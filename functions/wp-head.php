<?php
/**
 * All the stuff to go into wp_head.
 *
 * @package WordPress
 */
$term = get_queried_object();
if ( is_tax() ) {
	$metadata_description_tax = get_term_meta( $term->term_id, 'metadata_description', true );
	$metadata_keywords_tax = get_term_meta( $term->term_id, 'metadata_keywords', true );
}
if ( is_home() ) {
	$blog = get_option( 'page_for_posts' );
	$metadata_description_archive = get_post_meta( $blog, 'metadata_description', true );
	$metadata_keywords_archive = get_post_meta( $blog, 'metadata_keywords', true );
}
$metadata_description = get_post_meta( get_the_ID(), 'metadata_description', true );
$metadata_keywords = get_post_meta( get_the_ID(), 'metadata_keywords', true );
$metadata_title = get_post_meta( get_the_ID(), 'metadata_title', true );
$metadata_description = get_post_meta( get_the_ID(), 'metadata_description', true );
$metadata_keywords = get_post_meta( get_the_ID(), 'metadata_keywords', true );
$metadata_index = get_post_meta( get_the_ID(), 'metadata_index', true );
$metadata_follow = get_post_meta( get_the_ID(), 'metadata_follow', true );
$metadata_advanced = get_post_meta( get_the_ID(), 'metadata_advanced', true );
$metadata_advanced_noodp = get_post_meta( get_the_ID(), 'metadata_advanced_noodp', true );
$metadata_advanced_noimageindex = get_post_meta( get_the_ID(), 'metadata_advanced_noimageindex', true );
$metadata_advanced_noarchive = get_post_meta( get_the_ID(), 'metadata_advanced_noarchive', true );
$metadata_advanced_nosnippet = get_post_meta( get_the_ID(), 'metadata_advanced_nosnippet', true );
$metadata_sitemap = get_post_meta( get_the_ID(), 'metadata_sitemap', true );
$metadata_canonical = get_post_meta( get_the_ID(), 'metadata_canonical', true );
$metadata_robots = array( $metadata_index, $metadata_follow, $metadata_advanced_noodp, $metadata_advanced_noimageindex, $metadata_advanced_noarchive, $metadata_advanced_nosnippet );
$filter_metadata_robots = array_filter( $metadata_robots );
$robots = implode( ',', $filter_metadata_robots );
$website_facebook_pixel = get_option( 'website_facebook_pixel' );
$website_from_email = get_option( 'website_from_email' );
$website_from_name = get_option( 'website_from_name' );
$website_google_analytics = get_option( 'website_google_analytics' );
$website_google_search_console = get_option( 'website_google_search_console' );
if ( is_string( $robots ) && ! empty( $robots ) ) {
	echo '<meta name="robots" content="' . esc_html( $robots ) . '" />';
}
if ( ! empty( $metadata_description ) ) {
	echo '<meta name="description" content="' . esc_html( $metadata_description ) . '" />';
} else {
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			echo '<meta name="description" content="' . esc_html( get_the_excerpt() ) . '" />';
		}
	}
}
if ( ! empty( $metadata_description_tax ) ) {
	echo '<meta name="description" content="' . esc_html( $metadata_description_tax ) . '" />';
}
if ( ! empty( $metadata_description_archive ) ) {
	echo '<meta name="description" content="' . esc_html( $metadata_description_archive ) . '" />';
}
if ( ! empty( $metadata_keywords ) ) {
	echo '<meta name="keywords" content="' . esc_html( $metadata_keywords ) . '" />';
}
if ( ! empty( $metadata_keywords_tax ) ) {
	echo '<meta name="keywords" content="' . esc_html( $metadata_keywords_tax ) . '" />';
}
if ( ! empty( $metadata_keywords_archive ) ) {
	echo '<meta name="keywords" content="' . esc_html( $metadata_keywords_archive ) . '" />';
}
if ( ! empty( $website_google_analytics ) ) {
	echo '<script>' . wp_kses_post( stripslashes( $website_google_analytics ) ) . '</script>'; ?>
	<script>
	/* Track outbound links */
	var trackOutboundLink = function(url) {
	   ga('send', 'event', 'outbound', 'click', url, {
	     'transport': 'beacon',
	     'hitCallback': function(){document.location = url;}
	   });
	}
	</script><?php
}
if ( ! empty( $website_google_search_console ) ) {
	echo '<meta name="google-site-verification" content="' . esc_html( $website_google_search_console ) . '" />';
}
if ( ! empty( $website_facebook_pixel ) ) {
	echo wp_kses_post( stripslashes( $website_facebook_pixel ) );
}
