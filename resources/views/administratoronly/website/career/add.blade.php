@extends('administratoronly/layout')
@section('content')
<script>
$(function() {
	$('#career').addClass ('active');
});
</script>

	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Website</a><span class="m10"> > </span><a href="{{url('/administratoronly/website/career')}}"/>Career</a><span class="m10"> > </span><a class="active">Add Career</a>
				</div>
				<div class="title">Add New Career</div>
				@include('errorfile')
				<form method="post" action="{{ url('/administratoronly/website/career/add/save') }}">
					{{ csrf_field() }}
					<div class="form-group">
						<label>Job name <span class="red">*</span></label>
						<input type="text" required class="form-control" name="job_name" value="{{old('job_name')}}"/>
					</div>
					<div class="form-group">
						<label>Job requirement <span class="red">*</span></label>
						<textarea id="mceFixed" class="form-control"  name="job_requirement">{{old('job_requirement')}}</textarea>
					</div>
					<div class="form-group">
						<label>Job responsibility <span class="red">*</span></label>
						<textarea id="mceFixed" class="form-control"  name="job_responsibility">{{old('job_responsibility')}}</textarea>
					</div>
					<div class="form-group mt10">
						<input type="checkbox" class="check" checked name="is_publish" value = "1">
						<span class="publish-check">Publish</span>
					</div>
					<div class="text-center">
						<a href="{{ url('/administratoronly/website/career') }}"><button type="button" class="btn btn-pop mr10">Back</button></a>
						<input type="submit" class="btn btn-pop" value="Submit">
					</div>
				</form>
			</div>
		</div>
	</div>
@stop
