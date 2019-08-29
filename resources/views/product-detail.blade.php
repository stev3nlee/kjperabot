@extends('layout')

@section('content')

	<div class="home-new-product content">
		<div class="container">
			<div class="">
				<div class="row">
					@include('errorfile')
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="demo">
							<div class="sync1 owl-carousel">
                @foreach(explode("::",$product->image_path) as $image)
									@if($image != null)
										<div class="item">
											<img src="{{ asset($image) }}" class="img-responsive"/>
										</div>
									@endif
                @endforeach
							</div>
							<div class="sync2 owl-carousel">
                @foreach(explode("::",$product->image_path) as $image)
									@if($image != null)
										<div class="item">
											<img src="{{ asset($image) }}" class="img-responsive"/>
										</div>
									@endif
                @endforeach
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="">
							<div class="product-detail-name"> {{ $product->product_name }} </div>
							<div class="product-detail-price"> <span class="product-price-code">RP</span> {{ number_format(($product->sale != 0 ? $product->product_price - ($product->product_price * $product->sale / 100) : $product->product_price)) }}</div>

							<div class="mb30">
                @if($total_stock == 0)
                  <span class="product-stock outstock"> Stok Habis </span>
                @else
								  <span class="product-stock instock"> Stok Tersedia </span>
                @endif
							</div>

							<div class="bodytext">
							    {!! $product->product_description !!}
							</div>
						</div>
						<div class="row mt30">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="product-color"> SELECT COLOR </div>
								<div class="custom-select">
									<div class="replacement form-control">@if($cart==null) {{$details[0]->color}} @else {{$details->where('id',$cart->product_detail_id)->first()->color}} @endif</div>
									<select class="custom-select form-control" id="select-color" name="color">
                    @foreach($details as $detail)
										<option value="{{$detail->id}}" data-stock="{{$detail->stock}}" @if($cart!=null) @if($cart->product_detail_id == $detail->id) selected @endif @endif >{{ $detail->color }}</option>
                    @endforeach
									</select>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="product-color"> INPUT QUANTITY </div>
								<div class="product-stock outstock" id="div-empty-color" @if($details[0]->stock != 0) style="display:none" @endif> Maaf, untuk warna <span id="text-empty-color">{{$details[0]->color}}</span> telah habis.</div>
								<div class="quantity" id="div-input-quantity" @if($details[0]->stock == 0) style="display:none" @endif>
									<input id="txtboxToFilter" type="number" min="0" max="{{$details[0]->stock}}" class="form-control input-quantity" value="@if($cart!=null){{$cart->qty}}@else{{ 0 }}@endif">
								</div>
							</div>
						</div>
						<div class="mt50 product-detail">
							<span class="">
								@if($cart == null)
									<a onclick="addtocart()" id="btn-addtocart" @if($details[0]->stock == 0) disabled @endif class="btn btn-cart"> ADD TO CART </a>
								@else
									<a onclick="addtocart()" id="btn-addtocart" class="btn btn-cart"> EDIT CART </a>
								@endif
							</span>
							<span class="">
									<a onclick="submitform({{$product->id}})" id="btn-wishlist" class="btn btn-wish"> ADD TO WISHLIST </a>
									@if($cart == null)
										<form style="display:hidden" id="frm-addtocart" method="post" action="{{ url('cart') }}">
									@else
										<form style="display:hidden" id="frm-addtocart" method="post" action="{{ url('cart/edit') }}">
											<input type="hidden" value="{{$cart->id}}" name="cart_id"/>
									@endif
										{{csrf_field()}}
										<input type="hidden" name="product_detail_id" id="product_detail_id" value="">
										<input type="hidden" name="quantity" id="qty" value="">
									</form>
									<form style="display:hidden" id="frm-wishlist" method="post" action="{{ url('wishlist/save') }}">
										{{csrf_field()}}
										<input type="hidden" name="product_id" id="detail_id" value="{{$product->id}}">
									</form>
							</span>
						</div>
					</div>
				</div>
			</div>

			<div class="related-product">
				<div class="title"> Produk Terkait </div>
				<div class="row">
					@foreach($releated_products as $releated_product)
					<div class="col-md-2 col-sm-2 col-xs-6">
						<div class="product-box">
							<a href="{{ url('/product-detail/'.$releated_product->slug) }}">
								<div class="product-img"> <img src="{{ asset(explode("::",$releated_product->image_path)[0]) }}" class="img-responsive"/> </div>
								<div class="h50">
									<div class="product-name text-center"> {{ $releated_product->product_name }} </div>
									<div class="product-price text-center"> <span class="product-price-code">RP</span> {{ number_format(($releated_product->sale != 0 ? $releated_product->product_price - ($releated_product->product_price * $releated_product->sale / 100) : $releated_product->product_price)) }} </div>
								</div>
							</a>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>

@stop
@section('script')
  <script>
  $(function(){
    $('#select-color').on("change",function(){
      var stock = $('option:selected', this).attr('data-stock');

      var text = $('option:selected', this).html();

			if(stock == 0) {
				$('#div-empty-color').show();
				$('#div-input-quantity').hide();
				$('#text-empty-color').html(text);
				$('#btn-addtocart').attr("disabled",true);
			}else{
				$('#div-empty-color').hide();
				$('#div-input-quantity').show();
				$('#btn-addtocart').attr("disabled",false);
			}
      $(this).siblings(".replacement").html(text);
      $(".input-quantity").val(0);
      $(".input-quantity").prop('max',stock);
    });
  });

	function submitform(id)
	{
		$('#frm-wishlist').submit();
	}

	function addtocart()
	{
		var id = $('#select-color').val();
		var qty = $('.input-quantity').val();
		$('#product_detail_id').val(id);
		$('#qty').val(qty);
		$('#frm-addtocart').submit();
	}
  </script>
@stop
