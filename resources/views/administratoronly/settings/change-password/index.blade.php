@extends('administratoronly/layout')
@section('content')

	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Settings</a><span class="m10"> > </span><span class="active">Change Password</span>
				</div>
				<div class="clearfix">
					<div class="pull-left">
						<div class="title">Change Password</div>
					</div>
				</div>
				@include('errorfile')
				<form method="post" action="{{url('administratoronly/settings/change-password/save')}}">
					{{csrf_field()}}
					<div class="form-group">
						<label>Old Password<span class="red">*</span></label>
						<input type="password" class="form-control width500" name="current_password" />
					</div>
					<div class="form-group">
						<label>New Password<span class="red">*</span></label>
						<input type="password" class="form-control width500" name="password" />
					</div>
					<div class="form-group">
						<label>Confirm New Password<span class="red">*</span></label>
						<input type="password" class="form-control width500" name="password_confirmation" />
					</div>
					<div class="clearfix">
						<input type="submit" name="" class="btn btn-pop" value="Change" />
					</div>
				</form>
			</div>
		</div>
	</div>
@stop
@section('script')
<script>
$(function() {
	$('li#change-password').addClass ('active');
});

</script>
@stop
