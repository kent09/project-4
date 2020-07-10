(function($) {

	$(document).ready(function(e)
	{
		// $('.carousel .owl-carousel').owlCarousel({
		// 	loop:true,
		// 	items:1,
		// 	nav: true,
		// 	dots: false,
		// 	animateOut: 'fadeOut',
		// 	animateIn: 'fadeIn',
		// 	smartSpeed:1000,
		// 	autoplayTimeout:4000,
		// 	mouseDrag: false,
		// 	lazyLoad: true,
		// 	navText: ['<span class="arrow arrow-left"></span>' , '<span class="arrow arrow-right"></span>']
		// });

		// $('.testimonial .owl-carousel').owlCarousel({
		//     loop: true,
		//     items:1,
		//     navText: ['<span class="arrow arrow-left"></span>' , '<span class="arrow arrow-right"></span>'],
		//     responsive : {
		//     	0 : {
		// 	        dots: true,
		// 	    	nav: false
		// 	    },
		// 	    767 : {
		// 	    	dots: false,
		// 	    	nav: true
		// 	    }
		// 	}

		// });

		// $('.brand-list .owl-carousel').owlCarousel({
		// 	loop:true,
		// 	autoplay:true,
		// 	items:1,
		// 	autoplayTimeout:5000,
		// 	mouseDrag: true,
		// 	animateOut: 'fadeOut',
		// 	animateIn: 'fadeIn',
		// 	dots: false,
		// 	nav: false,
		// });

		// mobile homepage famous carousel
		// $('.item-list .mobile .owl-carousel').owlCarousel({
		// 	loop:true,
		// 	autoplay:true,
		// 	items:1,
		// 	autoplayTimeout:6000,
		// 	dots: true,
		// 	nav: false,
		// });


		$('.nav-brands-nav li:first-child').addClass('active');
		$('.nav-brands-list > div:first-child').addClass('active');

		$('.all-brand .nav-link').click(function(e) {
			// e.preventDefault();
		});

		$('.nav-brands-nav li').each(function(e) {
			var target = $(this).attr('data-brand_target');

			$('.nav-brand-tab[data-brand_tab="'+ target +'"]').clone().appendTo($(this));
			$(this).find('.nav-brand-tab').removeClass('active');
		});

		var wwidth = $(window).width();


		$('.nav-brands-nav li').click(function(e) {
			var target = $(this).data('brand_target');

			if( $(this).hasClass('active') )
			{
				$(this).removeClass('active');
				$('.nav-brand-tab.active').removeClass('active');
			} else {
				$('.nav-brands-nav li.active').removeClass('active');
				$(this).addClass('active');

				$('.nav-brand-tab.active').removeClass('active');
				$('.nav-brand-tab[data-brand_tab="'+ target +'"]').addClass('active');
			}
		});

		$( document ).ajaxComplete(function() {
			if($('#shipping_method_0_dtm_custom_shipping').is(':checked')) {
				$('#shipping_method .dtm-custom-message').show();
			}
		});

		if($('#shipping_method_0_dtm_custom_shipping').is(':checked')) {
			console.log('here');
		   $('#shipping_method .dtm-custom-message').show();
		   }
		

		function heroCarousel() {
			$('.home .carousel .item a').each(function() {
				let $mobile = $(this).data('mobile');
				let $web = $(this).data('web');
				if(wwidth < 768 && $mobile) {
					$(this).find('img').attr('src', $mobile);
				} else {
					$(this).find('img').attr('src', $web);
				}
			});
		}

		$(window).resize(function(e) {
			wwidth = $(window).width();
			heroCarousel();
		});

		// detach the header and transfer it above the sidebar
	    if(wwidth < 768 ){
			$('.archive #left-sidebar').prepend($('.archive #main > .woocommerce-products-header').detach());

		} else {
			$('.archive #left-sidebar aside > div').show();
		}

		$('.top-header .navbar-toggler').click(function(){
			$(this).toggleClass('active');
		});

		heroCarousel();

		$('.single-product .woocommerce-product-gallery__image').append('<div class="vb-product-img-loader"><div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>');
		
		let isDesk = window.matchMedia("(min-width: 991px)").matches;
	
		if(isDesk){
		    console.log("yes")
		       //show sub-menu on homepage 
    		 $("li.menu-item").hover(function(){ //mouse enter
    			$(this).find(".dropdown-menu").show();
    		  }, function(){ //mouse leave
    			if (!$(this).hasClass("menu-main-menu-container")){
    				$(this).find(".dropdown-menu").hide();
    			}
    	      });
		}

		



	});

	if($('.woof_container_brand .woof_list_checkbox').length < 1) {
		$('.woof_container_brand').remove();
	}

	$('.woof_price_filter_txt_container > input').removeAttr('value');
	$('.woof_price_filter_txt_container .woof_price_filter_txt_from').attr("placeholder", "Min.");
	$('.woof_price_filter_txt_container .woof_price_filter_txt_to').attr("placeholder", "Max.");


	$(window).load(function(e) {

		$('.flex-control-thumbs li').each(function(){
			$(this).css('background','#fff');
			if($(this).find('img').hasClass('flex-active')){
				$(this).css('background','#484848');
			}
		});

		$('.flex-control-thumbs li').on('click',function(){
			$('.flex-control-thumbs li').css('background','#fff');
			$(this).css('background','#484848');
		});

		$('.woocommerce-product-gallery__image img.wp-post-image').each(function(e) {
			$(this).attr('data-large_image_width', 800);
			$(this).attr('data-large_image_height', 800);
		});

		$('.single-product .woocommerce-product-gallery__image .vb-product-img-loader').remove();

		$('.prod-category-page li a').imagesLoaded().done( function( instance ) {
			productTitleHeight();
		});

		$(window).resize(function(e) {
			$('.prod-category-page li a').imagesLoaded().done( function( instance ) {
				productTitleHeight();
			});
		});

	});

	function productTitleHeight() {

		var highestBox = 0, listHeight = 0;

		if($(window).width() > 576) {
			$('.prod-category-page .woocommerce-loop-product__title').each(function(){
				if($(this).height() > highestBox) {
					highestBox = $(this).height(); 
				}
			}); 
			$('.prod-category-page ul.products li.product').each(function(){
				if($(this).height() > listHeight) {
					listHeight = $(this).height(); 
				}
			});  
		} else {
			highestBox = 'auto';
			listHeight = 'auto';
		}
		

		// Set the height of all those children to whichever was highest 
		$('.prod-category-page .woocommerce-loop-product__title').height(highestBox);
		$('.prod-category-page ul.products li.product').height(listHeight);
	}

})( jQuery );

