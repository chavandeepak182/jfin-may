var swiper1 = new Swiper(".iconsContainer", {
	slidesPerView: 1,
	spaceBetween: 10,
	loop: true,
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
	breakpoints: {
		768: {
			slidesPerView: 3,
			spaceBetween: 20,
		},
		1024: {
			slidesPerView: 4,
			spaceBetween: 20,
		},
	},
});

var swiper = new Swiper(".characterSlider", {
	effect: "coverflow",
	grabCursor: true,
	centeredSlides: true,
	loop: true,
	slidesPerView: "auto",
	coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 50,
        modifier: 1,
        slideShadows: true,
	},
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
});

// Designed & Developed by Sami from ECIS
$(document).ready(function () {
	"use strict";
	$('[data-toggle="tooltip"]').tooltip();
	
	$(".form-close").click(function() {
		$(".stickyForm").stop().hide(300);
		$(".enquiryBtn").show();
	});
	$(".enquiryBtn").click(function() {
		$(".stickyForm").stop().show(300);
		$(this).hide();
	});
	let formInterval = setInterval(function(){
		$(".stickyForm").stop().show(300);
		$(".enquiryBtn").hide();
	},15000);

	if($(window).innerWidth() < 576){
		clearInterval(formInterval);
	}

	$(".menuBtn").click(function() {
		$(this).toggleClass('closeMenuBtn');
	    $('.menuContainer').stop().fadeToggle(500).toggleClass('active');
	    $('.header').toggleClass('notfixed');
	    $('body').toggleClass('overflow-hidden');
	});

	$(".mainMenu li").click(function() {
		$(".menuBtn").toggleClass('closeMenuBtn');
	    $('.menuContainer').stop().fadeToggle(500).toggleClass('active');
	    $('.header').toggleClass('notfixed');
	    $('body').toggleClass('overflow-hidden');
	});

	// Designed & Developed by Sami from ECIS

	$(window).bind('scroll', function () {
		if ($(window).scrollTop() > 100) {
			$('.button-top').animate({
				opacity: 1
			}, 0);
		}
		else {
			$('.button-top').animate({
				opacity: 0
			}, 0);
		}
	});
	$(".button-top").click(function () {
		$("html,body").animate({ scrollTop: '0px' }, 500);
	});

	// Designed & Developed by Sami from ECIS
});

$(window).scroll(function () {
	"use strict";

	var wScroll = $(this).scrollTop();

	if (wScroll > 50) {
		$(".header").addClass("fixed");
	} else {
		$(".header").removeClass("fixed");
	}

	// Designed & Developed by Sami from ECIS

	if (wScroll > $('.animate-section1').offset().top - ($(window).height() / 1.5)) {
		$('.animate-section1 .animate').each(function (i) {
			setTimeout(function () {
				$('.animate-section1 .animate').eq(i).addClass('doneTranslate');
			}, 150 * (i + 1));
		});
	}
	if (wScroll > $('.animate-section2').offset().top - ($(window).height() / 1.5)) {
		$('.animate-section2 .animate').each(function (i) {
			setTimeout(function () {
				$('.animate-section2 .animate').eq(i).addClass('doneTranslate');
			}, 150 * (i + 1));
		});
	}
	if (wScroll > $('.animate-section3').offset().top - ($(window).height() / 1.5)) {
		$('.animate-section3 .animate').each(function (i) {
			setTimeout(function () {
				$('.animate-section3 .animate').eq(i).addClass('doneTranslate');
			}, 150 * (i + 1));
		});
	}
	if (wScroll > $('.animate-section4').offset().top - ($(window).height() / 1.5)) {
		$('.animate-section4 .animate').each(function (i) {
			setTimeout(function () {
				$('.animate-section4 .animate').eq(i).addClass('doneTranslate');
			}, 150 * (i + 1));
		});
	}
	if (wScroll > $('.animate-section5').offset().top - ($(window).height() / 1.5)) {
		$('.animate-section5 .animate').each(function (i) {
			setTimeout(function () {
				$('.animate-section5 .animate').eq(i).addClass('doneTranslate');
			}, 150 * (i + 1));
		});
	}
});