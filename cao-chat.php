<?php
/**
 * Plugin Name: Contact At Once! Chat
 * Plugin URI: http://contactatonce.com
 * Description: Active Contact At Once! subscribers can easily add their chat and text options to WP sites with this simple plugin.
 * Version: 1.0.1
 * Author: Contact At Once!
 * Author URI: http://contactatonce.com
 * License: GPL
 */

// Define constants
define('WTH_COMPANY_NAME', 'Contact At Once!');

include( plugin_dir_path( __FILE__ ) . 'inc/functions.php' );

register_activation_hook( __FILE__, 'activate_cao' );
register_deactivation_hook(__FILE__, 'deactivate_cao');

// For admin side
if ( is_admin() ) {
	add_action( 'admin_init', 'cao_admin_init');
	add_action( 'admin_menu', 'cao_menu_settings');
	add_action( 'admin_enqueue_scripts', 'admin_cao_scripts_n_styles' );
}

// For user side
if ( !is_admin() ) {
	add_action( 'wp_footer', 'display_cao' );
	add_action( 'wp_enqueue_scripts', 'cao_scripts_n_styles' );
}