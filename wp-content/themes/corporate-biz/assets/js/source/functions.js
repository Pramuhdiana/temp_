/* global corporateBizOptions */
 /*
 * Custom scripts
 * Description: Custom scripts for corporateBiz
 */
( function( $ ) {

	jQuery( document ).ready( function() {
		body = jQuery( document.body );
		jQuery( window )
			.on( 'load.corporateBiz resize.corporateBiz', function() {
			if ( window.innerWidth < 1200 ) {
				jQuery('#site-header-menu .menu-inside-wrapper').on('focusout', function () {
					var $elem = jQuery(this);
					// let the browser set focus on the newly clicked elem before check
				    setTimeout(function () {
				    	if ( ! $elem.find(':focus').length ) {
				    		jQuery( '#site-header-menu #menu-toggle-mobile' ).trigger('click');
				        }
				    }, 0);
				});
			}

			if ( window.innerWidth > 768 ) {
				jQuery('#primary-search-wrapper .menu-inside-wrapper').on('focusout', function () {
					var $elem = jQuery(this);
					
				    // let the browser set focus on the newly clicked elem before check
				    setTimeout(function () {
				        if ( ! $elem.find(':focus').length ) {
				            jQuery( '#primary-search-wrapper .menu-toggle' ).trigger('click');
				        }
				    }, 0);
				});

				jQuery('#social-menu-wrapper .menu-inside-wrapper').on('focusout', function () {
					var $elem = jQuery(this);
					
				    // let the browser set focus on the newly clicked elem before check
				    setTimeout(function () {
				        if ( ! $elem.find(':focus').length ) {
				            jQuery( '#social-menu-wrapper .menu-toggle' ).trigger('click');
				        }
				    }, 0);
				});
			}
		} );
	});

	// Owl Carousel 
	if ( $.isFunction( $.fn.owlCarousel ) ) {
		// Featured Slider
		var sliderOptions = {
			rtl:corporateBizOptions.rtl ? true : false,
			autoHeight:true,
			margin: 0,
			items: 1,
			nav: true,
			dots: true,
			autoplay: true,
			autoplayTimeout: 4000,
			loop: true,
		};

		$(".main-slider").owlCarousel(sliderOptions);

		// Testimonial Section
		var testimonialLayout = 2;
		var testimonialOptions = {
			rtl:corporateBizOptions.rtl ? true : false,
			autoHeight: true,
			margin: 0,
			items: 1,
			nav: true,
			dots: true,
			autoplay: true,
			autoplayTimeout: 4000,
			loop: true,
			responsive:{
				0:{
					items:1
				},
				668:{
					items:( testimonialLayout < 2 ) ? testimonialLayout : 2
				}
			}
		};

		$( '.testimonial-slider' ).owlCarousel(testimonialOptions);
	}

	$( function() {
		//Adding padding top for header to match with custom header
		$( window ).on( 'load.corporateBiz resize.corporateBiz', function () {
			if ( $( 'body' ).hasClass( 'has-custom-header' ) || $( 'body' ).hasClass( 'absolute-header' )) {
				headerheight = $('#masthead').height();
				//$('.custom-header').css('padding-top', headerheight );
				$('.navigation-default #primary-menu-wrapper .menu-inside-wrapper').css('top', headerheight );
			}

			headerheight = $('#masthead').height();

			if ( $(window).width() < 1024 ) {
				$('#primary-menu-wrapper .menu-inside-wrapper' ).css('top', headerheight );
			} else {
				$('#primary-menu-wrapper .menu-inside-wrapper' ).css('top', '' );
			}
		});

		// Functionality for scroll to top button
		$(window).scroll( function () {
			if ( $( this ).scrollTop() > 100 ) {
				$( '#scrollup' ).fadeIn('slow');
				$( '#scrollup' ).show();
			} else {
				$('#scrollup').fadeOut('slow');
				$("#scrollup").hide();
			}
		});

		$( '#scrollup' ).on( 'click', function () {
			$( 'body, html' ).animate({
				scrollTop: 0
			}, 500 );
			return false;
		});

	});

	// Add header video class after the video is loaded.
	$( document ).on( 'wp-custom-header-video-loaded', function() {
		$( 'body' ).addClass( 'has-header-video' );
	});

	/*
	 * Test if inline SVGs are supported.
	 * @link https://github.com/Modernizr/Modernizr/
	 */
	function supportsInlineSVG() {
		var div = document.createElement( 'div' );
		div.innerHTML = '<svg/>';
		return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
	}

	$( function() {
		$( document ).ready( function() {
			if ( true === supportsInlineSVG() ) {
				document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
			}
		});
	});

	$( '.search-toggle' ).click( function() {
		$( this ).toggleClass( 'open' );
		$( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
		$( '.search-wrapper' ).toggle();
	});


	/* Menu */
	var body, masthead, menuToggle, siteNavigation, socialNavigation, siteHeaderMenu, resizeTimer;

	function initMainNavigation( container ) {

		// Add dropdown toggle that displays child menu items.
		var dropdownToggle = $( '<button />', { 'class': 'dropdown-toggle', 'aria-expanded': false })
			.append( $( '<span />', { 'class': 'screen-reader-text', text: corporateBizOptions.screenReaderText.expand }) );

		container.find( '.menu-item-has-children > a, .page_item_has_children > a' ).after( dropdownToggle );

		// Toggle buttons and submenu items with active children menu items.
		container.find( '.current-menu-ancestor > button' ).addClass( 'toggled-on' );
		container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

		// Add menu items with submenus to aria-haspopup="true".
		container.find( '.menu-item-has-children, .page_item_has_children' ).attr( 'aria-haspopup', 'true' );

		container.find( '.dropdown-toggle' ).click( function( e ) {
			var _this            = $( this ),
				screenReaderSpan = _this.find( '.screen-reader-text' );

			e.preventDefault();
			_this.toggleClass( 'toggled-on' );

			// jscs:disable
			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
			screenReaderSpan.text( screenReaderSpan.text() === corporateBizOptions.screenReaderText.expand ? corporateBizOptions.screenReaderText.collapse : corporateBizOptions.screenReaderText.expand );
		} );
	}

	initMainNavigation( $( '.main-navigation' ) );

	masthead         = $( '#masthead' );
	menuToggle       = masthead.find( '.menu-toggle' );
	siteHeaderMenu   = masthead.find( '#site-header-menu' );
	siteNavigation   = masthead.find( '#site-navigation' );
	socialNavigation = masthead.find( '#social-navigation' );


	// Enable menuToggle.
	( function() {
		// Assume the initial scroll position is 0.
		var scroll = 0;

		// Return early if menuToggle is missing.
		if ( ! menuToggle.length ) {
			return;
		}

		menuToggle.on( 'click.corporateBiz', function() {
			// jscs:disable
			$( this ).add( siteNavigation ).attr( 'aria-expanded', $( this ).add( siteNavigation ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
		} );


		// Add an initial values for the attribute.
		menuToggle.add( siteNavigation ).attr( 'aria-expanded', 'false' );
		menuToggle.add( socialNavigation ).attr( 'aria-expanded', 'false' );

		// Wait for a click on one of our menu toggles.
		menuToggle.on( 'click.corporateBiz', function() {

			// Assign this (the button that was clicked) to a variable.
			var button = this;

			// Gets the actual menu (parent of the button that was clicked).
			var menu = $( this ).parents( '.menu-wrapper' );

			// Remove selected classes from other menus.
			$( '.menu-toggle' ).not( button ).removeClass( 'selected' );
			$( '.menu-wrapper' ).not( menu ).removeClass( 'is-open' );

			// Toggle the selected classes for this menu.
			$( button ).toggleClass( 'selected' );
			$( menu ).toggleClass( 'is-open' );

			// Is the menu in an open state?
			var is_open = $( menu ).hasClass( 'is-open' );

			// If the menu is open and there wasn't a menu already open when clicking.
			if ( is_open && ! jQuery( 'body' ).hasClass( 'menu-open' ) ) {

				// Get the scroll position if we don't have one.
				if ( 0 === scroll ) {
					scroll = $( 'body' ).scrollTop();
				}

				// Add a custom body class.
				$( 'body' ).addClass( 'menu-open' );

			// If we're closing the menu.
			} else if ( ! is_open ) {

				$( 'body' ).removeClass( 'menu-open' );
				$( 'body' ).scrollTop( scroll );
				scroll = 0;
			}
		} );

		// Close menus when somewhere else in the document is clicked.
		$( document ).on( 'click touchstart', function() {
			$( 'body' ).removeClass( 'menu-open' );
			$( '.menu-toggle' ).removeClass( 'selected' );
			$( '.menu-wrapper' ).removeClass( 'is-open' );
		} );

		// Stop propagation if clicking inside of our main menu.
		$( '.site-header-menu,.menu-toggle, .dropdown-toggle, .search-field, #site-navigation, #social-search-wrapper, #social-navigation .search-submit' ).on( 'click touchstart', function( e ) {
			e.stopPropagation();
		} );
	} )();

	// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
	( function() {
		if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
			return;
		}

		// Toggle `focus` class to allow submenu access on tablets.
		function toggleFocusClassTouchScreen() {
			if ( window.innerWidth >= 910 ) {
				$( document.body ).on( 'touchstart.corporateBiz', function( e ) {
					if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
						$( '.main-navigation li' ).removeClass( 'focus' );
					}
				} );
				siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).on( 'touchstart.corporateBiz', function( e ) {
					var el = $( this ).parent( 'li' );

					if ( ! el.hasClass( 'focus' ) ) {
						e.preventDefault();
						el.toggleClass( 'focus' );
						el.siblings( '.focus' ).removeClass( 'focus' );
					}
				} );
			} else {
				siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).unbind( 'touchstart.corporateBiz' );
			}
		}

		if ( 'ontouchstart' in window ) {
			$( window ).on( 'resize.corporateBiz', toggleFocusClassTouchScreen );
			toggleFocusClassTouchScreen();
		}

		siteNavigation.find( 'a' ).on( 'focus.corporateBiz blur.corporateBiz', function() {
			$( this ).parents( '.menu-item, .page_item' ).toggleClass( 'focus' );
		} );

		$('.main-navigation button.dropdown-toggle').click(function() {
			$(this).toggleClass('active');
			$(this).parent().find('.children, .sub-menu').toggleClass('toggled-on');
		});
	} )();

	$(document).ready(function() {
		/*Search and Social Container*/
		$('.toggle-top').on('click', function(e){
			$(this).toggleClass('toggled-on');
		});

		$('#search-toggle').on('click', function(){
			$('#header-menu-social, #share-toggle').removeClass('toggled-on');
			$('#header-search-container').toggleClass('toggled-on');
		});

		$('#share-toggle').on('click', function(e){
			e.stopPropagation();
			$('#header-search-container, #search-toggle').removeClass('toggled-on');
			$('#header-menu-social').toggleClass('toggled-on');
		});
	});

	/* Playlist On Scroll For Mobile */
	var PlaylistOnScroll = function(){

		var scrollTop = $(window).scrollTop();

		if (scrollTop > 46) {
			$('body').addClass('playlist-fixed');
		} else {
			$('body').removeClass('playlist-fixed');
		}
	};

	/*Onload*/
	PlaylistOnScroll();

	/*On Scroll*/
	$(window).scroll(function() {
		PlaylistOnScroll();
	});

	// Show count in header if count is more than 0
	if (parseInt($(".site-header-cart .cart-contents .count").text()) !== 0) {
		$(".site-header-cart .cart-contents .count").show();
	}
	
	var windowWidth = $(window).width();
	if(windowWidth > 768){
		 $( window ).on( 'load resize', function () {
		 });	
	}

	//Adding padding top for header to match with custom header
	var windowWidth = $(window).width();
	if(windowWidth >= 1200){
		$( window ).on( 'load resize', function () {
			if( $( 'body' ).hasClass( 'has-header-media' ) || $( 'body' ).hasClass( 'absolute-header' )) {
				headerheight = $('#masthead').height();
				$('.absolute-header #masthead + .custom-header, .absolute-header #masthead + #feature-slider-section .slider-image-wrapper').css('padding-top', headerheight );
			}
		});
	} else {
		$('.absolute-header #masthead + .custom-header, .absolute-header #masthead + #feature-slider-section .slider-image-wrapper').removeAttr('style');
	}

	$(window).on( 'load resize', function() {
		var thumbHeight = $('#featured-video-section .featured').height();
		if ( $(window).width() > 1024 ) {
			$('#featured-video-section .side-posts-wrap').css('height', thumbHeight);
		} else {
			$('#featured-video-section .side-post-wrap').removeAttr('style');
		}
	

		var thumbHeight = $('#featured-video-section .featured .video-thumbnail').height();
		$('#featured-video-section .side-posts-wrap').css('height', thumbHeight);
	});

	$(window).on("load resize scroll",function(e){
		if ( $(window).width() > 1200 ) {
			if ( $(window).scrollTop() >= $('.site-header').outerHeight() ) {
				$('.site-header').addClass('fixed transparent');
			}
			else {
				$('.site-header').removeClass('fixed transparent');
			}
		};
	});

	$(window).on("load resize",function(e) {
		headerheight = $('#masthead').height();
		$("header + .site-content").css("padding-top", headerheight );
	});
	
} )( jQuery );
