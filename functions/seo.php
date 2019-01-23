<?php
/**
 * Load all SEO-related functions and scripts.
 * Work in progress.
 *
 * @package WordPress
 */

/**
 * All the requirements.
 */
require 'seo/sitemap/sitemap.php';
require 'seo/wp-title.php';

/**
 * Load our stuff in wp_head.
 */
function ts_seo_into_wp_head() {
	require_once dirname( __FILE__ ) . '/seo/wp-head.php';
}
add_action( 'wp_head', 'ts_seo_into_wp_head', 1 );

/**
 * Bring in our styles and jQuery on the pages where we need them.
 *
 * @param [type] $hook Description still to come.
 */
function ts_seo_scripts_and_styles( $hook ) {
	wp_enqueue_style( 'admin-css', get_template_directory_uri() . '/functions/assets/css/admin.css' );
	$hook = array(
		'post.php',
		'post-new.php',
		'term.php',
	);
	if ( $hook ) {
		wp_enqueue_script( 'seo-scripts', get_template_directory_uri() . '/functions/assets/js/seo.js', array(), '1.0.0', true );
		wp_enqueue_style( 'seo-styles', get_template_directory_uri() . '/functions/assets/css/seo.css' );
		wp_enqueue_script( 'font-awesome', get_template_directory_uri() . '/functions/assets/js/fontawesome-all.min.js', array(), null, true );
		wp_enqueue_script( 'font-awesome-shims', get_template_directory_uri() . '/functions/assets/js/fontawesome-shims.min.js', array(), null, true );
	} else {
		return;
	}
}
add_action( 'admin_enqueue_scripts', 'ts_seo_scripts_and_styles' );
