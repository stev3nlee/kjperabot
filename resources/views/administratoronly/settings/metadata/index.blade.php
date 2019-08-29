@extends('administratoronly/layout')
@section('content')

	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Settings</a><span class="m10"> > </span><span class="active">Metadata</span>
				</div>
				<div class="clearfix">
					<div class="pull-left">
						<div class="title">Metadata</div>
					</div>
				</div>
				@include('errorfile')
				<form method="post" action="{{url('/administratoronly/settings/metadata/save')}}">
					{{ csrf_field() }}
					<div class="form-group">
						<label>Title <span class="red">*</span></label>
						<input type="text" class="form-control width500" name="meta_title" value="{{$company->meta_title}}"/>
					</div>
					<div class="form-group">
						<label>Meta Keyword <span class="red">*</span></label>
						<input type="text" class="form-control width500" name="meta_keyword" value="{{$company->meta_keyword}}"/>
					</div>
					<div class="form-group">
						<label>Meta Description <span class="red">*</span></label>
						<input type="text" class="form-control width500" name="meta_description" value="{{$company->meta_description}}" />
					</div>
					<div>
						<button type="submit" class="btn btn-pop">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div id="loader" style="display: none;">
		<img src="{{asset('images/icons/default.gif')}}" />
	</div>
@stop
@section('script')
<script>
$(function() {
	$('#metadata').addClass ('active');
});
</script>
@stop
