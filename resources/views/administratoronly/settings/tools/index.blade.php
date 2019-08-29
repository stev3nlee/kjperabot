@extends('administratoronly/layout')
@section('content')

	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Settings</a><span class="m10"> > </span><span class="active">Tools</span>
				</div>
				<div class="clearfix">
					<div class="pull-left">
						<div class="title">Tools</div>
					</div>
				</div>
				<form method="post" action="{{url('administratoronly/settings/tools/save')}}" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group">
						<label>Logo <span class="red">*</span></label>
						<div class="clearfix site_logo">
							<div class="box-logo pull-left mr10 bg-logo" id="tempLogo">
								<img src="{{url($company->logo_path)}}">
							</div>
							<div class="pull-left"><input type="file" id="logo_image" name="logo"></div>
						</div>
					</div>
					<div class="form-group">
						<label>Favicon <span class="red">*</span></label>
						<div class="clearfix site_logo">
							<div class="box-logo pull-left mr10" id="tempFavicon">
								<img src="{{url($company->favicon_path)}}" style="height:40px; width:40px;">
							</div>
							<div class="pull-left"><input type="file" id="favicon_image" name="favicon"></div>
						</div>
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
	$('#tools').addClass ('active');
});
</script>
@stop
