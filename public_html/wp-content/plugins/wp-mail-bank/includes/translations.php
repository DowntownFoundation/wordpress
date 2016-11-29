<?php
/**
* This file is used for translation strings.
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
		// Language Translator
		$wp_langs = array();
		$wp_langs["af"] = "Afrikaans";
		$wp_langs["ak"] = "Akan";
		$wp_langs["sq"] = "Shqip";
		$wp_langs["arq"] = "الدارجة الجزايرية";
		$wp_langs["am"] = "አማርኛ";
		$wp_langs["ar"] = "العربية";
		$wp_langs["hy"] = "Հայերեն";
		$wp_langs["rup_mk"] = "Armãneashce";
		$wp_langs["frp"] = "Arpitan";
		$wp_langs["as"] = "অসমীয়া";
		$wp_langs["ast"] = "Asturianu";
		$wp_langs["az"] = "Azərbaycan dili";
		$wp_langs["az_tr"] = "Azərbaycan Türkcəsi";
		$wp_langs["bcc"] = "بلوچی مکرانی";
		$wp_langs["ba"] = "башҡорт теле";
		$wp_langs["eu"] = "Euskara";
		$wp_langs["bel"] = "Беларуская мова";
		$wp_langs["bn_bd"] = "বাংলা";
		$wp_langs["bs_ba"] = "Bosanski";
		$wp_langs["bre"] = "Brezhoneg";
		$wp_langs["bg_bg"] = "Български";
		$wp_langs["ca"] = "Català";
		$wp_langs["bal"] = "Català (Balear)";
		$wp_langs["ceb"] = "Cebuano";
		$wp_langs["zh_cn"] = "简体中文";
		$wp_langs["zh_hk"] = "香港中文版 ";
		$wp_langs["zh_tw"] = "繁體中文";
		$wp_langs["co"] = "Corsu";
		$wp_langs["hr"] = "Hrvatski";
		$wp_langs["cs_cz"] = "Čeština‎";
		$wp_langs["da_dk"] = "Dansk";
		$wp_langs["dv"] = "ދިވެހި";
		$wp_langs["nl_nl"] = "Nederlands";
		$wp_langs["nl_be"] = "Nederlands (België)";
		$wp_langs["dzo"] = "རྫོང་ཁ";
		$wp_langs["en_au"] = "English (Australia)";
		$wp_langs["en_ca"] = "English (Canada)";
		$wp_langs["en_nz"] = "English (New Zealand)";
		$wp_langs["en_za"] = "English (South Africa)";
		$wp_langs["en_gb"] = "English (UK)";
		$wp_langs["eo"] = "Esperanto";
		$wp_langs["et"] = "Eesti";
		$wp_langs["fo"] = "Føroyskt";
		$wp_langs["fi"] = "Suomi";
		$wp_langs["fr_be"] = "Français de Belgique";
		$wp_langs["fr_ca"] = "Français du Canada";
		$wp_langs["fr_fr"] = "Français";
		$wp_langs["fy"] = "Frysk";
		$wp_langs["fur"] = "Friulian";
		$wp_langs["fuc"] = "Pulaar";
		$wp_langs["gl_es"] = "Galego";
		$wp_langs["ka_ge"] = "ქართული";
		$wp_langs["de_de"] = "Deutsch";
		$wp_langs["de_ch"] = "Deutsch (Schweiz)";
		$wp_langs["el"] = "Ελληνικά";
		$wp_langs["kal"] = "Kalaallisut";
		$wp_langs["gn"] = "Avañe'ẽ";
		$wp_langs["gu"] = "ગુજરાતી";
		$wp_langs["hat"] = "Kreyol ayisyen";
		$wp_langs["haw_us"] = "Ōlelo Hawaiʻi";
		$wp_langs["haz"] = "هزاره گی";
		$wp_langs["he_il"] = "עִבְרִית";
		$wp_langs["hi_in"] = "हिन्दी";
		$wp_langs["hu_hu"] = "Magyar";
		$wp_langs["is_is"] = "Íslenska";
		$wp_langs["ido"] = "Ido";
		$wp_langs["id_id"] = "Bahasa Indonesia";
		$wp_langs["ga"] = "Gaelige";
		$wp_langs["it_it"] = "Italiano";
		$wp_langs["ja"] = "日本語";
		$wp_langs["jv_id"] = "Basa Jawa";
		$wp_langs["kab"] = "Taqbaylit";
		$wp_langs["kn"] = "ಕನ್ನಡ";
		$wp_langs["kk"] = "Қазақ тілі";
		$wp_langs["km"] = "ភាសាខ្មែរ";
		$wp_langs["kin"] = "Ikinyarwanda";
		$wp_langs["ky_ky"] = "кыргыз тили";
		$wp_langs["ko_kr"] = "한국어";
		$wp_langs["ckb"] = "كوردی‎";
		$wp_langs["lo"] = "ພາສາລາວ";
		$wp_langs["lv"] = "Latviešu valoda";
		$wp_langs["li"] = "Limburgs";
		$wp_langs["lin"] = "Ngala";
		$wp_langs["lt_lt"] = "Lietuvių kalba";
		$wp_langs["lb_lu"] = "Lëtzebuergesch";
		$wp_langs["mk_mk"] = "Македонски јазик";
		$wp_langs["mg_mg"] = "Malagasy";
		$wp_langs["ms_my"] = "Bahasa Melayu";
		$wp_langs["ml_in"] = "മലയാളം";
		$wp_langs["mri"] = "Te Reo Māori";
		$wp_langs["mr"] = "मराठी";
		$wp_langs["xmf"] = "მარგალური ნინა";
		$wp_langs["mn"] = "Монгол";
		$wp_langs["me_me"] = "Crnogorski jezik";
		$wp_langs["ary"] = "العربية المغربية";
		$wp_langs["my_mm"] = "ဗမာစာ";
		$wp_langs["ne_np"] = "नेपाली";
		$wp_langs["nb_no"] = "Norsk bokmål";
		$wp_langs["nn_no"] = "Norsk nynorsk";
		$wp_langs["oci"] = "Occitan";
		$wp_langs["ory"] = "ଓଡ଼ିଆ";
		$wp_langs["os"] = "Ирон";
		$wp_langs["ps"] = "پښتو";
		$wp_langs["fa_ir"] = "فارسی";
		$wp_langs["fa_af"] = "(فارسی (افغانستان";
		$wp_langs["pl_pl"] = "Polski";
		$wp_langs["pt_br"] = "Português do Brasil";
		$wp_langs["pt_pt"] = "Português";
		$wp_langs["pa_in"] = "ਪੰਜਾਬੀ";
		$wp_langs["rhg"] = "Ruáinga";
		$wp_langs["ro_ro"] = "Română";
		$wp_langs["roh"] = "Rumantsch Vallader";
		$wp_langs["ru_ru"] = "Русский";
		$wp_langs["rue"] = "Русиньскый";
		$wp_langs["sah"] = "Сахалыы";
		$wp_langs["sa_in"] = "भारतम्";
		$wp_langs["srd"] = "Sardu";
		$wp_langs["gd"] = "Gàidhlig";
		$wp_langs["sr_rs"] = "Српски језик";
		$wp_langs["szl"] = "Ślōnskŏ gŏdka";
		$wp_langs["snd"] = "سنڌي";
		$wp_langs["si_lk"] = "සිංහල";
		$wp_langs["sk_sk"] = "Slovenčina";
		$wp_langs["sl_si"] = "Slovenščina";
		$wp_langs["so_so"] = "Afsoomaali";
		$wp_langs["azb"] = "گؤنئی آذربایجان";
		$wp_langs["es_ar"] = "Español de Argentina";
		$wp_langs["es_cl"] = "Español de Chile";
		$wp_langs["es_co"] = "Español de Colombia";
		$wp_langs["es_gt"] = "Español de Guatemala";
		$wp_langs["es_mx"] = "Español de México";
		$wp_langs["es_pe"] = "Español de Perú";
		$wp_langs["es_pr"] = "Español de Puerto Rico";
		$wp_langs["es_es"] = "Español";
		$wp_langs["es_ve"] = "Español de Venezuela";
		$wp_langs["su_id"] = "Basa Sunda";
		$wp_langs["sw"] = "Kiswahili";
		$wp_langs["sv_se"] = "Svenska";
		$wp_langs["gsw"] = "Schwyzerdütsch";
		$wp_langs["tl"] = "Tagalog";
		$wp_langs["tah"] = "Reo Tahiti";
		$wp_langs["tg"] = "Тоҷикӣ";
		$wp_langs["tzm"] = "ⵜⴰⵎⴰⵣⵉⵖⵜ";
		$wp_langs["ta_in"] = "தமிழ்";
		$wp_langs["ta_lk"] = "தமிழ்";
		$wp_langs["tt_ru"] = "Татар теле";
		$wp_langs["te"] = "తెలుగు";
		$wp_langs["th"] = "ไทย";
		$wp_langs["bo"] = "བོད་སྐད";
		$wp_langs["tir"] = "ትግርኛ";
		$wp_langs["tr_tr"] = "Türkçe";
		$wp_langs["tuk"] = "Türkmençe";
		$wp_langs["twd"] = "Twents";
		$wp_langs["ug_cn"] = "Uyƣurqə";
		$wp_langs["uk"] = "Українська";
		$wp_langs["ur"] = "اردو";
		$wp_langs["uz_uz"] = "O‘zbekcha";
		$wp_langs["vi"] = "Tiếng Việt";
		$wp_langs["wa"] = "Walon";
		$wp_langs["cy"] = "Cymraeg";
		$wp_langs["yor"] = "Yorùbá";
		$locale = strtolower(get_locale());
		if(array_key_exists("$locale",$wp_langs))
		{
			$language = $wp_langs["$locale"];
			$mb_like_to_tranlate = __("If you would like to translate in ",wp_mail_bank);
			$mb_help_us_reward = __(" & help us, we will reward you with a free Personal Edition License of Mail Bank. If Interested, Kindly click ",wp_mail_bank);
			$mb_message_translate_help = "$mb_like_to_tranlate $language $mb_help_us_reward";
			$mb_message_translate_here = __("here.",wp_mail_bank);
		}
		else
		{
			$mb_message_translate_help = "";
			$mb_message_translate_here = "";
		}

		$mb_confirm_close = __("Are you sure you want to close without sending Translation Request?",wp_mail_bank);
		$mb_translation_request = __("Translation Request",wp_mail_bank);
		$mb_language_interested_to_translate = __("Language Interested to Translate",wp_mail_bank);
		$mb_language_interested_to_translate_tooltip = __("Please enter the language you want to translate.",wp_mail_bank);
		$mb_language_interested_to_translate_placeholder = __("Please enter the language",wp_mail_bank);
		$mb_popup_query = __("Query",wp_mail_bank);
		$mb_popup_query_tooltip = __("Please enter your Query.",wp_mail_bank);
		$mb_popup_query_placeholder = __("Please enter the Query",wp_mail_bank);
		$mb_popup_your_name_tooltip = __("Please enter your Name.",wp_mail_bank);
		$mb_popup_your_email_tooltip = __("Please enter your Email.",wp_mail_bank);
		$mb_close = __("Close",wp_mail_bank);
		$mb_popup_send_request = __("Send Request",wp_mail_bank);

		//wizard
		$mb_wizard_basic_info = __("Basic Info",wp_mail_bank);
		$mb_wizard_account_setup = __("Account Setup",wp_mail_bank);
		$mb_wizard_confirm = __("Confirm",wp_mail_bank);

		// Menus
		$wp_mail_bank = __("Mail Bank",wp_mail_bank);
		$mb_email_configuration = __("Email Setup",wp_mail_bank);
		$mb_email_logs = __("Email Logs",wp_mail_bank);
		$mb_test_email = __("Test Email",wp_mail_bank);
		$mb_settings = __("Plugin Settings",wp_mail_bank);
		$mb_feedbacks = __("Feedbacks",wp_mail_bank);
		$mb_roles_and_capabilities = __("Roles & Capabilities",wp_mail_bank);
		$mb_system_information = __("System Information",wp_mail_bank);

		// Footer
		$message_premium_edition = __("This feature is available only in Premium Editions! <br> Kindly Purchase to unlock it!", wp_mail_bank);
		$mb_success = __("Success!",wp_mail_bank);
		$mb_update_email_configuration = __("Email Setup has been updated Successfully",wp_mail_bank);
		$mb_update_feedbacks = __("Your Feedback has been sent Successfully",wp_mail_bank);
		$mb_language_translate_request = __("Your request email has been sent Successfully",wp_mail_bank);
		$mb_test_email_sent = __("Test Email was sent Successfully!",wp_mail_bank);
		$mb_test_email_not_send = __("Test Email was not sent!",wp_mail_bank);
		$mb_update_settings = __("Plugin Settings have been updated Successfully",wp_mail_bank);
		$mb_choose_action = __("Please choose an Action from Dropdown!",wp_mail_bank);
		$mb_choose_record_to_delete = __("Please choose at least 1 record to delete!",wp_mail_bank);
		$mb_confirm_bulk_delete = __("Are you sure you want to delete Email Logs?",wp_mail_bank);
		$mb_bulk_delete_email_logs =__("Selected Logs have been deleted Successfully",wp_mail_bank);
		$mb_confirm_single_delete = __("Are you sure you want to delete Email Log?",wp_mail_bank);
		$mb_delete_log = __("Email Log has been deleted Successfully",wp_mail_bank);
		$oauth_not_supported = __("The OAuth is not supported by provided SMTP Host, kindly provide username and password",wp_mail_bank);
		$mb_invalid_secret_key = __("Invalid Secret Key.Please rectify and try again!",wp_mail_bank);
		$mb_premium_editions_label = __("Premium Editions",wp_mail_bank);

		// Common Variables
		$mb_status_sent = __("Sent",wp_mail_bank);
		$mb_status_not_sent = __("Not Sent",wp_mail_bank);
		$mb_important_disclaimer = __("Important Disclaimer!",wp_mail_bank);
		$mb_user_access_message = __("You don't have Sufficient Access to this Page. Kindly contact the Administrator for more Privileges",wp_mail_bank);
		$mb_enable = __("Enable",wp_mail_bank);
		$mb_disable = __("Disable",wp_mail_bank);
		$mb_override = __("Override",wp_mail_bank);
		$mb_dont_override = __("Don't Override",wp_mail_bank);
		$mb_save_changes = __("Save Settings",wp_mail_bank);
		$mb_subject = __("Subject",wp_mail_bank);
		$mb_next_step = __("Next Step",wp_mail_bank);
		$mb_previous_step = __("Previous Step",wp_mail_bank);
		$mb_settings_link = __("Settings",wp_mail_bank);
		$mb_not_available = __("Not available",wp_mail_bank);
		$mb_open_ssl_message = __("* Openssl extension not found or disabled",wp_mail_bank);

		// Email Setup
		$mb_email_configuration_cc_label = __("Cc",wp_mail_bank);
		$mb_email_configuration_bcc_label = __("Bcc",wp_mail_bank);
		$mb_email_configuration_cc_email_address_tooltip = __("Please provide valid Cc Email Address",wp_mail_bank);
		$mb_email_configuration_bcc_email_address_tooltip = __("Please provide valid Bcc Email Address",wp_mail_bank);
		$mb_email_configuration_cc_email_placeholder = __("Please provide Cc Email",wp_mail_bank);
		$mb_email_configuration_bcc_email_placeholder = __("Please provide Bcc Email",wp_mail_bank);
		$mb_email_configuration_mailer_settings_tab = __("Mailer Settings", wp_mail_bank);
		$mb_email_configuration_test_email_tab = __("Test Email", wp_mail_bank);
		$mb_email_configuration_from_name = __("From Name",wp_mail_bank);
		$mb_email_configuration_from_name_tooltip = __("From Name is the inbox field that tells your recipient who sent the messages. If you would like to override the pre-configured From Name, then you would need to insert the name in the inbox field", wp_mail_bank);
		$mb_email_configuration_from_name_placeholder = __("Please provide From Name", wp_mail_bank);
		$mb_email_configuration_from_email = __("From Email",wp_mail_bank);
		$mb_email_address_tooltip = __("From Email is the inbox field that tells your recipient from which Email Address the messages are coming. If you would like to override the pre-configured From Email, then you would need to insert an Email Address in the inbox field.", wp_mail_bank);
		$mb_email_configuration_from_email_placeholder = __("Please provide From Email Address", wp_mail_bank);
		$mb_email_configuration_mailer_type = __("Mailer Type",wp_mail_bank);
		$mb_email_configuration_mailer_type_tooltip = __("This field provides you an ability to choose a specific option for Mailer Type. If you would like to send an Email via SMTP mailer, you would need to select Send Email via SMTP from the drop down or you could use PHP mail () Function", wp_mail_bank);
		$mb_email_configuration_send_email_via_smtp = __("Send Email via SMTP",wp_mail_bank);
		$mb_email_configuration_use_php_mail_function = __("Use The PHP mail() Function",wp_mail_bank);
		$mb_email_configuration_smtp_host = __("SMTP Host",wp_mail_bank);
		$mb_email_configuration_smtp_host_tooltip = __("If you would like to send an Email via different host, you would need to insert that specific host name like smtp.gmail.com in the inbox field", wp_mail_bank);
		$mb_email_configuration_smtp_host_placeholder = __("Please provide SMTP Host", wp_mail_bank);
		$mb_email_configuration_smtp_port = __("SMTP Port",wp_mail_bank);
		$mb_email_configuration_smtp_port_tooltip = __("This inbox field is specified to provide a valid SMTP Port for authentication.", wp_mail_bank);
		$mb_email_configuration_smtp_port_placeholder = __("Please provide SMTP Port", wp_mail_bank);
		$mb_email_configuration_encryption = __("Encryption",wp_mail_bank);
		$mb_email_configuration_encryption_tooltip = __("It provides you an ability to choose a specific option for Encryption. If you would like to send an Email with TLS encryption, you would need to select �Use TLS Encryption� from the drop down or you could use SSL Encryption. For that you would need to select �Use SSL Encryption� from the drop down. If you would like to send an Email without encryption, you would need to select �No Encryption� from the drop down.", wp_mail_bank);
		$mb_email_configuration_no_encryption = __("No Encryption",wp_mail_bank);
		$mb_email_configuration_use_ssl_encryption = __("Use SSL Encryption",wp_mail_bank);
		$mb_email_configuration_use_tls_encryption = __("Use TLS Encryption",wp_mail_bank);
		$mb_email_configuration_authentication = __("Authentication",wp_mail_bank);
		$mb_email_configuration_authentication_tooltip = __("This inbox field allows you to choose an appropriate option for authentication. It provides you the Two-way authentication factor; If you would like to authenticate yourself via Username and Password, you would need to select Use Username and Password from the drop down. You can also authenticate by Oauth 2.0 protocol, which requires Client Id and Secret Key, for that you would need to select Use Oauth (Client ID and Secret Key) from the drop down. You can easily get Client Id and Secret Key from respective SMTP Server Developers section", wp_mail_bank);
		$mb_email_configuration_use_smtp_authentication = __("Use SMTP Authentication",wp_mail_bank);
		$mb_email_configuration_donot_use_authentication = __("Don't Use SMTP Authentication",wp_mail_bank);
		$mb_email_configuration_test_email_address = __("Test Email Address",wp_mail_bank);
		$mb_email_configuration_test_email_address_tooltip = __("You would need to provide a valid Email Address in the inbox field on which you would like to receive the Test email", wp_mail_bank);
		$mb_email_configuration_test_email_address_placeholder = __("Please provide Test Email Address", wp_mail_bank);
		$mb_email_configuration_subject_test_tooltip = __("In this field, you need to provide a subject for Test Email", wp_mail_bank);
		$mb_email_configuration_subject_test_placeholder = __("Please provide Subject", wp_mail_bank);
		$mb_email_configuration_content = __("Email Content",wp_mail_bank);
		$mb_email_configuration_content_tooltip = __("This field is to provide the content for the Test Email.", wp_mail_bank);
		$mb_email_configuration_send_test_email = __("Send Test Email", wp_mail_bank);
		$mb_email_configuration_smtp_debugging_output = __("SMTP Debugging Output", wp_mail_bank);
		$mb_email_configuration_send_test_email_textarea = __("Checking your settings", wp_mail_bank);
		$mb_email_configuration_result = __("Result", wp_mail_bank);
		$mb_email_configuration_send_another_test_email = __("Send Another Test Email", wp_mail_bank);
		$mb_email_configuration_enable_from_name = __("From Name Configuration",wp_mail_bank);
		$mb_email_configuration_enable_from_name_tooltip = __("If you would like to override the pre-configured name which will be used while sending Emails, then you would need to choose Override from the drop down and vice-versa",wp_mail_bank);
		$mb_email_configuration_enable_from_email = __("From Email Configuration",wp_mail_bank);
		$mb_email_configuration_enable_from_email_tooltip = __("If you would like to override your pre-configured Email Address which will be used while sending Emails, then you would need to choose Override from the drop down and vice-versa",wp_mail_bank);
		$mb_email_configuration_username = __("Username",wp_mail_bank);
		$mb_email_configuration_username_tooltip = __("In this field, you need to provide a username to authenticate your SMTP details",wp_mail_bank);
		$mb_email_configuration_username_placeholder = __("Please provide username",wp_mail_bank);
		$mb_email_configuration_password = __("Password",wp_mail_bank);
		$mb_email_configuration_password_tooltip = __("In this field, you need to provide a password to authenticate your SMTP details",wp_mail_bank);
		$mb_email_configuration_password_placeholder = __("Please provide password",wp_mail_bank);
		$mb_email_configuration_redirect_uri = __("Redirect URI",wp_mail_bank);
		$mb_email_configuration_redirect_uri_tooltip = __("Please copy this Redirect URI and Paste into Redirect URI field when creating your app",wp_mail_bank);
		$mb_email_configuration_use_oauth = __("Use OAuth(Client Id and Secret Key required)",wp_mail_bank);
		$mb_email_configuration_use_username_and_password = __("Use Username And Password",wp_mail_bank);
		$mb_email_configuration_client_id = __("Client Id",wp_mail_bank);
		$mb_email_configuration_client_secret = __("Secret Key",wp_mail_bank);
		$mb_email_configuration_client_id_tooltip = __("Please provide valid Client Id issued by your SMTP Host",wp_mail_bank);
		$mb_email_configuration_client_secret_tooltip = __("Please provide valid Secret Key issued by your SMTP Host",wp_mail_bank);
		$mb_email_configuration_client_id_placeholder = __("Please provide Client Id",wp_mail_bank);
		$mb_email_configuration_client_secret_placeholder = __("Please provide Secret Key",wp_mail_bank);
		$mb_email_configuration_tick_for_sent_mail = __("Yes, automatically send a Test Email upon clicking on the Next Step Button to verify settings",wp_mail_bank);
		$mb_email_configuration_email_address = __("Email Address",wp_mail_bank);
		$mb_email_configuration_email_address_tooltip = __("You would need to add a valid Email Address in the inbox field from which you would like to send Emails.",wp_mail_bank);
		$mb_email_configuration_email_address_placeholder = __("Please provide valid Email Address",wp_mail_bank);
		$mb_email_configuration_reply_to = __("Reply To",wp_mail_bank);
		$mb_email_configuration_reply_to_tooltip = __("You would need to add a valid Email Address that is automatically inserted into the Reply To field when a user replies to an email message.",wp_mail_bank);
		$mb_email_configuration_reply_to_placeholder = __("Please provide Reply To Email Address",wp_mail_bank);
		$mb_email_configuration_get_google_credentials = __("Get Google Client Id and Secret Key",wp_mail_bank);
		$mb_email_configuration_get_microsoft_credentials = __("Get Microsoft Client Id and Secret Key",wp_mail_bank);
		$mb_email_configuration_get_yahoo_credentials = __("Get Yahoo Client Id and Secret Key",wp_mail_bank);

		// Email Logs
		$mb_start_date_title = __("Start Date",wp_mail_bank);
		$mb_start_date_placeholder = __("Please provide Start Date",wp_mail_bank);
		$mb_start_date_tooltip = __("This field shows starting date of Email Logs",wp_mail_bank);
		$mb_end_date_title = __("End Date",wp_mail_bank);
		$mb_end_date_placeholder = __("Please provide End Date",wp_mail_bank);
		$mb_end_date_tooltip = __("This field shows ending date of Email Logs",wp_mail_bank);
		$mb_submit = __("Submit",wp_mail_bank);
		$mb_email_logs_bulk_action = __("Bulk Action",wp_mail_bank);
		$mb_email_logs_delete = __("Delete",wp_mail_bank);
		$mb_email_logs_apply = __("Apply",wp_mail_bank);
		$mb_email_logs_email_to = __("Email To",wp_mail_bank);
		$mb_email_logs_actions = __("Action",wp_mail_bank);
		$mb_email_logs_show_details = __("Show Details",wp_mail_bank);
		$mb_email_logs_email_details = __("Email Details",wp_mail_bank);
		$mb_email_logs_close = __("Close",wp_mail_bank);
		$mb_email_logs_debugging_output = __("Debugging Output",wp_mail_bank);
		$mb_email_logs_show_outputs = __("Show Debugging Output",wp_mail_bank);
		$mb_email_sent_to = __("Email Sent To",wp_mail_bank);
		$mb_date_time = __("Date/Time",wp_mail_bank);
		$mb_email_logs_status = __("Status",wp_mail_bank);
		$mb_from = __("From",wp_mail_bank);

		// Settings
		$mb_settings_automatic_plugin_update = __("Automatic Plugin Updates", wp_mail_bank);
		$mb_settings_automatic_plugin_update_tooltip = __("Please choose a specific option whether to allow Automatic Plugin Updates", wp_mail_bank);
		$mb_settings_debug_mode = __("Debug Mode",wp_mail_bank);
		$mb_settings_debug_mode_tooltip = __("Please choose a specific option for Debug Mode",wp_mail_bank);
		$mb_remove_tables_title = __("Remove Tables at Uninstall",wp_mail_bank);
		$mb_remove_tables_tooltip = __("Please choose a specific option whether to allow Remove Tables at Uninstall",wp_mail_bank);

		// Roles and Capabilities
		$mb_roles_capabilities_show_menu = __("Show Mail Bank Menu",wp_mail_bank);
		$mb_roles_capabilities_show_menu_tooltip = __("Please choose a specific role who can see Sidebar Menu",wp_mail_bank);
		$mb_roles_capabilities_administrator = __("Administrator",wp_mail_bank);
		$mb_roles_capabilities_author = __("Author",wp_mail_bank);
		$mb_roles_capabilities_editor = __("Editor",wp_mail_bank);
		$mb_roles_capabilities_contributor = __("Contributor",wp_mail_bank);
		$mb_roles_capabilities_subscriber = __("Subscriber",wp_mail_bank);
		$mb_roles_capabilities_topbar_menu = __("Show Mail Bank Top Bar Menu",wp_mail_bank);
		$mb_roles_capabilities_topbar_menu_tooltip = __("Please choose a specific option from Mail Bank Top Bar Menu", wp_mail_bank);
		$mb_roles_capabilities_administrator_role =  __("An Administrator Role can do the following ",wp_mail_bank);
		$mb_roles_capabilities_administrator_role_tooltip = __("Please choose specific page available for the Administrator Access", wp_mail_bank);
		$mb_roles_capabilities_full_control = __("Full Control",wp_mail_bank);
		$mb_roles_capabilities_author_role = __("An Author Role can do the following ",wp_mail_bank);
		$mb_roles_capabilities_author_role_tooltip = __("Please choose specific page available for Author Access", wp_mail_bank);
		$mb_roles_capabilities_editor_role = __("An Editor Role can do the following ",wp_mail_bank);
		$mb_roles_capabilities_editor_role_tooltip = __("Please choose specific page available for Editor Access", wp_mail_bank);
		$mb_roles_capabilities_contributor_role = __("A Contributor Role can do the following ",wp_mail_bank);
		$mb_roles_capabilities_contributor_role_tooltip = __("Please choose specific page available for Contributor Access", wp_mail_bank);
		$mb_roles_capabilities_subscriber_role = __("A Subscriber Role can do the following",wp_mail_bank);
		$mb_roles_capabilities_subscriber_role_tooltip = __("Please choose specific page available for Subscriber Access", wp_mail_bank);

		// Feedbacks
		$mb_feedbacks_thank_you = __("Thank You!",wp_mail_bank);
		$mb_feedbacks_suggest_some_features = __("Kindly fill in the below form, if you would like to suggest some features which are not in the Plugin",wp_mail_bank);
		$mb_feedbacks_suggestion_complaint = __("If you also have any suggestion/complaint, you can use the same form below",wp_mail_bank);
		$mb_feedbacks_write_us_on = __("You can also write us on",wp_mail_bank);
		$mb_feedbacks_your_name = __("Your Name",wp_mail_bank);
		$mb_feedbacks_your_name_tooltip = __("Please provide Your Name which will be sent along with your Feedback",wp_mail_bank);
		$mb_feedbacks_your_name_placeholder = __("Please provide your Name",wp_mail_bank);
		$mb_feedbacks_your_email = __("Your Email",wp_mail_bank);
		$mb_feedbacks_your_email_tooltip = __("Please provide Your Email Address which will be sent along with your Feedback",wp_mail_bank);
		$mb_feedbacks_your_email_placeholder = __("Please provide your Email Address",wp_mail_bank);
		$mb_feedbacks_tooltip = __("Please provide your Feedback which will be sent along",wp_mail_bank);
		$mb_feedbacks_placeholder = __("Please provide your Feedback",wp_mail_bank);
		$mb_feedbacks_send_feedback = __("Send Feedback",wp_mail_bank);

		// Test Email
		$mb_test_email_sending_test_email = __("Sending Test Email to",wp_mail_bank);
		$mb_test_email_status = __("Email Status",wp_mail_bank);

		// Disclaimers
		$mb_click_disclaimer = __("* Click ",wp_mail_bank);
		$mb_here_disclaimer = __("here ",wp_mail_bank);
		$mb_unblock_premium_disclaimer = __(" to see Premium Edition Features in detail.",wp_mail_bank);
		$mb_demos_disclaimer = __("* For Mail Bank Demos, click ",wp_mail_bank);
		$mb_manual_disclaimer = __("* For Mail Bank User Guide for this page, click ",wp_mail_bank);
		$mb_important_disclaimer = __("Important Disclaimer!",wp_mail_bank);
		$mb_language_translate_request = __("Your request email has been sent Successfully.",wp_mail_bank);
		$mb_filters_disclaimer = __("* Filters ",wp_mail_bank);
		$mb_cc_bcc_disclaimer = __("* Reply to, Cc and Bcc Fields ",wp_mail_bank);
		$mb_delete_logs_disclaimer = __("* Deleting Email Logs ",wp_mail_bank);
		$mb_debugging_output_disclaimer = __("* Debugging Output",wp_mail_bank);
		$mb_show_details_disclaimer = __("* Email Logs Details ",wp_mail_bank);
		$mb_save_roles_and_capabilities_disclaimer = __("* Saving Roles & Capabilities ",wp_mail_bank);
		$mb_premium_edition_features_disclaimer = __(" Premium Edition Features :",wp_mail_bank);
	}
}
?>
