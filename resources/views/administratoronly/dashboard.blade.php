@extends('administratoronly/layout')
@section('content')

<style>
div.dataTables_wrapper div.dataTables_paginate, .dataTables_filter, .adminTable .dataTables_length, div.dataTables_wrapper div.dataTables_info { display: none !important; }
</style>

<div class="clearfix">
	@include('administratoronly/menu')
	<div class="box-right" style="padding-top:20px;">
		<!--
		<div class="text-center">
			<div class="w-user">Welcome back! You’re logged in as <span style="font-family: 'open_sansbold_italic';">{{ ucwords(strtolower(Auth::guard('administrator')->user()->name)) }}</span>.</div>
		</div>
		-->
		<div class="content">
      <div class="breadcrumb">
          <a class="active">Dashboard</a>
      </div>
      <div class="mb50">
        <div class="clearfix">
					<div class="title">Completed Sales Report</div>
					<div class="clearfix bdr-sales">
						<div class="pull-left">Today</div>
						@php $total =0; $grandtotal=0; @endphp
						@foreach($totalPerday as $order)
							@foreach($order->order_details as $detail)
								@php $total = $detail->price - ($detail->price * $detail->sale / 100) * $detail->quantity; @endphp
								@php $total = $total +($total * $order->tax_vat / 100); @endphp
								@php $total = $total + $order->jne_shipping_value - ($order->free_shipping > 0 ? ($order->free_shipping >= $order->jne_shipping_value ? $order->jne_shipping_value : $order->free_shipping) : 0); @endphp
								@php $grandtotal +=$total; @endphp
							@endforeach
						@endforeach
						<div class="pull-right">IDR {{ number_format($grandtotal) }}</div>
					</div>
					<div class="clearfix bdr-sales">
						<div class="pull-left">This Month</div>
						@php $total =0; $grandtotal=0; @endphp
						@foreach($totalPermonth as $order)
							@foreach($order->order_details as $detail)
								@php $total = $detail->price - ($detail->price * $detail->sale / 100) * $detail->quantity; @endphp
								@php $total = $total +($total * $order->tax_vat / 100); @endphp
								@php $total = $total + $order->jne_shipping_value - ($order->free_shipping > 0 ? ($order->free_shipping >= $order->jne_shipping_value ? $order->jne_shipping_value : $order->free_shipping) : 0); @endphp
								@php $grandtotal +=$total; @endphp
							@endforeach
						@endforeach
						<div class="pull-right">IDR {{ number_format($grandtotal) }}</div>
					</div>
					<div class="clearfix bdr-sales">
						<div class="pull-left">This Year</div>
						@php $total =0; $grandtotal =0; @endphp
						@foreach($totalPeryear as $order)
							@foreach($order->order_details as $detail)
								@php $total = $detail->price - ($detail->price * $detail->sale / 100) * $detail->quantity; @endphp
								@php $total = $total +($total * $order->tax_vat / 100); @endphp
								@php $total = $total + $order->jne_shipping_value - ($order->free_shipping > 0 ? ($order->free_shipping >= $order->jne_shipping_value ? $order->jne_shipping_value : $order->free_shipping) : 0); @endphp
								@php $grandtotal +=$total; @endphp
							@endforeach
						@endforeach
						<div class="pull-right">IDR {{ number_format($grandtotal) }}</div>
					</div>
				</div>
      </div>
      <div class="mb50">
          <div class="row clearfix">
              <div class="wdth50">
                  <div class="title">Export to Excel</div>
                  <div class="form-group">
                      <div class="clearfix mb10">
												@include('errorfile')
												<form method="post" action="{{url('administratoronly/export')}}">
													{{ csrf_field() }}
                          <div class="inline-other" style="width: 200px;">
                              <label>Choose Range (Sales Report):</label>
                          </div>
													<br>
                          <div class="inline-other row">
														<label>From :</label>
														 <input type="text" class="start-date inputDate" name="start_date" value="{{date("01-m-Y")}}">
														<label>To :</label>
                            <input type="text" class="end-date inputDate" name="end_date" value="{{date("t-m-Y")}}">
                          </div>
													<div class="">
															<input type="submit" class="btn btn-pop mr10" value="EXPORT">
													</div>
												</form>
                      </div>
                  </div>
              </div>
              <div class="wdth50">
                  <div class="title">Other Stats</div>
                  <div class="box-other">
                      <div class="clearfix bdr-sales">
                          <div class="inline-other" style="width:50px;">
                              <div class="t-other">{{ number_format($totalCompleteOrder) }}</div>
                          </div>
                          <div class="inline-other">Completed Orders</div>
                      </div>
                      <div class="clearfix bdr-sales">
                          <div class="inline-other" style="width:50px;">
                              <div class="t-other">{{number_format($totalUser)}}</div>
                          </div>
                          <div class="inline-other">Customers</div>
                      </div>
                      <div class="clearfix bdr-sales">
                          <div class="inline-other" style="width:50px;">
                              <div class="t-other">{{ number_format($totalSubscriber) }}</div>
                          </div>
                          <div class="inline-other">Newsletter Subscribers</div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
			<div>
        <div class="title">Last 10 Orders</div>
        <div class="adminTable">
          <table id="data-table" width="100%">
            <thead>
              <tr>
                <td>Order No</td>
                <td>Member</td>
                <td>Total</td>
								<td>Destination</td>
                <td>Shipping</td>
                <td>Order Date</td>
                <td>Last Update</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody>
							@foreach($orders as $order)
								<tr>
								@php $total =0; $grandtotal =0; @endphp
								@foreach($order->order_details as $detail)
									@php $total = $detail->price - ($detail->price * $detail->sale / 100) * $detail->quantity; @endphp
									@php $total = $total +($total * $order->tax_vat / 100); @endphp
									@php $total = $total + $order->jne_shipping_value - ($order->free_shipping > 0 ? ($order->free_shipping >= $order->jne_shipping_value ? $order->jne_shipping_value : $order->free_shipping) : 0); @endphp
									@php $grandtotal +=$total; @endphp
								@endforeach
							<td> {{ $order->order_no }} </td>
							<td> {{ $order->billing_first_name }} {{ $order->billing_last_name }}</td>
							<td> IDR {{ number_format($grandtotal) }} </td>
							<td> {{ $order->shipping_jne_city_label }} </td>
							<td> {{ number_format($order->jne_shipping_value  - ($order->free_shipping > 0 ? ($order->free_shipping >= $order->jne_shipping_value ? $order->jne_shipping_value : $order->free_shipping) : 0)) }} </td>
							<td>{{ date("d F Y H:i",strtotime($order->created_at)) }}</td>
							<td>{{ date("d F Y H:i",strtotime($order->updated_at)) }}</td>
							<td> <a href="{{ url('administratoronly/commerce/order/view/'.$order->id) }}"> View </a> </td>
						</tr>
							@endforeach
            </tbody>
            <tfoot></tfoot>
          </table>
        </div>
      </div>
    </div>
	</div>
@stop
