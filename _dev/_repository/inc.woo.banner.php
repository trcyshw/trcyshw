<section id="banner">
  <?php 
	 /*==============================================
        BANNER IMAGE
    ==============================================*/
	
	/* Variables used throughout banner. Theoretically, this is all you should have to edit to customise the banner. */
	$wanted_width = 1919; // how wide we want the banner, minus one pixel
	$wanted_height = 499; // how tall we want the banner, minus one pixel
	$image_size = 'banner'; // the WP thumbnail size we want to use
	$default_banner = get_stylesheet_directory_uri().'/assets/img/banners/default-banner.jpg';

	
	/* How this works */
	/*
		At each step, the script checks for an image and checks its size. 
		If the size does not meet the requirements set in the variables above, it will proceed to the next check.
		If all checks come back without an appropriately sized image, the default image will be shown (as per the path above). 
		
		Product category: Current category, parent category, top-level (root) category, default.
		Single product: Current product, product's first product category, that category's parent, top-level (root) category, default.
		Page: Current page, parent page, default. 
		Post: Current post, default. 
	*/
	
	/* Shop page */
	if (is_shop()) {
		// get the thumbnail id using the shop page ID (21)
		$thumbnail_id = get_post_thumbnail_id('21');
		// get the image URL
		$imgdata = wp_get_attachment_image_src($thumbnail_id,$image_size);
		// check the size
		$imgwidth = $imgdata[1]; // thumbnail's width  
		$imgheight = $imgdata[2]; // thumbnail's height   
		$image = $imgdata[0]; // image url     
		
		if ($imgdata) {
			// Check the size. If the size is OK, show it
			$imgwidth = $imgdata[1]; // thumbnail's width  
			$imgheight = $imgdata[2]; // thumbnail's height  
			$image = $imgdata[0]; // image url 
			if (($imgwidth > $wanted_width ) & ($imgheight > $wanted_height )) {
				echo '<img src="'.$image.'" alt="" />';
			} 
			else { 
				echo '<img src="'.$default_banner.'" />';
			}
		} else {
			echo '<img src="'.$default_banner.'" />';
		}
	}
		
		
	/* Product categories */
	else if (is_product_category()){
		
		// get the query object
		global $wp_query;
		$cat = $wp_query->get_queried_object();
		
		// get the top-level (root) ancestor (if there is one) for later use
		$term_id = $cat->term_id;
		$ancestors = array_reverse(get_ancestors( $term_id, 'product_cat' )); // Reverse it so the top level one is $ancestors[0] regardless of how many levels there are
		$root_cat = get_term( $ancestors[0], 'product_cat' );
		$root_cat_id = $root_cat->term_id;
		
		// get the thumbnail id using the term_id
		$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true ); 
		// get the image URL
		$imgdata = wp_get_attachment_image_src($thumbnail_id,$image_size);
		// check the size
		$imgwidth = $imgdata[1]; // thumbnail's width  
		$imgheight = $imgdata[2]; // thumbnail's height   
		$image = $imgdata[0]; // image url        
		
		// If there is an image set
		if ($imgdata) {
			// Check the size. If the size is OK, show it
			$imgwidth = $imgdata[1]; // thumbnail's width  
			$imgheight = $imgdata[2]; // thumbnail's height  
			$image = $imgdata[0]; // image url 
			if (($imgwidth > $wanted_width ) & ($imgheight > $wanted_height )) {
				echo '<img src="'.$image.'" alt="" />';
			} 
			// If the image doesn't match size requirements, show the parent category's image 
			else if($cat->parent > 0) {
				$thumbnail_id = get_woocommerce_term_meta( $cat->parent, 'thumbnail_id', true ); 
				$imgdata = wp_get_attachment_image_src($thumbnail_id,$image_size); 
				$imgwidth = $imgdata[1]; // thumbnail's width  
				$imgheight = $imgdata[2]; // thumbnail's height  
				$image = $imgdata[0]; // image url 
				
				// If the size is OK, show it      
				if (($imgwidth > $wanted_width ) & ($imgheight > $wanted_height )) {
					echo '<img src="'.$image.'" alt="" />';
				} 
				// If it isn't, go for the root category image
				else if ($root_cat_id > 0) {
					$thumbnail_id = get_woocommerce_term_meta( $root_cat_id, 'thumbnail_id', true ); 
					$imgdata = wp_get_attachment_image_src($thumbnail_id,$image_size); 
					// check the size
					$imgwidth = $imgdata[1]; // thumbnail's width  
					$imgheight = $imgdata[2]; // thumnail's height   
					$image = $imgdata[0]; // image url  
					if (($imgwidth > $wanted_width ) & ($imgheight > $wanted_height )) {
						echo '<img src="'.$image.'" alt="" />';
					} 
					else {
						echo '<img src="'.$default_banner.'" />';
					}
				}
				// Still no luck, default
				else {
					echo '<img src="'.$default_banner.'" />';
				}
				
			// If the parent category doesn't have an image, show the default
			} else {
				echo '<img src="'.$default_banner.'" />';
				//echo "There is no image to show";
			}
			
		} // End if there is a category image

		// If no image on this category, show the parent category's image 
		else if($cat->parent > 0) {
			$thumbnail_id = get_woocommerce_term_meta( $cat->parent, 'thumbnail_id', true ); 
			$imgdata = wp_get_attachment_image_src($thumbnail_id,$image_size); 
			// check the size
			$imgwidth = $imgdata[1]; // thumbnail's width  
			$imgheight = $imgdata[2]; // thumnail's height   
			$image = $imgdata[0]; // image url    
			//   
			// If the size is OK, show it      
			if (($imgwidth > $wanted_width ) & ($imgheight > $wanted_height )) {
				echo '<img src="'.$image.'" alt="" />';
			} 
			// If not, look for an image on the root category
			else if ($root_cat_id > 0) {
				$thumbnail_id = get_woocommerce_term_meta( $root_cat_id, 'thumbnail_id', true ); 
				$imgdata = wp_get_attachment_image_src($thumbnail_id,$image_size); 
				// check the size
				$imgwidth = $imgdata[1]; // thumbnail's width  
				$imgheight = $imgdata[2]; // thumnail's height   
				$image = $imgdata[0]; // image url  
				if (($imgwidth > $wanted_width ) & ($imgheight > $wanted_height )) {
					echo '<img src="'.$image.'" alt="" />';
				} 
				else {
					echo '<img src="'.$default_banner.'" />';
				}
			}
			// Otherwise, default
			else {
				echo '<img src="'.$default_banner.'" />';
			}
		}
		
		// If the parent category doesn't have an image either (or there is no parent category), check for an image on the root category if there is one
		else if ($root_cat_id > 0) {
			$thumbnail_id = get_woocommerce_term_meta( $root_cat_id, 'thumbnail_id', true ); 
			$imgdata = wp_get_attachment_image_src($thumbnail_id,$image_size); 
			// check the size
			$imgwidth = $imgdata[1]; // thumbnail's width  
			$imgheight = $imgdata[2]; // thumnail's height   
			$image = $imgdata[0]; // image url  
			if (($imgwidth > $wanted_width ) & ($imgheight > $wanted_height )) {
				echo '<img src="'.$image.'" alt="" />';
			} 
			else {
				echo '<img src="'.$default_banner.'" />';
			}
		}
		
		// If all else fails, fall back to the default image
		else { 
			echo '<img src="'.$default_banner.'" />';
		}
	}
	
	/* Products */
	else if (is_product() ) {
		
		if ( has_post_thumbnail() )  {
			$imgdata = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_size ); //change thumbnail to whatever size you are using
			$imgwidth = $imgdata[1]; // thumbnail's width  
			$imgheight = $imgdata[2]; // thumnail's height                 
			if (($imgwidth > $wanted_width ) & ($imgheight > $wanted_height )) {
				the_post_thumbnail($image_size);
			} 
			
			// If image isn't big enough, look for category image
			else if ($terms = get_the_terms( $post->ID, 'product_cat' )) {
				
				// We only want the first category if the product belongs to multiple
				$count=0;
		
				foreach ( $terms as $term ) { 
					// get the top-level (root) category for later use
					$term_id = $term->term_id;
					$ancestors = array_reverse(get_ancestors( $term_id, 'product_cat' )); // Reverse it so the top level one is $ancestors[0] regardless of how many levels there are
					$root_cat = get_term( $ancestors[0], 'product_cat' );
					$root_cat_id = $root_cat->term_id;

					
					// Get the immediate category's image
					$thumbnail_id = get_woocommerce_term_meta( $cat->parent, 'thumbnail_id', true ); 
					$imgdata = wp_get_attachment_image_src($thumbnail_id,$image_size); 
					// check the size
					$imgwidth = $imgdata[1]; // thumbnail's width  
					$imgheight = $imgdata[2]; // thumnail's height   
					$image = $imgdata[0]; // image url  
					// If the size is OK, show it      
					if (($imgwidth > $wanted_width ) & ($imgheight > $wanted_height )) {
						echo '<img src="'.$image.'" alt="" />';
					} 
					// If not big enough, check the category parent if there is one
					else if ($term->parent > 0) { 
						$thumbnail_id = get_woocommerce_term_meta( $term->parent, 'thumbnail_id', true ); 
						$imgdata = wp_get_attachment_image_src($thumbnail_id,$image_size); 
						// check the size
						$imgwidth = $imgdata[1]; // thumbnail's width  
						$imgheight = $imgdata[2]; // thumnail's height   
						$image = $imgdata[0]; // image url    
						//   
						// If the size is OK, show it      
						if (($imgwidth > $wanted_width ) & ($imgheight > $wanted_height )) {
							echo '<img src="'.$image.'" alt="" />';
						} 
						// If not, look for a root category image if there is one
						else if ($root_cat_id > 0) {
							$thumbnail_id = get_woocommerce_term_meta( $root_cat_id, 'thumbnail_id', true ); 
							$imgdata = wp_get_attachment_image_src($thumbnail_id,$image_size); 
							// check the size
							$imgwidth = $imgdata[1]; // thumbnail's width  
							$imgheight = $imgdata[2]; // thumnail's height   
							$image = $imgdata[0]; // image url  
							if (($imgwidth > $wanted_width ) & ($imgheight > $wanted_height )) {
								echo '<img src="'.$image.'" alt="" />';
							} 
							else {
								echo '<img src="'.$default_banner.'" />';
							}
						}
						// Still no luck, default
						else {
							echo '<img src="'.$default_banner.'" />';
						}
					}
					// If no image on immediate parent category, check for a root category with an image
					else if ($root_cat_id > 0) {
						$thumbnail_id = get_woocommerce_term_meta( $root_cat_id, 'thumbnail_id', true ); 
						$imgdata = wp_get_attachment_image_src($thumbnail_id,$image_size); 
						// check the size
						$imgwidth = $imgdata[1]; // thumbnail's width  
						$imgheight = $imgdata[2]; // thumnail's height   
						$image = $imgdata[0]; // image url  
						if (($imgwidth > $wanted_width ) & ($imgheight > $wanted_height )) {
							echo '<img src="'.$image.'" alt="" />';
						} 
						else {
							echo '<img src="'.$default_banner.'" />';
						}
					}
					// If all else fails, default
					else {
						echo '<img src="'.$default_banner.'" />';
					}
									
					// Stop after the first category
					$count++;
					if ($count==1) { break; }
		
				} // End foreach

				
			}

			// If the category image isn't set, check if the category has a parent, and if it does and that category has an image, show that
			else if ($term->parent > 0) { 
			  $thumbnail_id = get_woocommerce_term_meta( $term->parent, 'thumbnail_id', true ); 
			  $parentimage = wp_get_attachment_url( $thumbnail_id ); 
			  echo '<img src="'.$parentimage.'">';
			}
			  
			// If all of these fail, show default
			else {
				echo '<img src="'.$default_banner.'" />';
			}
		}

		
		else { 
		// If the product doesn't have a featured image, look for the first category's image
			global $post;
			$terms = get_the_terms( $post->ID, 'product_cat' );
		
			// We only want the first category if the product belongs to multiple
			$count=0;
		
			foreach ( $terms as $term ){ 
		 	$category_thumbnail = get_woocommerce_term_meta($term->term_id, 'thumbnail_id', true);
		  	$image = wp_get_attachment_url($category_thumbnail);
		  	if ($image) {
		  		echo '<img src="'.$image.'">';
		  	} 
		  
		  	// If the category image isn't set, check if the category has a parent, and if it does and that category has an image, show that
		  	else if ($term->parent > 0) { 
			  $thumbnail_id = get_woocommerce_term_meta( $term->parent, 'thumbnail_id', true ); 
			  $parentimage = wp_get_attachment_url( $thumbnail_id ); 
			  echo '<img src="'.$parentimage.'">';
		  	}
		  
		  	// If all else fails, default
		 	else {
				echo '<img src="'.$default_banner.'" />';
		  	}
		  
		  	// Stop after the first category
		  	$count++;
		  	if ($count==1) break;
			}
		
		}

	} 

	/* Pages & Posts */
	else { 
	
		if ( has_post_thumbnail() )  {
			$imgdata = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_size ); //change thumbnail to whatever size you are using
			$imgwidth = $imgdata[1]; // thumbnail's width  
			$imgheight = $imgdata[2]; // thumnail's height                 
			if (($imgwidth > $wanted_width ) & ($imgheight > $wanted_height )) {
				the_post_thumbnail($image_size);
			} 
			// If image isn't big enough, look for parent's image
			else if( has_post_thumbnail( $post->post_parent ) ) { 
				$parentimgdata = wp_get_attachment_image_src( get_post_thumbnail_id($post->post_parent), $image_size );
				$parentimgwidth = $parentimgdata[1]; // thumbnail's width  
				$parentimgheight = $parentimgdata[2]; // thumnail's height                 
				if (($parentimgwidth > $wanted_width ) & ($parentimgheight > $wanted_height )) {
				  	echo get_the_post_thumbnail( $post->post_parent, $image_size );
				} else {
					echo '<img src="'.$default_banner.'" />';
				}
			}
			else { 
				// If still not big enough, show default
				echo '<img src="'.$default_banner.'" />';
			}
		} // End if has_post_thumbnail
		
		else if ( has_post_thumbnail( $post->post_parent ) ) {  // If no thumbnail, look for parent's
			$parentimgdata = wp_get_attachment_image_src( get_post_thumbnail_id($post->post_parent), $image_size );
			$parentimgwidth = $parentimgdata[1]; // thumbnail's width  
			$parentimgheight = $parentimgdata[2]; // thumnail's height                 
			if (($parentimgwidth > $wanted_width ) & ($parentimgheight > $wanted_height )) {
			  echo get_the_post_thumbnail( $post->post_parent, $image_size );
			} else {
				echo '<img src="'.$default_banner.'" />';
			}
		}
		else {
			// Fall back to default if none of these conditions apply
			echo '<img src="'.$default_banner.'" />';
		}
	
	}
    ?>
  <?php
	/*==============================================
		HEADING
	==============================================*/
	?>
  <div class="wrapper">
    <div class="container">
      <?php if (is_404()) { ?>
      <h1>Not found</h1>
      <?php } 
			
			else if (is_page()) { ?>
      <h1>
        <?php if (function_exists('goop_seo_title')){ $seotitle = get_post_meta(get_the_ID(), 'the_seotitle', true); $oldseotitle = get_post_meta(get_the_ID(), 'wps_seotitle', true); if (!empty($seotitle)) { echo $seotitle; } elseif (!empty($oldseotitle) && empty($seotitle)) { echo $oldseotitle; } else {	the_title(); }; } else { the_title(); }; ?>
      </h1>
      <?php }

            else if (is_shop()) { ?>
      <h1>Ballarat Party Supplies</h1>
      <?php }
            
            else if (is_product_category()) { ?>
      <span class="heading"><?php echo single_cat_title(); ?></span>
      <?php } 
			
			else if (is_product() ) { 
				$terms = get_the_terms( $post->ID, 'product_cat' );
				
				$count=0; // We only want the first category
				foreach ($terms as $term) {
					echo '<span class="heading">'.$term->name.'</span>'; 
					// Stop after the first one
					$count++;
					if ($count==1) break;
				}
			}
			
			else if (is_single()) { ?>
      <h1>
        <?php the_title(); ?>
      </h1>
      <?php } 
            
            else if (is_search()) { ?>
      <h1>
        <?php $search_count = 0; $search = new WP_Query("s=$s & showposts=-1"); if($search->have_posts()) : while($search->have_posts()) : $search->the_post();	$search_count++; endwhile; endif; echo $search_count; ?>
        search results for &lsquo;
        <?php the_search_query(); ?>
        &rsquo;</h1>
      <?php } 

            else if (is_category()) { echo '<h1>'.single_cat_title().'</h1>'; }  
            else if (is_day()) { ?>
      <h1>
      Daily Archive:
      <?php the_time('F j Y') . '</h1>'; } 
            else if (is_month()) { ?>
      <h1>
      Monthly Archive:
      <?php the_time('F Y') . '</h1>'; } 
            else if (is_year()) { ?>
      <h1>
      Yearly Archive:
      <?php the_time('Y') . '</h1>'; } 
            else { echo get_bloginfo('name') . ' '; echo get_the_title(get_option('page_for_posts')); 
            } ?>
    </div>
  </div>
</section>