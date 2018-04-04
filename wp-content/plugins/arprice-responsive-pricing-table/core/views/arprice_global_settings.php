<?php
global $arpricelite_default_settings;
if (is_ssl())
    $google_font_url = "https://fonts.googleapis.com/css?family=Ubuntu|Roboto|Open+Sans";
else
    $google_font_url = "http://fonts.googleapis.com/css?family=Ubuntu|Roboto|Open+Sans";
?>
<link rel="stylesheet" type="text/css" href="<?php echo $google_font_url; ?>" />
<input type="hidden" name="arp_version" id="arp_version" value="<?php
global $arpricelite_version;
echo $arpricelite_version;
?>" />
<script type="text/javascript" language="javascript">


    function show_success_msg() {
        jQuery('#global_settings_success_message').animate({width: 'toggle'}, 'slow');
        jQuery('#global_settings_success_message').delay(3000).animate({width: 'toggle'}, 'slow');
    }
</script>
<script type="text/javascript" language="javascript">
    function show_success_msg_reset_template() {
        jQuery('#success_message_reset_template').fadeIn();
        setTimeout(function () {
            jQuery('#success_message_reset_template').fadeOut('slow');
        }, 3000);
    }
</script>
<script type="text/javascript" language="javascript">
    function global_column_background_colors() {
        var arp_column_background_colors_var;
        arp_column_background_colors_var = <?php echo json_encode($arpricelite_default_settings->arp_column_section_background_color());
?>;
        return arp_column_background_colors_var;
    }
</script>
<style>
    .license-details-block {
        padding: 20px;
        width:450px;
        margin:0 auto;
        position: relative;
        background:#ffffff;
        border:1px solid #b3b3b3;
        color: #333;
        border-radius: 5px;
        -webkit-box-sizing: content-box;
        -moz-box-sizing: content-box;
        box-sizing: content-box;
        height:110px;

    }

    .arp_version_box{
        width:1034px;
        margin:auto;
        padding-top: 40px;
        padding-bottom: 40px;
        font:roboto; 
        Color: #464747;
    }

    .arp_version_detail {

        padding: 5px 0 0;
        width: 100%;
        height: auto;
        font-size: 16px;
    }

    .arp_version_table {
        margin-top: 50px;
        width: 100%;
        text-align: left;
    }

    .arp_version_table_header th {
        background: #31363d;
        color: #ffffff;
        padding: 15px;
        font-size: 18px;
    }

    .arp_version_feature_detail td {
        padding: 15px;
    }
    .arp_version_table_header th:first-child, .arp_version_feature_detail td:first-child {
        width: 370px;
    }

    td#arp_premium_row {
        background: #f0f7f8 none repeat scroll 0 0;
        font-weight: bold;
        width: 300px;
    }

    .arp_premium_version_info_belt {
        box-shadow: 0 0 10px #ffa800;
        float: left;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 50px;
        margin-top: 90px;
        min-height: 75px;
        line-height: 70px;
        text-align: center;
        width: 100%;
        color: #ffa800
    }

    .arp_premium_img{
        margin: 15px 0;
        padding: 5px;
        text-align: center;
    }

    h1.arp_highlighted_points{
        font-size: 18px;
        color: #1f98ff;
    }
    #arp_sub_label {
        font-weight: bold;
        margin: 15px 0;
    }
    .btn-gold {
        background: #62ca24 none repeat scroll 0 0;
        box-shadow:0 1px 1px 0 #747B73;
        border-radius: 6px;
        color: #ffffff;
        cursor: pointer;
        display: inline-block;
        font-weight: bold;
        line-height: 16px;
        padding: 20px;
        width:250px;
        font-size:16px;
    }
</style>
<?php
if (isset($_POST['arp_reset_template']) && $_POST['arp_reset_template'] > 0) {

    $count = count($_POST['arp_reset_template']);

    if ($count > 0) {

        $reset_template = $_POST['arp_reset_template'];

        if ($_POST['arp_reset_template']) {

            foreach ($reset_template as $reset_template_db) {

                $all_template = $wpdb->get_results("SELECT default_general_options FROM {$wpdb->prefix}arplite_arprice where ID = {$reset_template_db}", ARRAY_A);

                $update_template = $wpdb->query($wpdb->prepare('UPDATE ' . $wpdb->prefix . 'arplite_arprice SET general_options = %s WHERE ID = %d', $all_template[0]['default_general_options'], $reset_template_db));

                $all_template_settings = $wpdb->get_results("SELECT default_table_options FROM {$wpdb->prefix}arplite_arprice_options where ID = {$reset_template_db}", ARRAY_A);

                $update_template_settings = $wpdb->query($wpdb->prepare('UPDATE ' . $wpdb->prefix . 'arplite_arprice_options SET table_options = %s WHERE ID = %d', $all_template_settings[0]['default_table_options'], $reset_template_db));

                echo "<script type='text/javascript' language='javascript'> setTimeout( function(){ show_success_msg_reset_template(); },10 ); </script>";
            }
        }
    }
}

if (isset($_POST['arplite_load_js_css']) && $_POST['arplite_load_js_css'] == 'arplite_load_js_css') {
    update_option('arplite_load_js_css', $_POST['arplite_load_js_css']);
} else {
    delete_option('arplite_load_js_css');
}

if (isset($_POST['save_global_settings'])) {

    $number_pattern = '/^[0-9]+$/';

    if ($_POST['arp_mobile_responsive_size'] != '') {
        if (preg_match($number_pattern, $_POST['arp_mobile_responsive_size']) > 0) {
            $mobile_view_width = $_POST['arp_mobile_responsive_size'];
            update_option('arplite_mobile_responsive_size', $mobile_view_width);
        } else {
            $mobile_view_width = 480;
        }
    } else {
        $mobile_view_width = 480;
    }

    if ($_POST['arp_tablet_responsive_size'] != '') {
        if (preg_match($number_pattern, $_POST['arp_tablet_responsive_size']) > 0) {
            $mobile_view_width = $_POST['arp_tablet_responsive_size'];
            update_option('arplite_tablet_responsive_size', $mobile_view_width);
        } else {
            $tablet_view_width = 768;
        }
    } else {
        $tablet_view_width = 768;
    }

    if ($_POST['arp_desktop_responsive_size'] != '') {
        if (preg_match($number_pattern, $_POST['arp_desktop_responsive_size']) > 0) {
            $mobile_view_width = $_POST['arp_desktop_responsive_size'];
            update_option('arplite_desktop_responsive_size', $mobile_view_width);
        } else {
            $tablet_view_width = 0;
        }
    } else {
        $tablet_view_width = 0;
    }

    echo "<script type='text/javascript' language='javascript'> setTimeout( function(){ show_success_msg(); },10 ); </script>";
}
?>

<div class="arp_global_setting_main">
    <div class="arp_global_setting_main_title">
        <?php _e('Pricing Table Settings', 'ARPricelite'); ?>
    </div>
    <div class="clear" style="clear:both;"></div>
    <div class="success_message global_settings" id="global_settings_success_message">
        <div class="message_descripiton">
            <?php _e('Changes Saved Successfully.', 'ARPricelite'); ?>
        </div>
    </div>
    <?php
    if (isset($_POST['save_global_settings'])) {
        ?>
    <?php } else { ?>
        <div class="success_message global_settings arp_message_padding" id="success_message_reset_template">
            <div class="message_descripiton">
                <?php _e('Template Reset Successfully.', 'ARPricelite'); ?>
            </div>
        </div>
    <?php } ?>
    <div class="arp_global_setting_main_inner">
        <div class="arprice_global_settings">
            <div class="arp_global_setting_sub_title">
                <?php _e('Global Settings', 'ARPricelite'); ?>
            </div>
            <div class="arprice_analytics_browser" style="float:left;">
                <form id="arp_settings_form" name="arp_settings_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="arp_version" id="arp_version" value="<?php global $arpricelite_version;
                echo $arpricelite_version;
                ?>" />
                    <input type="hidden" name="arp_request_version" id="arp_request_version" value="<?php echo get_bloginfo('version'); ?>" />

                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="float:left;">
                        <tr class="arfmainformfield" valign="top">
                            <td class="lbltitle" colspan="3" ><div class="arp_global_setting_frm_main_title">
<?php _e('Product License', 'ARPricelite'); ?>
                                    &nbsp;</div></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="padding-left:10px;">
                                <div class="license-details-block trial-details-block"> 
                                    <h1 style="text-align:center;margin-bottom:20px;font-size:20px;">You Are Using Free Version Of ARPrice</h1>
                                    <div class="license-details" style="text-align:center;"> <a href="#" class="purchase-premium_link"> <span class="btn-gold btn-inner-wrap">Upgrade to Premium for $21</span></a></div>

                                </div>
                            </td>
                        </tr>
                        <tr class="arfmainformfield" valign="top">
                            <td class="lbltitle" colspan="3" style="width:100%;"><div class="arp_dotted_line"></div></td>
                        </tr>
                        <tr class="arfmainformfield" valign="top">
                            <td class="lbltitle" colspan="3"><div class="arp_global_setting_frm_main_title">
<?php _e('Global Custom CSS', 'ARPricelite'); ?>
                                </div></td>
                        </tr>
                        <tr>
                            <td class="lbltitle" colspan="3"><div class="arp_global_setting_frm_title">
<?php _e('Custom CSS', 'ARPricelite') ?>
                                </div></td>
                        </tr>
                        <tr>
                            <td colspan="3"><textarea class='arp_custom_css arp_global_setting_custom_css_textarea' id='arp_custom_css' readonly='readonly' ></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="3"><span class="arp_global_setting_custom_css_eg">(e.g.)&nbsp;&nbsp; .btn{color:#000000;}</span> <span class="align_right" style="padding-right:70px;color:#6bbc5b;font-size:16px;font-weight:bold;font-family:Ubuntu;">
<?php _e('Please Upgrade to premium version to use this feature.', 'ARPricelite') ?>
                                </span></td>
                        </tr>
                        <tr class="arfmainformfield" valign="top">
                            <td class="lbltitle" colspan="3"  style="width:100%;"><div class="arp_dotted_line"></div></td>
                        </tr>
                        <tr class="arfmainformfield" valign="top">
                            <td class="lbltitle" colspan="3"><div class="arp_global_setting_frm_main_title">
<?php _e('Resonsive Settings', 'ARPricelite'); ?>
                                </div></td>
                        </tr>
                        <tr class="arpmainformfield arp_global_setting_resonsive_main" valign="top">
                            <td class="tdclass arp_global_setting_resonsive_title_section"><label class="lblsubtitle arp_global_setting_resonsive_main_title">
                                        <?php _e('Mobile View', 'ARPricelite') ?>
                                    <span class="arp_global_setting_resonsive_sub_title">
<?php _e('(Max-Width)', 'ARPricelite'); ?>
                                    </span></label></td>
                            <td class="tdclass arp_global_setting_resonsive_title_section"><label class="lblsubtitle arp_global_setting_resonsive_main_title">
                                        <?php _e('Tablet View', 'ARPricelite') ?>
                                    <span class="arp_global_setting_resonsive_sub_title">
<?php _e('(Max-Width)', 'ARPricelite'); ?>
                                    </span></label></td>
                            <td class="tdclass arp_global_setting_resonsive_title_section"><label class="lblsubtitle arp_global_setting_resonsive_main_title">
                                        <?php _e('Desktop View', 'ARPricelite') ?>
                                    <span class="arp_global_setting_resonsive_sub_title">
<?php _e('(Optional)', 'ARPricelite'); ?>
                                    </span></label></td>
                        </tr>
                        <tr class="arpmainformfield arp_global_setting_resonsive_main" valign="top">
                            <td class="arp_global_setting_resonsive_title_section"><input type="text" name="arp_mobile_responsive_size" id="arp_mobile_responsive_size" class="txtstandardnew" size="42" value="<?php echo get_option('arplite_mobile_responsive_size'); ?>" autocomplete="off" />
                                &nbsp;&nbsp;
                                <label class="responsive_screen_width_unit">
<?php _e('px', 'ARPricelite'); ?>
                                </label></td>
                            <td class="arp_global_setting_resonsive_title_section"><input type="text" name="arp_tablet_responsive_size" id="arp_tablet_responsive_size" class="txtstandardnew" size="42" value="<?php echo get_option('arplite_tablet_responsive_size'); ?>" autocomplete="off" />
                                &nbsp;&nbsp;
                                <label class="responsive_screen_width_unit">
<?php _e('px', 'ARPricelite'); ?>
                                </label></td>
                            <td class="arp_global_setting_resonsive_title_section"><input type="text" name="arp_desktop_responsive_size" id="arp_desktop_responsive_size" class="txtstandardnew" size="42" value="<?php echo get_option('arplite_desktop_responsive_size'); ?>" autocomplete="off" />
                                &nbsp;&nbsp;
                                <label class="responsive_screen_width_unit">
<?php _e('px', 'ARPricelite'); ?>
                                </label></td>
                        </tr>
                        <tr class="arpmainformfield" valign="top">
                            <td></td>
                            <td></td>
                            <td class="arp_global_setting_resonsive_title_section"><span class="arp_global_setting_resonsive_sub_untitle">(Zero (0) means Unlimited)</span></td>
                        </tr>
                        <tr class="arfmainformfield" valign="top">
                            <td class="lbltitle" colspan="3" style="width:100%;"><div class="arp_dotted_line"></div></td>
                        </tr>
                        <tr class="arfmainformfield" valign="top">
                            <td class="lbltitle" colspan="3"><div class="arp_global_setting_frm_main_title">
<?php _e('Choose the character sets you want to add with google fonts', 'ARPricelite'); ?>
                                </div>
                                <div class="arp_global_setting_frm_main_title align_left" style="padding-top:0;padding-bottom:0;color:#6bbc5b;font-size:16px;font-weight:bold;top:-20px;width:auto;position:relative;">
<?php _e('Please Upgrade to premium version to use this feature.', 'ARPricelite'); ?>
                                </div></td>
                        </tr>
                        <tr class="arpmainformfield" valign="top">
                            <td colspan="3" class="arp_fix_padding"><div class="arp_reset_template_wrapper arp_global_setting_google_fonts">
                                    <?php
                                    $arp_default_character_arr = get_option('arplite_css_character_set');
                                    $arp_google_character_arr = array('latin' => 'Latin', 'latin-ext' => 'Latin-ext', 'menu' => 'Menu', 'greek' => 'Greek', 'greek-ext' => 'Greek-ext', 'cyrillic' => 'Cyrillic',
                                        'cyrillic-ext' => 'Cyrillic-ext', 'vietnamese' => 'Vietnamese', 'arabic' => 'Arabic', 'khmer' => 'Khmer', 'lao' => 'Lao', 'tamil' => 'Tamil', 'bengali' => 'Bengali',
                                        'hindi' => 'Hindi', 'korean' => 'Korean');
                                    ?>
                                    <div style="width:100%; float:left;"> <span style="width:100%; float:left;">
                                            <?php $arp_chk_counter = 1; ?>
                                            <?php
                                            foreach ($arp_google_character_arr as $arp_google_character_key => $arp_google_character_value) {
                                                ?>
                                                <p style="width: 117px; float: left;" class="arplite_restricted_view">
                                                    <input type="checkbox" class="arp_checkbox light_bg arp_reset_templates arplite_restricted_view" id="arp_character_<?php echo $arp_google_character_key; ?>" name="" value="<?php echo $arp_google_character_key; ?>" />
                                                    <label data-for="arp_character_<?php echo $arp_google_character_key; ?>"><?php echo $arp_google_character_value; ?></label>
                                                </p>
                                                <?php echo ($arp_chk_counter % 8 == 0) ? '</span><span style="width:100%; float:left;">' : ''; ?>
                                                <?php $arp_chk_counter++; ?>
                                                <?php
                                            }
                                            ?>
                                        </span> </div>
                                </div></td>
                        </tr>
                        <tr class="arfmainformfield" valign="top">
                            <td class="lbltitle" colspan="3" style="width:100%;">
                                <div class="arp_dotted_line"></div>
                            </td>
                        </tr>
                        <tr class="arfmainformfield" valign="top"><td class="lbltitle" colspan="3"><div class="arp_global_setting_frm_main_title"><?php _e('Track button click of pricing table', ARPLITE_PT_TXTDOMAIN); ?></div></td></tr>                     <tr>
                            <td colspan="3">
                                <span class="arp_global_setting_custom_css_eg"><?php _e(' ( If you do not want to get analytics of clicked column than uncheck below checkbox. )', ARPLITE_PT_TXTDOMAIN); ?> </span>
                            </td>
                        </tr>
                                                <tr class="arpmainformfield" valign="top">

                            <td class="arp_fix_padding" colspan="3">
                                <div class="arp_reset_template_wrapper arp_global_setting_google_fonts">
                                    <span>
                                        <p>
                                            <input type="checkbox" class="arp_checkbox light_bg arp_reset_templates arplite_restricted_view" id="arp_track_analytics" name="arp_track_analytics"  value="" style="margin-top:0px;"/>
                                            <label data-for="arp_track_analytics">
<?php _e('Enable Analytics', ARPLITE_PT_TXTDOMAIN); ?>
                                            </label>
                                        </p>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr class="arfmainformfield" valign="top">
                            <td class="lbltitle" colspan="3" style="width:100%;">
                                <div class="arp_dotted_line"></div>
                            </td>
                        </tr>
                        <tr class="arfmainformfield" valign="top"><td class="lbltitle" colspan="3"><div class="arp_global_setting_frm_main_title"><?php _e('Load JS & CSS in all pages', ARPLITE_PT_TXTDOMAIN); ?></div></td></tr>
                        <tr>
                            <td colspan="3">
                                <span class="arp_global_setting_custom_css_eg"><?php _e(' ( Not recommended - If you have any js/css loading issue in your theme, only in that case you should enable this settings )', ARPLITE_PT_TXTDOMAIN); ?> </span>
                            </td>
                        </tr>
                        <tr class="arpmainformfield" valign="top">

                            <td class="arp_fix_padding" colspan="3">
                                <div class="arp_reset_template_wrapper arp_global_setting_google_fonts">
                                    <span>
                                        <p>
                                            <input type="checkbox" class="arp_checkbox light_bg arp_reset_templates" id="arp_load_js_css" name="arplite_load_js_css" <?php checked(get_option('arplite_load_js_css'), 'arplite_load_js_css'); ?> value="arplite_load_js_css" style="margin-top:0px;"/>
                                            <label data-for="arp_load_js_css">
<?php _e('Load JS & CSS', ARPLITE_PT_TXTDOMAIN); ?>
                                            </label>
                                        </p>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr style="margin-top:50px;">
                            <td colspan="3" class="arp_fix_padding"><button type="submit" id="set_global_settings" name="save_global_settings" class="greensavebtn arp_global_setting_btn">
<?php _e('Save Changes', 'ARPricelite'); ?>
                                </button></td>
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
    <div class="upgrade_message"><?php _e('Please upgrade to premium version to unlock this feature.', 'ARPricelite'); ?></div>
    <div class="upgrade_modal_btn">
        <a href="#" class="buy_now_button_link"><?php _e('Buy Now', 'ARPricelite'); ?></a>
        <a href="#" class="learn_more_button_link"><?php _e('Learn More', 'ARPricelite'); ?></a>
        <input type="hidden" name="arp_version" id="arp_version" value="<?php global $arpricelite_version;
echo $arpricelite_version;
?>" />
        <input type="hidden" name="arp_request_version" id="arp_request_version" value="<?php echo get_bloginfo('version'); ?>" />

    </div>
</div>
