@extends('administratoronly/layout')
@section('content')
	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Website</a><span class="m10"> > </span><a href="{{url('/administratoronly/website/pages')}}"/>Pages</a><span class="m10"> > </span><a class="active">Edit Page</a>
				</div>
				<div class="title">Edit Page: {{ $page->page_title }}</div>
				@include('errorfile')
				<form method="post" action="{{ url('/administratoronly/website/pages/edit/'.$page->id.'/save') }}">
					{{ csrf_field() }}
					<input type="hidden" name="id" value="{{$page->id}}"/>
					<div class="form-group">
						<textarea id="mceEdit" class="form-control" name="page_content">{!! $page->page_description !!}</textarea>
					</div>
            <div class="text-center">
                <a class="mr10" href="{{ url('/administratoronly/website/pages') }}"><button type="button" class="btn btn-pop">Back</button></a>
                <input type="submit" name="upload" class="btn btn-pop mr10" value="Submit"/>
            </div>
        </form>
			</div>
		</div>
	</div>
@stop

@section('script')
<script>
$(function() {
	$('#pages').addClass ('active');
});
</script>
@endsection
