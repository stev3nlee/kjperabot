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
					<a>Website</a><span class="m10"> > </span><a href="{{url('/administratoronly/website/career')}}"/>Career</a><span class="m10"> > </span><a class="active">View Career</a>
				</div>
				<div class="title">View Career</div>
				<div class="form-group">
					<label>Title</label>
					<div>{{ $career->job_name }}</div>
				</div>
				<div class="form-group">
					<label>Job requirement</label>
					<p> {!! $career->requirement !!} </p>
				</div>

				<div class="form-group">
					<label>Job responsibility</label>
					<p> {!! $career->responsibility !!} </p>
				</div>
				<div>
					<a href="{{ url('administratoronly/website/career') }}"><button type="button" class="btn btn-pop">Back</button></a>
				</div>
			</div>

@stop
