@extends('layout2')

@section('content')

	<div class="home-search-mobile visible-xs">
		<div class="search-center">
			<form action="{{ url('/search') }}" method="get">
				<div class="home-search-box form-control">
					<input type="text" name="q" placeholder="Cari nama produk.."/>
					<button type="submit" class="btn">CARI</button>
				</div>
			</form>
		</div>
	</div>

	@if(count($saleProduts)>0)
		<div class="home-best-seller">
			<div class="container">
				<div class="title"> Produk Diskon </div>
				<div class="row">
	        @foreach($saleProduts as $product)
					<div class="col-md-3 col-sm-3 col-xs-6">
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
	@else
	<div class="home-best-seller">
		<div class="container">
			<div class="title"> Produk Terlaku </div>
			<div class="row">
        @foreach($hotProduts as $product)
				<div class="col-md-3 col-sm-3 col-xs-6">
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

	<div class="home-new-product">
		<div class="container">
			<div class="title"> Produk Terbaru </div>
			<div class="row">
				<div class="hidden-xs">
        @foreach($newProducts as $new)
				<div class="col-md-3 col-sm-3 col-xs-6">
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
					<div class="col-xs-6">
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
				<a href="{{ url('/product') }}"> More &rarr; </a>
			</div>
		</div>
	</div>
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
