<?php
/**
 * Plugin Name: One Icon for WP
 * Description: A plugin for icons all over WordPress and WooCommerce
 * Version:     1.2.1
 * Author:      Cross Media Cloud
 * Author URI:  https://www.cross-media-cloud.de
 * License:     GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: one-icon-for-wp
 * Domain Path: /languages/
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load plugin text domain.
 *
 * @since 1.0.0
 */
function one_icon_for_wp_load_text_domain() {

	load_plugin_textdomain( 'one-icon-for-wp', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );

}
add_action( 'plugins_loaded', 'one_icon_for_wp_load_text_domain' );

/**
 * Function to run after plugin activation.
 *
 * @since 1.0.0
 */
function one_icon_for_wp_activate() {

	// Activation code here...

}
register_activation_hook( __FILE__, 'one_icon_for_wp_activate' );

/**
 * Function to run after plugin deactivation.
 *
 * @since 1.0.0
 */
function one_icon_for_wp_deactivate() {

	// Activation code here...

}
register_deactivation_hook( __FILE__, 'one_icon_for_wp_deactivate' );

/*
 * Load helpers
 */
require_once 'includes/icons.php';
require_once 'includes/public-helper.php';

/*
 * Load features
 */
// Blocks
require_once 'blocks/blocks.php';
// Shortcodes
require_once 'includes/shortcodes.php';

if ( ! is_admin() ) {
	return;
}

require_once 'admin/class-term-icon.php';
