<?php
/* This file is the action handler. The appropriate function is then called based 
*  on the action that's been selected by the user. The functions themselves are all
* stored either in Prepare_Data_For_Insertion.php or Update_Admin_Databases.php */
		
function Update_EWD_WEP_Content() {
global $ewd_wep_message;
if (isset($_GET['Action'])) {
		switch ($_GET['Action']) {
			case "EWD_WEP_UpdateErrors":
       			$ewd_wep_message = EWD_WEP_UpdateErrors();
				break;
			case "EWD_WEP_Update_Excluded_Plugins":
       			$ewd_wep_message = EWD_WEP_Update_Excluded_Plugins();
				break;
			case "EWD_WEP_Update_Theme_Settings":
       			$ewd_wep_message = EWD_WEP_Update_Theme_Settings();
				break;
			case "EWD_WEP_UpdateEmailOptions":
       			$ewd_wep_message = EWD_WEP_UpdateEmailOptions();
				break;
			case "EWD_WEP_UpdateOptions":
       			$ewd_wep_message = EWD_WEP_UpdateOptions();
				break;
			default:
				$ewd_wep_message = __("The form has not worked correctly. Please contact the plugin developer.", 'EWD_WEP');
				break;
		}
	}
}

?>