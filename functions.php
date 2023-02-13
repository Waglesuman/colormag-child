<?php
/**
 * Enqueue the parent theme's style.css and the child theme's style.css.
 */
function colormag_child_enqueue_styles()
{
	$parent_style = 'colormag_style'; //parent theme style handle 'colormag_style'
	//Enqueue parent and chid theme style.css
	wp_enqueue_style($parent_style, get_template_directory_uri () . '/style.css');
	wp_enqueue_style(
		'colormag_child_style', get_stylesheet_directory_uri () . '/style.css',
		[$parent_style], wp_get_theme() -> get('Version')
	);
}
add_action('wp_enqueue_scripts', 'colormag_child_enqueue_styles');

/**
 * When WordPress is loading the scripts, load my custom script after jQuery.
 */
function enqueue_custom_scripts()
{
	wp_enqueue_script('cpmscript', get_stylesheet_directory_uri() . "/js/cpmscript.js",['jquery']);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


define( 'COLORMAG_CHILD_CPM_DIR', get_stylesheet_directory() );
define( 'COLORMAG_INCLUDES_FUNCTIONS_CPM', COLORMAG_CHILD_CPM_DIR . '/functions' );



require COLORMAG_CHILD_CPM_DIR . '/inc/customizerHeader.php'; // customizer
require COLORMAG_INCLUDES_FUNCTIONS_CPM . '/mediaCPM.php'; // media file handler
require COLORMAG_INCLUDES_FUNCTIONS_CPM . '/registerPostType.php'; // Register post type 
require COLORMAG_INCLUDES_FUNCTIONS_CPM . '/metaBoxCPM.php'; // Creating meta box and saving values as well
require COLORMAG_INCLUDES_FUNCTIONS_CPM . '/formShortCodeCPM.php'; // function to call 
require COLORMAG_INCLUDES_FUNCTIONS_CPM . '/shortCodeCPM.php'; // shortcode function to call