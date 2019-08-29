@extends('administratoronly/layout')
@section('content')

	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Settings</a><span class="m10"> > </span><span>User Account</span><span class="m10"> > </span><span class="active">Account</span>
				</div>
				<div class="clearfix">
					<div class="pull-left">
						<div class="title">Account</div>
					</div>
					<div class="pull-right">
						<a class="click-box2"><button type="button" class="btn btn-auto">Add</button></a>
					</div>
				</div>
				@include('errorfile')
				<div class="adminTable">
					<table id="table_id">
						<thead>
							<tr>
								<td width="60">No</td>
								<td>Email</td>
								<td width="200">Full Name</td>
								<td width="150">Role</td>
								<td width="150" class="text-center">Action</td>
							</tr>
						</thead>
						<tbody>
							@foreach($admins as $admin)
								<tr>
									<td>{{ $loop->index+1 }}</td>
									<td>{{ $admin->email }}</td>
									<td>{{ $admin->name }}</td>
									<td>{{ $admin->role->role_name }}</td>
									<td class="text-center">
										<a class="click-box">
											<div class="img-edit editClick" data-id="{{$admin->id}}" data-email="{{$admin->email}}" data-name="{{$admin->name}}" data-role="{{$admin->role_id}}"></div>
										</a>
										<a class="fancybox deleteClick" href="#deleteUser" data-id="{{$admin->id}}">
											<div class="img-delete"></div>
										</a>
									</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot></tfoot>
					</table>
				</div>
			</div>

			<!-- ADD -->
			<div class="open-box2">
				<div class="in-box">
					<div class="close-box"></div>
					<div class="mt30">
						<form action="{{ url('/administratoronly/settings/useraccount/account/add') }}" method="post">
							<div class="form-group">
								<label>Email <span class="red">*</span></label>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="text" class="form-control" name="email" value="" required/>
							</div>
							<div class="form-group">
								<label>Full Name <span class="red">*</span></label>
								<input type="text" class="form-control" name="full_name" value="" required/>
							</div>
							<div class="form-group">
								<label>Role <span class="red">*</span></label>
								<select class="custom-select form-control" name="role" required>
									@foreach($roles->where('id','<>',1) as $role)
									<option value="{{$role->id}}">{{$role->role_name}}</option>
									@endforeach
								</select>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn150">Add</button>
							</div>
						</form>
					</div>
				</div>
			</div>

	<!-- EDIT -->
	<div class="open-box">
		<div class="in-box">
			<div class="close-box"></div>
			<div class="mt30">
				<form action="{{ url('administratoronly/settings/useraccount/account/edit') }}" method="post">
					<div class="form-group">
						<label>Email <span class="red">*</span></label>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="" id="editId">
						<input type="text" class="form-control" id="editEmail" name="email" value="" readonly required/>
					</div>
					<div class="form-group">
						<label>Full Name <span class="red">*</span></label>
						<input type="text" class="form-control" id="editName" name="full_name" value="" required/>
					</div>
					<div class="form-group">
						<label>Role <span class="red">*</span></label>
						<select class="custom-select form-control" id="editRole" name="role">
							@foreach($roles as $role)
							<option value="{{$role->id}}">{{$role->role_name}}</option>
							@endforeach
						</select>
					</div>
					<div class="text-center">
						<button type="submit" class="btn btn150">Edit</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- DELETE -->
	<div id="deleteUser" class="width-pop">
		<div class="pad-pop">
			<div class="title-pop">DELETE</div>
			<div class="img-pop">
				<div class="pop-delete"></div>
			</div>
			 <div class="text-center">
				<form action="{{url('administratoronly/settings/useraccount/account/delete')}}" method="post">
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

@stop
@section('script')
<script>
	$(function() {
		$('#role > ul.submenu').addClass ('open');
		$('li#role').addClass ('open');
		$('#account').addClass ('active');

		$( ".deleteClick" ).click(function() {
			$("#deleteId").val($(this).attr('data-id'));
		});
		$( ".editClick" ).click(function() {
			$('#editId').val($(this).attr('data-id'));
			$("#editEmail").val($(this).attr('data-email'));
			$("#editName").val($(this).attr('data-name'));
			$("#editRole").val($(this).attr('data-role'));
		});
	});
	</script>
@stop
