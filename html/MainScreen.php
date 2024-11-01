<div class="EWD_OTP_Menu">
	<h2 class="nav-tab-wrapper">
		<a id="Dashboard_Menu" class="MenuTab nav-tab <?php if ($Display_Page == '' or $Display_Page == 'Dashboard') {echo 'nav-tab-active';}?>" onclick="ShowTab('Dashboard');"><?php _e("Dashboard", "EWD_OTP"); ?></a>
		<a id="Plugins_Menu" class="MenuTab nav-tab <?php if ($Display_Page == 'Plugins') {echo 'nav-tab-active';}?>" onclick="ShowTab('Plugins');"><?php _e("Plugins", "EWD_OTP"); ?></a>
		<a id="Themes_Menu" class="MenuTab nav-tab <?php if ($Display_Page == 'Themes') {echo 'nav-tab-active';}?>" onclick="ShowTab('Themes');"><?php _e("Themes", "EWD_OTP"); ?></a>
		<a id="Emails_Menu" class="MenuTab nav-tab <?php if ($Display_Page == 'Emails') {echo 'nav-tab-active';}?>" onclick="ShowTab('Emails');"><?php _e("Emails", "EWD_OTP"); ?></a>
		<a id="Options_Menu" class="MenuTab nav-tab <?php if ($Display_Page == 'Options') {echo 'nav-tab-active';}?>" onclick="ShowTab('Options');"><?php _e("Options", "EWD_OTP"); ?></a>
	</h2>
</div>

<div class="clear"></div>

<!-- Add the individual pages to the admin area, and create the active tab based on the selected page -->
<div class="OptionTab <?php if ($Display_Page == "" or $Display_Page == 'Dashboard') {echo 'ActiveTab';} else {echo 'HiddenTab';} ?>" id="Dashboard">
	<?php include( plugin_dir_path( __FILE__ ) . 'DashboardPage.php'); ?>
</div>

<div class="OptionTab <?php if ($Display_Page == 'Plugins' or $Display_Page == 'Plugin') {echo 'ActiveTab';} else {echo 'HiddenTab';} ?>" id="Plugins">
	<?php include( plugin_dir_path( __FILE__ ) . 'PluginsPage.php'); ?>
</div>	

<div class="OptionTab <?php if ($Display_Page == 'Themes'or $Display_Page == 'Theme') {echo 'ActiveTab';} else {echo 'HiddenTab';} ?>" id="Themes">
	<?php include( plugin_dir_path( __FILE__ ) . 'ThemesPage.php'); ?>
</div>	

<div class="OptionTab <?php if ($Display_Page == 'Emails'or $Display_Page == 'Email') {echo 'ActiveTab';} else {echo 'HiddenTab';} ?>" id="Emails">
	<?php include( plugin_dir_path( __FILE__ ) . 'EmailsPage.php'); ?>
</div>
<div class="OptionTab <?php if ($Display_Page == 'Options' or $Display_Page == 'Option') {echo 'ActiveTab';} else {echo 'HiddenTab';} ?>" id="Options">
	<?php include( plugin_dir_path( __FILE__ ) . 'OptionsPage.php'); ?>
</div>		