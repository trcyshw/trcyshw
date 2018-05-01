<?php
/**
 * Websites list
 *
 * @package WordPress
 */

$args = array(
	'orderby' => 'rand',
	'post_type' => 'website',
	'post_status' => 'publish',
	'posts_per_page' => '11',
);
$websites = new WP_Query( $args );
if ( $websites->have_posts() ) {
	while ( $websites->have_posts() ) {
		$websites->the_post();
		$website_url = get_post_meta( get_the_ID(), 'website_url', true );
		$website_url = trim( $website_url, '/' );
		if ( ! preg_match( '#^http(s)?://#', $website_url ) ) {
			$website_url = 'http://' . $website_url;
		}
		$website_url_parts = wp_parse_url( $website_url );
		$domain = preg_replace( '/^www\./', '', $website_url_parts['host'] );
		if ( has_post_thumbnail() ) {
			$website_image = wp_get_attachment_url( get_post_thumbnail_id(), 'website' );
			$website_image = ' style="background-image: url(' . $website_image . ')"';
		} else {
			$website_image = '';
		};
		echo '<article id="post-' . esc_attr( get_the_ID() ) . '" ';
		post_class();
		echo wp_kses_post( $website_image ) . '>';
		echo '<div class="overview">';
		echo '<div class="inner">';
		echo '<span class="title">' . get_the_title() . '</span>';
		$terms = get_the_terms( get_the_ID(), 'industry' );
		if ( $terms && ! is_wp_error( $terms ) ) {
			$industry_links = array();
			foreach ( $terms as $term ) {
				$industry_links[] = $term->name;
			}
			$industry = '<span class="industry">' . join( ' &bull; ', $industry_links ) . '</span>';
			printf( ( '%s' ), wp_kses_post( $industry ) );
		}
		echo '</div>';
		echo '</div>';
		if ( get_the_content() ) {
			echo '<div class="content">';
			echo '<div class="inner">';
			echo wp_kses_post( get_the_content() );
			if ( $website_url ) {
				echo '<br /><a href="' . esc_url( $website_url ) . '" class="url" target="_blank">' . esc_html( $domain ) . '</a>';
			}
			echo '</div>';
			echo '</div>';
		}
		echo '</article>';
	}
}
wp_reset_postdata();
