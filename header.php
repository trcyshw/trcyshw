<?php
/**
 * The template for displaying our header
 *
 * @package WordPress
 */

?>
<!DOCTYPE html>
<html <?php body_class( 'no-js' ); ?> lang="en">
	<head>
		<?php
		echo '<title>';
		if ( function_exists( 'seo_page_title' ) ) {
			seo_page_title();
		} else {
			wp_title( '', 'right', true );
		};
		echo '</title>';
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage"> 
	<div class="wrapper">
		<header class="site-header">
			<div class="container">
				<div class="site-logo">
					<a href="<?php echo esc_html( home_url() ); ?>" rel="home">
						<?php get_template_part( '/assets/img/logo.svg' ); ?>
						<span><?php bloginfo( 'name' ); ?></span>
					</a>
				</div>
				<div class="col">
					<?php
					get_template_part( 'partials/social' );
					if ( has_nav_menu( 'main' ) ) {
						echo '<nav class="nav nav--main">';
						wp_nav_menu( array(
							'container'      => false,
							'menu_class'     => '',
							'menu_id'        => 'nav--main',
							'theme_location' => 'main',
						));
						echo '</nav>';
					};
					?>
				</div>
			</div>
		</header>

