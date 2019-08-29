$(function() {

	$('.full-height').height($(window).height());

	$('.click-box').click(function(event) {
        $('.open-box').addClass('animate-open');
    });


	$('.click-box2').click(function(event) {
        $('.open-box2').addClass('animate-open');
    });

	$('.close-box').click(function(event) {
        $('.open-box').removeClass('animate-open');
        $('.open-box2').removeClass('animate-open');
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
	$(".txtboxToFilter").keydown(function (e) {
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

	datatable1 = $('#table_id').DataTable();
	datatable2 = $('#table_id2').DataTable();

	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		var links = this.el.find('.link');

		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this),
			$next = $this.next();

		$next.slideToggle();
		$this.parent().toggleClass('open');

		if (!e.data.multiple) {
			$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
		};
	}
	
	$('.start-date').datetimepicker({
		timepicker:false,
		format:'d-m-Y',
		formatDate:'Y.m.d',
		scrollInput:false,
		onShow:function( ct ){
		this.setOptions({

		})
		},
		onSelectDate:function( ct, $i ){
			$('.end-date').datetimepicker({ minDate:ct });
		}
	});

	$('.end-date').datetimepicker({
		timepicker:false,
		format:'d-m-Y',
		formatDate:'Y.m.d',
		scrollInput:false,
		onShow:function( ct ){
		this.setOptions({

		})
		},
		onSelectDate:function( ct, $i ){
		}
	});

	var accordion = new Accordion($('#accordion'), false);

	var getUrl = window.location;
	var baseUrl = getUrl .protocol + "//" + getUrl.host + "/";
	//var baseUrl = getUrl .protocol + "//" + getUrl.host + "/kjp/public/";
	tinyMCE.baseURL = baseUrl+"adminasset/js/tinymce";
	tinymce.init({
		baseURL: baseUrl,
        selector: "textarea#mceEdit",
        theme: "modern",
        width: 680,
        height: 300,
        subfolder:"",
        plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
        "contextmenu directionality emoticons paste textcolor filemanager"
        ],
        image_advtab: true,
        toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code",
    });

	// custom
	tinymce.init({
        selector: "textarea#mceCustom",
        theme: "modern",
        width: 400,
        height: 150,
        subfolder:"",
        plugins: [
        "image",
        "",
        ""
        ],
        image_advtab: true,
        toolbar: "image media"
    });

	//no feature //
	tinymce.init({
        selector: "textarea#mceFixed",
        theme: "modern",
        width: 400,
        height: 150,
        subfolder:"",
        image_advtab: true
    });

	$('.fancybox').fancybox();

	$(document).keyup(function(e) {
		if (e.keyCode == 27) {
			$.fancybox.close();
		}
	});

	$('.btn-cancel').click(function(event) {
        $.fancybox.close();
    });

	$(".tabs-menu a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".tab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });


});

function custom_select(e) {
	el = $(e);
	if (el.find('option:selected') != 0) {
		text = el.find('option:selected').text();
	} else {
		text = el.siblings('.replacement').attr('data-text');
	}
	el.siblings('.replacement').html(text);
}
