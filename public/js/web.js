function change_mymenu(a) {
    window.location = site_url + a;
}

$(function() {
	$("html").click(function(a) {
        if (!$(a.target).is(".toggle-menu") && !$(a.target).parents().is(".toggle-menu") && !$(a.target).is("#offcanvas-menu") && !$(a.target).parents().is("#offcanvas-menu")) {
            $("body").removeClass("offcanvas-menu-open");
            $(".bg-dark").hide();
            $(".bg-dark").animate({
                opacity: 0
            });
        }
    });
    $(document).keyup(function(a) {
        if (27 == a.keyCode) {
            $("body").removeClass("offcanvas-menu-open");
            $(".bg-dark").hide();
            $(".bg-dark").animate({
                opacity: 0
            });
        }
    });
    $(".close-menu").click(function(a) {
        a.preventDefault();
        $("body").removeClass("offcanvas-menu-open");
        $(".bg-dark").hide();
        $(".bg-dark").animate({
            opacity: 0
        });
    });
    $(".toggle-menu").click(function(a) {
        a.preventDefault();
        $("body").toggleClass("offcanvas-menu-open");
        $(".bg-dark").show();
        $(".bg-dark").animate({
            opacity: .85
        });
    });

	$('#slider-banner.owl-carousel').owlCarousel({
		slideSpeed : 00,
		paginationSpeed : 500,
		singleItem:true,
		autoPlay: true,
		pagination : false,
		paginationNumbers: false
	});
	$('.close-nav').click(function(){
		$('.box-nav').fadeOut(500);
	});
	$("#table-order").DataTable();
	$('.open-box').click(function(){
		$('.box-nav').fadeIn(500);
	});
	$('input[name="same_address"]').click(function() {
        if ($(this).is(":checked")) $(".same_address").stop(true, true).slideDown(); else $(".same_address").stop(true, true).slideUp();
    });
	$(".fancybox").fancybox();

    $(document).on("keydown", function(a) {
        if (27 === a.keyCode) $.fancybox.close();
    });
    $(".close-fancy").click(function(a) {
        $.fancybox.close();
    });
	$('.close-fancy').click(function(e) {
		$.fancybox.close();
	});
	$(".button-subscribed").click(function(a) {
        $.fancybox.close();
        $(".box-subscribed").hide();
        $(".box-unsubscribed").show();
    });
    $(".button-unsubscribed").click(function(a) {
        $.fancybox.close();
        $(".box-subscribed").show();
        $(".box-unsubscribed").hide();
    });

	$("#txtboxToFilter").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	var a = $(".sync1");
    var b = $(".sync2");
    a.owlCarousel({
        singleItem: true,
        slideSpeed: 1e3,
        navigation: false,
        pagination: false,
        navigationText: false,
        afterAction: c,
        responsiveRefreshRate: 200
    });
    b.owlCarousel({
        items: 3,
        itemsDesktop: [ 1199, 3 ],
        itemsTablet: [ 992, 3 ],
        itemsMobile: [ 768, 3 ],
        pagination: false,
        navigation: true,
        navigationText: true,
        responsiveRefreshRate: 100,
        afterInit: function(a) {
            a.find(".owl-item").eq(0).addClass("synced");
        }
    });
    function c(a) {
        var b = this.currentItem;
        $(".sync2").find(".owl-item").removeClass("synced").eq(b).addClass("synced");
        if (void 0 !== $(".sync2").data("owlCarousel")) d(b);
    }
    $(".sync2").on("click", ".owl-item", function(b) {
        b.preventDefault();
        var c = $(this).data("owlItem");
        a.trigger("owl.goTo", c);
    });
});

function custom_select(a) {
    el = $(a);
    if (0 != el.find("option:selected")) text = el.find("option:selected").text(); else text = el.siblings(".replacement").attr("data-text");
    el.siblings(".replacement").html(text);
}

    jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function() {
      var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

      btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

      btnDown.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

    });
