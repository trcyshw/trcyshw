<?php
/**
 * Custom settings for Advanced Custom Fields.
 *
 * @package WordPress
 */

/**
 * Setup ACF
 */
function ts_setup_acf() {
	// Hide for all users, we will activate admin access below.
	acf_update_setting( 'show_admin', false );

	if ( current_user_can( 'update_core' ) && function_exists( 'acf_add_options_page' ) ) {

		$parent = acf_add_options_page( array(
			'icon_url'   => 'dashicons-info',
			'page_title' => 'Theme Settings',
			'redirect'   => false,
		));

		acf_add_options_sub_page( array(
			'page_title'  => 'Contact Details',
			'parent_slug' => $parent['menu_slug'],
		));

		acf_add_options_sub_page( array(
			'page_title'  => 'Media Sizes',
			'parent_slug' => $parent['menu_slug'],
		));

		acf_add_options_sub_page( array(
			'page_title'  => 'Scripts',
			'parent_slug' => $parent['menu_slug'],
		));
	}
}
add_action( 'acf/init', 'ts_setup_acf' );

/**
 * Show ACF in admin menu for admins.
 *
 * @param [type] $show [desc].
 */
function ts_show_acf_for_admin( $show ) {
	return current_user_can( 'update_core' );
}
add_filter( 'acf/settings/show_admin', 'ts_show_acf_for_admin' );

/**
 * Save ACF fields to json files with custom path.
 *
 * @param [type] $path [desc].
 */
function ts_acf_json_save_point( $path ) {
	$path = get_template_directory() . '/assets/json/acf';
	return $path;
}
add_filter( 'acf/settings/save_json', 'ts_acf_json_save_point' );

/**
 * Load ACF fields json files from custom path.
 *
 * @param [type] $paths [desc].
 */
function ts_acf_json_load_point( $paths ) {
	// remove original path (optional).
	unset( $paths[0] );
	// append path.
	$paths[] = get_template_directory() . '/assets/json/acf';
	return $paths;
}
add_filter( 'acf/settings/load_json', 'ts_acf_json_load_point' );


/**
 * Load ACF into REST API.
 */
function ts_acf_into_api_all_post_types() {
	// Get all the post types.
	global $wp_post_types;
	$post_types = array_keys( $wp_post_types );
	// Loop through each one.
	foreach ( $post_types as $post_type ) {
		// Add a filter for this post type.
		add_filter( 'rest_prepare_' . $post_type, function( $data, $post, $request ) {
			// Get the response data.
			$response_data = $data->get_data();
			// Bail early if there's an error.
			if ( 'view' !== $request['context'] || is_wp_error( $data ) ) {
				return $data;
			}
			// Get all fields.
			$fields = get_fields( $post->ID );
			// If we have fields...
			if ( $fields ) {
				// Loop through them.
				foreach ( $fields as $field_name => $value ) {
					// Set the meta.
					$response_data[ $field_name ] = $value;
				}
			}
			// Commit the API result var to the API endpoint.
			$data->set_data( $response_data );
			return $data;
		}, 10, 3);
	}
}
add_action( 'rest_api_init', 'ts_acf_into_api_all_post_types', 99 );
