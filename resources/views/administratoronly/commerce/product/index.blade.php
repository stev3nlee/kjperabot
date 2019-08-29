@extends('administratoronly.layout')
@section('content')
	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Commerce</a><span class="m10"> > </span><a class="active">Product List</a>
				</div>
				<div class="clearfix">
					<div class="pull-left">
						<div class="title">Product List</div>
					</div>
					<div class="pull-right">
						<a href="{{ url('/administratoronly/commerce/product/add') }}"><button type="button" class="btn btn-auto">Add</button></a>
					</div>
				</div>
				@include('errorfile')
				<div class="adminTable">
					<table id="table_id">
						<thead>
							<tr>
								<td width="60">No</td>
								<td width="200">Product Name</td>
								<td width="200">Image</td>
								<td width="200">Category</td>
								<td width="150">
									<div class="text-center">Action</div>
								</td>
							</tr>
						</thead>
						<tbody>
							@foreach($products as $product)
							<tr>
								<td>{{ $loop->index+1 }}</td>
								<td class="product_name">{{ $product->product_name }}</td>
								<td>
									<div class="w100">
										<img src="{{ asset(explode("::",$product->image_path)[0]) }}" height="80" width="130" class="image-responsive"/>
									</div>
								</td>
								<td>{{ $product->subcategory->category->category_name }}</td>
								<td class="text-center">
									<a href="{{ url('/administratoronly/commerce/product/view/'.$product->id) }}">
										<div class="img-view"></div>
									</a>
									<a href="{{ url('/administratoronly/commerce/product/edit/'.$product->id) }}">
										<div class="img-edit"></div>
									</a>
									<a class="fancybox btn_del" data-id="{{ $product->id }}" href="#delete"><div class="img-delete"></div></a>
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

<!-- Delete -->
<div id="delete" class="full-pop">
	<div class="pad-pop">
		<div class="title-pop">DELETE</div>
		<div class="img-pop">
			<div class="pop-delete"></div>
		</div>
		<div class="text-center">
			<div class="inline">
				<form name="frmProduct" method="post" action="{{ url('administratoronly/commerce/product/delete') }}">
					{{ csrf_field() }}
					<input type="hidden" value="" id="delete_product" name="id">
					<button class="btn btn-sure">Yes</button>
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
	$(document).ready(function() {
		$('#commerce > ul.submenu').addClass ('open');
		$('li#commerce').addClass ('open');
		$('#product').addClass ('active');
	});
});
$('.btn_del').click(function(){
	$('#delete_product').val($(this).attr('data-id'));
})
</script>
@stop
