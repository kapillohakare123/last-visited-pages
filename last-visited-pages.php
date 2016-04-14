<?php
defined('ABSPATH') or die('No script kiddies please!');
/**
 * Plugin Name: Last Visited Pages
 * Plugin URI: #
 * Description: This plugin adds a widget for showing last pages viewed by the user.
 * Version: 1.0
 * Author: Kapil Lohakare
 * License: GPL2
 */
// Add files for admin and frontend
include(plugin_dir_path(__FILE__) . '/widget-last-visited.php' );
// Add scripts
function last_visited_enqueue_scripts() {
    wp_enqueue_script("jquery");
    wp_enqueue_script('jquery.cookie', plugins_url('js/jquery.cookie.js', __FILE__));
    wp_enqueue_script('cookie-custom', plugins_url('js/custom.js', __FILE__));
}

//This hook ensures our scripts and styles are only loaded in the admin.
add_action('wp_enqueue_scripts', 'last_visited_enqueue_scripts');

/**
 * Flushes all Options
 *
 */
function last_visited_activation() {   
}
function last_visited_deactivation() {  
}
register_activation_hook(__FILE__, 'last_visited_activation');
register_deactivation_hook(__FILE__, 'last_visited_deactivation');
