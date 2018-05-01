<?php get_header(); ?>
<section id="content">
	<div class="container">
          <div class="row">
            <main class="sixteen columns" role="main">
                <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>        
                <h1><?php if (!is_shop()) { if (is_product()) { the_title(); } elseif ( is_product_category() ) { $wooseotitle_term = get_queried_object()->term_id; $wooseotitle_term_meta = get_option( "taxonomy_$wooseotitle_term" ); if ($wooseotitle_term_meta['the_woocategory_seotitle'] != '') { echo stripslashes($wooseotitle_term_meta['the_woocategory_seotitle']); } else { single_cat_title(); }} else { woocommerce_page_title(); }}; if (is_shop()) { if (function_exists('goop_seo_title')){ $seotitle = get_post_meta(220, 'the_seotitle', true); $oldseotitle = get_post_meta(220, 'wps_seotitle', true); if (!empty($seotitle)) { echo $seotitle; } elseif (!empty($oldseotitle) && empty($seotitle)) { echo $oldseotitle; }} /* Change the id to your shop page ID */ }; ?></h1>
                
                <?php woocommerce_content(); ?>
                
                
                
                <?php if ( is_product_category('sale')) { echo do_shortcode('[sale_products per_page="500"]'); } ?>
                <?php if ( is_product_category('new-arrivals')) { echo do_shortcode(' [recent_products per_page="30" orderby="date" order="desc"]'); } ?>
               
                
            </main>
            
            
            
          </div>
  </div>
</section>
<?php get_footer(); ?>