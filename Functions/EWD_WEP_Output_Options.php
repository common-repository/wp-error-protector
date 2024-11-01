<?php
/* Creates the admin page, and fills it in based on whether the user is looking at
*  the overview page or an individual item is being edited */
function EWD_WEP_Output_Options() {
	global $wpdb, $EWD_WEP_Full_Version;

	if (isset($_GET['DisplayPage'])) {
		  $Display_Page = $_GET['DisplayPage'];
	}
	else {
		$Display_Page = null;
	}

	if (!isset($_GET['Action'])) {
		$_GET['Action'] = null;
	}

	if (!isset($_GET['OrderBy'])) {
		$_GET['OrderBy'] = null;
	}

	include EWD_WEP_CD_PLUGIN_PATH . 'html/AdminHeader.php';
	if ($_GET['Action'] == "EWD_WEP_Do_Something_Crazy") {
			include EWD_WEP_CD_PLUGIN_PATH . 'html/Something_Crazy_DetailsPage.php';
	}
	else {
		include EWD_WEP_CD_PLUGIN_PATH . 'html/MainScreen.php';
	}
	include EWD_WEP_CD_PLUGIN_PATH . 'html/AdminFooter.php';
}
?>