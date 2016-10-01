<?php
/*
Plugin Name: Clean Up Shortcodes
Plugin URI: http://codementor.io/davidbrumbaugh
Description: Remove unused (orphan) shortcode tags from posts.
Author: David Brumbaugh
Version: 1.0
Text Domain: cleanup-shortcodes
Author URI: http://codementor.io/davidbrumbaugh
*/

// Setup Admin Page - Goes on the Tools Menu

define( 'CLEAN_SHORTCODE_DIR', plugin_dir_path( __FILE__ ) );
define( 'CLEAN_SHORTCODE_URL', plugin_dir_url( __FILE__ ) );

require_once( CLEAN_SHORTCODE_DIR. 'include/functions.php' );

add_action( 'admin_menu', 'cleanup_shortcodes_menu' );


function cleanup_shortcodes_menu() {
	add_management_page( 'Clean Shortcodes', 'Clean Shortcodes', 'edit_posts', 'cleanup-shortcodes', 'cleanup_shortcodes_page' );
}
