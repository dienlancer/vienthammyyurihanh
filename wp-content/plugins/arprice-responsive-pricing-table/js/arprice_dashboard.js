function arp_select_template(e,r,t,a){jQuery(".arp_template_scheme").removeClass("arp_active"),jQuery("#arp_template_"+e).addClass("arp_active"),jQuery("#template_type_new").val(e),jQuery("#table_id").val(e),jQuery("#arp_template_old").val(r),jQuery("#arp_template").val("arplitetemplate_"+e),jQuery("#arp_template_skin").val(t),jQuery("#arp_ready_template").show(),jQuery("#arp_reference_template").val(a);var i=jQuery("#arp_template_"+e).attr("is_template");0==i?jQuery("div#delete_template.savebtn").show():jQuery("div#delete_template.savebtn").hide()}function arp_price_preview_home(e){var r=typeof e,t=jQuery(window).height(),a=jQuery(window).width();a="1100";var i=.9*Number(a),p=.1*Number(a)/2,o=Number(t)-80;jQuery("#table_id").val();i="1100";jQuery("#arp_pricing_table_preview").attr("style","display:none; width:"+i+"px; height:"+o+"px; left:"+p+"px;"),jQuery("#arp_pricing_table_preview").attr("data-modalwidth",i),jQuery("#arp_pricing_table_preview").attr("data-modalleft",p),jQuery(".device_icon").removeClass("active"),jQuery(".device_icon#computer_icon").addClass("active");if("string"===r)jQuery("#arp_pricing_table_preview").bPopup({positionStyle:"fixed",content:"iframe",contentContainer:"#arp_pricing_table_preview .preview_model",loadUrl:e,follow:[!1,!1],transition:"slideDown",transitionClose:"slideDown",iframeAttr:'scrolling="yes"'},function(){var e=jQuery("#arp_pricing_table_preview").css("left");e=e.replace("px",""),jQuery("#arp_pricing_table_preview").attr("data-modalleft",e)});else{var u=jQuery(e),n=(u.attr("data-img-url"),jQuery("#ajaxurl").val()),l=u.attr("data-id");jQuery("#arp_pricing_table_pro_preview").attr("style","display:none; width:"+i+"px; height:"+o+"px; left:"+p+"px;"),jQuery("#arp_pricing_table_pro_preview").attr("data-modalwidth",i),jQuery("#arp_pricing_table_pro_preview").attr("data-modalleft",p);var c=n+"?action=arplite_pro_preview&template_id="+l;jQuery("#arp_pricing_table_pro_preview").bPopup({positionStyle:"fixed",content:"iframe",contentContainer:"#arp_pricing_table_pro_preview .preview_model",loadUrl:c,follow:[!1,!1],transition:"slideDown",transitionClose:"slideDown",iframeAttr:'scrolling="yes"'},function(){var e=jQuery("#arp_pricing_table_pro_preview").css("left");e=e.replace("px",""),jQuery("#arp_pricing_table_pro_preview").attr("data-modalleft",e)})}}function open_documentation(e){var r=window.open(e,"_blank");r.focus()}jQuery(document).ready(function(){jQuery(".arp_editable_templates .template_action_button").tipso({position:"right",background:"#4c4c4c",width:"auto",useTitle:!0}),jQuery(".arptooltipster").tipso({position:"bottom",background:"#43B4FB",width:"auto",useTitle:!0}),jQuery("#subscribe-arprice").click(function(){var e=jQuery("#ajaxurl").val(),r=jQuery("#subscription_email").val();return""==r?!1:(jQuery("#subscribe_loader").css("display","inline"),jQuery.ajax({type:"POST",url:e,data:"action=arpsubscribe&cust_email="+r,success:function(e){jQuery("#subscribe_loader").css("display","none"),"VERIFIED"==e?jQuery("#arplite_subscription_model").bPopup().close():jQuery("#arplite_subscription_model").bPopup().close(),jQuery("#arplite_subscription_model").bPopup().close()}}),!1)}),jQuery("input[type='checkbox'].arp_checkbox").each(function(){if(jQuery(this).hasClass("light_bg")){var e=jQuery(this).parent().attr("class");"arp_dark_checkbox"!=e&&jQuery(this).wrap('<span class="arp_dark_checkbox" id="'+jQuery(this).attr("id")+'"></span>')}else jQuery(this).hasClass("dark_bg")&&jQuery(this).wrap('<span class="arp_light_checkbox" id="'+jQuery(this).attr("id")+'"></span>')}),jQuery("input[type='checkbox'].arp_checkbox:not(.arplite_restricted_view)").each(function(){1==jQuery(this).is(":checked")?jQuery(this).parent().addClass("checked"):jQuery(this).parent().removeClass("checked")}),jQuery("input[type='checkbox'].arp_checkbox:not(.arplite_restricted_view)").each(function(){1==jQuery(this).is(":checked")?jQuery(this).parent().addClass("checked"):jQuery(this).parent().removeClass("checked")}),jQuery(document).on("click",'input[type="checkbox"].arp_checkbox:not(.arplite_restricted_view)',function(){1==jQuery(this).is(":checked")?jQuery(this).parent().addClass("checked"):jQuery(this).parent().removeClass("checked")}),jQuery(document).on("click",'input[type="checkbox"].arp_checkbox:not(.arplite_restricted_view)',function(){1==jQuery(this).is(":checked")?jQuery(this).parent().addClass("checked"):jQuery(this).parent().removeClass("checked")}),jQuery(".arp_guid_btn").tipso({position:"left",background:"#4c4c4c",width:"auto",useTitle:!0})}),jQuery(document).on("click","#pro_template",function(){jQuery("#arplite_pro_table_notice").bPopup({modalColor:"#656565"})}),jQuery(document).ready(function(){var e=jQuery("#is_display_popup").val(),r=jQuery("#is_already_subscribed").val(),t=jQuery("#popup_displayed_last_date").val(),a=jQuery("#popup_display_difference").val(),i=jQuery("#popup_current_time_diff").val();"no"==r&&(""!=t?i>a&&jQuery("#arplite_subscription_model").bPopup({modalColor:"#656565",opacity:.5,escClose:!1,modalClose:!1,onClose:function(){var e=jQuery("#ajaxurl").val();jQuery.ajax({url:e,dataType:"json",type:"POST",data:"action=update_subscribe_date",success:function(e){jQuery("#popup_displayed_last_date").val(e.time),jQuery("#is_display_popup").val(e.display)}})}}):"yes"==e&&jQuery("#arplite_subscription_model").bPopup({modalColor:"#656565",opacity:.5,escClose:!1,modalClose:!1,onClose:function(){var e=jQuery("#ajaxurl").val();jQuery.ajax({url:e,dataType:"json",type:"POST",data:"action=update_subscribe_date",success:function(e){jQuery("#popup_displayed_last_date").val(e.time),jQuery("#is_display_popup").val(e.display)}})}}))}),jQuery(document).on("click",".arp_subscription_model_close_btn",function(){jQuery("#arplite_subscription_model").bPopup().close()}),jQuery(document).on("click","#delete_template",function(){var e=jQuery(this).attr("data-template");jQuery("#delete_table_id").val(e),jQuery("#arp_remove_template").bPopup()}),jQuery(document).on("click","#Model_Delete_Template",function(){if(jQuery(this).hasClass("delete_template")){var e=jQuery("#delete_table_id").val();jQuery.ajax({type:"POST",url:ajaxurl,data:"action=arpricelite_delete&id="+e,success:function(){jQuery("#delete_table_id").val(""),jQuery(".arp_editable_templates#arp_template_"+e).remove(),jQuery("#arp_template").val(""),jQuery("#arp_template_old").val(""),jQuery("#delete_template.savebtn").hide(),jQuery("#arplite_total_tables").val(jQuery(".arp_editable_templates").length),jQuery("#arp_remove_template .b-close").trigger("click")}})}else jQuery("#delete_template.savebtn").hide(),jQuery("#arp_remove_template .b-close").trigger("click")}),jQuery(document).on("click","label",function(){var e=jQuery(this).attr("data-for");""!=e&&jQuery(this).parent().find("input#"+e).trigger("click")}),jQuery(document).on("click","#pro_upgrade_button_custom_css,#pro_upgrade_cancel_button_custom_css",function(){jQuery("#arplite_custom_css_notice").bPopup().close()}),jQuery(document).on("click","#arplite_restricted_section,.arplite_restricted_view",function(){jQuery("#arplite_custom_css_notice").bPopup({modalColor:"#656565"})}),jQuery(document).on("click",".buy_now_button",function(){var e=document.getElementById("arp_version").value,r=document.getElementById("arp_request_version").value,t="http://arprice.arformsplugin.com/premium/upgrade_to_premium.php?rdt=t1&arp_version="+e+"&arp_request_version="+r,a=window.open(t,"_blank");a.focus()}),jQuery(document).on("click",".buy_now_button_link",function(){var e=document.getElementById("arp_version").value,r=document.getElementById("arp_request_version").value,t="http://arprice.arformsplugin.com/premium/upgrade_to_premium.php?rdt=t1&arp_version="+e+"&arp_request_version="+r,a=window.open(t,"_blank");a.focus()}),jQuery(document).on("click",".purchase-premium_link",function(){var e=document.getElementById("arp_version").value,r=document.getElementById("arp_request_version").value,t="http://arprice.arformsplugin.com/premium/upgrade_to_premium.php?rdt=t1&arp_version="+e+"&arp_request_version="+r,a=window.open(t,"_blank");a.focus()}),jQuery(document).on("click",".learn_more_button",function(){var e=document.getElementById("arp_version").value,r=document.getElementById("arp_request_version").value,t="http://arprice.arformsplugin.com/premium/upgrade_to_premium.php?rdt=t2&arp_version="+e+"&arp_request_version="+r,a=window.open(t,"_blank");a.focus()}),jQuery(document).on("click",".learn_more_button_link",function(){var e=document.getElementById("arp_version").value,r=document.getElementById("arp_request_version").value,t="http://arprice.arformsplugin.com/premium/upgrade_to_premium.php?rdt=t2&arp_version="+e+"&arp_request_version="+r,a=window.open(t,"_blank");a.focus()}),jQuery(document).on("click",".global_learn_more_button_link",function(){var e=document.getElementById("arp_version").value,r=document.getElementById("arp_request_version").value,t="http://arprice.arformsplugin.com/premium/upgrade_to_premium.php?rdt=t2&arp_version="+e+"&arp_request_version="+r,a=window.open(t,"_blank");a.focus()}),jQuery(document).on("click","#clone_template",function(){var e=jQuery(".arp_editable_templates").length;if(e>3)jQuery("#arplite_save_table_notice_editor").bPopup({modalColor:"#656565"});else{var r=jQuery(this).attr("data-url");window.location.href=r}}),jQuery(document).on("click","#edit_template",function(){var e=jQuery(this).attr("data-url");window.location.href=e}),jQuery(document).on("click",".arp_temp_down_btn",function(e){e.preventDefault();var r=document.getElementById("arp_version").value,t=document.getElementById("arp_request_version").value,a="http://arprice.arformsplugin.com/premium/upgrade_to_premium.php?rdt=t8&arp_version="+r+"&arp_request_version="+t,i=window.open(a,"_blank");i.focus()}),jQuery(document).on("click","#arprice_get_analytics",function(){jQuery("#arplite_custom_css_notice").bPopup({modalColor:"#656565"})}),jQuery(document).on("click","#computer_icon",function(){if(!jQuery(this).hasClass("active")){jQuery(".device_icon").removeClass("active"),jQuery(this).addClass("active");var e=jQuery("#arp_pricing_table_preview").attr("data-modalwidth"),r=jQuery("#arp_pricing_table_preview").attr("data-modalleft");jQuery("#arp_pricing_table_preview").css("left",r+"px"),jQuery("#arp_pricing_table_preview").css("width",e+"px"),jQuery("#arp_pricing_table_preview").css("max-width","")}}),jQuery(document).on("click","#tablet_icon",function(){if(!jQuery(this).hasClass("active")){jQuery(".device_icon").removeClass("active"),jQuery(this).addClass("active");var e=jQuery("#arp_responsive_tablet_width").val(),r=jQuery(window).width();if(e>0)var t=e+"px";else var t="768px";var a=parseInt(r)-parseInt(t);a=Number(a)/2,jQuery("#arp_pricing_table_preview").css("left",a+"px"),jQuery("#arp_pricing_table_preview").css("width",t),jQuery("#arp_pricing_table_preview").css("max-width","")}}),jQuery(document).on("click","#mobile_icon",function(){if(!jQuery(this).hasClass("active")){jQuery(".device_icon").removeClass("active"),jQuery(this).addClass("active");var e=jQuery("#arp_responsive_mobile_width").val(),r=jQuery(window).width();if(e>0)var t=e+"px";else var t="480px";var a=parseInt(r)-parseInt(t);a=Number(a)/2,jQuery("#arp_pricing_table_preview").css("left",a+"px"),jQuery("#arp_pricing_table_preview").css("width",t),setTimeout(function(){jQuery("#arp_pricing_table_preview").css("max-width","400px")},200)}});