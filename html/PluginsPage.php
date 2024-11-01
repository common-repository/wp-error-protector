<?php 
	if (!function_exists( 'get_plugins')) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}
	$Excluded_Plugins = get_option("EWD_WEP_Excluded_Plugins");
	if (!is_array($Excluded_Plugins)) {$Excluded_Plugins = array();}
  $Plugin_Error_Stats = get_option("EWD_WEP_Plugin_Error_Stats");
  if (!is_array($Plugin_Error_Stats)) {$Plugin_Error_Stats = array();}
	$All_Plugins = get_plugins();
?>

<div id="col-right">
<div class="col-wrap">

<br class="clear" />
</div>
</div>

<div id="col-left">
<div class="col-wrap">

<h2><?php _e("Exclude Plugins", 'EWD_WEP'); ?></h2>

<form action='admin.php?page=EWD-WEP-options&DisplayPage=Plugins&Action=EWD_WEP_Update_Excluded_Plugins' method='post'>
<table class="form-table">
<tr>
<th scope="row">Exclude Plugins</th>
<td>
    <fieldset><legend class="screen-reader-text"><span>Selected Errors</span></legend>
        <?php foreach ($All_Plugins as $Path => $Plugin) { ?>
       		<label title='<?php echo $Plugin['Name']; ?>'>
       			<input type='checkbox' name='excluded_plugins[]' value='<?php echo $Path; ?>' <?php if(in_array($Path, $Excluded_Plugins)) {echo "checked='checked'";} ?> />
       			<span>
              <?php echo $Plugin['Name']; ?>
              <?php if ($Plugin_Error_Stats[$Path] > 0) {echo " (" . $Plugin_Error_Stats[$Path] . ")";} ?>
            </span>
       		</label><br />
        <?php } ?>
        <p>Should any plugins not be deactivated, even if they're causing errors? Select any plugins you don't want deactivated under any circumstances.</p>
    </fieldset>
</td>
</tr>
</table>
<p class="submit"><input type="submit" name="Plugins_Submit" id="submit" class="button button-primary" value="Save Changes"  /></p></form>

</form>

</div>
</div>