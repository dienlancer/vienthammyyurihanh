<?php

if (!function_exists('arp_get_pricing_table_string_editor')) {

    function arp_get_pricing_table_string_editor($table_id, $pricetable_name = "", $is_tbl_preview = 0, $general_option = '', $opts = '', $is_clone = '') {

        global $wpdb, $arpricelite_form, $arpricelite_fonts, $arpricelite_version, $arprice_font_awesome_icons, $arplite_pricingtable, $arpricelite_default_settings, $arpricelite_img_css_version;
        $template_section_array = $arpricelite_default_settings->arp_column_section_background_color();

        $id = $table_id;
        $name = $pricetable_name;

        if (is_ssl()) {
            $googlefontpreviewurl = "https://www.google.com/fonts/specimen/";
        } else {
            $googlefontpreviewurl = "http://www.google.com/fonts/specimen/";
        }

        global $arplite_tempbuttonsarr, $arplite_mainoptionsarr, $arpricelite_form, $arpricelite_fonts, $arpricelite_default_settings;

        $tablestring = "";
        $title_cls = "";
        $header_cls = "";

        $tablestring .= "   <style type='text/css'>
	    body { overflow-x: hidden;} 
		.tooltipster-content{
			font-family: 'Open Sans' !important;
			font-size: 13px;
			font-weight: normal;
			line-height: normal !important;
			padding: 5px 10px !important;
		}
		.tooltipster-base{
			width:auto !important;
			border:none;
			border-radius:2px;
				-moz-border-radius:2px;
				-webkit-border-radius:2px;
				-o-border-radius:2px;
			min-height:30px;
			box-shadow:0 1px 2px rgba(0, 0, 0, 0.5);
				-moz-box-shadow:0 1px 2px rgba(0, 0, 0, 0.5);
				-webkit-box-shadow:0 1px 2px rgba(0, 0, 0, 0.5);
				-o-box-shadow:0 1px 2px rgba(0, 0, 0, 0.5);
			background:#43B4FB;
			color:#ffffff;
		}
	</style>";

        if (isset($_REQUEST['arp_action']) && $_REQUEST['arp_action'] == 'edit') {

            $tablestring .= "<script type='text/javascript' language='javascript'>
			jQuery(document).ready(function(){
				var right_side_tooltip_options = '';
				var left_side_tooltip_options = '';

				

                                jQuery('.arp_btn:not(\'.selected\')').tipso({
                                    position:'bottom',
                                    background:'#43B4FB',
                                    width:'auto',
                                });
				
			});
		</script>";
        }
        if ($is_tbl_preview && $is_tbl_preview == 1) {
            if (isset($_REQUEST['optid']) && $_REQUEST['optid'] != '') {
                $post_values = get_option($_REQUEST['optid']);
                $get_preview_data = $arpricelite_form->get_preview_table($post_values);
                
                $id = $table_id = $get_preview_data['table_id'];
                $is_animated = $get_preview_data['is_animated'];
                $opts = maybe_unserialize($get_preview_data['table_options']);
                $general_option = maybe_unserialize($get_preview_data['general_options']);
            }
        } else if ($is_tbl_preview && $is_tbl_preview == 3) {
            $opts = maybe_unserialize($opts);
            $general_option = maybe_unserialize($general_option);
        } else {
            $sql = $wpdb->get_row($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "arplite_arprice WHERE ID = %d AND status = %s ", $id, 'published'));
            $table_id = $sql->ID;
            $sql_opt = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "arplite_arprice_options WHERE table_id = %d ", $table_id));
            $is_animated = $sql->is_animated;
            $opts = maybe_unserialize($sql_opt[0]->table_options);
            $general_option = maybe_unserialize($sql->general_options);
            $is_template = $sql->is_template;
            apply_filters('arplite_append_googlemap_js', $table_id);
        }

        $table_cols = array();
        $table_cols = $table_cols_new = $opts['columns'];

        $maxrowcount = 0;
        if (is_array($table_cols)) {
            foreach ($table_cols as $countcol) {
                if ($countcol['rows'] && count($countcol['rows']) > $maxrowcount)
                    $maxrowcount = count($countcol['rows']);
            }
            $maxrowcount--;
        }

        $opts['columns'] = $table_cols;

        $total_columns = count($table_cols);

        $column_settings = $general_option['column_settings'];

        $hover_type = $column_settings['column_highlight_on_hover'];

        $template_settings = $general_option['template_setting'];

        $general_settings = $general_option['general_settings'];

        $template_type = $template_settings['template_type'];

        $template = $template_settings['template'];

        $ref_template = $general_settings['reference_template'];

        $template_id = $template_settings['template'];

        $arp_template_skin = $template_settings['skin'];

        $is_responsive = $general_option['column_settings']['is_responsive'];

        $reference_template = $general_settings['reference_template'];

        $arp_global_button_type = isset($column_settings['arp_global_button_type']) ? $column_settings['arp_global_button_type'] : 'shadow';

        $arp_global_button_class_array = $arpricelite_default_settings->arp_button_type();
        $arp_global_button_class = '';
        if ($arp_global_button_type !== 'none') {
            if (isset($column_settings['disable_button_hover_effect']) && $column_settings['disable_button_hover_effect'] == 1) {
                $arp_global_button_class = $arp_global_button_class_array[$arp_global_button_type]['class'] . ' arp_button_hover_disable arp_editor';
            } else {
                $arp_global_button_class = @$arp_global_button_class_array[$arp_global_button_type]['class'] . ' arp_editor';
            }
        }

        $arp_template_custom_color = isset($template_settings['custom_color_code']) ? $template_settings['custom_color_code'] : '';
        $shadow_style = '';
        if ($column_settings['column_border_radius_top_left'] == 0 && $column_settings['column_border_radius_top_right'] == 0 && $column_settings['column_border_radius_bottom_right'] == 0 && $column_settings['column_border_radius_bottom_left'] == 0) {
            $shadow_style = $column_settings['column_box_shadow_effect'];
        }


        $caption_col = array();

        if (is_array($opts['columns'])) {
            foreach ($opts['columns'] as $key => $val) {
                if ($val['is_caption'] == 1) {
                    $caption_col[] = 1;
                } else {
                    $caption_col[] = 0;
                }
            }
        }
        $tablestring .= "<div class='pricingtable_menu_belt' style='display:block;'>";

        $tablestring .= "<div class='pricingtable_menu_inner'>";

        $tablestring .= "<div class='pricing_table_main'>";

        $tablestring .= "<div class='pt_table_main_cnt'>";
        $tablestring .= "<div class='arprice_logo_box'>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='header_table_name enable' data-image='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/edit-icon_hover.png' id='main_pricing_table_name'>";
        $tablestring .= "<input type='text' name='pricing_table_main' id='pricing_table_main' class='arp_pricing_table_name' value='" . esc_html($name) . "'>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "</div>";

        $tablestring .= "<div class='pricing_table_btns'>";

        $display = ( empty($id) or $is_clone == 1 ) ? 'display:none;' : '';

        $shortcode_display = ($_GET['arp_action'] == 'edit') ? '' : "display:none;";
        
        $shortcode_txt = (!empty($id) ) ? '<div id="arp_shortcode_value" style="float:right;">[ARPLite id=' . $id . ']</div>' : '<div id="arp_shortcode_value" style="float:right;"></div>';

        $tablestring .= "<div id='arp_shortcode' class='arp_shortcode_main arp_shortcode' style='" . $display . $shortcode_display. "' >";

        $tablestring .= "<label style='float:left'>" . __('Shortcode', 'ARPricelite') . ' : </label>' . $shortcode_txt;

        $tablestring .= "</div>";

        $tablestring .= "<div class='btn_field' style='float:right;' >";

        $tablestring .= "<div class='savebtn enable arp_save_btn' id='save_btn' title=''>";

        $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/save_icon.png' />";

        $tablestring .= __('Save', 'ARPricelite');

        $tablestring .= "</div>";

        $tablestring .= "<div class='savebtn arp_preview_btn' data-src='" . $arpricelite_form->get_direct_link() . "' id='preview_btn' onClick='arp_preview_new(\"" . $arpricelite_form->get_direct_link() . "\");' >";
        $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/preview_icon_small.png' />";
        $tablestring .= __('Preview', 'ARPricelite');

        $tablestring .= "</div>";

        $tablestring .= "<div class='savebtn arp_cancel_btn' id='template_close_btn' onClick='javascript:location.href=\"admin.php?page=arpricelite\"'>";

        $tablestring .= "&nbsp;&nbsp;";
        $tablestring .= __('Cancel', 'ARPricelite');

        $tablestring .= "</div>";

        $arp_template = isset($arp_template) ? $arp_template : '';
        $arp_template_skin = ($arp_template_skin) ? $arp_template_skin : '';
        $arplitetemplate_1 = ($id) ? 'arplitetemplate_' . $id : '';
        $tablestring .= "<input type='hidden' name='arp_template' id='arp_template' value='" . $arplitetemplate_1 . "' />";
        $tablestring .= "<input type='hidden' name='arp_template_old' id='arp_template_old' value='" . $arp_template . "' />";
        $tablestring .= "<input type='hidden' name='arp_template_skin_editor' class='arp_template_skin' id='arp_template_skin' value='" . $arp_template_skin . "' />";

        $tablestring .= "<input type='hidden' name='arp_custom_color_code' id='arp_custom_color_code' value='" . $arp_template_custom_color . "' />";

        $arp_template_is_custom_color = isset($arp_template_is_custom_color) ? $arp_template_is_custom_color : '';
        $tablestring .= "<input type='hidden' name='is_custom_color' id='is_custom_color' value='" . $arp_template_is_custom_color . "' />";


        $arp_template_column_bg_color = isset($general_option['custom_skin_colors']['arp_column_bg_custom_color']) ? $general_option['custom_skin_colors']['arp_column_bg_custom_color'] : '';
        $arp_template_column_desc_bg_color = isset($general_option['custom_skin_colors']['arp_column_desc_bg_custom_color']) ? $general_option['custom_skin_colors']['arp_column_desc_bg_custom_color'] : '';
        $arp_template_header_bg_color = isset($general_option['custom_skin_colors']['arp_header_bg_custom_color']) ? $general_option['custom_skin_colors']['arp_header_bg_custom_color'] : '';
        $arp_template_pricing_bg_color = isset($general_option['custom_skin_colors']['arp_pricing_bg_custom_color']) ? $general_option['custom_skin_colors']['arp_pricing_bg_custom_color'] : '';
        $arp_template_odd_row_bg_color = isset($general_option['custom_skin_colors']['arp_body_odd_row_bg_custom_color']) ? $general_option['custom_skin_colors']['arp_body_odd_row_bg_custom_color'] : '';
        $arp_template_even_row_bg_color = isset($general_option['custom_skin_colors']['arp_body_even_row_bg_custom_color']) ? $general_option['custom_skin_colors']['arp_body_even_row_bg_custom_color'] : '';
        $arp_template_footer_content_bg_color = isset($general_option['custom_skin_colors']['arp_footer_content_bg_color']) ? $general_option['custom_skin_colors']['arp_footer_content_bg_color'] : '';
        $arp_template_button_bg_color = isset($general_option['custom_skin_colors']['arp_button_bg_custom_color']) ? $general_option['custom_skin_colors']['arp_button_bg_custom_color'] : '';
        $arp_column_bg_hover_color = isset($general_option['custom_skin_colors']['arp_column_bg_hover_color']) ? $general_option['custom_skin_colors']['arp_column_bg_hover_color'] : '';
        $arp_button_bg_hover_color = isset($general_option['custom_skin_colors']['arp_button_bg_hover_color']) ? $general_option['custom_skin_colors']['arp_button_bg_hover_color'] : '';
        $arp_header_bg_hover_color = isset($general_option['custom_skin_colors']['arp_header_bg_hover_color']) ? $general_option['custom_skin_colors']['arp_header_bg_hover_color'] : '';
        $arp_price_bg_hover_color = isset($general_option['custom_skin_colors']['arp_price_bg_hover_color']) ? $general_option['custom_skin_colors']['arp_price_bg_hover_color'] : '';
        $arp_template_odd_row_hover_bg_color = isset($general_option['custom_skin_colors']['arp_body_odd_row_hover_bg_custom_color']) ? $general_option['custom_skin_colors']['arp_body_odd_row_hover_bg_custom_color'] : '';
        $arp_template_even_row_hover_bg_color = isset($general_option['custom_skin_colors']['arp_body_even_row_hover_bg_custom_color']) ? $general_option['custom_skin_colors']['arp_body_even_row_hover_bg_custom_color'] : '';
        $arp_footer_hover_background_color = isset($general_option['custom_skin_colors']['arp_footer_content_hover_bg_color']) ? $general_option['custom_skin_colors']['arp_footer_content_hover_bg_color'] : '';
        $arp_template_column_desc_hover_bg_color = isset($general_option['custom_skin_colors']['arp_column_desc_hover_bg_custom_color']) ? $general_option['custom_skin_colors']['arp_column_desc_hover_bg_custom_color'] : '';
        $arp_header_font_custom_color_input = isset($general_option['custom_skin_colors']['arp_header_font_custom_color']) ? $general_option['custom_skin_colors']['arp_header_font_custom_color'] : '';
        $arp_header_font_custom_hover_color_input = isset($general_option['custom_skin_colors']['arp_header_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_header_font_custom_hover_color'] : "";
        $arp_price_font_custom_color_input = isset($general_option['custom_skin_colors']['arp_price_font_custom_color']) ? $general_option['custom_skin_colors']['arp_price_font_custom_color'] : '';
        $arp_price_font_custom_hover_color_input = isset($general_option['custom_skin_colors']['arp_price_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_price_font_custom_hover_color'] : '';
        $arp_price_duration_font_custom_color_input = isset($general_option['custom_skin_colors']['arp_price_duration_font_custom_color']) ? $general_option['custom_skin_colors']['arp_price_duration_font_custom_color'] : '';
        $arp_price_duration_font_custom_hover_color_input = isset($general_option['custom_skin_colors']['arp_price_duration_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_price_duration_font_custom_hover_color'] : '';
        $arp_desc_font_custom_color_input = isset($general_option['custom_skin_colors']['arp_desc_font_custom_color']) ? $general_option['custom_skin_colors']['arp_desc_font_custom_color'] : '';
        $arp_desc_font_custom_hover_color_input = isset($general_option['custom_skin_colors']['arp_desc_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_desc_font_custom_hover_color'] : '';
        $arp_body_label_font_custom_color_input = isset($general_option['custom_skin_colors']['arp_body_label_font_custom_color']) ? $general_option['custom_skin_colors']['arp_body_label_font_custom_color'] : '';
        $arp_body_label_font_custom_hover_color_input = isset($general_option['custom_skin_colors']['arp_body_label_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_body_label_font_custom_hover_color'] : '';
        $arp_body_font_custom_color_input = isset($general_option['custom_skin_colors']['arp_body_font_custom_color']) ? $general_option['custom_skin_colors']['arp_body_font_custom_color'] : '';
        $arp_body_font_custom_hover_color_input = isset($general_option['custom_skin_colors']['arp_body_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_body_font_custom_hover_color'] : '';
        $arp_body_even_font_custom_color_input = isset($general_option['custom_skin_colors']['arp_body_even_font_custom_color']) ? $general_option['custom_skin_colors']['arp_body_even_font_custom_color'] : '';
        $arp_body_even_font_custom_hover_color_input = isset($general_option['custom_skin_colors']['arp_body_even_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_body_even_font_custom_hover_color'] : "";

        $arp_footer_font_custom_color_input = isset($general_option['custom_skin_colors']['arp_footer_font_custom_color']) ? $general_option['custom_skin_colors']['arp_footer_font_custom_color'] : '';
        $arp_footer_font_custom_hover_color_input = isset($general_option['custom_skin_colors']['arp_footer_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_footer_font_custom_hover_color'] : "";
        $arp_button_font_custom_color_input = isset($general_option['custom_skin_colors']['arp_button_font_custom_color']) ? $general_option['custom_skin_colors']['arp_button_font_custom_color'] : '';
        $arp_button_font_custom_hover_color_input = isset($general_option['custom_skin_colors']['arp_button_font_custom_hover_color']) ? $general_option['custom_skin_colors']['arp_button_font_custom_hover_color'] : "";
        
                $arp_shortocode_background = @$general_option['custom_skin_colors']['arp_shortocode_background'];
        $arp_shortocode_font_color = @$general_option['custom_skin_colors']['arp_shortocode_font_color'];
        $arp_shortcode_bg_hover_color = @$general_option['custom_skin_colors']['arp_shortcode_bg_hover_color'];
        $arp_shortcode_font_hover_color = @$general_option['custom_skin_colors']['arp_shortcode_font_hover_color'];

        $tablestring .= "<input type='hidden' name='arp_column_background_color' id='arp_column_background_color_input' value='" . $arp_template_column_bg_color . "' />";

        $tablestring .= "<input type='hidden' name='arp_column_desc_background_color' id='arp_column_desc_background_color_input' value='" . $arp_template_column_desc_bg_color . "' />";

        $tablestring .= "<input type='hidden' name='arp_header_background_color' id='arp_header_background_color_input' value='" . $arp_template_header_bg_color . "' />";

        $tablestring .= "<input type='hidden' name='arp_pricing_background_color' id='arp_pricing_background_color_input' value='" . $arp_template_pricing_bg_color . "' />";

        $tablestring .= "<input type='hidden' name='arp_body_odd_row_background_color' id='arp_body_odd_row_background_color' value='" . $arp_template_odd_row_bg_color . "' />";

        $tablestring .= "<input type='hidden' name='arp_body_even_row_background_color' id='arp_body_even_row_background_color' value='" . $arp_template_even_row_bg_color . "' />";

        $tablestring .= "<input type='hidden' name='arp_footer_content_background_color' id='arp_footer_content_background_color' value='" . $arp_template_footer_content_bg_color . "' />";

        $tablestring .= "<input type='hidden' name='arp_button_background_color' id='arp_button_background_color_input' value='" . $arp_template_button_bg_color . "' />";

        $tablestring .= "<input type='hidden' name='arp_column_bg_hover_color' class='arp_column_bg_hover_color' id='arp_column_bg_hover_color' value='" . $arp_column_bg_hover_color . "' />";

        $tablestring .= "<input type='hidden' name='arp_header_bg_hover_color' class='arp_header_bg_hover_color' id='arp_header_bg_hover_color' value='" . $arp_header_bg_hover_color . "' />";

        $tablestring .= "<input type='hidden' name='arp_button_bg_hover_color' class='arp_button_bg_hover_color' id='arp_button_bg_hover_color' value='" . $arp_button_bg_hover_color . "' />";

        $tablestring .= "<input type='hidden' name='arp_price_bg_hover_color' class='arp_price_bg_hover_color' id='arp_price_bg_hover_color' value='" . $arp_price_bg_hover_color . "' />";

        $tablestring .= "<input type='hidden' name='arp_body_odd_row_hover_background_color' id='arp_body_odd_row_hover_background_color' class='arp_body_odd_row_hover_background_color' value='" . $arp_template_odd_row_hover_bg_color . "' />";

        $tablestring .= "<input type='hidden' name='arp_body_even_row_hover_background_color' id='arp_body_even_row_hover_background_color' class='arp_body_even_row_hover_background_color' value='" . $arp_template_even_row_hover_bg_color . "' />";
        $tablestring .= "<input type='hidden' name='arp_footer_content_hover_background_color' id='arp_footer_hover_bg_color' class='arp_footer_hover_background_color' value='" . $arp_footer_hover_background_color . "' />";

        $tablestring .= "<input type='hidden' name='arp_column_desc_hover_background_color' class='arp_column_desc_hover_background_color_input' id='arp_column_desc_hover_background_color_input' value='" . $arp_template_column_desc_hover_bg_color . "' />";

        $tablestring .= "<input type='hidden' name='arp_header_font_custom_color_input' class='arp_header_font_custom_color_input' id='arp_header_font_custom_color_input' value='" . $arp_header_font_custom_color_input . "' />";

        $tablestring .= "<input type='hidden' name='arp_header_font_custom_hover_color_input' class='arp_header_font_custom_hover_color_input' id='arp_header_font_custom_hover_color_input' value='" . $arp_header_font_custom_hover_color_input . "' />";
        $tablestring .= "<input type='hidden' name='arp_price_font_custom_color_input' class='arp_price_font_custom_color_input' id='arp_price_font_custom_color_input' value='" . $arp_price_font_custom_color_input . "' />";

        $tablestring .= "<input type='hidden' name='arp_price_font_custom_hover_color_input' class='arp_price_font_custom_hover_color_input' id='arp_price_font_custom_hover_color_input' value='" . $arp_price_font_custom_hover_color_input . "' />";

        $tablestring .= "<input type='hidden' name='arp_price_duration_font_custom_color_input' class='arp_price_duration_font_custom_color_input' id='arp_price_duration_font_custom_color_input' value='" . $arp_price_duration_font_custom_color_input . "' />";

        $tablestring .= "<input type='hidden' name='arp_price_duration_font_custom_hover_color_input' class='arp_price_duration_font_custom_hover_color_input' id='arp_price_duration_font_custom_hover_color_input' value='" . $arp_price_duration_font_custom_hover_color_input . "' />";

        $tablestring .= "<input type='hidden' name='arp_desc_font_custom_color_input' class='arp_desc_font_custom_color_input' id='arp_desc_font_custom_color_input' value='" . $arp_desc_font_custom_color_input . "' />";

        $tablestring .= "<input type='hidden' name='arp_desc_font_custom_hover_color_input' class='arp_desc_font_custom_hover_color_input' id='arp_desc_font_custom_hover_color_input' value='" . $arp_desc_font_custom_hover_color_input . "' />";
        $tablestring .= "<input type='hidden' name='arp_body_label_font_custom_color_input' class='arp_body_label_font_custom_color_input' id='arp_body_label_font_custom_color_input' value='" . $arp_body_label_font_custom_color_input . "' />";
        $tablestring .= "<input type='hidden' name='arp_body_label_font_custom_hover_color_input' class='arp_body_label_font_custom_hover_color_input' id='arp_body_label_font_custom_hover_color_input' value='" . $arp_body_label_font_custom_hover_color_input . "' />";

        $tablestring .= "<input type='hidden' name='arp_body_font_custom_color_input' class='arp_body_font_custom_color_input' id='arp_body_font_custom_color_input' value='" . $arp_body_font_custom_color_input . "' />";

        $tablestring .= "<input type='hidden' name='arp_body_font_custom_hover_color_input' class='arp_body_font_custom_hover_color_input' id='arp_body_font_custom_hover_color_input' value='" . $arp_body_font_custom_hover_color_input . "' />";

        $tablestring .= "<input type='hidden' name='arp_body_even_font_custom_color_input' class='arp_body_even_font_custom_color_input' id='arp_body_even_font_custom_color_input' value='" . $arp_body_even_font_custom_color_input . "' />";
        $tablestring .= "<input type='hidden' name='arp_body_even_font_custom_hover_color_input' class='arp_body_even_font_custom_hover_color_input' id='arp_body_even_font_custom_hover_color_input' value='" . $arp_body_even_font_custom_hover_color_input . "' />";

        $tablestring .= "<input type='hidden' name='arp_footer_font_custom_color_input' class='arp_footer_font_custom_color_input' id='arp_footer_font_custom_color_input' value='" . $arp_footer_font_custom_color_input . "' />";

        $tablestring .= "<input type='hidden' name='arp_footer_font_custom_hover_color_input' class='arp_footer_font_custom_hover_color_input' id='arp_footer_font_custom_hover_color_input' value='" . $arp_footer_font_custom_hover_color_input . "' />";

        $tablestring .= "<input type='hidden' name='arp_button_font_custom_color_input' class='arp_button_font_custom_color_input' id='arp_button_font_custom_color_input' value='" . $arp_button_font_custom_color_input . "' />";

        $tablestring .= "<input type='hidden' name='arp_button_font_custom_hover_color_input' class='arp_button_font_custom_hover_color_input' id='arp_button_font_custom_hover_color_input' value='" . $arp_button_font_custom_hover_color_input . "' />";
        $tablestring .= "<input type='hidden' name='arp_shortocode_background_color' id='arp_shortocode_background_color_input' value='" . $arp_shortocode_background . "' />";
        $tablestring .= "<input type='hidden' name='arp_shortocode_font_custom_color_input' class='arp_shortocode_font_custom_color_input' id='arp_shortocode_font_custom_color_input' value='" . $arp_shortocode_font_color . "' />";
        $tablestring .= "<input type='hidden' name='arp_shortcode_font_custom_hover_color_input' class='arp_shortcode_font_custom_hover_color_input' id='arp_shortcode_font_custom_hover_color_input' value='" . $arp_shortcode_font_hover_color . "' />";
        $tablestring .= "<input type='hidden' name='arp_shortcode_bg_hover_color' class='arp_shortcode_bg_hover_color' id='arp_shortcode_bg_hover_color' value='" . $arp_shortcode_bg_hover_color . "' />";

        $tablestring .= "</div>";

        $tablestring .= "</div>";

        $tablestring .= "</div>";

        /**
         * New Belt Design
         * 
         * @since ARPricelite 1.0
         */
        $tablestring .= "<div class='arprice_options_menu_belt'>";

        $tablestring .= "<div class='arprice_top_belt_menu_option' id='column_options'>";
        $tablestring .= "<div class='arprice_top_belt_inner_container'>";
        $tablestring .= "<div class='column_options_img'></div>";
        $tablestring .= "<label class='arprice_top_belt_label'>" . __('Column Options', 'ARPricelite') . "</label>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arprice_top_belt_menu_option' id='column_effects'>";
        $tablestring .= "<div class='arprice_top_belt_inner_container'>";
        $tablestring .= "<div class='column_effects_img'></div>";
        $tablestring .= "<label class='arprice_top_belt_label'>" . __('Effects', 'ARPricelite') . "</label>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arprice_top_belt_menu_option' id='all_font_options'>";
        $tablestring .= "<div class='arprice_top_belt_inner_container'>";
        $tablestring .= "<div class='font_options_img'></div>";
        $tablestring .= "<label class='arprice_top_belt_label'>" . __('Fonts', ARPLITE_PT_TXTDOMAIN) . "</label>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arprice_top_belt_menu_option' id='tootip_options'>";
        $tablestring .= "<div class='arprice_top_belt_inner_container'>";
        $tablestring .= "<div class='tooltip_options_img'></div>";
        $tablestring .= "<label class='arprice_top_belt_label'>" . __('Tooltip', 'ARPricelite') . "</label>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arprice_top_belt_menu_option' id='custom_css_options'>";
        $tablestring .= "<div class='arprice_top_belt_inner_container'>";
        $tablestring .= "<div class='custom_css_options_img'></div>";
        $tablestring .= "<label class='arprice_top_belt_label'>" . __('Custom CSS', 'ARPricelite') . "</label>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arprice_top_belt_menu_option' id='toggle_content_options'>";
        $tablestring .= "<div class='arprice_top_belt_inner_container'>";
        $tablestring .= "<div class='toggle_content_options_img'></div>";
        $tablestring .= "<label class='arprice_top_belt_label'>" . __('Toggle Price', 'ARPricelite') . "</label>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arprice_top_belt_menu_right'>";

        $tablestring .= "<div class='arprice_top_right_belt_inner container_width'>";

        if ($column_settings['column_wrapper_width_txtbox'] != '') {
            $wrapper_width_value = $column_settings['column_wrapper_width_txtbox'];
        } else {
            $wrapper_width_value = $arplite_mainoptionsarr['general_options']['wrapper_width'];
        }

        $tablestring .= "<label for='column_wrapper_width_txtbox'>" . __('Width', 'ARPricelite') . "</label>&nbsp;&nbsp;";

        $tablestring .= "<div class='arprice_container_width_wrapper'>";
        $tablestring .= "<input type='text' id='column_wrapper_width_txtbox' value='$wrapper_width_value' class='arp_tab_txt' name='column_wrapper_width_txtbox'>";

        $tablestring .= "<span>px</span>";

        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arprice_top_right_belt_inner general_color_opts enable'>";

        $tablestring .= "<label>" . __('Color', 'ARPricelite') . "</label>";

        if ($reference_template == '') {
            $reference_template = 'arplitetemplate_1';
        }
        $key = array_search($arp_template_skin, $arplite_mainoptionsarr['general_options']['template_options']['skins'][$reference_template]);

        $default_skins = $arpricelite_default_settings->arprice_default_template_skins();
        $postarr['action'] = "arprice_default_template_skins";
        $postarr['table_id'] = $table_id;
        $postarr['reference_template'] = $reference_template;
        $skins = $arpricelite_default_settings->arp_change_default_template_skins($default_skins, $postarr);

        $data_skin = json_encode($skins[$reference_template]['skin']);
        $data_array = json_encode($skins[$reference_template]['color']);

        $tablestring .= "<div class='arprice_container_width_wrapper general_color_box_div' id='general_color_box_div' target-div='template_color_scheme'";
        $tablestring .= "data-skins='" . $data_skin . "'";
        $tablestring .= "data-array='" . json_encode($skins[$reference_template]['color']) . "'";
        $tablestring .= ">";

        if ($arplite_mainoptionsarr['general_options']['template_options']['skins'][$reference_template][$key] == 'multicolor')
            $cls = 'multi-color-small-icon';
        else
            $cls = '';

        if ($arplite_mainoptionsarr['general_options']['template_options']['skins'][$reference_template][$key] != 'multicolor') {

            $color = '#' . $arplite_mainoptionsarr['general_options']['template_options']['skin_color_code'][$reference_template][$key];
        } else {
            $color = '';
        }

        if ($template_settings['skin'] == 'custom' || $template_settings['skin'] == 'custom_skin') {
            $custom_skin_key = $arpricelite_default_settings->arplite_custom_css_selected_bg_color();
            $custom_skin_key = $custom_skin_key[$reference_template];
            $color = $general_option['custom_skin_colors'][$custom_skin_key];
        }

        $tablestring .= "<div style='background:$color' id='general_color_box' class='general_color_box $cls'></div>";

        $tablestring .= "<div class='general_color_box_img'>";

        $tablestring .= "</div>";

        $tablestring .= "</div>";

        $tablestring .= "</div>";

        $tablestring .= "</div>";

        $tablestring .= "</div>";

        /**
         * ARPricelite Column Options Menu New Design.
         * 
         * @since 1.0
         */
        /* Start */

        $tablestring .= "<div class='general_options_bar arp_hidden'>";

        $tablestring .= "<div class='general_options_bar_content'>";

        $tablestring .= "<div class='arprice_toggle_menu_options'></div>";



        /* Column Options Start */

        $tablestring .= "<div class='general_column_options_tab enable global_opts' id='column_options'>";

        $tablestring .= "<div class='arprice_option_belt_title'>";

        $tablestring .= __('Column Options', 'ARPricelite');

        $tablestring .= "</div>";

        $tablestring .= "<div class='column_option_dropdown' id='column_option_dropdown'>";


        // Column Width \\
        $tablestring .= "<div class='column_content_light_row column_opt_row'>";

        $tablestring .= "<div class='column_opt_label two_cols'>" . __('Column Width', 'ARPricelite') . "</div>";

        $tablestring .= "<div class='column_opt_opts two_cols align_right'>";

        $column_width_readonly = '';

        $tablestring .= "<span class='arp_col_px'>px</span>";

        $tablestring .= "<input type='text' " . $column_width_readonly . " name='all_column_width' class='arp_tab_txt' value='" . $column_settings['all_column_width'] . "' id='all_column_width' />";


        $tablestring .= "</div>";

        $tablestring .= "</div>";
        // Column Width End \\
        // Responsive Column\\ 
        $tablestring .= "<div class='column_content_dark_row column_opt_row'>";

        $tablestring .= "<div class='column_opt_label two_cols'>" . __('Responsive column', 'ARPricelite') . "</div>";

        $tablestring .= "<div class='column_opt_opts two_cols align_right'>";

        $tablestring .= "<input type='checkbox' name='is_responsive' id='is_responsive' class='arp_checkbox light_bg' value='1' " . checked($column_settings['is_responsive'], 1, false) . " />";

        $tablestring .= "</div>";

        $tablestring .= "</div>";
        // Responsive Column End\\ 
        // Display Columns\\ 

        $tablestring .= "<div class='column_content_dark_row column_opt_row'>";

        $tablestring .= "<div class='column_opt_label'>";

        $tablestring .= __('Display Columns', 'ARPricelite');

        $tablestring .= "&nbsp;&nbsp;&nbsp;<span class='pro_version_info'>(" . __('Pro Version', 'ARPricelite') . ")</span></div>";




        // Mobile \\
        $tablestring .= "<div class='column_opt_opts'>";

        $tablestring .= "<div class='column_opt_label column_opt_sub_label  two_cols'>" . __('Mobile', 'ARPricelite');

        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_opts two_cols'>";

        $tablestring .= "<input type='hidden' name='arp_display_columns_mobile' id='arp_display_columns_mobile' value='1' />";

        $tablestring .= "<dl id='arp_display_columns_mobile' class='arp_selectbox arplite_restricted_view' data-id='arp_display_columns_mobile' data-name='arp_display_columns_mobile' style='width:141px;margin-top:18px;margin-right:15px;float:right;'>";


        $tablestring .= "<dt><span>1</span><input type='text' style='display:none;' value='1' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul class='arp_display_columns_mobile' data-id='arp_display_columns_mobile'>";
        $tablestring .= "<li style='margin:0' class='arp_selectbox_option' data-value='" . __('All', 'ARPricelite') . "' data-label='" . __('All', 'ARPricelite') . "'>" . __('All', 'ARPricelite') . "</li>";
        for ($i = 1; $i <= $total_columns; $i++) {
            $tablestring .= "<li style='margin:0' class='arp_selectbox_option' data-value='" . $i . "' data-label='" . $i . "'>" . $i . "</li>";
        }
        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";

        $tablestring .= "</div>";

        $tablestring .= "</div>";
        // Mobile End \\
        // Tablet \\
        $tablestring .= "<div class='column_opt_opts'>";

        $tablestring .= "<div class='column_opt_label column_opt_sub_label two_cols'>" . __('Tablet', 'ARPricelite');

        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_opts two_cols'>";

        $tablestring .= "<input type='hidden' name='arp_display_columns_tablet' id='arp_display_columns_tablet' value='3' />";

        $tablestring .= "<dl id='arp_display_columns_tablet' class='arp_selectbox arplite_restricted_view' data-id='arp_display_columns_tablet' data-name='arp_display_columns_tablet' style='width:141px;margin-top:18px;margin-right:15px;float:right;'>";

        $tablestring .= "<dt><span>3</span><input type='text' style='display:none;' value='3' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul class='arp_display_columns_tablet' data-id='arp_display_columns_tablet'>";
        $tablestring .= "<li style='margin:0' class='arp_selectbox_option' data-value='" . __('All', 'ARPricelite') . "' data-label='" . __('All', 'ARPricelite') . "'>" . __('All', 'ARPricelite') . "</li>";
        for ($i = 1; $i <= $total_columns; $i++) {
            $tablestring .= "<li style='margin:0' class='arp_selectbox_option' data-value='" . $i . "' data-label='" . $i . "'>" . $i . "</li>";
        }
        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";

        $tablestring .= "</div>";

        $tablestring .= "</div>";
        // Tablet End \\

        $tablestring .= "</div>";

        // Display Columns End\\ 
        // Space between Columns\\
        $tablestring .= "<div class='column_content_light_row column_opt_row'>";

        $tablestring .= "<div class='column_opt_label two_cols'>" . __('Space between Columns', 'ARPricelite') . "</div>";

        $tablestring .= "<div class='column_opt_opts two_cols align_right'>";

        $tablestring .= "<span class='arp_col_px'>px</span>";

        $tablestring .= "<input type='text' name='column_space' class='arp_tab_txt' value='" . $column_settings['column_space'] . "' id='column_space' />";

        $tablestring .= "</div>";

        $tablestring .= "</div>";
        // Space between Columns End \\
        //Full Column Clickable\\
        if (in_array(1, $caption_col))
            $style = 'display:block;';
        else
            $style = 'display:none;';

        $tablestring .= "<div class='column_content_light_row column_opt_row'>";

        $tablestring .= "<div class='column_opt_label two_cols'>" . __('Full Column Clickable', 'ARPricelite') . "&nbsp;&nbsp;&nbsp;<span class='pro_version_info'>(" . __('Pro Version', 'ARPricelite') . ")</span></div>";

        $tablestring .= "<div class='column_opt_opts two_cols align_right'>";


        $column_settings['full_column_clickable'] = isset($column_settings['full_column_clickable']) ? $column_settings['full_column_clickable'] : "";
        $tablestring .= "<input type='checkbox' name='full_column_clickable' id='full_column_clickable' class='arp_checkbox light_bg arplite_restricted_view' value='1' " . checked($column_settings['full_column_clickable'], 1, false) . " />";

        $tablestring .= "</div>";

        $tablestring .= "</div>";

        // Full Column Clickable End \\
        //disable hover effect

        $tablestring .= "<div class='column_content_light_row column_opt_row'>";

        $tablestring .= "<div class='column_opt_label two_cols'>" . __('Disable Hover Effect', ARPLITE_PT_TXTDOMAIN) . "&nbsp;&nbsp;&nbsp;<span class='pro_version_info'>(" . __('Pro Version', 'ARPricelite') . ")</span></div>";

        $tablestring .= "<div class='column_opt_opts two_cols align_right'>";


        $column_settings['disable_hover_effect'] = isset($column_settings['disable_hover_effect']) ? $column_settings['disable_hover_effect'] : "";
        $tablestring .= "<input type='checkbox' name='disable_hover_effect' id='disable_hover_effect' class='arp_checkbox light_bg arplite_restricted_view' value='1' " . checked($column_settings['disable_hover_effect'], 1, false) . " />";

        $tablestring .= "</div>";
        $tablestring .= "<div class='column_opt_label_help'>(" . __('Active column effects and hover color changes will be disabled.', ARPLITE_PT_TXTDOMAIN) . ")</div>";
        $tablestring .= "</div>";

//disable hover effect
        //Column Radius\\


        $allow_border_radius = $arpricelite_default_settings->arpricelite_allow_border_radius();
        if ($allow_border_radius[$reference_template]) {

            $tablestring .= "<div class='column_content_dark_row column_opt_row'>";

            $tablestring .= "<div class='column_opt_label two_cols' style='line-height:70px'>" . __('Column Radius (px)', 'ARPricelite') . "</div>";

            $tablestring .= "<div class='column_opt_opts two_cols align_right'>";


            if ($column_settings['column_box_shadow_effect'] == 'shadow_style_none' || $column_settings['column_box_shadow_effect'] == '') {
                $arp_tab_column_radius_txt_disabled = '';
            } else {
                $arp_tab_column_radius_txt_disabled = 'readonly="readonly"';
            }

            if ($column_settings['column_border_radius_top_left'] != '' || $column_settings['column_border_radius_top_left'] == 0) {
                $column_border_radius_top_left = $column_settings['column_border_radius_top_left'];
            } else {
                $column_border_radius_top_left = $arplite_mainoptionsarr['general_options']['default_column_radius_value'][$reference_template]['top_left'];
            }

            if ($column_settings['column_border_radius_top_right'] != '' || $column_settings['column_border_radius_top_right'] == 0) {
                $column_border_radius_top_right = $column_settings['column_border_radius_top_right'];
            } else {
                $column_border_radius_top_right = $arplite_mainoptionsarr['general_options']['default_column_radius_value'][$reference_template]['top_right'];
            }
            if ($column_settings['column_border_radius_bottom_right'] != '' || $column_settings['column_border_radius_bottom_right'] == 0) {
                $column_border_radius_bottom_right = $column_settings['column_border_radius_bottom_right'];
            } else {
                $column_border_radius_bottom_right = $arplite_mainoptionsarr['general_options']['default_column_radius_value'][$reference_template]['bottom_right'];
            }
            if ($column_settings['column_border_radius_bottom_left'] != '' || $column_settings['column_border_radius_bottom_left'] == 0) {
                $column_border_radius_bottom_left = $column_settings['column_border_radius_bottom_left'];
            } else {
                $column_border_radius_bottom_left = $arplite_mainoptionsarr['general_options']['default_column_radius_value'][$reference_template]['bottom_left'];
            }

            $tablestring .= "<div class='arp_column_radius_main'>";

            $tablestring .= "<div>";
            $tablestring .= "<span>Left</span>";
            $tablestring .= "<input type='text' id='column_border_radius_top_left' value='$column_border_radius_top_left' class='arp_tab_txt arp_tab_column_radius_txt' name='column_border_radius_top_left' onBlur=\"arp_update_column_border_radius(this.value,jQuery('#column_border_radius_top_right').val(),jQuery('#column_border_radius_bottom_right').val(), jQuery('#column_border_radius_bottom_left').val(),$is_animated)\" } $arp_tab_column_radius_txt_disabled />";
            $tablestring .= "</div>";

            $tablestring .= "<div>";
            $tablestring .= "<span>Right</span>";
            $tablestring .= "<input type='text' id='column_border_radius_top_right' value='$column_border_radius_top_right' class='arp_tab_txt arp_tab_column_radius_txt' name='column_border_radius_top_right' onBlur=\"arp_update_column_border_radius(jQuery('#column_border_radius_top_left').val(),this.value,jQuery('#column_border_radius_bottom_right').val(), jQuery('#column_border_radius_bottom_left').val(),$is_animated)\" $arp_tab_column_radius_txt_disabled />";
            $tablestring .= "</div>";


            $tablestring .= "<div>";
            $tablestring .= "<span>Left</span>";
            $tablestring .= "<input type='text' id='column_border_radius_bottom_left' value='$column_border_radius_bottom_left' class='arp_tab_txt arp_tab_column_radius_txt' name='column_border_radius_bottom_left' onBlur=\"arp_update_column_border_radius(jQuery('#column_border_radius_top_left').val(), jQuery('#column_border_radius_top_right').val(), jQuery('#column_border_radius_bottom_right').val(), this.value, $is_animated)\" $arp_tab_column_radius_txt_disabled />";
            $tablestring .= "</div>";

            $tablestring .= "<div>";
            $tablestring .= "<span>Right</span>";
            $tablestring .= "<input type='text' id='column_border_radius_bottom_right' value='$column_border_radius_bottom_right' class='arp_tab_txt arp_tab_column_radius_txt' name='column_border_radius_bottom_right' onBlur=\"arp_update_column_border_radius(jQuery('#column_border_radius_top_left').val(), jQuery('#column_border_radius_top_right').val(), this.value, jQuery('#column_border_radius_bottom_left').val(),$is_animated)\" $arp_tab_column_radius_txt_disabled />";
            $tablestring .= "</div>";

            $tablestring .= "</div>";


            $tablestring .= "<div class='arp_column_radius_main'>";
            $tablestring .= "<div class='arp_column_radius_bottom'>";
            $tablestring .= "<span>Top</span>";
            $tablestring .= "</div>";
            $tablestring .= "<div class='arp_column_radius_bottom'>";
            $tablestring .= "<span>Bottom</span>";
            $tablestring .= "</div>";
            $tablestring .= "</div>";


            $tablestring .= "</div>";

            $tablestring .= "</div>";
        }
        //Column Radius End \\
        //Hide Caption Column \\
        if (in_array(1, $caption_col))
            $style = 'display:block;';
        else
            $style = 'display:none;';

        $tablestring .= "<div class='column_content_light_row column_opt_row' id='column_content_hide_caption_column' style='" . $style . "'>";

        $tablestring .= "<div class='column_opt_label two_cols'>" . __('Hide Caption Column', 'ARPricelite') . "</div>";

        $tablestring .= "<div class='column_opt_opts two_cols align_right'>";

        $column_settings['hide_caption_column'] = isset($column_settings['hide_caption_column']) ? $column_settings['hide_caption_column'] : "";
        $tablestring .= "<input type='checkbox' name='hide_caption_column' id='hide_caption_column' class='arp_checkbox light_bg' value='1' " . checked($column_settings['hide_caption_column'], 1, false) . " />";

        $tablestring .= "</div>";

        $tablestring .= "</div>";

        // Hide Caption Column End \\
        // Hide Blank Rows \\\
        $tablestring .= "<div class='column_content_light_row column_opt_row'><div class='column_opt_label two_cols'>" . __('Hide blank rows from bottom', 'ARPricelite') . "</div>";
$column_settings['column_hide_blank_rows'] = isset($column_settings['column_hide_blank_rows'])?$column_settings['column_hide_blank_rows']:'';
        $tablestring .= "<div class='column_opt_opts two_cols align_right'>";
        $tablestring .= "<input type='checkbox' name='hide_blank_rows' id='hide_blank_rows' value='yes' " . checked(@$column_settings['column_hide_blank_rows'], 'yes', false) . " class='arp_checkbox light_bg' />";
        $tablestring .= "</div>";
        $tablestring .= "<div class='column_opt_label_help'>(" . __('Only bottom rows will hide and shown in preview and front end.', 'ARPricelite') . ")</div>";
        $tablestring .= "</div>";

        // Hide Blank Rows End \\   
        // Hide Footer Start \\
        if (in_array(1, $caption_col))
            $style = 'display:block;';
        else
            $style = 'display:none;';

        $hide_section_array = $arpricelite_default_settings->arprice_hide_section_array();
        $hide_section_array = $hide_section_array[$ref_template];

        /* Hide Header Section */
        $tablestring .= "<div class='column_content_light_row column_opt_row' id='arp_hide_show_section'>";

        $tablestring .= "<div class='column_opt_label two_cols'>" . __('Hide Column Sections', ARPLITE_PT_TXTDOMAIN) . "</div>";

        /* Hide Header Section */
        if (array_key_exists('arp_header', $hide_section_array))
            $style = 'display:block;';
        else
            $style = 'display:none;';

        $tablestring .= "<div class='column_opt_opts' style='" . $style . "'>";

        $tablestring .= "<div class='column_opt_label column_opt_sub_label  two_cols'>" . __('Hide Header', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_opts two_cols'>";

        $column_settings['hide_header_global'] = isset($column_settings['hide_header_global']) ? $column_settings['hide_header_global'] : "";
        $tablestring .= "<input type='checkbox' data-hide-section='arp_header' name='hide_header_global' id='hide_header_global' class='arp_checkbox light_bg' value='1' " . checked($column_settings['hide_header_global'], 1, false) . " />";

        $tablestring .= "</div>";
        $tablestring .= "</div>";

        if (array_key_exists('arp_header_shortcode', $hide_section_array))
            $style = 'display:block;';
        else
            $style = 'display:none;';

        $tablestring .= "<div class='column_opt_opts' style='" . $style . "'>";

        $tablestring .= "<div class='column_opt_label column_opt_sub_label  two_cols'>" . __('Hide Shortcode', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_opts two_cols'>";

        $column_settings['hide_header_shortcode_global'] = isset($column_settings['hide_header_shortcode_global']) ? $column_settings['hide_header_shortcode_global'] : "";
        $tablestring .= "<input type='checkbox' data-hide-section='arp_header_shortcode' name='hide_header_shortcode_global' id='hide_header_shortcode_global' class='arp_checkbox light_bg' value='1' " . checked($column_settings['hide_header_shortcode_global'], 1, false) . " />";

        $tablestring .= "</div>";
        $tablestring .= "</div>";

        if (array_key_exists('arp_price', $hide_section_array))
            $style = 'display:block;';
        else
            $style = 'display:none;';

        $tablestring .= "<div class='column_opt_opts' style='" . $style . "'>";

        $tablestring .= "<div class='column_opt_label column_opt_sub_label  two_cols'>" . __('Hide Price', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_opts two_cols'>";

        $column_settings['hide_price_global'] = isset($column_settings['hide_price_global']) ? $column_settings['hide_price_global'] : "";
        $tablestring .= "<input type='checkbox' data-hide-section='arp_price' name='hide_price_global' id='hide_price_global' class='arp_checkbox light_bg' value='1' " . checked($column_settings['hide_price_global'], 1, false) . " />";

        $tablestring .= "</div>";
        $tablestring .= "</div>";

        if (array_key_exists('arp_feature', $hide_section_array))
            $style = 'display:block;';
        else
            $style = 'display:none;';

        $tablestring .= "<div class='column_opt_opts' style='" . $style . "'>";

        $tablestring .= "<div class='column_opt_label column_opt_sub_label  two_cols'>" . __('Hide Body', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_opts two_cols'>";

        $column_settings['hide_feature_global'] = isset($column_settings['hide_feature_global']) ? $column_settings['hide_feature_global'] : "";
        $tablestring .= "<input type='checkbox' data-hide-section='arp_feature' name='hide_feature_global' id='hide_feature_global' class='arp_checkbox light_bg' value='1' " . checked($column_settings['hide_feature_global'], 1, false) . " />";

        $tablestring .= "</div>";

        $tablestring .= "</div>";

        if (array_key_exists('arp_description', $hide_section_array))
            $style = 'display:block;';
        else
            $style = 'display:none;';

        $tablestring .= "<div class='column_opt_opts' style='" . $style . "'>";

        $tablestring .= "<div class='column_opt_label column_opt_sub_label  two_cols'>" . __('Hide Description', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_opts two_cols'>";

        $column_settings['hide_description_global'] = isset($column_settings['hide_description_global']) ? $column_settings['hide_description_global'] : "";
        $tablestring .= "<input type='checkbox' data-hide-section='arp_description' name='hide_description_global' id='hide_description_global' class='arp_checkbox light_bg' value='1' " . checked($column_settings['hide_description_global'], 1, false) . " />";

        $tablestring .= "</div>";

        $tablestring .= "</div>";

        if (array_key_exists('arp_footer', $hide_section_array))
            $style = 'display:block;';
        else
            $style = 'display:none;';

        $tablestring .= "<div class='column_opt_opts' style='" . $style . "'>";

        $tablestring .= "<div class='column_opt_label column_opt_sub_label  two_cols'>" . __('Hide Button', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_opts two_cols'>";

        $column_settings['hide_footer_global'] = isset($column_settings['hide_footer_global']) ? $column_settings['hide_footer_global'] : "";
        $tablestring .= "<input type='checkbox' data-hide-section='arp_footer' name='hide_footer_global' id='hide_footer_global' class='arp_checkbox light_bg' value='1' " . checked($column_settings['hide_footer_global'], 1, false) . " />";

        $tablestring .= "</div>";

        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_label_help'>(" . __('Effect will shown in preview and front end only.', ARPLITE_PT_TXTDOMAIN) . ")</div>";
        $tablestring .= "</div>";


//Hide-Show Section end
        //Opacity \\
        if (in_array(1, $caption_col))
            $cls = 'column_content_dark_row';
        else
            $cls = 'column_content_light_row';

        $display = 'display:block';

        $tablestring .= "<div class='" . $cls . " column_opt_row' id='column_content_opacity' style='" . $display . ";' > ";

        $tablestring .= "<div class='column_opt_label  two_cols'>" . __('Opacity', 'ARPricelite');

        $tablestring .= "<br><span class='pro_version_info'>(" . __('Pro Version', 'ARPricelite') . ")</span></div>";

        $tablestring .= "<div class='column_opt_opts two_cols'>";

        $tablestring .= "<input type='hidden' name='column_opacity' id='column_opacity' value='1' />";

        $tablestring .= "<dl class='arp_selectbox arplite_restricted_view' id='column_opacity_dd' data-name='column_opacity' data-id='column_opacity' style='width:141px;margin-top:18px;margin-right:15px;float:right;'>";

        $tablestring .= "<dt><span>1</span><input type='text' style='display:none;' value='1' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul class='arp_column_opacity' data-id='column_opacity'>";

        foreach ($arplite_mainoptionsarr['general_options']['column_opacity'] as $column_opacity) {
            $tablestring .= "<li style='margin:0' class='arp_selectbox_option' data-value='" . $column_opacity . "' data-label='" . $column_opacity . "'>" . $column_opacity . "</li>";
        }
        $tablestring .= "</ul>";

        $tablestring .= "</dd>";

        $tablestring .= "</di>";

        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_label_help' style='margin: -2px 0 0;'>(" . __('Opacity will be shown in preview and frontend only.', 'ARPricelite') . ")</div>";

        $tablestring .= "</div>";

        //Opacity End\\
        // Column Shadow \\

        if (in_array(1, $caption_col))
            $cls = 'column_content_light_row';
        else
            $cls = 'column_content_dark_row';

        if ($template_settings['features']['is_animated'] == 0 && $ref_template != 'arplitetemplate_23' && $ref_template != 'arplitetemplate_21') {

            $arp_selectbox_disabled = '';

            $tablestring .= "<div id='column_box_shadow_effect' class='$cls column_opt_row  $arp_selectbox_disabled'>";

            $tablestring .= "<div class='column_opt_label  two_cols'>" . __('Column Shadow', 'ARPricelite');


            $tablestring .= "</div>";

            $tablestring .= "<div class='column_opt_opts two_cols'>";

            if ($column_settings['column_box_shadow_effect'] != '') {
                $column_box_shadow_effect = $column_settings['column_box_shadow_effect'];
            } else {
                $column_box_shadow_effect = __('None', 'ARPricelite');
            }

            $tablestring .= "<input type='hidden' name='column_box_shadow_effect' class='arp_box_shadow_change' id='column_box_shadow_effect' value='" . $column_box_shadow_effect . "' />";


            if ($column_settings['column_box_shadow_effect'] == 'shadow_style_1') {
                $shadow_span_text = 'Style 1';
            } else if ($column_settings['column_box_shadow_effect'] == 'shadow_style_2') {
                $shadow_span_text = 'Style 2';
            } else if ($column_settings['column_box_shadow_effect'] == 'shadow_style_3') {
                $shadow_span_text = 'Style 3';
            } else if ($column_settings['column_box_shadow_effect'] == 'shadow_style_4') {
                $shadow_span_text = 'Style 4';
            } else if ($column_settings['column_box_shadow_effect'] == 'shadow_style_5') {
                $shadow_span_text = 'Style 5';
            } else {
                $shadow_span_text = 'None';
            }

            $tablestring .= '<dl name="column_box_shadow_effect" style="width:141px;margin-top:18px;margin-right:15px;float:right;" id="column_box_shadow_effect" class="arp_selectbox">'
                    . '<dt><span>' . $shadow_span_text . '</span><input type="text" class="arp_autocomplete" value="None" style="display:none;"><i class="fa fa-caret-down fa-lg"></i></dt>'
                    . '<dd><ul data-id="column_box_shadow_effect" class="column_box_shadow_effect" id="column_box_shadow_effect1">';

            foreach ($arplite_mainoptionsarr['general_options']['column_box_shadow_effect'] as $key => $column_box_shadow_effect) {

                $tablestring .= '<li data-label="' . $column_box_shadow_effect . '" data-value="' . $key . '" class="arp_selectbox_option" style="margin:0">' . $column_box_shadow_effect . '</li>';
            }

            $tablestring .= '</ul>'
                    . '</dd>'
                    . '</dl>';

            $tablestring .= "</div>";

            $tablestring .= "<div class='column_opt_label_help' style='margin: -2px 0 0;'>(" . __('Column shadow will not apply with column border radius.', 'ARPricelite') . ")</div>";

            $tablestring .= '</div>';
        }

        // Column Shadow End \\

        $tablestring .= "<div class='column_content_dark_row column_opt_row'>";

        $tablestring .= "<div class='column_opt_label'>";

        $tablestring .= __('Column Borders', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "</div>";

        // border-size row level start \\
        $tablestring .= "<div class='column_opt_opts'>";

        $tablestring .= "<div class='column_opt_label column_opt_sub_label  two_cols'>" . __('Border Size', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_opts two_cols'>";
        $column_settings['arp_column_border_size'] = isset($column_settings['arp_column_border_size']) ? $column_settings['arp_column_border_size'] : '';
        $tablestring .= "<input type='hidden' name='arp_column_border_size' id='arp_column_border_size' value='" . $column_settings['arp_column_border_size'] . "' />";

        $tablestring .= "<dl id='arp_column_border_size' class='arp_selectbox' data-id='arp_column_border_size' data-name='arp_column_border_size' style='width:141px;margin-top:18px;margin-right:15px;float:right;'>";

        if ($column_settings['arp_column_border_size']) {
            $selected_border_size = $column_settings['arp_column_border_size'];
        } else {
            $selected_border_size = "0";
        }
        $tablestring .= "<dt><span>" . $selected_border_size . "</span><input type='text' style='display:none;' value='" . $selected_border_size . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul class='arp_column_border_size' data-id='arp_column_border_size'>";
        for ($i = 0; $i <= 10; $i++) {
            $tablestring .= "<li style='margin:0' class='arp_selectbox_option' data-value='" . $i . "' data-label='" . $i . "'>" . $i . "</li>";
        }
        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";

        $tablestring .= "</div>";

        $tablestring .= "</div>";
        // border-size row level end \\
        // border-type row level start \\
        $tablestring .= "<div class='column_opt_opts'>";

        $tablestring .= "<div class='column_opt_label column_opt_sub_label two_cols'>" . __('Border Type', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_opts two_cols'>";
        $column_settings['arp_column_border_type'] = isset($column_settings['arp_column_border_type']) ? $column_settings['arp_column_border_type'] : '';
        $tablestring .= "<input type='hidden' name='arp_column_border_type' id='arp_column_border_type' value='" . $column_settings['arp_column_border_type'] . "' />";

        $tablestring .= "<dl id='arp_column_border_type' class='arp_selectbox' data-id='arp_column_border_type' data-name='arp_column_border_type' style='width:141px;margin-top:18px;margin-right:15px;float:right;'>";

        if ($column_settings['arp_column_border_type']) {
            $selected_border_type = $column_settings['arp_column_border_type'];
        } else {
            $selected_border_type = __('Choose Option', ARPLITE_PT_TXTDOMAIN);
        }
        $tablestring .= "<dt><span>" . $selected_border_type . "</span><input type='text' style='display:none;' value='" . $selected_border_type . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul class='arp_column_border_type' data-id='arp_column_border_type'>";

        $tablestring .= "<li style='margin:0' class='arp_selectbox_option' data-value='solid' data-label='solid'>Solid</li>";
        $tablestring .= "<li style='margin:0' class='arp_selectbox_option' data-value='dotted' data-label='dotted'>Dotted</li>";
        $tablestring .= "<li style='margin:0' class='arp_selectbox_option' data-value='dashed' data-label='dashed'>Dashed</li>";

        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";

        $tablestring .= "</div>";

        $tablestring .= "</div>";
        // border-type row level end \\
        // border-color starts        
        $tablestring .= "<div class='column_opt_opts'>";
        $tablestring .= "<div class='column_opt_label column_opt_sub_label two_cols'>" . __('Border Color', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='column_opt_opts two_cols'>";
        $column_settings['arp_column_border_color'] = isset($column_settings['arp_column_border_color']) ? $column_settings['arp_column_border_color'] : "#c9c9c9";
        $tablestring .= "<div class='color_picker color_picker_round jscolor' data-jscolor='{hash:true,onFineChange:\"arp_update_color(this,arp_column_border_color)\",valueElement:arp_column_border_color_hidden}' jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_column_border_color)' jscolor-valueelement='arp_column_border_color_hidden' data-id='arp_column_border_color_hidden' data-column-id='arp_column_border_color' id='arp_column_border_color' style='background:" . $column_settings['arp_column_border_color'] . ";' data-color='" . $column_settings['arp_column_border_color'] . "' >";

        $tablestring .= "</div>";
        $tablestring .= "<input type='hidden' id='arp_column_border_color_hidden' name='arp_column_border_color' value='" . $column_settings['arp_column_border_color'] . "' />";
        $tablestring .= "</div>";

        $tablestring .= "</div>";
        // border-color ends
        // borders checkbox starts
        $disable_other_class = '';
        $column_settings['arp_column_border_all'] = isset($column_settings['arp_column_border_all']) ? $column_settings['arp_column_border_all'] : '';
        if ($column_settings['arp_column_border_all'] == 1) {
            $disable_other_border = "disabled='disabled'";
            $disable_other_class = 'arp_selectbox_disabled';
        } else {
            $disable_other_border = "";
        }
        $tablestring .= "<div class='column_opt_label column_opt_sub_label two_cols'>" . __('Borders', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='column_opt_opts two_cols align_right'>";
        $tablestring .= "<div class='arp_column_radius_main'>";

        $tablestring .= "<div>";
        $tablestring .= "<span>Left</span>";
        $column_settings['arp_column_border_left'] = isset($column_settings['arp_column_border_left']) ? $column_settings['arp_column_border_left'] : '';
        $tablestring .= "<input type='checkbox' name='arp_column_border_left' id='arp_column_border_left' class='arp_checkbox light_bg $disable_other_class' value='1' " . checked($column_settings['arp_column_border_left'], 1, false) . " style='position:relative;' $disable_other_border />";
        $tablestring .= "</div>";

        $tablestring .= "<div>";
        $tablestring .= "<span>Right</span>";
        $column_settings['arp_column_border_right'] = isset($column_settings['arp_column_border_right']) ? $column_settings['arp_column_border_right'] : '';
        $tablestring .= "<input type='checkbox' name='arp_column_border_right' id='arp_column_border_right' class='arp_checkbox light_bg $disable_other_class' value='1' " . checked($column_settings['arp_column_border_right'], 1, false) . " style='position:relative;' $disable_other_border />";
        $tablestring .= "</div>";

        $tablestring .= "<div>";
        $tablestring .= "<span>Top</span>";
        $column_settings['arp_column_border_top'] = isset($column_settings['arp_column_border_top']) ? $column_settings['arp_column_border_top'] : '';
        $tablestring .= "<input type='checkbox' name='arp_column_border_top' id='arp_column_border_top' class='arp_checkbox light_bg $disable_other_class' value='1' " . checked($column_settings['arp_column_border_top'], 1, false) . " style='position:relative;' $disable_other_border />";
        $tablestring .= "</div>";

        $tablestring .= "<div>";
        $tablestring .= "<span>Bottom</span>";
        $column_settings['arp_column_border_bottom'] = isset($column_settings['arp_column_border_bottom']) ? $column_settings['arp_column_border_bottom'] : '';
        $tablestring .= "<input type='checkbox' name='arp_column_border_bottom' id='arp_column_border_bottom' class='arp_checkbox light_bg $disable_other_class' value='1' " . checked($column_settings['arp_column_border_bottom'], 1, false) . " style='position:relative;' $disable_other_border />";
        $tablestring .= "</div>";

        $tablestring .= "</div>";
        $tablestring .= "</div>";
        // borders checkbox ends

        $tablestring .= "</div>";

        //end column level border
        //start row level border
        $tablestring .= "<div class='column_content_dark_row column_opt_row'>";

        $tablestring .= "<div class='column_opt_label'>";

        $tablestring .= __('Row Borders', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "</div>";

        // border-size row level start \\
        $tablestring .= "<div class='column_opt_opts'>";

        $tablestring .= "<div class='column_opt_label column_opt_sub_label  two_cols'>" . __('Border Size', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_opts two_cols'>";
        $column_settings['arp_row_border_size'] = isset($column_settings['arp_row_border_size']) ? $column_settings['arp_row_border_size'] : '';
        $tablestring .= "<input type='hidden' name='arp_row_border_size' id='arp_row_border_size' value='" . $column_settings['arp_row_border_size'] . "' />";

        $tablestring .= "<dl id='arp_row_border_size' class='arp_selectbox' data-id='arp_row_border_size' data-name='arp_row_border_size' style='width:141px;margin-top:18px;margin-right:15px;float:right;'>";

        if ($column_settings['arp_row_border_size']) {
            $selected_border_size = $column_settings['arp_row_border_size'];
        } else {
            $selected_border_size = "0";
        }
        $tablestring .= "<dt><span>" . $selected_border_size . "</span><input type='text' style='display:none;' value='" . $selected_border_size . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul class='arp_row_border_size' data-id='arp_row_border_size'>";
        for ($i = 0; $i <= 10; $i++) {
            $tablestring .= "<li style='margin:0' class='arp_selectbox_option' data-value='" . $i . "' data-label='" . $i . "'>" . $i . "</li>";
        }
        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";

        $tablestring .= "</div>";

        $tablestring .= "</div>";
        // border-size row level end \\
        // border-type row level start \\
        $tablestring .= "<div class='column_opt_opts'>";

        $tablestring .= "<div class='column_opt_label column_opt_sub_label two_cols'>" . __('Border Type', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_opts two_cols'>";
        $column_settings['arp_row_border_type'] = isset($column_settings['arp_row_border_type']) ? $column_settings['arp_row_border_type'] : '';
        $tablestring .= "<input type='hidden' name='arp_row_border_type' id='arp_row_border_type' value='" . $column_settings['arp_row_border_type'] . "' />";

        $tablestring .= "<dl id='arp_row_border_type' class='arp_selectbox' data-id='arp_row_border_type' data-name='arp_row_border_type' style='width:141px;margin-top:18px;margin-right:15px;float:right;'>";

        if ($column_settings['arp_row_border_type']) {
            $selected_border_type = $column_settings['arp_row_border_type'];
        } else {
            $selected_border_type = __('Choose Option', ARPLITE_PT_TXTDOMAIN);
        }
        $tablestring .= "<dt><span>" . $selected_border_type . "</span><input type='text' style='display:none;' value='" . $selected_border_type . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul class='arp_row_border_type' data-id='arp_row_border_type'>";

        $tablestring .= "<li style='margin:0' class='arp_selectbox_option' data-value='solid' data-label='solid'>Solid</li>";
        $tablestring .= "<li style='margin:0' class='arp_selectbox_option' data-value='dotted' data-label='dotted'>Dotted</li>";
        $tablestring .= "<li style='margin:0' class='arp_selectbox_option' data-value='dashed' data-label='dashed'>Dashed</li>";

        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";

        $tablestring .= "</div>";

        $tablestring .= "</div>";
        // border-type row level end \\
        // border-color starts        
        $tablestring .= "<div class='column_opt_opts'>";
        $tablestring .= "<div class='column_opt_label column_opt_sub_label two_cols'>" . __('Border Color', ARPLITE_PT_TXTDOMAIN) . "</div>";

        $tablestring .= "<div class='column_opt_opts two_cols'>";
        $column_settings['arp_row_border_color'] = isset($column_settings['arp_row_border_color']) ? $column_settings['arp_row_border_color'] : '#c9c9c9';
        $tablestring .= "<div class='color_picker color_picker_round jscolor' data-jscolor='{hash:true,onFineChange:\"arp_update_color(this,arp_row_border_color)\",valueElement:arp_row_border_color_hidden}' jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_row_border_color)' jscolor-valueelement='arp_row_border_color_hidden' data-id='arp_row_border_color_hidden' id='arp_row_border_color' style='background:" . $column_settings['arp_row_border_color'] . ";' data-color='" . $column_settings['arp_row_border_color'] . "' data-column-id='arp_row_border_color'>";
        $tablestring .= "<input type='hidden' id='arp_row_border_color_hidden' data-column-id='arp_row_border_color' data-id='arp_row_border_color' name='arp_row_border_color' value='" . $column_settings['arp_row_border_color'] . "' />";

        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "</div>";
        // border-color ends

        $tablestring .= "</div>";
        // end row level border
 
        $style = '';
        if ($reference_template == 'arplitetemplate_26') {
            $style = 'display:none';
        } else {
            $style = 'display:block';
        }

        $tablestring .= "<div class='column_content_light_row column_opt_row arp_no_border' style='" . $style . ";margin-bottom:15px;'>";

        $tablestring .= "<div class='column_opt_label two_cols'>" . __('Button Style Options', ARPLITE_PT_TXTDOMAIN) . "</div>";

        $arp_global_button_border_type = isset($column_settings['arp_global_button_type']) ? $column_settings['arp_global_button_type'] : 'shadow';
        if ($reference_template == 'arplitetemplate_5') {
            $button_button_type = 'display : none;';
        } else {
            $button_button_type = 'display : block;';
        }

        $button_type = $arpricelite_default_settings->arp_button_type();
        $tablestring .= "<div class='column_opt_opts' style='" . $button_button_type . "'>";
        $tablestring .= "<div class='column_opt_label column_opt_sub_label  two_cols' >" . __('Button Type', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "</div>";
        $tablestring .= "<div class='column_opt_opts two_cols' >";
        $tablestring .= "<input type='hidden' name='arp_global_button_type' id='arp_global_button_border_type' value='" . $arp_global_button_border_type . "' />";

        $tablestring .= "<dl id='arp_global_button_border_type' class='arp_selectbox' data-id='arp_global_button_border_type' data-name='arp_global_button_border_type' style='width:141px;margin-top:18px;margin-right:15px;float:right;'>";
        $button_type[$arp_global_button_border_type]['name'] = isset($button_type[$arp_global_button_border_type]['name'])?$button_type[$arp_global_button_border_type]['name']:'';
        $tablestring .= "<dt><span>" . @$button_type[$arp_global_button_border_type]['name'] . "</span><input type='text' style='display:none;' value='" . @$button_type[$arp_global_button_border_type]['name'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul class='arp_global_button_border_type' data-id='arp_global_button_border_type'>";

        foreach ($button_type as $i => $value) {
            if ($i == 'shadow') {
                $tablestring .= "<li style='margin:0px' class='arp_selectbox_option' data-value='" . $i . "' data-label='" . $value['name'] . "'>" . $value['name'] . "</li>";
            } else {
                $tablestring .= "<li class='arplite_restricted_view' style='margin:0px' class='arp_selectbox_option' data-value='" . $i . "' data-label='" . $value['name'] . "'>" . $value['name'] . " <span class='pro_version_info'>(Pro Version)</span></li>";
            }
        }
        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";

        $tablestring .= "</div>";
        $tablestring .= "</div>";







        $tablestring .= "<div class='column_opt_opts' style='display:none;'>";

        $tablestring .= "<div class='column_opt_label column_opt_sub_label  two_cols'>" . __('Border Width', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_opts two_cols' style='display:none;'>";

        if (isset($column_settings['global_button_border_width'])) {
            $arp_global_button_border_width = $column_settings['global_button_border_width'];
        } else {
            $arp_global_button_border_width = 0;
        }

        $tablestring .= "<input type='hidden' name='arp_global_button_border_width' id='arp_global_button_border_width' value='" . $arp_global_button_border_width . "' />";

        $tablestring .= "<dl id='arp_global_button_border_width' class='arp_selectbox' data-id='arp_global_button_border_width' data-name='arp_global_button_border_width' style='width:141px;margin-top:18px;margin-right:15px;float:right;'>";

        $tablestring .= "<dt><span>" . $arp_global_button_border_width . "</span><input type='text' style='display:none;' value='" . $arp_global_button_border_width . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul class='arp_global_button_border_width' data-id='arp_global_button_border_width'>";

        for ($i = 0; $i <= 10; $i++) {
            $tablestring .= "<li style='margin:0' class='arp_selectbox_option' data-value='" . $i . "' data-label='" . $i . "'>" . $i . "</li>";
        }
        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";
        $tablestring .= "</div>";

        $tablestring .= "</div>";

        $border_style = array('solid', 'dotted', 'dashed');
        $tablestring .= "<div class='column_opt_opts'>";
        if (isset($column_settings['global_button_border_type'])) {
            $arp_global_button_border_style = $column_settings['global_button_border_type'];
        } else {
            $arp_global_button_border_style = __('solid', ARPLITE_PT_TXTDOMAIN);
        }

        $tablestring .= "<div class='column_opt_label column_opt_sub_label  two_cols' style='display:none;'>" . __('Border Style', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_opts two_cols' style='display:none;'>";

        $tablestring .= "<input type='hidden' name='arp_global_button_border_style' id='arp_global_button_border_style' value='" . $arp_global_button_border_style . "' />";

        $tablestring .= "<dl id='arp_global_button_border_style' class='arp_selectbox' data-id='arp_global_button_border_style' data-name='arp_global_button_border_style' style='width:141px;margin-top:18px;margin-right:15px;float:right;'>";

        $tablestring .= "<dt><span>" . $arp_global_button_border_style . "</span><input type='text' style='display:none;' value='" . $arp_global_button_border_style . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul class='arp_global_button_border_style' data-id='arp_global_button_border_style'>";

        foreach ($border_style as $i) {
            $tablestring .= "<li style='margin:0px' class='arp_selectbox_option' data-value='" . $i . "' data-label='" . $i . "'>" . $i . "</li>";
        }
        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";

        $tablestring .= "</div>";

        $tablestring .= "</div>";

        if (isset($column_settings['global_button_border_color']) && $column_settings['global_button_border_color']) {
            $arp_global_button_border_color = $column_settings['global_button_border_color'];
        } else {
            $arp_global_button_border_color = '#c9c9c9';
        }

        $tablestring .= "<div class='column_opt_opts' style='height: 50px;display:none;'>";

        $tablestring .= "<div class='column_opt_label column_opt_sub_label  two_cols'>" . __('Border Color', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_opts two_cols' style='margin-top:10px;'>";

        $tablestring .= "<div class='color_picker color_picker_round jscolor' data-jscolor='{hash:true,onFineChange:\"arp_update_color(this,arp_global_button_border_color)\",valueElement:arp_global_button_border_color_hidden}' jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_global_button_border_color)' jscolor-valueelement='arp_global_button_border_color_hidden' data-id='arp_global_button_border_color_hidden' data-column-id='arp_global_button_border_color' id='arp_global_button_border_color' style='background:" . $arp_global_button_border_color . ";margin-left:0px;' data-color='" . $arp_global_button_border_color . "' >";

        $tablestring .= "</div>";

        $tablestring .= "</div>";

        $tablestring .= "<input type='hidden' id='arp_global_button_border_color_hidden' name='arp_global_button_border_color' value='" . $arp_global_button_border_color . "' />";

        $tablestring .= "</div>";

        if ($reference_template === 'arplitetemplate_26') {
            $button_border_radius = "display:none;";
        } else {
            $button_border_radius = "display:block;";
        }

        $tablestring .= "<div class='column_opt_opts' style='{$button_border_radius}'>";

        $tablestring .= "<div class='column_opt_label column_opt_sub_label  two_cols'>" . __('Border Radius', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "</div>";

        if (isset($column_settings['global_button_border_radius_top_left']) && $column_settings['global_button_border_radius_top_left'] != '') {
            $global_button_border_radius_top_left = $column_settings['global_button_border_radius_top_left'];
        } else {
            $global_button_border_radius_top_left = 0;
        }

        if (isset($column_settings['global_button_border_radius_top_right']) && $column_settings['global_button_border_radius_top_right'] != '') {
            $global_button_border_radius_top_right = $column_settings['global_button_border_radius_top_right'];
        } else {
            $global_button_border_radius_top_right = 0;
        }
        if (isset($column_settings['global_button_border_radius_bottom_left']) && $column_settings['global_button_border_radius_bottom_left'] != '') {
            $global_button_border_radius_bottom_left = $column_settings['global_button_border_radius_bottom_left'];
        } else {
            $global_button_border_radius_bottom_left = 0;
        }
        if (isset($column_settings['global_button_border_radius_bottom_right']) && $column_settings['global_button_border_radius_bottom_right'] != '') {
            $global_button_border_radius_bottom_right = $column_settings['global_button_border_radius_bottom_right'];
        } else {
            $global_button_border_radius_bottom_right = 0;
        }

        $tablestring .= "<div class='column_opt_opts two_cols'>";

        $tablestring .= "<div class='arp_button_radius_main'>";

        $tablestring .= "<div>";
        $tablestring .= "<span>Left</span>";
        $tablestring .= "<input type='text' id='global_button_border_radius_top_left' value='$global_button_border_radius_top_left' class='arp_tab_txt arp_tab_column_radius_txt' name='global_button_border_radius_top_left' onBlur=\"arp_update_button_border_radius(this.value,jQuery('#global_button_border_radius_top_right').val(),jQuery('#global_button_border_radius_bottom_right').val(), jQuery('#global_button_border_radius_bottom_left').val())\" />";
        $tablestring .= "</div>";

        $tablestring .= "<div>";
        $tablestring .= "<span>Right</span>";
        $tablestring .= "<input type='text' id='global_button_border_radius_top_right' value='$global_button_border_radius_top_right' class='arp_tab_txt arp_tab_column_radius_txt' name='global_button_border_radius_top_right' onBlur=\"arp_update_button_border_radius(jQuery('#global_button_border_radius_top_left').val(),this.value,jQuery('#global_button_border_radius_bottom_right').val(), jQuery('#global_button_border_radius_bottom_left').val())\" />";
        $tablestring .= "</div>";


        $tablestring .= "<div>";
        $tablestring .= "<span>Left</span>";
        $tablestring .= "<input type='text' id='global_button_border_radius_bottom_left' value='$global_button_border_radius_bottom_left' class='arp_tab_txt arp_tab_column_radius_txt' name='global_button_border_radius_bottom_left' onBlur=\"arp_update_button_border_radius(jQuery('#global_button_border_radius_top_left').val(), jQuery('#global_button_border_radius_top_right').val(), jQuery('#global_button_border_radius_bottom_right').val(), this.value)\" />";
        $tablestring .= "</div>";

        $tablestring .= "<div>";
        $tablestring .= "<span>Right</span>";
        $tablestring .= "<input type='text' id='global_button_border_radius_bottom_right' value='$global_button_border_radius_bottom_right' class='arp_tab_txt arp_tab_column_radius_txt' name='global_button_border_radius_bottom_right' onBlur=\"arp_update_button_border_radius(jQuery('#global_button_border_radius_top_left').val(), jQuery('#global_button_border_radius_top_right').val(), this.value, jQuery('#global_button_border_radius_bottom_left').val())\" />";
        $tablestring .= "</div>";

        $tablestring .= "</div>";


        $tablestring .= "<div class='arp_button_radius_main'>";
        $tablestring .= "<div class='arp_column_radius_bottom'>";
        $tablestring .= "<span>Top</span>";
        $tablestring .= "</div>";
        $tablestring .= "<div class='arp_column_radius_bottom'>";
        $tablestring .= "<span>Bottom</span>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "</div>";

        $tablestring .= "</div>";
        $tablestring .= "<div class='column_opt_opts' style='height: 50px;$button_button_type'>";

        $tablestring .= "<div class='column_opt_label column_opt_sub_label  two_cols ' >" . __('Disable Button Hover Effect', 'ARPricelite') . "&nbsp;&nbsp;&nbsp;<br><span class='pro_version_info' style='margin-top:-12px;float: left;'>(" . __('Pro Version', 'ARPricelite') . ")</span>";

        $tablestring .= "</div>";
        $column_settings['disable_button_hover_effect'] = isset($column_settings['disable_button_hover_effect']) ? $column_settings['disable_button_hover_effect'] : "";
        $tablestring .= "<div class='column_opt_opts two_cols align_right' >";
        $tablestring .= "<input type='checkbox' name='disable_button_hover_effect' id='disable_button_hover_effect' value='1' " . checked(@$column_settings['disable_button_hover_effect'], 1, false) . " class='arp_checkbox light_bg arplite_restricted_view' />";
        $tablestring .= "</div>";


        $tablestring .= "</div>";
        $tablestring .= "<div class='column_opt_label_help' style='" . $button_button_type . "' >(" . __('You can see button hover effect at front end.', ARPLITE_PT_TXTDOMAIN) . ")</div>";
        $tablestring .= "</div>";
        /* Button Customization */

        $tablestring .= "</div>";

        $tablestring .= "</div>";

        /* Column Options End */

        /* Column Effects Start */

        $tablestring .= "<div class='general_animation_tab enable global_opts' id='column_effects' >";

        $tablestring .= "<div class='animation_dropdown'>";

        $tablestring .= "<div class='arprice_option_belt_title'>" . __("Effects", 'ARPricelite') . "&nbsp;&nbsp;&nbsp;<span class='pro_version_info'>(" . __('Pro Version', 'ARPricelite') . ")</span></div>";

        $tablestring .= "<div class='column_option_animation_dropdown' id='column_option_animation_dropdown'>";

        $tablestring .= "<img id='arplite_restricted_section' src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/effect.png' />";

        $tablestring .= "</div>";

        $tablestring .= "</div>";

        $tablestring .= "</div>";

        /* Column Effects End */

        /* Column Tooltip Start */

        $tablestring .= "<div class='general_tooltip_tab enable global_opts' id='tootip_options' >";

        $tablestring .= "<div class='tooltip_dropdown'>";

        $tablestring .= "<div class='arprice_option_belt_title'>" . __('Tooltip', 'ARPricelite') . "&nbsp;&nbsp;&nbsp;<span class='pro_version_info'>(" . __('Pro Version', 'ARPricelite') . ")</span></div>";

        $tablestring .= "<div class='column_option_tooltip_dropdown' id='column_option_tooltip_dropdown'>";

        $tablestring .= "<img id='arplite_restricted_section' src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/tooltip.png' />";

        $tablestring .= "</div>";

        $tablestring .= "</div>";

        $tablestring .= "</div>";


        /* Column Tooltip End */

        /* Custom CSS Start */

        $tablestring .= "<div class='general_custom_css_tab enable global_opts' id='custom_css_options' >";

        $tablestring .= "<div class='arprice_option_belt_title'>" . __('Custom CSS', 'ARPricelite') . "&nbsp;&nbsp;&nbsp;<span class='pro_version_info'>(" . __('Pro Version', 'ARPricelite') . ")</span></div>";

        $tablestring .= "<div class='custom_css_dropdown'>";

        $tablestring .= "<div class='column_opt_label_div two_column'>";

        $tablestring .= "<div class='column_opt_label_div'>" . __('Enter css class and style', 'ARPricelite') . "</div>";

        $tablestring .= "<div class='column_content_light_row column_opt_row '>";

        $tablestring .= "<textarea class='arp_custom_css'></textarea>";

        $tablestring .= "<button id='arp_custom_css_btn' style='float:left; margin:12px 0 0 0;' class='col_opt_btn' type='button'>" . __('Apply To Editor', 'ARPricelite') . "</button>";

        $tablestring .= "<div style='float:left; margin:17px 0 0 5px;font-size:13px;'><span style='font-weight:normal; margin-right:6px;'>(e.g.) .btn{color:#000000;}</span></div>";


        $tablestring .= "</div>";

        $tablestring .= "<div class='column_content_dark_row column_opt_row arp_no_border'>";

        $tablestring .= "<div class='column_opt_label two_cols'>" . __('CSS class info', 'ARPricelite') . "</div>";

        $tablestring .= "<div class='column_opt_opts two_cols align_right'>";

        $tablestring .= "<input type='checkbox' id='css_debug_mode' value='1' class='css_debug_mode arp_switch' name='arp_css_debug_mode' />";

        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_label' style='box-sizing: border-box;float: left; width: 100%;white-space:pre-wrap;' >"
                . "<span class='column_opt_label_help' style='line-height:normal;margin:auto;'>" . __('When you turn ON CSS Class Info, You will get an extra button by clicking on each column. By clicking on that, you will get all css class information for that particular column.', 'ARPricelite') . "</span>"
                . "</div>";

        $tablestring .= "</div>";

        $tablestring .= "</div>";

        $tablestring .= "</div>";

        $tablestring .= "</div>";

        /* Custom CSS End */

        /* Toggle Price Start */

        $tablestring .= "<div class='general_toggle_options_tab enable global_opts' id='toggle_content_options' >";

        $tablestring .= "<div class='arprice_option_belt_title'>" . __('Toggle Price', 'ARPricelite') . "&nbsp;&nbsp;&nbsp;<span class='pro_version_info'>(" . __('Pro Version', 'ARPricelite') . ")</span></div>";


        $tablestring .= "<div class='toggle_options_dropdown' style='padding-left:0;'>";
        $tablestring .= "<img id='arplite_restricted_section' src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/toggle_price.png' />";
        $tablestring .= "</div>";

        $tablestring .= "</div>";

        $tablestring .= "<div class='general_toggle_options_tab enable global_opts' id='all_font_options'>";
        $tablestring .= "<div class='arprice_option_belt_title'>" . __('Font Settings', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='font_settings_options_dropdown'>";

        $arp_font_settings = $arpricelite_default_settings->arp_font_settings();
        $arp_font_settings = $arp_font_settings[$reference_template];

        if (in_array('arp_header_font', $arp_font_settings)) {
            $arp_header_style = 'display:block;';
        } else {
            $arp_header_style = 'display:none;';
        }

        /*         * header font settings */
        $tablestring .= "<div class='column_content_light_row column_opt_row' style='" . $arp_header_style . "'>";
        $tablestring .= "<div class='column_opt_label arp_fix_height'><div class='arp_toggle_title_font_title' style='padding:0';>" . __('Header Fonts', ARPLITE_PT_TXTDOMAIN) . "</div></div>";
        $tablestring .= "<div class='column_opt_opts arp_font_family'>";
        $tablestring .= "<div class='column_opt_label'>" . __('Font Family', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='font_title_font_family_div'>";
        $tablestring .= "<input type='hidden' id='header_font_family_global' name='header_font_family_global' value='" . $general_option['column_settings']['header_font_family_global'] . "' />";
        $tablestring .= "<dl class='arp_selectbox' id='header_font_font_family_dd' data-name='header_font_font_family_dd' data-id='header_font_family_global' style=''>";
        if ($general_option['column_settings']['header_font_family_global'])
            $arp_selectbox_placeholder = $general_option['column_settings']['header_font_family_global'];
        else
            $arp_selectbox_placeholder = __('Choose Option', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "<dt><span>" . $arp_selectbox_placeholder . "</span><input type='text' style='display:none;' value='" . $general_option['column_settings']['header_font_family_global'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul class='arp_toggletitle_font_setting' data-id='header_font_family_global'>";
        $default_fonts = $arpricelite_fonts->get_default_fonts();
        $google_fonts = $arpricelite_fonts->google_fonts_list();
        $tablestring .= "<ol class='arp_selectbox_group_label'>" . __('Default Fonts', ARPLITE_PT_TXTDOMAIN) . "</ol>";
        foreach ($default_fonts as $font) {

            $tablestring .= "<li class='arp_selectbox_option' data-value='" . $font . "' data-label='" . $font . "'>" . $font . "</li>";
        }

        $tablestring .= "<ol class='arp_selectbox_group_label'>" . __('Google Fonts', ARPLITE_PT_TXTDOMAIN) . "</ol>";

        foreach ($google_fonts as $font) {

            $tablestring .= "<li class='arp_selectbox_option' data-value='" . $font . "' data-label='" . $font . "'>" . $font . "</li>";
        }

        $tablestring .= "</ul>";

        $tablestring .= "</dd>";

        $tablestring .= "</dl>";

        $tablestring .= "<div class='arp_google_font_preview_note'><a target='_blank'  class='arp_google_font_preview_link' id='header_font_family_global_font_family_preview' href='" . $googlefontpreviewurl . $general_option['column_settings']['header_font_family_global'] . "'>" . __('Font Preview', ARPLITE_PT_TXTDOMAIN) . "</a></div>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        $tablestring .= "<div class='column_opt_opts font_settings_div'>";
        $tablestring .= "<div class='column_opt_label'>" . __('Font Size', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='font_title_font_family_div'>";
        $tablestring .= "<input type='hidden' id='header_font_size_global'  name='header_font_size_global' value='" . $general_option['column_settings']['header_font_size_global'] . "' />";
        $tablestring .= "<dl class='arp_selectbox header_font_size_global_dd' data-name='header_font_size_global' data-id='header_font_size_global' style='width : 80% !important;' >";
        $tablestring .= "<dt><span>" . $general_option['column_settings']['header_font_size_global'] . "</span><input type='text' style='display:none;' value='" . $general_option['column_settings']['header_font_size_global'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";

        $size_arr = array();

        $tablestring .= "<ul data-id='header_font_size_global'>";

        for ($s = 8; $s <= 20; $s++)
            $size_arr[] = $s;
        for ($st = 22; $st <= 70; $st+=2)
            $size_arr[] = $st;

        foreach ($size_arr as $size) {
            $tablestring .= "<li data-value='" . $size . "' data-label='" . $size . "'>" . $size . "</li>";
        }
        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_opts arp_font_align'>";
        $header_text_align = isset($general_option['column_settings']['arp_header_text_alignment']) ? $general_option['column_settings']['arp_header_text_alignment'] : 'center';
        $tablestring .= $arpricelite_form->arp_create_alignment_div_new('header_text_alignment', $header_text_align, 'arp_header_text_alignment', '', 'header_section');
        $tablestring .= "</div>";

        if ($general_option['column_settings']['arp_header_text_bold_global'] == 'bold') {
            $header_title_style_bold_selected = 'selected';
        } else {
            $header_title_style_bold_selected = '';
        }

        //check selected for italic
        if ($general_option['column_settings']['arp_header_text_italic_global'] == 'italic') {
            $header_title_style_italic_selected = 'selected';
        } else {
            $header_title_style_italic_selected = '';
        }

        //check selected for underline or line-through
        if ($general_option['column_settings']['arp_header_text_decoration_global'] == 'underline') {
            $header_title_style_underline_selected = 'selected';
        } else {
            $header_title_style_underline_selected = '';
        }

        if ($general_option['column_settings']['arp_header_text_decoration_global'] == 'line-through') {
            $header_title_style_linethrough_selected = 'selected';
        } else {
            $header_title_style_linethrough_selected = '';
        }
        $tablestring .= "<div class='column_opt_opts font_style_div' style='' id='arp_header_text_style_global'>";

        $tablestring .= "<div class='font_title_font_family_div' data-level = 'header_level_options' level-id='header_button_global'>";

        $tablestring .= "<div class='arp_style_btn " . $header_title_style_bold_selected . " arptooltipster' data-align='left' title='" . __('Bold', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Bold', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_bold'>";
        $tablestring .= "<i class='fa fa-bold'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $header_title_style_italic_selected . " arptooltipster' data-align='center' title='" . __('Italic', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Italic', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_italic'>";
        $tablestring .= "<i class='fa fa-italic'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $header_title_style_underline_selected . " arptooltipster' data-align='right' title='" . __('Underline', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Underline', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_underline'>";
        $tablestring .= "<i class='fa fa-underline'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div style='margin-right:0 !important;' class='arp_style_btn " . $header_title_style_linethrough_selected . " arptooltipster' data-align='right' title='" . __('Line-through', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Line-through', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_strike'>";
        $tablestring .= "<i class='fa fa-strikethrough'></i>";
        $tablestring .= "</div>";
        $tablestring .= "<input type='hidden' id='header_style_bold_global' name='header_style_bold_global' value='" . $general_option['column_settings']['arp_header_text_bold_global'] . "' /> ";
        $tablestring .= "<input type='hidden' id='header_style_italic_global' name='header_style_italic_global' value='" . $general_option['column_settings']['arp_header_text_italic_global'] . "' /> ";
        $tablestring .= "<input type='hidden' id='header_style_decoration_global' name='header_style_decoration_global' value='" . $general_option['column_settings']['arp_header_text_decoration_global'] . "' /> ";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        /*         * header font settings */

        if (in_array('arp_desc_font', $arp_font_settings)) {
            $arp_header_style = 'display:block;';
        } else {
            $arp_header_style = 'display:none;';
        }

        /*         * Desc font settings */
        $tablestring .= "<div class='column_content_light_row column_opt_row' style='" . $arp_header_style . "'>";
        $tablestring .= "<div class='column_opt_label arp_fix_height'><div class='arp_toggle_title_font_title' style='padding:0';>" . __('Description Fonts', ARPLITE_PT_TXTDOMAIN) . "</div></div>";
        $tablestring .= "<div class='column_opt_opts arp_font_family'>";
        $tablestring .= "<div class='column_opt_label'>" . __('Font Family', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='font_title_font_family_div'>";
        $tablestring .= "<input type='hidden' id='description_font_family_global' name='description_font_family_global' value='" . $general_option['column_settings']['description_font_family_global'] . "' />";
        $tablestring .= "<dl class='arp_selectbox' id='description_font_font_family_dd' data-name='description_font_font_family_dd' data-id='description_font_family_global' style=''>";
        if ($general_option['column_settings']['description_font_family_global'])
            $arp_selectbox_placeholder = $general_option['column_settings']['description_font_family_global'];
        else
            $arp_selectbox_placeholder = __('Choose Option', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "<dt><span>" . $arp_selectbox_placeholder . "</span><input type='text' style='display:none;' value='" . $general_option['column_settings']['description_font_family_global'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul class='arp_toggletitle_font_setting' data-id='description_font_family_global'>";
        $default_fonts = $arpricelite_fonts->get_default_fonts();
        $google_fonts = $arpricelite_fonts->google_fonts_list();
        $tablestring .= "<ol class='arp_selectbox_group_label'>" . __('Default Fonts', ARPLITE_PT_TXTDOMAIN) . "</ol>";
        foreach ($default_fonts as $font) {

            $tablestring .= "<li class='arp_selectbox_option' data-value='" . $font . "' data-label='" . $font . "'>" . $font . "</li>";
        }

        $tablestring .= "<ol class='arp_selectbox_group_label'>" . __('Google Fonts', ARPLITE_PT_TXTDOMAIN) . "</ol>";

        foreach ($google_fonts as $font) {

            $tablestring .= "<li class='arp_selectbox_option' data-value='" . $font . "' data-label='" . $font . "'>" . $font . "</li>";
        }

        $tablestring .= "</ul>";

        $tablestring .= "</dd>";

        $tablestring .= "</dl>";

        $tablestring .= "<div class='arp_google_font_preview_note'><a target='_blank'  class='arp_google_font_preview_link' id='description_font_family_global_font_family_preview' href='" . $googlefontpreviewurl . $general_option['column_settings']['description_font_family_global'] . "'>" . __('Font Preview', ARPLITE_PT_TXTDOMAIN) . "</a></div>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        $tablestring .= "<div class='column_opt_opts font_settings_div'>";
        $tablestring .= "<div class='column_opt_label'>" . __('Font Size', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='font_title_font_family_div'>";
        $tablestring .= "<input type='hidden' id='description_font_size_global'  name='description_font_size_global' value='" . $general_option['column_settings']['description_font_size_global'] . "' />";
        $tablestring .= "<dl class='arp_selectbox description_font_size_global_dd' data-name='description_font_size_global' data-id='description_font_size_global' style='width : 80% !important;' >";
        $tablestring .= "<dt><span>" . $general_option['column_settings']['description_font_size_global'] . "</span><input type='text' style='display:none;' value='" . $general_option['column_settings']['description_font_size_global'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";

        $size_arr = array();

        $tablestring .= "<ul data-id='description_font_size_global'>";

        for ($s = 8; $s <= 20; $s++)
            $size_arr[] = $s;
        for ($st = 22; $st <= 70; $st+=2)
            $size_arr[] = $st;

        foreach ($size_arr as $size) {
            $tablestring .= "<li data-value='" . $size . "' data-label='" . $size . "'>" . $size . "</li>";
        }
        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_opts arp_font_align'>";
        $description_text_alignment = isset($general_option['column_settings']['arp_description_text_alignment']) ? $general_option['column_settings']['arp_description_text_alignment'] : 'center';
        $tablestring .= $arpricelite_form->arp_create_alignment_div_new('description_text_alignment', $description_text_alignment, 'arp_description_text_alignment', '', 'column_description_section');
        $tablestring .= "</div>";

        if ($general_option['column_settings']['arp_description_text_bold_global'] == 'bold') {
            $description_title_style_bold_selected = 'selected';
        } else {
            $description_title_style_bold_selected = '';
        }

        //check selected for italic
        if ($general_option['column_settings']['arp_description_text_italic_global'] == 'italic') {
            $description_title_style_italic_selected = 'selected';
        } else {
            $description_title_style_italic_selected = '';
        }

        //check selected for underline or line-through
        if ($general_option['column_settings']['arp_description_text_decoration_global'] == 'underline') {
            $description_title_style_underline_selected = 'selected';
        } else {
            $description_title_style_underline_selected = '';
        }

        if ($general_option['column_settings']['arp_description_text_decoration_global'] == 'line-through') {
            $description_title_style_linethrough_selected = 'selected';
        } else {
            $description_title_style_linethrough_selected = '';
        }
        $tablestring .= "<div class='column_opt_opts font_style_div' style='' id='arp_description_text_style_global'>";
//        $tablestring .= "<div class='column_opt_label'>" . __('Font Style', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='font_title_font_family_div' data-level = 'description_level_options' level-id='description_button_global'>";

        $tablestring .= "<div class='arp_style_btn " . $description_title_style_bold_selected . " arptooltipster' data-align='left' title='" . __('Bold', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Bold', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_bold'>";
        $tablestring .= "<i class='fa fa-bold'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $description_title_style_italic_selected . " arptooltipster' data-align='center' title='" . __('Italic', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Italic', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_italic'>";
        $tablestring .= "<i class='fa fa-italic'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $description_title_style_underline_selected . " arptooltipster' data-align='right' title='" . __('Underline', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Underline', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_underline'>";
        $tablestring .= "<i class='fa fa-underline'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div style='margin-right:0 !important;' class='arp_style_btn " . $description_title_style_linethrough_selected . " arptooltipster' data-align='right' title='" . __('Line-through', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Line-through', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_strike'>";
        $tablestring .= "<i class='fa fa-strikethrough'></i>";
        $tablestring .= "</div>";
        $tablestring .= "<input type='hidden' id='description_style_bold_global' name='description_style_bold_global' value='" . $general_option['column_settings']['arp_description_text_bold_global'] . "' /> ";
        $tablestring .= "<input type='hidden' id='description_style_italic_global' name='description_style_italic_global' value='" . $general_option['column_settings']['arp_description_text_italic_global'] . "' /> ";
        $tablestring .= "<input type='hidden' id='description_style_decoration_global' name='description_style_decoration_global' value='" . $general_option['column_settings']['arp_description_text_decoration_global'] . "' /> ";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        /*         * Desc font settings */


        if (in_array('arp_price_font', $arp_font_settings)) {
            $arp_header_style = 'display:block;';
        } else {
            $arp_header_style = 'display:none;';
        }

        /*         * price font settings */
        $tablestring .= "<div class='column_content_light_row column_opt_row' style='" . $arp_header_style . "'>";
        $tablestring .= "<div class='column_opt_label arp_fix_height'><div class='arp_toggle_title_font_title' style='padding:0';>" . __('Pricing Fonts', ARPLITE_PT_TXTDOMAIN) . "</div></div>";
        $tablestring .= "<div class='column_opt_opts arp_font_family'>";
        $tablestring .= "<div class='column_opt_label'>" . __('Font Family', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='font_title_font_family_div'>";
        $tablestring .= "<input type='hidden' id='price_font_family_global' name='price_font_family_global' value='" . $general_option['column_settings']['price_font_family_global'] . "' />";
        $tablestring .= "<dl class='arp_selectbox' id='price_font_font_family_dd' data-name='price_font_font_family_dd' data-id='price_font_family_global' style=''>";
        if ($general_option['column_settings']['price_font_family_global'])
            $arp_selectbox_placeholder = $general_option['column_settings']['price_font_family_global'];
        else
            $arp_selectbox_placeholder = __('Choose Option', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "<dt><span>" . $arp_selectbox_placeholder . "</span><input type='text' style='display:none;' value='" . $general_option['column_settings']['price_font_family_global'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul class='arp_toggletitle_font_setting' data-id='price_font_family_global'>";
        $default_fonts = $arpricelite_fonts->get_default_fonts();
        $google_fonts = $arpricelite_fonts->google_fonts_list();
        $tablestring .= "<ol class='arp_selectbox_group_label'>" . __('Default Fonts', ARPLITE_PT_TXTDOMAIN) . "</ol>";
        foreach ($default_fonts as $font) {

            $tablestring .= "<li class='arp_selectbox_option' data-value='" . $font . "' data-label='" . $font . "'>" . $font . "</li>";
        }

        $tablestring .= "<ol class='arp_selectbox_group_label'>" . __('Google Fonts', ARPLITE_PT_TXTDOMAIN) . "</ol>";

        foreach ($google_fonts as $font) {

            $tablestring .= "<li class='arp_selectbox_option' data-value='" . $font . "' data-label='" . $font . "'>" . $font . "</li>";
        }

        $tablestring .= "</ul>";

        $tablestring .= "</dd>";

        $tablestring .= "</dl>";

        $tablestring .= "<div class='arp_google_font_preview_note'><a target='_blank'  class='arp_google_font_preview_link' id='price_font_family_global_font_family_preview' href='" . $googlefontpreviewurl . $general_option['column_settings']['price_font_family_global'] . "'>" . __('Font Preview', ARPLITE_PT_TXTDOMAIN) . "</a></div>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        $tablestring .= "<div class='column_opt_opts font_settings_div'>";
        $tablestring .= "<div class='column_opt_label'>" . __('Font Size', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='font_title_font_family_div'>";
        $tablestring .= "<input type='hidden' id='price_font_size_global'  name='price_font_size_global' value='" . $general_option['column_settings']['price_font_size_global'] . "' />";
        $tablestring .= "<dl class='arp_selectbox price_font_size_global_dd' data-name='price_font_size_global' data-id='price_font_size_global' style='width : 80% !important;' >";
        $tablestring .= "<dt><span>" . $general_option['column_settings']['price_font_size_global'] . "</span><input type='text' style='display:none;' value='" . $general_option['column_settings']['price_font_size_global'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";

        $size_arr = array();

        $tablestring .= "<ul data-id='price_font_size_global'>";

        for ($s = 8; $s <= 20; $s++)
            $size_arr[] = $s;
        for ($st = 22; $st <= 70; $st+=2)
            $size_arr[] = $st;

        foreach ($size_arr as $size) {
            $tablestring .= "<li data-value='" . $size . "' data-label='" . $size . "'>" . $size . "</li>";
        }
        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_opts arp_font_align'>";
        $price_text_alignment = isset($general_option['column_settings']['arp_price_text_alignment']) ? $general_option['column_settings']['arp_price_text_alignment'] : 'center';
        $tablestring .= $arpricelite_form->arp_create_alignment_div_new('price_text_alignment', $price_text_alignment, 'arp_price_text_alignment', '', 'pricing_section');
        $tablestring .= "</div>";

        if ($general_option['column_settings']['arp_price_text_bold_global'] == 'bold') {
            $price_title_style_bold_selected = 'selected';
        } else {
            $price_title_style_bold_selected = '';
        }

        //check selected for italic
        if ($general_option['column_settings']['arp_price_text_italic_global'] == 'italic') {
            $price_title_style_italic_selected = 'selected';
        } else {
            $price_title_style_italic_selected = '';
        }

        //check selected for underline or line-through
        if ($general_option['column_settings']['arp_price_text_decoration_global'] == 'underline') {
            $price_title_style_underline_selected = 'selected';
        } else {
            $price_title_style_underline_selected = '';
        }

        if ($general_option['column_settings']['arp_price_text_decoration_global'] == 'line-through') {
            $price_title_style_linethrough_selected = 'selected';
        } else {
            $price_title_style_linethrough_selected = '';
        }
        $tablestring .= "<div class='column_opt_opts font_style_div' style='' id='arp_price_text_style_global'>";
//        $tablestring .= "<div class='column_opt_label'>" . __('Font Style', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='font_title_font_family_div' data-level = 'price_level_options' level-id='price_button_global'>";

        $tablestring .= "<div class='arp_style_btn " . $price_title_style_bold_selected . " arptooltipster' data-align='left' title='" . __('Bold', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Bold', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_bold'>";
        $tablestring .= "<i class='fa fa-bold'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $price_title_style_italic_selected . " arptooltipster' data-align='center' title='" . __('Italic', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Italic', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_italic'>";
        $tablestring .= "<i class='fa fa-italic'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $price_title_style_underline_selected . " arptooltipster' data-align='right' title='" . __('Underline', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Underline', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_underline'>";
        $tablestring .= "<i class='fa fa-underline'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div style='margin-right:0 !important;' class='arp_style_btn " . $price_title_style_linethrough_selected . " arptooltipster' data-align='right' title='" . __('Line-through', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Line-through', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_strike'>";
        $tablestring .= "<i class='fa fa-strikethrough'></i>";
        $tablestring .= "</div>";
        $tablestring .= "<input type='hidden' id='price_style_bold_global' name='price_style_bold_global' value='" . $general_option['column_settings']['arp_price_text_bold_global'] . "' /> ";
        $tablestring .= "<input type='hidden' id='price_style_italic_global' name='price_style_italic_global' value='" . $general_option['column_settings']['arp_price_text_italic_global'] . "' /> ";
        $tablestring .= "<input type='hidden' id='price_style_decoration_global' name='price_style_decoration_global' value='" . $general_option['column_settings']['arp_price_text_decoration_global'] . "' /> ";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        /*         * Price font settings */


        if (in_array('arp_body_font', $arp_font_settings)) {
            $arp_header_style = 'display:block;';
        } else {
            $arp_header_style = 'display:none;';
        }

        /*         * body font settings */
        $tablestring .= "<div class='column_content_light_row column_opt_row' style='" . $arp_header_style . "'>";
        $tablestring .= "<div class='column_opt_label arp_fix_height'><div class='arp_toggle_title_font_title' style='padding:0';>" . __('Body Fonts', ARPLITE_PT_TXTDOMAIN) . "</div></div>";
        $tablestring .= "<div class='column_opt_opts arp_font_family'>";
        $tablestring .= "<div class='column_opt_label'>" . __('Font Family', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='font_title_font_family_div'>";
        $tablestring .= "<input type='hidden' id='body_font_family_global' name='body_font_family_global' value='" . $general_option['column_settings']['body_font_family_global'] . "' />";
        $tablestring .= "<dl class='arp_selectbox' id='body_font_font_family_dd' data-name='body_font_font_family_dd' data-id='body_font_family_global' style=''>";
        if ($general_option['column_settings']['body_font_family_global'])
            $arp_selectbox_placeholder = $general_option['column_settings']['body_font_family_global'];
        else
            $arp_selectbox_placeholder = __('Choose Option', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "<dt><span>" . $arp_selectbox_placeholder . "</span><input type='text' style='display:none;' value='" . $general_option['column_settings']['body_font_family_global'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul class='arp_toggletitle_font_setting' data-id='body_font_family_global'>";
        $default_fonts = $arpricelite_fonts->get_default_fonts();
        $google_fonts = $arpricelite_fonts->google_fonts_list();
        $tablestring .= "<ol class='arp_selectbox_group_label'>" . __('Default Fonts', ARPLITE_PT_TXTDOMAIN) . "</ol>";
        foreach ($default_fonts as $font) {

            $tablestring .= "<li class='arp_selectbox_option' data-value='" . $font . "' data-label='" . $font . "'>" . $font . "</li>";
        }

        $tablestring .= "<ol class='arp_selectbox_group_label'>" . __('Google Fonts', ARPLITE_PT_TXTDOMAIN) . "</ol>";

        foreach ($google_fonts as $font) {

            $tablestring .= "<li class='arp_selectbox_option' data-value='" . $font . "' data-label='" . $font . "'>" . $font . "</li>";
        }

        $tablestring .= "</ul>";

        $tablestring .= "</dd>";

        $tablestring .= "</dl>";

        $tablestring .= "<div class='arp_google_font_preview_note'><a target='_blank'  class='arp_google_font_preview_link' id='body_font_family_global_font_family_preview' href='" . $googlefontpreviewurl . $general_option['column_settings']['body_font_family_global'] . "'>" . __('Font Preview', ARPLITE_PT_TXTDOMAIN) . "</a></div>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        $tablestring .= "<div class='column_opt_opts font_settings_div'>";
        $tablestring .= "<div class='column_opt_label'>" . __('Font Size', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='font_title_font_family_div'>";
        $tablestring .= "<input type='hidden' id='body_font_size_global'  name='body_font_size_global' value='" . $general_option['column_settings']['body_font_size_global'] . "' />";
        $tablestring .= "<dl class='arp_selectbox body_font_size_global_dd' data-name='body_font_size_global' data-id='body_font_size_global' style='width : 80% !important;' >";
        $tablestring .= "<dt><span>" . $general_option['column_settings']['body_font_size_global'] . "</span><input type='text' style='display:none;' value='" . $general_option['column_settings']['body_font_size_global'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";

        $size_arr = array();

        $tablestring .= "<ul data-id='body_font_size_global'>";

        for ($s = 8; $s <= 20; $s++)
            $size_arr[] = $s;
        for ($st = 22; $st <= 70; $st+=2)
            $size_arr[] = $st;

        foreach ($size_arr as $size) {
            $tablestring .= "<li data-value='" . $size . "' data-label='" . $size . "'>" . $size . "</li>";
        }
        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_opts arp_font_align'>";
        $body_text_alignment = isset($general_option['column_settings']['arp_body_text_alignment']) ? $general_option['column_settings']['arp_body_text_alignment'] : 'center';
        $tablestring .= $arpricelite_form->arp_create_alignment_div_new('body_text_alignment', $body_text_alignment, 'arp_body_text_alignment', '', 'body_section');
        $tablestring .= "</div>";

        if ($general_option['column_settings']['arp_body_text_bold_global'] == 'bold') {
            $body_title_style_bold_selected = 'selected';
        } else {
            $body_title_style_bold_selected = '';
        }

        //check selected for italic
        if ($general_option['column_settings']['arp_body_text_italic_global'] == 'italic') {
            $body_title_style_italic_selected = 'selected';
        } else {
            $body_title_style_italic_selected = '';
        }

        //check selected for underline or line-through
        if ($general_option['column_settings']['arp_body_text_decoration_global'] == 'underline') {
            $body_title_style_underline_selected = 'selected';
        } else {
            $body_title_style_underline_selected = '';
        }

        if ($general_option['column_settings']['arp_body_text_decoration_global'] == 'line-through') {
            $body_title_style_linethrough_selected = 'selected';
        } else {
            $body_title_style_linethrough_selected = '';
        }
        $tablestring .= "<div class='column_opt_opts font_style_div' style='' id='arp_body_text_style_global'>";
//        $tablestring .= "<div class='column_opt_label'>" . __('Font Style', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='font_title_font_family_div' data-level = 'body_level_options' level-id='body_button_global'>";

        $tablestring .= "<div class='arp_style_btn " . $body_title_style_bold_selected . " arptooltipster' data-align='left' title='" . __('Bold', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Bold', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_bold'>";
        $tablestring .= "<i class='fa fa-bold'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $body_title_style_italic_selected . " arptooltipster' data-align='center' title='" . __('Italic', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Italic', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_italic'>";
        $tablestring .= "<i class='fa fa-italic'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $body_title_style_underline_selected . " arptooltipster' data-align='right' title='" . __('Underline', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Underline', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_underline'>";
        $tablestring .= "<i class='fa fa-underline'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div style='margin-right:0 !important;' class='arp_style_btn " . $body_title_style_linethrough_selected . " arptooltipster' data-align='right' title='" . __('Line-through', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Line-through', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_strike'>";
        $tablestring .= "<i class='fa fa-strikethrough'></i>";
        $tablestring .= "</div>";
        $tablestring .= "<input type='hidden' id='body_style_bold_global' name='body_style_bold_global' value='" . $general_option['column_settings']['arp_body_text_bold_global'] . "' /> ";
        $tablestring .= "<input type='hidden' id='body_style_italic_global' name='body_style_italic_global' value='" . $general_option['column_settings']['arp_body_text_italic_global'] . "' /> ";
        $tablestring .= "<input type='hidden' id='body_style_decoration_global' name='body_style_decoration_global' value='" . $general_option['column_settings']['arp_body_text_decoration_global'] . "' /> ";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        /*         * body font settings */


        if (in_array('arp_footer_font', $arp_font_settings)) {
            $arp_header_style = 'display:block;';
        } else {
            $arp_header_style = 'display:none;';
        }

        /*         * footer font settings */
        $tablestring .= "<div class='column_content_light_row column_opt_row' style='" . $arp_header_style . "'>";
        $tablestring .= "<div class='column_opt_label arp_fix_height'><div class='arp_toggle_title_font_title' style='padding:0';>" . __('Footer Fonts', ARPLITE_PT_TXTDOMAIN) . "</div></div>";
        $tablestring .= "<div class='column_opt_opts arp_font_family'>";
        $tablestring .= "<div class='column_opt_label'>" . __('Font Family', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='font_title_font_family_div'>";
        $tablestring .= "<input type='hidden' id='footer_font_family_global' name='footer_font_family_global' value='" . $general_option['column_settings']['footer_font_family_global'] . "' />";
        $tablestring .= "<dl class='arp_selectbox' id='footer_font_font_family_dd' data-name='footer_font_font_family_dd' data-id='footer_font_family_global' style=''>";
        if ($general_option['column_settings']['footer_font_family_global'])
            $arp_selectbox_placeholder = $general_option['column_settings']['footer_font_family_global'];
        else
            $arp_selectbox_placeholder = __('Choose Option', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "<dt><span>" . $arp_selectbox_placeholder . "</span><input type='text' style='display:none;' value='" . $general_option['column_settings']['footer_font_family_global'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul class='arp_toggletitle_font_setting' data-id='footer_font_family_global'>";
        $default_fonts = $arpricelite_fonts->get_default_fonts();
        $google_fonts = $arpricelite_fonts->google_fonts_list();
        $tablestring .= "<ol class='arp_selectbox_group_label'>" . __('Default Fonts', ARPLITE_PT_TXTDOMAIN) . "</ol>";
        foreach ($default_fonts as $font) {

            $tablestring .= "<li class='arp_selectbox_option' data-value='" . $font . "' data-label='" . $font . "'>" . $font . "</li>";
        }

        $tablestring .= "<ol class='arp_selectbox_group_label'>" . __('Google Fonts', ARPLITE_PT_TXTDOMAIN) . "</ol>";

        foreach ($google_fonts as $font) {

            $tablestring .= "<li class='arp_selectbox_option' data-value='" . $font . "' data-label='" . $font . "'>" . $font . "</li>";
        }

        $tablestring .= "</ul>";

        $tablestring .= "</dd>";

        $tablestring .= "</dl>";

        $tablestring .= "<div class='arp_google_font_preview_note'><a target='_blank'  class='arp_google_font_preview_link' id='footer_font_family_global_font_family_preview' href='" . $googlefontpreviewurl . $general_option['column_settings']['footer_font_family_global'] . "'>" . __('Font Preview', ARPLITE_PT_TXTDOMAIN) . "</a></div>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        $tablestring .= "<div class='column_opt_opts font_settings_div'>";
        $tablestring .= "<div class='column_opt_label'>" . __('Font Size', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='font_title_font_family_div'>";
        $tablestring .= "<input type='hidden' id='footer_font_size_global'  name='footer_font_size_global' value='" . $general_option['column_settings']['footer_font_size_global'] . "' />";
        $tablestring .= "<dl class='arp_selectbox footer_font_size_global_dd' data-name='footer_font_size_global' data-id='footer_font_size_global' style='width : 80% !important;' >";
        $tablestring .= "<dt><span>" . $general_option['column_settings']['footer_font_size_global'] . "</span><input type='text' style='display:none;' value='" . $general_option['column_settings']['footer_font_size_global'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";

        $size_arr = array();

        $tablestring .= "<ul data-id='footer_font_size_global'>";

        for ($s = 8; $s <= 20; $s++)
            $size_arr[] = $s;
        for ($st = 22; $st <= 70; $st+=2)
            $size_arr[] = $st;

        foreach ($size_arr as $size) {
            $tablestring .= "<li data-value='" . $size . "' data-label='" . $size . "'>" . $size . "</li>";
        }
        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='column_opt_opts arp_font_align'>";
        $footer_text_alignment = isset($general_option['column_settings']['arp_footer_text_alignment']) ? $general_option['column_settings']['arp_footer_text_alignment'] : 'center';
        $tablestring .= $arpricelite_form->arp_create_alignment_div_new('footer_text_alignment', $footer_text_alignment, 'arp_footer_text_alignment', '', 'footer_section');
        $tablestring .= "</div>";

        if ($general_option['column_settings']['arp_footer_text_bold_global'] == 'bold') {
            $footer_title_style_bold_selected = 'selected';
        } else {
            $footer_title_style_bold_selected = '';
        }

        //check selected for italic
        if ($general_option['column_settings']['arp_footer_text_italic_global'] == 'italic') {
            $footer_title_style_italic_selected = 'selected';
        } else {
            $footer_title_style_italic_selected = '';
        }

        //check selected for underline or line-through
        if ($general_option['column_settings']['arp_footer_text_decoration_global'] == 'underline') {
            $footer_title_style_underline_selected = 'selected';
        } else {
            $footer_title_style_underline_selected = '';
        }

        if ($general_option['column_settings']['arp_footer_text_decoration_global'] == 'line-through') {
            $footer_title_style_linethrough_selected = 'selected';
        } else {
            $footer_title_style_linethrough_selected = '';
        }
        $tablestring .= "<div class='column_opt_opts font_style_div' style='' id='arp_footer_text_style_global'>";
//        $tablestring .= "<div class='column_opt_label'>" . __('Font Style', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='font_title_font_family_div' data-level = 'footer_level_options' level-id='footer_button_global'>";

        $tablestring .= "<div class='arp_style_btn " . $footer_title_style_bold_selected . " arptooltipster' data-align='left' title='" . __('Bold', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Bold', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_bold'>";
        $tablestring .= "<i class='fa fa-bold'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $footer_title_style_italic_selected . " arptooltipster' data-align='center' title='" . __('Italic', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Italic', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_italic'>";
        $tablestring .= "<i class='fa fa-italic'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $footer_title_style_underline_selected . " arptooltipster' data-align='right' title='" . __('Underline', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Underline', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_underline'>";
        $tablestring .= "<i class='fa fa-underline'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div style='margin-right:0 !important;' class='arp_style_btn " . $footer_title_style_linethrough_selected . " arptooltipster' data-align='right' title='" . __('Line-through', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Line-through', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_strike'>";
        $tablestring .= "<i class='fa fa-strikethrough'></i>";
        $tablestring .= "</div>";
        $tablestring .= "<input type='hidden' id='footer_style_bold_global' name='footer_style_bold_global' value='" . $general_option['column_settings']['arp_footer_text_bold_global'] . "' /> ";
        $tablestring .= "<input type='hidden' id='footer_style_italic_global' name='footer_style_italic_global' value='" . $general_option['column_settings']['arp_footer_text_italic_global'] . "' /> ";
        $tablestring .= "<input type='hidden' id='footer_style_decoration_global' name='footer_style_decoration_global' value='" . $general_option['column_settings']['arp_footer_text_decoration_global'] . "' /> ";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        /*         * footer font settings */


        if (in_array('arp_button_font', $arp_font_settings)) {
            $arp_header_style = 'display:block;';
        } else {
            $arp_header_style = 'display:none;';
        }

        /*         * footer font settings */
        $tablestring .= "<div class='column_content_light_row column_opt_row' style='" . $arp_header_style . "'>";
        $tablestring .= "<div class='column_opt_label arp_fix_height'><div class='arp_toggle_title_font_title' style='padding:0';>" . __('Button Fonts', ARPLITE_PT_TXTDOMAIN) . "</div></div>";
        $tablestring .= "<div class='column_opt_opts arp_font_family'>";
        $tablestring .= "<div class='column_opt_label'>" . __('Font Family', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='font_title_font_family_div'>";
        $tablestring .= "<input type='hidden' id='button_font_family_global' name='button_font_family_global' value='" . $general_option['column_settings']['button_font_family_global'] . "' />";
        $tablestring .= "<dl class='arp_selectbox' id='button_font_font_family_dd' data-name='button_font_font_family_dd' data-id='button_font_family_global' style=''>";
        if ($general_option['column_settings']['button_font_family_global'])
            $arp_selectbox_placeholder = $general_option['column_settings']['button_font_family_global'];
        else
            $arp_selectbox_placeholder = __('Choose Option', ARPLITE_PT_TXTDOMAIN);

        $tablestring .= "<dt><span>" . $arp_selectbox_placeholder . "</span><input type='text' style='display:none;' value='" . $general_option['column_settings']['button_font_family_global'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul class='arp_toggletitle_font_setting' data-id='button_font_family_global'>";
        $default_fonts = $arpricelite_fonts->get_default_fonts();
        $google_fonts = $arpricelite_fonts->google_fonts_list();
        $tablestring .= "<ol class='arp_selectbox_group_label'>" . __('Default Fonts', ARPLITE_PT_TXTDOMAIN) . "</ol>";
        foreach ($default_fonts as $font) {

            $tablestring .= "<li class='arp_selectbox_option' data-value='" . $font . "' data-label='" . $font . "'>" . $font . "</li>";
        }

        $tablestring .= "<ol class='arp_selectbox_group_label'>" . __('Google Fonts', ARPLITE_PT_TXTDOMAIN) . "</ol>";

        foreach ($google_fonts as $font) {

            $tablestring .= "<li class='arp_selectbox_option' data-value='" . $font . "' data-label='" . $font . "'>" . $font . "</li>";
        }

        $tablestring .= "</ul>";

        $tablestring .= "</dd>";

        $tablestring .= "</dl>";

        $tablestring .= "<div class='arp_google_font_preview_note'><a target='_blank'  class='arp_google_font_preview_link' id='button_font_family_global_font_family_preview' href='" . $googlefontpreviewurl . $general_option['column_settings']['button_font_family_global'] . "'>" . __('Font Preview', ARPLITE_PT_TXTDOMAIN) . "</a></div>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        $tablestring .= "<div class='column_opt_opts font_settings_div'>";
        $tablestring .= "<div class='column_opt_label'>" . __('Font Size', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='font_title_font_family_div'>";
        $tablestring .= "<input type='hidden' id='button_font_size_global'  name='button_font_size_global' value='" . $general_option['column_settings']['button_font_size_global'] . "' />";
        $tablestring .= "<dl class='arp_selectbox button_font_size_global_dd' data-name='button_font_size_global' data-id='button_font_size_global' style='width : 80% !important;' >";
        $tablestring .= "<dt><span>" . $general_option['column_settings']['button_font_size_global'] . "</span><input type='text' style='display:none;' value='" . $general_option['column_settings']['button_font_size_global'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";

        $size_arr = array();

        $tablestring .= "<ul data-id='button_font_size_global'>";

        for ($s = 8; $s <= 20; $s++)
            $size_arr[] = $s;
        for ($st = 22; $st <= 70; $st+=2)
            $size_arr[] = $st;

        foreach ($size_arr as $size) {
            $tablestring .= "<li data-value='" . $size . "' data-label='" . $size . "'>" . $size . "</li>";
        }
        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";



        if ($general_option['column_settings']['arp_button_text_bold_global'] == 'bold') {
            $button_title_style_bold_selected = 'selected';
        } else {
            $button_title_style_bold_selected = '';
        }

        //check selected for italic
        if ($general_option['column_settings']['arp_button_text_italic_global'] == 'italic') {
            $button_title_style_italic_selected = 'selected';
        } else {
            $button_title_style_italic_selected = '';
        }

        //check selected for underline or line-through
        if ($general_option['column_settings']['arp_button_text_decoration_global'] == 'underline') {
            $button_title_style_underline_selected = 'selected';
        } else {
            $button_title_style_underline_selected = '';
        }

        if ($general_option['column_settings']['arp_button_text_decoration_global'] == 'line-through') {
            $button_title_style_linethrough_selected = 'selected';
        } else {
            $button_title_style_linethrough_selected = '';
        }
        $tablestring .= "<div class='column_opt_opts font_style_div' style='float: right;' id='arp_button_text_style_global'>";

        $tablestring .= "<div class='font_title_font_family_div' data-level = 'button_level_options' level-id='button_level_global'>";

        $tablestring .= "<div class='arp_style_btn " . $button_title_style_bold_selected . " arptooltipster' data-align='left' title='" . __('Bold', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Bold', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_bold'>";
        $tablestring .= "<i class='fa fa-bold'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $button_title_style_italic_selected . " arptooltipster' data-align='center' title='" . __('Italic', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Italic', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_italic'>";
        $tablestring .= "<i class='fa fa-italic'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $button_title_style_underline_selected . " arptooltipster' data-align='right' title='" . __('Underline', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Underline', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_underline'>";
        $tablestring .= "<i class='fa fa-underline'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div style='margin-right:0 !important;' class='arp_style_btn " . $button_title_style_linethrough_selected . " arptooltipster' data-align='right' title='" . __('Line-through', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Line-through', ARPLITE_PT_TXTDOMAIN) . "' id='arp_style_strike'>";
        $tablestring .= "<i class='fa fa-strikethrough'></i>";
        $tablestring .= "</div>";
        $tablestring .= "<input type='hidden' id='button_style_bold_global' name='button_style_bold_global' value='" . $general_option['column_settings']['arp_button_text_bold_global'] . "' /> ";
        $tablestring .= "<input type='hidden' id='button_style_italic_global' name='button_style_italic_global' value='" . $general_option['column_settings']['arp_button_text_italic_global'] . "' /> ";
        $tablestring .= "<input type='hidden' id='button_style_decoration_global' name='button_style_decoration_global' value='" . $general_option['column_settings']['arp_button_text_decoration_global'] . "' /> ";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        /** button font settings */
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";

        /* End */

        $tablestring .= "</div>";

        global $arplite_mainoptionsarr;

        $template_feature = $arplite_mainoptionsarr['general_options']['template_options']['features'][$ref_template];

        $template_css = '';

        if ($is_template == 1) {
            $template_name = $sql->template_name;
        } else {
            $template_name = $table_id;
        }

        $tablestring .= "<style type='text/css' id='border_radius_styles'>";

        if ($column_border_radius_top_left == 0 and $column_border_radius_top_right == 0 and $column_border_radius_bottom_right == 0 and $column_border_radius_bottom_left == 0) {
            
        } else {

            if ($template_feature['is_animated'] == 0) {

                $tablestring .= ".arplitetemplate_$template_name .ArpPricingTableColumnWrapper .arp_column_content_wrapper{";

                $tablestring .= "border-radius:{$column_border_radius_top_left}px {$column_border_radius_top_right}px {$column_border_radius_bottom_right}px {$column_border_radius_bottom_left}px !important;";

                $tablestring .= "-moz-border-radius:{$column_border_radius_top_left}px {$column_border_radius_top_right}px {$column_border_radius_bottom_right}px {$column_border_radius_bottom_left}px !important;";

                $tablestring .= "-webkit-border-radius:{$column_border_radius_top_left}px {$column_border_radius_top_right}px {$column_border_radius_bottom_right}px {$column_border_radius_bottom_left}px !important;";

                $tablestring .= "-o-border-radius:{$column_border_radius_top_left}px {$column_border_radius_top_right}px {$column_border_radius_bottom_right}px {$column_border_radius_bottom_left}px  !important;";

                $tablestring .= "overflow:hidden !important;";

                $tablestring .= "}";
            } else {
                $tablestring .= ".arplitetemplate_$template_name .ArpPricingTableColumnWrapper { ";

                $tablestring .= "border-radius:{$column_border_radius_top_left}px {$column_border_radius_top_right}px {$column_border_radius_bottom_right}px {$column_border_radius_bottom_left}px !important;overflow:hidden !important;";

                $tablestring .= " -moz-border-radius:{$column_border_radius_top_left}px {$column_border_radius_top_right}px {$column_border_radius_bottom_right}px {$column_border_radius_bottom_left}px !important;overflow:hidden !important;";

                $tablestring .= "-webkit-border-radius:{$column_border_radius_top_left}px {$column_border_radius_top_right}px {$column_border_radius_bottom_right}px {$column_border_radius_bottom_left}px !important;overflow:hidden !important;";

                $tablestring .= "-o-border-radius:{$column_border_radius_top_left}px {$column_border_radius_top_right}px {$column_border_radius_bottom_right}px {$column_border_radius_bottom_left}px !important;overflow:hidden !important;";

                $tablestring .= "}";
            }
        }

        $tablestring .= "</style>";

        if ($is_template == 1) {
            if (file_exists(ARPLITE_PRICINGTABLE_DIR . '/css/templates/arplitetemplate_' . $sql->template_name . '_v' . $arpricelite_img_css_version . '.css')) {

                $template_css = @file_get_contents(ARPLITE_PRICINGTABLE_DIR . "/css/templates/arplitetemplate_" . $sql->template_name . '_v' . $arpricelite_img_css_version . ".css");

                $template_css = str_replace('../../images', ARPLITE_PRICINGTABLE_IMAGES_URL, $template_css);
            }
        } else {
            if (file_exists(ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/css/arplitetemplate_' . $id . '.css')) {

                $template_css = @file_get_contents(ARPLITE_PRICINGTABLE_UPLOAD_DIR . "/css/arplitetemplate_" . $id . ".css");
            }
        }

        $tablestring .= "<style id='arptemplatecss' type='text/css'>" . $template_css . "</style>";



        $arp_front_css = @file_get_contents(ARPLITE_PRICINGTABLE_DIR . "/css/arprice_front.css");

        $arp_front_css = str_replace('../images', ARPLITE_PRICINGTABLE_IMAGES_URL, $arp_front_css);

        $arp_front_css = str_replace('../fonts/', ARPLITE_PRICINGTABLE_URL . '/fonts/', $arp_front_css);

        $tablestring .= "<style id='arpfrontcss' type='text/css'>" . $arp_front_css . "</style>";

        $col_ord_arr = json_decode($general_settings['column_order']);


        if (isset($column_animation['is_animation']) and $column_animation['is_animation'] == 'yes' and $column_animation['is_pagination'] == 1 and ( $column_animation['pagination_position'] == 'Top' or $column_animation['pagination_position'] == 'Both' ))
            $tablestring .= "<div class='arp_pagination " . $column_animation['pagination_style'] . " arp_pagination_top' id='arp_slider_" . $id . "_pagination_top'></div>";

        $container_width = $wrapper_width_value . 'px;';
        $tablestring .= "<div class='ArpTemplate_main' id=\"ArpTemplate_main\" style='clear:both;width:$container_width'>";

        $tablestring .= "<div class='arp_width_guide_line'>";
        $tablestring .= "<div class='arp_width_guide_line_box' id='arp_width_guide_line_box'>";
        $tablestring .= $wrapper_width_value . "px";
        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "<style type='text/css' media='all'>";


        $tablestring .= $arpricelite_form->arp_render_customcss($template_name, $general_option, 0, $opts, $is_animated);

        $tablestring .= "</style>";

        $tablestring .= "<div id='arp_inlinestyle'><style>";
        $tablestring .= "</style></div> ";

        $tablestring .= "<div class='arp_inlinescript'><script type='text/javascript'>
	
</script>";

        $global_column_width = "";

        if ($column_settings['all_column_width'] && $column_settings['all_column_width'] > 0) {
            $global_column_width = 'width:' . $column_settings['all_column_width'] . 'px;';
        }


        $tablestring .= "<input type='hidden' name='template' id='arp_template' value='" . $template_settings['template'] . "' />";
        $tablestring .= "<input type='hidden' name='template_type' id='arp_template_type' value='" . $template_type . "' />";
        $tablestring .= "<input type='hidden' name='is_tbl_preview' id='is_tbl_preview' value='" . $is_tbl_preview . "' /></div>";
        $tablestring .= "<input type='hidden' name='column_level_dynamic_array' id='column_level_dynamic_array' />";

        

        $tablestring .= "<input type='hidden' id='arp_template_name' name='arp_template_name' value='arplitetemplate_" . $template_name . "' />";

        $template_id = $template_settings['template'];
        $color_scheme = 'arp' . $template_settings['skin'];
        if ($hover_type == 0 and $is_tbl_preview != 2) {
            $hover_class = 'hover_effect';
        } else if ($hover_type == 1 and $is_tbl_preview != 2) {
            $hover_class = 'shadow_effect';
        } else {
            $hover_class = 'no_effect';
        }

        $animation_class = 'no_animation';

        $slider_pagination_container = '';

        $tablestring .= "<div class='ArpPriceTable arp_admin_template_editor arplite_price_table_" . $template_name . " arplitetemplate_" . $template_name . " " . $color_scheme . " " . $slider_pagination_container . "'";


        if (isset($column_animation['is_animation']) and $column_animation['is_animation'] == 'yes' and $is_tbl_preview != 2 and $is_tbl_preview != 3) {
            $data_items = $column_animation['visible_column'] ? $column_animation['visible_column'] : 1;
            $scrolling_columns = $column_animation['scrolling_columns'] ? $column_animation['scrolling_columns'] : 1;
            $navigation = ( $column_animation['navigation'] == 1 ) ? 1 : 0;
            $autoplay = ( $column_animation['autoplay'] == 1 ) ? 1 : 0;
            $sliding_effect = $column_animation['sliding_effect'] ? $column_animation['sliding_effect'] : 'slide';
            $transition_speed = $column_animation['transition_speed'] ? $column_animation['transition_speed'] : '500';
            $hide_caption = $column_animation['hide_caption'] ? $column_animation['hide_caption'] : 0;
            $infinite = $column_animation['is_infinite'] ? $column_animation['is_infinite'] : 0;
            $easing_effect = $column_animation['easing_effect'] ? $column_animation['easing_effect'] : 'swing';

            $tablestring .= "data-animate='true' data-id='" . $table_id . "' data-items='" . $data_items . "' data-scroll='" . $scrolling_columns . "' data-autoplay='" . $autoplay . "' data-effect='" . $sliding_effect . "' data-speed='" . $transition_speed . "' data-caption='" . $hide_caption . "' data-infinite='" . $infinite . "' data-easing='" . $easing_effect . "'";
        }
        $tablestring .= ">";

        $navigation = "";
        $ref_template = $general_settings['reference_template'];

        $tablestring .= "<div id='ArpPricingTableColumns'";
        $tablestring .= ">";

        $x = 0;
        if ($opts['columns'] and count($opts['columns']) > 0) {

            $header_img = array();
            foreach ($opts['columns'] as $j => $columns) {
                if (isset($columns['arp_header_shortcode']) && $columns['arp_header_shortcode'] != '')
                    $header_img[] = 1;
                else
                    $header_img[] = 0;
            }
            $new_arr = array();
            if (is_array($col_ord_arr) && count($col_ord_arr) > 0) {
                foreach ($col_ord_arr as $key => $value) {
                    $new_value = str_replace('main_', '', $value);
                    $new_col_id = $new_value;
                    foreach ($opts['columns'] as $j => $columns) {
                        if ($new_col_id == $j) {
                            if ($columns['is_caption'] != 1) {
                                $new_arr['columns'][$new_col_id] = $columns;
                            }
                        }
                    }
                }
            } else {
                $new_arr = $opts;
            }


            foreach ($opts['columns'] as $j => $column) {
                if ($column['is_caption'] == 1) {
                    $caption_column[] = 'yes';
                } else {
                    $caption_column[] = 'no';
                }
            }
            if (in_array('yes', $caption_column)) {
                $has_caption = 1;
            } else {
                $has_caption = 0;
            }
            $column_count = 1;
            foreach ($opts['columns'] as $j => $columns) {
                if ($columns['is_caption'] == 1 and $template_feature['caption_style'] == 'default') {
                    $inlinecolumnwidth = "";
                    if ($columns["column_width"] != "") {
                        $inlinecolumnwidth = 'width:' . $columns["column_width"] . 'px';
                    } else {
                        if ($column_settings['is_responsive'] != 1) {
                            $inlinecolumnwidth = $global_column_width;
                        }
                    }
                    $column_highlight = $opts['columns'][$j]['column_highlight'];
                    if ($column_highlight && $column_highlight == 1 and $is_table_preview != 2)
                        $highlighted_column = 'column_highlight';


                    $tablestring .= "<div class='ArpPricingTableColumnWrapper no_transition  maincaptioncolumn " . $animation_class . " style_" . $j . " $shadow_style' style='";
                    if ($column_settings['hide_caption_column'] && $column_settings['hide_caption_column'] == 1) {
                        $tablestring .= "display:none;";
                    } $tablestring .= $inlinecolumnwidth . "' id='main_" . $j . "'  is_caption='1' data-template_id='" . $ref_template . "' data-level='column_level_options' data-type='caption_column_buttons' >";

                    $tablestring .= '<input type="hidden" value="1" name="caption_column_0" id="caption_column">';



                    $tablestring .= "<div class='arpplan ";
                    if ($columns['is_caption'] == 1) {
                        $tablestring .= "maincaptioncolumn";
                    } else {
                        $tablestring .= $j . " ";
                    } if ($x % 2 == 0) {
                        $tablestring .= " arpdark-bg ArpPriceTablecolumndarkbg";
                    } $tablestring .= "' style='";
                    $tablestring .= "' >";

                    $tablestring .= "<div class='planContainer'>";
                    $tablestring .= "<div class='arp_column_content_wrapper'>";

                    if (in_array(1, $header_img))
                        $header_cls = 'has_header_code';

                    $tablestring .= "<div class='arpcolumnheader " . $header_cls . "' data-column='main_" . $j . "' >";

                    if ($columns['is_caption'] == 1) {
                        if ($template_feature['caption_title'] == 'default') {
                            if ($template == 'arplitetemplate_1' && in_array(1, $header_img))
                                $header_cls = 'has_header_code';
                            else
                                $header_cls = '';

                            $tablestring .= "<div class='arpcaptiontitle " . $header_cls . "' id='column_header' data-column='main_column_0' data-template_id='" . $ref_template . "' data-level='header_level_options' data-type='caption_column_buttons'>" . do_shortcode($columns['html_content']) . "</div>";
                        }
                        else if ($template_feature['caption_title'] == 'style_1') {
                            $tablestring .= "<div class='arpcaptiontitle' id='column_header' data-template_id='" . $ref_template . "' data-level='header_level_options' data-type='caption_column_buttons' data-column='main_column_0'>
                                            	
                                                <div class='arpcaptiontitle_style_1'>" . do_shortcode($columns['html_content']) . "</div>
                                            </div>";
                        }
                    } else {
                        $tablestring .= "<div class='arppricetablecolumntitle' id='column_header' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-level='header_level_options' data-type='caption_column_buttons'>
											<div class='bestPlanTitle package_title_first toggle_step_first'>" . do_shortcode($columns['package_title']) . "</div>
                                                                                        <div class='bestPlanTitle package_title_second toggle_step_second' style='display:none;'>" . do_shortcode($columns['package_title_second']) . "</div>
                                                                                        <div class='bestPlanTitle package_title_third toggle_step_third'  style='display:none;'>" . do_shortcode($columns['package_title_third']) . "</div>
										</div>
										<div class='arppricetablecolumnprice' data-column='main_" . $j . "'>" . do_shortcode($columns['html_content']) . "</div>";
                    }

                    $tablestring .= "</div>
                        <div class='arpbody-content arppricingtablebodycontent' id='arppricingtablebodycontent' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-level='body_level_options' data-type='caption_column_buttons'>
                            <ul class='arp_opt_options arppricingtablebodyoptions' id='column_column_" . $x . "' style='text-align:" . $columns['body_text_alignment'] . "'>";

                    $r = 0;

                    $row_order = isset($opts['columns'][$j]['row_order']) ? $opts['columns'][$j]['row_order'] : "";

                    if ($row_order && is_array($row_order)) {
                        $rows = array();
                        asort($row_order);
                        $ji = 0;
                        $maxorder = max($row_order) ? max($row_order) : 0;
                        foreach ($opts['columns'][$j]['rows'] as $rowno => $row) {
                            $row_order[$rowno] = isset($row_order[$rowno]) ? $row_order[$rowno] : ($maxorder + 1);
                        }
                        foreach ($row_order as $row_id => $order_id) {
                            if ($opts['columns'][$j]['rows'][$row_id]) {
                                $rows['row_' . $ji] = $opts['columns'][$j]['rows'][$row_id];
                                $ji++;
                            }
                        }
                        $opts['columns'][$j]['rows'] = $rows;
                    }
                    $column_count++;
                    $row_count = 0;
                    for ($ri = 0; $ri <= $maxrowcount; $ri++) {
                        $rows = isset($opts['columns'][$j]['rows']['row_' . $ri]) ? $opts['columns'][$j]['rows']['row_' . $ri] : array();

                        if ($columns['is_caption'] == 1) {
                            if (($ri + 1) % 2 == 0) {
                                $cls = 'rowlightcolorstyle';
                            } else {
                                $cls = '';
                            }
                        } else {
                            if ($column_count % 2 == 0) {
                                if (($ri + 1) % 2 == 0) {
                                    $cls = 'rowdarkcolorstyle';
                                } else {
                                    $cls = '';
                                }
                            } else {
                                if (($ri + 1) % 2 == 0) {
                                    $cls = 'rowlightcolorstyle';
                                } else {
                                    $cls = '';
                                }
                            }
                        }

                        if (($ri + 1 ) % 2 == 0) {
                            $cls .= " arp_even_row";
                        } else {
                            $cls .= " arp_odd_row";
                        }
                        if ($rows['row_description'] == '') {
                            $rows['row_description'] = '';
                        }

                        $li_class = $ref_template . '_' . $j . '_row_' . $ri;
                        $tablestring .= "<li data-column='main_" . $j . "' class='arpbodyoptionrow " . $cls . " " . $li_class . " arp_" . $j . "_row_" . $row_count . "' id='arp_row_" . $ri . "' style='text-align:";
                        $tablestring .= "' data-template_id='" . $ref_template . "' data-level='body_li_level_options' data-type='caption_column_buttons' ><span class='";

                        $tablestring .= "' title='";
                        $tablestring .= "'>" . stripslashes_deep($rows['row_description']) . "</span></li>";
                        $row_count++;
                    }

                    $tablestring .= "</ul>
                        </div>";

                    //footer text class assign start.
                    $footer_hover_class = '';
                    if ($columns['footer_content'] != '' and $template_feature['has_footer_content'] == 1) {

                        $footer_hover_class .= ' has_footer_content';
                        if ($columns['footer_content_position'] == 0) {
                            $footer_hover_class .= " footer_below_content";
                        } else {
                            $footer_hover_class .= " footer_above_content";
                        }
                    } else {
                        $footer_hover_class = "";
                    }
                    //footer text class assign end.

                    if ($template_feature['button_position'] == 'default') {
                        $tablestring .= "<div class='arpcolumnfooter " . $footer_hover_class . "' data-template_id='" . $ref_template . "' data-level='footer_level_options' data-type='caption_column_buttons' id='arpcolumnfooter' data-column='main_" . $j . "'>";

                        $footer_content_below_btn = "";
                        if ($columns['footer_content'] != '' and $template_feature['has_footer_content'] == 1) {
                            $footer_content_above_btn = "display:block;";
                        } else {
                            $footer_content_above_btn = "display:none;";
                        }

                        if ($template_feature['has_footer_content'] == 1) {
                            $tablestring .= "<div class='arp_footer_content arp_btn_before_content arp_footer_caption_column' style='{$footer_content_above_btn}'>";
                            $tablestring .= $columns['footer_content'];
                            $tablestring .= "</div>";
                        }

                        if ($columns['button_text'] != '' && $columns['btn_img'] != "") {
                            $tablestring .= "<div class='arppricetablebutton' data-column='main_" . $j . "' style='text-align:center;'>
                                            <button type='button' class='bestPlanButton $arp_global_button_class arp_" . strtolower($columns['button_size']) . "_btn' id='bestPlanButton' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-level='button_options' data-type='other_columns_buttons' ";
                            if ($columns['btn_img'] != "") {
                                $tablestring .= "style='background:" . $columns['button_background_color'] . " url(" . $columns['btn_img'] . ") no-repeat !important; '";
                            } $tablestring .= ">";
                            if ($columns['btn_img'] == "") {
                                $tablestring .= "<span class='btn_content_first_step toggle_step_first'>";
                                $tablestring .= stripslashes_deep($columns['button_text']);
                                $tablestring .= "</span>";

                                $tablestring .= "<span class='btn_content_second_step toggle_step_second' style='display:none'>";
                                $tablestring .= stripslashes_deep($columns['btn_content_second']);
                                $tablestring .= "</span>";

                                $tablestring .= "<span class='btn_content_third_step toggle_step_third' style='display:none'>";
                                $tablestring .= stripslashes_deep($columns['btn_content_third']);
                                $tablestring .= "</span>";
                            } $tablestring .= "</button>";
                            $tablestring .= "</div>";
                        }

                        $tablestring .= "</div>";
                    }
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";


                    $col_no = explode('_', $j);

                    $tablestring .= "<div class='column_level_settings' id='column_level_settings_new' data-column='main_column_0'>";
                    $tablestring .= "<div class='btn-main'>";

                    $tablestring .= "<div class='arp_btn' id='column_level_options__button_1' data-level='column_level_options' style='display:none;' title='" . __('Column Settings', 'ARPricelite') . "' data-title='" . __('Column Settings', 'ARPricelite') . "' ><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/general-setting-icon.png'></div>";

                    $tablestring .= "<div class='arp_btn' id='column_level_options__button_2' data-level='column_level_options' style='display:none;' title='" . __('Background and Font Color', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Background and Font Color', ARPLITE_PT_TXTDOMAIN) . "' ><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/color_option_icon.png'></div>";

                    $tablestring .= "<div class='arp_btn action_btn' col-id=" . $col_no[1] . " data-level='column_level_options' id='delete_column' style='display:none;' title='" . __('Delete Column', 'ARPricelite') . "' data-title='" . __('Delete Column', 'ARPricelite') . "'>";
                    $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/delete-icon2.png'>";
                    /* Delete Model Window */

                    $tablestring .= "<div class='delete_column_container' id='delete_column_container_" . $col_no[1] . "'>";
                    $tablestring .= "<div class='delete_column_arrow'></div>";
                    $tablestring .= "<div class='delete_column_title'>";
                    $tablestring .= __('Are you sure want to delete this column?', 'ARPricelite');
                    $tablestring .= "</div>";
                    $tablestring .= "<div class='delete_column_buttons'>";
                    $tablestring .= "<button id='Model_Delete_Column' col-id='" . $col_no[1] . "' type='button' class='ribbon_insert_btn delete_column'>" . __('Ok', 'ARPricelite') . "</button>";
                    $tablestring .= "<button id='Model_Delete_Column' col-id='" . $col_no[1] . "' type='button' class='ribbon_cancel_btn'>" . __('Cancel', 'ARPricelite') . "</button>";
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";

                    /* Delete Model Window */
                    $tablestring .= "</div>";

                    $tablestring .= "<div class='arp_btn column_add_new_row_action_btn' id='add_new_row' data-level='column_level_options' title='" . __('Add New Row', 'ARPricelite') . "' data-title='" . __('Add New Row', 'ARPricelite') . "' data-id='" . $col_no[1] . "' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/add-icon2.png'></div>";

                    $tablestring .= "<div class='arp_btn' id='header_level_options__button_1' data-level='header_level_options' title='" . __('Header Settings', 'ARPricelite') . "' data-title='" . __('Header Settings', 'ARPricelite') . "' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/content-setting-icon.png' ></div>";

                    //caption level footer setting menu start
                    $tablestring .= "<div class='arp_btn' id='footer_level_options__button_1' data-level='footer_level_options' title='" . __("Footer General Settings", 'ARPricelite') . "' data-title='" . __("Footer General Settings", 'ARPricelite') . "' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/button-general-setting-icon.png' ></div>";
                    //caption level footer setting menu end


                    $tablestring .= "<div class='arp_btn' id='body_level_options__button_1' data-level='body_level_options' style='display:none;' title='" . __('Content Settings', 'ARPricelite') . "' data-title='" . __('Content Settings', 'ARPricelite') . "'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/general-setting-icon.png'></div>";


                    $tablestring .= "<div class='arp_btn' id='body_li_level_options__button_1' data-level='body_li_level_options' title='" . __('Description Settings', 'ARPricelite') . "' data-title='" . __('Description Settings', 'ARPricelite') . "' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/description-setting-icon.png'></div>";

                    $tablestring .= "<div class='arp_btn' id='body_li_level_options__button_2' data-level='body_li_level_options' title='" . __('Tooltip Settings', 'ARPricelite') . "' data-title='" . __('Tooltip Settings', 'ARPricelite') . "' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/tooltip_settings.png' /></div>";

                    $tablestring .= "<div class='arp_btn action_btn' id='add_new_row' data-level='body_li_level_options' title='" . __('Add New Row', 'ARPricelite') . "' data-title='" . __('Add New Row', 'ARPricelite') . "' data-id='" . $col_no[1] . "' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/add-icon2.png'></div>";
                    $tablestring .= "<div class='arp_btn action_btn' id='copy_row' alt='' data-level='body_li_level_options' title='" . __('Duplicate Row', 'ARPricelite') . "' data-title='" . __('Duplicate Row', 'ARPricelite') . "' col-id='" . $col_no[1] . "' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/duplicate-icon2.png'></div>";
                    $tablestring .= "<div class='arp_btn action_btn' id='remove_row' row-id='' data-level='body_li_level_options' title='" . __('Delete Row', 'ARPricelite') . "' data-title='" . __('Delete Row', 'ARPricelite') . "' col-id='" . $col_no[1] . "' style='display:none;'>";
                    $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/delete-icon2.png'>";
                    $tablestring .= "<div class='delete_row_container' id='delete_row_container_" . $col_no[1] . "'>";
                    $tablestring .= "<div class='delete_row_arrow'></div>";
                    $tablestring .= "<div class='delete_row_title'>";
                    $tablestring .= __('Are you sure want to delete this row?', 'ARPricelite');
                    $tablestring .= "</div>";
                    $tablestring .= "<div class='delete_row_buttons'>";
                    $tablestring .= "<button id='Model_Delete_Row_Button' col-id='" . $col_no[1] . "' type='button' class='ribbon_insert_btn delete_row' row-id=''>" . __('Ok', 'ARPricelite') . "</button>";
                    $tablestring .= "<button id='Model_Delete_Row_Button' col-id='" . $col_no[1] . "' type='button' class='ribbon_cancel_btn' row-id=''>" . __('Cancel', 'ARPricelite') . "</button>";
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";

                    $tablestring .= "</div>";

                    $tablestring .= "<div class='column_level_options'>";



                    $tablestring .= "<div class='column_option_div' level-id='column_level_options__button_1' style='display:none;'>";

                    $tablestring .= "<div class='col_opt_row' id='column_width' style='display:none;'>";
                    $tablestring .= "<div class='col_opt_title_div two_column'>" . __('width (optional)', 'ARPricelite') . "</div>";
                    $tablestring .= "<div class='col_opt_input_div two_column'>";

                    $tablestring .= "<div class='col_opt_input'>";
                    $tablestring .= "<input type='text' name='column_width_" . $col_no[1] . "' id='column_width_input' data-column='main_" . $j . "' class='col_opt_input' value='" . $columns["column_width"] . "'>";
                    $tablestring .= "<span>" . __('Px', 'ARPricelite') . "</span>";
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";


                    /* caption border size */
                    $tablestring .= "<div class='col_opt_row' id='caption_border' style='display:none;'>";

                    $tablestring .= "<div class='col_opt_title_div'>" . __('Column Borders', ARPLITE_PT_TXTDOMAIN) . "</div>";

                    $tablestring .= "<div class='col_opt_title_div two_column'>" . __('Border Size', ARPLITE_PT_TXTDOMAIN) . "</div>";
                    $tablestring .= "<div class='col_opt_input_div two_column'>";

                    $tablestring .= "<div class=''>";
                    $column_settings['arp_caption_border_size'] = isset($column_settings['arp_caption_border_size']) ? $column_settings['arp_caption_border_size'] : '';
                    $tablestring .= "<input type='hidden' name='arp_caption_border_size' id='arp_caption_border_size' value='" . $column_settings['arp_caption_border_size'] . "' />";

                    $tablestring .= "<dl id='arp_caption_border_size' class='arp_selectbox' data-id='arp_caption_border_size' data-name='arp_caption_border_size' style='margin-top: 15px; width: 101px !important;'>";

                    if ($column_settings['arp_caption_border_size']) {
                        $selected_border_size = $column_settings['arp_caption_border_size'];
                    } else {
                        $selected_border_size = "0";
                    }
                    $tablestring .= "<dt><span>" . $selected_border_size . "</span><input type='text' style='display:none;' value='" . $selected_border_size . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
                    $tablestring .= "<dd>";
                    $tablestring .= "<ul class='arp_caption_border_size' data-id='arp_caption_border_size' style='width: 117px;'>";
                    for ($i = 0; $i <= 10; $i++) {
                        $tablestring .= "<li style='margin:0' class='arp_selectbox_option' data-value='" . $i . "' data-label='" . $i . "'>" . $i . "</li>";
                    }
                    $tablestring .= "</ul>";
                    $tablestring .= "</dd>";
                    $tablestring .= "</dl>";

                    $tablestring .= "</div>";
                    $tablestring .= "</div>";

                    /* caption border Style */
                    $tablestring .= "<div class='col_opt_title_div two_column'>" . __('Border Style', ARPLITE_PT_TXTDOMAIN) . "</div>";
                    $tablestring .= "<div class='col_opt_input_div two_column'>";

                    $tablestring .= "<div class=''>";

                    $column_settings['arp_caption_border_style'] = isset($column_settings['arp_caption_border_style']) ? $column_settings['arp_caption_border_style'] : '';
                    $tablestring .= "<input type='hidden' name='arp_caption_border_style' id='arp_caption_border_style' value='" . $column_settings['arp_caption_border_style'] . "' />";

                    $tablestring .= "<dl id='arp_caption_border_style' class='arp_selectbox' data-id='arp_caption_border_style' data-name='arp_caption_border_style' style='margin-top: 15px; width: 101px !important;'>";

                    if ($column_settings['arp_caption_border_style']) {
                        $selected_border_type = $column_settings['arp_caption_border_style'];
                    } else {
                        $selected_border_type = __('Choose Option', ARPLITE_PT_TXTDOMAIN);
                    }
                    $tablestring .= "<dt style=''><span>" . $selected_border_type . "</span><input type='text' style='display:none;' value='" . $selected_border_type . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
                    $tablestring .= "<dd>";
                    $tablestring .= "<ul class='arp_caption_border_style' data-id='arp_caption_border_style' style='width: 117px;'>";

                    $tablestring .= "<li style='margin:0' class='arp_selectbox_option' data-value='solid' data-label='solid'>Solid</li>";
                    $tablestring .= "<li style='margin:0' class='arp_selectbox_option' data-value='dotted' data-label='dotted'>Dotted</li>";
                    $tablestring .= "<li style='margin:0' class='arp_selectbox_option' data-value='dashed' data-label='dashed'>Dashed</li>";

                    $tablestring .= "</ul>";
                    $tablestring .= "</dd>";
                    $tablestring .= "</dl>";

                    $tablestring .= "</div>";
                    $tablestring .= "</div>";

                    /* caption border all */
                    $tablestring .= "<div class='col_opt_title_div two_column'>" . __('Borders', ARPLITE_PT_TXTDOMAIN) . "</div>";

                    $tablestring .= "<div class='col_opt_input_div two_column' style='width:70px;'>";
                    $tablestring .= "<input type='checkbox' name='arp_caption_border_left' id='arp_caption_border_left' class='arp_checkbox light_bg' value='1' " . checked($column_settings['arp_caption_border_left'], 1, false) . " />";
                    $tablestring .= "<label class='arp_checkbox_label' style='margin:10px 5px 5px 5px;' data-for='arp_caption_border_left'> " . __('Left', ARPLITE_PT_TXTDOMAIN) . "</label>";
                    $tablestring .= "<input type='checkbox' name='arp_caption_border_right' id='arp_caption_border_right' class='arp_checkbox light_bg' value='1' " . checked($column_settings['arp_caption_border_right'], 1, false) . " />";
                    $tablestring .= "<label class='arp_checkbox_label' style='margin:10px 3px 1px 5px;' data-for='arp_caption_border_right'> " . __('Right', ARPLITE_PT_TXTDOMAIN) . "</label>";
                    $tablestring .= "<input type='checkbox' name='arp_caption_border_top' id='arp_caption_border_top' class='arp_checkbox light_bg' value='1' " . checked($column_settings['arp_caption_border_top'], 1, false) . " />";
                    $tablestring .= "<label class='arp_checkbox_label' style='margin:10px 5px 5px 5px;' data-for='arp_caption_border_top'> " . __('Top', ARPLITE_PT_TXTDOMAIN) . "</label>";
                    $tablestring .= "<input type='checkbox' name='arp_caption_border_bottom' id='arp_caption_border_bottom' class='arp_checkbox light_bg' value='1' " . checked($column_settings['arp_caption_border_bottom'], 1, false) . " />";
                    $tablestring .= "<label class='arp_checkbox_label' style='margin:10px 1px 1px 5px;' data-for='arp_caption_border_bottom'> " . __('Bottom', ARPLITE_PT_TXTDOMAIN) . "</label>";

                    $tablestring .= "</div>";
                    $tablestring .= "</div>";

//                   *** Caption Row Level Border ***

                    $tablestring .= "<div class='col_opt_row arp_ok_div' id='column_level_caption_arp_ok_div__button_1' >";
                    $tablestring .= "<div class='col_opt_btn_div'>";
                    $tablestring .= "<div class='col_opt_navigation_div'>";
                    $tablestring .= "<i class='fa fa-long-arrow-left arp_navigation_arrow' id='column_left_arrow' data-button-id='column_level_options__button_1' data-column='{$col_no[1]}'></i>&nbsp;";
                    $tablestring .= "<i class='fa fa-long-arrow-right arp_navigation_arrow' id='column_right_arrow' data-button-id='column_level_options__button_1' data-column='{$col_no[1]}'></i>&nbsp;";
                    $tablestring .= "</div>";
                    $tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
                    $tablestring .= __('Ok', 'ARPricelite');
                    $tablestring .= "</button>";
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";

                    $tablestring .= "</div>";

                    $tablestring .= "<div class='column_option_div' level-id='column_level_options__button_2' >";
                    $tablestring .="<div class='col_opt_row' id='arp_custom_color_tab_column' style='padding:0 !important;'>";
                    $tablestring .= "<div class='col_opt_title_div' style='padding:5px 5px 10px !important'>" . __('Column Color Settings (Normal State)', ARPLITE_PT_TXTDOMAIN) . "</div>";

                    $tablestring .="</div>";
                    $tablestring .='<div class="col_opt_row" id="arp_normal_custom_color_tab_column" style="padding:0 !important;">';
                    $tablestring .='<div class="col_opt_title_div two_column"></div>';
                    $tablestring .='<div class="col_opt_title_div two_column" data-id="background_color" style="padding-top:5px !important;">' . __('Background', ARPLITE_PT_TXTDOMAIN) . '</div>';
                    $tablestring .='<div class="col_opt_title_div two_column" data-id="font_color" style="padding-top:5px !important;">' . __('Text Color', ARPLITE_PT_TXTDOMAIN) . '</div>';

                    $tablestring .='<div class="col_opt_row sub_row" id="arp_header_color_div" style="display:none">';
                    $tablestring .='<div class="col_opt_title_div two_column">' . __('Header', ARPLITE_PT_TXTDOMAIN) . '</div>';
                    $tablestring .='<div class="col_opt_input_div two_column first_picker header_background_color_div" id="header_background_color_div" style="display:none;">';
                    $header_background_color_value = $columns['header_background_color'];
                    $tablestring .=$arpricelite_form->font_color_new('header_background_color_' . $col_no[1], 'main_' . $j, $header_background_color_value, 'header_background_color', $header_background_color_value, 'header_background_color', 'general_color_box_background_color');
                    $tablestring .= "</div>";
                    $tablestring .='<div class="col_opt_input_div two_column second_picker header_font_color_div" id="header_font_color_div" style="display:none;">';
                    $tablestring .=$arpricelite_form->font_color_new('header_font_color_' . $col_no[1], 'main_' . $j, $columns['header_font_color'], 'header_font_color', $columns['header_font_color']);
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";

                    $tablestring .='<div class="col_opt_row sub_row" id="arp_footer_color_div" style="display:none">';
                    $tablestring .='<div class="col_opt_title_div two_column">' . __('Footer', ARPLITE_PT_TXTDOMAIN) . '</div>';
                    $tablestring .='<div class="col_opt_input_div two_column first_picker footer_background_color_div" id="footer_background_color_div" style="display:none;">';
                    $footer_background_color = isset($columns['footer_background_color']) ? $columns['footer_background_color'] : '';
                    $tablestring .=$arpricelite_form->font_color_new("footer_bg_color_{$col_no[1]}", "main_{$j}", $footer_background_color, 'footer_background_color', $footer_background_color, 'footer_background_color_picker', '');
                    $tablestring .= "</div>";
                    $tablestring .='<div class="col_opt_input_div two_column second_picker footer_font_color_div" id="footer_font_color_div" style="display:none;">';
                    $tablestring .=$arpricelite_form->font_color_new('footer_level_options_font_color_' . $col_no[1], 'main_' . $j, $columns['footer_level_options_font_color'], 'footer_level_options_font_color', $columns['footer_level_options_font_color']);
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";


                    $tablestring .='<div class="col_opt_row" id="arp_body_background_color_div" style="padding:0 !important;">';
                    $tablestring .='<div class="col_opt_title_div">' . __("Body Row Colors", ARPLITE_PT_TXTDOMAIN) . '</div>';
                    $tablestring .='<div class="col_opt_title_div two_column"></div>';
                    $tablestring .='<div class="col_opt_title_div two_column" data-id="background_color" style="padding-top:5px !important;">' . __('Background', ARPLITE_PT_TXTDOMAIN) . '</div>';
                    $tablestring .='<div class="col_opt_title_div two_column" data-id="font_color" style="padding-top:5px !important;">' . __('Text Color', ARPLITE_PT_TXTDOMAIN) . '</div>';
                    $tablestring .='</div>';

                    $tablestring .='<div class="col_opt_row sub_row" id="arp_odd_color_div" style="display:none">';
                    $tablestring .='<div class="col_opt_title_div two_column">' . __('Odd', ARPLITE_PT_TXTDOMAIN) . '</div>';
                    $tablestring .='<div class="col_opt_input_div two_column first_picker odd_background_color_div" id="odd_background_color_div" style="display:none;">';
                    $tablestring .=$arpricelite_form->font_color_new('content_odd_color_' . $col_no[1], 'main_' . $j, $columns['content_odd_color'], 'content_odd_color', $columns['content_odd_color']);
                    $tablestring .= "</div>";
                    $tablestring .='<div class="col_opt_input_div two_column second_picker odd_font_color_div" id="odd_font_color_div" style="display:none;">';
                    $tablestring .=$arpricelite_form->font_color_new('content_font_color_' . $col_no[1], 'main_' . $j, $columns['content_font_color'], 'content_font_color', $columns['content_font_color']);
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";

                    $tablestring .='<div class="col_opt_row sub_row" id="arp_even_color_div" style="display:none">';
                    $tablestring .='<div class="col_opt_title_div two_column">' . __('Even', ARPLITE_PT_TXTDOMAIN) . '</div>';
                    $tablestring .='<div class="col_opt_input_div two_column first_picker even_background_color_div" id="even_background_color_div" style="display:none;">';
                    $tablestring .=$arpricelite_form->font_color_new('content_even_color_' . $col_no[1], 'main_' . $j, $columns['content_even_color'], 'content_even_color', $columns['content_even_color']);
                    $tablestring .= "</div>";
                    $tablestring .='<div class="col_opt_input_div two_column second_picker even_font_color_div" id="even_font_color_div" style="display:none;">';
                    $tablestring .=$arpricelite_form->font_color_new('content_even_font_color_' . $col_no[1], 'main_' . $j, $columns['content_even_font_color'], 'content_even_font_color', $columns['content_even_font_color']);
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";

                    $tablestring .='</div>';



                    $tablestring .='<div class="col_opt_row" id="arp_border_color_div" style="padding:0 !important;">';
                    $tablestring .='<div class="col_opt_title_div" style="padding-left: 7px !important;">' . __("Border Colors", ARPLITE_PT_TXTDOMAIN) . '</div>';
                    $tablestring .='<div class="col_opt_title_div two_column"></div>';
                    $tablestring .='<div class="col_opt_title_div two_column" data-id="background_color" style="padding-top:5px !important;text-align:center;">' . __('Column', ARPLITE_PT_TXTDOMAIN) . '</div>';
                    $tablestring .='<div class="col_opt_title_div two_column" data-id="font_color" style="padding-top:5px !important;text-align:center;margin-left: -12px;">' . __('Row', ARPLITE_PT_TXTDOMAIN) . '</div>';
                    $tablestring .='</div>';

                    $tablestring .='<div class="col_opt_row sub_row" id="arp_border_color_div_sub" style="display:none">';
                    $tablestring .='<div class="col_opt_title_div two_column"></div>';
                    $tablestring .='<div class="col_opt_input_div two_column first_picker column_border_color_div" id="column_border_color_div" style="display:none;">';
                    $column_settings['arp_caption_border_color'] = isset($column_settings['arp_caption_border_color']) ? $column_settings['arp_caption_border_color'] : "#c9c9c9";

                    $tablestring .= "<div class='color_picker color_picker_round jscolor' data-jscolor='{hash:true,onFineChange:\"arp_update_color(this,arp_caption_border_color)\",valueElement:arp_caption_border_color}' jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_caption_border_color)' jscolor-valueelement='arp_caption_border_color' data-id='arp_caption_border_color' data-column-id='arp_caption_border_color' id='arp_caption_border_color_div' style='background:" . $column_settings['arp_caption_border_color'] . ";' data-color='" . $column_settings['arp_caption_border_color'] . "' >";

                    $tablestring .= "</div>";
                    $tablestring .= "<input type='hidden' class='general_color_box general_color_box_font_color general_color_box_background_color' data-jscolor='{hash:true,onFineChange:\"arp_update_color(this,arp_caption_border_color)\"}' value='" . $column_settings['arp_caption_border_color'] . "' name='arp_caption_border_color' id='arp_caption_border_color' jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_caption_border_color)' value='" . $column_settings['arp_caption_border_color'] . "'/>";


                    $tablestring .= "</div>";

                    $column_settings['arp_caption_row_border_color'] = isset($column_settings['arp_caption_row_border_color']) ? $column_settings['arp_caption_row_border_color'] : "#c9c9c9";

                    $tablestring .= "<input type='hidden' id='arp_caption_row_border_color_style' />";

                    $tablestring .= "<div class='color_picker color_picker_round jscolor' data-jscolor='{hash:true,onFineChange:\"arp_update_color(this,arp_caption_row_border_color)\",valueElement:arp_caption_row_border_color}' jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_caption_row_border_color)' jscolor-valueelement='arp_caption_row_border_color' data-id='arp_caption_row_border_color' data-column-id='arp_caption_row_border_color' id='arp_caption_row_border_color_div' style='background:" . $column_settings['arp_caption_row_border_color'] . ";' data-color='" . $column_settings['arp_column_border_color'] . "' >";

                    $tablestring .= "</div>";
                    $tablestring .= "<input type='hidden' class='general_color_box general_color_box_font_color general_color_box_background_color' value='" . $column_settings['arp_caption_row_border_color'] . "' name='arp_caption_row_border_color' data-jscolor='{hash:true,onFineChange:\"arp_update_color(this,arp_caption_row_border_color)\"}' jscolor-hash='true' jscolor-onfinechange='arp_update_color(this,arp_caption_row_border_color)' id='arp_caption_row_border_color'  />";
                    $tablestring .='<div class="col_opt_input_div two_column second_picker row_border_color_div" id="row_border_color_div" style="display:none;">';

                    $tablestring .= "</div>";
                    $tablestring .= "</div>";



                    $tablestring .= "<div class='col_opt_row arp_ok_div' id='column_level_other_arp_ok_div__button_2' style='display:none;'>";
                    $tablestring .= "<div class='col_opt_btn_div'>";
                    $tablestring .= "<div class='col_opt_navigation_div'>";
                    $tablestring .= "<i class='fa fa-long-arrow-left arp_navigation_arrow' id='column_left_arrow' data-column='{$col_no[1]}' data-button-id='column_level_options__button_2'></i>&nbsp;";
                    $tablestring .= "<i class='fa fa-long-arrow-right arp_navigation_arrow' id='column_right_arrow' data-column='{$col_no[1]}' data-button-id='column_level_options__button_2'></i>&nbsp;";
                    $tablestring .= "</div>";
                    $tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
                    $tablestring .= __('Ok', ARPLITE_PT_TXTDOMAIN);
                    $tablestring .= "</button>";
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";
                    $tablestring .='</div>';


                    $tablestring .= "<div class='column_option_div' level-id='footer_level_options__button_1'>";

                    // start to add footer level column options

                    $tablestring .= "<div class='col_opt_row' id='footer_text'>";
                    $tablestring .= "<div class='col_opt_title_div two_column'>" . __('Footer Content', 'ARPricelite') . "</div>";
                    $tablestring .= "<div class='col_opt_input_div'>";

                    if ($columns['footer_content']) {
                        $footer_content_db = $columns['footer_content'];
                    } else {
                        $footer_content_db = '';
                    }

                    $tablestring .= "<textarea name='footer_content_" . $col_no[1] . "' id='footer_content' data-column='main_" . $j . "' class='col_opt_textarea' >$footer_content_db";
                    $tablestring .= "</textarea>";

                    $tablestring .= "</div>";
                    $tablestring .= "</div>";

                    $footer_text_align = isset($columns['footer_text_align']) ? $columns['footer_text_align'] : 'center';
                    $tablestring .= $arpricelite_form->arp_create_alignment_div('footer_text_alignment', $footer_text_align, 'arp_footer_text_alignment', $col_no[1], 'footer_section');

                    // Footer Background Color 
                    $footer_background_color = isset($columns["footer_background_color"]) ? $columns["footer_background_color"] : '';
                    if ($footer_background_color == '') {
                        if ($reference_template == 'arplitetemplate_1' || $reference_template == 'arplitetemplate_4' || $reference_template == 'arplitetemplate_6') {
                            $footer_background_color = $template_section_array[$reference_template][$arp_template_skin]['arp_footer_background'][0];
                        }
                    }


                    $tablestring .= "<div class='col_opt_row' id='footer_level_options_background'>";
                    $tablestring .= "<div class='col_opt_title_div two_column'>" . __('Footer Background', 'ARPricelite') . "</div>";
                    $tablestring .= "<div class='col_opt_input_div two_column'>";
                    //$tablestring .= $arpricelite_form->font_color("footer_bg_color_{$col_no[1]}", "main_{$j}", $footer_background_color, 'footer_background_color', $footer_background_color, 'footer_background_color_picker', '', true);
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";

                    // Footer Background Color

                    $tablestring .= "<div class='col_opt_row' id='footer_level_options_font_family'>";
                    $tablestring .= "<div class='col_opt_title_div'>" . __('Font Family', 'ARPricelite') . "</div>";
                    $tablestring .= "<div class='col_opt_input_div'>";

                    $tablestring .= "<input type='hidden' id='footer_level_options_font_family' name='footer_level_options_font_family_" . $col_no[1] . "' data-column='main_" . $j . "' value='" . $columns['footer_level_options_font_family'] . "' />";
                    $tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='footer_level_options_font_family_" . $col_no[1] . "' data-id='footer_level_options_font_family_" . $col_no[1] . "'>";
                    $tablestring .= "<dt><span>" . $columns['footer_level_options_font_family'] . "</span><input type='text' style='display:none;' value='" . $columns['footer_level_options_font_family'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
                    $tablestring .= "<dd>";
                    $tablestring .= "<ul data-id='footer_level_options_font_family' data-column='" . $j . "'>";
                    $tablestring .= "</ul>";
                    $tablestring .= "</dd>";
                    $tablestring .= "</dl>";
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";



                    $tablestring .= "<div class='col_opt_row' id='footer_level_options_font_size'>";
                    //font size section start 
                    $tablestring .= "<div class='btn_type_size'>";
                    $tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Size', 'ARPricelite') . "</div>";
                    $tablestring .= "<div class='col_opt_input_div two_column'>";

                    $tablestring .= "<input type='hidden' id='footer_level_options_font_size' data-column='main_" . $j . "' name='footer_level_options_font_size_" . $col_no[1] . "' value='" . $columns['footer_level_options_font_size'] . "' />";
                    $tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='footer_level_options_font_size_" . $col_no[1] . "' data-id='footer_level_options_font_size_" . $col_no[1] . "' style='width:115px;max-width:115px;'>";
                    $tablestring .= "<dt><span>" . $columns['footer_level_options_font_size'] . "</span><input type='text' style='display:none;' value='" . $columns['footer_level_options_font_size'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
                    $tablestring .= "<dd>";
                    $size_arr = array();
                    $tablestring .= "<ul data-id='footer_level_options_font_size' data-column='" . $j . "'>";
                    for ($s = 8; $s <= 20; $s++)
                        $size_arr[] = $s;
                    for ($st = 22; $st <= 70; $st+=2)
                        $size_arr[] = $st;
                    foreach ($size_arr as $size) {
                        $tablestring .= "<li data-value='" . $size . "' data-label='" . $size . "'>" . $size . "</li>";
                    }
                    $tablestring .= "</ul>";
                    $tablestring .= "</dd>";
                    $tablestring .= "</dl>";
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";


                    $tablestring .= "</div>";



                    //footer level options font style starts 
                    $tablestring .= "<div class='col_opt_row' id='footer_level_options_font_style'>";
                    $tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Style', 'ARPricelite') . "</div>";
                    $tablestring .= "<div class='col_opt_input_div' data-level='footer_level_options_font_style' level-id='footer_level_options_font_style' >";
                    //check selected for bold

                    if ($columns['footer_level_options_font_style_bold'] == 'bold') {
                        $column1_style_bold_selected = 'selected';
                    } else {
                        $column1_style_bold_selected = '';
                    }

                    //check selected for italic

                    if ($columns['footer_level_options_font_style_italic'] == 'italic') {
                        $column1_style_italic_selected = 'selected';
                    } else {
                        $column1_style_italic_selected = '';
                    }

                    //check selected for underline or line-through

                    if ($columns['footer_level_options_font_style_decoration'] == 'underline') {
                        $column1_style_underline_selected = 'selected';
                    } else {
                        $column1_style_underline_selected = '';
                    }

                    if ($columns['footer_level_options_font_style_decoration'] == 'line-through') {
                        $column1_style_linethrough_selected = 'selected';
                    } else {
                        $column1_style_linethrough_selected = '';
                    }



                    $tablestring .= "<div class='arp_style_btn " . $column1_style_bold_selected . " arptooltipster' data-align='left' title='" . __('Bold', 'ARPricelite') . "' data-title='" . __('Bold', 'ARPricelite') . "' data-column='main_" . $j . "' id='arp_style_bold' data-id='" . $col_no[1] . "'>";
                    $tablestring .= "<i class='fa fa-bold'></i>";
                    $tablestring .= "</div>";

                    $tablestring .= "<div class='arp_style_btn " . $column1_style_italic_selected . " arptooltipster' data-align='center' title='" . __('Italic', 'ARPricelite') . "' data-title='" . __('Italic', 'ARPricelite') . "' data-column='main_" . $j . "' id='arp_style_italic' data-id='" . $col_no[1] . "'>";
                    $tablestring .= "<i class='fa fa-italic'></i>";
                    $tablestring .= "</div>";

                    $tablestring .= "<div class='arp_style_btn " . $column1_style_underline_selected . " arptooltipster' data-align='right' title='" . __('Underline', 'ARPricelite') . "' data-title='" . __('Underline', 'ARPricelite') . "' data-column='main_" . $j . "' id='arp_style_underline' data-id='" . $col_no[1] . "'>";
                    $tablestring .= "<i class='fa fa-underline'></i>";
                    $tablestring .= "</div>";

                    $tablestring .= "<div class='arp_style_btn " . $column1_style_linethrough_selected . " arptooltipster' data-align='right' title='" . __('Line-through', 'ARPricelite') . "' data-title='" . __('Line-through', 'ARPricelite') . "' data-column='main_" . $j . "' id='arp_style_strike' data-id='" . $col_no[1] . "'>";
                    $tablestring .= "<i class='fa fa-strikethrough'></i>";
                    $tablestring .= "</div>";

                    $tablestring .= "<input type='hidden' id='footer_level_options_font_style_bold' name='footer_level_options_font_style_bold_" . $col_no[1] . "' value='" . $columns['footer_level_options_font_style_bold'] . "' /> ";
                    $tablestring .= "<input type='hidden' id='footer_level_options_font_style_italic' name='footer_level_options_font_style_italic_" . $col_no[1] . "' value='" . $columns['footer_level_options_font_style_italic'] . "' /> ";
                    $tablestring .= "<input type='hidden' id='footer_level_options_font_style_decoration' name='footer_level_options_font_style_decoration_" . $col_no[1] . "' value='" . $columns['footer_level_options_font_style_decoration'] . "' /> ";
                    

                    $tablestring .= "</div>";

                    //new font style btn ends

                    $tablestring .= "</div>";

                    //footer level options font style ends 



                    $tablestring .= "<div class='col_opt_row arp_ok_div' id='footer_level_options_arp_ok_div__button_1'>";
                    $tablestring .= "<div class='col_opt_btn_div'>";
                    $tablestring .= "<div class='col_opt_navigation_div'>";
                    $tablestring .= "<i class='fa fa-long-arrow-left arp_navigation_arrow' id='footer_left_arrow' data-column='{$col_no[1]}' data-button-id='footer_level_options__button_1'></i>&nbsp;";
                    $tablestring .= "<i class='fa fa-long-arrow-right arp_navigation_arrow' id='footer_right_arrow' data-column='{$col_no[1]}' data-button-id='footer_level_options__button_1'></i>&nbsp;";
                    $tablestring .= "</div>";
                    $tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
                    $tablestring .= __('Ok', 'ARPricelite');
                    $tablestring .= "</button>";
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";

                    // end footer level column options


                    $tablestring .= '</div>';


                    $tablestring .= "<div class='column_option_div' level-id='header_level_options__button_1' style='display:none;'>";

                    $tablestring .= "<div class='col_opt_row' id='column_title'>";
                    $tablestring .= "<div class='col_opt_title_div'>" . __('Column Title', 'ARPricelite') . "</div>";
                    $tablestring .= "<div class='col_opt_input_div'>";
                    $tablestring .= "<textarea name='html_content_0' id='column_title_input' class='col_opt_textarea' data-column='main_column_0'>";
                    $tablestring .= $columns['html_content'];
                    $tablestring .= "</textarea>";
                    $tablestring .= "</div>";
                    $tablestring .= "<div class='col_opt_button'>";
                    if (is_array($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['caption_column_buttons']['header_level_options__button_1'])) {
                        if (in_array('arp_object', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['caption_column_buttons']['header_level_options__button_1'])) {
                            $tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster align_left' name='add_header_object_" . $col_no[1] . "' id='add_arp_object' data-insert='column_title_input' data-column='main_" . $j . "' title='" . __('Add Media', 'ARPricelite') . "' data-title='" . __('Add Media', 'ARPricelite') . "'>";
                            $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/image-icon.png' />";

                            $tablestring .= "</button>";
                            $tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";

                            $tablestring .= "<div class='arp_add_image_container'>";
                            $tablestring .= "<div class='arp_add_image_arrow'></div>";
                            $tablestring .= "<div class='arp_add_img_content'>";

                            $tablestring .= "<div class='arp_add_img_row'>";
                            $tablestring .= "<div class='arp_add_img_label'>";
                            $tablestring .= __('Image URL', 'ARPricelite');
                            $tablestring .= "<span class='arp_model_close_btn' id='arp_add_image_container'><i class='fa fa-times'></i></span>";
                            $tablestring .= "</div>";
                            $tablestring .= "<div class='arp_add_img_option'>";
                            $tablestring .= "<input type='text' value='' class='arp_modal_txtbox img' id='arp_header_image_url' name='arp_header_image_url' />";
                            $tablestring .= "<button data-insert='header_object' data-id='arp_header_image_url' type='button' class='arp_header_object'>";
                            $tablestring .= __('Add File', 'ARPricelite');
                            $tablestring .= "</button>";
                            $tablestring .= "</div>";
                            $tablestring .= "</div>";

                            $tablestring .= "<div class='arp_add_img_row'>";
                            $tablestring .= "<div class='arp_add_img_label'>";
                            $tablestring .= __('Dimension ( height X width )', 'ARPricelite');
                            $tablestring .= "</div>";
                            $tablestring .= "<div class='arp_add_img_option'>";
                            $tablestring .= "<input type='text' class='arp_modal_txtbox' id='arp_header_image_height' name='arp_header_image_height' /><label class='arp_add_img_note'>(px)</label>";
                            $tablestring .= "<label>x</label>";
                            $tablestring .= "<input type='text' class='arp_modal_txtbox' id='arp_header_image_width' name='arp_header_image_width' /><label class='arp_add_img_note'>(px)</label>";
                            $tablestring .= "</div>";
                            $tablestring .= "</div>";

                            $tablestring .= "<div class='arp_add_img_row' style='margin-top:10px;'>";
                            $tablestring .= "<div class='arp_add_img_label'>";
                            $tablestring .= '<button type="button" onclick="arp_add_object(this);" class="arp_modal_insert_shortcode_btn" name="rpt_image_btn" id="rpt_image_btn">';
                            $tablestring .= __('Add', 'ARPricelite');
                            $tablestring .= '</button>';
                            $tablestring .= '<button type="button" style="display:none;margin-right:10px;" onclick="arp_remove_object();" class="arp_modal_insert_shortcode_btn" name="arp_remove_img_btn" id="arp_remove_img_btn">';
                            $tablestring .= __('Remove', 'ARPricelite');
                            $tablestring .= '</button>';
                            $tablestring .= "</div>";
                            $tablestring .= "</div>";

                            $tablestring .= "</div>";
                            $tablestring .= "</div>";
                        }
                    }
                    if (is_array($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['caption_column_buttons']['header_level_options__button_1'])) {
                        if (in_array('arp_fontawesome', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['caption_column_buttons']['header_level_options__button_1'])) {

                            $tablestring .= "<button type='button' class='col_opt_btn_icon add_header_fontawesome arptooltipster align_left' name='add_header_fontawesome_" . $col_no[1] . "' id='add_header_fontawesome' data-insert='column_title_input' data-column='main_" . $j . "' title='" . __('Add Font Icon', 'ARPricelite') . "' data-title='" . __('Add Font Icon', 'ARPricelite') . "' >";
                            $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/font-awesome-icon.png' />";
                            $tablestring .= "</button>";
                        }
                    }
                    $tablestring .= "<div class='arp_font_awesome_model_box_container'>";

                    $tablestring .= "</div>";
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";
                    $header_text_align = isset($columns['header_font_align']) ? $columns['header_font_align'] : 'center';
                    $tablestring .= $arpricelite_form->arp_create_alignment_div('header_text_alignment', $header_text_align, 'arp_header_text_alignment', $col_no[1], 'header_section');

                    if (isset($columns['header_background_color']) && $columns['header_background_color'] != '') {
                        $header_background_color_value = $columns['header_background_color'];
                    } else {
                        $header_background_color_value = "#ffffff";
                    }

                    $tablestring .= "<div class='col_opt_row' id='header_caption_background_color'>";
                    $tablestring .= "<div class='col_opt_title_div two_column'>" . __('Background Color', 'ARPricelite') . "</div>";
                    $tablestring .= "<div class='col_opt_input_div two_column'>";
                   // $tablestring .= $arpricelite_form->font_color('header_background_color_' . $col_no[1], 'main_' . $j, $header_background_color_value, 'header_background_color', $header_background_color_value, 'background_column_picker', 'general_color_box_background_color', true);
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";

                    $tablestring .= "<div class='col_opt_row' id='header_caption_font_family'>";
                    $tablestring .= "<div class='col_opt_title_div'>" . __('Font Family', 'ARPricelite') . "</div>";
                    $tablestring .= "<div class='col_opt_input_div'>";

                    $tablestring .= "<input type='hidden' id='header_font_family' name='header_font_family_" . $col_no[1] . "' data-column='main_" . $j . "' value='" . $columns['header_font_family'] . "' />";
                    $tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='header_font_family_" . $col_no[1] . "' data-id='header_font_family_" . $col_no[1] . "'>";
                    $tablestring .= "<dt><span>" . $columns['header_font_family'] . "</span><input type='text' style='display:none;' value='" . $columns['header_font_family'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
                    $tablestring .= "<dd>";
                    $tablestring .= "<ul data-id='header_font_family' data-column='" . $j . "'>";

                    $tablestring .= "</ul>";
                    $tablestring .= "</dd>";
                    $tablestring .= "</dl>";
                    $tablestring .= "<div class='arp_google_font_preview_note'><a target='_blank'  class='arp_google_font_preview_link' id='arp_caption_header_font_family_preview' href='" . $googlefontpreviewurl . $columns['header_font_family'] . "'>" . __('Font Preview', 'ARPricelite') . "</a></div>";
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";

                    $tablestring .= "<div class='col_opt_row' id='header_caption_font_size'>";
                    $tablestring .= "<div class='btn_type_size'>";
                    $tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Size', 'ARPricelite') . "</div>";
                    $tablestring .= "<div class='col_opt_input_div two_column'>";

                    $tablestring .= "<input type='hidden' id='header_font_size' name='header_font_size_" . $col_no[1] . "' data-column='main_" . $j . "' value='" . $columns['header_font_size'] . "' />";
                    $tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='header_font_size_" . $col_no[1] . "' data-id='header_font_size_" . $col_no[1] . "' style='width:115px;max-width:115px;'>";
                    $tablestring .= "<dt><span>" . $columns['header_font_size'] . "</span><input type='text' style='display:none;' value='" . $columns['header_font_size'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
                    $tablestring .= "<dd>";
                    $size_arr = array();
                    $tablestring .= "<ul data-id='header_font_size' data-column='" . $j . "'>";
                    for ($s = 8; $s <= 20; $s++)
                        $size_arr[] = $s;
                    for ($st = 22; $st <= 70; $st+=2)
                        $size_arr[] = $st;
                    foreach ($size_arr as $size) {
                        $tablestring .= "<li data-value='" . $size . "' data-label='" . $size . "'>" . $size . "</li>";
                    }
                    $tablestring .= "</ul>";
                    $tablestring .= "</dd>";
                    $tablestring .= "</dl>";
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";

                    $tablestring .= "</div>";

                    $tablestring .= "<div class='col_opt_row' id='header_caption_font_color'>";
                    $tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Style', 'ARPricelite') . "</div>";


                    $tablestring .= "<div class='col_opt_input_div' data-level='header_level_options' level-id='header_button1' >";



                    $tablestring .= "<div class='arp_style_btn arptooltipster " . ($columns['header_style_bold'] == 'bold' ? 'selected' : '') . "' title='".__('Bold','ARPricelite')."' data-title='".__('Bold','ARPricelite')."' data-align='left' data-column='main_" . $j . "' id='arp_style_bold' data-id='" . $col_no[1] . "'>";
                    $tablestring .= "<i class='fa fa-bold'></i>";
                    $tablestring .= "</div>";

                    $tablestring .= "<div class='arp_style_btn arptooltipster " . ($columns['header_style_italic'] == 'italic' ? 'selected' : '') . "' title='".__('Italic','ARPricelite')."' data-title='".__('Italic','ARPricelite')."' data-align='center' data-column='main_" . $j . "' id='arp_style_italic' data-id='" . $col_no[1] . "'>";
                    $tablestring .= "<i class='fa fa-italic'></i>";
                    $tablestring .= "</div>";

                    $tablestring .= "<div class='arp_style_btn arptooltipster " . ($columns['header_style_decoration'] == 'underline' ? 'selected' : '') . "' title='".__('Underline','ARPricelite')."' data-title='".__('Underline','ARPricelite')."' data-align='right' data-column='main_" . $j . "' id='arp_style_underline' data-id='" . $col_no[1] . "'>";
                    $tablestring .= "<i class='fa fa-underline'></i>";
                    $tablestring .= "</div>";

                    $tablestring .= "<div class='arp_style_btn arptooltipster " . ($columns['header_style_decoration'] == 'line-through' ? 'selected' : '') . "' title='".__('Line-through','ARPricelite')."' data-title='".__('Line-through','ARPricelite')."' data-align='right' data-column='main_" . $j . "' id='arp_style_strike' data-id='" . $col_no[1] . "'>";
                    $tablestring .= "<i class='fa fa-strikethrough'></i>";
                    $tablestring .= "</div>";



                    $tablestring .= "<input type='hidden' id='header_style_bold' name='header_style_bold_" . $col_no[1] . "' value='" . $columns['header_style_bold'] . "' /> ";
                    $tablestring .= "<input type='hidden' id='header_style_italic' name='header_style_italic_" . $col_no[1] . "' value='" . $columns['header_style_italic'] . "' /> ";
                    $tablestring .= "<input type='hidden' id='header_style_decoration' name='header_style_decoration_" . $col_no[1] . "' value='" . $columns['header_style_decoration'] . "' /> ";



                    $tablestring .= "</div>";


                    $tablestring .= "</div>";

                    $tablestring .= "<div class='col_opt_row arp_ok_div' id='header_level_caption_arp_ok_div__button_1' >";
                    $tablestring .= "<div class='col_opt_btn_div'>";
                    $tablestring .= "<div class='col_opt_navigation_div'>";
                    $tablestring .= "<i class='fa fa-long-arrow-left arp_navigation_arrow' id='header_left_arrow' data-button-id='header_level_options__button_1' data-column='{$col_no[1]}'></i>&nbsp;";
                    $tablestring .= "<i class='fa fa-long-arrow-right arp_navigation_arrow' id='header_right_arrow' data-button-id='header_level_options__button_1' data-column='{$col_no[1]}'></i>&nbsp;";
                    $tablestring .= "</div>";
                    $tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
                    $tablestring .= __('Ok', 'ARPricelite');
                    $tablestring .= "</button>";
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";

                    $tablestring .= "</div>";




                    $tablestring .= "<div class='column_option_div' level-id='body_level_options__button_1' style='display:none;'>";

                    $tablestring .= "<div class='col_opt_row' id='text_alignment'>";
                    $tablestring .= "<div class='col_opt_title_div'>" . __('Text Alignment', 'ARPricelite') . "</div>";
                    $tablestring .= "<div class='col_opt_input_div'>";

                    $alignment = $columns['body_text_alignment'];

                    $left_selected = ($alignment == 'left') ? 'align_selected' : '';
                    $center_selected = ($alignment == 'center') ? 'align_selected' : '';
                    $right_selected = ($alignment == 'right') ? 'align_selected' : '';

                    $tablestring .= "<div class='alignment_btn align_left_btn " . $left_selected . "' data-align='left' id='align_left_btn' data-id='" . $col_no[1] . "'>";
                    $tablestring .= "<i class='fa fa-align-left fa-flip-vertical'></i>";
                    $tablestring .= "</div>";

                    $tablestring .= "<div class='alignment_btn align_center_btn " . $center_selected . "' data-align='center' id='align_center_btn' data-id='" . $col_no[1] . "'>";
                    $tablestring .= "<i class='fa fa-align-center fa-flip-vertical'></i>";
                    $tablestring .= "</div>";

                    $tablestring .= "<div class='alignment_btn align_right_btn " . $right_selected . "' data-align='right' id='align_right_btn' data-id='" . $col_no[1] . "'>";
                    $tablestring .= "<i class='fa fa-align-right fa-flip-vertical'></i>";
                    $tablestring .= "</div>";

                    $tablestring .= "<input type='hidden' id='body_text_alignment' value='" . $alignment . "' name='body_text_alignment_" . $col_no[1] . "'>";

                    $tablestring .= "</div>";
                    $tablestring .= "</div>";

                    $tablestring .= "<div class='col_opt_row' id='body_li_caption_alternate_bgcolor'>";

//                    if (isset($columns['content_odd_color']) && $columns['content_odd_color'] != '') {
//                        $columns['content_odd_color'] = $columns['content_odd_color'];
//                    } 
//                    else {
//                        $columns['content_odd_color'] = $template_section_array[$reference_template][$arp_template_skin]['arp_body_odd_row_background_color'][0];
//                    }

                    $tablestring .= "<div class='btn_type_size'>";
                    $tablestring .= "<div class='col_opt_title_div two_column'>";
                    $tablestring .= __('Odd Background', 'ARPricelite');
                    $tablestring .= "</div>";
                    $tablestring .= "<div class='col_opt_input_div two_column'>";
//                    $tablestring .= $arpricelite_form->font_color('content_odd_color_' . $col_no[1], 'main_' . $j, $columns['content_odd_color'], 'content_odd_color', $columns['content_odd_color'], '', '', true);
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";

                    $tablestring .= "<div class='btn_type_size'>";
                    $tablestring .= "<div class='col_opt_title_div two_column'>";
                    $tablestring .= __('Even Background', 'ARPricelite');
                    $tablestring .= "</div>";
                    $tablestring .= "<div class='col_opt_input_div two_column'>";
                    $columns['content_even_color'] = '';
                    if (isset($columns['content_even_color']) && $columns['content_even_color'] != '') {
                        $columns['content_even_color'] = $columns['content_even_color'];
                    } 

//                    $tablestring .= $arpricelite_form->font_color('content_even_color_' . $col_no[1], 'main_' . $j, $columns['content_even_color'], 'content_even_color', $columns['content_even_color'], '', '', true);
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";

                    $tablestring .= "</div>";

                    $tablestring .= "<div class='col_opt_row' id='body_li_caption_font_family'>";
                    $tablestring .= "<div class='col_opt_title_div'>" . __('Font Family', 'ARPricelite') . "</div>";
                    $tablestring .= "<div class='col_opt_input_div'>";

                    $tablestring .= "<input type='hidden' id='content_font_family' name='content_font_family_" . $col_no[1] . "' value='" . $columns['content_font_family'] . "' data-column='main_" . $j . "' />";
                    $tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='content_font_family_" . $col_no[1] . "' data-id='content_font_family_" . $col_no[1] . "'>";
                    $tablestring .= "<dt><span>" . $columns['content_font_family'] . "</span><input type='text' style='display:none;' value='" . $columns['content_font_family'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
                    $tablestring .= "<dd>";
                    $tablestring .= "<ul data-id='content_font_family' data-column='" . $j . "'>";

                    $tablestring .= "</ul>";
                    $tablestring .= "</dd>";
                    $tablestring .= "</dl>";
                    $tablestring .= "<div class='arp_google_font_preview_note'><a target='_blank'  class='arp_google_font_preview_link' id='arp_content_font_family_preview' href='" . $googlefontpreviewurl . $columns['content_font_family'] . "'>" . __('Font Preview', 'ARPricelite') . "</a></div>";
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";


                    $tablestring .= "<div class='col_opt_row' id='body_li_caption_font_size'>";
                    $tablestring .= "<div class='btn_type_size'>";
                    $tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Size', 'ARPricelite') . "</div>";
                    $tablestring .= "<div class='col_opt_input_div two_column'>";

                    $tablestring .= "<input type='hidden' id='content_font_size' name='content_font_size_" . $col_no[1] . "' data-column='main_" . $j . "' value='" . $columns['content_font_size'] . "' />";
                    $tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='content_font_size_" . $col_no[1] . "' data-id='content_font_size_" . $col_no[1] . "' style='width:115px;max-width:115px;'>";
                    $tablestring .= "<dt><span>" . $columns['content_font_size'] . "</span><input type='text' style='display:none;' value='" . $columns['content_font_size'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
                    $tablestring .= "<dd>";
                    $size_arr = array();
                    $tablestring .= "<ul data-id='content_font_size' data-column='" . $j . "'>";
                    for ($s = 8; $s <= 20; $s++)
                        $size_arr[] = $s;
                    for ($st = 22; $st <= 70; $st+=2)
                        $size_arr[] = $st;
                    foreach ($size_arr as $size) {
                        $tablestring .= "<li data-value='" . $size . "' data-label='" . $size . "'>" . $size . "</li>";
                    }
                    $tablestring .= "</ul>";
                    $tablestring .= "</dd>";
                    $tablestring .= "</dl>";
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";

                    $tablestring .= "</div>";

                    $tablestring .= "<div class='col_opt_row arp_ok_div' id='body_level_caption_arp_ok_div__button_1' >";
                    $tablestring .= "<div class='col_opt_btn_div'>";
                    $tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
                    $tablestring .= __('Ok', 'ARPricelite');
                    $tablestring .= "</button>";
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";

                    $tablestring .= "</div>";


                    $tablestring .= "<input type='hidden' id='total_rows' value='" . count($columns['rows']) . "' name='total_rows_" . $col_no[1] . "' />";

                    $tablestring .= "<div class='column_option_div' level-id='body_li_level_options__button_1' style='display:none;'>";

                    foreach ($columns['rows'] as $n => $row) {
                        $row_no = explode('_', $n);
                        $splitedid = explode('_', $n);



                        $tablestring .= "<div class='arp_row_wrapper' id='arp_" . $n . "' style='display:none;'>";

                        $tablestring .= "<div class='col_opt_row arp_" . $n . "' id='description" . $splitedid[1] . "' >";
                        $tablestring .= "<div class='col_opt_title_div'>" . __('Description', 'ARPricelite') . "</div>";
                        $tablestring .= "<div class='col_opt_input_div'>";
                        $tablestring .= "<textarea id='arp_li_description' col-id=" . $col_no[1] . " class='col_opt_textarea' name='row_" . $col_no[1] . "_description_" . $row_no[1] . "'>";
                        $tablestring .= stripslashes_deep($row['row_description']);
                        $tablestring .= "</textarea>";
                        $tablestring .= "</div>";

                        if ($row['row_des_style_bold'] == 'bold') {
                            $bodylevel_li_style_bold_selected = 'selected';
                        } else {
                            $bodylevel_li_style_bold_selected = '';
                        }

//check selected for italic

                        if ($row['row_des_style_italic'] == 'italic') {
                            $bodylevel_li_style_italic_selected = 'selected';
                        } else {
                            $bodylevel_li_style_italic_selected = '';
                        }

//check selected for underline or line-through

                        if ($row['row_des_style_decoration'] == 'underline') {
                            $bodylevel_li_style_underline_selected = 'selected';
                        } else {
                            $bodylevel_li_style_underline_selected = '';
                        }

                        if ($row['row_des_style_decoration'] == 'line-through') {
                            $bodylevel_li_style_linethrough_selected = 'selected';
                        } else {
                            $bodylevel_li_style_linethrough_selected = '';
                        }

                        $tablestring .= "</div>";

                        $tablestring .= "<div class='col_opt_row arp_" . $n . "' id='body_li_add_shortcode" . $splitedid[1] . "' >";
                        $tablestring .= "<div class='col_opt_btn_div'>";

                        $tablestring .= "<button type='button' class='col_opt_btn_icon arp_add_row_object arptooltipster align_left' name='" . $col_no[1] . "_add_body_li_object_" . $row_no[1] . "' id='arp_add_row_object' data-insert='arp_" . $n . " textarea#arp_li_description' data-column='main_" . $j . "' title='" . __('Add Media', 'ARPricelite') . "' data- title='" . __('Add Media', 'ARPricelite') . "'>";
                        $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/image-icon.png' />";
                        $tablestring .= "</button>";

                        $tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";

                        $tablestring .= "<div class='arp_add_image_container'>";
                        $tablestring .= "<div class='arp_add_image_arrow'></div>";
                        $tablestring .= "<div class='arp_add_img_content'>";

                        $tablestring .= "<div class='arp_add_img_row'>";
                        $tablestring .= "<div class='arp_add_img_label'>";
                        $tablestring .= __('Image URL', 'ARPricelite');
                        $tablestring .= "<span class='arp_model_close_btn' id='arp_add_image_container'><i class='fa fa-times'></i></span>";
                        $tablestring .= "</div>";
                        $tablestring .= "<div class='arp_add_img_option'>";
                        $tablestring .= "<input type='text' value='' class='arp_modal_txtbox img' id='arp_header_image_url' name='arp_header_image_url' />";
                        $tablestring .= "<button data-insert='header_object' data-id='arp_header_image_url' type='button' class='arp_header_object'>";
                        $tablestring .= __('Add File', 'ARPricelite');
                        $tablestring .= "</button>";
                        $tablestring .= "</div>";
                        $tablestring .= "</div>";

                        $tablestring .= "<div class='arp_add_img_row'>";
                        $tablestring .= "<div class='arp_add_img_label'>";
                        $tablestring .= __('Dimension ( height X width )', 'ARPricelite');
                        $tablestring .= "</div>";
                        $tablestring .= "<div class='arp_add_img_option'>";
                        $tablestring .= "<input type='text' class='arp_modal_txtbox' id='arp_header_image_height' name='arp_header_image_height' /><label class='arp_add_img_note'>(px)</label>";
                        $tablestring .= "<label>x</label>";
                        $tablestring .= "<input type='text' class='arp_modal_txtbox' id='arp_header_image_width' name='arp_header_image_width' /><label class='arp_add_img_note'>(px)</label>";
                        $tablestring .= "</div>";
                        $tablestring .= "</div>";

                        $tablestring .= "<div class='arp_add_img_row' style='margin-top:10px;'>";
                        $tablestring .= "<div class='arp_add_img_label'>";
                        $tablestring .= '<button type="button" onclick="arp_add_object(this);" class="arp_modal_insert_shortcode_btn" name="rpt_image_btn" id="rpt_image_btn">';
                        $tablestring .= __('Add', 'ARPricelite');
                        $tablestring .= '</button>';
                        $tablestring .= '<button type="button" style="display:none;margin-right:10px;" onclick="arp_remove_object();" class="arp_modal_insert_shortcode_btn" name="arp_remove_img_btn" id="arp_remove_img_btn">';
                        $tablestring .= __('Remove', 'ARPricelite');
                        $tablestring .= '</button>';
                        $tablestring .= "</div>";
                        $tablestring .= "</div>";

                        $tablestring .= "</div>";
                        $tablestring .= "</div>";


                        $tablestring .= "<button type='button' class='col_opt_btn_icon align_left arptooltipster arp_add_row_shortcode' id='arp_add_row_shortcode' name='row_" . $col_no[1] . "_add_description_shortcode_btn_" . $row_no[1] . "' col-id=" . $col_no[1] . " data-id='" . $col_no[1] . "' data-row-id='' title='" . __('Add Font Icon', 'ARPricelite') . "' data-title='" . __('Add Font Icon', 'ARPricelite') . "' >";
                        $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/font-awesome-icon.png' />";
                        $tablestring .= "</button>";


                        $tablestring .= "<div class='arp_font_awesome_model_box_container'>";
                       
                        $tablestring .= "</div>";

                        $tablestring .= "</div>";
                        $tablestring .= "</div>";

                        /* Custom CSS Row Level */
                        $tablestring .= "<div class='col_opt_row arplite_restricted_section arp_" . $n . "' id='row_level_custom_css" . $splitedid[1] . "'>";
                        $tablestring .= "<div class='col_opt_title_div'>" . __('Custom Css', ARPLITE_PT_TXTDOMAIN) . "&nbsp;<span class='pro_version_info'>(Pro Version)</span></div>";
                        $tablestring .= "<div class='col_opt_input_div'>";
                        $tablestring .= "<ul class='column_tabs_row_css' id='column_tabs_row_css_" . $row_no[1] . "'>";
                        $tablestring .= "<li class='option_title selected' id='normal_css' data-column='" . $col_no[1] . "' onClick='arp_row_css_tabs_select(\"normal_css\", \"hover_css\",\"$col_no[1]\",\"$row_no[1]\")'>" . __('Normal State', ARPLITE_PT_TXTDOMAIN) . "</li>";
                        $tablestring .= "<li class='option_title' id='hover_css' data-column='" . $col_no[1] . "' onClick='arp_row_css_tabs_select(\"hover_css\", \"normal_css\",\"$col_no[1]\",\"$row_no[1]\")'>" . __('Hover State', ARPLITE_PT_TXTDOMAIN) . "</li>";
                        $tablestring .= "</ul>";
                        $tablestring .= "<textarea id='arp_row_level_custom_css' col-id=" . $col_no[1] . " row-id='" . $row_no[1] . "' class='col_opt_textarea' name='row_" . $col_no[1] . "_custom_css_" . $row_no[1] . "'>";
                        $tablestring .= "</textarea>";
                        $tablestring .= "<textarea id='arp_row_level_hover_custom_css' col-id=" . $col_no[1] . " row-id='" . $row_no[1] . "' class='col_opt_textarea' name='row_hover_" . $col_no[1] . "_custom_css_" . $row_no[1] . "'  style='display:none;'>";

                        $tablestring .= "</textarea>";
                        $tablestring .= "</div>";
                        $tablestring .= "<div class='col_opt_input_div'>";
                        $tablestring .= "<div class='col_opt_title_div'>" . __('For Example', ARPLITE_PT_TXTDOMAIN) . "</div>";
                        $tablestring .= "<div class='arp_row_custom_css' data-code='color:#c9c9c9;' style='width:13%;'>color</div>";
                        $tablestring .= "<div class='arp_row_custom_css' data-code='font-size:20px;' style='width:21%;'>font-size</div>";
                        $tablestring .= "<div class='arp_row_custom_css' data-code='text-align:center;' style='width:25%;'>alignment</div>";
                        $tablestring .= "<div class='arp_row_custom_css' data-code='font-weight:bold;'>font-weight</div>";
                        $tablestring .= "</div>";
                        $tablestring .= "</div>";
                        /* Custom CSS Row Level */

                        $tablestring .= "<div class='col_opt_row arp_ok_div arp_" . $n . "' id='body_li_level_caption_arp_ok_div__button_1" . $splitedid[1] . "' >";
                        $tablestring .= "<div class='col_opt_btn_div'>";
                        $tablestring .= "<div class='col_opt_navigation_div'>";
                        $tablestring .= "<i class='fa fa-long-arrow-up arp_navigation_arrow' id='row_up_arrow' data-row-id='arp_{$n}' data-column='{$col_no[1]}' data-button-id='body_li_level_options__button_1'></i>&nbsp;";
                        $tablestring .= "<i class='fa fa-long-arrow-down arp_navigation_arrow' id='row_down_arrow' data-row-id='arp_{$n}' data-column='{$col_no[1]}' data-button-id='body_li_level_options__button_1'></i>&nbsp;";
                        $tablestring .= "<i class='fa fa-long-arrow-left arp_navigation_arrow' id='row_left_arrow' data-row-id='arp_{$n}' data-column='{$col_no[1]}' data-button-id='body_li_level_options__button_1'></i>&nbsp;";
                        $tablestring .= "<i class='fa fa-long-arrow-right arp_navigation_arrow' id='row_right_arrow' data-row-id='arp_{$n}' data-column='{$col_no[1]}' data-button-id='body_li_level_options__button_1'></i>&nbsp;";
                        $tablestring .= "</div>";
                        $tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
                        $tablestring .= __('Ok', 'ARPricelite');
                        $tablestring .= "</button>";
                        $tablestring .= "</div>";
                        $tablestring .= "</div>";

                        $tablestring .= "</div>";

                        // BODY LI TOOLTIP
                    }

                    $tablestring .= "</div>";

                    $tablestring .= "<div class='column_option_div' level-id='body_li_level_options__button_2' style='display:none;'>";

                    $tablestring .= "</div>";

                    $tablestring .= "</div>";

                    $tablestring .= "</div>";


                    $tablestring .= "</div>";

                    $x++;
                } //only for caption column
                else if ($columns['is_caption'] == 1 and $template_feature['caption_style'] == 'style_1') {
                    for ($i = 0; $i <= $maxrowcount; $i++) {
                        $rows = isset($opts['columns'][$j]['rows']['row_' . $i]) ? $opts['columns'][$j]['rows']['row_' . $i] : array();
                        $caption_li[$i] = stripslashes_deep($rows['row_description']);
                    }
                } else if ($columns['is_caption'] == 1 and $template_feature['caption_style'] == 'style_2') {
                    for ($i = 0; $i <= $maxrowcount; $i++) {
                        $rows = isset($opts['columns'][$j]['rows']['row_' . $i]) ? $opts['columns'][$j]['rows']['row_' . $i] : array();
                        $caption_li[$i] = stripslashes_deep($rows['row_description']);
                    }
                }
            }

            $tablestring .= "<div class='arp_allcolumnsdiv' id='arp_allcolumnsdiv' style='float:none'>";

            $c = $x;
            if ($c == 0) {
                $c = $x = 1;
            }
            $new_arr = array();
            if (is_array($col_ord_arr) && count($col_ord_arr) > 0) {
                foreach ($col_ord_arr as $key => $value) {
                    $new_value = str_replace('main_', '', $value);
                    $new_col_id = $new_value;
                    foreach ($opts['columns'] as $j => $columns) {
                        if ($new_col_id == $j) {
                            if ($columns['is_caption'] != 1) {
                                $new_arr['columns'][$new_col_id] = $columns;
                            }
                        }
                    }
                }
            } else {
                $new_arr = $opts;
            }

            $counter = 1;

            foreach ($new_arr['columns'] as $j => $columns) {
                if ($columns['is_caption'] == 0) {
                    $inlinecolumnwidth = "";
                    if ($columns["column_width"] != "") {
                        $inlinecolumnwidth = 'width:' . $columns["column_width"] . 'px';
                    } else {
                        if ($column_settings['is_responsive'] != 1) {
                            $inlinecolumnwidth = $global_column_width;
                        }
                    }
                    $shortcode_class = '';
                    $shortcode_class_array = $arpricelite_default_settings->arp_shortcode_custom_type();
                    if (isset($columns['arp_shortcode_customization_style'])) {
                        $shortcode_class .= @$columns['arp_shortcode_customization_size'] . ' ' . @$shortcode_class_array[$columns['arp_shortcode_customization_style']]['class'];
                    }

                    $column_highlight = $opts['columns'][$j]['column_highlight'];
                    if ($column_highlight && $column_highlight == 1 and $is_tbl_preview != 2)
                        $highlighted_column = 'column_highlight ';
                    else
                        $highlighted_column = '';

                    $col_no = explode('_', $j);
                    $tablestring .= "<div class='" . $highlighted_column . " ArpPricingTableColumnWrapper no_transition style_" . $j . " " . $hover_class . " " . $animation_class . " $shadow_style' id='main_column_" . $col_no[1] . "'  style='";  if ($c == 0) {
                        $tablestring .= "border-left:1px solid #DADADA;";
                    } $tablestring .= $inlinecolumnwidth . "' is_caption='0' data-order='" . $counter . "' data-template_id='" . $ref_template . "' data-level='column_level_options' data-type='other_columns_buttons' "
                            . "data-column-footer-position='{$columns['footer_content_position']}'"
                            . ">";


                    $tablestring .= "<div class='arpplan ";
                    if ($columns['is_caption'] == 1) {
                        $tablestring .= "maincaptioncolumn";
                    } else {
                        $tablestring .= "column_" . $c;
                    } if ($x % 2 == 0) {
                        $tablestring .= " arpdark-bg ArpPriceTablecolumndarkbg";
                    } $tablestring .= "'>";

                    $columns['ribbon_setting']['arp_ribbon'] = isset($columns['ribbon_setting']['arp_ribbon']) ? $columns['ribbon_setting']['arp_ribbon'] : "";
                    $tablestring .= "<div class='planContainer " . $columns['ribbon_setting']['arp_ribbon'] . "'>";
                    $tablestring .= "<div class='arp_column_content_wrapper'>";
                    if ($columns['arp_header_shortcode'] != '')
                        $header_cls = 'has_arp_shortcode';
                    else
                        $header_cls = '';
                    $columns_custom_ribbon_position = '';
                    if (isset($columns['ribbon_setting']) && $columns['ribbon_setting'] and $columns['ribbon_setting']['arp_ribbon'] != '' and $columns['ribbon_setting']['arp_ribbon_content'] != '') {
                        if ($columns['ribbon_setting']['arp_ribbon'] == 'arp_ribbon_6') {
                            if ($columns['ribbon_setting']['arp_ribbon_position'] == 'left') {
                                $columns_custom_ribbon_position = "left:{$columns['ribbon_setting']['arp_ribbon_custom_position_rl']}px;top:{$columns['ribbon_setting']['arp_ribbon_custom_position_top']}px;";
                            } else {
                                $columns_custom_ribbon_position = "right:{$columns['ribbon_setting']['arp_ribbon_custom_position_rl']}px;top:{$columns['ribbon_setting']['arp_ribbon_custom_position_top']}px;";
                            }
                        }
                        $basic_col = $arplite_mainoptionsarr['general_options']['arp_basic_colors'];
                        $ribbon_bg_col = $columns['ribbon_setting']['arp_ribbon_bgcol'];
                        $base_color = $ribbon_bg_col;
                        $base_color_key = array_search($base_color, $basic_col);
                        $gradient_color = $arplite_mainoptionsarr['general_options']['arp_basic_colors_gradient'][$base_color_key];
                        $ribbon_border_color = $arplite_mainoptionsarr['general_options']['arp_ribbon_border_color'][$base_color_key];
                        $tablestring .= "<div id='arp_ribbon_container' class='arp_ribbon_container arp_ribbon_" . strtolower($columns['ribbon_setting']['arp_ribbon_position']) . " " . $columns['ribbon_setting']['arp_ribbon'] . " ' style='" . $columns_custom_ribbon_position . "' >";
                        if ($columns['ribbon_setting']['arp_ribbon'] != 'arp_ribbon_6') {
                            $tablestring .= "<style type='text/css'>";
                            if (in_array($base_color, $basic_col)) {
                                if ($columns['ribbon_setting']['arp_ribbon'] == 'arp_ribbon_1') {
                                    $tablestring .= "#main_" . $j . " .arp_ribbon_content:before, #main_" . $j . " .arp_ribbon_content:after{";
                                    $tablestring .= "border-top-color:" . $gradient_color . " !important;";
                                    $tablestring .= "}";
                                }
                                if ($columns['ribbon_setting']['arp_ribbon'] == 'arp_ribbon_3') {
                                    $tablestring .= "#main_" . $j . " .arp_ribbon_content:before, #main_" . $j . " .arp_ribbon_content:after{";
                                    $tablestring .= "border-top-color:" . $base_color . " !important;";
                                    $tablestring .= "}";
                                    $tablestring .= "#main_" . $j . " .arp_ribbon_content{";
                                    $tablestring .= "border-top:75px solid " . $base_color . ";";
                                    $tablestring .= "color:" . $columns['ribbon_setting']['arp_ribbon_txtcol'] . ";";
                                    $tablestring .= "}";
                                } else {
                                    $tablestring .= ".arplite_price_table_" . $template_name . " #main_" . $j . " .arp_ribbon_content{";
                                    $tablestring .= "background:" . $gradient_color . ";";
                                    $tablestring .= "background-color:" . $gradient_color . ";";
                                    $tablestring .= "background-image:-moz-linear-gradient(0deg," . $gradient_color . "," . $base_color . "," . $gradient_color . ")";
                                    $tablestring .= "background-image:-webkit-gradient(linear, 0 0, 0 0, color-stop(0%," . $gradient_color . "), color-stop(50%," . $base_color . "), color-stop(100%," . $gradient_color . "));";
                                    $tablestring .= "background-image:-webkit-linear-gradient(left," . $gradient_color . " 0%, " . $base_color . " 51%, " . $gradient_color . " 100%);";
                                    $tablestring .= "background-image:-o-linear-gradient(left," . $gradient_color . " 0%, " . $base_color . " 51%, " . $gradient_color . " 100%);";
                                    $tablestring .= "background-image:linear-gradient(90deg," . $gradient_color . "," . $base_color . ", " . $gradient_color . ");";
                                    $tablestring .= "background-image:-ms-linear-gradient(left," . $gradient_color . "," . $base_color . ", " . $gradient_color . ");";
                                    $tablestring .= "filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='" . $base_color . "', endColorstr='" . $gradient_color . "', GradientType=1);";
                                    $tablestring .= '-ms-filter: "progid:DXImageTransform.Microsoft.gradient (startColorstr="' . $base_color . '", endColorstr="' . $gradient_color . '", GradientType=1)";';
                                    $tablestring .= "background-repeat:repeat-x;";
                                    $tablestring .= "border-top:1px solid {$ribbon_border_color};";
                                    $tablestring .= "box-shadow:3px 1px 2px rgba(0,0,0,0.6);";
                                    $tablestring .= "color:" . $columns['ribbon_setting']['arp_ribbon_txtcol'] . ";";
                                    $tablestring .= "}";
                                }
                            } else {
                                if ($columns['ribbon_setting']['arp_ribbon'] == 'arp_ribbon_1') {
                                    $tablestring .= "#main_" . $j . " .arp_ribbon_content:before,#main_" . $j . " .arp_ribbon_content:after{";
                                    $tablestring .= "border-top-color:" . $base_color . "  !important;";
                                    $tablestring .= "}";
                                }

                                $tablestring .= "#main_" . $j . " .arp_ribbon_content{";
                                $tablestring .= "background:" . $base_color . ";";
                                $tablestring .= "color:" . $columns['ribbon_setting']['arp_ribbon_txtcol'] . ";";
                                $tablestring .= "}";
                            }
                            $tablestring .= "</style>";
                        }
                        $tablestring .= "<div class='arp_ribbon_content arp_ribbon_" . strtolower($columns['ribbon_setting']['arp_ribbon_position']) . "'>";

                        $tablestring .= $columns['ribbon_setting']['arp_ribbon_content'];

                        $tablestring .= "</div>";

                        $tablestring .= "</div>";
                    }

                    $tablestring .= "<div class='arpcolumnheader " . $header_cls . "'>";
                    if ($template_feature['header_shortcode_position'] == 'default' && ( $ref_template == 'arplitetemplate_2' or $ref_template == 'arplitetemplate_5' or $ref_template == 'arplitetemplate_26' )) {
                        $tablestring .= "<div class='arp_header_selection_new' data-template_id='" . $ref_template . "' data-level='header_level_options' data-type='other_columns_buttons' data-column='main_" . $j . "'>";
                    }
                    if ( $template_feature['header_shortcode_position'] == 'position_1') {

                        if ($template_feature['header_shortcode_position'] == 'position_1' && ( $ref_template == 'arplitetemplate_8' )) {
                            $tablestring .= "<div class='arp_header_selection_new' data-template_id='" . $ref_template . "' data-level='header_level_options' data-type='other_columns_buttons'  data-column='main_" . $j . "'>";
                        }
                        $tablestring .= "<div class='arp_header_shortcode'>";
                        if ($template_feature['header_shortcode_type'] == 'normal') {
                            $tablestring .= $arpricelite_form->arp_get_video_image($columns['arp_header_shortcode']);
                        } else if ($template_feature['header_shortcode_type'] == 'rounded_corner') {
                            $tablestring .= "<div class='arp_rounded_shortcode_wrapper'>";
                            $tablestring .= "<div class='rounded_corner_wrapper $shortcode_class'>";
                            $tablestring .= "<div class='rounded_corder $shortcode_class'>" . do_shortcode($columns['arp_header_shortcode']) . "</div>";
                            $tablestring .= "</div>";
                            $tablestring .= "</div>";
                        }

                        $tablestring .= "</div>";
                    }

                    if ($columns['is_caption'] == 1) {
                        $tablestring .= "<div class='arpcaptiontitle' id='column_header' data-template_id='" . $ref_template . "' data-level='header_level_options' data-type='other_columns_buttons'  data-column='main_" . $j . "'>" . do_shortcode($columns['html_content']) . "</div>";
                    } else {

                        $tablestring .= "<div class='arppricetablecolumntitle' id='column_header' data-template_id='" . $ref_template . "' data-level='header_level_options' data-type='other_columns_buttons' data-column='main_" . $j . "'>
                                <div class='bestPlanTitle " . $title_cls . " package_title_first toggle_step_first'>" . do_shortcode($columns['package_title']) . "</div>";


                        if ($template_feature['column_description'] == 'enable' && $template_feature['column_description_style'] == 'style_1') {
                            $tablestring .= "<div class='column_description " . $title_cls . " column_description_first_step toggle_step_first' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-type='other_columns_buttons' data-level='column_description_level'>" . stripslashes_deep($columns['column_description']) . "</div>";
                        }

                        if ($template_feature['header_shortcode_position'] == 'position_1' && ( $ref_template == 'arplitetemplate_8' )) {
                            $tablestring .= "</div>";
                        }
                        $tablestring .= "</div>";

                        if ($template_feature['column_description'] == 'enable' && $template_feature['column_description_style'] == 'style_3') {
                            $tablestring .= "<div class='column_description " . $title_cls . " column_description_first_step toggle_step_first' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-type='other_columns_buttons' data-level='column_description_level'>" . stripslashes_deep($columns['column_description']) . "</div>";
                        }

                        if ($template_feature['button_position'] == 'position_2') {

                            $tablestring .= "<div class='arpcolumnfooter' id='arpcolumnfooter' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-level='footer_level_options' data-type='other_columns_buttons'>";
                            
                            $columns['btn_img'] = isset($columns['btn_img']) ? $columns['btn_img'] : "";

                            $footer_content_below_btn = "";
                            if ($columns['footer_content'] != '' and $columns['footer_content_position'] == 1 and $template_feature['has_footer_content'] == 1)
                                $footer_content_above_btn = "display:block;";
                            else
                                $footer_content_above_btn = "display:none;";
                            if ($template_feature['has_footer_content'] == 1) {
                                $tablestring .= "<div class='arp_footer_content arp_btn_before_content' style='{$footer_content_above_btn}'>";
                                $tablestring .= "<span class='footer_content_first_step toggle_step_first'>";
                                $tablestring .= $columns['footer_content'];
                                $tablestring .= "</span>";

                                $tablestring .= "</div>";
                            }

                            if (isset($columns['button_background_color']) && $columns['button_background_color'] != '') {
                                $button_background_color = $columns['button_background_color'];
                            } else {
                                $button_background_color = '';
                            }

                            $tablestring .= "<div class='arppricetablebutton' data-column='main_" . $j . "' style='text-align:center;'>";
                            $tablestring .= "<button type='button' class='bestPlanButton $arp_global_button_class arp_" . strtolower($columns['button_size']) . "_btn' id='bestPlanButton' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-level='button_options' data-type='other_columns_buttons' ";
                            if ($columns['btn_img'] != "") {
                                $tablestring .= "style='background:" . $columns['button_background_color'] . " url(" . $columns['btn_img'] . ") no-repeat !important;'";
                            } else {
                                $tablestring .= "style='background:" . $button_background_color . "'";
                            }

                            $tablestring .= ">";

                            if ($columns['btn_img'] == "") {
                                $tablestring .= "<span class='btn_content_first_step toggle_step_first'>";
                                $tablestring .= stripslashes_deep($columns['button_text']);
                                $tablestring .= "</span>";
                            } $tablestring .= "</button>";

                            $tablestring .= "</div>";

                            $footer_content_below_btn = "";
                            if ($columns['footer_content'] != '' and $columns['footer_content_position'] == 0)
                                $footer_content_below_btn = "display:block;";
                            else
                                $footer_content_below_btn = "display:none;";
                            if ($template_feature['has_footer_content'] == 1) {
                                $tablestring .= "<div class='arp_footer_content arp_btn_after_content' style='{$footer_content_below_btn}'>";
                                $tablestring .= "<span class='footer_content_first_step toggle_step_first'>";
                                $tablestring .= $columns['footer_content'];
                                $tablestring .= "</span>";

                                $tablestring .= "</div>";
                            }

                            $tablestring .= "</div>";
                        }

                        if ($template_feature['header_shortcode_position'] == 'default') {
                            if ($template_feature['header_shortcode_type'] == 'normal') {
                                $tablestring .= "<div class='arp_header_shortcode'>" . do_shortcode($columns['arp_header_shortcode']) . "</div>";
                            } else if ($template_feature['header_shortcode_type'] == 'rounded_border') {
                                $tablestring .= "<div class='arp_rounded_shortcode_wrapper $shortcode_class'>";
                                $tablestring .= "<div class='rounded_corner_wrapper $shortcode_class'>";
                                $tablestring .= "<div class='rounded_corder $shortcode_class'>" . do_shortcode($columns['arp_header_shortcode']) . "</div>";
                                $tablestring .= "</div>";
                                $tablestring .= "</div>";
                            }
                        }
                        if ($template_feature['header_shortcode_position'] == 'default') {
                            $tablestring .= "</div>";
                        }
                        if ($template_feature['amount_style'] == 'style_2')
                            $amount_style_cls = 'style_2';
                        $tablestring .= "<div class='arppricetablecolumnprice " . ( isset($amount_style_cls) ? $amount_style_cls : "" ) . "' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-level='pricing_level_options' data-type='other_columns_buttons' >";


                        if ($template_feature['amount_style'] == 'default') {
                            $tablestring .= "<div class='arp_price_wrapper'>";
                            if ($ref_template == 'arplitetemplate_1') {
                                $tablestring .= "<span class='price_text_first_step toggle_step_first'>";
                                $tablestring .= $columns['price_text'];
                                $tablestring .= '</span>';
                            } else {

                                $tablestring .= "<span class='price_text_first_step toggle_step_first'>";
                                $tablestring .= $columns['price_text'];
                                $tablestring .= '</span>';


                            }
                            $tablestring .= "</div>";

                            $tablestring .= isset($columns['html_content']) ? $columns['html_content'] : "";
                        } else if ($template_feature['amount_style'] == 'style_1') {
                            $tablestring .= "<div class='arp_pricename' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-type='other_columns_buttons' data-level='pricing_level_options'>";
                            $tablestring .= "<div class='arp_price_wrapper'  data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-type='other_columns_buttons' data-level='pricing_level_options' >";
                            $tablestring .= "<span class=\"arp_price_value\">";
                            $tablestring .= "<span class='price_text_first_step toggle_step_first'>";
                            $tablestring .= $columns['price_text'];
                            $tablestring .= '</span>';

                            $tablestring .= "</span>";
                            $tablestring .= "<span class=\"arp_price_duration\">";
                            $tablestring .= "<span class='price_text_first_step toggle_step_first'>";
                            $tablestring .= $columns['price_label'];
                            $tablestring .= '</span>';

                            $tablestring .= "</span>";

                            $tablestring .= "</div>";
                            $tablestring .= "</div>";
                            $columns['html_content'] = isset($columns['html_content']) ? $columns['html_content'] : "";
                            $tablestring .= do_shortcode($columns['html_content']);
                        } else if ($template_feature['amount_style'] == 'style_2') {
                            $tablestring .= "<div class='arp_price_wrapper'>";
                            if ($template == 'arplitetemplate_11') {
                                $tablestring .= "<div class='arp_pricename_selection_new' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-level='pricing_level_options' data-type='other_columns_buttons'>";
                            }
                            $tablestring .= "<span class=\"arp_price_duration\">";
                            $tablestring .= "<span class='price_text_first_step toggle_step_first'>";
                            $tablestring .= $columns['price_label'];
                            $tablestring .= '</span>';

                            $tablestring .= "</span>";
                            $tablestring .= "<span class=\"arp_price_value\">";
                            $tablestring .= "<span class='price_text_first_step toggle_step_first'>";
                            $tablestring .= $columns['price_text'];
                            $tablestring .= '</span>';

                            $tablestring .= "</span>";

                            if ($template == 'arplitetemplate_11') {
                                $tablestring .= "</div>";
                            }
                            $tablestring .= "</div>";
                            $columns['html_content'] = isset($columns['html_content']) ? $columns['html_content'] : "";
                            $tablestring .= do_shortcode($columns['html_content']);
                        }

                        if ($template_feature['column_description'] == 'enable' && $template_feature['column_description_style'] == 'style_2') {
                            $tablestring .= "<div class='custom_ribbon_wrapper'>";
                            $tablestring .= "<div class='column_description column_description_first_step toggle_step_first' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-type='other_columns_buttons' data-level='column_description_level'>" . stripslashes_deep($columns['column_description']) . "</div>";
                            $tablestring .= "<div class='column_description column_description_second_step toggle_step_second' style='display:none;' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-type='other_columns_buttons' data-level='column_description_level'>" . stripslashes_deep($columns['column_description_second']) . "</div>";
                            $tablestring .= "<div class='column_description column_description_third_step toggle_step_third' style='display:none;' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-type='other_columns_buttons' data-level='column_description_level'>" . stripslashes_deep($columns['column_description_third']) . "</div>";
                            $tablestring .= "</div>";
                        }

                        if ($template_feature['column_description'] == 'enable' && $template_feature['column_description_style'] == 'style_4') {
                            $first_desc_blank = $second_desc_blank = $third_desc_blank = '';
                            $first_desc_blank = empty($columns['column_description']) ? ' desc_content_blank' : '';
                            $second_desc_blank = empty($columns['column_description_second']) ? ' desc_content_blank' : '';
                            $third_desc_blank = empty($columns['column_description_third']) ? ' desc_content_blank' : '';

                            $tablestring .= "<div class='column_description column_description_first_step toggle_step_first " . $first_desc_blank . "' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-type='other_columns_buttons' data-level='column_description_level'>" . stripslashes_deep($columns['column_description']) . "</div>";
                        }

                        if ($template_feature['button_position'] == 'position_1') {

                            $tablestring .= "<div class='arpcolumnfooter' id='arpcolumnfooter' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-level='footer_level_options' data-type='other_columns_buttons'>";

                            $footer_content_above_btn = "";
                            if (isset($columns['footer_content']) && $columns['footer_content'] != '' and $columns['footer_content_position'] == 1)
                                $footer_content_above_btn = "display:block;";
                            else
                                $footer_content_above_btn = "display:none;";

                            if ($template_feature['has_footer_content'] == 1) {
                                $tablestring .= "<div class='arp_footer_content arp_btn_before_content' style='{$footer_content_above_btn}'>";
                                $tablestring .= "<span class='footer_content_first_step toggle_step_first'>";
                                $tablestring .= isset($columns['footer_content']) ? $columns['footer_content'] : '';
                                $tablestring .= "</span>";

                                $tablestring .= "<span class='footer_content_second_step toggle_step_second' style='display:none'>";
                                $tablestring .= stripslashes_deep($columns['footer_content_second']);
                                $tablestring .= "</span>";

                                $tablestring .= "<span class='footer_content_third_step toggle_step_third' style='display:none'>";
                                $tablestring .= stripslashes_deep($columns['footer_content_third']);
                                $tablestring .= "</span>";
                                $tablestring .= "</div>";
                            }

                            $columns['btn_img'] = isset($columns['btn_img']) ? $columns['btn_img'] : "";
                            $tablestring .= "<div class='arppricetablebutton' data-column='main_" . $j . "' style='text-align:center;'>
                                                        <button type='button' class='bestPlanButton $arp_global_button_class arp_" . strtolower($columns['button_size']) . "_btn' id='bestPlanButton' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-level='button_options' data-type='other_columns_buttons' ";
                            if ($columns['btn_img'] != "") {
                                $tablestring .= "style='background:" . $columns['button_background_color'] . " url(" . $columns['btn_img'] . ") no-repeat !important;'";
                            }  $tablestring .= ">";
                            if ($columns['btn_img'] == "") {
                                $tablestring .= "<span class='btn_content_first_step toggle_step_first'>";
                                $tablestring .= stripslashes_deep($columns['button_text']);
                                $tablestring .= "</span>";
                            } $tablestring .= "</button>";

                            $tablestring .= "</div>";
                            $footer_content_below_btn = "";
                            if (isset($columns['footer_content']) && $columns['footer_content'] != '' and $columns['footer_content_position'] == 0)
                                $footer_content_below_btn = "display:block;";
                            else
                                $footer_content_below_btn = "display:none;";
                            if ($template_feature['has_footer_content'] == 1) {
                                $tablestring .= "<div class='arp_footer_content arp_btn_after_content' style='{$footer_content_below_btn}'>";
                                $tablestring .= "<span class='footer_content_first_step toggle_step_first'>";
                                $tablestring .= $columns['footer_content'];
                                $tablestring .= "</span>";

                                $tablestring .= "</div>";
                            }
                            $tablestring .= "</div>";
                        }
                        $tablestring .= "</div>";
                    }
                    if ( $template_feature['header_shortcode_position'] == 'position_2') {

                        $tablestring .= "<div class='arp_header_shortcode'>";
                        if ($template_feature['header_shortcode_type'] == 'normal')
                            $tablestring .= do_shortcode($columns['arp_header_shortcode']);
                        else if ($template_feature['header_shortcode_type'] == 'rounded_border') {
                            $tablestring .= "<div class='arp_rounded_shortcode_wrapper'>";
                            $tablestring .= "<div class='rounded_corner_wrapper $shortcode_class'>";
                            $tablestring .= "<div class='rounded_corder $shortcode_class'>" . do_shortcode($columns['arp_header_shortcode']) . "</div>";
                            $tablestring .= "</div>";
                            $tablestring .= "</div>";
                        }
                        $tablestring .= "</div>";
                    }

                    $tablestring .= "</div>";


                    if ($template_feature['button_position'] == 'position_3') {
                        $tablestring .= "<div style='float:left;width:100%;'>";
                        $tablestring .= "<div class='column_description " . $title_cls . " column_description_first_step toggle_step_first' data-level='column_description_level' data-type='other_columns_buttons' data-template_id='" . $ref_template . "' data-column='main_" . $j . "'>" . stripslashes_deep($columns['column_description']) . "</div>";
                        $tablestring .= "<div class='column_description " . $title_cls . " column_description_second_step toggle_step_second' style='display:none;' data-level='column_description_level' data-type='other_columns_buttons' data-template_id='" . $ref_template . "' data-column='main_" . $j . "'>" . stripslashes_deep($columns['column_description_second']) . "</div>";
                        $tablestring .= "<div class='column_description " . $title_cls . " column_description_third_step toggle_step_third' style='display:none;' data-level='column_description_level' data-type='other_columns_buttons' data-template_id='" . $ref_template . "' data-column='main_" . $j . "'>" . stripslashes_deep($columns['column_description_third']) . "</div>";

                        $tablestring .= "<div class='arpcolumnfooter " . $footer_hover_class . "' id='arpcolumnfooter' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-level='footer_level_options' data-type='other_columns_buttons'>";
                        $columns['btn_img'] = isset($columns['btn_img']) ? $columns['btn_img'] : "";

                        $footer_content_above_btn = "";
                        if ($columns['footer_content'] != '' and $columns['footer_content_position'] == 1)
                            $footer_content_above_btn = "display:block;";
                        else
                            $footer_content_above_btn = "display:none;";
                        if ($template_feature['has_footer_content'] == 1) {
                            $tablestring .= "<div class='arp_footer_content arp_btn_before_content' style='{$footer_content_above_btn}'>";
                            $tablestring .= "<span class='footer_content_first_step toggle_step_first'>";
                            $tablestring .= $columns['footer_content'];
                            $tablestring .= "</span>";

                            $tablestring .= "<span class='footer_content_second_step toggle_step_second' style='display:none'>";
                            $tablestring .= stripslashes_deep($columns['footer_content_second']);
                            $tablestring .= "</span>";

                            $tablestring .= "<span class='footer_content_third_step toggle_step_third' style='display:none'>";
                            $tablestring .= stripslashes_deep($columns['footer_content_third']);
                            $tablestring .= "</span>";
                            $tablestring .= "</div>";
                        }

                        $tablestring .= "<div class='arppricetablebutton' data-column='main_" . $j . "' style='text-align:center;'>
                                                        <button type='button' class='bestPlanButton $arp_global_button_class arp_" . strtolower($columns['button_size']) . "_btn' id='bestPlanButton' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-level='button_options' data-type='other_columns_buttons' ";
                        if ($columns['btn_img'] != "") {
                            $tablestring .= "style='background:" . $columns['button_background_color'] . " url(" . $columns['btn_img'] . ") no-repeat !important;'";
                        } $tablestring .= ">";
                        if ($columns['btn_img'] == "") {
                            $tablestring .= "<span class='btn_content_first_step toggle_step_first'>";
                            $tablestring .= stripslashes_deep($columns['button_text']);
                            $tablestring .= "</span>";

                            $tablestring .= "<span class='btn_content_second_step toggle_step_second' style='display:none'>";
                            $tablestring .= stripslashes_deep($columns['btn_content_second']);
                            $tablestring .= "</span>";

                            $tablestring .= "<span class='btn_content_third_step toggle_step_third' style='display:none'>";
                            $tablestring .= stripslashes_deep($columns['btn_content_third']);
                            $tablestring .= "</span>";
                        } $tablestring .= "</button>";
                        $tablestring .= "</div>";

                        $footer_content_below_btn = "";
                        if ($columns['footer_content'] != '' and $columns['footer_content_position'] == 0)
                            $footer_content_below_btn = "display:block;";
                        else
                            $footer_content_below_btn = "display:none;";
                        if ($template_feature['has_footer_content'] == 1) {
                            $tablestring .= "<div class='arp_footer_content arp_btn_after_content' style='{$footer_content_below_btn}'>";
                            $tablestring .= "<span class='footer_content_first_step toggle_step_first'>";
                            $tablestring .= $columns['footer_content'];
                            $tablestring .= "</span>";

                            $tablestring .= "</div>";
                        }

                        $tablestring .= "</div>";
                        $tablestring .= "</div>";
                    }

                    $tablestring .= "<div class='arpbody-content arppricingtablebodycontent' id='arppricingtablebodycontent' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-level='body_level_options' data-type='other_columns_buttons'>";

                    $tablestring .= "<ul class='arp_opt_options arppricingtablebodyoptions' id='column_" . $j . "' style='text-align:" . $columns['body_text_alignment'] . ";'>";

                    $r = 0;

                    $row_order = isset($new_arr['columns'][$j]['row_order']) ? $new_arr['columns'][$j]['row_order'] : array();
                    if ($row_order && is_array($row_order)) {
                        $rows = array();
                        asort($row_order);
                        $ji = 0;
                        $maxorder = max($row_order) ? max($row_order) : 0;
                        foreach ($new_arr['columns'][$j]['rows'] as $rowno => $row) {
                            $row_order[$rowno] = isset($row_order[$rowno]) ? $row_order[$rowno] : ($maxorder + 1);
                        }

                        foreach ($row_order as $row_id => $order_id) {
                            if ($new_arr['columns'][$j]['rows'][$row_id]) {
                                $rows['row_' . $ji] = $new_arr['columns'][$j]['rows'][$row_id];
                                $ji++;
                            }
                        }

                        $new_arr['columns'][$j]['rows'] = $rows;
                    }
                    $column_count++;
                    $row_count = 0;
                    for ($ri = 0; $ri <= $maxrowcount; $ri++) {
                        $rows = isset($new_arr['columns'][$j]['rows']['row_' . $ri]) ? $new_arr['columns'][$j]['rows']['row_' . $ri] : array();

                        if ($columns['is_caption'] == 1) {
                            if (($ri + 1) % 2 == 0) {
                                $cls = 'rowlightcolorstyle';
                            } else {
                                $cls = '';
                            }
                        } else {

                            if ($column_count % 2 == 0) {
                                if (($ri + 1) % 2 == 0) {
                                    $cls = 'rowdarkcolorstyle';
                                } else {
                                    $cls = '';
                                }
                            } else {
                                if (($ri + 1) % 2 == 0) {
                                    $cls = 'rowlightcolorstyle';
                                } else {
                                    $cls = '';
                                }
                            }
                        }

                        if (($ri + 1 ) % 2 == 0) {
                            $cls .= " arp_even_row";
                        } else {
                            $cls .= " arp_odd_row";
                        }
                        //$caption_li
                        if ($rows['row_description'] == '') {
                            $rows['row_description'] = '';
                        }
                        if ($template_feature['caption_style'] == 'style_1' and $template_feature['list_alignment'] != 'default') {
                            $li_class = $ref_template . '_' . $j . '_row_' . $ri;
                            $tablestring .= "<li data-template_id='" . $ref_template . "' data-level='body_li_level_options' data-type='other_columns_buttons' data-column='main_" . $j . "' class='arpbodyoptionrow arp_" . $j . "_row_" . $row_count . " " . $cls;

                            $tablestring .= " " . $li_class . "' id='arp_row_" . $ri . "'>";

                            $tablestring .= "<span class='caption_li'>";
                            $tablestring .= "<div class='row_label_first_step toggle_step_first'>" . stripslashes_deep($rows['row_label']) . "</div>";
                            $tablestring .= "</span>";
                            $tablestring .= "<span class='caption_detail' ";
                            $tablestring .= " title='";
                            $tablestring .= "'>";
                            $tablestring .= "<div class='row_description_first_step toggle_step_first'>" . stripslashes_deep($rows['row_description']) . "</div>";
                            $tablestring .= "</span>
                                            </li>";
                        } else if ($template_feature['caption_style'] == 'style_2') {
                            $li_class = $ref_template . '_' . $j . '_row_' . $ri;

                            $tablestring .= "<li data-template_id='" . $ref_template . "' data-level='body_li_level_options' data-type='other_columns_buttons' data-column='main_" . $j . "' class='arpbodyoptionrow arp_" . $j . "_row_" . $row_count . " " . $cls;
                            $tablestring .= " " . $li_class . "' id='arp_row_" . $ri . "'";

                            $tablestring .= ">";
                            $tablestring .= "<span class='caption_detail' ";

                            $tablestring .= "title='";
                            if ($rows['row_tooltip'] != "") {
                                $tablestring .= esc_html($rows['row_tooltip']);
                            }
                            $tablestring .= "'>";
                            $tablestring .= "<div class='row_description_first_step toggle_step_first'>" . stripslashes_deep($rows['row_description']) . "</div>";
                            $tablestring .= "</span>";
                            $tablestring .= "<span class='caption_li'>";
                            $tablestring .= "<div class='row_label_first_step toggle_step_first'>" . stripslashes_deep($rows['row_label']) . "</div>";
                            $tablestring .= "</span>";
                            $tablestring .= "</li>";
                        } else if ($template_feature['list_alignment'] != 'default') {
                            $li_class = $ref_template . '_' . $j . '_row_' . $ri;
                            $tablestring .= "<li data-template_id='" . $ref_template . "' data-level='body_li_level_options' data-type='other_columns_buttons' data-column='main_" . $j . "' class='arpbodyoptionrow arp_" . $j . "_row_" . $row_count . " " . $cls;
                            $tablestring .= " " . $li_class . "' id='arp_row_" . $ri . "' style='text-align:" . $template_feature['list_alignment'] . "' >";
                            $tablestring .= "<span class=''";
                            $tablestring .= " title='";
                            if ($rows['row_tooltip'] != "") {
                                $tablestring .= esc_html($rows['row_tooltip']);
                            }
                            $tablestring .= "'>";
                            $tablestring .= "<div class='row_description_first_step toggle_step_first'>" . stripslashes_deep($rows['row_description']) . "</div>";
                            $tablestring .= "</span>
                                           </li>";
                        } else {
                            $li_class = $ref_template . '_' . $j . '_row_' . $ri;
                            $tablestring .= "<li data-template_id='" . $ref_template . "' data-level='body_li_level_options' data-type='other_columns_buttons' data-column='main_" . $j . "' class='arpbodyoptionrow arp_" . $j . "_row_" . $row_count . " " . $cls;
                            $tablestring .= " " . $li_class . "' id='arp_row_" . $ri . "' style='text-align:";  $tablestring .= "' >";
                            $tablestring .= "<span class='' ";
                            $tablestring .= " title='";
                            $tablestring .= "'>";
                            $tablestring .= "<div class='row_description_first_step toggle_step_first'>" . stripslashes_deep($rows['row_description']) . "</div>";
                            $tablestring .= "</span>
                                           </li>";
                        }
                        $row_count++;
                    }
                    $tablestring .= "</ul>";
                    $tablestring .= "</div>";


                    // TMP5


                    if ($template_feature['amount_style'] == 'style_3') {
                        $tablestring .= "<div class='arppricetablecolumnprice' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-level='pricing_level_options' data-type='other_columns_buttons' >";
                        $tablestring .= "<div class='arp_price_wrapper'>";

                        $tablestring .= "<span class=\"arp_price_duration\">";
                        $tablestring .= "<span class='price_text_first_step toggle_step_first'>";
                        $tablestring .= $columns['price_label'];
                        $tablestring .= '</span>';

                        $tablestring .= "<span class='price_text_second_step toggle_step_second' style='display:none'>";
                        $tablestring .= $columns['price_text_input_two_step_label'];
                        $tablestring .= '</span>';

                        $tablestring .= "<span class='price_text_third_step toggle_step_third' style='display:none'>";
                        $tablestring .= $columns['price_text_input_three_step_label'];
                        $tablestring .= '</span>';
                        $tablestring .= "</span>";
                        $tablestring .= "<span class=\"arp_price_value\">";
                        $tablestring .= "<span class='price_text_first_step toggle_step_first'>";
                        $tablestring .= $columns['price_text'];
                        $tablestring .= '</span>';

                        $tablestring .= "<span class='price_text_second_step toggle_step_second' style='display:none'>";
                        $tablestring .= $columns['price_text_input_two_step_price'];
                        $tablestring .= '</span>';

                        $tablestring .= "<span class='price_text_third_step toggle_step_third' style='display:none'>";
                        $tablestring .= $columns['price_text_input_three_step_price'];
                        $tablestring .= '</span>';
                        $tablestring .= "</span>";
                        $tablestring .= "</div>";
                        $columns['html_content'] = isset($columns['html_content']) ? $columns['html_content'] : "";
                        $tablestring .= do_shortcode($columns['html_content']);


                        if ($template_feature['button_position'] == 'position_4') {

                            $footer_hover_class = "";
                            if ($columns['footer_content'] != '' and $template_feature['has_footer_content'] == 1) {
                                $footer_hover_class .= ' has_footer_content';
                                if ($columns['footer_content_position'] == 0) {
                                    $footer_hover_class .= " footer_below_content";
                                } else {
                                    $footer_hover_class .= " footer_above_content";
                                }
                            } else {
                                $footer_hover_class = "";
                            }

                            $tablestring .= "<div class='arpcolumnfooter " . $footer_hover_class . "' id='arpcolumnfooter' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-level='footer_level_options' data-type='other_columns_buttons'>";
                            $columns['btn_img'] = isset($columns['btn_img']) ? $columns['btn_img'] : "";

                            $footer_content_above_btn = "";
                            if ($columns['footer_content'] != '' and $columns['footer_content_position'] == 1)
                                $footer_content_above_btn = "display:block;";
                            else
                                $footer_content_above_btn = "display:none;";
                            if ($template_feature['has_footer_content'] == 1) {
                                $tablestring .= "<div class='arp_footer_content arp_btn_before_content' style='{$footer_content_above_btn}'>";
                                $tablestring .= "<span class='footer_content_first_step toggle_step_first'>";
                                $tablestring .= $columns['footer_content'];
                                $tablestring .= "</span>";

                                $tablestring .= "<span class='footer_content_second_step toggle_step_second' style='display:none'>";
                                $tablestring .= stripslashes_deep($columns['footer_content_second']);
                                $tablestring .= "</span>";

                                $tablestring .= "<span class='footer_content_third_step toggle_step_third' style='display:none'>";
                                $tablestring .= stripslashes_deep($columns['footer_content_third']);
                                $tablestring .= "</span>";
                                $tablestring .= "</div>";
                            }

                            $tablestring .= "<div class='arppricetablebutton' data-column='main_" . $j . "' style='text-align:center;'>
                                                        <button type='button' class='bestPlanButton $arp_global_button_class arp_" . strtolower($columns['button_size']) . "_btn' id='bestPlanButton' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-level='button_options' data-type='other_columns_buttons' ";
                            if ($columns['btn_img'] != "") {
                                $tablestring .= "style='background:" . $columns['button_background_color'] . " url(" . $columns['btn_img'] . ") no-repeat !important;'";
                            } $tablestring .= ">";
                            if ($columns['btn_img'] == "") {
                                $tablestring .= "<span class='btn_content_first_step toggle_step_first'>";
                                $tablestring .= stripslashes_deep($columns['button_text']);
                                $tablestring .= "</span>";

                                $tablestring .= "<span class='btn_content_second_step toggle_step_second' style='display:none'>";
                                $tablestring .= stripslashes_deep($columns['btn_content_second']);
                                $tablestring .= "</span>";

                                $tablestring .= "<span class='btn_content_third_step toggle_step_third' style='display:none'>";
                                $tablestring .= stripslashes_deep($columns['btn_content_third']);
                                $tablestring .= "</span>";
                            } $tablestring .= "</button>";

                            $tablestring .= "</div>";

                            $footer_content_below_btn = "";
                            if ($columns['footer_content'] != '' and $columns['footer_content_position'] == 0)
                                $footer_content_below_btn = "display:block;";
                            else
                                $footer_content_below_btn = "display:none;";
                            if ($template_feature['has_footer_content'] == 1) {
                                $tablestring .= "<div class='arp_footer_content arp_btn_after_content' style='{$footer_content_below_btn}'>";
                                $tablestring .= "<span class='footer_content_first_step toggle_step_first'>";
                                $tablestring .= $columns['footer_content'];
                                $tablestring .= "</span>";

                                $tablestring .= "<span class='footer_content_second_step toggle_step_second' style='display:none'>";
                                $tablestring .= stripslashes_deep($columns['footer_content_second']);
                                $tablestring .= "</span>";

                                $tablestring .= "<span class='footer_content_third_step toggle_step_third' style='display:none'>";
                                $tablestring .= stripslashes_deep($columns['footer_content_third']);
                                $tablestring .= "</span>";
                                $tablestring .= "</div>";
                            }

                            $tablestring .= "</div>";
                        }

                        $tablestring .= "</div>";
                    }

                    if ($template_feature['button_position'] == 'default') {

                        $footer_hover_class = "";
                        if ($columns['footer_content'] != '' and $template_feature['has_footer_content'] == 1) {
                            $footer_hover_class .= ' has_footer_content';
                            if ($columns['footer_content_position'] == 0) {
                                $footer_hover_class .= " footer_below_content";
                            } else {
                                $footer_hover_class .= " footer_above_content";
                            }
                        } else {
                            $footer_hover_class = "";
                        }

                        $tablestring .= "<div class='arpcolumnfooter " . $footer_hover_class . "' id='arpcolumnfooter' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-level='footer_level_options' data-type='other_columns_buttons'>";

                        if ($template_feature['second_btn'] == true && $columns['button_s_text'] != '') {
                            $has_s_btn = 'has_second_btn';
                        } else {
                            $has_s_btn = 'no_second_btn';
                        }

                        $columns['btn_img'] = isset($columns['btn_img']) ? $columns['btn_img'] : "";


                        $footer_content_above_btn = "";
                        if ($columns['footer_content'] != '' and $columns['footer_content_position'] == 1)
                            $footer_content_above_btn = "display:block;";
                        else
                            $footer_content_above_btn = "display:none;";
                        if ($template_feature['has_footer_content'] == 1) {
                            $tablestring .= "<div class='arp_footer_content arp_btn_before_content' style='{$footer_content_above_btn}'>";
                            $tablestring .= "<span class='footer_content_first_step toggle_step_first'>";
                            $tablestring .= $columns['footer_content'];
                            $tablestring .= "</span>";

                            $tablestring .= "</div>";
                        }

                        $tablestring .= "<div class='arppricetablebutton' data-column='main_" . $j . "' style='text-align:center;'>";
                        $tablestring .= "<button type='button' class='bestPlanButton $arp_global_button_class arp_" . strtolower($columns['button_size']) . "_btn " . $has_s_btn . "' id='bestPlanButton' data-template_id='" . $ref_template . "' data-level='button_options' data-type='other_columns_buttons' data-column='main_" . $j . "' ";
                        if ($columns['btn_img'] != "") {
                            $tablestring .= "style='background:" . $columns['button_background_color'] . " url(" . $columns['btn_img'] . ") no-repeat !important;'";
                        } $tablestring .= ">";
                        if ($columns['btn_img'] == "") {
                            $tablestring .= "<span class='btn_content_first_step toggle_step_first'>";
                            $tablestring .= stripslashes_deep($columns['button_text']);
                            $tablestring .= "</span>";
                        } $tablestring .="</button>";

                        if ($template_feature['second_btn'] == true && $columns['button_s_text'] != '') {
                            if ($columns['button_text'] != '') {
                                $has_f_btn = 'has_first_btn';
                            } else {
                                $has_f_btn = 'no_first_btn';
                            }
                            $tablestring .= "<button type='button' class='bestPlanButton $arp_global_button_class arp_" . strtolower($columns['button_s_size']) . "_btn SecondBestPlanButton " . $has_f_btn . "' id='bestPlanButton' data-template_id='" . $ref_template . "' data-level='second_button_options' data-type='other_columns_buttons' data-column='main_" . $j . "' ";
                            if ($columns['button_s_img'] != "") {
                                $tablestring .= "style='background:" . $columns['button_background_color'] . " url(" . $columns['button_s_img'] . ") no-repeat !important;width:" . $columns['btn_s_img_width'] . "px;height:" . $columns['btn_s_img_height'] . "px;' ";
                            } $tablestring .= ">";
                            if ($columns['button_s_img'] == "") {
                                $tablestring .= stripslashes_deep($columns['button_s_text']);
                            } $tablestring .="</button>";
                        }
                        $tablestring .= "</div>";

                        $footer_content_below_btn = '';
                        if ($columns['footer_content'] != '' and $columns['footer_content_position'] == 0)
                            $footer_content_below_btn = "display:block;";
                        else
                            $footer_content_below_btn = "display:none;";
                        if ($template_feature['has_footer_content'] == 1) {
                            $tablestring .= "<div class='arp_footer_content arp_btn_after_content' style='{$footer_content_below_btn}'>";
                            $tablestring .= "<span class='footer_content_first_step toggle_step_first'>";
                            $tablestring .= $columns['footer_content'];
                            $tablestring .= "</span>";

                            $tablestring .= "</div>";
                        }

                        $tablestring .= "</div>";
                    }

                    if ($template_feature['column_description'] == 'enable' and $template_feature['column_description_style'] == 'after_button') {
                        $tablestring .= "<div class='column_description " . $title_cls . " column_description_first_step toggle_step_first' data-column='main_" . $j . "' data-template_id='" . $ref_template . "' data-type='other_columns_buttons' data-level='column_description_level'>" . stripslashes_deep($columns['column_description']) . "</div>";
                    }

                    $tablestring .= "</div>";
                    $tablestring .= "</div>";
                    $tablestring .= "</div>";


                    /* Dynamic Button Options */
                    $col_no = explode('_', $j);
                    include(ARPLITE_PRICINGTABLE_CLASSES_DIR . '/class.arprice_preview_editor_option.php');
                    $tablestring .= "</div>";  //ArpPricingTableColumnWrapper div



                    $c++;

                    if ($x % 5 == 0) {
                        $c = 1;
                    }
                    $x++;
                }
                $counter++;
            }

            $tablestring .= "</div>";
        } else {
            $tablestring .= __('Please select valid table', 'ARPricelite');
        }



        $tablestring .= "<div id='arp_all_font_listing' style='display:none;'>";
        $default_fonts = $arpricelite_fonts->get_default_fonts();
        $google_fonts = $arpricelite_fonts->google_fonts_list();
        $tablestring .= "<ol class='arp_selectbox_group_label'>" . __('Default Fonts', 'ARPricelite') . "</ol>";
        foreach ($default_fonts as $font) {
            $tablestring .= "<li data-value='" . $font . "'  data-label='" . $font . "'>" . $font . "</li>";
        }
        $tablestring .= "<ol class='arp_selectbox_group_label'>" . __('Google Fonts', 'ARPricelite') . "</ol>";
        foreach ($google_fonts as $font) {
            $tablestring .= "<li data-value='" . $font . "' data-label='" . $font . "'>" . $font . "</li>";
        }
        $tablestring .= "</div>";


        $tablestring .= "</div>";



        $tablestring .= "</div>";
        $tablestring .= "</div>";
        if (isset($column_animation['is_animation']) and $column_animation['is_animation'] == 'yes' and $is_tbl_preview != 2 and $column_animation['is_pagination'] == 1 and ( $column_animation['pagination_position'] == 'Bottom' or $column_animation['pagination_position'] == 'Both' ))
            $tablestring .= "<div class='arp_pagination
 " . $column_animation['pagination_style'] . " arp_pagination
_bottom' id='arp_slider
_" . $id . "_pagination_bottom'></div>";

        $tablestring = $arplite_pricingtable->arprice_font_icon_size_parser($tablestring);

        $tablestring = $arplite_pricingtable->arp_remove_style_tag($tablestring);

        return $tablestring;
    }

}
?>