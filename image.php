<?php
/**
 * Redirect images to their attachment page only.
 *
 * @package WordPress
 */

if ( $post->post_parent ) {
	wp_safe_redirect( get_permalink( $post->post_parent ), 301 );
} else {
	wp_safe_redirect( site_url(), 301 );
}
die();
