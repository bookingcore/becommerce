(function ($) {
	'use strict';

	var martfury = martfury || {};
	martfury.init = function () {
			martfury.$window = $(window),
			martfury.$header = $('#site-header');

		this.stickyHeader();
		this.navMenu();
		this.featuresCarousel();
		this.menuMobile();
		this.masonry();
		this.tabHome();

		$('#section-features').on('click', 'a', function(e) {
			e.preventDefault();
		});

	};

	martfury.navMenu = function() {
		$('#site-navigation').stickyNavbar({
			sectionSelector: "scrollto",
			jqueryEffects: false,
			animateCSS: false,
			jqueryAnim: 'show'
		});
	};

	martfury.featuresCarousel = function() {
		$('#section-homepages').find('.list-features').not('.slick-initialized').slick({
			slidesToShow  : 4,
			slidesToScroll: 1,
			arrows        : false,
			autoplay      : true,
			responsive    : [
				{
					breakpoint: 1024,
					settings  : {
						slidesToShow  : 2,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 767,
					settings  : {
						slidesToShow  : 1,
						slidesToScroll: 1
					}
				}
			]
		});
	};


	// Sticky Header
	martfury.stickyHeader = function () {

		martfury.$window.on('scroll', function () {
			var scrollTop = 5;

			if (martfury.$window.scrollTop() > scrollTop) {
				martfury.$header.addClass('minimized');
			} else {
				martfury.$header.removeClass('minimized');
			}
		});


	};

	martfury.menuMobile = function () {
		$('button').on('click',function(){
		  if($('.two').css('width')=='40px'){
		     $('.sidebar.three').addClass('turn1');
		     $('.sidebar.two').animate({width:'0', left:'50%'},500);
		     $('.sidebar.one').addClass('turn2');
		  } else {
		   $('.sidebar.three').removeClass('turn1');
		     $('.sidebar.two').animate({width:'40px', left:'5px'},500);
		     $('.sidebar.one').removeClass('turn2');
		  }

		  $('.site-menu--mobile').toggleClass('show');
		});
	};

	martfury.masonry = function () {
		$('.features-wrapper').imagesLoaded(function () {
			$('.features-wrapper').isotope({
				itemSelector   : '.features-item',
				layoutMode     : 'masonry',
				horizontalOrder: true
			});
		});
	};

	martfury.tabHome = function () {
		$('.tabs-homepage').each(function(){
			var el = $(this),
				tabNav = el.find('.tab-nav a'),
				tabContent = el.find('.tab-content .item-content');

			tabNav.first().addClass('active');
			tabContent.first().addClass('active');

	        tabNav.each( function ( i ) {
	            $( this ).attr( 'data-tab', 'tab' + i );
	        } );
	        tabContent.each( function ( i ) {
	            $( this ).attr( 'data-tab', 'tab' + i );
	        } );

			tabNav.on('click',function(e){
				e.preventDefault();

				var item = $(this),
					siblings = item.siblings(item),
					data = item.data('tab'),
				 	contentFilter = tabContent.filter( '[data-tab=' + data + ']' );

			 	if (tabNav.hasClass('.active')) {
	                return;
	            }

             	siblings.removeClass( 'active' );
	            item.addClass( 'active' );
	            contentFilter.addClass( 'active' );
	            contentFilter.siblings( tabContent).removeClass( 'active' );
			});

		});
	};

	/**
	 * Document ready
	 */
	$(function () {
		martfury.init();
	});

})(jQuery);
