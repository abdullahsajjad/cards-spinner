<?php

/**
 * Fired during plugin activation
 *
 * @link       //github.com/abdullah-sajjad/tarot-spinner
 * @since      1.1.0
 *
 * @package    Tarot_Spinner
 * @subpackage Tarot_Spinner/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.1.0
 * @package    Tarot_Spinner
 * @subpackage Tarot_Spinner/includes
 * @author     Abdullah <abdullahsajjad33@gmail.com>
 */
class Tarot_Spinner_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since  1.1.0
	 */
	public static function activate() {
		Tarot_Spinner_Activator::add_default_tags();
	}

	/**
	 * Sets Default Tags
	 *
	 * @access protected
	 * @since  1.1.0
	 */
	protected static function add_default_tags() {
		// email options
		$ts_tags = get_option( 'tarot_tag' );

		$ts_defaults = [
			TS_URL . 'assets/sample-card.jpeg',
			TS_URL . 'assets/sample-card-1.jpeg',
			TS_URL . 'assets/sample-card-2.jpeg',
			TS_URL . 'assets/sample-card-3.jpeg',
			TS_URL . 'assets/sample-card-4.jpeg',
			TS_URL . 'assets/sample-card-5.jpeg',
			TS_URL . 'assets/sample-card-6.jpeg',
			TS_URL . 'assets/sample-card-7.jpeg',
			TS_URL . 'assets/sample-card-8.jpeg',
			TS_URL . 'assets/sample-card-9.jpeg',
			TS_URL . 'assets/sample-card-10.jpeg',
		];

		self::ts_save_default_options( $ts_tags, $ts_defaults, 'tarot_tags' );

	}

	/**
	 * Save default options in options
	 *
	 * checks for the existing options if not set then
	 * add the default value's in options table
	 *
	 * @param $ts_settings      array   db options array
	 * @param $default_settings array   default options array
	 * @param $option           string  option name
	 *
	 * @since 1.1.0
	 */
	protected static function ts_save_default_options( $ts_settings, $default_settings, $option ) {
		if ( $ts_settings !== false ) {
			return;
		}

		update_option( $option, $default_settings );
	}

}