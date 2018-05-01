<?php

/**
 * Functions for images, galleries and the Media Library
 *
 * @package WordPress
 */

// Thumbnail Support and custom image sizes - add more as needed.
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 480, 480, true );
add_image_size( 'banner', 1920, 600, true );

// Strip the gallery shortcode from the content.
function strip_shortcode_gallery( $content ) {
	preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );
	if ( ! empty( $matches ) ) {
		foreach ( $matches as $shortcode ) {
			if ( 'gallery' === $shortcode[2] ) {
				$pos = strpos( $content, $shortcode[0] );
				if ( false !== $pos ) {
					return substr_replace( $content, '', $pos, strlen( $shortcode[0] ) );
				}
			}
		}
	}
	return $content;
}

// Increase max srcset width to bigger than its default of 1600.
add_filter( 'max_srcset_image_width',
	function( $max_srcset_image_width, $size_array ) {
		return 2000;
	},
	10, 2
);

// Attach a class to linked images' parent anchors.
function goop_linked_images_class( $content ) {
	$classes = 'img';
	if ( preg_match( '/<a.*? class=".*?"><img/', $content ) ) {
		$content = preg_replace( '/(<a.*? class=".*?)(".*?><img)/', '$1 ' . $classes . '$2', $content );
	} else {
		$content = preg_replace( '/(<a.*?)><img/', '$1 class="' . $classes . '" ><img', $content );
	}
	return $content;
}
add_filter( 'the_content','goop_linked_images_class' );

// Always default to 'None' when inserting images and to 'Media File' when inserting galleries.
function default_attachment_display_settings() {
	update_option( 'image_default_align', 'none' );
	update_option( 'image_default_link_type', 'none' );
	update_option( 'image_default_size', 'full' );
}
add_filter(
	'shortcode_atts_gallery',
	function( $out ) {
		$out['link'] = 'file';
		return $out;
	}
);
add_action( 'after_setup_theme', 'default_attachment_display_settings' );

// Get the caption of an image and display it in our lightbox
function add_title_attachment_link( $link, $id = null ) {
	$id = intval( $id );
	$_post = get_post( $id );
	$post_title = esc_attr( $_post->post_excerpt );
	return str_replace( '<a href', '<a title="' . $post_title . '" href', $link );
}
add_filter( 'wp_get_attachment_link', 'add_title_attachment_link', 10, 2 );

// Switch default core markup to output HTML5 for galleries.
add_theme_support(
	'html5', array(
		'gallery',
		'caption',
	)
);

// Add tags for attachments.
function add_tags_for_attachments() {
	register_taxonomy_for_object_type( 'post_tag', 'attachment' );
}
add_action( 'init' , 'add_tags_for_attachments' );

// Change upload directory for PDF files only.
function pdf_pre_upload( $file ) {
	add_filter( 'upload_dir', 'pdf_custom_upload_dir' );
	return $file;
}
function pdf_post_upload( $fileinfo ) {
	remove_filter( 'upload_dir', 'pdf_custom_upload_dir' );
	return $fileinfo;
}
function pdf_custom_upload_dir( $path ) {
	$extension = substr( strrchr( $_POST['name'],'.' ), 1 );
	if ( ! empty( $path['error'] ) || 'pdf' !== $extension ) {
		return $path;
	} //error or other filetype; do nothing.
	$customdir = '/pdf';
	$path['path'] = str_replace( $path['subdir'], '', $path['path'] ); // remove default subdir (year/month).
	$path['url'] = str_replace( $path['subdir'], '', $path['url'] );
	$path['subdir']  = $customdir;
	$path['path'] .= $customdir;
	$path['url'] .= $customdir;
	return $path;
}
add_filter( 'wp_handle_upload_prefilter', 'pdf_pre_upload' );
add_filter( 'wp_handle_upload', 'pdf_post_upload' );
