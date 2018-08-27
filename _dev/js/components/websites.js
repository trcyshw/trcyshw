jQuery( function( $ ) {
	var fetchpage = '2';

	// Ajax call.
	$.ajax({
		url: 'https://www.trcyshw.com/wp-json/wp/v2/websites?_embed&per_page=12&filter[orderby]=date&order=desc&page=1',
		success: function( data, textStatus, request ) {

			// For each website.
			$.each( data, function( count, website ) {
				var websiteContent = website.content.rendered;
				var websiteDev = website.acf._website_development;
				var websiteImage = website._embedded['wp:featuredmedia'];
				var websiteStatus = website.acf._website_status;
				var websiteTitle = website.title.rendered;
				var websiteUrl = website.acf._website_url;

				// Development type.
				if ( undefined !== websiteDev && websiteDev.length >= 3 ) {
					websiteDev = '<span class="website__development">Development: ' + websiteDev + '</span>';
				} else {
					websiteDev = '';
				}

				// Website status.
				if ( undefined !== websiteStatus ) {
					var archived = website.acf._website_status.archived;
					var wayback = website.acf._website_status.wayback;
					if ( true === archived ) {
						websiteUrl = '<a href="' + wayback + '" class="btn btn-brand2" target="_blank">View Archived Website</a>';
					} else {
						archived = '';
						if ( '' !== websiteUrl ) {
							websiteUrl = '<a href="' + websiteUrl + '" class="btn btn-brand2" target="_blank">View Website</a>';
						} else {
							websiteUrl = '';
						}
					}
				} else {
					websiteStatus = '';
					if ( undefined !== websiteUrl ) {
						websiteUrl = '<a href="' + websiteUrl + '" class="btn btn-brand2" target="_blank">View Website</a>';
					} else {
						websiteUrl = '';
					}
				}

				// Attached image.
				if ( undefined !== websiteImage ) {
					websiteImage = ' style="background-image: url(' + websiteImage[0].source_url + ');"';
				} else {
					websiteImage = '';
				}

				// Show the results.
				$( '.content__websites__websites-list' ).append( '<div class="website is-collapsed"><div class="website__image"><span ' + websiteImage + '></span></div><div class="website__detail"><span class="website__detail__close"></span><div class="col"><div class="website__detail__image large"' + websiteImage + '></div></div><div class="col"><span class="website__title title">' + websiteTitle + '</span>' + websiteContent + websiteDev + websiteUrl + '</div></div>' );

				$( '.content__websites .content__websites__loading' ).hide();
				$( '.content__websites .content__websites__show-more' ).show();
			});
		}
	});

	// Show more.
	$( '.content__websites__show-more .btn' ).on( 'click', function( e ) {

			// Prevent default click event
			e.preventDefault();

			// Update the link text
			$( this ).text( 'Loading websites' ).append( ' <i class="fal fa-circle-notch fa-spin"></i>' );

			// Ajax call.
			$.ajax({
				url: 'https://www.trcyshw.com/wp-json/wp/v2/websites?_embed&per_page=12&filter[orderby]=date&order=desc&page=' + fetchpage,
				success: function( data, textStatus, request ) {

				// Log all the things.
				// console.log ( data );
				// console.log ( textStatus );
				// console.log ( request );

				// Get total number of pages.
				totalpages = request.getResponseHeader( 'X-WP-TotalPages' );

				// If current page is less than total pages.
				if ( fetchpage <= totalpages ) {

					// For each website.
					$.each( data, function( count, website ) {
						var websiteContent = website.content.rendered;
						var websiteDev = website.acf._website_development;
						var websiteImage = website._embedded['wp:featuredmedia'];
						var websiteStatus = website.acf._website_status;
						var websiteTitle = website.title.rendered;
						var websiteUrl = website.acf._website_url;

						// Development type.
						if ( undefined !== websiteDev && websiteDev.length >= 3 ) {
							websiteDev = '<span class="website__development">Development: ' + websiteDev + '</span>';
						} else {
							websiteDev = '';
						}

						// Website status.
						if ( undefined !== websiteStatus ) {
							var archived = website.acf._website_status.archived;
							var wayback = website.acf._website_status.wayback;
							if ( true === archived ) {
								websiteUrl = '<a href="' + wayback + '" class="btn btn-brand2" target="_blank">View Archived Website</a>';
							} else {
								archived = '';
								if ( '' !== websiteUrl ) {
									websiteUrl = '<a href="' + websiteUrl + '" class="btn btn-brand2" target="_blank">View Website</a>';
								} else {
									websiteUrl = '';
								}
							}
						} else {
							websiteStatus = '';
							if ( undefined !== websiteUrl ) {
								websiteUrl = '<a href="' + websiteUrl + '" class="btn btn-brand2" target="_blank">View Website</a>';
							} else {
								websiteUrl = '';
							}
						}

						// Attached image.
						if ( undefined !== websiteImage ) {
							websiteImage = ' style="background-image: url(' + websiteImage[0].source_url + ');"';
						} else {
							websiteImage = '';
						}

						// Show the results.
						$( '.content__websites__websites-list' ).append( '<div class="website is-collapsed"><div class="website__image"><span ' + websiteImage + '></span></div><div class="website__detail"><span class="website__detail__close"></span><div class="col"><div class="website__detail__image large"' + websiteImage + '></div></div><div class="col"><span class="website__title title">' + websiteTitle + '</span>' + websiteContent + websiteDev + websiteUrl + '</div></div>' );
					});

					// Increment fetchpage
					fetchpage++;

					// As long as we still have pages to show
					if ( fetchpage <= totalpages ) {
						$( '.content__websites__show-more span' ).text( 'Show more websites' );
					} else {
						$( '.content__websites__show-more .btn' ).text( 'The end' ).fadeOut( 'slow' );
						$( '.js-show-more' ).text( 'The end' );
					}
				}
			},

			// If errors.
			error: function( data, textStatus, request ) {
				console.log( data.responseText );
			},

			cache: false
		});
	});

	jQuery( document ).on( 'click', '.website__image', function( event ) {
		var $website = $( '.website' );
		var $thisWebsite = $( this ).parent( '.website' );
		if ( $thisWebsite.hasClass( 'is-collapsed' ) ) {
			$website.not( $thisWebsite ).removeClass( 'is-expanded' ).addClass( 'is-collapsed' );
			$thisWebsite.removeClass( 'is-collapsed' ).addClass( 'is-expanded' );
		} else {
			$thisWebsite.removeClass( 'is-expanded' ).addClass( 'is-collapsed' );
		}
	});

	jQuery( document ).on( 'click', '.website__detail__close', function( event ) {
		var $thisWebsite = $( this ).parent().parent( '.website' );
		$thisWebsite.removeClass( 'is-expanded' ).addClass( 'is-collapsed' );
	});
});
