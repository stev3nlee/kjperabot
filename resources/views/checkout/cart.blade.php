@extends('layout')

@section('content')

	<div class="home-new-product content">
		<div class="container">
			<div class="title"> Keranjang Belanja </div>
			@include('errorfile')
			<div id="order-item" class="data-table detail-order">
        @php $subtotal = 0; @endphp
        @foreach($carts as $cart)
					<form method="post" action="{{ url('/checkout/shipping') }}">
						{{ csrf_field() }}
					<div class="list items hidden-xs">
						<div class="w100">
							<input type="hidden" name="id[]" value="{{$cart->cart_id}}"/>
							<img src="{{ asset(explode("::",$cart->image_path)[0]) }}" class="img-responsive" />
						</div>
						<div class="in product_carts">
							<div>
								<div class="cart-header">{{ $cart->product_name }}</div>
								<div class="cart-color">Warna : {{ $cart->color }}</div>
							</div>
								<div class="w200 text-center">
									<div class="cart-header">Quantity</div>
									<div class="cart-input">
										<input id="txtboxToFilter" type="number" min="0" max="{{ $cart->total_stock }}" name="qty[]" value="{{ $cart->qty }}" class="form-control form-cart qty qty{{$cart->cart_id}}" data-id="{{$cart->cart_id}}">
									</div>
								</div>
								<div class="w250 text-center">
									<div class="cart-header">Harga</div>
									@php $price = ($cart->sale_price == 0 ? $cart->product_price : $cart->sale_price) @endphp
									<div class="cart-price">Rp. <span class="product_price">{{number_format($price)}}</span></div>
								</div>
	            @if($cart->total_stock > 0)
	              <div class="w250">
							    <span> <a href="{{ url('/product-detail/'.$cart->slug.'/'.$cart->cart_id) }}" class="btn btn-edit-cart"> EDIT </a> </span>
									<a onclick="delete_item({{$cart->cart_id}})" class="btn btn-remove-cart"> REMOVE </a>
	              </div>
	            @else
	              <div class="w250 hidden-xs">
	  							<span class="outstock">Stok Habis</span>
									<a onclick="delete_item({{$cart->cart_id}})" class="btn btn-remove-cart"> REMOVE </a>
	  						</div>
	            @endif
						</div>
					</div>
        @php $subtotal += $cart->qty * $price; @endphp
        @endforeach
				<div class="list total-cart hidden-xs">
					<div class="w100"></div>
					<div class="in">
						<div></div>
						<div class="w200 text-center hidden-xs">
							<div class="cart-header-total">Subtotal</div>
						</div>
						<div class="w250 text-center hidden-xs">
							<div class="cart-header-total">Rp. <span class="subtotal">{{number_format($subtotal)}}</span></div>
						</div>
						<div class="w250 text-left hidden-xs">
							@if(Auth::check())
								<div class="text-center"> <input type="submit" class="btn btn-edit-cart" value="CHECKOUT" /> </div>
							@else
								<a href="{{ url('/checkout') }}" class="btn btn-edit-cart"> CHECKOUT </a> </span>
							@endif
						</div>
					</div>
				</div>
				</form>

				<div class="hidden-sm hidden-md hidden-lg">
					<form method="post" action="{{ url('/checkout/shipping') }}">
						{{ csrf_field() }}
	          @foreach($carts as $cart)
						<div class="list items">
							<div class="w20">
								<input type="hidden" name="id[]" value="{{ $cart->cart_id }}"/>
								<img src="{{ asset(explode("::",$cart->image_path)[0]) }}" class="img-responsive" />
							</div>
							<div class="w30">
								<div class="cart-header">{{$cart->product_name}}</div>
								<div class="cart-color">Warna {{ $cart->color }}</div>
								<div class="cart-input"><!--<input type="number" min="0" value="{{ $cart->qty }}" name="qty[]" class="form-control form-cart qty qty{{$cart->cart_id}}" data-id="{{$cart->cart_id}}">--><input id="txtboxToFilter" type="number" min="0" max="{{ $cart->total_stock }}" name="qty[]" value="{{ $cart->qty }}" class="form-control form-cart qty qty{{$cart->cart_id}}" data-id="{{$cart->cart_id}}"></div>
								<div class="cart-price">Rp. <span class="product_price">{{number_format($cart->sale == 0 ? $cart->product_price : $cart->sale_price)}}</span></div>
								<span> <a href="{{ url('/product-detail/'.$cart->slug.'/'.$cart->cart_id) }}" class="btn btn-edit-cart"> EDIT </a> </span>
								<span> <a onclick="delete_item({{$cart->cart_id}})" class="btn btn-remove-cart"> REMOVE </a> </span>
							</div>
							@if($cart->total_stock == 0)
	              <div class="w20 text-right">
	  							<span class="btn btn-edit-cart outstock"> Stok Habis </span>
									<span onclick="delete_item({{$cart->cart_id}})" class="btn btn-remove-cart fancybox"> REMOVE </span>
	  						</div>
	            @endif
						</div>
	          @endforeach
						<div class="list items" style="border-bottom:0;">
							<div class="w30 cart-header-total">SUBTOTAL</div>
							<div class="w20 cart-header-total text-right">Rp. <span class="subtotal">{{number_format($subtotal)}}</span></div>
						</div>
						@if(Auth::check())
							<div class="text-center"> <input type="submit" class="btn btn-edit-cart-mobile" value="LANJUT" /> </div>
						@else
							<div class="text-center"> <a href="{{ url('/checkout') }}" class="btn btn-edit-cart-mobile"> LANJUT </a> </div>
						@endif
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Delete -->
	<div id="delete" class="width-pop">
		<div class="pad-pop">
			<div class="img-pop">
				<img src="{{url('assets/images/icons/delete.svg')}}" class="img-responsive"/>
			</div>
			<div class="text-pop mb30">Are you sure want to delete this item ?</div>
			<div class="clearfix text-center">
				<div class="inline-block mr25">
					<form method="post" id="frm-cart" action="{{url('cart/delete')}}">
						{{ csrf_field() }}
						<input type="hidden" name="cart_id" id="delete_cart_id" value="">
					</form>
					<a id="deteleHref" href="{{ url('product/deletecart') }}"><button type="button" class="btn btn-blue">Delete</button></a>
				</div>
				<div class="inline-block">
					<button type="button" class="btn btn-red close-fancy">No</button>
				</div>
			</div>
		</div>
	</div>

@stop
@section('script')
	<script>
		$('.qty').change(function(){
			var id = $(this).attr("data-id");
			var val = $(this).val();
			$('.qty'+id).val(val);
			//$('.qty').val(val);
			calculate();
		});

		function calculate()
		{
			var subtotal = 0;
			$('.product_carts').each(function(){
				var val = parseInt($(this).find('.qty').val()) * parseInt($(this).find('.product_price').html().replace(",",""));
				subtotal += val;
			});
			$('.subtotal').html(subtotal);
			$('.subtotal').number(true);
		}

		function delete_item(id)
		{
			$('#delete_cart_id').val(id);
			$('#frm-cart').submit();
		}
	</script>
@stop
