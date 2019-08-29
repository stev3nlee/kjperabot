@extends('administratoronly/layout')
@section('content')
	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Commerce</a><span class="m10"> > </span><span class="active">Others</span>
				</div>
				<div class="title">Others</div>
				@include('errorfile')
				<form method="post" action="{{url('/administratoronly/commerce/others/save')}}">
					{{ csrf_field() }}
					<div class="form-group">
						<label>Tax (In %)</label>
						<input type="text" class="form-control width200" name="tax" value="{{$company->tax_vat}}" />
					</div>
					<div class="form-group" style="margin-top:50px;">
						<label>Free Shipping (Price)</label>
						<input type="text" class="form-control width200" name="free_shipping" value="{{$company->free_shipping}}" />
					</div>
					<div>
						<button type="submit" class="btn btn-pop">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop
@section('script')
<script>
$(function() {
	$('#others').addClass ('active');
});
</script>
@stop
