<?php
/**
 * Everything related to WordPress permalinks.
 *
 * @package WordPress
 */

/**
 * Do not allow slugs to match existing directories.
 * E.g. a media folder on the root will prevent a page slug of 'media' on the root.
 *
 * @param [type] $bool Description still to come.
 * @param [type] $slug Description still to come.
 */
function ts_prevent_slug_collisions( $bool, $slug ) {
	if ( is_dir( ABSPATH . '/' . $slug ) ) {
		return true;
	}
	return $bool;
};
add_filter( 'wp_unique_post_slug_is_bad_hierarchical_slug', 'ts_prevent_slug_collisions', 10, 2 );
