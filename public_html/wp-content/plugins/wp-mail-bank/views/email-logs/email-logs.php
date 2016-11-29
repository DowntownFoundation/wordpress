<?php
/**
* This Template is used for displaying email logs.
*
* @author  Tech Banker
* @package wp-mail-bank/views/email-logs
* @version 2.0.0
*/
if(!defined("ABSPATH")) exit; // Exit if accessed directly
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
	else if(email_logs_mail_bank == "1")
	{
		$end_date = time();
		$start_date = $end_date - 864000;
		?>
		<div class="page-content-wrapper">
			<div class="page-content">
				<div class="page-bar">
					<ul class="page-breadcrumb">
						<li>
							<i class="icon-custom-home"></i>
							<a href="admin.php?page=mb_email_configuration">
								<?php echo $wp_mail_bank; ?>
							</a>
							<span>></span>
						</li>
						<li>
							<span>
								<?php echo $mb_email_logs; ?>
							</span>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box vivid-green">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-custom-note"></i>
									<?php echo $mb_email_logs; ?>
								</div>
							</div>
							<div class="portlet-body form">
								<form id="ux_frm_email_logs">
									<div class="form-body">
										<div class="form-body">
											<div class="note note-danger">
												<h4 class="block">
													<?php echo $mb_premium_edition_features_disclaimer; ?>
												</h4>
												<ul>
													<li><?php echo $mb_filters_disclaimer;?></li>
													<li><?php echo $mb_delete_logs_disclaimer;?></li>
													<li><?php echo $mb_debugging_output_disclaimer;?></li>
													<li><?php echo $mb_show_details_disclaimer;?></li>
												</ul>
												<h4 class="block">
													<?php echo $mb_important_disclaimer; ?>
												</h4>
												<ul>
													<li><?php echo $mb_demos_disclaimer ?><a href="http://beta.tech-banker.com/products/mail-bank/demos/" target="_blank" class="custom_links"><?php echo $mb_here_disclaimer ?></a>.</li>
													<li><?php echo $mb_manual_disclaimer ?><a href="http://beta.tech-banker.com/products/mail-bank/user-guide/email-logs/" target="_blank" class="custom_links"><?php echo $mb_here_disclaimer ?></a>.</li>
													<li><?php echo $mb_click_disclaimer ?><a href="http://beta.tech-banker.com/products/mail-bank/" target="_blank" class="custom_links"><?php echo $mb_here_disclaimer ?></a><?php echo $mb_unblock_premium_disclaimer ?></li>
												</ul>
												<?php
													if($mb_message_translate_help != "")
													{
														?>
														<strong><?php echo $mb_message_translate_help;?><a href="javascript:void(0);" data-popup-open="ux_open_popup" class="custom_links" onclick="show_pop_up_mail_bank();"><?php echo $mb_message_translate_here; ?></a></strong>
														<?php
													}
												?>
											</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">
														<?php echo $mb_start_date_title;?> :
														<i class="icon-custom-question tooltips" data-original-title="<?php echo $mb_start_date_tooltip;?>" data-placement="right"></i>
														<span class="required" aria-required="true">*</span>
													</label>
													<input type="text" class="form-control" name="ux_txt_mb_start_date" id="ux_txt_mb_start_date" value="<?php echo date("m/d/Y",$start_date); ?>" placeholder="<?php echo $mb_start_date_placeholder; ?>" onfocus="prevent_datepicker_mail_bank(this.id);">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">
														<?php echo $mb_end_date_title;?> :
														<i class="icon-custom-question tooltips" data-original-title="<?php echo $mb_end_date_tooltip;?>" data-placement="right"></i>
														<span class="required" aria-required="true">*</span>
													</label>
													<input type="text" class="form-control" name="ux_txt_mb_end_date" id="ux_txt_mb_end_date" value="<?php echo date("m/d/Y",$end_date); ?>" placeholder="<?php echo $mb_end_date_placeholder;?>" onfocus="prevent_datepicker_mail_bank(this.id);">
												</div>
											</div>
										</div>
										<div class="form-actions">
											<div class="pull-right">
												<input type="submit" class="btn vivid-green" name="ux_btn_email_logs" id="ux_btn_email_logs" value="<?php echo $mb_submit;?>">
											</div>
										</div>
										<div class="line-separator"></div>
										<div class="table-top-margin">
											<select name="ux_ddl_email_logs" id="ux_ddl_email_logs" class="custom-bulk-width">
												<option value=""><?php echo $mb_email_logs_bulk_action; ?></option>
												<option value="delete"><?php echo $mb_email_logs_delete; ?></option>
											</select>
											<input type="button" class="btn vivid-green" name="ux_btn_apply" id="ux_btn_apply" value="<?php echo $mb_email_logs_apply;?>" onclick="premium_edition_notification_mail_bank()">
										</div>
										<table class="table table-striped table-bordered table-hover table-margin-top" id="ux_tbl_email_logs">
											<thead>
												<tr>
													<th style="text-align: center;" class="chk-action">
														<input type="checkbox" name="ux_chk_all_email_logs" id="ux_chk_all_email_logs">
													</th>
													<th style="width:32%">
														<label>
															<?php echo $mb_email_logs_email_to;?>
														</label>
													</th>
													<th style="width:25%">
														<label>
															<?php echo $mb_subject;?>
														</label>
													</th>
													<th style="width:19%">
														<label>
															<?php echo $mb_date_time;?>
														</label>
													</th>
													<th style="width:10%">
														<label>
															<?php echo $mb_email_logs_status;?>
														</label>
													</th>
													<th style="width:14%" class="chk-action">
														<label>
															<?php echo $mb_email_logs_actions;?>
														</label>
													</th>
												</tr>
											</thead>
											<tbody id="ux_dynamic_email_logs_table_filter">
												<?php
												foreach($unserialized_email_logs_data as $value)
												{
													?>
													<tr>
														<td style="text-align: center;">
															<input type="checkbox" name="ux_chk_email_logs_<?php echo $value["id"]; ?>" id="ux_chk_email_logs_<?php echo $value["id"]; ?>" onclick="check_email_logs(<?php echo $value["id"]; ?>)" value="<?php echo $value["id"]; ?>">
														</td>
														<td id="ux_email_sent_to_<?php echo $value["id"] ?>">
															<?php echo $value["email_to"]; ?>
														</td>
														<td id="ux_email_subject_<?php echo $value["id"] ?>">
															<?php echo isset($value["subject"]) != "" ? $value["subject"] : "N/A"; ?>
														</td>
														<td id="ux_email_date_time_<?php echo $value["id"] ?>">
															<?php echo date("d M Y H:i A",$value["timestamp"]); ?>
														</td>
														<td id="ux_email_status_<?php echo $value["id"] ?>">
															<?php echo $value["status"]== "Sent" ? $mb_status_sent : $mb_status_not_sent; ?>
														</td>
														<td class="custom-alternative">
															<?php
															if(isset($value["debug_mode"]))
															{
																?>
																<a href="javascript:void(0);" onclick="premium_edition_notification_mail_bank();">
																	<i class="icon-custom-doc tooltips" data-original-title="<?php echo $mb_email_logs_show_outputs ;?>" data-placement="top"></i>
																</a> |
																<?php
															}
															?>
															<a href="javascript:void(0);" onclick="premium_edition_notification_mail_bank();">
																<i class="icon-custom-share-alt tooltips" data-original-title="<?php echo $mb_email_logs_show_details ;?>" data-placement="top"></i>
															</a> |
															<a href="javascript:void(0);">
																<i class="icon-custom-trash tooltips" data-original-title="<?php echo $mb_email_logs_delete ;?>" onclick="premium_edition_notification_mail_bank()" data-placement="top"></i>
															</a>
															<div id="ux_div_content_<?php echo $value["id"]; ?>" style="display:none;">
																<?php
																echo trim($value["content"]);
																?>
															</div>
															<div id="ux_div_debugging_output_<?php echo $value["id"]; ?>" style="display:none">
																<pre><strong><?php echo isset($value["debugging_output"]) ? $value["debugging_output"] : "";?></strong></pre>
															</div>
														</td>
														<?php echo $sender_email = $value["sender_email"] == "" ? "" : "   <".$value["sender_email"].">";?>
														<span style="display:none" id="ux_from_name_<?php echo $value["id"] ?>" id="ux_from_email_<?php echo $value["id"] ?>"><?php echo $value["sender_name"] == "" && $value["sender_email"] == "" ? $mb_not_available : esc_attr($value["sender_name"].$sender_email); ?></span>
														<span style="display:none" id="ux_email_cc<?php echo $value["id"] ?>"><?php echo isset($value["cc"]) ? ($value["cc"] != "" ? $value["cc"] : $mb_not_available) : $mb_not_available; ?></span>
														<span style="display:none" id="ux_email_bcc<?php echo $value["id"] ?>"><?php echo isset($value["bcc"]) ? ($value["bcc"] != "" ? $value["bcc"] : $mb_not_available) : $mb_not_available; ; ?></span>
													</tr>
													<?php
												}
												?>
											</tbody>
										</table>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	else
	{
		?>
		<div class="page-content-wrapper">
			<div class="page-content">
				<div class="page-bar">
					<ul class="page-breadcrumb">
						<li>
							<i class="icon-custom-home"></i>
								<a href="admin.php?page=mb_email_configuration">
									<?php echo $wp_mail_bank; ?>
								</a>
								<span>></span>
						</li>
						<li>
							<span>
									<?php echo $mb_email_logs; ?>
								</span>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box vivid-green">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-custom-note"></i>
									<?php echo $mb_email_logs; ?>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<strong><?php echo $mb_user_access_message;?></strong>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
?>
