jQuery( document ).ready( function( $ ) {

	// Use Modernizr to add mouse class in place of touch class on devices without touchscreen.
	$( window ).one({
		mouseover: function() {
			Modernizr.touch = false;
			$( 'html' ).removeClass( 'touch' ).addClass( 'mouse' );
		}
	});

	/* ------------------------------------------------------------------------------
	 * HEADER / NAVIGATION
	/* --------------------------------------------------------------------------- */

	// Fixed header - detects height when page is loaded.
	$( function() {
		$( '.wrapper' ).each( function() {
			var headerHeight = $( '.site-header' ).height();
			//$( this ).css( 'padding-top', headerHeight + 'px' );
			$( '.site-header' ).css( 'position', 'fixed' );
		});
	});

	// Fixed header - try to gauge the height when resized.
	$( window ).resize( function() {
		var headerHeight = $( '.site-header' ).height();
		//$( '.wrapper' ).css( 'padding-top', headerHeight + 'px' );
		$( '.site-header' ).css( 'position', 'fixed' );
	}).resize();

	// Fixed header - adds a class on scroll (perfect for animated header height etc)
	$( function() {
		var shrinkHeader = 100;
		$( window ).scroll( function() {
			var scroll = getCurrentScroll();
			if ( scroll >= shrinkHeader ) {
				$( '.site-header' ).addClass( 'fixed' );
			} else {
				$( '.site-header' ).removeClass( 'fixed' );
			}
		});

		function getCurrentScroll() {
			return window.pageYOffset || document.documentElement.scrollTop;
		}
	});


	// Enable the responsive menu slide
	$( '.mobile-menubar .mobile-menubar__menu' ).click( function() {
		$( '.nav.nav--mobile' ).toggleClass( 'slide' );
		$( 'body' ).toggleClass( 'no-scroll mobile' );
	});

	$( '.nav.nav--mobile' ).click( function() {
		$( '.nav.nav--mobile' ).toggleClass( 'slide' );
		$( 'body' ).toggleClass( 'no-scroll mobile' );
	});
	$( '.nav.nav--mobile ul.nav--mobile' ).click( function( e ) {
		e.stopPropagation();
	});



	/* ------------------------------------------------------------------------------
	 * IMAGES / GALLERIES
	/* --------------------------------------------------------------------------- */

	// Add swipebox functionality - 'lightbox' by default ( with .swipebox added ).
	if ( $( '.gallery' ).length ) {
		$( '.gallery a' ).each( function() {
			$( this ).attr( 'rel', 'gallery' );
			$( this ).addClass( 'swipebox' );
		});
		$( '.swipebox' ).swipebox({
			loopAtEnd: true
		});
	}

	// Also use swipebox for WooCommerce galleries.
	if ( $( '.woocommerce .images' ).length ) {
		$( '.images a' ).each( function() {
			$( this ).attr( 'data-rel', 'prettyPhoto[product-gallery]' );
			$( this ).addClass( 'swipebox' );
		});
		$( '.swipebox' ).swipebox({
			loopAtEnd: true
		});
		$( '.thumbnails a' ).each( function() {
			$( this ).attr( 'data-rel', 'prettyPhoto[product-gallery]' );
			$( this ).addClass( 'swipebox' );
		});
		$( '.swipebox' ).swipebox({
			loopAtEnd: true
		});
	}

	// Wrap images in figure tags for better responsive styling.
	if ( $( 'img[class*=align]' ).length ) {
		var aligncenter = $( 'img.aligncenter' );
		var alignleft = $( 'img.alignleft' );
		var alignnone = $( 'img.alignnone' );
		var alignright = $( 'img.alignright' );
		alignnone.wrap( '<figure class="alignnone" />' );
		aligncenter.wrap( '<figure class="aligncenter" />' );
		alignright.wrap( '<figure class="alignright" />' );
		alignleft.wrap( '<figure class="alignleft" />' );
	}
	if ( $( '.wp-caption' ).length ) {
		$( '.wp-caption' ).removeAttr( 'style' );
	}

	/* ------------------------------------------------------------------------------
	 * CONTENT
	/* --------------------------------------------------------------------------- */

	// Wrap tables in a div for responsive sites.
	if ( $( 'article table' ).length ) {
		$( 'article table' ).wrap( '<div class="table-container" />' );
	}



	/* ------------------------------------------------------------------------------
	 * LINKS
	/* --------------------------------------------------------------------------- */

	// Open external links in a new window.
	$( function() {
		$( 'a[href^="//"],a[href^="http"]' )
		.not( '[href*="' + window.location.hostname + '"]' )
		.attr( 'target', '_blank' );
	});
});

// Allow FontAwesome 5 to be used with pseudo elements.
// Both calls are here for fallback, as the first one stopped working.
window.FontAwesomeConfig = {
	searchPseudoElements: true
};
window.FontAwesomeConfig.searchPseudoElements = true;
