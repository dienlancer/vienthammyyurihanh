function ArpColumnSortable(){jQuery(".arp_allcolumnsdiv").sortable({opacity:.8,items:".ArpPricingTableColumnWrapper:not(.maincaptioncolumn)",cursor:"move",helper:"clone",placeholder:"main_package_box_placeholder",cancel:".column_level_options,.arp_select_box,.col_opt_input,.col_opt_textarea,.arp_light_checkbox,.arp_dark_checkbox,.general_color_box",revert:!1,tolerance:"pointer",distance:1,forcePlaceholderSize:!0,grid:[20,10],zIndex:99999,beforeStop:function(r,t){1==jQuery.browser.mozilla&&t.helper.css("margin-top",0)},sort:function(r,t){if(1==jQuery.browser.mozilla){t.helper.css("position","absolute");var a=t.helper.offset().top,e="";e=0>=a?Number(t.helper.position().top):Number(t.helper.offset().top);var i=jQuery("body").scrollTop();Number(i)<=Number(0)&&(i=-25),t.helper.css("top",Number(i)+Number(e))}},stop:function(){scrolltop_offset="",arp_rearrange_columns()},start:function(r,t){1==jQuery.browser.mozilla&&t.helper.css("position","absolute").css("margin-top",jQuery(window).scrollTop());var a=t.item.attr("id");t.item.next().css("height",t.item.height()+"px"),t.item.next().css("width",t.item.width()+"px"),t.placeholder.height(t.item.height()),t.placeholder.width(t.helper.width()-20),t.placeholder.css("margin-bottom","40px"),jQuery(".ArpPricingTableColumnWrapper").removeClass("selected"),jQuery("#column_header").removeClass("selected"),jQuery(".arpcolumnheader").removeClass("selected"),jQuery(".arppricingtablebodycontent").removeClass("selected"),jQuery(".arpcolumnfooter").removeClass("selected"),jQuery(".column_level_settings").hide(),jQuery(".arp_allcolumnsdiv #"+a).addClass("selected"),jQuery(".arp_allcolumnsdiv #"+a).css("transition","none")},update:function(){var r=jQuery(".arp_allcolumnsdiv").sortable("toArray");r=JSON.stringify(r),jQuery("#pricing_table_column_order").val(r),jQuery(".ArpPricingTableColumnWrapper").each(function(r){jQuery(this).attr("id");jQuery(this).attr("data-order",r+1)}),arp_rearrange_columns()}})}function uninitializesortable(){var r=jQuery("#arp_wp_version").val();return 3.4>r?jQuery(".arppricingtablebodyoptions").sortable("disable"):jQuery(".arppricingtablebodyoptions").sortable({disabled:!0}),!1}function initializesortable(){var r=jQuery("#arp_wp_version").val();3.1>r&&jQuery(".arppricingtablebodyoptions").sortable("enable"),jQuery(".arppricingtablebodyoptions").sortable({disabled:!1,opacity:.8,axis:"y",helper:"clone",items:"li.arpbodyoptionrow",cusor:"move",disable:!1,cancel:".arp_select_box,.col_opt_input,.col_opt_textarea,.arp_light_checkbox,.arp_dark_checkbox,.general_color_box,.arp_googlemap",placeholder:"arpbodyoptionrow_placeholder",revert:!1,tolerance:"pointer",distance:1,forcePlaceholderSize:!0,start:function(r,t){t.item.next().css("height",t.item.height()+"px"),t.item.next().css("width",t.item.width()+"px"),t.placeholder.height(t.item.height()-2),t.placeholder.width(t.item.width());t.item.attr("data-column"),t.item.attr("id")},sort:function(r,t){if(1==jQuery.browser.mozilla||1==jQuery.browser.opera){var a=jQuery(r.target);if(!/html|body/i.test(a.offsetParent()[0].tagName)){var e=r.pageY-a.offsetParent().offset().top-t.helper.outerHeight(!0)/2;t.helper.css({top:e+"px"})}}},update:function(r,t){var a=t.item.attr("id"),e=("row_wrapper_row_"+a.replace("arp_row_",""),t.item.attr("data-column")),i=t.item.next().attr("id"),o=t.item.prev().attr("id"),d=e.replace("main_column_","");$this=jQuery(".ArpPricingTableColumnWrapper#"+e),$this.find("#column_level_settings_new").find(".column_option_div").each(function(){var r=jQuery(this).attr("level-id"),t=jQuery(this);if("body_li_level_options__button_1"==r||"body_li_level_options__button_2"==r||"body_li_level_options__button_3"==r||"body_li_level_options__button_4"==r||"body_li_level_options__button_5"==r||"body_li_level_options__button_6"==r){var e=jQuery(this).find("#"+a);if(jQuery(this).find("#"+a).remove(),"undefined"!=typeof i&&"undefined"!=typeof o){var _=i.replace("arp_row_","");_=parseInt(_)-1,jQuery(e).insertAfter(t.find("#arp_row_"+_)),$this.find(".arp_row_wrapper").each(function(r){jQuery(this).attr("id","arp_row_"+r),1==$this.attr("is_caption")?(jQuery(this).find("#arp_li_description").parent().parent().attr("id","description"+r),jQuery(this).find("#arp_li_description").parent().parent().attr("class",""),jQuery(this).find("#arp_li_description").parent().parent().addClass("col_opt_row"),jQuery(this).find("#arp_li_description").parent().parent().addClass("arp_row_"+r),jQuery(this).find("#arp_li_description").attr("name","row_"+d+"_description_"+r),jQuery(this).find("#arp_li_description").attr("col-id",d)):(jQuery(this).find("#arp_li_description").parent().parent().parent().attr("id","description"+r),jQuery(this).find("#arp_li_description").parent().parent().parent().attr("class",""),jQuery(this).find("#arp_li_description").parent().parent().parent().addClass("col_opt_row"),jQuery(this).find("#arp_li_description").parent().parent().parent().addClass("arp_row_"+r),jQuery(this).find("#arp_li_description").attr("name","row_"+d+"_description_"+r),jQuery(this).find("#arp_li_description").attr("col-id",d),jQuery(this).find("#row_description_second").attr("name","row_"+d+"_description_second_"+r),jQuery(this).find("#row_description_second").attr("col-id",d),jQuery(this).find("#row_description_third").attr("name","row_"+d+"_description_third_"+r),jQuery(this).find("#row_description_third").attr("col-id",d),jQuery(this).find("li.option_title").attr("data-column",d)),jQuery(this).find("#arp_add_row_shortcode").parent().parent().attr("id","body_li_add_shortcode"+r),jQuery(this).find("#arp_add_row_shortcode").parent().parent().attr("class",""),jQuery(this).find("#arp_add_row_shortcode").parent().parent().addClass("col_opt_row"),jQuery(this).find("#arp_add_row_shortcode").parent().parent().addClass("arp_row_"+r),jQuery(this).find("#arp_add_row_shortcode").attr("name","row_"+d+"_add_description_shortcode_btn_"+r),jQuery(this).find("#arp_add_row_shortcode").attr("data-row-id","row_"+r),jQuery(this).find("#arp_add_row_shortcode").attr("col-id",d),jQuery(this).find("#arp_add_row_shortcode").attr("data-id",d),jQuery(this).find("#row_up_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_down_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_left_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_right_arrow").attr("data-row-id","arp_row_"+r)}),$this.find(".arp_tooltip_wrapper").each(function(r){jQuery(this).attr("id","arp_row_"+r),jQuery(this).find("#arp_li_tooltip").parent().parent().attr("id","tooltip"+r),jQuery(this).find("#arp_li_tooltip").parent().parent().attr("class",""),jQuery(this).find("#arp_li_tooltip").parent().parent().addClass("col_opt_row"),jQuery(this).find("#arp_li_tooltip").parent().parent().addClass("arp_row_"+r),jQuery(this).find("#arp_li_tooltip").attr("name","row_"+d+"_tooltip_"+r),jQuery(this).find("#arp_li_toottip").attr("col-id",d),jQuery(this).find("#row_up_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_down_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_left_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_right_arrow").attr("data-row-id","arp_row_"+r)}),$this.find(".arp_row_label_wrapper").each(function(r){jQuery(this).attr("id","arp_row_"+r),1==$this.attr("is_caption")?(jQuery(this).find("textarea#label").parent().parent().attr("id","label"+r),jQuery(this).find("textarea#label").parent().parent().attr("class",""),jQuery(this).find("textarea#label").parent().parent().addClass("col_opt_row"),jQuery(this).find("textarea#label").parent().parent().addClass("arp_row_"+r),jQuery(this).find("textarea#label").attr("name","row_"+d+"_label_"+r),jQuery(this).find("textarea#label").attr("col-id",d)):(jQuery(this).find("textarea#label").parent().parent().parent().attr("id","label"+r),jQuery(this).find("textarea#label").parent().parent().parent().attr("class",""),jQuery(this).find("textarea#label").parent().parent().parent().addClass("col_opt_row"),jQuery(this).find("textarea#label").parent().parent().parent().addClass("arp_row_"+r),jQuery(this).find("textarea#label").attr("name","row_"+d+"_label_"+r),jQuery(this).find("textarea#label").attr("col-id",d),jQuery(this).find("textarea#label_second").attr("name","row_"+d+"_label_second_"+r),jQuery(this).find("textarea#label_second").attr("col-id",d),jQuery(this).find("textarea#label_third").attr("name","row_"+d+"_label_third_"+r),jQuery(this).find("textarea#label_third").attr("col-id",d),jQuery(this).find("li.option_title").attr("data-column",d)),jQuery(this).find("#row_up_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_down_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_left_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_right_arrow").attr("data-row-id","arp_row_"+r)}),$this.find(".arp_row_wrapper").each(function(r){jQuery(this).attr("id","arp_row_"+r),1==$this.attr("is_caption")?(jQuery(this).find("textarea#label").parent().parent().attr("id","label"+r),jQuery(this).find("textarea#label").parent().parent().attr("class",""),jQuery(this).find("textarea#label").parent().parent().addClass("col_opt_row"),jQuery(this).find("textarea#label").parent().parent().addClass("arp_row_"+r),jQuery(this).find("textarea#label").attr("name","row_"+d+"_label_"+r),jQuery(this).find("textarea#label").attr("col-id",d)):(jQuery(this).find("textarea#label").parent().parent().parent().attr("id","label"+r),jQuery(this).find("textarea#label").parent().parent().parent().attr("class",""),jQuery(this).find("textarea#label").parent().parent().parent().addClass("col_opt_row"),jQuery(this).find("textarea#label").parent().parent().parent().addClass("arp_row_"+r),jQuery(this).find("textarea#label").attr("name","row_"+d+"_label_"+r),jQuery(this).find("textarea#label").attr("col-id",d),jQuery(this).find("textarea#label_second").attr("name","row_"+d+"_label_second_"+r),jQuery(this).find("textarea#label_second").attr("col-id",d),jQuery(this).find("textarea#label_third").attr("name","row_"+d+"_label_third_"+r),jQuery(this).find("textarea#label_third").attr("col-id",d),jQuery(this).find("li.option_title").attr("data-column",d)),jQuery(this).find("#arp_add_label_shortcode").parent().parent().attr("id","body_li_add_shortcode"+r),jQuery(this).find("#arp_add_label_shortcode").parent().parent().attr("class",""),jQuery(this).find("#arp_add_label_shortcode").parent().parent().addClass("col_opt_row"),jQuery(this).find("#arp_add_label_shortcode").parent().parent().addClass("arp_row_"+r),jQuery(this).find("#arp_add_label_shortcode").attr("name","row_"+d+"_add_description_shortcode_btn_"+r),jQuery(this).find("#arp_add_label_shortcode").attr("data-row-id","row_"+r),jQuery(this).find("#arp_add_label_shortcode").attr("col-id",d),jQuery(this).find("#arp_add_label_shortcode").attr("data-id",d),jQuery(this).find("#row_up_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_down_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_left_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_right_arrow").attr("data-row-id","arp_row_"+r)})}else if("undefined"!=typeof i&&"undefined"==typeof o){var _=i.replace("arp_row_","");jQuery(e).insertBefore(t.find("#arp_row_"+_)),$this.find(".arp_row_wrapper").each(function(r){jQuery(this).attr("id","arp_row_"+r),1==$this.attr("is_caption")?(jQuery(this).find("#arp_li_description").parent().parent().attr("id","description"+r),jQuery(this).find("#arp_li_description").parent().parent().attr("class",""),jQuery(this).find("#arp_li_description").parent().parent().addClass("col_opt_row"),jQuery(this).find("#arp_li_description").parent().parent().addClass("arp_row_"+r),jQuery(this).find("#arp_li_description").attr("name","row_"+d+"_description_"+r),jQuery(this).find("#arp_li_description").attr("col-id",d)):(jQuery(this).find("#arp_li_description").parent().parent().parent().attr("id","description"+r),jQuery(this).find("#arp_li_description").parent().parent().parent().attr("class",""),jQuery(this).find("#arp_li_description").parent().parent().parent().addClass("col_opt_row"),jQuery(this).find("#arp_li_description").parent().parent().parent().addClass("arp_row_"+r),jQuery(this).find("#arp_li_description").attr("name","row_"+d+"_description_"+r),jQuery(this).find("#arp_li_description").attr("col-id",d),jQuery(this).find("#row_description_second").attr("name","row_"+d+"_description_second_"+r),jQuery(this).find("#row_description_second").attr("col-id",d),jQuery(this).find("#row_description_third").attr("name","row_"+d+"_description_third_"+r),jQuery(this).find("#row_description_third").attr("col-id",d),jQuery(this).find("li.option_title").attr("data-column",d)),jQuery(this).find("#arp_add_row_shortcode").parent().parent().attr("id","body_li_add_shortcode"+r),jQuery(this).find("#arp_add_row_shortcode").parent().parent().attr("class",""),jQuery(this).find("#arp_add_row_shortcode").parent().parent().addClass("col_opt_row"),jQuery(this).find("#arp_add_row_shortcode").parent().parent().addClass("arp_row_"+r),jQuery(this).find("#arp_add_row_shortcode").attr("name","row_"+d+"_add_description_shortcode_btn_"+r),jQuery(this).find("#arp_add_row_shortcode").attr("data-row-id","row_"+r),jQuery(this).find("#arp_add_row_shortcode").attr("col-id",d),jQuery(this).find("#arp_add_row_shortcode").attr("data-id",d),jQuery(this).find("#row_up_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_down_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_left_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_right_arrow").attr("data-row-id","arp_row_"+r)}),$this.find(".arp_tooltip_wrapper").each(function(r){jQuery(this).attr("id","arp_row_"+r),jQuery(this).find("#arp_li_tooltip").parent().parent().attr("id","tooltip"+r),jQuery(this).find("#arp_li_tooltip").parent().parent().attr("class",""),jQuery(this).find("#arp_li_tooltip").parent().parent().addClass("col_opt_row"),jQuery(this).find("#arp_li_tooltip").parent().parent().addClass("arp_row_"+r),jQuery(this).find("#arp_li_tooltip").attr("name","row_"+d+"_tooltip_"+r),jQuery(this).find("#arp_li_toottip").attr("col-id",d),jQuery(this).find("#row_up_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_down_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_left_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_right_arrow").attr("data-row-id","arp_row_"+r)}),$this.find(".arp_row_label_wrapper").each(function(r){jQuery(this).attr("id","arp_row_"+r),1==$this.attr("is_caption")?(jQuery(this).find("textarea#label").parent().parent().attr("id","label"+r),jQuery(this).find("textarea#label").parent().parent().attr("class",""),jQuery(this).find("textarea#label").parent().parent().addClass("col_opt_row"),jQuery(this).find("textarea#label").parent().parent().addClass("arp_row_"+r),jQuery(this).find("textarea#label").attr("name","row_"+d+"_label_"+r),jQuery(this).find("textarea#label").attr("col-id",d)):(jQuery(this).find("textarea#label").parent().parent().parent().attr("id","label"+r),jQuery(this).find("textarea#label").parent().parent().parent().attr("class",""),jQuery(this).find("textarea#label").parent().parent().parent().addClass("col_opt_row"),jQuery(this).find("textarea#label").parent().parent().parent().addClass("arp_row_"+r),jQuery(this).find("textarea#label").attr("name","row_"+d+"_label_"+r),jQuery(this).find("textarea#label").attr("col-id",d),jQuery(this).find("textarea#label_second").attr("name","row_"+d+"_label_second_"+r),jQuery(this).find("textarea#label_second").attr("col-id",d),jQuery(this).find("textarea#label_third").attr("name","row_"+d+"_label_third_"+r),jQuery(this).find("textarea#label_third").attr("col-id",d),jQuery(this).find("li.option_title").attr("data-column",d)),jQuery(this).find("#row_up_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_down_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_left_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_right_arrow").attr("data-row-id","arp_row_"+r)}),$this.find(".arp_row_wrapper").each(function(r){jQuery(this).attr("id","arp_row_"+r),1==$this.attr("is_caption")?(jQuery(this).find("textarea#label").parent().parent().attr("id","label"+r),jQuery(this).find("textarea#label").parent().parent().attr("class",""),jQuery(this).find("textarea#label").parent().parent().addClass("col_opt_row"),jQuery(this).find("textarea#label").parent().parent().addClass("arp_row_"+r),jQuery(this).find("textarea#label").attr("name","row_"+d+"_label_"+r),jQuery(this).find("textarea#label").attr("col-id",d)):(jQuery(this).find("textarea#label").parent().parent().parent().attr("id","label"+r),jQuery(this).find("textarea#label").parent().parent().parent().attr("class",""),jQuery(this).find("textarea#label").parent().parent().parent().addClass("col_opt_row"),jQuery(this).find("textarea#label").parent().parent().parent().addClass("arp_row_"+r),jQuery(this).find("textarea#label").attr("name","row_"+d+"_label_"+r),jQuery(this).find("textarea#label").attr("col-id",d),jQuery(this).find("textarea#label_second").attr("name","row_"+d+"_label_second_"+r),jQuery(this).find("textarea#label_second").attr("col-id",d),jQuery(this).find("textarea#label_third").attr("name","row_"+d+"_label_third_"+r),jQuery(this).find("textarea#label_third").attr("col-id",d),jQuery(this).find("li.option_title").attr("data-column",d)),jQuery(this).find("#arp_add_label_shortcode").parent().parent().attr("id","body_li_add_shortcode"+r),jQuery(this).find("#arp_add_label_shortcode").parent().parent().attr("class",""),jQuery(this).find("#arp_add_label_shortcode").parent().parent().addClass("col_opt_row"),jQuery(this).find("#arp_add_label_shortcode").parent().parent().addClass("arp_row_"+r),jQuery(this).find("#arp_add_label_shortcode").attr("name","row_"+d+"_add_description_shortcode_btn_"+r),jQuery(this).find("#arp_add_label_shortcode").attr("data-row-id","row_"+r),jQuery(this).find("#arp_add_label_shortcode").attr("col-id",d),jQuery(this).find("#arp_add_label_shortcode").attr("data-id",d),jQuery(this).find("#row_up_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_down_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_left_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_right_arrow").attr("data-row-id","arp_row_"+r)})}else if("undefined"==typeof i&&"undefined"!=typeof o){var _=o.replace("arp_row_","");jQuery(e).insertAfter(t.find("#arp_row_"+_)),$this.find(".arp_row_wrapper").each(function(r){jQuery(this).attr("id","arp_row_"+r),1==$this.attr("is_caption")?(jQuery(this).find("#arp_li_description").parent().parent().attr("id","description"+r),jQuery(this).find("#arp_li_description").parent().parent().attr("class",""),jQuery(this).find("#arp_li_description").parent().parent().addClass("col_opt_row"),jQuery(this).find("#arp_li_description").parent().parent().addClass("arp_row_"+r),jQuery(this).find("#arp_li_description").attr("name","row_"+d+"_description_"+r),jQuery(this).find("#arp_li_description").attr("col-id",d)):(jQuery(this).find("#arp_li_description").parent().parent().parent().attr("id","description"+r),jQuery(this).find("#arp_li_description").parent().parent().parent().attr("class",""),jQuery(this).find("#arp_li_description").parent().parent().parent().addClass("col_opt_row"),jQuery(this).find("#arp_li_description").parent().parent().parent().addClass("arp_row_"+r),jQuery(this).find("#arp_li_description").attr("name","row_"+d+"_description_"+r),jQuery(this).find("#arp_li_description").attr("col-id",d),jQuery(this).find("#row_description_second").attr("name","row_"+d+"_description_second_"+r),jQuery(this).find("#row_description_second").attr("col-id",d),jQuery(this).find("#row_description_third").attr("name","row_"+d+"_description_third_"+r),jQuery(this).find("#row_description_third").attr("col-id",d),jQuery(this).find("li.option_title").attr("data-column",d)),jQuery(this).find("#arp_add_row_shortcode").parent().parent().attr("id","body_li_add_shortcode"+r),jQuery(this).find("#arp_add_row_shortcode").parent().parent().attr("class",""),jQuery(this).find("#arp_add_row_shortcode").parent().parent().addClass("col_opt_row"),jQuery(this).find("#arp_add_row_shortcode").parent().parent().addClass("arp_row_"+r),jQuery(this).find("#arp_add_row_shortcode").attr("name","row_"+d+"_add_description_shortcode_btn_"+r),jQuery(this).find("#arp_add_row_shortcode").attr("data-row-id","row_"+r),jQuery(this).find("#arp_add_row_shortcode").attr("col-id",d),jQuery(this).find("#arp_add_row_shortcode").attr("data-id",d),jQuery(this).find("#row_up_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_down_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_left_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_right_arrow").attr("data-row-id","arp_row_"+r)}),$this.find(".arp_tooltip_wrapper").each(function(r){jQuery(this).attr("id","arp_row_"+r),jQuery(this).find("#arp_li_tooltip").parent().parent().attr("id","tooltip"+r),jQuery(this).find("#arp_li_tooltip").parent().parent().attr("class",""),jQuery(this).find("#arp_li_tooltip").parent().parent().addClass("col_opt_row"),jQuery(this).find("#arp_li_tooltip").parent().parent().addClass("arp_row_"+r),jQuery(this).find("#arp_li_tooltip").attr("name","row_"+d+"_tooltip_"+r),jQuery(this).find("#arp_li_toottip").attr("col-id",d),jQuery(this).find("#row_up_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_down_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_left_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_right_arrow").attr("data-row-id","arp_row_"+r)}),$this.find(".arp_row_label_wrapper").each(function(r){jQuery(this).attr("id","arp_row_"+r),1==$this.attr("is_caption")?(jQuery(this).find("textarea#label").parent().parent().attr("id","label"+r),jQuery(this).find("textarea#label").parent().parent().attr("class",""),jQuery(this).find("textarea#label").parent().parent().addClass("col_opt_row"),jQuery(this).find("textarea#label").parent().parent().addClass("arp_row_"+r),jQuery(this).find("textarea#label").attr("name","row_"+d+"_label_"+r),jQuery(this).find("textarea#label").attr("col-id",d)):(jQuery(this).find("textarea#label").parent().parent().parent().attr("id","label"+r),jQuery(this).find("textarea#label").parent().parent().parent().attr("class",""),jQuery(this).find("textarea#label").parent().parent().parent().addClass("col_opt_row"),jQuery(this).find("textarea#label").parent().parent().parent().addClass("arp_row_"+r),jQuery(this).find("textarea#label").attr("name","row_"+d+"_label_"+r),jQuery(this).find("textarea#label").attr("col-id",d),jQuery(this).find("textarea#label_second").attr("name","row_"+d+"_label_second_"+r),jQuery(this).find("textarea#label_second").attr("col-id",d),jQuery(this).find("textarea#label_third").attr("name","row_"+d+"_label_third_"+r),jQuery(this).find("textarea#label_third").attr("col-id",d),jQuery(this).find("li.option_title").attr("data-column",d)),jQuery(this).find("#row_up_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_down_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_left_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_right_arrow").attr("data-row-id","arp_row_"+r)}),$this.find(".arp_row_wrapper").each(function(r){jQuery(this).attr("id","arp_row_"+r),1==$this.attr("is_caption")?(jQuery(this).find("textarea#label").parent().parent().attr("id","label"+r),jQuery(this).find("textarea#label").parent().parent().attr("class",""),jQuery(this).find("textarea#label").parent().parent().addClass("col_opt_row"),jQuery(this).find("textarea#label").parent().parent().addClass("arp_row_"+r),jQuery(this).find("textarea#label").attr("name","row_"+d+"_label_"+r),jQuery(this).find("textarea#label").attr("col-id",d)):(jQuery(this).find("textarea#label").parent().parent().parent().attr("id","label"+r),jQuery(this).find("textarea#label").parent().parent().parent().attr("class",""),jQuery(this).find("textarea#label").parent().parent().parent().addClass("col_opt_row"),jQuery(this).find("textarea#label").parent().parent().parent().addClass("arp_row_"+r),jQuery(this).find("textarea#label").attr("name","row_"+d+"_label_"+r),jQuery(this).find("textarea#label").attr("col-id",d),jQuery(this).find("textarea#label_second").attr("name","row_"+d+"_label_second_"+r),jQuery(this).find("textarea#label_second").attr("col-id",d),jQuery(this).find("textarea#label_third").attr("name","row_"+d+"_label_third_"+r),jQuery(this).find("textarea#label_third").attr("col-id",d),jQuery(this).find("li.option_title").attr("data-column",d)),jQuery(this).find("#arp_add_label_shortcode").parent().parent().attr("id","body_li_add_shortcode"+r),jQuery(this).find("#arp_add_label_shortcode").parent().parent().attr("class",""),jQuery(this).find("#arp_add_label_shortcode").parent().parent().addClass("col_opt_row"),jQuery(this).find("#arp_add_label_shortcode").parent().parent().addClass("arp_row_"+r),jQuery(this).find("#arp_add_label_shortcode").attr("name","row_"+d+"_add_description_shortcode_btn_"+r),jQuery(this).find("#arp_add_label_shortcode").attr("data-row-id","row_"+r),jQuery(this).find("#arp_add_label_shortcode").attr("col-id",d),jQuery(this).find("#arp_add_label_shortcode").attr("data-id",d),jQuery(this).find("#row_up_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_down_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_left_arrow").attr("data-row-id","arp_row_"+r),jQuery(this).find("#row_right_arrow").attr("data-row-id","arp_row_"+r)})}}}),rearrange_rows(),reset_current_wrapper_li_color()}})}