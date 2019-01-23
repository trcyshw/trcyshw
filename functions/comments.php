<?php
/**
 * Disable comments everywhere.
 *
 * @package WordPress.
 */

/**
 * Disable support for comments and trackbacks in post types.
 */
function ts_disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ( $post_types as $post_type ) {
		if ( post_type_supports( $post_type, 'comments' ) ) {
			remove_post_type_support( $post_type, 'comments' );
			remove_post_type_support( $post_type, 'trackbacks' );
		}
	}
}
add_action( 'admin_init', 'ts_disable_comments_post_types_support' );

/**
 * Close comments on the front-end.
 */
function ts_disable_comments_status() {
	return false;
}
add_filter( 'comments_open', 'ts_disable_comments_status', 20, 2 );
add_filter( 'pings_open', 'ts_disable_comments_status', 20, 2 );

/**
 * Hide existing comments.
 *
 * @param array $comments Description still to come.
 */
function ts_disable_comments_hide_existing_comments( $comments ) {
	$comments = array();
	return $comments;
}
add_filter( 'comments_array', 'ts_disable_comments_hide_existing_comments', 10, 2 );

/**
 * Remove comments page in menu.
 */
function ts_disable_comments_admin_menu() {
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'ts_disable_comments_admin_menu' );

/**
 * Redirect any user trying to access comments page.
 */
function ts_disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ( 'edit-comments.php' === $pagenow ) {
		wp_safe_redirect( admin_url() );
		exit;
	}
}
add_action( 'admin_init', 'ts_disable_comments_admin_menu_redirect' );

/**
 * Remove comments metabox from dashboard.
 */
function ts_disable_comments_dashboard() {
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
}
add_action( 'admin_init', 'ts_disable_comments_dashboard' );

/**
 * Remove comments links from admin bar.
 */
function ts_disable_comments_admin_bar() {
	if ( is_admin_bar_showing() ) {
		remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
	}
}
add_action( 'init', 'ts_disable_comments_admin_bar' );
