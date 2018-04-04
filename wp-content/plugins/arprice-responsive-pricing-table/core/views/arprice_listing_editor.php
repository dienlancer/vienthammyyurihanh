<?php
global $arplite_pricingtable, $arpricelite_default_settings, $arpricelite_analytics, $arpricelite_fonts, $arpricelite_version, $arprice_font_awesome_icons, $arpricelite_img_css_version, $arplite_subscription_time;
?>

<div style="display:none;" >
    <img  src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/arprice_logo.png" />
    <img  src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/edit-icon.png" />

    <img  src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/save_icon.png" />
    <img  src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/preview_icon_small.png" />
    <img  src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/cancel_icon.png" />

    <img  src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/column_option_icon.png" />
    <img  src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/effects_icon.png" />
    <img  src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/tooltip_icon.png" />
    <img  src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/custom_css_icon.png" />
    <img  src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/toggle_icon.png" />

    <img  src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/column_option_hover_icon.png" />
    <img  src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/effects_hover_icon.png" />
    <img  src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/tooltip_hover_icon.png" />
    <img  src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/custom_css_hover_icon.png" />
    <img  src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/toggle_hover_icon.png" />

    <img  src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/nav_close_icon.png" />

    <img  src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/preview_icon.png" />
    <img  src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/preview_icon.png" />
    <img  src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/duplicate_icon.png" />

    <img  src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/clone_icon.png" />
    <img  src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/pro_icon.png" />
    <img src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/icons/preview_icon_default.png" />

</div>

<?php
/* ARPrice Font Awesome Icons */
require_once(ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_font_awesome_array.php');
$arprice_font_awesome_icons = arprice_font_awesome_font_array();
/* ARPrice Font Awesome Icons */


/* ARPrice Goole Font Load */
$default_fonts = $arpricelite_fonts->get_default_fonts();
$google_fonts = $arpricelite_fonts->google_fonts_list();
$diff = count($google_fonts) / 2;
$google_fonts_one = $google_fonts;
$google_fonts_two = $google_fonts;
array_splice($google_fonts_one, $diff);
array_splice($google_fonts_two, 0, -$diff);

$google_fonts_string_one = implode('|', $google_fonts_one);
$google_fonts_string_two = implode('|', $google_fonts_two);

$google_font_url_one = $google_font_url_two = "";

if (is_ssl()) {
    $google_font_url_one = "https://fonts.googleapis.com/css?family=" . $google_fonts_string_one;
    $google_font_url_two = "https://fonts.googleapis.com/css?family=" . $google_fonts_string_two;
} else {
    $google_font_url_one = "http://fonts.googleapis.com/css?family=" . $google_fonts_string_one;
    $google_font_url_two = "http://fonts.googleapis.com/css?family=" . $google_fonts_string_two;
}

$font_array = array_chunk($google_fonts, 150);

foreach ($font_array as $key => $font_values) {
    $google_fonts_string = implode('|', $font_values);
    $google_font_url_one = '';
    if (is_ssl()) {
        $google_font_url_one = "https://fonts.googleapis.com/css?family=" . $google_fonts_string;
    } else {
        $google_font_url_one = "http://fonts.googleapis.com/css?family=" . $google_fonts_string;
    }

    echo '<link rel = "stylesheet" type = "text/css" href = "' . $google_font_url_one . '" />';
}
/*
  ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $google_font_url_one; ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo $google_font_url_two; ?>" />

  <?php
 * /* */ /* ARPrice Goole Font Load */
?>

<script>
    jQuery(function () {
        jQuery("#scroll_top_wrapper").scroll(function () {
            jQuery("#main_package").scrollLeft(jQuery("#scroll_top_wrapper").scrollLeft());
        });
        jQuery("#main_package").scroll(function () {
            jQuery("#scroll_top_wrapper").scrollLeft(jQuery("#main_package").scrollLeft());
        });
    });
</script>
<script type="text/javascript">
    function global_template_options()
    {
        var tmpbuttonoptions;
        tmpbuttonoptions = <?php
global $arplite_tempbuttonsarr;
echo json_encode($arplite_tempbuttonsarr)
?>;
        return tmpbuttonoptions;
    }

    function global_ribbon_array() {
        var arpribbonarr;
        arpribbonarr = <?php
global $arplite_mainoptionsarr;
echo json_encode($arplite_mainoptionsarr['general_options']['template_options']['arp_template_ribbons']);
?>;
        return arpribbonarr;
    }

    function ribbon_basic_colors() {
        var arp_basic_ribbon_colors;
        arp_basic_ribbon_colors = '<?php
global $arplite_mainoptionsarr;
echo json_encode($arplite_mainoptionsarr['general_options']['arp_basic_colors']);
?>';
        return arp_basic_ribbon_colors;
    }

    function ribbon_gradient_colors() {
        var arp_gradient_ribbon_colors;
        arp_gradient_ribbon_colors = '<?php
global $arplite_mainoptionsarr;
echo json_encode($arplite_mainoptionsarr['general_options']['arp_basic_colors_gradient']);
?>';
        return arp_gradient_ribbon_colors;
    }

    function ribbon_border_colors() {
        var arp_ribbon_border_color;
        arp_ribbon_border_color = '<?php
global $arplite_mainoptionsarr;
echo json_encode($arplite_mainoptionsarr['general_options']['arp_ribbon_border_color']);
?>';
        return arp_ribbon_border_color;
    }

    function arp_template_css_class_info() {
        var arp_templatecssinfo;
        arp_templatecssinfo = <?php
global $arplite_templatecssinfoarr;
echo json_encode($arplite_templatecssinfoarr);
?>;
        return arp_templatecssinfo;
    }

    function arp_template_responsive_array_types() {
        var arp_template_responsive_array;
        arp_template_responsive_array = <?php
global $arplite_templateresponsivearr;
echo json_encode($arplite_templateresponsivearr);
?>;
        return arp_template_responsive_array;
    }

    function arp_template_editor_handler() {
        var arp_template_editro_handler_var;
        arp_template_editro_handler_var = <?php
global $arplite_template_editor_arr;
echo json_encode($arplite_template_editor_arr);
?>;
        return arp_template_editro_handler_var;
    }

    function global_column_background_colors() {
        var arp_column_background_colors_var;
        arp_column_background_colors_var = <?php echo json_encode($arpricelite_default_settings->arp_column_section_background_color());
?>;
        return arp_column_background_colors_var;
    }

    function global_column_section_background_colors() {
        var arp_column_section_bg_color;
        arp_column_section_bg_color = <?php echo json_encode($arpricelite_default_settings->arp_section_background_color()); ?>;
        return arp_column_section_bg_color;
    }

    function global_column_footer_type_templates() {
        var arp_column_footer_templates;
        arp_column_footer_templates = <?php echo json_encode($arpricelite_default_settings->arp_footer_section_template_types()); ?>;
        return arp_column_footer_templates;
    }

    function global_arp_color_skin_templats() {
        var arp_column_color_skin_templates;
        arp_column_color_skin_templates = <?php echo json_encode($arpricelite_default_settings->arp_color_skin_template_types()); ?>;
        return arp_column_color_skin_templates;
    }

    function global_column_sections_array() {
        var arp_column_sections_colors_array;
        arp_column_sections_colors_array = <?php
global $arplite_templatesectionsarr;
echo json_encode($arplite_templatesectionsarr);
?>;
        return arp_column_sections_colors_array;
    }

    function arp_global_skin_array() {
        var arp_template_custom_skin;
        arp_template_custom_skin = <?php
global $arplite_templatecustomskinarr;
echo json_encode($arplite_templatecustomskinarr);
?>;
        return arp_template_custom_skin;
    }

    function arp_global_default_gradient_templates() {
        var arp_template_gradient_templates;
        arp_template_gradient_templates = <?php echo json_encode($arpricelite_default_settings->arplite_default_gradient_templates()); ?>;
        return arp_template_gradient_templates;
    }

    function arp_global_default_gradient_colors() {
        var arp_global_default_gradient_color;
        arp_global_default_gradient_color = <?php echo json_encode($arpricelite_default_settings->arplite_default_gradient_templates_colors()); ?>;
        return arp_global_default_gradient_color;
    }

    function arp_global_default_rgba_colors() {
        var arp_global_rgba_colors;
        arp_global_rgba_colors = <?php echo json_encode($arpricelite_default_settings->arp_default_rgba_color_array()); ?>;
        return arp_global_rgba_colors;
    }

    function arplite_depended_section_color_codes() {
        var arp_global_depended_section_colors;
        arp_global_depended_section_colors = <?php echo json_encode($arpricelite_default_settings->arplite_depended_section_color_codes()); ?>;
        return arp_global_depended_section_colors;
    }

    function arp_custom_skin_selection_section_color() {
        var arplite_custom_skin_selection_colors;
        arplite_custom_skin_selection_colors = <?php echo json_encode($arpricelite_default_settings->arp_custom_skin_selection_section_color()); ?>;
        return arplite_custom_skin_selection_colors
    }

    function arp_background_image_section_array() {
        var arp_background_image_section_array;
        arp_background_image_section_array = <?php echo json_encode($arpricelite_default_settings->arp_background_image_section_array()); ?>;
        return arp_background_image_section_array;
    }

    function arprice_default_template_skins() {
        var arp_background_image_section_array;
        arp_background_image_section_array = <?php echo json_encode($arpricelite_default_settings->arprice_default_template_skins()); ?>;
        return arp_background_image_section_array;
    }

    function arp_column_border_array_global() {
        var arp_column_border_array;
        arp_column_border_array = '<?php echo json_encode($arpricelite_default_settings->arp_column_border_array()); ?>';
        return arp_column_border_array;
    }
    function arprice_css_pseudo_elements() {
        var arprice_css_pseudo_elements;
        arprice_css_pseudo_elements = <?php echo json_encode($arpricelite_default_settings->arplite_css_pseudo_elements_array()); ?>;
        var string = '';
        jQuery(arprice_css_pseudo_elements).each(function (i) {
            string += arprice_css_pseudo_elements[i] + '|';
        });
        var strlen = string.length;
        var str = '';
        for (var n = 0; n < strlen - 1; n++) {
            str += string[n];
        }
        var regex = new RegExp('(' + str + ')', 'ig');
        return regex;
    }

    function arprice_border_color() {
        var arprice_border_colors;
        arprice_border_colors = <?php echo json_encode($arpricelite_default_settings->arp_border_color()); ?>;
        return arprice_border_colors;
    }

    function arplite_exclude_caption_column_for_color_skin() {
        var arprice_exclude_caption;
        arprice_exclude_caption = '<?php echo json_encode($arpricelite_default_settings->arplite_exclude_caption_column_for_color_skin()) ?>';
        return arprice_exclude_caption;
    }

    function arp_editor_width() {
        var arp_editor_width;
        arp_editor_width = '<?php echo json_encode($arpricelite_default_settings->arprice_responsive_width_array()); ?>';
        return arp_editor_width;
    }

    function arp_section_text_alignment() {
        var arp_section_text_alignment_array;
        arp_section_text_alignment_array = <?php echo json_encode($arpricelite_default_settings->arp_section_text_alignment()); ?>;
        return arp_section_text_alignment_array;
    }

    function arp_hide_section_class_global() {
        var arp_hide_section_class;
        arp_hide_section_class = '<?php echo json_encode($arpricelite_default_settings->arprice_hide_section_array()); ?>';
        return arp_hide_section_class;
    }

    function arp_row_level_border_remove_from_last_child_global() {
        var arp_row_level_border_remove_from_last_child_array;
        arp_row_level_border_remove_from_last_child_array = '<?php echo json_encode($arpricelite_default_settings->arp_row_level_border_remove_from_last_child()); ?>';
        return arp_row_level_border_remove_from_last_child_array;
    }

    function arp_exclude_caption_column_for_color_skin() {
        var arprice_exclude_caption;
        arprice_exclude_caption = '<?php echo json_encode($arpricelite_default_settings->arp_exclude_caption_column_for_color_skin()) ?>';
        return arprice_exclude_caption;
    }

    function arp_select_previous_skin_for_multicolor_array() {
        var arp_select_previous_skin_for_multicolor;
        arp_select_previous_skin_for_multicolor = '<?php echo json_encode($arpricelite_default_settings->arp_select_previous_skin_for_multicolor()) ?>';
        return arp_select_previous_skin_for_multicolor;
    }

    function arp_navigation_section_class_array() {
        var arp_navigation_section_class_array;
        arp_navigation_section_class_array = '<?php echo json_encode($arpricelite_default_settings->arp_navigation_section_array()); ?>';
        return arp_navigation_section_class_array;
    }

    function arp_shortcode_custom_type_array() {
        var arp_shortcode_custom_type_sections;
        arp_shortcode_custom_type_sections = '<?php echo json_encode($arpricelite_default_settings->arp_shortcode_custom_type()); ?>';
        return arp_shortcode_custom_type_sections;
    }
    
        function arp_custom_css_inner_sections() {
        var arp_custom_css_inner_sections;
        arp_custom_css_inner_sections = '<?php echo json_encode($arpricelite_default_settings->arp_custom_css_inner_sections()); ?>';
        return arp_custom_css_inner_sections;
    }

    __DISABLED_RIBBON = '<?php _e('This ribbon is not supported in this template.', 'ARPricelite') ?>';
    __OK_BUTTON_TEXT = '<?php _e('Ok', 'ARPricelite'); ?>';
    __CANCEL_BUTTON_TXT = '<?php _e('Cancel', 'ARPricelite') ?>';
    __DELETE_COLUMN_TXT = '<?php _e('Are you sure want to delete this column?', 'ARPricelite'); ?>';
    __HIDE_FOOTER_TXT = '<?php _e('Footer section is hidden.', 'ARPricelite'); ?>';

    __HIDE_HEADER_TXT = '<?php _e('Header section is hidden.', ARPLITE_PT_TXTDOMAIN); ?>';
    __HIDE_PRICE_TXT = '<?php _e('Price section is hidden.', ARPLITE_PT_TXTDOMAIN); ?>';
    __HIDE_FEATURE_TXT = '<?php _e('Feature section is hidden.', ARPLITE_PT_TXTDOMAIN); ?>';
    __HIDE_DISCRIPTION_TXT = '<?php _e('Description section is hidden.', ARPLITE_PT_TXTDOMAIN); ?>';
    __HIDE_HEADER_SHORTCODE_TXT = '<?php _e('Header shortcode section is hidden.', ARPLITE_PT_TXTDOMAIN); ?>';
</script>
<style>
    .tooltipster-noir {
        border-radius: 0px; 
        -moz-border-radius: 0px; 
        -webkit-border-radius: 0px; 
        -o-border-radius: 0px; 
        border: 3px solid #2c2c2c;
        background: #fff;
        color: #2c2c2c;
    }
    .tooltipster-noir .tooltipster-content {
        font-family: 'Georgia', serif;
        font-size: 14px;
        line-height: 16px;
        padding: 8px 10px;
    }
</style>
<?php
global $wpdb, $arpricelite_form, $arpricelite_fonts;
$arpaction = isset($_GET['arp_action']) ? $_GET['arp_action'] : 'blank';
$arpreference = isset($_GET['ref']) ? $_GET['ref'] : '';
$id = isset($_GET['eid']) ? $_GET['eid'] : '';
$table_id = $id;

/* If table not exits */
if (isset($arpaction) and ( $arpaction == 'edit' or $arpaction == 'new') and isset($id) && $id) {
    $check_table = $wpdb->get_row($wpdb->prepare("SELECT id FROM " . $wpdb->prefix . "arplite_arprice WHERE ID='%d'", $id));
    if (!$check_table) {
        echo '<script type="text/javascript">window.location.href = "' . admin_url('admin.php?page=arpricelite') . '";</script>';
        exit;
    }
}
$has_caption = 0;
$table_cols = -1;
$arp_template_type = '';
if ($arpaction == 'blank' && isset($_GET['arpaction']) && @$_GET['arpaction'] == "") {
    $table_cols = -1;
} else if ($arpaction == 'create_new') {
    $table_name = $_REQUEST['new_table_name'];
    $table_cols = $_REQUEST['no_of_cols'];
    $table_rows = $_REQUEST['no_of_rows'];
    $has_caption = $_REQUEST['has_caption'];
    $arp_template_type = $_REQUEST['template_type'];
    if ($table_cols == "") {
        $table_cols = 0;
    }
    if ($has_caption == "") {
        $has_caption = 0;
    }
}

if (isset($arpaction) and ( $arpaction == 'edit' or $arpaction == 'new') and isset($table_id) && $table_id) {
    $arpaction = 'edit';
    $id = $table_id;
} else if (isset($arpaction) and $arpaction == 'new') {
    $arpaction = 'new';
}
?>
<script type="text/javascript" language="javascript">
    jQuery(document).ready(function () {
        remove_column_height();
        adjust_column_height();
    });
</script>

<?php if ($arpaction == 'edit') { ?>
    <style>
        .empty {
            height:80px;
        }
    </style>
<?php } ?>
<style>
    .repute_pricing_table_content{
        margin-top:60px;
    }
</style>

<div class="main_box" >
    <form name="price_table" id="price_table_form" method="post" onsubmit="return check_package_validation();">
        <input type="hidden" name="ajaxurl" id="ajaxurl" value="<?php echo admin_url('admin-ajax.php'); ?>"  />
        <input type="hidden" name="url" id="listing_url" value="admin.php?page=arpricelite" />
        <input type="hidden" name="template_type_old" id="template_type_old" value="<?php echo $id; ?>" />
        <input type="hidden" value="<?php echo $id; ?>" id="template_type_new" name="template_type_new">
        <input type="hidden" name="pricing_table_img_url" id="pricing_table_img_url" value="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>" />
        <input type="hidden" name="pricing_table_main_dir" id="pricing_table_main_dir" value="<?php echo ARPLITE_PRICINGTABLE_DIR; ?>"  />
        <input type="hidden" name="pricing_table_main_url" id="pricing_table_main_url" value="<?php echo ARPLITE_PRICINGTABLE_URL; ?>" />
        <input type="hidden" name="pricing_table_upload_dir" id="pricing_table_upload_dir" value="<?php echo ARPLITE_PRICINGTABLE_UPLOAD_DIR; ?>" />
        <input type="hidden" name="pricing_table_upload_url" id="pricing_table_upload_url" value="<?php echo ARPLITE_PRICINGTABLE_UPLOAD_URL; ?>" />
        <input type="hidden" name="pricing_table_admin" id="pricing_table_admin" value="<?php echo is_admin(); ?>" />
        <input type="hidden" name="arp_wp_version" id="arp_wp_version" value="<?php echo $GLOBALS['wp_version']; ?>" />
        <input type="hidden" name="arp_responsive_mobile_width" id="arp_responsive_mobile_width" value="<?php echo get_option('arplite_mobile_responsive_size'); ?>" />
        <input type="hidden" name="arp_responsive_tablet_width" id="arp_responsive_tablet_width" value="<?php echo get_option('arplite_tablet_responsive_size'); ?>" />
        <input type="hidden" name="arp_responsive_desktop_width" id="arp_responsive_desktop_width" value="<?php echo get_option('arplite_desktop_responsive_size'); ?>" />
        <input type="hidden" name="arp_version" id="arp_version" value="<?php
        global $arpricelite_version;
        echo $arpricelite_version;
        ?>" />
        <input type="hidden" name="arp_request_version" id="arp_request_version" value="<?php echo get_bloginfo('version'); ?>" />

        <?php
        $total_packages = 0;

        if ($arpaction == 'edit' or $arpaction == 'new') {
            global $wpdb, $arplite_mainoptionsarr;

            $sql = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "arplite_arprice WHERE ID = %d", $id));
            $table_name = $sql[0]->table_name;
            $is_template = $sql[0]->is_template;
            $status = $sql[0]->status;
            $template_name = $sql[0]->template_name;
            if (( $is_template == 1 && $arpreference == '' && $id != $arpreference && $_GET['arp_action'] !== 'new' ) || $status == 'draft') {
                echo "<script type='text/javascript'>window.location.href='" . admin_url('admin.php?page=arpricelite') . "'</script>";
            }
            $table_gen_opt = maybe_unserialize($sql[0]->general_options);
            $arp_template = $table_gen_opt['template_setting']['template'];
            $arp_template_skin = $table_gen_opt['template_setting']['skin'];
            $arp_template_type = $table_gen_opt['template_setting']['template_type'];

            $sqls = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "arplite_arprice_options WHERE table_id = %d", $id));
            $table_opt = $sqls[0]->table_options;
            $uns_table_opt = maybe_unserialize($table_opt);
            $total_packages = count($uns_table_opt['columns']);
            $caption_column = isset($uns_table_opt['columns']['column_0']['is_caption']) ? $uns_table_opt['columns']['column_0']['is_caption'] : '';
            $reference_template = $table_gen_opt['general_settings']['reference_template'];
            $template_feature = $arplite_mainoptionsarr['general_options']['template_options']['features'][$reference_template];

            if (is_array($template_feature) && in_array('column_description', $template_feature)) {
                $has_column_desc = 1;
                $col_desc_pos = array_search('column_description', $template_feature);
            } else {
                $has_column_desc = 0;
            }
            ?>
            <input type="hidden" name="is_template" id="is_template" value="<?php echo $is_template; ?>"/>
            <input type="hidden" name="pt_action" id="pt_action" value="<?php echo $_GET['arp_action']; ?>" />
            <input type="hidden" name="added_package" id="total_packages" value="<?php echo $total_packages; ?>" />
            <input type="hidden" name="table_id" id="table_id" value="<?php echo $id; ?>" />
            <input type="hidden" name="arp_template_type" id="arp_template_type" value="<?php echo $arp_template_type; ?>" />
            <input type="hidden" name="has_caption_column" id="has_caption_column" value="<?php echo $caption_column; ?>"  />
            <input type="hidden" name="template_feature" id="arp_template_feature" value='<?php echo stripslashes(json_encode($template_feature)); ?>' />
            <?php $column_order = str_replace('"', '\'', $table_gen_opt['general_settings']['column_order']); ?>
            <input type="hidden" name="pricing_table_column_order" id="pricing_table_column_order" value="<?php echo $column_order; ?>" />
            <input type="hidden" name="arp_reference_template" id="arp_reference_template" value="<?php echo $reference_template; ?>" />
            <?php $user_edited_columns = ( $table_gen_opt['general_settings']['user_edited_columns'] == '' ) ? '' : stripslashes(json_encode($table_gen_opt['general_settings']['user_edited_columns'])); ?>
            <input type="hidden" name="arp_user_edited_columns" id="arp_user_edited_columns" value='<?php echo $user_edited_columns; ?>' />
            <?php
        } else {
            global $wpdb, $arplite_mainoptionsarr;
            $template_feature = $arplite_mainoptionsarr['general_options']['template_options']['features']['arplitetemplate_1'];
            ?>
            <input type="hidden" name="is_template" id="is_template" value="0" />
            <input type="hidden" name="pt_action" id="pt_action" value="new" />
            <input type="hidden" name="added_package" id="total_packages" value="<?php echo ($table_cols + $has_caption); ?>" />
            <input type="hidden" name="pt_coloumn_order" id="pt_coloumn_order" value="" />
            <input type="hidden" name="table_id" id="table_id" value="" />
            <input type="hidden" name="arp_template_type" id="arp_template_type" value="<?php echo $arp_template_type; ?>" />
            <input type="hidden" name="has_caption_column" id="has_caption_column" value="<?php echo $has_caption; ?>"  />
            <input type="hidden" name="template_feature" id="arp_template_feature" value='<?php echo stripslashes(json_encode($template_feature)); ?>' />
            <input type="hidden" name="pricing_table_column_order" id="pricing_table_column_order" value="" />
            <input type="hidden" name="arp_reference_template" id="arp_reference_template" value="" />
            <input type="hidden" name="arp_user_edited_columns" id="arp_user_edited_columns" value="" />
            <?php
        }
        global $arplite_mainoptionsarr, $arpricelite_form, $wp_version;
        $pricingtable_menu_belt_style = '';
        if ($arpaction == 'edit') {
            $pricingtable_menu_belt_style = 'display:block;';
        }
        ?>
        <div class="pricingtablename">


            <div class="empty">	</div>

            <div class="success_message" id="success_message"> 
                <div class="message_descripiton"><?php _e('Pricing table saved successfully.', 'ARPricelite'); ?></div>		
            </div>

            <div class="repute_pricing_table_content">
                <?php
                global $wpdb;

                $animated_template = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "arplite_arprice WHERE is_animated = 1 ORDER BY ID ASC");
                ?>
                <div class="arprice_editor" id="arprice_editor" style="">


                    <div class="main_package_part">

                        <div id="main_package_div">

                            <div class="main_package" id="main_package">
                                <div class="ex" style="">
                                    <ul id="packages">
                                        <?php
                                        if ($arpaction == 'create_new') {
                                            global $arpricelite_form;
                                            $columns = ($has_caption != "") ? ($table_cols + 1) : $table_cols;
                                            $arpricelite_form->arp_pricing_table_new_form($columns, $table_rows, $has_caption, $arp_template);
                                        } else if ($arpaction == 'edit' || $arpaction == 'new') {
                                            require_once ARPLITE_PRICINGTABLE_DIR . '/core/classes/class.arprice_preview_editor.php';
                                            global $arpricelite_form, $wpdb;
                                            echo arp_get_pricing_table_string_editor($id, $table_name, 2);
                                        }
                                        ?>
                                    </ul>
                                    <div style="height:auto;width:10px;float:left;"></div>



                                    <div id="addnewpackage_loader"> </div>
                                    <?php
                                    if ($total_packages > 3) {
                                        $disable_actual_btn = 'display:none;';
                                        $enable_loacked_btn = 'display:block;';
                                    } else {
                                        $disable_actual_btn = 'display:block;';
                                        $enable_loacked_btn = 'display:none;';
                                    }
                                    ?>
                                    <div class="add_new_package arplite_unlocked enabled" align="center" id="addnewpackage" style="<?php echo $disable_actual_btn; ?>">
                                        <label class="add_new_package_label"><?php _e('Add Column', 'ARPricelite'); ?></label>
                                        <div class="add_new_package_icon">
                                            <span class="fa-stack fa-5x">
                                                <i class="fa fa-circle-thin fa-stack-2x"></i>
                                                <i class="fa fa-plus fa-stack-1x"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="add_new_package arplite_locked enabled" align="center" id="addnewpackage" style="<?php echo $enable_loacked_btn; ?>">
                                        <label class="add_new_package_label"><?php _e('Add Column', 'ARPricelite'); ?></label>
                                        <div class="add_new_package_icon">
                                            <span class="fa-stack fa-5x">
                                                <i class="fa fa-circle-thin fa-stack-2x"></i>
                                                <i class="fa fa-lock fa-stack-1x"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div style="height:10px;"></div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="empty">	</div>

            <?php
            $arp_template = isset($arp_template) ? $arp_template : '';
            $arp_template_skin = isset($arp_template_skin) ? $arp_template_skin : '';
            ?>
            <input type="hidden" name="arp_template" id="arp_template" value="<?php echo ($id) ? 'arplitetemplate_' . $id : ''; ?>" />
            <input type="hidden" name="arp_template_old" id="arp_template_old" value="<?php echo $arp_template; ?>" />
            <input type="hidden" name="arp_template_skin" id="arp_template_skin" value="<?php echo $arp_template_skin; ?>" />

            <input type="hidden" name="arp_is_generate_html_canvas" id="arp_is_generate_html_canvas" value="no" />


        </div>

    </form>

    <div style="clear:both;"></div>

    <div class="arp_loader" id="arp_loader_div">
        <div class="arp_loader_img"></div>
    </div>

</div>

<div id="testingpre"></div>

<div style="clear:both;"></div>

<div id="arp_fileupload_iframe" class="arp_modal_box" style="display:none; height:430px; width:720px;">
    <div class="modal_top_belt">
        <span class="modal_title"><?php _e('Choose File', 'ARPricelite'); ?></span>
        <span class="modal_close_btn b-close"></span>
    </div>
    <div id="arp_iframeContent">
    </div>
</div>



<?php /* Choose Template Model Window  */ ?>



<script type="text/javascript" language="javascript">
    __ARP_DEL_COL = '<?php _e('Are you sure want to delete this column ?', 'ARPricelite'); ?>';
    __ARP_DEL_ROW = '<?php _e('Are you sure want to delete this row ?', 'ARPricelite'); ?>';
    __ARP_DEL_TMP = '<?php _e('Are you sure you want to delete this table ?', 'ARPricelite'); ?>';

    __ARP_GROUP_IMG = '<?php _e('Image', 'ARPricelite'); ?>';
    __ARP_GROUP_VIDEO = '<?php _e('Video', 'ARPricelite'); ?>';
    __ARP_GROUP_AUDIO = '<?php _e('Audio', 'ARPricelite'); ?>';
    __ARP_GROUP_OTHER = '<?php _e('Other', 'ARPricelite'); ?>';

</script>

<?php /* ARPrice Modal Windows */ ?>

<!-- Pricing Table Preview -->
<input type="hidden" id="arpcol_insert" />
<input type="hidden" id="arpcol_to_insert_object" />
<div class="arp_model_box" id="arp_pricing_table_preview" style="display:none;background:white;">
    <div class="arp_model_preview_belt">
        <div class="device_icon active" id="computer_icon">
            <div class="computer_icon">&#xf108;</div>
        </div>
        <div class="device_icon" id="tablet_icon">
            <div class="tablet_icon">&#xf10a;</div>
        </div>
        <div class="device_icon" id="mobile_icon">
            <div class="mobile_icon">&#xf10b;</div>
        </div>
        <div class="preview_close" id="prev_close_icon">
            <span class="modal_close_btn b-close"></span>
        </div>
    </div>
    <div class="preview_model" style="float:left;width:100%;height:90%;">

    </div>
</div>
<!-- Pricing Table Preview -->

<!-- Ribbon Modal -->
<?php global $arplite_mainoptionsarr; ?>
<div class="arp_model_box" id="arp_ribbon_modal_window" style="top:50px;">
    <form name="arp_ribbon_settings" onsubmit="return add_column_ribbon();" id="arp_ribbon_settings">
        <input type="hidden" value="" id="arp_ribbon_to_insert_column" />
        <input type="hidden" value="" id="arp_ribbon_bg_color" />
        <input type="hidden" value="" id="arp_ribbon_textcolor" />
        <div class="modal_top_belt">
            <span class="modal_title"><?php _e('Select Ribbon', 'ARPricelite'); ?></span>
            <span class="modal_close_btn b-close"></span>
        </div>
        <div class="arp_ribbon_modal_content" style="height:525px;">
            <div class="arp_ribbon_text_title single" style="padding:5px 5px 5px 38px;height:auto;">
                <div class="arp_select_ribbon_dropdown_menu" id="arp_select_ribbon_dropdown_menu">
                    <span class="arp_ribbon_text_title single"><?php _e('Ribbon Style', 'ARPricelite'); ?></span>
                    <input type="hidden" id="arp_ribbon_style" />
                    <dl id="arp_ribbon_style" class="arp_selectbox" data-id="arp_ribbon_style" data-name="arp_ribbon_style" style="width:75% !important;margin-top:15px;float:left;">
                        <dt>
                        <span><?php _e('Select Ribbon', 'ARPricelite'); ?></span>
                        <input type="text" value="<?php echo 'Select Ribbon'; ?>" style="display:none;" class="arp_autocomplete" />
                        <i class='fa fa-caret-down fa-lg'></i>
                        </dt>
                        <dd>
                            <ul class="arp_ribbon_style" data-id="arp_ribbon_style">
                                <ol class="arp_selectbox_group_label"><?php _e('Preset Ribbons', 'ARPricelite'); ?></ol>
                                <?php
                                foreach ($arplite_mainoptionsarr['general_options']['template_options']['arp_ribbons'] as $value => $label) {
                                    if ($value == 'arp_ribbon_6') {
                                        ?>
                                        <ol class="arp_selectbox_group_label"><?php _e('Custom Ribbon', 'ARPricelite'); ?></ol>
                                        <li class="arp_selectbox_option arp_ribbon_icons" id="arp_ribbon_icons" data-ribbon="<?php echo $value; ?>" data-label="<?php echo esc_html($label); ?>" data-value="<?php echo esc_html($value); ?>"><?php echo $label; ?></li>
                                        <?php
                                    } else {
                                        ?>
                                        <li class="arp_selectbox_option arp_ribbon_icons" id="arp_ribbon_icons" data-ribbon="<?php echo $value; ?>" data-label="<?php echo esc_html($label); ?>" data-value="<?php echo esc_html($value); ?>"><?php echo $label; ?></li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </dd>
                    </dl>

                    <span class="arp_ribbon_text_title single"><?php _e('Ribbon Position', 'ARPricelite'); ?></span>
                    <dl style="width:75% !important;float:left;" data-id="arp_ribbon_position" data-name="arp_ribbon_position" id="select_arp_ribbon_position" class="arp_selectbox">
                        <dt><span style="float: left; max-width: 100px;"><?php _e('Right', 'ARPricelite'); ?></span><input type="text" value="Right" class="arp_autocomplete" style="display: none;" id='arp_ribbon_position'><i class="fa fa-caret-down fa-lg"></i></dt>
                        <dd>
                            <ul style="margin-top: 18px; display: none;" data-id="arp_ribbon_position">
                                <li data-label="<?php _e('Right', 'ARPricelite'); ?>" data-value="right"><?php _e('Right', 'ARPricelite'); ?></li>
                                <li data-label="<?php _e('Left', 'ARPricelite'); ?>" data-value="left"><?php _e('Left', 'ARPricelite'); ?></li>
                            </ul>
                        </dd>
                    </dl>
                </div>

                <div class="arp_selected_ribbon_preview" id="arp_selected_ribbon_preview">
                    <style id="preview_arp_ribbon_1">
                        .arp_ribbon_style_preview_container .arp_ribbon_content.arp_ribbon_1:before,
                        .arp_ribbon_style_preview_container .arp_ribbon_content.arp_ribbon_1:after{
                            border-top-color:#0c0b0b;
                        }
                        .arp_ribbon_style_preview_container .arp_ribbon_content.arp_ribbon_1{
                            background:#0c0b0b;
                            background-repeat:repeat-x;
                            border-top:1px solid #1a1818;
                            box-shadow:13px 1px 2px rgba(0,0,0,0.6);
                            color:#ffffff;
                        }
                    </style>

                    <div id="arp_ribbon_style_preview" class="arp_ribbon_style_preview_container">
                        <div class="arp_ribbon_container arp_ribbon_right arp_ribbon_1">
                            <div class="arp_ribbon_content arp_ribbon_right arp_ribbon_1">
                                <span>20% off</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="arp_ribbon_text_content" id="arp_ribbon_text"  style="margin-top:0px;">
                <div class="arp_ribbon_text_title single"><?php _e('Ribbon Text', 'ARPricelite'); ?></div>
                <div class="arp_ribbon_text_input single">
                    <input type="text" id="arp_ribbon_content" value="20% Off" class="arp_modal_txtbox ribbon_content_txt" />
                </div>
            </div>

            <div class="arp_ribbon_text_content single" id="arp_ribbon_background_color_title" style="margin-top:20px;">
                <span style="font-family:Open Sans Bold;font-size:14px;"><?php _e('Set Colors', 'ARPricelite'); ?></span>
            </div>

            <div class="arp_ribbon_text_content multiple" id="arp_ribbon_background_color" style="width:25%;padding-right:0px;">
                <div class="arp_ribbon_text_input multiple" style="width:95%;">
                    <div class="arp_ribbon_bgcolor_wrapper" id="arp_ribbon_bgcolor_wrapper">
                        <input type="text" id="arp_ribbon_bgcolor" name="arp_ribbon_bgcolor" value="#514e4e" />
                        <div class="arp_ribbon_bgcolor_picker"><i class="fa fa-eyedropper fa-lg"></i></div>
                    </div>
                </div>
                <div class="arp_ribbon_text_title single" style="font-family:Ubuntu;line-height:normal;width:90%;text-align:center;"><?php _e('Background', 'ARPricelite'); ?></div>
            </div>

            <div class="arp_ribbon_text_content multiple" id="arp_ribbon_text_color" style="width:22%;padding-left:10px;padding-right:6px;">
                <div class="arp_ribbon_text_input multiple" style="width:95%;">
                    <div class="arp_ribbon_txtcolor_wrapper" id="arp_ribbon_txtcolor_wrapper">
                        <input type="text" id="arp_ribbon_txtcolor" name="arp_ribbon_textcolor" value="#ffffff" />
                        <div class="arp_ribbon_textcolor_picker"><i class="fa fa-eyedropper fa-lg"></i></div>
                    </div>
                </div>
                <div class="arp_ribbon_text_title single" style="font-family:Ubuntu;line-height:normal;width:90%;text-align:center;"><?php _e('Text Color', 'ARPricelite'); ?></div>
            </div>

            <div class="arp_ribbon_text_content single" id="arp_ribbon_custom_image" style="display: none;margin-top:0px;">
                <div class="arp_ribbon_text_title single"><?php _e('Custom Ribbon', 'ARPricelite'); ?></div>
                <div class="arp_ribbon_text_input multiple" style="position: relative; top: 0px;margin-top:0px;">
                    <div class="arp_ribbon_txtcolor_wrapper">
                        <input type="text" id="arp_ribbon_content_custom" value="" class="arp_modal_txtbox custom_ribbon_img" style="width:50% !important;" />
                        <button data-column="" class="add_arp_ribbon_object" tyle="button" name="add_arp_ribbon_object" id="add_arp_ribbon_object" data-insert='arp_ribbon_image_object' data-id="arp_ribbon_image_url"><?php _e('Add Ribbon', 'ARPricelite'); ?></button>
                    </div>
                </div>
            </div>

            <div style="float:left;width:100%;display:none;" id="ribbon_custom_position" >
                <div class="arp_ribbon_text_content">
                    <div class="arp_ribbon_text_title"><?php _e('Custom Position:', 'ARPricelite'); ?></div>
                </div>
                <div class="arp_ribbon_text_content multiple" style="box-sizing:border-box;width:22%;margin-top:16px;">
                    <div class="arp_ribbon_text_input single" style="position:relative;top:-5px;line-height:35px;">
                        <input type="text" name="arp_ribbon_custom_position_rl" id="arp_ribbon_custom_position_rl_modal" class="arp_modal_txtbox" value="0" style="width:60px;margin-right:5px;" /><?php _e('Px', 'ARPricelite'); ?>
                    </div>
                    <div class="arp_ribbon_text_title single" style="font-family:ubuntu;line-height:normal;"><?php _e('Left / Right', 'ARPricelite'); ?></div>
                </div>
                <div class="arp_ribbon_text_content multiple" style="box-sizing:border-box;width:22%;margin-top:16px;">
                    <div class="arp_ribbon_text_input single" style="position:relative;top:-5px;line-height:35px;">
                        <input type="text" name="arp_ribbon_custom_position_top" id="arp_ribbon_custom_position_top_modal" class="arp_modal_txtbox" value="0" style="width:60px;margin-right:5px;" /><?php _e('Px', 'ARPricelite'); ?>
                    </div>
                    <div class="arp_ribbon_text_title single" style="font-family:ubuntu;line-height:normal;">
                        <?php _e('Top', 'ARPricelite'); ?>
                    </div>
                </div>
            </div>

            <div class="arp_ribbon_btn_content">
                <div class="arp_ribbon_btn">
                    <button type="submit" name="add_ribbon_insert" id="add_ribbon_insert" class="ribbon_insert_btn">
                        <?php _e('Add Ribbon', 'ARPricelite') ?>
                    </button>
                </div>
                <div class="arp_ribbon_btn">
                    <button type="button" name="add_ribbon_cancel" id="add_ribbon_cancel" class="ribbon_cancel_btn">
                        <?php _e('Cancel', 'ARPricelite'); ?>
                    </button>
                </div>

            </div>
        </div>

        <div class="arp_ribbon_colorpicker_wrapper" id="arp_ribbon_colorpicker_wrapper" data-insert="arp_rbn_textcolor">
            <div class="arp_ribbon_colorpicker" id="arp_ribbon_colorpicker">
                <div class="ribbon_modal_top_belt">

                    <span class="modal_title"><?php _e('Choose Color', 'ARPricelite'); ?></span>
                    <span class="ribbon_modal_close_btn"><i class="fa fa-times"></i></span>
                </div>
                <div class="arp_ribbon_colorpicker_tabs">
                    <div class="arp_basic_color_tab" id="arp_basic_color_tab">
                        <?php
                        global $arplite_mainoptionsarr;

                        $basic_colors = $arplite_mainoptionsarr['general_options']['arp_basic_colors'];
                        ?>
                        <ul class="arp_basic_colors">
                            <style type="text/css">
<?php
foreach ($basic_colors as $key => $colors) {
    $base_color = $colors;
    $base_color_key = array_search($base_color, $basic_colors);
    $gradient_color = $arplite_mainoptionsarr['general_options']['arp_basic_colors_gradient'][$base_color_key];
    ?>
                                    .basic_color_box.basic_color_<?php echo $key; ?>{
                                        background:<?php echo $base_color; ?>;
                                        background-color:<?php echo $base_color; ?>;
                                        background-image:-moz-linear-gradient(top, <?php echo $base_color; ?>, <?php echo $gradient_color; ?>);";
                                        background-image:-webkit-gradient(linear, 0 0, 0 100%, from(<?php echo $base_color; ?>), to(<?php echo $gradient_color; ?>));
                                        background-image:-webkit-linear-gradient(top, <?php echo $base_color; ?>, <?php echo $gradient_color; ?>);
                                        background-image:-o-linear-gradient(top, <?php echo $base_color; ?>, <?php echo $gradient_color; ?>);
                                        background-image:linear-gradient(to bottom, <?php echo $base_color; ?>, <?php echo $gradient_color; ?>);
                                        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $base_color; ?>', endColorstr='<?php echo $gradient_color; ?>', GradientType=0);
                                        -ms-filter: "progid:DXImageTransform.Microsoft.gradient (startColorstr="<?php echo $base_color; ?>", endColorstr="<?php echo $gradient_color; ?>", GradientType=0)";
                                            background-repeat:repeat-x;
                                            }
    <?php
}
?>
                                    </style>
                                    <?php
                                    foreach ($basic_colors as $key => $colors) {
                                        ?>

                                        <li class="basic_color_box basic_color_<?php echo $key; ?>" title="<?php echo $colors; ?>" data-color="<?php echo $colors; ?>" >&nbsp;</li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <div class="arp_ribbon_colorpicker_okbtn">
                                    <button type="button" id="arp_close_colorpicker" class='col_opt_btn' style="float:right;margin-right:10px;position:relative;top:-10px !important;"><?php _e('Ok', 'ARPricelite'); ?></button>
                                </div>
                            </div>
                            <div class="arp_advanced_color_tab" id="arp_advanced_color_tab" data-insert="">
                                <div class="arp_advanced_color_picker jscolor"  jscolor-hash='true' jscolor-valueelement='arp_ribbon_txtcolor' id='arp_advanced_color_picker'  jscolor-onfinechange="arp_update_color(this,arp_advanced_color_picker)" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_advanced_color_picker)',valueElement:arp_ribbon_txtcolor,required:false}">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>

        <!-- Ribbon Modal -->

        <input type="hidden" name="shortcode_to_insert" id="shortcode_to_insert" value="" />

        <!-- Remove column -->
        <div class="arp_model_delete_box" id="arp_remove_column_last" style="display:none;background:white;">
            <div class="modal_top_belt">
                <span class="modal_title"><?php _e('Delete Column', 'ARPricelite'); ?></span>
                <span id="nav_style_close" class="modal_close_btn b-close"></span>
            </div>
            <div class="arp_modal_delete_content">
                <div class="arp_delete_modal_msg"><?php _e("You can not delete all columns", 'ARPricelite'); ?></div>
                <div class="arp_delete_modal_btn">
                    <button id="Model_Delete_Column_last"  class="ribbon_insert_btn Model_Delete_Column_last_btn" type="button"><?php _e("Okay", 'ARPricelite'); ?></button>
                </div>
            </div>
        </div>

        <!-- Remove column -->



        <!-- Tour Guide Model -->
        <div class="arp_model_delete_box" id="arp_tour_guide_model" style="display:none;background:white;">
            <div class="modal_top_belt">
                <span class="modal_title"><?php _e('ARPrice Guided Tour', 'ARPricelite'); ?></span>
                <span id="nav_style_close" class="arp_tour_guide_start_model modal_close_btn b-close"></span>
            </div>

            <div class="arp_modal_delete_content">
                <div class="arp_delete_modal_msg"><?php _e('Please take a quick tour of basic functionalities.', 'ARPricelite'); ?></div>

                <div class="arp_delete_modal_btn">
                    <button id="arp_tour_guide_start_yes" class="arp_tour_guide_start_model ribbon_insert_btn b-close" type="button"><?php _e('Start Tour', 'ARPricelite'); ?></button>
                    <button id="arp_tour_guide_start_no" class="arp_tour_guide_start_model ribbon_insert_btn b-close" type="button" style="background:#373a3f;"><?php _e('Skip Tour', 'ARPricelite'); ?></button>
                </div>
            </div>
        </div>

        <!-- Tour Guide Model -->

        <!-- ARPrice Font Icons Model -->
        <input type="hidden" name="fa_to_insertcol" id="fa_to_insertcol" value="" />
        <input type="hidden" name="fa_to_insertrow" id="fa_to_insertrow" value="" />
        <input type="hidden" name="fa_to_inserttooltip" id="fa_to_inserttooltip" value="" />
        <input type="hidden" name="fa_to_insertlabel" id="fa_to_insertlabel" value="" />
        <input type="hidden" name="fontselected_1" id="fontselected_1" value="" />
        <input type="hidden" name="fontselected_2" id="fontselected_2" value="" />
        <input type="hidden" name="add_to_sec_btn" id="add_to_sec_btn" value="" />
        <input type="hidden" name="arp_fa_text" id="arp_fa_text" value="" />
        <input type="hidden" name="arpcol_to_insert_font" id="arpcol_to_insert_font" value="" />
        <input type="hidden" name="arpcol_insert_font" id="arpcol_insert_font" value="" />
        <div class="arp_font_icons" id="arp_font_icons" style="display:none;">

            <?php
            $fonticon = '';
            $fonticon .= "<div class='arp_font_awesome_arrow'></div>";
            $fonticon .= "<div class='font_awesome_icon_list'>";

            $fonticon .= "<div class='arp_icon_search'><input class='arp_icon_search_input' id='arp_icon_search_input' name='arp_icon_search_input' placeholder='search' /></div>";
            foreach ($arprice_font_awesome_icons as $name => $icon) {
                if ($name == 'font_awesome') {
                    $fonticon .= '<div class="arp_icon_text_title" id="arp_font_awaesome_icon">Font Awesome &nbsp;&nbsp;&nbsp;<span class="pro_version_info">(' . __("Limited icons in lite version", 'ARPricelite') . ')</span></div><div class="clear"></div>';
                    foreach ($icon as $icon_name => $icon_class) {

                        $fonticon .= "<div class='arp_fainsideimge' data-icon='fontawesome' id='" . $icon_class . "' title='" . $icon_name . "'>";
                        $fonticon .= "<i class='fa " . $icon_class . "'></i>";
                        $fonticon .= "</div>";
                    }
                }
                if ($name == 'material_design') {
                    $fonticon .= '<div class="clear"></div><div class="arp_icon_text_title" id="arp_font_material_icon">Material Design Icons</div><div class="clear"></div>';

                    $fonticon .= "<span class='font_icons_notice'>" . __('Please upgrade to premium version to use this icons', 'ARPricelite') . "</span>";
                }
                if ($name == 'typicons') {
                    $fonticon .= '<div class="clear"></div><div class="arp_icon_text_title" id="arp_font_typicons_icon">Typicons</div><div class="clear"></div>';

                    $fonticon .= "<span class='font_icons_notice'>" . __('Please upgrade to premium version to use this icons', 'ARPricelite') . "</span>";
                }
                if ($name == 'ionicons') {
                    $fonticon .= '<div class="clear"></div><div class="arp_icon_text_title" id="arp_font_ionicons_icon">Ionicons</div><div class="clear"></div>';

                    $fonticon .= "<span class='font_icons_notice'>" . __('Please upgrade to premium version to use this icons', 'ARPricelite') . "</span>";
                }
            }
            $fonticon .= "</div>";
            echo $fonticon;
            ?>
        </div>
        <!-- ARPrice Font Icons Model -->
        <?php /* ARPrice Modal Windows */ ?>



        <!-- ARPrice Pro Version Notice -->
        <div class="arp_upgrade_modal" id="arplite_addnew_notice" style="display:none;">
            <div class="upgrade_modal_top_belt">
                <div class="logo" style="text-align:center;"><img src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/arprice_update_logo.png" /></div>
                <div id="nav_style_close" class="close_button b-close"><img src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/arprice_upgrade_close_img.png" /></div>
            </div>
            <div class="upgrade_title"><?php _e('Upgrade To Premium Version.', 'ARPricelite'); ?></div>
            <div class="upgrade_message"><?php _e('You can create maximum 4 columns in free version', 'ARPricelite'); ?></div>
            <div class="upgrade_modal_btn">
                <button id="pro_upgrade_button"  type="button" class="buy_now_button"><?php _e('Buy Now', 'ARPricelite'); ?></button>
                <button id="pro_upgrade_cancel_button"  class="learn_more_button" type="button">Learn More</button>
            </div>
        </div>
        <div class="arp_upgrade_modal" id="arplite_custom_notice" style="display:none;">
            <div class="upgrade_modal_top_belt">
                <div class="logo" style="text-align:center;"><img src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/arprice_update_logo.png" /></div>
                <div id="nav_style_close" class="close_button b-close"><img src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/arprice_upgrade_close_img.png" /></div>
            </div>
            <div class="upgrade_title"><?php _e('Upgrade To Premium Version.', 'ARPricelite'); ?></div>
            <div class="upgrade_message"><?php _e('To unlock this Feature, Buy Premium Version for $21.00 Only.', 'ARPricelite'); ?></div>
            <div class="upgrade_modal_btn">
                <button id="pro_upgrade_button"  type="button" class="buy_now_button"><?php _e('Buy Now', 'ARPricelite'); ?></button>
                <button id="pro_upgrade_cancel_button"  class="learn_more_button" type="button">Learn More</button>
            </div>
        </div>
        <div class="arp_upgrade_modal" id="arplite_custom_css_notice" style="display:none;">
            <div class="upgrade_modal_top_belt">
                <div class="logo" style="text-align:center;"><img src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/arprice_update_logo.png" /></div>
                <div id="nav_style_close" class="close_button b-close"><img src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/arprice_upgrade_close_img.png" /></div>
            </div>
            <div class="upgrade_title"><?php _e('Upgrade To Premium Version.', 'ARPricelite'); ?></div>
            <div class="upgrade_message"><?php _e('To unlock this Feature, Buy Premium Version for $21.00 Only.', 'ARPricelite'); ?></div>
            <div class="upgrade_modal_btn">
                <button id="pro_upgrade_button"  type="button" class="buy_now_button"><?php _e('Buy Now', 'ARPricelite'); ?></button>
                <button id="pro_upgrade_cancel_button"  class="learn_more_button" type="button">Learn More</button>
            </div>
        </div>
        <div class="arp_upgrade_modal" id="arplite_ribbon_notice" style="display:none;">
            <div class="upgrade_modal_top_belt">
                <div class="logo" style="text-align:center;"><img src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/arprice_update_logo.png" /></div>
                <div id="nav_style_close" class="close_button b-close"><img src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/arprice_upgrade_close_img.png" /></div>
            </div>
            <div class="upgrade_title"><?php _e('Upgrade To Premium Version.', 'ARPricelite'); ?></div>
            <div class="upgrade_message"><?php _e('To unlock this Feature, Buy Premium Version for $21.00 Only.', 'ARPricelite'); ?></div>
            <div class="upgrade_modal_btn">
                <button id="pro_upgrade_button"  type="button" class="buy_now_button"><?php _e('Buy Now', 'ARPricelite'); ?></button>
                <button id="pro_upgrade_cancel_button"  class="learn_more_button" type="button">Learn More</button>
            </div>
        </div>
        <div class="arp_upgrade_modal" id="arplite_save_table_notice" style="display:none;">
            <div class="upgrade_modal_top_belt">
                <div class="logo" style="text-align:center;"><img src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/arprice_update_logo.png" /></div>
                <div id="nav_style_close" class="close_button b-close"><img src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/arprice_upgrade_close_img.png" /></div>
            </div>
            <div class="upgrade_title"><?php _e('Upgrade To Premium Version.', 'ARPricelite'); ?></div>
            <div class="upgrade_message"><?php _e('To unlock this Feature, Buy Premium Version for $21.00 Only.', 'ARPricelite'); ?></div>
            <div class="upgrade_modal_btn">
                <button id="pro_upgrade_button"  type="button" class="buy_now_button"><?php _e('Buy Now', 'ARPricelite'); ?></button>
                <button id="pro_upgrade_cancel_button"  class="learn_more_button" type="button">Learn More</button>
            </div>
        </div>

        <!-- Color Options Model Window -->
        <?php
        if (isset($id) && $id != "") {
            $sql = $wpdb->get_row($wpdb->prepare("SELECT general_options FROM " . $wpdb->prefix . "arplite_arprice WHERE ID = %d AND status = %s ", $id, 'published'));
            
            $table_id = isset($sql->ID) ? $sql->ID : '';
            
            $general_option = maybe_unserialize($sql->general_options);
            //print_r($general_option);
        } else {
            $id = "";
        }
        ?>
        <div class="column_custom_background " table_id="<?php echo $id ?>"  style="display:none" id="arp_custom_color_scheme_popup" style='display:none;'>
            <div class="col_opt_row" id="arp_custom_color_tab" style="padding:0 !important;">
                <div class="col_opt_title_div two_column arp_color_tab selected" data-id="arp_normal"><?php _e('Normal', 'ARPricelite'); ?></div>
                <div class="col_opt_title_div two_column arp_color_tab" data-id="arp_hover"><?php _e('Hover', 'ARPricelite'); ?></div>
            </div>
            <div class="col_opt_row" id="arp_normal_custom_color_tab" style="padding:0 !important;">
                <div class="col_opt_title_div two_column"></div>
                <div class="col_opt_title_div two_column" data-id="background_color" style="padding-top:5px !important;"><?php _e('Background', 'ARPricelite'); ?></div>
                <div class="col_opt_title_div two_column" data-id="font_color" style="padding-top:5px !important;"><?php _e('Text Color', 'ARPricelite'); ?></div>
            </div>
            <div id="arp_normal_background_color">
                <div class="col_opt_row" id="arp_column_background_color_data_div" style="display:none">
                    <div class="col_opt_title_div two_column"><?php _e('Column', 'ARPricelite'); ?></div>
                    <div class="col_opt_input_div two_column">
                        <div data-color="<?php echo isset($general_option['custom_skin_colors']['arp_column_bg_custom_color']) ? $general_option['custom_skin_colors']['arp_column_bg_custom_color'] : ''; ?>" id="arp_column_background_color_data" data-column-id="" data-column="" class="color_picker_font font_color_picker background_column_picker arp_header_background_color jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_column_background_color_data)',valueElement:arp_column_background_color_data_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_column_background_color_data)' jscolor-valueelement="arp_column_background_color_data_hidden">
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color" value="<?php echo isset($general_option['custom_skin_colors']['arp_column_bg_custom_color']) ? $general_option['custom_skin_colors']['arp_column_bg_custom_color'] : ''; ?>" name="arp_column_bg_custom_color" id="arp_column_background_color_data_hidden" />
                    </div>
                </div>
                <div class="col_opt_row" id="arp_header_background_color_div" style="display:none">
                    <div class="col_opt_title_div two_column">
                        <?php _e('Header', 'ARPricelite'); ?>
                    </div>
                    <div class="col_opt_input_div two_column arp_header_background_div_id" id='arp_header_background_div_id'>

                        <div data-color="<?php echo isset($general_option['custom_skin_colors']['arp_header_bg_custom_color']) ? $general_option['custom_skin_colors']['arp_header_bg_custom_color'] : ''; ?>" id="arp_header_background_color" data-column-id="" data-column="" class="color_picker_font font_color_picker background_column_picker arp_header_background_color jscolor arp_custom_css_colorpicker" data-id="arp_header_background_color_hidden" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_header_background_color)',valueElement:arp_header_background_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_header_background_color)' jscolor-valueelement='arp_header_background_color_hidden' >
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color" value="<?php echo isset($general_option['custom_skin_colors']['arp_header_bg_custom_color']) ? $general_option['custom_skin_colors']['arp_header_bg_custom_color'] : ''; ?>" name="arp_header_background_color" id="arp_header_background_color_hidden" >
                    </div>
                    <div class="col_opt_input_div two_column arp_header_font_color_div_id" id='arp_header_font_color_div_id'>
                        <div id="arp_header_font_color" data-color="<?php echo isset($general_option['custom_skin_colors']['arp_header_font_custom_color']) ? $general_option['custom_skin_colors']['arp_header_font_custom_color'] : ''; ?>" data-column-id="<?php echo isset($general_option['custom_skin_colors']['arp_header_font_custom_color']) ? $general_option['custom_skin_colors']['arp_header_font_custom_color'] : ''; ?>" data-column="" class="color_picker_font font_color_picker background_column_picker arp_header_font_custom_color jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_header_font_color)',valueElement:arp_header_font_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_header_font_color)' jscolor-valueelement="arp_header_font_color_hidden">
                        </div>

                        <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color" value="" name="arp_header_font_custom_color" id="arp_header_font_color_hidden" >
                    </div>
                </div>

                <div class="col_opt_row" id="arp_shortcode_background_color_div" style="display:none">
                    <div class="col_opt_title_div two_column" style='line-height:1.5;'>
                        <?php _e('Shortcode Section', 'ARPricelite'); ?>
                    </div>
                    <div class="col_opt_input_div two_column arp_shortcode_background_div_id" id='arp_shortcode_background_div_id'>

                        <div data-color="<?php echo isset($general_option['custom_skin_colors']['arp_shortcode_bg_custom_color']) ? $general_option['custom_skin_colors']['arp_shortcode_bg_custom_color'] : ''; ?>" id="arp_shortcode_background_color" data-column-id="" data-column="" class="color_picker_font font_color_picker background_column_picker arp_shortcode_background_color jscolor arp_custom_css_colorpicker" data-id="arp_shortcode_background_color_hidden" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_shortcode_background_color)',valueElement:arp_shortcode_background_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_shortcode_background_color)' jscolor-valueelement='arp_shortcode_background_color_hidden' >
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color" value="<?php echo isset($general_option['custom_skin_colors']['arp_shortcode_bg_custom_color']) ? $general_option['custom_skin_colors']['arp_shortcode_bg_custom_color'] : ''; ?>" name="arp_shortcode_background_color" id="arp_shortcode_background_color_hidden" >
                    </div>
                    <div class="col_opt_input_div two_column arp_shortcode_font_color_div_id" id='arp_shortcode_font_color_div_id'>
                        <div id="arp_shortcode_font_custom_color" data-color="<?php echo isset($general_option['custom_skin_colors']['arp_shortcode_font_custom_color']) ? $general_option['custom_skin_colors']['arp_shortcode_font_custom_color'] : ''; ?>" data-column-id="<?php echo isset($general_option['custom_skin_colors']['arp_shortcode_font_custom_color']) ? $general_option['custom_skin_colors']['arp_shortcode_font_custom_color'] : ''; ?>" data-column="" class="color_picker_font font_color_picker background_column_picker arp_shortcode_font_custom_color jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_shortcode_font_color)',valueElement:arp_shortcode_font_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_shortcode_font_color)' jscolor-valueelement="arp_shortcode_font_color_hidden" data-id="arp_shortcode_font_color_hidden">
                        </div>

                        <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color" value="" name="arp_shortcode_font_custom_color" id="arp_shortcode_font_color_hidden" >
                    </div>
                </div>

                <div class="col_opt_row" id="arp_column_desc_background_color_data_div" style="display:none">
                    <div class="col_opt_title_div two_column"><?php _e('Description', 'ARPricelite'); ?></div>
                    <div class="col_opt_input_div two_column arp_column_desc_background_color_div_id" id='arp_column_desc_background_color_div_id'>
                        <div data-color="<?php echo isset($general_option['custom_skin_colors']['arp_column_desc_bg_custom_color']) ? $general_option['custom_skin_colors']['arp_column_desc_bg_custom_color'] : ''; ?>" id="arp_column_desc_background_color_data" data-column-id="" data-column="" class="color_picker_font font_color_picker background_column_picker arp_header_background_color jscolor arp_custom_css_colorpicker" data-column_id="" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_column_desc_background_color_data)',valueElement:arp_column_desc_background_color_data_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_column_desc_background_color_data)' jscolor-valueelement="arp_column_desc_background_color_data_hidden">
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color" value="<?php echo isset($general_option['arp_column_desc_bg_custom_color']) ? $general_option['arp_column_desc_bg_custom_color'] : ''; ?>" name="arp_column_desc_bg_custom_color" id="arp_column_desc_background_color_data_hidden" />
                    </div>
                    <div class="col_opt_input_div two_column arp_desc_font_custom_color_div_id" id='arp_desc_font_custom_color_div_id'>
                        <div id="arp_desc_font_custom_color" data-color="<?php echo isset($general_option['custom_skin_colors']['arp_desc_font_custom_color']) ? $general_option['custom_skin_colors']['arp_desc_font_custom_color'] : ''; ?>" data-column-id="<?php echo isset($general_option['custom_skin_colors']['arp_desc_font_custom_color']) ? $general_option['custom_skin_colors']['arp_desc_font_custom_color'] : ''; ?>" data-column="" class="color_picker_font font_color_picker background_column_picker arp_desc_font_custom_color jscolor arp_custom_css_colorpicker" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_desc_font_custom_color)' data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_desc_font_custom_color)',valueElement:arp_desc_font_custom_color_hidden}" jscolor-valueelement="arp_desc_font_custom_color_hidden">
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color" value="<?php echo isset($general_option['custom_skin_colors']['arp_desc_font_custom_color']) ? $general_option['custom_skin_colors']['arp_desc_font_custom_color'] : ''; ?>" name="arp_desc_font_custom_color" id="arp_desc_font_custom_color_hidden" />
                    </div>
                </div>
                <div class="col_opt_row" id="arp_pricing_background_color_div" style="display:none">
                    <div class="col_opt_title_div two_column"><?php _e('Pricing', 'ARPricelite'); ?></div>
                    <div class="col_opt_input_div two_column arp_pricing_background_div_id" id='arp_pricing_background_div_id'>
                        <div data-color="<?php echo isset($general_option['arp_pricing_bg_custom_color']) ? $general_option['arp_pricing_bg_custom_color'] : ''; ?>" id="arp_pricing_background_color" data-column-id="" data-column="" class="color_picker_font font_color_picker background_column_picker arp_header_background_color jscolor arp_custom_css_colorpicker" data-column_id="" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_pricing_background_color)',valueElement:arp_pricing_background_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_pricing_background_color)' jscolor-valueElement="arp_pricing_background_color_hidden">
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color" value="<?php echo isset($general_option['arp_pricing_bg_custom_color']) ? $general_option['arp_pricing_bg_custom_color'] : ''; ?>" name="arp_pricing_background_color" id="arp_pricing_background_color_hidden" />
                    </div>
                    <div class="col_opt_input_div two_column arp_pricing_font_color_div_id" id='arp_pricing_font_color_div_id'>
                        <div id="arp_price_font_custom_color" data-color="<?php echo isset($general_option['custom_skin_colors']['arp_price_font_custom_color']) ? $general_option['custom_skin_colors']['arp_price_font_custom_color'] : ''; ?>" data-column-id="<?php echo isset($general_option['custom_skin_colors']['arp_price_font_custom_color']) ? $general_option['custom_skin_colors']['arp_price_font_custom_color'] : ''; ?>" data-column="" class="color_picker_font font_color_picker background_column_picker arp_price_font_custom_color jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_price_font_custom_color)',valueElement:arp_price_font_custom_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_price_font_custom_color)' jscolor-valueelement="arp_price_font_custom_color_hidden">
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color" value="<?php echo isset($general_option['custom_skin_colors']['arp_price_font_custom_color']) ? $general_option['custom_skin_colors']['arp_price_font_custom_color'] : ''; ?>" name="arp_price_font_custom_color" id="arp_price_font_custom_color_hidden" >
                    </div>
                </div>
                <div class="col_opt_row" id="arp_footer_background_color_div" style="display:none;">
                    <div class="col_opt_title_div two_column"><?php _e('Footer', 'ARPricelite'); ?></div>
                    <div class="col_opt_input_div two_column arp_footer_background_div_id">
                        <div data-color="<?php echo isset($general_option['arp_footer_content_bg_color']) ? $general_option['arp_footer_content_bg_color'] : ''; ?>" id="arp_footer_background_color" data-column_id="" data-column="" class="color_picker_font font_color_picker background_column_picker arp_footer_background jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_footer_background_color)',valueElement:arp_footer_background_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_footer_background_color)' jscolor-valueelement="arp_footer_background_color_hidden" >
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color"   value="<?php echo isset($general_option['arp_footer_content_bg_color']) ? $general_option['arp_footer_content_bg_color'] : ''; ?>" name="arp_footer_background_color" id="arp_footer_background_color_hidden" />
                    </div>
                    <div class="col_opt_input_div two_column arp_footer_font_color_div_id">
                        <div id="arp_footer_font_custom_color" data-color="<?php echo isset($general_option['custom_skin_colors']['arp_footer_font_custom_color']) ? $general_option['custom_skin_colors']['arp_footer_font_custom_color'] : ''; ?>" data-column-id="<?php echo isset($general_option['custom_skin_colors']['arp_footer_font_custom_color']) ? $general_option['custom_skin_colors']['arp_footer_font_custom_color'] : ''; ?>" data-column="" class="color_picker_font font_color_picker background_column_picker arp_footer_font_custom_color jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_footer_font_custom_color)',valueElement:arp_footer_font_custom_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_footer_font_custom_color)' jscolor-valueelement='arp_footer_font_custom_color_hidden'>                                
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color" value="<?php echo isset($general_option['custom_skin_colors']['arp_footer_font_custom_color']) ? $general_option['custom_skin_colors']['arp_footer_font_custom_color'] : ''; ?>" name="arp_footer_font_custom_color" id="arp_footer_font_custom_color_hidden" >
                    </div>
                </div>
                <div class="col_opt_row" id="arp_button_background_color_div" style="display:none">
                    <div class="col_opt_title_div two_column"><?php _e('Button', 'ARPricelite'); ?></div>
                    <div class="col_opt_input_div two_column arp_button_background_div_id" id='arp_button_background_div_id'>
                        <div data-color="<?php echo isset($general_option['arp_button_bg_custom_color']) ? $general_option['arp_button_bg_custom_color'] : ''; ?>" id="arp_button_background_color" data-column_id="" data-column="" class="color_picker_font font_color_picker background_column_picker arp_footer_background jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_button_background_color)',valueElement:arp_button_background_color_hidden}" jscolor-hash='true' jscolor-valueelement="arp_button_background_color_hidden" jscolor-onfinechange='arp_update_color(this,arp_button_background_color)'>
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color" value="<?php echo isset($general_option['arp_button_bg_custom_color']) ? $general_option['arp_button_bg_custom_color'] : ''; ?>" name="arp_button_background_color" id="arp_button_background_color_hidden" />
                    </div>
                    <div class="col_opt_input_div two_column" id='arp_button_font_color_div_id'>
                        <div id="arp_button_font_custom_color" data-color="<?php echo isset($general_option['custom_skin_colors']['arp_button_font_custom_color']) ? $general_option['custom_skin_colors']['arp_button_font_custom_color'] : ''; ?>" data-column-id="<?php echo isset($general_option['custom_skin_colors']['arp_button_font_custom_color']) ? $general_option['custom_skin_colors']['arp_button_font_custom_color'] : ''; ?>" data-column="" class="color_picker_font font_color_picker background_column_picker arp_button_font_custom_color jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_button_font_custom_color)',valueElement:arp_button_font_custom_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_button_font_custom_color)', jscolor-valueelement='arp_button_font_custom_color_hidden'>
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color" value="<?php echo isset($general_option['custom_skin_colors']['arp_button_font_custom_color']) ? $general_option['custom_skin_colors']['arp_button_font_custom_color'] : ''; ?>" name="arp_button_font_custom_color" id="arp_button_font_custom_color_hidden">
                        <div class="col_opt_input_div" id="button_custom_font_notice" style="display:none;">(For Button <br>Hover)</div>
                    </div>

                </div>
                <div class="col_opt_row" id="arp_body_background_color" style="display:none;padding-left:5px !important;">
                    <div class="col_opt_title_div"><?php _e('Body Row Colors', 'ARPricelite'); ?></div>
                    <div id="" class="col_opt_row" style="padding:0 !important;width:285px;">
                        <div class="col_opt_title_div two_column" style="width:68px;"></div>
                        <div class="col_opt_title_div two_column"><?php _e('Background', 'ARPricelite'); ?></div>
                        <div class="col_opt_title_div two_column" style="padding-left:0px !important;"><?php _e('Text Color', 'ARPricelite'); ?></div>
                    </div>
                    <div class="col_opt_row">
                        <div class="col_opt_title_div two_column"><?php _e('Odd', 'ARPricelite'); ?></div>
                        <div class="col_opt_input_div two_column arp_body_background_div_id" id='arp_body_background_div_id'>
                            <div data-color="<?php echo isset($general_option['arp_body_odd_row_bg_custom_color']) ? $general_option['arp_body_odd_row_bg_custom_color'] : ''; ?>" id="arp_body_odd_background" data-column="" class="color_picker_font font_color_picker background_column_picker arp_body_odd_background jscolor arp_custom_css_colorpicker" data-column_id="" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_body_odd_background)',valueElement:arp_body_odd_background_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_body_odd_background)' data-valueelement="arp_body_odd_background_hidden">
                            </div>
                            <input type="hidden" class="general_color_box general_color_box_font_color" value="<?php echo isset($general_option['arp_body_odd_row_bg_custom_color']) ? $general_option['arp_body_odd_row_bg_custom_color'] : ''; ?>" name="arp_body_odd_background_color" id="arp_body_odd_background_hidden" />
                        </div>
                        <div class="col_opt_input_div two_column arp_body_font_color_id" id='arp_body_font_color_id'> 
                            <div id="arp_body_font_custom_color" data-color="<?php echo isset($general_option['custom_skin_colors']['arp_body_font_custom_color']) ? $general_option['custom_skin_colors']['arp_body_font_custom_color'] : ''; ?>" data-column-id="<?php echo isset($general_option['custom_skin_colors']['arp_body_font_custom_color']) ? $general_option['custom_skin_colors']['arp_body_font_custom_color'] : ''; ?>" data-column="" class="color_picker_font font_color_picker background_column_picker arp_body_font_custom_color jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_body_font_custom_color)',valueElement:arp_body_font_custom_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_body_font_custom_color)' jscolor-valueelement="arp_body_font_custom_color_hidden">
                            </div>
                            <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color " value="<?php echo isset($general_option['custom_skin_colors']['arp_body_font_custom_color']) ? $general_option['custom_skin_colors']['arp_body_font_custom_color'] : ''; ?>" name="arp_body_font_custom_color" id="arp_body_font_custom_color_hidden" >
                        </div>
                    </div>
                    <div class="col_opt_row">
                        <div class="col_opt_title_div two_column"><?php _e('Even', 'ARPricelite'); ?></div>
                        <div class="col_opt_input_div two_column arp_body_background_div_id" id='arp_body_background_div_id'>
                            <div data-color="<?php echo isset($general_option['arp_body_even_row_bg_custom_color']) ? $general_option['arp_body_even_row_bg_custom_color'] : ''; ?>" id="arp_body_even_background" data-column="" class="color_picker_font font_color_picker background_column_picker arp_body_even_background jscolor arp_custom_css_colorpicker" data-column_id="" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_body_even_background)',valueElement:arp_body_even_background_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_body_even_background)' jscolor-valueelement="arp_body_even_background_hidden">
                            </div>
                            <input type="hidden" class="general_color_box general_color_box_font_color" value="<?php echo isset($general_option['arp_body_even_row_bg_custom_color']) ? $general_option['arp_body_even_row_bg_custom_color'] : ''; ?>" name="arp_body_even_background_color" id="arp_body_even_background_hidden" />
                        </div>

                        <div class="col_opt_input_div two_column arp_body_font_color_id" id='arp_body_font_color_id'>
                            <div data-color="<?php echo isset($general_option['arp_body_even_font_custom_color']) ? $general_option['arp_body_even_font_custom_color'] : ''; ?>" id="arp_body_even_font_custom_color" data-column="" class="color_picker_font font_color_picker background_column_picker arp_body_even_font_custom_color jscolor arp_custom_css_colorpicker" data-column_id="" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_body_even_font_custom_color)',valueElement:arp_body_even_font_custom_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_body_even_font_custom_color)' jscolor-valueelement="arp_body_even_font_custom_color_hidden">
                            </div>
                            <input type="hidden" class="general_color_box general_color_box_font_color" value="<?php echo isset($general_option['arp_body_even_font_custom_color']) ? $general_option['arp_body_even_font_custom_color'] : ''; ?>" name="arp_body_even_font_custom_color_color" id="arp_body_even_font_custom_color_hidden" />
                        </div>
                    </div>
                </div>
            </div>
            <div id="arp_hover_background_color" style="display:none;">
                <div class="col_opt_row" id="arp_column_hover_color_div" style="display:none">
                    <div class="col_opt_title_div two_column"><?php _e('Column', 'ARPricelite'); ?></div>
                    <div class="col_opt_input_div two_column arp_column_background_div_id" id='arp_column_background_div_id'>
                        <div data-color="<?php echo isset($general_option['arp_column_bg_hover_color']) ? $general_option['arp_column_bg_hover_color'] : ''; ?>" id="arp_column_hover_background" data-column_id="" data-column="" class="color_picker_font font_color_picker background_column_picker arp_column_hover_background jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_column_hover_background)',valueElement:arp_column_hover_background_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_column_hover_background)' jscolor-valueelement="arp_column_hover_background_hidden">
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color" value="<?php echo isset($general_option['arp_column_bg_hover_color']) ? $general_option['arp_column_bg_hover_color'] : ''; ?>" name="arp_column_bg_hover_color" id="arp_column_hover_background_hidden" />
                    </div>
                </div>
                <div class="col_opt_row" id="arp_header_hover_bg_color" style="display:none">
                    <div class="col_opt_title_div two_column">
                        <?php _e('Header', 'ARPricelite'); ?>
                    </div>
                    <div class="col_opt_input_div two_column arp_header_background_div_id">
                        <div data-color="<?php echo isset($general_option['arp_header_bg_hover_custom_color']) ? $general_option['arp_header_bg_hover_custom_color'] : ''; ?>" id="arp_header_hover_background_color" data-column-id="" data-column="" class="color_picker_font font_color_picker background_column_picker arp_header_background_color jscolor arp_custom_css_colorpicker" data-column_id="" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_header_hover_background_color)',valueElement:arp_header_hover_background_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_header_hover_background_color)' jscolor-valueelement="arp_header_hover_background_color_hidden" >
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color" value="<?php echo isset($general_option['arp_header_bg_hover_custom_color']) ? $general_option['arp_header_bg_custom_color'] : ''; ?>" name="arp_header_hover_background_color" id="arp_header_hover_background_color_hidden" >
                    </div>
                    <div class="col_opt_input_div two_column arp_header_font_color_div_id">
                        <div id="arp_header_font_custom_hover_color" data-color="<?php echo isset($general_option['custom_skin_colors']['arp_header_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_header_font_custom_hover_color'] : ''; ?>" data-column-id="<?php echo isset($general_option['custom_skin_colors']['arp_header_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_header_font_custom_hover_color'] : ''; ?>" data-column="" class="color_picker_font font_color_picker background_column_picker arp_header_font_custom_hover_color jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_header_font_custom_hover_color)',valueElement:arp_header_font_custom_hover_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_header_font_custom_hover_color)' jscolor-valueelement="arp_header_font_custom_hover_color_hidden">
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color" value="<?php echo isset($general_option['custom_skin_colors']['arp_header_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_header_font_custom_hover_color'] : ''; ?>" name="arp_header_font_custom_hover_color" id="arp_header_font_custom_hover_color_hidden" />
                    </div>
                </div>
                <div class="col_opt_row" id="arp_shortcode_hover_bg_color" style="display:none">
                    <div class="col_opt_title_div two_column" style='line-height:1.5;'>
                        <?php _e('Shortcode Section', 'ARPricelite'); ?>
                    </div>
                    <div class="col_opt_input_div two_column arp_shortcode_background_div_id">
                        <div data-color="<?php echo isset($general_option['arp_shortcode_bg_hover_custom_color']) ? $general_option['arp_shortcode_bg_hover_custom_color'] : ''; ?>" id="arp_shortcode_hover_background_color" data-column-id="" data-column="" class="color_picker_font font_color_picker background_column_picker arp_shortcode_background_color jscolor arp_custom_css_colorpicker" data-column_id="" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_shortcode_hover_background_color)',valueElement:arp_shortcode_hover_background_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_shortcode_hover_background_color)' jscolor-valueelement="arp_shortcode_hover_background_color_hidden" >
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color" value="<?php echo isset($general_option['arp_shortcode_bg_hover_custom_color']) ? $general_option['arp_shortcode_bg_custom_color'] : ''; ?>" name="arp_shortcode_hover_background_color" id="arp_shortcode_hover_background_color_hidden" >
                    </div>
                    <div class="col_opt_input_div two_column arp_shortcode_font_color_div_id">
                        <div id="arp_shortcode_font_custom_hover_color" data-color="<?php echo isset($general_option['custom_skin_colors']['arp_shortcode_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_shortcode_font_custom_hover_color'] : ''; ?>" data-column-id="<?php echo isset($general_option['custom_skin_colors']['arp_shortcode_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_shortcode_font_custom_hover_color'] : ''; ?>" data-column="" class="color_picker_font font_color_picker background_column_picker arp_shortcode_font_custom_hover_color jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_shortcode_font_custom_hover_color)',valueElement:arp_shortcode_font_custom_hover_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_shortcode_font_custom_hover_color)' jscolor-valueelement="arp_shortcode_font_custom_hover_color_hidden">
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color" value="<?php echo isset($general_option['custom_skin_colors']['arp_shortcode_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_shortcode_font_custom_hover_color'] : ''; ?>" name="arp_shortcode_font_custom_hover_color" id="arp_shortcode_font_custom_hover_color_hidden" />
                    </div>
                </div>
                <div class="col_opt_row" id="arp_column_desc_hover_background_color_data" style="display:none">
                    <div class="col_opt_title_div two_column"><?php _e('Description', 'ARPricelite'); ?></div>
                    <div class="col_opt_input_div two_column arp_column_desc_background_color_div_id">
                        <div data-color="" id="arp_column_desc_hover_bg_custom_color" data-column-id="" data-column="" class="color_picker_font font_color_picker background_column_picker arp_header_background_color jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_column_desc_hover_bg_custom_color)',valueElement:arp_column_desc_hover_bg_custom_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_column_desc_hover_bg_custom_color)' jscolor-valueelement="arp_column_desc_hover_bg_custom_color_hidden">
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color" value="" name="arp_column_desc_hover_bg_custom_color" id="arp_column_desc_hover_bg_custom_color_hidden" />
                    </div>
                    <div class="col_opt_input_div two_column arp_desc_font_custom_color_div_id">
                        <div id="arp_desc_font_custom_hover_color" data-color="<?php echo isset($general_option['custom_skin_colors']['arp_desc_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_desc_font_custom_hover_color'] : ''; ?>" data-column-id="<?php echo isset($general_option['custom_skin_colors']['arp_desc_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_desc_font_custom_hover_color'] : ''; ?>" data-column="" class="color_picker_font font_color_picker background_column_picker arp_desc_font_custom_hover_color jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_desc_font_custom_hover_color)',valueElement:arp_desc_font_custom_hover_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_desc_font_custom_hover_color)' jscolor-valueelement="arp_desc_font_custom_hover_color_hidden">
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color" value="<?php echo isset($general_option['custom_skin_colors']['arp_desc_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_desc_font_custom_hover_color'] : ''; ?>" name="arp_desc_font_custom_hover_color" id="arp_desc_font_custom_hover_color_hidden" />
                    </div>
                </div>
                <div class="col_opt_row" id="arp_pricing_background_hover_color_div" style="display:none">
                    <div class="col_opt_title_div two_column"><?php _e('Pricing', 'ARPricelite'); ?> </div>
                    <div class="col_opt_input_div two_column arp_pricing_background_div_id">
                        <div data-color="" id="arp_column_price_hover_background" data-column_id="" data-column="" class="color_picker_font font_color_picker background_column_picker arp_column_price_hover_background jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_column_price_hover_background)',valueElement:arp_column_price_hover_background_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_column_price_hover_background)' jscolor-valueelement="arp_column_price_hover_background_hidden">
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color" value="" name="arp_column_price_hover_background" id="arp_column_price_hover_background_hidden" />
                    </div>
                    <div class="col_opt_input_div two_column arp_pricing_font_color_div_id">
                        <div id="arp_price_font_custom_hover_color" data-color="<?php echo isset($general_option['custom_skin_colors']['arp_price_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_price_font_custom_hover_color'] : ''; ?>" data-column-id="<?php echo isset($general_option['custom_skin_colors']['arp_price_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_price_font_custom_hover_color'] : ''; ?>" data-column="" class="color_picker_font font_color_picker background_column_picker arp_price_font_custom_hover_color jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_price_font_custom_hover_color)',valueElement:arp_price_font_custom_hover_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_price_font_custom_hover_color)' jscolor-valueelement="arp_price_font_custom_hover_color_hidden">
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color" value="<?php echo isset($general_option['custom_skin_colors']['arp_price_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_price_font_custom_hover_color'] : ''; ?>" name="arp_price_font_custom_hover_color" id="arp_price_font_custom_hover_color_hidden" >
                    </div>
                </div>
                <div class="col_opt_row" id="arp_footer_hover_background_color" style="display:none">
                    <div class="col_opt_title_div two_column"><?php _e('Footer', 'ARPricelite'); ?></div>
                    <div class="col_opt_input_div two_column arp_footer_background_div_id">
                        <div data-color="" id="arp_footer_hover_background" data-column_id="" data-column="" class="color_picker_font font_color_picker background_column_picker arp_footer_hover_background jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_footer_hover_background)',valueElement:arp_footer_hover_background_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_footer_hover_background)' jscolor-valueelement="arp_footer_hover_background_hidden">
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color" value="" name="arp_footer_hover_background" id="arp_footer_hover_background_hidden" />
                    </div>
                    <div class="col_opt_input_div two_column arp_footer_font_color_div_id">
                        <div id="arp_footer_font_custom_hover_color" data-color="<?php echo isset($general_option['custom_skin_colors']['arp_footer_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_footer_font_custom_hover_color'] : ''; ?>" data-column-id="<?php echo isset($general_option['custom_skin_colors']['arp_footer_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_footer_font_custom_hover_color'] : ''; ?>" data-column="" class="color_picker_font font_color_picker background_column_picker arp_footer_font_custom_hover_color jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_footer_font_custom_hover_color)',valueElement:arp_footer_font_custom_hover_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_footer_font_custom_hover_color)' jscolor-valueelement="arp_footer_font_custom_hover_color_hidden">
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color" value="<?php echo isset($general_option['custom_skin_colors']['arp_footer_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_footer_font_custom_hover_color'] : ''; ?>" name="arp_footer_font_custom_hover_color" id="arp_footer_font_custom_hover_color_hidden" >
                    </div>
                </div>
                <div class="col_opt_row" id="arp_btn_hover_color_div" style="display:none">
                    <div class="col_opt_title_div two_column"><?php _e('Button', 'ARPricelite'); ?> </div>
                    <div class="col_opt_input_div two_column">
                        <div data-color="" id="arp_column_btn_hover_background" data-column_id="" data-column="" class="color_picker_font font_color_picker background_column_picker arp_column_btn_hover_background jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_column_btn_hover_background)',valueElement:arp_column_btn_hover_background_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_column_btn_hover_background)' jscolor-valueelement="arp_column_btn_hover_background_hidden">
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color" value="" name="arp_column_btn_bg_hover_color" id="arp_column_btn_hover_background_hidden" />
                    </div>
                    <div class="col_opt_input_div two_column">
                        <div id="arp_button_font_custom_hover_color" data-color="<?php echo isset($general_option['custom_skin_colors']['arp_button_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_button_font_custom_hover_color'] : ''; ?>" data-column-id="<?php echo isset($general_option['custom_skin_colors']['arp_button_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_button_font_custom_hover_color'] : ''; ?>" data-column="" class="color_picker_font font_color_picker background_column_picker arp_button_font_custom_hover_color jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_button_font_custom_hover_color)',valueElement:arp_button_font_custom_hover_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_button_font_custom_hover_color)', jscolor-valueelement="arp_button_font_custom_hover_color_hidden">
                        </div>
                        <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color" value="<?php echo isset($general_option['custom_skin_colors']['arp_button_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_button_font_custom_hover_color'] : ''; ?>" name="arp_button_font_custom_hover_color" id="arp_button_font_custom_hover_color_hidden" >
                    </div>
                </div>
                <div class="col_opt_row" id="arp_body_hover_background_color" style="display:none;padding-left:5px !important;">
                    <div class="col_opt_title_div"><?php _e('Body Row Colors', 'ARPricelite'); ?></div>
                    <div id="" class="col_opt_row" style="padding:0 !important;width:285px;">
                        <div class="col_opt_title_div two_column" style="width:68px;"></div>
                        <div class="col_opt_title_div two_column"><?php _e('Background', 'ARPricelite'); ?></div>
                        <div class="col_opt_title_div two_column" style="padding-left:0px !important;"><?php _e('Text Color', 'ARPricelite'); ?></div>
                    </div>
                    <div class="col_opt_row">
                        <div class="col_opt_title_div two_column"><?php _e('Odd', 'ARPricelite'); ?></div>
                        <div class="col_opt_input_div two_column arp_body_background_div_id">
                            <div data-color="" id="arp_body_hover_odd_background" data-column_id="" data-column="" class="color_picker_font font_color_picker background_column_picker arp_body_hover_odd_background jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_body_hover_odd_background)',valueElement:arp_body_hover_odd_background_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_body_hover_odd_background)' jscolor-valueelement="arp_body_hover_odd_background_hidden">
                            </div>
                            <input type="hidden" class="general_color_box general_color_box_font_color" value="" name="arp_body_hover_odd_background_color" id="arp_body_hover_odd_background_hidden" />
                        </div>
                        <div class="col_opt_input_div two_column arp_body_font_color_div_id">
                            <div id="arp_body_font_custom_hover_color" data-color="<?php echo isset($general_option['custom_skin_colors']['arp_body_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_body_font_custom_hover_color'] : ''; ?>" data-column-id="<?php echo isset($general_option['custom_skin_colors']['arp_body_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_body_font_custom_hover_color'] : ''; ?>" data-column="" class="color_picker_font font_color_picker background_column_picker arp_body_font_custom_hover_color jscolor arp_custom_css_colorpicker" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_body_font_custom_hover_color)',valueElement:arp_body_font_custom_hover_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_body_font_custom_hover_color)' jscolor-valueelement="arp_body_font_custom_hover_color_hidden">
                            </div>
                            <input type="hidden" class="general_color_box general_color_box_font_color general_color_box_background_color" value="<?php echo isset($general_option['custom_skin_colors']['arp_body_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_body_font_custom_hover_color'] : ''; ?>" name="arp_body_font_custom_hover_color" id="arp_body_font_custom_hover_color_hidden" >
                        </div>
                    </div>
                    <div class="col_opt_row">
                        <div class="col_opt_title_div two_column"><?php _e('Even', 'ARPricelite'); ?></div>
                        <div class="col_opt_input_div two_column arp_body_background_div_id">
                            <div data-color="" id="arp_body_hover_even_background" data-column="" class="color_picker_font font_color_picker background_column_picker arp_body_hover_even_background jscolor arp_custom_css_colorpicker" data-column_id="" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_body_hover_even_background)',valueElement:arp_body_hover_even_background_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_body_hover_even_background)' jscolor-valueelement="arp_body_hover_even_background_hidden">
                            </div>
                            <input type="hidden" class="general_color_box general_color_box_font_color" value="" name="arp_body_hover_even_background_color" id="arp_body_hover_even_background_hidden" />
                        </div>
                        <div class="col_opt_input_div two_column arp_body_font_color_id" id='arp_body_font_color_id'>
                            <div data-color="<?php echo isset($general_option['arp_body_even_font_custom_hover_color']) ? $general_option['arp_body_even_font_custom_hover_color'] : ''; ?>" id="arp_body_even_font_custom_hover_color" data-column="" class="color_picker_font font_color_picker background_column_picker arp_body_even_font_custom_hover_color jscolor arp_custom_css_colorpicker" data-column_id="" data-jscolor="{hash:true,onFineChange:'arp_update_color(this,arp_body_even_font_custom_hover_color)',valueElement:arp_body_even_font_custom_hover_color_hidden}" jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_body_even_font_custom_hover_color)' jscolor-valueelement="arp_body_even_font_custom_hover_color_hidden">
                            </div>
                            <input type="hidden" class="general_color_box general_color_box_font_color" value="<?php echo isset($general_option['arp_body_even_row_font_custom_color']) ? $general_option['arp_body_even_row_font_custom_color'] : ''; ?>" name="arp_body_even_font_custom_hover_color_hidden" id="arp_body_even_font_custom_hover_color_hidden" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="col_opt_row" id="arp_custom_ok_btn_div" style="display:none;">
                <div class="col_opt_input_div">
                    <button class="col_opt_btn arp_custom_color_ok_btn" id="arp_custom_color_ok_btn" type="button" style="float:right;font-weight:bold;"><?php _e('Ok', 'ARPricelite'); ?></button>
                </div>
            </div>
        </div>
        <!-- Color Options Model Window -->