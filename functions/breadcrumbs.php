<?php
/**
 * Custom breadcrumbs - work in progress.
 * Source: https://www.thewebtaylor.com/articles/wordpress-creating-breadcrumbs-without-a-plugin
 *
 * @package WordPress
 */

/**
 * Breadcrumbs.
 */
function website_breadcrumbs() {
	global $post, $wp_query;
	// If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat).
	$blog = get_option( 'page_for_posts' );
	$custom_taxonomy = 'product_cat';
	$prefix = '';
	echo '<li><a href="' . esc_url( get_option( 'home' ) ) . '">Home</a></li>';
	if ( is_archive() && ! is_tax() && ! is_category() && ! is_tag() && ! is_year() && ! is_month() && ! is_day() ) {
		echo '<li>' . post_type_archive_title( $prefix, false ) . '</li>';
	} elseif ( is_archive() && is_tax() && ! is_category() && ! is_tag() ) {
		$post_type = get_post_type();
		// If it is a custom post type display name and link.
		if ( 'post' !== $post_type ) {
			$post_type_object = get_post_type_object( $post_type );
			$post_type_archive = get_post_type_archive_link( $post_type );
			echo '<li><a href="' . esc_url( $post_type_archive ) . '">' . esc_attr( $post_type_object->labels->name ) . '</a></li>';
		}
		$custom_tax_name = get_queried_object()->name;
		echo '<li class="item-current item-archive">' . esc_attr( $custom_tax_name ) . '</li>';
	} elseif ( is_home() ) {
		echo '<li><a href="' . esc_url( get_the_permalink( $blog ) ) . '">' . get_the_title( $blog ) . '</a></li>';
	} elseif ( is_single() ) {
		$post_type = get_post_type();
		// If it is a custom post type display name and link.
		if ( 'post' !== $post_type ) {
			$post_type_object = get_post_type_object( $post_type );
			$post_type_archive = get_post_type_archive_link( $post_type );
			echo '<li><a href="' . esc_url( $post_type_archive ) . '">' . esc_attr( $post_type_object->labels->name ) . '</a></li>';
		} else {
			echo '<li><a href="' . esc_url( get_the_permalink( $blog ) ) . '">' . get_the_title( $blog ) . '</a></li>';
		}
		// If it's a custom post type within a custom taxonomy.
		$taxonomy_exists = taxonomy_exists( $custom_taxonomy );
		if ( empty( $last_category ) && ! empty( $custom_taxonomy ) && $taxonomy_exists ) {
			$taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
			$cat_id = $taxonomy_terms[0]->term_id;
			$cat_nicename = $taxonomy_terms[0]->slug;
			$cat_link = get_term_link( $taxonomy_terms[0]->term_id, $custom_taxonomy );
			$cat_name = $taxonomy_terms[0]->name;
		}
		// Check if the post is in a category.
		if ( ! empty( $last_category ) ) {
			echo esc_attr( $cat_display );
			echo '<li>' . get_the_title() . '</li>';
			// elseif post is in a custom taxonomy.
		} elseif ( ! empty( $cat_id ) ) {
			echo '<li><a href="' . esc_url( $cat_link ) . '">' . esc_attr( $cat_name ) . '</a></li>';
			echo '<li>' . get_the_title() . '</li>';
		} else {
			echo '<li>' . get_the_title() . '</li>';
		}
	} elseif ( is_category() ) {
		// Category page.
		$post_type = get_post_type();
		// If it is a custom post type display name and link.
		if ( 'post' === $post_type ) {
			echo '<li><a href="' . esc_url( get_the_permalink( $blog ) ) . '">' . get_the_title( $blog ) . '</a></li>';
		}
		echo '<li>' . esc_attr( single_cat_title( '', false ) ) . '</li>';
	} elseif ( is_page() ) {
		 // Standard page.
		if ( $post->post_parent ) {
			// If child page, get parents.
			$anc = get_post_ancestors( $post->ID );
			// Get parents in the right order.
			$anc = array_reverse( $anc );
			// Parent page loop.
			if ( ! isset( $parents ) ) {
				$parents = null;
			}
			foreach ( $anc as $ancestor ) {
				$parents .= '<li><a href="' . esc_url( get_permalink( $ancestor ) ) . '">' . get_the_title( $ancestor ) . '</a></li>';
			}
			// Display parent pages.
			echo wp_kses_post( $parents );
			// Current page.
			echo '<li>' . get_the_title() . '</li>';
		} else {
			// Just display current page if not parents.
			echo '<li> ' . get_the_title() . '</li>';
		}
	} elseif ( is_month() ) {
		// Month Archive.
		// Year link.
		echo '<li><a href="' . esc_url( get_the_permalink( $blog ) ) . '">' . get_the_title( $blog ) . '</a></li>';
		echo '<li><a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . esc_attr( get_the_time( 'Y' ) ) . '</a></li>';
		// Month display.
		echo '<li>' . esc_attr( get_the_time( 'F' ) ) . '</li>';
	} elseif ( is_year() ) {
		// Display year archive.
		echo '<li><a href="' . esc_url( get_the_permalink( $blog ) ) . '">' . get_the_title( $blog ) . '</a></li>';
		echo '<li>' . esc_attr( get_the_time( 'Y' ) ) . '</li>';
	} elseif ( is_search() ) {
		// Search results page.
		echo '<li>Search results for: ' . get_search_query() . '</li>';
	} elseif ( is_404() ) {
		// 404 page.
		echo '<li>Error 404</li>';
	} // End if().
}

/**
 * Breadcrumbs.
 *
 * @param [type] $id [description].
 */
function get_tax_children( $id ) {
	$count = null;
	$taxonomy = 'website_taxonomy';
	$args = array(
		'child_of' => $id,
	);
	$tax_terms = get_terms( $taxonomy, $args );
	foreach ( $tax_terms as $tax_term ) {
			$count += $tax_term->count;
	}
	return $count;
}
