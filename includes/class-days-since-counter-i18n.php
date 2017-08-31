<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/gothick/wp-days-since-counter-plugin
 * @since      1.0.0
 *
 * @package    Days_Since_Counter
 * @subpackage Days_Since_Counter/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Days_Since_Counter
 * @subpackage Days_Since_Counter/includes
 * @author     Matt Gibson <gothick@gothick.org.uk>
 */
class Days_Since_Counter_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'days-since-counter',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
