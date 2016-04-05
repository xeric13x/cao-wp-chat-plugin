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

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define constants
define( 'CAO_CHAT_COMPANY_NAME', 'Contact At Once!' );
define( 'CAO_CHAT_PLUGIN_DIR', ABSPATH . 'wp-content/plugins/cao-wp-chat-plugin/');
define( 'CAO_CHAT_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'CAO_CHAT_OPTION_NAME', 'cao_chat');
define( 'CAO_CHAT_OPTION_NAMES', serialize( array(
	'mid' => 'cao_merchant_id',
	'pid' => 'cao_provider_id',
	'display_icon' => 'cao_display_icon',
	'placement_id' => 'cao_placement_id',
	'has_dropin' => 'cao_has_dropin',
	'has_mtc' => 'cao_has_mtc',
	'has_social_media_bar' => 'cao_has_social_media_bar'
) ) );


include( CAO_CHAT_PLUGIN_DIR . 'inc/functions.php' );

register_activation_hook( __FILE__, 'activate_cao' );
register_deactivation_hook( __FILE__, 'deactivate_cao');

// For admin side
if ( is_admin() ) {
	add_action( 'admin_init', 'cao_admin_init');
	add_action( 'admin_menu', 'cao_menu_settings');
	add_action( 'admin_enqueue_scripts', 'admin_cao_scripts_n_styles' );
	//add_action( 'admin_init', 'fn_tester' );
}

// For user side
if ( !is_admin() ) {
	add_action( 'wp_footer', 'display_cao' );
	add_action( 'wp_enqueue_scripts', 'cao_scripts_n_styles' );
}