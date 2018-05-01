<?php
/**
 * Functions file.
 *
 * @package WordPress
 */

// The power of Greyskull. Delete this whole folder if client goes bye-bye.
//require_once( 'functions/goop/goop.php' );

// Call CSS for the admin section if required.
// require_once( 'functions/admin-css.php' );

// Customise blog/archive output.
require_once( 'functions/blog.php' );

// Call any necessary custom post types.
// require_once( 'functions/cpt-address.php' );
// require_once( 'functions/cpt-banner.php' );
// require_once( 'functions/cpt-brand.php' );
// require_once( 'functions/cpt-product.php' );
require_once( 'functions/cpt-website.php' );
// require_once( 'functions/cpt-review.php' );
// require_once( 'functions/cpt-staff.php' );

// Image functions.
require_once( 'functions/images.php' );

// Register and customise menus.
require_once( 'functions/navigation.php' );
// require_once( 'functions/navigation-cpt.php' );

// Register styles and scripts.
require_once( 'functions/scripts-and-styles.php' );

require_once( 'functions/seo.php' );

// Slug/permalink customisations.
require_once( 'functions/slugs.php' );

// WooCommerce if you need it.
// require_once( 'functions/woocommerce.php' );

// WooCommerce catalogue functions - use in conjunction with the general WooCommerce functions
// require_once( 'functions/woocommerce-catalogue.php' );
