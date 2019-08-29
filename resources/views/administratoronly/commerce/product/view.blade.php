@extends('administratoronly.layout')
@section('content')
	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Commerce</a><span class="m10"> > </span><a>Store</a><span class="m10"> > </span><a href="{{ url('administratoronly/commerce/product') }}">Product</a><span class="m10"> > </span><a class="active">View Product</a>
				</div>

				<div class="title">View Product: {{ $product->product_name }}</div>
				<div class="row clearfix">
					<div class="wdth50">

						<div class="form-group" style="margin-bottom: 60px;">
							<label>Product Description</label>
							{!! $product->product_description !!}
						</div>
					</div>
					<div class="wdth50">
						<div class="adminTable">
							<table>
								<thead>
								<tr>
									<td>Color</td>
									<td>Stock</td>
									<td>Price</td>
									<td>Sale</td>
								</tr>
								</thead>

								<tbody>
								@foreach($product->product_details as $product_detail)
									<tr>
										<td>{{ $product_detail->color }}</div></td>
										<td>{{ $product_detail->stock }}</td>
										<td>IDR {{ number_format($product->product_price) }}</td>
										<td>IDR {{ number_format($product->product_price-($product->product_price*$product->sale/100)) }}</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<?php /*
				<div class="border-line"></div>
				<div class="row clearfix">
					<div class="wdth50">
						<div class="title"> Notify Customers </div>
						<form action="{{url('sendrestock-notification')}}" method="post">
							{{csrf_field()}}
							<input type="hidden" name="product_name" value="{{$product['product_name']}}"/>
							<div class="mb10"> The products are back in stock, you may send the notification by sending email to customers. </div>
							<div><button class="btn btn-small" type="submit" style="padding: 7px; line-height: 1em; font-size: 10px; height: 30px; width: auto;"> Notify Users </button> </div>
						</form>
						<div class="table-role mb30">
							<table>
								<thead>
									<tr>
										<td width="60">No</td>
										<td>Email</td>
										<td>Date</td>
									</tr>
								</thead>
								<tbody>
									@if(!empty($restockNotifications))
									<?php $x=1; ?>
									@foreach(explode("&&",$restockNotifications['email']) as $email)
									<tr><td>{{$x}}</td><td>{{$email}}</td><td>{{date("d-M-Y",strtotime($restockNotifications->created_at))}}</td></tr>
									<?php $x++ ?>
									@endforeach
									@endif
								</tbody>
								<tfoot></tfoot>
							</table>
						</div>
					</div>
				</div>
				*/?>
				<div>
					<a href="{{ url('administratoronly/commerce/product') }}"><button type="button" class="btn btn-pop">Back</button></a>
				</div>
			</div>
		</div>
	</div>
@stop
@section('script')
<script>
$(function() {
	$(document).ready(function() {
		$('#store > ul.submenu').addClass ('open');
		$('li#store').addClass ('open');
		$('#product').addClass ('active');
	});
});
</script>
@stop
