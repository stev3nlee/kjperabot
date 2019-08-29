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
					<a>Website</a><span class="m10"> > </span><a href="{{url('/administratoronly/website/article')}}"/>Article</a><span class="m10"> > </span><a class="active">Edit Article</a>
				</div>
				<div class="title">Edit Article</div>
				@include('errorfile')
				<form method="post" action="{{url('administratoronly/website/article/edit/'.$article->id.'/save')}}" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group">
						<label>Title <span class="red">*</span></label>
						<input type="hidden" required class="form-control" name="id" value="{{$article->id}}"/>
						<input type="text" required class="form-control" name="article_title" value="{{ $article->article_title }}"/>
					</div>
					<div class="form-group">
						<label>Image <span class="red">*</span></label><br>
						<img src="{{asset($article->image_path)}}" width="250" height="180"/>
						<input type="file" name="image"/>
						<div class="mt5">Tipe File : jpg, jpeg, gif, png</div>
						<div>Maximum File Size : 1MB</div>
						<div>Pic Resolution : 1440 x 600 pixels</div>
					</div>
					<textarea id="mceEdit" name="article_content">{{ $article->article_content }}</textarea>
					<div class="text-center">
						<a href="{{ url('/administratoronly/website/article/') }}"><button type="button" class="btn btn-pop mr10">Back</button></a>
						<input type="submit" class="btn btn-pop" value="Submit">
					</div>
				</form>
			</div>
		</div>
	</div>
@stop
