jQuery( document ).ready( function( $ ) {

	// Filter long taxonomy and category lists with a textbox.
	// Source: http://blog.grapii.com/2010/08/how-to-build-a-simple-search-filter-with-jquery/
	( function( $ ) {
		jQuery.expr[':'].contains = function( a, i, m ) {
			return ( a.textContent || a.innerText || '' ).toUpperCase().indexOf( m[3].toUpperCase() ) >= 0;
		};

		function listFilter( header, list ) {
			var form = $( '<form>' ).attr({ 'class': 'filterform', 'action': '#' }),
			input = $( '<input>' ).attr({ 'class': 'filterinput widefat', 'placeholder': 'Filter list...', 'type': 'text' });
			console.log( list );
			$( form ).append( input ).prependTo( header );
			$( input ).change( function() {
				var filter = $( this ).val();
				if ( filter ) {
					$( list ).find( 'label:not(:contains(' + filter + '))' ).parent().hide();
					$( list ).find( 'label:contains(' + filter + ')' ).parent().show();
				} else {
					$( list ).find( 'li' ).show();
				}
				return false;
			}).keyup( function() {
				$( this ).change();
			});
		}

		$( function() {
			if ( $( '.categorychecklist li' ).length >= 10 ) {
				listFilter( $( '.categorydiv' ), $( '.categorychecklist' ) );
			}
		});
	}( jQuery ) );
});
