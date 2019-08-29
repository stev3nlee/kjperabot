@extends('administratoronly.layout')
@section('content')
	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Commerce</a><span class="m10"> > </span><a href="{{url('/administratoronly/commerce/payment')}}"/>Payment</a><span class="m10"> > </span><a class="active">View Payment</a>
				</div>
				<div class="clearfix">
					<div class="pull-left">
						<div class="title">View Bank Transfer</div>
					</div>
				</div>
				<div class="adminTable">
					<table id="table_id">
						<thead>
							<tr>
								<td width="50">No</td>
								<td>Bank Name</td>
								<td>Account Name</td>
								<td>Account Number</td>
							</tr>
						</thead>
						<tbody>
							@foreach($banks as $bank)
							<tr>
								<td>{{$loop->index+1}}</td>
								<td>{{$bank->bank_name}}</td>
								<td>{{$bank->account_name}}</td>
								<td>{{$bank->account_no}}</td>
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
@section('script')
<script>
$(function() {
	$('#payment').addClass ('active');
});
</script>
@stop
