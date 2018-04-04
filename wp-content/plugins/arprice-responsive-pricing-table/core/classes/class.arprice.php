<?php

class arpricelite {

    function __construct() {
        add_action('wp_ajax_arpricelite_delete', array(&$this, 'arpricelite_delete'));
        add_action('wp_ajax_arplite_pro_preview', array(&$this, 'arplite_pro_preview'));
        add_action('wp_ajax_arpsubscribe', array(&$this, 'arpreqact'));
        add_action('admin_init', array(&$this, 'upgrade_data'));
    }

    function upgrade_data() {
        global $wpdb, $arpricelite_version;
        $checkupdate = "";
        $checkupdate = get_option('arpricelite_version');

        if (version_compare($checkupdate, '1.1', '<')) {
            update_option('arpricelite_version', $arpricelite_version);
            update_option('arplite_popup_display', 'yes');
            update_option('arplite_already_subscribe', 'no');
        }

        if (version_compare($checkupdate, '1.7', '<')) {
            $path = ARPLITE_PRICINGTABLE_VIEWS_DIR . '/upgrade_latest_data.php';
            include($path);
        }
    }

    function arpreqact() {
        global $arpricelite_class;
        $plugres = $arpricelite_class->arpsubscribeuser();

        if (isset($plugres) && $plugres != "") {
            $responsetext = $plugres;

            if ($responsetext == "Subscribed Successfully.") {
                update_option('arplite_popup_display', 'no');
                update_option('arplite_already_subscribe', 'yes');
                echo "VERIFIED";
                exit;
            } else {
                echo $plugres;
                exit;
            }
        } else {
            echo "Invalid Request";
            exit;
        }
    }

    function arpsubscribeuser() {
        global $arpricelite_class;
        $lidata = array();

        $lidata[] = $_POST["cust_email"];

        if (!isset($_POST["cust_email"]) || $_POST["cust_email"] == "") {
            echo "Invalid Email";
            exit;
        }

        $pluginuniquecode = $arpricelite_class->generateplugincode();
        $lidata[] = $pluginuniquecode;
        $lidata[] = ARPLITEURL;
        $lidata[] = get_option("arpricelite_version");

        $valstring = implode("||", $lidata);
        $encodedval = base64_encode($valstring);

        $urltopost = "http://arprice.arformsplugin.com/premium/arprice_subscribe.php";


        $response = wp_remote_post($urltopost, array(
            'method' => 'POST',
            'timeout' => 45,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking' => true,
            'headers' => array(),
            'body' => array('verifysubscribe' => $encodedval),
            'cookies' => array()
                )
        );

        if (array_key_exists('body', $response) && isset($response["body"]) && $response["body"] != "")
            $responsemsg = $response["body"];
        else
            $responsemsg = "";


        if ($responsemsg != "" && $responsemsg == "Subscribed Successfully.") {
            update_option('arplite_popup_display', 'no');
            update_option('arplite_already_subscribe', 'yes');
            return "Subscribed Successfully.";
            exit;
        } else {
            return "Invalid Request";
            exit;
        }
    }

    function arpricelite_delete() {
        global $wpdb;
        $id = $_REQUEST['id'];
        $table = $wpdb->prefix . 'arplite_arprice';
        $tbl_option = $wpdb->prefix . 'arplite_arprice_options';
        $table_analytics = $wpdb->prefix . 'arplite_arprice_analytics';

        $sql = $wpdb->query($wpdb->prepare('SELECT is_template FROM ' . $table . ' WHERE ID = %d', $id));

        $is_template = $sql->is_template;

        if ($is_template != 1) {
            if (file_exists(ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/css/arplitetemplate_' . $id . '.css'))
                @unlink(ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/css/arplitetemplate_' . $id . '.css');
            if (file_exists(ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/template_images/arplitetemplate_' . $id . '.png')) {
                @unlink(ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/template_images/arplitetemplate_' . $id . '.png');
                @unlink(ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/template_images/arplitetemplate_' . $id . '_big.png');
                @unlink(ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/template_images/arplitetemplate_' . $id . '_large.png');
            }
        }

        $wpdb->query($wpdb->prepare('DELETE FROM ' . $table . ' WHERE ID = %d', $id));

        $wpdb->query($wpdb->prepare('DELETE FROM ' . $tbl_option . ' WHERE table_id = %d', $id));

        $wpdb->query($wpdb->prepare('DELETE FROM ' . $table_analytics . ' WHERE pricing_table_id = %d', $id));

        die();
    }

    function generateplugincode() {
        $siteinfo = array();

        $siteinfo[] = get_bloginfo('name');
        $siteinfo[] = get_bloginfo('description');
        $siteinfo[] = home_url();
        $siteinfo[] = get_bloginfo('admin_email');
        $siteinfo[] = $_SERVER['SERVER_ADDR'];

        $newstr = implode("^", $siteinfo);
        $postval = base64_encode($newstr);

        return $postval;
    }

    function table_dropdown_widget($field_name = '', $field_id = '', $default_value = '') {
        global $wpdb;
        $tables = $wpdb->get_results($wpdb->prepare("SELECT ID, table_name FROM " . $wpdb->prefix . "arplite_arprice WHERE status = '%s' and is_template != '%d'", array('published', '1')));
        $price_tabel = '';
        if ($tables) {
            $price_tabel .= '<select name="' . $field_name . '" id="' . $field_id . '" class="arp_table_list">';
            foreach ($tables as $table) {
                $price_tabel .= '<option value="' . $table->ID . '" ' . selected($table->ID, $default_value, false) . '>' . $table->table_name . '</option>';
            }
            $price_tabel .= '</select>';
        }
        return $price_tabel;
    }

    function arplite_pro_preview() {

        global $arpricelite_img_css_version;

        $template_id = $_REQUEST['template_id'];

        echo "<image src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/" . $template_id . "_v" . $arpricelite_img_css_version . "_preview.png' style='width:1000px;position:relative;left:45px;' />";
        die();
    }

}

?>