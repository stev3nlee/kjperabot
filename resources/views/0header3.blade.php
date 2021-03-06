<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>{{ $company->meta_title }}</title>

	<meta name="author" content="{{ $company->meta_title }}">
	<meta name="description" content="{{ $company->meta_description }}">
	<meta name="keyword" content="{{ $company->meta_keyword }}">

	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('js/owl/owl.carousel.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('js/owl/owl.transitions.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('js/dataTable/datatable.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('js/dataTable/responsive.bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('js/fancybox/jquery.fancybox.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('js/simple-pagination/simplePagination.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/fonts.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">


	<script type="text/javascript" src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/typeahead.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery.number.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/accordion/jquery-ui.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/dataTable/jquery.dataTables.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('js/dataTable/dataTables.bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('js/dataTable/dataTables.responsive.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('js/simple-pagination/jquery.simplePagination.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/fancybox/jquery.fancybox.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/owl/owl.carousel.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/web.js') }}"></script>

	<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '313435666666044');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=313435666666044&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
</head>
<body>

<section id="main-page">
	<div class="pos-rel">
		<div class="bg-dark"></div>
		<header id="header3">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
						<div class="h70">
							<div class="tbl">
								<div class="cell">
									<div class="img-logo-mobile"><a href="{{ url('/') }}"><img src="{{ asset($company->logo_path) }}" class="img-responsive"/></a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
