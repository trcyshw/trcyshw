<?php
/**
 * All the stuff to go into wp_head.
 * Work in progress.
 *
 * @package WordPress
 */

if ( is_archive() || is_tax() ) {
	// Leave the auto-generated date archive out of this.
	if ( is_date() ) {
		$the_term = get_queried_object();
	} else {
		if ( ! is_date() && is_archive() || is_category() || is_tax() ) {
			$the_term = get_queried_object()->term_id;
		}
	}
	$metadata_advanced    = get_term_meta( $the_term, '_metadata_advanced' );
	$metadata_description = get_term_meta( $the_term, '_metadata_description', true );
	$metadata_follow      = get_term_meta( $the_term, '_metadata_follow', true );
	$metadata_index       = get_term_meta( $the_term, '_metadata_index', true );
	$metadata_keywords    = get_term_meta( $the_term, '_metadata_keywords', true );
	$metadata_sitemap     = get_term_meta( $the_term, '_metadata_sitemap', true );
} else {
	$metadata_advanced    = get_post_meta( get_the_ID(), '_metadata_advanced', true );
	$metadata_description = get_post_meta( get_the_ID(), '_metadata_description', true );
	$metadata_follow      = get_post_meta( get_the_ID(), '_metadata_follow', true );
	$metadata_index       = get_post_meta( get_the_ID(), '_metadata_index', true );
	$metadata_keywords    = get_post_meta( get_the_ID(), '_metadata_keywords', true );
	$metadata_sitemap     = get_post_meta( get_the_ID(), '_metadata_sitemap', true );
}
// Display robots instructions.
if ( $metadata_index ) {
	$robots_index = 'noindex';
} else {
	$robots_index = null;
}
if ( $metadata_follow ) {
	$robots_follow = 'nofollow';
} else {
	$robots_follow = null;
}
$robots_noodp        = null;
$robots_noimageindex = null;
$robots_noarchive    = null;
$robots_nosnippet    = null;
if ( ! empty( $metadata_advanced ) ) {
	if ( $metadata_advanced ) {
		$robots_noodp = 'noodp';
	}
	if ( $metadata_advanced ) {
		$robots_noimageindex = 'noimageindex';
	}
	if ( $metadata_advanced ) {
		$robots_noarchive = 'noarchive';
	}
	if ( $metadata_advanced ) {
		$robots_nosnippet = 'nosnippet';
	}
}
$robots = array( $robots_index, $robots_follow, $robots_noodp, $robots_noimageindex, $robots_noarchive, $robots_nosnippet );
if ( ! empty( array_filter( $robots ) ) ) {
	$robots_array = implode( ',', array_filter( $robots ) );
	echo '<meta name="robots" content="' . esc_html( $robots_array ) . '" />' . "\n";
}
// Leave the auto-generated date archive out of this.
if ( ! is_date() && ! is_404() && ! is_search() ) {
	// Display meta description.
	if ( $metadata_description ) {
		if ( ! is_archive() ) {
			echo '		'; // For indentation.
		}
		echo '<meta name="description" content="' . esc_html( $metadata_description ) . '" />' . "\n";
	} else {
		global $post;
		echo '<meta name="description" content="' . esc_html( apply_filters( 'the_excerpt', get_post_field( 'post_excerpt', $post->ID ) ) ) . '" />' . "\n";
	}
	// Display meta keywords.
	if ( $metadata_keywords ) {
		echo '		<meta name="keywords" content="' . esc_html( $metadata_keywords ) . '" />' . "\n";
	}
}
