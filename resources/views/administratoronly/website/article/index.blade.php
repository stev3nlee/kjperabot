@extends('administratoronly/layout')
@section('content')

	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Website</a><span class="m10"> > </span><span class="active">Article</span>
				</div>
			</div>
		<div class="clearfix">
			<div class="pull-left title">Article List</div>
			<div class="pull-right">
				<a href="{{ url('/administratoronly/website/article/add') }}"><button type="button" class="btn btn-auto">Add</button></a>
			</div>
		</div>
		@include('errorfile')
		<div class="adminTable">
			<table id="table_id">
				<thead>
					<tr>
						<td width="50">No</td>
						<td>Title</td>
						<td width="200">Date Created</td>
						<td width="90">
							<div class="text-center">Action</div>
						</td>
					</tr>
				</thead>
				<tbody>
					@foreach($articles as $article)
						<tr>
							<td>{{$loop->index+1}}</td>
							<td>{{$article->article_title}}</td>
							<td>{{ date("d M Y H:i",strtotime($article->created_at)) }}</td>
							<td class="text-center">
								<a href="{{ url('/administratoronly/website/article/view/'.$article->id) }}">
									<div class="img-view"></div>
								</a>
								<a href="{{ url('/administratoronly/website/article/edit/'.$article->id) }}">
									<div class="img-edit"></div>
								</a>
								<a class="fancybox deleteClick" href="#deleteGallery" data-id="{{$article->id}}">
									<div class="img-delete"></div>
								</a>
							</td>
						</tr>
					@endforeach
					</tbody>
					<tfoot></tfoot>
				</table>


			</div>
		</div>
	</div>

<!-- DELETE -->
<div id="deleteGallery" class="width-delete">
	<div class="pad-pop">
		<div class="title-pop">DELETE</div>
		<div class="img-pop">
			<div class="pop-delete"></div>
		</div>
		 <div class="text-center">
			<form action="{{url('/administratoronly/website/article/delete')}}" method="post">
				{{csrf_field()}}
				<input type="hidden" required name="id" id="deleteID"/>
				<div class="inline">
					<input type="submit" class="btn btn-sure" value="Yes"/>
				</div>
				<div class="inline">
					<button class="btn btn-cancel no-popup" type="button">No</button>
				</div>
			</form>
		</div>
	</div>
</div>
@stop
@section('script')
<script>
$(function() {
	$('#article').addClass ('active');
});
//comment line 1950
$("a.fancybox").fancybox('#deleteGallery');

$('.deleteClick').click(function(){
	var id = $(this).attr('data-id');
	$('#deleteID').val(id)
})
</script>
@stop
