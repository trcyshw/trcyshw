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
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<title><?php
		if ( function_exists( 'seo_page_title' ) ) {
			seo_page_title();
		} else {
			echo 'Tracey Shaw | WordPress Developer';
		}; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link rel="icon" type="image/png" href="<?php bloginfo( 'template_directory' ); ?>/assets/img/icons/favicon.png" />
		<link rel="apple-touch-icon-precomposed" href="<?php bloginfo( 'template_directory' ); ?>/assets/img/icons/favicon.png?1">
		<?php wp_head(); ?>
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-100943408-1', 'auto');
  ga('send', 'pageview');

</script>
	</head>
<body <?php
if ( is_page() ) {
	echo ' id="page-' . esc_attr( $post->post_name ) . '" ';
};
body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
<div id="<?php echo esc_attr( wp_get_theme()->get( 'TextDomain' ) ); ?>">
