<?php
/**
 * Metadata for pages and posts
 *
 * @package WordPress
 */
wp_nonce_field( 'seo_nonce_action', 'seo_nonce' );
$metadata_title = get_post_meta( $post->ID, 'metadata_title', true );
$metadata_description = get_post_meta( $post->ID, 'metadata_description', true );
$metadata_keywords = get_post_meta( $post->ID, 'metadata_keywords', true );
$metadata_index = get_post_meta( $post->ID, 'metadata_index', true );
$metadata_follow = get_post_meta( $post->ID, 'metadata_follow', true );
$metadata_advanced = get_post_meta( $post->ID, 'metadata_advanced', true );
$metadata_advanced_noodp = get_post_meta( $post->ID, 'metadata_advanced_noodp', true );
$metadata_advanced_noimageindex = get_post_meta( $post->ID, 'metadata_advanced_noimageindex', true );
$metadata_advanced_noarchive = get_post_meta( $post->ID, 'metadata_advanced_noarchive', true );
$metadata_advanced_nosnippet = get_post_meta( $post->ID, 'metadata_advanced_nosnippet', true );
$metadata_sitemap = get_post_meta( $post->ID, 'metadata_sitemap', true );
$metadata_canonical = get_post_meta( $post->ID, 'metadata_canonical', true );
$metadata_adwords = get_post_meta( $post->ID, 'metadata_adwords', true );
if ( empty( $metadata_title ) ) {
	$metadata_title = '';
}
if ( empty( $metadata_description ) ) {
	$metadata_description = '';
}
if ( empty( $metadata_keywords ) ) {
	$metadata_keywords = '';
}
if ( empty( $metadata_index ) ) {
	$metadata_index = '';
}
if ( empty( $metadata_follow ) ) {
	$metadata_follow = '';
}
if ( empty( $metadata_advanced ) ) {
	$metadata_advanced = '';
}
if ( empty( $metadata_sitemap ) ) {
	$metadata_sitemap = '';
}
if ( empty( $metadata_canonical ) ) {
	$metadata_canonical = '';
}
if ( empty( $metadata_adwords ) ) {
	$metadata_adwords = '';
}
echo '<table class="form-table">';
echo '<tr>';
echo '<th><label for="metadata_title" class="metadata_title_label">Page Title</label></th>';
echo '<td>';
echo '<input type="text" id="metadata_title" name="metadata_title" class="metadata_title_field widefat" placeholder="" value="' . esc_attr( $metadata_title ) . '"><span class="metadata_title_max" style="color: #666666; display: block; font-size: 12px; padding:5px 0 0; text-align: right;"></span>';
echo '</td>';
echo '</tr>';
echo '<tr>';
echo '<th><label for="metadata_description" class="metadata_description_label">Page Description</label></th>';
echo '<td>';
echo '<textarea id="metadata_description" name="metadata_description" class="metadata_description_field widefat" style="height:100px;" placeholder="">' . esc_attr( $metadata_description ) . '</textarea><span class="metadata_description_max" style="color: #666666; display: block; font-size: 12px; padding:1px 0 0; text-align: right;"></span>';
echo '</td>';
echo '</tr>';
echo '<tr>';
echo '<th><label for="metadata_keywords" class="metadata_keywords_label">Page Keywords</label></th>';
echo '<td>';
echo '<textarea id="metadata_keywords" name="metadata_keywords" class="metadata_keywords_field widefat" style="height:50px;" placeholder="" maxlength="180">' . esc_attr( $metadata_keywords ) . '</textarea>';
echo '</td>';
echo '</tr>';
echo '<tr>';
echo '<th colspan="2" style="font-weight:normal;">';
echo '<span style="border-top:1px dotted #cccccc; display: block;padding: 20px 0 0;"><strong>Note:</strong> changing the values below will affect SEO, so make sure you have checked the correct boxes. All boxes are optional.</span>';
echo '</th>';
echo '</tr>';
echo '<tr>';
echo '<th><label for="metadata_index" class="metadata_follow_label">Meta robots index</label></th>';
echo '<td>';
echo '<label><input type="checkbox" name="metadata_index" class="metadata_index_field" value="noindex" ' . checked( $metadata_index, 'noindex', false ) . '>noindex</label><br>';
echo '</td>';
echo '</tr>';
echo '<tr>';
echo '<th><label for="metadata_follow" class="metadata_follow_label">Meta robots follow</label></th>';
echo '<td>';
echo '<label><input type="checkbox" name="metadata_follow" class="metadata_follow_field" value="nofollow" ' . checked( $metadata_follow, 'nofollow', false ) . '>nofollow</label><br>';
echo '</td>';
echo '</tr>';
echo '<tr>';
echo '<th><label for="metadata_advanced" class="metadata_advanced_label">Meta robots advanced</label></th>';
echo '<td>';
echo '<label><input type="checkbox" name="metadata_advanced_noodp" class="custom_checkbox_field" value="noodp" ' . checked( $metadata_advanced_noodp, 'noodp', false ) . '>noodp</label><br>';
echo '<label><input type="checkbox" name="metadata_advanced_noimageindex" class="custom_checkbox_field" value="noimageindex" ' . checked( $metadata_advanced_noimageindex, 'noimageindex', false ) . '>noimageindex</label><br>';
echo '<label><input type="checkbox" name="metadata_advanced_noarchive" class="custom_checkbox_field" value="noarchive" ' . checked( $metadata_advanced_noarchive, 'noarchive', false ) . '>noarchive</label><br>';
echo '<label><input type="checkbox" name="metadata_advanced_nosnippet" class="custom_checkbox_field" value="nosnippet" ' . checked( $metadata_advanced_nosnippet, 'nosnippet', false ) . '>nosnippet</label><br>';
echo '</td>';
echo '</tr>';
echo '<tr>';
echo '<th><label for="metadata_sitemap" class="metadata_follow_label">Exclude from sitemap</label></th>';
echo '<td>';
echo '<label><input type="checkbox" name="metadata_sitemap" class="metadata_sitemap_field" value="exclude" ' . checked( $metadata_sitemap, 'exclude', false ) . '>Yes</label><br>';
echo '</td>';
echo '</tr>';
$screen = get_current_screen();
if ( 'page' === $screen->post_type || 'post' === $screen->post_type ) {
	echo '<tr>';
	echo '<th colspan="2" style="font-weight:normal;">';
	echo '<span style="border-top:1px dotted #cccccc; display: block;padding: 0;"></span>';
	echo '</th>';
	echo '</tr>';
	echo '<tr>';
	echo '<th><label for="metadata_adwords" class="metadata_adwords_label">Google Adwords</label></th>';
	echo '<td>';
	echo '<textarea id="metadata_adwords" name="metadata_adwords" class="metadata_adwords_field widefat" style="height:80px;" placeholder="" maxlength="180">' . esc_attr( $metadata_adwords ) . '</textarea>';
	echo '</td>';
	echo '</tr>';
};
echo '</table>';
