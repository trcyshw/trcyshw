jQuery( document ).ready( function( $ ) {

	if ( $( '.metadata-title input' ).length ) {
		$( '.metadata-title input' ).after( '<div class="metadata-title-max"></div>' );
	}
	if ( $( '.metadata-description textarea' ).length ) {
		$( '.metadata-description textarea' ).after( '<div class="metadata-description-max"></div>' );
	}

	function updatePageTitle() {
		if ( $( '.metadata-title input' ).length ) {
			var total = parseInt( $( '.metadata-title input' ).attr( 'maxlength' ) );
			var remaining = total - $( '.metadata-title input' ).val().length;
			$( '.metadata-title-max' ).text( remaining + ' characters remaining' );
			$( '.metadata-title-max' ).css( 'color', '#666666' );
			$( '.metadata-title input' ).css( 'border-bottom-color', 'green' );
			if ( remaining <= 10 ) {
				$( '.metadata-title input' ).css( 'border-bottom-color', 'orange' );
				$( '.metadata-title-max' ).css( 'color', 'orange' );
			}
			if ( remaining <= 0 ) {
				$( '.metadata-title input' ).css( 'border-bottom-color', 'red' );
				$( '.metadata-title-max' ).css( 'color', 'red' );
			}
		}
	}

	function updatePageDescription() {
		if ( $( '.metadata-description textarea' ).length ) {
			var total = parseInt( $( '.metadata-description textarea' ).attr( 'maxlength' ) );
			var remaining = total - $( '.metadata-description textarea' ).val().length;
			$( '.metadata-description-max' ).text( remaining + ' characters remaining' );
			$( '.metadata-description-max' ).css( 'color', '#666666' );
			$( '.metadata-description textarea' ).css( 'border-bottom-color', 'green' );
			if ( remaining <= 10 ) {
				$( '.metadata-description textarea' ).css( 'border-bottom-color', 'orange' );
				$( '.metadata-description-max' ).css( 'color', 'orange' );
			}
			if ( remaining <= 0 ) {
				$( '.metadata-description textarea' ).css( 'border-bottom-color', 'red' );
				$( '.metadata-description-max' ).css( 'color', 'red' );
			}
		}
	}

	updatePageTitle();

	$( '.metadata-title input' ).change( updatePageTitle );
	$( '.metadata-title input' ).keyup( updatePageTitle );

	updatePageDescription();

	$( '.metadata-description textarea' ).change( updatePageDescription );
	$( '.metadata-description textarea' ).keyup( updatePageDescription );

	if ( $( '.form-field.term-description-wrap' ).length ) {
		$( '.form-field.term-description-wrap' ).remove();
	}
});
