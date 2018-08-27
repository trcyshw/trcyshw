<?php
/**
 * Enqueue scripts and styles.
 *
 * @package WordPress
 */

/**
 * Enqueue frontend scripts.
 */
function enqueue_ts_frontend_scripts() {
	// jQuery.
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, null, true );
	wp_enqueue_script( 'jquery' );
	// Web fonts.
	wp_enqueue_style( 'font-poppins', 'https://fonts.googleapis.com/css?family=Poppins:300,500:latin' );
	wp_enqueue_script( 'font-awesome', get_template_directory_uri() . '/assets/js/fontawesome-all.min.js', array(), null, true );
	// Theme stylesheet.
	wp_enqueue_style( 'site-style', get_template_directory_uri() . '/assets/css/style.css' );
	// Theme scripts.
	wp_register_script( 'site-scripts', get_template_directory_uri() . '/assets/js/package.min.js', array( 'jquery' ), null, false );
	wp_enqueue_script( 'site-scripts' );
}

/**
 * Hook into the 'wp_enqueue_scripts' action.
 */
add_action( 'wp_enqueue_scripts', 'enqueue_ts_frontend_scripts' );
add_filter( 'script_loader_tag', 'add_defer_attribute', 10, 2 );

/**
 * Filter the HTML script tag of `font-awesome` script to add `defer` attribute.
 *
 * @param string $tag    The <script> tag for the enqueued script.
 * @param string $handle The script's registered handle.
 *
 * @return Filtered HTML script tag.
 */
function add_defer_attribute( $tag, $handle ) {
	if ( 'font-awesome' === $handle ) {
		$tag = str_replace( ' src', ' defer src', $tag );
	}
	return $tag;
}
