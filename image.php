<?php
if ( $post->post_parent ) {
	wp_redirect( get_permalink( $post->post_parent ), 301 );
} else {
	wp_redirect( site_url(), 301 );
}
die();
