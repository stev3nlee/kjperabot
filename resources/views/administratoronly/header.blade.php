<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="_token" content="{{ csrf_token() }}"/>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Admin</title>

	<!-- Favicon -->
	<link rel="icon" type="image/ico" href="{{ asset('adminasset/uploads/favicon.ico') }}">

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('adminasset/css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('adminasset/css/icon-font.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('adminasset/js/dataTable/datatable.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('adminasset/js/datetimepicker/jquery.datetimepicker.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('adminasset/js/fancybox/jquery.fancybox.css?v=2.1.5') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('adminasset/css/fonts.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('adminasset/css/web.css?v=2') }}">

	<script type="text/javascript" src="{{ asset('adminasset/js/jquery-1.11.1.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('adminasset/js/bootstrap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('adminasset/js/datetimepicker/jquery.datetimepicker.js') }}"></script>
	<script type="text/javascript" src="{{ asset('adminasset/js/dataTable/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('adminasset/js/fancybox/jquery.fancybox.js?v=2.1.5') }}"></script>
	<script type="text/javascript" src="{{ asset('adminasset/js/web.js?v=1') }}"></script>

    <!-- tinymce -->

	<script type="text/javascript" src="{{ asset('adminasset/js/tinymce/tinymce.min.js') }}"></script>
	<script type="text/javascript">
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	</script>
	<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/98aeb53714a03473ee7c09679/fbb4c2697aa8516adc303018c.js");</script>
</head>
<body>

	<div class="wrapper">
		<header>
			<div id="header">
				<div class="clearfix">
					<div class="pull-left center-header">
						<div class="tbl">
							<div class="cell">
								<div class="logo">
									<img src="{{ asset('adminasset/uploads/logo2.png') }}"/>&nbsp; <span class="bold">{{ ucwords(strtolower(Auth::guard('administrator')->user()->name)) }}</span></a>
								</div>
							</div>
						</div>
					</div>
					<div class="pull-right center-header">
						<div class="tbl">
							<div class="cell">
								<a href="{{ url('/logout') }}"><span class="lnr lnr-exit" style="font-size: 1.16em; position: relative; top: 2px;"></span>&nbsp; Sign Out</a>
							</div>
						</div>
					</div>
					<div class="pull-right center-header" style="margin-right: 20px;">
						<div class="tbl">
							<div class="cell">
								<span class="lnr lnr-user"></span>&nbsp; {{ ucwords(strtolower(Auth::guard('administrator')->user()->name)) }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
