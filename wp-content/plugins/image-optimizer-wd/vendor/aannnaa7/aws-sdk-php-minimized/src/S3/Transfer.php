<?php
namespace Aws\S3;

use Aws;
use Aws\CommandInterface;
use Aws\ResultInterface;
use GuzzleHttp\Promise;
use GuzzleHttp\Psr7;
use GuzzleHttp\Promise\PromisorInterface;

/**
 * Transfers files from the local filesystem to S3 or from S3 to the local
 * filesystem.
 *
 * This class does not support copying from the local filesystem to somewhere
 * else on the local filesystem or from one S3 bucket to another.
 */
class Transfer implements PromisorInterface
{
    private $client;
    private $promise;
    private $source;
    private $destination;
    private $concurrency;
    private $mupThreshold;
    private $before;
    private $s3Args = [];

    /**
     * When providing the $source argument, you may provide a string referencing
     * the path to a directory on disk to upload, an s3 scheme URI that contains
     * the bucket and key (e.g., "s3://bucket/key"), or an \Iterator object
     * that yields strings containing filenames that are the path to a file on
     * disk or an s3 scheme URI. The "/key" portion of an s3 URI is optional.
     *
     * When providing an iterator for the $source argument, you must also
     * provide a 'base_dir' key value pair in the $options argument.
     *
     * The $dest argument can be the path to a directory on disk or an s3
     * scheme URI (e.g., "s3://bucket/key").
     *
     * The options array can contain the following key value pairs:
     *
     * - base_dir: (string) Base directory of the source, if $source is an
     *   iterator. If the $source option is not an array, then this option is
     *   ignored.
     * - before: (callable) A callback to invoke before each transfer. The
     *   callback accepts the following positional arguments: string $source,
     *   string $dest, Aws\CommandInterface $command. The provided command will
     *   be either a GetObject, PutObject, InitiateMultipartUpload, or
     *   UploadPart command.
     * - mup_threshold: (int) Size in bytes in which a multipart upload should
     *   be used instead of PutObject. Defaults to 20971520 (20 MB).
     * - concurrency: (int, default=5) Number of files to upload concurrently.
     *   The ideal concurrency value will vary based on the number of files
     *   being uploaded and the average size of each file. Generally speaking,
     *   smaller files benefit from a higher concurrency while larger files
     *   will not.
     * - debug: (bool) Set to true to print out debug information for
     *   transfers. Set to an fopen() resource to write to a specific stream
     *   rather than writing to STDOUT.
     *
     * @param S3Client         $client  Client used for transfers.
     * @param string|\Iterator $source  Where the files are transferred from.
     * @param string           $dest    Where the files are transferred to.
     * @param array            $options Hash of options.
     */
    public function __construct(
        S3Client $client,
        $source,
        $dest,
        array $options = []
    ) {
        $this->client = $client;

        // Prepare the destination.
        $this->destination = $this->prepareTarget($dest);
        if ($this->destination['scheme'] === 's3') {
            $this->s3Args = $this->getS3Args($this->destination['path']);
        }

        // Prepare the source.
        if (is_string($source)) {
            $this->source = $this->prepareTarget($source);
        } elseif ($source instanceof \Iterator) {
            if (isset($options['base_dir'])) {
                $this->source = $this->prepareTarget($options['base_dir']);
            } else {
                throw new \InvalidArgumentException('You must provide the source'
                    . ' argument as a string or provide the "base_dir" option.');
            }
        } else {
            throw new \InvalidArgumentException('source must be the path to a '
                . 'directory or an iterator that yields file names.');
        }

        // Validate schemes.
        if ($this->source['scheme'] === $this->destination['scheme']) {
            throw new \InvalidArgumentException("You cannot copy from "
                . "{$this->source['scheme']} to {$this->destination['scheme']}."
            );
        }

        // Handle multipart-related options.
        $this->concurrency = isset($options['concurrency'])
            ? $options['concurrency']
            : MultipartUploader::DEFAULT_CONCURRENCY;
        $this->mupThreshold = isset($options['mup_threshold'])
            ? $options['mup_threshold']
            : 16777216;
        if ($this->mupThreshold < MultipartUploader::PART_MIN_SIZE) {
            throw new \InvalidArgumentException('mup_threshold must be >= 5MB');
        }

        // Handle "before" callback option.
        if (isset($options['before'])) {
            $this->before = $options['before'];
            if (!is_callable($this->before)) {
                throw new \InvalidArgumentException('before must be a callable.');
            }
        }

        // Handle "debug" option.
        if (isset($options['debug'])) {
            if ($options['debug'] === true) {
                $options['debug'] = fopen('php://output', 'w');
            }
            $this->addDebugToBefore($options['debug']);
        }
    }

    /**
     * Transfers the files.
     */
    public function promise()
    {
        // If the promise has been created, just return it.
        if (!$this->promise) {
            // Create an upload/download promise for the transfer.
            $this->promise = $this->source['scheme'] === 'file'
                ? $this->createUploadPromise()
                : $this->createDownloadPromise();
        }

        return $this->promise;
    }

    /**
     * Transfers the files synchronously.
     */
    public function transfer()
    {
        $this->promise()->wait();
    }

    private function prepareTarget($targetPath)
    {
        $target = [
            'path'   => $this->normalizePath($targetPath),
            'scheme' => $this->determineScheme($targetPath),
        ];

        if ($target['scheme'] !== 's3' && $target['scheme'] !== 'file') {
            throw new \InvalidArgumentException('Scheme must be "s3" or "file".');
        }

        return $target;
    }

    /**
     * Creates an array that contains Bucket and Key by parsing the filename.
     *
     * @param string $path Path to parse.
     *
     * @return array
     */
    private function getS3Args($path)
    {
        $parts = explode('/', str_replace('s3://', '', $path), 2);
        $args = ['Bucket' => $parts[0]];
        if (isset($parts[1])) {
            $args['Key'] = $parts[1];
        }

        return $args;
    }

    /**
     * Parses the scheme from a filename.
     *
     * @param string $path Path to parse.
     *
     * @return string
     */
    private function determineScheme($path)
    {
        return !strpos($path, '://') ? 'file' : explode('://', $path)[0];
    }

    /**
     * Normalize a path so that it has UNIX-style directory separators and no trailing /
     *
     * @param string $path
     *
     * @return string
     */
    private function normalizePath($path)
    {
        return rtrim(str_replace('\\', '/', $path), '/');
    }

    private function createDownloadPromise()
    {
        // Prepare args for ListObjects.
        $listArgs = $this->getS3Args($this->source['path']);
        if (isset($listArgs['Key'])) {
            $listArgs['Prefix'] = $listArgs['Key'] . '/';
            unset($listArgs['Key']);
        }

        // Get the Paginator for ListObjects
        $objects = $this->client->getPaginator('ListObjects', $listArgs);

        // Asynchronously execute the paginator, building command pools to
        // download the objects.
        return $objects->each(function (
            ResultInterface $result
        ) use ($listArgs) {
            $commands = [];
            $prefix = isset($listArgs['Prefix']) ? $listArgs['Prefix'] : null;
            foreach ($result->search('Contents[].Key') as $key) {
                // Skip files on S3 that just mark the existence of a folder.
                if (substr($key, -1, 1) === '/') {
                    continue;
                }

                // Prepare the sink.
                $localKey = $key;
                if ($prefix && strpos($localKey, $prefix) === 0) {
                    $localKey = substr($key, strlen($prefix));
                }
                $sink = $this->destination['path'] . '/' . $localKey;

                // Create the directory if needed.
                $dir = dirname($sink);
                if (!is_dir($dir) && !mkdir($dir, 0777, true)) {
                    return Promise\rejection_for(
                        new \RuntimeException("Could not create dir: {$dir}")
                    );
                }

                // Create the command.
                $commands[] = $this->client->getCommand('GetObject', [
                    'Bucket' => $listArgs['Bucket'],
                    'Key'    => $key,
                    '@http'  => ['sink'  => $sink],
                ]);
            }

            // Create a GetObject command pool and return the promise.
            return (new Aws\CommandPool($this->client, $commands, [
                'concurrency' => $this->concurrency,
                'before'      => $this->before,
                'rejected'    => function ($reason, $idx, Promise\PromiseInterface $p) {
                    $p->reject($reason);
                }
            ]))->promise();
        });
    }

    private function createUploadPromise()
    {
        // Creates an iterator that yields promises for either upload or
        // multipart upload operations for each file in the source directory.
        $files = Aws\recursive_dir_iterator($this->source['path']);
        // Filter out directories.
        $files = \Aws\filter($files, function ($file) {
            return !is_dir($file);
        });
        // Map each file into a promise that performs the actual transfer.
        $files = \Aws\map($files, function ($file) {
            return (filesize($file) >= $this->mupThreshold)
                ? $this->uploadMultipart($file)
                : $this->upload($file);
        });

        // Create an EachPromise, that will concurrently handle the upload
        // operations' yielded promises from the iterator.
        return Promise\each_limit_all($files, $this->concurrency);
    }

    private function upload($filename)
    {
        $args = $this->s3Args;
        $args['SourceFile'] = $filename;
        $args['Key'] = $this->createS3Key($filename);
        $command = $this->client->getCommand('PutObject', $args);
        $this->before and call_user_func($this->before, $command);

        return $this->client->executeAsync($command);
    }

    private function uploadMultipart($filename)
    {
        $args = $this->s3Args;
        $args['Key'] = $this->createS3Key($filename);

        return (new MultipartUploader($this->client, $filename, [
            'bucket'          => $args['Bucket'],
            'key'             => $args['Key'],
            'before_initiate' => $this->before,
            'before_upload'   => $this->before,
            'before_complete' => $this->before,
            'concurrency'     => $this->concurrency,
        ]))->promise();
    }

    private function createS3Key($filename)
    {
        $relative_file_path = ltrim(
            preg_replace('#^' . preg_quote($this->source['path']) . '#', '', $filename),
            '/\\'
        );
        
        if (isset($this->s3Args['Key'])) {
            return rtrim($this->s3Args['Key'], '/').'/'.$relative_file_path;
        }

        return $relative_file_path;
    }

    private function addDebugToBefore($debug)
    {
        $before = $this->before;
        $sourcePath = $this->source['path'];
        $s3Args = $this->s3Args;

        $this->before = static function (
            CommandInterface $command
        ) use ($before, $debug, $sourcePath, $s3Args) {
            // Call the composed before function.
            $before and $before($command);

            // Determine the source and dest values based on operation.
            switch ($operation = $command->getName()) {
                case 'GetObject':
                    $source = "s3://{$command['Bucket']}/{$command['Key']}";
                    $dest = $command['@http']['sink'];
                    break;
                case 'PutObject':
                    $source = $command['SourceFile'];
                    $dest = "s3://{$command['Bucket']}/{$command['Key']}";
                    break;
                case 'UploadPart':
                    $part = $command['PartNumber'];
                case 'CreateMultipartUpload':
                case 'CompleteMultipartUpload':
                    $sourceKey = $command['Key'];
                    if (isset($s3Args['Key']) && strpos($sourceKey, $s3Args['Key']) === 0) {
                        $sourceKey = substr($sourceKey, strlen($s3Args['Key']) + 1);
                    }
                    $source = "{$sourcePath}/{$sourceKey}";
                    $dest = "s3://{$command['Bucket']}/{$command['Key']}";
                    break;
                default:
                    throw new \UnexpectedValueException(
                        "Transfer encountered an unexpected operation: {$operation}."
                    );
            }

            // Print the debugging message.
            $context = sprintf('%s -> %s (%s)', $source, $dest, $operation);
            if (isset($part)) {
                $context .= " : Part={$part}";
            }
            fwrite($debug, "Transferring {$context}\n");
        };
    }
}
