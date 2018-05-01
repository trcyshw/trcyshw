<?php
/**
 * 404 page
 *
 * @package WordPress
 */

get_header();
echo '<section id="error404">';
echo '<div class="inner">';
echo '<span class="title">Nope.</span>';
echo '<span class="text">Nothing to see here. <a href="' . esc_url( home_url() ) . '">Go home</a> or endure my continual disapproval.</span>';
echo '</div>';
echo '<a href="https://www.flickr.com/photos/tokutomi/8325662500/in/photostream" class="credit" target="_blank">Photo: Masaki Tokutomi</a>';
echo '</section>';
get_footer();
