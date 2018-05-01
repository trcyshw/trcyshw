<?php
/**
 * Jquery and JS
 *
 * @package WordPress
 */

/**
 * Register Scripts
 */
function goop_scripts() {
	/* Styles */
	wp_enqueue_style( 'style', get_stylesheet_uri(), null, null, 'all' );
	//wp_enqueue_style( 'print', get_template_directory_uri() . '/assets/css/print.css', null, null, 'print' );

	wp_register_script( 'icons', 'https://use.fontawesome.com/482af11763.js', false, null, true );
	wp_enqueue_script( 'icons' );

	/* jQuery */
	wp_deregister_script( 'jquery' );
	//wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', null, null, true );
	wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, null, true );
	wp_enqueue_script( 'jquery' );

	// /* Webfonts */
	// wp_register_script( 'webfontloader', 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js', null, null, true ); .
	// wp_enqueue_script( 'webfontloader' ); .

	/* Load our concatenated, minified JavaScript */
	wp_register_script( 'Package', get_stylesheet_directory_uri() . '/assets/js/package.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'Package' );
}

/**
 * Hook into the 'wp_enqueue_scripts' action
 */
add_action( 'wp_enqueue_scripts', 'goop_scripts' );

//function prefix_add_footer_styles() {
//    wp_enqueue_style( 'style', get_stylesheet_uri(), null, null, 'all' );
//};
//add_action( 'get_footer', 'prefix_add_footer_styles' );


/**
 * Remove Emojis
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
add_filter( 'emoji_svg_url', '__return_false' );

/**
 * Remove WordPress gallery shortcode inline styles
 */
add_filter( 'use_default_gallery_style', '__return_false' );
