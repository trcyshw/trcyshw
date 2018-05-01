<?php
/**
 *
 * All functions that are related to Posts and their archives
 *
 * @package WordPress
 */

/**
 * Get monthly archive for current year
 */
function show_archives_by_month( $where, $args = '' ) {
	$where .= ' AND YEAR (post_date) = YEAR (current_date)';
	return $where;
}
/**
 * Show monthly archive for current year
 */
function show_archives_monthly( $args = '' ) {
	add_filter( 'getarchives_where', 'show_archives_by_month' );
	wp_get_archives( $args );
	remove_filter( 'getarchives_where', 'show_archives_by_month' );
}
/**
 * If there are posts from previous years, get the years
 */
function show_archives_by_year( $where, $args = '' ) {
	$where .= ' AND YEAR(post_date) < YEAR (current_date)';
	return $where;
}
/**
 * If there are posts from previous years, show the years
 */
function show_archives_yearly( $args = '' ) {
	add_filter( 'getarchives_where', 'show_archives_by_year' );
	wp_get_archives( $args );
	remove_filter( 'getarchives_where', 'show_archives_by_year' );
}
/**
 * Show short month names in the archives list
 * This is optional - comment out if not wanted
 * http://zurb.com/forrst/posts/WordPress_filter_to_shorten_wp_get_archives_mont-hti
 */
add_filter( 'get_archives_link', 'archives_shortmonth' );
function archives_shortmonth( $html ) {
	global $wp_locale;
	$html = str_replace( $wp_locale->month, $wp_locale->month_abbrev, $html );
	return $html;
}




// Other stuff below to be tidied.

/**
 * Add tag support to pages if desired
 */
/*function tags_support_all() {
	register_taxonomy_for_object_type( 'post_tag', 'page' );
} */

/**
 * Ensure all tags are included in queries
 */
/*function tags_support_query( $wp_query ) {
	if ( $wp_query->get( 'tag' ) ) {
		$wp_query->set( 'post_type', 'any' );
	}
}
// Tag hooks.
add_action( 'init', 'tags_support_all' );
add_action( 'pre_get_posts', 'tags_support_query' ); */


/* Exclude certain categories from blogs and archives
------------------------------------------------------------ */
/*if (!is_admin()) {
	function goop_exclude_category($query){
		if(is_home() || is_archive()){
			$query->set('cat','-1,-2,-3'); // use your required ID(s), with a minus sign
			return $query;
		};
	};
	add_action( 'pre_get_posts', 'goop_exclude_category');
};*/

/* Exclude certain categories from archives
------------------------------------------------------------ */
/*add_filter( 'getarchives_where', 'customarchives_where' );
add_filter( 'getarchives_join', 'customarchives_join' );
if (!is_admin()) {
	function customarchives_join( $x ) {
		global $wpdb;
		return $x . " INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)";
	}
	function customarchives_where( $x ) {
		global $wpdb;
		$exclude = '1,2'; // category IDs to exclude, should match the ones above but no minus sign
		return $x . " AND $wpdb->term_taxonomy.taxonomy = 'category' AND $wpdb->term_taxonomy.term_id NOT IN ($exclude)";
	}
}; */
