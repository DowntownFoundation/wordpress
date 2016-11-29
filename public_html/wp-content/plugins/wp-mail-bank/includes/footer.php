<?php
/**
* This file contains javascript code.
*
* @author  Tech Banker
* @package wp-mail-bank/includes
* @version 2.0.0
*/
if(!defined("ABSPATH")) exit;// Exit if accessed directly
if(!is_user_logged_in())
{
	return;
}
else
{
	foreach($user_role_permission as $permission)
	{
		if(current_user_can($permission))
		{
			$access_granted = true;
			break;
		}
	}
	if(!$access_granted)
	{
		return;
	}
	else
	{
		?>
		</div>
		<div class="popup" data-popup="ux_open_popup">
			<div class="popup-inner">
				<div class="portlet box vivid-green" style="margin-bottom: 0px !important;">
					<div class="portlet-title">
						<div class="caption" id="ux_div_action">
							<?php echo $mb_translation_request; ?>
						</div>
					</div>
					<div class="portlet-body form">
						<div id="ux_div_popup_header">
							<form id="ux_frm_language_translator">
								<div class="form-body">
									<div class="row">
										<div class="col-md-6 popup-control">
											<div class="form-group">
												<label class="control-label">
													<?php echo $mb_feedbacks_your_name;?> :
													<i class="icon-custom-question tooltips" data-original-title="<?php echo $mb_popup_your_name_tooltip;?>" data-placement="right"></i>
													<span class="required" aria-required="true">*</span>
												</label>
												<input type="text" class="form-control" name="ux_txt_your_name" id="ux_txt_your_name" value="" placeholder="<?php echo $mb_feedbacks_your_name_placeholder;?>">
											</div>
										</div>
										<div class="col-md-6 popup-control">
											<div class="form-group">
												<label class="control-label">
													<?php echo $mb_feedbacks_your_email;?> :
													<i class="icon-custom-question tooltips" data-original-title="<?php echo $mb_popup_your_email_tooltip;?>" data-placement="right"></i>
													<span class="required" aria-required="true">*</span>
												</label>
												<input type="text" class="form-control" name="ux_txt_email_address" id="ux_txt_email_address" value=""  placeholder="<?php echo $mb_feedbacks_your_email_placeholder;?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $mb_language_interested_to_translate; ?> :
											<i class="icon-custom-question tooltips" data-original-title="<?php echo $mb_language_interested_to_translate_tooltip; ?>" data-placement="right"></i>
											<span class="required" aria-required="true">*</span>
										</label>
										<input type="text" class="form-control" name="ux_txt_language" id="ux_txt_language"  value="" placeholder="<?php echo $mb_language_interested_to_translate_placeholder;?>">
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $mb_popup_query; ?> :
											<i class="icon-custom-question tooltips" data-original-title="<?php echo $mb_popup_query_tooltip; ?>" data-placement="right"></i>
											<span class="required" aria-required="true">*</span>
										</label>
										<textarea class="form-control" name="ux_txtarea_query" id="ux_txtarea_query" rows="7" placeholder="<?php echo $mb_popup_query_placeholder;?>"><?php echo "Hi,\r\r\nI am interested in translating your plugin Mail Bank in my native language.\r\r\nPlease get back to me!\r\r\nThanks";?></textarea>
									</div>
								</div>
								<div class="modal-footer">
									<input type="button" data-popup-close="ux_open_popup" class="btn vivid-green" name="ux_btn_close" id="ux_btn_close" value="<?php echo $mb_close;?>">
									<input type="submit"  class="btn vivid-green" name="ux_btn_send_request" id="ux_btn_send_request" value="<?php echo $mb_popup_send_request;?>">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			jQuery(".tooltips").tooltip_tip({placement: "right"});
			jQuery("li > a").parents("li").each(function()
			{
				if(jQuery(this).parent("ul.page-sidebar-menu-tech-banker").size() === 1)
				{
					jQuery(this).find("> a").append("<span class=\"selected\"></span>");
				}
			});
			if(typeof(load_sidebar_content_mail_bank) != "function")
			{
				function load_sidebar_content_mail_bank()
				{
					var menus_height = jQuery(".page-sidebar-menu-tech-banker").height();
					var content_height = jQuery(".page-content").height() + 30;
					if(parseInt(menus_height) > parseInt(content_height))
					{
						jQuery(".page-content").attr("style","min-height:"+menus_height+"px")
					}
					else
					{
						jQuery(".page-sidebar-menu-tech-banker").attr("style","min-height:"+content_height+"px")
					}
				}
			}
			jQuery(".page-sidebar-tech-banker").on("click", "li > a", function(e)
			{
				var hasSubMenu = jQuery(this).next().hasClass("sub-menu");
				var parent = jQuery(this).parent().parent();
				var sidebar_menu = jQuery(".page-sidebar-menu-tech-banker");
				var sub = jQuery(this).next();
				var slideSpeed = parseInt(sidebar_menu.data("slide-speed"));
				parent.children("li.open").children(".sub-menu:not(.always-open)").slideUp(slideSpeed);
				parent.children("li.open").removeClass("open");
				var sidebar_close = parent.children("li.open").removeClass("open");
				if(sidebar_close)
				{
					setInterval(load_sidebar_content_mail_bank ,100);
				}
				if(sub.is(":visible"))
				{
					jQuery(this).parent().removeClass("open");
					sub.slideUp(slideSpeed);
				}
				else if(hasSubMenu)
				{
					jQuery(this).parent().addClass("open");
					sub.slideDown(slideSpeed);
				}
			});
			if(typeof(paste_only_digits_mail_bank) != "function")
			{
				function paste_only_digits_mail_bank(control_id)
				{
					jQuery("#"+control_id).on("paste keypress",function(e)
					{
						var $this = jQuery("#"+control_id);
						setTimeout(function()
						{
							$this.val($this.val().replace(/[^0-9]/g, ""));
						}, 5);
					});
				}
			}
			if(typeof(remove_unwanted_spaces_mail_bank) != "function")
			{
				function remove_unwanted_spaces_mail_bank(id)
				{
					var api_key = jQuery("#"+id).val();
					api_key = api_key.replace(/[ ]/g, "");
					jQuery("#"+id).val("");
					jQuery("#"+id).val(jQuery.trim(api_key));
				}
			}
			var sidebar_load_interval = setInterval(load_sidebar_content_mail_bank ,1000);
			setTimeout(function()
			{
				clearInterval(sidebar_load_interval);
			}, 5000);
			if(typeof(overlay_loading_mail_bank) != "function")
			{
				function overlay_loading_mail_bank(control_id)
				{
					var overlay_opacity = jQuery("<div class=\"opacity_overlay\"></div>");
					jQuery("body").append(overlay_opacity);
					var overlay = jQuery("<div class=\"loader_opacity\"><div class=\"processing_overlay\"></div></div>");
					jQuery("body").append(overlay);
					if(control_id != undefined)
					{
						var message = control_id;
						var success = <?php echo json_encode($mb_success);?>;
						var issuccessmessage = jQuery("#toast-container").exists();
						if(issuccessmessage != true)
						{
							var shortCutFunction = jQuery("#manage_messages input:checked").val();
							var $toast = toastr[shortCutFunction](message, success);
						}
					}
				}
			}
			if(typeof(remove_overlay_mail_bank) != "function")
			{
				function remove_overlay_mail_bank()
				{
					jQuery(".loader_opacity").remove();
					jQuery(".opacity_overlay").remove();
				}
			}
			if(typeof(base64_encode)!= "function")
			{
				function base64_encode(data)
				{
					var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
					var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
					ac = 0,
					enc = '',
					tmp_arr = [];
					if(!data)
					{
						return data;
					}
					do
					{
						o1 = data.charCodeAt(i++);
						o2 = data.charCodeAt(i++);
						o3 = data.charCodeAt(i++);
						bits = o1 << 16 | o2 << 8 | o3;
						h1 = bits >> 18 & 0x3f;
						h2 = bits >> 12 & 0x3f;
						h3 = bits >> 6 & 0x3f;
						h4 = bits & 0x3f;
						tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
					} while (i < data.length);
					enc = tmp_arr.join('');
					var r = data.length % 3;
					return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);
				}
			}
			if(typeof(open_popup_mail_bank) != "function")
			{
				function open_popup_mail_bank()
				{
					jQuery("[data-popup-open]").on("click", function(e)
					{
						var targeted_popup_class = jQuery(this).attr("data-popup-open");
						jQuery('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
						e.preventDefault();
					});
				}
			}
			// Close Popup
			jQuery("[data-popup-close]").on("click", function(e)
			{
				var confirm_close = confirm(<?php echo json_encode($mb_confirm_close); ?>);
				if(confirm_close == true)
				{
					var targeted_popup_class = jQuery(this).attr("data-popup-close");
					jQuery('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
				}
				e.preventDefault();
			});
			if(typeof(another_test_email_mail_bank) != "function")
			{
				function another_test_email_mail_bank()
				{
					jQuery("#ux_div_mail_console").css("display","none");
					jQuery("#console_log_div").css("display","none");
					jQuery("#ux_div_test_mail").css("display","block");
				}
			}
			if(typeof(premium_edition_notification_mail_bank) != "function")
			{
				function premium_edition_notification_mail_bank()
				{
					var premium_edition = <?php echo json_encode($message_premium_edition); ?>;
					var shortCutFunction = jQuery("#toastTypeGroup_error input:checked").val();
					var $toast = toastr[shortCutFunction](premium_edition);
				}
			}
			if(typeof(mail_bank_mail_sender) != "function")
			{
				function mail_bank_mail_sender(to_email_address)
				{
					jQuery.post(ajaxurl,
					{
						data: base64_encode(jQuery("#ux_frm_test_email_configuration").serialize()),
						param: "mail_bank_test_email_configuration_module",
						action: "mail_bank_action",
						_wp_nonce: "<?php echo isset($mail_bank_test_email_configuration) ? $mail_bank_test_email_configuration : "";?>"
					},
					function(data)
					{
						jQuery("#ux_txtarea_result_log").html("<?php echo $mb_email_configuration_send_test_email_textarea; ?>\n");
						jQuery("#ux_txtarea_result_log").append(<?php echo json_encode($mb_test_email_sending_test_email); ?>+ "&nbsp;" +to_email_address+"\n");
						if(jQuery.trim(data) == "true" || jQuery.trim(data) == "1")
						{
							jQuery("#ux_div_mail_console").css("display","block");
							jQuery("#console_log_div").css("display","none");
							jQuery("#ux_txtarea_result_log").append(<?php echo json_encode($mb_test_email_sent);?>);
						}
						else
						{
							jQuery("#console_log_div").css("display","none");
							jQuery("#ux_div_mail_console").css("display","block");
							if(jQuery.trim(data) != "")
							{
								jQuery("#ux_txtarea_result_log").html(data);
							}
							else
							{
								jQuery("#ux_txtarea_result_log").append(<?php echo json_encode($mb_test_email_not_send);?>);
							}
						}
						load_sidebar_content_mail_bank();
					});
				}
			}
			if(typeof(mail_bank_send_test_mail) != "function")
			{
				function mail_bank_send_test_mail()
				{
					jQuery("#ux_frm_test_email_configuration").validate
					({
						rules:
						{
							ux_txt_email:
							{
								required:true,
								email:true
							},
							ux_txt_subject:
							{
								required:true
							},
							ux_content:
							{
								required:true
							}
						},
						errorPlacement: function(error, element)
						{
							var icon = jQuery(element).parent(".input-icon").children("i");
							icon.removeClass("fa-check").addClass("fa-warning");
							icon.attr("data-original-title", error.text()).tooltip_tip({"container": "body"});
						},
						highlight: function(element)
						{
							jQuery(element).closest(".form-group").removeClass("has-success").addClass("has-error");
						},
						success: function(label, element)
						{
							var icon = jQuery(element).parent(".input-icon").children("i");
							jQuery(element).closest(".form-group").removeClass("has-error").addClass("has-success");
							icon.removeClass("fa-warning").addClass("fa-check");
						},
						submitHandler: function(form)
						{
							var to_email_address = jQuery("#ux_txt_email").val();
							if(jQuery("#wp-ux_content-wrap").hasClass("tmce-active"))
							{
								jQuery("#ux_email_configuration_text_area").val(tinyMCE.get("ux_content").getContent());
							}
							else
							{
								jQuery("#ux_email_configuration_text_area").val(jQuery("#ux_content").val());
							}
							mail_bank_mail_sender(to_email_address);
							jQuery("#console_log_div").css("display","block");
							jQuery("#ux_div_test_mail").css("display","none");
						}
					});
				}
			}
			if(typeof(show_pop_up_mail_bank) != "function")
			{
				function show_pop_up_mail_bank()
				{
					open_popup_mail_bank();
				}
			}
			var translation_request_array = [];
			var url = "<?php echo tech_banker_url."/feedbacks.php";?>";
			var domain_url = "<?php echo site_url(); ?>";
			jQuery("#ux_frm_language_translator").validate
			({
				rules:
				{
					ux_txt_your_name:
					{
						required : true
					},
					ux_txt_email_address:
					{
						required : true,
						email: true
					},
					ux_txt_language:
					{
						required : true
					},
					ux_txtarea_query:
					{
						required : true
					}
				},
				errorPlacement: function (error, element)
				{
					var icon = jQuery(element).parent(".input-icon").children("i");
					icon.removeClass("fa-check").addClass("fa-warning");
					icon.attr("data-original-title", error.text()).tooltip_tip({"container": "body"});
				},
				highlight: function (element)
				{
					jQuery(element).closest(".form-group").removeClass("has-success").addClass("has-error");
				},
				success: function (label, element)
				{
					var icon = jQuery(element).parent(".input-icon").children("i");
					jQuery(element).closest(".form-group").removeClass("has-error").addClass("has-success");
					icon.removeClass("fa-warning").addClass("fa-check");
				},
				submitHandler:function (form)
				{
					translation_request_array.push(jQuery("#ux_txt_your_name").val(),jQuery("#ux_txt_email_address").val(),domain_url,jQuery("#ux_txt_language").val(),jQuery("#ux_txtarea_query").val());
					overlay_loading_mail_bank(<?php echo json_encode($mb_language_translate_request);?>);
					jQuery.post(url,
					{
						data :JSON.stringify(translation_request_array),
						param: "mail_bank_translation_request"
					},
					function(data)
					{
						setTimeout(function()
						{
							remove_overlay_mail_bank();
							window.location.href = "admin.php?page=mb_email_configuration";
						}, 3000);
					});
				}
			});
			<?php
			if(isset($_GET["page"]))
			{
				switch(esc_attr($_GET["page"]))
				{
					case "mb_email_configuration":
						?>
						jQuery("#ux_mb_li_email_configuration").addClass("active");
						<?php
						if(email_configuration_mail_bank == 1)
						{
							?>
							if(typeof(select_credentials_mail_bank) != "function")
							{
								function select_credentials_mail_bank()
								{
									var selected_credential = jQuery("#ux_ddl_mb_authentication").val();
									var type = jQuery("#ux_ddl_type").val();
									if(selected_credential == "oauth2" && type == "smtp")
									{
										jQuery("#ux_div_username_password_authentication").css("display","none");
										jQuery("#ux_div_oauth_authentication").css("display","block");
									}
									else
									{
										jQuery("#ux_div_username_password_authentication").css("display","block");
										jQuery("#ux_div_oauth_authentication").css("display","none");
									}
								}
							}
							if(typeof(mail_bank_second_step_settings) != "function")
							{
								function mail_bank_second_step_settings()
								{
									jQuery("#ux_div_first_step").css("display","none");
									jQuery("#test_email").css("display","none");
									jQuery("#ux_div_second_step").css("display","block");
									jQuery("#ux_div_step_progres_bar_width").css("width","66%");
									jQuery("#ux_div_frm_wizard li:eq(1)").addClass("active");
									jQuery("#ux_div_frm_wizard li:eq(2)").removeClass("active");
								}
							}
							if(typeof(mail_bank_third_step_settings) != "function")
							{
								function mail_bank_third_step_settings()
								{
									jQuery("#ux_div_first_step").removeClass("first-step-helper");
									jQuery("#test_email").css("display","block");
									jQuery("#ux_div_first_step").css("display","none");
									jQuery("#ux_div_second_step").css("display","none");
									jQuery("#ux_div_step_progres_bar_width").css("width","100%");
									jQuery("#ux_div_frm_wizard li:eq(1)").addClass("active");
									jQuery("#ux_div_frm_wizard li:eq(2)").addClass("active");
								}
							}
							if(typeof(mail_bank_from_name_override) != "function")
							{
								function mail_bank_from_name_override()
								{
									var from_name = jQuery("#ux_ddl_from_name").val();
									if(jQuery.trim(from_name) == "dont_override")
									{
										jQuery("#ux_txt_mb_from_name").attr("disabled",true);
									}
									else
									{
										jQuery("#ux_txt_mb_from_name").attr("disabled",false);
									}
								}
							}
							if(typeof(mail_bank_from_email_override) != "function")
							{
								function mail_bank_from_email_override()
								{
									var from_email = jQuery("#ux_ddl_from_email").val();
									if(jQuery.trim(from_email) == "dont_override")
									{
										jQuery("#ux_txt_mb_from_email_configuration").attr("disabled",true);
									}
									else
									{
										jQuery("#ux_txt_mb_from_email_configuration").attr("disabled",false);
									}
								}
							}
							if(typeof(mail_bank_validate_settings) != "function")
							{
								function mail_bank_validate_settings()
								{
									jQuery("#ux_frm_email_configuration").validate
									({
										rules:
										{
											ux_txt_mb_from_name:
											{
												required: true
											},
											ux_txt_mb_from_email_configuration:
											{
												required: true,
												email: true
											},
											ux_txt_email_address:
											{
												required: true,
												email: true
											},
											ux_txt_host:
											{
												required: true
											},
											ux_txt_port:
											{
												required: true
											},
											ux_txt_client_id:
											{
												required: true
											},
											ux_txt_client_secret:
											{
												required: true
											},
											ux_txt_username:
											{
												required: true
											},
											ux_txt_password:
											{
												required: true
											}
										},
										errorPlacement: function(error, element)
										{
											var icon = jQuery(element).parent(".input-icon").children("i");
											icon.removeClass("fa-check").addClass("fa-warning");
											icon.attr("data-original-title", error.text()).tooltip_tip({"container": "body"});
										},
										highlight: function(element)
										{
											jQuery(element).closest(".form-group").removeClass("has-success").addClass("has-error");
										},
										success: function(label, element)
										{
											var icon = jQuery(element).parent(".input-icon").children("i");
											jQuery(element).closest(".form-group").removeClass("has-error").addClass("has-success");
											icon.removeClass("fa-warning").addClass("fa-check");
										},
										submitHandler: function(form)
										{
											if(jQuery("#ux_div_first_step").hasClass("first-step-helper"))
											{
												mail_bank_second_step_settings();
											}
											else if(jQuery("#test_email").hasClass("second-step-helper"))
											{
												jQuery.post(ajaxurl,
												{
													data: base64_encode(jQuery("#ux_frm_email_configuration").serialize()),
													action: "mail_bank_action",
													param: "mail_bank_email_configuration_settings_module",
													_wp_nonce: "<?php echo $mail_bank_email_configuration_settings; ?>"
												},
												function(data)
												{
													var automatic_mail = jQuery("#ux_chk_automatic_sent_mail").is(":checked");
													var mailer_type = jQuery("#ux_ddl_type").val();
													if(jQuery.trim(data) == "100" && mailer_type == "smtp")
													{
														var shortCutFunction = jQuery("#toastTypeGroup_error input:checked").val();
														var $toast = toastr[shortCutFunction](<?php echo json_encode($oauth_not_supported); ?>);
													}
													else if(jQuery.trim(data) != "" && mailer_type == "smtp")
													{
														window.location.href = data;
													}
													else
													{
														var send_mail = false;
														if(jQuery.trim(automatic_mail) == "true")
														{
															var send_mail = true;
														}
														window.location.href = "admin.php?page=mb_email_configuration&auto_mail="+send_mail;
													}
												});
											}
										}
									});
								}
							}
							if(typeof(change_settings_mail_bank) != "function")
							{
								function change_settings_mail_bank()
								{
									var type = jQuery("#ux_ddl_type").val();
									switch(type)
									{
										case "php_mail_function":
											jQuery("#ux_div_smtp_mail_function").css("display","none");
										break;
										case "smtp":
											jQuery("#ux_div_smtp_mail_function").css("display","block");
										break;
									}
									select_credentials_mail_bank();
								}
							}
							if(typeof(mail_bank_get_host_port) != "function")
							{
								function mail_bank_get_host_port()
								{
									change_settings_mail_bank();
									var smtp_user = jQuery("#ux_txt_email_address").val();
									jQuery.post(ajaxurl,
									{
										smtp_user: smtp_user,
										param: "mail_bank_set_hostname_port_module",
										action: "mail_bank_action",
										_wp_nonce:"<?php echo $mail_bank_set_hostname_port;?>"
									},
									function(data)
									{
										if(jQuery.trim(data) != "")
										{
											jQuery("#ux_txt_host").val(data);
											var indexof = data.indexOf("yahoo");
											var hostname = data.substr(indexof,5);
											if(jQuery.trim(data) == "smtp.gmail.com")
											{
												jQuery("#ux_link_content").text("("+<?php echo json_encode($mb_email_configuration_get_google_credentials); ?> +")");
												jQuery("#ux_link_reference").attr("href","https://console.developers.google.com");
											}
											else if(jQuery.trim(data) == "smtp.live.com")
											{
												jQuery("#ux_link_content").text("("+<?php echo json_encode($mb_email_configuration_get_microsoft_credentials); ?>+")");
												jQuery("#ux_link_reference").attr("href","https://account.live.com/developers/applications/create");
											}
											else if(hostname == "yahoo")
											{
												jQuery("#ux_link_content").text("("+<?php echo json_encode($mb_email_configuration_get_yahoo_credentials); ?>+")");
												jQuery("#ux_link_reference").attr("href","https://developer.yahoo.com/apps/");
											}
											else
											{
												jQuery("#ux_link_content").text("");
											}
										}
										else
										{
											jQuery("#ux_txt_host").val("");
											jQuery("#ux_link_content").text("");
										}
										change_settings_mail_bank();
									});
								}
							}
							if(typeof(change_link_content_mail_bank) != "function")
							{
								function change_link_content_mail_bank()
								{
									var host_type = jQuery("#ux_txt_host").val();
									var indexof = host_type.indexOf("yahoo");
									var hostname = host_type.substr(indexof,5);
									if(host_type == "smtp.gmail.com")
									{
										jQuery("#ux_link_content").text("("+<?php echo json_encode($mb_email_configuration_get_google_credentials); ?>+")");
										jQuery("#ux_link_reference").attr("href","https://console.developers.google.com");
										jQuery("#ux_ddl_mb_authentication").val("oauth2");
										select_credentials_mail_bank();
									}
									else if(host_type == "smtp.live.com")
									{
										jQuery("#ux_link_content").text("("+<?php echo json_encode($mb_email_configuration_get_microsoft_credentials); ?>+")");
										jQuery("#ux_link_reference").attr("href","https://account.live.com/developers/applications/create");
										jQuery("#ux_ddl_mb_authentication").val("oauth2");
										select_credentials_mail_bank();
									}
									else if(hostname == "yahoo")
									{
										jQuery("#ux_link_content").text("("+<?php echo json_encode($mb_email_configuration_get_yahoo_credentials); ?>+")");
										jQuery("#ux_link_reference").attr("href","https://developer.yahoo.com/apps/");
										jQuery("#ux_ddl_mb_authentication").val("oauth2");
										select_credentials_mail_bank();
									}
									else
									{
										jQuery("#ux_link_content").text("");
										jQuery("#ux_ddl_mb_authentication").val("plain");
										select_credentials_mail_bank();
									}
								}
							}
							jQuery(document).ready(function()
							{
								jQuery("#ux_ddl_type").val("<?php echo isset($email_configuration_array["mailer_type"]) ? $email_configuration_array["mailer_type"] : "";?>");
								jQuery("#ux_ddl_mb_authentication").val("<?php echo isset($email_configuration_array["auth_type"]) ? $email_configuration_array["auth_type"] : "";?>");
								jQuery("#ux_ddl_from_name").val("<?php echo isset($email_configuration_array["sender_name_configuration"]) ? $email_configuration_array["sender_name_configuration"] : "";?>");
								jQuery("#ux_ddl_from_email").val("<?php echo isset($email_configuration_array["from_email_configuration"]) ? $email_configuration_array["from_email_configuration"] : "";?>");
								jQuery("#ux_ddl_encryption").val("<?php echo isset($email_configuration_array["enc_type"]) ? $email_configuration_array["enc_type"] : "" ?>");
								show_pop_up_mail_bank();
								<?php
								if(isset($test_secret_key_error))
								{
									?>
									var shortCutFunction = jQuery("#toastTypeGroup_error input:checked").val();
									var $toast = toastr[shortCutFunction](<?php echo json_encode($test_secret_key_error); ?>);
									mail_bank_second_step_settings();
									<?php
								}
								if(isset($automatically_send_mail))
								{
									?>
									window.location.href = "admin.php?page=mb_email_configuration&auto_mail=true";
									<?php
								}
								elseif(isset($automatically_not_send_mail))
								{
									?>
									window.location.href = "admin.php?page=mb_email_configuration&auto_mail=false";
									<?php
								}
								?>
								load_sidebar_content_mail_bank();
								//change_link_content_mail_bank();
								select_credentials_mail_bank();
								change_settings_mail_bank();
								mail_bank_from_name_override();
								mail_bank_from_email_override();
								<?php
								if(isset($_REQUEST["auto_mail"]) && esc_attr($_REQUEST["auto_mail"]) == "true")
								{
									?>
									mail_bank_mail_sender("<?php echo get_option('admin_email'); ?>");
									jQuery("#console_log_div").css("display","block");
									jQuery("#ux_div_mail_console").css("display","none");
									jQuery("#ux_div_test_mail").css("display","none");
									mail_bank_third_step_settings();
									<?php
								}
								elseif(isset($_REQUEST["auto_mail"]) && esc_attr($_REQUEST["auto_mail"]) == "false")
								{
									?>
									jQuery("#ux_div_mail_console").css("display","none");
									jQuery("#ux_div_test_mail").css("display","block");
									mail_bank_third_step_settings();
									<?php
								}
								if($email_configuration_array["hostname"] != "")
								{
									?>
									jQuery("#ux_txt_host").val("<?php echo $email_configuration_array["hostname"];?>");
									<?php
								}
								else
								{
									?>
									mail_bank_get_host_port();
									<?php
								}
								?>
							});
							if(typeof(mail_bank_move_to_second_step) != "function")
							{
								function mail_bank_move_to_second_step()
								{
									jQuery("#ux_div_first_step").addClass("first-step-helper");
									mail_bank_validate_settings();
								}
							}
							if(typeof(mail_bank_move_to_first_step) != "function")
							{
								function mail_bank_move_to_first_step()
								{
									jQuery("#ux_div_first_step").removeClass("first-step-helper");
									jQuery("#test_email").removeClass("second-step-helper");
									jQuery("#ux_div_first_step").css("display","block");
									jQuery("#test_email").css("display","none");
									jQuery("#ux_div_second_step").css("display","none");
									jQuery("#ux_div_step_progres_bar_width").css("width","33%");
									jQuery("#ux_div_frm_wizard li:eq(1)").removeClass("active");
								}
							}
							if(typeof(mail_bank_save_changes) != "function")
							{
								function mail_bank_save_changes()
								{
									overlay_loading_mail_bank(<?php echo json_encode($mb_update_email_configuration);?>);
									setTimeout(function()
									{
										remove_overlay_mail_bank();
										window.location.href = "admin.php?page=mb_email_configuration";
									}, 3000);
								}
							}
							if(typeof(mail_bank_move_to_third_step) != "function")
							{
								function mail_bank_move_to_third_step()
								{
									mail_bank_validate_settings();
									jQuery("#ux_div_first_step").removeClass("first-step-helper");
									jQuery("#test_email").addClass("second-step-helper");
								}
							}
							if(typeof(mail_bank_select_port) != "function")
							{
								function mail_bank_select_port()
								{
									var encryption = jQuery("#ux_ddl_encryption").val();
									switch(encryption)
									{
										case "none":
										case "tls":
											jQuery("#ux_txt_port").val(587);
										break;
										case "ssl":
											jQuery("#ux_txt_port").val(465);
										break;
									}
								}
							}
							var sidebar_load_interval = setInterval(load_sidebar_content_mail_bank ,1000);
							setTimeout(function()
							{
								clearInterval(sidebar_load_interval);
							}, 5000);
							load_sidebar_content_mail_bank();
							<?php
						}
					break;
					case "mb_test_email":
					?>
					jQuery("#ux_mb_li_test_email").addClass("active");
					<?php
					if(test_email_mail_bank == 1)
					{
						 ?>
							jQuery(document).ready(function()
							{
								show_pop_up_mail_bank();
							});
							<?php
						}
					break;
					case "mb_email_logs":
						?>
						jQuery("#ux_mb_li_email_logs").addClass("active");
						<?php
						if(email_logs_mail_bank == 1)
						{
							?>
							jQuery(document).ready(function()
							{
								jQuery("#ux_txt_mb_start_date").datepicker
								({
									dateFormat: 'mm/dd/yy',
									numberOfMonths: 1,
									changeMonth: true,
									changeYear: true,
									yearRange: "1970:2039",
									onSelect: function(selected)
									{
										jQuery("#ux_txt_mb_end_date").datepicker("option","minDate", selected)
									}
								});
								jQuery("#ux_txt_mb_end_date").datepicker
								({
									dateFormat: 'mm/dd/yy',
									numberOfMonths: 1,
									changeMonth: true,
									changeYear: true,
									yearRange: "1970:2039",
									onSelect: function(selected)
									{
										jQuery("#ux_txt_mb_start_date").datepicker("option","maxDate", selected)
									}
								});
								show_pop_up_mail_bank();
							});
							if(typeof(prevent_datepicker_mail_bank) != "function")
							{
								function prevent_datepicker_mail_bank(id)
								{
									jQuery("#"+id).on("keypress",function(e)
									{
										e.preventDefault();
									});
								}
							}
							var oTable = jQuery("#ux_tbl_email_logs").dataTable
							({
								"pagingType": "full_numbers",
								"language":
								{
									"emptyTable": "No data available in table",
									"info": "Showing _START_ to _END_ of _TOTAL_ entries",
									"infoEmpty": "No entries found",
									"infoFiltered": "(filtered1 from _MAX_ total entries)",
									"lengthMenu": "Show _MENU_ entries",
									"search": "Search:",
									"zeroRecords": "No matching records found"
								},
								"bSort": true,
								"pageLength": 10
							});
							var sidebar_load_interval = setInterval(load_sidebar_content_mail_bank ,1000);
							setTimeout(function()
							{
								clearInterval(sidebar_load_interval);
							}, 5000);
							jQuery("#ux_chk_all_email_logs").click(function()
							{
								jQuery("input[type=checkbox]", oTable.fnGetFilteredNodes()).attr("checked",this.checked);
							});
							if(typeof(check_email_logs) != "function")
							{
								function check_email_logs(id)
								{
									if(jQuery("input:checked", oTable.fnGetFilteredNodes()).length == jQuery("input[type=checkbox]", oTable.fnGetFilteredNodes()).length)
									{
										jQuery("#ux_chk_all_email_logs").attr("checked","checked");
									}
									else
									{
										jQuery("#ux_chk_all_email_logs").removeAttr("checked");
									}
								}
							}
							var ux_frm_email_logs = jQuery("#ux_frm_email_logs").validate
							({
								rules:
								{
									ux_txt_mb_start_date:
									{
										required: true
									},
									ux_txt_mb_end_date:
									{
										required: true
									}
								},
								errorPlacement: function(error, element)
								{
									var icon = jQuery(element).parent(".input-icon").children("i");
									icon.removeClass("fa-check").addClass("fa-warning");
									icon.attr("data-original-title", error.text()).tooltip_tip({"container": "body"});
								},
								highlight: function(element)
								{
									jQuery(element).closest(".form-group").removeClass("has-success").addClass("has-error");
								},
								success: function(label, element)
								{
									var icon = jQuery(element).parent(".input-icon").children("i");
									jQuery(element).closest(".form-group").removeClass("has-error").addClass("has-success");
									icon.removeClass("fa-warning").addClass("fa-check");
								},
								submitHandler:function(form)
								{
									premium_edition_notification_mail_bank();
								}
							});
							load_sidebar_content_mail_bank();
							<?php
						}
					break;
					case "mb_settings":
						?>
						jQuery("#ux_mb_li_settings").addClass("active");
						<?php
						if(settings_mail_bank == 1)
						{
							?>
							jQuery(document).ready(function()
							{
								jQuery("#ux_ddl_automatic_plugin_updates").val("<?php echo isset($settings_data_array["automatic_plugin_update"]) ? $settings_data_array["automatic_plugin_update"] : "enable";?>");
								jQuery("#ux_ddl_debug_mode").val("<?php echo isset($settings_data_array["debug_mode"]) ? $settings_data_array["debug_mode"] : "enable";?>");
								jQuery("#ux_ddl_remove_tables").val("<?php echo isset($settings_data_array["remove_tables_at_uninstall"]) ? $settings_data_array["remove_tables_at_uninstall"] : "enable";?>");
								show_pop_up_mail_bank();
							});
							jQuery("#ux_frm_settings").validate
							({
								submitHandler: function(form)
								{
									overlay_loading_mail_bank(<?php echo json_encode($mb_update_settings);?>);
									jQuery.post(ajaxurl,
									{
										data: base64_encode(jQuery("#ux_frm_settings").serialize()),
										action: "mail_bank_action",
										param: "mail_bank_settings_module",
										_wp_nonce: "<?php echo $mail_bank_settings; ?>"
									},
									function(data)
									{
										setTimeout(function()
										{
											remove_overlay_mail_bank();
											window.location.href="admin.php?page=mb_settings";
										}, 3000);
									});
								}
							});
							load_sidebar_content_mail_bank();
							<?php
						}
					break;
					case "mb_roles_and_capabilities":
						?>
						jQuery("#ux_mb_li_roles_and_capabilities").addClass("active");
						var sidebar_load_interval = setInterval(load_sidebar_content_mail_bank ,1000);
						setTimeout(function()
						{
							clearInterval(sidebar_load_interval);
						}, 5000);
						<?php
						if(roles_and_capabilities_mail_bank == 1)
						{
							?>
							if(typeof(full_control_function_mail_bank)!= "function")
							{
								function full_control_function_mail_bank(id,div_id)
								{
									var checkbox_id  = jQuery(id).prop("checked");
									jQuery("#"+div_id+ " input[type=checkbox]").each(function()
									{
										if(checkbox_id)
										{
											jQuery(this).attr("checked","checked");
											if(jQuery(id).attr("id") != jQuery(this).attr("id"))
											{
												jQuery(this).attr("disabled","disabled");
											}
										}
										else
										{
											if(jQuery(id).attr("id") != jQuery(this).attr("id"))
											{
												jQuery(this).removeAttr("disabled");
											}
										}
									});
								}
							}
							if(typeof(show_roles_capabilities_mail_bank)!= "function")
							{
								function show_roles_capabilities_mail_bank(id,div_id)
								{
									if(jQuery(id).prop("checked"))
									{
										jQuery("#"+div_id).css("display","block");
									}
									else
									{
										jQuery("#"+div_id).css("display","none");
									}
								}
							}
							jQuery(document).ready(function()
							{
								jQuery("#ux_ddl_mail_bank_menu").val("<?php echo isset($details_roles_capabilities["show_mail_bank_top_bar_menu"]) ? $details_roles_capabilities["show_mail_bank_top_bar_menu"] : "enable";?>");
								show_roles_capabilities_mail_bank("#ux_chk_author","ux_div_author_roles");
								full_control_function_mail_bank("#ux_chk_full_control_author","ux_div_author_roles");
								show_roles_capabilities_mail_bank("#ux_chk_editor","ux_div_editor_roles");
								full_control_function_mail_bank("#ux_chk_full_control_editor","ux_div_editor_roles");
								show_roles_capabilities_mail_bank("#ux_chk_contributor","ux_div_contributor_roles");
								full_control_function_mail_bank("#ux_chk_full_control_contributor","ux_div_contributor_roles");
								show_roles_capabilities_mail_bank("#ux_chk_subscriber","ux_div_subscriber_roles");
								full_control_function_mail_bank("#ux_chk_full_control_subscriber","ux_div_subscriber_roles");
								show_pop_up_mail_bank();
							});
							jQuery("#ux_frm_roles_and_capabilities").validate
							({
								submitHandler:function(form)
								{
									premium_edition_notification_mail_bank();
								}
							});
							load_sidebar_content_mail_bank();
						<?php
						}
					break;
					case "mb_feedbacks":
						?>
						jQuery("#ux_mb_li_feedbacks").addClass("active");
						jQuery(document).ready(function()
						{
							show_pop_up_mail_bank();
						});
						load_sidebar_content_mail_bank();
						var feedback_array = [];
						var url = "<?php echo tech_banker_url."/feedbacks.php";?>";
						var domain_url = "<?php echo site_url(); ?>";
						jQuery("#ux_frm_feedbacks").validate
						({
							rules:
							{
								ux_txt_your_name:
								{
									required:true
								},
								ux_txt_email_address:
								{
									required:true,
									email:true
								},
								ux_txtarea_feedbacks:
								{
									required:true
								}
							},
							errorPlacement: function(error, element)
							{
								var icon = jQuery(element).parent(".input-icon").children("i");
								icon.removeClass("fa-check").addClass("fa-warning");
								icon.attr("data-original-title", error.text()).tooltip_tip({"container": "body"});
							},
							highlight: function(element)
							{
								jQuery(element).closest(".form-group").removeClass("has-success").addClass("has-error");
							},
							success: function(label, element)
							{
								var icon = jQuery(element).parent(".input-icon").children("i");
								jQuery(element).closest(".form-group").removeClass("has-error").addClass("has-success");
								icon.removeClass("fa-warning").addClass("fa-check");
							},
							submitHandler:function(form)
							{
								feedback_array.push(jQuery("#ux_txt_your_name").val(),jQuery("#ux_txt_email_address").val(),domain_url,jQuery("#ux_txtarea_feedbacks").val());
								overlay_loading_mail_bank(<?php echo json_encode($mb_update_feedbacks);?>);
								jQuery.post(url,
								{
									data :JSON.stringify(feedback_array),
									param: "mail_bank_send_feedback"
								},
								function()
								{
									setTimeout(function()
									{
										remove_overlay_mail_bank();
										window.location.href = "admin.php?page=mb_feedbacks";
									}, 3000);
								});
							}
						});
						load_sidebar_content_mail_bank();
						<?php
					break;
					case "mb_system_information":
						?>
						jQuery("#ux_mb_li_system_information").addClass("active");
						var sidebar_load_interval = setInterval(load_sidebar_content_mail_bank ,1000);
						setTimeout(function()
						{
							clearInterval(sidebar_load_interval);
						}, 5000);
						<?php
						if(system_information_mail_bank == 1)
						{
							?>
							jQuery(document).ready(function()
							{
								show_pop_up_mail_bank();
							});
							jQuery.getSystemReport = function(strDefault, stringCount, string, location)
							{
								var o = strDefault.toString();
								if(!string)
								{
									string = "0";
								}
								while (o.length < stringCount)
								{
									if(location == "undefined")
									{
										o = string + o;
									}
									else
									{
										o = o + string;
									}
								}
								return o;
							};
							jQuery(".system-report").click(function()
							{
								var report = "";
								jQuery(".custom-form-body").each(function()
								{
									jQuery("h3.form-section", jQuery(this)).each(function()
									{
										report = report + "\n### " + jQuery.trim(jQuery(this).text()) + " ###\n\n";
									});
									jQuery("tbody > tr", jQuery(this)).each(function()
									{
										var the_name = jQuery.getSystemReport(jQuery.trim(jQuery(this).find("strong").text()), 25, " ");
										var the_value = jQuery.trim(jQuery(this).find("span").text());
										var value_array = the_value.split(", ");
										if(value_array.length > 1)
										{
											var temp_line = "";
											jQuery.each(value_array, function(key, line)
											{
												var tab = ( key == 0 ) ? 0 : 25;
												temp_line = temp_line + jQuery.getSystemReport("", tab, " ", "f") + line + "\n";
											});
											the_value = temp_line;
										}
										report = report + "" + the_name + the_value + "\n";
									});
								});
								try
								{
									jQuery("#ux_system_information").slideDown();
									jQuery("#ux_system_information textarea").val(report).focus().select();
									return false;
								}
								catch (e)
								{
								}
								return false;
							});
							jQuery("#ux_btn_system_information").click(function()
							{
								if(jQuery("#ux_btn_system_information").text() == "Close System Information!")
								{
									jQuery("#ux_system_information").slideUp();
									jQuery("#ux_btn_system_information").html("Get System Information!");
								}
								else
								{
									jQuery("#ux_btn_system_information").html("Close System Information!");
									jQuery("#ux_btn_system_information").removeClass("system-information");
									jQuery("#ux_btn_system_information").addClass("close-information");
								}
							});
							load_sidebar_content_mail_bank();
							<?php
						}
					break;
					case "mb_premium_editions":
						?>
						jQuery("#ux_li_premium_editions").addClass("active");
						load_sidebar_content_mail_bank();
						<?php
					break;
				}
			}
			?>
	</script>
	<?php
		}
	}
	?>
