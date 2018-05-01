<?php

// ===============================================================================================================================================
// Slug/permalink customisations
// ===============================================================================================================================================

/* Do not allow slugs matching existing directories
------------------------------------------------------------ */		
add_filter('wp_unique_post_slug_is_bad_hierarchical_slug','prevent_directory_slugs',10, 2);
function prevent_directory_slugs($bool, $slug) {
	if (is_dir( ABSPATH . '/' . $slug)) return TRUE;
	return $bool;
};

?>