@extends('administratoronly.layout')
@section('content')
	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Commerce</a><span class="m10"> > </span><span class="active">Member</span>
				</div>
				<div class="clearfix">
					<div class="pull-left">
						<div class="title">Member</div>
					</div>
				</div>
				<div class="adminTable">
					<table id="table_id">
						<thead>
							<tr>
								<td width="150">Full Name</td>
								<td width="200">Email Address</td>
								<td width="100">Contact Phone</td>
								<td width="100" class="text-center">Action</td>
							</tr>
						</thead>
						<tbody>
							@foreach($members as $member)
							<tr>
								<td>{{ ucwords($member->first_name)}} {{ucwords($member->last_name) }}</td>
								<td>{{ $member->email }}</td>
								<td width="100">{{ $member->phone }}</td>
								<td class="text-center">
									<a href="{{ url('administratoronly/commerce/member/view/'.$member->id) }}">
										<div class="img-view"></div>
									</a>
								</td>
							</tr>
							@endforeach
							<div id="popUp" class="width-pop">
								<div id="location">
									<div class="pad-pop">
										<div class="title-pop">Location</div>
										<div class="row clearfix">
											<div class="wdth50">
												<div class="form-group">
													<label>Personal Address</label>
													<div class="clearfix text-pop">
														<div class="left-location">Country</div>
														<div class="center-location">:</div>
														<div class="right-location">Indoneisa</div>
													</div>
													<div class="clearfix text-pop">
														<div class="left-location">City</div>
														<div class="center-location">:</div>
														<div class="right-location">Jakarta</div>
													</div>
													<div class="clearfix text-pop">
														<div class="left-location">Post Code</div>
														<div class="center-location">:</div>
														<div class="right-location">11510</div>
													</div>
													<div class="clearfix text-pop">
														<div class="left-location">Address</div>
														<div class="center-location">:</div>
														<div class="right-location">Ancol Lodan</div>
													</div>
												</div>
											</div>
											<div class="wdth50">
												<div class="form-group">
													<label>Shipping Address</label>
													<div class="clearfix text-pop">
														<div class="left-location">Country</div>
														<div class="center-location">:</div>
														<div class="right-location">Indoneisa</div>
													</div>
													<div class="clearfix text-pop">
														<div class="left-location">City</div>
														<div class="center-location">:</div>
														<div class="right-location">Jakarta</div>
													</div>
													<div class="clearfix text-pop">
														<div class="left-location">Post Code</div>
														<div class="center-location">:</div>
														<div class="right-location">11510</div>
													</div>
													<div class="clearfix text-pop">
														<div class="left-location">Address</div>
														<div class="center-location">:</div>
														<div class="right-location">Ancol Lodan</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</tbody>
						<tfoot></tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>

<div id="deleteUser" class="width-pop">
	<div class="pad-pop">
		<div class="title-pop">DELETE</div>
		<div class="img-pop">
			<div class="pop-delete"></div>
		</div>
		 <div class="text-center">
			<form action="" method="post">
				<input type="hidden" required name="delete_id" id="deleteID"/>
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
$(function() {
	$('li#member').addClass ('active');
});
</script>
@stop
