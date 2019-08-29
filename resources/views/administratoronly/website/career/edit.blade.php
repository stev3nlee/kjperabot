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
					<a>Website</a><span class="m10"> > </span><a href="{{url('/administratoronly/website/career')}}"/>Career</a><span class="m10"> > </span><a class="active">Edit Career</a>
				</div>
				<div class="title">Edit: {{$career->job_name}}</div>
				@include('errorfile')
				<form method="post" action="{{ url('/administratoronly/website/career/edit/'.$career->id.'/save') }}">
					{{ csrf_field() }}
					<input type="hidden" name="id" value="{{$career->id}}"/>
					<div class="form-group">
						<label>Job name <span class="red">*</span></label>
						<input type="text" required class="form-control" name="job_name" value="{{$career->job_name}}"/>
					</div>
					<div class="form-group">
						<label>Job requirement <span class="red">*</span></label>
						<textarea id="mceFixed" class="form-control"  name="job_requirement">{{$career->requirement}}</textarea>
					</div>
					<div class="form-group">
						<label>Job responsibility <span class="red">*</span></label>
						<textarea id="mceFixed" class="form-control"  name="job_responsibility">{{$career->responsibility}}</textarea>
					</div>
					<div class="form-group mt10">
						<input type="checkbox" class="check" @if($career->is_publish == 1) checked @endif name="is_publish" value = "1">
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
