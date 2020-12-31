@extends('layout')

@section('content')

	<div id="home-banner">
		<div id="slider-banner" class="owl-carousel">
				@foreach($sliders as $slider)
				<div class="item">
					<div class="img-banner">
						<img src="{{ asset($slider->image_path) }}" alt="" title=""/>
					</div>
					<div class="overlay"></div>
				</div>
				@endforeach
			</div>
		</div>
	</div>

	@if(count($saleProduts)>0)
	<div class="home-new-product white hidden-xs">
		<div class="container">
			<div class="title"> Promo </div>
			<div class="row">
				@foreach($saleProduts as $product)
				<div class="col-md-3 col-sm-3 col-xs-6 item-four">
					<div class="product-box">
						<a href="{{ url('/product-detail/'.$product->slug) }}">
							<div class="product-img"> <img src="{{ asset(explode("::",$product->image_path)[0]) }}" class="img-responsive"/> </div>
							<div class="product-name text-center"> {{ $product->product_name }} </div>
							<div class="product-price text-center"> <span class="product-price-code">RP</span> {{ number_format($product->product_price - ($product->sale * $product->product_price / 100)) }} </div>
						</a>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	@endif

	<div class="home-new-product white hidden-xs">
		<div class="container">
			<div class="title"> Produk Terlaris </div>
			<div class="row">
				@foreach($hotProduts as $product)
				<div class="col-md-3 col-sm-3 col-xs-6 item-four">
					<div class="product-box">
						<a href="{{ url('/product-detail/'.$product->slug) }}">
							<div class="product-img"> <img src="{{ asset(explode("::",$product->image_path)[0]) }}" class="img-responsive"/> </div>
							<div class="product-name text-center"> {{ $product->product_name }} </div>
							<div class="product-price text-center"> <span class="product-price-code">RP</span> {{ number_format($product->product_price - ($product->sale * $product->product_price / 100)) }} </div>
						</a>
					</div>
				</div>
        		@endforeach
			</div>
		</div>
	</div>

	<div class="home-best-seller hidden-xs">
		<div class="container">
			<div class="title"> Produk Terbaru </div>
			<div class="row">
				<div class="hidden-xs">
        @foreach($newProducts as $new)
				<div class="col-md-3 col-sm-3 col-xs-6 item-four">
					<div class="product-box">
					<a href="{{ url('/product-detail/'.$new->slug) }}">
							<div class="product-img"> <img src="{{ asset(explode("::",$new->image_path)[0]) }}" class="img-responsive"/> </div>
							<div class="product-name text-center"> {{ $new->product_name }} </div>
							<div class="product-price text-center"> <span class="product-price-code">RP</span> {{ number_format(($new->sale != null ? $new->product_price - ($new->sale * $new->product_price / 100) : $new->product_price)) }} </div>
						</a>
					</div>
				</div>
        @endforeach
				</div>

				<div class="visible-xs">
					@foreach($newProducts as $new)
						@if($loop->index % 2 == 0 or $loop->index == 0) @if($loop->index!=0) </div> @endif <div class="row"> @endif
					<div class="col-xs-6 item-two">
						<div class="product-box">
							<a href="{{ url('/product-detail/'.$new->slug) }}">
								<div class="product-img"> <img src="{{ asset(explode("::",$new->image_path)[0]) }}" class="img-responsive"/> </div>
								<div class="product-name text-center"> {{ $new->product_name }} </div>
								<div class="product-price text-center"> <span class="product-price-code">RP</span> {{ number_format(($new->sale != null ? $new->product_price - ($new->sale * $new->product_price / 100) : $new->product_price)) }} </div>
							</a>
						</div>
					</div>
					@if($loop->last)</div>@endif
					@endforeach
				</div>
			</div>
			<div class="more-product">
				<a href="{{ url('/product?urut=terbaru&order=40') }}"> More &rarr; </a>
			</div>
		</div>
	</div>

	<!-- NEW -->
	<div class="bg-tab">
		<div class="container">
			<div class="t-tab">Produk</div>
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item active">
					<a class="nav-link" id="terbaru-tab" data-toggle="tab" href="#terbaru" role="tab" aria-controls="terbaru" aria-selected="true">Terbaru</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="promo-tab" data-toggle="tab" href="#promo" role="tab" aria-controls="promo" aria-selected="false">Promo</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="terlaku-tab" data-toggle="tab" href="#terlaku" role="tab" aria-controls="terlaku" aria-selected="false">Terlaris</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="kategori-tab" data-toggle="tab" href="#kategori" role="tab" aria-controls="kategori" aria-selected="false">Kategori</a>
				</li>
			</ul>
		</div>
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active in" id="terbaru" role="tabpanel" aria-labelledby="terbaru-tab">
				<div class="container">
					<div class="row">
        				@foreach($newProducts as $new)
						<div class="col-xs-6 item-two">
							<div class="product-box">
								<a href="{{ url('/product-detail/'.$new->slug) }}">
									<div class="product-img"> <img src="{{ asset(explode("::",$new->image_path)[0]) }}" class="img-responsive"/> </div>
									<div class="product-name text-center"> {{ $new->product_name }} </div>
									<div class="product-price text-center"> <span class="product-price-code">RP</span> {{ number_format(($new->sale != null ? $new->product_price - ($new->sale * $new->product_price / 100) : $new->product_price)) }} </div>
								</a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="promo" role="tabpanel" aria-labelledby="promo-tab">
				<div class="container">
					<div class="row">
						@foreach($saleProduts as $product)
						<div class="col-xs-6 item-two">
							<div class="product-box">
								<a href="{{ url('/product-detail/'.$product->slug) }}">
									<div class="product-img"> <img src="{{ asset(explode("::",$product->image_path)[0]) }}" class="img-responsive"/> </div>
									<div class="product-name text-center"> {{ $product->product_name }} </div>
									<div class="product-price text-center"> <span class="product-price-code">RP</span> {{ number_format($product->product_price - ($product->sale * $product->product_price / 100)) }} </div>
								</a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="terlaku" role="tabpanel" aria-labelledby="terlaku-tab">
				<div class="container">
					<div class="row">
        				@foreach($hotProduts as $product)
						<div class="col-xs-6 item-two">
							<div class="product-box">
								<a href="{{ url('/product-detail/'.$product->slug) }}">
									<div class="product-img"> <img src="{{ asset(explode("::",$product->image_path)[0]) }}" class="img-responsive"/> </div>
									<div class="product-name text-center"> {{ $product->product_name }} </div>
									<div class="product-price text-center"> <span class="product-price-code">RP</span> {{ number_format($product->product_price - ($product->sale * $product->product_price / 100)) }} </div>
								</a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="kategori" role="tabpanel" aria-labelledby="kategori-tab">
				<div class="container">
	            	@foreach($categories as $category)
					<div class="category-name">
						<a href="{{ url('/product/'.$category->category_slug) }}">
							{{ $category->category_name }}
						</a>
					</div>
					<ul class="category-list">
						@foreach($category->subcategories as $subcategory)
							<li> <a href="{{ url('/product/'.$category->category_slug.'/'.$subcategory->subcategory_slug) }}"> {{$subcategory->subcategory_name}} </a> </li>
						@endforeach
					</ul>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<!-- END NEW -->

	
	@if(count($testimonies) > 0)
	<div class="home-article">
		<div class="container">
			<div class="title"> Testimoni </div>
			<div class="row">
        @foreach($testimonies as $testimony)
          @php $words=implode(' ', array_slice(explode(' ', strip_tags($testimony->testimony_content)), 0, 20)); @endphp
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="test-box">
						<div class="test-title"> {{ $testimony->testimony_title }} </div>
						<div class="test-desc">{{ $testimony->testimony_content }}</div>
						<div class="test-from"> {{ $testimony->written_by }} </div>
					</div>
				</div>
        @endforeach
			</div>
		</div>
	</div>
	@endif
	@if(count($newArticles) > 0)
	<div class="home-testimony">
		<div class="container">
			<div class="title"> Artikel Terbaru </div>
			<div class="row">
        @foreach($newArticles as $new)
        @php $words=implode(' ', array_slice(explode(' ', strip_tags($new->article_content)), 0, 20)); @endphp
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="art-boxx">
						<a href="{{ url('/article-detail/'.$new->article_slug) }}">
							<div class="art-img"> <img src="{{ asset($new->image_path) }}" class="img-responsive"/> </div>
							<div class="art-box">
								<div class="art-title"> {{ $new->article_title }} </div>
								<div class="art-desc"> {{ $words }}.. </div>
								<div class="art-more pull-right"> READ MORE </div>
							</div>
						</a>
					</div>
				</div>
        @endforeach
			</div>
		</div>
	</div>
	@endif
@stop
