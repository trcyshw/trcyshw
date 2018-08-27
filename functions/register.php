<?php
/**
 * Register relevant extras for theme.
 *
 * @package WordPress
 */

/**
 * Register Custom Post Types
 */
function ts_register_post_types() {

	// Websites.
	register_post_type( 'website', array(
		'can_export'            => true,
		'capability_type'       => 'post',
		'description'           => '',
		'exclude_from_search'   => true,
		'has_archive'           => false,
		'hierarchical'          => false,
		'label'                 => 'Website',
		'labels'                => array(
			'add_new'               => 'Add Website',
			'add_new_item'          => 'Add New Website',
			'all_items'             => 'All Websites',
			'archives'              => 'Website Archives',
			'edit_item'             => 'Edit Website',
			'featured_image'        => 'Website Logo',
			'filter_items_list'     => 'Filter website list',
			'insert_into_item'      => 'Insert into website content',
			'items_list'            => 'Website list',
			'items_list_navigation' => 'Website list navigation',
			'menu_name'             => 'Websites',
			'name'                  => 'Websites',
			'name_admin_bar'        => 'Website',
			'new_item'              => 'New Website',
			'not_found'             => 'Not found',
			'not_found_in_trash'    => 'Not found in Trash',
			'parent_item_colon'     => 'Parent Website:',
			'remove_featured_image' => 'Remove website logo',
			'search_items'          => 'Search Website',
			'set_featured_image'    => 'Set website logo',
			'singular_name'         => 'Website',
			'update_item'           => 'Update Website',
			'uploaded_to_this_item' => 'Uploaded to this website',
			'use_featured_image'    => 'Use as website logo',
			'view_item'             => 'View Website',
		),
		'menu_icon'             => 'dashicons-hammer',
		'menu_position'         => 5,
		'public'                => false,
		'publicly_queryable'    => true,
		'query_var'             => true,
		'rest_base'             => 'websites',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'rewrite'               => array(
			'hierarchical' => false,
			'with_front'   => true,
			'slug'         => 'website',
		),
		'rewrite'               => array(
			'slug'       => get_option( 'website_base' ),
			'with_front' => false,
		),
		'show_in_admin_bar'     => true,
		'show_in_menu'          => true,
		'show_in_nav_menus'     => true,
		'show_in_rest'          => true,
		'show_ui'               => true,
		'supports'              => array(
			'author',
			'editor',
			'page-attributes',
			'title',
		),
		'taxonomies'            => array(),
	));
}
add_action( 'init', 'ts_register_post_types' );

/**
 * Register Custom Taxonomies
 */
function ts_register_taxonomies() {
	register_taxonomy( 'website_industry', array( 'website' ),
		array(
			'has_archive'           => false,
			'hierarchical'          => true,
			'labels'                => array(
				'add_new_item'               => 'Add New Website Industry',
				'add_or_remove_items'        => 'Add or remove website industries',
				'all_items'                  => 'All Website Industries',
				'choose_from_most_used'      => 'Choose from the most used website industries',
				'edit_item'                  => 'Edit Website Industries',
				'menu_name'                  => 'Website Industries',
				'name'                       => 'Website Industries',
				'new_item_name'              => 'New Website Industry Name',
				'not_found'                  => 'No website industries found.',
				'parent_item'                => 'Parent Website Industry',
				'parent_item_colon'          => 'Parent Website Industry:',
				'popular_items'              => 'Popular Website Industries',
				'search_items'               => 'Search Website Industries',
				'separate_items_with_commas' => 'Separate website industries with commas',
				'singular_name'              => 'Website Industry',
				'update_item'                => 'Update Website Industry',
				'view_item'                  => 'View Website Industry',
			),
			'public'                => true,
			'query_var'             => true,
			'rest_controller_class' => 'WP_REST_Terms_Controller',
			'rest_base'             => 'industry',
			'rewrite'               => array(
				'slug'       => get_option( 'website_industry_base' ),
				'with_front' => false,
			),
			'show_in_rest'          => true,
			'show_admin_column'     => true,
			'show_in_nav_menus'     => true,
			'show_tagcloud'         => false,
			'show_ui'               => true,
		)
	);
	// Show the editor on the taxonomy term pages.
	add_filter( 'website_industry_edit_form_fields', 'show_description_editor', 10, 1 );
}
add_action( 'init', 'ts_register_taxonomies' );
