<?php

// ===============================================================================================================================================
// Search customisations
// ===============================================================================================================================================

/* Only search Pages and Posts, ignore custom post types (unless they're specified below)
------------------------------------------------------------ */
function custom_search_filter($query) {
	if (!$query->is_admin && $query->is_search) {
		$query->set('post_type', array('post','page',));
	}
	return $query;
}
add_filter( 'pre_get_posts', 'custom_search_filter' );

?>