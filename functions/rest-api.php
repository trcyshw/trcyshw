<?php
/**
 * A file for REST API things.
 * Work in progress.
 *
 * @package WordPress.
 */

/**
 * Bring custom post meta into REST.
 */
function create_api_posts_meta_field() {

	register_rest_field( 'website', 'website_details', array(
		'get_callback' => 'get_post_meta_for_api',
		'schema'       => null,
	));
}
add_action( 'rest_api_init', 'create_api_posts_meta_field' );

/**
 * Function to get the post meta.
 *
 * @param string $object Description still to come.
 */
function get_post_meta_for_api( $object ) {
	// Get the id of the post object array.
	$post_id = $object['id'];
	// Return the post meta.
	return get_post_meta( $post_id );
}
