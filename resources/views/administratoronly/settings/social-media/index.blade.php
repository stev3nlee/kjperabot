@extends('administratoronly/layout')
@section('content')
	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Settings</a><span class="m10"> > </span><span class="active">Social Media</span>
				</div>
				<div class="title">Social Media</div>
				@include('errorfile')
				<form method="post" action="{{url('/administratoronly/settings/social-media/save')}}">
					{{ csrf_field() }}
					<div class="form-group">
						<label>Facebook</label>
						<input type="text" class="form-control width500" name="facebook" value="{{$company->facebook}}" />
					</div>
					<div class="form-group">
						<label>Instagram</label>
						<input type="text" class="form-control width500" name="instagram" value="{{$company->instagram}}" />
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
	$('#social-media').addClass ('active');
});
</script>
@stop
