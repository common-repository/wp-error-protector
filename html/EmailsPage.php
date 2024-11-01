<?php 
	$Admin_Email = get_option("EWD_WEP_Error_Admin_Email");
	$Email_Subject = get_option("EWD_WEP_Error_Email_Subject");
	$Message_Body = get_option("EWD_WEP_Error_Message_Body");

?>

<div id="col-right">
<div class="col-wrap">

<br class="clear" />
</div>
</div>

<div id="col-left">
<div class="col-wrap">
<h2><?php _e("Email Options", 'EWD_WEP'); ?></h2>
<form method="post" action="admin.php?page=EWD-WEP-options&DisplayPage=Email&Action=EWD_WEP_UpdateEmailOptions">

<div class="form-field">
	<fieldset><legend class="screen-reader-text"><span>Admin Email</span></legend>
		<label title='Admin Email'>Admin Email</label><input type='text' name='error_admin_email' value='<?php echo $Admin_Email; ?>' /><br />
		<p>The address to send error notifications to. Leave blank to have the emails sent to the default admin email set in the "Settings" WordPress menu.</p>
	</fieldset>
</div>

<div class="form-field">
	<fieldset><legend class="screen-reader-text"><span>Email Subject</span></legend>
		<label title='Email Subject'>Email Subject</label><input type='text' name='error_email_subject' value='<?php echo $Email_Subject; ?>' /><br />
		<p>The subject line of the email sent to the admin when an error occurs, if that option is selected.<br />
		You can use %filename%, %message%, %line%, %type% or %extension% to display the filename, error message, error line, error type or the theme/plugin causing the error respectively.</p>
	</fieldset>
</div>

<div class="form-field">
	<fieldset><legend class="screen-reader-text"><span>Error Message Body</span></legend>
		<label title='Error Message Body'>Error Message Body</label><textarea class='ewd-wep-textarea' name='error_message_body'> <?php echo $Message_Body; ?></textarea><br />
		<p>The body of the email sent to the admin when an error occurs, if that option is selected.<br />
		You can use %filename%, %message%, %line%, %type% or %extension% to display the filename, error message, error line, error type or the theme/plugin causing the error respectively.</p>
	</fieldset>
</div>

<p class="submit"><input type="submit" name="Options_Submit" id="submit" class="button button-primary" value="Save Changes"  /></p>
</form>
</div>
</div>