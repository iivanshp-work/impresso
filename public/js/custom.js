$(window).on("load", function() {
	if (
		/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)
	) {
		$("body").addClass("ios");
	} else {
		$("body").addClass("web");
	}
	$("body").removeClass("loaded");
});

$(document).ready(function() {
	let step = 1;

	if (step === 1) $("#step1").show();
	$(".btn-open").click(function() {});
	// slick slider
	$(".slider").slick({
		arrows: false,
		dots: true,
		infinite: true,
		speed: 400,
		slidesToShow: 1,
		slidesToScroll: 1,
		// autoplay: true,
		// autoplaySpeed: 2000,
		slide: ".slider__item"
	});

	// tabs
	$(".tab-navigation").each(function() {
		$(this)
			.find("li")
			.each(function(i) {
				$(this).attr("data-tab", "tab" + i);
				$(this).click(function() {
					$(this)
						.addClass("active")
						.siblings()
						.removeClass("active");
				});
			});
	});

	$(".tab-content").each(function() {
		$(this)
			.find("div.tab-content__item")
			.each(function(i) {
				$(this).attr("data-tab", "tab" + i);
			});
	});

	$(".tab-navigation__item").click(function() {
		let dataTab = $(this).data("tab");
		let getBlock = $(this).closest(".tabs-block");
		let tabContent = $(
			".tab-content>div.tab-content__item[data-tab=" + dataTab + "]"
		);
		getBlock
			.find(tabContent)
			.addClass("open")
			.siblings()
			.removeClass("open");
	});

	// open modal window
	$(".open-pop-up").click(function(e) {
		e.preventDefault();
		let dataTarget = $(this).attr("data-target");
		if ($(this).attr("data-target")) {
			$(dataTarget)
				.fadeIn(400)
				.addClass("show");
			$(".main").addClass("filter-blur");
			$("body").addClass("overflow-hidden");
		}
	});

	// close modal window
	$(".close-modal, .modal-window__content").click(function(e) {
		e.preventDefault();
		$(".modal-window")
			.fadeOut(400)
			.removeClass("show");
		$(".main").removeClass("filter-blur");
		$("body").removeClass("overflow-hidden");
	});

	$(".modal-window__body").click(function(e) {
		e.stopPropagation();
	});

	// accordion
	$(".arrow-down").click(function() {
		$(this).toggleClass("open");
		$(this)
			.parent()
			.addClass("show")
			.next(".dashboard__body")
			.slideToggle();
	});

	// edit profile
	$("#edit-profile").click(function() {
		$(".user").addClass("edit-profile");
		$(".header-title").text("Edit Profile");
	});

	$("#save").click(function() {
		$(".user").removeClass("edit-profile");
		$(".header-title").text("Profile");
	});

	// $(".edit-info").click(function() {
	// 	$(this)
	// 		.parent()
	// 		.find("input, textarea")
	// 		.removeAttr("disabled");
	// });
});
