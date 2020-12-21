@extends('layout')

@section('content')

<!--
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
-->

	<div id="home-banner">
		<!--
		<div class="center-slider hidden-xs">
			<div class="h700">
				<div class="tbl">
					<div class="cell">
						<div class="home-search">
							<div class="search-center">
								<form action="{{ url('/search') }}" method="get">
									<div class="search-box form-control">
										<input type="text" name="q" placeholder="Cari nama produk.."/>
										<button type="submit" class="btn">CARI</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		-->
		<div id="slider-banner" class="owl-carousel">
				@foreach($sliders as $slider)
				<div class="item">
					<div class="img-banner" style="background:url('{{ asset($slider->image_path) }}') no-repeat center 0;"></div>
					<div class="overlay"></div>
				</div>
				@endforeach
			</div>
		</div>
	</div>

	<div class="home-best-seller">
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
				<a href="{{ url('/product?urut=terbaru&order=40') }}"> More &rarr; </a>
			</div>
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
	<div class="home-new-product">
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

	<!-- NEW -->
	<div class="bg-tab">
		<div class="container">
			<div class="t-tab">Produk</div>
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item active">
					<a class="nav-link" id="kategori-tab" data-toggle="tab" href="#kategori" role="tab" aria-controls="kategori" aria-selected="true">Kategori</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="promo-tab" data-toggle="tab" href="#promo" role="tab" aria-controls="promo" aria-selected="false">Promo</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="terbaru-tab" data-toggle="tab" href="#terbaru" role="tab" aria-controls="terbaru" aria-selected="false">Terbaru</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="terlaku-tab" data-toggle="tab" href="#terlaku" role="tab" aria-controls="terlaku" aria-selected="false">Terlaku</a>
				</li>
			</ul>
		</div>
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active in" id="kategori" role="tabpanel" aria-labelledby="kategori-tab">
				<div class="container">
					<div class="category-name">
						<a href="https://kjperabot.co.id/product/home-kitchen">
							Home Kitchen
						</a>
					</div>
					<ul class="category-list">
						<li> <a href="https://kjperabot.co.id/product/home-kitchen/tea-set"> TEA SET </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-kitchen/aneka-gelas"> GELAS </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-kitchen/aneka-teko"> TEKO </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-kitchen/aneka-sendokk"> PERALATAN MAKAN </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-kitchen/tempat-makan"> KOTAK MAKAN </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-kitchen/aneka-toples"> TOPLES </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-kitchen/drink-jar"> DRINK JAR </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-kitchen/nampan"> NAMPAN </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-kitchen/kompor"> KOMPOR </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-kitchen/botol"> BOTOL </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-kitchen/alat-saji"> WADAH SAJI </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-kitchen/ayam-jago-series"> AYAM JAGO SERIES </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-kitchen/bambu-series"> BAMBU &amp; KAYU SERIES </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-kitchen/peralatan-masak"> PERALATAN MASAK </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-kitchen/gerabah-series"> GERABAH SERIES </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-kitchen/cetakan-loyang-kue"> CETAKAN &amp; LOYANG KUE </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-kitchen/lain-lain"> LAIN - LAIN </a> </li>
					</ul>

					<div class="category-name">
						<a href="https://kjperabot.co.id/product/home-living">
							Home Living
						</a>
					</div>
					<ul class="category-list">
						<li> <a href="https://kjperabot.co.id/product/home-living/aneka-wajan"> TEMPAT SERBAGUNA </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-living/aneka-rak-sepatu"> RAK SEPATU </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-living/aneka-karpet-puzzle"> KARPET PUZZLE </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-living/aneka-jas-hujan"> JAS HUJAN </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-living/aneka-payung"> PAYUNG </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-living/aneka-sepatu-boot"> SEPATU BOOT </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-living/aneka-hanger"> ANEKA HANGER </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-living/meja-setrika-lipat"> MEJA SETRIKA </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-living/lilin-aromaterapi"> ANEKA LILIN </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-living/tas"> TAS SERBAGUNA </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-living/gantungan-kunci"> GANTUNGAN KUNCI </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-living/perlengkapan-kamar-tidur"> PERLENGKAPAN KAMAR TIDUR </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-living/kapstock"> KAPSTOCK </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-living/perlengkapan-rumah"> PERLENGKAPAN RUMAH </a> </li>
						<li> <a href="https://kjperabot.co.id/product/home-living/perlengkapan-lain"> PERLENGKAPAN LAIN </a> </li>
					</ul>
				</div>
			</div>
			<div class="tab-pane fade" id="promo" role="tabpanel" aria-labelledby="promo-tab">
				<div class="container">
					<div class="row">
						<div class="col-xs-6">
							<div class="product-box">
								<a href="https://kjperabot.co.id/product-detail/ttissu-roll-kayu-kitchen">
									<div class="product-img"> <img src="https://kjperabot.co.id/images/uploads/8c269f4616acda0da964328c67ae8ba7.jpeg" class="img-responsive"> </div>
									<div class="product-name text-center"> T.TISSU ROLL KAYU KITCHEN </div>
									<div class="product-price text-center"> <span class="product-price-code">RP</span> 35,000 </div>
								</a>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="product-box">
								<a href="https://kjperabot.co.id/product-detail/sendok-makan-doll-403-isi-6">
									<div class="product-img"> <img src="https://kjperabot.co.id/images/uploads/57e40cd53ecdd0c406844fab54f3c823.jpeg" class="img-responsive"> </div>
									<div class="product-name text-center"> SENDOK MAKAN DOLL 403 ISI 6 </div>
									<div class="product-price text-center"> <span class="product-price-code">RP</span> 35,000 </div>
								</a>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="product-box">
								<a href="https://kjperabot.co.id/product-detail/white-line-mug-coconut">
									<div class="product-img"> <img src="https://kjperabot.co.id/images/uploads/4c5babe891c0661b5af6d2298dedeca1.jpeg" class="img-responsive"> </div>
									<div class="product-name text-center"> WHITE LINE MUG COCONUT </div>
									<div class="product-price text-center"> <span class="product-price-code">RP</span> 17,000 </div>
								</a>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="product-box">
								<a href="https://kjperabot.co.id/product-detail/rak-bawang-serbaguna-ss2">
									<div class="product-img"> <img src="https://kjperabot.co.id/images/uploads/53ae7028a657f104afb1467e0588062c.jpeg" class="img-responsive"> </div>
									<div class="product-name text-center"> RAK BAWANG SERBAGUNA SS2 </div>
									<div class="product-price text-center"> <span class="product-price-code">RP</span> 125,000 </div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="terbaru" role="tabpanel" aria-labelledby="terbaru-tab">
				<div class="container">
					<div class="row">
						<div class="col-xs-6">
							<div class="product-box">
								<a href="https://kjperabot.co.id/product-detail/ttissu-roll-kayu-kitchen">
									<div class="product-img"> <img src="https://kjperabot.co.id/images/uploads/8c269f4616acda0da964328c67ae8ba7.jpeg" class="img-responsive"> </div>
									<div class="product-name text-center"> T.TISSU ROLL KAYU KITCHEN </div>
									<div class="product-price text-center"> <span class="product-price-code">RP</span> 35,000 </div>
								</a>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="product-box">
								<a href="https://kjperabot.co.id/product-detail/sendok-makan-doll-403-isi-6">
									<div class="product-img"> <img src="https://kjperabot.co.id/images/uploads/57e40cd53ecdd0c406844fab54f3c823.jpeg" class="img-responsive"> </div>
									<div class="product-name text-center"> SENDOK MAKAN DOLL 403 ISI 6 </div>
									<div class="product-price text-center"> <span class="product-price-code">RP</span> 35,000 </div>
								</a>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="product-box">
								<a href="https://kjperabot.co.id/product-detail/white-line-mug-coconut">
									<div class="product-img"> <img src="https://kjperabot.co.id/images/uploads/4c5babe891c0661b5af6d2298dedeca1.jpeg" class="img-responsive"> </div>
									<div class="product-name text-center"> WHITE LINE MUG COCONUT </div>
									<div class="product-price text-center"> <span class="product-price-code">RP</span> 17,000 </div>
								</a>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="product-box">
								<a href="https://kjperabot.co.id/product-detail/rak-bawang-serbaguna-ss2">
									<div class="product-img"> <img src="https://kjperabot.co.id/images/uploads/53ae7028a657f104afb1467e0588062c.jpeg" class="img-responsive"> </div>
									<div class="product-name text-center"> RAK BAWANG SERBAGUNA SS2 </div>
									<div class="product-price text-center"> <span class="product-price-code">RP</span> 125,000 </div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="terlaku" role="tabpanel" aria-labelledby="terlaku-tab">
				<div class="container">
					<div class="row">
						<div class="col-xs-6">
							<div class="product-box">
								<a href="https://kjperabot.co.id/product-detail/ttissu-roll-kayu-kitchen">
									<div class="product-img"> <img src="https://kjperabot.co.id/images/uploads/8c269f4616acda0da964328c67ae8ba7.jpeg" class="img-responsive"> </div>
									<div class="product-name text-center"> T.TISSU ROLL KAYU KITCHEN </div>
									<div class="product-price text-center"> <span class="product-price-code">RP</span> 35,000 </div>
								</a>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="product-box">
								<a href="https://kjperabot.co.id/product-detail/sendok-makan-doll-403-isi-6">
									<div class="product-img"> <img src="https://kjperabot.co.id/images/uploads/57e40cd53ecdd0c406844fab54f3c823.jpeg" class="img-responsive"> </div>
									<div class="product-name text-center"> SENDOK MAKAN DOLL 403 ISI 6 </div>
									<div class="product-price text-center"> <span class="product-price-code">RP</span> 35,000 </div>
								</a>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="product-box">
								<a href="https://kjperabot.co.id/product-detail/white-line-mug-coconut">
									<div class="product-img"> <img src="https://kjperabot.co.id/images/uploads/4c5babe891c0661b5af6d2298dedeca1.jpeg" class="img-responsive"> </div>
									<div class="product-name text-center"> WHITE LINE MUG COCONUT </div>
									<div class="product-price text-center"> <span class="product-price-code">RP</span> 17,000 </div>
								</a>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="product-box">
								<a href="https://kjperabot.co.id/product-detail/rak-bawang-serbaguna-ss2">
									<div class="product-img"> <img src="https://kjperabot.co.id/images/uploads/53ae7028a657f104afb1467e0588062c.jpeg" class="img-responsive"> </div>
									<div class="product-name text-center"> RAK BAWANG SERBAGUNA SS2 </div>
									<div class="product-price text-center"> <span class="product-price-code">RP</span> 125,000 </div>
								</a>
							</div>
						</div>
					</div>
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
