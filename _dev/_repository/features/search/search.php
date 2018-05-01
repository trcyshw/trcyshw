<?php get_header(); ?>
<section id="content" class="container">
	<div class="row">
    	<main class="twelve columns" role="main">
        	<h1><?php $search_count = 0; $search = new WP_Query("s=$s & showposts=-1"); if($search->have_posts()) : while($search->have_posts()) : $search->the_post();	$search_count++; endwhile; endif; echo $search_count; ?> search results for &lsquo;<?php the_search_query(); ?>&rsquo;</h1>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            	<?php get_template_part('parts/excerpt'); ?>
			<?php endwhile; else: ?>
            <p><?php _e('Sorry, nothing found.'); ?></p>
			<?php endif; ?>
			<?php get_template_part('parts/pagination'); ?>
		</main>
        <?php get_sidebar(); ?>
    </div>
</section>
<?php get_footer(); ?>