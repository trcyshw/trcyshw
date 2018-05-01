<?php

// ===============================================================================================================================================
// Navigation
// ===============================================================================================================================================

/* Register the menus and their positions
------------------------------------------------------------ */
register_nav_menus(
	array(
		'header' => 'Header',
		'mobile' => 'Mobile',
		'aside' => 'Aside',
		'footer' => 'Footer',
		'sitemap' => 'Sitemap'
	)
);

// Include page slug as nav classes on custom menus, and add a class if the page is a draft
function page_status_menu_class( $classes, $item ) {
	if( 'page' == $item->object ){
		$page = get_post( $item->object_id );
		$page = get_post( $item->object_id );
		$status = get_post_status( $item->object_id );
		$classes[] = 'menu-item-' . $page->post_name;
		$classes[] = 'menu-item-' . $status;
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'page_status_menu_class', 10, 2 );

/* Add search to nav
------------------------------------------------------------ */
/*function add_search_to_menu ( $items, $args ) {
	if( 'header' === $args -> theme_location ) {
		ob_start();
		get_search_form();
		$searchform = ob_get_contents();
		ob_end_clean();
		$items .= '<li class="menu-item-search"><a href="javascript:void(0);"><i class="fa fa-search"></i></a><ul class="search"><li>' . $searchform .'</li></ul></li>';
	};
	if( 'mobile' === $args -> theme_location ) {
		ob_start();
		get_search_form();
		$searchform = ob_get_contents();
		ob_end_clean();
		$items .= '<li class="menu-item-search">' . $searchform . '</li>';
   }
   return $items;
}
add_filter('wp_nav_menu_items','add_search_to_menu',10,2);*/


?>
