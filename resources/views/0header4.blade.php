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
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css?v.1') }}">

	<script>var site_url = '';</script>
	<script type="text/javascript" src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/simple-pagination/jquery.simplePagination.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/accordion/jquery-ui.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/dataTable/jquery.dataTables.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('js/dataTable/dataTables.bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('js/dataTable/dataTables.responsive.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('js/fancybox/jquery.fancybox.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/owl/owl.carousel.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/web.js') }}"></script>

	<style>
		.fix-wa { position: fixed; right: 20px; bottom: 15px; z-index: 100; border-radius:30px;  }
		.fix-wa img { border-radius:30px; width:105px;}
	</style>
	
</head>
<body>

<section id="main-page">
	<div class="pos-rel">
		<div class="bg-dark"></div>
		<header id="header2">
			<div class="container">
				<div class="row">
					<div class="visible-xs col-xs-4">
						<div class="h70">
							<div class="tbl">
								<div class="cell" style="position: relative;left: -22px;">
									<a class="toggle-menu">
										<img src="{{ asset('icons/menu-toggle.svg') }}" class=""/>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="visible-xs col-xs-4">
						<div class="h70">
							<div class="tbl">
								<div class="cell">
									<div class="img-logo-mobile text-center"><a href="{{ url('/') }}"><img src="{{ asset($company->logo_path) }}" class="img-responsive"/></a></div>
								</div>
							</div>
						</div>
					</div>
					<div class="visible-xs col-xs-4">
						<div class="h70">
							<div class="tbl">
								<div class="cell">
									<div class="text-right"><a href="{{ url('/cart') }}">CART ({{ $cart_count }})</a></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-1 col-md-1 hidden-xs">
						<div class="h70">
							<div class="tbl">
								<div class="cell">
									<div class="img-logo-mobile"><a href="{{ url('/') }}"><img src="{{ asset($company->logo_path) }}" class="img-responsive"/></a></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-7 col-md-7 hidden-xs">
						<div class="h70">
							<div class="tbl">
								<div class="cell">
									<ul class="list-inline-b">
										<li> <a href="{{ url('/') }}"> <div>Beranda</div> </a>	</li>
										<li> <a href="{{ url('/category') }}"> <div>Kategori</div> </a> </li>
										<li> <a href="{{ url('/contact') }}"> <div>Kontak Kami</div> </a> </li>
										<li> <a href="{{ url('/about') }}"> <div>Tentang Kami</div> </a> </li>
										<li> <a href="{{ url('/article') }}"> <div>Artikel</div> </a> </li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4 col-md-4 hidden-xs">
						<div class="h70">
							<div class="tbl">
								<div class="cell">
									<ul class="list-inline-b text-right">
										<li class="blueunderscore">
											<form action="{{ url('/search') }}" method="get" style="width:100px;">
												<input type="text" class="form-search" name="q" placeholder="Cari produk..">
											</form>
										</li>
										<li class="blueunderscore">
											@if(Auth::check())
											<a href="{{ url('/profile') }}">
												<div>{{ ucwords(Auth::user()->first_name) }} {{ ucwords(Auth::user()->last_name) }}</div>
											</a>
											@else
											<a href="{{ url('/sign') }}">
												<div>Login/Daftar</div>
											</a>
											@endif
										</li>
										<li class="blueunderscore">
											<a href="{{ url('/cart') }}">
												<div>Cart ({{ $cart_count }})</div>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
