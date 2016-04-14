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
    // Register the script
wp_register_script( 'script_handle', plugins_url('js/custom.js', __FILE__) );
// Localize the script with new data
$translation_array = array(
	'ajaxurl' => admin_url('admin-ajax.php')
);
wp_localize_script( 'script_handle', 'script_object', $translation_array );
wp_enqueue_script( 'script_handle' );
    
    
    
    

}

//This hook ensures our scripts and styles are only loaded in the admin.
add_action('wp_enqueue_scripts', 'last_visited_enqueue_scripts');

add_action( 'wp_ajax_last_visited_getpage', 'last_visited_getpage' );
add_action( 'wp_ajax_nopriv_last_visited_getpage', 'last_visited_getpage' );

function last_visited_getpage() {
	$req = $_POST['data'];
//        echo '<pre>';print_r($req);echo '</pre>';
//	$arr = explode("&",$req);
//	$vote = $arr[0];
//	$userid = $arr[1].":".$vote;
//	$productid = $arr[2];
//	$count = 0;
        $page = get_page_by_path($req['slug']);
$title = get_the_title($page->ID);
	echo $title; die();
}
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
