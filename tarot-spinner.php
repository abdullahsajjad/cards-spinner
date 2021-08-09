<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @wordpress-plugin
 * Plugin Name:       Tarot Spinner
 * Description:       Tarot Spinner Animation.
 * Version:           1.0.0
 * Author:            Abdullah Sajjad
 * Author URI:        https://github.com/abdullahsajjjad
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tarot-spinner
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'TS_VERSION', '1.0.0' );
define( 'TS_PATH', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tarot-spinner-activator.php
 */
function activate_tarot_spinner() {
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tarot-spinner-deactivator.php
 */
function deactivate_tarot_spinner() {

}

register_activation_hook( __FILE__, 'activate_tarot_spinner' );
register_deactivation_hook( __FILE__, 'deactivate_tarot_spinner' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tarot-spinner.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tarot_spinner() {

	$plugin = new Tarot_Spinner();
	$plugin->run();

}
run_tarot_spinner();
