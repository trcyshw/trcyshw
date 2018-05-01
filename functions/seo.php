<?php
/**
 * SEO stuff lives here.
 *
 * @package WordPress
 */



/**
 * SEO Metadata - Pages and Posts
 */
class SEO_Metadata {
	/**
	 * [__construct description]
	 */
	public function __construct() {
		if ( is_admin() ) {
			add_action( 'load-post.php', array( $this, 'init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
		}
	}
	/**
	 * [init_metabox description]
	 */
	public function init_metabox() {
		add_action( 'add_meta_boxes', array( $this, 'add_metabox' ) );
		add_action( 'save_post', array( $this, 'save_metabox' ), 10, 2 );
	}
	/**
	 * [add_metabox description]
	 */
	public function add_metabox() {
		foreach ( get_post_types( '', 'names' ) as $post_type ) { // this will add metadata to ALL post types.
			if ( 'brand' !== $post_type && 'business_address' !== $post_type && 'homepage_banner' !== $post_type  && 'redirect_rule' !== $post_type ) {
				add_meta_box(
					'seometadata_metabox',
					'SEO Metadata',
					array( $this, 'callmemaybe' ),
					$post_type,
					'normal',
					'default'
				);
			}
		}
	}
	/**
	 * [callmemaybe description]
	 *
	 * @param [type] $post [description].
	 */
	public function callmemaybe( $post ) {
		require_once( 'metadata.php' );
	}
	/**
	 * [save_metabox description]
	 *
	 * @param [type] $post_id [description].
	 * @param [type] $post    [description].
	 */
	public function save_metabox( $post_id, $post ) {
		$nonce_name = isset( $_POST['seo_nonce'] ) ? $_POST['seo_nonce'] : '';
		$nonce_action = 'seo_nonce_action';
		if ( ! isset( $nonce_name ) ) {
			return;
		}
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
			return;
		}
		if ( wp_is_post_autosave( $post_id ) ) {
			return;
		}
		$metadata_new_title = isset( $_POST['metadata_title'] ) ? sanitize_text_field( wp_unslash( $_POST['metadata_title'] ) ) : '';
		$metadata_new_description = isset( $_POST['metadata_description'] ) ? sanitize_text_field( wp_unslash( $_POST['metadata_description'] ) ) : '';
		$metadata_new_keywords = isset( $_POST['metadata_keywords'] ) ? sanitize_text_field( wp_unslash( $_POST['metadata_keywords'] ) ) : '';
		$metadata_new_index = isset( $_POST['metadata_index'] ) ? $_POST['metadata_index'] : '';
		$metadata_new_follow = isset( $_POST['metadata_follow'] ) ? $_POST['metadata_follow'] : '';
		$metadata_new_advanced_noodp = isset( $_POST['metadata_advanced_noodp'] ) ? 'noodp' : '';
		$metadata_new_advanced_noimageindex = isset( $_POST['metadata_advanced_noimageindex'] ) ? 'noimageindex' : '';
		$metadata_new_advanced_noarchive = isset( $_POST['metadata_advanced_noarchive'] ) ? 'noarchive' : '';
		$metadata_new_advanced_nosnippet = isset( $_POST['metadata_advanced_nosnippet'] ) ? 'nosnippet' : '';
		$metadata_new_sitemap = isset( $_POST['metadata_sitemap'] ) ? 'exclude' : '';
		$metadata_new_canonical = isset( $_POST['metadata_canonical'] ) ? esc_url( wp_unslash( $_POST['metadata_canonical'] ) ) : '';
		$metadata_new_adwords = isset( $_POST['metadata_adwords'] ) ? sanitize_text_field( wp_unslash( $_POST['metadata_adwords'] ) ) : '';
		update_post_meta( $post_id, 'metadata_title', $metadata_new_title );
		update_post_meta( $post_id, 'metadata_description', $metadata_new_description );
		update_post_meta( $post_id, 'metadata_keywords', $metadata_new_keywords );
		update_post_meta( $post_id, 'metadata_index', $metadata_new_index );
		update_post_meta( $post_id, 'metadata_follow', $metadata_new_follow );
		update_post_meta( $post_id, 'metadata_advanced_noodp', $metadata_new_advanced_noodp );
		update_post_meta( $post_id, 'metadata_advanced_noimageindex', $metadata_new_advanced_noimageindex );
		update_post_meta( $post_id, 'metadata_advanced_noarchive', $metadata_new_advanced_noarchive );
		update_post_meta( $post_id, 'metadata_advanced_nosnippet', $metadata_new_advanced_nosnippet );
		update_post_meta( $post_id, 'metadata_sitemap', $metadata_new_sitemap );
		update_post_meta( $post_id, 'metadata_canonical', $metadata_new_canonical );
		update_post_meta( $post_id, 'metadata_adwords', $metadata_adwords );
	}
}

new SEO_Metadata;

/**
 * Function to replace the wp_title.
 *
 * @param [type] $page_slug [description].
 */
function get_id_by_slug( $page_slug ) {
	$page = get_page_by_path( $page_slug );
	if ( $page ) {
		return $page->ID;
	} else {
		return null;
	}
}
/**
 * [seo_page_title description]
 */
function seo_page_title() {
	if ( is_404() ) {
		'Nope. That\'s a 404.';
	}
	if ( is_archive() ) {
		global $page, $paged;
		$post_type_archive = get_post_type() . 's';
		$archive_id = get_id_by_slug( $post_type_archive );
		$metadata_title = get_post_meta( $archive_id, 'metadata_title', true );
		if ( $paged >= 2 ) {
			$metadata_title = get_post_meta( $archive_id, 'metadata_title', true ) . sprintf( __( ' - Page %s' ), max( $paged, $page ) );
		}
	} elseif ( is_tax() ) {
		$term = get_queried_object();
		$metadata_title = get_term_meta( $term->term_id, 'metadata_title', true );
	} elseif ( is_home() ) {
		$blog = get_option( 'page_for_posts' );
		$metadata_title = get_post_meta( $blog, 'metadata_title', true );
	} else {
		$metadata_title = get_post_meta( get_the_ID(), 'metadata_title', true );
	}
	if ( '' !== $metadata_title ) {
		echo esc_html( $metadata_title );
	} else {
		wp_title( '&ndash;', true, 'right' ) . bloginfo( 'name' );
	}
}

/**
 * Enable 'after-title' position for metaboxes, after the title, before the editor.
 */
function after_title_meta_boxes() {
	global $post, $wp_meta_boxes;
	// Output the 'below_title' meta boxes:.
	do_meta_boxes( get_current_screen(), 'after_title', $post );
}
add_action( 'edit_form_after_title', 'after_title_meta_boxes' );

// SHow the title and description to admins and editors.
if ( current_user_can( 'delete_published_pages' ) ) {
	/**
	 * [metadata_columns description]
	 *
	 * @param [type] $columns [description].
	 */
	function metadata_columns( $columns ) {
		$metadata_columns = array(
			'metatitle' => __( 'Meta Title' ),
			'metadescription' => __( 'Meta Description' ),
		);
		$columns = array_merge( $columns, $metadata_columns );
		return $columns;
	}
	add_filter( 'manage_pages_columns', 'metadata_columns' );
	/**
	 * [metadata_column_content description]
	 *
	 * @param [type] $column_name [description].
	 * @param [type] $post_id     [description].
	 */
	function metadata_column_content( $column_name, $post_id ) {
		if ( 'metatitle' === $column_name ) {
			$metadata_title = get_post_meta( get_the_ID(), 'metadata_title', true );
			if ( $metadata_title ) {
				echo esc_html( $metadata_title );
			}
		}
		if ( 'metadescription' === $column_name ) {
			$metadata_description = get_post_meta( get_the_ID(), 'metadata_description', true );
			if ( $metadata_description ) {
				echo esc_html( $metadata_description );
			}
		}
	}
	add_action( 'manage_pages_custom_column', 'metadata_column_content', 10, 2 );
}

/**
 * Load our stuff in wp_head.
 */
function seo_into_wp_head() {
	require_once( 'wp-head.php' );
}
add_action( 'wp_head', 'seo_into_wp_head' );
