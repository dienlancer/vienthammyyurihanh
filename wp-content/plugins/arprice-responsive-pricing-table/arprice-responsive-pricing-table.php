<?php @session_start();
@error_reporting(E_ERROR | E_WARNING | E_PARSE);
/*
  Plugin Name: ARPrice Lite
  Description: Responsive Wordpress Pricing Table / Team Showcase Plugin
  Version: 1.7
  Plugin URI: http://arprice.arformsplugin.com
  Author: Repute InfoSystems
  Author URI: http://arprice.arformsplugin.com
 */

if (is_ssl())
    define('ARPLITEURL', str_replace('http://', 'https://', WP_PLUGIN_URL . '/arprice-responsive-pricing-table'));
else
    define('ARPLITEURL', WP_PLUGIN_URL . '/arprice-responsive-pricing-table');

define('ARPLITE_PRICINGTABLE_DIR', WP_PLUGIN_DIR . '/arprice-responsive-pricing-table');
define('ARPLITE_PRICINGTABLE_URL', ARPLITEURL);
define('ARPLITE_PRICINGTABLE_CORE_DIR', ARPLITE_PRICINGTABLE_DIR . '/core');
define('ARPLITE_PRICINGTABLE_CLASSES_DIR', ARPLITE_PRICINGTABLE_DIR . '/core/classes');
define('ARPLITE_PRICINGTABLE_CLASSES_URL', ARPLITE_PRICINGTABLE_URL . '/core/classes');
define('ARPLITE_PRICINGTABLE_IMAGES_URL', ARPLITE_PRICINGTABLE_URL . '/images');
define('ARPLITE_PRICINGTABLE_INC_DIR', ARPLITE_PRICINGTABLE_DIR . '/inc');
define('ARPLITE_PRICINGTABLE_VIEWS_DIR', ARPLITE_PRICINGTABLE_DIR . '/core/views');
define('ARPLITE_PRICINGTABLE_MODEL_DIR', ARPLITE_PRICINGTABLE_DIR . '/core/models');
define('ARPLITE_PT_TXTDOMAIN', 'ARPricelite');
@define('FS_METHOD', 'direct');


$wpupload_dir = wp_upload_dir();
$upload_dir = $wpupload_dir['basedir'] . '/arprice-responsive-pricing-table';
$upload_url = $wpupload_dir['baseurl'] . '/arprice-responsive-pricing-table';

if (is_ssl()) {
    $upload_url = str_replace("http://", "https://", $wpupload_dir['baseurl'] . '/arprice-responsive-pricing-table');
} else {
    $upload_url = $wpupload_dir['baseurl'] . '/arprice-responsive-pricing-table';
}

wp_mkdir_p($upload_dir);

$css_upload_dir = $upload_dir . '/css';
wp_mkdir_p($css_upload_dir);

$template_images_upload_dir = $upload_dir . '/template_images';
wp_mkdir_p($template_images_upload_dir);

$arp_import_dir = $upload_dir . '/import';
wp_mkdir_p($arp_import_dir);

define('ARPLITE_PRICINGTABLE_UPLOAD_DIR', $upload_dir);

define('ARPLITE_PRICINGTABLE_UPLOAD_URL', $upload_url);

global $arplite_pricingtable;
$arplite_pricingtable = new ARPlite_PricingTable();

/* Defining Pricing Table Version */
global $arpricelite_version;
$arpricelite_version = '1.7';

global $arpricelite_img_css_version;
$arpricelite_img_css_version = '1.0';

/* Defining Rolls for Pricing table Plugin */
global $arplite_allrole;
$arplite_allrole = array("editor", "author", "contributor", "subscriber");

global $arplite_subscription_time;
$arplite_subscription_time = "15";

global $pricingtableliteajaxurl;
$pricingtableliteajaxurl = admin_url('admin-ajax.php');

if (file_exists(ARPLITE_PRICINGTABLE_CLASSES_DIR . '/class.arprice.php'))
    require_once(ARPLITE_PRICINGTABLE_CLASSES_DIR . '/class.arprice.php' );

if (file_exists(ARPLITE_PRICINGTABLE_CLASSES_DIR . '/class.arprice_form.php'))
    require_once( ARPLITE_PRICINGTABLE_CLASSES_DIR . '/class.arprice_form.php' );

if (file_exists(ARPLITE_PRICINGTABLE_CLASSES_DIR . '/class.arprice_analytics.php'))
    require_once( ARPLITE_PRICINGTABLE_CLASSES_DIR . '/class.arprice_analytics.php' );

if (file_exists(ARPLITE_PRICINGTABLE_CLASSES_DIR . '/class.arprice_import_export.php'))
    require_once( ( ARPLITE_PRICINGTABLE_CLASSES_DIR . '/class.arprice_import_export.php' ) );
if (file_exists(ARPLITE_PRICINGTABLE_CLASSES_DIR . '/class.arp_fonts.php'))
    require_once( ( ARPLITE_PRICINGTABLE_CLASSES_DIR . '/class.arp_fonts.php' ) );

if (file_exists(ARPLITE_PRICINGTABLE_CLASSES_DIR . '/class.arp_default_settings.php'))
    require_once( (ARPLITE_PRICINGTABLE_CLASSES_DIR . '/class.arp_default_settings.php'));

global $arpricelite_class;
$arpricelite_class = new arpricelite();

global $arpricelite_form;
$arpricelite_form = new arpricelite_form();

global $arpricelite_analytics;
$arpricelite_analytics = new arpricelite_analytics();

global $arpricelite_import_export;
$arpricelite_import_export = new arpricelite_import_export();

global $arpricelite_fonts;
$arpricelite_fonts = new arpricelite_fonts();

global $arpricelite_default_settings;
$arpricelite_default_settings = new arplite_default_settings();

global $arplite_mainoptionsarr;
global $arplite_coloptionsarr;
global $arplite_tempbuttonsarr;
global $arplite_templateorderarr;
global $arplite_templatecssinfoarr;
global $arplite_templateresponsivearr;
global $arplite_template_editor_arr;
global $arplite_templatesectionsarr;
global $arplite_templatecustomskinarr;
global $arplite_templatehoverclassarr;

global $arplite_is_animation, $arplite_has_tooltip, $arplite_has_fontawesome, $arplite_effect_css, $arplite_switch_css;
$arplite_is_animation = 0;
$arplite_has_tooltip = 0;
$arplite_has_fontawesome = 0;
$arplite_effect_css = 0;
$arplite_switch_css = 0;

if (class_exists('WP_Widget')) {
    require_once(ARPLITE_PRICINGTABLE_DIR . '/core/widgets/arprice_widget.php');
    add_action('widgets_init', create_function('', 'return register_widget("arpricelite_widget");'));
}

class ARPlite_PricingTable {

    function __construct() {
        register_activation_hook(__FILE__, array('ARPlite_PricingTable', 'arpricelite_install'));

        register_activation_hook(__FILE__, array('ARPlite_PricingTable', 'arpricelite_check_network_activation'));

        register_uninstall_hook(__FILE__, array('ARPlite_PricingTable', 'uninstall'));

        add_action('admin_menu', array(&$this, 'pricingtablelite_menu'), 27);

        add_action('wp_ajax_editplan', array(&$this, 'editplan'));

        add_action('wp_ajax_editpackage', array(&$this, 'editpackage'));

        add_action('admin_enqueue_scripts', array(&$this, 'set_css'), 10);

        add_action('admin_enqueue_scripts', array(&$this, 'set_js'), 10);

        add_action('wp_head', array(&$this, 'set_front_css'), 1);

        add_action('wp_head', array(&$this, 'set_front_js'), 1);

        add_action('admin_head', array(&$this, 'arplite_menu_css'));

        add_action('init', array(&$this, 'arplite_pricing_table_main_settings'));

        add_action('plugins_loaded', array(&$this, 'arplite_pricing_table_load_textdomain'));

        add_action('wp_head', array(&$this, 'arplite_enqueue_template_css'), 1, 0);
        add_action('wp_head', array(&$this, 'arplite_front_assets'), 1, 0);

        add_action('arplite_enqueue_preview_style', array(&$this, 'arplite_enqueue_preview_css'), 1, 4);

        add_action('admin_init', array(&$this, 'arplite_db_check'));

        add_filter('admin_footer_text', array(&$this, 'replace_footer_admin'));

        add_filter('update_footer', array(&$this, 'arplite_replace_footer_version'), '1234');

        add_action('admin_head', array($this, 'arplite_hide_update_notice_to_all_admin_users'), 10000);

        add_action('wp_footer', array(&$this, 'footer_js'), 1, 0);

        //add_action( 'admin_footer', 'arp_add_admin_footer_js');
        add_filter('script_loader_tag', array(&$this, 'arp_prevent_rocket_loader_script'), 10, 2);

        add_action('user_register', array(&$this, 'arp_add_capabilities_to_new_user'));
    }

    function arp_add_capabilities_to_new_user( $user_id){
        if( $user_id == '' ){
            return;
        }

        if( user_can($user_id,'administrator')){
            $arproles = $this->arp_capabilities();
            $userObj = new WP_User($user_id);
            
            foreach ($arproles as $arprole => $arproledescription){
                $userObj->add_cap($arprole);
            }

            unset($arproles);
            unset($arprole);
            unset($arproledescription);
        }
    }

    function arp_prevent_rocket_loader_script($tag, $handle) {
        $pattern = '/(.*?)(data\-cfasync\=)(.*?)/';
        preg_match_all($pattern, $tag, $matches);
        if (!is_array($matches)) {
            return str_replace(' src', ' data-cfasync="false" src', $tag);
        } else if (!empty($matches) && !empty($matches[2]) && !empty($matches[2][0]) && strtolower(trim($matches[2][0])) != 'data-cfasync=') {
            return str_replace(' src', ' data-cfasync="false" src', $tag);
        } else if (!empty($matches) && empty($matches[2])) {
            return str_replace(' src', ' data-cfasync="false" src', $tag);
        } else {
            return $tag;
        }
    }
    
    function replace_footer_admin() {
        echo '<span id="footer-thankyou"></span>';
    }

    function arplite_replace_footer_version() {
        return ' ';
    }

    /* Loading plugin text domain */

    function arplite_pricing_table_load_textdomain() {
        load_plugin_textdomain(ARPLITE_PT_TXTDOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

    function arpricelite_check_network_activation($network_wide) {
        if (!$network_wide)
            return;

        deactivate_plugins(plugin_basename(__FILE__), TRUE, TRUE);

        header('Location: ' . network_admin_url('plugins.php?deactivate=true'));
        exit;
    }

    function arplite_pricing_table_main_settings() {
        global $arplite_mainoptionsarr, $arplite_pricingtable, $arpricelite_default_settings;
        $arplite_mainoptionsarr = $arplite_pricingtable->arp_mainoptions();

        global $arplite_coloptionsarr;
        $arplite_coloptionsarr = $arplite_pricingtable->arp_columnoptions();

        global $arplite_tempbuttonsarr;
        $arplite_tempbuttonsarr = $arplite_pricingtable->arp_tempbuttonsoptions();

        global $arplite_templateorderarr;
        $arplite_templateorderarr = $arplite_pricingtable->arp_template_order();

        global $arplite_templateresponsivearr;
        $arplite_templateresponsivearr = $arplite_pricingtable->arp_template_responsive_type_array();

        global $arplite_template_editor_arr;
        $arplite_template_editor_arr = $arplite_pricingtable->arp_template_editor_array();

        global $arplite_templatesectionsarr;
        $arplite_templatesectionsarr = $arpricelite_default_settings->arp_template_sections_array();

        global $arplite_templatecustomskinarr;
        $arplite_templatecustomskinarr = $arpricelite_default_settings->arplite_template_custom_skin_array();

        global $arplite_templatehoverclassarr;
        $arplite_templatehoverclassarr = $arpricelite_default_settings->arp_template_hover_class_array();
    }

    /* Setting General Options for Pricing table */

    function arp_mainoptions() {
        $arpoptionsarr = apply_filters('arplite_pricing_table_available_main_settings', array(
            'general_options' => array(
                'template_options' => array(
                    'templates' => array('arplitetemplate_1', 'arplitetemplate_8', 'arplitetemplate_11', 'arplitetemplate_26'),
                    'skins' => array('arplitetemplate_1' => array('green', 'yellow', 'darkorange', 'darkred', 'red', 'violet', 'pink', 'blue', 'darkblue', 'lightgreen', 'darkestblue', 'cyan', 'black', 'multicolor'), 'arplitetemplate_8' => array('purple', 'skyblue', 'red', 'green', 'blue', 'orange', 'darkcyan', 'yellow', 'pink', 'teal', 'multicolor'), 'arplitetemplate_11' => array('yellow', 'limegreen', 'red', 'blue', 'pink', 'cyan', 'lightpink', 'violet', 'gray', 'green'), 'arplitetemplate_26' => array('blue', 'red', 'lightblue', 'cyan', 'yellow', 'pink', 'lightviolet', 'gray', 'orange', 'darkblue', 'turquoise', 'grayishyellow', 'green'),),
                    'skin_color_code' => array('arplitetemplate_1' => array('6dae2e', 'fbb400', 'e75c01', 'c32929', 'e52937', '713887', 'EB005C', '29A1D3', '2F3687', '1BA341', '2F4251', '009E7B', '5C5C5C', 'Multicolor'), 'arplitetemplate_8' => array('AB6ED7', '44B7E4', 'F15859', '7FB948', '595EB7', 'FF6E3D', '54CAB0', 'FFC74B', 'EC3E9A', '25D0D7', 'Multicolor'), 'arplitetemplate_11' => array('EFA738', '43B34D', 'FF3241', '09B1F8', 'E3328C', '11B0B6', 'F15F74', '8F4AFF', '949494', '78C335'), 'arplitetemplate_26' => array('2fb8ff', 'ff2d46', '4196ff', '00d29d', 'f1bc16', 'ff2476', '6b68ff', 'b7bdcb', 'fd9a25', '337cff', '00dbef', 'cfc5a1', '16d784')),
                    'template_type' => array('arplitetemplate_1' => 'normal', 'arplitetemplate_8' => 'normal', 'arplitetemplate_11' => 'normal', 'arplitetemplate_26' => 'normal'),
                    'features' => array(
                        'arplitetemplate_1' => array('column_description' => 'disable', 'custom_ribbon' => 'disable', 'button_position' => 'default', 'caption_style' => 'default', 'amount_style' => 'default', 'list_alignment' => 'default', 'ribbon_type' => 'default', 'column_description_style' => 'default', 'caption_title' => 'default', 'header_shortcode_type' => 'normal', 'header_shortcode_position' => 'none', 'tooltip_position' => 'top-left', 'tooltip_style' => 'default', 'second_btn' => false, 'additional_shortcode' => false, 'is_animated' => 0, 'has_footer_content' => 1, 'button_border_customization' => 1),
                        'arplitetemplate_8' => array('column_description' => 'disable', 'custom_ribbon' => 'disable', 'button_position' => 'position_2', 'caption_style' => 'default', 'amount_style' => 'default', 'list_alignment' => 'default', 'ribbon_type' => 'default', 'column_description_style' => 'default', 'caption_title' => 'default', 'header_shortcode_type' => 'rounded_corner', 'header_shortcode_position' => 'position_1', 'tooltip_position' => 'top', 'tooltip_style' => 'style_2', 'second_btn' => false, 'additional_shortcode' => true, 'is_animated' => 0, 'has_footer_content' => 0, 'button_border_customization' => 1),
                        'arplitetemplate_11' => array('column_description' => 'enable', 'custom_ribbon' => 'disable', 'button_position' => 'position_1', 'caption_style' => 'none', 'amount_style' => 'default', 'list_alignment' => 'default', 'ribbon_type' => 'default', 'column_description_style' => 'style_4', 'caption_title' => 'default', 'header_shortcode_type' => 'normal', 'header_shortcode_position' => 'none', 'tooltip_position' => 'top-left', 'tooltip_style' => 'default', 'second_btn' => false, 'additional_shortcode' => false, 'is_animated' => 0, 'has_footer_content' => 0, 'button_border_customization' => 1),
                        'arplitetemplate_26' => array('column_description' => 'disable', 'custom_ribbon' => 'disable', 'button_position' => 'default', 'caption_style' => 'default', 'amount_style' => 'default', 'list_alignment' => 'default', 'ribbon_type' => 'default', 'column_description_style' => 'default', 'caption_title' => 'default', 'header_shortcode_type' => 'rounded_border', 'header_shortcode_position' => 'default', 'tooltip_position' => 'top', 'tooltip_style' => 'style_2', 'second_btn' => false, 'is_animated' => 0, 'button_border_customization' => 1, 'has_footer_content' => 0)
                    ),
                    'arp_ribbons' => array('arp_ribbon_1' => 'Ribbon Style 1', 'arp_ribbon_2' => 'Ribbon Style 2 <span class="pro_version_info">(' . __("Pro Version", 'ARPricelite') . ')</span>', 'arp_ribbon_3' => 'Ribbon Style 3 <span class="pro_version_info">(' . __("Pro Version", 'ARPricelite') . ')</span>', 'arp_ribbon_4' => 'Ribbon Style 4 <span class="pro_version_info">(' . __("Pro Version", 'ARPricelite') . ')</span>', 'arp_ribbon_5' => 'Ribbon Style 5 <span class="pro_version_info">(' . __("Pro Version", 'ARPricelite') . ')</span>', 'arp_ribbon_6' => 'Custom Ribbon <span class="pro_version_info">(' . __("Pro Version", 'ARPricelite') . ')</span>'),
                    'arp_template_ribbons' => array(
                        'arplitetemplate_1' => array('arp_ribbon_1', 'arp_ribbon_2', 'arp_ribbon_3', 'arp_ribbon_4', 'arp_ribbon_6', 'arp_ribbon_6'),
                        'arplitetemplate_8' => array('arp_ribbon_1', 'arp_ribbon_2', 'arp_ribbon_3', 'arp_ribbon_4', 'arp_ribbon_5', 'arp_ribbon_6'),
                        'arplitetemplate_11' => array('arp_ribbon_1', 'arp_ribbon_2', 'arp_ribbon_3', 'arp_ribbon_4', 'arp_ribbon_6'),
                        'arplitetemplate_26' => array('arp_ribbon_1', 'arp_ribbon_2', 'arp_ribbon_3', 'arp_ribbon_4', 'arp_ribbon_6'),
                    ),
                    'arp_tablet_view_width' => array(
                        'arplitetemplate_1' => '19.5',
                        'arplitetemplate_8' => '23',
                        'arplitetemplate_11' => '23',
                        'arplitetemplate_26' => '23',
                    )
                ),
                'arp_basic_colors' => array('#ff7525', '#ffcf33', '#e3e500', '#00d2d7', '#4fe3fe', '#ff67b4', '#c96098', '#ff1515', '#ffcea6', '#ffc22f', '#dbd423', '#0bc124', '#00e430', '#00a9ff', '#a1bed6', '#006be1', '#90d73d', '#00825f', '#04d2ab', '#ff5c77', '#6951ff', '#ac3f07', '#b5fe01', '#666666', '#ffe217', '#5d9cec', '#bbea8a', '#496b90', '#9943d8', '#d6a153', '#bd0101', '#0385a0', '#45487d', '#8d5d17', '#f2f2f2', '#514e4e'),
                'arp_basic_colors_gradient' => array('#d24c00', '#c99a00', '#8aa301', '#00a5a9', '#46aec1', '#ce0f70', '#7b164c', '#c80202', '#d47f46', '#f48a00', '#876705', '#006400', '#00951f', '#0182c4', '#5f7c97', '#003a7a', '#145502', '#003f32', '#16a086', '#a0132a', '#2105cc', '#5e1d0b', '#699001', '#3c3c3c', '#c09505', '#3a72b9', '#699f2f', '#1e2a36', '#531084', '#8f6229', '#590101', '#02414e', '#151845', '#633b00', '#c0c0c0', '#0c0b0b'),
                'arp_ribbon_border_color' => array('#f1732b', '#f1732b', '#a0b419', '#00b3b8', '#33a0b4', '#dc2783', '#a33c73', '#ff1515', '#ed9e67', '#ed9e67', '#b3a015', '#07a318', '#00af25', '#0095e0', '#809cb6', '#0052ab', '#559921', '#003f32', '#14a68a', '#d73b54', '#472de7', '#7f2b09', '#8dc401', '#4e4e4e', '#d3ac07', '#4680ca', '#7cb144', '#2b3e52', '#6d23a4', '#aa7a39', '#650101', '#035a6d', '#272a5a', '#714608', '#b5b5b5', '#1a1818'),
                'fontoption' => array(
                    'header_fonts' => array('font_family' => 'Arial', 'font_size' => '32', 'font_color' => '#ffffff', 'font_style' => 'normal'),
                    'price_fonts' => array('font_family' => 'Arial', 'font_size' => '16', 'font_color' => '#ffffff', 'font_style' => 'normal'),
                    'price_text_fonts' => array('font_family' => 'Arial', 'font_size' => '16', 'font_color' => '#ffffff', 'font_style' => 'normal'),
                    'content_fonts' => array('font_family' => 'Arial', 'font_size' => '12', 'font_color' => '#364762', 'font_style' => 'bold'),
                    'button_fonts' => array('font_family' => 'Arial', 'font_size' => '14', 'font_color' => '#ffffff', 'font_style' => 'bold')
                ),
                'column_animation' => array(
                    'is_enable' => 0,
                    'visible_column_count' => 2,
                    'columns_to_scroll' => 2,
                    'is_navigation' => 1,
                    'autoplay' => 1,
                    'sliding_effect' => array('slide', 'fade', 'crossfade', 'directscroll', 'cover', 'uncover'),
                    'sliding_transition_speed' => 750,
                    'navigation_style' => array('arp_nav_style_1', 'arp_nav_style_2'),
                    'pagination' => 1,
                    'pagination_style' => array('arp_paging_style_1', 'arp_paging_style_2'),
                    'pagination_position' => array('Top', 'Bottom', 'Both'),
                    'easing_effect' => array('swing', 'linear', 'cubic', 'elastic', 'quadratic'),
                    'infinite' => 1,
                    'sticky_caption' => 0,
                    'pagi_nav_btns' => array('pagination_top' => 'Top', 'pagination_bottom' => 'Bottom', 'none' => 'Off'),
                    'navi_nav_btns' => array('navigation' => 'On', 'none' => 'Off'),
                    'def_pagin_nav' => 'both'
                /* 'hide_caption' => 1, */
                ),
                'is_spacebetweencolumns' => 'no',
                'spacebetweencolumns' => '0px',
                'tooltipsetting' => array(
                    'width' => '',
                    'background_color' => '#000000',
                    'text_color' => '#FFFFFF',
                    'animation' => array('grow', 'fade', 'swing', 'slide', 'fall'),
                    'position' => array('top', 'bottom', 'left', 'right'),
                    'style' => array('normal', 'alert', 'glass'/* ,'drop' */),
                    'trigger_on' => array('hover', 'click'),
                    'tooltip_display_style' => array('default', 'informative'),
                    'informative_tootip_icon' => array('<i class="fa fa-info-circle fa-tp"></i>'),
                ),
                'is_responsive' => 1,
                'hide_caption_column' => 0,
                'highlightcolumnonhover' => array(
                    'hover_effect' => 'Hover Effect',
                    'shadow_effect' => 'Shadow effect',
                    'arp-pulse' => 'Pulse',
                    'arp-shake' => 'Shake',
                    'arp-swing' => 'Swing',
                    'arp-bob' => 'Bob',
                    'arp-hang' => 'Hang',
                    'arp-wobble-horizontal' => 'Wobble',
                    'no_effect' => 'None'
                ),
                'button_settings' => array(
                    'button_shadow_color' => '#FFFFFF',
                    'button_radius' => 0
                ),
                'column_opacity' => array(1, 0.90, 0.80, 0.70, 0.60, 0.50, 0.40, 0.30, 0.20, 0.10),
                'wrapper_width' => '1000',
                'wrapper_width_style' => array('px', '%'),
                'default_column_radius_value' => array(
                    'arplitetemplate_1' => array('top_left' => 0, 'top_right' => 0, 'bottom_right' => 0, 'bottom_left' => 0),
                    'arplitetemplate_8' => array('top_left' => 0, 'top_right' => 0, 'bottom_right' => 0, 'bottom_left' => 0),
                    'arplitetemplate_11' => array('top_left' => 0, 'top_right' => 0, 'bottom_right' => 0, 'bottom_left' => 0),
                    'arplitetemplate_26' => array('top_left' => 15, 'top_right' => 15, 'bottom_right' => 15, 'bottom_left' => 15),
                ),
                'footer_content_position' => array('Below Button', 'Above Button'),
                'column_box_shadow_effect' => array('shadow_style_none' => 'None', 'shadow_style_1' => 'Style1', 'shadow_style_2' => 'Style2', 'shadow_style_3' => 'Style3', 'shadow_style_4' => 'Style4', 'shadow_style_5' => 'Style5'),
                'arp_color_skin_template_types' => array(
                    'type_1' => array('arplitetemplate_1', 'arplitetemplate_8', 'arplitetemplate_26'),
                    'type_2' => array('arplitetemplate_11'),
                    'type_3' => array(),
                    'type_4' => array()
                ),
                'template_bg_section_classes' => array(
                    'arplitetemplate_1' => array(
                        'caption_column' => array(
                            'column_section' => '.arp_column_content_wrapper',
                            'header_section' => 'arpcaptiontitle',
                            'footer_section' => 'arpcolumnfooter',
                            'body_section' => array(
                                'odd_row' => 'arp_odd_row',
                                'even_row' => 'arp_even_row'
                            )
                        ),
                        'other_column' => array(
                            'column_section' => '.arp_column_content_wrapper',
                            'header_section' => 'arppricetablecolumntitle',
                            'pricing_section' => 'arppricetablecolumnprice',
                            'button_section' => 'bestPlanButton',
                            'footer_section' => 'arpcolumnfooter',
                            'body_section' => array(
                                'odd_row' => 'arp_odd_row',
                                'even_row' => 'arp_even_row'
                            )
                        )
                    ),
                    'arplitetemplate_8' => array('caption_column' => array(
                            'footer_section' => 'arpcolumnfooter',
                            'body_section' => array(
                                'odd_row' => 'arp_odd_row',
                                'even_row' => 'arp_even_row'
                            ),
                         'column_section' => '.arp_column_content_wrapper',
                        
                        ),
                        'other_column' => array(
                            'header_section' => 'arpcolumnheader',
                            //'pricing_section' => 'arppricetablecolumnprice',
                            'button_section' => 'bestPlanButton',
                            'body_section' => array(
                                'odd_row' => 'arp_odd_row',
                                'even_row' => 'arp_even_row'
                            ),
                              'column_section' => '.arp_column_content_wrapper',
                        ),
                       
                    ),
                    'arplitetemplate_11' => array(
                        'caption_columns' => array(),
                        'other_column' => array(
                             'column_section' => '.arp_column_content_wrapper',
                            'header_section' => 'arppricetablecolumntitle',
                            'desc_selection' => 'arppricetablecolumnprice',
                            'button_section' => 'bestPlanButton',
                            'body_section' => array(
                                'odd_row' => 'arp_odd_row',
                                'even_row' => 'arp_even_row'
                            )
                        ),
                    ),
                    'arplitetemplate_26' => array(
                        'caption_column' => array(),
                        'other_column' => array(
                            'header_section' => 'arppricetablecolumntitle,rounded_corder',
                            'column_section' => '.arp_column_content_wrapper',
                            'button_section' => 'bestPlanButton'
                        )
                    ),
                ),
                'template_border_color' => array(
                    'arplitetemplate_1' => array(
                        'caption_column' => array(
                            'border_color' => '#E3E3E3',
                        ),
                    ),
                ),
            )
        ));
        return $arpoptionsarr;
    }

    /* Setting Default Options */

    function arp_columnoptions() {
        $arptempbutoptionsarr = apply_filters('arplite_pricing_table_available_column_settings', array(
            'column_options' => array('width' => 'auto', 'alignment' => array('left', 'center', 'right'), 'column_highlight' => 0, 'show_column' => 1, 'ribbon_icon' => array(), 'ribbon_position' => array('left', 'right')),
            'header_options' => array(
                'column_title' => '',
                'price' => '',
                'html_content' => '',
                'html_shortcode_options' => array(
                    'image' => array('image' => __('Image', 'ARPricelite')),
                    'video' => array(
                        'youtube' => __('Youtube video', 'ARPricelite'),
                        'vimeo' => __('Vimeo Video', 'ARPricelite'),
                        'screenr' => __('Screenr Video', 'ARPricelite'),
                        'video' => __('html5 Video', 'ARPricelite'),
                        'dailymotion' => __('Dailymotion Video', 'ARPricelite'),
                        'metacafe' => __('Metacafe Video', 'ARPricelite'),
                    ),
                    'audio' => array(
                        'audio' => __('html5 Audio', 'ARPricelite'),
                        'soundcloud' => __('Soundcloud Audio', 'ARPricelite'),
                        'mixcloud' => __('Mixcloud Audio', 'ARPricelite'),
                        'beatport' => __('Beatport Audio', 'ARPricelite'),
                    ),
                    'other' => array(
                        'googlemap' => __('Google Map', 'ARPricelite'),
                        'embed' => __('Embed Block', 'ARPricelite'),
                    ),
                ),
                'image_shortcode_options' => array(
                    'url' => __('Image URL', 'ARPricelite'),
                    'height' => __('Height', 'ARPricelite'),
                    'width' => __('Width', 'ARPricelite'),
                ),
                'youtube_shortcode_options' => array(
                    'id' => __('Video id', 'ARPricelite'),
                    'height' => __('Height', 'ARPricelite'),
                    'autoplay' => __('Autoplay', 'ARPricelite'),
                ),
                'vimeo_shortcode_options' => array(
                    'id' => __('Video id', 'ARPricelite'),
                    'height' => __('Height', 'ARPricelite'),
                    'autoplay' => __('Autoplay', 'ARPricelite'),
                ),
                'screenr_shortcode_options' => array(
                    'id' => __('Video id', 'ARPricelite'),
                    'height' => __('Height', 'ARPricelite'),
                ),
                'video_shortcode_options' => array(
                    'mp4' => __('MP4 source', 'ARPricelite'),
                    'webm' => __('Webm source', 'ARPricelite'),
                    'ogg' => __('Ogg source', 'ARPricelite'),
                    'poster' => __('Poster image source', 'ARPricelite'),
                    'autoplay' => __('Autoplay', 'ARPricelite'),
                    'loop' => __('Loop', 'ARPricelite'),
                ),
                'audio_shortcode_options' => array(
                    'autoplay' => __('Autoplay', 'ARPricelite'),
                    'loop' => __('Loop', 'ARPricelite'),
                    'mp3' => __('MP3 source', 'ARPricelite'),
                    'ogg' => __('Ogg source', 'ARPricelite'),
                    'wav' => __('Wav source', 'ARPricelite'),
                ),
                'googlemap_shortcode_options' => array(
                    'address' => __('Address', 'ARPricelite'),
                    'height' => __('Height', 'ARPricelite'),
                    'zoom_level' => __('Zoom level', 'ARPricelite'),
                    'marker_image' => __('Marker image source', 'ARPricelite'),
                    'mapinfo_title' => __('Marker title', 'ARPricelite'),
                    'mapinfo_content' => __('Map info window content', 'ARPricelite'),
                    'mapinfo_show_default' => __('Info window by default?', 'ARPricelite'),
                ),
                'dailymotion_shortcode_options' => array(
                    'id' => __('Video id', 'ARPricelite'),
                    'height' => __('Height', 'ARPricelite'),
                    'autoplay' => __('Autoplay', 'ARPricelite'),
                ),
                'metacafe_shortcode_options' => array(
                    'id' => __('Video id', 'ARPricelite'),
                    'height' => __('Height', 'ARPricelite'),
                    'autoplay' => __('Autoplay', 'ARPricelite'),
                ),
                'soundcloud_shortcode_options' => array(
                    'id' => __('Track id', 'ARPricelite'),
                    'height' => __('Height', 'ARPricelite'),
                    'autoplay' => __('Autoplay', 'ARPricelite'),
                ),
                'mixcloud_shortcode_options' => array(
                    'url' => __('Track url', 'ARPricelite'),
                    'height' => __('Height', 'ARPricelite'),
                    'autoplay' => __('Autoplay', 'ARPricelite'),
                ),
                'beatport_shortcode_options' => array(
                    'id' => __('Track id', 'ARPricelite'),
                    'height' => __('Height', 'ARPricelite'),
                    'autoplay' => __('Autoplay', 'ARPricelite'),
                ),
                'embed_shortcode_options' => array(
                    'id' => __('Embed', 'ARPricelite'),
                /* 'height' 	=> __('Height', 'ARPricelite') */
                ),
            ),
            'column_body_options' => array('body_description' => '', 'description_shortcode_options' => array('icons', 'icon_alignment'), 'icon_shortcode_options' => array(), 'description_alignment' => 'center', 'tooltip_text' => ''),
            'column_button_options' => array(
                'button_size' => array(
                    'small' => __('Small', 'ARPricelite'),
                    'medium' => __('Medium', 'ARPricelite'),
                    'large' => __('Large', 'ARPricelite'),
                ),
                'button_type' => array(
                    'button' => __('Button', 'ARPricelite'),
                    'submit_button' => __('Submit', 'ARPricelite'),
                ),
                'button_text' => '',
                'button_icon' => array(),
                'button_link' => '',
                'open_link_in_new_window' => '0',
                'button_custom_image' => ''
            ),
        ));

        return $arptempbutoptionsarr;
    }

    /* Setting Template Button Options for Pricing table */

    function arp_tempbuttonsoptions() {
        $rpttempbutoptionsarr = apply_filters('arplite_pricing_table_available_column_button_settings', array(
            'template_button_options' => array(
                'features' => array(
                    'arplitetemplate_1' => array('column_level_options' => array('caption_column_buttons' => array(
                                'column_level_options__button_1' => array('column_width', 'set_hidden', 'caption_border', 'caption_row_border', 'column_level_caption_arp_ok_div__button_1'),
                                'column_level_options__button_2' => array('arp_custom_color_tab_column', 'arp_normal_custom_color_tab_column', 'arp_header_color_div', 'header_background_color_div', 'header_font_color_div', 'arp_header_hover_color_div', 'header_hover_background_color_div', 'header_hover_font_color_div', 'arp_footer_color_div', 'footer_background_color_div', 'footer_font_color_div', 'arp_body_background_color_div', 'arp_body_background_color_div_title', 'arp_odd_color_div', 'odd_background_color_div', 'odd_font_color_div', 'arp_even_color_div', 'even_background_color_div', 'even_font_color_div', 'arp_footer_hover_color_div', 'footer_hover_background_color_div', 'footer_hover_font_color_div', 'arp_body_hover_background_color_div', 'arp_body_hover_background_color_div_title', 'arp_odd_hover_color_div', 'odd_hover_background_color_div', 'odd_hover_font_color_div', 'arp_even_hover_color_div', 'even_hover_background_color_div', 'even_hover_font_color_div', 'column_level_other_arp_ok_div__button_2', 'arp_border_color_div', 'arp_border_color_div_sub', 'row_border_color_div', 'column_border_color_div')
                            ),
                            'other_columns_buttons' => array(
                                'column_level_options__button_1' => array(/* 'column_width', */ 'column_highlight', 'set_hidden', 'select_ribbon', 'is_post_variable', 'post_variables_content', 'column_level_other_arp_ok_div__button_1', 'is_column_clickable_wrapper', 'column_other_background_image'),
                                'column_level_options__button_2' => array('arp_custom_color_tab_column', 'arp_normal_custom_color_tab_column', 'arp_header_color_div', 'header_background_color_div', 'header_font_color_div', 'arp_header_hover_color_div', 'header_hover_background_color_div', 'header_hover_font_color_div', 'arp_price_color_div', 'price_background_color_div', 'price_font_color_div', 'arp_price_hover_color_div', 'price_hover_background_color_div', 'price_hover_font_color_div', 'arp_footer_color_div', 'footer_background_color_div', 'footer_font_color_div', 'arp_button_color_div', 'button_background_color_div', 'button_font_color_div', 'arp_body_background_color_div', 'arp_body_background_color_div_title', 'arp_odd_color_div', 'odd_background_color_div', 'odd_font_color_div', 'arp_even_color_div', 'even_background_color_div', 'even_font_color_div', 'arp_footer_hover_color_div', 'footer_hover_background_color_div', 'footer_hover_font_color_div', 'arp_hover_button_color_div', 'button_hover_background_color_div', 'button_hover_font_color_div', 'arp_body_hover_background_color_div', 'arp_body_hover_background_color_div_title', 'arp_odd_hover_color_div', 'odd_hover_background_color_div', 'odd_hover_font_color_div', 'arp_even_hover_color_div', 'even_hover_background_color_div', 'even_hover_font_color_div', 'column_level_other_arp_ok_div__button_2'),
                            ),
                        ),
                        'header_level_options' => array('caption_column_buttons' => array(
                                'header_level_options__button_1' => array('column_title', 'header_text_alignment', 'header_caption_font_family', 'header_caption_font_size', 'header_caption_font_style', 'arp_object', 'header_caption_font_color', 'arp_fontawesome', 'header_level_caption_arp_ok_div__button_1'),
                            ),
                            'other_columns_buttons' => array(
                                'header_level_options__button_1' => array('column_title', 'arp_object', 'arp_fontawesome', 'header_level_other_arp_ok_div__button_1'),
                            ),
                        ),
                        'pricing_level_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(
                                'pricing_level_options__button_1' => array('price_text', 'arp_fontawesome', 'pricing_level_other_arp_ok_div__button_1'),
                            ),
                        ),
                        'body_level_options' => array('caption_column_buttons' => array(
                                'body_level_options__button_1' => array('text_alignment', 'body_li_caption_font_family', 'body_li_caption_font_size', 'body_li_caption_font_style', 'body_level_caption_arp_ok_div__button_1'),
                            ),
                            'other_columns_buttons' => array(),
                        ),
                        'body_li_level_options' => array('caption_column_buttons' => array(
                                'body_li_level_options__button_1' => array('body_li_add_shortcode', 'arp_object', 'description', 'body_li_level_caption_arp_ok_div__button_1'),
                                'body_li_level_options__button_2' => array('tooltip', 'arp_fontawesome', 'body_li_level_caption_arp_ok_div__button_2'),
                            ),
                            'other_columns_buttons' => array(
                                'body_li_level_options__button_1' => array('body_li_add_shortcode', 'arp_object', 'description', 'body_li_level_other_arp_ok_div__button_1'),
                                'body_li_level_options__button_2' => array('tooltip', 'arp_fontawesome', 'body_li_level_other_arp_ok_div__button_2'),
                            ),
                        ),
                        'button_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(
                                'button_options__button_1' => array('button_text', 'add_icon', 'button_size', 'button_options_other_arp_ok_div__button_1'),
                                'button_options__button_2' => array('button_image', 'add_shortcode', 'button_options_other_arp_ok_div__button_2'),
                                'button_options__button_3' => array('redirect_link', 'open_in_new_window', 'external_btn', 'button_options_other_arp_ok_div__button_3'),
                            ),
                        ),
                        'footer_level_options' =>
                        array('caption_column_buttons' => array('footer_level_options__button_1' => array('footer_text', 'footer_text_alignment', 'footer_level_options_font_family', 'footer_level_options_font_size', 'footer_level_options_font_style', 'footer_level_options_arp_ok_div__button_1'),
                            ),
                            'other_columns_buttons' => array(
                                'footer_level_options__button_1' => array('footer_text', 'above_below_button', 'footer_level_options_arp_ok_div__button_1'),
                                'footer_level_options__button_2' => array('button_text', 'add_icon', 'button_size', 'button_options_other_arp_ok_div__button_1'),
                                'footer_level_options__button_3' => array('button_image', 'add_shortcode', 'button_options_other_arp_ok_div__button_2'),
                                'footer_level_options__button_4' => array('redirect_link', 'open_in_new_window', 'open_in_new_window_actual', 'external_btn', 'button_options_other_arp_ok_div__button_3', 'hide_default_btn',),
                            ),
                        ),
                    ),
                    'arplitetemplate_8' => array('column_level_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(
                                'column_level_options__button_1' => array('column_highlight', 'set_hidden', 'select_ribbon', 'is_post_variable', 'post_variables_content', 'column_level_other_arp_ok_div__button_1', 'is_column_clickable_wrapper', 'column_other_background_image'),
                                'column_level_options__button_2' => array('arp_custom_color_tab_column', 'arp_normal_custom_color_tab_column', 'arp_header_color_div', 'header_background_color_div', 'header_font_color_div', 'arp_header_hover_color_div', 'header_hover_background_color_div', 'header_hover_font_color_div', 'arp_price_color_div', 'price_font_color_div', 'arp_price_hover_color_div', 'price_hover_font_color_div', 'arp_button_color_div', 'button_background_color_div', 'button_font_color_div', 'arp_body_background_color_div', 'arp_body_background_color_div_title', 'arp_odd_color_div', 'odd_background_color_div', 'odd_font_color_div', 'arp_even_color_div', 'even_background_color_div', 'even_font_color_div', 'arp_hover_button_color_div', 'button_hover_background_color_div', 'button_hover_font_color_div', 'arp_body_hover_background_color_div', 'arp_body_hover_background_color_div_title', 'arp_odd_hover_color_div', 'odd_hover_background_color_div', 'odd_hover_font_color_div', 'arp_even_hover_color_div', 'even_hover_background_color_div', 'even_hover_font_color_div', 'arp_shortcode_div', 'arp_shortcode_background', 'arp_shortcode_font_color', 'arp_shortcode_hover_div', 'arp_shortcode_hover_background', 'arp_shortcode_hover_font_color', 'column_level_other_arp_ok_div__button_2'),
                            ),
                        ),
                        'header_level_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(
                                'header_level_options__button_1' => array('column_title', 'arp_fontawesome', 'header_level_other_arp_ok_div__button_1'),
                                'header_level_options__button_3' => array('additional_shortcode', 'arp_object', 'arp_fontawesome', 'arp_shortcode_customization_style_div', 'arp_shortcode_customization_size_div', 'header_level_other_arp_ok_div__button_3'),
                            ),
                        ),
                        'pricing_level_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(
                                'pricing_level_options__button_1' => array('price_text', 'arp_fontawesome', 'pricing_level_other_arp_ok_div__button_1'),
                            ),
                        ),
                        'body_level_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(
                                'body_level_options__button_1' => array(),
                                'body_level_options__button_2' => array(),
                            ),
                        ),
                        'body_li_level_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(
                                'body_li_level_options__button_1' => array('body_li_add_shortcode', 'arp_object', 'description', 'body_li_level_other_arp_ok_div__button_1'),
                                'body_li_level_options__button_2' => array('tooltip', 'arp_fontawesome', 'body_li_level_other_arp_ok_div__button_2'),
                            ),
                        ),
                        'button_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(
                                'button_options__button_1' => array('button_text', 'add_icon', 'button_options_other_arp_ok_div__button_1'),
                                'button_options__button_2' => array('button_image', 'add_shortcode', 'button_options_other_arp_ok_div__button_2'),
                                'button_options__button_3' => array('redirect_link', 'open_in_new_window', 'external_btn', 'button_options_other_arp_ok_div__button_3'),
                            ),
                        ),
                        'footer_level_options' =>
                        array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(
                                'footer_level_options__button_2' => array('button_text', 'add_icon', 'button_size', 'button_options_other_arp_ok_div__button_1'),
                                'footer_level_options__button_3' => array('button_image', 'add_shortcode', 'button_options_other_arp_ok_div__button_2'),
                                'footer_level_options__button_4' => array('redirect_link', 'open_in_new_window', 'open_in_new_window_actual', 'external_btn', 'button_options_other_arp_ok_div__button_3', 'hide_default_btn',),
                            ),
                        ),
                    ),
                    'arplitetemplate_11' => array('column_level_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(
                                'column_level_options__button_1' => array(/* 'column_width', */ 'column_highlight', 'set_hidden', 'select_ribbon', 'is_post_variable', 'post_variables_content', 'column_level_other_arp_ok_div__button_1', 'is_column_clickable_wrapper', 'column_other_background_image'),
                                'column_level_options__button_2' => array('arp_custom_color_tab_column', 'arp_normal_custom_color_tab_column', 'arp_header_color_div', 'header_background_color_div', 'header_font_color_div', 'arp_header_hover_color_div', 'header_hover_background_color_div', 'header_hover_font_color_div', 'arp_price_color_div', 'price_font_color_div', 'arp_price_hover_color_div', 'price_hover_font_color_div', 'arp_button_color_div', 'button_background_color_div', 'button_font_color_div', 'arp_body_background_color_div', 'arp_body_background_color_div_title', 'arp_odd_color_div', 'odd_background_color_div', 'odd_font_color_div', 'arp_even_color_div', 'even_background_color_div', 'even_font_color_div', 'arp_hover_button_color_div', 'button_hover_background_color_div', 'button_hover_font_color_div', 'arp_body_hover_background_color_div', 'arp_body_hover_background_color_div_title', 'arp_odd_hover_color_div', 'odd_hover_background_color_div', 'odd_hover_font_color_div', 'arp_even_hover_color_div', 'even_hover_background_color_div', 'even_hover_font_color_div', 'arp_desc_color_div', 'desc_background_color_div', 'desc_font_color_div', 'arp_desc_hover_color_div', 'desc_hover_background_color_div', 'desc_hover_font_color_div', 'column_level_other_arp_ok_div__button_2'),
                            ),
                        ),
                        'header_level_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(
                                'header_level_options__button_1' => array('column_title', 'arp_object', 'arp_fontawesome', 'header_level_other_arp_ok_div__button_1'),
                            ),
                        ),
                        'pricing_level_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(
                                'pricing_level_options__button_1' => array('price_text', 'arp_fontawesome', 'pricing_level_other_arp_ok_div__button_1'),
                            ),
                        ),
                        'body_level_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(),
                        ),
                        'body_li_level_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(
                                'body_li_level_options__button_1' => array('body_li_add_shortcode', 'arp_object', 'description', 'body_li_level_other_arp_ok_div__button_1'),
                                'body_li_level_options__button_2' => array('tooltip', 'arp_fontawesome', 'body_li_level_other_arp_ok_div__button_2'),
                            ),
                        ),
                        'button_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(
                                'button_options__button_1' => array('button_text', 'add_icon', 'button_size', 'button_options_other_arp_ok_div__button_1'),
                                'button_options__button_2' => array('button_image', 'add_shortcode', 'button_options_other_arp_ok_div__button_2'),
                                'button_options__button_3' => array('redirect_link', 'open_in_new_window', 'external_btn', 'button_options_other_arp_ok_div__button_3'),
                            ),
                        ),
                        'column_description_level' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(
                                'column_description_level__button_1' => array('column_description', 'arp_fontawesome', 'column_description_level_other_arp_ok_div__button_1'),
                            ),
                        ),
                        'footer_level_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(
                                'footer_level_options__button_2' => array('button_text', 'add_icon', 'button_size', 'button_options_other_arp_ok_div__button_1'),
                                'footer_level_options__button_3' => array('button_image', 'add_shortcode', 'button_options_other_arp_ok_div__button_2'),
                                'footer_level_options__button_4' => array('redirect_link', 'open_in_new_window', 'open_in_new_window_actual', 'external_btn', 'button_options_other_arp_ok_div__button_3', 'hide_default_btn',),
                            ),
                        ),
                    ),
                    'arplitetemplate_26' => array('column_level_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(
                                'column_level_options__button_1' => array('column_highlight', 'set_hidden', 'column_background', 'column_hover_background', 'select_ribbon', 'is_post_variable', 'post_variables_content', 'column_level_other_arp_ok_div__button_1', 'is_column_clickable_wrapper', 'column_other_background_image'),
                                'column_level_options__button_2' => array('arp_custom_color_tab_column', 'arp_normal_custom_color_tab_column', 'arp_header_color_div', 'header_background_color_div', 'header_font_color_div', 'arp_header_hover_color_div', 'header_hover_background_color_div', 'header_hover_font_color_div', 'arp_body_background_color_div', 'arp_body_background_color_div_title', 'arp_odd_color_div', 'odd_font_color_div', 'arp_even_color_div', 'even_font_color_div', 'arp_body_hover_background_color_div', 'arp_body_hover_background_color_div_title', 'arp_odd_hover_color_div', 'odd_hover_font_color_div', 'arp_even_hover_color_div', 'even_hover_font_color_div', 'arp_column_color_div', 'column_background_color_div', 'arp_column_hover_color_div_column', 'column_hover_background_color_div', 'arp_button_color_div', 'button_background_color_div', 'button_font_color_div', 'button_hover_background_color_div', 'button_hover_font_color_div', 'arp_hover_button_color_div', 'arp_shortcode_div', 'arp_shortcode_background', 'arp_shortcode_font_color', 'arp_shortcode_hover_div', 'arp_shortcode_hover_background', 'arp_shortcode_hover_font_color', 'column_level_other_arp_ok_div__button_2'),
                            ),
                        ),
                        'header_level_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(
                                'header_level_options__button_1' => array('column_title', 'arp_fontawesome', 'header_level_other_arp_ok_div__button_1'),
                                'header_level_options__button_3' => array('additional_shortcode', 'arp_object', 'arp_fontawesome', 'arp_shortcode_customization_style_div', 'arp_shortcode_customization_size_div', 'header_level_other_arp_ok_div__button_3'),
                            ),
                        ),
                        'pricing_level_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(),
                        ),
                        'body_level_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(),
                        ),
                        'body_li_level_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(
                                'body_li_level_options__button_1' => array('body_li_add_shortcode', 'arp_object', 'description', 'body_li_level_other_arp_ok_div__button_1'),
                                'body_li_level_options__button_2' => array('tooltip', 'arp_fontawesome', 'body_li_level_other_arp_ok_div__button_2'),
                            ),
                        ),
                        'button_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(
                                'button_options__button_1' => array('button_text', 'add_icon', 'button_size', 'button_options_other_arp_ok_div__button_1'),
                                'button_options__button_2' => array('button_image', 'add_shortcode', 'button_options_other_arp_ok_div__button_2'),
                                'button_options__button_3' => array('redirect_link', 'open_in_new_window', 'open_in_new_window_actual', 'external_btn', 'hide_default_btn', 'button_options_other_arp_ok_div__button_3'),
                            ),
                        ),
                        'footer_level_options' => array('caption_column_buttons' => array(),
                            'other_columns_buttons' => array(
                                'footer_level_options__button_2' => array('button_text', 'add_icon', 'button_options_other_arp_ok_div__button_1'),
                                'footer_level_options__button_3' => array('button_image', 'add_shortcode', 'button_options_other_arp_ok_div__button_2'),
                                'footer_level_options__button_4' => array('redirect_link', 'open_in_new_window', 'open_in_new_window_actual', 'external_btn', 'hide_default_btn', 'button_options_other_arp_ok_div__button_3', 'hide_default_btn',),
                            ),
                        ),
                    )
                ),
            )
        ));
        return $rpttempbutoptionsarr;
    }

    function set_css() {
        global $arpricelite_version;
        wp_register_style('arplite_admin_css', ARPLITE_PRICINGTABLE_URL . '/css/arprice_admin.css', array(), $arpricelite_version);

        wp_register_style('arplite_fontawesome_css', ARPLITE_PRICINGTABLE_URL . '/css/font-awesome.css', array(), $arpricelite_version);

        wp_register_style('arplite_tooltip_css', ARPLITE_PRICINGTABLE_URL . '/css/tipso.min.css', array(), $arpricelite_version);

        wp_register_style('arplite_font_css_admin', ARPLITE_PRICINGTABLE_URL . '/fonts/arp_fonts.css', array(), $arpricelite_version);

        wp_register_style('arplite_bootstrap_tour_css', ARPLITE_PRICINGTABLE_URL . '/css/bootstrap-tour-standalone.css', array(), $arpricelite_version);

        if (isset($_REQUEST['page']) && ( $_REQUEST['page'] == 'arpricelite' || $_REQUEST['page'] == 'arplite_add_pricing_table' || $_REQUEST['page'] == 'arp_analytics' || $_REQUEST['page'] == 'arplite_import_export' || $_REQUEST['page'] == 'arplite_global_settings' || $_REQUEST['page'] == 'arplite_upgrade_to_premium' )) {
            if (version_compare($GLOBALS['wp_version'], '3.7', '>')) {
                wp_enqueue_style('arplite_admin_css_3.8', ARPLITE_PRICINGTABLE_URL . '/css/arprice_admin_3.8.css', array(), $arpricelite_version);
            }

            wp_enqueue_style('arplite_admin_css');


            if ($_REQUEST['page'] != 'arplite_global_settings' && $_REQUEST['page'] != 'arplite_import_export') {

                wp_enqueue_style('arplite_fontawesome_css');

                wp_enqueue_style('arplite_bootstrap_tour_css');
            }



            if (isset($_REQUEST['page']) and $_REQUEST['page'] == 'arpricelite') {
                wp_enqueue_style('arplite_tooltip_css');
            }
        }
    }

    /* Setting Frond CSS */

    function set_front_css() {
        global $arpricelite_version;
        if (!is_admin()) {
            /* Common CSS */
            wp_register_style('arplite_front_css', ARPLITE_PRICINGTABLE_URL . '/css/arprice_front.css', array(), $arpricelite_version);

            /* Font Awesome CSS */
            wp_register_style('arplite_fontawesome_css', ARPLITE_PRICINGTABLE_URL . '/css/font-awesome.css', array(), $arpricelite_version);

            /* Font CSS */
            wp_register_style('arplite_font_css_front', ARPLITE_PRICINGTABLE_URL . '/fonts/arp_fonts.css', array(), $arpricelite_version);
        }
    }

    function arplite_front_assets() {
        $arp_load_js_css = get_option('arplite_load_js_css');
        if (isset($arp_load_js_css) && $arp_load_js_css == 'arplite_load_js_css') {

            wp_enqueue_script('arplite_front_js');

            wp_enqueue_style('arplite_front_css');

            wp_enqueue_style('arplite_fontawesome_css');

            wp_enqueue_style('arplite_font_css_front');
        }
    }

    /* Setting CSS as per Selected Template */

    function arplite_enqueue_template_css() {

        global $post, $arpricelite_form, $arpricelite_version;

        $upload_main_url = ARPLITE_PRICINGTABLE_UPLOAD_URL . '/css';

        $post_content = isset($post->post_content) ? $post->post_content : '';
        $parts = @explode("[ARPLite", $post_content);
        if (is_array($parts) && key_exists(1, $parts)) {
            $myidpart = @explode("id=", $parts[1]);
            if (is_array($myidpart) && key_exists(1, $myidpart)) {
                $myid = @explode("]", $myidpart[1]);
            }
        }

        if (!is_admin()) {
            global $wp_query;
            $posts = $wp_query->posts;
            $pattern = '\[(\[?)(ARPLite)(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*+(?:\[(?!\/\2\])[^\[]*+)*+)\[\/\2\])?)(\]?)';
            $frm_ids = array();
            if (is_array($posts)) {

                foreach ($posts as $post) {
                    if (preg_match_all('/' . $pattern . '/s', $post->post_content, $matches) && array_key_exists(2, $matches) && in_array('ARPLite', $matches[2])) {
                        $frm_ids[] = $matches;
                        //break;	
                    }
                }

                $formids = array();
                if (is_array($frm_ids) && count($frm_ids) > 0) {

                    foreach ($frm_ids as $mat) {

                        if (is_array($mat) and count($mat) > 0) {
                            foreach ($mat as $k => $v) {

                                foreach ($v as $key => $val) {
                                    $parts = explode("id=", $val);
                                    if ($parts > 0 && isset($parts[1])) {

                                        if (stripos(@$parts[1], ']') !== false) {
                                            $partsnew = explode("]", $parts[1]);
                                            $formids[] = $partsnew[0];
                                        } else if (stripos(@$parts[1], ' ') !== false) {

                                            $partsnew = explode(" ", $parts[1]);
                                            $formids[] = $partsnew[0];
                                        } else {
                                            
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            $newvalarr = array();

            if (isset($formids) and is_array($formids) && count($formids) > 0) {
                foreach ($formids as $newkey => $newval) {
                    $newval = str_replace('"', '', $newval);
                    $newval = str_replace("'", "", $newval);
                    if (stripos($newval, ' ') !== false) {
                        $partsnew = explode(" ", $newval);
                        $newvalarr[] = $partsnew[0];
                    } else
                        $newvalarr[] = $newval;
                }
            }

            if ($newvalarr)
                $newvalues_enqueue = $arpricelite_form->get_table_enqueue_data($newvalarr);

            if (isset($newvalues_enqueue) && is_array($newvalues_enqueue) && count($newvalues_enqueue) > 0) {
                $to_google_map = 0;
                $templates = array();
                $is_template = 0;

                foreach ($newvalues_enqueue as $n => $newqnqueue) {
                    if ($newqnqueue['googlemap'])
                        $to_google_map = 1;

                    //$templates[] = $newqnqueue['template']; 
                    if ($newqnqueue['template_name'] != 0) {
                        $templates[] = $newqnqueue['template_name'];
                    } else {
                        $templates[] = $n;
                    }

                    if (!empty($newqnqueue['is_template'])) {
                        $is_template = $newqnqueue['is_template'];
                    }
                }

                $templates = array_unique($templates);


                if ($templates) {
                    wp_enqueue_script('arplite_front_js');

                    wp_enqueue_style('arplite_front_css');

                    foreach ($newvalues_enqueue as $template_id => $newqnqueue) {
                        if (isset($newqnqueue['is_template']) && !empty($newqnqueue['is_template'])) {
                            wp_register_style('arplitetemplate_' . $newqnqueue['template_name'] . '_css', ARPLITE_PRICINGTABLE_URL . '/css/templates/arplitetemplate_' . $newqnqueue['template_name'] . '.css', array(), $arpricelite_version);
                            wp_enqueue_style('arplitetemplate_' . $newqnqueue['template_name'] . '_css');
                        } else {

                            wp_register_style('arplitetemplate_' . $template_id . '_css', ARPLITE_PRICINGTABLE_UPLOAD_URL . '/css/arplitetemplate_' . $template_id . '.css', array(), $arpricelite_version);
                            wp_enqueue_style('arplitetemplate_' . $template_id . '_css');
                        }
                    }
                }
            }
        }
    }

    /* Setting Front Side JavaScript */

    function set_front_js() {
        global $arpricelite_version;
        if (!is_admin()) {
            // Setting jQuery
            wp_enqueue_script('jquery');

            // Common JS
            wp_register_script('arplite_front_js', ARPLITE_PRICINGTABLE_URL . '/js/arprice_front.js', array(), $arpricelite_version);

            wp_enqueue_script('jquery-ui-core');

            wp_enqueue_script('jquery-effects-slide');
        }
    }

    /* Setting Admin JavaScript */

    function set_js() {
        global $arpricelite_version, $pagenow;
        if ($pagenow == 'edit.php' || $pagenow == 'post.php' || $pagenow == 'post-new.php') {
            return;
        }
        wp_register_script('arplite_js', ARPLITE_PRICINGTABLE_URL . '/js/arprice.js', array(), $arpricelite_version);

        wp_register_script('arplite_sortable_resizable_js', ARPLITE_PRICINGTABLE_URL . '/js/arprice_sortable_resizable.js', array(), $arpricelite_version);

        wp_register_script('arplite_bpopup', ARPLITE_PRICINGTABLE_URL . '/js/jquery.bpopup.min.js', array(), $arpricelite_version);

        wp_register_script('arplite_tooltip', ARPLITE_PRICINGTABLE_URL . '/js/tipso.min.js', array(), $arpricelite_version);

        wp_register_script('arplite_jscolor', ARPLITE_PRICINGTABLE_URL . '/js/jscolor.js', array(), $arpricelite_version);

        wp_register_script('arplite_editor_js', ARPLITE_PRICINGTABLE_URL . '/js/arprice_editor.js', array(), $arpricelite_version);

        wp_register_script('arplite_html2canvas_js', ARPLITE_PRICINGTABLE_URL . '/js/html2canvas.js', array(), $arpricelite_version);

        wp_register_script('arplite_bootstrap_tour_js', ARPLITE_PRICINGTABLE_URL . '/js/bootstrap-tour-standalone.js', array(), $arpricelite_version);

        wp_register_script('arplite_tour_guide', ARPLITE_PRICINGTABLE_URL . '/js/arprice_tour_guide.js', array(), $arpricelite_version);

        wp_register_script('arplite_dashboard_js', ARPLITE_PRICINGTABLE_URL . '/js/arprice_dashboard.js');


        if (isset($_REQUEST['page']) && ( $_REQUEST['page'] == 'arpricelite' || $_REQUEST['page'] == 'arplite_add_pricing_table' || $_REQUEST['page'] == 'arplite_analytics' || $_REQUEST['page'] == 'arplite_import_export' || $_REQUEST['page'] == 'arplite_global_settings' ) && ($pagenow !== 'edit.php' && $pagenow !== 'post.php' && $pagenow !== 'post-new.php')) {

            wp_enqueue_script('jquery');

            if ($_REQUEST['page'] != 'arplite_import_export') {
                wp_enqueue_script('arplite_bpopup');
            }



            if (isset($_REQUEST['page']) and ( $_REQUEST['page'] == 'arpricelite' || $_REQUEST['page'] == 'arplite_global_settings')) {
                if ($_REQUEST['page'] == 'arpricelite' && isset($_REQUEST['arp_action'])) {
                    wp_enqueue_script('arplite_js');
                    wp_enqueue_script('arplite_sortable_resizable_js');
                    wp_enqueue_script('arplite_editor_js');
                    wp_enqueue_script('arplite_html2canvas_js');
                    wp_enqueue_script('jquery-ui-core');

                    wp_enqueue_script('jquery-effects-slide');

                    wp_enqueue_script('jquery-ui-sortable');

                    wp_enqueue_script('jquery-ui-slider');

                    wp_enqueue_script('media-upload');
                    wp_enqueue_script('arplite_jscolor');
                    wp_enqueue_script('sack');
                    
                    wp_enqueue_script('arplite_bootstrap_tour_js');
                    wp_enqueue_script('arplite_tour_guide');
                }


                if (($_REQUEST['page'] == 'arpricelite' && !isset($_REQUEST['arp_action'])) || $_REQUEST['page'] == 'arplite_global_settings') {
                    wp_enqueue_script('arplite_dashboard_js');
                    if ($_REQUEST['page'] == 'arpricelite' && @$_REQUEST['arp_action'] == '') {
                        wp_enqueue_script('arplite_bootstrap_tour_js');
                        wp_enqueue_script('arplite_tour_guide');
                    }
                }


                wp_enqueue_script('arplite_tooltip');
            }
        }
    }

    /* Setting Menu Position */

    function get_free_menu_position($start, $increment = 0.1) {
        foreach ($GLOBALS['menu'] as $key => $menu) {
            $menus_positions[] = floatval($key);
        }
        if (!in_array($start, $menus_positions)) {
            $start = strval($start);
            return $start;
        } else {
            $start += $increment;
        }
        /* the position is already reserved find the closet one */
        while (in_array($start, $menus_positions)) {
            $start += $increment;
        }
        $start = strval($start);
        return $start;
    }

    /* Setting Capabilities for user */

    function arp_capabilities() {
        $cap = array(
            'arplite_view_pricingtables' => __('View And Manage Arpricelite Pricing Tables', 'ARPricelite'),
            'arplite_add_udpate_pricingtables' => __('Add/Edit Arpricelite Pricing Tables', 'ARPricelite'),
            'arplite_analytics_pricingtables' => __('View Analytics of Arpricelite Pricing Tables', 'ARPricelite'),
            'arplite_import_export_pricingtables' => __('Import/Export Arpricelite Pricing Tables', 'ARPricelite'),
            'arplite_global_settings_pricingtables' => __('Global Settings Arpricelite Pricing Tables', 'ARPricelite'),
        );

        return $cap;
    }

    // Adding Pricing Table Menu
    function pricingtablelite_menu() {
        global $arplite_pricingtable;
        /*if (current_user_can('administrator')) {
            global $current_user;
            $arproles = $arplite_pricingtable->arp_capabilities();
            foreach ($arproles as $arprole => $arproledescription)
                $current_user->add_cap($arprole);

            unset($arproles);
            unset($arprole);
            unset($arproledescription);
        }*/

        $place = $arplite_pricingtable->get_free_menu_position(26.1, .1);

        // add custom role to these menu links

        add_menu_page('ARPricelite', 'ARPrice Lite', 'arplite_view_pricingtables', 'arpricelite', array(&$this, 'route'), ARPLITE_PRICINGTABLE_IMAGES_URL . '/pricing_table_icon.png', $place);

        add_submenu_page('arpricelite', __('Import/Export', 'ARPricelite'), __('Import/Export', 'ARPricelite'), 'arplite_import_export_pricingtables', 'arplite_import_export', array(&$this, 'route'));

        add_submenu_page('arpricelite', __('Settings', 'ARPricelite'), __('Settings', 'ARPricelite'), 'arplite_global_settings_pricingtables', 'arplite_global_settings', array(&$this, 'route'));

        $this->set_premium_link();
    }

    function set_premium_link() {

        if (file_exists(ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_upgrade_to_premium.php'))
            include(ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_upgrade_to_premium.php');
    }

    function arplite_menu_css() {
        ?>
        <style type="text/css">
            #adminmenu #toplevel_page_arpricelite .wp-menu-image img{
                padding-top:5px;
            }
            #adminmenu #toplevel_page_arpricelite .wp-submenu li:last-child a{
                color:#6bbc5b !important;
            }
            #adminmenu #toplevel_page_arpricelite .wp-submenu li:last-child a:hover,
            #adminmenu #toplevel_page_arpricelite .wp-submenu li:last-child a:focus{
                color:#7ad368 !important;
            }
        </style>
        <?php

    }

    function route() {
        global $arplite_pricingtable, $arpricelite_form;
        if (isset($_REQUEST['page']) and $_REQUEST['page'] == 'arpricelite' && isset($_REQUEST['arp_action'])&& $_REQUEST['arp_action'] == '') {
            $arplite_pricingtable->addnew();
        } else if (isset($_REQUEST['page']) and $_REQUEST['page'] == 'arplite_add_pricing_table') {
            if (isset($_REQUEST['arpaction']) and $_REQUEST['arpaction'] == 'create_new')
                $arpricelite_form->edit_template();
            else
                $arplite_pricingtable->addnew();
        } else if (isset($_REQUEST['page']) and $_REQUEST['page'] == 'arplite_analytics') {
            $arplite_pricingtable->analytics();
        } else if (isset($_REQUEST['page']) and $_REQUEST['page'] == 'arplite_import_export') {
            $arplite_pricingtable->import_export();
        } else if (isset($_REQUEST['page']) and $_REQUEST['page'] == 'arplite_global_settings') {
            $arplite_pricingtable->load_global_settings();
        } else if (isset($_REQUEST['page']) and $_REQUEST['page'] == 'arplite_upgrade_to_premium') {
            $arplite_pricingtable->arplite_upgrade_to_premium();
        } else if (isset($_REQUEST['page']) and $_REQUEST['page'] == 'arpricelite' and isset($_REQUEST['arp_action']) and $_REQUEST['arp_action'] != '') {
            $arplite_pricingtable->pricing_table_content();
        } else {
            $arplite_pricingtable->addnew();
        }
    }

    function arplite_upgrade_to_premium() {
        if (file_exists(ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_upgrade_to_premium.php'))
            include(ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_upgrade_to_premium.php');
    }

    function addnew() {
        if (file_exists(ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_template_listing.php')) {
            include( ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_template_listing.php' );
        }
    }

    function pricing_table_content() {
        if (file_exists(ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_listing_editor.php')) {
            include( ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_listing_editor.php' );
        }
    }

    function import_export() {
        if (file_exists(ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_import_export.php'))
            include( ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_import_export.php' );
    }

    function load_global_settings() {
        if (file_exists(ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_global_settings.php'))
            include( ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_global_settings.php' );
    }

    public static function arplite_db_check() {
        global $arplite_pricingtable;
        $arpricelite_version = get_option('arpricelite_version');

        if (!isset($arpricelite_version) || $arpricelite_version == '' && is_multisite()) {
            $arplite_pricingtable->arpricelite_install();
        }
    }

    public static function arpricelite_install() {

        global $arplite_pricingtable;

        $arpricelite_version = get_option('arpricelite_version');

        if (!isset($arpricelite_version) || $arpricelite_version == '') {
            $arplite_pricingtable->arplite_pricing_table_main_settings();

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

            global $wpdb, $arpricelite_version;

            $charset_collate = '';

            if ($wpdb->has_cap('collation')) {

                if (!empty($wpdb->charset))
                    $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";

                if (!empty($wpdb->collate))
                    $charset_collate .= " COLLATE $wpdb->collate";
            }

            update_option('arpricelite_version', $arpricelite_version);
            update_option('arplite_is_new_installation', 1);

            update_option('arplite_already_subscribe', 'no');
            update_option('arplite_popup_display', 'no');

            update_option('arpricelite_tour_guide_value', 'yes');

            $table = $wpdb->prefix . 'arplite_arprice';

            $sql_table = "CREATE TABLE IF NOT EXISTS `{$table}`(			
                 ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
                 table_name VARCHAR(255) NOT NULL, 
                 template_name int(11) NOT NULL,
                 general_options LONGTEXT NOT NULL, 
                 is_template int(1) NOT NULL,
                 is_animated int(1) NOT NULL,
                 status VARCHAR(255) NOT NULL, 
                 create_date DATETIME NOT NULL, 
                 arp_last_updated_date DATETIME NOT NULL 
             ){$charset_collate}";

            dbDelta($sql_table);

            $table_opt = $wpdb->prefix . 'arplite_arprice_options';

            $sql_table_opt = "CREATE TABLE IF NOT EXISTS `{$table_opt}`( 
                ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                table_id INT(11) NOT NULL,
		table_options LONGTEXT NOT NULL
            ){$charset_collate}";

            dbDelta($sql_table_opt);

            $tablecreate = $wpdb->prefix . 'arplite_arprice_analytics';

            $sqltable = "CREATE TABLE IF NOT EXISTS `{$tablecreate}`(
                tracking_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                pricing_table_id int NOT NULL,
                browser_name VARCHAR(255) NOT NULL,
                browser_version VARCHAR(255) NOT NULL,
                page_url varchar(255) NOT NULL,
                ip_address varchar(255) NOT NULL,
                country_name varchar(255) NOT NULL,
                session_id varchar(255) NOT NULL,
                added_date DATETIME NOT NULL,
                is_click int(1) NOT NULL DEFAULT '0',
                plan_id varchar(25) NOT NULL 
            ){$charset_collate}";
            dbDelta($sqltable);

            $arplite_pricingtable->arp_pricing_table_templates();  //install default templates

            $wpdb->query("ALTER TABLE `{$table}` AUTO_INCREMENT = 100");

            $wpdb->query("ALTER TABLE `{$table_opt}` AUTO_INCREMENT = 100");

            $arplite_pricingtable->arp_set_global_settings();
        }

        $args = array(
            'role' => 'administrator',
            'fields' => 'id'
        );
        $users = get_users($args);
        if (count($users) > 0) {
            foreach ($users as $key => $user_id) {
                $arproles = $arplite_pricingtable->arp_capabilities();
                $userObj = new WP_User($user_id);
                
                foreach ($arproles as $arprole => $arproledescription){
                    $userObj->add_cap($arprole);
                }

                unset($arproles);
                unset($arprole);
                unset($arproledescription);
            }
        }
    }

    public static function uninstall() {

        global $wpdb;
        if (is_multisite()) {
            $blogs = $wpdb->get_results("SELECT blog_id FROM {$wpdb->blogs}", ARRAY_A);
            if ($blogs) {
                foreach ($blogs as $blog) {
                    switch_to_blog($blog['blog_id']);

                    delete_option('arpricelite_version');
                    delete_option('arpricelite_tour_guide_value');
                    delete_option('arplite_mobile_responsive_size');
                    delete_option('arplite_tablet_responsive_size');
                    delete_option('arplite_desktop_responsive_size');
                    delete_option('arplite_global_custom_css');
                    delete_option('arplite_css_character_set');
                    delete_option('arplite_wp_get_version');
                    delete_option('arplite_previewoptions');
                    delete_option('arplite_tablegeneraloption');
                    delete_option('arplite_tablecolumnoption');
                    delete_option('arplite_is_new_installation');
                    delete_option('arplite_is_dashboard_visited');
                    delete_option('arplite_load_js_css');
                    delete_option('arplite_already_subscribe');
                    delete_option('arplite_popup_display');
                    delete_option('arplite_display_popup_date');

                    $wpdb->query("DELETE FROM " . $wpdb->options . " WHERE option_name LIKE '%arplite_previewtabledata_%'");
                    $table = $wpdb->prefix . 'arplite_arprice';
                    $table_opt = $wpdb->prefix . 'arplite_arprice_options';
                    $table_analytics = $wpdb->prefix . 'arplite_arprice_analytics';
                    $wpdb->query("DROP TABLE IF EXISTS $table");
                    $wpdb->query("DROP TABLE IF EXISTS $table_opt");
                    $wpdb->query("DROP TABLE IF EXISTS $table_analytics");
                }
                restore_current_blog();
            }
        } else {
            delete_option('arpricelite_version');
            delete_option('arpricelite_tour_guide_value');
            delete_option('arplite_mobile_responsive_size');
            delete_option('arplite_tablet_responsive_size');
            delete_option('arplite_desktop_responsive_size');
            delete_option('arplite_global_custom_css');
            delete_option('arplite_css_character_set');
            delete_option('arplite_wp_get_version');
            delete_option('arplite_previewoptions');
            delete_option('arplite_tablegeneraloption');
            delete_option('arplite_tablecolumnoption');
            delete_option('arplite_load_js_css');
            delete_option('arplite_already_subscribe');
            delete_option('arplite_popup_display');
            delete_option('arplite_display_popup_date');
            delete_option('arplite_is_new_installation');

            $wpdb->query("DELETE FROM " . $wpdb->options . " WHERE option_name LIKE '%arplite_previewtabledata_%'");
            $table = $wpdb->prefix . 'arplite_arprice';
            $table_opt = $wpdb->prefix . 'arplite_arprice_options';
            $table_analytics = $wpdb->prefix . 'arplite_arprice_analytics';
            $wpdb->query("DROP TABLE IF EXISTS $table");
            $wpdb->query("DROP TABLE IF EXISTS $table_opt");
            $wpdb->query("DROP TABLE IF EXISTS $table_analytics");
        }
    }

   public static  function arp_pricing_table_templates() {
        include(ARPLITE_PRICINGTABLE_CLASSES_DIR . '/class.arprice_default_templates.php');
    }

    function arplite_enqueue_preview_css($id, $template_id, $is_admin_preview, $is_template) {
        global $arpricelite_version, $arpricelite_img_css_version;

        if ($is_template == 1) {
            wp_register_style('arplite_preview_css_' . $id . '_v' . $arpricelite_img_css_version, ARPLITE_PRICINGTABLE_URL . '/css/templates/arplitetemplate_' . $template_id . '_v' . $arpricelite_img_css_version . '.css', array(), $arpricelite_version);
            wp_print_styles('arplite_preview_css_' . $id . '_v' . $arpricelite_img_css_version);
        } else {
            wp_register_style('arplite_preview_css_' . $id, ARPLITE_PRICINGTABLE_UPLOAD_URL . '/css/arplitetemplate_' . $template_id . '.css', array(), $arpricelite_version);

            wp_print_styles('arplite_preview_css_' . $id);
        }

        if ($is_admin_preview == 1) {
            wp_register_style('arplite_front_css', ARPLITE_PRICINGTABLE_URL . '/css/arprice_front.css', array(), $arpricelite_version);

            wp_register_script('arplite_front_js', ARPLITE_PRICINGTABLE_URL . '/js/arprice_front.js', array(), $arpricelite_version);
        }

        wp_print_scripts('arplite_front_js');
    }

    function arplite_hide_update_notice_to_all_admin_users() {
        if (isset($_GET) and ( isset($_GET['page']) and preg_match('/arp*/', $_GET['page']))) {

            remove_all_actions('network_admin_notices');
            remove_all_actions('user_admin_notices');
            remove_all_actions('admin_notices');
            remove_all_actions('all_admin_notices');
        }
    }

    function footer_js($location = 'footer') {
        global $arplite_is_animation, $arplite_has_tooltip, $arplite_has_fontawesome, $arplite_effect_css, $arplite_switch_css;

        if ($arplite_has_fontawesome == 1) {
            wp_enqueue_style('arplite_fontawesome_css');
        }
    }

    function arp_template_order() {


        $arptmparr = apply_filters('arplite_pricing_template_order_managed', array(
            'arplitetemplate_26' => 1,
            'arplitetemplate_1' => 2,
            'arplitetemplate_8' => 3,
            'arplitetemplate_11' => 4,
        ));



        return $arptmparr;
    }

    function arp_set_global_settings() {
        add_option('arplite_mobile_responsive_size', 480);
        add_option('arplite_tablet_responsive_size', 768);
        add_option('arplite_desktop_responsive_size', 0);
    }

    function arp_template_responsive_type_array() {

        $array = apply_filters('arpricelite_responsive_type_array_filter', array(
            'header_level_types' => array(
                'type_1' => array(),
                'type_2' => array(),
                'type_3' => array(),
                'type_4' => array(),
                'type_5' => array('arplitetemplate_1', 'arplitetemplate_8', 'arplitetemplate_11', 'arplitetemplate_26'),
                'type_6' => array(),
                'type_7' => array(),
                'type_8' => array(),
            ),
            'header_title_types' => array(
                'type_1' => array('arplitetemplate_1'),
                'type_2' => array('arplitetemplate_8', 'arplitetemplate_11', 'arplitetemplate_26'),
                'type_3' => array(),
                'type_4' => array(),
                'type_5' => array(),
                'type_6' => array(),
                'type_7' => array(),
                'type_8' => array(),
            ),
            'header_level_types_front_array_1' => array(
                'type_1' => array('arplitetemplate_1'),
                'type_2' => array('arplitetemplate_8', 'arplitetemplate_11', 'arplitetemplate_26'),
                'type_3' => array(),
                'type_4' => array(),
                'type_5' => array(),
                'type_6' => array(),
                'type_7' => array(),
                'type_8' => array(),
            ),
            'header_level_types_front_array_2' => array(
                'type_1' => array(),
                'type_2' => array(),
                'type_3' => array('arplitetemplate_8', 'arplitetemplate_11', 'arplitetemplate_26'),
                'type_4' => array('arplitetemplate_1'),
                'type_5' => array(),
                'type_6' => array(),
                'type_7' => array(),
                'type_8' => array(),
            ),
            'column_wrapper_height' => array(
                'type_1' => array(),
                'type_2' => array('arplitetemplate_1', 'arplitetemplate_8', 'arplitetemplate_11', 'arplitetemplate_26'),
                'type_3' => array(),
                'type_4' => array(),
                'type_5' => array(),
                'type_6' => array(),
                'type_7' => array(),
                'type_8' => array(),
            ),
            'price_wrapper_types' => array(
                'type_1' => array('arplitetemplate_11','arplitetemplate_8'),
                'type_2' => array(),
                'type_3' => array('arplitetemplate_8'),
                'type_4' => array(),
                'type_5' => array(),
                'type_6' => array(),
                'type_7' => array(),
                'type_8' => array(),
            ),
            'price_level_types' => array(
                'type_1' => array('arplitetemplate_1', 'arplitetemplate_11', 'arplitetemplate_26'),
                'type_2' => array('arplitetemplate_8',),
                'type_3' => array(),
                'type_4' => array(),
                'type_5' => array(),
                'type_6' => array(),
                'type_7' => array(),
                'type_8' => array(),
            ),
            'price_label_level_types' => array(
                'type_1' => array('arplitetemplate_11'),
                'type_2' => array('arplitetemplate_1', 'arplitetemplate_8', 'arplitetemplate_26'),
                'type_3' => array(),
                'type_4' => array(),
                'type_5' => array(),
                'type_6' => array(),
                'type_7' => array(),
                'type_8' => array(),
            ),
            'body_li_level_types' => array(
                'type_1' => array('arplitetemplate_8'),
                'type_2' => array(),
                'type_3' => array(),
                'type_4' => array(),
                'type_5' => array(),
                'type_6' => array(),
                'type_7' => array(),
                'type_8' => array(),
            ),
            'column_description_types' => array(
                'type_1' => array('arplitetemplate_1', 'arplitetemplate_8'),
                'type_2' => array('arplitetemplate_11', 'arplitetemplate_26'),
                'type_3' => array(),
                'type_4' => array(),
                'type_5' => array(),
                'type_6' => array(),
                'type_7' => array(),
                'type_8' => array(),
            ),
            'button_level_types' => array(
                'type_1' => array('arplitetemplate_8', 'arplitetemplate_11', 'arplitetemplate_26'),
                'type_2' => array('arplitetemplate_1'),
                'type_3' => array(),
                'type_4' => array(),
                'type_5' => array(),
                'type_6' => array(),
                'type_7' => array(),
                'type_8' => array(),
            ),
            'slider_types' => array(
                'type_1' => array('arplitetemplate_8'),
                'type_2' => array(),
                'type_3' => array(),
                'type_4' => array(),
                'type_5' => array('arplitetemplate_1', 'arplitetemplate_11', 'arplitetemplate_26'),
                'type_6' => array(),
                'type_7' => array(),
                'type_8' => array(),
            ),
        ));

        return $array;
    }

    function arp_template_editor_array() {

        $arptemplate_editor_array = apply_filters('arplitetemplate_editor_handler', array(
            'column_header_click_handler' => array(
                'type_1' => array('arplitetemplate_8', 'arplitetemplate_11', 'arplitetemplate_26'),
                'type_2' => array(),
                'type_3' => array('arplitetemplate_1'),
                'type_4' => array(),
                'type_5' => array(),
                'type_6' => array(),
                'type_7' => array(),
                'type_8' => array(),
            ),
            'column_header_click_handler_type_1' => array(
                'type_1' => array(),
                'type_2' => array('arplitetemplate_1', 'arplitetemplate_8', 'arplitetemplate_11', 'arplitetemplate_26'),
                'type_3' => array(),
                'type_4' => array(),
                'type_5' => array(),
                'type_6' => array(),
                'type_7' => array(),
                'type_8' => array(),
            ),
            'column_button_click_handler' => array(
                'type_1' => array('arplitetemplate_8', 'arplitetemplate_11', 'arplitetemplate_26'),
                'type_2' => array(),
                'type_3' => array('arplitetemplate_1'),
                'type_4' => array(),
                'type_5' => array(),
                'type_6' => array(),
                'type_7' => array(),
                'type_8' => array(),
            ),
            'body_li_click_handler' => array(
                'type_1' => array('arplitetemplate_8', 'arplitetemplate_11', 'arplitetemplate_26'),
                'type_2' => array(),
                'type_3' => array('arplitetemplate_1'),
                'type_4' => array(),
                'type_5' => array(),
                'type_6' => array(),
                'type_7' => array(),
                'type_8' => array(),
            ),
            'column_price_click_handler' => array(
                'type_1' => array('arplitetemplate_8', 'arplitetemplate_11', 'arplitetemplate_26'),
                'type_2' => array(),
                'type_3' => array('arplitetemplate_1'),
                'type_4' => array(),
                'type_5' => array(),
                'type_6' => array(),
                'type_7' => array(),
                'type_8' => array(),
            ),
            'price_text_keyup_handler' => array(
                'type_1' => array('arplitetemplate_1'),
                'type_2' => array('arplitetemplate_11'),
                'type_3' => array('arplitetemplate_8', 'arplitetemplate_26'),
                'type_4' => array(''),
                'type_5' => array(''),
                'type_6' => array(''),
                'type_7' => array(''),
                'type_8' => array(''),
            ),
            'price_label_keyup_handler' => array(
                'type_1' => array('arplitetemplate_1'),
                'type_2' => array('arplitetemplate_11'),
                'type_3' => array('arplitetemplate_8', 'arplitetemplate_26'),
                'type_4' => array(''),
                'type_5' => array(''),
                'type_6' => array(''),
                'type_7' => array(''),
                'type_8' => array(''),
            ),
            'price_font_size_handler' => array(
                'type_1' => array(),
                'type_2' => array('arplitetemplate_1', 'arplitetemplate_8', 'arplitetemplate_11', 'arplitetemplate_26'),
                'type_3' => array(),
                'type_4' => array(),
                'type_5' => array(),
                'type_6' => array(),
                'type_7' => array(),
                'type_8' => array(),
            ),
            'price_text_font_size_handler' => array(
                'type_1' => array(),
                'type_2' => array('arplitetemplate_1', 'arplitetemplate_8', 'arplitetemplate_11', 'arplitetemplate_26'),
                'type_3' => array(),
                'type_4' => array(),
                'type_5' => array(),
                'type_6' => array(),
                'type_7' => array(),
                'type_8' => array(),
            ),
            'column_title_handler' => array(
                'type_1' => array(),
                'type_2' => array('arplitetemplate_1', 'arplitetemplate_8', 'arplitetemplate_11', 'arplitetemplate_26'),
                'type_3' => array(),
                'type_4' => array(),
                'type_5' => array(),
                'type_6' => array(),
                'type_7' => array(),
                'type_8' => array()
            ),
            'column_style_btn_handler' => array(
                'type_1' => array('arplitetemplate_1'),
                'type_2' => array('arplitetemplate_8', 'arplitetemplate_11', 'arplitetemplate_26'),
                'type_3' => array(),
                'type_4' => array(),
                'type_5' => array(),
                'type_6' => array(),
                'type_7' => array(),
                'type_8' => array()
            )
        ));

        return $arptemplate_editor_array;
    }

    function arprice_font_icon_size_parser($string = '') {

        $pattern = "/<i (.*?)>(.*?)<\/i>/i";

        $size_pattern = "/arpsize-ico-[0-9]*/";
        preg_match_all($pattern, $string, $matches, PREG_SET_ORDER);

        if (is_array($matches) and ! empty($matches)) {
            foreach ($matches as $key => $value) {

                preg_match($size_pattern, $value[0], $matches_n);

                if (!empty($matches_n[0])) {
                    $font_size = str_replace('arpsize-ico-', '', $matches_n[0]);
                    $style = "font-size:" . $font_size . "px;";
                    $dom = new DOMDocument();
                    @$dom->loadHTML($value[0]);
                    $n = new DOMXPath($dom);
                    foreach ($n->query("//i") as $node) {
                        $node->setAttribute("style", $style);
                    }
                    $newHTML = $dom->saveHTML();

                    preg_match_all($pattern, $newHTML, $matches_);

                    if (is_array($matches_[0]) && !empty($matches_[0])) {
                        foreach ($matches_[0] as $key => $mat) {
                            $string = str_replace($value[0], $mat, $string);
                        }
                    }
                }
            }
        }

        return $string;
    }

    function arp_remove_style_tag($tablestring = '') {

        $pattern_ = '/\<style(.*?)\>(.*?)\<\/style\>/';

        preg_match_all($pattern_, $tablestring, $matches);

        if (!empty($matches[1]) && is_array($matches[1])) {
            foreach ($matches[1] as $key => $match) {
                if ($match == '' || empty($match)) {
                    $tablestring = str_replace($matches[2][$key], '', $tablestring);
                } else {
                    $id_pattern = "/id=(.*)/";
                    preg_match_all($id_pattern, $match, $matches_);
                    if (!empty($matches_[1]) && is_array($matches_[1])) {
                        foreach ($matches_[1] as $k => $mat) {
                            if (!preg_match_all('/arplite_render_css|border_radius_style|arplite_ribbon_style/', $mat, $matche_)) {
                                $tablestring = str_replace($matches[2][$key], '', $tablestring);
                            }
                        }
                    }
                }
            }
        }

        return $tablestring;
    }

    function arp_template_pro_images() {

        $arp_template_pro_images = apply_filters('arp_template_pro_images', array('arptemplate_25', 'arptemplate_20', 'arptemplate_21', 'arptemplate_23', 'arptemplate_22', 'arptemplate_24', 'arptemplate_2', 'arptemplate_3', 'arptemplate_4', 'arptemplate_5', 'arptemplate_6', 'arptemplate_7', 'arptemplate_9', 'arptemplate_10', 'arptemplate_13', 'arptemplate_14', 'arptemplate_15', 'arptemplate_16')
        );

        return $arp_template_pro_images;
    }

}

function arpricelite_load_table($id = '') {

    global $arpricelite_form, $arpricelite_img_css_version, $arpricelite_version;

    $formids = array();

    $formids[] = $id;

    if (isset($formids) and is_array($formids) && count($formids) > 0) {
        foreach ($formids as $newkey => $newval) {
            $newval = str_replace('"', '', $newval);
            $newval = str_replace("'", "", $newval);
            if (stripos($newval, ' ') !== false) {
                $partsnew = explode(" ", $newval);
                $newvalarr[] = $partsnew[0];
            } else
                $newvalarr[] = $newval;
        }
    }

    if ($newvalarr)
        $newvalues_enqueue = $arpricelite_form->get_table_enqueue_data($newvalarr);

    if (is_array($newvalues_enqueue) && count($newvalues_enqueue) > 0) {
        $templates = array();
        $is_template = 0;

        foreach ($newvalues_enqueue as $n => $newqnqueue) {

            if ($newqnqueue['template_name'] != 0) {
                $templates[] = $newqnqueue['template_name'];
            } else {
                $templates[] = $n;
            }

            if (!empty($newqnqueue['is_template'])) {
                $is_template = $newqnqueue['is_template'];
            }
        }

        $templates = array_unique($templates);

        if ($templates) {
            wp_enqueue_script('arplite_front_js');

            wp_enqueue_style('arplite_front_css');

            foreach ($newvalues_enqueue as $template_id => $newqnqueue) {

                if (isset($newqnqueue['is_template']) && !empty($newqnqueue['is_template'])) {
                    wp_register_style('arplitetemplate_' . $newqnqueue['template_name'] . '_css', ARPLITE_PRICINGTABLE_URL . '/css/templates/arplitetemplate_' . $newqnqueue['template_name'] . '_v' . $arpricelite_img_css_version . '.css', array(), $arpricelite_version);
                    wp_enqueue_style('arplitetemplate_' . $newqnqueue['template_name'] . '_css');
                } else {

                    wp_register_style('arplitetemplate_' . $template_id . '_css', ARPLITE_PRICINGTABLE_UPLOAD_URL . '/css/arplitetemplate_' . $template_id . '.css', array(), $arpricelite_version);
                    wp_enqueue_style('arplitetemplate_' . $template_id . '_css');
                }
            }
        }
    }

    return do_shortcode('[ARPLite id=' . $id . ']');
}
?>