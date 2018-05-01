<?php
/* 
	BANNER USING BACKGROUND IMAGES INSTEAD OF IMG TAGS 
	WooCommerce support still to come
*/

if ( has_post_thumbnail() )  {
    $imgdata = wp_get_attachment_image_src( get_post_thumbnail_id(), 'banner' ); //change thumbnail to whatever size you are using
    $imgwidth = $imgdata[1]; // thumbnail's width  
	$imgheight = $imgdata[2]; // thumnail's height                 
    $wanted_width = 1919; 
	$wanted_height = 599;
    if (($imgwidth > $wanted_width ) & ($imgheight > $wanted_height )) {
        $setimage = $imgdata[0];
    } 
	// If image isn't big enough, look for parent's image
	else if( has_post_thumbnail( $post->post_parent ) ) { 
		$parentimgdata = wp_get_attachment_image_src( get_post_thumbnail_id($post->post_parent), 'banner' );
		$parentimgwidth = $parentimgdata[1]; // thumbnail's width  
		$parentimgheight = $parentimgdata[2]; // thumnail's height                 
		$wanted_width = 1919; 
		$wanted_height = 599;
		if (($parentimgwidth > $wanted_width ) & ($parentimgheight > $wanted_height )) {
		  $setimage = $parentimgdata[0];
		} 
	}
	else { 
		$setimage = get_stylesheet_directory_uri() . '/img/banners/banner-01.jpg'; 
	}
} // End if has_post_thumbnail

else if ( has_post_thumbnail( $post->post_parent ) ) {  // If no thumbnail, look for parent's
	$parentimgdata = wp_get_attachment_image_src( get_post_thumbnail_id($post->post_parent), 'banner' );
	$parentimgwidth = $parentimgdata[1]; // thumbnail's width  
	$parentimgheight = $parentimgdata[2]; // thumnail's height                 
	$wanted_width = 1919; 
	$wanted_height = 599;
	if (($parentimgwidth > $wanted_width ) & ($parentimgheight > $wanted_height )) {
	   $setimage = $parentimgdata[0];
	} 
}
else {
	$setimage = get_stylesheet_directory_uri() . '/img/banners/banner-01.jpg';
}
?>

<section id="banner" style="background-image: url(<?php echo $setimage; ?>)">
<div class="inner">
<?php if (!is_front_page()) { ?><div class="container"> <?php } ?>
<?php if ( is_404() ) { ?><h1>Sorry</h1><?php } else if ( is_page()) { ?><h1><?php if (function_exists('goop_seo_title')){ $seotitle = get_post_meta(get_the_ID(), 'the_seotitle', true); $oldseotitle = get_post_meta(get_the_ID(), 'wps_seotitle', true); if (!empty($seotitle)) { echo $seotitle; } elseif (!empty($oldseotitle) && empty($seotitle)) { echo $oldseotitle; } else {	the_title(); }; } else { the_title(); }; ?></h1><?php } else { ?><h1><?php if (is_single()) { $cats = get_the_category(); echo $cats[0]->name; } elseif (is_category()) { echo single_cat_title(); } elseif (is_day()) { ?> Daily Archive: <?php the_time('F j Y'); }  elseif (is_month()) { ?>  Monthly Archive: <?php the_time('F Y'); } elseif (is_year()) { ?> Yearly Archive: <?php the_time('Y'); } else { echo get_bloginfo('name') . ' '; echo '<span>' . get_the_title(get_option('page_for_posts') . '</span>' ); } ?></h1><?php } ?>
<?php if (!is_front_page()) { ?></div> <?php } ?>
</div>
</section>