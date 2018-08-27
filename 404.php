<?php
/**
 * 404 page
 *
 * @package WordPress
 */

get_header();
echo '<main class="content">';
echo '<div class="content__404">';
echo '<div class="container">';
echo '<span class="title">Nope.</span>';
echo '<span class="text">Nothing to see here. <a href="' . esc_url( home_url() ) . '">Go home</a> or endure my continual disapproval.</span>';
echo '</div>';
echo '<a href="https://www.flickr.com/photos/tokutomi/8325662500/in/photostream" class="content__404__credit" target="_blank">Photo: Masaki Tokutomi</a>';
echo '</div>';
echo '</main>';
get_footer();
