<?php
function EWD_WEP_UpdateErrors() {
	global $EWD_WEP_Full_Version;

	//use $_POST['Options_Submit'] for optional fields
	if (isset($_POST['Errors_Submit'])) {update_option("EWD_WEP_Selected_Errors", $_POST['selected_errors']);}

	$update_message = __("Selected errors have been succesfully updated.", 'EWD_URP');
	$update['Message'] = $update_message;
	$update['Message_Type'] = "Update";
	return $update;
}

function EWD_WEP_Update_Excluded_Plugins() {
	global $EWD_WEP_Full_Version;

	//use $_POST['Plugins_Submit'] for optional fields
	if (isset($_POST['Plugins_Submit'])) {update_option("EWD_WEP_Excluded_Plugins", $_POST['excluded_plugins']);}

	$update_message = __("Excluded plugins have been succesfully updated.", 'EWD_URP');
	$update['Message'] = $update_message;
	$update['Message_Type'] = "Update";
	return $update;
}

function EWD_WEP_Update_Theme_Settings() {
	global $EWD_WEP_Full_Version;

	if (isset($_POST['switch_themes'])) {update_option("EWD_WEP_Switch_Themes", $_POST['switch_themes']);}

	$theme = wp_get_theme($_POST['stylesheet']);
	if (isset($_POST['stylesheet'])) {update_option("EWD_WEP_Stylesheet", $_POST['stylesheet']);}
	if (isset($_POST['stylesheet'])) {update_option("EWD_WEP_Template_Name", $theme->get_template());}
	if (isset($_POST['stylesheet'])) {update_option("EWD_WEP_Replace_Theme", $theme->Name);}

	$update_message = __("Theme settings have been succesfully updated.", 'EWD_URP');
	$update['Message'] = $update_message;
	$update['Message_Type'] = "Update";
	return $update;
}

function EWD_WEP_UpdateEmailOptions() {
	global $EWD_WEP_Full_Version;

	//use $_POST['Options_Submit'] for write in fields
	if (isset($_POST['error_admin_email'])) {update_option("EWD_WEP_Error_Admin_Email", stripslashes_deep($_POST['error_admin_email']));}
	if (isset($_POST['error_email_subject'])) {update_option("EWD_WEP_Error_Email_Subject", stripslashes_deep($_POST['error_email_subject']));}
	if (isset($_POST['error_message_body'])) {update_option("EWD_WEP_Error_Message_Body", stripslashes_deep($_POST['error_message_body']));}

	$update_message = __("Email options have been succesfully updated.", 'EWD_URP');
	$update['Message'] = $update_message;
	$update['Message_Type'] = "Update";
	return $update;
}

function EWD_WEP_UpdateOptions() {
	global $EWD_WEP_Full_Version;

	//use $_POST['Options_Submit'] for write in fields
	if (isset($_POST['admin_email_notification'])) {update_option("EWD_WEP_Admin_Notification_Email", $_POST['admin_email_notification']);}
	if (isset($_POST['developer_notification_email'])) {update_option("EWD_WEP_Developer_Notification_Email", $_POST['developer_notification_email']);}
	if (isset($_POST['hide_php_error'])) {update_option("EWD_WEP_Hide_PHP_Error", $_POST['hide_php_error']);}
	if (isset($_POST['Options_Submit'])) {update_option("EWD_WEP_Error_Page_Header", stripslashes_deep($_POST['error_page_header']));}
	if (isset($_POST['Options_Submit'])) {update_option("EWD_WEP_Error_Page_Text", stripslashes_deep($_POST['error_page_text']));}
	if (isset($_POST['link_to_homepage'])) {update_option("EWD_WEP_Link_To_Homepage", $_POST['link_to_homepage']);}
	if (isset($_POST['link_to_homepage_button'])) {update_option("EWD_WEP_Link_To_Homepage_Button", $_POST['link_to_homepage_button']);}
	if (isset($_POST['Options_Submit'])) {update_option("EWD_WEP_Background_Color", $_POST['background_color']);}
	if (isset($_POST['Options_Submit'])) {update_option("EWD_WEP_Text_Color", $_POST['text_color']);}

	$update_message = __("Options have been succesfully updated.", 'EWD_URP');
	$update['Message'] = $update_message;
	$update['Message_Type'] = "Update";
	return $update;
}
?>