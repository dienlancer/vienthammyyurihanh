<?php

global $arpricelite_form, $arplite_mainoptionsarr, $arpricelite_default_settings;
$template_section_array = $arpricelite_default_settings->arp_column_section_background_color();
$tablestring .= "<div class='column_level_settings' id='column_level_settings_new' data-column='main_" . $j . "'>";
$tablestring .= "<div class='btn-main'>";


$tablestring .= "<div class='arp_btn' id='column_level_options__button_1' data-level='column_level_options' style='display:none;' title='" . __('Column Settings', 'ARPricelite') . "' data-title='" . __('Column Settings', 'ARPricelite') . "'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/general-setting-icon.png'></div>";

$tablestring .= "<div class='arp_btn' id='column_level_options__button_2' data-level='column_level_options' style='display:none;' title='" . __('Background and Font Color', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Background and Font Color', ARPLITE_PT_TXTDOMAIN) . "' ><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/color_option_icon.png'></div>";

$tablestring .= "<div class='arp_btn action_btn' col-id=" . $col_no[1] . " data-level='column_level_options' id='duplicate_column' style='display:none;' title='" . __('Duplicate Column', 'ARPricelite') . "' data-title='" . __('Duplicate Column', 'ARPricelite') . "'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/duplicate-icon2.png' ></div>";

$tablestring .= "<div class='arp_btn action_btn' col-id=" . $col_no[1] . " data-level='column_level_options' id='delete_column' style='display:none;' title='" . __('Delete Column', 'ARPricelite') . "' data-title='" . __('Delete Column', 'ARPricelite') . "'>";
$tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/delete-icon2.png' >";

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
$tablestring .= "</div>";

$tablestring .= "<div class='arp_btn column_add_new_row_action_btn' id='add_new_row' data-id='" . $col_no[1] . "' title='" . __('Add New Row', 'ARPricelite') . "' data-title='" . __('Add New Row', 'ARPricelite') . "' data-level='body_li_level_options' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/add-icon2.png'></div>";

$tablestring .= "<div class='arp_btn' id='header_level_options__button_1' data-level='header_level_options' title='" . __('Header Settings', 'ARPricelite') . "' data-title='" . __('Header Settings', 'ARPricelite') . "' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/content-setting-icon.png'></div>";
$tablestring .= "<div class='arp_btn' id='header_level_options__button_2' data-level='header_level_options' title='" . __('Column Description Settings', 'ARPricelite') . "' data-title='" . __('Column Description Settings', 'ARPricelite') . "' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/description-setting-icon.png'></div>";
$tablestring .= "<div class='arp_btn' id='header_level_options__button_3' data-level='header_level_options' title='" . __('Media Settings', 'ARPricelite') . "' data-title='" . __('Media Settings', 'ARPricelite') . "' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/shortcode-setting-icon.png'></div>";

$tablestring .= "<div class='arp_btn' id='pricing_level_options__button_1' data-level='pricing_level_options' title='" . __('Price Settings', 'ARPricelite') . "' data-title='" . __('Price Settings', 'ARPricelite') . "'  style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/content-setting-icon.png'></div>";

$tablestring .= "<div class='arp_btn' id='pricing_level_options__button_3' data-level='pricing_level_options' title='" . __('Column Description Settings', 'ARPricelite') . "' data-title='" . __('Column Description Settings', 'ARPricelite') . "' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/description-icon3.png'></div>";

$tablestring .= "<div class='arp_btn' id='column_description_level__button_1' data-level='column_description_level' title='" . __('Column Description Settings', 'ARPricelite') . "' data-title='" . __('Column Description Settings', 'ARPricelite') . "' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/description-setting-icon.png'></div>";



$tablestring .= "<div class='arp_btn' id='body_li_level_options__button_1' data-level='body_li_level_options' title='" . __('Description Settings', 'ARPricelite') . "' data-title='" . __('Description Settings', 'ARPricelite') . "' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/content-setting-icon.png'></div>";

$tablestring .= "<div class='arp_btn' id='body_li_level_options__button_2' data-level='body_li_level_options' title='" . __('Tooltip Settings', 'ARPricelite') . "' data-title='" . __('Tooltip Settings', 'ARPricelite') . "' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/tooltip_settings.png'></div>";

$tablestring .= "<div class='arp_btn' id='body_li_level_options__button_3' data-level='body_li_level_options' title='" . __('Label Description Settings', 'ARPricelite') . "' data-title='" . __('Label Description Settings', 'ARPricelite') . "' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/lable-description-setting-icon.png'></div>";

$tablestring .= "<div class='arp_btn action_btn' id='add_new_row' data-id='" . $col_no[1] . "' title='" . __('Add New Row', 'ARPricelite') . "' data-title='" . __('Add New Row', 'ARPricelite') . "' data-level='body_li_level_options' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/add-icon2.png'></div>";
$tablestring .= "<div class='arp_btn action_btn' id='copy_row' alt='' col-id='" . $col_no[1] . "' title='" . __('Duplicate Row', 'ARPricelite') . "' data-title='" . __('Duplicate Row', 'ARPricelite') . "' data-level='body_li_level_options' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/duplicate-icon2.png'></div>";
$tablestring .= "<div class='arp_btn action_btn' id='remove_row' row-id='' col-id='" . $col_no[1] . "' title='" . __('Delete Row', 'ARPricelite') . "' data-title='" . __('Delete Row', 'ARPricelite') . "' data-level='body_li_level_options' style='display:none;'>";
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

//footer dbl click options
$tablestring .= "<div class='arp_btn' id='footer_level_options__button_1' data-level='footer_level_options' title='" . __('Footer General Settings', 'ARPricelite') . "' data-title='" . __('Footer General Settings', 'ARPricelite') . "' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/content-setting-icon.png'></div>";

// Button Options
$tablestring .= "<div class='arp_btn' id='footer_level_options__button_2' data-level='button_level_options' title='" . __('Button General Settings', 'ARPricelite') . "' data-title='" . __('Button General Settings', 'ARPricelite') . "' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/button_settings.png'></div>";
$tablestring .= "<div class='arp_btn' id='footer_level_options__button_3' data-level='button_level_options' title='" . __('Button Image Settings', 'ARPricelite') . "' data-title='" . __('Button Image Settings', 'ARPricelite') . "' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/buttonimage-setting-icon.png'></div>";
$tablestring .= "<div class='arp_btn' id='footer_level_options__button_4' data-level='button_level_options' title='" . __('Button Link/Script Settings', 'ARPricelite') . "' data-title='" . __('Button Link Settings', 'ARPricelite') . "' style='display:none;'><img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/buttonlink-setting-icon.png'></div>";

$tablestring .= "</div>";

$tablestring .= "<div class='column_level_options'>";

$tablestring .= "<div class='column_option_div' level-id='footer_level_options__button_1'>";

// start to add footer level column options

$tablestring .= "<div class='col_opt_row' id='footer_text'>";
$tablestring .= "<div class='col_opt_title_div two_column'>" . __('Footer Content', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div'>";

if (isset($columns['footer_content'])) {
    $footer_content_db = $columns['footer_content'];
} else {
    $footer_content_db = '';
}

$tablestring .= "<div class='option_tab' id='footer_yearly_tab'>";

$tablestring .= "<textarea name='footer_content_" . $col_no[1] . "' id='footer_content' data-column='main_" . $j . "' class='col_opt_textarea footer_content_first'>";
$tablestring .= $footer_content_db;
$tablestring .= "</textarea>";

$tablestring .= "</div>";


$tablestring .= "</div>";
$tablestring .= "</div>";
$tablestring .= "<div class='col_opt_row' id='above_below_button'>";
$tablestring .= "<div class='col_opt_title_div two_column'>" . __('Content Position', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div col_opt_input_div_bottom_margin'>";

if (!isset($columns['footer_content_position']) && empty($columns['footer_content_position'])) {
    $columns['footer_content_position'] = 0;
} else {
    $columns['footer_content_position'] = $columns['footer_content_position'];
}

foreach ($arplite_mainoptionsarr['general_options']['footer_content_position'] as $key => $above_below_array) {
    $tablestring .= "<input type='radio' class='arp_checkbox dark_bg' value='$key' id='footer_content_position_" . $key . "_" . $col_no[1] . "' name='footer_content_position_" . $col_no[1] . "' " . checked($key, $columns['footer_content_position'], false) . " data-column='main_" . $j . "' style='margin-left:10px;' /> <label id='footer_content_position_" . $key . "_" . $col_no[1] . "' for='footer_content_position_" . $key . "_" . $col_no[1] . "'>$above_below_array</label>";
}


$tablestring .= "</div>";
$tablestring .= "</div>";

$footer_text_alignment = isset($columns['footer_text_align']) ? $columns['footer_text_align'] : 'center';
$tablestring .= $arpricelite_form->arp_create_alignment_div('footer_text_alignment', $footer_text_alignment, 'arp_footer_text_alignment', $col_no[1], 'footer_section');
// Footer Background Color

$footer_background_color = (isset($columns['footer_background_color']) ) ? $columns['footer_background_color'] : '';

if ($footer_background_color == '') {
    if ($reference_template == 'arplitetemplate_1') {

        $footer_bg_col_key = 0;
    }
    $footer_background_color = (isset($template_section_array[$reference_template][$arp_template_skin]['arp_footer_background']) ) ? $template_section_array[$reference_template][$arp_template_skin]['arp_footer_background'][$footer_bg_col_key] : '';
}

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

$tablestring .= "<div class='arp_google_font_preview_note'><a target='_blank'  class='arp_google_font_preview_link' id='arp_footer_level_options_font_family_preview' href='" . $googlefontpreviewurl . $columns['footer_level_options_font_family'] . "'>" . __('Font Preview', 'ARPricelite') . "</a></div>";

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

$tablestring .= "</div>";

$tablestring .= "<div class='column_option_div' level-id='column_level_options__button_1'>";

$column_background_color_value = ( isset($columns['column_background_color']) && $columns['column_background_color'] != '' ) ? $columns['column_background_color'] : '#ffffff';

$tablestring .= "<div class='col_opt_row' id='column_other_background_image'>";
$tablestring .= "<div class='col_opt_title_div two_column'>" . __('Background Image', ARPLITE_PT_TXTDOMAIN) . "</div>";
$tablestring .= "<div class='col_opt_input_div two_column'>";
$tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster arplite_restricted_view' name='arp_column_background_image_" . $col_no[1] . "' id='arp_column_background_image' data-insert='arp_column_background_image_input' data-column='main_" . $j . "' title='" . __('Add Column Background Image', ARPLITE_PT_TXTDOMAIN) . "' data-title='" . __('Add Column Background Image', ARPLITE_PT_TXTDOMAIN) . "' style='float:right;'>";
$tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/image-icon.png' />";
$tablestring .= "</button>";
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "<div class='col_opt_row' id='column_highlight'>";
$tablestring .= "<div class='col_opt_title_div two_column'>" . __('Highlight Column', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div two_column'>";
$tablestring .= "<div class='arp_checkbox_div'>";
if ($column_highlight == 1) {
    $checked = "checked='checked'";
} else {
    $checked = '';
}
$tablestring .= "<input type='checkbox' class='arp_checkbox dark_bg' " . $checked . " value='1' id='column_highlight_input' name='column_highlight_" . $col_no[1] . "' data-column='main_" . $j . "' />";
$tablestring .= "<label class='arp_checkbox_label' data-for='column_highlight_input'>" . __('Yes', 'ARPricelite') . "</label>";
$tablestring .= "</div>";
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "<div class='col_opt_row' id='select_ribbon'>";
$tablestring .= "<div class='col_opt_title_div two_column'>" . __('Ribbon', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div two_column'>";
$tablestring .= "<button type='button' class='col_opt_btn' onclick='arp_select_ribbon(this)' name='ribbon_select_" . $j . "' id='ribbon_select' style='float:right;' data-column='main_" . $j . "'>";
$tablestring .= __('Select Ribbon', 'ARPricelite');
$tablestring .= "</button>";
$columns['ribbon_setting']['arp_ribbon'] = isset($columns['ribbon_setting']['arp_ribbon']) ? $columns['ribbon_setting']['arp_ribbon'] : "";
$tablestring .= "<input type='hidden' id='arp_ribbon_style_main' name='arp_ribbon_style_" . $col_no[1] . "' value='" . $columns['ribbon_setting']['arp_ribbon'] . "' />";
$columns['ribbon_setting']['arp_ribbon_bgcol'] = isset($columns['ribbon_setting']['arp_ribbon_bgcol']) ? $columns['ribbon_setting']['arp_ribbon_bgcol'] : "";
$tablestring .= "<input type='hidden' id='arp_ribbon_bgcol_main' name='arp_ribbon_bgcol_" . $col_no[1] . "' value='" . $columns['ribbon_setting']['arp_ribbon_bgcol'] . "' />";
$columns['ribbon_setting']['arp_ribbon_txtcol'] = isset($columns['ribbon_setting']['arp_ribbon_txtcol']) ? $columns['ribbon_setting']['arp_ribbon_txtcol'] : "";
$tablestring .= "<input type='hidden' id='arp_ribbon_textcol_main' name='arp_ribbon_textcol_" . $col_no[1] . "' value='" . $columns['ribbon_setting']['arp_ribbon_txtcol'] . "' />";
$columns['ribbon_setting']['arp_ribbon_position'] = isset($columns['ribbon_setting']['arp_ribbon_position']) ? $columns['ribbon_setting']['arp_ribbon_position'] : "";
$tablestring .= "<input type='hidden' id='arp_ribbon_position_main' name='arp_ribbon_position_" . $col_no[1] . "' value='" . $columns['ribbon_setting']['arp_ribbon_position'] . "' />";
$columns['ribbon_setting']['arp_ribbon_content'] = isset($columns['ribbon_setting']['arp_ribbon_content']) ? $columns['ribbon_setting']['arp_ribbon_content'] : "";
$tablestring .= "<input type='hidden' id='arp_ribbon_content_main' name='arp_ribbon_content_" . $col_no[1] . "' value='" . esc_html($columns['ribbon_setting']['arp_ribbon_content']) . "' />";
$tablestring .= "</div>";
if ($columns['ribbon_setting']['arp_ribbon'] != '') {
    $remove_ribbon_style = '';
} else {
    $remove_ribbon_style = "display:none;";
}
$tablestring .= "<div class='arp_google_font_preview_note' id='arp_remove_ribbon_container_" . $col_no[1] . "' style='" . $remove_ribbon_style . "'>";
$tablestring .= "<a class='arp_google_font_preview_link' data-column='main_column_" . $col_no[1] . "' id='arp_ribbon_remove' style='text-decoration:none;cursor:pointer;'>" . __('Remove Ribbon', 'ARPricelite') . "</a>";
$tablestring .= "</div>";

$tablestring .= "</div>";

$tablestring .= "<div class='col_opt_row arplite_restricted_view' id='post_variables_content'>";

$tablestring .= "<div class='col_opt_title_div'>";
$tablestring .= __('Post variables', 'ARPricelite');
$tablestring .= "</div>";

$tablestring .= "<div class='col_opt_input_div'>";

$disabled = "";
$tablestring .= "<textarea style='height:45px;' id='post_variables_content' name='post_variables_content_{$col_no[1]}' data-column='main_{$j}' class='col_opt_textarea' readonly='readonly' $disabled>";
$tablestring .= "</textarea>";
$tablestring .= "<span class='arp_note' id='post_variable_content_ex'>e.g. plan_id=" . $col_no[1] . ";type=arprice; </span>";
$tablestring .= "<span class='arp_note' id='post_variable_content_ex'> Add your variables with seperated by ; (semicolon). These variables will pass by GET method to specified URL upon button click. </span>";
$tablestring .= "</div>";

$tablestring .= "</div>";

$tablestring .= "<div class='col_opt_row arp_ok_div' id='column_level_other_arp_ok_div__button_1' style='display:none;'>";
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

$tablestring .= "<div class='column_option_div' level-id='column_level_options__button_2' style='display:none;'>";
$tablestring .="<div class='col_opt_row' id='arp_custom_color_tab_column' style='padding:0 !important;'>";
$tablestring .="<div class='col_opt_title_div two_column arp_color_tab_column selected' data-id='arp_normal'>" . __('Normal', ARPLITE_PT_TXTDOMAIN) . "</div>";
$tablestring .="<div class = 'col_opt_title_div two_column arp_color_tab_column' data-id = 'arp_hover'>" . __('Hover', ARPLITE_PT_TXTDOMAIN) . "</div>";
$tablestring .="</div>";
$tablestring .='<div class="col_opt_row" id="arp_normal_custom_color_tab_column" style="padding:0 !important;">';
$tablestring .='<div class="col_opt_title_div two_column"></div>';
$tablestring .='<div class="col_opt_title_div two_column" data-id="background_color" style="padding-top:5px !important;">' . __('Background', ARPLITE_PT_TXTDOMAIN) . '</div>';
$tablestring .='<div class="col_opt_title_div two_column" data-id="font_color" style="padding-top:5px !important;">' . __('Text Color', ARPLITE_PT_TXTDOMAIN) . '</div>';

$tablestring .='<div class="col_opt_row sub_row" id="arp_column_color_div" style="display:none">';
$tablestring .='<div class="col_opt_title_div two_column">' . __('Column', ARPLITE_PT_TXTDOMAIN) . '</div>';
$tablestring .='<div class="col_opt_input_div two_column first_picker column_background_color_div" id="column_background_color_div" style="display:none;">';
$column_background_color_value = (isset($columns['column_background_color']) && $columns['column_background_color'] != '' ) ? $columns['column_background_color'] : '#ffffff';
$tablestring .=$arpricelite_form->font_color_new('column_background_color_' . $col_no[1], 'main_' . $j, $column_background_color_value, 'column_background_color', $column_background_color_value, 'background_column_picker column_level_background', 'general_color_box_background_color background_color_' . $j);
$tablestring .= "</div>";
$tablestring .= "</div>";

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


$tablestring .='<div class="col_opt_row sub_row" id="arp_shortcode_div" style="display:none">';
$tablestring .='<div class="col_opt_title_div two_column" style="line-height:1.5">' . __('Shortcode Section', ARPLITE_PT_TXTDOMAIN) . '</div>';
$tablestring .='<div class="col_opt_input_div two_column first_picker arp_shortcode_background" id="arp_shortcode_background" style="display:none;">';
$shortcode_background_color = isset($columns['shortcode_background_color'])?$columns['shortcode_background_color']:'';
$tablestring .=$arpricelite_form->font_color_new('shortcode_background_color_' . $col_no[1], 'main_' . $j, $shortcode_background_color, 'shortcode_background_color', $shortcode_background_color, 'shortcode_background_color', 'general_color_box_background_color');
$tablestring .= "</div>";
$tablestring .='<div class="col_opt_input_div two_column second_picker arp_shortcode_font_color" id="arp_shortcode_font_color" style="display:none;">';
$columns['shortcode_font_color'] = isset($columns['shortcode_font_color'])?$columns['shortcode_font_color']:'';
$tablestring .=$arpricelite_form->font_color_new('shortcode_font_color_' . $col_no[1], 'main_' . $j, @$columns['shortcode_font_color'], 'shortcode_font_color', @$columns['shortcode_font_color']);
$tablestring .= "</div>";
$tablestring .= "</div>";


$tablestring .='<div class="col_opt_row sub_row" id="arp_desc_color_div" style="display:none">';
$tablestring .='<div class="col_opt_title_div two_column">' . __('Description', ARPLITE_PT_TXTDOMAIN) . '</div>';
$tablestring .='<div class="col_opt_input_div two_column first_picker desc_background_color_div" id="desc_background_color_div" style="display:none;">';
$columns['column_desc_background_color'] = isset($columns['column_desc_background_color'])?$columns['column_desc_background_color']:'';
$tablestring .=$arpricelite_form->font_color_new('column_desc_background_color_' . $col_no[1], 'main_' . $j, @$columns['column_desc_background_color'], 'column_desc_background_color', @$columns['column_desc_background_color']);
$tablestring .= "</div>";
$tablestring .='<div class="col_opt_input_div two_column second_picker desc_font_color_div" id="desc_font_color_div" style="display:none;">';
$tablestring .=$arpricelite_form->font_color_new('column_description_font_color_' . $col_no[1], 'main_' . $j, @$columns['column_description_font_color'], 'column_description_font_color', @$columns['column_description_font_color']);
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .='<div class="col_opt_row sub_row" id="arp_price_color_div" style="display:none">';
$tablestring .='<div class="col_opt_title_div two_column">' . __('Pricing', ARPLITE_PT_TXTDOMAIN) . '</div>';
$tablestring .='<div class="col_opt_input_div two_column first_picker price_background_color_div" id="price_background_color_div" style="display:none;">';
$price_background_color_value = isset($columns['price_background_color'])?$columns['price_background_color']:'';
$tablestring .=$arpricelite_form->font_color_new('price_background_color_' . $col_no[1], 'main_' . $j, $price_background_color_value, 'price_background_color', $price_background_color_value, 'background_column_picker', 'general_color_box_background_color');
$tablestring .= "</div>";
$tablestring .='<div class="col_opt_input_div two_column second_picker price_font_color_div" id="price_font_color_div" style="display:none;">';
$tablestring .=$arpricelite_form->font_color_new('price_font_color_' . $col_no[1], 'main_' . $j, @$columns['price_font_color'], 'price_font_color', @$columns['price_font_color']);
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .='<div class="col_opt_row sub_row" id="arp_footer_color_div" style="display:none">';
$tablestring .='<div class="col_opt_title_div two_column">' . __('Footer', ARPLITE_PT_TXTDOMAIN) . '</div>';
$tablestring .='<div class="col_opt_input_div two_column first_picker footer_background_color_div" id="footer_background_color_div" style="display:none;">';
$footer_background_color = isset($columns['footer_background_color']) ? $columns['footer_background_color'] : '';
$tablestring .=$arpricelite_form->font_color_new("footer_bg_color_{$col_no[1]}", "main_{$j}", $footer_background_color, 'footer_background_color', $footer_background_color, 'footer_background_color_picker', '');
$tablestring .= "</div>";
$tablestring .='<div class="col_opt_input_div two_column second_picker footer_font_color_div" id="footer_font_color_div" style="display:none;">';
$tablestring .=$arpricelite_form->font_color_new('footer_level_options_font_color_' . $col_no[1], 'main_' . $j, @$columns['footer_level_options_font_color'], 'footer_level_options_font_color', @$columns['footer_level_options_font_color']);
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .='<div class="col_opt_row sub_row" id="arp_button_color_div" style="display:none">';
$tablestring .='<div class="col_opt_title_div two_column">' . __('Button', ARPLITE_PT_TXTDOMAIN) . '</div>';
$tablestring .='<div class="col_opt_input_div two_column first_picker button_background_color_div" id="button_background_color_div" style="display:none;">';
$button_background_color_value = ($columns['button_background_color'] != '' ) ? $columns['button_background_color'] : '#00baff';
$tablestring .=$arpricelite_form->font_color_new('button_background_color_' . $col_no[1], 'main_' . $j, $button_background_color_value, 'button_background_color', $button_background_color_value, 'background_column_picker button_background_color', 'general_color_box_background_color');
$tablestring .= "</div>";
$tablestring .='<div class="col_opt_input_div two_column second_picker button_font_color_div" id="button_font_color_div" style="display:none;">';


$tablestring .=$arpricelite_form->font_color_new('button_font_color_' . $col_no[1], 'main_' . $j, @$columns['button_font_color'], 'button_font_color', @$columns['button_font_color']);
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
$tablestring .=$arpricelite_form->font_color_new('content_odd_color_' . $col_no[1], 'main_' . $j, @$columns['content_odd_color'], 'content_odd_color', @$columns['content_odd_color']);
$tablestring .= "</div>";
$tablestring .='<div class="col_opt_input_div two_column second_picker odd_font_color_div" id="odd_font_color_div" style="display:none;">';
$tablestring .=$arpricelite_form->font_color_new('content_font_color_' . $col_no[1], 'main_' . $j, @$columns['content_font_color'], 'content_font_color', @$columns['content_font_color']);
$tablestring .= "</div>";
$tablestring .= "</div>";
$columns['content_even_color'] = isset($columns['content_even_color']) ? $columns['content_even_color'] : '';
$tablestring .='<div class="col_opt_row sub_row" id="arp_even_color_div" style="display:none">';
$tablestring .='<div class="col_opt_title_div two_column">' . __('Even', ARPLITE_PT_TXTDOMAIN) . '</div>';
$tablestring .='<div class="col_opt_input_div two_column first_picker even_background_color_div" id="even_background_color_div" style="display:none;">';
$tablestring .=$arpricelite_form->font_color_new('content_even_color_' . $col_no[1], 'main_' . $j, $columns['content_even_color'], 'content_even_color', $columns['content_even_color']);
$tablestring .= "</div>";
$tablestring .='<div class="col_opt_input_div two_column second_picker even_font_color_div" id="even_font_color_div" style="display:none;">';
$columns['content_even_font_color'] = isset($columns['content_even_font_color']) ? $columns['content_even_font_color'] : @$columns['content_font_color'];
$tablestring .=$arpricelite_form->font_color_new('content_even_font_color_' . $col_no[1], 'main_' . $j, $columns['content_even_font_color'], 'content_even_font_color', $columns['content_even_font_color']);
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .='</div>';

/* Normal End Hover Start */
$tablestring .='<div class="col_opt_row" id="arp_hover_background_color_column" style="padding:0 !important;">';

$tablestring .='<div class="col_opt_title_div two_column"></div>';
$tablestring .='<div class="col_opt_title_div two_column" data-id="background_color" style="padding-top:5px !important;">' . __('Background', ARPLITE_PT_TXTDOMAIN) . '</div>';
$tablestring .='<div class="col_opt_title_div two_column" data-id="font_color" style="padding-top:5px !important;">' . __('Text Color', ARPLITE_PT_TXTDOMAIN) . '</div>';


$tablestring .='<div class="col_opt_row sub_row" id="arp_column_hover_color_div_column" style="display:none">';
$tablestring .='<div class="col_opt_title_div two_column">' . __('Column', ARPLITE_PT_TXTDOMAIN) . '</div>';
$tablestring .='<div class="col_opt_input_div two_column first_picker column_hover_background_color_div" id="column_hover_background_color_div" style="display:none;">';
$column_hover_background_color_value = isset($columns['column_hover_background_color']) ? $columns['column_hover_background_color'] : '';
$tablestring .=$arpricelite_form->font_color_new('column_hover_background_color_' . $col_no[1], 'main_' . $j, $column_background_color_value, 'column_hover_background_color', $column_hover_background_color_value, 'background_column_picker column_level_hover_background', 'general_color_box_background_color background_color_' . $j);
$tablestring .= "</div>";

$tablestring .= "</div>";


$tablestring .='<div class="col_opt_row sub_row" id="arp_header_hover_color_div" style="display:none">';
$tablestring .='<div class="col_opt_title_div two_column">' . __('Header', ARPLITE_PT_TXTDOMAIN) . '</div>';
$tablestring .='<div class="col_opt_input_div two_column first_picker header_hover_background_color_div" id="header_hover_background_color_div" style="display:none;">';
if (isset($columns['header_hover_background_color'])) {
    $header_hover_background_color_value = $columns['header_hover_background_color'];
} else {
    $header_hover_background_color_value = '';
}
$tablestring .=$arpricelite_form->font_color_new('header_hover_background_color_' . $col_no[1], 'main_' . $j, $header_hover_background_color_value, 'header_hover_background_color', $header_hover_background_color_value, 'background_column_picker header_hover_background_color', 'general_color_box_background_color');
$tablestring .= "</div>";
$tablestring .='<div class="col_opt_input_div two_column second_picker header_hover_font_color_div" id="header_hover_font_color_div" style="display:none;">';
$header_hover_font_color_value = isset($columns['header_hover_font_color']) ? $columns['header_hover_font_color'] : '';
$tablestring .=$arpricelite_form->font_color_new('header_hover_font_color_' . $col_no[1], 'main_' . $j, $header_hover_font_color_value, 'header_hover_font_color', $header_hover_font_color_value, 'background_column_picker header_hover_font_color', 'general_color_box_background_color');
$tablestring .= "</div>";
$tablestring .= "</div>";



$tablestring .='<div class="col_opt_row sub_row" id="arp_shortcode_hover_div" style="display:none">';
$tablestring .='<div class="col_opt_title_div two_column"  style="line-height:1.5">' . __('Shortcode Section', ARPLITE_PT_TXTDOMAIN) . '</div>';
$tablestring .='<div class="col_opt_input_div two_column first_picker arp_shortcode_hover_background" id="arp_shortcode_hover_background" style="display:none;">';
$shortcode_hover_background_color = isset($columns['shortcode_hover_background_color'])?$columns['shortcode_hover_background_color']:'';
$tablestring .=$arpricelite_form->font_color_new('shortcode_hover_background_color_' . $col_no[1], 'main_' . $j, $shortcode_hover_background_color, 'shortcode_hover_background_color', $shortcode_hover_background_color, 'shortcode_hover_background_color', 'general_color_box_background_color');
$tablestring .= "</div>";
$tablestring .='<div class="col_opt_input_div two_column second_picker arp_shortcode_hover_font_color" id="arp_shortcode_hover_font_color" style="display:none;">';
$columns['shortcode_hover_font_color'] = isset($columns['shortcode_hover_font_color'])?$columns['shortcode_hover_font_color']:'';
$tablestring .=$arpricelite_form->font_color_new('shortcode_hover_font_color_' . $col_no[1], 'main_' . $j, @$columns['shortcode_hover_font_color'], 'shortcode_hover_font_color', @$columns['shortcode_hover_font_color']);
$tablestring .= "</div>";
$tablestring .= "</div>";


$tablestring .='<div class="col_opt_row sub_row" id="arp_desc_hover_color_div" style="display:none">';
$tablestring .='<div class="col_opt_title_div two_column">' . __('Description', ARPLITE_PT_TXTDOMAIN) . '</div>';
$tablestring .='<div class="col_opt_input_div two_column first_picker desc_hover_background_color_div" id="desc_hover_background_color_div" style="display:none;">';
$columns['column_desc_hover_background_color'] = isset($columns['column_desc_hover_background_color']) ? $columns['column_desc_hover_background_color'] : '';
$tablestring .=$arpricelite_form->font_color_new('column_desc_hover_background_color_' . $col_no[1], 'main_' . $j, $columns['column_desc_hover_background_color'], 'column_desc_hover_background_color', $columns['column_desc_hover_background_color']);
$tablestring .= "</div>";
$tablestring .='<div class="col_opt_input_div two_column second_picker desc_hover_font_color_div" id="desc_hover_font_color_div" style="display:none;">';
$column_description_hover_font_color_value = isset($columns['column_description_hover_font_color']) ? $columns['column_description_hover_font_color'] : '';
$tablestring .=$arpricelite_form->font_color_new('column_description_hover_font_color_' . $col_no[1], 'main_' . $j, $column_description_hover_font_color_value, 'column_description_hover_font_color', $column_description_hover_font_color_value, 'background_column_picker column_description_hover_font_color', 'general_color_box_background_color');
$tablestring .= "</div>";
$tablestring .= "</div>";




$tablestring .='<div class="col_opt_row sub_row" id="arp_price_hover_color_div" style="display:none">';
$tablestring .='<div class="col_opt_title_div two_column">' . __('Pricing', ARPLITE_PT_TXTDOMAIN) . '</div>';
$tablestring .='<div class="col_opt_input_div two_column first_picker price_hover_background_color_div" id="price_hover_background_color_div" style="display:none;">';
$price_hover_background_color_value = isset($columns['price_hover_background_color']) ? $columns['price_hover_background_color'] : '';
$tablestring .=$arpricelite_form->font_color_new('price_hover_background_color_' . $col_no[1], 'main_' . $j, $price_hover_background_color_value, 'price_hover_background_color', $price_hover_background_color_value, 'background_column_picker', 'general_color_box_background_color');
$tablestring .= "</div>";
$price_hover_font_color_value = isset($columns['price_hover_font_color']) ? $columns['price_hover_font_color'] : '';
$tablestring .='<div class="col_opt_input_div two_column second_picker price_hover_font_color_div" id="price_hover_font_color_div" style="display:none;">';
$tablestring .=$arpricelite_form->font_color_new('price_hover_font_color_' . $col_no[1], 'main_' . $j, $price_hover_font_color_value, 'price_hover_font_color', $price_hover_font_color_value, 'background_column_picker price_hover_font_color', 'general_color_box_background_color');
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .='<div class="col_opt_row sub_row" id="arp_footer_hover_color_div" style="display:none">';
$tablestring .='<div class="col_opt_title_div two_column">' . __('Footer', ARPLITE_PT_TXTDOMAIN) . '</div>';
$tablestring .='<div class="col_opt_input_div two_column first_picker footer_hover_background_color_div" id="footer_hover_background_color_div" style="display:none;">';
$footer_hover_background_color = isset($columns['footer_hover_background_color']) ? $columns['footer_hover_background_color'] : '';
$tablestring .=$arpricelite_form->font_color_new("footer_hover_bg_color_{$col_no[1]}", "main_{$j}", $footer_hover_background_color, 'footer_hover_background_color', $footer_hover_background_color, 'footer_hover_background_color_picker', '');
$tablestring .= "</div>";
$tablestring .='<div class="col_opt_input_div two_column second_picker footer_hover_font_color_div" id="footer_hover_font_color_div" style="display:none;">';
$footer_hover_font_color_value = isset($columns['footer_level_options_hover_font_color']) ? $columns['footer_level_options_hover_font_color'] : '';
$tablestring .=$arpricelite_form->font_color_new('footer_level_options_hover_font_color_' . $col_no[1], 'main_' . $j, $footer_hover_font_color_value, 'footer_hover_font_color', $footer_hover_font_color_value, 'background_column_picker footer_hover_font_color', 'general_color_box_background_color');
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .='<div class="col_opt_row sub_row" id="arp_hover_button_color_div" style="display:none">';
$tablestring .='<div class="col_opt_title_div two_column">' . __('Button', ARPLITE_PT_TXTDOMAIN) . '</div>';
$tablestring .='<div class="col_opt_input_div two_column first_picker button_hover_background_color_div" id="button_hover_background_color_div" style="display:none;">';
$button_hover_background_color_value = (isset($columns['button_hover_background_color']) && $columns['button_hover_background_color'] != '' ) ? $columns['button_hover_background_color'] : '';
$tablestring .=$arpricelite_form->font_color_new('button_hover_background_color_' . $col_no[1], 'main_' . $j, $button_hover_background_color_value, 'button_hover_background_color', $button_hover_background_color_value, 'background_column_picker button_hover_background_color', 'general_color_box_background_color');
$tablestring .= "</div>";
$tablestring .='<div class="col_opt_input_div two_column second_picker button_hover_font_color_div" id="button_hover_font_color_div" style="display:none;">';
$button_hover_font_color_value = isset($columns['button_hover_font_color']) ? $columns['button_hover_font_color'] : '';
$tablestring .=$arpricelite_form->font_color_new('button_hover_font_color_' . $col_no[1], 'main_' . $j, $button_hover_font_color_value, 'button_hover_font_color', $button_hover_font_color_value, 'background_column_picker button_hover_font_color', 'general_color_box_background_color');
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .='<div class="col_opt_row" id="arp_body_hover_background_color_div" style="padding:0 !important;">';
$tablestring .='<div class="col_opt_title_div">' . __("Body Row Colors", ARPLITE_PT_TXTDOMAIN) . '</div>';
$tablestring .='<div class="col_opt_title_div two_column"></div>';
$tablestring .='<div class="col_opt_title_div two_column" data-id="background_color" style="padding-top:5px !important;">' . __('Background', ARPLITE_PT_TXTDOMAIN) . '</div>';
$tablestring .='<div class="col_opt_title_div two_column" data-id="font_color" style="padding-top:5px !important;">' . __('Text Color', ARPLITE_PT_TXTDOMAIN) . '</div>';
$tablestring .='</div>';

$tablestring .='<div class="col_opt_row sub_row" id="arp_odd_hover_color_div" style="display:none">';
$tablestring .='<div class="col_opt_title_div two_column">' . __('Odd', ARPLITE_PT_TXTDOMAIN) . '</div>';
$tablestring .='<div class="col_opt_input_div two_column first_picker odd_hover_background_color_div" id="odd_hover_background_color_div" style="display:none;">';
$columns['content_odd_hover_color'] = isset($columns['content_odd_hover_color']) ? $columns['content_odd_hover_color'] : '';
$tablestring .=$arpricelite_form->font_color_new('content_odd_hover_color_' . $col_no[1], 'main_' . $j, $columns['content_odd_hover_color'], 'content_odd_hover_color', $columns['content_odd_hover_color']);
$tablestring .= "</div>";
$tablestring .='<div class="col_opt_input_div two_column second_picker odd_hover_font_color_div" id="odd_hover_font_color_div" style="display:none;">';
$content_hover_font_color_value = isset($columns['content_hover_font_color']) ? $columns['content_hover_font_color'] : '';
$tablestring .=$arpricelite_form->font_color_new('content_hover_font_color_' . $col_no[1], 'main_' . $j, $content_hover_font_color_value, 'content_hover_font_color', $content_hover_font_color_value, 'background_column_picker content_hover_font_color', 'general_color_box_background_color');
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .='<div class="col_opt_row sub_row" id="arp_even_hover_color_div" style="display:none">';
$tablestring .='<div class="col_opt_title_div two_column">' . __('Even', ARPLITE_PT_TXTDOMAIN) . '</div>';
$tablestring .='<div class="col_opt_input_div two_column first_picker even_hover_background_color_div" id="even_hover_background_color_div" style="display:none;">';
$columns['content_even_hover_color'] = isset($columns['content_even_hover_color']) ? $columns['content_even_hover_color'] : '';
$tablestring .=$arpricelite_form->font_color_new('content_even_hover_color_' . $col_no[1], 'main_' . $j, $columns['content_even_hover_color'], 'content_even_hover_color', $columns['content_even_hover_color']);
$tablestring .= "</div>";
$tablestring .='<div class="col_opt_input_div two_column second_picker even_font_color_div" id="even_hover_font_color_div" style="display:none;">';
$content_even_hover_font_color = isset($columns['content_even_hover_font_color']) ? $columns['content_even_hover_font_color'] : '';
$tablestring .=$arpricelite_form->font_color_new('content_even_hover_font_color_' . $col_no[1], 'main_' . $j, $content_even_hover_font_color, 'content_even_hover_font_color', $content_even_hover_font_color, 'background_column_picker content_even_hover_font_color', 'general_color_box_background_color');
$tablestring .= "</div>";
$tablestring .= "</div>";




/* Hover Color Ends Here */
$tablestring .='</div>';


$tablestring .= "<div class='col_opt_row arp_ok_div' id='column_level_other_arp_ok_div__button_2' style='display:none;'>";
$tablestring .= "<div class='col_opt_btn_div'>";
$tablestring .= "<div class='col_opt_navigation_div'>";
$tablestring .= "<i class='fa fa-long-arrow-left arp_navigation_arrow' id='column_left_arrow' data-column='{$col_no[1]}' data-button-id='column_level_options__button_2'></i>&nbsp;";
$tablestring .= "<i class='fa fa-long-arrow-right arp_navigation_arrow' id='column_right_arrow' data-column='{$col_no[1]}' data-button-id='column_level_options__button_2'></i>&nbsp;";
$tablestring .= "</div>";
$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
$tablestring .= __('Ok', 'ARPricelite');
$tablestring .= "</button>";
$tablestring .= "</div>";
$tablestring .= "</div>";


$tablestring .= "</div>";



$tablestring .= "<div class='column_option_div' level-id='header_level_options__button_1' >";

$tablestring .= "<div class='col_opt_row' id='column_title'>";
$tablestring .= "<div class='col_opt_title_div'>" . __('Column Title', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div'>";
$col_no = explode('_', $j);
if (in_array('arp_object', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_1']) || in_array('arp_fontawesome', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_1'])) {

    $tablestring .= "<div class='option_tab' id='header_yearly_tab'>";
    $tablestring .= "<textarea name='column_title_" . $col_no[1] . "' id='column_title_input' data-column='main_" . $j . "' class='col_opt_textarea column_title_first' style='margin-bottom:10px;' >";
    $tablestring .= $columns['package_title'];
    $tablestring .= "</textarea>";
    $tablestring .= "</div>";
} else {

    $tablestring .= "<input type='text' name='column_title_" . $col_no[1] . "' id='column_title_input' data-column='main_" . $j . "' class='col_opt_input' value='" . $columns["package_title"] . "'  />";
}
$tablestring .= "</div>";

$tablestring .= "<div class='col_opt_button'>";
if (in_array('arp_object', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_1'])) {
    $tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster align_left' name='add_header_object_" . $col_no[1] . "' id='add_arp_object' data-insert='column_title_input' data-column='main_" . $j . "' title='" . __('Add Media', 'ARPricelite') . "' data-title='" . __('Add Media', 'ARPricelite') . "'>";
    $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/image-icon.png' />";

    $tablestring .= "</button>";
    $tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";
}

if (in_array('arp_fontawesome', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_1'])) {

    $tablestring .= "<button type='button' class='col_opt_btn_icon arptooltipster add_header_fontawesome align_left' name='add_header_fontawesome_" . $col_no[1] . "' id='add_header_fontawesome' data-insert='column_title_input' data-column='main_" . $j . "' data-title='" . __('Add Font Icon', 'ARPricelite') . "' title='" . __('Add Font Icon', 'ARPricelite') . "' >";
    $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/font-awesome-icon.png' />";
    $tablestring .= "</button>";

    $tablestring .= "<div class='arp_font_awesome_model_box_container'>";

    $tablestring .= "</div>";
}

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

$tablestring .= "</div>";
$tablestring .= "</div>";

$header_text_align = isset($columns['header_font_align']) ? $columns['header_font_align'] : 'center';
$tablestring .= $arpricelite_form->arp_create_alignment_div('header_text_alignment', $header_text_align, 'arp_header_text_alignment', $col_no[1], 'header_section');

if ($reference_template == 'arplitetemplate_1') {
    if (isset($columns['header_background_color']) && $columns['header_background_color'] != '') {
        $header_background_color_value = $columns['header_background_color'];
    } else {
        $col_key_header = $col_no[1] % 5;
        if ($col_key_header == 0)
            $col_key_header = 5;
        $header_background_color_value = $template_section_array[$reference_template][$arp_template_skin]['arp_header_background'][$col_key_header];
    }
}

if ($reference_template == 'arplitetemplate_8') {
    if (isset($columns['header_background_color']) && $columns['header_background_color'] != '') {
        $header_background_color_value = $columns['header_background_color'];
    } else {
        if ($arp_template_skin == 'multicolor') {
            $col_key_button = ($col_no[1] + 1) % 5;
            if ($col_key_button == 0)
                $col_key_button = 5;
            $header_background_color_value = $template_section_array[$reference_template][$arp_template_skin]['arp_header_background'][$col_key_button];
        } else {
            $header_background_color_value = $template_section_array[$reference_template][$arp_template_skin]['arp_header_background'][0];
        }
    }
}


if ($reference_template == 'arplitetemplate_11') {
    if (isset($columns['header_background_color']) && $columns['header_background_color'] != '') {
        $header_background_color_value = $columns['header_background_color'];
    } else {
        $header_background_color_value = '#414045';
    }
}

$tablestring .= "<div class='col_opt_row' id='header_other_background_image'>";
$tablestring .= "<div class='col_opt_title_div two_column'>" . __('Background Image', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div two_column'>";
$tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster align_left' name='arp_header_background_image_" . $col_no[1] . "' id='arp_header_background_image' data-insert='arp_header_background_image_input' data-column='main_" . $j . "' title='" . __('Add Header Background Image', 'ARPricelite') . "' data-title='" . __('Add Header Background Image', 'ARPricelite') . "' style='float:right;'>";
$tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/image-icon.png' />";
$tablestring .= "</button>";
$tablestring .= "<input type='hidden' name='arp_header_background_image_" . $col_no[1] . "' value='' id='arp_header_background_image_input' />";
$tablestring .= "<div class='arp_add_image_container arp_header_image_container'>";
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

$tablestring .= "<div class='arp_add_img_row' style='margin-top:10px;'>";
$tablestring .= "<div class='arp_add_img_label'>";
$tablestring .= '<button type="button" onclick="arp_add_object(this);" class="arp_modal_insert_shortcode_btn" name="rpt_image_btn" id="rpt_image_btn">';
$tablestring .= __('Add', 'ARPricelite');
$tablestring .= '</button>';
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "</div>";
$tablestring .= "</div>";
$tablestring .= "</div>";

$remove_link = "display:none;";
if (isset($columns['header_background_image']) && $columns['header_background_image'] != '') {
    $remove_link = "";
}

$tablestring .= "<div class='arp_google_font_preview_note' id='arp_remove_header_image_link' style='$remove_link'>";
$tablestring .= "<a href='javascript:arp_remove_object(\"main_column_" . $col_no[1] . "\",\"arp_header_background_image_input\")'  class='arp_google_font_preview_link'>";
$tablestring .= __('Remove Image', 'ARPricelite');
$tablestring .= "</a>";
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "<div class='col_opt_row' id='header_other_font_family'>";
$tablestring .= "<div class='col_opt_title_div'>" . __('Font Family', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div'>";

$tablestring .= "<input type='hidden' id='header_font_family' name='header_font_family_" . $col_no[1] . "' value='" . $columns['header_font_family'] . "' data-column='main_" . $j . "' />";
$tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='header_font_family_" . $col_no[1] . "' data-id='header_font_family_" . $col_no[1] . "'>";
$tablestring .= "<dt><span>" . $columns['header_font_family'] . "</span><input type='text' style='display:none;' value='" . $columns['header_font_family'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
$tablestring .= "<dd>";
$tablestring .= "<ul data-id='header_font_family' data-column='" . $j . "'>";



$tablestring .= "</ul>";
$tablestring .= "</dd>";
$tablestring .= "</dl>";

$tablestring .= "<div class='arp_google_font_preview_note'><a target='_blank'  class='arp_google_font_preview_link' id='arp_header_font_family_preview' href='" . $googlefontpreviewurl . $columns['header_font_family'] . "'>" . __('Font Preview', 'ARPricelite') . "</a></div>";

$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "<div class='col_opt_row' id='header_other_font_size'>";
$tablestring .= "<div class='btn_type_size'>";
$tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Size', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div two_column'>";

$tablestring .= "<input type='hidden' id='header_font_size' name='header_font_size_" . $col_no[1] . "' data-column='main_" . $j . "' value='" . $columns['header_font_size'] . "' />";
$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='header_font_size_" . $col_no[1] . "' data-id='header_font_size_" . $col_no[1] . "' style='width:115px;max-width:115px;'>";
$tablestring .= "<dt><span>" . $columns['header_font_size'] . "</span><input type='text' style='display:none;' value='" . $columns['header_font_size'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
$tablestring .= "<dd>";
$tablestring .= "<ul data-id='header_font_size' data-column='" . $j . "'>";
$size_arr = array();
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

$tablestring .= "<div class='col_opt_row' id='header_other_font_color'>";
$tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Style', 'ARPricelite') . "</div>";

//new font style btns
//check selected for bold
$tablestring .= "<div class='col_opt_input_div' data-level='header_level_options' level-id='header_button1' >";

if ($columns['header_style_bold'] == 'bold') {
    $header_style_bold_selected = 'selected';
} else {
    $header_style_bold_selected = '';
}

//check selected for italic

if ($columns['header_style_italic'] == 'italic') {
    $header_style_italic_selected = 'selected';
} else {
    $header_style_italic_selected = '';
}

//check selected for underline or line-through

if ($columns['header_style_decoration'] == 'underline') {
    $header_style_underline_selected = 'selected';
} else {
    $header_style_underline_selected = '';
}

if ($columns['header_style_decoration'] == 'line-through') {
    $header_style_linethrough_selected = 'selected';
} else {
    $header_style_linethrough_selected = '';
}



$tablestring .= "<div class='arp_style_btn " . $header_style_bold_selected . "  arptooltipster' data-align='left' title='" . __('Bold', 'ARPricelite') . "' data-title='" . __('Bold', 'ARPricelite') . "' data-column='main_" . $j . "' id='arp_style_bold' data-id='" . $col_no[1] . "'>";
$tablestring .= "<i class='fa fa-bold'></i>";
$tablestring .= "</div>";

$tablestring .= "<div class='arp_style_btn " . $header_style_italic_selected . " arptooltipster' data-align='center' title='" . __('Italic', 'ARPricelite') . "' data-title='" . __('Italic', 'ARPricelite') . "' data-column='main_" . $j . "' id='arp_style_italic' data-id='" . $col_no[1] . "'>";
$tablestring .= "<i class='fa fa-italic'></i>";
$tablestring .= "</div>";

$tablestring .= "<div class='arp_style_btn " . $header_style_underline_selected . " arptooltipster' data-align='right' title='" . __('Underline', 'ARPricelite') . "' data-title='" . __('Underline', 'ARPricelite') . "' data-column='main_" . $j . "' id='arp_style_underline' data-id='" . $col_no[1] . "'>";
$tablestring .= "<i class='fa fa-underline'></i>";
$tablestring .= "</div>";

$tablestring .= "<div class='arp_style_btn " . $header_style_linethrough_selected . " arptooltipster' data-align='right' title='" . __('Line-through', 'ARPricelite') . "' data-title='" . __('Line-through', 'ARPricelite') . "' data-column='main_" . $j . "' id='arp_style_strike' data-id='" . $col_no[1] . "'>";
$tablestring .= "<i class='fa fa-strikethrough'></i>";
$tablestring .= "</div>";


$tablestring .= "<input type='hidden' id='header_style_bold' name='header_style_bold_" . $col_no[1] . "' value='" . $columns['header_style_bold'] . "' /> ";
$tablestring .= "<input type='hidden' id='header_style_italic' name='header_style_italic_" . $col_no[1] . "' value='" . $columns['header_style_italic'] . "' /> ";
$tablestring .= "<input type='hidden' id='header_style_decoration' name='header_style_decoration_" . $col_no[1] . "' value='" . $columns['header_style_decoration'] . "' /> ";



$tablestring .= "</div>";


$tablestring .= "</div>";


$tablestring .= "<div class='col_opt_row arp_ok_div' id='header_level_other_arp_ok_div__button_1'>";
$tablestring .= "<div class='col_opt_btn_div'>";
$tablestring .= "<div class='col_opt_navigation_div'>";
$tablestring .= "<i class='fa fa-long-arrow-left arp_navigation_arrow' id='header_left_arrow' data-column='{$col_no[1]}' data-button-id='header_level_options__button_1'></i>&nbsp;";
$tablestring .= "<i class='fa fa-long-arrow-right arp_navigation_arrow' id='header_right_arrow' data-column='{$col_no[1]}' data-button-id='header_level_options__button_1'></i>&nbsp;";
$tablestring .= "</div>";
$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
$tablestring .= __('Ok', 'ARPricelite');
$tablestring .= "</button>";
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "</div>";

// COLUMN DESCRIPTION

$tablestring .= "<div class='column_option_div' level-id='header_level_options__button_2' style='display:none;'>";
$arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_2'] = isset($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_2']) ? $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_2'] : "";
if (is_array($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_2'])) {
    if (in_array('column_description', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_2'])) {

        $tablestring .= "<div class='col_opt_row' id='column_description'>";
        $tablestring .= "<div class='col_opt_title_div'>" . __('Column Description', 'ARPricelite') . "</div>";
        $tablestring .= "<div class='col_opt_input_div'>";
        $tablestring .= "<div class='option_tab' id='column_description_yearly_tab'>";
        $tablestring .= "<textarea id='arp_column_description' name='arp_column_description_" . $col_no[1] . "'  class='col_opt_textarea arp_column_description_first' data-column='main_column_" . $col_no[1] . "'>";
        $tablestring .= stripslashes_deep($columns['column_description']);
        $tablestring .= "</textarea>";
        $tablestring .= "</div>";
        $tablestring .= "<div class='option_tab' id='column_description_monthly_tab' style='display:none;'>";
        $tablestring .= "<textarea id='arp_column_description_second' name='arp_column_description_second_" . $col_no[1] . "'  class='col_opt_textarea arp_column_description_second' data-column='main_column_" . $col_no[1] . "'>";
        $tablestring .= stripslashes_deep($columns['column_description_second']);
        $tablestring .= "</textarea>";
        $tablestring .= "</div>";
        $tablestring .= "<div class='option_tab' id='column_description_quarterly_tab' style='display:none;'>";
        $tablestring .= "<textarea id='arp_column_description_third' name='arp_column_description_third_" . $col_no[1] . "'  class='col_opt_textarea arp_column_description_third' data-column='main_column_" . $col_no[1] . "'>";
        $tablestring .= stripslashes_deep($columns['column_description_third']);
        $tablestring .= "</textarea>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        $tablestring .= "<div class='col_opt_button'>";
        if (in_array('arp_object', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_2'])) {
            $tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster align_left' name='add_header_object_" . $col_no[1] . "' id='add_arp_object' data-insert='arp_column_description' data-column='main_" . $j . "' title='" . __('Add Media', 'ARPricelite') . "' data-title='" . __('Add Media', 'ARPricelite') . "'>";
            $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/image-icon.png' />";

            $tablestring .= "</button>";
            $tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";
        }

        if (in_array('arp_fontawesome', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_2'])) {
            $tablestring .= "<button type='button' class='col_opt_btn_icon arptooltipster add_header_fontawesome align_left' name='add_header_fontawesome_" . $col_no[1] . "' id='add_header_fontawesome' data-insert='arp_column_description' data-column='main_" . $j . "' title='" . __('Add Font Icon', 'ARPricelite') . "' data-title='" . __('Add Font Icon', 'ARPricelite') . "' >";
            $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/font-awesome-icon.png' />";
            $tablestring .= "</button>";

            $tablestring .= "<div class='arp_font_awesome_model_box_container'>";

            $tablestring .= "</div>";
        }

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

        $tablestring .= "</div>";
        $tablestring .= "</div>";

        if ((!isset($columns['column_desc_background_color'])) && $columns['column_desc_background_color'] == '') {
            $columns['column_desc_background_color'] = @$template_section_array[$reference_template][$arp_template_skin]['arp_desc_background'][0];
        }
  
        $tablestring .= "<div class='col_opt_row' id='column_description_other_font_family'>";
        $tablestring .= "<div class='col_opt_title_div'>" . __('Font Family', 'ARPricelite') . "</div>";
        $tablestring .= "<div class='col_opt_input_div'>";

        $tablestring .= "<input type='hidden' id='column_description_font_family' name='column_description_font_family_" . $col_no[1] . "' data-column='main_" . $j . "' value='" . $columns['column_description_font_family'] . "' />";
        $tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='column_description_font_family_" . $col_no[1] . "' data-id='column_description_font_family_" . $col_no[1] . "'>";
        $tablestring .= "<dt><span>" . $columns['column_description_font_family'] . "</span><input type='text' style='display:none;' value='" . $columns['column_description_font_family'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul data-id='column_description_font_family' data-column='" . $j . "'>";



        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";

        $tablestring .= "<div class='arp_google_font_preview_note'><a target='_blank'  class='arp_google_font_preview_link' id='arp_column_description_font_family_preview' href='" . $googlefontpreviewurl . $columns['column_description_font_family'] . "'>" . __('Font Preview', 'ARPricelite') . "</a></div>";

        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='col_opt_row' id='column_description_other_font_size'>";
        $tablestring .= "<div class='btn_type_size'>";
        $tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Size', 'ARPricelite') . "</div>";
        $tablestring .= "<div class='col_opt_input_div two_column'>";

        $tablestring .= "<input type='hidden' id='column_description_font_size' data-column='main_" . $j . "' name='column_description_font_size_" . $col_no[1] . "' value='" . $columns['column_description_font_size'] . "' />";
        $tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='column_description_font_size_" . $col_no[1] . "' data-id='column_description_font_size_" . $col_no[1] . "' style='width:115px;max-width:115px;'>";
        $tablestring .= "<dt><span>" . $columns['column_description_font_size'] . "</span><input type='text' style='display:none;' value='" . $columns['column_description_font_size'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $size_arr = array();
        $tablestring .= "<ul data-id='column_description_font_size' data-column='" . $j . "'>";
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

        //end

        $tablestring .= "</div>";

        $tablestring .= "<div class='col_opt_row' id='column_description_other_font_color'>";
        $tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Style', 'ARPricelite') . "</div>";

        //new font style btns

        $tablestring .= "<div class='col_opt_input_div' data-level='header_level_options'  level-id='header_button2' >";

        //check selected for bold


        if ($columns['column_description_style_bold'] == 'bold') {
            $header2_style_bold_selected = 'selected';
        } else {
            $header2_style_bold_selected = '';
        }

        //check selected for italic

        if ($columns['column_description_style_italic'] == 'italic') {
            $header2_style_italic_selected = 'selected';
        } else {
            $header2_style_italic_selected = '';
        }

        //check selected for underline or line-through

        if ($columns['column_description_style_decoration'] == 'underline') {
            $header2_style_underline_selected = 'selected';
        } else {
            $header2_style_underline_selected = '';
        }

        if ($columns['column_description_style_decoration'] == 'line-through') {
            $header2_style_linethrough_selected = 'selected';
        } else {
            $header2_style_linethrough_selected = '';
        }


        $tablestring .= "<div class='arp_style_btn " . $header2_style_bold_selected . " arptooltipster' data-align='left' title='" . __('Bold', 'ARPricelite') . "' data-title='" . __('Bold', 'ARPricelite') . "' data-column='main_" . $j . "' id='arp_style_bold' data-id='" . $col_no[1] . "'>";
        $tablestring .= "<i class='fa fa-bold'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $header2_style_italic_selected . " arptooltipster' data-align='center' title='" . __('Italic', 'ARPricelite') . "' data-title='" . __('Italic', 'ARPricelite') . "' data-column='main_" . $j . "' id='arp_style_italic' data-id='" . $col_no[1] . "'>";
        $tablestring .= "<i class='fa fa-italic'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $header2_style_underline_selected . " arptooltipster' data-align='right' title='" . __('Underline', 'ARPricelite') . "' data-title='" . __('Underline', 'ARPricelite') . "' data-column='main_" . $j . "' id='arp_style_underline' data-id='" . $col_no[1] . "'>";
        $tablestring .= "<i class='fa fa-underline'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $header2_style_linethrough_selected . " arptooltipster' data-align='right' title='" . __('Line-through', 'ARPricelite') . "' data-title='" . __('Line-through', 'ARPricelite') . "' data-column='main_" . $j . "' id='arp_style_strike' data-id='" . $col_no[1] . "'>";
        $tablestring .= "<i class='fa fa-strikethrough'></i>";
        $tablestring .= "</div>";


        $tablestring .= "<input type='hidden' id='column_description_style_bold' name='column_description_style_bold_" . $col_no[1] . "' value='" . $columns['column_description_style_bold'] . "' /> ";
        $tablestring .= "<input type='hidden' id='column_description_style_italic' name='column_description_style_italic_" . $col_no[1] . "' value='" . $columns['column_description_style_italic'] . "' /> ";
        $tablestring .= "<input type='hidden' id='column_description_style_decoration' name='column_description_style_decoration_" . $col_no[1] . "' value='" . $columns['column_description_style_decoration'] . "' /> ";

        $tablestring .= "</div>";

        //new font style btn ends
        $tablestring .= "</div>";
    }
}

$tablestring .= "<div class='col_opt_row arp_ok_div' id='header_level_other_arp_ok_div__button_2' style='display:none;'>";
$tablestring .= "<div class='col_opt_btn_div'>";
$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
$tablestring .= __('Ok', 'ARPricelite');
$tablestring .= "</button>";
$tablestring .= "</div>";
$tablestring .= "</div>";


$tablestring .= "</div>";

$tablestring .= "<div class='column_option_div' level-id='header_level_options__button_3' style='display:none;'>";
$arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'] = isset($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3']) ? $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'] : "";
if (is_array($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'])) {
    if (in_array('column_description', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'])) {
        $tablestring .= "<div class='col_opt_row' id='column_description'>";
        $tablestring .= "<div class='col_opt_title_div'>" . __('Column Description', 'ARPricelite') . "</div>";
        $tablestring .= "<div class='col_opt_input_div'>";
        $tablestring .= "<div class='option_tab' id='column_description_yearly_tab'>";
        $tablestring .= "<textarea id='arp_column_description' name='arp_column_description_" . $col_no[1] . "'  class='col_opt_textarea arp_column_description_first' data-column='main_column_" . $col_no[1] . "'>";
        $tablestring .= stripslashes_deep($columns['column_description']);
        $tablestring .= "</textarea>";
        $tablestring .= "</div>";
        $tablestring .= "<div class='option_tab' id='column_description_monthly_tab' style='display:none;'>";
        $tablestring .= "<textarea id='arp_column_description_second' name='arp_column_description_second_" . $col_no[1] . "'  class='col_opt_textarea arp_column_description_second' data-column='main_column_" . $col_no[1] . "'>";
        $tablestring .= stripslashes_deep($columns['column_description_second']);
        $tablestring .= "</textarea>";
        $tablestring .= "</div>";
        $tablestring .= "<div class='option_tab' id='column_description_quarterly_tab' style='display:none;'>";
        $tablestring .= "<textarea id='arp_column_description_third' name='arp_column_description_third_" . $col_no[1] . "'  class='col_opt_textarea arp_column_description_third' data-column='main_column_" . $col_no[1] . "'>";
        $tablestring .= stripslashes_deep($columns['column_description_third']);
        $tablestring .= "</textarea>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        $tablestring .= "<div class='col_opt_button'>";
        if (in_array('arp_object', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'])) {
            $tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster align_left' name='add_header_object_" . $col_no[1] . "' id='add_arp_object' data-insert='arp_column_description' data-column='main_" . $j . "' title='" . __('Add Media', 'ARPricelite') . "' data-title='" . __('Add Media', 'ARPricelite') . "'>";
            $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/image-icon.png' />";

            $tablestring .= "</button>";
            $tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";
        }

        if (in_array('arp_fontawesome', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'])) {
            $tablestring .= "<button type='button' class='col_opt_btn_icon arptooltipster add_header_fontawesome align_left' name='add_header_fontawesome_" . $col_no[1] . "' id='add_header_fontawesome' data-insert='arp_column_description' data-column='main_" . $j . "' title='" . __('Add Font Icon', 'ARPricelite') . "' data-title='" . __('Add Font Icon', 'ARPricelite') . "' >";
            $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/font-awesome-icon.png' />";
            $tablestring .= "</button>";

            $tablestring .= "<div class='arp_font_awesome_model_box_container'>";
            $tablestring .= "</div>";
        }

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

        $tablestring .= "</div>";
        $tablestring .= "</div>";
        if ((!isset($columns['column_desc_background_color'])) && $columns['column_desc_background_color'] == '') {
            $columns['column_desc_background_color'] = @$arplite_mainoptionsarr['general_options']['arp_section_background_color'][$reference_template][$arp_template_skin]['arp_desc_background'][0];
        }
        $tablestring .= "<div class='col_opt_row' id='column_description_other_font_family'>";
        $tablestring .= "<div class='col_opt_title_div'>" . __('Font Family', 'ARPricelite') . "</div>";
        $tablestring .= "<div class='col_opt_input_div'>";

        $tablestring .= "<input type='hidden' id='column_description_font_family' name='column_description_font_family_" . $col_no[1] . "' data-column='main_" . $j . "' value='" . $columns['column_description_font_family'] . "' />";
        $tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='column_description_font_family_" . $col_no[1] . "' data-id='column_description_font_family_" . $col_no[1] . "'>";
        $tablestring .= "<dt><span>" . $columns['column_description_font_family'] . "</span><input type='text' style='display:none;' value='" . $columns['column_description_font_family'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul data-id='column_description_font_family' data-column='" . $j . "'>";



        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";

        $tablestring .= "<div class='arp_google_font_preview_note'><a target='_blank'  class='arp_google_font_preview_link' id='arp_column_description_font_family_preview' href='" . $googlefontpreviewurl . $columns['column_description_font_family'] . "'>" . __('Font Preview', 'ARPricelite') . "</a></div>";

        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='col_opt_row' id='column_description_other_font_size'>";
        $tablestring .= "<div class='btn_type_size'>";
        $tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Size', 'ARPricelite') . "</div>";
        $tablestring .= "<div class='col_opt_input_div two_column'>";

        $tablestring .= "<input type='hidden' id='column_description_font_size' name='column_description_font_size_" . $col_no[1] . "' value='" . $columns['header_font_size'] . "' data-column='main_" . $j . "' />";
        $tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='column_description_font_size_" . $col_no[1] . "' data-id='column_description_font_size_" . $col_no[1] . "' style='width:115px;max-width:115px;'>";
        $tablestring .= "<dt><span>" . $columns['column_description_font_size'] . "</span><input type='text' style='display:none;' value='" . $columns['column_description_font_size'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $size_arr = array();
        $tablestring .= "<ul data-id='column_description_font_size' data-column='" . $j . "'>";
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

        $tablestring .= "<div class='btn_type_size'>";
        $tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Style', 'ARPricelite') . "</div>";
        $tablestring .= "<div class='col_opt_input_div two_column'>";

        $tablestring .= "<input type='hidden' id='column_description_font_style' name='column_description_font_style_" . $col_no[1] . "' value='" . $columns['column_description_font_style'] . "' data-column='main_" . $j . "' />";
        $tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='column_description_font_style_" . $col_no[1] . "' data-id='column_description_font_style_" . $col_no[1] . "' style='width:115px;max-width:115px;'>";
        $tablestring .= "<dt><span>" . $columns['column_description_font_style'] . "</span><input type='text' style='display:none;' value='" . $columns['column_description_font_style'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul data-id='column_description_font_style' data-column='" . $j . "'>";
        $tablestring .= $arpricelite_form->font_style_new();
        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "</div>";
    }
    if (in_array('additional_shortcode', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'])) {

        if (in_array('arp_object', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3']) || in_array('arp_fontawesome', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'])) {
            $header_shortcode_txtarea_cls = 'editable_shortcode';
        } else {
            $header_shortcode_txtarea_cls = '';
        }

        $tablestring .= "<div class='col_opt_row' id='additional_shortcode'>";

        $tablestring .= "<div class='col_opt_title_div'>" . __('Additional Shortcode', 'ARPricelite') . "</div>";
        $tablestring .= "<div class='col_opt_input_div'>";
        $tablestring .= "<textarea id='additional_shortcode_input' name='additional_shortcode_" . $col_no[1] . "'  class='col_opt_textarea " . $header_shortcode_txtarea_cls . "' data-column='main_" . $j . "'>";
        $tablestring .= htmlentities($columns['arp_header_shortcode']);
        $tablestring .= "</textarea>";
        $tablestring .= "</div>";

        if (in_array('arp_object', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3']) || in_array('arp_fontawesome', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'])) {
            $tablestring .= "<div class='col_opt_button'>";

            if (in_array('arp_object', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'])) {
                $tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster align_left' name='add_header_object_" . $col_no[1] . "' id='add_arp_object' data-insert='additional_shortcode_input' data-column='main_" . $j . "' title='" . __('Add Media', 'ARPricelite') . "' data-title='" . __('Add Media', 'ARPricelite') . "'>";
                $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/image-icon.png' />";
                $tablestring .= "</button>";
                $tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";
            }

            if (in_array('arp_fontawesome', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'])) {
                $tablestring .= "<button type='button' class='col_opt_btn_icon add_header_fontawesome arptooltipster align_left' name='add_header_fontawesome_" . $col_no[1] . "' id='add_header_fontawesome' data-insert='additional_shortcode_input' data-column='main_" . $j . "' title='" . __('Add Font Icon', 'ARPricelite') . "' data-title='" . __('Add Font Icon', 'ARPricelite') . "' >";
                $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/font-awesome-icon.png' />";
                $tablestring .= "</button>";

                $tablestring .= "<div class='arp_font_awesome_model_box_container'>";

                $tablestring .= "</div>";
            }

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

            $tablestring .= "</div>";
        } else {
            $tablestring .= "<div class='col_opt_button'>";
            $tablestring .= "<button type='button' class='col_opt_btn_icon align_left arptooltipster' onclick='add_header_shortcode_fn(this);' name='add_header_shortcode_btn_" . $col_no[1] . "' id='add_header_shortcode' title='" . __('Add Media', 'ARPricelite') . "' data-title='" . __('Add Media', 'ARPricelite') . "'>";

            $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/audio-icon.png' />";
            $tablestring .= "</button>";
            $tablestring .= "</div>";
        }
        $tablestring .= "</div>";
    }

    if (in_array('arp_shortcode_customization_style_div', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'])) {
        $arprice_customization_style = $arpricelite_default_settings->arp_shortcode_custom_type();
        if ($reference_template == 'arptemplate_26') {
            unset($arprice_customization_style['none']);
        }


        $tablestring .= "<div class='col_opt_row' id='arp_shortcode_customization_style_div'>";
        $tablestring .= "<div class='col_opt_title_div' style='width : 20%;margin-top:6px;'>" . __('Style', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='col_opt_input_div' style='width : 80%;'>";

        $tablestring .= "<input type='hidden' id='arp_shortcode_customization_style' name='arp_shortcode_customization_style_" . $col_no[1] . "' data-column='main_" . $j . "' value='" . @$columns['arp_shortcode_customization_style'] . "' />";
        $tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='arp_shortcode_customization_style_" . $col_no[1] . "' data-id='arp_shortcode_customization_style_" . $col_no[1] . "' style='width:190px;'>";
        $columns['arp_shortcode_customization_style'] = isset($columns['arp_shortcode_customization_style']) ? $columns['arp_shortcode_customization_style'] : '';
        $arprice_customization_style[$columns['arp_shortcode_customization_style']]['name'] = isset($arprice_customization_style[$columns['arp_shortcode_customization_style']]['name']) ? $arprice_customization_style[$columns['arp_shortcode_customization_style']]['name'] : '';
        $tablestring .= "<dt style='width : 180px;'><span>" . @$arprice_customization_style[$columns['arp_shortcode_customization_style']]['name'] . "</span><input type='text' style='display:none;' value='" . @$columns['arp_shortcode_customization_style'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd style='width : 195px;'>";
        $tablestring .= "<ul data-id='arp_shortcode_customization_style' data-column='" . $j . "'>";

        foreach ($arprice_customization_style as $key => $style) {
            if ($key == 'rounded' || $key == 'rounded_solid') {
                $tablestring .= "<li data-value='" . $key . "' data-label='" . $style['name'] . "'>" . $style['name'] . "</li>";
            } else {

                $tablestring .= "<li class='arplite_restricted_view' style='margin:0px' class='arp_selectbox_option' data-value='" . $key . "' data-label='" . $style['name'] . "'>" . $style['name'] . " <span class='pro_version_info'>(Pro Version)</span></li>";
            }
        }
        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
    }

    if (in_array('arp_shortcode_customization_size_div', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['header_level_options']['other_columns_buttons']['header_level_options__button_3'])) {
        $tablestring .= "<div class='col_opt_row' id='arp_shortcode_customization_size_div'>";


        $tablestring .= "<div class='col_opt_title_div' style='width : 40%;margin-top:6px;'>" . __('Size', ARPLITE_PT_TXTDOMAIN) . "</div>";
        $tablestring .= "<div class='col_opt_input_div' style='width : 60%;'>";

        $tablestring .= "<input type='hidden' id='arp_shortcode_customization_size' name='arp_shortcode_customization_size_" . $col_no[1] . "' data-column='main_" . $j . "' value='" . @$columns['arp_shortcode_customization_size'] . "' />";
        $arprice_customization_size = array(
            'small' => __('Small', ARPLITE_PT_TXTDOMAIN),
            'medium' => __('Medium', ARPLITE_PT_TXTDOMAIN),
            'large' => __('Large', ARPLITE_PT_TXTDOMAIN),
        );
        $tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='arp_shortcode_customization_size_" . $col_no[1] . "' data-id='arp_shortcode_customization_size_" . $col_no[1] . "' style='width:190px;'>";

        $tablestring .= "<dt style='width : 130px;'><span>" . @$arprice_customization_size[@$columns['arp_shortcode_customization_size']]. "</span><input type='text' style='display:none;' value='" .@$columns['arp_shortcode_customization_size'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd style='width : 146px;'>";
        $tablestring .= "<ul data-id='arp_shortcode_customization_size' data-column='" . $j . "'>";

        foreach ($arprice_customization_size as $key => $style) {
            $tablestring .= "<li data-value='" . $key . "' data-label='" . $style . "'>" . $style . "</li>";
        }
        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
    }
}

$tablestring .= "<div class='col_opt_row arp_ok_div' id='header_level_other_arp_ok_div__button_3' style='display:none;'>";
$tablestring .= "<div class='col_opt_btn_div'>";
$tablestring .= "<div class='col_opt_navigation_div'>";
$tablestring .= "<i class='fa fa-long-arrow-left arp_navigation_arrow' id='header_left_arrow' data-column='{$col_no[1]}' data-button-id='header_level_options__button_3'></i>&nbsp;";
$tablestring .= "<i class='fa fa-long-arrow-right arp_navigation_arrow' id='header_right_arrow' data-column='{$col_no[1]}' data-button-id='header_level_options__button_3'></i>&nbsp;";
$tablestring .= "</div>";
$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
$tablestring .= __('Ok', 'ARPricelite');
$tablestring .= "</button>";
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "</div>";

$tablestring .= "<div class='column_option_div' level-id='pricing_level_options__button_1' style='display:none;'>";

$tablestring .= "<div class='col_opt_row' id='price_text'>";
$tablestring .= "<div class='col_opt_title_div'>" . __('Price Text', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div'>";
if ($template_type == 'normal') {
    $col_opt_txtarea_cls = 'col_opt_textarea_big';
    $arp_price_yearly_text_tab_id = 'price_yearly_tab';
    $arp_price_monthly_text_tab_id = 'price_monthly_tab';
    $arp_price_quarterly_text_tab_id = 'price_quarterly_tab';
} else {
    $col_opt_txtarea_cls = '';
    $arp_price_yearly_text_tab_id = 'price_yearly_value_tab';
    $arp_price_monthly_text_tab_id = 'price_monthly_value_tab';
    $arp_price_quarterly_text_tab_id = 'price_quarterly_value_tab';
}

$tablestring .= "<div class='option_tab' id='" . $arp_price_yearly_text_tab_id . "'>";
$tablestring .= "<textarea id='price_text_input' name='price_text_" . $col_no[1] . "' class='col_opt_textarea " . $col_opt_txtarea_cls . " price_text_one_step' data-column='main_" . $j . "' style='min-height:65px;max-width:100%;width:100%;margin-bottom:10px;height:65px;'>";
$tablestring .= $columns['price_text'];
$tablestring .= "</textarea>";

$tablestring .= "</div>";

$tablestring .= "<div class='col_opt_button'>";

$arp_pricing_font_awesome_icon = "arp_single_icon_arrow";

if (isset($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_1']) && is_array($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']) && is_array(@$arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_1']) && in_array('arp_object', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_1'])) {
    $tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster align_left' name='add_header_object_" . $col_no[1] . "' id='add_arp_object' data-insert='price_text_input' data-column='main_" . $j . "' title='" . __('Add Media', 'ARPricelite') . "' data-title='" . __('Add Media', 'ARPricelite') . "'>";
    $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/image-icon.png' />";

    $tablestring .= "</button>";
    $tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";
    $arp_pricing_font_awesome_icon = "";
}

if (isset($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_1']) && is_array($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']) && is_array(@$arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_1']) && in_array('arp_fontawesome', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_1'])) {
    $tablestring .= "<button type='button' class='col_opt_btn_icon add_header_fontawesome arptooltipster align_left' name='add_header_fontawesome_" . $col_no[1] . "' id='add_header_fontawesome' data-insert='price_text_input' data-column='main_" . $j . "' title='" . __('Add Font Icon', 'ARPricelite') . "' data-title='" . __('Add Font Icon', 'ARPricelite') . "' >";
    $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/font-awesome-icon.png' />";
    $tablestring .= "</button>";

    $tablestring .= "<div class='arp_font_awesome_model_box_container'>";

    $tablestring .= "</div>";
}

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

$tablestring .= "</div>";
$tablestring .= "</div>";
$tablestring .= "</div>";

$price_text_alignment = isset($columns['price_font_align']) ? $columns['price_font_align'] : 'center';
$tablestring .= $arpricelite_form->arp_create_alignment_div('price_text_alignment', $price_text_alignment, 'arp_price_text_alignment', $col_no[1], 'pricing_section');

$price_background_color_value = '';
if ($reference_template == 'arplitetemplate_1') {
    if (isset($columns['price_background_color']) && $columns['price_background_color'] != '') {
        $price_background_color_value = $columns['price_background_color'];
    } else {
        $col_key_price = $col_no[1] % 5;
        if ($col_key_price == 0)
            $col_key_price = 5;

        $price_background_color_value = $template_section_array[$reference_template][$arp_template_skin]['arp_price_background'][$col_key_price];
    }
}


if ($reference_template == 'arplitetemplate_8') {
    if (isset($columns['price_background_color']) && $columns['price_background_color'] != '') {
        $price_background_color_value = $columns['price_background_color'];
    } else {
        if ($arp_template_skin == 'multicolor') {
            $col_key_button = ($col_no[1] + 1) % 5;
            if ($col_key_button == 0)
                $col_key_button = 5;
            $price_background_color_value = isset($template_section_array[$reference_template][$arp_template_skin]['arp_price_background']) ? $template_section_array[$reference_template][$arp_template_skin]['arp_price_background'][$col_key_button] : '';
        } else {
            $price_background_color_value = isset($template_section_array[$reference_template][$arp_template_skin]['arp_price_background']) ? $template_section_array[$reference_template][$arp_template_skin]['arp_price_background'][0] : '';
        }
    }
}

$tablestring .= "<div class='col_opt_row' id='price_text_other_font_family'>";
$tablestring .= "<div class='col_opt_title_div'>" . __('Font Family', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div'>";

$tablestring .= "<input type='hidden' id='price_font_family' name='price_font_family_" . $col_no[1] . "' value='" . $columns['price_font_family'] . "' data-column='main_" . $j . "' />";
$tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='price_font_family_" . $col_no[1] . "' data-id='price_font_family_" . $col_no[1] . "'>";
$tablestring .= "<dt><span>" . $columns['price_font_family'] . "</span><input type='text' style='display:none;' value='" . $columns['price_font_family'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
$tablestring .= "<dd>";
$tablestring .= "<ul data-id='price_font_family' data-column='" . $j . "'>";

$tablestring .= "</ul>";
$tablestring .= "</dd>";
$tablestring .= "</dl>";

$tablestring .= "<div class='arp_google_font_preview_note'><a target='_blank'  class='arp_google_font_preview_link' id='arp_price_font_family_preview' href='" . $googlefontpreviewurl . $columns['price_font_family'] . "'>" . __('Font Preview', 'ARPricelite') . "</a></div>";

$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "<div class='col_opt_row' id='price_text_other_font_size'>";

$tablestring .= "<div class='btn_type_size'>";
$tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Size', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div two_column'>";

$tablestring .= "<input type='hidden' id='price_font_size' name='price_font_size_" . $col_no[1] . "' data-column='main_" . $j . "' value='" . $columns['price_font_size'] . "' />";
$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='price_font_size_" . $col_no[1] . "' data-id='price_font_size_" . $col_no[1] . "' style='width:115px;max-width:115px;'>";
$tablestring .= "<dt><span>" . $columns['price_font_size'] . "</span><input type='text' style='display:none;' value='" . $columns['price_font_size'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
$tablestring .= "<dd>";
$tablestring .= "<ul data-id='price_font_size' data-column='" . $j . "'>";
$size_arr = array();
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

//font color new pos ends


$tablestring .= "</div>";

$tablestring .= "<div class='col_opt_row' id='price_text_other_font_color'>";

$tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Style', 'ARPricelite') . "</div>";

//new font style btns

$tablestring .= "<div class='col_opt_input_div' data-level='pricing_level_options' level-id='pricing_button1'>";

//check selected for bold


if ($columns['price_label_style_bold'] == 'bold') {
    $pricing_style_bold_selected = 'selected';
} else {
    $pricing_style_bold_selected = '';
}

//check selected for italic

if ($columns['price_label_style_italic'] == 'italic') {
    $pricing_style_italic_selected = 'selected';
} else {
    $pricing_style_italic_selected = '';
}

//check selected for underline or line-through

if ($columns['price_label_style_decoration'] == 'underline') {
    $pricing_style_underline_selected = 'selected';
} else {
    $pricing_style_underline_selected = '';
}

if ($columns['price_label_style_decoration'] == 'line-through') {
    $pricing_style_linethrough_selected = 'selected';
} else {
    $pricing_style_linethrough_selected = '';
}



$tablestring .= "<div class='arp_style_btn " . $pricing_style_bold_selected . " arptooltipster' title='" . __('Bold', 'ARPricelite') . "' data-title='" . __('Bold', 'ARPricelite') . "' data-align='left' data-column='main_" . $j . "' id='arp_style_bold' data-id='" . $col_no[1] . "'>";
$tablestring .= "<i class='fa fa-bold'></i>";
$tablestring .= "</div>";

$tablestring .= "<div class='arp_style_btn " . $pricing_style_italic_selected . " arptooltipster' title='" . __('Italic', 'ARPricelite') . "' data-title='" . __('Italic', 'ARPricelite') . "' data-align='center' data-column='main_" . $j . "' id='arp_style_italic' data-id='" . $col_no[1] . "'>";
$tablestring .= "<i class='fa fa-italic'></i>";
$tablestring .= "</div>";

$tablestring .= "<div class='arp_style_btn " . $pricing_style_underline_selected . " arptooltipster' title='" . __('Underline', 'ARPricelite') . "' data-title='" . __('Underline', 'ARPricelite') . "' data-align='right' data-column='main_" . $j . "' id='arp_style_underline' data-id='" . $col_no[1] . "'>";
$tablestring .= "<i class='fa fa-underline'></i>";
$tablestring .= "</div>";

$tablestring .= "<div class='arp_style_btn " . $pricing_style_linethrough_selected . " arptooltipster' title='" . __('Line-through', 'ARPricelite') . "' data-title='" . __('Line-through', 'ARPricelite') . "' data-align='right' data-column='main_" . $j . "' id='arp_style_strike' data-id='" . $col_no[1] . "'>";
$tablestring .= "<i class='fa fa-strikethrough'></i>";
$tablestring .= "</div>";



$tablestring .= "<input type='hidden' id='price_label_style_bold' name='price_label_style_bold_" . $col_no[1] . "' value='" . $columns['price_label_style_bold'] . "' /> ";
$tablestring .= "<input type='hidden' id='price_label_style_italic' name='price_label_style_italic_" . $col_no[1] . "' value='" . $columns['price_label_style_italic'] . "' /> ";
$tablestring .= "<input type='hidden' id='price_label_style_decoration' name='price_label_style_decoration_" . $col_no[1] . "' value='" . $columns['price_label_style_decoration'] . "' /> ";

$tablestring .= "</div>";

//new font style btn ends

$tablestring .= "</div>";


$tablestring .= "<div class='col_opt_row arp_ok_div' id='pricing_level_other_arp_ok_div__button_1' style='display:none;'>";
$tablestring .= "<div class='col_opt_btn_div'>";
$tablestring .= "<div class='col_opt_navigation_div'>";
$tablestring .= "<i class='fa fa-long-arrow-left arp_navigation_arrow' id='price_left_arrow' data-column='{$col_no[1]}' data-button-id='pricing_level_options__button_1'></i>&nbsp;";
$tablestring .= "<i class='fa fa-long-arrow-right arp_navigation_arrow' id='price_right_arrow' data-column='{$col_no[1]}' data-button-id='pricing_level_options__button_1'></i>&nbsp;";
$tablestring .= "</div>";
$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
$tablestring .= __('Ok', 'ARPricelite');
$tablestring .= "</button>";
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "</div>";

$tablestring .= "<div class='column_option_div' level-id='pricing_level_options__button_2' style='display:none;'>";

$tablestring .= "<div class='col_opt_row' id='price_label'>";
$tablestring .= "<div class='col_opt_title_div'>" . __('Label Text', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div'>";
$arp_price_yearly_duration_tab_id = '';
$arp_price_monthly_duration_tab_id = '';
$arp_price_quarterly_duration_tab_id = '';
if ($template_type == 'normal') {
    $col_opt_txtarea_cls = 'col_opt_textarea_big';
    $arp_price_yearly_duration_tab_id = 'price_yearly_duration_tab';
    $arp_price_monthly_duration_tab_id = 'price_monthly_duration_tab';
    $arp_price_quarterly_duration_tab_id = 'price_quarterly_duration_tab';
} else {
    $col_opt_txtarea_cls = '';
    $arp_price_yearly_duration_tab_id = 'price_yearly_label_tab';
    $arp_price_monthly_duration_tab_id = 'price_monthly_label_tab';
    $arp_price_quarterly_duration_tab_id = 'price_quarterly_label_tab';
}


$tablestring .= "<div class='option_tab' id='" . $arp_price_yearly_duration_tab_id . "'>";
$tablestring .= "<textarea id='price_label_input' name='price_label_" . $col_no[1] . "' class='col_opt_textarea price_text_one_step_only_label_main' data-column='main_" . $j . "' style='min-height:65px;max-width:100%;width:100%;margin-bottom:10px;'>";
$tablestring .= $columns['price_label'];
$tablestring .= "</textarea>";
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "<div class='col_opt_button'>";
$arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2'] = isset($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2']) ? $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2'] : "";
if (is_array($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2'])) {
    if (in_array('arp_object', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2'])) {
        $tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster align_left' name='add_header_object_" . $col_no[1] . "' id='add_arp_object' data-insert='price_label_input' data-column='main_" . $j . "' title='" . __('Add Media', 'ARPricelite') . "' data-title='" . __('Add Media', 'ARPricelite') . "'>";
        $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/image-icon.png' />";

        $tablestring .= "</button>";
        $tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";
    }
}

$arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2'] = isset($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2']) ? $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2'] : "";
if (is_array($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2'])) {
    if (in_array('arp_fontawesome', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_2'])) {

        $tablestring .= "<button type='button' class='col_opt_btn_icon add_header_fontawesome arptooltipster align_left' name='add_header_fontawesome_" . $col_no[1] . "' id='add_header_fontawesome' data-insert='price_label_input' data-column='main_" . $j . "' title='" . __('Add Font Icon', 'ARPricelite') . "' data-title='" . __('Add Font Icon', 'ARPricelite') . "' >";
        $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/font-awesome-icon.png' />";
        $tablestring .= "</button>";

        $tablestring .= "<div class='arp_font_awesome_model_box_container'>";

        $tablestring .= "</div>";
    }
}

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

$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "<div class='col_opt_row' id='price_label_other_font_family'>";
$tablestring .= "<div class='col_opt_title_div'>" . __('Font Family', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div'>";

$tablestring .= "<input type='hidden' id='price_text_font_family' value='" . $columns['price_text_font_family'] . "' name='price_text_font_family_" . $col_no[1] . "' data-column='main_" . $j . "' />";
$tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='price_text_font_family_" . $col_no[1] . "' data-id='price_text_font_family_" . $col_no[1] . "'>";
$tablestring .= "<dt><span>" . $columns['price_text_font_family'] . "</span><input type='text' style='display:none;' value='" . $columns['price_text_font_family'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
$tablestring .= "<dd>";
$tablestring .= "<ul data-id='price_text_font_family' data-column='" . $j . "'>";

$tablestring .= "</ul>";
$tablestring .= "</dd>";
$tablestring .= "</dl>";

$tablestring .= "<div class='arp_google_font_preview_note'><a target='_blank'  class='arp_google_font_preview_link' id='arp_price_text_font_family_preview' href='" . $googlefontpreviewurl . $columns['price_text_font_family'] . "'>" . __('Font Preview', 'ARPricelite') . "</a></div>";

$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "<div class='col_opt_row' id='price_label_other_font_size'>";

$tablestring .= "<div class='btn_type_size'>";
$tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Size', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div two_column'>";

$tablestring .= "<input type='hidden' id='price_text_font_size' data-column='main_" . $j . "' name='price_text_font_size_" . $col_no[1] . "' value='" . $columns['price_text_font_size'] . "' />";
$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='price_text_font_size_" . $col_no[1] . "' data-id='price_text_font_size_" . $col_no[1] . "' style='width:115px;max-width:115px;'>";
$tablestring .= "<dt><span>" . $columns['price_text_font_size'] . "</span><input type='text' style='display:none;' value='" . $columns['price_text_font_size'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
$tablestring .= "<dd>";
$tablestring .= "<ul data-id='price_text_font_size' data-column='" . $j . "'>";
$size_arr = array();
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

//font color brn new pos end

$tablestring .= "</div>";

$tablestring .= "<div class='col_opt_row' id='price_label_other_font_color'>";

$tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Style', 'ARPricelite') . "</div>";

//new font style btns

$tablestring .= "<div class='col_opt_input_div' data-level='pricing_level_options' level-id='pricing_button2' >";

//check selected for bold


if ($columns['price_text_style_bold'] == 'bold') {
    $pricing2_style_bold_selected = 'selected';
} else {
    $pricing2_style_bold_selected = '';
}

//check selected for italic

if ($columns['price_text_style_italic'] == 'italic') {
    $pricing2_style_italic_selected = 'selected';
} else {
    $pricing2_style_italic_selected = '';
}

//check selected for underline or line-through

if ($columns['price_text_style_decoration'] == 'underline') {
    $pricing2_style_underline_selected = 'selected';
} else {
    $pricing2_style_underline_selected = '';
}

if ($columns['price_text_style_decoration'] == 'line-through') {
    $pricing2_style_linethrough_selected = 'selected';
} else {
    $pricing2_style_linethrough_selected = '';
}



$tablestring .= "<div class='arp_style_btn " . $pricing2_style_bold_selected . " arptooltipster' title='" . __('Bold', 'ARPricelite') . "' data-title='" . __('Bold', 'ARPricelite') . "' data-align='left' data-column='main_" . $j . "' id='arp_style_bold' data-id='" . $col_no[1] . "'>";
$tablestring .= "<i class='fa fa-bold'></i>";
$tablestring .= "</div>";

$tablestring .= "<div class='arp_style_btn " . $pricing2_style_italic_selected . " arptooltipster' title='" . __('Italic', 'ARPricelite') . "' data-title='" . __('Italic', 'ARPricelite') . "' data-align='center' data-column='main_" . $j . "' id='arp_style_italic' data-id='" . $col_no[1] . "'>";
$tablestring .= "<i class='fa fa-italic'></i>";
$tablestring .= "</div>";

$tablestring .= "<div class='arp_style_btn " . $pricing2_style_underline_selected . " arptooltipster' title='" . __('Underline', 'ARPricelite') . "' data-title='" . __('Underline', 'ARPricelite') . "' data-align='right' data-column='main_" . $j . "' id='arp_style_underline' data-id='" . $col_no[1] . "'>";
$tablestring .= "<i class='fa fa-underline'></i>";
$tablestring .= "</div>";

$tablestring .= "<div class='arp_style_btn " . $pricing2_style_linethrough_selected . " arptooltipster' title='" . __('Line-through', 'ARPricelite') . "' data-title='" . __('Line-through', 'ARPricelite') . "' data-align='right' data-column='main_" . $j . "' id='arp_style_strike' data-id='" . $col_no[1] . "'>";
$tablestring .= "<i class='fa fa-strikethrough'></i>";
$tablestring .= "</div>";




$tablestring .= "<input type='hidden' id='price_text_style_bold' name='price_text_style_bold_" . $col_no[1] . "' value='" . $columns['price_text_style_bold'] . "' /> ";
$tablestring .= "<input type='hidden' id='price_text_style_italic' name='price_text_style_italic_" . $col_no[1] . "' value='" . $columns['price_text_style_italic'] . "' /> ";
$tablestring .= "<input type='hidden' id='price_text_style_decoration' name='price_text_style_decoration_" . $col_no[1] . "' value='" . $columns['price_text_style_decoration'] . "' /> ";



$tablestring .= "</div>";

//new font style btn ends

$tablestring .= "</div>";


$tablestring .= "<div class='col_opt_row arp_ok_div' id='pricing_level_other_arp_ok_div__button_2' style='display:none;'>";
$tablestring .= "<div class='col_opt_btn_div'>";
$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
$tablestring .= __('Ok', 'ARPricelite');
$tablestring .= "</button>";
$tablestring .= "</div>";
$tablestring .= "</div>";


$tablestring .= "</div>";

$tablestring .= "<div class='column_option_div' level-id='pricing_level_options__button_3' style='display:none;'>";
$arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_3'] = isset($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_3']) ? $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_3'] : "";
if (is_array($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_3'])) {
    if (in_array('column_description', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_3'])) {

        $tablestring .= "<div class='col_opt_row' id='column_description'>";
        $tablestring .= "<div class='col_opt_title_div'>" . __('Column Description', 'ARPricelite') . "</div>";
        $tablestring .= "<div class='col_opt_input_div'>";
        $tablestring .= "<div class='option_tab' id='column_description_yearly_tab'>";
        $tablestring .= "<textarea id='arp_column_description' name='arp_column_description_" . $col_no[1] . "'  class='col_opt_textarea arp_column_description_first' data-column='main_column_" . $col_no[1] . "'>";
        $tablestring .= stripslashes_deep($columns['column_description']);
        $tablestring .= "</textarea>";
        $tablestring .= "</div>";
        $tablestring .= "<div class='option_tab' id='column_description_monthly_tab' style='display:none;'>";
        $tablestring .= "<textarea id='arp_column_description_second' name='arp_column_description_second_" . $col_no[1] . "'  class='col_opt_textarea arp_column_description_second' data-column='main_column_" . $col_no[1] . "'>";
        $tablestring .= stripslashes_deep($columns['column_description_second']);
        $tablestring .= "</textarea>";
        $tablestring .= "</div>";
        $tablestring .= "<div class='option_tab' id='column_description_quarterly_tab' style='display:none;'>";
        $tablestring .= "<textarea id='arp_column_description_third' name='arp_column_description_third_" . $col_no[1] . "'  class='col_opt_textarea arp_column_description_third' data-column='main_column_" . $col_no[1] . "'>";
        $tablestring .= stripslashes_deep($columns['column_description_third']);
        $tablestring .= "</textarea>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        $tablestring .= "<div class='col_opt_button'>";
        if (in_array('arp_object', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_3'])) {
            $tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster align_left' name='add_header_object_" . $col_no[1] . "' id='add_arp_object' data-insert='arp_column_description' data-column='main_" . $j . "' title='" . __('Add Media', 'ARPricelite') . "' data-title='" . __('Add Media', 'ARPricelite') . "' >";
            $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/image-icon.png' />";

            $tablestring .= "</button>";
            $tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";
        }

        if (in_array('arp_fontawesome', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['pricing_level_options']['other_columns_buttons']['pricing_level_options__button_3'])) {
            $tablestring .= "<button type='button' class='col_opt_btn_icon add_header_fontawesome arptooltipster align_left' name='add_header_fontawesome_" . $col_no[1] . "' id='add_header_fontawesome' data-insert='arp_column_description' data-column='main_" . $j . "' title='" . __('Add Font Icon', 'ARPricelite') . "' data-title='" . __('Add Font Icon', 'ARPricelite') . "' >";
            $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/font-awesome-icon.png' />";
            $tablestring .= "</button>";

            $tablestring .= "<div class='arp_font_awesome_model_box_container'>";
            
            $tablestring .= "</div>";
        }

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

        $tablestring .= "</div>";
        $tablestring .= "</div>";


        if ((!isset($columns['column_desc_background_color'])) && $columns['column_desc_background_color'] == '') {
            $columns['column_desc_background_color'] = @$template_section_array[$reference_template][$arp_template_skin]['arp_desc_background'][0];
        }
        
        $tablestring .= "<div class='col_opt_row' id='column_description_other_font_family'>";
        $tablestring .= "<div class='col_opt_title_div'>" . __('Font Family', 'ARPricelite') . "</div>";
        $tablestring .= "<div class='col_opt_input_div'>";

        $tablestring .= "<input type='hidden' id='column_description_font_family' name='column_description_font_family_" . $col_no[1] . "' data-column='main_" . $j . "' value='" . $columns['column_description_font_family'] . "' data-column='main_" . $j . "' />";
        $tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='column_description_font_family_" . $col_no[1] . "' data-id='column_description_font_family_" . $col_no[1] . "'>";
        $tablestring .= "<dt><span>" . $columns['column_description_font_family'] . "</span><input type='text' style='display:none;' value='" . $columns['column_description_font_family'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul data-id='column_description_font_family' data-column='" . $j . "'>";

        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";

        $tablestring .= "<div class='arp_google_font_preview_note'><a target='_blank'  class='arp_google_font_preview_link' id='arp_column_description_font_family_preview' href='" . $googlefontpreviewurl . $columns['column_description_font_family'] . "'>" . __('Font Preview', 'ARPricelite') . "</a></div>";

        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='col_opt_row' id='column_description_other_font_size'>";
        $tablestring .= "<div class='btn_type_size'>";
        $tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Size', 'ARPricelite') . "</div>";
        $tablestring .= "<div class='col_opt_input_div two_column'>";

        $tablestring .= "<input type='hidden' id='column_description_font_size' name='column_description_font_size_" . $col_no[1] . "' value='" . $columns['column_description_font_size'] . "' data-column='main_" . $j . "' />";
        $tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='column_description_font_size_" . $col_no[1] . "' data-id='column_description_font_size_" . $col_no[1] . "' style='width:115px;max-width:115px;'>";
        $tablestring .= "<dt><span>" . $columns['column_description_font_size'] . "</span><input type='text' style='display:none;' value='" . $columns['column_description_font_size'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul data-id='column_description_font_size' data-column='" . $j . "'>";
        $size_arr = array();
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

        //font color btn new pos ends

        $tablestring .= "</div>";

        $tablestring .= "<div class='col_opt_row' id='column_description_other_font_color'>";

        $tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Style', 'ARPricelite') . "</div>";

        //new font style btns

        $tablestring .= "<div class='col_opt_input_div' data-level='pricing_level_options' level-id='pricing_button3'>";


        //check selected for bold


        if ($columns['column_description_style_bold'] == 'bold') {
            $pricing3_style_bold_selected = 'selected';
        } else {
            $pricing3_style_bold_selected = '';
        }

        //check selected for italic

        if ($columns['column_description_style_italic'] == 'italic') {
            $pricing3_style_italic_selected = 'selected';
        } else {
            $pricing3_style_italic_selected = '';
        }

        //check selected for underline or line-through

        if ($columns['column_description_style_decoration'] == 'underline') {
            $pricing3_style_underline_selected = 'selected';
        } else {
            $pricing3_style_underline_selected = '';
        }

        if ($columns['column_description_style_decoration'] == 'line-through') {
            $pricing3_style_linethrough_selected = 'selected';
        } else {
            $pricing3_style_linethrough_selected = '';
        }



        $tablestring .= "<div class='arp_style_btn " . $pricing3_style_bold_selected . "  arptooltipster' title='" . __('Bold', 'ARPricelite') . "' data-title='" . __('Bold', 'ARPricelite') . "' data-align='left'  data-column='main_" . $j . "' id='arp_style_bold' data-id='" . $col_no[1] . "'>";
        $tablestring .= "<i class='fa fa-bold'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $pricing3_style_italic_selected . " arptooltipster' title='" . __('Italic', 'ARPricelite') . "' data-title='" . __('Italic', 'ARPricelite') . "' data-align='center' data-column='main_" . $j . "' id='arp_style_italic' data-id='" . $col_no[1] . "'>";
        $tablestring .= "<i class='fa fa-italic'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $pricing3_style_underline_selected . " arptooltipster' title='" . __('Underline', 'ARPricelite') . "' data-title='" . __('Underline', 'ARPricelite') . "' data-align='right' data-column='main_" . $j . "' id='arp_style_underline' data-id='" . $col_no[1] . "'>";
        $tablestring .= "<i class='fa fa-underline'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $pricing3_style_linethrough_selected . " arptooltipster' title='" . __('Line-through', 'ARPricelite') . "' data-title='" . __('Line-through', 'ARPricelite') . "' data-align='right' data-column='main_" . $j . "' id='arp_style_strike' data-id='" . $col_no[1] . "'>";
        $tablestring .= "<i class='fa fa-strikethrough'></i>";
        $tablestring .= "</div>";


        $tablestring .= "<input type='hidden' id='column_description_style_bold' name='column_description_style_bold_" . $col_no[1] . "' value='" . $columns['column_description_style_bold'] . "' /> ";
        $tablestring .= "<input type='hidden' id='column_description_style_italic' name='column_description_style_italic_" . $col_no[1] . "' value='" . $columns['column_description_style_italic'] . "' /> ";
        $tablestring .= "<input type='hidden' id='column_description_style_decoration' name='column_description_style_decoration_" . $col_no[1] . "' value='" . $columns['column_description_style_decoration'] . "' /> ";


        $tablestring .= "</div>";

        //new font style btn ends

        $tablestring .= "</div>";
    }
}



$tablestring .= "<div class='col_opt_row arp_ok_div' id='pricing_level_other_arp_ok_div__button_3' style='display:none;'>";
$tablestring .= "<div class='col_opt_btn_div'>";
$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
$tablestring .= __('Ok', 'ARPricelite');
$tablestring .= "</button>";
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "</div>";

// BODY LEVEL OPTIONS
$tablestring .= "<input type='hidden' id='total_rows' value='" . count($columns['rows']) . "' name='total_rows_" . $col_no[1] . "' />";
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

//$columns['content_odd_color'] = isset($template_section_array[$reference_template][$arp_template_skin]['arp_body_odd_row_background_color']) ? $template_section_array[$reference_template][$arp_template_skin]['arp_body_odd_row_background_color'][0] : '';

if ($reference_template == 'arplitetemplate_1') {
    if ((!isset($columns['content_even_color'])) && $columns['content_even_color'] == '' && $col_no[1] % 2 == 0) {
        $columns['content_even_color'] = $template_section_array[$reference_template][$arp_template_skin]['arp_body_even_row_background_color'][1];
    } else if ((!isset($columns['content_even_color'])) && $columns['content_even_color'] == '') {
        $columns['content_even_color'] = $template_section_array[$reference_template][$arp_template_skin]['arp_body_even_row_background_color'][0];
    }
} else {
    $columns['content_even_color'] = isset($columns['content_even_color']) ? $columns['content_even_color'] : $template_section_array[$reference_template][$arp_template_skin]['arp_body_even_row_background_color'][0];
}


$tablestring .= "<div class='col_opt_row' id='body_li_other_alternate_bgcolor'>";

$tablestring .= "</div>";

$tablestring .= "<div class='col_opt_row' id='body_li_other_font_family'>";
$tablestring .= "<div class='col_opt_title_div'>" . __('Font Family', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div'>";

$tablestring .= "<input type='hidden' id='content_font_family' value='" . $columns['content_font_family'] . "' name='content_font_family_" . $col_no[1] . "' data-column='main_" . $j . "' />";
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

$tablestring .= "<div class='col_opt_row' id='body_li_other_font_size'>";
$tablestring .= "<div class='btn_type_size'>";
$tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Size', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div two_column'>";

$tablestring .= "<input type='hidden' id='content_font_size' name='content_font_size_" . $col_no[1] . "' value='" . $columns['content_font_size'] . "' data-column='main_" . $j . "' />";
$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='content_font_size_" . $col_no[1] . "' data-id='content_font_size_" . $col_no[1] . "' style='width:115px;max-width:115px;'>";
$tablestring .= "<dt><span>" . $columns['content_font_size'] . "</span><input type='text' style='display:none;' value='" . $columns['content_font_size'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
$tablestring .= "<dd>";
$tablestring .= "<ul data-id='content_font_size' data-column='" . $j . "'>";
$size_arr = array();
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

//font color btn new pos ends

$tablestring .= "</div>";

$tablestring .= "<div class='col_opt_row' id='body_li_other_font_color' data-level='body_level_options' level-id='bodylevel_button1'>";

$tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Style', 'ARPricelite') . "</div>";

//new font style btns

$tablestring .= "<div class='col_opt_input_div' data-level='body_level_options' level-id='bodylevel_button1' >";

//check selected for bold


if ($columns['body_li_style_bold'] == 'bold') {
    $bodylevel_style_bold_selected = 'selected';
} else {
    $bodylevel_style_bold_selected = '';
}

//check selected for italic

if ($columns['body_li_style_italic'] == 'italic') {
    $bodylevel_style_italic_selected = 'selected';
} else {
    $bodylevel_style_italic_selected = '';
}

//check selected for underline or line-through

if ($columns['body_li_style_decoration'] == 'underline') {
    $bodylevel_style_underline_selected = 'selected';
} else {
    $bodylevel_style_underline_selected = '';
}

if ($columns['body_li_style_decoration'] == 'line-through') {
    $bodylevel_style_linethrough_selected = 'selected';
} else {
    $bodylevel_style_linethrough_selected = '';
}

$tablestring .= "<input type='hidden' id='body_li_style_bold' name='body_li_style_bold_" . $col_no[1] . "' value='" . $columns['body_li_style_bold'] . "' /> ";
$tablestring .= "<input type='hidden' id='body_li_style_italic' name='body_li_style_italic_" . $col_no[1] . "' value='" . $columns['body_li_style_italic'] . "' /> ";
$tablestring .= "<input type='hidden' id='body_li_style_decoration' name='body_li_style_decoration_" . $col_no[1] . "' value='" . $columns['body_li_style_decoration'] . "' /> ";




$tablestring .= "</div>";

//new font style btn ends

$tablestring .= "</div>";


$tablestring .= "<div class='col_opt_row arp_ok_div' id='body_level_other_arp_ok_div__button_1' style='display:none;'>";
$tablestring .= "<div class='col_opt_btn_div'>";
$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
$tablestring .= __('Ok', 'ARPricelite');
$tablestring .= "</button>";
$tablestring .= "</div>";
$tablestring .= "</div>";


$tablestring .= "</div>";

// BODY LEVEL OPTIONS 2

$tablestring .= "<div class='column_option_div' level-id='body_level_options__button_2' style='display:none;'>";

$tablestring .= "<div class='col_opt_row' id='body_label_other_font_family'>";
$tablestring .= "<div class='col_opt_title_div'>" . __('Font Family', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div'>";
$columns['content_label_font_family'] = isset($columns['content_label_font_family']) ? $columns['content_label_font_family'] : "";
$tablestring .= "<input type='hidden' id='content_label_font_family' value='" . $columns['content_label_font_family'] . "' name='content_label_font_family_" . $col_no[1] . "' data-column='main_" . $j . "' />";
$tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='content_label_font_family_" . $col_no[1] . "' data-id='content_label_font_family_" . $col_no[1] . "'>";
$tablestring .= "<dt><span>" . $columns['content_label_font_family'] . "</span><input type='text' style='display:none;' value='" . $columns['content_label_font_family'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
$tablestring .= "<dd>";
$tablestring .= "<ul data-id='content_label_font_family' data-column='" . $j . "'>";



$tablestring .= "</ul>";
$tablestring .= "</dd>";
$tablestring .= "</dl>";

$tablestring .= "<div class='arp_google_font_preview_note'><a target='_blank'  class='arp_google_font_preview_link' id='arp_hcontent_label_font_family_preview' href='" . $googlefontpreviewurl . $columns['content_label_font_family'] . "'>" . __('Font Preview', 'ARPricelite') . "</a></div>";

$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "<div class='col_opt_row' id='body_label_other_font_size'>";
$tablestring .= "<div class='btn_type_size'>";
$tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Size', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div two_column'>";
$columns['content_label_font_size'] = isset($columns['content_label_font_size']) ? $columns['content_label_font_size'] : "";
$tablestring .= "<input type='hidden' id='content_label_font_size' name='content_label_font_size_" . $col_no[1] . "' value='" . $columns['content_label_font_size'] . "' data-column='main_" . $j . "' />";
$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='content_label_font_size_" . $col_no[1] . "' data-id='content_label_font_size_" . $col_no[1] . "' style='width:115px;max-width:115px;'>";
$tablestring .= "<dt><span>" . $columns['content_label_font_size'] . "</span><input type='text' style='display:none;' value='" . $columns['content_label_font_size'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
$tablestring .= "<dd>";
$tablestring .= "<ul data-id='content_label_font_size' data-column='" . $j . "'>";
$size_arr = array();
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




$columns['content_label_font_color'] = isset($columns['content_label_font_color']) ? $columns['content_label_font_color'] : "";

$tablestring .= "</div>";

$tablestring .= "<div class='col_opt_row' id='body_label_other_font_color'>";

$tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Style', 'ARPricelite') . "</div>";



$tablestring .= "<div class='col_opt_input_div' data-level='body_level_options' level-id='bodylevel_button2'>";





if (isset($columns['body_label_style_bold']) && $columns['body_label_style_bold'] == 'bold') {
    $bodylevel2_style_bold_selected = 'selected';
} else {
    $bodylevel2_style_bold_selected = '';
}



if (isset($columns['body_label_style_italic']) && $columns['body_label_style_italic'] == 'italic') {
    $bodylevel2_style_italic_selected = 'selected';
} else {
    $bodylevel2_style_italic_selected = '';
}



if (isset($columns['body_label_style_decoration']) && $columns['body_label_style_decoration'] == 'underline') {
    $bodylevel2_style_underline_selected = 'selected';
} else {
    $bodylevel2_style_underline_selected = '';
}

if (isset($columns['body_label_style_decoration']) && $columns['body_label_style_decoration'] == 'line-through') {
    $bodylevel2_style_linethrough_selected = 'selected';
} else {
    $bodylevel2_style_linethrough_selected = '';
}



$tablestring .= "<div class='arp_style_btn " . $bodylevel2_style_bold_selected . " arptooltipster' title='" . __('Bold', 'ARPricelite') . "' data-title='" . __('Bold', 'ARPricelite') . "' data-align='left' data-column='main_" . $j . "' id='arp_style_bold' data-id='" . $col_no[1] . "'>";
$tablestring .= "<i class='fa fa-bold'></i>";
$tablestring .= "</div>";

$tablestring .= "<div class='arp_style_btn " . $bodylevel2_style_italic_selected . " arptooltipster' title='" . __('Italic', 'ARPricelite') . "' data-title='" . __('Italic', 'ARPricelite') . "' data-align='center' data-column='main_" . $j . "' id='arp_style_italic' data-id='" . $col_no[1] . "'>";
$tablestring .= "<i class='fa fa-italic'></i>";
$tablestring .= "</div>";

$tablestring .= "<div class='arp_style_btn " . $bodylevel2_style_underline_selected . " arptooltipster' title='" . __('Underline', 'ARPricelite') . "' data-title='" . __('Underline', 'ARPricelite') . "' data-align='right' data-column='main_" . $j . "' id='arp_style_underline' data-id='" . $col_no[1] . "'>";
$tablestring .= "<i class='fa fa-underline'></i>";
$tablestring .= "</div>";

$tablestring .= "<div class='arp_style_btn " . $bodylevel2_style_linethrough_selected . " arptooltipster' title='" . __('Line-through', 'ARPricelite') . "' data-title='" . __('Line-through', 'ARPricelite') . "' data-align='right' data-column='main_" . $j . "' id='arp_style_strike' data-id='" . $col_no[1] . "'>";
$tablestring .= "<i class='fa fa-strikethrough'></i>";
$tablestring .= "</div>";

$columns['body_label_style_bold'] = isset($columns['body_label_style_bold']) ? $columns['body_label_style_bold'] : "";
$tablestring .= "<input type='hidden' id='body_label_style_bold' name='body_label_style_bold_" . $col_no[1] . "' value='" . $columns['body_label_style_bold'] . "' /> ";
$columns['body_label_style_italic'] = isset($columns['body_label_style_italic']) ? $columns['body_label_style_italic'] : "";
$tablestring .= "<input type='hidden' id='body_label_style_italic' name='body_label_style_italic_" . $col_no[1] . "' value='" . $columns['body_label_style_italic'] . "' /> ";
$columns['body_label_style_decoration'] = isset($columns['body_label_style_decoration']) ? $columns['body_label_style_decoration'] : "";
$tablestring .= "<input type='hidden' id='body_label_style_decoration' name='body_label_style_decoration_" . $col_no[1] . "' value='" . $columns['body_label_style_decoration'] . "' /> ";


$tablestring .= "</div>";

//new font style btn ends


$tablestring .= "</div>";



$tablestring .= "<div class='col_opt_row arp_ok_div' id='body_level_other_arp_ok_div__button_2' style='display:none;'>";
$tablestring .= "<div class='col_opt_btn_div'>";
$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
$tablestring .= __('Ok', 'ARPricelite');
$tablestring .= "</button>";
$tablestring .= "</div>";
$tablestring .= "</div>";


$tablestring .= "</div>";

$tablestring .= "<div class='column_option_div' level-id='column_description_level__button_1' style='display:none;'>";

$arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_level_options']['other_columns_buttons']['body_level_options__button_3'] = isset($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_level_options']['other_columns_buttons']['body_level_options__button_3']) ? $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_level_options']['other_columns_buttons']['body_level_options__button_3'] : "";
if (isset($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['column_description_level']) && is_array($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['column_description_level']['other_columns_buttons']['column_description_level__button_1'])) {
    if (in_array('column_description', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['column_description_level']['other_columns_buttons']['column_description_level__button_1'])) {
        $tablestring .= "<div class='col_opt_row' id='column_description'>";
        $tablestring .= "<div class='col_opt_title_div'>" . __('Column Description', 'ARPricelite') . "</div>";
        $tablestring .= "<div class='col_opt_input_div'>";
        $tablestring .= "<div class='option_tab' id='column_description_yearly_tab'>";
        $tablestring .= "<textarea id='arp_column_description' name='arp_column_description_" . $col_no[1] . "'  class='col_opt_textarea arp_column_description_first' data-column='main_column_" . $col_no[1] . "'>";
        $tablestring .= stripslashes_deep($columns['column_description']);
        $tablestring .= "</textarea>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        $tablestring .= "<div class='col_opt_button'>";
        if (in_array('arp_object', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['column_description_level']['other_columns_buttons']['column_description_level__button_1'])) {
            $tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster align_left' name='add_header_object_" . $col_no[1] . "' id='add_arp_object' data-insert='arp_column_description' data-column='main_" . $j . "' title='" . __('Add Media', 'ARPricelite') . "' data-title='" . __('Add Media', 'ARPricelite') . "'>";
            $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/image-icon.png' />";

            $tablestring .= "</button>";
            $tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";
        }

        if (in_array('arp_fontawesome', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['column_description_level']['other_columns_buttons']['column_description_level__button_1'])) {
            $tablestring .= "<button type='button' class='col_opt_btn_icon add_header_fontawesome arptooltipster align_left' name='add_header_fontawesome_" . $col_no[1] . "' id='add_header_fontawesome' data-insert='arp_column_description' data-column='main_" . $j . "' title='" . __('Add Font Icon', 'ARPricelite') . "' data-title='" . __('Add Font Icon', 'ARPricelite') . "' >";
            $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/font-awesome-icon.png' />";
            $tablestring .= "</button>";

            $tablestring .= "<div class='arp_font_awesome_model_box_container'>";

            $tablestring .= "</div>";
        }

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

        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $column_description_text_alignment = isset($columns['description_text_alignment']) ? $columns['description_text_alignment'] : 'center';
        $tablestring .= $arpricelite_form->arp_create_alignment_div('column_description_text_alignment', $column_description_text_alignment, 'arp_description_text_alignment', $col_no[1], 'column_description_section');

        $columns['column_desc_background_color'] = '';
        if ((!isset($columns['column_desc_background_color'])) && $columns['column_desc_background_color'] == '') {
            $columns['column_desc_background_color'] = @$template_section_array[$reference_template][$arp_template_skin]['arp_desc_background'][0];
        }

        $tablestring .= "<div class='col_opt_row' id='column_description_other_font_family'>";
        $tablestring .= "<div class='col_opt_title_div'>" . __('Font Family', 'ARPricelite') . "</div>";
        $tablestring .= "<div class='col_opt_input_div'>";

        $tablestring .= "<input type='hidden' id='column_description_font_family' name='column_description_font_family_" . $col_no[1] . "' data-column='main_" . $j . "' value='" . $columns['column_description_font_family'] . "' data-column='main_" . $j . "' />";
        $tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='column_description_font_family_" . $col_no[1] . "' data-id='column_description_font_family_" . $col_no[1] . "'>";
        $tablestring .= "<dt><span>" . $columns['column_description_font_family'] . "</span><input type='text' style='display:none;' value='" . $columns['column_description_font_family'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul data-id='column_description_font_family' data-column='" . $j . "'>";



        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";

        $tablestring .= "<div class='arp_google_font_preview_note'><a target='_blank'  class='arp_google_font_preview_link' id='arp_column_description_font_family_preview' href='" . $googlefontpreviewurl . $columns['column_description_font_family'] . "'>" . __('Font Preview', 'ARPricelite') . "</a></div>";

        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='col_opt_row' id='column_description_other_font_size'>";
        $tablestring .= "<div class='btn_type_size'>";
        $tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Size', 'ARPricelite') . "</div>";
        $tablestring .= "<div class='col_opt_input_div two_column'>";

        $tablestring .= "<input type='hidden' id='column_description_font_size' name='column_description_font_size_" . $col_no[1] . "' value='" . $columns['column_description_font_size'] . "' data-column='main_" . $j . "' />";
        $tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='column_description_font_size_" . $col_no[1] . "' data-id='column_description_font_size_" . $col_no[1] . "' style='width:115px;max-width:115px;'>";
        $tablestring .= "<dt><span>" . $columns['column_description_font_size'] . "</span><input type='text' style='display:none;' value='" . $columns['column_description_font_size'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul data-id='column_description_font_size' data-column='" . $j . "'>";
        $size_arr = array();
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

        //end

        $tablestring .= "</div>";

        $tablestring .= "<div class='col_opt_row' id='column_description_other_font_color'>";

        $tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Style', 'ARPricelite') . "</div>";

        //new font style btns

        $tablestring .= "<div class='col_opt_input_div' data-level='body_level_options' level-id='bodylevel_button3'>";


        //check selected for bold


        if ($columns['column_description_style_bold'] == 'bold') {
            $bodylevel3_style_bold_selected = 'selected';
        } else {
            $bodylevel3_style_bold_selected = '';
        }

        //check selected for italic

        if ($columns['column_description_style_italic'] == 'italic') {
            $bodylevel3_style_italic_selected = 'selected';
        } else {
            $bodylevel3_style_italic_selected = '';
        }

        //check selected for underline or line-through

        if ($columns['column_description_style_decoration'] == 'underline') {
            $bodylevel3_style_underline_selected = 'selected';
        } else {
            $bodylevel3_style_underline_selected = '';
        }

        if ($columns['column_description_style_decoration'] == 'line-through') {
            $bodylevel3_style_linethrough_selected = 'selected';
        } else {
            $bodylevel3_style_linethrough_selected = '';
        }


        $tablestring .= "<div class='arp_style_btn " . $bodylevel3_style_bold_selected . " arptooltipster' title='" . __('Bold', 'ARPricelite') . "' data-title='" . __('Bold', 'ARPricelite') . "' data-align='left' data-column='main_" . $j . "' id='arp_style_bold' data-id='" . $col_no[1] . "'>";
        $tablestring .= "<i class='fa fa-bold'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $bodylevel3_style_italic_selected . " arptooltipster' title='" . __('Italic', 'ARPricelite') . "' data-title='" . __('Italic', 'ARPricelite') . "' data-align='center' data-column='main_" . $j . "' id='arp_style_italic' data-id='" . $col_no[1] . "'>";
        $tablestring .= "<i class='fa fa-italic'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $bodylevel3_style_underline_selected . " arptooltipster' title='" . __('Underline', 'ARPricelite') . "' data-title='" . __('Underline', 'ARPricelite') . "' data-align='right' data-column='main_" . $j . "' id='arp_style_underline' data-id='" . $col_no[1] . "'>";
        $tablestring .= "<i class='fa fa-underline'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $bodylevel3_style_linethrough_selected . " arptooltipster' title='" . __('Line-through', 'ARPricelite') . "' data-title='" . __('Line-through', 'ARPricelite') . "' data-align='right' data-column='main_" . $j . "' id='arp_style_strike' data-id='" . $col_no[1] . "'>";
        $tablestring .= "<i class='fa fa-strikethrough'></i>";
        $tablestring .= "</div>";



        $tablestring .= "<input type='hidden' id='column_description_style_bold' name='column_description_style_bold_" . $col_no[1] . "' value='" . $columns['column_description_style_bold'] . "' /> ";
        $tablestring .= "<input type='hidden' id='column_description_style_italic' name='column_description_style_italic_" . $col_no[1] . "' value='" . $columns['column_description_style_italic'] . "' /> ";
        $tablestring .= "<input type='hidden' id='column_description_style_decoration' name='column_description_style_decoration_" . $col_no[1] . "' value='" . $columns['column_description_style_decoration'] . "' /> ";





        $tablestring .= "</div>";

        //new font style btn ends

        $tablestring .= "</div>";
    }
}

$tablestring .= "<div class='col_opt_row arp_ok_div' id='column_description_level_other_arp_ok_div__button_1' style='display:none;'>";
$tablestring .= "<div class='col_opt_btn_div'>";
$tablestring .= "<div class='col_opt_navigation_div'>";
$tablestring .= "<i class='fa fa-long-arrow-left arp_navigation_arrow' id='description_left_arrow' data-column='{$col_no[1]}' data-button-id='column_description_level__button_1'></i>&nbsp;";
$tablestring .= "<i class='fa fa-long-arrow-right arp_navigation_arrow' id='description_right_arrow' data-column='{$col_no[1]}' data-button-id='column_description_level__button_1'></i>&nbsp;";
$tablestring .= "</div>";
$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
$tablestring .= __('Ok', 'ARPricelite');
$tablestring .= "</button>";
$tablestring .= "</div>";

$tablestring .= "</div>";

$tablestring .= "</div>";

$tablestring .= "<div class='column_option_div' level-id='body_level_options__button_3' style='display:none;'>";

$arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_level_options']['other_columns_buttons']['body_level_options__button_3'] = isset($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_level_options']['other_columns_buttons']['body_level_options__button_3']) ? $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_level_options']['other_columns_buttons']['body_level_options__button_3'] : "";
if (is_array($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_level_options']['other_columns_buttons']['body_level_options__button_3'])) {
    if (in_array('column_description', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_level_options']['other_columns_buttons']['body_level_options__button_3'])) {
        $tablestring .= "<div class='col_opt_row' id='column_description'>";
        $tablestring .= "<div class='col_opt_title_div'>" . __('Column Description', 'ARPricelite') . "</div>";
        $tablestring .= "<div class='col_opt_input_div'>";
        $tablestring .= "<div class='option_tab' id='column_description_yearly_tab'>";
        $tablestring .= "<textarea id='arp_column_description' name='arp_column_description_" . $col_no[1] . "'  class='col_opt_textarea arp_column_description_first' data-column='main_column_" . $col_no[1] . "'>";
        $tablestring .= stripslashes_deep($columns['column_description']);
        $tablestring .= "</textarea>";
        $tablestring .= "</div>";
        $tablestring .= "<div class='option_tab' id='column_description_monthly_tab' style='display:none;'>";
        $tablestring .= "<textarea id='arp_column_description_second' name='arp_column_description_second_" . $col_no[1] . "'  class='col_opt_textarea arp_column_description_second' data-column='main_column_" . $col_no[1] . "'>";
        $tablestring .= stripslashes_deep($columns['column_description_second']);
        $tablestring .= "</textarea>";
        $tablestring .= "</div>";
        $tablestring .= "<div class='option_tab' id='column_description_quarterly_tab' style='display:none;'>";
        $tablestring .= "<textarea id='arp_column_description_third' name='arp_column_description_third_" . $col_no[1] . "'  class='col_opt_textarea arp_column_description_third' data-column='main_column_" . $col_no[1] . "'>";
        $tablestring .= stripslashes_deep($columns['column_description_third']);
        $tablestring .= "</textarea>";
        $tablestring .= "</div>";
        $tablestring .= "</div>";
        $tablestring .= "<div class='col_opt_button'>";
        if (in_array('arp_object', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_level_options']['other_columns_buttons']['body_level_options__button_3'])) {
            $tablestring .= "<button type='button' class='col_opt_btn_icon add_arp_object arptooltipster align_left' name='add_header_object_" . $col_no[1] . "' id='add_arp_object' data-insert='arp_column_description' data-column='main_" . $j . "' title='" . __('Add Media', 'ARPricelite') . "' data-title='" . __('Add Media', 'ARPricelite') . "'>";
            $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/image-icon.png' />";

            $tablestring .= "</button>";
            $tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";
        }

        if (in_array('arp_fontawesome', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_level_options']['other_columns_buttons']['body_level_options__button_3'])) {
            $tablestring .= "<button type='button' class='col_opt_btn_icon add_header_fontawesome arptooltipster align_left' name='add_header_fontawesome_" . $col_no[1] . "' id='add_header_fontawesome' data-insert='arp_column_description' data-column='main_" . $j . "' title='" . __('Add Font Icon', 'ARPricelite') . "' data-title='" . __('Add Font Icon', 'ARPricelite') . "' >";
            $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/font-awesome-icon.png' />";
            $tablestring .= "</button>";

            $tablestring .= "<div class='arp_font_awesome_model_box_container'>";

            $tablestring .= "</div>";
        }

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

        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='col_opt_row' id='column_description_other_font_family'>";
        $tablestring .= "<div class='col_opt_title_div'>" . __('Font Family', 'ARPricelite') . "</div>";
        $tablestring .= "<div class='col_opt_input_div'>";

        $tablestring .= "<input type='hidden' id='column_description_font_family' name='column_description_font_family_" . $col_no[1] . "' data-column='main_" . $j . "' value='" . $columns['column_description_font_family'] . "' data-column='main_" . $j . "' />";
        $tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='column_description_font_family_" . $col_no[1] . "' data-id='column_description_font_family_" . $col_no[1] . "'>";
        $tablestring .= "<dt><span>" . $columns['column_description_font_family'] . "</span><input type='text' style='display:none;' value='" . $columns['column_description_font_family'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul data-id='column_description_font_family' data-column='" . $j . "'>";

        $tablestring .= "</ul>";
        $tablestring .= "</dd>";
        $tablestring .= "</dl>";

        $tablestring .= "<div class='arp_google_font_preview_note'><a target='_blank'  class='arp_google_font_preview_link' id='arp_column_description_font_family_preview' href='" . $googlefontpreviewurl . $columns['column_description_font_family'] . "'>" . __('Font Preview', 'ARPricelite') . "</a></div>";

        $tablestring .= "</div>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='col_opt_row' id='column_description_other_font_size'>";
        $tablestring .= "<div class='btn_type_size'>";
        $tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Size', 'ARPricelite') . "</div>";
        $tablestring .= "<div class='col_opt_input_div two_column'>";

        $tablestring .= "<input type='hidden' id='column_description_font_size' name='column_description_font_size_" . $col_no[1] . "' value='" . $columns['column_description_font_size'] . "' data-column='main_" . $j . "' />";
        $tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='column_description_font_size_" . $col_no[1] . "' data-id='column_description_font_size_" . $col_no[1] . "' style='width:115px;max-width:115px;'>";
        $tablestring .= "<dt><span>" . $columns['column_description_font_size'] . "</span><input type='text' style='display:none;' value='" . $columns['column_description_font_size'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
        $tablestring .= "<dd>";
        $tablestring .= "<ul data-id='column_description_font_size' data-column='" . $j . "'>";
        $size_arr = array();
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


        //end

        $tablestring .= "</div>";

        $tablestring .= "<div class='col_opt_row' id='column_description_other_font_color'>";

        $tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Style', 'ARPricelite') . "</div>";

        //new font style btns

        $tablestring .= "<div class='col_opt_input_div' data-level='body_level_options' level-id='bodylevel_button3'>";


        //check selected for bold


        if ($columns['column_description_style_bold'] == 'bold') {
            $bodylevel3_style_bold_selected = 'selected';
        } else {
            $bodylevel3_style_bold_selected = '';
        }

        //check selected for italic

        if ($columns['column_description_style_italic'] == 'italic') {
            $bodylevel3_style_italic_selected = 'selected';
        } else {
            $bodylevel3_style_italic_selected = '';
        }

        //check selected for underline or line-through

        if ($columns['column_description_style_decoration'] == 'underline') {
            $bodylevel3_style_underline_selected = 'selected';
        } else {
            $bodylevel3_style_underline_selected = '';
        }

        if ($columns['column_description_style_decoration'] == 'line-through') {
            $bodylevel3_style_linethrough_selected = 'selected';
        } else {
            $bodylevel3_style_linethrough_selected = '';
        }


        $tablestring .= "<div class='arp_style_btn " . $bodylevel3_style_bold_selected . " arptooltipster' title='" . __('Bold', 'ARPricelite') . "' data-title='" . __('Bold', 'ARPricelite') . "' data-align='left' data-column='main_" . $j . "' id='arp_style_bold' data-id='" . $col_no[1] . "'>";
        $tablestring .= "<i class='fa fa-bold'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $bodylevel3_style_italic_selected . " arptooltipster' title='" . __('Italic', 'ARPricelite') . "' data-title='" . __('Italic', 'ARPricelite') . "' data-align='center' data-column='main_" . $j . "' id='arp_style_italic' data-id='" . $col_no[1] . "'>";
        $tablestring .= "<i class='fa fa-italic'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $bodylevel3_style_underline_selected . " arptooltipster' title='" . __('Underline', 'ARPricelite') . "' data-title='" . __('Underline', 'ARPricelite') . "' data-align='right' data-column='main_" . $j . "' id='arp_style_underline' data-id='" . $col_no[1] . "'>";
        $tablestring .= "<i class='fa fa-underline'></i>";
        $tablestring .= "</div>";

        $tablestring .= "<div class='arp_style_btn " . $bodylevel3_style_linethrough_selected . " arptooltipster' title='" . __('Line-through', 'ARPricelite') . "' data-title='" . __('Line-through', 'ARPricelite') . "' data-align='right' data-column='main_" . $j . "' id='arp_style_strike' data-id='" . $col_no[1] . "'>";
        $tablestring .= "<i class='fa fa-strikethrough'></i>";
        $tablestring .= "</div>";



        $tablestring .= "<input type='hidden' id='column_description_style_bold' name='column_description_style_bold_" . $col_no[1] . "' value='" . $columns['column_description_style_bold'] . "' /> ";
        $tablestring .= "<input type='hidden' id='column_description_style_italic' name='column_description_style_italic_" . $col_no[1] . "' value='" . $columns['column_description_style_italic'] . "' /> ";
        $tablestring .= "<input type='hidden' id='column_description_style_decoration' name='column_description_style_decoration_" . $col_no[1] . "' value='" . $columns['column_description_style_decoration'] . "' /> ";





        $tablestring .= "</div>";

        //new font style btn ends

        $tablestring .= "</div>";
    }
}



$tablestring .= "<div class='col_opt_row arp_ok_div' id='body_level_other_arp_ok_div__button_3' style='display:none;'>";
$tablestring .= "<div class='col_opt_btn_div'>";
$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
$tablestring .= __('Ok', 'ARPricelite');
$tablestring .= "</button>";
$tablestring .= "</div>";
$tablestring .= "</div>";



$tablestring .= "</div>";

$tablestring .= "<div class='column_option_div' level-id='button_options__button_4' style='display:none;'>";

$tablestring .= "</div>";

$tablestring .= "<div class='column_option_div' level-id='footer_level_options__button_2' style='display:none;'>";

// BUTTON TEXT
$tablestring .= "<div class='col_opt_row' id='button_text' style='display:none;'>";
$tablestring .= "<div class='col_opt_title_div'>" . __('Button Content', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div'>";

$tablestring .= "<div class='option_tab' id='button_yearly_tab'>";
$tablestring .= "<textarea id='btn_content' data-column='main_" . $j . "' name='btn_content_" . $col_no[1] . "' class='col_opt_textarea btn_content_first'>";
$tablestring .= $columns['button_text'];
$tablestring .= "</textarea>";
$tablestring .= "</div>";

$tablestring .= "</div>";
$tablestring .= "</div>";


// ADD ICON
$tablestring .= "<div class='col_opt_row' id='add_icon' style='display:none;'>";
$tablestring .= "<div class='col_opt_btn_div'>";
$tablestring .= "<button onclick='add_arp_button_shortcode(this,false);' type='button' class='col_opt_btn_icon align_left arptooltipster' name='add_button_shortcode_" . $col_no[1] . "' id='add_button_shortcode' title='" . __('Add Font Icon', 'ARPricelite') . "' data-title='" . __('Add Font Icon', 'ARPricelite') . "'>";

$tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/font-awesome-icon.png' />";
$tablestring .= "</button>";

$tablestring .= "<div class='arp_font_awesome_model_box_container'>";

$tablestring .= "</div>";

$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "<div class='col_opt_row' id='button_size' style='display:none;'>";
$tablestring .= "<div class='col_opt_title_div two_column'>" . __('Button Width', ARPLITE_PT_TXTDOMAIN) . "</div>";
$tablestring .= "<div class='col_opt_input_div two_column'>";

$tablestring .= "<div class='arp_button_slider' data-column='" . $col_no[1] . "'>";
$tablestring .= "</div>";

$tablestring .= "<input type='hidden' id='button_size_input' name='button_size_" . $col_no[1] . "' data-column='main_" . $j . "' value='" . $columns['button_size'] . "' />";
//$tablestring .= "<input type='hidden' id='button_size_input' name='button_size_" . $col_no[1] . "' data-column='main_" . $j . "' value='60' />";
$tablestring .= "</div>";
$tablestring .= "<div class='col_opt_input_div two_column'>";
$tablestring .="<div class='arp_slider_float_left'>80px</div><div class='arp_slider_float_right'>200px</div>";
$tablestring .= "</div>";


$tablestring .= "<div class='col_opt_title_div two_column'>" . __('Button Height', ARPLITE_PT_TXTDOMAIN) . "</div>";
$tablestring .= "<div class='col_opt_input_div two_column'>";
$tablestring .= "<div class='arp_button_height_slider' data-column='" . $col_no[1] . "'>";
$tablestring .= "</div>";

$tablestring .= "<input type='hidden' id='button_height_input' name='button_height_" . $col_no[1] . "' data-column='main_" . $j . "' value='" . @$columns['button_height'] . "' />";
//$tablestring .= "<input type='hidden' id='button_height_input' name='button_height_" . $col_no[1] . "' data-column='main_" . $j . "' value='40' />";
$tablestring .= "</div>";
$tablestring .= "<div class='col_opt_input_div two_column'>";
$tablestring .="<div class='arp_slider_float_left'>30px</div><div class='arp_slider_float_right'>60px</div>";
$tablestring .= "</div>";
$tablestring .= "</div>";

$button_background_color_value = (isset($columns['button_background_color']) && $columns['button_background_color'] != '' ) ? $columns['button_background_color'] : '#ffffff';

// BUTTON FONT FAMILY
$tablestring .= "<div class='col_opt_row' id='button_other_font_family' style='display:none;'>";
$tablestring .= "<div class='col_opt_title_div'>" . __('Font Family', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div'>";

$tablestring .= "<input type='hidden' id='button_font_family' name='button_font_family_" . $col_no[1] . "' value='" . $columns['button_font_family'] . "' data-column='main_" . $j . "' />";
$tablestring .= "<dl class='arp_selectbox column_level_dd' data-name='button_font_family_" . $col_no[1] . "' data-id='button_font_family_" . $col_no[1] . "'>";
$tablestring .= "<dt><span>" . $columns['button_font_family'] . "</span><input type='text' style='display:none;' value='" . $columns['button_font_family'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
$tablestring .= "<dd>";
$tablestring .= "<ul data-id='button_font_family' data-column='" . $j . "'>";

$tablestring .= "</ul>";
$tablestring .= "</dd>";
$tablestring .= "</dl>";

$tablestring .= "<div class='arp_google_font_preview_note'><a target='_blank'  class='arp_google_font_preview_link' id='arp_button_font_family_preview' href='" . $googlefontpreviewurl . $columns['button_font_family'] . "'>" . __('Font Preview', 'ARPricelite') . "</a></div>";

$tablestring .= "</div>";
$tablestring .= "</div>";

// BUTTON FONT SIZE
$tablestring .= "<div class='col_opt_row' id='button_other_font_size' style='display:none;'>";
$tablestring .= "<div class='btn_type_size'>";
$tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Size', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div two_column'>";

$tablestring .= "<input type='hidden' id='button_font_size' data-column='main_" . $j . "' name='button_font_size_" . $col_no[1] . "' value='" . $columns['button_font_size'] . "' />";
$tablestring .= "<dl class='arp_selectbox column_level_size_dd' data-name='button_font_size_" . $col_no[1] . "' data-id='button_font_size_" . $col_no[1] . "' style='width:115px;max-width:115px;'>";
$tablestring .= "<dt><span>" . $columns['button_font_size'] . "</span><input type='text' style='display:none;' value='" . $columns['button_font_size'] . "' class='arp_autocomplete' /><i class='fa fa-caret-down fa-lg'></i></dt>";
$tablestring .= "<dd>";
$tablestring .= "<ul data-id='button_font_size' data-column='" . $j . "'>";
$size_arr = array();
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

// BUTTON FONT COLOR
$tablestring .= "<div class='col_opt_row' id='button_other_font_color'>";

$tablestring .= "<div class='col_opt_title_div two_column'>" . __('Font Style', 'ARPricelite') . "</div>";

//new font style btns
//check selected for bold


if ($columns['button_style_bold'] == 'bold') {
    $button1_style_bold_selected = 'selected';
} else {
    $button1_style_bold_selected = '';
}

//check selected for italic

if ($columns['button_style_italic'] == 'italic') {
    $button1_style_italic_selected = 'selected';
} else {
    $button1_style_italic_selected = '';
}

//check selected for underline or line-through

if ($columns['button_style_decoration'] == 'underline') {
    $button1_style_underline_selected = 'selected';
} else {
    $button1_style_underline_selected = '';
}

if ($columns['button_style_decoration'] == 'line-through') {
    $button1_style_linethrough_selected = 'selected';
} else {
    $button1_style_linethrough_selected = '';
}


$tablestring .= "<div class='col_opt_input_div' data-level='button_level_options'  level-id='buttonoptions_button1' >";

$tablestring .= "<div class='arp_style_btn " . $button1_style_bold_selected . " arptooltipster' title='" . __('Bold', 'ARPricelite') . "' data-title='" . __('Bold', 'ARPricelite') . "' data-align='left' data-column='main_" . $j . "' id='arp_style_bold' data-id='" . $col_no[1] . "'>";
$tablestring .= "<i class='fa fa-bold'></i>";
$tablestring .= "</div>";

$tablestring .= "<div class='arp_style_btn " . $button1_style_italic_selected . " arptooltipster' title='" . __('Italic', 'ARPricelite') . "' data-title='" . __('Italic', 'ARPricelite') . "' data-align='center' data-column='main_" . $j . "' id='arp_style_italic' data-id='" . $col_no[1] . "'>";
$tablestring .= "<i class='fa fa-italic'></i>";
$tablestring .= "</div>";

$tablestring .= "<div class='arp_style_btn " . $button1_style_underline_selected . " arptooltipster' title='" . __('Underline', 'ARPricelite') . "' data-title='" . __('Underline', 'ARPricelite') . "' data-align='right' data-column='main_" . $j . "' id='arp_style_underline' data-id='" . $col_no[1] . "'>";
$tablestring .= "<i class='fa fa-underline'></i>";
$tablestring .= "</div>";

$tablestring .= "<div class='arp_style_btn " . $button1_style_linethrough_selected . " arptooltipster' title='" . __('Line-through', 'ARPricelite') . "' data-title='" . __('Line-through', 'ARPricelite') . "' data-align='right' data-column='main_" . $j . "' id='arp_style_strike' data-id='" . $col_no[1] . "'>";
$tablestring .= "<i class='fa fa-strikethrough'></i>";
$tablestring .= "</div>";


$tablestring .= "<input type='hidden' id='button_style_bold' name='button_style_bold_" . $col_no[1] . "' value='" . $columns['button_style_bold'] . "' /> ";
$tablestring .= "<input type='hidden' id='button_style_italic' name='button_style_italic_" . $col_no[1] . "' value='" . $columns['button_style_italic'] . "' /> ";
$tablestring .= "<input type='hidden' id='button_style_decoration' name='button_style_decoration_" . $col_no[1] . "' value='" . $columns['button_style_decoration'] . "' /> ";

$tablestring .= "</div>";

//new font style btn ends

$tablestring .= "</div>";


$tablestring .= "<div class='col_opt_row arp_ok_div' id='button_options_other_arp_ok_div__button_1'>";
$tablestring .= "<div class='col_opt_btn_div'>";
$tablestring .= "<div class='col_opt_navigation_div'>";
$tablestring .= "<i class='fa fa-long-arrow-left arp_navigation_arrow' id='button_left_arrow' data-column='{$col_no[1]}' data-button-id='footer_level_options__button_2'></i>&nbsp;";
$tablestring .= "<i class='fa fa-long-arrow-right arp_navigation_arrow' id='button_right_arrow' data-column='{$col_no[1]}' data-button-id='footer_level_options__button_2'></i>&nbsp;";
$tablestring .= "</div>";
$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
$tablestring .= __('Ok', 'ARPricelite');
$tablestring .= "</button>";
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "</div>";

$tablestring .= "<div class='column_option_div' level-id='footer_level_options__button_3' style='display:none;'>";

// BUTTON IMAGE
if ($columns['btn_img'] != '') {
    $btn_img_height = $columns['btn_img_height'];
} else {
    $btn_img_height = '';
}
if ($columns['btn_img'] != '') {
    $btn_img_width = $columns['btn_img_width'];
} else {
    $btn_img_width = '';
}
$tablestring .= "<div class='col_opt_row' id='button_image' style='display:none;'>";
$tablestring .= "<div class='col_opt_title_div'>" . __('Button Image url', 'ARPricelite') . "</div>";

$tablestring .= "<div class='col_opt_input_div'>";
$tablestring .= "<input type='text' id='btn_img_url' class='col_opt_input arpbtn_img_url' name='btn_img_url_" . $col_no[1] . "' value='" . $columns['btn_img'] . "'>";

$tablestring .= "<button onclick='add_arp_button_scode(this,false);' type='button' class='col_opt_btn_icon align_left arptooltipster' name='add_button_scode_" . $col_no[1] . "' id='add_button_scode' title='" . __('Add Button Image', 'ARPricelite') . "' data-title='" . __('Add Button Image', 'ARPricelite') . "'>";
$tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/image-icon.png' />";
$tablestring .= "</button>";

$remove_link = "display:none;";
if ($columns['btn_img'] != '') {
    $remove_link = "";
}

$tablestring .= "<div class='arp_google_font_preview_note' id='arp_remove_btn_image_link' style='$remove_link'>";
$tablestring .= "<a onClick='remove_arp_button_scode(this,false)'  name='remove_button_scode_" . $col_no[1] . "' class='arp_google_font_preview_link' style='cursor:pointer'>";
$tablestring .= __('Remove Image', 'ARPricelite');
$tablestring .= "</a>";
$tablestring .= "</div>";

$tablestring .= "<div class='arp_add_image_container add_btn_image_container'>";
$tablestring .= "<div class='arp_add_image_arrow'></div>";
$tablestring .= "<div class='arp_add_img_content'>";

$tablestring .= "<div class='arp_add_img_row'>";

$tablestring .= "<div class='arp_add_img_label'>";
$tablestring .= __('Image URL', 'ARPricelite');
$tablestring .= "<span class='arp_model_close_btn' id='add_btn_image_container'><i class='fa fa-times'></i></span>";
$tablestring .= "</div>";
$tablestring .= "<div class='arp_add_img_option'>";
$tablestring .= "<input type='text' value='" . $columns['btn_img'] . "' class='arp_modal_txtbox img' id='arp_btn_image_url' name='rpt_btn_image_url' />";
$tablestring .= "<button id='arp_add_btn_image_link' data-column-id='main_column_" . $col_no[1] . "' data-insert='btn_image' data-id='arp_btn_image_url' type='button' class='arp_modal_add_file_btn'>";
$tablestring .= __('Add File', 'ARPricelite');
$tablestring .= "</button>";
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "<div class='arp_add_img_row' style='margin-top:10px;'>";
$tablestring .= "<div class='arp_add_img_label'>";
$tablestring .= '<button type="button" onclick="add_arp_btn_shortcode(0);" class="arp_modal_insert_shortcode_btn" name="rpt_image_btn" id="rpt_image_btn">';
$tablestring .= __('Add', 'ARPricelite');
$tablestring .= '</button>';
$tablestring .= '<button type="button" style="display:none;margin-right:10px;" onclick="arp_remove_object();" class="arp_modal_insert_shortcode_btn" name="arp_remove_img_btn" id="arp_remove_img_btn">';
$tablestring .= __('Remove', 'ARPricelite');
$tablestring .= '</button>';
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "</div>";

$tablestring .= "<input type='hidden' class='arpbtn_img_height' id='arpbtn_img_height' value='" . $btn_img_height . "' name='button_img_height_" . $col_no[1] . "' />";
$tablestring .= "<input type='hidden' class='arpbtn_img_width' id='arpbtn_img_width' value='" . $btn_img_width . "' name='button_img_width_" . $col_no[1] . "' />";
$tablestring .= "</div>";

// ADD SHORTCODE


$tablestring .= "<div class='col_opt_row arp_ok_div' id='button_options_other_arp_ok_div__button_2' style='display:none;'>";
$tablestring .= "<div class='col_opt_btn_div'>";
$tablestring .= "<div class='col_opt_navigation_div'>";
$tablestring .= "<i class='fa fa-long-arrow-left arp_navigation_arrow' id='button_left_arrow' data-column='{$col_no[1]}' data-button-id='footer_level_options__button_3'></i>&nbsp;";
$tablestring .= "<i class='fa fa-long-arrow-right arp_navigation_arrow' id='button_right_arrow' data-column='{$col_no[1]}' data-button-id='footer_level_options__button_3'></i>&nbsp;";
$tablestring .= "</div>";
$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
$tablestring .= __('Ok', 'ARPricelite');
$tablestring .= "</button>";
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "</div>";

$tablestring .= "<div class='column_option_div' level-id='footer_level_options__button_4' style='display:none;'>";

// REDIRECT LINK
$tablestring .= "<div class='col_opt_row' id='redirect_link' style='display:none;'>";
$tablestring .= "<div class='col_opt_title_div'>" . __('Button Link', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div'>";
$columns['button_url'] = isset($columns['button_url']) ? $columns['button_url'] : "#";

$tablestring .= "<textarea class='col_opt_textarea button_url_textarea' name='btn_link_" . $col_no[1] . "' id='btn_link'>";
$tablestring .= $columns['button_url'];
$tablestring .= "</textarea>";

$tablestring .= "</div>";
$tablestring .= "</div>";

//Paypal Code
$columns['paypal_code'] = isset($columns['paypal_code']) ? $columns['paypal_code'] : "";

$tablestring .= "<div class='col_opt_row arplite_restricted_view' id='external_btn' style='display:none;'>";
$tablestring .= "<div class='col_opt_title_div'>" . __('Embed Script (e.g. PayPal Code)', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div'>";
$tablestring .= "<textarea class='col_opt_textarea' name='paypal_code_" . $col_no[1] . "' id='arp_paypal_code'>";
$tablestring .= $columns['paypal_code'];
$tablestring .= "</textarea>";
$tablestring .= "</div>";

$tablestring .= "</div>";

//hide default button
$tablestring .= "<div class='col_opt_row arplite_restricted_view' id='hide_default_btn' style='display:none;'>";
$tablestring .= "<div class='col_opt_title_div two_column more_size'>" . __('Hide default button', ARPLITE_PT_TXTDOMAIN) . "</div>";
$tablestring .= "<div class='col_opt_input_div two_column small_size'>";
$tablestring .= "<div class='arp_checkbox_div'>";
$hide_default_btn = '';
if (isset($columns['hide_default_btn']) && $columns['hide_default_btn'] == 1)
    $hide_default_btn = 'checked="checked"';
else
    $hide_default_btn = '';

$tablestring .= "<input type='checkbox' class='arp_checkbox dark_bg arplite_restricted_view' " . $hide_default_btn . " id='arp_hide_default_btn' value='1' name='arp_hide_default_btn_" . $col_no[1] . "' />";
$tablestring .= "<label class='arp_checkbox_label' data-for='arp_hide_default_btn'>" . __('Yes', ARPLITE_PT_TXTDOMAIN) . "</label>";

$tablestring .= "</div>";
$tablestring .= "</div>";
$tablestring .= "<br/><br/>&nbsp;<span class='col_opt_title_div pro_version_info'>(Pro Version)</span>";
$tablestring .= "</div>";


// OPEN IN NEW WINDOW
$tablestring .= "<div class='col_opt_row' id='open_in_new_window' style='display:none;'>";
$tablestring .= "<div class='col_opt_title_div two_column more_size'>" . __('Open in New Tab?', 'ARPricelite') . "</div>";
$tablestring .= "<div class='col_opt_input_div two_column small_size'>";
$tablestring .= "<div class='arp_checkbox_div'>";
if ($columns['is_new_window'] == 1)
    $new_window = 'checked="checked"';
else
    $new_window = '';

$tablestring .= "<input type='checkbox' class='arp_checkbox dark_bg' " . $new_window . " id='new_window' value='1' name='new_window_" . $col_no[1] . "' />";
$tablestring .= "<label class='arp_checkbox_label' data-for='new_window'>" . __('Yes', 'ARPricelite') . "</label>";
$tablestring .= "</div>";
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "<div class='col_opt_row' id='open_in_new_window_actual' style='display:none;'>";
$tablestring .= "<div class='col_opt_title_div two_column more_size'>" . __('Open in New Window?', ARPLITE_PT_TXTDOMAIN) . "</div>";
$tablestring .= "<div class='col_opt_input_div two_column small_size'>";
$tablestring .= "<div class='arp_checkbox_div'>";
$new_window = '';
if (isset($columns['is_new_window_actual']) && $columns['is_new_window_actual'] == 1)
    $new_window = 'checked="checked"';
else
    $new_window = '';

$tablestring .= "<input type='checkbox' class='arp_checkbox arplite_restricted_view dark_bg' " . $new_window . " id='new_window_actual' value='1' name='new_window_actual_" . $col_no[1] . "' />";
$tablestring .= "<label class='arp_checkbox_label' data-for='new_window_actual'>" . __('Yes', ARPLITE_PT_TXTDOMAIN) . "</label>";

$tablestring .= "</div>";
$tablestring .= "</div>";
$tablestring .= "<br/><br/>&nbsp;<span class='col_opt_title_div pro_version_info'>(Pro Version)</span>";
$tablestring .= "</div>";


$tablestring .= "<div class='col_opt_row arp_ok_div' id='button_options_other_arp_ok_div__button_3' style='display:none;'>";
$tablestring .= "<div class='col_opt_btn_div'>";
$tablestring .= "<div class='col_opt_navigation_div'>";
$tablestring .= "<i class='fa fa-long-arrow-left arp_navigation_arrow' id='button_left_arrow' data-column='{$col_no[1]}' data-button-id='footer_level_options__button_4'></i>&nbsp;";
$tablestring .= "<i class='fa fa-long-arrow-right arp_navigation_arrow' id='button_right_arrow' data-column='{$col_no[1]}' data-button-id='footer_level_options__button_4'></i>&nbsp;";
$tablestring .= "</div>";
$tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
$tablestring .= __('Ok', 'ARPricelite');
$tablestring .= "</button>";
$tablestring .= "</div>";
$tablestring .= "</div>";

$tablestring .= "</div>";


$tablestring .= "<div class='column_option_div' level-id='body_li_level_options__button_1' style='display:none;'>";

foreach ($columns['rows'] as $n => $row) {
    $row_no = explode('_', $n);
    $splitedid = explode('_', $n);


    $tablestring .= "<div id='arp_" . $n . "' class='arp_row_wrapper' style='display:none;'>";

    if (in_array('label', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_1'])) {


        $tablestring .= "<div class='col_opt_row arp_" . $n . "' id='label" . $splitedid[1] . "'>";
        $tablestring .= "<div class='col_opt_title_div'>" . __('Label', 'ARPricelite') . "</div>";
        $tablestring .= "<div class='col_opt_input_div'>";

        $tablestring .= "<div class='option_tab' id='description_label_yearly_tab'>";
        $tablestring .= "<textarea id='label' class='col_opt_textarea row_label_first' name='row_" . $col_no[1] . "_label_" . $row_no[1] . "'>";
        $tablestring .= stripslashes_deep($row['row_label']);
        $tablestring .= "</textarea>";
        $tablestring .= "</div>";


        $tablestring .= "<input type='hidden' id='body_li_style_bold_caption' name='body_li_style_bold_caption_column_" . $col_no[1] . "_arp_row_" . $row_no[1] . "' value='" . $row['row_caption_style_bold'] . "' /> ";
        $tablestring .= "<input type='hidden' id='body_li_style_italic_caption' name='body_li_style_italic_caption_column_" . $col_no[1] . "_arp_row_" . $row_no[1] . "' value='" . $row['row_caption_style_italic'] . "' /> ";
        $tablestring .= "<input type='hidden' id='body_li_style_decoration_caption' name='body_li_style_decoration_caption_column_" . $col_no[1] . "_arp_row_" . $row_no[1] . "' value='" . $row['row_caption_style_decoration'] . "' /> ";



        $tablestring .= "</div>";
        $tablestring .= "</div>";


        if (is_array($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_1'])) {

            if (in_array('arp_fontawesome', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_1'])) {
                $tablestring .= "<div class='col_opt_row arp_" . $n . "' id='body_tooltip_add_shortcode" . $splitedid[1] . "' >";
                $tablestring .= "<div class='col_opt_btn_div'>";
                $tablestring .= "<button type='button' class='col_opt_btn_icon align_left arptooltipster arp_add_label_shortcode' id='arp_add_label_shortcode' name='row_" . $col_no[1] . "_add_tooltip_shortcode_btn_" . $row_no[1] . "' col-id=" . $col_no[1] . " data-id='" . $col_no[1] . "' data-row-id='label_" . $splitedid[1] . "' title='" . __('Add Font Icon', 'ARPricelite') . "' data-title='" . __('Add Font Icon', 'ARPricelite') . "' >";
                $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/font-awesome-icon.png' />";
                $tablestring .= "</button>";

                $tablestring .= "<div class='arp_font_awesome_model_box_container'>";

                $tablestring .= "</div>";

                $tablestring .= "</div>";
                $tablestring .= "</div>";
            }
        }
    }

    $tablestring .= "<div class='col_opt_row arp_" . $n . "' id='description" . $splitedid[1] . "'>";
    $tablestring .= "<div class='col_opt_title_div'>" . __('Description', 'ARPricelite') . "</div>";
    $tablestring .= "<div class='col_opt_input_div'>";
    $tablestring .= "<div class='option_tab' id='description_yearly_tab'>";
    $tablestring .= "<textarea id='arp_li_description' col-id=" . $col_no[1] . " class='col_opt_textarea row_description_first' name='row_" . $col_no[1] . "_description_" . $row_no[1] . "'>";
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

    $tablestring .= "<input type='hidden' id='body_li_style_bold' name='body_li_style_bold_column_" . $col_no[1] . "_arp_row_" . $row_no[1] . "' value='" . $row['row_des_style_bold'] . "' /> ";
    $tablestring .= "<input type='hidden' id='body_li_style_italic' name='body_li_style_italic_column_" . $col_no[1] . "_arp_row_" . $row_no[1] . "' value='" . $row['row_des_style_italic'] . "' /> ";
    $tablestring .= "<input type='hidden' id='body_li_style_decoration' name='body_li_style_decoration_column_" . $col_no[1] . "_arp_row_" . $row_no[1] . "' value='" . $row['row_des_style_decoration'] . "' /> ";


    $tablestring .= "</div>";
    $tablestring .= "</div>";



    $tablestring .= "<div class='col_opt_row arp_" . $n . "' id='body_li_add_shortcode" . $splitedid[1] . "' >";
    $tablestring .= "<div class='col_opt_btn_div'>";
    $tablestring .= "<button type='button' class='col_opt_btn_icon arp_add_row_object arptooltipster align_left' name='" . $col_no[1] . "_add_body_li_object_" . $row_no[1] . "' id='arp_add_row_object' data-insert='arp_" . $n . " textarea#arp_li_description' data-column='main_" . $j . "' title='" . __('Add Media', 'ARPricelite') . "' data-title='" . __('Add Media', 'ARPricelite') . "'>";
    $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/image-icon.png' />";
    $tablestring .= "</button>";
    $tablestring .= "<label style='float:left;width:10px;'>&nbsp;</label>";


    $tablestring .= "<button type='button' class='col_opt_btn_icon align_left arptooltipster arp_add_row_shortcode' id='arp_add_row_shortcode' name='row_" . $col_no[1] . "_add_description_shortcode_btn_" . $row_no[1] . "' col-id=" . $col_no[1] . " data-id='" . $col_no[1] . "' data-row-id='' title='" . __('Add Font Icon', 'ARPricelite') . "' data-title='" . __('Add Font Icon', 'ARPricelite') . "' >";
    $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/font-awesome-icon.png' />";
    $tablestring .= "</button>";

    $tablestring .= "<div class='arp_font_awesome_model_box_container'>";

    $tablestring .= "</div>";

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

    $tablestring .= "</div>";
    $tablestring .= "</div>";

    //
    $tablestring .= "<div class='col_opt_row arp_" . $n . "' id='row_level_custom_css" . $splitedid[1] . "'>";
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
    $tablestring .= "<div class='arp_row_custom_css' data-code='font-size:20px;' style='width:24%;'>font-size</div>";
    $tablestring .= "<div class='arp_row_custom_css' data-code='text-align:center;' style='width:25%;'>alignment</div>";
    $tablestring .= "<div class='arp_row_custom_css' data-code='font-weight:bold;'>font-weight</div>";
    $tablestring .= "</div>";
    $tablestring .= "</div>";

    $tablestring .= "<div class='col_opt_row arp_ok_div arp_" . $n . "' id='body_li_level_other_arp_ok_div__button_1" . $splitedid[1] . "' >";
    $tablestring .= "<div class='col_opt_btn_div'>";
    $tablestring .= "<div class='col_opt_navigation_div'>";
    $tablestring .= "<i class='fa fa-long-arrow-up arp_navigation_arrow' id='row_up_arrow' data-column='{$col_no[1]}' data-row-id='arp_{$n}' data-button-id='body_li_level_options__button_1'></i>&nbsp;";
    $tablestring .= "<i class='fa fa-long-arrow-down arp_navigation_arrow' id='row_down_arrow' data-column='{$col_no[1]}' data-row-id='arp_{$n}' data-button-id='body_li_level_options__button_1'></i>&nbsp;";
    $tablestring .= "<i class='fa fa-long-arrow-left arp_navigation_arrow' id='row_left_arrow' data-column='{$col_no[1]}' data-row-id='arp_{$n}' data-button-id='body_li_level_options__button_1'></i>&nbsp;";
    $tablestring .= "<i class='fa fa-long-arrow-right arp_navigation_arrow' id='row_right_arrow' data-column='{$col_no[1]}' data-row-id='arp_{$n}' data-button-id='body_li_level_options__button_1'></i>&nbsp;";
    $tablestring .= "</div>";
    $tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
    $tablestring .= __('Ok', 'ARPricelite');
    $tablestring .= "</button>";
    $tablestring .= "</div>";
    $tablestring .= "</div>";

    $tablestring .= "</div>";
}

$tablestring .= "</div>";


$tablestring .= "<div class='column_option_div' level-id='body_li_level_options__button_2' style='display:none;'>";

$tablestring .= "</div>";

$tablestring .= "<div class='column_option_div' level-id='body_li_level_options__button_3' style='display:none;'>";
if (isset($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_3']) && @is_array(@$arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_3'])) {
    if (@in_array('label', @$arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_3'])) {

        foreach ($columns['rows'] as $n => $row) {
            $row_no = explode('_', $n);
            $splitedid = explode('_', $n);

            $tablestring .= "<div class='arp_row_label_wrapper' id='arp_" . $n . "' style='display:none;'>";
            $tablestring .= "<div class='col_opt_row arp_" . $n . "' id='label" . $splitedid[1] . "'>";
            $tablestring .= "<div class='col_opt_title_div'>" . __('Label', 'ARPricelite') . "</div>";
            $tablestring .= "<div class='col_opt_input_div'>";
            $tablestring .= "<textarea id='label' class='col_opt_textarea' name='row_" . $col_no[1] . "_label_" . $row_no[1] . "'>";
            $tablestring .= stripslashes_deep($row['row_label']);
            $tablestring .= "</textarea>";
            $tablestring .= "</div>";
            $tablestring .= "</div>";


            $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_3'] = isset($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_3']) ? $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_3'] : "";
            if (is_array($arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_3'])) {

                if (in_array('arp_fontawesome', $arplite_tempbuttonsarr['template_button_options']['features'][$ref_template]['body_li_level_options']['other_columns_buttons']['body_li_level_options__button_3'])) {
                    $tablestring .= "<div class='col_opt_row arp_" . $n . "' id='body_tooltip_add_shortcode" . $splitedid[1] . "' >";
                    $tablestring .= "<div class='col_opt_btn_div'>";
                    $tablestring .= "<button type='button' class='col_opt_btn arptooltipster arp_add_label_shortcode' id='arp_add_label_shortcode' name='row_" . $col_no[1] . "_add_tooltip_shortcode_btn_" . $row_no[1] . "' col-id=" . $col_no[1] . " data-id='" . $col_no[1] . "' data-row-id='label_" . $splitedid[1] . "' title='" . __('Add Font Icon', 'ARPricelite') . "' data-title='" . __('Add Font Icon', 'ARPricelite') . "' >";

                    $tablestring .= "<img src='" . ARPLITE_PRICINGTABLE_IMAGES_URL . "/icons/font-awesome-icon.png' />";
                    $tablestring .= "</button>";

                    $tablestring .= "<div class='arp_font_awesome_model_box_container'>";

                    $tablestring .= "</div>";

                    $tablestring .= "</div>";
                    $tablestring .= "</div>";
                }
            }


            $tablestring .= "<div class='col_opt_row arp_ok_div arp_" . $n . "' id='body_li_level_other_arp_ok_div__button_3" . $splitedid[1] . "'>";
            $tablestring .= "<div class='col_opt_btn_div'>";
            $tablestring .= "<button type='button' id='arp_ok_btn' class='col_opt_btn arp_ok_btn' >";
            $tablestring .= __('Ok', 'ARPricelite');
            $tablestring .= "</button>";
            $tablestring .= "</div>";
            $tablestring .= "</div>";

            $tablestring .= "</div>";
        }
    }
}
$tablestring .= "</div>";

$tablestring .= "</div>";
$tablestring .= "</div>";
?>