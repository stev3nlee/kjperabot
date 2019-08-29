@extends('administratoronly.layout')
@section('content')
<div class="clearfix">
	@include('administratoronly/menu')
	<div class="box-right">
		<div class="content">
			<div class="breadcrumb">
				<a>Commerce</a><span class="m10"> > </span><a>Store</a><span class="m10"> > </span><a href="{{ url('/administratoronly/commerce/product') }}">Product</a><span class="m10"> > </span><a class="active">Edit Product</a>
			</div>
			<div class="title">Edit Product</div>
			<div class="row clearfix">
				@include('errorfile')
				<form method="post" action="{{url('/administratoronly/commerce/product/edit/'.$product->id.'/save')}}" enctype="multipart/form-data">
					{{csrf_field()}}
					<input type="hidden" name="id" value="{{$product->id}}"/>
					<div class="wdth50">
						<div class="form-group">
							<label>Category <span class="red">*</span></label>
							<select class="custom-select form-control" id="select_category" name="category" onchange="custom_select(this)">
								@foreach($categories as $category)
								<option value="{{$category->id}}" @if($category->id == $product->category_id) selected @endif>{{ $category->category_name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Sub Category <span class="red">*</span></label>
							<select class="custom-select form-control" name="subcategory" id="select_subcategory" onchange="custom_select(this)">
								<option value="0">--- Please Select Sub Categoy ---</option>
								@foreach($subcategories as $subcategory)
								<option value="{{ $subcategory->id }}" class="option_subcategory {{ $subcategory->category_id }}" @if($subcategory->id == $product->subcategory_id) selected @endif>{{ $subcategory->subcategory_name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Product Code <span class="red">*</span></label>
							<input type="text" class="form-control" name="product_code" value="{{$product->product_code}}"/>
						</div>
						<div class="form-group">
							<label>Product Name <span class="red">*</span></label>
							<input type="text" class="form-control" name="product_name" value="{{$product->product_name}}"/>
						</div>
						<div class="clearfix mb30">
							<div class="display-inline mr10">
								<label>Price</label>
								<div class="clearfix">
									<div class="display-inline mr10">
										<div style="height: 30px; margin: auto 0;">
											<div class="tbl">
												<div class="cell">IDR</div>
											</div>
										</div>
									</div>
									<div class="display-inline">
										<input type="text" class="form-control" id="price" maxlength="9" name="price"  onkeyup="calculate()" value="{{ $product->product_price }}" style="width:150px;" />
									</div>
								</div>
							</div>
							<div class="display-inline mr10">
								<label>Sale</label>
								<div class="clearfix">
									<div class="display-inline mr10" style="width: 50px;">
										<input type="text" class="form-control" id="discount" maxlength="3" name="sale" onkeyup="calculate()" value="{{ $product->sale }}" style="width:50px;" />
									</div>
									<div class="display-inline">
										<div style="height: 30px; margin: auto 0;">
											<div class="tbl">
												<div class="cell">%</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="display-inline">
								<label>Final Price</label>
								<div class="clearfix">
									<div class="display-inline mr10">
										<div style="height: 30px; margin: auto 0;">
											<div class="tbl">
												<div class="cell">IDR</div>
											</div>
										</div>
									</div>
									<div class="display-inline">
										<input type="text" class="form-control" maxlength="9" id="total_price" name="totalPrice" disabled value="{{$product->product_price-($product->product_price*$product->sale/100)}}" style="width:150px;" />
									</div>
								</div>
							</div>
							<br />
							<div class="clearfix mb30">
								<div class="display-inline mr10">
									<label>Weight</label>
									<div class="clearfix">
										<div class="display-inline">
											<input type="text" class="form-control txtboxToFilter price" id="price" name="weight" value="{{ $product->weight }}" style="width:150px;" />
										</div>
										<div class="display-inline mr10">
											<div style="height: 30px; margin: auto 0;">
												<div class="tbl">
													<div class="cell">KG <span class="red">*</span></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<div style="margin-top:30px;">
								@foreach(explode("::",$product->image_path) as $image)
									@if($image!="")
								<img src="{{asset($image)}}" height="90" width="120">
								@endif
								@endforeach
								<div class="form-group">
									<label>Images <span class="red">*</span></label>
									<input type="file" class="btn_image"  name="image[]" multiple>
									<div class="mt5">Tipe File : jpg, jpeg, gif, png</div>
									<div>Pic Resolution : 600 x 1020 pixels</div>
									<div>Maximum File Size : 1MB</div>
								</div>
							</div>
						</div>
						<div>
							<a href="{{ url('/administratoronly/commerce/product') }}"><button type="button" class="btn btn-pop mr10">Back</button></a>
							<input type="submit" class="btn btn-pop" value="Submit">
						</div>
					</div>

					<div class="wdth50">
						<div class="form-group mb30">
							<label>Product Description <span class="red">*</span></label>
							<textarea id="mceFixed" name="product_description">{{$product->product_description}}</textarea>
						</div>
					</div>
				</form>
			</div>
			<div class="border-line"></div>
			<div>
				<div class="title"> Details </div>
				<div class="form-group color_group">

				</div>
				<div id="errmessage"></div>
				@include('errorfile')
				<form method="post" action="{{ url('/administratoronly/commerce/product/edit/'.$product->id.'/addcolor') }}">
					{{csrf_field()}}
					<input type="hidden" name="id" value="{{$product->id}}"/>
					<input type="submit" class="btn btn-small add-colour" style="width:180px" value="Add new color"/>
				</form>
				<form  method="post" action="{{ url('administratoronly/commerce/product/edit/'.$product->id.'/editdetail') }}">
				{{csrf_field()}}
				<table class="table">
					<thead>
						<tr>
							<th>Color</th>
							<th>Stock</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
							@foreach($product->product_details as $product_detail)
							<tr id="{{$product_detail->product_detail_id}}">
								<td>
									<input type="hidden" name="product_detail_id[]" value="{{$product_detail->id}}"/>
									<input type="text" class="form-control input-color-{{str_slug($product_detail->color,'-')}}" name="color[]" style="width: 100px;" value="{{$product_detail->color}}"/>
								</td>
								<td><input type="text" class="form-control current_stock" name="stock[]" value="{{$product_detail->stock}}" style="width: 50px;"></td>
								<td>
										<a class="fancybox btn-delete-color" data-id="{{ $product_detail->id }}" href="#delete">
											<input type="button" class="btn btn-small add-colour" style="width:80px" data-id="{{ $product_detail->id }}" value="Delete"/>
										</a>
								</td>
							</tr>
							@endforeach
					</tbody>
					<tfooter>
						<tr>
							<td colspan="2"><input type="submit" class="btn btn-small" style="width:100px" value="save"></td>
							</td>
						</tr>
					</tfooter>
				</table>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="delete" class="full-pop">
	<div class="pad-pop">
		<div class="title-pop">DELETE</div>
		<div class="img-pop">
			<div class="pop-delete"></div>
		</div>
		<div class="text-center">
			<div class="inline">
				<form name="frmProduct" method="post" action="{{ url('administratoronly/commerce/product/edit/'.$product->id.'/deletecolor') }}">
					{{ csrf_field() }}
					<input type="hidden" value="" id="deleteId" name="id">
					<input type="submit" class="btn btn-sure" value="Yes"/>
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

$(document).ready(function(){
$('.box-generate').show();

var value=$('#select_category').val();
$('.option_subcategory').hide();
$('.'+value).show();

$('#select_category').on('change',function(){
	var value=$('#select_category').val();
	$('.option_subcategory').hide();
	$('#select_subcategory').val(0);
	$('.'+value).show();
})
})
$(function() {
	$('#store > ul.submenu').addClass ('open');
	$('li#store').addClass ('open');
	$('#product').addClass ('active');
});
$('.btn-delete-color').click(function(){
	$('#deleteId').val($(this).attr('data-id'));
});

function calculate()
{
	var price = $('#price').val();
	var total_price = price -( price * $('#discount').val()/100 ) ;
	$('#total_price').val(total_price);
}
</script>
@stop
