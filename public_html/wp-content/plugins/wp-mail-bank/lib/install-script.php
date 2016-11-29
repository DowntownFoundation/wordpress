<?php
/**
* This file is used for creating tables in database on the activation hook.
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
		/*
		Class Name: dbHelper_install_script_mail_bank
		Parameters: No
		Description: This Class is used to Insert, Update operations.
		Created On: 05-02-2016 11:40
		Created By: Tech Banker Team
		*/

		if(!class_exists("dbHelper_install_script_mail_bank"))
		{
			class dbHelper_install_script_mail_bank
			{
				/*
				Function Name: insertCommand
				Parameters: Yes($table_name,$data)
				Description: This Function is used to Insert data in database.
				Created On: 05-02-2016 11:40
				Created By: Tech Banker Team
				*/

				function insertCommand($table_name,$data)
				{
					global $wpdb;
					$wpdb->insert($table_name,$data);
					return $wpdb->insert_id;
				}

				/*
				Function Name: updateCommand
				Parameters: Yes($table_name,$data,$where)
				Description: This function is used to Update data.
				Created On: 05-02-2016 11:40
				Created By: Tech Banker Team
				*/

				function updateCommand($table_name,$data,$where)
				{
					global $wpdb;
					$wpdb->update($table_name,$data,$where);
				}
			}
		}

		if(file_exists(ABSPATH ."wp-admin/includes/upgrade.php"))
		require_once ABSPATH ."wp-admin/includes/upgrade.php";

		$mail_bank_version_number = get_option("mail-bank-version-number");

		if(!function_exists("mail_bank_table"))
		{
			function mail_bank_table()
			{
				$sql = "CREATE TABLE IF NOT EXISTS ".mail_bank()."
				(
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`type` varchar(100) NOT NULL,
					`parent_id` int(11) NOT NULL,
					PRIMARY KEY (`id`)
				)
				ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
				dbDelta($sql);

				$data = "INSERT INTO ". mail_bank() ." (`type`, `parent_id`) VALUES
				('email_configuration', 0),
				('email_logs', 0),
				('settings', 0),
				('roles_and_capabilities', 0)";
				dbDelta($data);
			}
		}

		if(!function_exists("mail_bank_meta_table"))
		{
			function mail_bank_meta_table()
			{
				$obj_dbHelper_install_script_mail_bank = new dbHelper_install_script_mail_bank();
				global $wpdb;
				$sql = "CREATE TABLE IF NOT EXISTS ".mail_bank_meta()."
				(
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`meta_id` int(11) NOT NULL,
					`meta_key` varchar(255) NOT NULL,
					`meta_value` longtext NOT NULL,
					PRIMARY KEY (`id`)
				)
				ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
				dbDelta($sql);

				$admin_email = get_option("admin_email");
				$admin_name = get_option("blogname");

				$mail_bank_table_data = $wpdb->get_results
				(
					"SELECT * FROM " .mail_bank()
				);

				foreach($mail_bank_table_data as $row)
				{
					switch($row->type)
					{
						case "email_configuration":
							$email_configuration_array = array();
							$email_configuration_array["email_address"] = $admin_email;
							$email_configuration_array["reply_to"] = "";
							$email_configuration_array["cc"] = "";
							$email_configuration_array["bcc"] = "";
							$email_configuration_array["mailer_type"] = "php_mail_function";
							$email_configuration_array["sender_name"] = $admin_name;
							$email_configuration_array["sender_name_configuration"] = "override";
							$email_configuration_array["hostname"] = "";
							$email_configuration_array["port"] = "587";
							$email_configuration_array["client_id"] = "";
							$email_configuration_array["client_secret"] = "";
							$email_configuration_array["redirect_uri"] = "";
							$email_configuration_array["sender_email"] = $admin_email;
							$email_configuration_array["from_email_configuration"] = "override";
							$email_configuration_array["auth_type"] = "plain";
							$email_configuration_array["username"] = $admin_email;
							$email_configuration_array["password"] = "";
							$email_configuration_array["enc_type"] = "tls";

							$email_configuration_array_data = array();
							$email_configuration_array_data["meta_id"] = $row->id;
							$email_configuration_array_data["meta_key"] = "email_configuration";
							$email_configuration_array_data["meta_value"] = serialize($email_configuration_array);
							$obj_dbHelper_install_script_mail_bank->insertCommand(mail_bank_meta(),$email_configuration_array_data);
						break;

						case "settings":
							$settings_data_array = array();
							$settings_data_array["automatic_plugin_update"] = "enable";
							$settings_data_array["debug_mode"] = "enable";
							$settings_data_array["remove_tables_at_uninstall"] = "enable";

							$settings_array = array();
							$settings_array["meta_id"] = $row->id;
							$settings_array["meta_key"] = "settings";
							$settings_array["meta_value"] = serialize($settings_data_array);
							$obj_dbHelper_install_script_mail_bank->insertCommand(mail_bank_meta(),$settings_array);
						break;

						case "roles_and_capabilities":
							$roles_capabilities_data_array = array();
							$roles_capabilities_data_array["roles_and_capabilities"] = "1,1,1,0,0";
							$roles_capabilities_data_array["show_mail_bank_top_bar_menu"] = "enable";
							$roles_capabilities_data_array["administrator_privileges"] = "1,1,1,1,1,1,1,1";
							$roles_capabilities_data_array["author_privileges"] = "0,0,1,0,0,0,0,0";
							$roles_capabilities_data_array["editor_privileges"] = "0,0,1,0,0,1,0,0";
							$roles_capabilities_data_array["contributor_privileges"] = "0,0,0,0,0,1,0,0";
							$roles_capabilities_data_array["subscriber_privileges"] = "0,0,0,0,0,0,0,0";

							$roles_data_array = array();
							$roles_data_array["meta_id"] = $row->id;
							$roles_data_array["meta_key"] = "roles_and_capabilities";
							$roles_data_array["meta_value"] = serialize($roles_capabilities_data_array);
							$obj_dbHelper_install_script_mail_bank->insertCommand(mail_bank_meta(),$roles_data_array);
						break;
					}
				}
			}
		}

		$obj_dbHelper_install_script_mail_bank = new dbHelper_install_script_mail_bank();
		switch($mail_bank_version_number)
		{
			case "":
				if(count($wpdb->get_var("SHOW TABLES LIKE '". $wpdb->prefix."mail_bank'")) != 0)
				{
					$mail_bank_data = $wpdb->get_row
					(
						"SELECT * FROM ".$wpdb->prefix."mail_bank"
					);

					$wpdb->query("DROP TABLE ".$wpdb->prefix."mail_bank");
					mail_bank_table();
					mail_bank_meta_table();

					$get_from_name = get_option("show_from_name_in_email");
					$get_from_email = get_option("show_from_email_in_email");

					if(count($mail_bank_data) > 0)
					{
						$update_mail_bank_data = array();
						$update_mail_bank_data["email_address"] = get_option("admin_email");
						$update_mail_bank_data["reply_to"] = "";
						$update_mail_bank_data["cc"] = "";
						$update_mail_bank_data["bcc"] = "";
						$update_mail_bank_data["mailer_type"] = isset($mail_bank_data->mailer_type) && $mail_bank_data->mailer_type == 1 ? "php_mail_function" : "smtp";
						$update_mail_bank_data["sender_name_configuration"] = isset($get_from_name) && $get_from_name == 1 ? "override" : "dont_override";
						$update_mail_bank_data["sender_name"] = isset($mail_bank_data->from_name) ? esc_html($mail_bank_data->from_name) : esc_html(get_option("blogname"));
						$update_mail_bank_data["from_email_configuration"] = isset($get_from_email) && $get_from_email == 1 ? "override" : "dont_override";
						$update_mail_bank_data["sender_email"] = isset($mail_bank_data->from_email) ? $mail_bank_data->from_email : get_option("admin_email");
						$update_mail_bank_data["hostname"] = isset($mail_bank_data->smtp_host) ? $mail_bank_data->smtp_host : "";
						$update_mail_bank_data["port"] = isset($mail_bank_data->smtp_port) ? $mail_bank_data->smtp_port : "";
						$update_mail_bank_data["enc_type"] = isset($mail_bank_data->encryption) && (($mail_bank_data->encryption) == 0) ? "none" : ((($mail_bank_data->encryption) == 1) ? "ssl" : "tls");
						$update_mail_bank_data["auth_type"] = "plain";
						$update_mail_bank_data["client_id"] = "";
						$update_mail_bank_data["client_secret"] = "";
						$update_mail_bank_data["redirect_uri"] = "";
						$update_mail_bank_data["username"] = isset($mail_bank_data->smtp_username) ? $mail_bank_data->smtp_username : "";
						$update_mail_bank_data["password"] = isset($mail_bank_data->smtp_password) ? base64_encode($mail_bank_data->smtp_password) : "";
						$update_mail_bank_data["automatic_mail"] = "1";

						$update_mail_bank_data_serialize = array();
						$where = array();
						$where["meta_id"] = $mail_bank_data->id;
						$where["meta_key"] = "email_configuration";
						$update_mail_bank_data_serialize["meta_value"] = serialize($update_mail_bank_data);
						$obj_dbHelper_install_script_mail_bank->updateCommand(mail_bank_meta(),$update_mail_bank_data_serialize,$where);
					}

					$get_automatic_update_option = get_option("mail-bank-automatic-update");
					$plugin_settings_data = $wpdb->get_var
					(
						$wpdb->prepare
						(
							"SELECT meta_value FROM ".mail_bank_meta()."
							WHERE meta_key = %s",
							"settings"
						)
					);
					$plugin_settings_data_unserialize = unserialize($plugin_settings_data);

					$update_plugin_data = array();
					$update_plugin_data["automatic_plugin_update"] = isset($get_automatic_update_option) && $get_automatic_update_option == 1 ? "enable" : "disable";
					$update_plugin_data["debug_mode"] = isset($plugin_settings_data_unserialize["debug_mode"]) ? $plugin_settings_data_unserialize["debug_mode"] : "enable";
					$update_plugin_data["remove_tables_at_uninstall"] = isset($plugin_settings_data_unserialize["remove_tables_at_uninstall"]) ? $plugin_settings_data_unserialize["remove_tables_at_uninstall"] : "enable";

					$update_plugin_settings_data_serialize = array();
					$where = array();
					$where["meta_key"] = "settings";
					$update_plugin_settings_data_serialize["meta_value"] = serialize($update_plugin_data);
					$obj_dbHelper_install_script_mail_bank->updateCommand(mail_bank_meta(),$update_plugin_settings_data_serialize,$where);
				}
				else
				{
					mail_bank_table();
					mail_bank_meta_table();
				}
			break;
		}
		update_option("mail-bank-version-number","2.0");
	}
}
?>
