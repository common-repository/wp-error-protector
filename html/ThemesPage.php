<?php 
	$Switch_Themes = get_option("EWD_WEP_Switch_Themes");
	$Replacement_Theme_Stylesheet = get_option("EWD_WEP_Stylesheet");
	$All_Themes = wp_get_themes();
?>

<div id="col-right">
<div class="col-wrap">

<br class="clear" />
</div>
</div>

<div id="col-left">
<div class="col-wrap">

<h2><?php _e("Theme Switch", 'EWD_WEP'); ?></h2>

<form action='admin.php?page=EWD-WEP-options&DisplayPage=Themes&Action=EWD_WEP_Update_Theme_Settings' method='post'>
<table class="form-table">
<tr>
<th scope="row">Switch Themes</th>
<td>
    <fieldset><legend class="screen-reader-text"><span>Switch Themes</span></legend>
        <label title='Yes'><input type='checkbox' name='switch_themes' value='Yes' <?php if($Switch_Themes == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'EWD_WEP'); ?></span></label><br />
        <label title='No'><input type='checkbox' name='switch_themes' value='No'  <?php if($Switch_Themes == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'EWD_WEP'); ?></span></label><br />
        <p>If an error occurs in your selected theme, should your site be switched to the replacment theme selected below?</p>
    </fieldset>
</td>
</tr>
<tr>
<th scope="row">Replacement Theme</th>
<td>
    <fieldset><legend class="screen-reader-text"><span>Replacement Theme</span></legend>
    	<select name='stylesheet'>
        	<?php foreach ($All_Themes as $Theme) { ?>
       				<option value='<?php echo $Theme->get_stylesheet(); ?>' <?php if($Theme->get_stylesheet() == $Replacement_Theme_Stylesheet) {echo "selected='selected'";} ?> ><?php echo $Theme->name; ?></option>
        	<?php } ?>
        </select>
        <p>Should any plugins not be deactivated, even if they're causing errors? Select any plugins you don't want deactivated under any circumstances.</p>
    </fieldset>
</td>
</tr>
</table>
<p class="submit"><input type="submit" name="Plugins_Submit" id="submit" class="button button-primary" value="Save Changes"  /></p></form>

</form>

</div>
</div>