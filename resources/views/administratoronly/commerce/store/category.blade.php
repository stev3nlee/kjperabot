@extends('administratoronly.layout')
@section('content')
	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Commerce</a><span class="m10"> > </span><span class="active">Category</span>
				</div>
				<div class="clearfix">
					<div class="pull-left">
						<div class="title">Category</div>
					</div>
					<div class="pull-right">
						<a class="click-box2"><button type="button" class="btn btn-auto">Add</button></a>
					</div>
				</div>
				@include('errorfile')
				<div class="adminTable">
					<table id="table_id">
						<thead>
							<tr>
								<td width="50">No</td>
								<td>Category Name</td>
								<td width="200">
									<div class="text-center">Action</div>
								</td>
							</tr>
						</thead>
						<tbody>
							@foreach($categories as $category)
							<tr>
								<td>{{$loop->index+1}}</td>
								<td>{{$category->category_name}}</td>
								<td class="text-center">
									<a href="{{ url('/administratoronly/commerce/store/subcategory/') }}" class="link"><div class="img-view"></div></a>
									<a class="click-box edit" onclick="edit_category({{$category->id}},'{{$category->category_name}}')" data-id="{{$category->id}}" data-name="{{$category->category_name}}"><div class="img-edit"></div></a>
									<a class="fancybox delete" onclick="delete_category({{$category->id}})" data-id="{{$category->id}}" href="#delete"><div class="img-delete"></div></a>
								</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot></tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>

<!-- ADD -->
<div class="open-box2">
	<div class="in-box">
		<div class="close-box"></div>
		<div class="mt30">
			<form method="post" action="{{ url('/administratoronly/commerce/store/category/add') }}">
				{{ csrf_field() }}
				<div class="form-group">
					<label>Category Name <span class="red">*</span></label>
					<input type="text" class="form-control" name="category_name" value="{{old('category_name')}}">
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn150">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- EDIT -->
<div class="open-box">
	<div class="in-box">
		<div class="close-box"></div>
		<div class="mt30">
			<form method="post" action="{{ url('/administratoronly/commerce/store/category/edit') }}">
				{{ csrf_field() }}
				<div class="form-group">
					<label>Category Name <span class="red">*</span></label>
					<input type="hidden" class="form-control" id="edit_id" name="id" value="">
					<input type="text" class="form-control" id="edit_name" name="category_name" value="">
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn150">Edit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Delete -->
<div id="delete" class="full-pop">
	<div class="pad-pop">
		<div class="title-pop">DELETE</div>
		<div class="img-pop">
			<div class="pop-delete"></div>
		</div>
		<div class="text-center">
			<div class="inline">
				<form method="post" action="{{ url('/administratoronly/commerce/store/category/delete') }}">
					{{ csrf_field() }}
						<input type="hidden" class="form-control" id="delete_id" name="id" value="">
						<input type="submit" class="btn btn-sure" value="submit"/>
				</form>
			</div>
			<div class="inline">
				<button class="btn btn-cancel">No</button>
			</div>
		</div>
	</div>
</div>
@stop
@section('script')
<script>
$(function() {
	$('#product > ul.submenu').addClass ('open');
	$('li#product').addClass ('open');
	$('#category').addClass ('active');
});
$('#table_id').dataTable( {
	"order": [[ 0, 'asc' ]]
} );

function edit_category(id,name)
{
	$('#edit_id').val(id);
	$('#edit_name').val(name);
	$('.open-box').addClass('animate-open');
}

function delete_category(id)
{
	$('#delete_id').val(id);
}

	$(function() {
		$(document).ready(function() {
			$('#store > ul.submenu').addClass ('open');
			$('li#store').addClass ('open');
			$('#category').addClass ('active');
			$('.edit').click(function(){
				var id			=$(this).attr('data-id');
				var name		=$(this).attr('data-name');
				$('#edit_id').val(id);
				$('#edit_name').val(name);
			});

			$('.delete').click(function(){
				var id=$(this).attr('data-id');
				$('#delete_id').val(id);
			});

		});
	});
</script>
@stop
