<?php
/**
 * Plugin Name: 	Mygrace Core
 * Plugin URI:
 * Description: 	Core plugin for Zemez Themes.
 * Version: 		1.0.0
 * Author: 			Zemez
 * Author URI: 		https://zemez.io/
 * Text Domain: 	mygrace-core
 * License: 		GPL-2.0+
 * License URI: 	http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: 	/languages
 *
 * @package mygrace-pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mygrace_core-activator.php
 */
function activate_mygrace_core() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mygrace_core-activator.php';
	mygrace_core_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mygrace_core-deactivator.php
 */
function deactivate_mygrace_core() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mygrace_core-deactivator.php';
	mygrace_core_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mygrace_core' );
register_deactivation_hook( __FILE__, 'deactivate_mygrace_core' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mygrace_core.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mygrace_core() {

	$plugin = new mygrace_core();
	$plugin->run();

}
run_mygrace_core();
