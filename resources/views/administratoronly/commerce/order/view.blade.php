@extends('administratoronly.layout')
@section('content')
	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Commerce</a><span class="m10"> > </span><a href="{{ url('/administratoronly/commerce/order') }}">Order</a><span class="m10"> > </span><span class="active">View Order Detail</span>
				</div>
				<div class="title">View Order Detail <span style="margin-left: 20px;">#{{ $order->order_no }}</span></div>
				<div class="content">
					<div id="tabs-container">
						<div class="clearfix">
							<div class="pull-left mr30" style="width: 170px;">
								<ul class="tabs-menu">
									<li class="current"><a href="#tab-1">Member</a></li>
									<li><a href="#tab-2">Billing</a></li>
									<li><a href="#tab-3">Shipping</a></li>
									@foreach($order->payments as $payment)
									<li><a href="#tab-{{6+$loop->index}}">Bank Transfer {{ $loop->index+1 }}</a></li>
									@endforeach
									<li><a href="#tab-4">Product</a></li>
									<li><a href="#tab-5">History</a></li>
								</ul>
								<div class="mb20">
									<a href="{{ url('/administratoronly/commerce/order/invoice/'.$order->id) }}" target="_blank"><button type="button" class="btn btn-pop" style="width: 125px; margin-top: 0;">INVOICE</button></a>
								</div>
								<div>
									<a href="{{ url('/administratoronly/commerce/order') }}"><button type="button" class="btn btn-pop" style="width: 125px; margin-top: 0;">Back</button></a>
								</div>
							</div>
							<div class="pull-left">
								<div class="tab">
									<div id="tab-1" class="tab-content">
										<div class="t-code">Member</div>
										<div>
											<div class="t-order">Full Name</div>
											<div class="w-order">{{ $order->billing_first_name }} {{ $order->billing_last_name }}</div>
										</div>
										<div class="border-title"></div>
										<div>
											<div class="t-order">Email</div>
											<div class="w-order">{{ $order->billing_email }}</div>
										</div>
									</div>
									<div id="tab-2" class="tab-content">
										<div class="t-code">Billing</div>
										<div class="full-product">
											<div class="row clearfix">
												<div class="wdth50">
													<p class="htitle">Full Name</p>
													<p>{{ $order->billing_first_name }} {{ $order->billing_last_name }}</p>
												</div>
												<div class="wdth50">
													<p class="htitle"></p>
													<p></p>
												</div>
											</div>
											<div class="border-title"></div>
											<div>
												<div class="t-order">Email Address</div>
												<div class="w-order">{{ $order->billing_email }}</div>
											</div>
											<div class="border-title"></div>
											<div>
												<div class="t-order">Address</div>
												<div class="w-order">{{ $order->billing_address }}</div>
											</div>
											<div class="border-title"></div>
											<div class="row clearfix">
												<div class="wdth50">
													<p class="htitle">Country</p>
													<p>Indonesia</p>
												</div>
												<div class="wdth50">
													<p class="htitle">Province</p>
												</div>
												<p>{{ $order->billing_province->province_name }}</p>
											</div>
											<div class="border-title"></div>
											<div class="row clearfix">
												<div class="wdth50">
													<p class="htitle">City</p>
													<p>{{ $order->billing_jne_city_label }}</p>
												</div>
												<div class="wdth50">
													<p class="htitle">Zip Code</p>
													<p>{{ $order->billing_post_code }}</p>
												</div>
											</div>
											<div class="border-title"></div>
											<div class="row clearfix">
												<div class="wdth50">
													<p class="htitle">Telephone Number</p>
													<p>{{ $order->billing_phone }}</p>
												</div>
												<div class="wdth50">
													<p class="htitle"></p>
													<p></p>
												</div>
											</div>
										</div>
									</div>
									<div id="tab-3" class="tab-content">
										<div class="t-code">Shipping</div>
										<div class="full-product">
											<div class="row clearfix">
												<div class="wdth50">
													<p class="htitle">Full Name</p>
													<p>{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</p>
												</div>
												<div class="wdth50">
													<p class="htitle"></p>
													<p></p>
												</div>
											</div>
											<div class="border-title"></div>
											<div>
												<div class="t-order">Email Address</div>
												<div class="w-order">{{ $order->shipping_email }}</div>
											</div>
											<div class="border-title"></div>
											<div>
												<div class="t-order">Address</div>
												<div class="w-order">{{ $order->shipping_address }}</div>
											</div>
											<div class="border-title"></div>
											<div class="row clearfix">
												<div class="wdth50">
													<p class="htitle">Country</p>
													<p>Indonesia</p>
												</div>
												<div class="wdth50">
													<p class="htitle">Province</p>
													<p>{{ $order->shipping_province->province_name }}</p>
												</div>
											</div>
											<div class="border-title"></div>
											<div class="row clearfix">
												<div class="wdth50">
													<p class="htitle">City</p>
													<p>{{ $order->shipping_jne_city_label }}</p>
												</div>
												<div class="wdth50">
													<p class="htitle">Zip Code</p>
													<p>{{ $order->shipping_post_code }}</p>
												</div>
											</div>
											<div class="border-title"></div>
											<div class="row clearfix">
												<div class="wdth50">
													<p class="htitle">Telephone Number</p>
													<p>{{ $order->shipping_phone }}</p>
												</div>
												<div class="wdth50">
													<p class="htitle"></p>
													<p></p>
												</div>
											</div>
										</div>
									</div>
									<div id="tab-4" class="tab-content">
										<div class="full-product">
											<div class="t-code">Product</div>
											<div class="mb30">
												<p class="htitle">Order Note</p>
												<p>{{ $order->order_note }}</p>
											</div>
											<div class="adminTable">
												<table id="table_id" style="width: 100% !important;">
													<thead>
														<tr>
															<td>Item</td>
															<td width="200" class="text-center">Price</td>
															<td width="200" class="text-center">Quantity</td>
															<td width="200" class="text-right">Total</td>
														</tr>
													</thead>
													<tbody>
														@php $subtotal=0; @endphp
														@foreach($order->order_details as $detail)
														@if($detail->sale)
															@php $price = $detail->price - ($detail->price * $detail->sale / 100); @endphp
														@else
															@php $price = $detail->price - $detail->discount_amount; @endphp
														@endif
														<tr>
															<td>
																<div class="clearfix">
																	<div class="pull-left mr20">
																		<div class="table-imgproduct">
																			<img src="{{ asset(explode("::",$detail->product_detail->product->image_path)[0]) }}" class="img-responsive">
																		</div>
																	</div>
																	<div class="pull-left">
																		<div class="detail-product"></div>
																		<div class="s-title">
																			<div>{{ $detail->product_detail->product->product_name }}</div>
																			<div>Color : {{ $detail->product_detail->color }}</div>
																			<div>Weight : {{ $detail->product_detail->product->weight * $detail->quantity }}</div>
																		</div>
																	</div>
																</div>
															</td>
															<td class="text-center">Rp. {{ number_format($price) }}</td>
															<td class="text-center">{{ $detail->quantity }}</td>
															<td class="text-right">Rp. {{ number_format($detail->quantity * $price) }}</td>
														</tr>
														@php $subtotal += $price * $detail->quantity; @endphp
														@endforeach
													</tbody>
													<tfoot>
														<tr>
															{{--<td rowspan="1" colspan="2">
																<div class="clearfix">
																	<div style="float: left; margin-right: 10px; position: relative; top: 3px;">PROMO CODE</div>
																	<div style="width: 150px; float:left;">
																		<input type="text" class="form-control" name="promo" disabled value=""/>
																	</div>
																</div>
															</td>--}}
															@php $tax = $subtotal * $order->tax_vat /100; @endphp
															<td rowspan="1" colspan="2">
																<div class="text-right">
																	<p> SUBTOTAL : RP. {{ number_format($subtotal) }} </p>
																	<p> SHIPPING FEE : RP. {{ number_format($order->jne_shipping_value) }} </p>

																	@if($order->free_shipping > 0)
																		@if($order->free_shipping >= $order->jne_shipping_value)
																		<p> FREE SHIPPING : RP. (-) {{ number_format($order->jne_shipping_value) }}</p>
																		@else
																		<p> FREE SHIPPING : RP. (-) {{ number_format( $order->free_shipping) }}</p>
																		@endif
																	@else
																		<p> FREE SHIPPING : RP. 0</p>
																	@endif

																	@if($order->tax_vat > 0)
																	<p> TAXES : RP. {{ number_format($tax) }} </p>
																	@endif
																	@if($order->free_shipping > $order->jne_shipping_value)
																		<p> ORDER TOTAL : RP. {{ number_format($subtotal + $tax) }} </p>
																	@else
																	<p> ORDER TOTAL : RP. {{ number_format($subtotal + $order->jne_shipping_value - $order->free_shipping + $tax) }} </p>
																	@endif
																</div>
															</td>
														</tr>
													</tfoot>
												</table>
											</div>
										</div>
									</div>
									<div id="tab-5" class="tab-content">
										<div class="t-code">History</div>
										<div class="adminTable">
											<table id="table_id2" style="width: 100% !important;">
												<thead>
													<tr>
														<td>Date</td>
														<td>Status</td>
													</tr>
												</thead>
												<tbody>
													@foreach($order->order_histories as $history)
														<tr>
															<td>{{ date("d F Y, H:i",strtotime($history->created_at)) }} </td>
															<td>{{ $history->action }}</td>
														</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
									@foreach($order->payments as $payment)
									<div id="tab-{{ 6+$loop->index }}" class="tab-content">
										<div class="t-code">Bank Transfer {{ $loop->index+1 }}</div>
										<div>
											<div class="t-order">Payment Method</div>
											<div class="w-order">Bank Transfer</div>
										</div>
										<div class="border-title"></div>
										<div>
											<div class="t-order">Account No</div>
											<div class="w-order">{{ $payment->bank_account_no }}</div>
										</div>
										<div class="border-title"></div>
										<div>
											<div class="t-order">Account Name</div>
											<div class="w-order">{{ $payment->bank_account_name }}</div>
										</div>
										<div class="border-title"></div>
										<div>
											<div class="t-order">Image</div>
											<div class="w-order">
												<a href="{{ asset($payment->image_path) }}">
													<img src="{{ asset($payment->image_path) }}" class="img-responsive" style="width: 150px;">
												</a>
											</div>
										</div>
										<div class="border-title"></div>
										<div class="mb20">
											<div class="t-order">Total</div>
											<div class="w-order">RP {{ number_format($payment->nominal) }}</div>
										</div>
									</div>
									@endforeach
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
	$('#order').addClass ('active');
});
</script>
@stop
