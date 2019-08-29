@extends('layout')

@section('content')

	<div class="home-new-product">
		<div class="container">
			<div class="title"> Hasil Pencarian : "<span class="italic">Nama Produk</span>" </div>
			<div class="filter-box">
				Cari Produk: <input type="email" class="filter-name" id="" name="email" placeholder="Nama Product">
				<span class="mr20 hidden-xs"> | </span>
				<span class="visible-xs"> <br/> </span>
				Urutkan : <a href="#" class="active mr5"> Termurah </a> <a href="#"> Termahal </a>
				<!--
				<span class="mr20"> | </span>
				Order : <a href="#" class="active  mr5"> Ascending </a> <a href="#"> Descending </a>
				-->
				<span class="mr20 hidden-xs"> | </span>
				<span class="visible-xs"> <br/> </span>
				Order : <a href="#" class="active  mr5"> 40 </a> <a href="#" class="mr5"> 80 </a> <a href="#" class="mr5"> 120 </a> <a href="#" class="mr5"> 160 </a>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-6">
					<div class="product-box">
						<a href="{{ url('/product-detail') }}">
							<div class="product-img"> <img src="{{ asset('images/uploads/prod01.jpg') }}" class="img-responsive"/> </div>
							<div class="product-name text-center"> Lorem Ipsum Dolor Sit Amet Doleros Laras </div>
							<div class="product-price text-center"> <span class="product-price-code">RP</span> 100.000 </div>
						</a>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6">
					<div class="product-box">
						<a href="{{ url('/product-detail') }}">
							<div class="product-img"> <img src="{{ asset('images/uploads/prod04.jpg') }}" class="img-responsive"/> </div>
							<div class="product-name text-center"> Nama Produk </div>
							<div class="product-price text-center"> <span class="product-price-code">RP</span> 100.000 </div>
						</a>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6">
					<div class="product-box">
						<a href="{{ url('/product-detail') }}">
							<div class="product-img"> <img src="{{ asset('images/uploads/prod01.jpg') }}" class="img-responsive"/> </div>
							<div class="product-name text-center"> Nama Produk </div>
							<div class="product-price text-center"> <span class="product-price-code">RP</span> 100.000 </div>
						</a>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6">
					<div class="product-box">
						<a href="{{ url('/product-detail') }}">
							<div class="product-img"> <img src="{{ asset('images/uploads/prod04.jpg') }}" class="img-responsive"/> </div>
							<div class="product-name text-center"> Nama Produk </div>
							<div class="product-price text-center"> <span class="product-price-code">RP</span> 100.000 </div>
						</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-6">
					<div class="product-box">
						<a href="{{ url('/product-detail') }}">
							<div class="product-img"> <img src="{{ asset('images/uploads/prod01.jpg') }}" class="img-responsive"/> </div>
							<div class="product-name text-center"> Nama Produk </div>
							<div class="product-price text-center"> <span class="product-price-code">RP</span> 100.000 </div>
						</a>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6">
					<div class="product-box">
						<a href="{{ url('/product-detail') }}">
							<div class="product-img"> <img src="{{ asset('images/uploads/prod04.jpg') }}" class="img-responsive"/> </div>
							<div class="product-name text-center"> Nama Produk </div>
							<div class="product-price text-center"> <span class="product-price-code">RP</span> 100.000 </div>
						</a>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6">
					<div class="product-box">
						<a href="{{ url('/product-detail') }}">
							<div class="product-img"> <img src="{{ asset('images/uploads/prod01.jpg') }}" class="img-responsive"/> </div>
							<div class="product-name text-center"> Nama Produk </div>
							<div class="product-price text-center"> <span class="product-price-code">RP</span> 100.000 </div>
						</a>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6">
					<div class="product-box">
						<a href="{{ url('/product-detail') }}">
							<div class="product-img"> <img src="{{ asset('images/uploads/prod04.jpg') }}" class="img-responsive"/> </div>
							<div class="product-name text-center"> Nama Produk </div>
							<div class="product-price text-center"> <span class="product-price-code">RP</span> 100.000 </div>
						</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-6">
					<div class="product-box">
						<a href="{{ url('/product-detail') }}">
							<div class="product-img"> <img src="{{ asset('images/uploads/prod01.jpg') }}" class="img-responsive"/> </div>
							<div class="product-name text-center"> Nama Produk </div>
							<div class="product-price text-center"> <span class="product-price-code">RP</span> 100.000 </div>
						</a>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6">
					<div class="product-box">
						<a href="{{ url('/product-detail') }}">
							<div class="product-img"> <img src="{{ asset('images/uploads/prod04.jpg') }}" class="img-responsive"/> </div>
							<div class="product-name text-center"> Nama Produk </div>
							<div class="product-price text-center"> <span class="product-price-code">RP</span> 100.000 </div>
						</a>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6">
					<div class="product-box">
						<a href="{{ url('/product-detail') }}">
							<div class="product-img"> <img src="{{ asset('images/uploads/prod01.jpg') }}" class="img-responsive"/> </div>
							<div class="product-name text-center"> Nama Produk </div>
							<div class="product-price text-center"> <span class="product-price-code">RP</span> 100.000 </div>
						</a>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6">
					<div class="product-box">
						<a href="{{ url('/product-detail') }}">
							<div class="product-img"> <img src="{{ asset('images/uploads/prod04.jpg') }}" class="img-responsive"/> </div>
							<div class="product-name text-center"> Nama Produk </div>
							<div class="product-price text-center"> <span class="product-price-code">RP</span> 100.000 </div>
						</a>
					</div>
				</div>
			</div>
			<div>
				<ul class="pagination">
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#">6</a></li>
					<li><a href="#">7</a></li>
					<li><a href="#">8</a></li>
					<li><a href="#">9</a></li>
					<li><a href="#">10</a></li>
					<li><a href="#">More &rarr; </a></li>
				</ul>
			</div>
		</div>
	</div>

@stop
