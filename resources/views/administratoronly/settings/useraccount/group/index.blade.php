@extends('administratoronly.layout')
@section('content')
	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Settings</a><span class="m10"> > </span><span>User Account</span><span class="m10"> > </span><span class="active">Group</span>
				</div>
				<div class="clearfix">
					<div class="pull-left">
						<div class="title">Group</div>
					</div>
					<div class="pull-right">
						<a class="click-box2" href="{{ url('/administratoronly/settings/useraccount/group/add') }}"><button type="button" class="btn btn-auto">Add</button></a>
					</div>
				</div>
				<div class="table-role">
					@include('errorfile')
					<table>
						<thead>
							<tr>
								<td width="60">No</td>
								<td>Role Name</td>
								<td width="150" class="text-center">Action</td>
							</tr>
						</thead>
						<tbody>
							@foreach($roles as $role)
							<tr>
								<td>{{ $loop->index+1 }}</td>
								<td>{{ $role->role_name }}</td>
								<td class="text-center" style="height:35px;">
									<a href="{{url('/administratoronly/settings/useraccount/group/edit/'.$role->id)}}">
										<div class="img-edit"></div>
									</a>
									@if($role->id != 1)
									<a class="fancybox deleteUserClick" href="#deleteUser" data-id="{{$role->id}}">
										<div class="img-delete"></div>
									</a>
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot></tfoot>
					</table>
				</div>
			</div>

			<div id="deleteUser" class="width-pop">
				<div class="pad-pop">
					<div class="title-pop">DELETE</div>
					<div class="img-pop">
						<div class="pop-delete"></div>
					</div>
					 <div class="text-center">
						<form action="{{url('/administratoronly/settings/useraccount/group/delete')}}" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" required name="id" id="deleteId"/>
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
		</div>

	</div>
@stop
@section('script')
<script>
	$(function() {
		$('#role > ul.submenu').addClass ('open');
		$('li#role').addClass ('open');
		$('#group').addClass ('active');

		$( ".deleteUserClick" ).click(function() {
			$("#deleteId").val($(this).attr('data-id'));
		});
	});
</script>
@stop
