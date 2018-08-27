jQuery( document ).ready( function( $ ) {

	// Add scroll to top functionality.
	$( window ).scroll( function() {
		if ( 0 !== $( this ).scrollTop() ) {
			$( '.site-footer__scroll-to-top' ).fadeIn();
		} else {
			$( '.site-footer__scroll-to-top' ).fadeOut();
		}

		$( '.section' ).each( function() {
			var headerHeight = $( '.site-header' ).height();
			var offset = -headerHeight - 5;
			if ( $( window ).scrollTop() >= $( this ).offset().top + offset ) {
				var id = $( this ).attr( 'id' );
				$( '.nav--main ul li a' ).removeClass( 'current' );
				$( '.nav--main ul li a[href="#' + id + '"]' ).addClass( 'current' );
			}
	});

	});

	// Fade in/out scroll icon.
	$( '.site-footer__scroll-to-top' ).click( function() {
		$( 'html, body' ).animate({
			scrollTop: 0
		}, 800 );
	});

	$( 'a[href*="#"]:not([href="#"])' ).click( function() {
		var headerHeight = $( '.site-header' ).height();
		var offset = -headerHeight; // <-- change the value here.
		if ( location.pathname.replace( /^\//, '' ) == this.pathname.replace( /^\//, '' ) && location.hostname == this.hostname ) {
			var target = $( this.hash );
			target = target.length ? target : $( '[name=' + this.hash.slice( 1 ) + ']' );
			if ( target.length ) {
				$( 'html, body' ).animate({
					scrollTop: target.offset().top + offset
				}, 1000 );
				return false;
			}
		}
	});
}); // The End