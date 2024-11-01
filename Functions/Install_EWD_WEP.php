<?php
function Install_EWD_WEP() {
	/* Add in the required globals to be able to create the tables */
  	global $wpdb;
   	global $EWD_WEP_db_version;
		
	update_option("EWD_WEP_DB_version", $EWD_WEP_db_version);
 
   	if (get_option("EWD_WEP_Full_Version") == "") {update_option("EWD_WEP_Full_Version", "Yes");}
   	if (get_option("EWD_WEP_Admin_Notification_Email") == "") {update_option("EWD_WEP_Admin_Notification_Email", "Yes");}
   	if (get_option("EWD_WEP_Developer_Notification_Email") == "") {update_option("EWD_WEP_Developer_Notification_Email", "Yes");}
   	if (get_option("EWD_WEP_Hide_PHP_Error") == "") {update_option("EWD_WEP_Hide_PHP_Error", "No");}
   	if (get_option("EWD_WEP_Error_Page_Header") == "") {update_option("EWD_WEP_Error_Page_Header", "Error in plugin: %extension%");}
   	if (get_option("EWD_WEP_Error_Page_Text") == "") {update_option("EWD_WEP_Error_Page_Text", "%extension% has been deactivated, please refresh the page to continue as expected.");}
   	if (get_option("EWD_WEP_Link_To_Homepage") == "") {update_option("EWD_WEP_Link_To_Homepage", "Yes");}
   	if (get_option("EWD_WEP_Link_To_Homepage_Button") == "") {update_option("EWD_WEP_Link_To_Homepage_Button", "Yes");}

   	if (get_option("EWD_WEP_Error_Email_Subject") == "") {update_option("EWD_WEP_Error_Email_Subject", "Error in %filename%");}
   	if (get_option("EWD_WEP_Error_Message_Body") == "") {
   		$Message =  "Hello,\n\n";
		 $Message .= "An error appears to have occurred in your plugin:\n\n";
		 $Message .= "File: %filename% \n";
		 $Message .= "Line: %line%\n";
		 $Message .= "Message: %message%\n";
		 $Message .= "Error Type: %type%\n\n";
		 $Message .= "This is an automatically generated email, which was sent to you because of an option selected in the WP Error Protector plugin.";

   		update_option("EWD_WEP_Error_Message_Body", $Message);
   	}
}
?>
