@extends('administratoronly.layout')
@section('content')
<script>
$(function() {
	$('#member').addClass ('active');
});
</script>
	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Commerce</a><span class="m10"> > </span><a href="{{url('/administratoronly/commerce/member')}}"/>Member</a><span class="m10"> > </span><a class="active">View Member</a>
				</div>
				<div class="title">View Member: <span style="margin-left: 10px;">{{ ucwords($member->first_name) }} {{ ucwords($member->last_name) }}</span></div>
				<div class="content">
					<div id="tabs-container">
						<div class="clearfix">
							<div class="pull-left mr30" style="width: 170px;">
								<ul class="tabs-menu">
									<li class="current"><a href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/yogurtrack/admin/commerce/member/view.php#tab-3">Order</a></li>
								</ul>
								<div>
									<a href="{{ url('/administratoronly/commerce/member/view/'.$order->user_id)}}"><button type="button" class="btn btn-pop" style="width: 125px; margin-top: 0;">Back</button></a>
								</div>
							</div>
							<div class="pull-left">
								<div class="tab">
									<div id="tab-1" class="tab-content">
										<div class="full-product">
											<div class="t-code">Order #{{$order->order_no}}</div>
											<div class="row clearfix">
												<div class="wdth50">
													<p class="htitle">Shipping</p>
													<p class="pending">@if($order->order_status < 3) Pending @else Telah dikirim @endif</p>
												</div>
												<div class="wdth50">
													<p class="htitle">Payment</p>
													<p class="pending">{{ $order_string[$order->order_status] }}</p>
												</div>
											</div>
											<div class="border-title"></div>
											<div class="row clearfix">
												<div class="wdth50">
													<p class="htitle">Billing Info</p>
													<p>{{ ucwords($order->billing_first_name) }} {{ ucwords($order->billing_last_name) }}</p>
													<p>{{ $order->billing_email }}</p>
													<p>{{ $order->billing_phone }}</p>
													<p>{{ $order->billing_address }}</p>
													<p>{{ $order->billing_province->province_name }}</p>
													<p>{{ $order->billing_city->city_name }}, {{ $order->billing_district->district_name }}</p>
													<p>Indonesia</p>
													<p>{{ $order->billing_post_code }}</p>
												</div>
												<div class="wdth50">
													<p class="htitle">Shipping Info</p>
													<p>{{ ucwords($order->shipping_first_name) }} {{ ucwords($order->shipping_last_name) }}</p>
													<p>{{ $order->shipping_email }}</p>
													<p>{{ $order->shipping_phone }}</p>
													<p>{{ $order->shipping_address }}</p>
													<p>{{ $order->shipping_province->province_name }}</p>
													<p>{{ $order->shipping_city->city_name }}, {{ $order->shipping_district->district_name }}</p>
													<p>Indonesia</p>
													<p>{{ $order->shipping_post_code }}</p>
												</div>
											</div>
											<div class="border-title"></div>
											<div class="row clearfix">
												<div class="wdth50">
													<p class="htitle">Payment</p>
													<p>Bank Transfer</p>
												</div>
												<div class="wdth50">
													<p class="htitle">Delivery</p>
													<p>@if($order->jne_shipping_method == 1) Reg @else  OKE ("Ongkos Kirim Ekonomis") @endif</p>
												</div>
											</div>
											<div class="border-title"></div>
												<p class="htitle">Note</p>
												<p>{{ $order->order_note }}</p>
											</div>
											<div class="mb50"></div>
											<div class="table-role">
												<table style="width: 100% !important; line-height: 25px;">
													<thead>
														<tr class="no-sort">
															<td>Item</td>
															<td width="150" class="text-center">Price</td>
															<td width="80" class="text-center">Qty</td>
															<td width="200" class="text-right">Total</td>
														</tr>
													</thead>
													<tbody>
														@php $subtotal=0; @endphp
														@foreach($order_details as $detail)
															@php $price = $detail->price - ($detail->sale * $detail->price / 100) @endphp
														<tr>
															<td>
																<div class="clearfix">
																	<div class="pull-left mr20">
																		<div>
																			<img src="{{ asset($detail->product_detail->product->image_path) }}" class="img-responsive" style="width: 80px;">
																		</div>
																	</div>
																	<div class="pull-left">
																		<div class="detail-product">{{ $detail->product_name }}</div>
																		<div class="s-title">
																			<div>Color : {{ $detail->color }}</div>
																		</div>
																	</div>
																</div>
															</td>
															<td class="text-center">Rp {{ number_format($price) }}</td>
															<td class="text-center">{{ $detail->quantity }}</td>
															<td class="text-right">Rp. {{number_format($price * $detail->quantity) }}</td>
														</tr>
														@php $subtotal +=$price @endphp
														@endforeach
													</tbody>
													<tfoot>
														<tr>
															<td rowspan="1" colspan="2">
																<div class="clearfix">
																	<div style="float: left; margin-right: 10px; position: relative; top: 3px;">PROMO CODE</div>
																	<div style="width: 150px; float:left;">
																		<input type="text" class="form-control" name="promo" disabled value=""/>
																	</div>
																</div>
															</td>
															<td rowspan="1" colspan="2">
																<div class="text-right">
																	@php $tax=$subtotal * $order->tax_vat / 100; @endphp
																	<p> SUBTOTAL : RP. {{number_format($subtotal)}} </p>
																	<p> SHIPPING FEE : RP. {{ number_format($order->jne_shipping_value) }} </p>
																	<p> TAXES : RP. {{ number_format($tax) }} </p>
																	<p> ORDER TOTAL : RP.{{ number_format($subtotal + $order->jne_shipping_value + $tax) }} </p>
																</div>
															</td>
														</tr>
													</tfoot>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
@section('script')
<script>
$(function() {
	$('#member').addClass ('active');
});
</script>
@stop
