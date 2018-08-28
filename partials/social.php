<?php
/**
 * Social media part for theme
 *
 * @package WordPress
 */

$email     = get_option( 'options_social_email' );
$facebook  = get_option( 'options_social_facebook' );
$github    = get_option( 'options_social_github' );
$instagram = get_option( 'options_social_instagram' );
$linkedin  = get_option( 'options_social_linkedin' );
$twitter   = get_option( 'options_social_twitter' );
if ( $email || $facebook . $github . $instagram . $linkedin . $twitter ) {
	echo '<ul class="site-contact">';
	if ( $email ) {
		echo '<li><a href="mailto:' . sanitize_email( $email ) . '?subject=via%20trcyshw.com"><i class="fal fa-envelope"></i></a></li>';
	}
	if ( $facebook ) {
		echo '<li><a href="' . esc_url( $facebook ) . '" target="_blank" rel="nofollow"><i class="fab fa-facebook-square"></i></a></li>';
	}
	if ( $github ) {
		echo '<li><a href="' . esc_url( $github ) . '" target="_blank" rel="nofollow"><i class="fab fa-github-square"></i></a></li>';
	}
	if ( $instagram ) {
		echo '<li><a href="' . esc_url( $instagram ) . '" target="_blank" rel="nofollow"><i class="fab fa-instagram"></i></a></li>';
	}
	if ( $linkedin ) {
		echo '<li><a href="' . esc_url( $linkedin ) . '" target="_blank" rel="nofollow"><i class="fab fa-linkedin"></i></a></li>';
	}
	if ( $twitter ) {
		echo '<li><a href="' . esc_url( $twitter ) . '" target="_blank" rel="nofollow"><i class="fab fa-twitter"></i></a></li>';
	}
	echo '</ul>';
}
