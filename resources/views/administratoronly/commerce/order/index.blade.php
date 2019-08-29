@extends('administratoronly.layout')
@section('content')

<style>
.no-sort::after { display: none!important; }
.no-sort { pointer-events: none!important; cursor: default!important; }
table.dataTable thead>tr>th.sorting_asc, table.dataTable thead>tr>th.sorting_desc, table.dataTable thead>tr>th.sorting, table.dataTable thead>tr>td.sorting_asc, table.dataTable thead>tr>td.sorting_desc, table.dataTable thead>tr>td.sorting { padding-right: 0; }
</style>

	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Commerce</a><span class="m10"> > </span><span class="active">Order</span>
				</div>
				<div class="title">Order</div>
				@include('errorfile')
				<div class="adminTable">
					<table id="table_id">
						<thead>
							<tr class="no-sort">
								<td>Order No.</td>
								<td>Member</td>
								<td>Total</td>
								<td>Payment</td>
								<td width="150">Shipping</td>
								<td>Order Date</td>
								<td>Last Updated</td>
								<td width="150" class="text-center">Action</td>
							</tr>
						</thead>
						<tbody>
							@foreach($orders as $order)
							<tr>
								<td>{{ $order->order_no }}</td>
								<td>{{ ucwords(strtolower($order->billing_first_name)) }} {{ ucwords(strtolower($order->billing_last_name)) }}</td>
								<td>
									@php $price = 0; @endphp
									@foreach($order->order_details as $detail)
										@php $price += ($detail->price - ($detail->price * $detail->sale / 100)) * $detail->quantity; @endphp
									@endforeach
									@if($order->free_shipping > $order->jne_shipping_value)
									Rp {{ number_format($price + ($order->tax_vat * $price / 100)) }}
									@else
									Rp {{ number_format($price + ($order->tax_vat * $price / 100) + $order->jne_shipping_value - $order->free_shipping) }}
									@endif
								</td>
								<td>
									@if($order->order_status == 1)
										Pending
									@elseif($order->order_status == 2)
										<div class="orange">Awaiting for Payment</div>
										<a class="fancybox trackingClick confirm-payment" onclick="set_confirm_payment({{$order->id}})" href="#popConfirm" data-id="{{ $order->id }}"><button type="button" class="btn btn-order">Confirm Payment</button></a>
									@elseif($order->order_status == 3)
										<div class="green">Paid</div>
										@if($order->jne_track == null)
										<a class="fancybox trackingClick cancel-payment" onclick="set_cancel_payment({{$order->id}})" href="#popCancelConfirm" data-id="{{ $order->id }}"><button type="button" class="btn btn-order">Cancel Payment</button></a>
										@endif
									@elseif($order->order_status == 4 or $order->order_status == 5)
										<div class="red">Canceled</div>
									@endif
								</td>
								<td>
									@if($order->order_status == 3)
										@if($order->jne_track == null)
											<div class="orange">On Process</div>
											<a class="fancybox trackingClick" href="#pop-tracking" onclick="set_tracking({{$order->id}})"><button type="button" class="btn btn-order">Tracking no</button></a>
										@else
											<div class="">{{ $order->jne_track }}</div>
											<a class="fancybox trackingClick" href="#pop-tracking" onclick="set_tracking({{$order->id}})"><button type="button" class="btn btn-order">Tracking no</button></a>
										@endif
									@else
										@if($order->order_status == 4)
											<div class="red">Pending</div>
										@else
											<div class="">Pending</div>
										@endif
									@endif
								</td>
								<td>{{ date("d F Y H:i",strtotime($order->created_at)) }}</td>
								<td>{{ date("d F Y H:i",strtotime($order->updated_at)) }}</td>
								<td class="text-center">
									<a href="{{ url('/administratoronly/commerce/order/view/'.$order->id) }}" class="link"><div class="img-view"></div></a>
									<a class="fancybox delete" onclick="setDeleteData({{ $order->id }})" href="#cancelOrder"><div class="img-delete"></div></a>
								</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot></tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>

<!-- TRACKING NO -->
<div id="pop-tracking" class="width-pop">
	<div class="pad-pop">
		 <div class="text-center">
			 	<form id="frmConfirmTracking" method="post" action="{{url('administratoronly/commerce/order/tracking')}}">
					{{csrf_field()}}
					<div class="form-group">
						<label class="title-pop">Tracking No</label>
						<br>
						<input type="text" class="form-control" name="tracking_no" />
						<input type="hidden" value="" class="hidden_order" id="tracking-id" name="id">
					</div>
					<div class="inline">
						<button class="btn btn-sure btn_tracking order2 submit_tracking">Yes</button>
					</div>
					<div class="inline">
						<button class="btn btn-cancel no-popup" type="button">No</button>
					</div>
				</form>
		</div>
	</div>
</div>

<!-- DELETE -->
<div id="deleteGallery" class="full-pop">
	<div class="pad-pop">
		<div class="title-pop">DELETE</div>
		<div class="img-pop">
			<div class="pop-delete"></div>
		</div>
		 <div class="text-center">
			<form action="#" method="post">
				{{csrf_field()}}
				<input type="hidden" value="" required name="hidden_order" id="deleteID"/>
				<div class="inline">
					<button class="btn btn-sure">Yes</button>
				</div>
				<div class="inline">
					<button class="btn btn-cancel no-popup" type="button">No</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- CONFIRM PAYMENT -->
<div id="popConfirm" class="width-pop">
	<div class="pad-pop">
		<div class="title-pop">CONFIRM PAYMENT</div>
		 <div class="text-center">
			<div class="inline">
				<form id="frmConfirmPayment" method="post" action="{{ url('/administratoronly/commerce/order/confirmpayment') }}">
					{{csrf_field()}}
					<input type="hidden" value="" class="hidden_order" id="confirm-id"  name="id">
					<input type="submit" class="btn btn-sure btn_payment submit_payment" value="Yes">
				</form>
			</div>
			<div class="inline">
				<button class="btn btn-cancel no-popup" type="button">No</button>
			</div>
		</div>
	</div>
</div>

<!-- CANCEL PAYMENT -->
<div id="popCancelConfirm" class="width-pop">
	<div class="pad-pop">
		<div class="title-pop">CANCEL PAYMENT</div>
		 <div class="text-center">
			<div class="inline">
				<form id="frmConfirmPayment" method="post" action="{{ url('/administratoronly/commerce/order/cancelpayment') }}">
					{{csrf_field()}}
					<input type="hidden" value="" class="hidden_order" id="cancel-id"  name="id">
					<input type="submit" class="btn btn-sure btn_payment submit_payment" value="Yes">
				</form>
			</div>
			<div class="inline">
				<button class="btn btn-cancel no-popup" type="button">No</button>
			</div>
		</div>
	</div>
</div>

<!-- CANCEL -->
<div id="cancelOrder" class="width-pop">
	<div class="pad-pop">
		<div class="title-pop">CANCEL</div>
		<div class="img-pop">
			<div class="pop-cancel"></div>
		</div>
		 <div class="text-center">
			<form method="post" action="{{ url('administratoronly/commerce/order/delete') }}">
				{{ csrf_field() }}
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" required name="id" id="cancelId"/>
				<div class="inline">
					<button class="btn btn-sure">Yes</button>
				</div>
				<div class="inline">
					<button class="btn btn-cancel no-popup" type="button">No</button>
				</div>
			</form>
		</div>
	</div>
</div>
@stop
@section('script')
<script>
function set_confirm_payment(id)
{
	$('#confirm-id').val(id);
}

function set_cancel_payment(id)
{
	$('#cancel-id').val(id);
}

function set_tracking(id)
{
	$('#tracking-id').val(id);
}


function setDeleteData(id)
{
	$('#cancelId').val(id);
}


$(function() {

	$('li#order').addClass ('active');
});
$('#table_id').dataTable( {
	"order": [[ 0, 'desc' ]]
} );


</script>
@stop
