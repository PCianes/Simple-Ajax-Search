<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also core all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://pablocianes.com
 * @since             1.0.0
 * @package           Simple_Ajax_Search
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Ajax Search
 * Plugin URI:        https://pablocianes.com
 * Description:       Easily create a dynamic ajax search engine for your content.
 * Version:           1.0.0
 * Author:            Pablo Cianes
 * Author URI:        https://pablocianes.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       simple-ajax-search
 * Domain Path:       /languages
 */

/*
Simple Ajax Search is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Simple Ajax Search is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Simple_Ajax_Search. If not, see http://www.gnu.org/licenses/gpl-2.0.txt.
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs only in dev mode
 * and we know that because of exists autolad.php into vendor folder
 * when it is set 'composer install' in console to dev this plugin
 */
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
	require_once __DIR__ . '/tests/dev/simple-ajax-search-configuration.php';
}

/**
 * The code that runs during plugin activation.
 * This action is documented in core/class-simple-ajax-search-activator.php
 */
function activate_simple_ajax_search() {
	require_once plugin_dir_path( __FILE__ ) . 'core/class-simple-ajax-search-activator.php';
	Simple_Ajax_Search_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in core/class-simple-ajax-search-deactivator.php
 */
function deactivate_simple_ajax_search() {
	require_once plugin_dir_path( __FILE__ ) . 'core/class-simple-ajax-search-deactivator.php';
	Simple_Ajax_Search_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_simple_ajax_search' );
register_deactivation_hook( __FILE__, 'deactivate_simple_ajax_search' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'core/class-simple-ajax-search.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_simple_ajax_search() {

	$plugin = new Simple_Ajax_Search();
	$plugin->run();

}
run_simple_ajax_search();
