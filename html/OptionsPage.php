<?php 
	$Admin_Notification_Email = get_option("EWD_WEP_Admin_Notification_Email");
	$Developer_Notification_Email = get_option("EWD_WEP_Developer_Notification_Email");
	$Hide_PHP_Error = get_option("EWD_WEP_Hide_PHP_Error");
	$Error_Page_Header = get_option("EWD_WEP_Error_Page_Header");
	$Error_Page_Text = get_option("EWD_WEP_Error_Page_Text");
	$Link_To_Homepage = get_option("EWD_WEP_Link_To_Homepage");
	$Link_To_Homepage_Button = get_option("EWD_WEP_Link_To_Homepage_Button");
	$Background_Color = get_option("EWD_WEP_Background_Color");
	$Text_Color = get_option("EWD_WEP_Text_Color");

?>
<div class="wrap wep-options-page-tabbed">
	<div class="wep-options-submenu-div">
		<ul class="wep-options-submenu wep-options-page-tabbed-nav">
			<li><a id="Basic_Menu" class="MenuTab options-subnav-tab <?php if ($Display_Tab == '' or $Display_Tab == 'Basic') {echo 'options-subnav-tab-active';}?>" onclick="ShowOptionTab('Basic');">Basic</a></li>
			<li><a id="Premium_Menu" class="MenuTab options-subnav-tab <?php if ($Display_Tab == 'Premium') {echo 'options-subnav-tab-active';}?>" onclick="ShowOptionTab('Premium');">Premium</a></li>
		</ul>
	</div>


<div class="wep-options-page-tabbed-content">

<form method="post" action="admin.php?page=EWD-WEP-options&DisplayPage=Options&Action=EWD_WEP_UpdateOptions">
<div id='Basic' class='wep-option-set'>
<h2 id='label-basic-options' class='wep-options-page-tab-title'>Basic Options</h2>
<table class="form-table">
<tr>
	<th scope="row">Admin Notification Email on Error</th>
	<td>
		<fieldset><legend class="screen-reader-text"><span>Admin Notification Email on Error</span></legend>
			<label title='Yes'><input type='radio' name='admin_email_notification' value="Yes" <?php if($Admin_Notification_Email == "Yes") {echo "checked=checked";} ?>><span>Yes</span></label><br />
			<label title='No'><input type='radio' name='admin_email_notification' value="No" <?php if($Admin_Notification_Email == "No") {echo "checked=checked";} ?> ><span>No</span></label><br />
			<p>Should an email be sent to the site admin when an error occurs?</p>
		</fieldset>
	</td>
</tr>
<tr>
	<th scope="row">Developer Notification Email on Error</th>
	<td>
		<fieldset><legend class="screen-reader-text"><span>Developer Notification Email on Error</span></legend>
			<label title='Yes'><input type='radio' name='developer_notification_email' value="Yes" <?php if($Developer_Notification_Email == "Yes") {echo "checked=checked";} ?>><span>Yes</span></label><br />
			<label title='No'><input type='radio' name='developer_notification_email' value="No" <?php if($Developer_Notification_Email == "No") {echo "checked=checked";} ?> ><span>No</span></label><br />
			<p>Should an anonymous email with the error message and filename be sent to the plugin/theme developer when an error occurs?<br/ >
			This only works if a particular theme or plugin developer is using the option as well.</p>
		</fieldset>
	</td>
</tr>
<tr>
	<th scope="row">Hide PHP Error Message</th>
	<td>
		<fieldset><legend class="screen-reader-text"><span>Hide PHP Error Message</span></legend>
			<label title='Yes'><input type='radio' name='hide_php_error' value="Yes" <?php if($Hide_PHP_Error == "Yes") {echo "checked=checked";} ?>><span>Yes</span></label><br />
			<label title='No'><input type='radio' name='hide_php_error' value="No" <?php if($Hide_PHP_Error == "No") {echo "checked=checked";} ?> ><span>No</span></label><br />
			<p>Should the standard PHP error message be displayed at the top of the page when there's an error?</p>
		</fieldset>
	</td>
</tr>
<tr>
	<th scope="row">Error Page Header</th>
	<td>
		<fieldset><legend class="screen-reader-text"><span>Error Page Header</span></legend>
			<input type='text' name='error_page_header' value='<?php echo $Error_Page_Header; ?>' />
			<p>How much time should there be between scheduled appointments? (in minutes)<br />
			You can use %filename% or %extension% to display the filename or the theme/plugin causing the error respectively.</p>
		</fieldset>
	</td>
</tr>
<tr>
	<th scope="row">Error Page Text</th>
	<td>
		<fieldset><legend class="screen-reader-text"><span>Error Page Text</span></legend>
		<label title='Error Page Text'></label><textarea class='ewd-wep-textarea' name='error_page_text'> <?php echo $Error_Page_Text; ?></textarea><br />
		<p>The text displayed on the error page.<br />
		You can use %filename% or %extension% to display the filename or the theme/plugin causing the error respectively.</p>
		</fieldset>
	</td>
</tr>
<tr>
	<th scope="row">Link to Homepage</th>
	<td>
		<fieldset><legend class="screen-reader-text"><span>Link to Homepage</span></legend>
			<label title='Yes'><input type='radio' name='link_to_homepage' value="Yes" <?php if($Link_To_Homepage == "Yes") {echo "checked=checked";} ?>><span>Yes</span></label><br />
			<label title='No'><input type='radio' name='link_to_homepage' value="No" <?php if($Link_To_Homepage == "No") {echo "checked=checked";} ?> ><span>No</span></label><br />
			<p>Should a link to the homepage be added on the error page?</p>
		</fieldset>
	</td>
</tr>
<tr>
	<th scope="row">Link to Homepage Button</th>
	<td>
		<fieldset><legend class="screen-reader-text"><span>Link to Homepage Button</span></legend>
			<label title='Yes'><input type='radio' name='link_to_homepage_button' value="Yes" <?php if($Link_To_Homepage_Button == "Yes") {echo "checked=checked";} ?>><span>Yes</span></label><br />
			<label title='No'><input type='radio' name='link_to_homepage_button' value="No" <?php if($Link_To_Homepage_Button == "No") {echo "checked=checked";} ?> ><span>No</span></label><br />
			<p>If "Link to Homepage" is set to "Yes", should that link be shown as a button?</p>
		</fieldset>
	</td>
</tr>
<tr>
	<th scope="row">Background Color</th>
	<td class='ewd-wep-color-option-input'><input type='text' class='ewd-wep-spectrum' name='background_color' value='<?php echo $Background_Color; ?>' /></td>
</tr>
<tr>
	<th scope="row">Text Color</th>
	<td class='ewd-wep-color-option-input'><input type='text' class='ewd-wep-spectrum' name='text_color' value='<?php echo $Text_Color; ?>' /></td>
</tr>
</table>
</div>

<div id='Premium' class='wep-option-set wep-hidden'>
<h2 id='label-premium-options' class='wep-options-page-tab-title'>Premium Options</h2>
Coming soon!
<table class="form-table">
</table>
</div>

<p class="submit"><input type="submit" name="Options_Submit" id="submit" class="button button-primary" value="Save Changes"  /></p></form>
</div>
</div>
