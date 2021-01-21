@extends('layout')

@section('content')

	<div class="home-new-product">
		<div class="container">
			@if($search != null) <div class="title"> Hasil Pencarian : "<span class="italic">{{ $search }}</span>" </div> @endif
			<div class="title"> Produk Terbaru </div>
			<div class="filter-box">
				<form id="frmSearch" action="{{url('search')}}" method="get">
				Cari Produk: <input type="text" class="filter-name" id="txtSearch" name="q" placeholder="Nama Product">
				<span class="mr20 hidden-xs"> | </span>
				<span class="visible-xs"> <br/> </span>
				Urutkan :
				    <a href="{{ url()->current() }}?{{($search != null) ? "q=".$search."&" : ""}}urut=terbaru&order={{$limit}}" class="@if($order == "terbaru") active @endif"> Terbaru </a>
					<a href="{{ url()->current() }}?{{($search != null) ? "q=".$search."&" : ""}}urut=termurah&order={{$limit}}" class="@if($order == "termurah") active @endif mr5"> Termurah </a>
					<a href="{{ url()->current() }}?{{($search != null) ? "q=".$search."&" : ""}}urut=termahal&order={{$limit}}" class="@if($order == "termahal") active @endif" > Termahal </a>&nbsp;
					
				<!--
				<span class="mr20"> | </span>
				Order : <a href="#" class="active  mr5"> Ascending </a> <a href="#"> Descending </a>
				-->
				<span class="mr20 hidden-xs"> | </span>
				<span class="visible-xs"> <br/> </span>
				Order :
				<a href="{{ url()->current() }}?{{($search != null) ? "q=".$search."&" : ""}}urut={{$order}}&order=40" class="@if($limit == "40") active @endif mr5"> 40 </a>
				<a href="{{ url()->current() }}?{{($search != null) ? "q=".$search."&" : ""}}urut={{$order}}&order=80" class="@if($limit == "80") active @endif mr5"> 80 </a>
				<a href="{{ url()->current() }}?{{($search != null) ? "q=".$search."&" : ""}}urut={{$order}}&order=120" class="@if($limit == "120") active @endif mr5"> 120 </a>
				<a href="{{ url()->current() }}?{{($search != null) ? "q=".$search."&" : ""}}urut={{$order}}&order=160" class="@if($limit == "160") active @endif mr5"> 160 </a>
				</form>
			</div>

			<div class="hidden-xs">
			@foreach($products as $product)
				@if($loop->index % 3 == 0 or $loop->index == 0) @if($loop->index!=0) </div> @endif <div class="row"> @endif
						<div class="col-md-4 col-xs-6">
							<div class="product-box">
								<a href="{{ url('/product-detail/'.$product->slug) }}">
									<div class="product-img"> <img src="{{ asset(explode("::",$product->image_path)[0]) }}" class="img-responsive"/> </div>
									<div class="product-name text-center"> {{ $product->product_name }} </div>
									<div class="product-price text-center"> <span class="product-price-code">RP</span> {{ ($product->sale_price != 0 ? $product->sale_price : $product->product_price) }} </div>
								</a>
							</div>
						</div>
				@if($loop->last)</div>@endif
			@endforeach
			</div>

			<div class="visible-xs">
			@foreach($products as $product)
				@if($loop->index % 2 == 0 or $loop->index == 0) @if($loop->index!=0) </div> @endif <div class="row"> @endif
						<div class="col-md-4 col-xs-6">
							<div class="product-box">
								<a href="{{ url('/product-detail/'.$product->slug) }}">
									<div class="product-img"> <img src="{{ asset(explode("::",$product->image_path)[0]) }}" class="img-responsive"/> </div>
									<div class="product-name text-center"> {{ $product->product_name }} </div>
									<div class="product-price text-center"> <span class="product-price-code">RP</span> {{ ($product->sale_price != 0 ? $product->sale_price : $product->product_price) }} </div>
								</a>
							</div>
						</div>
				@if($loop->last)</div>@endif
			@endforeach
			</div>

			<div class="pagination-holder clearfix">
				<div id="light-pagination" class="pagination"></div>
			</div>
		</div>
	</div>

@stop
@section('script')
	<script>
	$(function(){
		$('.pagination').pagination({
				items: '{{$products->total()}}',
				itemsOnPage: '{{$limit}}',
				currentPage:'{{$products->currentPage()}}',
				hrefTextPrefix:'?{{($search != null) ? "q=".$search."&" : ""}}urut={{$order}}&order={{$limit}}&page=',
				hrefTextSuffix:'',
		});

		$('#txtSearch').keypress(function(event){
		  if(event.keyCode == 13){
		    $('#frmSearch').submit();
		  }
		});
	});
	</script>
@endsection
