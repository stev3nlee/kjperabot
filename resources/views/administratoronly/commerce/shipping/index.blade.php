@extends('administratoronly.layout')
@section('content')
	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Commerce</a><span class="m10"> > </span><span class="active">Shipping</span>
				</div>
				<div class="clearfix">
					<div class="pull-left">
						<div class="title">Shipping</div>
					</div>
				</div>
				<div class="adminTable">
					<table id="table_id">
						<thead>
							<tr>
								<td width="50">No</td>
								<td>Shipping Name</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>JNE</td>
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
	$('#shipping').addClass ('active');
});
</script>
@stop
