<?php
/*
Plugin Name: WP Error Protector
Plugin URI: http://www.EtoileWebDesign.com/plugins/
Description: A plugin automatically deactivates plugins or switches themes which cause specified PHP errors
Author: Etoile Web Design
Author URI: http://www.EtoileWebDesign.com/
Terms and Conditions: http://www.etoilewebdesign.com/plugin-terms-and-conditions/
Text Domain: EWD_WEP
Version: 0.1
*/

global $ewd_wep_message;
global $EWD_WEP_Full_Version;
global $EWD_WEP_db_version;

$EWD_WEP_db_version = "0.2";
//$wpdb->show_errors();

define( 'EWD_WEP_CD_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'EWD_WEP_CD_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

//define('WP_DEBUG', true);

register_activation_hook(__FILE__,'Install_EWD_WEP');

/* Hooks neccessary admin tasks */
if ( is_admin() ){
		add_action('widgets_init', 'Update_EWD_WEP_Content');
		add_action('admin_head', 'EWD_WEP_Admin_Styles');
		add_action('admin_init', 'Add_EWD_WEP_Scripts');
		add_action('widgets_init', 'Update_EWD_WEP_Content');
		add_action('admin_notices', 'EWD_WEP_Error_Notices');
}

function EWD_WEP_Enable_Menu() {
	$Access_Role = get_option("EWD_WEP_Access_Role");
	if ($Access_Role == "") {$Access_Role = "administrator";}

	add_menu_page('WP Error Protector', 'WP Errors', $Access_Role, 'EWD-WEP-options', 'EWD_WEP_Output_Options', null , '50.9');
	add_submenu_page('EWD-WEP-options', 'WEP Plugins', 'Plugins', $Access_Role, 'EWD-WEP-options&DisplayPage=Plugins', 'EWD_WEP_Output_Options');
	add_submenu_page('EWD-WEP-options', 'WEP Themes', 'Themes', $Access_Role, 'EWD-WEP-options&DisplayPage=Themes', 'EWD_WEP_Output_Options');
	add_submenu_page('EWD-WEP-options', 'WEP Emails', 'Emails', $Access_Role, 'EWD-WEP-options&DisplayPage=Emails', 'EWD_WEP_Output_Options');
	add_submenu_page('EWD-WEP-options', 'WEP Options', 'Options', $Access_Role, 'EWD-WEP-options&DisplayPage=Options', 'EWD_WEP_Output_Options');
}
add_action('admin_menu' , 'EWD_WEP_Enable_Menu');

/* Add localization support */
function EWD_WEP_localization_setup() {
		load_plugin_textdomain('EWD_WEP', false, dirname(plugin_basename(__FILE__)) . '/lang/');
}
add_action('after_setup_theme', 'EWD_WEP_localization_setup');

// Add settings link on plugin page
function EWD_WEP_plugin_settings_link($links) {
  $settings_link = '<a href="admin.php?page=EWD-WEP-options">Settings</a>';
  array_unshift($links, $settings_link);
  return $links;
}
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'EWD_WEP_plugin_settings_link' );

function Add_EWD_WEP_Scripts() {
	if (isset($_GET['page']) && $_GET['page'] == 'EWD-WEP-options') {
		$url_one = plugins_url("wp-error-protector/js/Admin.js");

		wp_enqueue_script('PageSwitch', $url_one, array('jquery'));
	}
}

function EWD_WEP_Admin_Styles() {
	wp_enqueue_style( 'ewd-wep-admin', plugins_url("wp-error-protector/css/Admin.css"));
	wp_enqueue_style( 'spectrum', plugins_url("wp-error-protector/css/spectrum.css"));
}

/* add_action( 'wp_enqueue_scripts', 'Add_EWD_WEP_FrontEnd_Scripts' );
function Add_EWD_WEP_FrontEnd_Scripts() {
	wp_enqueue_script('ewd-wep-js', plugins_url( '/js/ewd-wep-js.js' , __FILE__ ), array( 'jquery' ));
} */


/*add_action( 'wp_enqueue_scripts', 'EWD_WEP_Add_Stylesheet' );
function EWD_WEP_Add_Stylesheet() {
    wp_register_style( 'ewd-wep-style', plugins_url('css/ewd-wep-styles.css', __FILE__) );
    wp_enqueue_style( 'ewd-wep-style' );
} */

add_action('activated_plugin','save_wep_error');
function save_wep_error(){
		update_option('plugin_error',  ob_get_contents());
		file_put_contents("Error.txt", ob_get_contents());
}

add_action("activated_plugin", "EWD_WEP_Ensure_Plugin_Is_First");
function EWD_WEP_Ensure_Plugin_Is_First() {
	// ensure path to this file is via main wp plugin path
	$wp_path_to_this_file = preg_replace('/(.*)plugins\/(.*)$/', WP_PLUGIN_DIR."/$2", __FILE__);
	$this_plugin = plugin_basename(trim($wp_path_to_this_file));
	$active_plugins = get_option('active_plugins');
	$this_plugin_key = array_search($this_plugin, $active_plugins);
	if ($this_plugin_key) { // if it's 0 it's the first plugin already, no need to continue
		array_splice($active_plugins, $this_plugin_key, 1);
		array_unshift($active_plugins, $this_plugin);
		update_option('active_plugins', $active_plugins);
	}
}

$EWD_WEP_Full_Version = get_option("EWD_WEP_Full_Version");

/*if (isset($_POST['Upgrade_To_Full'])) {
	  add_action('admin_init', 'Upgrade_To_Full');
}*/

include "Functions/EWD_WEP_Error_Notices.php";
include "Functions/EWD_WEP_Handle_Fatal_Errors.php";
include "Functions/EWD_WEP_Handle_Lesser_Errors.php";
include "Functions/EWD_WEP_Output_Options.php";
include "Functions/Install_EWD_WEP.php";
include "Functions/Prepare_EWD_WEP_Data_For_Insertion.php";
include "Functions/EWD_WEP_Process_Error_Handling.php";
include "Functions/Update_EWD_WEP_Admin_Databases.php";
include "Functions/Update_EWD_WEP_Content.php";
include "Functions/EWD_WEP_Styling.php";

// Updates the UASP database when required
if (get_option('EWD_WEP_DB_Version') != $EWD_WEP_db_version) {
	update_option("EWD_WEP_DB_Version", $EWD_WEP_db_version);
}
