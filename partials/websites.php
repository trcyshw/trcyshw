<?php
/**
 * Previous work part for theme.
 *
 * @package WordPress
 */

$previous_work = get_post_meta( get_the_ID(), '_previous_work', true ); ?>
<div class="content__websites section" id="work">
	<h2 class="underline">Previous Work</h2>
	<?php
	if ( $previous_work ) {
		echo '<div class="content__websites__introduction">';
		echo wp_kses_post( wpautop( $previous_work ) );
		echo '</div>';
	}
	?>
	<div class="content__websites__loading"><i class="fal fa-circle-notch fa-spin"></i></div>
	<div class="content__websites__websites-list"></div>
	<div class="content__websites__show-more" style="display: none;"><span class="btn btn-brand2">Show more websites</span></div>
</div>
