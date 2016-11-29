<?php
/**
* This Template is used for managing settings.
*
* @author  Tech Banker
* @package wp-mail-bank/views/settings
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
	else if(settings_mail_bank == "1")
	{
		$mail_bank_settings = wp_create_nonce("mail_bank_settings");
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
								<?php echo $mb_settings; ?>
							</span>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box vivid-green">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-custom-paper-clip"></i>
									<?php echo $mb_settings; ?>
								</div>
							</div>
							<div class="portlet-body form">
								<form id="ux_frm_settings">
									<div class="form-body">
										<div class="note note-danger">
											<h4 class="block">
												<?php echo $mb_important_disclaimer; ?>
											</h4>
											<ul>
												<li><?php echo $mb_demos_disclaimer ?><a href="http://beta.tech-banker.com/products/mail-bank/demos/" target="_blank" class="custom_links"><?php echo $mb_here_disclaimer ?></a>.</li>
												<li><?php echo $mb_manual_disclaimer ?><a href="http://beta.tech-banker.com/products/mail-bank/user-guide/plugin-settings/" target="_blank" class="custom_links"><?php echo $mb_here_disclaimer ?></a>.</li>
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
														<?php echo $mb_settings_automatic_plugin_update;?> :
														<i class="icon-custom-question tooltips" data-original-title="<?php echo $mb_settings_automatic_plugin_update_tooltip;?>" data-placement="right"></i>
														<span class="required" aria-required="true">*</span>
													</label>
													<select name="ux_ddl_automatic_plugin_updates" id="ux_ddl_automatic_plugin_updates" class="form-control" >
														<option value="enable"><?php echo $mb_enable; ?></option>
														<option value="disable"><?php echo $mb_disable; ?></option>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">
														<?php echo $mb_settings_debug_mode;?> :
														<i class="icon-custom-question tooltips" data-original-title="<?php echo $mb_settings_debug_mode_tooltip;?>" data-placement="right"></i>
														<span class="required" aria-required="true">*</span>
													</label>
													<select name="ux_ddl_debug_mode" id="ux_ddl_debug_mode" class="form-control" >
														<option value="enable"><?php echo $mb_enable; ?></option>
														<option value="disable"><?php echo $mb_disable; ?></option>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label">
												<?php echo $mb_remove_tables_title;?> :
												<i class="icon-custom-question tooltips" data-original-title="<?php echo $mb_remove_tables_tooltip;?>" data-placement="right"></i>
												<span class="required" aria-required="true">*</span>
											</label>
											<select name="ux_ddl_remove_tables" id="ux_ddl_remove_tables" class="form-control" >
												<option value="enable"><?php echo $mb_enable; ?></option>
												<option value="disable"><?php echo $mb_disable; ?></option>
											</select>
										</div>
										<div class="line-separator"></div>
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
									<?php echo $mb_settings; ?>
								</span>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="portlet box vivid-green">
								<div class="portlet-title">
									<div class="caption">
										<i class="icon-custom-paper-clip"></i>
										<?php echo $mb_settings; ?>
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
