<?php
/**
* This Template is used for managing roles and capabilities.
*
* @author  Tech Banker
* @package wp-mail-bank/views/roles-and-capabilities
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
	else if(roles_and_capabilities_mail_bank == "1")
	{
		$roles_and_capabilities = explode(",",isset($details_roles_capabilities["roles_and_capabilities"]) ? $details_roles_capabilities["roles_and_capabilities"] : "");
		$author = explode(",",isset($details_roles_capabilities["author_privileges"]) ? $details_roles_capabilities["author_privileges"] : "");
		$editor = explode(",",isset($details_roles_capabilities["editor_privileges"]) ? $details_roles_capabilities["editor_privileges"] : "");
		$contributor = explode(",",isset($details_roles_capabilities["contributor_privileges"]) ? $details_roles_capabilities["contributor_privileges"] : "");
		$subscriber = explode(",",isset($details_roles_capabilities["subscriber_privileges"]) ? $details_roles_capabilities["subscriber_privileges"] : "");
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
								<?php echo $mb_roles_and_capabilities; ?>
							</span>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box vivid-green">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-custom-user"></i>
									<?php echo $mb_roles_and_capabilities; ?>
								</div>
							</div>
							<div class="portlet-body form">
								<form id="ux_frm_roles_and_capabilities">
									<div class="form-body">
										<div class="note note-danger">
											<h4 class="block">
												<?php echo $mb_premium_edition_features_disclaimer; ?>
											</h4>
											<ul>
												<li><?php echo $mb_save_roles_and_capabilities_disclaimer;?></li>
											</ul>
											<h4 class="block">
												<?php echo $mb_important_disclaimer; ?>
											</h4>
											<ul>
												<li><?php echo $mb_demos_disclaimer ?><a href="http://beta.tech-banker.com/products/mail-bank/demos/" target="_blank" class="custom_links"><?php echo $mb_here_disclaimer ?></a>.</li>
												<li><?php echo $mb_manual_disclaimer ?><a href="http://beta.tech-banker.com/products/mail-bank/user-guide/roles-capabilities/" target="_blank" class="custom_links"><?php echo $mb_here_disclaimer ?></a>.</li>
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
										<div class="form-group">
											<label class="control-label">
												<?php echo $mb_roles_capabilities_show_menu;?> :
												<i class="icon-custom-question tooltips" data-original-title="<?php echo $mb_roles_capabilities_show_menu_tooltip;?>" data-placement="right"></i>
												<span class="required" aria-required="true">*</span>
											</label>
											<table class="table table-striped table-bordered table-margin-top" id="ux_tbl_mail_bank_roles">
												<thead>
													<tr>
														<th>
															<input type="checkbox"  name="ux_chk_administrator" id="ux_chk_administrator" value="1" checked="checked" disabled="disabled" <?php echo $roles_and_capabilities[0] == "1" ? "checked = checked" : ""?>>
															<?php echo $mb_roles_capabilities_administrator;?>
														</th>
														<th>
															<input type="checkbox"  name="ux_chk_author" id="ux_chk_author"  value="1" onclick="show_roles_capabilities_mail_bank(this,'ux_div_author_roles');" <?php echo $roles_and_capabilities[1] == "1" ? "checked = checked" : ""?>>
															<?php echo $mb_roles_capabilities_author;?>
														</th>
														<th>
															<input type="checkbox"  name="ux_chk_editor" id="ux_chk_editor" value="1" onclick="show_roles_capabilities_mail_bank(this,'ux_div_editor_roles');" <?php echo $roles_and_capabilities[2] == "1" ? "checked = checked" : ""?>>
															<?php echo $mb_roles_capabilities_editor;?>
														</th>
														<th>
															<input type="checkbox"  name="ux_chk_contributor" id="ux_chk_contributor"  value="1" onclick="show_roles_capabilities_mail_bank(this,'ux_div_contributor_roles');" <?php echo $roles_and_capabilities[3] == "1" ? "checked = checked" : ""?>>
															<?php echo $mb_roles_capabilities_contributor;?>
														</th>
														<th>
															<input type="checkbox"  name="ux_chk_subscriber" id="ux_chk_subscriber" value="1" onclick="show_roles_capabilities_mail_bank(this,'ux_div_subscriber_roles');" <?php echo $roles_and_capabilities[4] == "1" ? "checked = checked" : ""?>>
															<?php echo $mb_roles_capabilities_subscriber;?>
														</th>
													</tr>
												</thead>
											</table>
										</div>
										<div class="form-group">
											<label class="control-label">
												<?php echo $mb_roles_capabilities_topbar_menu;?> :
												<i class="icon-custom-question tooltips" data-original-title="<?php echo $mb_roles_capabilities_topbar_menu_tooltip;?>" data-placement="right"></i>
												<span class="required" aria-required="true">*</span>
											</label>
											<select name="ux_ddl_mail_bank_menu" id="ux_ddl_mail_bank_menu" class="form-control">
												<option value="enable"><?php echo $mb_enable;?></option>
												<option value="disable"><?php echo $mb_disable;?></option>
											</select>
										</div>
										<div class="line-separator"></div>
										<div class="form-group">
											<div id="ux_div_administrator_roles">
												<label class="control-label">
													<?php echo $mb_roles_capabilities_administrator_role;?> :
													<i class="icon-custom-question tooltips" data-original-title="<?php echo $mb_roles_capabilities_administrator_role_tooltip;?>" data-placement="right"></i>
													<span class="required" aria-required="true">*</span>
												</label>
												<div class="table-margin-top">
													<table class="table table-striped table-bordered table-hover" id="ux_tbl_administrator">
														<thead>
															<tr>
																<th style="width: 40% !important;">
																	<input type="checkbox" name="ux_chk_full_control_administrator" id="ux_chk_full_control_administrator" checked="checked" disabled="disabled" value="1">
																	<?php echo $mb_roles_capabilities_full_control;?>
																</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>
																	<input type="checkbox" name="ux_chk_email_configuration_admin" disabled="disabled" checked="checked" id="ux_chk_email_configuration_admin" value="1">
																	<?php echo $mb_email_configuration;?>
																</td>
																<td>
																	<input type="checkbox" name="ux_chk_test_email_admin" disabled="disabled" checked="checked" id="ux_chk_test_email_admin" value="1">
																	<?php echo $mb_test_email ;?>
																</td>
																<td>
																	<input type="checkbox" name="ux_chk_email_logs_admin" disabled="disabled" checked="checked" id="ux_chk_email_logs_admin" value="1">
																	<?php echo $mb_email_logs ;?>
																</td>
															</tr>
															<tr>
																<td>
																	<input type="checkbox" name="ux_chk_settings_admin" disabled="disabled" checked="checked" id="ux_chk_settings_admin" value="1">
																	<?php echo $mb_settings ;?>
																</td>
																<td>
																	<input type="checkbox" name="ux_chk_roles_and_capabilities_admin" disabled="disabled" checked="checked" id="ux_chk_roles_and_capabilities_admin" value="1">
																	<?php echo $mb_roles_and_capabilities;?>
																</td>
																<td>
																	<input type="checkbox" name="ux_chk_system_information_admin" disabled="disabled" checked="checked" id="ux_chk_system_information_admin" value="1">
																	<?php echo $mb_system_information;?>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
												<div class="line-separator"></div>
											</div>
										</div>
										<div class="form-group">
											<div id="ux_div_author_roles">
												<label class="control-label">
													<?php echo $mb_roles_capabilities_author_role;?> :
													<i class="icon-custom-question tooltips" data-original-title="<?php echo $mb_roles_capabilities_author_role_tooltip;?>" data-placement="right"></i>
													<span class="required" aria-required="true">*</span>
												</label>
												<div class="table-margin-top">
													<table class="table table-striped table-bordered table-hover" id="ux_tbl_author">
														<thead>
															<tr>
																<th style="width: 40% !important;">
																	<input type="checkbox" name="ux_chk_full_control_author" id="ux_chk_full_control_author" value="1" onclick="full_control_function_mail_bank(this,'ux_div_author_roles');" <?php echo isset($author) && $author[0] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_roles_capabilities_full_control;?>
																</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>
																	<input type="checkbox" name="ux_chk_email_configuration_author" id="ux_chk_email_configuration_author" value="1" <?php echo isset($author) && $author[1] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_email_configuration;?>
																</td>
																<td>
																	<input type="checkbox" name="ux_chk_test_email_author" id="ux_chk_test_email_author" value="1" <?php echo isset($author) && $author[2] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_test_email ;?>
																</td>
																<td>
																	<input type="checkbox" name="ux_chk_email_logs_author" id="ux_chk_email_logs_author" value="1" <?php echo isset($author) && $author[3] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_email_logs ;?>
																</td>
															</tr>
															<tr>
																<td>
																	<input type="checkbox" name="ux_chk_settings_author" id="ux_chk_settings_author" value="1" <?php echo isset($author) && $author[4] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_settings ;?>
																</td>
																<td>
																	<input type="checkbox" name="ux_chk_roles_and_capabilities_author" id="ux_chk_roles_and_capabilities_author" value="1" <?php echo isset($author) && $author[5] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_roles_and_capabilities;?>
																</td>
																<td>
																	<input type="checkbox" name="ux_chk_system_information_author" id="ux_chk_system_information_author" value="1" <?php echo isset($author) && $author[6] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_system_information;?>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
												<div class="line-separator"></div>
											</div>
										</div>
										<div class="form-group">
											<div id="ux_div_editor_roles">
												<label class="control-label">
													<?php echo $mb_roles_capabilities_editor_role;?> :
													<i class="icon-custom-question tooltips" data-original-title="<?php echo $mb_roles_capabilities_editor_role_tooltip;?>" data-placement="right"></i>
													<span class="required" aria-required="true">*</span>
												</label>
												<div class="table-margin-top">
													<table class="table table-striped table-bordered table-hover" id="ux_tbl_editor">
														<thead>
															<tr>
																<th style="width: 40% !important;">
																	<input type="checkbox" name="ux_chk_full_control_editor" id="ux_chk_full_control_editor" value="1" onclick="full_control_function_mail_bank(this,'ux_div_editor_roles');" <?php echo isset($editor) && $editor[0] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_roles_capabilities_full_control;?>
																</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>
																	<input type="checkbox" name="ux_chk_email_configuration_editor" id="ux_chk_email_configuration_editor" value="1" <?php echo isset($editor) && $editor[1] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_email_configuration;?>
																</td>
																<td>
																	<input type="checkbox" name="ux_chk_test_email_editor" id="ux_chk_test_email_editor" value="1" <?php echo isset($editor) && $editor[2] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_test_email ;?>
																</td>
																<td>
																	<input type="checkbox" name="ux_chk_email_logs_editor" id="ux_chk_email_logs_editor" value="1" <?php echo isset($editor) && $editor[3] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_email_logs ;?>
																</td>
															</tr>
															<tr>
																<td>
																	<input type="checkbox" name="ux_chk_settings_editor" id="ux_chk_settings_editor" value="1" <?php echo isset($editor) && $editor[4] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_settings ;?>
																</td>
																<td>
																	<input type="checkbox" name="ux_chk_roles_and_capabilities_editor" id="ux_chk_roles_and_capabilities_editor" value="1" <?php echo isset($editor) && $editor[5] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_roles_and_capabilities;?>
																</td>
																<td>
																	<input type="checkbox" name="ux_chk_system_information_editor" id="ux_chk_system_information_editor" value="1" <?php echo isset($editor) && $editor[6] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_system_information;?>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
												<div class="line-separator"></div>
											</div>
										</div>
										<div class="form-group">
											<div id="ux_div_contributor_roles">
												<label class="control-label">
													<?php echo $mb_roles_capabilities_contributor_role;?> :
													<i class="icon-custom-question tooltips" data-original-title="<?php echo $mb_roles_capabilities_contributor_role_tooltip;?>" data-placement="right"></i>
													<span class="required" aria-required="true">*</span>
												</label>
												<div class="table-margin-top">
													<table class="table table-striped table-bordered table-hover" id="ux_tbl_contributor">
														<thead>
															<tr>
																<th style="width: 40% !important;">
																	<input type="checkbox" name="ux_chk_full_control_contributor" id="ux_chk_full_control_contributor" value="1" onclick="full_control_function_mail_bank(this,'ux_div_contributor_roles');" <?php echo isset($contributor) && $contributor[0] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_roles_capabilities_full_control;?>
																</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>
																	<input type="checkbox" name="ux_chk_email_configuration_contributor" id="ux_chk_email_configuration_contributor" value="1" <?php echo isset($contributor) && $contributor[1] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_email_configuration;?>
																</td>
																<td>
																	<input type="checkbox" name="ux_chk_test_email_contributor" id="ux_chk_test_email_contributor" value="1" <?php echo isset($contributor) && $contributor[2] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_test_email ;?>
																</td>
																<td>
																	<input type="checkbox" name="ux_chk_email_logs_contributor" id="ux_chk_email_logs_contributor" value="1" <?php echo isset($contributor) && $contributor[3] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_email_logs ;?>
																</td>
															</tr>
															<tr>
																<td>
																	<input type="checkbox" name="ux_chk_settings_contributor" id="ux_chk_settings_contributor" value="1" <?php echo isset($contributor) && $contributor[4] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_settings ;?>
																</td>
																<td>
																	<input type="checkbox" name="ux_chk_roles_and_capabilities_contributor" id="ux_chk_roles_and_capabilities_contributor" value="1" <?php echo isset($contributor) && $contributor[5] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_roles_and_capabilities;?>
																</td>
																<td>
																	<input type="checkbox" name="ux_chk_system_information_contributor" id="ux_chk_system_information_contributor" value="1" <?php echo isset($contributor) && $contributor[6] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_system_information;?>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
												<div class="line-separator"></div>
											</div>
										</div>
										<div class="form-group">
											<div id="ux_div_subscriber_roles">
												<label class="control-label">
													<?php echo $mb_roles_capabilities_subscriber_role;?> :
													<i class="icon-custom-question tooltips" data-original-title="<?php echo $mb_roles_capabilities_subscriber_role_tooltip;?>" data-placement="right"></i>
													<span class="required" aria-required="true">*</span>
												</label>
												<div class="table-margin-top">
													<table class="table table-striped table-bordered table-hover" id="ux_tbl_subscriber">
														<thead>
															<tr>
																<th style="width: 40% !important;">
																	<input type="checkbox" name="ux_chk_full_control_subscriber" id="ux_chk_full_control_subscriber" value="1" onclick="full_control_function_mail_bank(this,'ux_div_subscriber_roles');" <?php echo isset($subscriber) && $subscriber[0] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_roles_capabilities_full_control;?>
																</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>
																	<input type="checkbox" name="ux_chk_email_configuration_subscriber" id="ux_chk_email_configuration_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[1] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_email_configuration;?>
																</td>
																<td>
																	<input type="checkbox" name="ux_chk_test_email_subscriber" id="ux_chk_test_email_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[2] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_test_email ;?>
																</td>
																<td>
																	<input type="checkbox" name="ux_chk_email_logs_subscriber" id="ux_chk_email_logs_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[3] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_email_logs ;?>
																</td>
															</tr>
															<tr>
																<td>
																	<input type="checkbox" name="ux_chk_settings_subscriber" id="ux_chk_settings_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[4] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_settings ;?>
																</td>
																<td>
																	<input type="checkbox" name="ux_chk_roles_and_capabilities_subscriber" id="ux_chk_roles_and_capabilities_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[5] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_roles_and_capabilities;?>
																</td>
																<td>
																	<input type="checkbox" name="ux_chk_system_information_subscriber" id="ux_chk_system_information_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[6] =="1" ? "checked = checked" : ""?>>
																	<?php echo $mb_system_information;?>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
												<div class="line-separator"></div>
											</div>
										</div>
										<div class="form-actions">
											<div class="pull-right">
												<input type="submit" class="btn vivid-green" name="ux_btn_save_changes" id="ux_btn_save_changes" value="<?php echo $mb_save_changes;?>">
											</div>
										</div>
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
								<?php echo $mb_roles_and_capabilities; ?>
							</span>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box vivid-green">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-custom-user"></i>
									<?php echo $mb_roles_and_capabilities; ?>
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
