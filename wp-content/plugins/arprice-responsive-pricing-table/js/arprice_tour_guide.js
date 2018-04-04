function EditorTourGuide(e){var t=new Tour({storage:!1});t.addSteps([{element:"#arp_allcolumnsdiv",title:"Real Time Editor",content:"Below you can see that your selected template is loaded in editor. Here you can modify it as per your need.",placement:"top",backdrop:!0,orphan:!0,onShown:function(){jQuery("#arp_allcolumnsdiv").css("box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery("#arp_allcolumnsdiv").css("float","left"),jQuery("#arp_allcolumnsdiv").css("padding-top","10px"),jQuery("#arp_allcolumnsdiv").css("background","#ffffff"),jQuery(".arp_tour").css("margin-top","15px")},onHide:function(){jQuery("#arp_allcolumnsdiv").css("box-shadow",""),jQuery("#arp_allcolumnsdiv").css("float",""),jQuery("#arp_allcolumnsdiv").css("padding",""),jQuery("#arp_allcolumnsdiv").css("background",""),jQuery(".arp_tour").css("margin-top","")},template:"<div class='popover tour arp_tour'><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button id='arp_next_two' class='arp_tour_next' style='margin:0 15px 15px;' data-role='next'>Next</button><button class='arp_tour_end_tour' style='margin-right:15px;' data-role='end'>End tour</button></div></nav></div>"},{element:".general_color_opts",title:"Choose color",content:"Select color of your template by clicking the button. you will see color change is applied right away :)",backdrop:!0,orphan:!0,placement:"left",onShown:function(){jQuery("#arp_allcolumnsdiv").css("z-index","99999"),jQuery("#arp_allcolumnsdiv").css("position","relative"),jQuery(".general_color_opts").css("box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery("#arp_allcolumnsdiv").css("box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery("#arp_allcolumnsdiv").css("float","left"),jQuery("#arp_allcolumnsdiv").css("padding-top","10px"),jQuery("#arp_allcolumnsdiv").css("background","#ffffff")},onHide:function(){jQuery("#arp_allcolumnsdiv").css("z-index",""),jQuery("#arp_allcolumnsdiv").css("position",""),jQuery(".general_color_opts").css("box-shadow",""),jQuery("#arp_allcolumnsdiv").css("box-shadow",""),jQuery("#arp_allcolumnsdiv").css("float",""),jQuery("#arp_allcolumnsdiv").css("padding",""),jQuery("#arp_allcolumnsdiv").css("background","")},template:"<div class='popover tour arp_tour' style='margin:75px 0 0 -25px'><div class='arrow arrow_color'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_prev' data-role='prev'>Prev</button> <button id='arp_next_thiree' class='arp_tour_next' data-role='next'>Next</button><button class='arp_tour_end_tour' data-role='end'>End tour</button></div></div>"},{element:"#main_column_0",title:"Column level changes",content:"First click column and on the right side you will see option bar. After selecting column, double click header area to see options for header part.",backdrop:!0,orphan:!0,placement:"right",onShown:function(){jQuery("#arp_allcolumnsdiv").addClass("no_arp_tour_hover"),jQuery("#main_column_0").css("box-shadow","0 0 0 4px rgba(79, 213, 214,1)")},onHide:function(){jQuery("#arp_allcolumnsdiv").removeClass("no_arp_tour_hover"),jQuery("#main_column_0").css("box-shadow","")},template:"<div style='margin:0 0 0 20px;'; class='popover tour arp_tour'><div class='arrow arrow_header'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_prev' data-role='prev'>Prev</button><button id='arp_next_four' class='arp_tour_next' data-role='next'>Next</button><button class='arp_tour_end_tour' data-role='end'>End tour</button></div></div>"},{element:"#main_column_0",title:"Pricing area change",content:"Set pricing and its interval from this area.",backdrop:!0,orphan:!0,placement:"right",onShown:function(){jQuery("#arp_allcolumnsdiv").addClass("no_arp_tour_hover"),jQuery("#main_column_0").addClass("ArpPricingTableColumnWrapper_inner_selected selected"),jQuery("#main_column_0").css("z-index","9999"),jQuery("#main_column_0").find(".arppricetablecolumnprice").trigger("dblclick")},onHide:function(){jQuery("#arp_allcolumnsdiv").removeClass("no_arp_tour_hover"),jQuery("#main_column_0").removeClass("ArpPricingTableColumnWrapper_inner_selected selected"),jQuery("#main_column_0").css("z-index","")},template:"<div style='margin:0 0 0 20px;'; class='popover tour arp_tour'><div class='arrow arrow_price'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_prev' data-role='prev'>Prev</button><button id='arp_next_four' class='arp_tour_next' data-role='next'>Next</button><button class='arp_tour_end_tour' data-role='end'>End tour</button></div></div>"},{element:"#preview_btn",title:"Preview button",content:"click 'Next' or 'Preview' button to view your applied changes in separate responsive tab.",backdrop:!0,orphan:!0,placement:"bottom",onNext:function(e){jQuery("#preview_btn").css("box-shadow",""),jQuery("#preview_btn").addClass("DisplayTourGuide"),jQuery("#preview_btn").trigger("click"),jQuery("#arp_allcolumnsdiv").addClass("no_arp_tour_hover"),e.end()},onShown:function(){jQuery("#preview_btn").addClass("DisplayTourGuide")},template:"<div style='margin:12px 0 0 -10px;' class='popover tour arp_tour'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_prev' data-role='prev'>Prev</button><button id='arp_next_preview' class='arp_tour_next' data-role='next'>Next</button><button class='arp_tour_end_tour' data-role='end'>End tour</button></div></div>"}]),setTimeout(function(){t.init(),t.start(),e>0&&t.goTo(e)},1e3)}function previewTour(e){var t=new Tour({storage:!1});t.addSteps([{element:".mobile_icon",title:"Change views",content:"Hit Next or Mobile button to view pricing table preview in mobile view.",backdrop:!0,orphan:!0,placement:"bottom",onShown:function(){jQuery("#preview_btn").removeClass("DisplayTourGuide")},onNext:function(){jQuery("#mobile_icon").trigger("click")},onPrev:function(e){EditorTourGuide(4),jQuery("#arp_pricing_table_preview .b-close").trigger("click"),e.end()},template:"<div style='margin-top:23px;' class='popover tour arp_tour_preview'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_prev' data-role='prev'>Prev</button><button id='arp_next_mobile' class='arp_tour_next' data-role='next'>Next</button><button class='arp_tour_end_tour' data-role='end'>End tour</button></div></div>"},{element:".mobile_icon",title:"Mobile View",content:"Click 'Next' or close button to get back to editor area.",backdrop:!0,orphan:!0,placement:"bottom",onShown:function(){jQuery("#preview_btn").removeClass("DisplayTourGuide")},onNext:function(e){AnimationTours(),jQuery("#arp_pricing_table_preview .b-close").trigger("click"),e.end()},onPrev:function(){jQuery("#computer_icon").trigger("click")},template:"<div style='margin-top:23px;' class='popover tour arp_tour_preview'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_prev' data-role='prev'>Prev</button><button id='arp_next_mobile' class='arp_tour_next' data-role='next'>Next</button><button class='arp_tour_end_tour' data-role='end'>End tour</button></div></div>"}]),setTimeout(function(){t.init(),t.start(),e>0&&t.goTo(e)},1e3)}function AnimationTours(){var e=new Tour({storage:!1});e.addSteps([{element:".arprice_options_menu_belt",title:"General settings",content:"All the template level options like column options, animation effects, tooltip settings etc can be changed in general setting area.",backdrop:!0,orphan:!0,placement:"bottom",onShown:function(){jQuery("#preview_btn").removeClass("DisplayTourGuide"),jQuery(".arprice_options_menu_belt").css("box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery(".arprice_options_menu_belt").css("margin","0 4px 0 4px");var e=jQuery("#column_options").width(),t=jQuery("#column_effects").width(),o=jQuery("#tootip_options").width(),r=jQuery("#custom_css_options").width(),a=jQuery("#toggle_content_options").width(),n=jQuery("#all_font_options").width(),i=parseInt(e)+parseInt(t)+parseInt(o)+parseInt(r)+parseInt(a)+parseInt(n);jQuery(".arprice_options_menu_belt").css("width",i+80),jQuery.browser.safari&&jQuery(".arp_tour_preview").css("margin-left","-75%"),jQuery(".arprice_options_menu_belt").css("background","#ffffff"),jQuery(".arprice_top_belt_menu_right").hide()},onHide:function(){jQuery(".arprice_options_menu_belt").css("box-shadow",""),jQuery(".arprice_options_menu_belt").css("margin",""),jQuery(".arprice_options_menu_belt").css("width",""),jQuery(".arprice_options_menu_belt").css("background",""),jQuery(".arp_tour_preview").css("margin-left","-25%"),jQuery(".arprice_top_belt_menu_right").show()},onNext:function(){jQuery(".arp_shortcode").show(),jQuery("#save_btn").trigger("click")},onPrev:function(e){jQuery(".arprice_options_menu_belt").css("box-shadow",""),jQuery(".arprice_options_menu_belt").css("margin",""),jQuery(".arprice_options_menu_belt").css("width",""),jQuery(".arprice_options_menu_belt").css("background",""),jQuery("#preview_btn").addClass("DisplayTourGuide"),jQuery("#preview_btn").trigger("click"),e.end()},template:"<div style='margin:21px 0 0 -25%;' class='popover tour arp_tour_preview'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_prev' data-role='prev'>Prev</button><button id='arp_next_effects' class='arp_tour_next' data-role='next'>Next</button><button class='arp_tour_end_tour' data-role='end'>End tour</button></div></div>"},{element:".arp_shortcode",title:"Finish",content:"Once you click save button all your changes will be saved as clone of existing template. you can right away copy short code and put it on page. </br>Thank you",backdrop:!0,orphan:!0,placement:"bottom",onShown:function(){jQuery(".arp_shortcode").show(),jQuery(".arp_shortcode").css("box-shadow","0 0 0 4px rgba(79, 213, 214,1)"),jQuery(".arp_shortcode").css("background","#ffffff")},onHide:function(){jQuery(".arprice_options_menu_belt").css("box-shadow","")},onNext:function(e){e.end(),window.location.href="admin.php?page=arpricelite"},template:"<div style='margin:18px 0 0 0' class='popover tour arp_tour_preview'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='arp_tour_end_tour' data-role='next'>End tour</button></div></div>"}]),setTimeout(function(){e.init(),e.start()},1e3)}jQuery(document).ready(function(){var e=jQuery("#arp_tour_guide_start"),t=new Tour({storage:!1,onStart:function(){var o=jQuery(".arp_editable_templates").length;return o>3?(jQuery("#arplite_save_table_notice_editor").bPopup(),void t.end()):e.addClass("disabled",!0)},onEnd:function(){e.removeClass("disabled",!0)}}),o="<div style='margin-top:18px;' class='popover tour arp_tour'>";o+="<div class='arrow'></div><h3 class='popover-title'></h3>",o+="<div class='popover-content'></div><div class='popover-navigation'>",o+="<button id='arp_next_one' class='arp_tour_next' style='margin:0 15px 15px;' data-role='next'>Next</button>",o+="<button class='arp_tour_end_tour' style='margin-right:15px;'  data-role='end'>End tour</button>",o+="</div>",o+="</div>",t.addSteps([{element:"#arp_template_8",title:"Choose your template",content:"Click 'Next' button to clone selected template.",placement:"bottom",backdrop:!0,orphan:!0,onShown:function(){jQuery("#arp_template_8").trigger("click"),jQuery("#arp_template_8").css("background","#ffffff"),jQuery("#arp_template_8").css("box-shadow","0 0 0 4px rgba(79, 213, 214,1)")},onHide:function(){jQuery("#arp_template_8").css("background",""),jQuery("#arp_template_8").css("box-shadow","")},onNext:function(e){jQuery("#arp_template_8").find("#clone_template").trigger("click");var t=/(\?|\&)([^=]+)\=([^&]+)/g,o=jQuery("#arp_template_8").find("#clone_template").attr("data-url"),r="";o.replace(t,function(e){""==r?r=e:r+=e}),r=r.replace("?page=arpricelite","");var a=r+"&tour_guid=true",n=window.location.href+a;jQuery("#arp_template_8").find("#clone_template").attr("data-url",n),jQuery("#arp_template_8").find("#clone_template").trigger("click"),e.end()},template:o}]),t.init();var r=/(tour_guid=true)/gi,a=window.location.href;r.test(a)&&EditorTourGuide(0),jQuery(".arp_tour_guide_start_model").click(function(){var e=jQuery("#ajaxurl").val(),o=jQuery(this).attr("id");jQuery.ajax({url:e,type:"POST",data:"action=update_arplite_tour_guide_value&arp_tour_guide_value="+o,success:function(e){"1"==e&&t.start()}})}),jQuery(document).on("click","#arp_tour_guide_start",function(e){e.preventDefault(),jQuery(".arp_tables_content_container").scrollTop(0),jQuery(this).hasClass("disabled")||t.restart()});var n=jQuery("#arp_tour_guide_value").val();"yes"==n&&setTimeout(function(){jQuery("#arp_tour_guide_model").bPopup()},1e3)});