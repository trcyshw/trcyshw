<?php
/**
 * Navigation walker functionality for themes.
 *
 * @package WordPress
 */

/**
 * Class for the dynamic shop menu.
 */
class Taxonomy_Menu extends Walker_Nav_Menu {
	/**
	 * Function for the Shop Menu.
	 *
	 * @param [type] $output [description].
	 * @param [type] $item [description].
	 * @param [type] $depth [description].
	 * @param [type] $args [description].
	 */
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if ( 'Shop' === $item->title ) {
			$taxonomy = 'product_cat';
			$terms = get_terms(
				array(
					'hide_empty' => 1,
					'meta_key' => 'order',
					'order' => 'asc',
					'orderby' => 'meta_value_num',
					'pad_counts'  => 1,
					'parent' => 0,
					'taxonomy' => $taxonomy,
				)
			);
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				$output .= '<ul class="sub-menu">';
				foreach ( $terms as $term ) {
					$output .= '<li class="menu-item menu-item-type-product_cat menu-item-' . $term->slug . ' menu-item-' . $term->term_id . '">';
					$output .= '<a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>';

					$children = get_terms(
						array(
							'hide_empty' => 1,
							'meta_key' => 'order',
							'order' => 'asc',
							'orderby' => 'meta_value_num',
							'pad_counts'  => 1,
							'parent' => $term->term_id,
							'taxonomy' => $taxonomy,
						)
					);

					if ( ! empty( $children ) && ! is_wp_error( $children ) ) {
						$output .= '<ul class="children">';
						foreach ( $children as $child ) {
							$output .= '<li class="menu-item menu-item-type-product_cat menu-item-' . $child->slug . ' menu-item-' . $child->term_id . '">';
							$output .= '<a href="' . esc_url( get_term_link( $child ) ) . '">' . esc_html( $child->name ) . '</a>';
							$output .= '</li>';
						}
						$output .= '</ul>';
					}
					$output .= '</li>';
				}
				$output .= '</ul>';
			}
			wp_reset_postdata();
		} // End if().
	}
}
