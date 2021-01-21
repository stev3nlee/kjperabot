@extends('layout3')

@section('content')

	<div class="home-new-product content">
		<div class="container">
			<div class="checkout">
				<div class="row">
					<div class="col-md-7 col-sm-7 col-xs-12">
						<div class="clearfix">
							<div class="pull-left">
								<div class="title"> Alamat Pengiriman </div>
							</div>
							<div class="pull-right hidden-xs">
								<a href="{{ url('/checkout/shipping') }}" class="checkout-edit"> UBAH RINCIAN </a>
							</div>
						</div>
						<div class="clearfix visible-xs">
							<a href="{{ url('/checkout/shipping') }}" class="checkout-edit">UBAH RINCIAN</a>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="checkout-header">{{ $dataOrder['shipping_first_name'] }} {{ $dataOrder['shipping_last_name'] }}</div>
								<div class="checkout-desc">{{ $dataOrder['shipping_email'] }}</div>
								<div class="checkout-desc">{{ $dataOrder['shipping_phone'] }}</div>
								<div class="checkout-desc">{{ ucwords($dataOrder['shipping_address']) }}</div>
								<div class="checkout-desc">{{ ucwords($dataOrder['shipping_province']['province_name']) }}</div>
								<div class="checkout-desc">{{ ucwords($dataOrder['shipping_jne_city_label']) }}</div>
								<div class="checkout-desc">Indonesia</div>
								<div class="checkout-desc">{{ $dataOrder['shipping_post_code'] }}</div>

							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="checkout-header">Metode Pengiriman</div>
								<div class="checkout-desc">{{ $dataOrder['shipping_type'] }} ( {{$dataOrder['total_weight']}} KG )</div>
								<div class="checkout-header mt30">Biaya Pengiriman</div>
								@php $subtotal=0; @endphp
	              @foreach($carts as $cart)
	                @php $price = ($cart->sale_price == 0 ? $cart->product_price : $cart->sale_price); @endphp
								@endforeach
								@if($subtotal > $dataOrder['free_shipping'] and $dataOrder['free_shipping']>0)
									<div class="checkout-desc">Rp. {{ number_format($dataOrder['shipping_cost']) }}</div>
								@else
									<div class="checkout-desc">Rp. {{ number_format($dataOrder['shipping_cost']) }}</div>
								@endif
							</div>
						</div>
						<div class="title mt50 title-billing"> Alamat Billing </div>
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="checkout-header">{{ $dataOrder['billing_first_name'] }} {{ $dataOrder['billing_last_name'] }}</div>
								<div class="checkout-desc">{{ $dataOrder['billing_email'] }}</div>
								<div class="checkout-desc">{{ $dataOrder['billing_phone'] }}</div>
								<div class="checkout-desc">{{ ucwords($dataOrder['billing_address']) }}</div>
								<div class="checkout-desc">{{ ucwords($dataOrder['billing_province']['province_name']) }}</div>
								<div class="checkout-desc">{{ ucwords($dataOrder['billing_jne_city_label']) }} </div>
								<div class="checkout-desc">Indonesia</div>
								<div class="checkout-desc">{{ $dataOrder['billing_post_code'] }}</div>
							</div>
						</div>
						<?php /* ?>
						<div class="title mt50"> Tahap Pembayaran </div>
						<div class="bank-method">Transfer Bank</div>
						<div class="bank-img">
							<img src="{{ asset($bank->image_path) }}" class="responsive" />
						</div>
						<div class="trf-bank-name bold mt30">NAMA PEMILIK AKUN</div>
						<div class="trf-bank-name">{{ ucwords($bank->account_name) }}</div>
						<div class="trf-bank-no bold mt30">NOMOR AKUN BANK</div>
						<div class="trf-bank-no">{{ $bank->account_no }}</div>
						<div class="checkout-header mt30">Detil tentang metode pembayaran bank transfer</div>
						<div class="checkout-desc">{!! $page->page_description !!}</div><?php */ ?>
						<div class="mt90 hidden-xs"> 
              <form action="{{ url('checkout/review') }}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="data_order" value="{{ json_encode($dataOrder) }}"/>
							  <span class=""> <input type="submit" value="LANJUT" class="btn btn-checkout"/></span>
              </form>
						</div>
					</div>

					<div class="col-md-5 col-sm-5 col-xs-12">
						<div class="title summary"> Ringkasan </div>
						<div id="order-item" class="data-table detail-order">
              @php $price = 0; @endphp
              @php $subtotal=0; @endphp
              @foreach($carts as $cart)
                @php $price = ($cart->sale_price == 0 ? $cart->product_price : $cart->sale_price); @endphp
							<div class="list items hidden-xs">
								<div class="w100">
									<img src="{{ asset(explode("::",$cart->image_path)[0]) }}" class="img-responsive" />
								</div>
								<div class="in">
									<div>
										<div class="cart-header">Nama Produk Produk Produk Porudk Produk</div>
										<div class="cart-color">Warna : {{ $cart->color }}</div>
										<div class="cart-color">Berat : {{ $cart->weight * $cart->qty }} KG</div>
									</div>
									<div class="summary-cart">
										<div class="cart-price">Quantity: {{ $cart->qty }}</div>
										<div class="cart-price">Rp. {{ number_format($price*$cart->qty) }}</div>
									</div>
								</div>
							</div>
              @php $subtotal += $price *$cart->qty; @endphp
              @endforeach
						</div>
						<div class="row summary-cart-info">
							<div class="col-sm-6 col-md-6 col-xs-6">
								<div> Subtotal </div>
								@if($company->tax_vat > 0)
								<div> Tax </div>
								@endif
								<div> Shipping </div>
								<!--<div> Discount </div>-->
								<div class="total-cart"> TOTAL </div>
							</div>
              @php $tax = ($company->tax_vat * $subtotal /100); @endphp
							@if($dataOrder['free_shipping'] > $dataOrder['shipping_cost'] and $dataOrder['free_shipping'] > 0)
								@php $grandtotal = $subtotal + $tax; @endphp
							@else
              @php $grandtotal = $subtotal + $tax + $dataOrder['shipping_cost'] - $dataOrder['free_shipping']; @endphp
							@endif
							<div class="col-sm-6 col-md-6 col-xs-6">
								<div> Rp. {{ number_format($subtotal) }} </div>
								@if($company->tax_vat > 0)
								<div> Rp. {{ number_format($tax) }} </div>
								@endif

								@if($dataOrder['free_shipping'] > $dataOrder['shipping_cost'] and $dataOrder['free_shipping'] > 0)
									<div> Rp. 0 </div>
								@else
									<div> Rp. {{ number_format($dataOrder['shipping_cost'] - $dataOrder['free_shipping']) }} </div>
								@endif

								<div class="total-cart"> Rp. {{ number_format($grandtotal) }} </div>
							</div>
						</div>
						<div class="mt50 visible-xs">
              <form action="{{ url('checkout/review') }}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="data_order" value="{{ json_encode($dataOrder) }}"/>
							  <span class=""> <input type="submit" value="LANJUT" class="btn btn-checkout"/> </span>
              </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop
