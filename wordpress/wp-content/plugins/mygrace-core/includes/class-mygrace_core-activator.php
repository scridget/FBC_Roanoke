<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.mygrace.io/
 * @since      1.0.0
 *
 * @package    Mygrace_Core
 * @subpackage Mygrace_Core/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Mygrace_core
 * @subpackage Mygrace_core/includes
 */
class Mygrace_Core_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		/*MygracePostTypesRegister::getInstance()->register();
		flush_rewrite_rules();*/
	}

}
