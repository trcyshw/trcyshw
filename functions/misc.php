<?php
/**
 * A file for all the rest, which hasn't been tidied yet.
 *
 * @package WordPress.
 */

/**
 * Shorthand function for checking if we are on the homepage.
 */
function is_homepage() {
	return ( is_front_page() || is_page( 'home' ) );
}

/**
 * Remove Emojis
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
add_filter( 'emoji_svg_url', '__return_false' );

/**
 * Template Stylesheet Directory
 */
function ts_theme_url() {
	return get_stylesheet_directory_uri();
}

/**
 * Template Stylesheet Directory
 */
function ts_theme_dir() {
	return get_stylesheet_directory();
}

/**
 * Template Images Directory
 */
function ts_image_dir() {
	return ts_theme_url() . '/assets/img';
}

/**
 * Favicon Location
 */
function ts_include_favicon() {
	$icon_path = ts_image_dir() . '/icons';
	echo '<link rel="apple-touch-icon-precomposed" href="' . esc_url( $icon_path ) . '/favicon.png?1">';
	echo '<link rel="icon" type="image/png" href="' . esc_url( $icon_path ) . '/favicon.png" />';
	echo '<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />';
}
add_action( 'wp_head', 'ts_include_favicon' );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function ts_excerpt_readmore( $more ) {
	return ' ...';
}
add_filter( 'excerpt_more', 'ts_excerpt_readmore' );

/**
 * Order CPTs by title in wp-admin.
 *
 * @param [type] $query [desc].
 */
function ts_cpt_admin_order( $query ) {
	if ( $query->is_admin ) {
		if ( $query->get( 'post_type' ) === 'website' && ! isset( $_GET['orderby'] ) ) {
			$query->set( 'orderby', 'title' );
			$query->set( 'order', 'ASC' );
		}
	}
	return $query;
}
add_filter( 'pre_get_posts', 'ts_cpt_admin_order' );
