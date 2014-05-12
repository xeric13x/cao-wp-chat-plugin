<?php
/**
 * Plugin Name: Contact At Once! Chat
 * Plugin URI: http://contactatonce.com
 * Description: Simple plugin to add Contact At Once! chat to your website.
 * Version: 0.1
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
}

// For user side
if ( !is_admin() ) {
	add_action( 'wp_footer', 'display_cao' );
}