<?php
global $arplite_pricingtable, $arpricelite_default_settings, $arpricelite_analytics, $arpricelite_fonts, $arpricelite_version, $arprice_font_awesome_icons, $arpricelite_img_css_version, $arplite_subscription_time, $arpricelite_form;
?>

<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ubuntu" />
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto" />
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans" />
<div class="main_box">
    <input type="hidden" name="ajaxurl" id="ajaxurl" value="<?php echo admin_url('admin-ajax.php'); ?>"  />
    <input type="hidden" name="arp_version" id="arp_version" value="<?php
    global $arpricelite_version;
    echo $arpricelite_version;
    ?>" />
    <input type="hidden" name="arp_request_version" id="arp_request_version" value="<?php echo get_bloginfo('version'); ?>" />
    <?php
    $now = time(); /* or your date as well */
    $your_date = get_option('arplite_display_popup_date');
    $datediff = $now - $your_date;
    $days = floor($datediff / (60 * 60 * 24));
    ?>
    <input type="hidden" id="popup_display_difference" name="popup_display_difference" value="<?php echo $arplite_subscription_time; ?>" />
    <input type="hidden" id="popup_current_time_diff" name="popup_current_time_diff" value="<?php echo $days; ?>" />
    <input type="hidden" id="is_display_popup" name="is_display_popup" value="<?php echo get_option('arplite_popup_display'); ?>" />
    <input type="hidden" id="is_already_subscribed" name="is_already_subscribed" value="<?php echo get_option('arplite_already_subscribe'); ?>" />
    <input type="hidden" id="popup_displayed_last_date" name="popup_displayed_last_date" value="<?php echo get_option('arplite_display_popup_date'); ?>" />
    <input type="hidden" id="arplite_current_date" name="arplite_current_date" value="<?php echo time(); ?>" />
    <input type="hidden" name="arp_tour_guide_value" id="arp_tour_guide_value" value="<?php echo get_option('arpricelite_tour_guide_value'); ?>" />
    <input type="hidden" name="arp_restrict_dashboard" id="arp_restrict_dashboard" value="<?php echo get_option('arplite_is_dashboard_visited'); ?>" />
    <div class="pricingtablename">
        <div class="repute_pricing_table_content">
            <div class="arp_tables_container">
                <input type="hidden" id="arpaction" value="create_new" name="arpaction" />
                <input type="hidden" value="arplite_add_pricing_table" name="page">
                <div class="arprice_logo"></div>
                <div class="arprice_my_table_container">
                    <label class="arprice_label"><?php _e('My Pricing Tables', 'ARPricelite'); ?></label>

                    <?php
                    /**
                     * Retrieving Editable Templates
                     * @since ARPricelite 1.0
                     */
                    global $wpdb;
                    $editable_templates = "SELECT * FROM " . $wpdb->prefix . "arplite_arprice WHERE is_template = '0' ORDER BY ID DESC";
                    $arp_my_templates = $wpdb->get_results($editable_templates);
                    $total_saved_templates = count($arp_my_templates);
                    ?>
                    <input type="hidden" id="arplite_total_tables" value="<?php echo $total_saved_templates; ?>" />
                    <div class="arp_tables_container">
                        <?php
                        $total_templates = count($arp_my_templates);
                        foreach ($arp_my_templates as $key => $template) {
                            $template_opt = maybe_unserialize($template->general_options);
                            $template_name = $template_opt['template_setting']['template'];
                            $reference_template = $template_opt['general_settings']['reference_template'];
                            $table_name = $template->table_name;
                            $arp_template_id = $template->ID;
                            ?>
                            <div id="arp_template_<?php echo $arp_template_id; ?>" class="arp_editable_templates" ondblclick="window.location.href = '<?php echo admin_url('admin.php?page=arpricelite&arp_action=edit&eid=' . $arp_template_id); ?>'">
                                <div class="arprice_template_inner_content">
                                    <div class="arp_editable_templates_img" id="arplitetemplate_<?php echo $arp_template_id; ?>">
                                        <?php /* <img src="<?php echo ARPLITE_PRICINGTABLE_UPLOAD_URL . '/template_images/arplitetemplate_' . $arp_template_id . '.png' ?>" width="280" height="150" alt="<?php echo $table_name; ?>" /> */ ?>
                                        <div id="img">
                                        </div>
                                        <script type="text/javascript">
                                            if (screen.width > 1900) {
                                                var img = '<img class="template_large_img" src="<?php echo ARPLITE_PRICINGTABLE_UPLOAD_URL . '/template_images/arplitetemplate_' . $arp_template_id . '_large.png'; ?>" alt="<?php echo $table_name; ?>" align="absmiddle" />';
    <?php
    if (!file_exists(ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/template_images/arplitetemplate_' . $arp_template_id . '_large.png')) {
        ?>
                                                    jQuery('.arp_editable_templates_img#arplitetemplate_' +<?php echo $arp_template_id; ?>).find('#img').html('<span class="no_image_text">No Image</span>');
        <?php
    } else {
        ?>
                                                    jQuery('.arp_editable_templates_img#arplitetemplate_' +<?php echo $arp_template_id; ?>).find('#img').html(img);
    <?php } ?>
                                            } else if (screen.width >= 1600) {
                                                var img = '<img class="template_big_img" src="<?php echo ARPLITE_PRICINGTABLE_UPLOAD_URL . '/template_images/arplitetemplate_' . $arp_template_id . '_big.png'; ?>" alt="<?php echo $table_name; ?>" align="absmiddle" />';
    <?php
    if (!file_exists(ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/template_images/arplitetemplate_' . $arp_template_id . '_big.png')) {
        ?>
                                                    jQuery('.arp_editable_templates_img#arplitetemplate_' +<?php echo $arp_template_id; ?>).find('#img').html('<span class="no_image_text">No Image</span>');
        <?php
    } else {
        ?>
                                                    jQuery('.arp_editable_templates_img#arplitetemplate_' +<?php echo $arp_template_id; ?>).find('#img').html(img);
    <?php } ?>
                                            } else {
                                                var img = '<img  class="template_img" src="<?php echo ARPLITE_PRICINGTABLE_UPLOAD_URL . '/template_images/arplitetemplate_' . $arp_template_id . '.png'; ?>" align="absmiddle" alt="<?php echo $table_name; ?>" height="150px" />';
    <?php
    if (!file_exists(ARPLITE_PRICINGTABLE_UPLOAD_DIR . '/template_images/arplitetemplate_' . $arp_template_id . '.png')) {
        ?>
                                                    jQuery('.arp_editable_templates_img#arplitetemplate_' +<?php echo $arp_template_id; ?>).find('#img').html('<span class="no_image_text">No Image</span>');
        <?php
    } else {
        ?>
                                                    jQuery('.arp_editable_templates_img#arplitetemplate_' +<?php echo $arp_template_id; ?>).find('#img').html(img);
    <?php } ?>
                                            }
                                        </script>
                                    </div>
                                    <ul class="arp_editable_template_info">
                                        <li class="arp_editable_template_info_item">
                                            <label class="arp_template_info_left"><?php _e('Title', 'ARPricelite'); ?></label>
                                            <label class="arp_template_info_right"><?php echo $template->table_name; ?></label>
                                        </li>
                                        <li class="arp_editable_template_info_item">
                                            <label class="arp_template_info_left"><?php _e('Last modified', 'ARPricelite'); ?></label>
                                            <label class="arp_template_info_right">
                                                <?php
                                                $date_format = get_option('date_format');
                                                $last_update_date = $template->arp_last_updated_date;
                                                if ($last_update_date == "0000-00-00 00:00:00")
                                                    $last_update_date = $template->create_date;
                                                echo date($date_format, strtotime($last_update_date));
                                                ?>
                                            </label>
                                        </li>
                                        <li class="arp_editable_template_info_item">
                                            <label class="arp_template_info_left"><?php _e('Statistics', 'ARPricelite'); ?></label>
                                            <label class="arp_template_info_right">

                                                <?php echo $arpricelite_analytics->arp_retrieve_template_views($arp_template_id) . ' ( Visits )'; ?>

                                                <div class="arprice_chart_icon arptooltipster" data-template-views="<?php echo $arpricelite_analytics->arp_retrieve_template_views($arp_template_id); ?>" title="<?php _e('Statistics', 'ARPricelite'); ?>" id="arprice_get_analytics" data-template-id="<?php echo $arp_template_id; ?>" ></div>

                                            </label>
                                        </li>
                                        <li class="arp_editable_template_info_item" id="arprice_shortcode_wrapper">
                                            <label class="arp_template_info_left"><?php _e('Shortcode', 'ARPricelite'); ?></label>
                                            <label class="arp_template_info_right arprice_shortcode" data-field='arp_dashboard_shortcode'>
                                                <input type="text" class="arp_input_shortcode_dashboard" name="arp_dashboard_shortcode" value="[ARPLite id=<?php echo $arp_template_id; ?>]" onClick="this.select();" readonly/>    
                                            </label>

                                        </li>
                                    </ul>
                                </div>
                                <div class="arp_editable_template_action_btn">
                                    <?php
                                    $clone_template_btn_link = admin_url('admin.php?page=arpricelite&eid=' . $template->ID . '&arp_action=new');
                                    ?>
                                    <div class='template_action_button preview_template' id='preview_btn' onClick='arp_price_preview_home("<?php echo $arpricelite_form->get_direct_link($template->ID, true) ?>");' title='<?php _e('Preview', 'ARPricelite'); ?>' ></div>
                                    <div id="edit_template" class="template_action_button edit_template" title="<?php _e('Select Table', 'ARPricelite'); ?>" data-url="<?php echo admin_url('admin.php?page=arpricelite&arp_action=edit&eid=' . $template->ID); ?>"></div>
                                    <div id="clone_template" class="template_action_button clone_template" title="<?php _e('Clone Table', 'ARPricelite'); ?>" data-url="<?php echo $clone_template_btn_link; ?>"></div>
                                    <div id="delete_template" class="template_action_button delete_template" data-template="<?php echo $template->ID; ?>" title="<?php _e('Delete Table', 'ARPricelite'); ?>"></div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="arp_tables_container arp_default_templates_listing" id="arp_default_templates_listing" >
                <div class="arp_default_template_menu_title_belt">
                    <div class="arp_top_edit_menu_inner">
                        <div class="top_edit_menu_title"><?php _e('Please Select Your Template', 'ARPricelite'); ?></div>
                        <button type="button" class="arp_temp_down_btn"><?php _e('Download Free Samples', 'ARPricelite'); ?></button>
                    </div>
                </div>
                <?php
                /**
                 * Retrieving Default Templates
                 * @since ARPricelite 1.0
                 */
                $default_templates = "SELECT * FROM " . $wpdb->prefix . "arplite_arprice WHERE is_template = '1' AND status = 'published' ORDER BY is_template DESC, is_animated ASC, ID ASC";
                $default_templates = $wpdb->get_results($default_templates);
                $template_orders = $arplite_pricingtable->arp_template_order();
                $pro_templates = $arplite_pricingtable->arp_template_pro_images();
                $template_new_orders = array();
                $x = 0;
                $total_default = count($default_templates);
                $total_ordered = count($template_orders);

                foreach ($template_orders as $key => $value) {
                    foreach ($default_templates as $key1 => $template) {
                        $template_opt = maybe_unserialize($template->general_options);
                        $reference_template = $template_opt['general_settings']['reference_template'];
                        if ($key == $reference_template) {
                            $template_new_orders[$x] = $default_templates[$key1];
                        }
                    }
                    $x++;
                }
                ?>
                <div class="arp_tables_content_container">
                    <div class="arp_tables_inner_container">
                        <div class="arp_tables_list_container">
                            <div class="arp_tables_listing">
                                <?php
                                foreach ($template_new_orders as $key => $template) {
                                    $template_opt = maybe_unserialize($template->general_options);
                                    $template_name = $template_opt['template_setting']['template'];
                                    $reference_template = $template_opt['general_settings']['reference_template'];
                                    $table_name = $template->table_name;
                                    $arp_template_id = $template->ID;
                                    ?>
                                    <div id="arp_template_<?php echo $template->ID; ?>" class="arp_template_scheme custom_template" is_template='0' onclick="arp_select_template('<?php echo $template->ID; ?>', '<?php echo $template_opt['template_setting']['template']; ?>', '<?php echo $template_opt['template_setting']['skin']; ?>', '<?php echo $reference_template ?>');">
                                        <div class="template_action_div_belt">
                                            <div class="template_action_div_inner_belt">
                                                <div id="clone_template" class="template_action_button clone_template" title="" data-url="<?php echo admin_url('admin.php?page=arpricelite&eid=' . $template->ID . '&arp_action=new'); ?>"></div>
                                                <div class='template_action_button preview_template' id='preview_btn' onClick='arp_price_preview_home("<?php echo $arpricelite_form->get_direct_link($template->ID, true) ?>");' title='' ></div>
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                            if (screen.width > 1900) {
                                                var img = '<img class="template_large_img" src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL . '/' . $reference_template . '_large_v' . $arpricelite_img_css_version . '.png'; ?>" alt="<?php echo $table_name; ?>" align="absmiddle" />';
                                                jQuery("#arp_template_<?php echo $template->ID ?>").find('.template_action_div_belt').after(img);
                                            } else if (screen.width >= 1600 && screen.width < 1900) {
                                                if (Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0) {
                                                    var img = '<img  class="template_img" src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL . '/' . $reference_template . '_v' . $arpricelite_img_css_version . '.png'; ?>" align="absmiddle" alt="<?php echo esc_html($table_name); ?>" />';
                                                    jQuery("#arp_template_<?php echo $template->ID ?>").find('.template_action_div_belt').after(img);
                                                }
                                                else
                                                {
                                                    var img = '<img class="template_big_img" src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL . '/' . $reference_template . '_big_v' . $arpricelite_img_css_version . '.png'; ?>" alt="<?php echo esc_html($table_name); ?>" align="absmiddle" />';
                                                    jQuery("#arp_template_<?php echo $template->ID ?>").find('.template_action_div_belt').after(img);

                                                }
                                            } else {
                                                var img = '<img  class="template_img" src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL . '/' . $reference_template . '_v' . $arpricelite_img_css_version . '.png'; ?>" align="absmiddle" alt="<?php echo $table_name; ?>" />';
                                                jQuery("#arp_template_<?php echo $template->ID ?>").find('.template_action_div_belt').after(img);
                                            }
                                        </script>
                                    </div>
                                    <?php
                                }

                                foreach ($pro_templates as $key => $value) {
                                    $template_id = str_replace('arplitetemplate_', '', $value);
                                    ?>
                                    <div id="arp_template_<?php echo $template_id; ?>" class="arp_template_scheme custom_template pro_template">
                                        <div class="template_action_div_belt">
                                            <div class="template_action_div_inner_belt">
                                                <div class="pro_version_info"><i class="fa fa-lock  arpsize-ico-28"></i>&nbsp;&nbsp;<?php _e('Available In Premium Version', 'ARPricelite'); ?>&nbsp;&nbsp;<i class="fa fa-lock  arpsize-ico-28"></i></div>
                                                <div id="pro_template" class="template_action_button pro_template" title=""></div>
                                                <div class='template_action_button preview_template' id='preview_btn' data-img-url="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL . '/' . $value . '_v' . $arpricelite_img_css_version . '_preview.png'; ?>" data-id="<?php echo $value; ?>" onClick='arp_price_preview_home(this);' title='' ></div>
                                            </div>
                                            <script type="text/javascript">
                                                if (screen.width > 1900) {
                                                    var img = '<img class="template_large_img" src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL . '/' . $value . '_large_v' . $arpricelite_img_css_version . '.png'; ?>" alt="<?php echo $table_name; ?>" align="absmiddle" />';
                                                    jQuery("#arp_template_<?php echo $template_id ?>").find('.template_action_div_belt').after(img);
                                                } else if (screen.width >= 1600) {
                                                    var img = '<img class="template_big_img" src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL . '/' . $value . '_big_v' . $arpricelite_img_css_version . '.png'; ?>" alt="<?php echo $table_name; ?>" align="absmiddle" />';
                                                    jQuery("#arp_template_<?php echo $template_id ?>").find('.template_action_div_belt').after(img);
                                                } else {
                                                    var img = '<img  class="template_img" src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL . '/' . $value . '_v' . $arpricelite_img_css_version . '.png'; ?>" align="absmiddle" alt="<?php echo $value; ?>" />';
                                                    jQuery("#arp_template_<?php echo $template_id ?>").find('.template_action_div_belt').after(img);
                                                }
                                            </script>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="arp_user_help_section">
            <div class="arp_guid_btn" title="Documentation" id="arp_documentation" onclick="javascript:open_documentation('http://arprice.arformsplugin.com/documentation/index.html');"><img src="<?php echo ARPLITE_PRICINGTABLE_URL; ?>/images/documentation-icon.png" /></div>
            <div class="arp_guid_btn" id="arp_tour_guide_start" title="Tour Guide"><img src="<?php echo ARPLITE_PRICINGTABLE_URL; ?>/images/tour-guid-icon.png" /></div>
            <div class="arp_user_help_section">
                <div class="arp_guid_btn" title="Documentation" id="arp_documentation" onclick="javascript:open_documentation('http://arprice.arformsplugin.com/documentation/index.html');"><img src="<?php echo ARPLITE_PRICINGTABLE_URL; ?>/images/documentation-icon.png" /></div>
                <div class="arp_guid_btn" id="arp_tour_guide_start" title="Tour Guide"><img src="<?php echo ARPLITE_PRICINGTABLE_URL; ?>/images/tour-guid-icon.png" /></div>
            </div>
        </div>
    </div>
</div>

<div class="arp_upgrade_modal" id="arplite_pro_table_notice" style="display:none;">
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

<div class="arp_subscription_model" id="arplite_subscription_model" style="display:none;">
    <div class="arp_subscription_model_close_btn"><img src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL . '/icons/close_button.png' ?>" height="15" width="15" /></div>
    <form name="arplite_subscription" method="get" action="<?php echo admin_url('admin.php'); ?>">
        <input type="hidden" name="page" value="arpricelite" />
        <div class="arp_subscription_header_wrapper">
            <div class="arp_subscription_header">
                <div class="arp_subscription_model_title"> <?php _e('Subscribe with Us', ARPLITE_PT_TXTDOMAIN); ?> </div>
                <div class="arp_subscription_model_subtitle">Get interesting offers and update notifications straight into your email Inbox. Only few mails a year.</div>
                <div class="arp_subscription_form">
                    <input type="text" name="subscription_email" id="subscription_email" placeholder="Enter Your Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Your Email'" class="arp_subscription_field" />
                    <div class="arperrmessage subscribeerror" id="subscription_email_error" style="display:none;"><?php _e('This field cannot be blank.', ARPLITE_PT_TXTDOMAIN); ?></div>
                </div>
            </div>
        </div>
        <div class="arp_subscription_submit_button_wrapper">
            <button type="button" name="arp_subscribe" class="arp_subscribe_button" id="subscribe-arprice" value="subscribe"><?php _e('Send it now', ARPLITE_PT_TXTDOMAIN); ?>&nbsp;&nbsp;<i class="fa fa-caret-right"></i></button>
            <span id="subscribe_loader" style="display:none;"><img src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL . '/ajax_loader_add_new_column.gif'; ?>" height="15" /></span>
            <span class="arplite_subscription_note"><?php _e('We respect your privacy. We will NEVER share your detail anywhere.', ARPLITE_PT_TXTDOMAIN) ?></span>
        </div>
    </form>
</div>

<!-- Remove template -->
<div class="arp_model_delete_box" id="arp_remove_template" style="display:none;background:white;">
    <input type="hidden" id="delete_table_id" value="" />
    <div class="modal_top_belt">
        <span class="modal_title"><?php _e('Delete Table', 'ARPricelite'); ?></span>
        <span id="nav_style_close" class="modal_close_btn b-close"></span>
    </div>
    <div class="arp_modal_delete_content">
        <div class="arp_delete_modal_msg"><?php _e('Are you sure you want to delete this table?', 'ARPricelite'); ?></div>
        <div class="arp_delete_modal_btn">
            <button id="Model_Delete_Template"  type="button" class="ribbon_insert_btn delete_template"><?php _e('Okay', 'ARPricelite'); ?></button>
            <button id="Model_Delete_Template"  class="ribbon_cancel_btn" type="button"><?php _e('Cancel', 'ARPricelite'); ?></button>
        </div>
    </div>
</div>

<!-- Remove template -->

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

<!-- ARPrice Pro Preview Model -->
<div class="arp_model_box" id="arp_pricing_table_pro_preview" style="display:none;background:white;">
    <div class="arp_model_preview_belt">
        <div class="arp_pro_model_notice">
            <?php _e('This template is available in premium version', 'ARPricelite'); ?>
        </div>
        <div class="preview_close" id="prev_close_icon">
            <span class="modal_close_btn b-close"></span>
        </div>
    </div>
    <div class="preview_model" style="float:left;width:100%;height:90%;">

    </div>
</div>
<!-- ARPrice Pro Preview Model -->

<div class="arp_upgrade_modal" id="arplite_save_table_notice_editor" style="display:none;">
    <div class="upgrade_modal_top_belt">
        <div class="logo" style="text-align:center;"><img src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/arprice_update_logo.png" /></div>
        <div id="nav_style_close" class="close_button b-close"><img src="<?php echo ARPLITE_PRICINGTABLE_IMAGES_URL; ?>/arprice_upgrade_close_img.png" /></div>
    </div>
    <div class="upgrade_title"><?php _e('Upgrade To Premium Version.', 'ARPricelite'); ?></div>
    <div class="upgrade_message"><?php _e('You can create maximum 4 tables in free version.', 'ARPricelite'); ?></div>
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

