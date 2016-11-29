<?php
/**
* This file is used for managing data in database.
*
* @author  Tech Banker
* @package wp-mail-bank/lib
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
	else
	{
		if(!function_exists("get_mail_bank_details_unserialize"))
		{
			function get_mail_bank_details_unserialize($email_data_manage,$mb_date1,$mb_date2)
			{
				$email_details = array();
				foreach($email_data_manage as $raw_row)
				{
					$unserialize_data = unserialize($raw_row->meta_value);
					$unserialize_data["id"] = $raw_row->id;
					$unserialize_data["meta_id"] = $raw_row->meta_id;
					if($unserialize_data["timestamp"] >= $mb_date1 &&  $unserialize_data["timestamp"] <= $mb_date2)
					array_push($email_details,$unserialize_data);
				}
				return $email_details;
			}
		}

		if(isset($_REQUEST["param"]))
		{
			$obj_dbHelper_mail_bank = new dbHelper_mail_bank();
			switch(esc_attr($_REQUEST["param"]))
			{
				case "mail_bank_set_hostname_port_module":
					if(wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "mail_bank_set_hostname_port" ))
					{
						$smtp_user = isset($_REQUEST["smtp_user"]) ? esc_attr($_REQUEST["smtp_user"]) : "";
						$hostname = substr(strrchr($smtp_user,"@"),1);
						$obj_mail_bank_discover_host = new mail_bank_discover_host();
						$hostname_to_set = $obj_mail_bank_discover_host->get_smtp_from_email($hostname);
						echo $hostname_to_set;
					}
				break;

				case "mail_bank_test_email_configuration_module":
					if(wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "mail_bank_test_email_configuration"))
					{

						parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "",$form_data);
						global $phpmailer;
						$logs = array();
						if(!is_object($phpmailer) || !is_a($phpmailer,"PHPMailer"))
						{
							if(file_exists(ABSPATH . WPINC . "/class-phpmailer.php"))
							require_once ABSPATH . WPINC . "/class-phpmailer.php";

							if(file_exists(ABSPATH . WPINC . "/class-smtp.php"))
							require_once ABSPATH . WPINC . "/class-smtp.php";

							$phpmailer = new PHPMailer(true) ;
						}
						$phpmailer->SMTPDebug = true;

						$to = esc_attr($form_data["ux_txt_email"]);
						$subject = stripcslashes(htmlspecialchars_decode($form_data["ux_txt_subject"], ENT_QUOTES));
						$message = "<div style=\"font-family: Calibri;\">";
						$message .= htmlspecialchars_decode(!empty($form_data["ux_email_configuration_text_area"]) ? esc_attr($form_data["ux_email_configuration_text_area"]) : "This is a demo Test Email for Email Configuration - Mail Bank");
						$message .= "</div>";
						$headers = "Content-Type: text/html; charset= utf-8". "\r\n";
						$result = wp_mail($to,$subject,$message,$headers);
						$mb_email_configuration_data = $wpdb->get_row
						(
							$wpdb->prepare
							(
								"SELECT meta_value FROM ".mail_bank_meta().
								" WHERE meta_key = %s",
								"email_configuration"
							)
						);
						$unserialized_email_configuration_data = unserialize($mb_email_configuration_data->meta_value);

						$settings_data = $wpdb->get_var
						(
							$wpdb->prepare
							(
								"SELECT meta_value FROM ".mail_bank_meta().
								" WHERE meta_key=%s",
								"settings"
							)
						);
						$settings_data_array = unserialize($settings_data);
						$debugging_output = "";

						if($unserialized_email_configuration_data["mailer_type"] == "smtp")
						{
							$mail_bank_mail_status = get_option("mail_bank_mail_status");
							if($settings_data_array["debug_mode"] == "enable")
							{
								$debugging_output .= $mb_email_configuration_send_test_email_textarea."\n";
								$debugging_output .= $mb_test_email_sending_test_email." ".$to."\n";
								$debugging_output .= $mb_test_email_status." : ";
								$debugging_output .= get_option("mail_bank_is_mail_sent") == "Sent" ? $mb_status_sent : $mb_status_not_sent;
								$debugging_output .= "\n----------------------------------------------------------------------------------------\n";
								$debugging_output .= $mb_email_logs_debugging_output." :\n";
								$debugging_output .= "----------------------------------------------------------------------------------------\n";
							}
							$debugging_output .= $mail_bank_mail_status;
							echo $debugging_output;
						}
						else
						{
							$to_address = $phpmailer->getToAddresses();
							$cc_address_array = $phpmailer->getCcAddresses();

							$cc_addresses_data = array();
							$bcc_addresses_data = array();

							$bcc_address_array = $phpmailer->getBccAddresses();
							$email_logs_data_array = array();
							$email_logs_data_array["email_to"] = $to_address[0][0];
							foreach($cc_address_array as $cc_address)
							{
								foreach($cc_address as $address)
								{
									if($address != "")
									array_push($cc_addresses_data,$address);
								}
							}
							$all_cc_addresses = implode(",",$cc_addresses_data);

							foreach($bcc_address_array as $bcc_address)
							{

								foreach($bcc_address as $bcc_add)
								{
									if($bcc_add != "")
									array_push($bcc_addresses_data,$bcc_add);
								}
							}

							$all_bcc_addresses = implode(",",$bcc_addresses_data);

							$email_logs_data_array["sender_name"] = $unserialized_email_configuration_data["sender_name"];
							$email_logs_data_array["sender_email"] = $unserialized_email_configuration_data["sender_email"];
							$email_logs_data_array["cc"] = $all_cc_addresses;
							$email_logs_data_array["bcc"] = $all_bcc_addresses;
							$email_logs_data_array["subject"] = $phpmailer->Subject;
							$email_logs_data_array["content"] = $phpmailer->Body;
							$email_logs_data_array["timestamp"] = time();

							if($result == "true" || $result == "1")
							{
								$email_logs_data_array["status"] = $mb_status_sent;
							}
							else
							{
								$email_logs_data_array["status"] = $mb_status_not_sent;
							}
							$email_logs_id = $wpdb->get_var
							(
								$wpdb->prepare
								(
									"SELECT id FROM ".mail_bank().
									" WHERE type = %s",
									"email_logs"
								)
							);

							$email_logs_data = array();
							$email_logs_data["meta_id"] = $email_logs_id;
							$email_logs_data["meta_key"] = "email_logs";
							$email_logs_data["meta_value"] = serialize($email_logs_data_array);
							$obj_dbHelper_mail_bank->insertCommand(mail_bank_meta(),$email_logs_data);
							echo $result;
						}
					}
				break;

				case "mail_bank_settings_module":
					if(wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "mail_bank_settings"))
					{
						parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "",$settings_array);

						$settings_data = array();
						$settings_data["automatic_plugin_update"] = esc_attr($settings_array["ux_ddl_automatic_plugin_updates"]);
						$settings_data["debug_mode"] = esc_attr($settings_array["ux_ddl_debug_mode"]);
						$settings_data["remove_tables_at_uninstall"] = esc_attr($settings_array["ux_ddl_remove_tables"]);

						$where = array();
						$settings_data_array = array();
						$where["meta_key"] = "settings";
						$settings_data_array["meta_value"] = serialize($settings_data);
						$obj_dbHelper_mail_bank->updateCommand(mail_bank_meta(),$settings_data_array,$where);
					}
				break;

				case "mail_bank_email_configuration_settings_module":
					if(wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "mail_bank_email_configuration_settings"))
					{
						parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "",$form_data);
						$update_email_configuration_array = array();
						$update_email_configuration_array["email_address"] = esc_attr($form_data["ux_txt_email_address"]);
						$update_email_configuration_array["reply_to"] = "";
						$update_email_configuration_array["cc"] = "";
						$update_email_configuration_array["bcc"] = "";
						$update_email_configuration_array["mailer_type"] = esc_attr($form_data["ux_ddl_type"]);
						$update_email_configuration_array["sender_name_configuration"] =  esc_attr($form_data["ux_ddl_from_name"]);
						$update_email_configuration_array["sender_name"] =  isset($form_data["ux_txt_mb_from_name"]) ? esc_html($form_data["ux_txt_mb_from_name"]) : "";
						$update_email_configuration_array["from_email_configuration"] =  esc_attr($form_data["ux_ddl_from_email"]);
						$update_email_configuration_array["sender_email"] =  isset($form_data["ux_txt_mb_from_email_configuration"]) ? esc_html($form_data["ux_txt_mb_from_email_configuration"]) : "";
						$update_email_configuration_array["hostname"] = esc_html($form_data["ux_txt_host"]);
						$update_email_configuration_array["port"] = intval($form_data["ux_txt_port"]);
						$update_email_configuration_array["enc_type"]= esc_attr($form_data["ux_ddl_encryption"]);
						$update_email_configuration_array["auth_type"] =  esc_attr($form_data["ux_ddl_mb_authentication"]);
						$update_email_configuration_array["client_id"] = esc_html(trim($form_data["ux_txt_client_id"]));
						$update_email_configuration_array["client_secret"] = esc_html(trim($form_data["ux_txt_client_secret"]));
						$update_email_configuration_array["username"] = esc_html($form_data["ux_txt_username"]);
						$update_email_configuration_array["automatic_mail"] = isset($form_data["ux_chk_automatic_sent_mail"]) ? esc_html($form_data["ux_chk_automatic_sent_mail"]) : "";

						if(preg_match( '/^\**$/',$form_data["ux_txt_password"]))
						{
							$email_configuration_data = $wpdb->get_var
							(
								$wpdb->prepare
								(
									"SELECT meta_value FROM ".mail_bank_meta().
									" WHERE meta_key=%s",
									"email_configuration"
								)
							);
							$email_configuration_array = unserialize($email_configuration_data);
							$update_email_configuration_array["password"] = $email_configuration_array["password"];
						}
						else
						{
							$update_email_configuration_array["password"] = base64_encode(esc_html($form_data["ux_txt_password"]));
						}

						$update_email_configuration_array["redirect_uri"] = esc_html($form_data["ux_txt_redirect_uri"]);

						update_option("update_email_configuration",$update_email_configuration_array);

						$mail_bank_auth_host = new mail_bank_auth_host($update_email_configuration_array);
						if(!in_array($form_data["ux_txt_host"],$mail_bank_auth_host->oauth_domains) && $form_data["ux_ddl_mb_authentication"] == "oauth2")
						{
							echo "100";
							die();
						}

						if($update_email_configuration_array["auth_type"] != "plain" && $update_email_configuration_array["mailer_type"] == "smtp")
						{
							if($update_email_configuration_array["hostname"] == "smtp.gmail.com")
							{
								$mail_bank_auth_host->google_authentication();
							}
							elseif($update_email_configuration_array["hostname"] == "smtp.live.com" && $update_email_configuration_array["mailer_type"] == "smtp")
							{
								$mail_bank_auth_host->microsoft_authentication();
							}
							elseif(in_array($update_email_configuration_array["hostname"],$mail_bank_auth_host->yahoo_domains))
							{
								$mail_bank_auth_host->yahoo_authentication();
							}
						}
						else
						{
							$update_email_configuration_data_array = array();
							$where = array();
							$where["meta_key"] = "email_configuration";
							$update_email_configuration_data_array["meta_value"] = serialize($update_email_configuration_array);
							$obj_dbHelper_mail_bank->updateCommand(mail_bank_meta(),$update_email_configuration_data_array,$where);
						}
					}
				break;
			}
			die();
		}
	}
}
?>
