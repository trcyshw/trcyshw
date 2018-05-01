<?php
/**
 * Website - Custom Post Type
 *
 * @package WordPress
 */

/**
 * Add an image thumbnail size for this CPT
 */
function website_add_new_image_size() {
	add_image_size( 'website', 1200, 775, true );
}
add_action( 'init', 'website_add_new_image_size' );

/**
 * Enable permalink customisation for CPT
 */
function website_permalinks() {
	if ( isset( $_POST['website_base'] ) ) {
		update_option( 'website_base', $_POST['website_base'] );
	}
	if ( isset( $_POST['website_category_base'] ) ) {
		update_option( 'website_category_base', $_POST['website_category_base'] );
	}
	// Add a settings field to the permalink page.
	add_settings_field( 'website_base', __( 'Website base' ), 'website_base_callback', 'permalink', 'optional' );
	add_settings_field( 'website_category_base', __( 'Website category base' ), 'website_category_base_callback', 'permalink', 'optional' );
}
add_action( 'load-options-permalink.php', 'website_permalinks' );

/**
 * Callbacks for the permalinks - base
 */
function website_base_callback() {
	$value = get_option( 'website_base' );
	echo '<input type="text" value="' . esc_attr( $value ) . '" name="website_base" id="website_base" class="regular-text" />';
}

/**
 * Callbacks for the permalinks - category
 */
function website_category_base_callback() {
	$value = get_option( 'website_category_base' );
	echo '<input type="text" value="' . esc_attr( $value ) . '" name="website_category_base" id="website_category_base" class="regular-text" />';
}


add_action( 'init', 'website', 0 );
/**
 * Register Custom Post Type
 */
function website() {
	$labels = array(
		'name' 								=> _x( 'Website Industry', 'taxonomy general name' ),
		'singular_name' 			=> _x( 'Industry', 'taxonomy singular name' ),
		'search_items' 				=> __( 'Search Industries' ),
		'all_items' 					=> __( 'All Industries' ),
		'parent_item' 				=> __( 'Parent Industry' ),
		'parent_item_colon' 	=> __( 'Parent Industry:' ),
		'edit_item' 					=> __( 'Edit Industries' ),
		'update_item' 				=> __( 'Update Industry' ),
		'add_new_item' 				=> __( 'Add New Industry' ),
		'new_item_name' 			=> __( 'New Industry Name' ),
	);
	$rewrite = array(
		'slug'								=> 'website',
		'with_front'					=> true,
		'hierarchical'				=> false,
	);
	$args = array(
		'labels'							=> $labels,
		'hierarchical'				=> false,
		'public'							=> false,
		'show_ui'							=> true,
		'show_admin_column'		=> true,
		'show_in_nav_menus'		=> true,
		'show_tagcloud'				=> false,
		'query_var'						=> true,
		'has_archive' 				=> false,
		'rewrite' => array(
			'slug' => get_option(
				'website_category_base'
			),
			'with_front' => false,
		),
	);
	register_taxonomy(
		'industry',
		array(
			'website'
		), $args
	);
	$labels = array(
		'name'                  => 'Websites',
		'singular_name'         => 'Website',
		'menu_name'             => 'Websites',
		'name_admin_bar'        => 'Website',
		'archives'              => 'Website Archives',
		'parent_item_colon'     => 'Parent Website:',
		'all_items'             => 'All Websites',
		'add_new_item'          => 'Add New Website',
		'add_new'               => 'Add Website',
		'new_item'              => 'New Website',
		'edit_item'             => 'Edit Website',
		'update_item'           => 'Update Website',
		'view_item'             => 'View Website',
		'search_items'          => 'Search Website',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'featured_image'        => 'Website Image',
		'set_featured_image'    => 'Set website image',
		'remove_featured_image' => 'Remove website image',
		'use_featured_image'    => 'Use as website image',
		'insert_into_item'      => 'Insert into website',
		'uploaded_to_this_item' => 'Uploaded to this website',
		'items_list'            => 'Websites list',
		'items_list_navigation' => 'Websites list navigation',
		'filter_items_list'     => 'Filter websites list',
	);
	$rewrite = array(
		'slug'                  => 'website',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => 'Website',
		'description'           => 'A description of the post type',
		'labels'                => $labels,
		'supports'              => array(
			'title',
			'editor',
			'author',
			'thumbnail',
		),
		'query_var'				=> true,
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-hammer',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'rewrite'               => $rewrite,
		'rewrite' => array(
			'slug' => get_option(
				'website_base'
			),
			'with_front' => false,
		),
		'capability_type'       => 'post',
	);
	register_post_type(
		'website', $args
	);
}

/**
 * Website - Metaboxes
 */
class Website_Metabox {
	/**
	 * Initialise metaboxes
	 */
	public function __construct() {
		if ( is_admin() ) {
			add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
		}
	}

	/**
	 * Initialise metaboxes
	 */
	public function init_metabox() {
		add_action( 'add_meta_boxes', array( $this, 'add_metabox' ) );
		add_action( 'save_post', array( $this, 'save_metabox' ), 10, 2 );
	}

	/**
	 * Add metaboxes
	 */
	public function add_metabox() {
		add_meta_box(
			'website_details',
			'Website Details',
			array(
				$this,
				'callmemaybe',
			),
			'website',
			'advanced',
			'default'
		);
	}

	/**
	 * Callback for metaboxes
	 *
	 * @param [type] $post [description].
	 */
	public function callmemaybe( $post ) {
		// Add nonce for security and authentication.
		wp_nonce_field( 'website_nonce_action', 'website_nonce' );
		// Retrieve an existing value from the database.
		$website_url = get_post_meta( $post->ID, 'website_url', true );

		if ( empty( $website_url ) ) {
			$website_url = '';
		}

		// Form fields.
		echo '<table class="form-table">';
		echo '<tr>';
		echo '<tr>';
		echo '<th><label for="website_url" class="website_url_label">Website</label></th>';
		echo '<td>';
		echo '<input type="url" id="website_url" name="website_url" class="website_url_field widefat" placeholder="" value="' . esc_attr( $website_url ) . '">';
		echo '<p class="description">Must include http://</p>';
		echo '</td>';
		echo '</tr>';
		echo '</table>';
	}
	/**
	 * Save the metaboxes
	 *
	 * @param [type] $post_id [description].
	 * @param [type] $post [description].
	 */
	public function save_metabox( $post_id, $post ) {
		// Add nonce for security and authentication.
		$nonce_name   = isset( $_POST['website_nonce'] ) ? $_POST['website_nonce'] : '';
		$nonce_action = 'website_nonce_action';
		// Check if a nonce is set.
		if ( ! isset( $nonce_name ) ) {
			return;
		}
		// Check if a nonce is valid.
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
			return;
		}
		// Check if it's not an autosave.
		if ( wp_is_post_autosave( $post_id ) ) {
			return;
		}
		// Check if it's not a revision.
		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}
		// Sanitize user input.
		$website_new_date = isset( $_POST['website_date'] ) ? $_POST['website_date'] : '';
		$website_new_year = isset( $_POST['website_year'] ) ? floatval( $_POST['website_year'] ) : '';
		$website_new_url = isset( $_POST['website_url'] ) ? esc_url( $_POST['website_url'] ) : '';
		// Update the meta field in the database.
		update_post_meta( $post_id, 'website_date', $website_new_date );
		update_post_meta( $post_id, 'website_year', $website_new_year );
		update_post_meta( $post_id, 'website_url', $website_new_url );
	}
}
new Website_Metabox;

/**
 * Website - order by title in wp-admin
 *
 * @param [type] $query [description].
 */
function website_default_order( $query ) {
	if ( is_admin() && 'website' === $query->get( 'post_type' ) ) {
		if ( $query->get( 'order' ) === '' ) {
			$query->set( 'order', 'ASC' );
		}
		if ( $query->get( 'orderby' ) === '' ) {
			$query->set( 'orderby', 'title' );
		}
	}
};
add_action( 'pre_get_posts', 'website_default_order' );

/**
 * Website - respect posts_per_page and pagination on front-end
 *
 * @param [type] $query [description].
 */
function website_posts_per_page( $query ) {
	if ( ! is_admin() && $query->is_archive( 'website' ) ) {
		set_query_var( 'posts_per_page', 1 );
	}
}
add_action( 'pre_get_posts', 'website_posts_per_page' );
