<?php
/**
 * Sitemap generator
 *
 * @package WordPress
 */

header( 'HTTP/1.1 200 OK' );
header( 'Content-type: application/xml; charset=utf-8' );
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<?xml-stylesheet type="text/xsl" href="' . esc_url( get_template_directory_uri() . '/functions/seo/sitemap/sitemap.xsl' ) . '"?>';
echo '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$posts_per_page = 50000;
$query          = new WP_Query(
	array(
		'has_password'   => false,
		'meta_query'     => array( // check whether post has been excluded from sitemap.
			'relation' => 'or',
			array(
				'compare' => '!=',
				'key'     => '_hidden_page',
				'value'   => 1,
			),
			array(
				'compare' => 'NOT EXISTS',
				'key'     => '_metadata_sitemap',
			),
			array(
				'compare' => 'NOT LIKE',
				'key'     => '_metadata_sitemap',
				'value'   => '1',
			),
		),
		'orderby'        => 'modified',
		'post_status'    => 'publish',
		'post_type'      => array(
			'page',
			'post',
		),
		'posts_per_page' => $posts_per_page,
	)
);
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		$link = get_permalink();
		$date = get_the_modified_date( 'Y-m-d\TH:i:sP' );
		echo '<url><loc>' . esc_url( $link ) . '</loc><lastmod>' . esc_html( $date ) . '</lastmod></url>';
	}
}
wp_reset_postdata();
echo '</urlset>';
