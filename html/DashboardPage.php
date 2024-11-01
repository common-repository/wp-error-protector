<?php 
	$Selected_Errors = get_option("EWD_WEP_Selected_Errors"); 
	if (!is_array($Selected_Errors)) {$Selected_Errors = array();}
?>

<div id="side-sortables" class="metabox-holder ">
<div id="upcp-support" class="postbox " >
	<div class="handlediv" title="Click to toggle"></div><h3 class='hndle'><span><?php _e("Support Options:", 'EWD_WEP') ?></span></h3>
	<div class="inside">
		<ul>
			<li><a href='https://www.youtube.com/channel/UCZPuaoetCJB1vZOmpnMxJNw/feed'>Our YouTube channel with getting started and plugin feature tutorials.</a></li>
			<!--<li><a href='http://www.etoilewebdesign.com/ultimate-product-catalogue-faq/'>Plugin in-depth FAQ page.</a></li> -->
			<li><a href='https://wordpress.org/support/plugin/wp-error-protector'>WordPress support forum.</a></li>
			<!--<li><a href='http://www.etoilewebdesign.com/wp-content/uploads/2015/07/EWD_WEP-Document.pdf'>PDF of the plugin documentation.</a></li>-->
		</ul>
	</div>
</div>
</div>

<div id="col-right">
<div class="col-wrap">

<br class="clear" />
</div>
</div>

<div id="col-left">
<div class="col-wrap">

<h2><?php _e("Error Types", 'EWD_WEP'); ?></h2>

<form action='admin.php?page=EWD-WEP-options&Action=EWD_WEP_UpdateErrors' method='post'>
<table class="form-table">
<tr>
<th scope="row">Selected Errors</th>
<td>
    <fieldset><legend class="screen-reader-text"><span>Selected Errors</span></legend>
        <label title='Errors'><input type='checkbox' name='selected_errors[]' value='E_ERROR' <?php if(in_array("E_ERROR", $Selected_Errors)) {echo "checked='checked'";} ?> /> <span><?php _e("Fatal Errors", 'EWD_WEP'); ?></span></label><br />
        <label title='Warnings'><input type='checkbox' name='selected_errors[]' value='E_WARNING'  <?php if(in_array("E_WARNING", $Selected_Errors)) {echo "checked='checked'";} ?> /> <span><?php _e("Warnings", 'EWD_WEP'); ?></span></label><br />
        <label title='Notices'><input type='checkbox' name='selected_errors[]' value='E_NOTICE' <?php if(in_array("E_NOTICE", $Selected_Errors)) {echo "checked='checked'";} ?>  /> <span><?php _e("Notices", 'EWD_WEP'); ?></span></label><br />
        <p>Depending on your server settings, we recommend disabling all plugins/themes that cause fatal errors, which can make both the front-end and admin panel of your site inaccessible.</p>
        <p>Warnings may also cause unexpected behaviour, so consider enabling protection against those as well.</p>
        <p>Notices are rarely harmful, so we would discourage enabling protection for them.</p>
    </fieldset>
</td>
</tr>
</table>
<p class="submit"><input type="submit" name="Errors_Submit" id="submit" class="button button-primary" value="Save Changes"  /></p></form>

</form>

</div>
</div>
