<?php
/**
 * Theme sitemap generator.
 * Work in progress.
 *
 * @package WordPress
 */

header( 'HTTP/1.1 200 OK' );
header( 'Content-type: application/xml; charset=utf-8' );
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<?xml-stylesheet type="text/xsl" href="' . esc_url( get_template_directory_uri() . '/functions/seo/sitemap/sitemap.xsl' ) . '"?>';
echo '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$cpt_address_public = get_option( 'options_cpt_default_address_public' );
$cpt_brand_public   = get_option( 'options_cpt_default_brand_public' );
$cpt_person_public  = get_option( 'options_cpt_default_person_public' );
$cpt_product_public = get_option( 'options_cpt_default_product_public' );
$cpt_project_public = get_option( 'options_cpt_default_project_public' );
$cpt_review_public  = get_option( 'options_cpt_default_review_public' );
$custom_post_types  = get_option( 'options_cpt' );
$posts_per_page     = 500000;
$public_post_types  = array();
if ( $custom_post_types || $cpt_address_public || $cpt_brand_public || $cpt_person_public || $cpt_product_public || $cpt_project_public || $cpt_review_public ) {
	if ( $cpt_address_public ) {
		$public_post_types[] = 'address';
	}
	if ( $cpt_brand_public ) {
		$public_post_types[] = '\'brand\'';
	}
	if ( $cpt_person_public ) {
		$public_post_types[] = '\'person\'';
	}
	if ( $cpt_product_public ) {
		$public_post_types[] = '\'product\'';
	}
	if ( $cpt_project_public ) {
		$public_post_types[] = '\'project\'';
	}
	if ( $cpt_review_public ) {
		$public_post_types[] = '\'review\'';
	}
	if ( $custom_post_types ) {
		for ( $cpt = 0; $cpt < $custom_post_types; $cpt++ ) {
			$public              = get_option( 'options_cpt_' . $cpt . '_public' );
			$singular_name       = get_option( 'options_cpt_' . $cpt . '_singular_name' );
			$singular_name_lower = strtolower( $singular_name );
			if ( $public ) {
				$public_post_types[] = '\'' . $singular_name_lower . '\'';
			}
		}
	}
}
$public_post_types_array = '\'page\', \'post\', ' . join( ', ', $public_post_types );
$included_post_types     = explode( ',', $public_post_types_array );
$query                   = new WP_Query(
	array(
		'has_password'   => false,
		'meta_query'     => array( // WPCS: Slow query ok. Check whether post has been excluded from sitemap.
			'relation' => 'or',
			array(
				'compare' => 'NOT EXISTS',
				'key'     => '_metadata_sitemap',
			),
			array(
				'compare' => '=',
				'key'     => '_metadata_sitemap',
				'type'    => 'NUMERIC',
				'value'   => '0',
			),
		),
		'orderby'        => 'modified',
		'post_status'    => 'publish',
		'post_type'      => $included_post_types,
		'posts_per_page' => $posts_per_page,
	)
);
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		$date      = get_the_modified_date( 'Y-m-d\TH:i:sP' );
		$item_link = get_permalink();
		echo '<url><loc>' . esc_url( $item_link ) . '</loc><lastmod>' . esc_html( $date ) . '</lastmod></url>';
	}
}
wp_reset_postdata();
echo '</urlset>';
