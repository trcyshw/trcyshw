<?php
/**
 * Add custom code to wp_head and wp_footer.
 *
 * @package WordPress
 */

/**
 * Add GA code from ACF to the header.
 */
function add_google_analytics_ua_code() {
	if ( '' !== get_option( 'options_google_analytics' ) ) {
		echo wp_kses( get_option( 'options_google_analytics' ), array(
			'script' => array(
				'src' => array(),
			),
		));
		echo "\n";
		echo '<script>
/* Track outbound links in Analytics */
var trackOutboundLink = function(url) {
	gtag(\'event\', \'click\', {
		\'event_category\': \'outbound\',
		\'event_label\': url,
		\'transport_type\': \'beacon\',
		\'event_callback\': function(){
			document.location = url;
		}
	});
}
</script>';
		echo "\n";
	}
}
add_action( 'wp_head', 'add_google_analytics_ua_code', 10 );

/**
 * Add script code from ACF to the header.
 */
function add_scripts_to_head() {
	if ( '' !== get_option( 'options_scripts_head' ) ) {
		$scripts = get_option( 'options_scripts_head' );
		for ( $i = 0; $i < $scripts; $i++ ) {
			$header_script = get_option( 'options_scripts_head_' . $i . '_script' );
			echo wp_kses( $header_script, array(
				'script' => array(
					'src' => array(),
				),
			));
			echo "\n";
		}
	}
}
add_action( 'wp_head', 'add_scripts_to_head', 10 );

/**
 * Add script code from ACF to the footer.
 */
function add_scripts_to_footer() {
	if ( '' !== get_option( 'options_scripts_footer' ) ) {
		$scripts = get_option( 'options_scripts_footer' );
		for ( $i = 0; $i < $scripts; $i++ ) {
			$footer_script = get_option( 'options_scripts_footer_' . $i . '_script' );
			echo wp_kses( $footer_script, array(
				'script' => array(
					'src' => array(),
				),
			));
			echo "\n";
		}
	}
}
add_action( 'wp_footer', 'add_scripts_to_footer', 10 );
