<?php
/**
 * SEO stuff all lives here.
 * Work in progress.
 *
 * @package WordPress
 */

/**
 * Function to replace the wp_title.
 *
 * @param [type] $page_slug Description still to come..
 */
function ts_get_id_by_slug( $page_slug ) {
	$page = get_page_by_path( $page_slug );
	if ( $page ) {
		return $page->ID;
	} else {
		return null;
	}
}
/**
 * Function to replace the wp_title.
 */
function ts_replace_wp_title() {
	// Leave the auto-generated date archive out of this.
	if ( is_date() ) {
		$term = get_queried_object();
	} else {
		if ( ! is_date() && is_archive() || is_category() || is_tax() ) {
			$term = get_queried_object()->term_id;
		}
	}
	if ( is_archive() || is_category() || is_tax() ) {
		$metadata_title = get_term_meta( $term, '_metadata_title', true );
		$title          = get_the_archive_title();
	} else {
		if ( is_home() ) {
			$blog           = get_option( 'page_for_posts' );
			$metadata_title = get_post_meta( $blog, '_metadata_title', true );
			$title          = get_the_title( $blog );
		} else {
			$metadata_title = get_post_meta( get_the_ID(), '_metadata_title', true );
			$title          = get_the_title();
		}
	}
	// Exclude 404 and search results.
	if ( ! is_404() && ! is_search() ) {
		if ( $metadata_title ) {
			echo esc_html( $metadata_title );
		} else {
			echo esc_attr( $title ) . ' &ndash; ' . esc_attr( get_bloginfo( 'name' ) );
		}
		// Add extra if there's pagination.
		if ( is_home() || is_archive() || is_tax() ) {
			global $page, $paged;
			if ( $paged >= 2 ) {
				echo sprintf( ' &ndash; Page %s', esc_attr( max( $paged, $page ) ) );
			}
		}
	}
	// The 404 page.
	if ( is_404() ) {
		echo 'Error 404: Nothing Found';
	}
	// Search results page.
	if ( is_search() ) {
		echo 'Search Results: \'' . get_search_query() . '\'';
		global $page, $paged;
		if ( $paged >= 2 ) {
			echo sprintf( ' &ndash; Page %s', esc_attr( max( $paged, $page ) ) );
		}
	}
}
add_filter( 'wp_title', 'ts_replace_wp_title' );
