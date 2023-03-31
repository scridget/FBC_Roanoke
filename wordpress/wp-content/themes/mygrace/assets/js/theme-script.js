;var Mygrace_Theme_JS;

(function($) {
	'use strict';

	Mygrace_Theme_JS = {

		$document: $( document ),

		verticalMenuPrepared: false,

		init: function() {
			this.page_preloader_init();
			this.toTopInit();
			this.responsiveMenuInit();
			this.magnificPopupInit();
			this.swiperInit();
			this.commentReplyLinkInit();
			this.masonryInit();

			// Document ready event check
			this.$document.on( 'ready', this.documentReadyRender.bind( this ) );
		},

		documentReadyRender: function() {

			// Header functions
			this.verticalMenuPrepare( this );

			// Events
			this.$document
				.on( 'click.' + this.eventID, '.header-search-toggle', this.searchToggleHandler.bind( this ) )
				.on( 'click.' + this.eventID, '.header-search-popup-close',  this.searchToggleHandler.bind( this ) )

				.on( 'click.' + this.eventID, '#newsletter_popup', this.newsletterToggleHandler.bind( this ) )
				.on( 'click.' + this.eventID, '.footer-newsletter-popup-close',  this.newsletterToggleHandler.bind( this ) )

				//	Vertical Menu
				.on( 'click.' + this.eventID, '.menu-toggle-wrapper', this.menuVerticalToggleHandler.bind( this ) )
				.on( 'click.' + this.eventID, '.menu-toggle-close',  this.menuVerticalToggleHandler.bind( this ) )

				// Vertical Menu
				.on( 'click.' + this.eventID, '.main-navigation__vertical .menu-item-has-children > a', this.verticalMenuLinkHandler.bind( this ) )
				.on( 'click.' + this.eventID, '.main-navigation__vertical .menu-back-btn', 				this.verticalMenuBackHandler.bind( this ) )
				.on( 'click.' + this.eventID, '.menu-toggle-close', 									this.resetVerticalMenu.bind( this ) )

			// Customize Selective Refresh
			if ( typeof window.wp !== "undefined" && typeof window.wp.customize !== "undefined" && wp.customize.selectiveRefresh ) {

				var self = this;

				wp.customize.selectiveRefresh.bind( 'partial-content-rendered', function( placement ) {
					if ( 'header_bar' === placement.partial.id ) {
						self.verticalMenuPrepare( self );
					}
				} );
			}

		},

		page_preloader_init: function(self) {

			if ($('.page-preloader-cover')[0]) {
				$('.page-preloader-cover').delay(500).fadeTo(500, 0, function() {
					$(this).remove();
				});
			}
		},

		toTopInit: function() {
			if ($.isFunction(jQuery.fn.UItoTop)) {
				$().UItoTop({
					text: '',
					scrollSpeed: 600
				});
			}
		},

		searchToggleHandler: function( event ) {
			$('body').toggleClass( 'header-search-active' );
			$('.header-search-popup .header-search-form__field').focus();
		},

		newsletterToggleHandler: function( event ) {
			$('body').toggleClass( 'footer-newsletter-active' );
		},

		menuVerticalToggleHandler: function( event ) {
			$('body').toggleClass( 'vertical-menu-active' );
		},

		hideHeaderMenuVertical: function( event ) {
			var $toggle = $( '.menu-toggle-wrapper' ),
				$popup  = $( '.header-vertical-menu-popup' );

			if ( $( event.target ).closest( $toggle ).length || $( event.target ).closest( $popup ).length ) {
				return;
			}

			if (  ! $('body').hasClass( 'vertical-menu-active' ) ) {
				return;
			}

			$('body').removeClass( 'vertical-menu-active' );

			event.stopPropagation();
		},

		verticalMenuPrepare: function( self ) {
			var $menu = $( '.main-navigation__vertical .menu' );

			if ( ! $menu[0] || self.verticalMenuPrepared ) {
				return;
			}

			$( '.menu-item-has-children', $menu ).each( function() {
				var $li      = $( this ),
					$link    = $( '> a', $li ),
					$parentItem = $( '<li>', { class: 'menu-parent-item' } ).append( $link.clone() ),
					deep     = $li.parents( '.menu, .sub-menu' ).length,
					$subMenu = $( '> .sub-menu', $li );

				$subMenu.prepend( $parentItem );
				$subMenu.prepend( '<li class="menu-back-item"><button class="menu-back-btn btn-initial" data-deep="' + deep + '"><svg width="12" height="20" viewBox="0 0 12 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 19L2 10L11 1" stroke="#C2C2C3" stroke-width="2"/></svg></button></li>' );
			} );

			self.verticalMenuPrepared = true;
		},

		verticalMenuLinkHandler: function( event ) {
			event.preventDefault();

			var self      = this,
				$target   = $( event.currentTarget ),
				$menu     = $target.closest( '.menu' ),
				deep      = $target.parents( '.menu, .sub-menu' ).length,
				direction = self.isRTL ? 1 : -1,
				translate = direction * deep * 100;

			$menu.css( 'transform', 'translateX(' + translate + '%)' );

			setTimeout( function() {
				$target.parent().addClass( 'active' );
				$target.parent().siblings().addClass( 'mygrace-hidden' );
				$target.parents( '.active' ).find( '> a' ).addClass( 'mygrace-hidden' );
			}, 250 );
		},

		verticalMenuBackHandler: function( event ) {
			var self      = this,
				$target   = $( event.currentTarget ),
				$menu     = $target.closest( '.menu' ),
				$menuItem = $target.closest( '.menu-item' ),
				deep      = $target.data( 'deep' ) - 1,
				direction = self.isRTL ? 1 : -1,
				translate = direction * deep * 100;

			$menu.css( 'transform', 'translateX(' + translate + '%)' );

			setTimeout( function() {
				$menuItem.removeClass( 'active' );
				$menuItem.siblings().removeClass( 'mygrace-hidden' );
				$menuItem.find( '> a' ).removeClass( 'mygrace-hidden' );
			}, 250 );
		},

		resetVerticalMenu: function( event ) {
			var self         = this,
				$menu        = $( '.main-navigation__vertical .menu' ),
				$menuItems   = $( '.menu-item', $menu ),
				$parentItems = $( '.menu-parent-item', $menu ),
				$backItems   = $( '.menu-back-item', $menu ),
				$activeLinks = $( '.menu-item.active > a', $menu );

			$menu.css( 'transform', '' );

			setTimeout( function() {
				$menuItems.removeClass( 'active' ).removeClass( 'mygrace-hidden' );
				$parentItems.removeClass( 'mygrace-hidden' );
				$backItems.removeClass( 'mygrace-hidden' );
				$activeLinks.removeClass( 'mygrace-hidden' );
			}, 250 );
		},

		responsiveMenuInit: function() {
			if (typeof mygraceResponsiveMenu !== 'undefined') {
				mygraceResponsiveMenu();
			}
		},

		magnificPopupInit: function() {

			if (typeof $.magnificPopup !== 'undefined') {

				//MagnificPopup init
				$('[data-popup="magnificPopup"]').magnificPopup({
					type: 'image'
				});

				$(".gallery > .gallery-item a").filter("[href$='.png'],[href$='.jpg']").magnificPopup({
					type: 'image',
					gallery: {
						enabled: true,
						navigateByImgClick: true,
					},
				});

			}
		},

		swiperInit: function() {
			if (typeof Swiper !== 'undefined') {

				//Swiper carousel init
				var mySwiper = new Swiper('.swiper-container', {
					// Optional parameters
					loop: true,
					spaceBetween: 10,
					autoHeight: true,

					// Navigation arrows
					navigation: {
						nextEl: '.swiper-button-next',
						prevEl: '.swiper-button-prev'
					}
				})

			}
		},

		commentReplyLinkInit: function() {
			if ( $('body').hasClass( 'single-post' ) ) {
				$( '.comment-reply-link', '.comment-body' ).on( 'click', function(){
					$( '#cancel-comment-reply-link' ).insertAfter( '.form-submit #submit' ).show();
				} );

				$( '#cancel-comment-reply-link' ).on( 'click', function(){
					$( this ).hide();
				} );
			}
		},

		masonryInit: function() {

			var $container = $('.posts-list--grid');

			setTimeout( function() {
				$container.masonry({
				  itemSelector: '.grid-item'
				});
			}, 100 );
		},
	};

	Mygrace_Theme_JS.init();

}(jQuery));
