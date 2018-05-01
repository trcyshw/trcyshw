jQuery(document).ready(function($) {

	/*Use Modernizr to add mouse class in place of touch class on devices without touchscreen*/
	$(window).one({
		mouseover : function(){
			Modernizr.touch = false;
			$('html').removeClass('touch').addClass('mouse');
		}
	});

	/* Add scroll to top functionality */
	$(window).scroll(function() {
		if($(this).scrollTop() !== 0) {
			$('#scroll').fadeIn();
		} else {
			$('#scroll').fadeOut();
		}
	});
	$('#scroll').click(function() {
		$('html, body').animate({
			scrollTop:0
		},800);
	});
	$('.scroll').click(function(){
		$('html, body').animate({
			scrollTop: $( $(this).attr('href') ).offset().top
		}, 800);
		return false;
	});

	/* Add swipebox  functionality - 'lightbox' by default (with .swipebox added) */
	if ($('.gallery').length) {
		$('.gallery a').each(function() {
			$(this).attr('rel', 'gallery');
			$(this).addClass('swipebox');
		});
		$( '.swipebox' ).swipebox({
			loopAtEnd:true
		});
	}
	/* Also use swipebox for WooCommerce: */
	if ($('.woocommerce .images').length) {
		$('.images a').each(function() {
			$(this).attr('data-rel', 'prettyPhoto[product-gallery]');
			$(this).addClass('swipebox');
		});
		$('.swipebox' ).swipebox({
			loopAtEnd:true
		});
		$('.thumbnails a').each(function() {
			$(this).attr('data-rel', 'prettyPhoto[product-gallery]');
			$(this).addClass('swipebox');
		});
		$('.swipebox' ).swipebox({
			loopAtEnd:true
		});
	}

	/* Enable the responsive menu slide */
	$('#responsive span').click(function() {
		$('#responsive > ul').animate({
			height: 'toggle'
		}, 400);
	});

	$('#websites article.type-website').click(function() {
		$(this).toggleClass( 'open' );
	});

	$('article.bio .more').click(function() {
		$('article.bio').addClass('open');
	});

	$('article.bio .close').click(function() {
		$('article.bio').removeClass('open');
	});

	// $( 'html.touch #websites article.type-website .close' ).click(function() {
	// 	$( 'html.touch #websites .content' ).hide();
	// 	//alert('touched');
	// });

	/* Wrap images in figure tags for better responsive styling */
	if ($('img[class*=align]').length) {
		var alignnone = $('img.alignnone');
		var aligncenter = $('img.aligncenter');
		var alignright = $('img.alignright');
		var alignleft = $('img.alignleft');
		alignnone.wrap('<figure class="alignnone" />');
		aligncenter.wrap('<figure class="aligncenter" />');
		alignright.wrap('<figure class="alignright" />');
		alignleft.wrap('<figure class="alignleft" />');
	}
	if ($('.wp-caption').length) {
		$('.wp-caption').removeAttr('style');
	}

	/* Slick slider - customise as needed */
	if ($('#slider .slide').length > 1) {
		$('#slider').slick({
			autoplay:true,
			autoplaySpeed:4500,
			fade:true,
			dots:true,
			infinite:true,
			cssEase:'linear',
			prevArrow:'<span class="fa fa-angle-left prev"></i>',
			nextArrow:'<span class="fa fa-angle-right next"></i>',
		});
	}

	/* Add classes to certain links for styling */
	$('a[href$=".pdf"]').addClass('pdf').attr('target', '_blank');
	$('a[href$=".doc"], a[href$=".docx"], a[href$=".txt"], a[href$=".rtf"]').addClass('doc').attr('target', '_blank');
	$('a[href$=".xls"], a[href$=".xlsx"], a[href$=".csv"]').addClass('xls').attr('target', '_blank');

	/* If there is an iframe in the #content, wrap it in a div, add a disclaimer (see _messages.scss) */
	if ($('#content iframe').length) {
		$('#content iframe').wrap('<div class="iframe-container" />');
		$('#content iframe[src*="google"]').parent('div').addClass('google');
		$('#content iframe[src*="vimeo"]').unwrap('<div class="iframe-container" />');
		$('#content iframe[src*="youtube"]').unwrap('<div class="iframe-container" />');
		$('<span class="dontblamegoop">The following data has been provided by a third party and may not display optimally on all devices.</span>' ).insertBefore( $( '#content iframe' ) );
	}

	/* Stacktable responsive tables - for options see http://johnpolacek.github.io/stacktable.js/# */
	//jQuery('#content table').stacktable();

	/* Foundation responsive tables */
	//$('#sizing table').addClass('responsive');

	/* Apply classes if running certain IE browsers */
	if (/*@cc_on!@*/false) {
		document.documentElement.className+=' ie lt-ie11';
	}
	var ie11Styles = ['msTextCombineHorizontal'];
	var d = document;
	var b = d.body;
	var s = b.style;
	var ieVersion = null;
	var property; for (var i = 0; i < ie11Styles.length; i++) {
		property = ie11Styles[i];
		if (s[property] !== undefined) {
			document.documentElement.className+=' ie';
		}
	}

}); // The End
