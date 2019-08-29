@extends('administratoronly.layout')
@section('content')

	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Settings</a><span class="m10"> > </span><span>User Account</span><span class="m10"> > </span><span>Group</span> <span class="m10"> > </span><span class="active">Edit Group</span>
				</div>
				<div class="title">Admin Group</div>
				@include('errorfile')
				<form action="{{ url('administratoronly/settings/useraccount/group/edit/'.$role->id.'/save') }}" method="post">
					{{ csrf_field() }}
					<?php $role_access=explode("&&",$role->role_access); ?>
					<div class="form-group">
						<label>Role Name <span class="red">*</span></label>
						<input type="hidden" name="id" value="{{ $role->id }}" />
						<input type="text" class="form-control" name="role_name" value="{{ $role->role_name }}" />
					</div>
					<div class="table-role">
						<table>
							<thead>
								<tr>
									<td>Menu</td>
									<td width="250" class="text-center">View</td>
								</tr>
							</thead>
							<tbody>
								@foreach($roles as $row)
								<tr>
									<td>{{ $row->role_detail_name }}</td>
									<td class="text-center"><input type="checkbox" name="is_checked[{{$row->id}}]" value="1" @if($role_access[$row->id-1]==1) checked @endif class="check-view"></td>
								</tr>
								@endforeach
							</tbody>
							<tfoot></tfoot>
						</table>
						<div class="text-center" style="margin-top: 10px;">
							<a href="{{ url('/administratoronly/settings/useraccount/group/index') }}"><button type="button" class="btn btn-pop">Back</button></a>
							<button type="submit" class="btn btn-pop">Submit</button>
						</div>
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
		$('#group').addClass ('active');

		$( ".deleteUserClick" ).click(function() {
			$("[name=deleteId]").val($(this).attr('data-value'));
		});
	});
</script>
@stop
