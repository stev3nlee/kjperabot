@extends('administratoronly.layout')
@section('content')
	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Commerce</a><span class="m10"> > </span><span class="active">Payment</span>
				</div>
				<div class="clearfix">
					<div class="pull-left">
						<div class="title">Payment</div>
					</div>
				</div>
				<div class="adminTable">
					<table id="table_id">
						<thead>
							<tr>
								<td width="50">No</td>
								<td>Payment Method</td>
								<td width="200">
									<div class="text-center">Action</div>
								</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Bank Transfer</td>
								<td class="text-center">
									<a href="{{ url('/administratoronly/commerce/payment/view' ) }}" class="link"><div class="img-view"></div></a>
								</td>
							</tr>
						</tbody>
						<tfoot></tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>

	
@stop
@section('script')
<script>
$(function() {
	$('#payment').addClass ('active');
});
</script>
@stop
