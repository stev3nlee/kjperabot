<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>KJ Perabot</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{url('/images/uploads/favicon.ico')}}" />
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{url('/css/bootstrap.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('/css/fonts.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('/css/style.css')}}">
</head>
<body style="padding-top: 50px;">

<style>
.table10 { float: left; width: 10%; color: white !important; font-size: 14px; background: #737373 !important; border-right: 1px solid #999999; padding: 12px 15px; }
.table20 { float: left; width: 20%; color: white !important; font-size: 12px; background: #737373 !important; border-right: 1px solid #999999; padding: 12px 15px; }
.table20.fz14 { font-size: 14px; }
.table30 { float: left; width: 30%; color: white !important; font-size: 12px; background: #737373 !important; border-right: 1px solid #999999; padding: 12px 15px; }
.table50 { float: left; width: 50%; color: white !important; font-size: 14px; background: #737373 !important; padding: 12px 15px; }
.table10.bg-white, .table20.bg-white, .table30.bg-white, .table50.bg-white { color: #2b2b2b !important; background: white !important; }
</style>
	<div style="width: 100%; background: white;">
		<div class="container">
			<img src="{{url($company->logo_path)}}" style="width: 50px; margin-bottom: 20px;"/>
			<div class="row">
				<div class="col-xs-6">
					<div style="font-size: 12px; line-height: 18px; color: #2b2b2b; ">
						<div>{!! $company->address !!}</div>
						<div>DKI Jakarta</div>
						<div>Indonesia, {{ $company->post_code }}</div>
						<div>{{ $company->whatsapp }}</div>
						<div>{{ $company->email }}</div>
						<div>kjperabot.co.id</div>
					</div>
				</div>
				<div class="col-xs-6">
					<div style="height: 108px; margin: auto 0;">
						<div class="tbl">
							<div class="cell">
								<div style="text-align: right; color: #737373 !important; font-size: 24px; letter-spacing: 1px;">INVOICE</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div style="margin: 50px 0;">
				<div style="border-bottom: 1px solid #999999;">
					<div class="clearfix" style="border-bottom: 1px solid #999999;">
						<div class="table20">ORDER DATE</div>
						<div class="table20">ORDER NO.</div>
						<div class="table30">PAYMENT METHOD</div>
						<div class="table30" style="border-right: 0;">SHIPPING METHOD</div>
					</div>
					<div class="clearfix">
						<div class="table20 bg-white" style="border-left: 1px solid #999999;">{{ date("d F Y",strtotime($order->created_at)) }}</div>
						<div class="table20 bg-white">#{{ $order->order_no }}</div>
						<?php
																		if($order->payment_method == 'bank_transfer'){
																			$payment_method = 'BCA Virtual Account';
																		}else if($order->payment_method == 'qris'){
																			$payment_method = 'Qris';
																		}else{
																			$payment_method = 'Bank Transfer';	
																		}
																	 ?>
						<div class="table30 bg-white">{{ $payment_method }} </div>
						<div class="table30 bg-white">{{ $order->jne_shipping_method }} ( {{ $order->total_weight }} KG )</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<div style="font-size: 14px; line-height: 21px; color: #2b2b2b; ">
						<div style="font-weight: bold;">BILLING ADDRESS</div>
						<div>{{ $order->billing_first_name }} {{ $order->billing_last_name }}</div>
						<div>{{ $order->billing_address }}, {{ $order->billing_province->province_name }}</div>
						<div>{{ $order->billing_jne_city_label }}</div>
						<div>Indonesia, {{ $order->billing_post_code }}</div>
						<div>Ph. {{ $order->billing_phone }}</div>
					</div>
				</div>
				<div class="col-xs-6">
					<div style="font-size: 14px; line-height: 21px; color: #2b2b2b; ">
						<div style="font-weight: bold;">SHIPPING ADDRESS</div>
						<div>{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</div>
						<div>{{ $order->shipping_address }}, {{ $order->shipping_province->province_name }}</div>
						<div>{{ $order->shipping_jne_city_label }}</div>
						<div>Indonesia, {{ $order->shipping_post_code }}</div>
						<div>Ph. {{ $order->shipping_phone }}</div>
					</div>
				</div>
			</div>
			<div style="margin: 50px 0;">
				<div>
					<div class="clearfix" style="border-bottom: 1px solid #999999;">
						<div class="table50">Item</div>
						<div class="table20 fz14" style="border-left: 1px solid #999999;">Price</div>
						<div class="table10">Qty.</div>
						<div class="table20 fz14" style="border-right: 0;">Total</div>
					</div>
					@php $subtotal=0; @endphp
					@foreach($order->order_details as $detail)
						@if($detail->sale)
							@php $price = $detail->price - ($detail->price * $detail->sale / 100); @endphp
						@else
							@php $price = $detail->price - $detail->discount_amount; @endphp
						@endif

					<div class="clearfix" style="border-bottom: 1px solid #999999; border-left: 1px solid #999999; border-right: 1px solid #999999;">
						<div style="float: left; width: 50%; color: #2b2b2b; font-size: 14px; padding: 12px 15px;">{{ $detail->product_detail->product->product_name }}, Warna : {{ $detail->product_detail->color }}</div>
						<div style="float: left; width: 20%; color: #2b2b2b; font-size: 14px; border-left: 1px solid #999999; padding: 12px 15px;">RP {{ number_format($price) }}</div>
						<div style="float: left; width: 10%; color: #2b2b2b; font-size: 14px; border-left: 1px solid #999999; padding: 12px 15px;">{{ $detail->quantity }}</div>
						<div style="float: left; width: 20%; color: #2b2b2b; font-size: 14px; border-left: 1px solid #999999; padding: 12px 15px;">RP {{ number_format($detail->quantity * $price) }}</div>
					</div>
					@php $subtotal += $price * $detail->quantity; @endphp
					@endforeach
					@php $tax = $subtotal * $order->tax_vat /100; @endphp
					<div class="clearfix" style="border-right: 1px solid #999999; border-left: 1px solid transparent;">
						<div style="float: right; width: 20%; color: #2b2b2b; font-size: 14px; padding: 8px 15px;">RP {{ number_format($subtotal) }}</div>
						<div style="float: right; width: 30%; color: #2b2b2b; font-size: 14px; border-right: 1px solid #999999; border-left: 1px solid #999999; padding: 8px 15px;">SUBTOTAL</div>
					</div>
					<div class="clearfix" style="border-right: 1px solid #999999; border-left: 1px solid transparent;">
						<div style="float: right; width: 20%; color: #2b2b2b; font-size: 14px; padding: 8px 15px;">RP {{ number_format($order->jne_shipping_value) }}</div>
						<div style="float: right; width: 30%; color: #2b2b2b; font-size: 14px; border-right: 1px solid #999999; border-left: 1px solid #999999; padding: 8px 15px;">SHIPPING</div>
					</div>

					<div class="clearfix" style="border-right: 1px solid #999999; border-left: 1px solid transparent;">
						@if($order->free_shipping > 0)
							@if($order->free_shipping >= $order->jne_shipping_value)
								<div style="float: right; width: 20%; color: #2b2b2b; font-size: 14px; padding: 8px 15px;">RP (-){{ $order->jne_shipping_value }}</div>
							@else
								<div style="float: right; width: 20%; color: #2b2b2b; font-size: 14px; padding: 8px 15px;">RP (-){{ number_format($order->free_shipping) }}</div>
							@endif
						@else
							<div style="float: right; width: 20%; color: #2b2b2b; font-size: 14px; padding: 8px 15px;">RP 0</div>
						@endif
						<div style="float: right; width: 30%; color: #2b2b2b; font-size: 14px; border-right: 1px solid #999999; border-left: 1px solid #999999; padding: 8px 15px;">FREE SHIPPING</div>
					</div>
					@if($order->tax_vat > 0)
					<div class="clearfix" style="border-right: 1px solid #999999; border-left: 1px solid transparent;">
						<div style="float: right; width: 20%; color: #2b2b2b; font-size: 14px; padding: 8px 15px;">RP {{ number_format($tax) }}</div>
						<div style="float: right; width: 30%; color: #2b2b2b; font-size: 14px; border-right: 1px solid #999999; border-left: 1px solid #999999; padding: 8px 15px;">{{$company->tax_vat}}%</div>
					</div>
					@endif
					<div class="clearfix">
						@if($order->free_shipping > $order->jne_shipping_value)
							<div style="font-weight: bold; float: right; width: 20%; background: #737373 !important; color: white !important; font-size: 14px; padding: 12px 15px;">RP {{ number_format($subtotal + $tax) }}</div>
						@else
						<div style="font-weight: bold; float: right; width: 20%; background: #737373 !important; color: white !important; font-size: 14px; padding: 12px 15px;">RP {{ number_format($subtotal + $order->jne_shipping_value - $order->free_shipping + $tax) }}</div>
						@endif
						<div style="font-weight: bold; float: right; width: 30%; background: #737373 !important; color: white !important; font-size: 14px; border-right: 1px solid #999999; border-left: 1px solid #999999; padding: 12px 15px;">GRAND TOTAL</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
