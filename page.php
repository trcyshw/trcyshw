<?php
/**
 * Homepage template
 *
 * @package WordPress
 */

get_header();
$attachment = get_post_meta( get_the_ID(), '_thumbnail_id', true );
$content    = get_extended( apply_filters( 'the_content', get_post_field( 'post_content', get_the_ID() ) ) ); ?>
<div class="site-hero section">
	<div class="site-hero__inner">
		<h1 class="site-hero__inner__title underline">
			<?php bloginfo( 'name' ); ?>
		</h1>
		<div class="site-hero__inner__subtitle">
			<?php
			if ( strpos( $post->post_content, '<!--more-->' ) ) {
				echo wp_kses_post( $content ['main'] );
			}
			?>
		</div>
	</div>
	<i class="fal fa-angle-down"></i>
</div>
<main class="content">
	<?php get_template_part( 'partials/websites' ); ?>
	<div class="content__profile section" id="profile">
		<div class="container">
			<h2 class="underline">Profile</h2>
			<?php
			if ( $attachment ) {
				$photo = wp_get_attachment_url( $attachment );
				echo '<div class="content__profile__photo" style="background-image: url(' . esc_url( $photo ) . ');"></div>';
			}
			if ( strpos( $post->post_content, '<!--more-->' ) ) {
				echo wp_kses_post( $content ['extended'] );
			} else {
				the_content();
			}
			?>
		</div>
	</div>
</main>
<?php
get_footer();
