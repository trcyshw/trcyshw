<?php
/**
 * Create sitemap.xml file in root directory of site.
 * Work in progress.
 *
 * @package WordPress
 */

/**
 * Generate the sitemap.
 *
 * @param [type] $template Description still to come..
 */
function ts_sitemap_redirect( $template ) {
	global $wp;
	if ( 'sitemap.xml' === $wp->request ) {
		return get_stylesheet_directory() . '/functions/goop/seo/sitemap/generate.php';
	}
	return $template;
}
add_filter( 'template_include', 'ts_sitemap_redirect' );
