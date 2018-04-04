<?php

class arpricelite_import_export {

    function __construct() {

        add_action('wp_ajax_arplite_import_table', array(&$this, 'import_table'));

        add_action('wp_ajax_arplite_get_table_list', array(&$this, 'export_table_list'));

        add_action('init', array(&$this, 'arplite_export_pricing_tables'));
    }

    function arplite_export_pricing_tables() {

        if (is_admin()) {

            if (isset($_POST['arplite_export_tables']) && $_REQUEST['page'] = 'arplite_import_export') {
                global $wpdb, $arpricelite_import_export;

                $arp_db_version = get_option('arpricelite_version');

                $wp_upload_dir = wp_upload_dir();
                $upload_dir = $wp_upload_dir['basedir'] . '/arprice-responsive-pricing-table/';
                $upload_dir_url = $wp_upload_dir['url'];
                $upload_dir_base_url = $wp_upload_dir['baseurl'] . '/arprice-responsive-pricing-table/';
                $charset = get_option('blog_charset');

                @ini_set('max_execution_time', 0);

                if (!empty($_REQUEST['table_to_export'])) {
                    $table_ids = implode(',', $_REQUEST['table_to_export']);

                    $file_name = "arplite_" . time();

                    $filename = $file_name . '.txt';

                    $sql_main = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "arplite_arprice WHERE ID in(" . $table_ids . ")");

                    $xml = "";
                    $xml .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

                    $xml .= "<arplite>\n";

                    foreach ($sql_main as $key => $result) {

                        $xml .= "\t<arplite_table id='" . $result->ID . "'>\n";

                        $xml .= "\t\t<site_url><![CDATA[" . site_url() . "]]></site_url>\n";

                        $xml .= "\t\t<arp_plugin_version><![CDATA[" . $arp_db_version . "]]></arp_plugin_version>\n";

                        $xml .= "\t\t<arp_table_name><![CDATA[" . $result->table_name . "]]></arp_table_name>\n";

                        $xml .= "\t\t<status><![CDATA[" . $result->status . "]]></status>\n";

                        $xml .= "\t\t<is_template><![CDATA[" . $result->is_template . "]]></is_template>\n";

                        $xml .= "\t\t<template_name><![CDATA[" . $result->template_name . "]]></template_name>\n";

                        $xml .= "\t\t<is_animated><![CDATA[" . $result->is_animated . "]]></is_animated>\n";


                        if ($arp_db_version > '1.0') {
                            $arp_db_version1 = '1.0';
                        }

                        $general_options_new = unserialize($result->general_options);

                        $arp_main_reference_template = $general_options_new['general_settings']['reference_template'];

                        $arp_exp_arp_main_reference_template = explode('_', $arp_main_reference_template);

                        $arp_new_arp_main_reference_template = $arp_exp_arp_main_reference_template[1];

                        if ($result->is_template == 1) {

                            $xml .= "\t\t<arp_template_img><![CDATA[" . ARPLITE_PRICINGTABLE_URL . "/images/arplitetemplate_" . $arp_new_arp_main_reference_template . "_v" . $arp_db_version1 . ".png" . "]]></arp_template_img>";
                            $xml .= "\t\t<arp_template_img_big><![CDATA[" . ARPLITE_PRICINGTABLE_URL . "/images/arplitetemplate_" . $arp_new_arp_main_reference_template . "_v" . $arp_db_version1 . "_big.png" . "]]></arp_template_img_big>";
                            $xml .= "\t\t<arp_template_img_large><![CDATA[" . ARPLITE_PRICINGTABLE_URL . "/images/arplitetemplate_" . $arp_new_arp_main_reference_template . "_" . $arp_db_version1 . "_large.png" . "]]></arp_template_img_large>";
                        } else {
                            $xml .= "\t\t<arp_template_img><![CDATA[" . $upload_dir_base_url . "template_images/arplitetemplate_" . $result->ID . ".png" . "]]></arp_template_img>";
                            $xml .= "\t\t<arp_template_img_big><![CDATA[" . $upload_dir_base_url . "template_images/arplitetemplate_" . $result->ID . "_big.png" . "]]></arp_template_img_big>";
                            $xml .= "\t\t<arp_template_img_large><![CDATA[" . $upload_dir_base_url . "template_images/arplitetemplate_" . $result->ID . "_large.png" . "]]></arp_template_img_large>";
                        }


                        $xml .= "\t\t<options>\n";

                        $xml .= "\t\t\t<general_options>";

                        $arp_general_options = unserialize($result->general_options);

                        $arp_gen_opt_new = array();

                        $new_general_options = $this->arprice_recursive_array_function($arp_general_options, 'export');

                        $general_opt = serialize($new_general_options);

                        $xml .= "<![CDATA[" . $general_opt . "]]>";

                        $xml .= "</general_options>\n";

                        $sql = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "arplite_arprice_options WHERE table_id = %d", $result->ID));

                        $xml .= "\t\t\t<column_options>";

                        $table_opts = unserialize($sql[0]->table_options);

                        $arp_tbl_opt = array();

                        $new_array = $this->arprice_recursive_array_function($table_opts, 'export');

                        $table_opts = serialize($new_array);

                        $xml .= "<![CDATA[" . $table_opts . "]]>";

                        $xml .= "</column_options>\n";

                        $xml .= "\t\t</options>\n";

                        $table_opt = unserialize($sql[0]->table_options);

                        foreach ($table_opt['columns'] as $c => $res) {
                            $str = isset($res['arp_header_shortcode']) ? $res['arp_header_shortcode'] : '';

                            $btn_img = isset($res['btn_img']) ? $res['btn_img'] : '';


                            if ($btn_img != "") {
                                $btn_img_src = $btn_img;
                                $img_file_name = explode('/', $btn_img_src);
                                $btn_img_file = $img_file_name[count($img_file_name) - 1];

                                @copy($btn_img, $upload_dir . "temp_" . $btn_img_file);

                                if (file_exists($upload_dir . "temp_" . $btn_img_file)) {

                                    $filename_arry[] = "temp_" . $btn_img_file;

                                    $button_img = "temp_" . $file_name;

                                    $xml .= "\t\t<" . $c . "_btn_img>" . $btn_img_src . "</" . $c . "_btn_img>\n";
                                }
                            }

                            if ($str != "") {

                                $header_img = esc_html(stristr($str, '<img'));


                                if ($header_img != "") {
                                    $img_src = $arprice_import_export->getAttribute('src', $str);

                                    $img_height = $arprice_import_export->getAttribute('height', $header_img);

                                    $img_width = $arprice_import_export->getAttribute('width', $header_img);

                                    $img_class = $arprice_import_export->getAttribute('class', $header_img);

                                    $img_src = trim($img_src, '&quot;');
                                    $img_src = trim($img_src, '"');
                                    $img_height = trim($img_height, '&quot;');
                                    $img_height = trim($img_height, '"');
                                    $img_width = trim($img_width, '&quot;');
                                    $img_width = trim($img_width, '"');
                                    $img_class = trim($img_class, '&quot;');
                                    $img_class = trim($img_class, '"');

                                    $img_height = (!empty($img_height) ) ? $img_height : '';
                                    $img_width = (!empty($img_width) ) ? $img_width : '';
                                    $img_class = (!empty($img_class) ) ? $img_class : '';
                                    $img_src = (!empty($img_src) ) ? $img_src : '';

                                    $explodefilename = explode('/', $img_src);

                                    $header_img_name = $explodefilename[count($explodefilename) - 1];

                                    $header_img = $header_img_name;

                                    if ($header_img != "") {
                                        $newfilename1 = $header_img;

                                        @copy($img_src, $upload_dir . "temp_" . $newfilename1);

                                        if (file_exists($upload_dir . "temp_" . $newfilename1)) {

                                            $filename_arry[] = "temp_" . $newfilename1;

                                            $header_img = "temp_" . $newfilename1;
                                        }
                                    }

                                    if (file_exists($upload_dir . "temp_" . $newfilename1)) {

                                        $xml .= "\t\t<" . $c . "_img>" . $img_src . "</" . $c . "_img>\n";

                                        $xml .= "\t\t<" . $c . "_img_width>" . $img_width . "</" . $c . "_img_width>\n";

                                        $xml .= "\t\t<" . $c . "_img_height>" . $img_height . "</" . $c . "_img_height>\n";

                                        $xml .= "\t\t<" . $c . "_img_class>" . $img_class . "</" . $c . "_img_class>\n";
                                    }
                                }
                            }
                        }

                        $xml .= "\t</arplite_table>\n\n";
                    }

                    $xml .= "</arplite>";


                    $xml = base64_encode($xml);



                    header("Content-type: text/plain");
                    header("Content-Disposition: attachment; filename=" . $filename);

                    ob_start();
                    echo $xml;
                    die;
                }
            }
        }
    }

    function Create_zip($source, $destination, $destindir) {
        $filename = array();
        $filename = @unserialize($source);

        $zip = new ZipArchive();
        if ($zip->open($destination, ZipArchive::CREATE) === TRUE) {
            $i = 0;
            foreach ($filename as $file) {
                $zip->addFile($destindir . $file, $file);
                $i++;
            }
            $zip->close();
        }

        foreach ($filename as $file1) {
            @unlink($destindir . $file1);
        }
    }

    function getAttribute($att, $tag = '') {
        $re = '/' . $att . '=([\'])?((?(1).+?|[^\s>]+))(?(1)\1)/is';

        if (preg_match($re, $tag, $match)) {
            return urldecode($match[2]);
        }
        return false;
    }

    function get_table_list() {
        global $wpdb;
        $table = $wpdb->prefix . 'arplite_arprice';

        $res_default_template = $wpdb->get_results("SELECT * FROM " . $table . " WHERE  status = 'published' AND is_template ='1' ORDER BY ID ASC ");
        ?>
        <select multiple="multiple" name="arp_table_to_export[]" id="arp_table_to_export">
            <?php
            foreach ($res_default_template as $r) {
                ?>
                <option value="<?php echo $r->ID; ?>">Template ::&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $r->table_name; ?>&nbsp;&nbsp;&nbsp;&nbsp;[<?php echo $r->ID; ?>]</option>
                <?php
            }

            $res_new_template = $wpdb->get_results("SELECT * FROM " . $table . " WHERE  status = 'published' AND is_template ='0' ORDER BY ID ASC ");

            foreach ($res_new_template as $r) {
                ?>
                <option value="<?php echo $r->ID; ?>">Table ::&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $r->table_name; ?>&nbsp;&nbsp;&nbsp;&nbsp;[<?php echo $r->ID; ?>]</option>
                <?php
            }
            ?>
        </select>
        <?php
    }

    function export_table_list() {
        global $arpricelite_import_export;
        $arpricelite_import_export->get_table_list();
        die();
    }

    function import_table() {
        $_SESSION['arprice_image_array'] = array();

        WP_Filesystem();


        global $wpdb, $arpricelite_images_css_version;
        $arpricelite_images_css_version = '1.0';
        $table = $wpdb->prefix . 'arplite_arprice';

        $table_opt = $wpdb->prefix . 'arplite_arprice_options';

        $file_name = $_REQUEST['xml_file'];

        @ini_set('max_execution_time', 0);

        $wp_upload_dir = wp_upload_dir();

        $output_url = $wp_upload_dir['baseurl'] . '/arprice-responsive-pricing-table/';
        $output_dir = $wp_upload_dir['basedir'] . '/arprice-responsive-pricing-table/';

        $upload_dir_path = $wp_upload_dir['basedir'] . '/arprice-responsive-pricing-table/';
        $upload_dir_url = $wp_upload_dir['baseurl'] . '/arprice-responsive-pricing-table/';

        $xml_file = $output_dir . 'import/' . $file_name . '.txt';

        $xml_content = file_get_contents($xml_file);


        $xml = base64_decode($xml_content);


        $ik = 1;

        $xml = simplexml_load_string($xml);

        if (isset($xml->arplite_table)) {
            foreach ($xml->children() as $key_main => $val_main) {

                $sqls = $wpdb->get_results($wpdb->prepare("SELECT count(ID) AS total FROM " . $wpdb->prefix . "arplite_arprice WHERE is_template = %d", 0));
                if (isset($sqls[0]->total) && ($sqls[0]->total) >= 4) {
                    echo 2;
                    die();
                    return;
                }
                $attr = $val_main->attributes();
                $old_id = $attr['id'];
                $status = $val_main->status;
                $is_template = $val_main->is_template;
                $template_name = $val_main->template_name;
                $is_animated = $val_main->is_animated;
                $arprice_import_version = $val_main->arp_plugin_version;

                $table_name = $val_main->arp_table_name;
                $arp_template_css = $val_main->arp_template_css;


                $arp_template_img = $val_main->arp_template_img;
                $arp_template_img_big = $val_main->arp_template_img_big;
                $arp_template_img_large = $val_main->arp_template_img_large;

                $date = current_time('mysql');
                foreach ($val_main->options->children() as $key => $val) {
                    if ($key == 'general_options') {
                        $general_options = (string) $val;

                        $general_options_new = maybe_unserialize($general_options);


                        if (isset($general_options_new['column_animation'])) {
                            echo 0;
                            die();
                            return;
                        }
                        if (isset($general_options_new['tooltip_settings'])) {
                            echo 0;
                            die();
                            return;
                        }
                        $arp_main_reference_template = $general_options_new['general_settings']['reference_template'];

                        $reference_template = $general_options_new['general_settings']['reference_template'];

                        $general_options_new = $this->arprice_recursive_array_function($general_options_new, 'import');

                        $general_options = serialize($general_options_new);
                    } else if ($key == 'column_options') {

                        $column_options = (string) $val;

                        $column_opts = unserialize($column_options);

                        $column_opts = $this->arprice_recursive_array_function($column_opts, 'import');

                        foreach ($column_opts['columns'] as $c => $columns) {

                            /* -- Caption Column Header Title -- */
                            if (isset($columns['html_content'])) {
                                $html_content = $this->arpricelite_copy_image_from_content($columns['html_content']);
                                $column_opts['columns'][$c]['html_content'] = $html_content;
                            }


                            /* -- Other Column Header Title -- */
                            if (isset($columns['package_title'])) {
                                $header_content = $this->arpricelite_copy_image_from_content($columns['package_title']);
                                $column_opts['columns'][$c]['package_title'] = $header_content;
                            }


                            /* -- Other Column Price Content -- */
                            if (isset($columns['price_text'])) {
                                $price_text = $this->arpricelite_copy_image_from_content($columns['price_text']);
                                $column_opts['columns'][$c]['price_text'] = $price_text;
                            }


                            /* -- Other Column Header Shortcode -- */
                            if (isset($columns['arp_header_shortcode'])) {
                                $arp_header_shortcode = $this->arpricelite_copy_image_from_content($columns['arp_header_shortcode']);
                                $column_opts['columns'][$c]['arp_header_shortcode'] = $arp_header_shortcode;
                            }

                            /* -- Other Column Column Description -- */
                            if (isset($columns['column_description'])) {
                                $column_description = $this->arpricelite_copy_image_from_content($columns['column_description']);
                                $column_opts['columns'][$c]['column_description'] = $column_description;
                            }


                            /* All Columns Row Changes */
                            if (is_array($columns['rows']) && count($columns['rows']) > 0) {
                                foreach ($columns['rows'] as $r => $row) {
                                    $row_description = $this->arpricelite_copy_image_from_content($row['row_description']);
                                    $column_opts['columns'][$c]['rows'][$r]['row_description'] = $row_description;
                                }
                            }

                            /* Footer Content */
                            $footer_content = $this->arpricelite_copy_image_from_content($columns['footer_content']);
                            $column_opts['columns'][$c]['footer_content'] = $footer_content;

                            /* Button Text */
                            $button_text = $this->arpricelite_copy_image_from_content($columns['button_text']);
                            $column_opts['columns'][$c]['button_text'] = $button_text;

                            $btn_img = $c . '_btn_img';

                            if ($val_main->$btn_img != "") {
                                $btn_image = $c . "_btn_img";
                                $button_img = $val_main->$btn_image;
                                $image_name = explode('/', $button_img);
                                $image_nm = $image_name[count($image_name) - 1];
                                $image_name = 'arp_' . time() . '_' . $image_nm;

                                $base_url = trim($button_img);
                                $new_path = $upload_dir_path . $image_name;
                                $new_url = $upload_dir_url . $image_name;
                                if (array_key_exists($base_url, $_SESSION['arprice_image_array'])) {
                                    $new_url = $_SESSION['arprice_image_array'][$base_url];
                                } else {
                                    @copy($base_url, $new_path);
                                    $_SESSION['arprice_image_array'][$base_url] = $new_url;
                                }

                                $column_opts['columns'][$c]['btn_img'] = $new_url;
                            }
                        }

                        $column_options = serialize($column_opts);
                    }
                }

                $wpdb->query($wpdb->prepare('INSERT INTO ' . $table . ' (table_name,general_options,is_template,is_animated,status,create_date,arp_last_updated_date) VALUES (%s,%s,%s,%s,%s,%s,%s)', $table_name, $general_options, 0, $is_animated, $status, $date, $date));

                $new_id = $wpdb->insert_id;

                $ref_id = str_replace('arplitetemplate_', '', $reference_template);

                if ($ref_id >= 20) {
                    $ref_id = $ref_id - 3;
                    $reference_template = 'arplitetemplate_' . $ref_id;
                }

                $file = ARPLITE_PRICINGTABLE_DIR . '/css/templates/' . $reference_template . '_v' . $arpricelite_images_css_version . '.css';

                $content = @file_get_contents($file);

                $css_content = preg_replace('/arplitetemplate_([\d]+)/', 'arplitetemplate_' . $new_id, $content);


                $css_content = str_replace('../../images', ARPLITE_PRICINGTABLE_IMAGES_URL, $css_content);

                $css_file_name = 'arplitetemplate_' . $new_id . '.css';

                $template_img_name = 'arplitetemplate_' . $new_id . '.png';
                $template_img_big_name = 'arplitetemplate_' . $new_id . '_big.png';
                $template_img_large_name = 'arplitetemplate_' . $new_id . '_large.png';

                $arp_img_copy_error = @copy($arp_template_img, $upload_dir_path . 'template_images/' . $template_img_name);

                if ($arp_img_copy_error == 0) {
                    $i1 = @copy(ARPLITE_PRICINGTABLE_DIR . '/images/' . $arp_main_reference_template . '.png', $upload_dir_path . 'template_images/' . $template_img_name);
                }

                $arp_bigimg_copy_error = @copy($arp_template_img_big, $upload_dir_path . 'template_images/' . $template_img_big_name);

                if ($arp_bigimg_copy_error == 0) {
                    @copy(ARPLITE_PRICINGTABLE_DIR . '/images/' . $arp_main_reference_template . '_big.png', $upload_dir_path . 'template_images/' . $template_img_big_name);
                }

                $arp_largeimg_copy_error = @copy($arp_template_img_large, $upload_dir_path . 'template_images/' . $template_img_large_name);

                if ($arp_largeimg_copy_error == 0) {
                    @copy(ARPLITE_PRICINGTABLE_DIR . '/images/' . $arp_main_reference_template . '_large.png', $upload_dir_path . 'template_images/' . $template_img_large_name);
                }


                global $wp_filesystem;

                $wp_filesystem->put_contents(ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/css/' . $css_file_name, $css_content, 0777);

                $wpdb->query($wpdb->prepare('INSERT INTO ' . $table_opt . ' (table_id,table_options) VALUES (%d,%s)', $new_id, $column_options));
            }
            @unlink($wp_upload_dir['basedir'] . '/arprice-responsive-pricing-table/import/' . $file_name . '.zip');

            echo 1;
        } else if (!isset($xml->arplite_table)) {
            echo 0;
        }
        unset($_SESSION['arprice_image_array']);
        die();
    }

    function arprice_recursive_array_function($array = array(), $type = 'export') {

        $temp = array();
        if (is_array($array) and ! empty($array)) {
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $temp[$key] = $this->arprice_recursive_array_function($value, $type);
                } else {
                    if ($type == 'export') {
                        $temp[$key] = str_replace('&lt;br /&gt;', '[ENTERKEY]', str_replace('&lt;br/&gt;', '[ENTERKEY]', str_replace('&lt;br&gt;', '[ENTERKEY]', str_replace('<br />', '[ENTERKEY]', str_replace('<br/>', '[ENTERKEY]', str_replace('<br>', '[ENTERKEY]', trim(preg_replace('/\s\s+/', ' ', $value))))))));
                        $temp[$key] = str_replace('&amp;', '[AND]', $temp[$key]);
                    } else if ($type == 'import') {
                        $temp[$key] = str_replace("[ENTERKEY]", "<br>", $value);
                        $temp[$key] = str_replace("[AND]", "&amp;", $temp[$key]);
                    }
                }
            }
        }

        return $temp;
    }

    function arpricelite_copy_image_from_content($content = '') {
        if ($content === '') {
            return $content;
        }
        WP_Filesystem();

        $wp_upload_dir = wp_upload_dir();

        $upload_dir_path = $wp_upload_dir['basedir'] . '/arprice-responsive-pricing-table/';
        $upload_dir_url = $wp_upload_dir['baseurl'] . '/arprice-responsive-pricing-table/';

        if (is_ssl()) {
            $upload_dir_url = str_replace("http://", "https://", $upload_dir_url);
        }

        $pattern = "#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#";
        $matches = array();
        preg_match_all($pattern, $content, $matches);

        $imgextensions = array('jpeg', 'jpg', 'bmp', 'ico', 'png', 'gif', 'svg');
        if ($matches[0] !== '' && is_array($matches[0]) && count($matches[0]) > 0) {
            foreach ($matches[0] as $key => $link) {
                $link = trim($link, '"');
                $linkpart = explode('/', $link);
                $lastpart = $linkpart[count($linkpart) - 1];
                $get_extension = explode('.', $lastpart);
                $extension = $get_extension[count($get_extension) - 1];
                if (in_array($extension, $imgextensions)) {
                    $image_name = 'arp_' . time() . '_' . $lastpart;

                    $base_url = trim($link);
                    $new_path = $upload_dir_path . $image_name;
                    $new_url = $upload_dir_url . $image_name;
                    if (array_key_exists($base_url, $_SESSION['arprice_image_array'])) {
                        $new_url = $_SESSION['arprice_image_array'][$base_url];
                        $nlinkpart = explode('/', $new_url);
                        $nlastpart = $nlinkpart[count($nlinkpart) - 1];
                        $new_path = $upload_dir_path . $nlastpart;
                    } else {
                        @copy($base_url, $new_path);
                        $_SESSION['arprice_image_array'][$base_url] = $new_url;
                    }

                    if (file_exists($new_path)) {
                        $newlink = $new_url;
                        $content = str_replace($link, $newlink, $content);
                    } else {
                        $content = $content;
                    }
                } else {
                    continue;
                }
            }
        } else {
            return $content;
        }
        return $content;
    }

}
?>