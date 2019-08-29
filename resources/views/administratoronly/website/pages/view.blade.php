@extends('administratoronly/layout')
@section('content')
<script>
$(function() {
	$('#pages').addClass ('active');
});
</script>

	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Website</a><span class="m10"> > </span><a href="{{url('/administratoronly/website/pages')}}"/>Pages</a><span class="m10"> > </span><a class="active">View Pages</a>
				</div>
				<div class="title">View Content: {{ $page->page_title }}</div>
				<div class="form-group ori-font">
					{!! $page->page_description !!}
				</div>
				<div class="text-center">
					<a href="{{url('/administratoronly/website/pages')}}"><button type="button" class="btn btn-pop">Back</button></a>
				</div>
			</div>
		</div>
	</div>
@stop
