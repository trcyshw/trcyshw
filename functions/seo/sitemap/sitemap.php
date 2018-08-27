<?php
/**
 * Create sitemap.xml file in root directory of site
 *
 * @package WordPress
 */

/**
 * Generate the sitemap.
 *
 * @param [type] $template [desc].
 */
function ts_sitemap_template_redirect( $template ) {
	global $wp;
	if ( 'sitemap.xml' === $wp->request ) {
		return get_stylesheet_directory() . '/functions/seo/sitemap/generate.php';
	}
	return $template;
}
add_filter( 'template_include', 'ts_sitemap_template_redirect' );
