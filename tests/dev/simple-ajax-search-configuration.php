<?php
/**
 * This file have basic functions only to DEV
 * when 'composer install' is run and there are vendor folder
 *
 * @link       https://pablocianes.com
 * @since      1.0.0
 *
 * @package    Simple_Ajax_Search
 * @subpackage Simple_Ajax_Search/tests/dev
 */

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

/**
 * Setup the Whoops container.
 * Whoops is an error handler framework for PHP. Out-of-the-box,
 * it provides a pretty error interface that helps you debug your web projects,
 * but at heart it's a simple yet powerful stacked error handling system.
 *
 * @since 1.0.0
 *
 * @return void
 */
function plugin_name_setup_whoops() {
	$whoops     = new Run();
	$error_page = new PrettyPageHandler();

	$error_page->setEditor( 'sublime' );
	$whoops->pushHandler( $error_page );
	$whoops->register();
}

plugin_name_setup_whoops();

add_action( 'admin_notices', 'plugin_name_custom_admin_notices', 999 );
/**
 * Custom notices for help to DEV in dashboard page
 * as summary of options to work with all features
 * already includes into the plugin
 *
 * @since       1.0.0
 */
function plugin_name_custom_admin_notices() {

	global $pagenow;

	if ( ! ( 'index.php' === $pagenow ) ) {
		return;
	}

	$current_user = wp_get_current_user();

	printf( '<div data-dismissible="notice-escritorio-forever" class="notice notice-info is-dismissible">
			  <p>¡Hello %s! You are in <code>DEV MODE</code> because of run "composer install" in your console. Now you have some features to improve your dev about this plugin: </p>
			  <ul>
				  <li>- Pretty error interface with <code>Whoops</code>. To see it in action just make a fatal error. ;-)</li>
				  <li>- <code>Kint</code> debugging helper. Inside your code insted of use var_dump($variable);</code> try to use <code>d( $variable );</code> for amazing debug.</li>
				  <li>- Type <code>into the console</code> base in the root of the project if you already run "npm install" & "composer install":</li>
					<ol>
						<li><code>gulp</code> to start test mode in console and run all the test into tests folder in auto mode when a file of the project is save it.</li>
						<li><code>grunt</code> to make auto the simple-ajax-search.pot into the languages folder, and <code>grunt watch</code> to make min files of CSS & JS. -->Stop with: <code>Ctrl + C</code></li>
						<li>PHP CodeSniffer with WordPress standards. To configure it set <code>vendor/bin/phpcs --config-set installed_paths vendor/wp-coding-standards/wpcs.</code>
						And also set <code>vendor/bin/phpcs --config-set default_standard WordPress</code> --> More info into https://github.com/PCianes/WordPress-Plugin-Boilerplate</li>
						<li><code>php make class CLASS-NAME FOLDER-NAME</code> to create a new file into the FOLDER-NAME indicate with the name: class-simple-ajax-search-CLASS-NAME.php with some base code to start to work.</li>
						<li><code>php make zip</code> to make a clean copy of the plugin into zip without all vendors and dev files.</li>
					</ol>
					<li>Note: the features of "make zip & make class" always run also in clean dev copy without composer install.</li>
			  </ul>
             </div>', esc_html( $current_user->display_name ) );
}

/**
 * Admin functions to change the look of the admin bar when this plugin
 * is activated, i.e. to differentiate that we are in development mode.
 *
 * @since       1.0.0
 */
add_action( 'admin_bar_menu', 'plugin_name_add_admin_bar_notice', 9999 );
/**
 * Add an admin bar notice to alert user that they are in local development
 * and this plugin is activated.
 *
 * @since 1.0.0
 *
 * @return void
 */
function plugin_name_add_admin_bar_notice() {
	if ( ! is_admin_bar_showing() ) {
		return;
	}
	global $wp_admin_bar;

	$message = plugin_name_get_admin_bar_config( 'message' );

	$admin_notice = array(
		'parent' => 'top-secondary',
		'id'     => 'environment-notice',
		'title'  => sprintf( '<span class="adminbar--environment-notice">%s</span>', $message ),
	);

	$wp_admin_bar->add_menu( $admin_notice );
}

add_action( 'admin_head', 'plugin_name_render_admin_bar_css', 9999 );
add_action( 'wp_head', 'plugin_name_render_admin_bar_css', 9999 );
/**
 * Render the admin bar CSS.
 *
 * @since 1.0.0
 *
 * @return void
 */
function plugin_name_render_admin_bar_css() {
	if ( ! is_admin_bar_showing() ) {
		return;
	}

	ob_start();

	include 'simple-ajax-search-bar-dev.php';

	$css_pattern = ob_get_clean();

	vprintf( $css_pattern, plugin_name_get_admin_bar_config( 'colors' ) );
}

/**
 * Get the admin bar's runtime configuration parameter(s).
 *
 * @since 1.0.0
 *
 * @param string $parameter Valid to know what data to return.
 *
 * @return array|mixed
 */
function plugin_name_get_admin_bar_config( $parameter = '' ) {
	static $config = array();

	if ( ! $config ) {
		$config = array(
			'message' => 'DEV MODE',
			'colors'  => array(
				'admin_bar_background_color' => '#29AAE3',
				'message_background_color'   => '#F8931F',
				'message_hover_color'        => '#1b202d',
			),
		);
	}

	if ( $parameter && isset( $config[ $parameter ] ) ) {
		return $config[ $parameter ];
	}

	return $config;
}
