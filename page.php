<?php
/**
 * Homepage template
 *
 * @package WordPress
 */

get_header();
echo '<section id="content" class="container">';
echo '<main>';
echo '<div id="websites">';
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		echo '<article id="post-' . esc_attr( get_the_ID() ) . '" ';
		post_class( 'bio' );
		echo '>';
		echo '<div class="overview">';
		echo '<div class="inner">';
		echo '<span class="title">' . esc_attr( get_bloginfo( 'name' ) ) . '</span>';
		$trcyshw = get_extended( apply_filters( 'the_content', get_post_field( 'post_content', get_the_ID() ) ) );
		if ( strpos( $post->post_content, '<!--more-->' ) ) {
			echo wp_kses_post( $trcyshw ['main'] );
			echo ' <span class="more inline">Long Version <i class="fa fa-angle-right"></i></span>';
		} else {
			echo '<span class="more">Read More <i class="fa fa-angle-right"></i></span>';
		}
		echo '<ul class="connect">';
		echo '<li><a href="mailto:hello@trcyshw.com?subject=Via%20trcyshw.com"><i class="fa fa-envelope"></i></a></li>';
		echo '<li><a href="https://www.github.com/trcyshw" target="_blank"><i class="fa fa-github"></i></a></li>';
		echo '<li><a href="https://www.linkedin.com/in/traceyshaw/" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
		echo '</ul>';
		echo '</div>';
		echo '</div>';
		echo '</article>';
		echo '<article ';
		post_class( 'expanded bio' );
		echo '>';
		echo '<span class="close"></span>';
		if ( strpos( $post->post_content, '<!--more-->' ) ) {
			echo '<p>';
			echo wp_kses_post( $trcyshw ['extended'] );
		} else {
			the_content();
		}
		echo '</article>';
	}
} // End if().
get_template_part( 'parts/websites' );
echo '</div>';
echo '</main>';
echo '</section>';
get_footer();
