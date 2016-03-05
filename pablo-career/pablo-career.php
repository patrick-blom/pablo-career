<?php

/**
 * The plugin bootstrap file
 * @package           PabloCareer
 *
 * @wordpress-plugin
 * Plugin Name:       Pablo Career
 * Plugin URI:        https://github.com/patrick-blom/pablo-career
 * Description:		  Manage your joboffers easy within wordpress
 * Version:           1.0.1
 * Author:            Patrick Blom
 * Author URI:        https://github.com/patrick-blom/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pablo-career
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Setup composer autoload
 */
require __DIR__.'/vendor/autoload.php';

/**
 * crapy but atm the only way to prevent redeclaration
 */
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * The code that runs during plugin activation.
 */
function activatePabloCareer() {
	PabloCareer\Plugin\Setup\Activator::activate();
}
register_activation_hook( __FILE__, 'activatePabloCareer' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 */
function runPabloCareer() {

	$plugin = new \PabloCareer\Plugin\PabloCareer();
	$plugin->init();
	$plugin->run();

}

runPabloCareer();
