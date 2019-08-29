@extends('administratoronly/layout')
@section('content')
	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Website</a><span class="m10"> > </span><span class="active">Slider</span>
				</div>
				<div class="clearfix">
					<div class="pull-left">
						<div class="title">Slider List</div>
					</div>
					<div class="pull-right">
						<a class="click-box2"><button type="button" class="btn btn-auto">Add</button></a>
					</div>
				</div>
				@include('errorfile')
				<div class="table-role">
					{{ csrf_field() }}
					<table>
						<thead>
							<tr>
								<td width="50"> No </td>
								<td>Banner</td>
								<td width="150"><div class="text-center">Action</div></td>
							</tr>
						</thead>
						<tbody>
							@foreach($sliders as $slider)
							<tr>
								<td> {{ $loop->index + 1 }} </td>
								<td> <img src="{{ asset($slider->image_path) }}" class="img-responsive" width="250" height="300"> </td>
								<td class="text-center">
									<a class="click-box edit" data-id="{{$slider->id}}" data-image="{{$slider->image_path}}"><div class="img-edit"></div></a>
									<a class="fancybox delete" data-id="{{$slider->id}}" href="#delete"><div class="img-delete"></div></a>
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
			<form method="post" action="{{ url('administratoronly/website/slider/add') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group">
					<label>Upload Image <span class="red">*</span></label>
					<input type="file" name="image">
					<div class="mt5">Tipe File : jpg, jpeg, gif, png</div>
					<div>Maximum File Size : 1MB</div>
					<div>Pic Resolution : 1440 x 600 pixels</div>
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
			<form method="post" action="{{ url('administratoronly/website/slider/edit') }}" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="form-group">
					<div id="editImage">
					</div>
					<input type="hidden" class="form-control" id="editId" name="id" value="">
					<label>Upload Image <span class="red">*</span></label>
					<input type="file" name="image">
					<div class="mt5">Tipe File : jpg, jpeg, gif, png</div>
					<div>Maximum File Size : 1MB</div>
					<div>Pic Resolution : 1200 x 450 pixels</div>
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
				<form method="post" action="{{ url('administratoronly/website/slider/delete') }}">
					{{csrf_field()}}
						<input type="hidden" class="form-control" id="deleteId" name="id" value="">
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
	$('#slider').addClass ('active');
});

$(".edit").click(function(){
	var id = $(this).attr('data-id');
	var image = '{{url("/")}}'+'/'+$(this).attr('data-image');
	$('#editId').val(id);
	$('#editImage').empty();
	$('#editImage').prepend('<img id="theImg" height="160px" width="300px" src="'+image+'" />');
});

$(".delete").click(function(){
	var id = $(this).attr('data-id');
	$('#deleteId').val(id);
});
</script>
@stop
