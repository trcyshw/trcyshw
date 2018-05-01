<section id="banner">
<?php 
if ( has_post_thumbnail() )  {
    $imgdata = wp_get_attachment_image_src( get_post_thumbnail_id(), 'banner' ); //change thumbnail to whatever size you are using
    $imgwidth = $imgdata[1]; // thumbnail's width  
	$imgheight = $imgdata[2]; // thumnail's height                 
    $wanted_width = 1919; 
	$wanted_height = 499;
    if (($imgwidth > $wanted_width ) & ($imgheight > $wanted_height )) {
        the_post_thumbnail('banner');
    } 
	// If image isn't big enough, look for parent's image
	else if( has_post_thumbnail( $post->post_parent ) ) { 
		$parentimgdata = wp_get_attachment_image_src( get_post_thumbnail_id($post->post_parent), 'banner' );
		$parentimgwidth = $parentimgdata[1]; // thumbnail's width  
		$parentimgheight = $parentimgdata[2]; // thumnail's height                 
		$wanted_width = 1919; 
		$wanted_height = 499;
		if (($parentimgwidth > $wanted_width ) & ($parentimgheight > $wanted_height )) {
		  echo get_the_post_thumbnail( $post->post_parent, 'banner' );
		} 
	}
	else { 
		// If still not big enough, show default
		echo '<img src="'.get_stylesheet_directory_uri().'/img/banners/default-banner.jpg" />';
	}
} // End if has_post_thumbnail

else if ( has_post_thumbnail( $post->post_parent ) ) {  // If no thumbnail, look for parent's
	$parentimgdata = wp_get_attachment_image_src( get_post_thumbnail_id($post->post_parent), 'banner' );
	$parentimgwidth = $parentimgdata[1]; // thumbnail's width  
	$parentimgheight = $parentimgdata[2]; // thumnail's height                 
	$wanted_width = 1919; 
	$wanted_height = 499;
	if (($parentimgwidth > $wanted_width ) & ($parentimgheight > $wanted_height )) {
	  echo get_the_post_thumbnail( $post->post_parent, 'banner' );
	} 
}
else {
	// Fall back to default if none of these conditions apply
	echo '<img src="'.get_stylesheet_directory_uri().'/img/banners/default-banner.jpg" />';
}
?>
</section>