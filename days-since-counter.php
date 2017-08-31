<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/gothick/wp-days-since-counter-plugin
 * @since             1.0.0
 * @package           Days_Since_Counter
 *
 * @wordpress-plugin
 * Plugin Name:       Days Since Counter
 * Plugin URI:        https://github.com/gothick/wp-days-since-counter-plugin
 * Description:       Adds meta boxes to the New/Edit Post page showing the count of days since a configurable date.
 * Version:           1.0.0
 * Author:            Matt Gibson
 * Author URI:        http://gothick.org.uk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       days-since-counter
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-days-since-counter-activator.php
 */
function activate_days_since_counter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-days-since-counter-activator.php';
	Days_Since_Counter_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-days-since-counter-deactivator.php
 */
function deactivate_days_since_counter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-days-since-counter-deactivator.php';
	Days_Since_Counter_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_days_since_counter' );
register_deactivation_hook( __FILE__, 'deactivate_days_since_counter' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-days-since-counter.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_days_since_counter() {

	$plugin = new Days_Since_Counter();
	$plugin->run();

}
run_days_since_counter();
