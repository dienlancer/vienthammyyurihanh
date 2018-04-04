<?php

class arpricelite_form {

    function __construct() {

        add_action('init', array(&$this, 'parse_standalone_request'), 1);
        add_action('wp_ajax_arplite_add_new_row', array(&$this, 'add_new_row_new'));
        add_action('wp_ajax_arplite_updatetabledata', array(&$this, 'arp_updatetabledata'));
        add_action('wp_ajax_arplite_load_pricing_table', array(&$this, 'arp_load_pricing_table'));
        add_filter('widget_text', array(&$this, 'arplite_widget_text_filter'), 9);
        add_action('wp_ajax_arplite_save_template_image', array(&$this, 'arp_save_template_image'));
        add_action('wp_ajax_update_arplite_tour_guide_value', array(&$this, 'update_arp_tour_guide_value'));
        add_action('wp_ajax_arplite_save_pricing_table', array(&$this, 'arp_save_pricing_table'));
        add_action('wp_ajax_update_subscribe_date', array(&$this, 'arp_update_subscribe_date'));
    }

    function arp_save_pricing_table() {
        global $wpdb, $arpricelite_version, $arpricelite_img_css_version;

        $_POST = json_decode(stripslashes_deep($_POST['filtered_data']), true);

        /* MODIFY PRICING TABLE BEFORE SAVING */
        $_POST = apply_filters('arplite_change_values_before_update_pricing_table', $_POST);

        $select_templates = $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . "arplite_arprice WHERE is_template = 0");

        $pt_action = $_POST['pt_action'];

        if ($select_templates > 3 && $pt_action == 'new') {
            echo 'notice~|~';
            die();
        }

        if ($pt_action == "edit") {
            $table_id = @$_POST['table_id'];
        }

        if ($pt_action == "new") {
            $is_template = 0;
        } else {
            $get_is_template = $wpdb->get_results("SELECT is_template FROM {$wpdb->prefix}arplite_arprice WHERE ID = {$table_id}");

            $is_template = $get_is_template[0]->is_template;
        }

        do_action('arplite_before_update_pricing_table', $_POST);

        $main_table_title = @$_POST['pricing_table_main'];

        $is_tbl_preview = ( @isset($_POST['is_tbl_preview']) and @ $_POST['is_tbl_preview'] == 1 ) ? 1 : 0;

        $dt = current_time('mysql');

        $total = @$_POST['added_package'];

        if ($main_table_title == "" && !$is_tbl_preview) {
            return;
        }

        @parse_str(@$_POST['pt_coloumn_order'], $pt_coloumn_order);

        $template = @$_POST['arp_template'];
        $template_name = @$_POST['arp_template_name'];

        $template_skin = @$_POST['arp_template_skin_editor'];
        $template_type = @$_POST['arp_template_type'];

        $template_feature = @json_decode(@stripslashes_deep(@$_POST['template_feature']), true);

        $template_setting = array('template' => $template, 'skin' => $template_skin, 'template_type' => $template_type, 'features' => $template_feature);

        $column_order = @stripslashes_deep(@$_POST['pricing_table_column_order']);

        $column_ord = str_replace('\'', '"', $column_order);
        $col_ord_arr = json_decode($column_ord, true);
        if ($_POST['has_caption_column'] == 1 and ! in_array('main_column_0', $col_ord_arr))
            array_unshift($col_ord_arr, 'main_column_0');
        $new_id = array();


        if (is_array($col_ord_arr) and count($col_ord_arr) > 0) {
            foreach ($col_ord_arr as $key => $value)
                $new_id[$key] = str_replace('main_column_', '', $value);
        }

        $total = @max($new_id);

        $column_order = @json_encode($col_ord_arr);

        $reference_template = @$_POST['arp_reference_template'];

        $user_edited_columns = @json_decode(@stripslashes_deep(@$_POST['arp_user_edited_columns']), true);

        $general_settings = array('column_order' => $column_order, 'reference_template' => $reference_template, 'user_edited_columns' => $user_edited_columns);

        $is_column_space = @$_POST['space_between_column'];
        $column_space = @$_POST['column_space'];
        $hover_highlight = @$_POST['column_high_on_hover'];
        $is_responsive = @$_POST['is_responsive'];
        $all_column_width = @$_POST['all_column_width'];

        $arp_row_border_size = @$_POST['arp_row_border_size'];
        $arp_row_border_type = @$_POST['arp_row_border_type'];
        $arp_row_border_color = @$_POST['arp_row_border_color'];

//        Caption Row Level Border
        $arp_caption_row_border_size = @$_POST['arp_caption_row_border_size'];
        $arp_caption_row_border_style = @$_POST['arp_caption_row_border_style'];
        $arp_caption_row_border_color = @$_POST['arp_caption_row_border_color'];
//        Caption Row Level Border

        $arp_column_border_size = @$_POST['arp_column_border_size'];
        $arp_column_border_type = @$_POST['arp_column_border_type'];
        $arp_column_border_color = @$_POST['arp_column_border_color'];
        $arp_column_border_all = @$_POST['arp_column_border_all'];
        $arp_column_border_left = @$_POST['arp_column_border_left'];
        $arp_column_border_right = @$_POST['arp_column_border_right'];
        $arp_column_border_top = @$_POST['arp_column_border_top'];
        $arp_column_border_bottom = @$_POST['arp_column_border_bottom'];

        $arp_caption_border_color = @$_POST['arp_caption_border_color'];
        $arp_caption_border_style = @$_POST['arp_caption_border_style'];
        $arp_caption_border_size = @$_POST['arp_caption_border_size'];
        $arp_caption_border_all = @$_POST['arp_caption_border_all'];
        $arp_caption_border_left = @$_POST['arp_caption_border_left'];
        $arp_caption_border_right = @$_POST['arp_caption_border_right'];
        $arp_caption_border_top = @$_POST['arp_caption_border_top'];
        $arp_caption_border_bottom = @$_POST['arp_caption_border_bottom'];

        $hide_caption_column = @$_POST['hide_caption_column'];
        $hide_footer_global = @$_POST['hide_footer_global'];
        $hide_header_global = @$_POST['hide_header_global'];
        $hide_price_global = @$_POST['hide_price_global'];
        $hide_feature_global = @$_POST['hide_feature_global'];
        $hide_description_global = @$_POST['hide_description_global'];
        $hide_header_shortcode_global = @$_POST['hide_header_shortcode_global'];

        $column_wrapper_width_txtbox = @$_POST['column_wrapper_width_txtbox'];
        $column_wrapper_width_style = @$_POST['column_wrapper_width_style'];

        $column_box_shadow_effect = @$_POST['column_box_shadow_effect'];

        $column_border_radius_top_left = ( isset($_POST['column_border_radius_top_left']) and ! empty($_POST['column_border_radius_top_left']) ) ? $_POST['column_border_radius_top_left'] : 0;
        $column_border_radius_top_right = ( isset($_POST['column_border_radius_top_right']) and ! empty($_POST['column_border_radius_top_right']) ) ? $_POST['column_border_radius_top_right'] : 0;
        $column_border_radius_bottom_right = ( isset($_POST['column_border_radius_bottom_right']) and ! empty($_POST['column_border_radius_bottom_right']) ) ? $_POST['column_border_radius_bottom_right'] : 0;
        $column_border_radius_bottom_left = ( isset($_POST['column_border_radius_bottom_left']) and ! empty($_POST['column_border_radius_bottom_left']) ) ? $_POST['column_border_radius_bottom_left'] : 0;
        $column_hide_blank_rows = @$_POST['hide_blank_rows'];

        $global_button_border_width = @$_POST['arp_global_button_border_width'];
        $global_button_border_type = @$_POST['arp_global_button_border_style'];
        $global_button_border_color = @$_POST['arp_global_button_border_color'];
        $global_button_border_radius_top_left = @$_POST['global_button_border_radius_top_left'];
        $global_button_border_radius_top_right = @$_POST['global_button_border_radius_top_right'];
        $global_button_border_radius_bottom_left = @$_POST['global_button_border_radius_bottom_left'];
        $global_button_border_radius_bottom_right = @$_POST['global_button_border_radius_bottom_right'];
        $arp_global_button_border_type = @$_POST['arp_global_button_type'];

        $header_font_family_global = @$_POST['header_font_family_global'];
        $header_font_size_global = @$_POST['header_font_size_global'];
        $arp_header_text_alignment = @$_POST['arp_header_text_alignment'];

        $header_style_bold_global = @$_POST['header_style_bold_global'];
        $header_style_italic_global = @$_POST['header_style_italic_global'];
        $header_style_decoration_global = @$_POST['header_style_decoration_global'];

        $price_font_family_global = @$_POST['price_font_family_global'];
        $price_font_size_global = @$_POST['price_font_size_global'];
        $arp_price_text_alignment = @$_POST['arp_price_text_alignment'];

        $price_style_bold_global = @$_POST['price_style_bold_global'];
        $price_style_italic_global = @$_POST['price_style_italic_global'];
        $price_style_decoration_global = @$_POST['price_style_decoration_global'];

        $body_font_family_global = @$_POST['body_font_family_global'];
        $body_font_size_global = @$_POST['body_font_size_global'];
        $arp_body_text_alignment = @$_POST['arp_body_text_alignment'];

        $body_style_bold_global = @$_POST['body_style_bold_global'];
        $body_style_italic_global = @$_POST['body_style_italic_global'];
        $body_style_decoration_global = @$_POST['body_style_decoration_global'];

        $footer_font_family_global = @$_POST['footer_font_family_global'];
        $footer_font_size_global = @$_POST['footer_font_size_global'];
        $arp_footer_text_alignment = @$_POST['arp_footer_text_alignment'];

        $footer_style_bold_global = @$_POST['footer_style_bold_global'];
        $footer_style_italic_global = @$_POST['footer_style_italic_global'];
        $footer_style_decoration_global = @$_POST['footer_style_decoration_global'];

        $button_font_family_global = @$_POST['button_font_family_global'];
        $button_font_size_global = @$_POST['button_font_size_global'];
        $arp_button_text_alignment = @$_POST['arp_button_text_alignment'];

        $button_style_bold_global = @$_POST['button_style_bold_global'];
        $button_style_italic_global = @$_POST['button_style_italic_global'];
        $button_style_decoration_global = @$_POST['button_style_decoration_global'];

        $description_font_family_global = @$_POST['description_font_family_global'];
        $description_font_size_global = @$_POST['description_font_size_global'];
        $arp_description_text_alignment = @$_POST['arp_description_text_alignment'];

        $description_style_bold_global = @$_POST['description_style_bold_global'];
        $description_style_italic_global = @$_POST['description_style_italic_global'];
        $description_style_decoration_global = @$_POST['description_style_decoration_global'];

        $column_setting = array('space_between_column' => $is_column_space, 'column_space' => $column_space, 'column_highlight_on_hover' => $hover_highlight, 'is_responsive' => $is_responsive, 'hide_caption_column' => $hide_caption_column, 'hide_footer_global' => $hide_footer_global, 'hide_header_global' => $hide_header_global, 'hide_header_shortcode_global' => $hide_header_shortcode_global, 'hide_price_global' => $hide_price_global, 'hide_feature_global' => $hide_feature_global, 'hide_description_global' => $hide_description_global, 'all_column_width' => $all_column_width, 'column_wrapper_width_txtbox' => $column_wrapper_width_txtbox, 'column_wrapper_width_style' => $column_wrapper_width_style, 'column_border_radius_top_left' => $column_border_radius_top_left, 'column_border_radius_top_right' => $column_border_radius_top_right, 'column_border_radius_bottom_right' => $column_border_radius_bottom_right, 'column_border_radius_bottom_left' => $column_border_radius_bottom_left, 'column_box_shadow_effect' => $column_box_shadow_effect, 'column_hide_blank_rows' => $column_hide_blank_rows, 'global_button_border_width' => $global_button_border_width, 'global_button_border_type' => $global_button_border_type, 'global_button_border_color' => $global_button_border_color, 'global_button_border_radius_top_left' => $global_button_border_radius_top_left, 'global_button_border_radius_top_right' => $global_button_border_radius_top_right, 'global_button_border_radius_bottom_left' => $global_button_border_radius_bottom_left, 'global_button_border_radius_bottom_right' => $global_button_border_radius_bottom_right, 'arp_global_button_type' => $arp_global_button_border_type, 'arp_row_border_size' => $arp_row_border_size, 'arp_row_border_type' => $arp_row_border_type, 'arp_row_border_color' => $arp_row_border_color, 'arp_caption_border_style' => $arp_caption_border_style, 'arp_caption_border_size' => $arp_caption_border_size, 'arp_column_border_size' => $arp_column_border_size, 'arp_column_border_type' => $arp_column_border_type, 'arp_column_border_color' => $arp_column_border_color, 'arp_caption_border_color' => $arp_caption_border_color, 'arp_column_border_left' => $arp_column_border_left, 'arp_column_border_right' => $arp_column_border_right, 'arp_column_border_top' => $arp_column_border_top, 'arp_column_border_bottom' => $arp_column_border_bottom, 'arp_column_border_all' => $arp_column_border_all, 'arp_caption_border_left' => $arp_caption_border_left, 'arp_caption_border_right' => $arp_caption_border_right, 'arp_caption_border_top' => $arp_caption_border_top, 'arp_caption_border_bottom' => $arp_caption_border_bottom, 'arp_caption_border_all' => $arp_caption_border_all, 'arp_caption_row_border_size' => $arp_caption_row_border_size, 'arp_caption_row_border_style' => $arp_caption_row_border_style, 'arp_caption_row_border_color' => $arp_caption_row_border_color,
            'header_font_family_global' => $header_font_family_global,
            'header_font_size_global' => $header_font_size_global,
            'arp_header_text_alignment' => $arp_header_text_alignment,
            'arp_header_text_bold_global' => $header_style_bold_global,
            'arp_header_text_italic_global' => $header_style_italic_global,
            'arp_header_text_decoration_global' => $header_style_decoration_global,
            'price_font_family_global' => $price_font_family_global,
            'price_font_size_global' => $price_font_size_global,
            'arp_price_text_alignment' => $arp_price_text_alignment,
            'arp_price_text_bold_global' => $price_style_bold_global,
            'arp_price_text_italic_global' => $price_style_italic_global,
            'arp_price_text_decoration_global' => $price_style_decoration_global,
            'body_font_family_global' => $body_font_family_global,
            'body_font_size_global' => $body_font_size_global,
            'arp_body_text_alignment' => $arp_body_text_alignment,
            'arp_body_text_bold_global' => $body_style_bold_global,
            'arp_body_text_italic_global' => $body_style_italic_global,
            'arp_body_text_decoration_global' => $body_style_decoration_global,
            'footer_font_family_global' => $footer_font_family_global,
            'footer_font_size_global' => $footer_font_size_global,
            'arp_footer_text_alignment' => $arp_footer_text_alignment,
            'arp_footer_text_bold_global' => $footer_style_bold_global,
            'arp_footer_text_italic_global' => $footer_style_italic_global,
            'arp_footer_text_decoration_global' => $footer_style_decoration_global,
            'button_font_family_global' => $button_font_family_global,
            'button_font_size_global' => $button_font_size_global,
            'arp_button_text_alignment' => $arp_button_text_alignment,
            'arp_button_text_bold_global' => $button_style_bold_global,
            'arp_button_text_italic_global' => $button_style_italic_global,
            'arp_button_text_decoration_global' => $button_style_decoration_global,
            'description_font_family_global' => $description_font_family_global,
            'description_font_size_global' => $description_font_size_global,
            'arp_description_text_alignment' => $arp_description_text_alignment,
            'arp_description_text_bold_global' => $description_style_bold_global,
            'arp_description_text_italic_global' => $description_style_italic_global,
            'arp_description_text_decoration_global' => $description_style_decoration_global,
        );

        $arp_column_bg_custom_color = @$_POST['arp_column_background_color'];

        $arp_column_desc_bg_custom_color = @$_POST['arp_column_desc_background_color'];

        $arp_column_desc_hover_bg_custom_color = @$_POST['arp_column_desc_hover_background_color'];

        $arp_header_bg_custom_color = @$_POST['arp_header_background_color'];

        $arp_pricing_bg_custom_color = @$_POST['arp_pricing_background_color'];

        $arp_template_odd_row_hover_bg_color = @$_POST['arp_body_odd_row_hover_background_color'];

        $arp_template_odd_row_bg_color = @$_POST['arp_body_odd_row_background_color'];

        $arp_body_even_row_hover_bg_custom_color = @$_POST['arp_body_even_row_hover_background_color'];

        $arp_body_even_row_bg_custom_color = @$_POST['arp_body_even_row_background_color'];

        $arp_footer_content_bg_color = @$_POST['arp_footer_content_background_color'];

        $arp_footer_content_hover_bg_color = @$_POST['arp_footer_content_hover_background_color'];

        $arp_button_bg_custom_color = @$_POST['arp_button_background_color'];

        $arp_column_bg_hover_color = @$_POST['arp_column_bg_hover_color'];

        $arp_button_bg_hover_color = @$_POST['arp_button_bg_hover_color'];

        $arp_header_bg_hover_color = @$_POST['arp_header_bg_hover_color'];

        $arp_price_bg_hover_color = @$_POST['arp_price_bg_hover_color'];

        $arp_header_font_custom_color = @$_POST['arp_header_font_custom_color_input'];

        $arp_header_font_custom_hover_color_input = @$_POST['arp_header_font_custom_hover_color_input'];

        $arp_price_font_custom_color = @$_POST['arp_price_font_custom_color_input'];

        $arp_price_font_custom_hover_color_input = @$_POST['arp_price_font_custom_hover_color_input'];

        $arp_price_duration_font_custom_color = @$_POST['arp_price_duration_font_custom_color_input'];

        $arp_price_duration_font_custom_hover_color_input = @$_POST['arp_price_duration_font_custom_hover_color_input'];

        $arp_desc_font_custom_color = @$_POST['arp_desc_font_custom_color_input'];

        $arp_desc_font_custom_hover_color_input = @$_POST['arp_desc_font_custom_hover_color_input'];

        $arp_body_label_font_custom_color = @$_POST['arp_body_label_font_custom_color_input'];

        $arp_body_label_font_custom_hover_color_input = @$_POST['arp_body_label_font_custom_hover_color_input'];

        $arp_body_font_custom_color = @$_POST['arp_body_font_custom_color_input'];
        $arp_body_even_font_custom_color = @$_POST['arp_body_even_font_custom_color_input'];

        $arp_body_font_custom_hover_color_input = @$_POST['arp_body_font_custom_hover_color_input'];
        $arp_body_even_font_custom_hover_color_input = @$_POST['arp_body_even_font_custom_hover_color_input'];

        $arp_footer_font_custom_color = @$_POST['arp_footer_font_custom_color_input'];

        $arp_footer_font_custom_hover_color_input = @$_POST['arp_footer_font_custom_hover_color_input'];

        $arp_button_font_custom_color = @$_POST['arp_button_font_custom_color_input'];

        $arp_button_font_custom_hover_color_input = @$_POST['arp_button_font_custom_hover_color_input'];

        $arp_shortocode_background = @$_POST['arp_shortocode_background_color'];
        $arp_shortocode_font_color = @$_POST['arp_shortocode_font_custom_color_input'];
        $arp_shortcode_bg_hover_color = @$_POST['arp_shortcode_bg_hover_color'];
        $arp_shortcode_font_hover_color = @$_POST['arp_shortcode_font_custom_hover_color_input'];

        $custom_skin_colors = array(
            "arp_header_bg_custom_color" => $arp_header_bg_custom_color,
            "arp_column_bg_custom_color" => $arp_column_bg_custom_color,
            "arp_column_desc_bg_custom_color" => $arp_column_desc_bg_custom_color,
            "arp_column_desc_hover_bg_custom_color" => $arp_column_desc_hover_bg_custom_color,
            "arp_pricing_bg_custom_color" => $arp_pricing_bg_custom_color,
            "arp_body_odd_row_bg_custom_color" => $arp_template_odd_row_bg_color,
            "arp_body_odd_row_hover_bg_custom_color" => $arp_template_odd_row_hover_bg_color,
            "arp_body_even_row_hover_bg_custom_color" => $arp_body_even_row_hover_bg_custom_color,
            "arp_body_even_row_bg_custom_color" => $arp_body_even_row_bg_custom_color,
            "arp_footer_content_hover_bg_color" => $arp_footer_content_hover_bg_color,
            "arp_footer_content_bg_color" => $arp_footer_content_bg_color,
            "arp_button_bg_custom_color" => $arp_button_bg_custom_color,
            "arp_column_bg_hover_color" => $arp_column_bg_hover_color,
            "arp_button_bg_hover_color" => $arp_button_bg_hover_color,
            "arp_header_bg_hover_color" => $arp_header_bg_hover_color,
            "arp_price_bg_hover_color" => $arp_price_bg_hover_color,
            "arp_header_font_custom_color" => $arp_header_font_custom_color,
            "arp_header_font_custom_hover_color" => $arp_header_font_custom_hover_color_input,
            "arp_price_font_custom_color" => $arp_price_font_custom_color,
            "arp_price_font_custom_hover_color" => $arp_price_font_custom_hover_color_input,
            "arp_desc_font_custom_color" => $arp_desc_font_custom_color,
            "arp_desc_font_custom_hover_color" => $arp_desc_font_custom_hover_color_input,
            "arp_body_label_font_custom_color" => $arp_body_label_font_custom_color,
            "arp_body_label_font_custom_hover_color" => $arp_body_label_font_custom_hover_color_input,
            "arp_body_font_custom_color" => $arp_body_font_custom_color,
            "arp_body_even_font_custom_color" => $arp_body_even_font_custom_color,
            "arp_body_font_custom_hover_color" => $arp_body_font_custom_hover_color_input,
            "arp_body_even_font_custom_hover_color" => $arp_body_even_font_custom_hover_color_input,
            "arp_footer_font_custom_color" => $arp_footer_font_custom_color,
            "arp_footer_font_custom_hover_color" => $arp_footer_font_custom_hover_color_input,
            "arp_button_font_custom_color" => $arp_button_font_custom_color,
            "arp_button_font_custom_hover_color" => $arp_button_font_custom_hover_color_input,
            'arp_shortocode_background' => $arp_shortocode_background,
            'arp_shortocode_font_color' => $arp_shortocode_font_color,
            'arp_shortcode_bg_hover_color' => $arp_shortcode_bg_hover_color,
            'arp_shortcode_font_hover_color' => $arp_shortcode_font_hover_color,
        );
        $tab_general_opt = array('template_setting' => $template_setting,
            'column_settings' => $column_setting,
            'general_settings' => $general_settings,
            'custom_skin_colors' => $custom_skin_colors
        );

        $general_opt = maybe_serialize($tab_general_opt);

        $row = array();
        $column_order = array();
        $row_order = array();

        if (count($total) > 0) {

            if ($pt_action == "new") {
                if ($is_tbl_preview && $is_tbl_preview == 1) {
                    $temp_status = 'draft';

                    $id = $wpdb->query($wpdb->prepare('INSERT INTO ' . $wpdb->prefix . 'arplite_arprice (table_name,general_options,status,create_date,arp_last_updated_date) VALUES (%s,%s,%s,%s,%s)', $main_table_title, $general_opt, $temp_status, $dt, $dt));

                    $table_id = $wpdb->insert_id;
                } else {
                    $new_status = 'published';

                    $type_of_template = $template_feature['is_animated'];

                    $id = $wpdb->query($wpdb->prepare('INSERT INTO ' . $wpdb->prefix . 'arplite_arprice (table_name,general_options,is_animated,status,create_date,arp_last_updated_date) VALUES (%s,%s,%d,%s,%s,%s)', $main_table_title, $general_opt, $type_of_template, $new_status, $dt, $dt));
                    $table_id = $wpdb->insert_id;
                }
            } else {
                $query_results = $wpdb->query($wpdb->prepare('UPDATE ' . $wpdb->prefix . 'arplite_arprice SET table_name = %s, general_options= %s,arp_last_updated_date=%s WHERE ID = %d', $main_table_title, $general_opt, $dt, $table_id));

                if (!isset($_POST['is_tbl_preview']))
                    $wpdb->update($wpdb->prefix . 'arplite_arprice', array('status' => 'published', 'arp_last_updated_date' => $dt), array('ID' => $table_id));
            }

            // AFTER UPDATE PRICING TABLE

            do_action('arplite_after_update_pricing_table', $table_id, $_POST);
            do_action('arplite_after_update_pricing_table' . $table_id, $table_id, $_POST);

            $table_id = apply_filters('arplite_change_values_after_update_pricing_table', $table_id, $_POST);

            if (count($new_id) > 0) {
                $ki = 1;
                for ($i = 0; $i <= $total; $i++) {
                    if (!in_array($i, $new_id))
                        continue;
                    $Title = 'column_' . $i;
                    $column_width = @$_POST['column_width_' . $i];
                    $column_title = @stripslashes_deep(@$_POST['column_title_' . $i]);
                    $column_desc = @stripslashes_deep(@$_POST['arp_column_description_' . $i]);
                    $cstm_rbn_txt = @stripslashes_deep(@$_POST['arp_custom_ribbon_txt_' . $i]);
                    $column_highlight = @$_POST['column_highlight_' . $i];
                    $column_background_color = @stripslashes_deep(@$_POST['column_background_color_' . $i]);
                    $column_hover_background_color = @stripslashes_deep(@$_POST['column_hover_background_color_' . $i]);
                    $arp_change_bgcolor = @stripslashes_deep(@$_POST['arp_change_bgcolor_' . $i]);

                    $hide_footer = isset($_POST['hide_footer_' . $i]) ? $_POST['hide_footer_' . $i] : '';

                    $column_ribbon_style = @stripslashes_deep(@$_POST['arp_ribbon_style_' . $i]);
                    $column_ribbon_position = @stripslashes_deep(@$_POST['arp_ribbon_position_' . $i]);
                    $column_ribbon_bgcolor = @stripslashes_deep(@$_POST['arp_ribbon_bgcol_' . $i]);
                    $column_ribbon_txtcolor = @stripslashes_deep(@$_POST['arp_ribbon_textcol_' . $i]);
                    $column_ribbon_content = @stripslashes_deep(@$_POST['arp_ribbon_content_' . $i]);
                    $header_background_color = @stripslashes_deep(@$_POST['header_background_color_' . $i]);
                    $header_hover_background_color = @stripslashes_deep(@$_POST['header_hover_background_color_' . $i]);
                    $header_font_family = @stripslashes_deep(@$_POST['header_font_family_' . $i]);
                    $header_font_size = @$_POST['header_font_size_' . $i];
                    $header_font_style = @$_POST['header_font_style_' . $i];
                    $header_font_color = @stripslashes_deep(@$_POST['header_font_color_' . $i]);
                    $header_hover_font_color = @stripslashes_deep(@$_POST['header_hover_font_color_' . $i]);
                    $header_font_align = @stripslashes_deep(@$_POST['arp_header_text_alignment_' . $i]);

                    $header_style_bold = @$_POST['header_style_bold_' . $i];
                    $header_style_italic = @$_POST['header_style_italic_' . $i];
                    $header_style_decoration = @$_POST['header_style_decoration_' . $i];
                    $price_background_color = @stripslashes_deep(@$_POST['price_background_color_' . $i]);
                    $price_hover_background_color = @stripslashes_deep(@$_POST['price_hover_background_color_' . $i]);
                    $header_background_image = @stripslashes_deep(@$_POST['arp_header_background_image_' . $i]);

                    $price_font_family = @stripslashes_deep(@$_POST['price_font_family_' . $i]);
                    $price_font_size = @$_POST['price_font_size_' . $i];
                    $price_font_color = @stripslashes_deep(@$_POST['price_font_color_' . $i]);
                    $price_hover_font_color = @$_POST['price_hover_font_color_' . $i];
                    $price_font_style = @$_POST['price_font_style_' . $i];
                    $price_font_align = @$_POST['arp_price_text_alignment_' . $i];

                    $price_label_style_bold = @$_POST['price_label_style_bold_' . $i];
                    $price_label_style_italic = @$_POST['price_label_style_italic_' . $i];
                    $price_label_style_decoration = @$_POST['price_label_style_decoration_' . $i];

                    $price_text_font_family = @stripslashes_deep(@$_POST['price_text_font_family_' . $i]);
                    $price_text_font_size = @$_POST['price_text_font_size_' . $i];
                    $price_text_font_style = @$_POST['price_text_font_style_' . $i];
                    $price_text_font_color = @stripslashes_deep(@$_POST['price_text_font_color_' . $i]);
                    $price_text_hover_font_color = @stripslashes_deep(@$_POST['price_text_hover_font_color_' . $i]);

                    $price_text_style_bold = @$_POST['price_text_style_bold_' . $i];
                    $price_text_style_italic = @$_POST['price_text_style_italic_' . $i];
                    $price_text_style_decoration = @$_POST['price_text_style_decoration_' . $i];

                    $column_description_font_family = @stripslashes_deep(@$_POST['column_description_font_family_' . $i]);
                    $column_description_font_size = @$_POST['column_description_font_size_' . $i];
                    $column_description_font_style = @$_POST['column_description_font_style_' . $i];
                    $column_description_font_color = @stripslashes_deep(@$_POST['column_description_font_color_' . $i]);
                    $column_description_hover_font_color = @stripslashes_deep(@$_POST['column_description_hover_font_color_' . $i]);
                    $column_desc_background_color = @stripslashes_deep(@$_POST['column_desc_background_color_' . $i]);
                    $column_desc_hover_background_color = @stripslashes_deep(@$_POST['column_desc_hover_background_color_' . $i]);
                    $column_description_style_bold = @$_POST['column_description_style_bold_' . $i];
                    $column_description_style_italic = @$_POST['column_description_style_italic_' . $i];
                    $column_description_style_decoration = @$_POST['column_description_style_decoration_' . $i];
                    $column_description_text_align = @$_POST['arp_description_text_alignment_' . $i];

                    $content_font_family = @stripslashes_deep(@$_POST['content_font_family_' . $i]);
                    $content_font_size = @$_POST['content_font_size_' . $i];
                    $content_font_color = @stripslashes_deep(@$_POST['content_font_color_' . $i]);
                    $content_font_style = @$_POST['content_font_style_' . $i];
                    $content_even_font_color = @stripslashes_deep(@$_POST['content_even_font_color_' . $i]);
                    $content_hover_font_color = @stripslashes_deep(@$_POST['content_hover_font_color_' . $i]);
                    $content_even_hover_font_color = @stripslashes_deep(@$_POST['content_even_hover_font_color_' . $i]);

                    $content_odd_color = @$_POST['content_odd_color_' . $i];
                    $content_odd_hover_color = @$_POST['content_odd_hover_color_' . $i];
                    $content_even_color = @$_POST['content_even_color_' . $i];
                    $content_even_hover_color = @$_POST['content_even_hover_color_' . $i];

                    $body_li_style_bold = @$_POST['body_li_style_bold_' . $i];
                    $body_li_style_italic = @$_POST['body_li_style_italic_' . $i];
                    $body_li_style_decoration = @$_POST['body_li_style_decoration_' . $i];


                    $content_label_font_family = @stripslashes_deep(@$_POST['content_label_font_family_' . $i]);
                    $content_label_font_size = @$_POST['content_label_font_size_' . $i];
                    $content_label_font_color = @stripslashes_deep(@$_POST['content_label_font_color_' . $i]);
                    $content_label_hover_font_color = @stripslashes_deep(@$_POST['content_label_hover_font_color_' . $i]);
                    $content_label_font_style = @$_POST['content_font_style_' . $i];

                    $body_label_style_bold = @$_POST['body_label_style_bold_' . $i];
                    $body_label_style_italic = @$_POST['body_label_style_italic_' . $i];
                    $body_label_style_decoration = @$_POST['body_label_style_decoration_' . $i];

                    $button_background_color = @stripslashes_deep(@$_POST['button_background_color_' . $i]);
                    $button_hover_background_color = @stripslashes_deep(@$_POST['button_hover_background_color_' . $i]);
                    $button_font_family = @stripslashes_deep(@$_POST['button_font_family_' . $i]);
                    $button_font_size = @$_POST['button_font_size_' . $i];
                    $button_font_color = @stripslashes_deep(@$_POST['button_font_color_' . $i]);
                    $button_hover_font_color = @$_POST['button_hover_font_color_' . $i];
                    $button_font_style = @$_POST['button_font_style_' . $i];

                    $button_style_bold = @$_POST['button_style_bold_' . $i];
                    $button_style_italic = @$_POST['button_style_italic_' . $i];
                    $button_style_decoration = @$_POST['button_style_decoration_' . $i];

                    $caption = isset($_POST['caption_column_' . $i]) ? $_POST['caption_column_' . $i] : 0;

                    $footer_content = @stripslashes_deep(@$_POST['footer_content_' . $i]);
                    $footer_content_position = @$_POST['footer_content_position_' . $i];
                    $footer_text_align = @$_POST['arp_footer_text_alignment_' . $i];
                    $footer_background_color = @$_POST['footer_bg_color_' . $i];
                    $footer_hover_background_color = @$_POST['footer_hover_bg_color_' . $i];
                    $footer_level_options_font_family = @$_POST['footer_level_options_font_family_' . $i];
                    $footer_level_options_font_size = @$_POST['footer_level_options_font_size_' . $i];
                    $footer_level_options_font_color = @$_POST['footer_level_options_font_color_' . $i];
                    $footer_level_options_hover_font_color = @$_POST['footer_level_options_hover_font_color_' . $i];
                    $footer_level_options_font_style_bold = @$_POST['footer_level_options_font_style_bold_' . $i];
                    $footer_level_options_font_style_italic = @$_POST['footer_level_options_font_style_italic_' . $i];
                    $footer_level_options_font_style_decoration = @$_POST['footer_level_options_font_style_decoration_' . $i];


                    $header_shortcode = @stripslashes_deep(@$_POST['additional_shortcode_' . $i]);
                    $arp_shortcode_customization_style = @stripslashes_deep(@$_POST['arp_shortcode_customization_style_' . $i]);
                    $arp_shortcode_customization_size = @stripslashes_deep(@$_POST['arp_shortcode_customization_size_' . $i]);
                    $shortcode_background_color = @stripslashes_deep(@$_POST['shortcode_background_color_' . $i]);
                    $shortcode_font_color = @stripslashes_deep(@$_POST['shortcode_font_color_' . $i]);
                    $shortcode_hover_background_color = @stripslashes_deep(@$_POST['shortcode_hover_background_color_' . $i]);
                    $shortcode_hover_font_color = @stripslashes_deep(@$_POST['shortcode_hover_font_color_' . $i]);
                    $html_content = @stripslashes_deep(@$_POST['html_content_' . $i]);
                    $price_text = @stripslashes_deep(@$_POST['price_text_' . $i]);

                    $price_label = @stripslashes_deep(@$_POST['price_label_' . $i]);
                    $gmap_marker = @stripslashes_deep(@$_POST['gmap_marker' . $i]);
                    $total_rows = @$_POST['total_rows_' . $i];
                    $body_text_alignment = @$_POST['body_text_alignment_' . $i];

                    $ji = 1;
                    $row = array();
                    if ($total_rows > 0) {
                        for ($j = 0; $j < $total_rows; $j++) {
                            $row_title = 'row_' . $j;
                            $row_label = @stripslashes_deep(@$_POST['row_' . $i . '_label_' . $j]);
                            $row_des_align = @stripslashes_deep(@$_POST['row_' . $i . '_description_text_alignment_' . $j]);
                            $row_des = @stripslashes_deep(@$_POST['row_' . $i . '_description_' . $j]);
                            $row_des_style_bold = @stripslashes_deep(@$_POST['body_li_style_bold_column_' . $i . '_arp_row_' . $j]);
                            $row_des_style_italic = @stripslashes_deep(@$_POST['body_li_style_italic_column_' . $i . '_arp_row_' . $j]);
                            $row_des_style_decoration = @stripslashes_deep(@$_POST['body_li_style_decoration_column_' . $i . '_arp_row_' . $j]);
                            $row_caption_style_bold = @stripslashes_deep(@$_POST['body_li_style_bold_caption_column_' . $i . '_arp_row_' . $j]);
                            $row_caption_style_italic = @stripslashes_deep(@$_POST['body_li_style_italic_caption_column_' . $i . '_arp_row_' . $j]);
                            $row_caption_style_decoration = @stripslashes_deep(@$_POST['body_li_style_decoration_caption_column_' . $i . '_arp_row_' . $j]);

                            $row[$row_title] = array('row_des_txt_align' => $row_des_align, 'row_description' => $row_des, 'row_label' => $row_label, 'row_des_style_bold' => $row_des_style_bold, 'row_des_style_italic' => $row_des_style_italic, 'row_des_style_decoration' => $row_des_style_decoration, 'row_caption_style_bold' => $row_caption_style_bold, 'row_caption_style_italic' => $row_caption_style_italic, 'row_caption_style_decoration' => $row_caption_style_decoration);

                            unset($_POST['row_' . $i . '_description_text_alignment_' . $j]);
                            unset($_POST['row_' . $i . '_description_' . $j]);

                            $ji++;
                        }
                    }
                    $btn_size = @$_POST['button_size_' . $i];
                    $btn_height = @$_POST['button_height_' . $i];
                    $btn_type = @$_POST['button_type_' . $i];
                    $btn_text = @stripslashes_deep(@$_POST['btn_content_' . $i]);
                    $btn_content_second = @stripslashes_deep(@$_POST['btn_content_second_' . $i]);
                    $btn_content_third = @stripslashes_deep(@$_POST['btn_content_third_' . $i]);
                    $btn_link = @stripslashes_deep(@$_POST['btn_link_' . $i]);
                    $btn_img = @stripslashes_deep(@$_POST['btn_img_url_' . $i]);
                    $btn_img_height = @$_POST['button_img_height_' . $i];
                    $btn_img_width = @$_POST['button_img_width_' . $i];
                    $is_new_window = @$_POST['new_window_' . $i];

                    if (!isset($table_columns[$Title]['row_order']) || !is_array($table_columns[$Title]['row_order'])) {
                        @parse_str(@$_POST[$Title . '_row_order'], $col_row_order);
                        $row_order = $col_row_order;
                    }

                    $ribbon_settings = array(
                        'arp_ribbon' => $column_ribbon_style,
                        'arp_ribbon_bgcol' => $column_ribbon_bgcolor,
                        'arp_ribbon_txtcol' => $column_ribbon_txtcolor,
                        'arp_ribbon_position' => $column_ribbon_position,
                        'arp_ribbon_content' => $column_ribbon_content,
                    );

                    $column[$Title] = array(
                        'package_title' => $column_title,
                        'column_width' => $column_width,
                        'is_caption' => $caption,
                        'column_description' => $column_desc,
                        'column_highlight' => $column_highlight,
                        'column_background_color' => $column_background_color,
                        'column_hover_background_color' => $column_hover_background_color,
                        'arp_header_shortcode' => $header_shortcode,
                        'arp_shortcode_customization_size' => $arp_shortcode_customization_size,
                        'arp_shortcode_customization_style' => $arp_shortcode_customization_style,
                        'shortcode_background_color' => $shortcode_background_color,
                        'shortcode_font_color' => $shortcode_font_color,
                        'shortcode_hover_background_color' => $shortcode_hover_background_color,
                        'shortcode_hover_font_color' => $shortcode_hover_font_color,
                        'html_content' => $html_content,
                        'price_text' => $price_text,
                        'price_label' => $price_label,
                        'gmap_marker' => @$google_map_marker,
                        'body_text_alignment' => $body_text_alignment,
                        'rows' => $row,
                        'button_size' => $btn_size,
                        'button_height' => $btn_height,
                        'button_type' => $btn_type,
                        'button_text' => $btn_text,
                        'button_url' => $btn_link,
                        'btn_img' => $btn_img,
                        'btn_img_height' => $btn_img_height,
                        'btn_img_width' => $btn_img_width,
                        'is_new_window' => $is_new_window,
                        'ribbon_setting' => $ribbon_settings,
                        'header_background_color' => $header_background_color,
                        'header_hover_background_color' => $header_hover_background_color,
                        'header_background_image' => $header_background_image,
                        'header_font_family' => $header_font_family,
                        'header_font_size' => $header_font_size,
                        'header_font_style' => $header_font_style,
                        'header_font_color' => $header_font_color,
                        'header_hover_font_color' => $header_hover_font_color,
                        'header_style_bold' => $header_style_bold,
                        'header_style_italic' => $header_style_italic,
                        'header_style_decoration' => $header_style_decoration,
                        'price_background_color' => $price_background_color,
                        'price_hover_background_color' => $price_hover_background_color,
                        'price_font_family' => $price_font_family,
                        'price_font_size' => $price_font_size,
                        'price_font_style' => $price_font_style,
                        'price_font_color' => $price_font_color,
                        'price_hover_font_color' => $price_hover_font_color,
                        'price_label_style_bold' => $price_label_style_bold,
                        'price_label_style_italic' => $price_label_style_italic,
                        'price_label_style_decoration' => $price_label_style_decoration,
                        'price_text_font_family' => $price_text_font_family,
                        'price_text_font_size' => $price_text_font_size,
                        'price_text_font_style' => $price_text_font_style,
                        'price_text_font_color' => $price_text_font_color,
                        'price_text_hover_font_color' => $price_text_hover_font_color,
                        'price_text_style_bold' => $price_text_style_bold,
                        'price_text_style_italic' => $price_text_style_italic,
                        'price_text_style_decoration' => $price_text_style_decoration,
                        'content_font_family' => $content_font_family,
                        'content_font_size' => $content_font_size,
                        'content_font_style' => $content_font_style,
                        'content_font_color' => $content_font_color,
                        'content_even_font_color' => $content_even_font_color,
                        'content_hover_font_color' => $content_hover_font_color,
                        'content_even_hover_font_color' => $content_even_hover_font_color,
                        'content_odd_color' => $content_odd_color,
                        'content_odd_hover_color' => $content_odd_hover_color,
                        'content_even_color' => $content_even_color,
                        'content_even_hover_color' => $content_even_hover_color,
                        'body_li_style_bold' => $body_li_style_bold,
                        'body_li_style_italic' => $body_li_style_italic,
                        'body_li_style_decoration' => $body_li_style_decoration,
                        'content_label_font_family' => $content_label_font_family,
                        'content_label_font_size' => $content_label_font_size,
                        'content_label_font_style' => $content_label_font_style,
                        'content_label_font_color' => $content_label_font_color,
                        'content_label_hover_font_color' => $content_label_hover_font_color,
                        'body_label_style_bold' => $body_label_style_bold,
                        'body_label_style_italic' => $body_label_style_italic,
                        'body_label_style_decoration' => $body_label_style_decoration,
                        'button_background_color' => $button_background_color,
                        'button_hover_background_color' => $button_hover_background_color,
                        'button_font_family' => $button_font_family,
                        'button_font_size' => $button_font_size,
                        'button_font_color' => $button_font_color,
                        'button_hover_font_color' => $button_hover_font_color,
                        'button_font_style' => $button_font_style,
                        'button_style_bold' => $button_style_bold,
                        'button_style_italic' => $button_style_italic,
                        'button_style_decoration' => $button_style_decoration,
                        'column_description_font_family' => $column_description_font_family,
                        'column_description_font_size' => $column_description_font_size,
                        'column_description_font_style' => $column_description_font_style,
                        'column_description_font_color' => $column_description_font_color,
                        'column_description_hover_font_color' => $column_description_hover_font_color,
                        'column_desc_background_color' => $column_desc_background_color,
                        'column_desc_hover_background_color' => $column_desc_hover_background_color,
                        'column_description_style_bold' => $column_description_style_bold,
                        'column_description_style_italic' => $column_description_style_italic,
                        'column_description_style_decoration' => $column_description_style_decoration,
                        'footer_content' => $footer_content,
                        'footer_content_position' => $footer_content_position,
                        'footer_level_options_font_family' => $footer_level_options_font_family,
                        'footer_background_color' => $footer_background_color,
                        'footer_hover_background_color' => $footer_hover_background_color,
                        'footer_level_options_font_size' => $footer_level_options_font_size,
                        'footer_level_options_font_color' => $footer_level_options_font_color,
                        'footer_level_options_hover_font_color' => $footer_level_options_hover_font_color,
                        'footer_level_options_font_style_bold' => $footer_level_options_font_style_bold,
                        'footer_level_options_font_style_italic' => $footer_level_options_font_style_italic,
                        'footer_level_options_font_style_decoration' => $footer_level_options_font_style_decoration,
                        'footer_text_align' => $footer_text_align,
                        'description_text_alignment' => $column_description_text_align,
                        'price_font_align' => $price_font_align,
                        'header_font_align' => $header_font_align,
                    );
                }
            }
        } else {
            return;
        }

        $tbl_opt['columns'] = $column;
        $tbl_opt['column_order'] = $column_order;
        $table_options = maybe_serialize($tbl_opt);

        if ($pt_action == "new") {
            $ins = $wpdb->query($wpdb->prepare('INSERT INTO ' . $wpdb->prefix . 'arplite_arprice_options (table_id,table_options) VALUES (%d,%s)', $table_id, $table_options));

            $css_file_name = $template_name . '.css';

            WP_Filesystem();

            global $wp_filesystem;
            if (file_exists(ARPLITE_PRICINGTABLE_DIR . '/css/templates/' . $template_name . '_v' . $arpricelite_img_css_version . '.css')) {
                $css = file_get_contents(ARPLITE_PRICINGTABLE_DIR . '/css/templates/' . $template_name . '_v' . $arpricelite_img_css_version . '.css');
            } else {

                if (file_exists(ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/css/' . $css_file_name))
                    $css = file_get_contents(ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/css/' . $css_file_name);
                else
                    $css = file_get_contents(ARPLITE_PRICINGTABLE_DIR . '/css/templates/' . $reference_template . '_v' . $arpricelite_img_css_version . '.css');
            }

            $css_new = preg_replace('/arplitetemplate_([\d]+)/', 'arplitetemplate_' . $table_id, $css);

            $css_new = str_replace('../../images', ARPLITE_PRICINGTABLE_IMAGES_URL, $css_new);

            $path = ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/css/';

            $file_name = 'arplitetemplate_' . $table_id . '.css';

            $wp_filesystem->put_contents($path . $file_name, $css_new, 0777);
        } else {
            $ins = $wpdb->query($wpdb->prepare('UPDATE ' . $wpdb->prefix . 'arplite_arprice_options SET table_options = %s WHERE table_id = %d', $table_options, $table_id));
            $query = $wpdb->get_row($wpdb->prepare('SELECT is_template FROM ' . $wpdb->prefix . 'arplite_arprice WHERE ID = %d', $table_id));

            $is_template = $query->is_template;

            if ($is_template == 0 and ! file_exists(ARPLITE_PRICINGTABLE_UPLOAD_URL . '/css/arplitetemplate_' . $table_id . '.css')) {

                WP_Filesystem();

                global $wp_filesystem;

                $css_file_name = $template_name . '.css';

                if (file_exists(ARPLITE_PRICINGTABLE_DIR . '/css/templates/' . $template_name . '_v' . $arpricelite_version . '.css')) {
                    $css = file_get_contents(ARPLITE_PRICINGTABLE_DIR . '/css/templates/' . $template_name . '_v' . $arpricelite_img_css_version . '.css');
                } else {

                    if (file_exists(ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/css/' . $css_file_name))
                        $css = file_get_contents(ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/css/' . $css_file_name);
                    else
                        $css = file_get_contents(ARPLITE_PRICINGTABLE_DIR . '/css/templates/' . $reference_template . '_v' . $arpricelite_img_css_version . '.css');
                }

                $css_new = preg_replace('/arplitetemplate_([\d]+)/', 'arplitetemplate_' . $table_id, $css);

                $css_new = str_replace('../../images', ARPLITE_PRICINGTABLE_IMAGES_URL, $css_new);

                $path = ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/css/';

                $file_name = 'arplitetemplate_' . $table_id . '.css';

                $wp_filesystem->put_contents($path . $file_name, $css_new, 0777);
            }
        }


        /* Query for delete preview data option start */
        $all_previewoption = get_option('arplite_previewoptions');
        $all_previewoption = maybe_unserialize($all_previewoption);
        if ($all_previewoption && count($all_previewoption) > 0) {
            $option_to_delete = array();
            $day_ago_time = strtotime("-2 days");
            $all_previewoption_db = $all_previewoption;
            foreach ($all_previewoption as $opt_name => $opt_date) {
                if (isset($opt_name) && $opt_name != '' && $opt_name != '0' && $opt_date <= $day_ago_time) {
                    $option_to_delete[] = $opt_name;
                    unset($all_previewoption_db[$opt_name]);
                }
            }
            if ($option_to_delete && count($option_to_delete) > 0) {
                update_option('arplite_previewoptions', $all_previewoption_db);  // Update Remaining options
                $option_to_delete_str = @implode("','", $option_to_delete);
                $option_to_delete_str = "'" . $option_to_delete_str . "'";
                $wpdb->query("DELETE FROM " . $wpdb->options . " WHERE option_name IN (" . $option_to_delete_str . ")");
            }
        }
        /* Query for delete preview data option end */

        $get_counter = $wpdb->get_var("SELECT count(*) FROM " . $wpdb->prefix . "arplite_arprice WHERE is_template = 0");
        $already_displayed = get_option('arplite_display_popup_date');
        $popup = "";
        if ($get_counter == 1 && $already_displayed == '' && $pt_action == 'new') {
            $is_subscribed = get_option('arplite_already_subscribe');
            $display_popup = get_option('arplite_popup_display');
            if ($is_subscribed === 'no') {
                update_option('arplite_popup_display', 'yes');
            }
        }

        echo $pt_action . '~|~' . $table_id . '~|~' . $is_template;

        die();
    }

    function create($values = array()) {
        global $wpdb;

        $form_name = $values['name'];
        $dt = current_time('mysql');
        $status = $values['status'];
        $id = $values['ID'];
        $template = $values['is_template'];
        $template_name = $values['template_name'];
        $is_animated = $values['is_animated'];
        $options = $values['options'];

        $wpdb->query($wpdb->prepare("INSERT INTO " . $wpdb->prefix . "arplite_arprice (ID,table_name,template_name,general_options,is_template,is_animated,status,create_date,arp_last_updated_date) VALUES (%d,%s,%d,%s,%d,%d,%s,%s,%s) ", $id, $form_name, $template_name, $options, $template, $is_animated, $status, $dt, $dt));

        return $wpdb->insert_id;
    }

    function new_release_update($values = array()) {
        global $wpdb;

        $form_name = $values['name'];
        $dt = current_time('mysql');
        $status = $values['status'];
        $template = $values['is_template'];
        $template_name = $values['template_name'];
        $is_animated = $values['is_animated'];
        $options = $values['options'];

        
        $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "arplite_arprice set general_options = %s where template_name = %d ", $options, $template_name));

        return $template_name;
    }

    function option_create($table_id, $opts) {
        global $wpdb;
        $wpdb->query($wpdb->prepare("INSERT INTO " . $wpdb->prefix . "arplite_arprice_options(ID,table_id,table_options) VALUES (%d,%d,%s)", $table_id, $table_id, $opts));
    }

    function new_release_option_update($table_id, $opts) {
        global $wpdb;
        
        $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "arplite_arprice_options set table_options = %s where table_id = %d ", $opts, $table_id));
    }

    function get_direct_link($tbl_id = '', $chk_preview = false) {

        if (!$chk_preview) {
            $target_url = esc_url(get_home_url() . '/index.php?plugin=arpricelite&arpaction=preview&tbl=' . $tbl_id);
        } else {
            $target_url = esc_url(get_home_url() . '/index.php?plugin=arpricelite&arpaction=preview&home_view=1&tbl=' . $tbl_id);
        }

        if (is_ssl()) {
            $target_url = str_replace('http://', 'https://', $target_url);
        }

        return $target_url;
    }

    function parse_standalone_request() {
        global $arpricelite_form;
        $plugin = isset($_REQUEST['plugin']) ? $_REQUEST['plugin'] : '';

        $action = isset($_REQUEST['arpaction']) ? $_REQUEST['arpaction'] : '';

        if (!empty($plugin) and $plugin == 'arpricelite' and ! empty($action) and $action == 'preview') {

            $table_id = isset($_REQUEST['tbl']) ? $_REQUEST['tbl'] : '';
            $arpricelite_form->preview_table($table_id);
            exit;
        }
    }

    function preview_table($table_id) {

        @header("Content-Type: text/html; charset=utf-8");

        @header("Cache-Control: no-cache, must-revalidate, max-age=0");

        $is_tbl_preview = 1;

        require(ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_preview.php');
    }

    function edit_template() {
        global $wpdb;
        $arpaction_new = 'new';
        if (isset($_REQUEST['template_type']) and $_REQUEST['template_type'] == 'new') {
            
        } else if (isset($_REQUEST['template_type']) and $_REQUEST['template_type'] != '') {
            $template_id = $_REQUEST['template_type'];

            $tbl_res = $wpdb->get_row($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "arplite_arprice WHERE ID = %d", $template_id));

            $results = $wpdb->get_row($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "arplite_arprice_options WHERE table_id = %d", $tbl_res->ID));

            $new_values = array();

            $new_values['table_name'] = isset($tbl_res->table_name) ? $tbl_res->table_name : '';
            $new_values['general_options'] = isset($tbl_res->general_options) ? $tbl_res->general_options : '';
            $new_values['is_template'] = 0;
            $new_values['status'] = 'draft';
            $new_current_date = current_time('mysql');
            $new_values['create_date'] = $new_current_date;
            $new_values['arp_last_updated_date'] = $new_current_date;

            $res = $wpdb->insert($wpdb->prefix . "arplite_arprice", $new_values);
            $table_id = $wpdb->insert_id;

            $new_values = array();
            $new_values['table_id'] = $table_id;
            $new_values['table_options'] = isset($results->table_options) ? $results->table_options : '';
            $res = $wpdb->insert($wpdb->prefix . "arplite_arprice_options", $new_values);

            $general_option = maybe_unserialize($tbl_res->general_options);

            $general_font_settings = isset($general_option['font_settings']) ? $general_option['font_settings'] : array();

            $general_column_settings = isset($general_option['font_settings']) ? $general_option['column_settings'] : array();

            $general_tooltip_settings = isset($general_option['tooltip_settings']) ? $general_option['tooltip_settings'] : array();

            $new_values = array();

            $arpaction_new = 'edit';
        }

        if (file_exists(ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_listing_editor.php'))
            include(ARPLITE_PRICINGTABLE_VIEWS_DIR . '/arprice_listing_editor.php');
    }

    function arp_render_customcss($table_id, $general_option, $front_preview, $opts, $is_animated) {
        global $arplite_mainoptionsarr, $arpricelite_fonts, $arpricelite_form, $arpricelite_default_settings;

        $template_section_array = $arpricelite_default_settings->arp_column_section_background_color();

        $returnstring = "";

        $template_type = $general_option['template_setting']['template_type'];

        $general_column_settings = $general_option['column_settings'];

        $general_template_settings = $general_option['template_setting'];

        $template_color_skin = $general_template_settings['skin'];

        $general_settings = $general_option['general_settings'];

        $user_edited_columns = $general_settings['user_edited_columns'];

        $reference_template = $general_option['general_settings']['reference_template'];


        if (isset($general_template_settings['template_feature']) and ! empty($general_template_settings['template_feature'])) {
            $template_feature = maybe_unserialize($general_template_settings['template_feature']);
        } else {
            
            $template_feature = maybe_unserialize($general_template_settings['features']);
        }

        $new_values = array();

        $new_values['space_between_column'] = isset($general_column_settings['space_between_column']) ? 1 : 0;

        $new_values['column_space'] = $general_column_settings['column_space'];

        $new_values['highlight_column'] = isset($general_column_settings['highlightcolumnonhover']) ? 1 : 0;

        if ($front_preview == 1 || $front_preview == 2) {
            $new_values['caption_style'] = $template_feature['caption_style'];
        } else {
            $new_values['caption_style'] = @$general_template_settings['features']['caption_style'];
        }

        $new_value['column_wrapper_width_txtbox'] = $general_column_settings['column_wrapper_width_txtbox'];

        $new_value['column_wrapper_width_style'] = isset($general_column_settings['column_wrapper_width_style']) ? $general_column_settings['column_wrapper_width_style'] : '';

        $new_value['column_border_radius_top_left'] = ( isset($general_column_settings['column_border_radius_top_left']) and ! empty($general_column_settings['column_border_radius_top_left']) ) ? $general_column_settings['column_border_radius_top_left'] : 0;
        $new_value['column_border_radius_top_right'] = ( isset($general_column_settings['column_border_radius_top_right']) and ! empty($general_column_settings['column_border_radius_top_right']) ) ? $general_column_settings['column_border_radius_top_right'] : 0;
        $new_value['column_border_radius_bottom_right'] = ( isset($general_column_settings['column_border_radius_bottom_right']) and ! empty($general_column_settings['column_border_radius_bottom_right']) ) ? $general_column_settings['column_border_radius_bottom_right'] : 0;
        $new_value['column_border_radius_bottom_left'] = ( isset($general_column_settings['column_border_radius_bottom_left']) and ! empty($general_column_settings['column_border_radius_bottom_left']) ) ? $general_column_settings['column_border_radius_bottom_left'] : 0;

        $is_responsive = $general_column_settings['is_responsive'];

        $is_columnhover_on = $general_column_settings['column_highlight_on_hover'];



        $arp_column_bg_hover_color = $general_option['custom_skin_colors']['arp_column_bg_hover_color'];

        $arp_button_bg_hover_color = $general_option['custom_skin_colors']['arp_button_bg_hover_color'];

        $arp_header_bg_hover_color = $general_option['custom_skin_colors']['arp_header_bg_hover_color'];

        $is_columnanimation_on = ( isset($general_column_animation['is_animation']) and $general_column_animation['is_animation'] == 'yes' ) ? 1 : 0;

        extract($new_values);

        $default_luminosity = $arpricelite_default_settings->arplite_default_skin_luminosity();

        $luminosity = ($default_luminosity[$reference_template]) ? $default_luminosity[$reference_template][0] : '';
        $template_inputs = $arpricelite_default_settings->arp_template_bg_section_inputs();
        $template_inputs_ = $template_inputs[$reference_template];

        if (is_array($opts['columns'])) {
            foreach ($opts['columns'] as $c => $columns) {

                $column_type = "";
                $col_arr_key = 0;
                if ($columns['is_caption'] == 1)
                    $column_type = "caption_column";
                else
                    $column_type = "other_column";
                $col = str_replace('column_', '', $c);
                if ($column_type == 'caption_column') {
                    $col_arr_key = 0;
                } else {
                    $col_arr_key = $col % 4;
                    $col_arr_key = ($col_arr_key > 0) ? $col_arr_key : 4;
                }

                $is_colum_bg_color = false;
                if ($column_type === 'caption_column') {
                    $is_column_bg_color = (is_array($template_inputs_['caption_column']) && array_key_exists('column_background_color', $template_inputs_['caption_column'])) ? true : false;
                } else {
                    $is_column_bg_color = (is_array($template_inputs_['other_column']) && array_key_exists('column_background_color', $template_inputs_['other_column'])) ? true : false;
                }

                if (isset($columns['column_background_color']) && $columns['column_background_color'] != '' && $is_column_bg_color) {


                    $gradient_arr = $arpricelite_default_settings->arplite_default_gradient_templates();
                    $gradient_col = $arpricelite_default_settings->arplite_default_gradient_templates_colors();
                    $gradient_default_skin = $gradient_arr['default_only'];
                    $gradient_all_skin = $gradient_arr['all_skins'];
                    $all_skin_template = 0;
                    $default_skin_template = 0;

                    if (in_array($reference_template, $gradient_all_skin)) {
                        $all_skin_template = 1;
                        $default_skin_template = 0;
                    } else if (in_array($reference_template, $gradient_default_skin)) {
                        $all_skin_template = 0;
                        $default_skin_template = 1;
                    }

                    $css_class = $arplite_mainoptionsarr['general_options']['template_bg_section_classes'][$reference_template][$column_type]['column_section'];

                    $explode_css_class = explode(",", $css_class);

                    if ($all_skin_template == 1 || $default_skin_template == 1) {

                        foreach ($explode_css_class as $css_class) {
                            $colors = $gradient_col[$reference_template]['arp_color_skin']['arp_css']['column_level_gradient'][$css_class][$template_color_skin];

                            if ($template_color_skin == 'custom_skin') {
                                foreach ($explode_css_class as $column_class) {

                                    $returnstring .= " .arplitetemplate_$table_id #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_$c $column_class{";

                                    if ($colors[$col_arr_key] == "") {
                                        $properties[] = "background";
                                        $values[] = $columns['column_background_color'];
                                        foreach ($properties as $arkey => $arvalue) {
                                            $returnstring .= $arvalue . ':' . $values[$arkey] . ';';
                                        }
                                    } else {
                                        $properties = array();
                                        $values = array();

                                        $colors = explode('___', $colors[$col_arr_key]);
                                        $color1 = $colors[0];
                                        $color2 = $colors[1];
                                        $putcol = $colors[2];

                                        if ($color1 == '{arp_column_background_color}') {
                                            $color1 = str_replace('{arp_column_background_color}', $columns['column_background_color'], $color1);
                                        }

                                        preg_match('/\d{2,3}|(\.\d{2,3})/', $color2, $matches);


                                        if ($matches[0] != "") {
                                            $matches[0] = $matches[0];
                                            $color2 = $this->arp_generate_color_tone($color1, $matches[0]);
                                        } else {
                                            $color2 = $colors[1];
                                        }


                                        if ($putcol == 1) {
                                            $first_color = $color1;
                                            $base_color = $color1;
                                            $color1 = $color2;
                                        } else {
                                            $first_color = $color1;
                                            $color1 = $color1;
                                            $base_color = $color2;
                                        }

                                        $properties[] = "background";
                                        $values[] = $first_color;
                                        $properties[] = "background-color";
                                        $values[] = $first_color;
                                        $properties[] = "background-image";
                                        $values[] = "-moz-linear-gradient(top,$base_color,$color1)";
                                        $properties[] = "background-image";
                                        $values[] = "-webkit-gradient(linear,0 0, 100%, from(), to($base_color,$color1))";
                                        $properties[] = "background-image";
                                        $values[] = "-webkit-linear-gradient(top,$base_color,$color1)";
                                        $properties[] = "background-image";
                                        $values[] = "-o-linear-gradient(top,$base_color,$color1)";
                                        $properties[] = "background-image";
                                        $values[] = "linear-gradient(to bottom,$base_color,$color1)";
                                        $properties[] = "background-repeat";
                                        $values[] = "repeat-x";
                                        $properties[] = "filter";
                                        $values[] = "progid:DXImageTransform.Microsoft.gradient(startColorstr='$base_color', endColorstr='$color1', GradientType=0)";
                                        $properties[] = "-ms-filter";
                                        $values[] = "progid:DXImageTransform.Microsoft.gradient (startColorstr=$base_color, endColorstr=$color1, GradientType=0)";
                                        foreach ($properties as $arkey => $arvalue) {
                                            $returnstring .= $arvalue . ':' . $values[$arkey] . ';';
                                        }
                                    }
                                    $returnstring .= "}";
                                }
                            } else {

                                $colors = $colors[$col_arr_key];
                                foreach ($explode_css_class as $column_class) {
                                    $returnstring .= " .arplitetemplate_$table_id #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_$c $column_class{";

                                    $colors_new = $gradient_col[$reference_template]['arp_color_skin']['arp_css']['column_level_gradient'][$css_class][$template_color_skin];
                                    $column_bg_color = $columns['column_background_color'];
                                    $default_gradient_colors = array();
                                    if (is_array($colors_new) && !empty($colors_new)) {
                                        foreach ($colors_new as $key => $tmpcol) {
                                            $default_gradient_colors[$key] = substr($tmpcol, 0, 7);
                                        }
                                    }

                                    if (( $colors == "")) {
                                        $properties[] = "background";
                                        $values[] = $columns['column_background_color'];
                                        foreach ($properties as $arkey => $arvalue) {
                                            $returnstring .= $arvalue . ':' . $values[$arkey] . ';';
                                        }
                                    } else {
                                        $properties = array();
                                        $values = array();

                                        $colors = explode('___', $colors);
                                        $color1 = $colors[0];
                                        $color2 = $colors[1];
                                        $putcol = $colors[2];

                                        if ($putcol == 1) {
                                            $first_color = $color1;
                                            $base_color = $color1;
                                            $color1 = $color2;
                                        } else {
                                            $first_color = $color1;
                                            $color1 = $color1;
                                            $base_color = $color2;
                                        }

                                        $properties[] = "background";
                                        $values[] = $first_color;
                                        $properties[] = "background-color";
                                        $values[] = $first_color;
                                        $properties[] = "background-image";
                                        $values[] = "-moz-linear-gradient(top,$base_color,$color1)";
                                        $properties[] = "background-image";
                                        $values[] = "-webkit-gradient(linear,0 0, 100%, from(), to($base_color,$color1))";
                                        $properties[] = "background-image";
                                        $values[] = "-webkit-linear-gradient(top,$base_color,$color1)";
                                        $properties[] = "background-image";
                                        $values[] = "-o-linear-gradient(top,$base_color,$color1)";
                                        $properties[] = "background-image";
                                        $values[] = "linear-gradient(to bottom,$base_color,$color1)";
                                        $properties[] = "background-repeat";
                                        $values[] = "repeat-x";
                                        $properties[] = "filter";
                                        $values[] = "progid:DXImageTransform.Microsoft.gradient(startColorstr='$base_color', endColorstr='$color1', GradientType=0)";
                                        $properties[] = "-ms-filter";
                                        $values[] = "progid:DXImageTransform.Microsoft.gradient (startColorstr=$base_color, endColorstr=$color1, GradientType=0)";
                                        foreach ($properties as $arkey => $arvalue) {
                                            $returnstring .= $arvalue . ':' . $values[$arkey] . ';';
                                        }
                                    }
                                    $returnstring .= "}";
                                }
                            }
                        }
                    } else {

                        foreach ($explode_css_class as $column_class) {
                            if (!empty($column_class)) {
                                $returnstring .= " .arplitetemplate_$table_id #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_$c $column_class{";
                                $returnstring .= "background-color:{$columns['column_background_color']};";
                                $returnstring .= "}";
                            }
                        }
                    }
                }

                /* ==== Column Section Background ==== */

                /* ==== Column Desc Section Background ==== */
                $is_column_desc_bg_color = false;
                if ($column_type === 'caption_column') {
                    $is_column_desc_bg_color = ( is_array($template_inputs_['caption_column']) && array_key_exists('column_desc_background_color', $template_inputs_['caption_column'])) ? true : false;
                } else {
                    $is_column_desc_bg_color = ( is_array($template_inputs_['other_column']) && array_key_exists('column_desc_background_color', $template_inputs_['other_column'])) ? true : false;
                }

                if (isset($columns['column_desc_background_color']) && $columns['column_desc_background_color'] != '' && $is_column_desc_bg_color) {

                    $returnstring .= " .arplitetemplate_$table_id #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_$c .{$arplite_mainoptionsarr['general_options']['template_bg_section_classes'][$reference_template][$column_type]['desc_selection']}{";


                    $returnstring .= "background-color:{$columns['column_desc_background_color']};";

                    $returnstring .= "}";
                }

                /* ==== Column Desc Section Background ==== */

                /* ==== Header Section Background ==== */
                $is_column_header_bg_color = false;
                if ($column_type === 'caption_column') {
                    $is_column_header_bg_color = (is_array($template_inputs_['caption_column']) && array_key_exists('header_background_color', $template_inputs_['caption_column'])) ? true : false;
                } else {
                    $is_column_header_bg_color = ( is_array($template_inputs_['other_column']) && array_key_exists('header_background_color', $template_inputs_['other_column'])) ? true : false;
                }

                if (isset($columns['header_background_color']) && $columns['header_background_color'] != '' && $is_column_header_bg_color) {

                    $explode_header_class_arr = explode(",", $arplite_mainoptionsarr['general_options']['template_bg_section_classes'][$reference_template][$column_type]['header_section']);

                    $gradient_arr = $arpricelite_default_settings->arplite_default_gradient_templates();
                    $gradient_col = $arpricelite_default_settings->arplite_default_gradient_templates_colors();
                    $gradient_default_skin = $gradient_arr['default_only'];
                    $gradient_all_skin = $gradient_arr['all_skins'];
                    $all_skin_template = 0;
                    $default_skin_template = 0;

                    if (in_array($reference_template, $gradient_all_skin)) {
                        $all_skin_template = 1;
                        $default_skin_template = 0;
                    } else if (in_array($reference_template, $gradient_default_skin)) {
                        $all_skin_template = 0;
                        $default_skin_template = 1;
                    }

                    foreach ($explode_header_class_arr as $explode_header_class) {

                        $returnstring .= " .arplitetemplate_$table_id #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_$c .$explode_header_class {";
                        $returnstring .= "background-color:{$columns['header_background_color']};";
                        $returnstring .= "}";
                    }
                }

                /* ==== Header Section Background ==== */

                /* ==== Pricing Section Background ==== */
                $is_column_price_bg_color = false;
                if ($column_type === 'caption_column') {
                    $is_column_price_bg_color = (is_array($template_inputs_['caption_column']) && array_key_exists('price_background_color', $template_inputs_['caption_column'])) ? true : false;
                } else {
                    $is_column_price_bg_color = (is_array($template_inputs_['other_column']) && array_key_exists('price_background_color', $template_inputs_['other_column'])) ? true : false;
                }

                if (isset($columns['price_background_color']) && $columns['price_background_color'] != '' && $is_column_price_bg_color) {
                    $gradient_arr = $arpricelite_default_settings->arplite_default_gradient_templates();
                    $gradient_col = $arpricelite_default_settings->arplite_default_gradient_templates_colors();
                    $gradient_default_skin = $gradient_arr['default_only'];
                    $gradient_all_skin = $gradient_arr['all_skins'];
                    $all_skin_template = 0;
                    $default_skin_template = 0;

                    if (in_array($reference_template, $gradient_all_skin)) {
                        $all_skin_template = 1;
                        $default_skin_template = 0;
                    } else if (in_array($reference_template, $gradient_default_skin)) {
                        $all_skin_template = 0;
                        $default_skin_template = 1;
                    }

                    $css_class = (isset($arplite_mainoptionsarr['general_options']['template_bg_section_classes'][$reference_template][$column_type]['pricing_section'])) ? $arplite_mainoptionsarr['general_options']['template_bg_section_classes'][$reference_template][$column_type]['pricing_section'] : '';

                    if ($all_skin_template == 1 || $default_skin_template == 1) {

                        $colors = $gradient_col[$reference_template]['arp_color_skin']['arp_css']['pricing_level_gradient']['.' . $css_class][$template_color_skin];

                        if ($template_color_skin == 'custom_skin') {

                            $returnstring .= " .arplitetemplate_$table_id #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_$c .$css_class{";

                            if ($colors[$col_arr_key] == "") {
                                $properties[] = "background";
                                $values[] = $columns['price_background_color'];
                                foreach ($properties as $arkey => $arvalue) {
                                    $returnstring .= $arvalue . ':' . $values[$arkey] . ';';
                                }
                            } else {
                                $properties = array();
                                $values = array();

                                $colors = explode('___', $colors[$col_arr_key]);
                                $color1 = $colors[0];
                                $color2 = $colors[1];
                                $putcol = $colors[2];

                                if ($color1 == '{arp_pricing_background_color_input}') {
                                    $color1 = str_replace('{arp_pricing_background_color_input}', $columns['price_background_color'], $color1);
                                }

                                preg_match('/\d{2,3}|(\.\d{2,3})/', $color2, $matches);


                                if ($matches[0] != "") {
                                    $matches[0] = $matches[0];
                                    $color2 = $this->arp_generate_color_tone($color1, $matches[0]);
                                } else {
                                    $color2 = $colors[1];
                                }


                                if ($putcol == 1) {
                                    $first_color = $color1;
                                    $base_color = $color1;
                                    $color1 = $color2;
                                } else {
                                    $first_color = $color1;
                                    $color1 = $color1;
                                    $base_color = $color2;
                                }

                                $properties[] = "background";
                                $values[] = $first_color;
                                $properties[] = "background-color";
                                $values[] = $first_color;
                                $properties[] = "background-image";
                                $values[] = "-moz-linear-gradient(top,$base_color,$color1)";
                                $properties[] = "background-image";
                                $values[] = "-webkit-gradient(linear,0 0, 100%, from(), to($base_color,$color1))";
                                $properties[] = "background-image";
                                $values[] = "-webkit-linear-gradient(top,$base_color,$color1)";
                                $properties[] = "background-image";
                                $values[] = "-o-linear-gradient(top,$base_color,$color1)";
                                $properties[] = "background-image";
                                $values[] = "linear-gradient(to bottom,$base_color,$color1)";
                                $properties[] = "background-repeat";
                                $values[] = "repeat-x";
                                $properties[] = "filter";
                                $values[] = "progid:DXImageTransform.Microsoft.gradient(startColorstr='$base_color', endColorstr='$color1', GradientType=0)";
                                $properties[] = "-ms-filter";
                                $values[] = "progid:DXImageTransform.Microsoft.gradient (startColorstr=$base_color, endColorstr=$color1, GradientType=0)";

                                foreach ($properties as $arkey => $arvalue) {
                                    $returnstring .= $arvalue . ':' . $values[$arkey] . ';';
                                }
                            }
                            $returnstring .= "}";
                        } else {

                            $colors = $colors[$col_arr_key];

                            $returnstring .= " .arplitetemplate_$table_id #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_$c .$css_class{";
                            if ($colors == "") {
                                $properties[] = "background";
                                $values[] = $columns['price_background_color'];
                                foreach ($properties as $arkey => $arvalue) {
                                    $returnstring .= $arvalue . ':' . $values[$arkey] . ';';
                                }
                            } else {
                                $properties = array();
                                $values = array();
                                $colors = explode('___', $colors);
                                $color1 = $colors[0];
                                $color2 = $colors[1];
                                $putcol = $colors[2];

                                if ($putcol == 1) {
                                    $first_color = $color1;
                                    $base_color = $color1;
                                    $color1 = $color2;
                                } else {
                                    $first_color = $color1;
                                    $color1 = $color1;
                                    $base_color = $color2;
                                }

                                $properties[] = "background";
                                $values[] = $first_color;
                                $properties[] = "background-color";
                                $values[] = $first_color;
                                $properties[] = "background-image";
                                $values[] = "-moz-linear-gradient(top,$base_color,$color1)";
                                $properties[] = "background-image";
                                $values[] = "-webkit-gradient(linear,0 0, 100%, from(), to($base_color,$color1))";
                                $properties[] = "background-image";
                                $values[] = "-webkit-linear-gradient(top,$base_color,$color1)";
                                $properties[] = "background-image";
                                $values[] = "-o-linear-gradient(top,$base_color,$color1)";
                                $properties[] = "background-image";
                                $values[] = "linear-gradient(to bottom,$base_color,$color1)";
                                $properties[] = "background-repeat";
                                $values[] = "repeat-x";
                                $properties[] = "filter";
                                $values[] = "progid:DXImageTransform.Microsoft.gradient(startColorstr='$base_color', endColorstr='$color1', GradientType=0)";
                                $properties[] = "-ms-filter";
                                $values[] = "progid:DXImageTransform.Microsoft.gradient (startColorstr=$base_color, endColorstr=$color1, GradientType=0)";
                                foreach ($properties as $arkey => $arvalue) {
                                    $returnstring .= $arvalue . ':' . $values[$arkey] . ';';
                                }
                            }
                            $returnstring .= "}";
                        }
                    } else {
                        $returnstring .= " .arplitetemplate_$table_id #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_$c .$css_class{";
                        $returnstring .= "background-color:{$columns['price_background_color']};";
                        $returnstring .= "}";
                    }
                }

                /* ==== Pricing Section Background ==== */

                /* ==== Button Background ==== */
                $is_button_bg_color = false;
                if ($column_type === 'caption_column') {
                    $is_button_bg_color = (is_array($template_inputs_['caption_column']) && array_key_exists('button_background_color', $template_inputs_['caption_column'])) ? true : false;
                } else {
                    $is_button_bg_color = (is_array($template_inputs_['other_column']) && array_key_exists('button_background_color', $template_inputs_['other_column'])) ? true : false;
                }
                if (isset($columns['button_background_color']) && $columns['button_background_color'] != '' && $is_button_bg_color) {
                    $returnstring .= " .arplitetemplate_$table_id #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_$c .{$arplite_mainoptionsarr['general_options']['template_bg_section_classes'][$reference_template][$column_type]['button_section']}{";
                    $returnstring .= "background-color:{$columns['button_background_color']};";
                    $returnstring .= "}";
                }

                /* ==== Button Background ==== */

                /* ==== Footer Section ==== */
                $is_footer_bg_color = false;
                if ($column_type === 'caption_column') {
                    $is_footer_bg_color = (is_array($template_inputs_['caption_column']) && array_key_exists('footer_background_color', $template_inputs_['caption_column'])) ? true : false;
                } else {
                    $is_footer_bg_color = (is_array($template_inputs_['other_column']) && array_key_exists('footer_background_color', $template_inputs_['other_column'])) ? true : false;
                }

                if (isset($columns['footer_background_color']) && $columns['footer_background_color'] != '' && $is_footer_bg_color) {

                    $returnstring .= " .arplitetemplate_$table_id #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_$c .{$arplite_mainoptionsarr['general_options']['template_bg_section_classes'][$reference_template][$column_type]['footer_section']}{";
                    $returnstring .= "background:{$columns['footer_background_color']};";
                    $returnstring .= "}";
                }

                /* ==== Footer Section ==== */

                /* ==== Body Alternate Background Effect ==== */
                $is_content_odd_bg_color = false;
                if ($column_type === 'caption_column') {
                    $is_body_section = ( is_array($template_inputs_['caption_column']) && array_key_exists('body_section', $template_inputs_['caption_column']) ) ? true : false;
                    $is_content_odd_bg_color = ( $is_body_section && is_array($template_inputs_['caption_column']['body_section']) && array_key_exists('content_odd_color', $template_inputs_['caption_column']['body_section'])) ? true : false;
                   
                } else {
                    $is_body_section = is_array($template_inputs_['other_column']) && array_key_exists('body_section', $template_inputs_['other_column']) ? true : false;
                    $is_content_odd_bg_color = ($is_body_section && $template_inputs_['other_column']['body_section'] && array_key_exists('content_odd_color', $template_inputs_['other_column']['body_section'])) ? true : false;
                }

                if (isset($columns['content_odd_color']) && $columns['content_odd_color'] != '' && $is_content_odd_bg_color) {
                   
                    $returnstring .= " .arplitetemplate_$table_id #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_$c .{$arplite_mainoptionsarr['general_options']['template_bg_section_classes'][$reference_template][$column_type]['body_section']['odd_row']} {";
                    $returnstring .= "background:{$columns['content_odd_color']}";
                    $returnstring .= "}";
                }

                $is_content_even_bg_color = false;
                if ($column_type === 'caption_column') {
                    $is_body_section = (is_array(@$template_inputs_['caption_column']) && array_key_exists('body_section', $template_inputs_['caption_column'])) ? true : false;
                    $is_content_even_bg_color = ($is_body_section && is_array($template_inputs_['caption_column']['body_section']) && array_key_exists('content_even_color', $template_inputs_['caption_column']['body_section'])) ? true : false;
                } else {
                    $is_body_section = is_array(@$template_inputs_['other_column']) && array_key_exists('body_section', $template_inputs_['other_column']) ? true : false;
                    $is_content_even_bg_color = ($is_body_section && is_array(@$template_inputs_['other_column']['body_section']) && array_key_exists('content_even_color', $template_inputs_['other_column']['body_section'])) ? true : false;
                }

                if (isset($columns['content_even_color']) && $columns['content_even_color'] != '' && $is_content_even_bg_color) {
                    $returnstring .= " .arplitetemplate_$table_id #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_$c .{$arplite_mainoptionsarr['general_options']['template_bg_section_classes'][$reference_template][$column_type]['body_section']['even_row']} {";
                    $returnstring .= "background:{$columns['content_even_color']}";
                    $returnstring .= "}";
                }

                /* ==== Body Alternate Background Effect ==== */

                /* ==== Hover Color Effect ==== */

                if ($columns['is_caption'] != 0) {
                    $returnstring .= " .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .arpcolumnheader .arpcaptiontitle";
                    $returnstring .= " {";
                    $returnstring .= "font-family: " . stripslashes($columns['header_font_family']) . ";font-size: " . $columns['header_font_size'] . "px; ";
                    if ($columns['header_style_bold'] != '')
                        $returnstring .= " font-weight: " . $columns['header_style_bold'] . ";";

                    if ($columns['header_style_italic'] != '')
                        $returnstring .= " font-style: " . $columns['header_style_italic'] . ";";

                    if ($columns['header_style_decoration'] != '')
                        $returnstring .= " text-decoration: " . $columns['header_style_decoration'] . ";";


                    $returnstring .= " color: " . $columns['header_font_color'] . "; }";
                } else {
                    $returnstring .= " .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .arpcolumnheader .bestPlanTitle{";
                    $returnstring .= " color: " . $columns['header_font_color'] . "; }";
                }


                if ($template_type == 'normal') {

                    $returnstring .= "  .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .arp_price_wrapper, .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .arp_price_wrapper_text, .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .arp_price_wrapper_text .arp_price_value, .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .arp_price_wrapper_text .arp_price_duration{";

                    $returnstring .= "color:" . $columns['price_font_color'] . ";";
                    $returnstring .= "}";
                } else if ($template_type == 'advanced') {

                    $returnstring .= "  .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .arp_price_value, .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .arp_price_value_text{";

                    $returnstring .= "color:" . $columns['price_font_color'] . ";";
                    $returnstring .= "}";


                    $returnstring .= "  .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .arp_price_duration, .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .arp_price_duration_text{";

                    $returnstring .= "color:" . $columns['price_text_font_color'] . ";";
                    $returnstring .= "}";
                }

                if ($caption_style == 'style_1' || $caption_style == 'style_2') {
                    $returnstring .= " .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .arp_opt_options li span.caption_detail, .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .arp_opt_options li .arp_caption_detail_text";

                    $returnstring .= "{";
                    $returnstring .= "color:" . $columns['content_font_color'] . ";";

                    $returnstring .= "}";
                }

                $returnstring .= ".arplite_price_table_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .arp_opt_options li.arp_odd_row{";
                $returnstring .= "color:" . $columns['content_font_color'] . ";";
                $returnstring .= "}";
                $returnstring .= ".arplite_price_table_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .arp_opt_options li.arp_even_row{";
                $returnstring .= "color:" . $columns['content_even_font_color'] . ";";
                $returnstring .= "}";

                /* for  li level custom font style */
                if (is_array($columns['rows'])) {
                    $row_count = 0;
                    foreach ($columns['rows'] as $i => $row_detail) {

                        if ($caption_style == 'style_1' || $caption_style == 'style_2') {
                            $returnstring .= " .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper:not(.no_transition).style_" . $c . " .arp_opt_options li, .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper:not(.no_transition).style_" . $c . " .arp_opt_options li";
                            $returnstring .= "{";

                            $returnstring .= "color:" . $columns['content_font_color'] . ";";

                            $returnstring .= "}";


                            /* Preview Editor Change */

                            $returnstring .= ".arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.no_transition.style_" . $c . " .arp_opt_options li.arp_" . $c . "_row_" . $row_count . " span.caption_detail, .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.no_transition.style_" . $c . " .arp_opt_options li.arp_" . $c . "_row_" . $row_count . " .arp_caption_detail_text";
                            $returnstring .= "{";

                            $returnstring .= "color:" . $columns['content_font_color'] . ";";
                            $returnstring .= "}";

                            /* Preview Editor Change */


                            $returnstring .= " .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper:not(.no_transition).style_" . $c . " .arp_opt_options li, .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper:not(.no_transition).style_" . $c . " .arp_opt_options li";
                            $returnstring .= "{";

                            $returnstring .= "color:" . $columns['content_label_font_color'] . ";";

                            $returnstring .= "}";

                            /* Preview Editor Change */

                            $returnstring .= " .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.no_transition.style_" . $c . " .arp_opt_options li.arp_" . $c . "_row_" . $row_count . " span.caption_li, .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.no_transition.style_" . $c . " .arp_opt_options li.arp_" . $c . "_row_" . $row_count . " .arp_caption_li_text";
                            $returnstring .= "{";

                            $returnstring .= "color:" . $columns['content_label_font_color'] . ";";

                            $returnstring .= "}";

                            /* Preview Editor Change */
                        } else {
                            $returnstring .= " .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper:not(.no_transition).style_" . $c . " .arp_opt_options li,.arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper:not(.no_transition).style_" . $c . " .arp_opt_options li";

                            $returnstring .= "{";
                            if ($columns['is_caption'] != 0) {
                                $returnstring .= "font-family:" . stripslashes_deep($columns['content_font_family']) . ";";
                                $returnstring .= "font-size:" . $columns['content_font_size'] . "px;";

                                if ($row_detail['row_des_style_bold'] != '')
                                    $returnstring .= " font-weight: " . $row_detail['row_des_style_bold'] . ";";

                                if ($row_detail['row_des_style_italic'] != '')
                                    $returnstring .= " font-style: " . $row_detail['row_des_style_italic'] . ";";

                                if ($row_detail['row_des_style_decoration'] != '')
                                    $returnstring .= " text-decoration: " . $row_detail['row_des_style_decoration'] . ";";

//                                $returnstring .= "color:" . $columns['content_font_color'] . ";";
                            }


                            $returnstring .= "}";

                            /* Preview Editor Change */

                            $returnstring .= ".arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.no_transition.style_" . $c . " .arp_opt_options li.arp_" . $c . "_row_" . $row_count;
                            $returnstring .= "{";
                            if ($columns['is_caption'] != 0) {
                                $returnstring .= "font-family:" . stripslashes_deep($columns['content_font_family']) . ";";
                                $returnstring .= "font-size:" . $columns['content_font_size'] . "px;";

                                if ($row_detail['row_des_style_bold'] != '')
                                    $returnstring .= " font-weight: " . $row_detail['row_des_style_bold'] . ";";

                                if ($row_detail['row_des_style_italic'] != '')
                                    $returnstring .= " font-style: " . $row_detail['row_des_style_italic'] . ";";

                                if ($row_detail['row_des_style_decoration'] != '')
                                    $returnstring .= " text-decoration: " . $row_detail['row_des_style_decoration'] . ";";
                                $returnstring .= "color:" . $columns['content_font_color'] . ";";
                            }
                            $returnstring .= "}";

                            /* Preview Editor Change */
                        }
                        $row_count++;
                    }
                }

                $returnstring .= " .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .bestPlanButton:not(.SecondBestPlanButton), .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .bestPlanButton:not(.SecondBestPlanButton) .bestPlanButton_text";

                $returnstring .= "{";

                $returnstring .= "color:" . $columns['button_font_color'] . ";";

                $returnstring .= "}";
                
                if (isset($columns['button_size']) && isset($columns['button_height'])) {
                    
                    $returnstring .= " .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .bestPlanButton, .arp_price_table_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .bestPlanButton";
                    $returnstring .= "{";
                    $returnstring .= "width:" . $columns['button_size'] . "px;";
                    $returnstring .= "height:" . $columns['button_height'] . "px;";
                    $returnstring .= "}";
                }



                $returnstring .= " .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .column_description{";

                $returnstring .= "color:" . stripslashes_deep($columns['column_description_font_color']) . ";";


                $returnstring .= "}";

                $returnstring .= " .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .caption_li, .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .arp_caption_li_text{";

                if (isset($columns['body_label_style_bold']) && $columns['body_label_style_bold'] != '')
                    $returnstring .= " font-weight: " . $columns['body_label_style_bold'] . ";";

                if (isset($columns['body_label_style_italic']) && $columns['body_label_style_italic'] != '')
                    $returnstring .= " font-style: " . $columns['body_label_style_italic'] . ";";

                if (isset($columns['body_label_style_decoration']) && $columns['body_label_style_decoration'] != '')
                    $returnstring .= " text-decoration: " . $columns['body_label_style_decoration'] . ";";


                $returnstring .= "font-family:" . stripslashes_deep(isset($columns['content_label_font_family']) ? $columns['content_label_font_family'] : "") . ";";
                $returnstring .= "font-size:" . ( isset($columns['content_label_font_size']) ? $columns['content_label_font_size'] : "" ) . 'px;';
                $returnstring .= "color:" . ( isset($columns['content_label_font_color']) ? $columns['content_label_font_color'] : "" ) . ";";


                $returnstring .= "}";

                /* content column css start */
                if ($columns['is_caption'] != 0) {

                    $returnstring .= '.arplitetemplate_' . $table_id . ' .style_column_0 .arp_footer_content {';
                    $returnstring .= 'margin: 5px;';
                    $returnstring .= 'color: ' . $columns['footer_level_options_font_color'] . ';';

                    $returnstring .= 'font-family: ' . $columns['footer_level_options_font_family'] . ';';
                    $returnstring .= 'font-size:' . $columns['footer_level_options_font_size'] . 'px;';
                    if ($columns['footer_level_options_font_style_bold'] == 'bold') {
                        $returnstring .= 'font-weight: bold;';
                    }
                    if ($columns['footer_level_options_font_style_italic'] == 'italic') {
                        $returnstring .= 'font-style: italic;';
                    }
                    if ($columns['footer_level_options_font_style_decoration'] == 'underline') {
                        $returnstring .= 'text-decoration: underline;';
                    } else if ($columns['footer_level_options_font_style_decoration'] == 'line-through') {
                        $returnstring .= 'text-decoration: line-through;';
                    }
                      $returnstring .= '}';
                }
              

                /* text-align */
                $arp_section_text_alignment = $arpricelite_default_settings->arp_section_text_alignment();
                $arp_section_text_alignment = isset($arp_section_text_alignment[$reference_template]) ? $arp_section_text_alignment[$reference_template] : array();                
                if ($columns['is_caption'] != 0) {
                    
                    $arp_section_text_alignment = $arp_section_text_alignment['caption_column'];
                    if (isset($columns['header_font_align']) && array_key_exists('header_section', $arp_section_text_alignment)) {
                        $returnstring .= " .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " ." . $arp_section_text_alignment['header_section'] . "{";
                        $returnstring .="text-align:" . $columns['header_font_align'] . ";";
                        $returnstring .="}";
                    }      
                     
                    if (isset($columns['footer_text_align']) && array_key_exists('footer_section', $arp_section_text_alignment)) {
                       
                        $returnstring .= " .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " ." . $arp_section_text_alignment['footer_section'] . "{";
                        $returnstring .="text-align:" . $columns['footer_text_align'] . ";";
                        $returnstring .="}";
                    }
                } else {
                    
                    $arp_section_text_alignment = isset($arp_section_text_alignment['other_column']) ? $arp_section_text_alignment['other_column'] : array();
                    
                    if (isset($general_column_settings['arp_header_text_alignment']) && array_key_exists('header_section', $arp_section_text_alignment)) {
                        $returnstring .= " .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .arp_column_content_wrapper ." . $arp_section_text_alignment['header_section'] . "{";
                        
                        $returnstring .="text-align:" . $general_column_settings['arp_header_text_alignment'] . ";";
                        $returnstring .="}";
                        
                    }
                    if (isset($general_column_settings['arp_price_text_alignment']) && array_key_exists('pricing_section', $arp_section_text_alignment)) {
                        $returnstring .= " .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " ." . $arp_section_text_alignment['pricing_section'] . "{";
                        $returnstring .="text-align:" . $general_column_settings['arp_price_text_alignment'] . ";";
                        $returnstring .="}";
                    }
                    if (isset($general_column_settings['arp_footer_text_alignment']) && array_key_exists('footer_section', $arp_section_text_alignment)) {
                        $returnstring .= " .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " ." . $arp_section_text_alignment['footer_section'] . "{";
                        $returnstring .="text-align:" . $general_column_settings['arp_footer_text_alignment'] . ";";
                        $returnstring .="}";
                    }
                    if (isset($general_column_settings['arp_body_text_alignment']) && array_key_exists('body_section', $arp_section_text_alignment)) {
                        $returnstring .= " .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " ." . $arp_section_text_alignment['body_section'] . "{";
                        $returnstring .="text-align:" . $general_column_settings['arp_body_text_alignment'] . ";";
                        $returnstring .= "}";
                    }

                    if (isset($general_column_settings['arp_description_text_alignment']) && array_key_exists('column_description_section', $arp_section_text_alignment)) {
                        $returnstring .= " .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " ." . $arp_section_text_alignment['column_description_section'] . "{";
                        $returnstring .="text-align:" . $general_column_settings['arp_description_text_alignment'] . ";";
                        $returnstring .="}";
                    }
                }
                /* text-align */

                /* content column css end */
                if ($columns['is_caption'] == 0) {
                    $returnstring .= '.arplitetemplate_' . $table_id . ' .style_' . $c . ' .arp_footer_content{';

                    $returnstring .= 'margin: 5px;';
                    $returnstring .= 'color: ' . $columns['footer_level_options_font_color'] . ';';

                    $returnstring .= '}';
                }
                /* shortcode customization */

                if (isset($columns['arp_shortcode_customization_style']) && isset($columns['arp_shortcode_customization_size'])) {
                    $returnstring .= " .arplite_price_table_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .rounded_corder i{";

                    $returnstring .="color : " . @$columns['shortcode_font_color'] . "; ";

                    $returnstring .="}";
                    $returnstring .= " .arplite_price_table_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .rounded_corder{";
                    $shortcode_array = $arpricelite_default_settings->arp_shortcode_custom_type();

                    $returnstring .="color : " . @$columns['shortcode_font_color'] . "; ";

                    $returnstring .="border-color : " . @$columns['price_background_color'] . "; ";

                    if (@$shortcode_array[$columns['arp_shortcode_customization_style']]['type'] == 'solid') {

                        $returnstring .="background-color : " . @$columns['shortcode_background_color'] . "; ";
                    }
                    $returnstring .="border-color : " . @$columns['shortcode_background_color'] . "; ";

                    $returnstring .="}";
                }
                /* shortcode customization */



                $arp_button_type = $arpricelite_default_settings->arp_button_type();
                if ($general_column_settings['arp_global_button_type'] == 'shadow') {
                    $returnstring .= " .arplite_price_table_" . $table_id . ":not(.arp_admin_template_editor) #ArpPricingTableColumns .ArpPricingTableColumnWrapper.style_" . $c . " .bestPlanButton." . $arp_button_type[$general_column_settings['arp_global_button_type']]['class'] . ":hover{";
                    $color = $arpricelite_form->hex2rgb($columns['button_hover_background_color']);
//                    if ($reference_template == 'arplitetemplate_11') {
//                        $color = $arpricelite_default_settings->arp_template_hover_class_array();
//                        $color = $color['arplitetemplate_11']['arp_skin_hover_css']['.bestPlanButton_^_1']['background'][$template_color_skin];
//                        $color = $arpricelite_form->hex2rgb($color);
//                    }

                    $returnstring .= 'background-color:rgba(' . $color['red'] . ',' . $color['green'] . ',' . $color['blue'] . ',0.75) !important';
                    $returnstring .="}";
                }
            }
        }

        $returnstring .= " .arplitetemplate_" . $table_id . " .fa{";
        $returnstring .= " font-family:FontAwesome !important; ";
        $returnstring .= "}";

        $returnstring .= " .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper{
				margin-right: " . ($column_space / 2) . "px;
				margin-left: " . ($column_space / 2) . "px;
			}";
        if ($column_space > 0) {
            $arp_border_array = $arpricelite_default_settings->arp_border_color();
            $arp_border_array = isset($arp_border_array[$reference_template]) ? $arp_border_array[$reference_template] : '';

            if (!empty($arp_border_array['caption_column'])) {
                foreach ($arp_border_array['caption_column'] as $class => $arr) {
                    $class_name = $class;
                    $border_size = $arr['border_size'];
                    $border_color = $arr['border_color'];
                    $border_type = $arr['border_type'];
                    $border_position = $arr['border_position'];
                    $brdposition = explode('|^|', $border_position);
                    if ($border_position == 'all') {
                        
                    } else {
                        foreach ($brdposition as $pstn) {
                            $returnstring .= ".arplitetemplate_" . $table_id . " .maincaptioncolumn " . $class . "{";
                            $returnstring .= "border-" . $pstn . ":" . $border_size . " " . $border_type . " " . $border_color . " !important;";
                            $returnstring .= "}";
                        }
                    }
                }
            }

            if (!empty($arp_border_array['other_column'])) {
                foreach ($arp_border_array['other_column'] as $class => $arr) {
                    $class_name = $class;
                    $border_size = $arr['border_size'];
                    $border_color = $arr['border_color'];
                    $border_type = $arr['border_type'];
                    $border_position = $arr['border_position'];
                    $brdposition = explode('|^|', $border_position);
                    if ($border_position == 'all') {
                        
                    } else {
                        foreach ($brdposition as $pstn) {

                            $returnstring .= ".arplitetemplate_" . $table_id . " .ArpPricingTableColumnWrapper:not(.maincaptioncolumn) " . $class . "{";
                            $returnstring .= "border-" . $pstn . ":" . $border_size . " " . $border_type . " " . $border_color . " !important;";
                            $returnstring .= "}";
                        }
                    }
                }
            }
        }

        global $arplite_pricingtable, $arplite_templatehoverclassarr, $arpricelite_default_settings;
        $arplite_templatehoverclassarr = $arpricelite_default_settings->arp_template_hover_class_array();

        $exclude_caption = $arpricelite_default_settings->arplite_exclude_caption_column_for_color_skin();
        $is_exclude_caption = $exclude_caption[$reference_template];

        $caption_column_odd_color = !empty($opts['columns']['column_0']['content_odd_color']) ? $opts['columns']['column_0']['content_odd_color'] : '';
        $caption_column_even_color = !empty($opts['columns']['column_0']['content_even_color']) ? $opts['columns']['column_0']['content_even_color'] : '';

        $content_odd_color = isset($columns['content_odd_color'])?$columns['content_odd_color']:'';
        $content_even_color = isset($columns['content_even_color'])?$columns['content_even_color']:'';
        $skinarr = array();

        if (!empty($arplite_templatehoverclassarr[$reference_template])) {

            $common_skin = isset($arplite_templatehoverclassarr[$reference_template]['arp_common_hover_css']) ? $arplite_templatehoverclassarr[$reference_template]['arp_common_hover_css'] : '';
            $color_skins = isset($arplite_templatehoverclassarr[$reference_template]['arp_skin_hover_css']) ? $arplite_templatehoverclassarr[$reference_template]['arp_skin_hover_css'] : '';
            $columns = $opts['columns'];
            $element_hover = "";
            $parent_hover = "";
            $g = 1;
            $grc = 1;

            $cap_cols = array();
            $start = 0;


            foreach ($columns as $c => $column) {

                if ($column['is_caption'] == 1) {
                    $start++;
                    continue;
                }

                $col = str_replace('column_', '', $c);
                $col_arr_key = $col % 4;
                $col_arr_key = ($col_arr_key > 0) ? $col_arr_key : 4;


                $g = ($general_option['template_setting']['skin'] == 'custom_skin') ? 0 : 1;
                $caption_column_odd_color = isset($opts['columns']['column_0']['content_odd_color']) ? $opts['columns']['column_0']['content_odd_color'] : "";
                $caption_column_even_color = isset($opts['columns']['column_0']['content_even_color']) ? $opts['columns']['column_0']['content_even_color'] : "";

                $content_odd_color = isset($column['content_odd_color']) ? $column['content_odd_color'] : "";
                $content_even_color = isset($column['content_even_color']) ? $column['content_even_color'] : "";
                /*
                  if ($column_type == 'caption_column') {
                  $column['content_odd_color'] = $template_section_array[$reference_template][$template_color_skin]['arp_body_caption_odd_row_bg_color'][1];
                  } else {
                  $column['content_odd_color'] = isset($template_section_array[$reference_template][$template_color_skin]['arp_body_odd_row_background_color'][0]) ? $template_section_array[$reference_template][$template_color_skin]['arp_body_odd_row_background_color'][0] : '';
                  }

                  if ($column_type == 'caption_column') {
                  $column['content_even_color'] = $template_section_array[$reference_template][$template_color_skin]['arp_body_caption_even_row_bg_color'][0];
                  } else {
                  $column['content_even_color'] = isset($template_section_array[$reference_template][$template_color_skin]['arp_body_even_row_background_color'][0]) ? $template_section_array[$reference_template][$template_color_skin]['arp_body_even_row_background_color'][0] : "";
                  }

                  $column['footer_background_color'] = isset($template_section_array[$reference_template][$template_color_skin]['arp_footer_background']) ? $template_section_array[$reference_template][$template_color_skin]['arp_footer_background'][$col_arr_key] : '';

                  $column['column_background_color'] = isset($template_section_array[$reference_template][$template_color_skin]['arp_column_background']) ? $template_section_array[$reference_template][$template_color_skin]['arp_column_background'][$col_arr_key] : '';

                  $column['column_desc_background_color'] = isset($template_section_array[$reference_template][$template_color_skin]['arp_desc_background']) ? $template_section_array[$reference_template][$template_color_skin]['arp_desc_background'][$col_arr_key] : '';

                  $column['header_background_color'] = isset($template_section_array[$reference_template][$template_color_skin]['arp_header_background']) ? $template_section_array[$reference_template][$template_color_skin]['arp_header_background'][$col_arr_key] : ''; */

                if (!empty($common_skin)) {
                    foreach ($common_skin as $class_key => $cskin) {

                        $str = '';
                        $class_key = explode('_^_', $class_key);
                        $class_name = $class_key[0];
                        $class_name = str_replace("[ARP_SPACE]", " ", $class_name);
                        $hover = $class_key[1];
                        if ($hover == 0) {
                            $element_hover = ":hover";
                            $parent_hover = "";
                        } else {
                            $element_hover = "";
                            $parent_hover = ":hover";
                        }

                        $str .= ".arplitetemplate_$table_id .ArpPricingTableColumnWrapper.no_animation.arp_style_$start:not(.no_transition):not(.maincaptioncolumn)$parent_hover $class_name";
                        $str .= $element_hover;
                        $str .= ",.arplitetemplate_$table_id .ArpPricingTableColumnWrapper.no_animation.arp_style_$start:not(.no_transition):not(.maincaptioncolumn).column_highlight $class_name$element_hover";
                        $str .="{";

                        foreach ($cskin as $property => $values) {

                            $values = explode('<==>', $values);

                            $values_ = isset($values[0]) ? $values[0] : '';
                            $parameter = isset($values[1]) ? $values[1] : '';
                            $points = isset($values[2]) ? $values[2] : '';
                            if (preg_match('/____/', $values_)) {
                                $values_ = explode('____', $values_);
                            } else {
                                $value = $values_;
                            }


                            $value = ( is_array($values_) and count($values_) > 1 ) ? $values_[1] : $values_;

                            $arp_button_bg_hover_color = isset($column['button_hover_background_color']) ? $column['button_hover_background_color'] : $general_option['custom_skin_colors']['arp_button_bg_hover_color'];
                            $arp_button_hover_font_color = isset($column['button_hover_font_color']) ? $column['button_hover_font_color'] : '';

                            $arp_column_bg_hover_color = isset($column['column_hover_background_color']) ? $column['column_hover_background_color'] : $general_option['custom_skin_colors']['arp_column_bg_hover_color'];


                            if (isset($general_option['custom_skin_colors']['arp_footer_content_bg_color']) and ! empty($general_option['custom_skin_colors']['arp_footer_content_bg_color']) && $template_color_skin == 'custom_skin') {
                                $arp_footer_bg_hover_color = $general_option['custom_skin_colors']['arp_footer_content_bg_color'];
                            } else {
                                $arp_footer_bg_hover_color = @$column['footer_background_color'];
                            }


                            if (isset($general_option['custom_skin_colors']['arp_header_bg_custom_color']) and ! empty($general_option['custom_skin_colors']['arp_header_bg_custom_color']) && $template_color_skin == 'custom_skin') {
                                $arp_header_bg_hover_color = $general_option['custom_skin_colors']['arp_header_bg_custom_color'];
                            } else {
                                $arp_header_bg_hover_color = isset($column['header_hover_background_color']) ? $column['header_hover_background_color'] : $general_option['custom_skin_colors']['arp_header_bg_custom_color'];
                            }

                            $arp_header_bg_hover_custom_color = isset($column['header_hover_background_color']) ? $column['header_hover_background_color'] : $general_option['custom_skin_colors']['arp_header_bg_hover_color'];

                            $arp_header_hover_font_color = isset($column['header_hover_font_color']) ? $column['header_hover_font_color'] : '';
                            $arp_price_bg_hover_custom_color = isset($column['price_hover_background_color']) ? $column['price_hover_background_color'] : $general_option['custom_skin_colors']['arp_price_bg_hover_color'];

                            $arp_odd_row_hover_background_color = isset($column['content_odd_hover_color']) ? $column['content_odd_hover_color'] : $general_option['custom_skin_colors']['arp_body_odd_row_hover_bg_custom_color'];

                            $arp_even_row_hover_background_color = isset($column['content_even_hover_color']) ? $column['content_even_hover_color'] : $general_option['custom_skin_colors']['arp_body_even_row_hover_bg_custom_color'];

                            $arp_content_hover_font_color = isset($column['content_hover_font_color']) ? $column['content_hover_font_color'] : '';
                            $arp_content_even_hover_font_color = isset($column['content_even_hover_font_color']) ? $column['content_even_hover_font_color'] : '';
                            $arp_content_label_hover_font_color = isset($column['content_label_hover_font_color']) ? $column['content_label_hover_font_color'] : '';

                            $arp_footer_content_hover_bg_color = isset($column['footer_hover_background_color']) ? $column['footer_hover_background_color'] : $general_option['custom_skin_colors']['arp_footer_content_hover_bg_color'];
                            $arp_footer_hover_font_color = isset($column['footer_level_options_hover_font_color']) ? $column['footer_level_options_hover_font_color'] : '';

                            $arp_desc_hover_background_color = isset($column['column_desc_hover_background_color']) ? $column['column_desc_hover_background_color'] : $general_option['custom_skin_colors']['arp_column_desc_hover_bg_custom_color'];
                            $arp_desc_hover_font_color = isset($column['column_description_hover_font_color']) ? $column['column_description_hover_font_color'] : '';

                            $arp_price_backgroud_color = isset($column['price_background_color']) ? $column['price_background_color'] : '';
                            $arp_price_hover_font_color = isset($column['price_hover_font_color']) ? $column['price_hover_font_color'] : '';
                            $arp_price_label_hover_font_color = isset($column['price_text_hover_font_color']) ? $column['price_text_hover_font_color'] : '';

                            $arp_shortoce_hover_font_color = isset($column['shortcode_hover_font_color']) ? $column['shortcode_hover_font_color'] : '';
                            $arp_shortoce_hover_background_color = isset($column['shortcode_hover_background_color']) ? $column['shortcode_hover_background_color'] : '';
                            
                            $value = str_replace('{arp_even_row_hover_background_color}', $arp_even_row_hover_background_color, $value);
                            $value = str_replace('{arp_odd_row_hover_background_color}', $arp_odd_row_hover_background_color, $value);
                            $value = str_replace('{arp_price_hover_font_color}', $arp_price_hover_font_color, $value);
                            $value = str_replace('{arp_price_label_hover_font_color}', $arp_price_label_hover_font_color, $value);
                            $value = str_replace('{arp_button_background_color}', $arp_button_bg_hover_color, $value);
                            $value = str_replace('{arp_button_hover_font_color}', $arp_button_hover_font_color, $value);
                            $value = str_replace('{arp_column_hover_background_color}', $arp_column_bg_hover_color, $value);
                            $value = str_replace('{arp_footer_column_background_color}', $arp_column_bg_hover_color, $value);
                            $value = str_replace('{arp_header_background_color}', $arp_header_bg_hover_color, $value);
                            $value = str_replace('{arp_header_hover_font_color}', $arp_header_hover_font_color, $value);

                            $value = str_replace('{arp_content_hover_font_color}', $arp_content_hover_font_color, $value);

                            $value = str_replace('{arp_content_even_hover_font_color}', $arp_content_even_hover_font_color, $value);

                            $value = str_replace('{arp_footer_font_hover_color}', $arp_footer_hover_font_color, $value);
                            $value = str_replace('{arp_description_hover_font_color}', $arp_desc_hover_font_color, $value);
                            $value = str_replace('[ARP_SPACE]', ' ', $value);

                            $value = str_replace('{arp_header_bg_custom_hover_color}', $arp_header_bg_hover_custom_color, $value);
$column['column_background_color'] = isset($column['column_background_color'])?$column['column_background_color']:'';
                            $value = str_replace('{arp_column_background_color}', $column['column_background_color'], $value);
                              $value = str_replace('{arp_desc_hover_background_color}', $arp_desc_hover_background_color, $value);
                                $value = str_replace('{arp_footer_bg_custom_hover_color}', $arp_footer_content_hover_bg_color, $value);
                               $value = str_replace('{arp_price_hover_background_color}', $arp_price_bg_hover_custom_color, $value);
                            if ($class_name == '.rounded_corder') {

                                $shortcode_array = $arpricelite_default_settings->arp_shortcode_custom_type();
                                if (isset($column['arp_shortcode_customization_style'])) {
                                    if ($shortcode_array[$column['arp_shortcode_customization_style']]['type'] == 'solid') {

                                        $value = str_replace('{arp_shortcode_background_color}', $arp_shortoce_hover_background_color, $value);
                                    } else {
                                        $value = str_replace('{arp_shortcode_background_color}', 'none', $value);
                                    }
                                }
                                $value = str_replace('{arp_shortcode_border_color}', $arp_shortoce_hover_background_color, $value);
                            }
                            $value = str_replace('{arp_shortcode_font_color}', $arp_shortoce_hover_font_color, $value);

                            if ($points > 0) {

                                if ($parameter == "n") {
                                    $points = "-" . $points;
                                } else {
                                    $points = $points;
                                }

                                $value = $this->arp_generate_color_tone($value, $points);
                            }
                            $str .= $property . ':' . $value . ' !important;';
                        }
                        $str .= "}";
                        $skinarr[] = $str;
                    }
                }
                if (!empty($color_skins)) {

                    $template_skin = $general_option['template_setting']['skin'];
                    $skinarrn = array();
                    foreach ($color_skins as $class_key => $skins) {

                        $str = '';
                        $point = 0;
                        $class_key = explode('_^_', $class_key);
                        $class_name = $class_key[0];
                        $hover = $class_key[1];

                        if ($hover == 0) {
                            $element_hover = ":hover";
                            $parent_hover = "";
                        } else {
                            $element_hover = "";
                            $parent_hover = ":hover";
                        }

                        foreach ($skins as $property => $skin) {

                            $str .= ".arplitetemplate_$table_id .ArpPricingTableColumnWrapper.arp_style_$start.no_animation:not(.no_transition):not(.maincaptioncolumn)$parent_hover $class_name";
                            $str .= $element_hover;
                            $str .= ",.arplitetemplate_$table_id .ArpPricingTableColumnWrapper.arp_style_$start.no_animation:not(.no_transition):not(.maincaptioncolumn).column_highlight  $class_name";
                            $str .="{";
                            $value = $skin[$template_skin];

                            if ($template_skin == 'custom_skin') {
                                $value = str_replace('{arp_column_background_color}', $general_option['custom_skin_colors']['arp_column_bg_hover_color'], $value);
                                $value = str_replace('{arp_footer_column_background_color}', $general_option['custom_skin_colors']['arp_column_bg_hover_color'], $value);
                                $value = str_replace('{arp_header_background_color}', $general_option['custom_skin_colors']['arp_header_bg_custom_color'], $value);
                                $value = str_replace('{arp_button_background_color}', $general_option['custom_skin_colors']['arp_button_bg_hover_color'], $value);
                            } else {
                                $value = str_replace('{arp_header_background_color}', $column['header_background_color'], $value);
                                $value = $value;
                            }

                            if (preg_match('/____/', $value)) {
                                $value__ = explode('____', $value);
                                if ($template_skin == 'custom_skin') {
                                    $value = $value__[1];
                                } else {
                                    $value = $value__[0];
                                }
                            } else {
                                $value = $value;
                            }

                            preg_match_all('/<==>/', $value, $matches);

                            if (!empty($matches[0])) {
                                $value_ = explode('<==>', $value);
                            } else {
                                $value_ = $value;
                            }

                            if (is_array($value_) and ! empty($value_)) {
                                $value = $value_[0];

                                $parameter = $value_[1];
                                $point = $value_[2];
                            } else {
                                $value = $value_;
                            }

                            if ($point > 0) {
                                if ($parameter == "n") {
                                    $points = "-" . $point;
                                } else {
                                    $points = $point;
                                }

                                $value = $this->arp_generate_color_tone($value, $points);
                            } else {
                                $value = $value;
                            }

                            $str .= $property . ":" . $value . " !important;";
                            $str .= "}";
                            $skinarrn[] = $str;
                        }
                        $returnstring .= $str;
                    }
                }
                $start++;
            }
        }

        if (is_array($skinarr) && !empty($skinarr)) {
            foreach ($skinarr as $css) {
                $returnstring .= $css;
            }
        }

        /* Column Desktop View Changes */
        $tablet_responsive_size = get_option('arplite_tablet_responsive_size');
        $tablet_responsive_size += 1;

        $returnstring .= "@media ( min-width:" . $tablet_responsive_size . "px){";
        $returnstring .= ".arplitetemplate_" . $table_id . " .ArpPricingTableColumnWrapper{";
        $returnstring .= "width:" . $general_column_settings['all_column_width'] . "px;";
        $returnstring .= "}";
        $returnstring .= "}";

        $returnstring .= ".arplitetemplate_" . $table_id . " .ArpPricingTableColumnWrapper{";
        $returnstring .= "width:" . $general_column_settings['all_column_width'] . "px;";
        $returnstring .= "}";

        /* Hide-show Section start */

        $hide_section_min_height_array = $arpricelite_default_settings->arprice_min_height_with_section_hide();
        $hide_section_min_height_array = isset($hide_section_min_height_array[$reference_template]) ? $hide_section_min_height_array[$reference_template] : '';

        if (isset($hide_section_min_height_array)) {
            /* header section */
            if (isset($general_column_settings['hide_header_global']) && $general_column_settings['hide_header_global'] == '1') {
                if (is_array($hide_section_min_height_array) && is_array($hide_section_min_height_array['arp_header'])) {
                    foreach ($hide_section_min_height_array['arp_header'] as $hide_class) {
                        if ($hide_class != '') {
                            $returnstring .= ".arplitetemplate_" . $table_id . ":not(.arp_admin_template_editor) " . $hide_class . "{";
                            $returnstring .= "min-height:0px !important;";
                            $returnstring .= "}";
                        }
                    }
                } else {
                    if (is_array($hide_section_min_height_array) && $hide_section_min_height_array['arp_header'] != '') {
                        $returnstring .= ".arplitetemplate_" . $table_id . ":not(.arp_admin_template_editor) " . $hide_section_min_height_array['arp_header'] . "{";
                        $returnstring .= "min-height:0px !important;";
                        $returnstring .= "}";
                    }
                }
            }
            /* header section */
            /* header shortcode section */
            if (isset($general_column_settings['hide_header_shortcode_global']) && $general_column_settings['hide_header_shortcode_global'] == '1') {

                if (isset($hide_section_min_height_array['arp_header_shortcode']) && is_array($hide_section_min_height_array) && is_array($hide_section_min_height_array['arp_header_shortcode'])) {
                    foreach ($hide_section_min_height_array['arp_header_shortcode'] as $hide_class) {
                        if ($hide_class != '') {
                            $returnstring .= ".arplitetemplate_" . $table_id . ":not(.arp_admin_template_editor) " . $hide_class . "{";
                            $returnstring .= "min-height:0px !important;";
                            $returnstring .= "}";
                        }
                    }
                } else {
                    if (isset($hide_section_min_height_array['arp_header_shortcode']) && is_array($hide_section_min_height_array) && $hide_section_min_height_array['arp_header_shortcode'] != '') {
                        $returnstring .= ".arplitetemplate_" . $table_id . ":not(.arp_admin_template_editor) " . $hide_section_min_height_array['arp_header_shortcode'] . "{";
                        $returnstring .= "min-height:0px !important;";
                        $returnstring .= "}";
                    }
                }
            }
            /* header shortcode section */
            /* feature section */
            if (isset($general_column_settings['hide_feature_global']) && $general_column_settings['hide_feature_global'] == '1') {
                if (isset($hide_section_min_height_array['arp_feature']) && is_array($hide_section_min_height_array['arp_feature'])) {
                    foreach ($hide_section_min_height_array['arp_feature'] as $hide_class) {
                        if ($hide_class != '') {
                            $returnstring .= ".arplitetemplate_" . $table_id . ":not(.arp_admin_template_editor) " . $hide_class . "{";
                            $returnstring .= "min-height:0px !important;";
                            $returnstring .= "}";
                        }
                    }
                } else {
                    if (isset($hide_section_min_height_array['arp_feature']) && $hide_section_min_height_array['arp_feature'] != '') {
                        $returnstring .= ".arplitetemplate_" . $table_id . ":not(.arp_admin_template_editor) " . $hide_section_min_height_array['arp_feature'] . "{";
                        $returnstring .= "min-height:0px !important;";
                        $returnstring .= "}";
                    }
                }
            }
            /* feature section */
            /* price section */
            if (isset($general_column_settings['hide_price_global']) && $general_column_settings['hide_price_global'] == '1') {
                if (isset($hide_section_min_height_array['arp_price']) && is_array($hide_section_min_height_array['arp_price'])) {
                    foreach ($hide_section_min_height_array['arp_price'] as $hide_class) {
                        if ($hide_class != '') {
                            $returnstring .= ".arplitetemplate_" . $table_id . ":not(.arp_admin_template_editor) " . $hide_class . "{";
                            $returnstring .= "min-height:0px !important;";
                            $returnstring .= "}";
                        }
                    }
                } else {
                    if (isset($hide_section_min_height_array['arp_price']) && $hide_section_min_height_array['arp_price'] != '') {
                        $returnstring .= ".arplitetemplate_" . $table_id . ":not(.arp_admin_template_editor) " . $hide_section_min_height_array['arp_price'] . "{";
                        $returnstring .= "min-height:0px !important;";
                        $returnstring .= "}";
                    }
                }
            }
            /* price section */
            /* description section */
            if (isset($general_column_settings['hide_description_global']) && $general_column_settings['hide_description_global'] == '1') {
                if (isset($hide_section_min_height_array['arp_description']) && is_array($hide_section_min_height_array['arp_description'])) {
                    foreach ($hide_section_min_height_array['arp_description'] as $hide_class) {
                        if ($hide_class != '') {
                            $returnstring .= ".arplitetemplate_" . $table_id . ":not(.arp_admin_template_editor) " . $hide_class . "{";
                            $returnstring .= "min-height:0px !important;";
                            $returnstring .= "}";
                        }
                    }
                } else {
                    if (isset($hide_section_min_height_array['arp_description']) && $hide_section_min_height_array['arp_description'] != '') {
                        $returnstring .= ".arplitetemplate_" . $table_id . ":not(.arp_admin_template_editor) " . $hide_section_min_height_array['arp_description'] . "{";
                        $returnstring .= "min-height:0px !important;";
                        $returnstring .= "}";
                    }
                }
            }
            /* description section */
            /* footer section */
            if (isset($general_column_settings['hide_footer_global']) && $general_column_settings['hide_footer_global'] == '1') {
                if (isset($hide_section_min_height_array['arp_footer']) && is_array($hide_section_min_height_array['arp_footer'])) {
                    foreach ($hide_section_min_height_array['arp_footer'] as $hide_class) {
                        if ($hide_class != '') {
                            $returnstring .= ".arplitetemplate_" . $table_id . ":not(.arp_admin_template_editor) " . $hide_class . "{";
                            $returnstring .= "min-height:0px !important;";
                            $returnstring .= "}";
                        }
                    }
                } else {
                    if (isset($hide_section_min_height_array['arp_footer']) && $hide_section_min_height_array['arp_footer'] != '') {
                        $returnstring .= ".arplitetemplate_" . $table_id . ":not(.arp_admin_template_editor) " . $hide_section_min_height_array['arp_footer'] . "{";
                        $returnstring .= "min-height:0px !important;";
                        $returnstring .= "}";
                    }
                }
            }
            /* footer section */
        }

        /* Hide-show section end */

        if (isset($arplite_mainoptionsarr['general_options']['template_options']['features'][$reference_template]['button_border_customization']) && $arplite_mainoptionsarr['general_options']['template_options']['features'][$reference_template]['button_border_customization'] == 1) {
            if (isset($general_column_settings['global_button_border_color']) && $general_column_settings['global_button_border_color'] != '') {
                $general_column_settings['global_button_border_color'] = $general_column_settings['global_button_border_color'];
            } else {
                $general_column_settings['global_button_border_color'] = '#c9c9c9';
            }

            if (isset($general_column_settings['global_button_border_width']) && $general_column_settings['global_button_border_width'] != '') {
                $general_column_settings['global_button_border_width'] = $general_column_settings['global_button_border_width'];
            } else {
                $general_column_settings['global_button_border_width'] = 0;
            }

            if (isset($general_column_settings['global_button_border_type']) && $general_column_settings['global_button_border_type'] != '') {
                $general_column_settings['global_button_border_type'] = $general_column_settings['global_button_border_type'];
            } else {
                $general_column_settings['global_button_border_type'] = 'solid';
            }

            if (isset($general_column_settings['global_button_border_radius_top_left']) && $general_column_settings['global_button_border_radius_top_left'] != '') {
                $general_column_settings['global_button_border_radius_top_left'] = $general_column_settings['global_button_border_radius_top_left'];
            } else {
                $general_column_settings['global_button_border_radius_top_left'] = 0;
            }

            if (isset($general_column_settings['global_button_border_radius_top_right']) && $general_column_settings['global_button_border_radius_top_right'] != '') {
                $general_column_settings['global_button_border_radius_top_right'] = $general_column_settings['global_button_border_radius_top_right'];
            } else {
                $general_column_settings['global_button_border_radius_top_right'] = 0;
            }
            if (isset($general_column_settings['global_button_border_radius_bottom_left']) && $general_column_settings['global_button_border_radius_bottom_left'] != '') {
                $general_column_settings['global_button_border_radius_bottom_left'] = $general_column_settings['global_button_border_radius_bottom_left'];
            } else {
                $general_column_settings['global_button_border_radius_bottom_left'] = 0;
            }

            if (isset($general_column_settings['global_button_border_radius_bottom_right']) && $general_column_settings['global_button_border_radius_bottom_right'] != '') {
                $general_column_settings['global_button_border_radius_bottom_right'] = $general_column_settings['global_button_border_radius_bottom_right'];
            } else {
                $general_column_settings['global_button_border_radius_bottom_right'] = '0';
            }


            $returnstring .= ".arplitetemplate_" . $table_id . " .bestPlanButton{";
            $returnstring .= 'border : ' . $general_column_settings['global_button_border_width'] . 'px ' . $general_column_settings['global_button_border_type'] . ' ' . $general_column_settings['global_button_border_color'] . ';';
            $returnstring .= 'border-radius :' . $general_column_settings['global_button_border_radius_top_left'] . 'px ' . $general_column_settings['global_button_border_radius_top_right'] . 'px ' . $general_column_settings['global_button_border_radius_bottom_right'] . 'px ' . $general_column_settings['global_button_border_radius_bottom_left'] . 'px;';
            $returnstring .= '-webkit-border-radius :' . $general_column_settings['global_button_border_radius_top_left'] . 'px ' . $general_column_settings['global_button_border_radius_top_right'] . 'px ' . $general_column_settings['global_button_border_radius_bottom_right'] . 'px ' . $general_column_settings['global_button_border_radius_bottom_left'] . 'px;';
            $returnstring .= '-moz-border-radius :' . $general_column_settings['global_button_border_radius_top_left'] . 'px ' . $general_column_settings['global_button_border_radius_top_right'] . 'px ' . $general_column_settings['global_button_border_radius_bottom_right'] . 'px ' . $general_column_settings['global_button_border_radius_bottom_left'] . 'px;';
            $returnstring .= '-o-border-radius :' . $general_column_settings['global_button_border_radius_top_left'] . 'px ' . $general_column_settings['global_button_border_radius_top_right'] . 'px ' . $general_column_settings['global_button_border_radius_bottom_right'] . 'px ' . $general_column_settings['global_button_border_radius_bottom_left'] . 'px;';
            $returnstring .= "}";
        }


        $tol_bottom_border_style = " border-bottom-style:";
        $tol_bottom_border_width = " border-bottom-width:";
        $tol_bottom_border_color = " border-bottom-color:";

        //Body row level li border css apply start

        $general_column_settings['arp_row_border_type'] = isset($general_column_settings['arp_row_border_type']) ? $general_column_settings['arp_row_border_type'] : '';
        $general_column_settings['arp_row_border_size'] = isset($general_column_settings['arp_row_border_size']) ? $general_column_settings['arp_row_border_size'] : '';
        $general_column_settings['arp_row_border_color'] = isset($general_column_settings['arp_row_border_color']) ? $general_column_settings['arp_row_border_color'] : '';

        /* Caption Row Level */
        $general_column_settings['arp_caption_row_border_style'] = isset($general_column_settings['arp_caption_row_border_style']) ? $general_column_settings['arp_caption_row_border_style'] : '';
        $general_column_settings['arp_caption_row_border_size'] = isset($general_column_settings['arp_caption_row_border_size']) ? $general_column_settings['arp_caption_row_border_size'] : '';
        $general_column_settings['arp_caption_row_border_color'] = isset($general_column_settings['arp_caption_row_border_color']) ? $general_column_settings['arp_caption_row_border_color'] : '';
        /* Caption Row Level */

        /* Condition Due to extra li in template where button position in not default */

        if (isset($template_feature['button_position']) && $template_feature['button_position'] != 'default') {
            $returnstring .= " .arplite_price_table_$table_id:not(.arp_admin_template_editor) .ArpPricingTableColumnWrapper:not(.maincaptioncolumn) .planContainer .arppricingtablebodycontent ul li:not(:nth-last-child(-n+2)),.arplite_price_table_$table_id:not(.arp_admin_template_editor) .ArpPricingTableColumnWrapper:not(.maincaptioncolumn) .planContainer .arppricingtablebodycontent ul li:last-child,.arplite_price_table_$table_id.arp_admin_template_editor .ArpPricingTableColumnWrapper:not(.maincaptioncolumn) .planContainer .arppricingtablebodycontent ul li";
        } else {
            $returnstring .= " .arplite_price_table_$table_id .ArpPricingTableColumnWrapper:not(.maincaptioncolumn) .planContainer .arppricingtablebodycontent ul li";
        }
        $returnstring .= "{";
        $returnstring .= "$tol_bottom_border_style " . $general_column_settings['arp_row_border_type'] . ";";
        $returnstring .= "$tol_bottom_border_width " . $general_column_settings['arp_row_border_size'] . "px;";
        $returnstring .= "$tol_bottom_border_color " . $general_column_settings['arp_row_border_color'] . ";";
        $returnstring .= " }";


        /* Caption Row Level Border */
        $returnstring .= " .arplite_price_table_$table_id .ArpPricingTableColumnWrapper.maincaptioncolumn .planContainer .arppricingtablebodycontent ul li";
        $returnstring .= "{";
        $returnstring .= "$tol_bottom_border_style " . $general_column_settings['arp_row_border_type'] . ";";
        $returnstring .= "$tol_bottom_border_width " . $general_column_settings['arp_row_border_size'] . "px;";
        $returnstring .= "$tol_bottom_border_color " . $general_column_settings['arp_caption_row_border_color'] . ";";
        $returnstring .= " }";


        $arp_row_level_border_remove_from_last_child = $arpricelite_default_settings->arp_row_level_border_remove_from_last_child();
        if (in_array($reference_template, $arp_row_level_border_remove_from_last_child)) {

            $returnstring .= " .arplite_price_table_$table_id .ArpPricingTableColumnWrapper .planContainer .arppricingtablebodycontent ul li:last-child{border-bottom:none !important;}";
            if ($reference_template == 'arplitetemplate_8' || $reference_template == 'arplitetemplate_11') {

                $returnstring .= " .arplite_price_table_$table_id:not(.arp_admin_template_editor) .ArpPricingTableColumnWrapper .planContainer .arppricingtablebodycontent ul li:nth-last-child(-n+2){border-bottom:none;}";
            }
        }

        /* Caption Row Level Border */

        /* column border */
        $arp_border_css_class = $arpricelite_default_settings->arp_column_border_array();
        $arp_border_css_class = $arp_border_css_class[$reference_template];

        $border_size = isset($general_column_settings['arp_column_border_size']) ? $general_column_settings['arp_column_border_size'] : '0';
        $border_type = isset($general_column_settings['arp_column_border_type']) ? $general_column_settings['arp_column_border_type'] : 'solid';
        $all_size_border = isset($general_column_settings['arp_column_border_all']) ? $general_column_settings['arp_column_border_all'] : '';
        $left_size_border = isset($general_column_settings['arp_column_border_left']) ? $general_column_settings['arp_column_border_left'] : '';
        $right_size_border = isset($general_column_settings['arp_column_border_right']) ? $general_column_settings['arp_column_border_right'] : '';
        $top_size_border = isset($general_column_settings['arp_column_border_top']) ? $general_column_settings['arp_column_border_top'] : '';
        $bottom_size_border = isset($general_column_settings['arp_column_border_bottom']) ? $general_column_settings['arp_column_border_bottom'] : '';

        $border_color = isset($general_column_settings['arp_column_border_color']) ? $general_column_settings['arp_column_border_color'] : '#c9c9c9';



        $caption_border_color = isset($general_column_settings['arp_caption_border_color']) ? $general_column_settings['arp_caption_border_color'] : '#c9c9c9';
        $caption_border_size = isset($general_column_settings['arp_caption_border_size']) ? $general_column_settings['arp_caption_border_size'] : '0';
        $arp_caption_border_style = isset($general_column_settings['arp_caption_border_style']) ? $general_column_settings['arp_caption_border_style'] : 'solid';
        $caption_all_size_border = isset($general_column_settings['arp_caption_border_all']) ? $general_column_settings['arp_caption_border_all'] : '';
        $caption_left_size_border = isset($general_column_settings['arp_caption_border_left']) ? $general_column_settings['arp_caption_border_left'] : '';
        $caption_right_size_border = isset($general_column_settings['arp_caption_border_right']) ? $general_column_settings['arp_caption_border_right'] : '';
        $caption_top_size_border = isset($general_column_settings['arp_caption_border_top']) ? $general_column_settings['arp_caption_border_top'] : '';
        $caption_bottom_size_border = isset($general_column_settings['arp_caption_border_bottom']) ? $general_column_settings['arp_caption_border_bottom'] : '';

        if ($border_size != '0' && $all_size_border != '' && isset($arp_border_css_class['all'])) {
            $returnstring .= ".arplitetemplate_" . $table_id . " .ArpPricingTableColumnWrapper:not(.maincaptioncolumn) " . $arp_border_css_class['all'] . "{";
            $returnstring .= 'border :' . $border_size . 'px ' . $border_type . ' ' . $border_color . ';';
            $returnstring .= "}";
        } else {
            if ($border_size != '0' && $left_size_border != '' && $left_size_border != '0' && isset($arp_border_css_class['left'])) {
                $returnstring .= ".arplitetemplate_" . $table_id . " .ArpPricingTableColumnWrapper:not(.maincaptioncolumn) " . $arp_border_css_class['left'] . "{";
                $returnstring .= 'border-left :' . $border_size . 'px ' . $border_type . ' ' . $border_color . ';';
                $returnstring .= "}";
            }
            if ($border_size != '0' && $right_size_border != '' && $right_size_border != '0' && isset($arp_border_css_class['right'])) {
                $returnstring .= ".arplitetemplate_" . $table_id . " .ArpPricingTableColumnWrapper:not(.maincaptioncolumn) " . $arp_border_css_class['right'] . "{";
                $returnstring .= 'border-right :' . $border_size . 'px ' . $border_type . ' ' . $border_color . ';
            ';
                $returnstring .= "}";
            }
            if ($border_size != '0' && $top_size_border != '' && $top_size_border != '0' && isset($arp_border_css_class['top'])) {
                $returnstring .= ".arplitetemplate_" . $table_id . " .ArpPricingTableColumnWrapper:not(.maincaptioncolumn) " . $arp_border_css_class['top'] . "{";
                $returnstring .= 'border-top :' . $border_size . 'px ' . $border_type . ' ' . $border_color . ';
            ';
                $returnstring .= "}";
            }
            if ($border_size != '0' && $bottom_size_border != '' && $bottom_size_border != '0' && isset($arp_border_css_class['bottom'])) {
                $returnstring .= ".arplitetemplate_" . $table_id . " .ArpPricingTableColumnWrapper:not(.maincaptioncolumn) " . $arp_border_css_class['bottom'] . "{";
                $returnstring .= 'border-bottom :' . $border_size . 'px ' . $border_type . ' ' . $border_color . ';
            ';
                $returnstring .= "}";
            }
        }



        // caption border

        if ($caption_border_size != '0' && $caption_left_size_border != '' && $caption_left_size_border != '0' && isset($arp_border_css_class['left']) || $caption_border_size != '0' && $caption_all_size_border != '' && isset($arp_border_css_class['all'])) {

            $cap_border_left = explode(",", $arp_border_css_class['caption_border_all']['left']);
            foreach ($cap_border_left as $value_left) {
                $returnstring .= ".arplitetemplate_" . $table_id . " .ArpPricingTableColumnWrapper.maincaptioncolumn " . $value_left . "{";
                $returnstring .= 'border-left :' . $caption_border_size . 'px ' . $arp_caption_border_style . ' ' . $caption_border_color . ';
            ';
                $returnstring .= "}";
            }
        }

        if ($caption_border_size != '0' && $caption_right_size_border != '' && $caption_right_size_border != '0' && isset($arp_border_css_class['right']) || $caption_border_size != '0' && $caption_all_size_border != '' && isset($arp_border_css_class['all'])) {

            $cap_border_right = explode(",", $arp_border_css_class['caption_border_all']['right']);
            foreach ($cap_border_right as $value_right) {
                $returnstring .= ".arplitetemplate_" . $table_id . " .ArpPricingTableColumnWrapper.maincaptioncolumn " . $value_right . "{";
                $returnstring .= 'border-right :' . $caption_border_size . 'px ' . $arp_caption_border_style . ' ' . $caption_border_color . ';
            ';
                $returnstring .= "}";
            }
        }

        if ($caption_border_size != '0' && $caption_top_size_border != '' && $caption_top_size_border != '0' && isset($arp_border_css_class['top']) || $caption_border_size != '0' && $caption_all_size_border != '' && isset($arp_border_css_class['all'])) {

            $cap_border_top = explode(",", $arp_border_css_class['caption_border_all']['top']);
            foreach ($cap_border_top as $value_top) {
                $returnstring .= ".arplitetemplate_" . $table_id . " .ArpPricingTableColumnWrapper.maincaptioncolumn " . $value_top . "{";
                $returnstring .= 'border-top :' . $caption_border_size . 'px ' . $arp_caption_border_style . ' ' . $caption_border_color . ';
            ';
                $returnstring .= "}";
            }
        }

        if ($caption_border_size != '0' && $caption_bottom_size_border != '' && $caption_bottom_size_border != '0' && isset($arp_border_css_class['bottom']) || $caption_border_size != '0' && $caption_all_size_border != '' && isset($arp_border_css_class['all'])) {

            $cap_border_bottom = explode(",", $arp_border_css_class['caption_border_all']['bottom']);
            foreach ($cap_border_bottom as $value_bottom) {
                $returnstring .= ".arplitetemplate_" . $table_id . " .ArpPricingTableColumnWrapper.maincaptioncolumn " . $value_bottom . "{";
                $returnstring .= 'border-bottom :' . $caption_border_size . 'px ' . $arp_caption_border_style . ' ' . $caption_border_color . ';
            ';
                $returnstring .= "}";
            }
        }
        /****
         * new css after all font in gloabal settings
         ****/
        $returnstring .= " .arplitetemplate_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper:not(.maincaptioncolumn) .bestPlanTitle";

        $returnstring .= " {font-family: " . stripslashes($general_column_settings['header_font_family_global']) . ";font-size: " . $general_column_settings['header_font_size_global'] . "px; ";
        if ($general_column_settings['arp_header_text_bold_global'] != '') {
            $returnstring .= " font-weight: " . $general_column_settings['arp_header_text_bold_global'] . ";";
        }
        if ($general_column_settings['arp_header_text_italic_global'] != '') {
            $returnstring .= " font-style: " . $general_column_settings['arp_header_text_italic_global'] . ";";
        }
        if ($general_column_settings['arp_header_text_decoration_global'] != '') {
            $returnstring .= " text-decoration: " . $general_column_settings['arp_header_text_decoration_global'] . ";";
        }
        $returnstring .="}";

        $returnstring .= " .arplite_price_table_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper:not(.maincaptioncolumn) .arp_price_wrapper{";


        $returnstring .= "font-family:" . stripslashes_deep($general_column_settings['price_font_family_global']) . ";
		font-size:" . $general_column_settings['price_font_size_global'] . "px;";

        if (isset($general_column_settings['arp_price_text_bold_global']) && $general_column_settings['arp_price_text_bold_global'] != '') {
            $returnstring .= " font-weight: " . $general_column_settings['arp_price_text_bold_global'] . ";";
        }

        if (isset($general_column_settings['price_label_style_italic']) && $general_column_settings['price_label_style_italic'] != '') {
            $returnstring .= " font-style: " . $general_column_settings['price_label_style_italic'] . ";";
        }

        if (isset($general_column_settings['arp_price_text_decoration_global']) && $general_column_settings['arp_price_text_decoration_global'] != '') {
            $returnstring .= " text-decoration: " . $general_column_settings['arp_price_text_decoration_global'] . ";";
        }


        $returnstring .= "}";

        $returnstring .= " .arplite_price_table_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper:not(.maincaptioncolumn):not(.no_transition) .arp_opt_options li *, .arplite_price_table_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper.no_transition:not(.maincaptioncolumn) .arp_opt_options li";
        $returnstring .= "{";
        $returnstring .= "font-family:" . stripslashes_deep($general_column_settings['body_font_family_global']) . ";";
        $returnstring .= "font-size:" . $general_column_settings['body_font_size_global'] . "px;";

        if ($general_column_settings['arp_body_text_bold_global'] != '')
            $returnstring .= " font-weight: " . $general_column_settings['arp_body_text_bold_global'] . ";";

        if ($general_column_settings['arp_body_text_italic_global'] != '')
            $returnstring .= " font-style: " . $general_column_settings['arp_body_text_italic_global'] . ";";

        if ($general_column_settings['arp_body_text_decoration_global'] != '')
            $returnstring .= " text-decoration: " . $general_column_settings['arp_body_text_decoration_global'] . " ;";


        $returnstring .= "}";

        $returnstring .= '.arplite_price_table_' . $table_id . ' #ArpPricingTableColumns .ArpPricingTableColumnWrapper:not(.maincaptioncolumn) .arp_footer_content{';

        $returnstring .= 'font-family: ' . $general_column_settings['footer_font_family_global'] . ';';
        $returnstring .= 'font-size:' . $general_column_settings['footer_font_size_global'] . 'px;';
        if ($general_column_settings['arp_footer_text_bold_global'] == 'bold') {
            $returnstring .= 'font-weight: bold;';
        }
        if ($general_column_settings['arp_footer_text_italic_global'] == 'italic') {
            $returnstring .= 'font-style: italic;';
        }
        if ($general_column_settings['arp_footer_text_decoration_global'] == 'underline') {
            $returnstring .= 'text-decoration: underline;';
        } else if ($general_column_settings['arp_footer_text_decoration_global'] == 'line-through') {
            $returnstring .= 'text-decoration: line-through;';
        }

        $returnstring .= '}';

        $returnstring .= " .arplite_price_table_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper:not(.maincaptioncolumn) .bestPlanButton, .arplite_price_table_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper:not(.maincaptioncolumn) .bestPlanButton .bestPlanButton_text";

        $returnstring .= "{";

        $returnstring .= "font-family:" . stripslashes_deep($general_column_settings['button_font_family_global']) . ";";
        $returnstring .= "font-size:" . $general_column_settings['button_font_size_global'] . "px;";

        if (isset($general_column_settings['arp_button_text_bold_global']) && $general_column_settings['arp_button_text_bold_global'] != '')
            $returnstring .= " font-weight: " . $general_column_settings['arp_button_text_bold_global'] . ";";

        if (isset($general_column_settings['arp_button_text_italic_global']) && $general_column_settings['arp_button_text_italic_global'] != '')
            $returnstring .= " font-style: " . $general_column_settings['arp_button_text_italic_global'] . ";";

        if (isset($general_column_settings['arp_button_text_decoration_global']) && $general_column_settings['arp_button_text_decoration_global'] != '')
            $returnstring .= " text-decoration: " . $general_column_settings['arp_button_text_decoration_global'] . ";";


        $returnstring .= "}";


        $returnstring .= " .arplite_price_table_" . $table_id . " #ArpPricingTableColumns .ArpPricingTableColumnWrapper:not(.maincaptioncolumn) .column_description{";


        if ($general_column_settings['arp_description_text_bold_global'] != '')
            $returnstring .= " font-weight: " . $general_column_settings['arp_description_text_bold_global'] . ";";

        if ($general_column_settings['arp_description_text_italic_global'] != '')
            $returnstring .= " font-style: " . $general_column_settings['arp_description_text_italic_global'] . ";";

        if ($general_column_settings['arp_description_text_decoration_global'] != '')
            $returnstring .= " text-decoration: " . $general_column_settings['arp_description_text_decoration_global'] . ";";


        $returnstring .= "font-family:" . stripslashes_deep($general_column_settings['description_font_family_global']) . ";";
        $returnstring .= "font-size:" . $general_column_settings['description_font_size_global'] . 'px;';


        $returnstring .= "}";




        return $returnstring;
    }

    function get_preview_table($values) {
        global $wpdb, $arplite_mainoptionsarr;

        $table_id = $values['table_id'];

        $sql = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "arplite_arprice WHERE ID = %d", $table_id));

        $is_template = $sql[0]->is_template;
        $template_name = $sql[0]->template_name;
        $is_animated = $sql[0]->is_animated;

        $main_table_title = $values['pricing_table_main'];

        $total = $values['added_package'];

        $template = $values['arp_template'];
        $template_skin = $values['arp_template_skin_editor'];
        $template_type = $values['arp_template_type'];
        $arp_template_custom_color = isset($values['arp_custom_color_code']) ? $values['arp_custom_color_code'] : '';
        $template_feature = maybe_serialize(json_decode(stripslashes($values['template_feature']), true));

        $template_setting = array('template' => $template, 'skin' => $template_skin, 'template_type' => $template_type, 'template_feature' => $template_feature);

        $column_order = stripslashes_deep($values['pricing_table_column_order']);

        $column_ord = str_replace('\'', '"', $column_order);
        $col_ord_arr = json_decode($column_ord, true);

        if (isset($values['has_caption_column']) && $values['has_caption_column'] == 1 and ! in_array('main_column_0', $col_ord_arr))
            array_unshift($col_ord_arr, 'main_column_0');
        $new_id = array();


        if (is_array($col_ord_arr) and count($col_ord_arr) > 0) {
            foreach ($col_ord_arr as $key => $value)
                $new_id[$key] = str_replace('main_column_', '', $value);
        }

        $column_order = json_encode($col_ord_arr);

        $total = max($new_id);

        $reference_template = $values['arp_reference_template'];

        $user_edited_columns = json_decode(stripslashes_deep(@$values['arp_user_edited_columns']), true);

        $general_settings = array('column_order' => $column_order, 'reference_template' => $reference_template, 'user_edited_columns' => $user_edited_columns);

        $is_column_space = @$values['space_between_column'];
        $column_space = @$values['column_space'];
        $hover_highlight = @$values['column_high_on_hover'];
        $is_responsive = @$values['is_responsive'];
        $all_column_width = @$values['all_column_width'];

        $arp_row_border_size = @$values['arp_row_border_size'];
        $arp_row_border_type = @$values['arp_row_border_type'];
        $arp_row_border_color = @$values['arp_row_border_color'];

//        Caption Row Level Border
        $arp_caption_row_border_size = @$values['arp_caption_row_border_size'];
        $arp_caption_row_border_style = @$values['arp_caption_row_border_style'];
        $arp_caption_row_border_color = @$values['arp_caption_row_border_color'];
//        Caption Row Level Border

        $arp_column_border_size = @$values['arp_column_border_size'];
        $arp_column_border_type = @$values['arp_column_border_type'];
        $arp_column_border_color = @$values['arp_column_border_color'];
        $arp_column_border_all = @$values['arp_column_border_all'];
        $arp_column_border_left = @$values['arp_column_border_left'];
        $arp_column_border_right = @$values['arp_column_border_right'];
        $arp_column_border_top = @$values['arp_column_border_top'];
        $arp_column_border_bottom = @$values['arp_column_border_bottom'];

        $arp_caption_border_color = @$values['arp_caption_border_color'];
        $arp_caption_border_size = @$values['arp_caption_border_size'];
        $arp_caption_border_style = @$values['arp_caption_border_style'];
        $arp_caption_border_all = @$values['arp_caption_border_all'];
        $arp_caption_border_left = @$values['arp_caption_border_left'];
        $arp_caption_border_right = @$values['arp_caption_border_right'];
        $arp_caption_border_top = @$values['arp_caption_border_top'];
        $arp_caption_border_bottom = @$values['arp_caption_border_bottom'];

        $hide_caption_column = @$values['hide_caption_column'];
        $hide_footer_global = @$values['hide_footer_global'];
        $hide_header_global = @$values['hide_header_global'];
        $hide_price_global = @$values['hide_price_global'];
        $hide_feature_global = @$values['hide_feature_global'];
        $hide_description_global = @$values['hide_description_global'];
        $hide_header_shortcode_global = @$values['hide_header_shortcode_global'];

        $column_wrapper_width_txtbox = @$values['column_wrapper_width_txtbox'];
        $column_wrapper_width_style = @$values['column_wrapper_width_style'];
        $column_box_shadow_effect = @$values['column_box_shadow_effect'];

        $column_border_radius_top_left = ( isset($values['column_border_radius_top_left']) and ! empty($values['column_border_radius_top_left']) ) ? $values['column_border_radius_top_left'] : 0;
        $column_border_radius_top_right = ( isset($values['column_border_radius_top_right']) and ! empty($values['column_border_radius_top_right']) ) ? $values['column_border_radius_top_right'] : 0;
        $column_border_radius_bottom_right = ( isset($values['column_border_radius_bottom_right']) and ! empty($values['column_border_radius_bottom_right']) ) ? $values['column_border_radius_bottom_right'] : 0;
        $column_border_radius_bottom_left = ( isset($values['column_border_radius_bottom_left']) and ! empty($values['column_border_radius_bottom_left']) ) ? $values['column_border_radius_bottom_left'] : 0;
        $column_hide_blank_rows = @$values['hide_blank_rows'];

        $global_button_border_width = @$values['arp_global_button_border_width'];
        $global_button_border_type = @$values['arp_global_button_border_style'];
        $global_button_border_color = @$values['arp_global_button_border_color'];
        $global_button_border_radius_top_left = @$values['global_button_border_radius_top_left'];
        $global_button_border_radius_top_right = @$values['global_button_border_radius_top_right'];
        $global_button_border_radius_bottom_left = @$values['global_button_border_radius_bottom_left'];
        $global_button_border_radius_bottom_right = @$values['global_button_border_radius_bottom_right'];
        $arp_global_button_border_type = @$values['arp_global_button_type'];

        $header_font_family_global = @$values['header_font_family_global'];
        $header_font_size_global = @$values['header_font_size_global'];
        $arp_header_text_alignment = @$values['arp_header_text_alignment'];

        $header_style_bold_global = @$values['header_style_bold_global'];
        $header_style_italic_global = @$values['header_style_italic_global'];
        $header_style_decoration_global = @$values['header_style_decoration_global'];

        $price_font_family_global = @$values['price_font_family_global'];
        $price_font_size_global = @$values['price_font_size_global'];
        $arp_price_text_alignment = @$values['arp_price_text_alignment'];

        $price_style_bold_global = @$values['price_style_bold_global'];
        $price_style_italic_global = @$values['price_style_italic_global'];
        $price_style_decoration_global = @$values['price_style_decoration_global'];

        $body_font_family_global = @$values['body_font_family_global'];
        $body_font_size_global = @$values['body_font_size_global'];
        $arp_body_text_alignment = @$values['arp_body_text_alignment'];

        $body_style_bold_global = @$values['body_style_bold_global'];
        $body_style_italic_global = @$values['body_style_italic_global'];
        $body_style_decoration_global = @$values['body_style_decoration_global'];

        $footer_font_family_global = @$values['footer_font_family_global'];
        $footer_font_size_global = @$values['footer_font_size_global'];
        $arp_footer_text_alignment = @$values['arp_footer_text_alignment'];

        $footer_style_bold_global = @$values['footer_style_bold_global'];
        $footer_style_italic_global = @$values['footer_style_italic_global'];
        $footer_style_decoration_global = @$values['footer_style_decoration_global'];

        $button_font_family_global = @$values['button_font_family_global'];
        $button_font_size_global = @$values['button_font_size_global'];
        $arp_button_text_alignment = @$values['arp_button_text_alignment'];

        $button_style_bold_global = @$values['button_style_bold_global'];
        $button_style_italic_global = @$values['button_style_italic_global'];
        $button_style_decoration_global = @$values['button_style_decoration_global'];

        $description_font_family_global = @$values['description_font_family_global'];
        $description_font_size_global = @$values['description_font_size_global'];
        $arp_description_text_alignment = @$values['arp_description_text_alignment'];

        $description_style_bold_global = @$values['description_style_bold_global'];
        $description_style_italic_global = @$values['description_style_italic_global'];
        $description_style_decoration_global = @$values['description_style_decoration_global'];

        $column_setting = array('space_between_column' => $is_column_space, 'column_space' => $column_space, 'column_highlight_on_hover' => $hover_highlight, 'is_responsive' => $is_responsive, 'hide_caption_column' => $hide_caption_column, 'hide_footer_global' => $hide_footer_global, 'hide_header_global' => $hide_header_global, 'hide_header_shortcode_global' => $hide_header_shortcode_global, 'hide_price_global' => $hide_price_global, 'hide_feature_global' => $hide_feature_global, 'hide_description_global' => $hide_description_global, 'all_column_width' => $all_column_width, 'column_wrapper_width_txtbox' => $column_wrapper_width_txtbox, 'column_wrapper_width_style' => $column_wrapper_width_style, 'column_border_radius_top_left' => $column_border_radius_top_left, 'column_border_radius_top_right' => $column_border_radius_top_right, 'column_border_radius_bottom_right' => $column_border_radius_bottom_right, 'column_border_radius_bottom_left' => $column_border_radius_bottom_left, 'column_box_shadow_effect' => $column_box_shadow_effect, 'column_hide_blank_rows' => $column_hide_blank_rows, 'global_button_border_width' => $global_button_border_width, 'global_button_border_type' => $global_button_border_type, 'global_button_border_color' => $global_button_border_color, 'global_button_border_radius_top_left' => $global_button_border_radius_top_left, 'global_button_border_radius_top_right' => $global_button_border_radius_top_right, 'global_button_border_radius_bottom_left' => $global_button_border_radius_bottom_left, 'global_button_border_radius_bottom_right' => $global_button_border_radius_bottom_right, 'arp_global_button_type' => $arp_global_button_border_type, 'arp_row_border_size' => $arp_row_border_size, 'arp_row_border_type' => $arp_row_border_type, 'arp_row_border_color' => $arp_row_border_color, 'arp_caption_border_style' => $arp_caption_border_style, 'arp_caption_border_size' => $arp_caption_border_size, 'arp_column_border_size' => $arp_column_border_size, 'arp_column_border_type' => $arp_column_border_type, 'arp_column_border_color' => $arp_column_border_color, 'arp_caption_border_color' => $arp_caption_border_color, 'arp_column_border_left' => $arp_column_border_left, 'arp_column_border_right' => $arp_column_border_right, 'arp_column_border_top' => $arp_column_border_top, 'arp_column_border_bottom' => $arp_column_border_bottom, 'arp_column_border_all' => $arp_column_border_all, 'arp_caption_border_left' => $arp_caption_border_left, 'arp_caption_border_right' => $arp_caption_border_right, 'arp_caption_border_top' => $arp_caption_border_top, 'arp_caption_border_bottom' => $arp_caption_border_bottom, 'arp_caption_border_all' => $arp_caption_border_all, 'arp_caption_row_border_size' => $arp_caption_row_border_size, 'arp_caption_row_border_style' => $arp_caption_row_border_style, 'arp_caption_row_border_color' => $arp_caption_row_border_color,
            'header_font_family_global' => $header_font_family_global,
            'header_font_size_global' => $header_font_size_global,
            'arp_header_text_alignment' => $arp_header_text_alignment,
            'arp_header_text_bold_global' => $header_style_bold_global,
            'arp_header_text_italic_global' => $header_style_italic_global,
            'arp_header_text_decoration_global' => $header_style_decoration_global,
            'price_font_family_global' => $price_font_family_global,
            'price_font_size_global' => $price_font_size_global,
            'arp_price_text_alignment' => $arp_price_text_alignment,
            'arp_price_text_bold_global' => $price_style_bold_global,
            'arp_price_text_italic_global' => $price_style_italic_global,
            'arp_price_text_decoration_global' => $price_style_decoration_global,
            'body_font_family_global' => $body_font_family_global,
            'body_font_size_global' => $body_font_size_global,
            'arp_body_text_alignment' => $arp_body_text_alignment,
            'arp_body_text_bold_global' => $body_style_bold_global,
            'arp_body_text_italic_global' => $body_style_italic_global,
            'arp_body_text_decoration_global' => $body_style_decoration_global,
            'footer_font_family_global' => $footer_font_family_global,
            'footer_font_size_global' => $footer_font_size_global,
            'arp_footer_text_alignment' => $arp_footer_text_alignment,
            'arp_footer_text_bold_global' => $footer_style_bold_global,
            'arp_footer_text_italic_global' => $footer_style_italic_global,
            'arp_footer_text_decoration_global' => $footer_style_decoration_global,
            'button_font_family_global' => $button_font_family_global,
            'button_font_size_global' => $button_font_size_global,
            'arp_button_text_alignment' => $arp_button_text_alignment,
            'arp_button_text_bold_global' => $button_style_bold_global,
            'arp_button_text_italic_global' => $button_style_italic_global,
            'arp_button_text_decoration_global' => $button_style_decoration_global,
            'description_font_family_global' => $description_font_family_global,
            'description_font_size_global' => $description_font_size_global,
            'arp_description_text_alignment' => $arp_description_text_alignment,
            'arp_description_text_bold_global' => $description_style_bold_global,
            'arp_description_text_italic_global' => $description_style_italic_global,
            'arp_description_text_decoration_global' => $description_style_decoration_global,
        );






        $arp_column_bg_custom_color = @$values['arp_column_background_color'];

        $arp_column_desc_bg_custom_color = @$values['arp_column_desc_background_color'];

        $arp_column_desc_hover_bg_custom_color = @$values['arp_column_desc_hover_background_color'];

        $arp_header_bg_custom_color = @$values['arp_header_background_color'];

        $arp_pricing_bg_custom_color = @$values['arp_pricing_background_color'];

        $arp_template_odd_row_bg_color = @$values['arp_body_odd_row_background_color'];

        $arp_template_odd_row_hover_bg_color = @$values['arp_body_odd_row_hover_background_color'];

        $arp_body_even_row_bg_custom_color = @$values['arp_body_even_row_background_color'];

        $arp_body_even_row_hover_bg_custom_color = @$values['arp_body_even_row_hover_background_color'];

        $arp_footer_content_bg_color = @$values['arp_footer_content_background_color'];

        $arp_footer_content_hover_bg_color = @$values['arp_footer_content_hover_background_color'];

        $arp_button_bg_custom_color = @$values['arp_button_background_color'];

        $arp_column_bg_hover_color = @$values['arp_column_bg_hover_color'];

        $arp_button_bg_hover_color = @$values['arp_button_bg_hover_color'];

        $arp_header_bg_hover_color = @$values['arp_header_bg_hover_color'];

        $arp_price_bg_hover_color = @$values['arp_price_bg_hover_color'];

        $arp_header_font_custom_color = @$values['arp_header_font_custom_color_input'];

        $arp_header_font_custom_hover_color_input = @$values['arp_header_font_custom_hover_color_input'];

        $arp_price_font_custom_color = @$values['arp_price_font_custom_color_input'];

        $arp_price_font_custom_hover_color_input = @$values['arp_price_font_custom_hover_color_input'];

        $arp_price_duration_font_custom_color = @$values['arp_price_duration_font_custom_color_input'];

        $arp_price_duration_font_custom_hover_color_input = @$values['arp_price_duration_font_custom_hover_color_input'];

        $arp_desc_font_custom_color = @$values['arp_desc_font_custom_color_input'];

        $arp_desc_font_custom_hover_color_input = @$values['arp_desc_font_custom_hover_color_input'];

        $arp_body_label_font_custom_color = @$values['arp_body_label_font_custom_color_input'];

        $arp_body_label_font_custom_hover_color_input = @$values['arp_body_label_font_custom_hover_color_input'];

        $arp_body_font_custom_color = @$values['arp_body_font_custom_color_input'];
        $arp_body_even_font_custom_color = @$values['arp_body_even_font_custom_color_input'];

        $arp_body_font_custom_hover_color_input = @$values['arp_body_font_custom_hover_color_input'];
        $arp_body_even_font_custom_hover_color_input = @$values['arp_body_even_font_custom_hover_color_input'];

        $arp_footer_font_custom_color = @$values['arp_footer_font_custom_color_input'];

        $arp_footer_font_custom_hover_color_input = @$values['arp_footer_font_custom_hover_color_input'];

        $arp_button_font_custom_color = @$values['arp_button_font_custom_color_input'];

        $arp_button_font_custom_hover_color_input = @$values['arp_button_font_custom_hover_color_input'];

        $arp_shortocode_background = @$values['arp_shortocode_background_color'];
        $arp_shortocode_font_color = @$values['arp_shortocode_font_custom_color_input'];
        $arp_shortcode_bg_hover_color = @$values['arp_shortcode_bg_hover_color'];
        $arp_shortcode_font_hover_color = @$values['arp_shortcode_font_custom_hover_color_input'];

        $custom_skin_colors = array(
            "arp_header_bg_custom_color" => $arp_header_bg_custom_color,
            "arp_column_bg_custom_color" => $arp_column_bg_custom_color,
            "arp_column_desc_bg_custom_color" => $arp_column_desc_bg_custom_color,
            "arp_column_desc_hover_bg_custom_color" => $arp_column_desc_hover_bg_custom_color,
            "arp_pricing_bg_custom_color" => $arp_pricing_bg_custom_color,
            "arp_body_odd_row_bg_custom_color" => $arp_template_odd_row_bg_color,
            "arp_body_odd_row_hover_bg_custom_color" => $arp_template_odd_row_hover_bg_color,
            "arp_body_even_row_hover_bg_custom_color" => $arp_body_even_row_hover_bg_custom_color,
            "arp_body_even_row_bg_custom_color" => $arp_body_even_row_bg_custom_color,
            "arp_footer_content_bg_color" => $arp_footer_content_bg_color,
            "arp_footer_content_hover_bg_color" => $arp_footer_content_hover_bg_color,
            "arp_button_bg_custom_color" => $arp_button_bg_custom_color,
            "arp_column_bg_hover_color" => $arp_column_bg_hover_color,
            "arp_button_bg_hover_color" => $arp_button_bg_hover_color,
            "arp_header_bg_hover_color" => $arp_header_bg_hover_color,
            "arp_price_bg_hover_color" => $arp_price_bg_hover_color,
            "arp_header_font_custom_color" => $arp_header_font_custom_color,
            "arp_header_font_custom_hover_color" => $arp_header_font_custom_hover_color_input,
            "arp_price_font_custom_color" => $arp_price_font_custom_color,
            "arp_price_font_custom_hover_color" => $arp_price_font_custom_hover_color_input,
            "arp_price_duration_font_custom_color" => $arp_price_duration_font_custom_color,
            "arp_price_duration_font_custom_hover_color" => $arp_price_duration_font_custom_hover_color_input,
            "arp_desc_font_custom_color" => $arp_desc_font_custom_color,
            "arp_desc_font_custom_hover_color" => $arp_desc_font_custom_hover_color_input,
            "arp_body_label_font_custom_color" => $arp_body_label_font_custom_color,
            "arp_body_label_font_custom_hover_color" => $arp_body_label_font_custom_hover_color_input,
            "arp_body_font_custom_color" => $arp_body_font_custom_color,
            "arp_body_even_font_custom_color" => $arp_body_even_font_custom_color,
            "arp_body_font_custom_hover_color" => $arp_body_font_custom_hover_color_input,
            "arp_body_even_font_custom_hover_color" => $arp_body_even_font_custom_hover_color_input,
            "arp_footer_font_custom_color" => $arp_footer_font_custom_color,
            "arp_footer_font_custom_hover_color" => $arp_footer_font_custom_hover_color_input,
            "arp_button_font_custom_color" => $arp_button_font_custom_color,
            "arp_button_font_custom_hover_color" => $arp_button_font_custom_hover_color_input,
            'arp_shortocode_background' => $arp_shortocode_background,
            'arp_shortocode_font_color' => $arp_shortocode_font_color,
            'arp_shortcode_bg_hover_color' => $arp_shortcode_bg_hover_color,
            'arp_shortcode_font_hover_color' => $arp_shortcode_font_hover_color,
        );

        $tab_general_opt = array('template_setting' => $template_setting, 'column_settings' => $column_setting, 'general_settings' => $general_settings, 'custom_skin_colors' => $custom_skin_colors);
        $general_opt = maybe_serialize($tab_general_opt);

        //for table options
        $sql_results = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "arplite_arprice_options WHERE table_id = %d", $table_id));
        $table_opt = $sql_results[0]->table_options;
        $uns_table_opt = maybe_unserialize($table_opt);
        $table_columns = $uns_table_opt['columns'];

        if (count($total) > 0) {
            if (count($new_id) > 1) {
                for ($i = 0; $i <= $total; $i++) {
                    if (!in_array($i, $new_id))
                        continue;
                    $Title = 'column_' . $i;
                    $column_width = @$values['column_width_' . $i];
                    $column_title = @$values['column_title_' . $i];
                    $column_desc = @$values['arp_column_description_' . $i];
                    $cstm_rbn_txt = @$values['arp_custom_ribbon_txt_' . $i];
                    $column_highlight = @$values['column_highlight_' . $i];
                    $column_background_color = @$values['column_background_color_' . $i];
                    $column_hover_background_color = @$values['column_hover_background_color_' . $i];
                    $arp_change_bgcolor = @$values['arp_change_bgcolor_' . $i];

                    $column_ribbon_style = @stripslashes_deep($values['arp_ribbon_style_' . $i]);
                    $column_ribbon_position = @stripslashes_deep($values['arp_ribbon_position_' . $i]);
                    $column_ribbon_bgcolor = @stripslashes_deep($values['arp_ribbon_bgcol_' . $i]);
                    $column_ribbon_txtcolor = @stripslashes_deep($values['arp_ribbon_textcol_' . $i]);
                    $column_ribbon_content = @stripslashes_deep($values['arp_ribbon_content_' . $i]);

                    $header_background_color = @$values['header_background_color_' . $i];
                    $header_hover_background_color = @$values['header_hover_background_color_' . $i];
                    $header_font_family = @$values['header_font_family_' . $i];
                    $header_font_size = @$values['header_font_size_' . $i];
                    $header_font_color = @$values['header_font_color_' . $i];
                    $header_hover_font_color = @$values['header_hover_font_color_' . $i];
                    $header_font_style = @$values['header_font_style_' . $i];
                    $header_font_align = @$values['arp_header_text_alignment_' . $i];

                    $header_style_bold = @$values['header_style_bold_' . $i];
                    $header_style_italic = @$values['header_style_italic_' . $i];
                    $header_style_decoration = @$values['header_style_decoration_' . $i];

                    $header_background_image = @stripslashes_deep(@$values['arp_header_background_image_' . $i]);

                    $price_background_color = @$values['price_background_color_' . $i];
                    $price_hover_background_color = @$values['price_hover_background_color_' . $i];
                    $price_font_family = @stripslashes_deep($values['price_font_family_' . $i]);
                    $price_font_size = @$values['price_font_size_' . $i];
                    $price_font_color = @$values['price_font_color_' . $i];
                    $price_hover_font_color = @$values['price_hover_font_color_' . $i];
                    $price_font_style = @stripslashes_deep($values['price_font_style_' . $i]);
                    $price_font_align = @stripslashes_deep($values['arp_price_text_alignment_' . $i]);

                    $price_label_style_bold = @$values['price_label_style_bold_' . $i];
                    $price_label_style_italic = @$values['price_label_style_italic_' . $i];
                    $price_label_style_decoration = @$values['price_label_style_decoration_' . $i];

                    $price_text_font_family = @stripslashes_deep($values['price_text_font_family_' . $i]);
                    $price_text_font_size = @$values['price_text_font_size_' . $i];
                    $price_text_font_style = @$values['price_text_font_style_' . $i];
                    $price_text_font_color = @stripslashes_deep($values['price_text_font_color_' . $i]);
                    $price_text_hover_font_color = @stripslashes_deep($values['price_text_hover_font_color_' . $i]);
                    $price_text_style_bold = @$values['price_text_style_bold_' . $i];
                    $price_text_style_italic = @$values['price_text_style_italic_' . $i];
                    $price_text_style_decoration = @$values['price_text_style_decoration_' . $i];

                    $column_description_font_family = @stripslashes_deep($values['column_description_font_family_' . $i]);
                    $column_description_font_size = @$values['column_description_font_size_' . $i];
                    $column_description_font_style = @$values['column_description_font_style_' . $i];
                    $column_description_font_color = @stripslashes_deep($values['column_description_font_color_' . $i]);
                    $column_description_hover_font_color = @stripslashes_deep($values['column_description_hover_font_color_' . $i]);
                    $column_desc_background_color = @stripslashes_deep(@$values['column_desc_background_color_' . $i]);
                    $column_desc_hover_background_color = @stripslashes_deep(@$values['column_desc_hover_background_color_' . $i]);

                    $column_description_style_bold = @$values['column_description_style_bold_' . $i];
                    $column_description_style_italic = @$values['column_description_style_italic_' . $i];
                    $column_description_style_decoration = @$values['column_description_style_decoration_' . $i];

                    $content_font_family = @stripslashes_deep($values['content_font_family_' . $i]);
                    $content_font_size = @$values['content_font_size_' . $i];
                    $content_font_color = @stripslashes_deep($values['content_font_color_' . $i]);
                    $content_font_style = @$values['content_font_style_' . $i];
                    $content_even_font_color = @stripslashes_deep($values['content_even_font_color_' . $i]);
                    $content_hover_font_color = @stripslashes_deep($values['content_hover_font_color_' . $i]);
                    $content_even_hover_font_color = @stripslashes_deep($values['content_even_hover_font_color_' . $i]);

                    $content_odd_color = @$values['content_odd_color_' . $i];
                    $content_odd_hover_color = @$values['content_odd_hover_color_' . $i];
                    $content_even_color = @$values['content_even_color_' . $i];
                    $content_even_hover_color = @$values['content_even_hover_color_' . $i];

                    $body_li_style_bold = @$values['body_li_style_bold_' . $i];
                    $body_li_style_italic = @$values['body_li_style_italic_' . $i];
                    $body_li_style_decoration = @$values['body_li_style_decoration_' . $i];

                    $content_label_font_family = @stripslashes_deep($values['content_label_font_family_' . $i]);
                    $content_label_font_size = @$values['content_label_font_size_' . $i];
                    $content_label_font_color = @stripslashes_deep($values['content_label_font_color_' . $i]);
                    $content_label_hover_font_color = @stripslashes_deep($values['content_label_hover_font_color_' . $i]);
                    $content_label_font_style = @$values['content_label_font_style_' . $i];

                    $body_label_style_bold = @$values['body_label_style_bold_' . $i];
                    $body_label_style_italic = @$values['body_label_style_italic_' . $i];
                    $body_label_style_decoration = @$values['body_label_style_decoration_' . $i];

                    $button_background_color = @$values['button_background_color_' . $i];
                    $button_hover_background_color = @$values['button_hover_background_color_' . $i];
                    $button_font_family = @stripslashes_deep($values['button_font_family_' . $i]);
                    $button_font_size = @$values['button_font_size_' . $i];
                    $button_font_color = @$values['button_font_color_' . $i];
                    $button_hover_font_color = @$values['button_hover_font_color_' . $i];
                    $button_font_style = @stripslashes_deep($values['button_font_style_' . $i]);

                    $button_style_bold = @$values['button_style_bold_' . $i];
                    $button_style_italic = @$values['button_style_italic_' . $i];
                    $button_style_decoration = @$values['button_style_decoration_' . $i];

                    $caption = isset($values['caption_column_' . $i]) ? $values['caption_column_' . $i] : 0;

                    $footer_content = @$values['footer_content_' . $i];
                    $footer_content_position = @$values['footer_content_position_' . $i];
                    $footer_level_options_font_family = @$values['footer_level_options_font_family_' . $i];
                    $footer_background_color = @$values['footer_bg_color_' . $i];
                    $footer_hover_background_color = @$values['footer_hover_bg_color_' . $i];
                    $footer_level_options_font_size = @$values['footer_level_options_font_size_' . $i];
                    $footer_level_options_font_color = @$values['footer_level_options_font_color_' . $i];
                    $footer_level_options_hover_font_color = @$values['footer_level_options_hover_font_color_' . $i];
                    $footer_level_options_font_style_bold = @$values['footer_level_options_font_style_bold_' . $i];
                    $footer_level_options_font_style_italic = @$values['footer_level_options_font_style_italic_' . $i];
                    $footer_level_options_font_style_decoration = @$values['footer_level_options_font_style_decoration_' . $i];
                    $footer_text_align = @$values['arp_footer_text_alignment_' . $i];


                    $header_shortcode = @stripslashes_deep($values['additional_shortcode_' . $i]);
                    $arp_shortcode_customization_style = @stripslashes_deep($values['arp_shortcode_customization_style_' . $i]);
                    $arp_shortcode_customization_size = @stripslashes_deep($values['arp_shortcode_customization_size_' . $i]);
                    $shortcode_background_color = @stripslashes_deep($values['shortcode_background_color_' . $i]);
                    $shortcode_font_color = @stripslashes_deep($values['shortcode_font_color_' . $i]);
                    $shortcode_hover_background_color = @stripslashes_deep($values['shortcode_hover_background_color_' . $i]);
                    $shortcode_hover_font_color = @stripslashes_deep($values['shortcode_hover_font_color_' . $i]);
                    $html_content = @stripslashes_deep($values['html_content_' . $i]);
                    $price_text = @stripslashes_deep($values['price_text_' . $i]);

                    $price_label = @stripslashes_deep($values['price_label_' . $i]);
                    $gmap_marker = @$values['gmap_marker' . $i];
                    $total_rows = @$values['total_rows_' . $i];

                    $row = array();
                    if ($total_rows > 0) {
                        for ($j = 0; $j < $total_rows; $j++) {
                            $row_title = 'row_' . $j;
                            $row_label = @$values['row_' . $i . '_label_' . $j];
                            $row_des_align = @$values['row_' . $i . '_description_text_alignment_' . $j];
                            $row_des = @stripslashes_deep($values['row_' . $i . '_description_' . $j]);
                            $row_des_style_bold = @stripslashes_deep($values['body_li_style_bold_column_' . $i . '_arp_row_' . $j]);
                            $row_des_style_italic = @stripslashes_deep($values['body_li_style_italic_column_' . $i . '_arp_row_' . $j]);
                            $row_des_style_decoration = @stripslashes_deep($values['body_li_style_decoration_column_' . $i . '_arp_row_' . $j]);
                            $row_caption_style_bold = @stripslashes_deep($values['body_li_style_bold_caption_column_' . $i . '_arp_row_' . $j]);
                            $row_caption_style_italic = @stripslashes_deep($values['body_li_style_italic_caption_column_' . $i . '_arp_row_' . $j]);
                            $row_caption_style_decoration = @stripslashes_deep($values['body_li_style_decoration_caption_column_' . $i . '_arp_row_' . $j]);

                            $row[$row_title] = array('row_des_txt_align' => $row_des_align, 'row_description' => $row_des, 'row_label' => $row_label, 'row_des_style_bold' => $row_des_style_bold, 'row_des_style_italic' => $row_des_style_italic, 'row_des_style_decoration' => $row_des_style_decoration, 'row_caption_style_bold' => $row_caption_style_bold, 'row_caption_style_italic' => $row_caption_style_italic, 'row_caption_style_decoration' => $row_caption_style_decoration);

                            unset($values['row_' . $i . '_description_text_alignment_' . $j]);
                            unset($values['row_' . $i . '_description_' . $j]);
                            unset($values['body_li_style_bold_column_' . $i . '_arp_row_' . $j]);
                            unset($values['body_li_style_italic_column_' . $i . '_arp_row_' . $j]);
                            unset($values['body_li_style_decoration_column_' . $i . '_arp_row_' . $j]);
                            unset($values['body_li_style_bold_caption_column_' . $i . '_arp_row_' . $j]);
                            unset($values['body_li_style_italic_caption_column_' . $i . '_arp_row_' . $j]);
                            unset($values['body_li_style_decoration_caption_column_' . $i . '_arp_row_' . $j]);
                        }
                    }
                    $body_text_alignemnt = @$values['body_text_alignment_' . $i];
                    $btn_size = @$values['button_size_' . $i];
                    $btn_height = @$values['button_height_' . $i];
                    $btn_type = @$values['button_type_' . $i];
                    $btn_text = @stripslashes_deep($values['btn_content_' . $i]);
                    $btn_link = @$values['btn_link_' . $i];
                    $btn_img = @$values['btn_img_url_' . $i];
                    $btn_img_height = @$values['button_img_height_' . $i];
                    $btn_img_width = @$values['button_img_width_' . $i];
                    $is_new_window = @$values['new_window_' . $i];

                    if (!@$table_columns[$Title]['row_order'] || !is_array(@$table_columns[$Title]['row_order'])) {
                        @parse_str($values[$Title . '_row_order'], $col_row_order);
                        $row_order = @$col_row_order;
                    } else
                        $row_order = @$table_columns[$Title]['row_order'];

                    $ribbon_settings = array(
                        'arp_ribbon' => $column_ribbon_style,
                        'arp_ribbon_bgcol' => $column_ribbon_bgcolor,
                        'arp_ribbon_txtcol' => $column_ribbon_txtcolor,
                        'arp_ribbon_position' => $column_ribbon_position,
                        'arp_ribbon_content' => $column_ribbon_content,
                    );

                    $column[$Title] = array(
                        'package_title' => $column_title,
                        'column_width' => $column_width,
                        'is_caption' => $caption,
                        'column_description' => $column_desc,
                        'custom_ribbon_txt' => $cstm_rbn_txt,
                        'column_highlight' => $column_highlight,
                        'column_background_color' => $column_background_color,
                        'column_hover_background_color' => $column_hover_background_color,
                        'arp_change_bgcolor' => $arp_change_bgcolor,
                        'arp_header_shortcode' => $header_shortcode,
                        'arp_shortcode_customization_size' => $arp_shortcode_customization_size,
                        'arp_shortcode_customization_style' => $arp_shortcode_customization_style,
                        'shortcode_background_color' => $shortcode_background_color,
                        'shortcode_font_color' => $shortcode_font_color,
                        'shortcode_hover_background_color' => $shortcode_hover_background_color,
                        'shortcode_hover_font_color' => $shortcode_hover_font_color,
                        'html_content' => $html_content,
                        'price_text' => $price_text,
                        'price_label' => $price_label,
                        'gmap_marker' => @$google_map_marker,
                        'body_text_alignment' => @$body_text_alignemnt,
                        'rows' => $row,
                        'button_size' => $btn_size,
                        'button_height' => $btn_height,
                        'button_type' => $btn_type,
                        'button_text' => $btn_text,
                        'button_url' => $btn_link,
                        'btn_img' => $btn_img,
                        'btn_img_height' => $btn_img_height,
                        'btn_img_width' => $btn_img_width,
                        'row_order' => $row_order,
                        'ribbon_setting' => $ribbon_settings,
                        'header_background_color' => $header_background_color,
                        'header_hover_background_color' => $header_hover_background_color,
                        'header_font_family' => $header_font_family,
                        'header_font_size' => $header_font_size,
                        'header_font_color' => $header_font_color,
                        'header_hover_font_color' => $header_hover_font_color,
                        'header_font_style' => $header_font_style,
                        'header_style_bold' => $header_style_bold,
                        'header_style_italic' => $header_style_italic,
                        'header_style_decoration' => $header_style_decoration,
                        'header_background_image' => $header_background_image,
                        'price_background_color' => $price_background_color,
                        'price_hover_background_color' => $price_hover_background_color,
                        'price_font_family' => $price_font_family,
                        'price_font_size' => $price_font_size,
                        'price_font_style' => $price_font_style,
                        'price_font_color' => $price_font_color,
                        'price_hover_font_color' => $price_hover_font_color,
                        'price_label_style_bold' => $price_label_style_bold,
                        'price_label_style_italic' => $price_label_style_italic,
                        'price_label_style_decoration' => $price_label_style_decoration,
                        'price_text_font_family' => $price_text_font_family,
                        'price_text_font_size' => $price_text_font_size,
                        'price_text_font_style' => $price_text_font_style,
                        'price_text_font_color' => $price_text_font_color,
                        'price_text_hover_font_color' => $price_text_hover_font_color,
                        'price_text_style_bold' => $price_text_style_bold,
                        'price_text_style_italic' => $price_text_style_italic,
                        'price_text_style_decoration' => $price_text_style_decoration,
                        'content_font_family' => $content_font_family,
                        'content_font_size' => $content_font_size,
                        'content_font_style' => $content_font_style,
                        'content_font_color' => $content_font_color,
                        'content_odd_color' => $content_odd_color,
                        'content_even_color' => $content_even_color,
                        'content_even_font_color' => $content_even_font_color,
                        'content_hover_font_color' => $content_hover_font_color,
                        'content_even_hover_font_color' => $content_even_hover_font_color,
                        'content_odd_color' => $content_odd_color,
                        'content_odd_hover_color' => $content_odd_hover_color,
                        'content_even_color' => $content_even_color,
                        'content_even_hover_color' => $content_even_hover_color,
                        'body_li_style_bold' => $body_li_style_bold,
                        'body_li_style_italic' => $body_li_style_italic,
                        'body_li_style_decoration' => $body_li_style_decoration,
                        'content_label_font_family' => $content_label_font_family,
                        'content_label_font_size' => $content_label_font_size,
                        'content_label_font_style' => $content_label_font_style,
                        'content_label_font_color' => $content_label_font_color,
                        'content_label_hover_font_color' => $content_label_hover_font_color,
                        'body_label_style_bold' => $body_label_style_bold,
                        'body_label_style_italic' => $body_label_style_italic,
                        'body_label_style_decoration' => $body_label_style_decoration,
                        'button_background_color' => $button_background_color,
                        'button_hover_background_color' => $button_hover_background_color,
                        'button_font_family' => $button_font_family,
                        'button_font_size' => $button_font_size,
                        'button_font_color' => $button_font_color,
                        'button_hover_font_color' => $button_hover_font_color,
                        'button_font_style' => $button_font_style,
                        'button_style_bold' => $button_style_bold,
                        'button_style_italic' => $button_style_italic,
                        'button_style_decoration' => $button_style_decoration,
                        'column_description_font_family' => $column_description_font_family,
                        'column_description_font_size' => $column_description_font_size,
                        'column_description_font_style' => $column_description_font_style,
                        'column_description_font_color' => $column_description_font_color,
                        'column_description_hover_font_color' => $column_description_hover_font_color,
                        'column_desc_background_color' => $column_desc_background_color,
                        'column_desc_hover_background_color' => $column_desc_hover_background_color,
                        'column_description_style_bold' => $column_description_style_bold,
                        'column_description_style_italic' => $column_description_style_italic,
                        'column_description_style_decoration' => $column_description_style_decoration,
                        'footer_content' => $footer_content,
                        'footer_content_position' => $footer_content_position,
                        'footer_level_options_font_family' => $footer_level_options_font_family,
                        'footer_background_color' => $footer_background_color,
                        'footer_hover_background_color' => $footer_hover_background_color,
                        'footer_level_options_font_size' => $footer_level_options_font_size,
                        'footer_level_options_font_color' => $footer_level_options_font_color,
                        'footer_level_options_font_style_bold' => $footer_level_options_font_style_bold,
                        'footer_level_options_hover_font_color' => $footer_level_options_hover_font_color,
                        'footer_level_options_font_style_italic' => $footer_level_options_font_style_italic,
                        'footer_level_options_font_style_decoration' => $footer_level_options_font_style_decoration,
                        'footer_text_align' => $footer_text_align,
                        'description_text_alignment' => @$column_description_text_align,
                        'price_font_align' => $price_font_align,
                        'header_font_align' => $header_font_align,
                    );
                }
            } else {
                $i = $new_id[0];
                $Title = 'column_' . $i;
                $column_width = @$values['column_width_' . $i];
                $column_title = @$values['column_title_' . $i];
                $column_desc = @$values['arp_column_description_' . $i];
                $cstm_rbn_txt = @$values['arp_custom_ribbon_txt_' . $i];
                $column_highlight = @$values['column_highlight_' . $i];
                $column_background_color = @$values['column_background_color_' . $i];
                $column_hover_background_color = @$values['column_hover_background_color_' . $i];
                $arp_change_bgcolor = @$values['arp_change_bgcolor_' . $i];
                $caption = isset($values['caption_column_' . $i]) ? $values['caption_column_' . $i] : 0;
                $footer_content = @$values['footer_content_' . $i];
                $footer_content_position = @$values['footer_content_position_' . $i];
                $footer_level_options_font_family = @$values['footer_level_options_font_family_' . $i];
                $footer_background_color = @$values['footer_bg_color_' . $i];
                $footer_hover_background_color = @$values['footer_hover_bg_color_' . $i];
                $footer_level_options_font_size = @$values['footer_level_options_font_size_' . $i];
                $footer_level_options_font_color = @$values['footer_level_options_font_color_' . $i];
                $footer_level_options_hover_font_color = @$values['footer_level_options_font_hover_color_' . $i];
                $footer_level_options_font_style_bold = @$values['footer_level_options_font_style_bold_' . $i];
                $footer_level_options_font_style_italic = @$values['footer_level_options_font_style_italic_' . $i];
                $footer_level_options_font_style_decoration = @$values['footer_level_options_font_style_decoration_' . $i];
                $footer_text_align = @$values['arp_footer_text_alignment_' . $i];

                $header_shortcode = @stripslashes_deep(@$values['additional_shortcode_' . $i]);
                $arp_shortcode_customization_style = @stripslashes_deep(@$values['arp_shortcode_customization_style_' . $i]);
                $arp_shortcode_customization_size = @stripslashes_deep(@$values['arp_shortcode_customization_size_' . $i]);

                $shortcode_background_color = @stripslashes_deep(@$values['shortcode_background_color_' . $i]);
                $shortcode_font_color = @stripslashes_deep(@$values['shortcode_font_color_' . $i]);
                $shortcode_hover_background_color = @stripslashes_deep(@$values['shortcode_hover_background_color_' . $i]);
                $shortcode_hover_font_color = @stripslashes_deep(@$values['shortcode_hover_font_color_' . $i]);
                $html_content = @stripslashes_deep(@$values['html_content_' . $i]);
                $price_text = @stripslashes_deep(@$values['price_text_' . $i]);
                $price_label = @stripslashes_deep(@$values['price_label_' . $i]);
                $gmap_marker = @$values['gmap_marker_' . $i];
                $total_rows = @$values['total_rows_' . $i];
                $column_ribbon_style = @stripslashes_deep(@$values['arp_ribbon_style_' . $i]);
                $column_ribbon_position = @stripslashes_deep(@$values['arp_ribbon_position_' . $i]);
                $column_ribbon_bgcolor = @stripslashes_deep(@$values['arp_ribbon_bgcol_' . $i]);
                $column_ribbon_txtcolor = @stripslashes_deep(@$values['arp_ribbon_textcol_' . $i]);
                $column_ribbon_content = @stripslashes_deep(@$values['arp_ribbon_content_' . $i]);

                $header_background_color = @$values['header_background_color_' . $i];
                $header_hover_background_color = @$values['header_hover_background_color_' . $i];

                $header_font_family = @$values['header_font_family_' . $i];
                $header_font_size = @$values['header_font_size_' . $i];
                $header_font_color = @$values['header_font_color_' . $i];
                $header_hover_font_color = @$values['header_hover_font_color_' . $i];
                $header_font_style = @$values['header_font_style_' . $i];

                $header_style_bold = @$values['header_style_bold_' . $i];
                $header_style_italic = @$values['header_style_italic_' . $i];
                $header_style_decoration = @$values['header_style_decoration_' . $i];

                $price_background_color = @$values['price_background_color_' . $i];
                $price_hover_background_color = @$values['price_hover_background_color_' . $i];
                $price_font_family = @stripslashes_deep(@$values['price_font_family_' . $i]);
                $price_font_size = @$values['price_font_size_' . $i];
                $price_font_color = @$values['price_font_color_' . $i];
                $price_hover_font_color = @$values['price_hover_font_color_' . $i];
                $price_font_style = @$values['price_font_style_' . $i];

                $price_label_style_bold = @$values['price_label_style_bold_' . $i];
                $price_label_style_italic = @$values['price_label_style_italic_' . $i];
                $price_label_style_decoration = @$values['price_label_style_decoration_' . $i];

                $price_text_font_family = @stripslashes_deep(@$values['price_text_font_family_' . $i]);
                $price_text_font_size = @$values['price_text_font_size_' . $i];
                $price_text_font_style = @$values['price_text_font_style_' . $i];
                $price_text_font_color = @$values['price_text_font_color_' . $i];
                $price_text_hover_font_color = @$values['price_text_hover_font_color_' . $i];

                $price_text_style_bold = @$values['price_text_style_bold_' . $i];
                $price_text_style_italic = @$values['price_text_style_italic_' . $i];
                $price_text_style_decoration = @$values['price_text_style_decoration_' . $i];

                $column_description_font_family = @stripslashes_deep(@$values['column_description_font_family_' . $i]);
                $column_description_font_size = @stripslashes_deep(@$values['column_description_font_size_' . $i]);
                $column_description_font_style = @stripslashes_deep(@$values['column_description_font_style_' . $i]);
                $column_description_font_color = @stripslashes_deep(@$values['column_description_font_color_' . $i]);
                $column_description_hover_font_color = @stripslashes_deep(@$values['column_description_hover_font_color_' . $i]);
                $column_desc_background_color = @stripslashes_deep(@$values['column_desc_background_color_' . $i]);
                $column_desc_hover_background_color = @stripslashes_deep(@$values['column_desc_hover_background_color_' . $i]);

                $column_description_style_bold = @$values['column_description_style_bold_' . $i];
                $column_description_style_italic = @$values['column_description_style_italic_' . $i];
                $column_description_style_decoration = @$values['column_description_style_decoration_' . $i];

                $content_font_family = @$values['content_font_family_' . $i];
                $content_font_size = @$values['content_font_size_' . $i];
                $content_font_color = @$values['content_font_color_' . $i];
                $content_even_font_color = @$values['content_even_font_color_' . $i];
                $content_hover_font_color = @$values['content_hover_font_color_' . $i];
                $content_even_hover_font_color = @$values['content_even_hover_font_color_' . $i];
                $content_font_style = @$values['content_font_style_' . $i];

                $content_odd_color = @$values['content_odd_color_' . $i];
                $content_odd_hover_color = @$values['content_odd_hover_color_' . $i];
                $content_even_color = @$Values['content_even_color_' . $i];
                $content_even_hover_color = @$Values['content_even_hover_color_' . $i];

                $body_li_style_bold = @$values['body_li_style_bold_' . $i];
                $body_li_style_italic = @$values['body_li_style_italic_' . $i];
                $body_li_style_decoration = @$values['body_li_style_decoration_' . $i];

                $content_label_font_family = @stripslashes_deep(@$values['content_label_font_family_' . $i]);
                $content_label_font_size = @$values['content_label_font_size_' . $i];
                $content_label_font_color = @stripslashes_deep(@$values['content_label_font_color_' . $i]);
                $content_label_hover_font_color = @stripslashes_deep(@$values['content_label_hover_font_color_' . $i]);
                $content_label_font_style = @$values['content_label_font_style_' . $i];
                $body_label_style_bold = @$values['body_label_style_bold_' . $i];
                $body_label_style_italic = @$values['body_label_style_italic_' . $i];
                $body_label_style_decoration = @$values['body_label_style_decoration_' . $i];

                $button_background_color = @$values['button_background_color_' . $i];
                $button_hover_background_color = @$values['button_hover_background_color_' . $i];
                $button_font_family = @$values['button_font_family_' . $i];
                $button_font_size = @$values['button_font_size_' . $i];
                $button_font_color = @$values['button_font_color_' . $i];
                $button_hover_font_color = @$values['button_hover_font_color_' . $i];
                $button_font_style = @$values['button_font_style_' . $i];

                $button_style_bold = @$values['button_style_bold_' . $i];
                $button_style_italic = @$values['button_style_italic_' . $i];
                $button_style_decoration = @$values['button_style_decoration_' . $i];

                $row = array();
                if ($total_rows > 0) {
                    for ($j = 0; $j < $total_rows; $j++) {
                        $row_title = 'row_' . $j;
                        $row_label = @$values['row_' . $i . '_label_' . $j];
                        $row_des_align = @$values['row_' . $i . '_description_text_alignment_' . $j];
                        $row_des = @stripslashes_deep(@$values['row_' . $i . '_description_' . $j]);
                        $row_des_style_bold = @stripslashes_deep(@$values['body_li_style_bold_column_' . $i . '_arp_row_' . $j]);
                        $row_des_style_italic = @stripslashes_deep(@$values['body_li_style_italic_column_' . $i . '_arp_row_' . $j]);
                        $row_des_style_decoration = @stripslashes_deep(@$values['body_li_style_decoration_column_' . $i . '_arp_row_' . $j]);
                        $row_caption_style_bold = @stripslashes_deep(@$values['body_li_style_bold_caption_column_' . $i . '_arp_row_' . $j]);
                        $row_caption_style_italic = @stripslashes_deep(@$values['body_li_style_italic_caption_column_' . $i . '_arp_row_' . $j]);
                        $row_caption_style_decoration = @stripslashes_deep(@$values['body_li_style_decoration_caption_column_' . $i . '_arp_row_' . $j]);

                        $row[$row_title] = array('row_des_txt_align' => $row_des_align, 'row_description' => $row_des, 'row_label' => $row_label, 'row_des_style_bold' => $row_des_style_bold, 'row_des_style_italic' => $row_des_style_italic, 'row_des_style_decoration' => $row_des_style_decoration, 'row_caption_style_bold' => $row_caption_style_bold, 'row_caption_style_italic' => $row_caption_style_italic, 'row_caption_style_decoration' => $row_caption_style_decoration);

                        unset($values['row_' . $i . '_description_text_alignment_' . $j]);
                        unset($values['row_' . $i . '_description_' . $j]);
                        unset($values['body_li_style_bold_column_' . $i . '_arp_row_' . $j]);
                        unset($values['body_li_style_italic_column_' . $i . '_arp_row_' . $j]);
                        unset($values['body_li_style_decoration_column_' . $i . '_arp_row_' . $j]);
                        unset($values['body_li_style_bold_caption_column_' . $i . '_arp_row_' . $j]);
                        unset($values['body_li_style_italic_caption_column_' . $i . '_arp_row_' . $j]);
                        unset($values['body_li_style_decoration_caption_column_' . $i . '_arp_row_' . $j]);
                    }
                }
                $body_text_alignemnt = @$values['body_text_alignment_' . $i];
                $btn_size = @$values['button_size_' . $i];
                $btn_height = @$values['button_height_' . $i];
                $btn_type = @$values['button_type_' . $i];
                $btn_text = @stripslashes_deep(@$values['btn_content_' . $i]);
                $btn_link = @$values['btn_link_' . $i];
                $btn_img = @$values['btn_img_url_' . $i];
                $btn_img_height = @$values['button_img_height_' . $i];
                $btn_img_width = @$values['button_img_width_' . $i];
                $hide_default_btn = @$values['arp_hide_default_btn_' . $i];
                $is_new_window = @$values['new_window_' . $i];

                if (!@$table_columns[$Title]['row_order'] || !is_array(@$table_columns[$Title]['row_order'])) {
                    @parse_str($values[$Title . '_row_order'], $col_row_order);
                    $row_order = $col_row_order;
                } else
                    $row_order = $table_columns[$Title]['row_order'];

                $ribbon_settings = array(
                    'arp_ribbon' => $column_ribbon_style,
                    'arp_ribbon_bgcol' => $column_ribbon_bgcolor,
                    'arp_ribbon_txtcol' => $column_ribbon_txtcolor,
                    'arp_ribbon_position' => $column_ribbon_position,
                    'arp_ribbon_content' => $column_ribbon_content,
                );

                $column[$Title] = array(
                    'package_title' => $column_title,
                    'column_width' => $column_width,
                    'is_caption' => $caption,
                    'column_highlight' => $column_highlight,
                    'column_background_color' => $column_background_color,
                    'column_hover_background_color' => $column_hover_background_color,
                    'arp_change_bgcolor' => $arp_change_bgcolor,
                    'column_description' => $column_desc,
                    'arp_header_shortcode' => $header_shortcode,
                    'arp_shortcode_customization_size' => $arp_shortcode_customization_size,
                    'arp_shortcode_customization_style' => $arp_shortcode_customization_style,
                    'shortcode_background_color' => $shortcode_background_color,
                    'shortcode_font_color' => $shortcode_font_color,
                    'shortcode_hover_background_color' => $shortcode_hover_background_color,
                    'shortcode_hover_font_color' => $shortcode_hover_font_color,
                    'html_content' => $html_content,
                    'price_text' => $price_text,
                    'price_label' => $price_label,
                    'gmap_marker' => @$google_map_marker,
                    'body_text_alignment' => $body_text_alignemnt,
                    'rows' => $row,
                    'button_size' => $btn_size,
                    'button_height' => $btn_height,
                    'button_type' => $btn_type,
                    'button_text' => $btn_text,
                    'button_url' => $btn_link,
                    'btn_img' => $btn_img,
                    'btn_img_height' => $btn_img_height,
                    'btn_img_width' => $btn_img_width,
                    'is_new_window' => $is_new_window,
                    'row_order' => $row_order,
                    'ribbon_setting' => $ribbon_settings,
                    'header_background_color' => $header_background_color,
                    'header_hover_background_color' => $header_hover_background_color,
                    'header_font_family' => $header_font_family,
                    'header_font_size' => $header_font_size,
                    'header_font_color' => $header_font_color,
                    'header_hover_font_color' => $header_hover_font_color,
                    'header_font_style' => $header_font_style,
                    'header_style_bold' => $header_style_bold,
                    'header_style_italic' => $header_style_italic,
                    'header_style_decoration' => $header_style_decoration,
                    'header_background_image' => @$header_background_image,
                    'price_background_color' => $price_background_color,
                    'price_hover_background_color' => $price_hover_background_color,
                    'price_font_family' => $price_font_family,
                    'price_font_size' => $price_font_size,
                    'price_font_style' => $price_font_style,
                    'price_font_color' => $price_font_color,
                    'price_hover_font_color' => $price_hover_font_color,
                    'price_label_style_bold' => $price_label_style_bold,
                    'price_label_style_italic' => $price_label_style_italic,
                    'price_label_style_decoration' => $price_label_style_decoration,
                    'price_text_font_family' => $price_text_font_family,
                    'price_text_font_size' => $price_text_font_size,
                    'price_text_font_style' => $price_text_font_style,
                    'price_text_font_color' => $price_text_font_color,
                    'price_text_hover_font_color' => $price_text_hover_font_color,
                    'price_text_style_bold' => $price_text_style_bold,
                    'price_text_style_italic' => $price_text_style_italic,
                    'price_text_style_decoration' => $price_text_style_decoration,
                    'content_font_family' => $content_font_family,
                    'content_font_size' => $content_font_size,
                    'content_font_style' => $content_font_style,
                    'content_font_color' => $content_font_color,
                    'content_even_font_color' => $content_even_font_color,
                    'content_hover_font_color' => $content_hover_font_color,
                    'content_even_hover_font_color' => $content_even_hover_font_color,
                    'content_odd_color' => $content_odd_color,
                    'content_odd_hover_color' => $content_odd_hover_color,
                    'content_even_color' => $content_even_color,
                    'content_even_hover_color' => $content_even_hover_color,
                    'body_li_style_bold' => $body_li_style_bold,
                    'body_li_style_italic' => $body_li_style_italic,
                    'body_li_style_decoration' => $body_li_style_decoration,
                    'content_label_font_family' => $content_label_font_family,
                    'content_label_font_size' => $content_label_font_size,
                    'content_label_font_style' => $content_label_font_style,
                    'content_label_font_color' => $content_label_font_color,
                    'content_label_hover_font_color' => $content_label_hover_font_color,
                    'body_label_style_bold' => $body_label_style_bold,
                    'body_label_style_italic' => $body_label_style_italic,
                    'body_label_style_decoration' => $body_label_style_decoration,
                    'button_background_color' => $button_background_color,
                    'button_hover_background_color' => $button_hover_background_color,
                    'button_font_family' => $button_font_family,
                    'button_font_size' => $button_font_size,
                    'button_font_color' => $button_font_color,
                    'button_hover_font_color' => $button_hover_font_color,
                    'button_font_style' => $button_font_style,
                    'button_style_bold' => $button_style_bold,
                    'button_style_italic' => $button_style_italic,
                    'button_style_decoration' => $button_style_decoration,
                    'column_description_font_family' => $column_description_font_family,
                    'column_description_font_size' => $column_description_font_size,
                    'column_description_font_style' => $column_description_font_style,
                    'column_description_hover_font_color' => $column_description_hover_font_color,
                    'column_desc_background_color' => $column_desc_background_color,
                    'column_desc_hover_background_color' => $column_desc_hover_background_color,
                    'column_description_font_color' => $column_description_font_color,
                    'column_description_hover_font_color' => $column_description_hover_font_color,
                    'column_description_style_bold' => $column_description_style_bold,
                    'column_description_style_italic' => $column_description_style_italic,
                    'column_description_style_decoration' => $column_description_style_decoration,
                    'footer_content' => $footer_content,
                    'footer_content_position' => $footer_content_position,
                    'footer_level_options_font_family' => $footer_level_options_font_family,
                    'footer_background_color' => $footer_background_color,
                    'footer_hover_background_color' => $footer_hover_background_color,
                    'footer_level_options_font_size' => $footer_level_options_font_size,
                    'footer_level_options_font_color' => $footer_level_options_font_color,
                    'footer_level_options_hover_font_color' => $footer_level_options_hover_font_color,
                    'footer_level_options_font_style_bold' => $footer_level_options_font_style_bold,
                    'footer_level_options_font_style_italic' => $footer_level_options_font_style_italic,
                    'footer_level_options_font_style_decoration' => $footer_level_options_font_style_decoration,
                    'footer_text_align' => $footer_text_align,
                    'description_text_alignment' => @$column_description_text_align,
                    'price_font_align' => @$price_font_align,
                    'header_font_align' => @$header_font_align,
                );
            }
        }
        else {
            return;
        }

        $uns_table_opt['columns'] = $column;

        $table_options = maybe_serialize($uns_table_opt);

        $table_arr = array('table_id' => $table_id, 'general_options' => $general_opt, 'table_options' => $table_options, 'is_template' => $is_template, 'template_name' => $template_name, 'is_animated' => $is_animated);

        return $table_arr;
    }

    function arp_updatetabledata() {
        $all_previewtabledata_option = get_option('arplite_previewoptions');
        $all_previewtabledata_option = maybe_unserialize($all_previewtabledata_option);
        $all_previewtabledata_option = (array) $all_previewtabledata_option;

        if (get_option('arplite_previewtabledata_1') == '') {
            update_option('arplite_previewtabledata_1', $_POST);
            $all_previewtabledata_option['arplite_previewtabledata_1'] = time();
            echo 'arplite_previewtabledata_1';
        } else if (get_option('arplite_previewtabledata_2') == '') {
            update_option('arplite_previewtabledata_2', $_POST);
            $all_previewtabledata_option['arplite_previewtabledata_2'] = time();
            echo 'arplite_previewtabledata_2';
        } else if (get_option('arplite_previewtabledata_3') == '') {
            update_option('arplite_previewtabledata_3', $_POST);
            $all_previewtabledata_option['arplite_previewtabledata_3'] = time();
            echo 'arplite_previewtabledata_3';
        } else if (get_option('arplite_previewtabledata_4') == '') {
            update_option('arplite_previewtabledata_4', $_POST);
            $all_previewtabledata_option['arplite_previewtabledata_4'] = time();
            echo 'arplite_previewtabledata_4';
        } else if (get_option('arplite_previewtabledata_5') == '') {
            update_option('arplite_previewtabledata_5', $_POST);
            $all_previewtabledata_option['arplite_previewtabledata_5'] = time();
            echo 'arplite_previewtabledata_5';
        } else if (get_option('arplite_previewtabledata_6') == '') {
            update_option('arplite_previewtabledata_6', $_POST);
            $all_previewtabledata_option['arplite_previewtabledata_6'] = time();
            echo 'arplite_previewtabledata_6';
        } else if (get_option('arplite_previewtabledata_7') == '') {
            update_option('arplite_previewtabledata_7', $_POST);
            $all_previewtabledata_option['arplite_previewtabledata_7'] = time();
            echo 'arplite_previewtabledata_7';
        } else if (get_option('arplite_previewtabledata_8') == '') {
            update_option('arplite_previewtabledata_8', $_POST);
            $all_previewtabledata_option['arplite_previewtabledata_8'] = time();
            echo 'arplite_previewtabledata_8';
        } else if (get_option('arplite_previewtabledata_9') == '') {
            update_option('arplite_previewtabledata_9', $_POST);
            $all_previewtabledata_option['arplite_previewtabledata_9'] = time();
            echo 'arplite_previewtabledata_9';
        } else {
            $random = rand(11, 9999);
            if (get_option('arplite_previewtabledata_' . $random) != '')
                $random = rand(11, 9999);
            update_option('arplite_previewtabledata_' . $random, $_POST);
            $all_previewtabledata_option['arplite_previewtabledata_' . $random] = time();
            echo 'arplite_previewtabledata_' . $random;
        }

        update_option('arplite_previewoptions', $all_previewtabledata_option);

        die();
    }

    function get_table_enqueue_data($tablearr = array()) {
        if (!$tablearr)
            return;

        global $wpdb;

        $tableresutls = array();

        foreach ($tablearr as $table_id) {
            $tabledata = $wpdb->get_row($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "arplite_arprice WHERE ID = %d and is_template = 0", $table_id));
            $tableoption = $wpdb->get_row($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "arplite_arprice_options WHERE table_id = %d", $table_id));

            if ($tabledata && $tableoption) {
                $general_options = maybe_unserialize($tabledata->general_options);
                $table_options = maybe_unserialize($tableoption->table_options);

                $googlemap = 0;
                if ($table_options['columns']) {
                    foreach ($table_options['columns'] as $columns) {
                        $html_content = isset($columns['arp_header_shortcode']) ? $columns['arp_header_shortcode'] : "";
                        if (preg_match('/arp_googlemap/', $html_content))
                            $googlemap = 1;
                    }
                }

                $tableresutls[$tabledata->ID] = array(
                    'template' => $general_options['template_setting']['template'],
                    'skin' => $general_options['template_setting']['skin'],
                    'template_name' => $tabledata->template_name,
                    'is_template' => $tabledata->is_template,
                    'googlemap' => $googlemap,
                );
            }
        }

        return $tableresutls;
    }

    function arp_choose_template_type($template_1 = '') {
        global $arplite_mainoptionsarr;
        if ($template_1 == '')
            $template = $_REQUEST['template'];
        else
            $template = $template_1;

        if ($template_1 != '')
            return $arplite_mainoptionsarr['general_options']['template_options']['template_type'][$template];
        else
            echo $arplite_mainoptionsarr['general_options']['template_options']['template_type'][$template];

        die();
    }

    function arplite_widget_text_filter($content) {
        $regex = '/\[\s*ARPLite\s+.*\]/';
        return preg_replace_callback($regex, array($this, 'arplite_widget_text_filter_callback'), $content);
    }

    function arplite_widget_text_filter_callback($matches) {

        global $arpricelite_form;

        if ($matches[0]) {
            $parts = explode("id=", $matches[0]);
            $partsnew = explode(" ", $parts[1]);
            $tableid = $partsnew[0];
            $tableid = @trim($tableid);
            if ($tableid) {
                $newvalues_enqueue = $arpricelite_form->get_table_enqueue_data(array($tableid));

                if (is_array($newvalues_enqueue) && count($newvalues_enqueue) > 0) {
                    $to_google_map = 0;
                    $templates = array();

                    foreach ($newvalues_enqueue as $newqnqueue) {
                        if ($newqnqueue['googlemap'])
                            $to_google_map = 1;

                        $templates[] = $newqnqueue['template'];
                    }

                    $templates = array_unique($templates);

                    if ($templates) {
                        wp_enqueue_script('arprice_js');

                        wp_enqueue_style('arprice_front_css');
                        wp_enqueue_style('arp_fontawesome_css');
                        wp_enqueue_style('arprice_font_css_front');

                        foreach ($templates as $template) {
                            foreach ($newvalues_enqueue as $template_id => $newqnqueue) {
                                if (isset($newqnqueue['is_template']) && !empty($newqnqueue['is_template'])) {
                                    wp_register_style('arplitetemplate_' . $newqnqueue['template_name'] . '_css', ARPLITE_PRICINGTABLE_URL . '/css/templates/arplitetemplate_' . $newqnqueue['template_name'] . '.css', array(), null);
                                    wp_enqueue_style('arplitetemplate_' . $newqnqueue['template_name'] . '_css');
                                } else {

                                    wp_register_style('arplitetemplate_' . $template_id . '_css', ARPLITE_PRICINGTABLE_UPLOAD_URL . '/css/arplitetemplate_' . $template_id . '.css', array(), null);
                                    wp_enqueue_style('arplitetemplate_' . $template_id . '_css');
                                }
                            }
                        }
                    }
                }
            }
        }

        return do_shortcode($matches[0]);
    }

    function hex2rgb($colour) {

        if (isset($colour[0]) && $colour[0] == '#') {
            $colour = substr($colour, 1);
        }
        if (strlen($colour) == 6) {
            list( $r, $g, $b ) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
        } elseif (strlen($colour) == 3) {
            list( $r, $g, $b ) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
        } else {
            return false;
        }
        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);
        return array('red' => $r, 'green' => $g, 'blue' => $b);
    }

    function arp_load_pricing_table() {

        global $wpdb, $arplite_mainoptionsarr;

        require_once ARPLITE_PRICINGTABLE_DIR . '/core/classes/class.arprice_preview_editor.php';

        $template_id = $_REQUEST['id'];

        $template = $_REQUEST['template'];

        $skin = $_REQUEST['skin'];

        $ref_template = $_REQUEST['ref_temp'];

        $is_clone = $_REQUEST['is_clone'];

        $sql = $wpdb->get_results($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'arplite_arprice WHERE ID = %d ', $template_id));

        $table_name = $sql[0]->table_name;

        $general_options = json_encode(maybe_unserialize(stripslashes($sql[0]->general_options)));


        $opt = maybe_unserialize($sql[0]->general_options);

        $is_animated = $sql[0]->is_animated;

        $columns = $wpdb->get_results($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'arplite_arprice_options WHERE table_id = %d', $template_id));

        $column_options = json_encode(maybe_unserialize(stripslashes($columns[0]->table_options)));

        $table = arp_get_pricing_table_string_editor($template_id, $table_name, 2, '', '', $is_clone);

        $template_skins = json_encode($arplite_mainoptionsarr['general_options']['template_options']['skins'][$ref_template]);

        $template_skin_codes = json_encode($arplite_mainoptionsarr['general_options']['template_options']['skin_color_code'][$ref_template]);

        $options = json_decode($general_options, true);

        $general_settings = json_encode($options['general_settings']);

        $template_settings = json_encode($options['template_setting']);

        $template_type = $this->arp_choose_template_type($ref_template);

        $columns = maybe_unserialize(stripslashes($columns[0]->table_options));

        $template_feature = json_encode($arplite_mainoptionsarr['general_options']['template_options']['features'][$ref_template]);

        $total_columns = count($columns['columns']);

        $json_array = array('table' => $table, 'table_name' => $table_name, 'general_settings' => $general_settings, 'template_settings' => $template_settings, 'column_options' => $column_options, 'template_skins' => $template_skins, 'template_skin_codes' => $template_skin_codes, 'template_type' => $template_type, 'total_columns' => $total_columns, 'is_animated' => $is_animated, 'template_features' => $template_feature, 'general_options' => $general_options);

        $json_array = json_encode($json_array);

        echo $json_array;

        die();
    }

    function font_settings($selected_fonts = '') {

        global $arpricelite_fonts;

        $default_fonts = $arpricelite_fonts->get_default_fonts();

        $google_fonts = $arpricelite_fonts->google_fonts_list();

        $str = '';

        $str .= '<optgroup label="' . __('Default Fonts', 'ARPricelite') . '">';

        foreach ($default_fonts as $font) {
            $str .= '<option style="font-family:' . $font . '" id="normal" ' . selected($font, $selected_fonts, false) . ' value="' . $font . '">' . $font . '</option>';
        }

        $str .= '</optgroup>';

        $str .= '<optgroup label="' . __('Google Fonts', 'ARPricelite') . '">';

        foreach ($google_fonts as $font) {
            $str .= '<option style="font-family:' . $font . '" id="google" ' . selected($font, $selected_fonts, false) . ' value="' . $font . '">' . $font . '</div>';
        }

        $str.= '</optgroup>';

        return $str;
    }

    function add_new_row_new() {

        $total_rows = $_POST['total_rows'];

        if ($total_rows == 'NaN' or $total_rows == '') {
            $total_rows = 0;
        }

        $features = json_decode(stripslashes_deep($_POST['template_features']), true);

        $column_id = $_POST['column'];

        $template = $_POST['template'];

        $li_id = $total_rows;

        $new_row_string = "";

        $new_row_wrapper = "";

        $new_row_label = "";

        $new_row_string .= "<li id='arp_row_" . $li_id . "' class='arpbodyoptionrow' data-column='main_column_" . $column_id . "' style=''>";

        if ($features['caption_style'] == 'style_2') {
            $new_row_string .= "<span class='caption_detail' title=''>";
            $new_row_string .= "<div class='row_description_first_step toggle_step_first'></div>";
            $new_row_string .= "</span>";

            $new_row_string .= "<span class='caption_li'>";
            $new_row_string .= "<div class='row_label_first_step toggle_step_first'></div>";
            $new_row_string .= "</span>";
        } else if ($features['caption_style'] == 'style_1') {
            $new_row_string .= "<span class='caption_li'>";
            $new_row_string .= "<div class='row_label_first_step toggle_step_first'></div>";
            $new_row_string .= "</span>";
            $new_row_string .= "<span class='caption_detail' title=''>";
            $new_row_string .= "<div class='row_description_first_step toggle_step_first'></div>";
            $new_row_string .= "</span>";
        } else {
            $new_row_string .= "<span class='' title=''>";
            $new_row_string .= "<div class='row_label_first_step toggle_step_first'></div>";
            $new_row_string .= "</span>";
        }

        $new_row_string .= "</li>";

        // New Row Description

        $new_row_wrapper .= "<div id='arp_row_" . $li_id . "' class='arp_row_wrapper' style=''>";

        $new_row_wrapper .= "<div id='description" . $li_id . "' class='col_opt_row arp_row_" . $li_id . "' style='display:none;'>";

        $new_row_wrapper .= "<div class='col_opt_title_div'>" . __('Description', 'ARPricelite') . "</div>";

        $new_row_wrapper .= "<div class='col_opt_input_div'>";

        $new_row_wrapper .= "<div class='option_tab' id='description_yearly_tab'>";

        $new_row_wrapper .= "<textarea id='arp_li_description' class='col_opt_textarea row_description_first' name='row_" . $column_id . "_description_" . $li_id . "'>";

        $new_row_wrapper .= "</textarea>";

        $new_row_wrapper .= "</div>";

        $new_row_wrapper .= "<div class='option_tab' id='description_monthly_tab' style='display:none;'>";

        $new_row_wrapper .= "<textarea id='row_description_second' class='col_opt_textarea row_description_second' name='row_" . $column_id . "_description_second_" . $li_id . "'>";

        $new_row_wrapper .= "</textarea>";

        $new_row_wrapper .= "</div>";

        $new_row_wrapper .= "<div class='option_tab' id='description_quarterly_tab' style='display:none;'>";

        $new_row_wrapper .= "<textarea id='row_description_third' class='col_opt_textarea row_description_third' name='row_" . $column_id . "_description_third_" . $li_id . "'>";

        $new_row_wrapper .= "</textarea>";

        $new_row_wrapper .= "</div>";

        $new_row_wrapper .= "</div>";

        $new_row_wrapper .= "</div>";


        $new_row_wrapper .= "<div class='col_opt_row arp_row_" . $li_id . "' id='body_li_add_shortcode" . $li_id . "' >";
        $new_row_wrapper .= "<div class='col_opt_btn_div'>";
        $new_row_wrapper .= "<button type='button' class='col_opt_btn_icon arp_add_row_object arptooltipster align_left' name='" . $column_id . "_add_body_li_object_" . $li_id . "' id='arp_add_row_object' data-insert='arp_row_" . $li_id . " textarea#arp_li_description' data-column='main_column_" . $column_id . "' title='" . __('Add Media', 'ARPricelite') . "'>";
        $new_row_wrapper .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/image-icon.png' />";
        $new_row_wrapper .= "</button>";
        $new_row_wrapper .= "<label style='float:left;width:10px;'>&nbsp;</label>";


        $new_row_wrapper .= "<button type='button' class='col_opt_btn_icon align_left arptooltipster arp_add_row_shortcode' id='arp_add_row_shortcode' name='row_" . $column_id . "_add_description_shortcode_btn_" . $li_id . "' col-id=" . $column_id . " data-id='" . $column_id . "' data-row-id='' title='" . __('Add Font Icon', 'ARPricelite') . "' >";
        $new_row_wrapper .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/font-awesome-icon.png' />";
        $new_row_wrapper .= "</button>";
        $new_row_wrapper .= "<div class='arp_font_awesome_model_box_container'></div>";

        $new_row_wrapper .= "<div class='arp_add_image_container'>";
        $new_row_wrapper .= "<div class='arp_add_image_arrow'></div>";
        $new_row_wrapper .= "<div class='arp_add_img_content'>";

        $new_row_wrapper .= "<div class='arp_add_img_row'>";
        $new_row_wrapper .= "<div class='arp_add_img_label'>";
        $new_row_wrapper .= __('Image URL', 'ARPricelite');
        $new_row_wrapper .= "<span class='arp_model_close_btn' id='arp_add_image_container'><i class='fa fa-times'></i></span>";
        $new_row_wrapper .= "</div>";
        $new_row_wrapper .= "<div class='arp_add_img_option'>";
        $new_row_wrapper .= "<input type='text' value='' class='arp_modal_txtbox img' id='arp_header_image_url' name='arp_header_image_url' />";
        $new_row_wrapper .= "<button data-insert='header_object' data-id='arp_header_image_url' type='button' class='arp_header_object'>";
        $new_row_wrapper .= __('Add File', 'ARPricelite');
        $new_row_wrapper .= "</button>";
        $new_row_wrapper .= "</div>";
        $new_row_wrapper .= "</div>";

        $new_row_wrapper .= "<div class='arp_add_img_row'>";
        $new_row_wrapper .= "<div class='arp_add_img_label'>";
        $new_row_wrapper .= __('Dimension ( height X width )', 'ARPricelite');
        $new_row_wrapper .= "</div>";
        $new_row_wrapper .= "<div class='arp_add_img_option'>";
        $new_row_wrapper .= "<input type='text' class='arp_modal_txtbox' id='arp_header_image_height' name='arp_header_image_height' /><label class='arp_add_img_note'>(px)</label>";
        $new_row_wrapper .= "<label>x</label>";
        $new_row_wrapper .= "<input type='text' class='arp_modal_txtbox' id='arp_header_image_width' name='arp_header_image_width' /><label class='arp_add_img_note'>(px)</label>";
        $new_row_wrapper .= "</div>";
        $new_row_wrapper .= "</div>";

        $new_row_wrapper .= "<div class='arp_add_img_row' style='margin-top:10px;'>";
        $new_row_wrapper .= "<div class='arp_add_img_label'>";
        $new_row_wrapper .= '<button type="button" onclick="arp_add_object(this);" class="arp_modal_insert_shortcode_btn" name="rpt_image_btn" id="rpt_image_btn">';
        $new_row_wrapper .= __('Add', 'ARPricelite');
        $new_row_wrapper .= '</button>';
        $new_row_wrapper .= '<button type="button" style="display:none;margin-right:10px;" onclick="arp_remove_object();" class="arp_modal_insert_shortcode_btn" name="arp_remove_img_btn" id="arp_remove_img_btn">';
        $new_row_wrapper .= __('Remove', 'ARPricelite');
        $new_row_wrapper .= '</button>';
        $new_row_wrapper .= "</div>";
        $new_row_wrapper .= "</div>";

        $new_row_wrapper .= "</div>";
        $new_row_wrapper .= "</div>";

        $new_row_wrapper .= "</div>";
        $new_row_wrapper .= "</div>";
        $new_row_wrapper .= "<div class='col_opt_row arp_row_" . $li_id . "' id='row_level_custom_css" . $li_id . "'>";
        $new_row_wrapper .= "<style class='arp_row_custom_css' id=arp_row_css_column_" . $column_id . "_row_" . $li_id . "></style>";

        $new_row_wrapper .= "<div class='col_opt_title_div'>" . __('Custom Css', ARPLITE_PT_TXTDOMAIN) . "&nbsp;<span class='pro_version_info'>(Pro Version)</span></div>";
        $new_row_wrapper .= "<div class='col_opt_input_div'>";
        $new_row_wrapper .= "<ul class='column_tabs_row_css' id='column_tabs_row_css_" . $li_id . "'>";
        $new_row_wrapper .= "<li class='option_title selected' id='normal_css' data-column='" . $column_id . "' onClick='arp_row_css_tabs_select(\"normal_css\", \"hover_css\",\"$column_id\",\"$li_id\")'>" . __('Normal State', ARPLITE_PT_TXTDOMAIN) . "</li>";
        $new_row_wrapper .= "<li class='option_title' id='hover_css' data-column='" . $column_id . "' onClick='arp_row_css_tabs_select(\"hover_css\", \"normal_css\",\"$column_id\",\"$li_id\")'>" . __('Hover State', ARPLITE_PT_TXTDOMAIN) . "</li>";
        $new_row_wrapper .= "</ul>";
        $new_row_wrapper .= "<textarea id='arp_row_level_custom_css' col-id=" . $column_id . " row-id='" . $li_id . "' class='col_opt_textarea' name='row_" . $column_id . "_custom_css_" . $li_id . "'>";
        $new_row_wrapper .= "</textarea>";
        $new_row_wrapper .= "<textarea id='arp_row_level_hover_custom_css' col-id=" . $column_id . " row-id='" . $li_id . "' class='col_opt_textarea' name='row_hover_" . $column_id . "_custom_css_" . $li_id . "'  style='display:none;'>";

        $new_row_wrapper .= "</textarea>";
        $new_row_wrapper .= "</div>";




        $new_row_wrapper .= "<div class='col_opt_input_div'>";
        $new_row_wrapper .= "<div class='col_opt_title_div'>" . __('For Example', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $new_row_wrapper .= "<div class='arp_row_custom_css' data-code='color:#c9c9c9;' style='width:13%;'>color</div>";
        $new_row_wrapper .= "<div class='arp_row_custom_css' data-code='font-size:20px;' style='width:21%;'>font-size</div>";
        $new_row_wrapper .= "<div class='arp_row_custom_css' data-code='text-align:center;' style='width:25%;'>alignment</div>";
        $new_row_wrapper .= "<div class='arp_row_custom_css' data-code='font-weight:bold;'>font-weight</div>";
        $new_row_wrapper .= "</div>";
        $new_row_wrapper .= "</div>";


        $new_row_wrapper .= "<div class='col_opt_row arp_ok_div  arp_row_" . $li_id . "' id='body_li_level_other_arp_ok_div__button_1" . $li_id . "'  >";
        $new_row_wrapper .= "<div class='col_opt_btn_div'>";
        $new_row_wrapper .= "<div class='col_opt_navigation_div'>";
        $new_row_wrapper .= "<i class='fa fa-long-arrow-up arp_navigation_arrow' id='row_up_arrow' data-column='{$column_id}' data-row-id='arp_row_{$li_id}' data-button-id='body_li_level_options__button_1'></i>&nbsp;";
        $new_row_wrapper .= "<i class='fa fa-long-arrow-down arp_navigation_arrow' id='row_down_arrow' data-column='{$column_id}' data-row-id='arp_row_{$li_id}' data-button-id='body_li_level_options__button_1'></i>&nbsp;";
        $new_row_wrapper .= "<i class='fa fa-long-arrow-left arp_navigation_arrow' id='row_left_arrow' data-column='{$column_id}' data-row-id='arp_row_{$li_id}' data-button-id='body_li_level_options__button_1'></i>&nbsp;";
        $new_row_wrapper .= "<i class='fa fa-long-arrow-right arp_navigation_arrow' id='row_right_arrow' data-column='{$column_id}' data-row-id='arp_row_{$li_id}' data-button-id='body_li_level_options__button_1'></i>&nbsp;";
        $new_row_wrapper .= "</div>";
        $new_row_wrapper .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
        $new_row_wrapper .= __('Ok', ARPLITE_PT_TXTDOMAIN);
        $new_row_wrapper.= "</button>";
        $new_row_wrapper .= "</div>";
        $new_row_wrapper .= "</div>";

        $new_row_wrapper .= "</div>";
        //

        $new_row_wrapper .= "<div class='col_opt_row arp_ok_div  arp_row_" . $li_id . "' id='body_li_level_other_arp_ok_div__button_1" . $li_id . "'  >";
        $new_row_wrapper .= "<div class='col_opt_btn_div'>";
        $new_row_wrapper .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
        $new_row_wrapper .= __('Ok', 'ARPricelite');
        $new_row_wrapper.= "</button>";
        $new_row_wrapper .= "</div>";
        $new_row_wrapper .= "</div>";

        $new_row_wrapper .= "</div>";

        // New Row Label

        if ($features['caption_style'] == 'style_1' || $features['caption_style'] == 'style_2') {

            $new_row_label .= "<div id='arp_row_" . $li_id . "' class='arp_row_label_wrapper'>";

            $new_row_label .= "<div id='label" . $li_id . "' class='col_opt_row arp_row_" . $li_id . "' style='display:none;'>";

            $new_row_label .= "<div class='col_opt_title_div'>" . __('Label', 'ARPricelite') . "</div>";

            $new_row_label .= "<div class='col_opt_input_div'>";

            $new_row_label .= "<div class='option_tab' id='description_label_yearly_tab'>";

            $new_row_label .= "<textarea id='label' class='col_opt_textarea row_label_first' name='row_" . $column_id . "_label_" . $li_id . "'></textarea>";

            $new_row_label .= "</div>";

            $new_row_label .= "<div class='option_tab' id='description_label_monthly_tab' style='display:none;'>";

            $new_row_label .= "<textarea id='label_second' class='col_opt_textarea row_label_second' name='row_" . $column_id . "_label_second_" . $li_id . "'></textarea>";

            $new_row_label .= "</div>";

            $new_row_label .= "<div class='option_tab' id='description_label_quarterly_tab' style='display:none;'>";

            $new_row_label .= "<textarea id='label_third' class='col_opt_textarea row_label_third' name='row_" . $column_id . "_label_third_" . $li_id . "'></textarea>";

            $new_row_label .= "</div>";

            $new_row_label .= "</div>";

            $new_row_label .= "</div>";

            $new_row_label .= "<div id='body_li_add_shortcode" . $li_id . "' class='col_opt_row arp_row_" . $li_id . "' style='display:none;'>";

            $new_row_label .= "<div class='col_opt_btn_div'>";

            $new_row_label .= "<button type='button' id='arp_add_row_shortcode' class='col_opt_btn_icon align_left arptooltipster arp_add_row_shortcode' data-row-id='row_" . $li_id . "' data-id='" . $column_id . "' col-id='" . $column_id . "' name='row_" . $column_id . "_add_description_shortcode_btn_" . $li_id . "' title='" . __('Add Font Icon', 'ARPricelite') . "'>";



            $new_row_label .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/font-awesome-icon.png' />";

            $new_row_label .= "</button>";

            $new_row_label .= "<div class='arp_font_awesome_model_box_container'></div>";

            $new_row_label .= "</div>";

            $new_row_label .= "</div>";



            $new_row_label .= "<div class='col_opt_row arp_ok_div arp_" . $n . " arp_row_" . $li_id . "' id='body_li_level_other_arp_ok_div__button_3" . $li_id . "'  >";
            $new_row_label .= "<div class='col_opt_btn_div'>";
            $new_row_label .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
            $new_row_label .= __('Ok', 'ARPricelite');
            $new_row_label.= "</button>";
            $new_row_label .= "</div>";
            $new_row_label .= "</div>";

            $new_row_label .= "</div>";
        }



        $new_row_tooltip = isset($new_row_tooltip) ? $new_row_tooltip : '';
        $json_array = array('new_row_string' => $new_row_string, 'new_row_wrapper' => $new_row_wrapper, 'new_row_tooltip' => $new_row_tooltip, 'new_row_label' => $new_row_label);

        $json_array = json_encode($json_array);

        echo $json_array;



        die();
    }

    function font_size($selected_size = '') {
        $str = '';
        for ($s = 8; $s <= 20; $s++) {
            $size_arr[] = $s;
        }
        for ($st = 22; $st <= 70; $st+=2) {
            $size_arr[] = $st;
        }
        foreach ($size_arr as $size) {
            $str .= '<option ' . selected($size, $selected_size, false) . ' value="' . $size . '">' . __(ucfirst($size), 'ARPricelite') . '</option>';
        }
        return $str;
    }

    function font_style($selected_style = '') {
        $str = '';
        $style_arr = array('normal', 'italic', 'bold');
        foreach ($style_arr as $style) {
            $str .= '<option ' . selected($style, $selected_style, false) . ' value="' . $style . '">' . __(ucfirst($style), 'ARPricelite') . '</option>';
        }
        return $str;
    }

    function font_style_new() {
        $str = '';
        $style_arr = array('normal' => __('Normal', 'ARPricelite'), 'italic' => __('Italic', 'ARPricelite'), 'bold' => __('Bold', 'ARPricelite'));
        foreach ($style_arr as $x => $style) {
            $str .= "<li data-value='" . $x . "' data-label='" . $style . "'>" . $style . "</li>";
        }
        return $str;
    }

    function font_color_new($property_name = '', $data_column = '', $data_column_id = '', $id = '', $value = '', $main_class = '', $input_class = '') {
        $str = '';
        $pattern = "/(background|content_odd_color|content_even_color|content_odd_hover_color|content_even_hover_color)/";
        $restricted_class = '';
        preg_match($pattern, $id, $matches);
        if (is_array($matches) && !empty($matches)) {
            $restricted_class = 'arplite_restricted_view';
        } else {
            $restricted_class = '';
        }
        $restricted_class = '';
        $str .= '<div class="jscolor arp_custom_css_colorpicker arp_general_color_box ' . $restricted_class . '" data-column="' . $data_column . '" id="' . $id . '_' . $data_column . '_wrapper" data-color="' . $value . '" data-jscolor="{hash:true,onFineChange:\'arp_update_color(this,' . $id . '_' . $data_column . '_wrapper)\',valueElement:' . $id . '_' . $data_column . ',required:false}" jscolor-required="false" jscolor-hash="true" jscolor-onfinechange="arp_update_color(this,' . $id . '_' . $data_column . '_wrapper)" jscolor-valueelement="' . $id . '_' . $data_column . '">';
        $str .= '</div>';
        $str .= '<input type="hidden" id="' . $id . '_' . $data_column . '" name="' . $property_name . '" value="' . $value . '" class="  ' . $input_class . '"  />';

        return $str;
    }

    function font_color($property_name = '', $data_column = '', $data_column_id = '', $id = '', $value = '', $main_class = '', $input_class = '', $is_readonly = false) {
        $str = '';

        $readonly = $reaonly_cls = '';
        if ($is_readonly == true) {
            $readonly = "readonly='readonly'";
            $readonly_cls = 'arplite_restricted_view';
        } else {
            $readonly = "";
            $readonly_cls = "";
        }

        $str.='<div class="color_picker_font font_color_picker ' . $main_class . ' ' . $readonly_cls . ' " data-column="' . $data_column . '" id="' . $id . '_wrapper" data-color="' . $value . '">';
        if ($readonly_cls == "") {
            $str.='<input type="text" id="' . $id . '_' . $data_column . '" name="' . $property_name . '" value="' . $value . '" class="general_color_box general_color_box_font_color jscolor ' . $input_class . ' ' . $readonly_cls . '" data-jscolor="{hash:true,onFineChange:\'arp_update_color(this,' . $id . '_' . $data_column . ')\',required:false}" jscolor-required="false" jscolor-hash="true" jscolor-onfinechange="arp_update_color(this,' . $id . '_' . $data_column . ')" ' . $readonly . ' />';
        } else if ($readonly_cls != "") {
            $str.='<input type="text" id="' . $id . '" name="' . $property_name . '" value="' . $value . '" class="general_color_box general_color_box_font_color restricted_jscolor ' . $input_class . ' ' . $readonly_cls . '" ' . $readonly . ' />';
        }
        $str.='</div>';

        return $str;
    }

    function arp_save_template_image() {
        WP_Filesystem();
        global $wp_filesystem;

        $arp_image_data = isset($_POST['arp_image_data']) ? $_POST['arp_image_data'] : '';

        $template_id = isset($_POST['template_id']) ? $_POST['template_id'] : '';

        if ($arp_image_data != '' && $template_id != '') {
            $arp_image_data = str_replace('data:image/png;base64,', '', $arp_image_data);
            $arp_image_data = str_replace(' ', '+', $arp_image_data);
            $data = base64_decode($arp_image_data);
            $file = ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/template_images/arplitetemplate_' . $template_id . '_full_legnth.png';
            $wp_filesystem->put_contents($file, $data, 0777);

            list($width, $height) = getimagesize($file);
            $newheight = 180; //90
            $newwidth = 400; //200

            $src_image = imagecreatefrompng($file);
            $tmp_image = imagecreatetruecolor($newwidth, $newheight);
            $bgColor = imagecolorallocate($tmp_image, 255, 255, 255);
            imagefill($tmp_image, 0, 0, $bgColor);
            imagecopyresampled($tmp_image, $src_image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $filename = ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/template_images/arplitetemplate_' . $template_id . '.png';
            imagepng($tmp_image, $filename);
            imagedestroy($tmp_image);

            $newheight_big = 238; //119;
            $newwidth_big = 530; //265;
            $tmp_image_big = imagecreatetruecolor($newwidth_big, $newheight_big);
            $bgColor_big = imagecolorallocate($tmp_image_big, 255, 255, 255);
            imagefill($tmp_image_big, 0, 0, $bgColor_big);
            imagecopyresampled($tmp_image_big, $src_image, 0, 0, 0, 0, $newwidth_big, $newheight_big, $width, $height);
            $filename_big = ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/template_images/arplitetemplate_' . $template_id . '_big.png';
            imagepng($tmp_image_big, $filename_big);
            imagedestroy($tmp_image_big);

            $newheight_large = 300; //150;
            $newwidth_large = 668; //334;
            $tmp_image_large = imagecreatetruecolor($newwidth_large, $newheight_large);
            $bgColor_large = imagecolorallocate($tmp_image_large, 255, 255, 255);
            imagefill($tmp_image_large, 0, 0, $bgColor_large);
            imagecopyresampled($tmp_image_large, $src_image, 0, 0, 0, 0, $newwidth_large, $newheight_large, $width, $height);
            $filename_large = ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/template_images/arplitetemplate_' . $template_id . '_large.png';
            imagepng($tmp_image_large, $filename_large);
            imagedestroy($tmp_image_large);

            @unlink($file);
        }
        die();
    }

    function update_arp_tour_guide_value() {
        $return = '0';
        update_option('arpricelite_tour_guide_value', 'no');
        if ($_REQUEST['arp_tour_guide_value'] == 'arp_tour_guide_start_yes') {
            $return = '1';
        }

        echo $return;

        die();
    }

    function arp_generate_color_tone($hex, $steps) {

        $steps = max(-255, min(255, $steps));

        $hex = str_replace('#', '', $hex);
        if ($hex != '' && strlen($hex) < 6) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }

        $color_parts = str_split($hex, 2);
        $return = '#';

        $acsteps = str_replace(array('+', '-'), array('', ''), $steps);

        if (strlen($acsteps) > 2)
            $lum = $steps / 1000;
        else
            $lum = $steps / 100;

        foreach ($color_parts as $color) {
            $color = hexdec($color);
            $color = round(max(0, min(255, $color + ($color * $lum))));
            $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT);
        }

        return $return;
    }

    /* Generate Text Alignment Div */

    function arp_create_alignment_div($id, $alignment, $name, $column, $level) {
        $tablestring = '';
        $tablestring .= "<div class='col_opt_row' id='" . $id . "'>";
        $tablestring .= "<div class='col_opt_title_div'>" . __('Text Alignment', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='col_opt_input_div'>";
        $left_selected = ($alignment == 'left') ? 'align_selected' : '';
        $center_selected = ($alignment == 'center') ? 'align_selected' : '';
        $right_selected = ($alignment == 'right') ? 'align_selected' : '';

        $tablestring .= "<div class='arp_alignment_btn align_left_btn " . $left_selected . "' data-align='left' id='align_left_btn' data-id='" . $column . "' data-level='" . $level . "'>";
        $tablestring .= "<i class='fa fa-align-left fa-flip-vertical'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_alignment_btn align_center_btn " . $center_selected . "' data-align='center' id='align_center_btn' data-id='" . $column . "' data-level='" . $level . "'>";
        $tablestring .= "<i class='fa fa-align-center fa-flip-vertical'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_alignment_btn align_right_btn " . $right_selected . "' data-align='right' id='align_right_btn' data-id='" . $column . "' data-level='" . $level . "'>";
        $tablestring .= "<i class='fa fa-align-right fa-flip-vertical'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<input type='hidden' id='$name' value='" . $alignment . "' name='" . $name . "_" . $column . "'>";

        $tablestring .= "</div>";
        $tablestring .= "</div>";

        return $tablestring;
        die();
    }

    function arp_update_subscribe_date() {
        $time = time();
        update_option('arplite_popup_display', 'no');
        update_option('arplite_display_popup_date', $time);
        echo json_encode(array('time' => $time, 'display' => 'yes'));
        die();
    }

    function arp_create_alignment_div_new($id, $alignment, $name, $column, $level) {
        $tablestring = '';

        $tablestring .= "<div class='col_opt_input_div' id='" . $id . "'>";
        $left_selected = ($alignment == 'left') ? 'align_selected' : '';
        $center_selected = ($alignment == 'center') ? 'align_selected' : '';
        $right_selected = ($alignment == 'right') ? 'align_selected' : '';

        $tablestring .= "<div class='arp_alignment_btn align_left_btn " . $left_selected . "' data-align='left' id='align_left_btn' data-id='" . $column . "' data-level='" . $level . "'>";
        $tablestring .= "<i class='fa fa-align-left fa-flip-vertical'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_alignment_btn align_center_btn " . $center_selected . "' data-align='center' id='align_center_btn' data-id='" . $column . "' data-level='" . $level . "'>";
        $tablestring .= "<i class='fa fa-align-center fa-flip-vertical'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_alignment_btn align_right_btn " . $right_selected . "' data-align='right' id='align_right_btn' data-id='" . $column . "' data-level='" . $level . "'>";
        $tablestring .= "<i class='fa fa-align-right fa-flip-vertical'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<input type='hidden' id='$name' value='" . $alignment . "' name='" . $name . "'>";

        $tablestring .= "</div>";

        return $tablestring;
        die();
    }

}
?>