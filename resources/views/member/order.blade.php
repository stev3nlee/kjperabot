@extends('layout4')

@section('content')

	<div class="home-new-product member">
		<div class="container">
			<div class="title"> Profile Saya </div>
			@include ('member/menu')
			<table id="table-order" class="wishlist table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>No Pesanan</th>
						<th width="200">Harga</th>
						<th width="200">Ongkos Kirim</th>
						<th width="200">Status</th>
						<th width=""></th>
						<th width="150"></th>
					</tr>
				</thead>
				<tbody>
          @foreach($orders as $order)
						@php $price = 0 ; @endphp
						@foreach($order->order_details as $detail)
							@if($detail->sale)
								@php $price += $detail->price - ($detail->price * $detail->sale / 100) * $detail->quantity; @endphp
							@else
								@php $price += ($detail->price - $detail->discount_amount) * $detail->quantity; @endphp
							@endif
						@endforeach
					<tr>
						<td>
							<div class="wish-header">Order #{{$order->order_no}}</div>
							<div class="wish-desc">{{ date("M d, Y",strtotime($order->created_at)) }}</div>
						</td>
						<td>
							<div class="wish-header">Harga Item</div>
							<div class="wish-desc">Rp {{number_format($price+($price * $order->tax_vat /100))}}</div>
						</td>
						<td>
							<div class="wish-header">Berat : {{ $order->total_weight }} KG</div>
							@if($order->free_shipping > $order->jne_shipping_value and $order->free_shipping > 0)
								0
							@else
								<div class="wish-desc">Rp {{number_format($order->jne_shipping_value-$order->free_shipping)}}</div>
							@endif
						</td>
						<td>
							<div class="wish-header">Status Pembayaran</div>
							<div class="wish-header {{$order_color[$order->order_status]}}">{{$order_string[$order->order_status]}}</div>
						</td>
						<td>
							<div class="wish-header">Status Pengiriman</div>
							@if($order->jne_track == null)
								<div class="wish-header yellow">Pending</div>
							@else
								<div class="wish-header green">Sukses</div>
							@endif
						</td>
						<td>
							<a href="{{ url('/order-detail/'.$order->order_no) }}" class="btn btn-wish"> LIHAT PRODUK </a>
						</td>
					</tr>
        @endforeach
				</tbody>
			</table>
		</div>
	</div>
@stop
@section('script')
<script>
$(function() {
	$('#order').addClass ('active');
});
$('#table-order').dataTable( {
	"order": []
} );
</script>
@stop
