@extends('layout')

@section('content')

	<div class="home-new-product content">
		<div class="container">
			<div class="checkout">
				<div class="text-center">
					<div class="title-checkout"> Terima kasih </div>
					<div class="sub-title-success"> Anda telah berhasil pesan produk.</div>
				</div>
				<div class="row">
					<div class="col-md-7 col-sm-7 col-xs-12">
						<div class="title"> Rincian </div>
						<div class="checkout-header mt30">Nomor Pesanan</div>
						<div class="checkout-desc">#{{ $order->order_no }}</div>
						<div class="row mt30 checkout-pay">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="checkout-header">Alamat Pengiriman</div>
								<div class="checkout-desc">{{ $order->shipping_email }}</div>
								<div class="checkout-desc">{{ $order->shipping_phone }}</div>
								<div class="checkout-desc">{{ $order->shipping_address }}</div>
								<div class="checkout-desc">{{ $order->shipping_province->province_name }}</div>
								<div class="checkout-desc">{{ $order->shipping_jne_city_label }}</div>
								<div class="checkout-desc">Indonesia</div>
								<div class="checkout-desc">{{ $order->shipping_post_code }}</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="checkout-header">Alamat Billing</div>
								<div class="checkout-desc">{{ $order->billing_email }}</div>
								<div class="checkout-desc">{{ $order->billing_phone }}</div>
								<div class="checkout-desc">{{ $order->billing_address }}</div>
								<div class="checkout-desc">{{ $order->billing_province->province_name }}</div>
								<div class="checkout-desc">{{ $order->billing_jne_city_label }}</div>
								<div class="checkout-desc">Indonesia</div>
								<div class="checkout-desc">{{ $order->billing_post_code }}</div>
							</div>
						</div>
						<div class="row mt30 checkout-pay">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="checkout-header">Metode Pembayaran</div>
								<div class="checkout-desc">Transfer Bank</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="checkout-header">Metode Pengiriman</div>
								<div class="checkout-desc">{{ $order->jne_shipping_method }} ({{ $order->total_weight }} KG)</div>
							</div>
						</div>
						<div class="checkout-header mt30">Catatan</div>
						<div class="checkout-desc">{{$order->order_note}}</div>
					</div>

					<div class="col-md-5 col-sm-5 col-xs-12">
						<div class="title summary"> Ringkasan </div>
						<div id="order-item" class="data-table detail-order">
							@php $price = 0; @endphp
              @php $subtotal=0; @endphp

							@foreach($details as $detail)
								  @php $price = $detail->price - ($detail->price * $detail->sale / 100); @endphp
							<div class="list items hidden-xs">
								<div class="w100">
									<img src="{{ asset(explode("::",$detail->image_path)[0]) }}" class="img-responsive" />
								</div>
								<div class="in">
									<div>
										<div class="cart-header">{{ $detail->product_name }}</div>
										<div class="cart-color">Warna : {{ $detail->color }}</div>
										<div class="cart-color">Berat : {{ $detail->weight * $detail->quantity}} KG</div>
									</div>
									<div class="summary-cart">
										<div class="cart-price">Quantity: {{ $detail->quantity }}</div>
										<div class="cart-price">Rp. {{ number_format($detail->quantity * $price) }}</div>
									</div>
								</div>
							</div>
							@php $subtotal += $detail->quantity * $price; @endphp
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
							<div class="col-sm-6 col-md-6 col-xs-6">
								@php $tax = ($order->tax_vat * $subtotal /100); @endphp

								@if($order->free_shipping > $order->jne_shipping_value and $order->free_shipping>0)
									@php $grandtotal = $subtotal + $tax + 0; @endphp
								@else
	              	@php $grandtotal = $subtotal + $tax + $order->jne_shipping_value - $order->free_shipping; @endphp
								@endif

								<div> Rp. {{ number_format($subtotal) }} </div>
								@if($company->tax_vat > 0)
								<div> Rp. {{ number_format($tax) }} </div>
								@endif

								@if($order->free_shipping > $order->jne_shipping_value and $order->free_shipping>0)
								<div> Rp. 0 </div>
								@else
								<div> Rp. {{ number_format($order->jne_shipping_value - $order->free_shipping) }} </div>
								@endif
								<div class="total-cart"> Rp. {{number_format($grandtotal)}} </div>

							</div>
						</div>
						<div class="mt50 visible-xs">
							<span class=""> <a href="{{ url('/') }}" class="btn btn-checkout"> KE HALAMAN BERANDA </a>
						</div>
					</div>
				</div>
				<div class="mt90 hidden-xs text-center">
					<span class="to-home"> <a href="{{ url('/') }}" class="btn btn-checkout"> KE HALAMAN BERANDA </a>
				</div>
			</div>
		</div>
	</div>
	<a style="display:none" id="btn-email-order" href="{{url('/mail/order/'.$order->order_no)}}" target="_blank">Click</a>
	<a style="display:none" id="btn-emailadmin-order" href="{{url('/mail/adminorder/'.$order->order_no)}}" target="_blank">Click</a>
@stop
@section('script')
	<script>
	@if($_SERVER['REMOTE_ADDR'] == "::1")
	$(document).ready(function(){
		window.open('{{url('/mail/order/'.$order->order_no)}}','_blank');
		window.open('{{url('/mail/adminorder/'.$order->order_no)}}','_blank');
	});
	@endif
	</script>
@stop
