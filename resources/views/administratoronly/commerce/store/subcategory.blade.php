@extends('administratoronly.layout')
@section('content')
	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Commerce</a><span class="m10"> > </span><a href="{{url('/administratoronly/commerce/store/category')}}"/>Category</a><span class="m10"> > </span><a class="active">View Subcategory</a>
				</div>

				<div class="clearfix">
					<div class="pull-left">
						<div class="title">Sub Category : {{$subcategories[0]->category->category_name}}</div>
					</div>
					<div class="pull-right">
						<a class="click-box2"><button type="button" class="btn btn-auto">Add</button></a>
					</div>
				</div>
				<div class="adminTable">
					@include('errorfile')
					<table id="table_id">
						<thead>
							<tr>
								<td width="50">No</td>
								<td>Subcategory Name</td>
								<td>Category Name</td>
								<td width="200">
									<div class="text-center">Action</div>
								</td>
							</tr>
						</thead>
						<tbody>
							@foreach($subcategories as $subcategory)
							<tr>
								<td>{{ $loop->index+1 }}</td>
								<td>{{ $subcategory->subcategory_name }}</td>
								<td>{{ $subcategory->category->category_name }}</td>
								<td class="text-center">
									<a class="click-box edit" onclick="edit_category({{$subcategory->id}},'{{$subcategory->subcategory_name}}',{{$subcategory->category_id}})" data-id="{{$subcategory->id}}" data-category-id="{{$subcategory->category_id}}" data-name="{{$subcategory->subcategory_name}}"><div class="img-edit"></div></a>
									<a class="fancybox delete" onclick="delete_category({{$subcategory->id}})" data-id="{{$subcategory->id}}" href="#delete"><div class="img-delete"></div></a>
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
			<form method="post" action="{{ url('/administratoronly/commerce/store/subcategory/save') }}">
				{{ csrf_field() }}
				<div class="form-group">
					<label class="width500">Category <span class="red">*</span></label>
					<select class="form-control select-category" id="services" name="category" style="margin-bottom:5px;">
						@foreach($categories as $category)
						<option value="{{ $category->id }}">{{ $category->category_name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>Sub Category Name <span class="red">*</span></label>
					<input type="text" class="form-control" name="subcategory_name">
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
			<form method="post" action="{{ url('/administratoronly/commerce/store/subcategory/edit') }}">
				{{ csrf_field() }}
				<input type="hidden" class="form-control" id="editId" name="id" value="{{ url('/administratoronly/commerce/store/subcategory/edit') }}">
				<div class="form-group">
					<label class="width500">Category <span class="red">*</span></label>
					<select class="form-control select-category" id="editCategory" name="category" style="margin-bottom:5px;">
						@foreach($categories as $category)
						<option value="{{ $category->id }}">{{ $category->category_name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>Sub Category Name <span class="red">*</span></label>
					<input type="text" class="form-control" id="editName" name="subcategory_name" value="">
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
				<form method="post" action="{{ url('/administratoronly/commerce/store/subcategory/delete') }}">
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

function edit_category(id,name,category_id)
{
	$('#editId').val(id);
	$('#editName').val(name);
	$('#editCategory').val(category_id);
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
				var category=$(this).attr('data-category-id');
				$('#editId').val(id);
				$('#editName').val(name);
				$('#editCategory').val(category);
			});

			$('.delete').click(function(){
				var id=$(this).attr('data-id');
				$('#delete_id').val(id);
			});

		});
	});
</script>
@stop
