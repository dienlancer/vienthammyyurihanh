<div id="arp_loader_div" class="arp_loader" style="display: none;">
    <div class="arp_loader_img"></div>
</div>
<?php
if (is_ssl())
    $google_font_url = "https://fonts.googleapis.com/css?family=Ubuntu|Roboto";
else
    $google_font_url = "http://fonts.googleapis.com/css?family=Ubuntu|Roboto";
?>
<link rel="stylesheet" type="text/css" href="<?php echo $google_font_url; ?>" />
<script type="application/javascript" language="javascript">
    jQuery(document).ready(function () {

    jQuery(document).on('click', '.buy_now_button', function () {
    var arp_version = document.getElementById('arp_version').value;
    var arp_request_version = document.getElementById('arp_request_version').value;

    var link_top_open = "http://arprice.arformsplugin.com/premium/upgrade_to_premium.php?rdt=t1&arp_version="+arp_version+"&arp_request_version="+arp_request_version;
    var win = window.open(link_top_open, '_blank');
    win.focus();
    });

    jQuery(document).on('click', '.learn_more_button', function () {
    //var link_top_open = "http://arprice.arformsplugin.com/?page_id=189";
    //var win = window.open(link_top_open, '_blank');
    //win.focus();

    var arp_version = document.getElementById('arp_version').value;
    var arp_request_version = document.getElementById('arp_request_version').value;

    var link_top_open = "http://arprice.arformsplugin.com/premium/upgrade_to_premium.php?rdt=t2&arp_version=" + arp_version + "&arp_request_version=" + arp_request_version;
    var win = window.open(link_top_open, '_blank');
    win.focus();

    });

    });	
</script>
<?php
global $wpdb, $arpricelite_import_export;

if (isset($_FILES["arp_pt_import_file"])) {
    global $wpdb, $WP_Filesystem;

    $wp_upload_dir = wp_upload_dir();
    $upload_dir = $wp_upload_dir['basedir'] . '/arprice-responsive-pricing-table/import/';

    $output_dir = $wp_upload_dir['basedir'] . '/arprice-responsive-pricing-table/import/';
    $output_url = $wp_upload_dir['baseurl'] . '/arprice-responsive-pricing-table/import/';

    if (!is_dir($output_dir))
        wp_mkdir_p($output_dir);

    $extexp = explode(".", $_FILES["arp_pt_import_file"]["name"]);
    $ext = $extexp[count($extexp) - 1];

    //Filter the file types , if you want.
    if (strtolower($ext) == "txt") {
        if ($_FILES["arp_pt_import_file"]["error"] > 0) {
            echo "Error: " . $_FILES["file"]["error"] . "<br>";
        } else {
            if (@move_uploaded_file($_FILES["arp_pt_import_file"]["tmp_name"], $output_dir . $_FILES["arp_pt_import_file"]["name"])) {
                $explodezipfilename = explode(".", $_FILES["arp_pt_import_file"]["name"]);
                $zipfilename = $explodezipfilename[0];
                ?>
                <script>
                    jQuery('#arp_loader_div').show();
                    var file_name = '<?php echo $zipfilename; ?>';
                    jQuery.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: 'action=arplite_import_table&xml_file=' + file_name,
                        success: function (res)
                        {
                            if (res == 1)
                            {

                                jQuery('#arp_loader_div').hide();
                                jQuery('#import_success_message').animate({width: 'toggle'}, 'slow');
                                jQuery('#import_success_message').delay(3000).animate({width: 'toggle'}, 'slow');
                                jQuery.ajax({
                                    type: 'POST',
                                    url: ajaxurl,
                                    data: 'action=arplite_get_table_list',
                                    success: function (res)
                                    {
                                        jQuery("#export_table_lists").html(res);
                                    }
                                });
                            }
                            else if (res == 0)
                            {
                                jQuery('#arp_loader_div').hide();
                                jQuery("#import_validation_zip_error_message").css('display', '');
                                setTimeout(function hide_err_msg() {
                                    jQuery("#import_validation_zip_error_message").fadeOut('slow');
                                }, 3000);
                            }
                            else if (res == 2) {
                                jQuery('#arp_loader_div').hide();
                                jQuery("#import_max_validation_zip_error_message").css('display', '');
                                setTimeout(function hide_err_msg() {
                                    jQuery("#import_max_validation_zip_error_message").fadeOut('slow');
                                }, 3000);
                            }
                        }
                    });
                </script>
                <?php
            }
        }
    }
}
?>

<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#arp_pt_import_file').on('change', function () {
            var filename = jQuery(this).val();

            if (filename == "") {
                jQuery('#arp_pt_import_file_name').html('No file Selected');
            } else {
                if (/C\:\\fakepath\\/gi.test(filename)) {
                    filename = filename.split('\\');
                    var flength = filename.length;
                    flength = flength - 1;
                    filename = filename[flength];
                }
                jQuery('#arp_pt_import_file_name').html(filename);
            }
        });
    });

    if (typeof select2 === 'function') {
        jQuery('select#arp_table_to_export').select2('distroy');
    }

    jQuery(document).on('click', '#pro_upgrade_button_custom_css,#pro_upgrade_cancel_button_custom_css', function () {
        jQuery('#arplite_custom_css_notice').bPopup().close();
    });
    /* Validating Imported file */
    function check_valid_imported_file()
    {
        var importFile = jQuery("#arp_pt_import_file").val();
        var extension = importFile.substr((importFile.lastIndexOf('.') + 1));
        var file_nm = importFile.split('_');

        if (/fakepath/g.test(file_nm[0])) {
            var file_nm_tmp = file_nm[0].split('\\');
            file_nm[0] = file_nm_tmp[file_nm_tmp.length - 1];
        }
        if (importFile == null || importFile == "")
        {
            jQuery("#import_invalid_zip_error_message").css('display', 'none');
            jQuery("#import_blank_zip_error_message").css('display', '');
            jQuery(window.opera ? 'html' : 'html, body').animate({scrollTop: jQuery('#import_blank_zip_error_message').offset().top - 250}, 'slow');
            return false;
        }
        else if (extension != 'txt')
        {
            jQuery("#import_blank_zip_error_message").css('display', 'none');
            jQuery("#import_invalid_zip_error_message").css('display', '');
            jQuery(window.opera ? 'html' : 'html, body').animate({scrollTop: jQuery('#import_invalid_zip_error_message').offset().top - 250}, 'slow');
            return false;
        }
        else if (file_nm[0] != 'arplite')
        {
            var isIE11 = !!navigator.userAgent.match(/Trident.*rv\:11\./);
            if (jQuery.browser.webkit || jQuery.browser.msie || jQuery.browser.opera || isIE11) {
                var arr_file_path = importFile.split('\\');
                var filename = arr_file_path[arr_file_path.length - 1];
                var arr_file_name = filename.split('_');
                if (arr_file_name[0] != 'arp') {
                    jQuery("#import_invalid_zip_error_message").css('display', '');
                    jQuery(window.opera ? 'html' : 'html, body').animate({scrollTop: jQuery('#import_invalid_zip_error_message').offset().top - 250}, 'slow');
                    return false;
                } else {
                    return true;
                }
            } else {
                jQuery("#import_invalid_zip_error_message").css('display', '');
                jQuery(window.opera ? 'html' : 'html, body').animate({scrollTop: jQuery('#import_invalid_zip_error_message').offset().top - 250}, 'slow');
                return false;
            }

        }
        else
        {
            return true;
        }
    }

    /* JavaScript for Exporting Table */
    function import_export_table()
    {
        var form = jQuery("#arp_export").serialize();
        if (jQuery("#table_to_export").val() == "" || jQuery("#table_to_export").val() == null)
        {
            jQuery("#export_blank_error_message").css('display', '');

            return false;
        }
        else
        {
            return true;

        }
        return false;
    }

</script>

<div class="arp_import_export_main">

    <div class="arp_import_export_main_title"><?php _e('Import / Export Pricing Tables', 'ARPricelite'); ?></div>
    <div class="clear" style="clear:both;"></div>
    <div class="success_message" id="import_success_message" style="">
        <?php _e('Table Imported Successfully', 'ARPricelite'); ?>
    </div> 
    <div class="error_message arp_message_padding" id="import_validation_zip_error_message" style="display:none;">
        <?php _e('Please Select file exported from ARPrice Plugin.', 'ARPricelite'); ?>
    </div>
    <div class="error_message arp_message_padding" id="import_max_validation_zip_error_message" style="display:none;">
        <?php _e('You can create maximum 4 tables in free version.', 'ARPricelite'); ?>
    </div>
    <div class="error_message arp_message_padding" id="import_invalid_zip_error_message" style="display:none;">
        <?php _e('Please Select Valid File.', 'ARPricelite'); ?>
    </div>
    <div class="error_message arp_message_padding" id="import_blank_zip_error_message" style="display:none;">
        <?php _e('Please Select File.', 'ARPricelite'); ?>
    </div>
    <div class="error_message arp_message_padding" id="export_blank_error_message" style="display:none;">
        <?php _e('Please Select Table.', 'ARPricelite'); ?>
    </div>
    <div class="clear" style="clear:both;"></div>
    <div class="arp_import_export_main_inner">

        <div class="arp_export_section">

            <div class="arp_import_export_sub_title"><?php _e('Export Pricing Tables', 'ARPricelite'); ?></div>

            <div class="import_export_list_main">
                <form  name="arplite_export" method="post" action="" id="arplite_export" onsubmit="return import_export_table();">
                    <div class="arp_import_export_frm_title"><?php _e('Please Select Table(s)', 'ARPricelite'); ?></div>
                    <div class="arp_import_export_frm_select" id="export_table_lists">
                        <?php
                        global $wpdb;
                        $table = $wpdb->prefix . 'arplite_arprice';

                        $res_default_template = $wpdb->get_results("SELECT * FROM " . $table . " WHERE  status = 'published' AND is_template ='1' ");
                        ?>
                        <select multiple="multiple" name="table_to_export[]" id="table_to_export">
                            <?php
                            foreach ($res_default_template as $r) {
                                ?>
                                <option value="<?php echo $r->ID; ?>">Template ::&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $r->table_name; ?>&nbsp;&nbsp;&nbsp;&nbsp;[<?php echo $r->ID; ?>]</option>
                                <?php
                            }

                            $res_new_template = $wpdb->get_results("SELECT * FROM " . $table . " WHERE  status = 'published' AND is_template ='0' ");

                            foreach ($res_new_template as $r) {
                                ?>
                                <option value="<?php echo $r->ID; ?>">Table ::&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $r->table_name; ?>&nbsp;&nbsp;&nbsp;&nbsp;[<?php echo $r->ID; ?>]</option>
                                <?php
                            }
                            ?>
                        </select>
                        <?php ?>
                    </div>
                    <div class="clear" style="clear:both;"></div>
                    <div class="arp_import_export_frm_submit">
                        <button class="arp_import_export_btn" type="submit" name="arplite_export_tables"><img class="arp_import_export_btn_img"><span class="arp_import_export_btn_txt"><?php _e('Export', 'ARPricelite'); ?></span></button> 
                    </div>
                </form>

            </div>
        </div> 


        <div class="arp_import_section">
            <div class="arp_import_export_sub_title"><?php _e('Import Pricing Tables', 'ARPricelite'); ?></div>

            <div class="import_export_list_main">
                <form name="arp_import" id="arp_import" method="post" enctype="multipart/form-data" onsubmit="return check_valid_imported_file();" >

                    <table align="left" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td colspan="3"><div class="arp_import_export_frm_title"><?php _e('Please Upload text file exported from ARPrice plugin', 'ARPricelite'); ?></div></td>
                        </tr>
                        <tr>
                            <td><div class="arp_import_export_select_title"><?php _e('Select File :', 'ARPricelite'); ?></div></td>                                
                        </tr>

                        <tr>
                            <td>
                                <input type="file" style="opacity:0;width:0px !important;;height:0px !important;;padding:0px !important;" id="arp_pt_import_file" name="arp_pt_import_file"  />
                                <label for="arp_pt_import_file" class="arp_import_file_main">
                                    <div  class="text pd_input_control pd_input_small helpdesk_txt">
                                        <div class="arp_import_export_file_btn"><?php _e('Add File', 'ARPricelite'); ?></div>
                                        <div id="arp_pt_import_file_name" class= "arp_import_file_name">
                                            <?php _e('No file Selected', 'ARPricelite'); ?>
                                        </div>
                                    </div>
                                </label>    
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="arp_import_export_frm_submit">
                                    <button class="arp_import_export_btn" type="submit" name="imprort_file" id="import_file" style="margin-top: 20px;"><img class="arp_import_export_btn_img"><span class="arp_import_export_btn_txt"><?php _e('Import', 'ARPricelite'); ?></span></button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

    </div>
</div>    


<div class="arp_upgrade_modal" id="arplite_custom_css_notice" style="display:none;">
    <div class="upgrade_modal_top_belt">
        <div class="logo" style="text-align:center;"><img src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/arprice_update_logo.png" /></div>
        <div id="nav_style_close" class="close_button b-close"><img src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/arprice_upgrade_close_img.png" /></div>
    </div>
    <div class="upgrade_title"><?php _e('Upgrade To Premium Version.', 'ARPricelite'); ?></div>
    <div class="upgrade_message"><?php _e('You can create maximum 4 columns in free version', 'ARPricelite'); ?></div>
    <div class="upgrade_modal_btn">
        <button id="pro_upgrade_button"  type="button" class="buy_now_button"><?php _e('Buy Now', 'ARPricelite'); ?></button>
        <button id="pro_upgrade_cancel_button"  class="learn_more_button" type="button">Learn More</button>
        <input type="hidden" name="arp_version" id="arp_version" value="<?php
        global $arpricelite_version;
        echo $arpricelite_version;
        ?>" />
        <input type="hidden" name="arp_request_version" id="arp_request_version" value="<?php echo get_bloginfo('version'); ?>" />
    </div>
</div>