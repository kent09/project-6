(function($) {
	
	
	$(".hamburger").click(function(){
		$(this).toggleClass("is-active");
		$('body').toggleClass("cbp-spmenu-push-toright");
		$("#mobile-menu").toggleClass("move-left");
		$('#mobile-menu li').removeClass('open');
		$('#mobile-menu ul').slideUp();
	});

	$(".seach-btn").click(function() {
		$('body').removeClass('hide-search');
		$('.top-search-wrapper').slideDown();
	});

	$('#mobile-menu li').each(function() {
		var anchor = $(this).children('a');
		anchor.on('click', function(e) {

			e.preventDefault(); 

			var li = $(this).parent();

			if(li.hasClass('menu-item-has-children')) {
				li.children('ul').slideToggle(isUlVisible);
				li.toggleClass('open');
			}

		});
	});

	$('.to-top div').click(function(e){
		e.preventDefault();
        $('html, body').animate({ scrollTop:0 }, 'slow');
        return false;
    });


    $('.hero-banner .desktop').owlCarousel({
		items:1,
		loop:false,
		nav: true,
		dots: false,
		navText: ['<i class="next"></i>','<i class="prev"></i>']
	});

	$('.hero-banner .mobile').owlCarousel({
		items:1,
		loop:false,
		nav: true,
		dots: false,
		navText: ['<i class="next"></i>','<i class="prev"></i>']
	});

	$('.feature-product').owlCarousel({
		loop:false,
	    margin:12,
	    mouseDrag: false,
	    responsive:{
	        0:{
	            items:1,
	            dots: true,
	            touchDrag: true
	        },
	        767:{
	            items:3,
	            dots: false
	        },
	        1000:{
	            items:5,
	            dots: false
	        }
	    }
	});

	$('.woo-filter-wrapper .woocommerce-ordering').on('click', function() {
	    $(this).toggleClass('active');
	});


	$(window).scroll(function() {
		scrollFunction();
	});
	
	menuScroll();

	$(window).resize(function() {
		arrowCenterLocation();
		menuScroll();
	});

	$(window).load(function() {
		arrowCenterLocation();
	});

	function menuScroll() {

		if($(window).width() < 768) {
			var prevScrollpos = window.pageYOffset;

			window.addEventListener('scroll', function(){
				var currentScrollPos = window.pageYOffset;
				if (prevScrollpos < currentScrollPos) {
					$('body').addClass('hide-search');
					$('.top-search-wrapper').slideUp('slow');
				}
				prevScrollpos = currentScrollPos;
			});		

		} else {
			$('body').removeClass('hide-search');
			$('.top-search-wrapper').show();
		}

	}

	function scrollFunction() {

		if($(window).width() > 767) {
			return false;
		}
		
		if (document.body.scrollTop > 250 || document.documentElement.scrollTop > 250) {
			$('.to-top').fadeIn();
		} else {
			$('.to-top').fadeOut();
		}
	}


	function arrowCenterLocation() {
		let Hheight = ($('.hero-banner').outerHeight() / 2) + 44;
		$('.hero-banner button').css({'top' : - Hheight });
	}


	function isUlVisible() {
		let href = $(this).parent().children('a');
		if(!$(this).is(':visible') && href.attr('href') != '#') {
			window.location = href.attr('href');
		}
	}

	$(document).mouseup(function(e) 
	{
	    var container = $(".woo-filter-wrapper .woocommerce-ordering");

	    // if the target of the click isn't the container nor a descendant of the container
	    if (!container.is(e.target) && container.has(e.target).length === 0) 
	    {
	        container.removeClass("active");
	    }
	});

})( jQuery );













