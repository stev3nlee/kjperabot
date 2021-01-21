@extends('layout4')

@section('content')

	<div class="home-new-product member">
		<div class="container">
			<div class="title"> Profile Saya </div>

			@include ('member/menu')

			<div class="order-detail-box">
				<div class="title">Lihat Order #{{ $order[0]->order_no }}</div>
				<div class="order-header"> SUMMARY </div>
				<div class="order-detail">
					<div class="row">
						<div class="col-sm-3 col-md-3 col-xs-12">
							<div class="order-detail-header"> Tanggal </div>
							<div class="order-detail-desc">{{ date("d M Y, H:i",strtotime($order[0]->created_at)) }}</div>
						</div>
						<div class="col-sm-3 col-md-3 col-xs-12">
							<div class="order-detail-header"> Harga </div>
							@if($order[0]->free_shipping > $order[0]->jne_shipping_value and $order[0]->free_shipping > 0)
								<div class="order-detail-desc"> Rp. {{ number_format(array_sum(array_pluck($order,"total"))+(array_sum(array_pluck($order,"total")) * $order[0]->tax_vat /100)) }}</div>
							@else
								<div class="order-detail-desc"> Rp. {{ number_format(array_sum(array_pluck($order,"total")) + $order[0]->jne_shipping_value - $order[0]->free_shipping + (array_sum(array_pluck($order,"total")) * $order[0]->tax_vat /100)) }}</div>
							@endif
						</div>
						<div class="col-sm-3 col-md-3 col-xs-12">
							<div class="order-detail-header"> Status Pembayaran </div>
							<div class="order-detail-desc"> {{$order_string[$order[0]->order_status]}} </div>
						</div>
						<div class="col-sm-3 col-md-3 col-xs-12">
							<div class="order-detail-header"> Status Pengiriman </div>
							<div class="order-detail-desc"> {{$order_string[$order[0]->order_status]}} </div>
							<div class="order-detail-desc"> {{ $order[0]->jne_track }} </div>
						</div>
					</div>
				</div>
			</div>

			<div class="checkout">
				<div class="row">
					<div class="col-md-7 col-sm-7 col-xs-12">
						<div class="title"> Rincian </div>
						<div class="checkout-header mt30">Nomor Pesanan</div>
						<div class="checkout-desc">#{{ $order[0]->order_no }}</div>
						<div class="row mt30 checkout-pay">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="checkout-header">Alamat Pengiriman</div>
								<div class="checkout-desc">{{ $order2->shipping_email }}</div>
								<div class="checkout-desc">{{ $order2->shipping_phone }}</div>
								<div class="checkout-desc">{{ ucwords($order2->shipping_address) }}</div>
								<div class="checkout-desc">{{ ucwords($order2->shipping_province->province_name) }}</div>
								<div class="checkout-desc">{{ ucwords($order2->shipping_jne_city_label) }}</div>
								<div class="checkout-desc">Indonesia</div>
								<div class="checkout-desc">{{ $order2->shipping_post_code }}</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="checkout-header">Alamat Billing</div>
								<div class="checkout-desc">{{ $order2->billing_email }}</div>
								<div class="checkout-desc">{{ $order2->billing_phone }}</div>
								<div class="checkout-desc">{{ ucwords($order2->billing_address) }}</div>
								<div class="checkout-desc">{{ ucwords($order2->billing_province->province_name) }}</div>
								<div class="checkout-desc">{{ ucwords($order2->billing_jne_city_label) }}</div>
								<div class="checkout-desc">Indonesia</div>
								<div class="checkout-desc">{{ $order2->billing_post_code }}</div>
							</div>
						</div>
						<div class="row mt30 checkout-pay">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="checkout-header">Metode Pembayaran</div>
								<div class="checkout-desc">Transfer Bank</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="checkout-header">Metode Pengiriman</div>
								<div class="checkout-desc">{{ $order[0]->jne_shipping_method }} ( {{ $order[0]->total_weight }} KG )</div>
							</div>
						</div>
						<div class="checkout-header mt30">Catatan</div>
						<div class="checkout-desc">{{ucwords($order[0]->order_note)}}</div>
					</div>

					<div class="col-md-5 col-sm-5 col-xs-12">
						<div class="title summary"> Ringkasan </div>
						<div id="order-item" class="data-table detail-order">
              @php $price = 0; @endphp
              @php $subtotal=0; @endphp
							@foreach($details as $detail)
								@if($detail->sale)
									@php $price = $detail->price - ($detail->price * $detail->sale / 100); @endphp
								@else
									@php $price = $detail->price - $detail->discount_amount; @endphp
								@endif
							<div class="list items hidden-xs">
								<div class="w100">
									<img src="{{ asset(explode("::",$detail->image_path)[0]) }}" class="img-responsive" />
								</div>
								<div class="in">
									<div>
										<div class="cart-header">{{ $detail->product_name }}</div>
										<div class="cart-color">Warna : {{ ucwords($detail->color) }}</div>
										<div class="cart-color">Berat : {{ $detail->weight * $detail->quantity }}</div>
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
								@php $tax = ($order[0]->tax_vat * $subtotal /100); @endphp

								@if($order[0]->free_shipping > $order[0]->jne_shipping_value and $order[0]->free_shipping > 0)
	              	@php $grandtotal = $subtotal + $tax; @endphp
								@else
									@php $grandtotal = $subtotal + $tax + $order[0]->jne_shipping_value - $order[0]->free_shipping; @endphp
								@endif
								<div> Rp. {{ number_format($subtotal) }} </div>
								@if($company->tax_vat > 0)
								<div> Rp. {{ number_format($tax) }} </div>
								@endif
								@if($order[0]->free_shipping > $order[0]->jne_shipping_value and $order[0]->free_shipping > 0)
								<div> Rp. {{ number_format(0) }} </div>
								@else
								<div> Rp. {{ number_format($order[0]->jne_shipping_value - $order[0]->free_shipping) }} </div>
								@endif
								<!--<div> Rp. 100.000 </div>-->
								<div class="total-cart"> Rp. {{number_format($grandtotal)}} </div>
							</div>
						</div>
						<div class="mt50 visible-xs">
							<span class=""> <a href="{{ url('/order') }}" class="btn btn-checkout"> KEMBALI </a>
						</div>
					</div>
				</div>
				<div class="mt90 hidden-xs">
					<span class="to-home"> <a href="{{ url('/order') }}" class="btn btn-checkout"> KEMBALI </a>
				</div>
			</div>

		</div>
	</div>

@stop

@section('script')
<script>
$(function() {
	$('#order').addClass ('active');
});
</script>
@stop
