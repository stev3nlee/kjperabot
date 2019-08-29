@extends('administratoronly/layout')
@section('content')
<script>
$(function() {
	$('#article').addClass ('active');
});
</script>

	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Website</a><span class="m10"> > </span><a href="{{url('/administratoronly/website/article')}}"/>Article</a><span class="m10"> > </span><a class="active">View article</a>
				</div>
				<div class="title">View: {!! $article->article_title !!}</div>
				<div class="title">Image: <br><img src="{{asset($article->image_path)}}" width="250" height="180"/></div>
				<div class="bodytext">
					<p> {!! $article->article_content !!} </p>
				</div>
				<div style="margin-top:80px;">
					<a href="{{ url('administratoronly/website/article') }}"><button type="button" class="btn btn-pop">Back</button></a>
				</div>
			</div>

@stop
