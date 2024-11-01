<?php
function EWD_WEP_Process_Error_Handling($errfile, $errmsg, $errline, $errtype) {
	$Admin_Notification_Email = get_option("EWD_WEP_Admin_Notification_Email");
	$Developer_Notification_Email = get_option("EWD_WEP_Developer_Notification_Email");
	$Hide_PHP_Error = get_option("EWD_WEP_Hide_PHP_Error");
	$Error_Page_Header = get_option("EWD_WEP_Error_Page_Header");
	$Error_Page_Text = get_option("EWD_WEP_Error_Page_Text");
	$Link_To_Homepage = get_option("EWD_WEP_Link_To_Homepage");
	$Link_To_Homepage_Button = get_option("EWD_WEP_Link_To_Homepage_Button");
	$Background_Color = get_option("EWD_WEP_Background_Color");
	$Text_Color = get_option("EWD_WEP_Text_Color");

	$Excluded_Plugins = get_option("EWD_WEP_Excluded_Plugins");
	if (!is_array($Excluded_Plugins)) {$Excluded_Plugins = array();}
	$Plugin_Error_Stats = get_option("EWD_WEP_Plugin_Error_Stats");
	if (!is_array($Plugin_Error_Stats)) {$Plugin_Error_Stats = array();}
	$Switch_Themes = get_option("EWD_WEP_Switch_Themes");

	$Error_Page_Header = str_replace("%filename%", $errfile, $Error_Page_Header);
	$Error_Page_Text = str_replace("%filename%", $errfile, $Error_Page_Text);

	if ($Hide_PHP_Error == "Yes") {$Hide_Error_Class = 'ewd-wep-hide-error';}
	else {$Hide_Error_Class = '';}

	/* $Template_Name = "twentyeleven";
	$Stylesheet = "twentyeleven";
	$Replace_Theme = "Twenty Eleven"; */

	$Template_Name = get_option("EWD_WEP_Template_Name");
	$Stylesheet = get_option("EWD_WEP_Stylesheet");
	$Replace_Theme = get_option("EWD_WEP_Replace_Theme");

	$Plugin_Directory_Start_Char = strpos($errfile, "plugins/");
	$Theme_Directory_Start_Char = strpos($errfile, "themes/");
	if ($Plugin_Directory_Start_Char !== false) {
		$Plugin_Directory_Start_Char += 8;
		$Error_In = "Plugin";
	}
	elseif ($Theme_Directory_Start_Char !== false) {
		$Theme_Directory_Start_Char += 7;
		$Error_In = "Theme";
	}
	else {
		$Error_In = "Other";
	}
	
	if ($Plugin_Directory_Start_Char !== false) {
		$Error_Plugin = substr($errfile, $Plugin_Directory_Start_Char, strpos(substr($errfile, $Plugin_Directory_Start_Char), "/"));
		$Error_Plugin_Name = substr($errfile, $Plugin_Directory_Start_Char);
	}
	elseif ($Theme_Directory_Start_Char !== false) {$Error_Theme = substr($errfile, $Theme_Directory_Start_Char, strpos(substr($errfile, $Theme_Directory_Start_Char), "/"));}
	
	if ($Plugin_Directory_Start_Char !== false) {
		$Active_Plugins = get_option("active_plugins");

		foreach ($Active_Plugins as $Plugin) {
			if (strpos($Plugin, $Error_Plugin) === false or in_array($Plugin, $Excluded_Plugins)) {
				$New_Active_Plugins[] = $Plugin;
			}
			else {
				$Deactivated = true;
			}
		}
		update_option("active_plugins", $New_Active_Plugins);

		//update_option("TEST_ERROR_HANDLE", $Error_Plugin);
	}
	elseif ($Theme_Directory_Start_Char !== false and $Switch_Themes == "Yes") {
		update_option("template", $Template_Name);
		update_option("stylesheet", $Stylesheet);
		update_option("current_theme", $Replace_Theme);

		$Deactivated = true;

		//update_option("TEST_ERROR_HANDLE", $Error_Theme);
	}

	if ($Error_In == "Plugin") {
		$Error_Page_Header = str_replace("%extension%", $Error_Plugin, $Error_Page_Header);
		$Error_Page_Text = str_replace("%extension%", $Error_Plugin, $Error_Page_Text);

		if ($Developer_Notification_Email == "Yes") {EWD_WEP_Send_Developer_Email($Error_Plugin, $errfile, $errmsg, $errline, $errtype);}

		$Plugin_Error_Stats[$Error_Plugin_Name]++;
		update_option("EWD_WEP_Plugin_Error_Stats", $Plugin_Error_Stats);
	}
	elseif ($Error_In == "Theme") {
		$Error_Page_Header = str_replace("%extension%", $Error_Theme, $Error_Page_Header);
		$Error_Page_Text = str_replace("%extension%", $Error_Theme, $Error_Page_Text);
		
		if ($Developer_Notification_Email == "Yes") {EWD_WEP_Send_Developer_Email($Error_Theme, $errfile, $errmsg, $errline, $errtype);}
	}
	else {
		$Error_Page_Header = str_replace("%extension%", "WordPress Core", $Error_Page_Header);
		$Error_Page_Text = str_replace("%extension%", "WordPress Core", $Error_Page_Text);
	}

	//if ($Error_In == "Plugin" and $Deactivated) {echo "<strong>Plugin has been deactivated, please refresh the page to continue as expected.</strong>";}
	//if ($Error_In == "Theme" and $Deactivated) {echo "<strong>Theme has been switched to " . $Replace_Theme . ", please refresh the page to continue as expected.</strong>";}

	$Error_Message = "<style>";
	if ($Background_Color != "") {$Error_Message .= "background:" . $Background_Color . ";";}
	if ($Text_Color != "" ) {$Error_Message .= "color:" . $Text_Color . ";";}
	$Error_Message .= "</style>";

	$Error_Message .= "<div class='ewd-wep-main-div " . $Hide_Error_Class . "'>";
	$Error_Message .= "<div class='ewd-wep-inner-div'>";
	$Error_Message .= "<h1>" . $Error_Page_Header . "</h1>";
	$Error_Message .= "<div class='ewd-wep-page-text'>";
	$Error_Message .= $Error_Page_Text;
	$Error_Message .= "</div>";
	if ($Link_To_Homepage == "Yes") {
		$Error_Message .= "<a href='" . home_url() . "'>";
		if ($Link_To_Homepage_Button == "Yes") {$Error_Message .= "<button>";}
		$Error_Message .= __('Go to homepage', 'EWD_WEP');
		if ($Link_To_Homepage_Button == "Yes") {$Error_Message .= "</button>";}
	}
	$Error_Message .= "</div>";
	$Error_Message .= "</div>";

	echo $Error_Message;

	if ($Admin_Notification_Email == "Yes") {EWD_WEP_Send_Admin_Email($Error_Extension, $errfile, $errmsg, $errline, $errtype);}
}

function EWD_WEP_Send_Admin_Email($Error_Extension, $errfile, $errmsg, $errline, $errtype) {
	$Message_Body = get_option("EWD_WEP_Error_Message_Body");
	$Email_Subject = get_option("EWD_WEP_Error_Email_Subject");
	$Admin_Email = get_option("EWD_WEP_Error_Admin_Email");

	if ($Admin_Email == "") {$Admin_Email = get_option('admin_email');}

	$Error_Plain_Text = EWD_WEP_Error_Type_To_Text($errtype);

	$headers = 'From: ' . $Admin_Email . "\r\n" .
    		'Reply-To: ' . $Admin_Email . "\r\n" .
    		'X-Mailer: PHP/' . phpversion();

    $Search_Terms = array('%extension%', '%filename%', '%message%', '%line%', '%type%');
    $Replace_Terms = array($Error_Extension, $errfile, $errmsg, $errline, $Error_Plain_Text);

    $Message_Body = str_replace($Search_Terms, $Replace_Terms, $Message_Body);
    $Email_Subject = str_replace($Search_Terms, $Replace_Terms, $Email_Subject);

    $mail_success = wp_mail($Admin_Email, $Email_Subject, $Message_Body, $headers);
}

function EWD_WEP_Send_Developer_Email($Error_Extension, $errfile, $errmsg, $errline, $errtype) {
	if (get_option("ewd-wep-" . $Error_Extension . "-email") == "") {return;}

	$Developer_Email = get_option("ewd-wep-" . $Error_Extension . "-email");
	$Developer_Errors = get_option("ewd-wep-" . $Error_Extension . "-errors");
	if (!is_array($Developer_Errors)) {$Developer_Errors = array(E_ERROR, E_WARNING);}

	foreach ($Developer_Errors as $key => $Error) {
		$Developer_Errors[$key] = constant($Error);
	}

	if (!in_array($errtype, $Developer_Errors)) {return;}

	$Admin_Email = get_option('admin_email');

	$Error_Plain_Text = EWD_WEP_Error_Type_To_Text($errtype);

	$headers = 'From: ' . $Admin_Email . "\r\n" .
    		'Reply-To: ' . $Admin_Email . "\r\n" .
    		'X-Mailer: PHP/' . phpversion();

	$Email_Subject = "Error in " . $errfile;
	
	$Message_Body =  __("Hello from ", 'EWD_WEP').get_bloginfo('name')."\n\n";
	$Message_Body .= __("An error appears to have occurred in your plugin:", 'EWD_WEP')."\n\n";
	$Message_Body .= __("File:", 'EWD_WEP') . " " . $errfile . "\n";
	$Message_Body .= __("Line:", 'EWD_WEP') . " " . $errline . "\n";
	$Message_Body .= __("Message:", 'EWD_WEP') . " " . $errmsg . "\n";
	$Message_Body .= __("Error Type:", 'EWD_WEP') . " " . $Error_Plain_Text . "\n\n";
	$Message_Body .= __("This is an automatically generated email, which was sent to you because your email was listed as the recipient for errors for this plugin in the WP options table.", 'EWD_WEP');

	$mail_success = wp_mail($Developer_Email, $Email_Subject, $Message_Body, $headers);
}

function EWD_WEP_Error_Type_To_Text($errtype) {
	switch ($errtype) {
		case 1:
			$Error = "Fatal Error";
			break;
		case 2:
			$Error = "Warning";
			break;
		case 4:
			$Error = "Parse Error";
			break;
		case 8:
			$Error = "Notice";
			break;
		case 16:
			$Error = "Core Error";
			break;
		case 32:
			$Error = "Core Warning";
			break;
		case 64:
			$Error = "Compile Error";
			break;
		case 128:
			$Error = "Compile Warning";
			break;
		case 256:
			$Error = "User-generated Error";
			break;
		case 512:
			$Error = "User-generated Warning";
			break;
		case 1024:
			$Error = "User-generated Notice";
			break;
		case 2048:
			$Error = "Strict";
			break;
		case 4096:
			$Error = "Recoverable Error";
			break;
		case 8192:
			$Error = "Deprecated";
			break;
		case 16384:
			$Error = "User-generated Deprecated";
			break;
		case 32767:
			$Error = "All Errors";
			break;
		default:
			$Error = "Unknown";
			break;
	}
}

?>