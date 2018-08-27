<?php
/**
 * Functions for images, galleries and the Media Library
 *
 * @package WordPress
 */

/**
 * Thumbnail Support and custom image sizes - add more as needed.
 */
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 480, 480, true );
/**
 * Get media sizes from our options to replace WordPress defaults.
 */
$media_size_default_large_h     = get_option( 'options_media_sizes_default_large_height' );
$media_size_default_large_w     = get_option( 'options_media_sizes_default_large_height' );
$media_size_default_medium_h    = get_option( 'options_media_sizes_default_medium_height' );
$media_size_default_medium_w    = get_option( 'options_media_sizes_default_medium_height' );
$media_size_default_thumbnail_h = get_option( 'options_media_sizes_default_thumbnail_height' );
$media_size_default_thumbnail_w = get_option( 'options_media_sizes_default_thumbnail_height' );
/**
 * Update default media sizes.
 */
update_option( 'large_size_h', $media_size_default_large_h );
update_option( 'large_size_w', $media_size_default_large_w );
update_option( 'medium_size_h', $media_size_default_medium_h );
update_option( 'medium_size_w', $media_size_default_medium_w );
update_option( 'thumbnail_size_h', $media_size_default_thumbnail_h );
update_option( 'thumbnail_size_w', $media_size_default_thumbnail_w );
/**
 * Add our own custom sizes.
 */
$custom_media_sizes = get_option( 'options_media_sizes_custom' );
if ( $custom_media_sizes ) {
	for ( $m = 0; $m < $custom_media_sizes; $m++ ) {
		$crop   = get_option( 'options_media_sizes_custom_' . $m . '_crop' );
		$height = get_option( 'options_media_sizes_custom_' . $m . '_height' );
		$name   = get_option( 'options_media_sizes_custom_' . $m . '_name' );
		$width  = get_option( 'options_media_sizes_custom_' . $m . '_width' );
		add_image_size( $name, $width, $height, $crop );
	}
}

// Increase max srcset width to bigger than its default of 1600.
add_filter( 'max_srcset_image_width',
	function( $max_srcset_image_width, $size_array ) {
		return 2000;
	},
	10, 2
);

/**
 * Remove WordPress gallery shortcode inline styles
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Strip the gallery shortcode from the content.
 *
 * @param [type] $content [description].
 */
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

/**
 * Attach a class to linked images' parent anchors.
 *
 * @param  [type] $content [description].
 */
function ts_linked_images_class( $content ) {
	$classes = 'img';
	if ( preg_match( '/<a.*? class=".*?"><img/', $content ) ) {
		$content = preg_replace( '/(<a.*? class=".*?)(".*?><img)/', '$1 ' . $classes . '$2', $content );
	} else {
		$content = preg_replace( '/(<a.*?)><img/', '$1 class="' . $classes . '" ><img', $content );
	}
	return $content;
}
add_filter( 'the_content', 'ts_linked_images_class' );

/**
 * Always default to 'None' when inserting images.
 */
function default_attachment_display_settings() {
	update_option( 'image_default_align', 'none' );
	update_option( 'image_default_link_type', 'none' );
	update_option( 'image_default_size', 'full' );
}
add_action( 'after_setup_theme', 'default_attachment_display_settings' );

/**
 * Get the caption of an image and display it in our lightbox.
 *
 * @param [type] $link [description].
 * @param [type] $id   [description].
 */
function add_title_attachment_link( $link, $id = null ) {
	$id         = intval( $id );
	$_post      = get_post( $id );
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

/**
 * Add tags for attachments.
 */
function add_tags_for_attachments() {
	register_taxonomy_for_object_type( 'post_tag', 'attachment' );
}
add_action( 'init', 'add_tags_for_attachments' );

/**
 * Change upload directory for non-image files only.
 *
 * @param  [type] $file [description].
 * @return [type]       [description].
 */
function file_pre_upload( $file ) {
	add_filter( 'upload_dir', 'file_custom_upload_dir' );
	return $file;
}
/**
 * Change upload directory for non-image files only.
 *
 * @param  [type] $fileinfo [description].
 * @return [type]           [description].
 */
function file_post_upload( $fileinfo ) {
	remove_filter( 'upload_dir', 'file_custom_upload_dir' );
	return $fileinfo;
}
/**
 * Change upload directory for non-image files only.
 *
 * @param  [type] $path [description].
 * @return [type]       [description].
 */
function file_custom_upload_dir( $path ) {
	$extension = substr( strrchr( $_POST['name'], '.' ), 1 );
	if ( ! empty( $path['error'] ) || 'bmp' === $extension || 'gif' === $extension || 'jpg' === $extension || 'jpeg' === $extension || 'png' === $extension ) {
		return $path; // error or other filetype; do nothing.
	}
	$customdir      = '/files';
	$path['path']   = str_replace( $path['subdir'], '', $path['path'] ); // remove default subdir (year/month).
	$path['url']    = str_replace( $path['subdir'], '', $path['url'] );
	$path['subdir'] = $customdir;
	$path['path']  .= $customdir;
	$path['url']   .= $customdir;
	return $path;
}
add_filter( 'wp_handle_upload_prefilter', 'file_pre_upload' );
add_filter( 'wp_handle_upload', 'file_post_upload' );

/**
 * Make galleries link to Media File.
 *
 * @param  [type] $out   [description].
 * @param  [type] $pairs [description].
 * @param  [type] $atts  [description].
 */
function gallery_should_link_to_files( $out, $pairs, $atts ) {
	$atts        = shortcode_atts( array(
		'link' => 'file',
	), $atts );
	$out['link'] = $atts['link'];
	return $out;
}
add_filter( 'shortcode_atts_gallery', 'gallery_should_link_to_files', 10, 3 );

/**
 * Automatically set the image Title, Alt-Text, Caption and Description* upon upload.
 * Description is optional, it is commented out by default.
 * Source: https://brutalbusiness.com/automatically-set-the-wordpress-image-title-alt-text-other-meta/
 *
 * @param [type] $post_id [desc].
 */
function set_image_meta_on_upload( $post_id ) {
	// Check if uploaded file is an image, else do nothing.
	if ( wp_attachment_is_image( $post_id ) ) {
		$the_photo_title = get_post( $post_id )->post_title;
		// Sanitise the title: remove hyphens, underscores & extra spaces.
		$the_photo_title = preg_replace( '%\s*[-_\s]+\s*%', ' ', $the_photo_title );
		// Sanitise the title:  capitalize first letter of every word (other letters lower case).
		$the_photo_title = ucwords( strtolower( $the_photo_title ) );
		// Create an array with the image meta (Title, Caption, Description) to be updated.
		// Description is not updated by default, uncomment the line below to implement it.
		$the_photo_meta = array(
			'ID'           => $post_id, // Specify the image (ID) to be updated.
			'post_title'   => $the_photo_title, // Set image Title to sanitised title.
			'post_excerpt' => $the_photo_title, // Set image Caption (Excerpt) to sanitised title.
			// 'post_content' => $the_photo_title, // Set image Description (Content) to sanitised title.
		);
		// Set the image Alt-Text.
		update_post_meta( $post_id, '_wp_attachment_image_alt', $the_photo_title );
		// Set the image meta (e.g. Title, Excerpt, Content).
		wp_update_post( $the_photo_meta );
	}
}
add_action( 'add_attachment', 'set_image_meta_on_upload' );
