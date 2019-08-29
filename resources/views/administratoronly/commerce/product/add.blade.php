@extends('administratoronly.layout')
@section('content')
	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Commerce</a><span class="m10"> > </span><a href="{{ url('/administratoronly/commerce/product') }}">Product List</a> > </span><a class="active">Add Product</a>
				</div>
				<div class="title">Add Product</div>
				@include('errorfile')
				<form method="post" action="{{ url('/administratoronly/commerce/product/add/save') }}" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="row clearfix">
						<div class="wdth50">
							<div class="form-group">
								<label>Category <span class="red">*</span></label>
								<select class="custom-select form-control" name="category"  id='select_category'>
									<option value="0" disabled selected>--- Please Select Category ---</option>
									@foreach($categories as $category)
									<option value="{{ $category->id }}" @if(old('category') == $category->id) selected  @endif>{{ $category->category_name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Subcategory <span class="red">*</span></label>
								<select class="custom-select form-control" name="subcategory"  id='select_subcategory'>
									<option value="0" disabled selected>--- Please Select Subcategory ---</option>
									@foreach($subcategories as $subcategory)
									<option value="{{ $subcategory->id }}" class="subcategories subcategory-category-{{$subcategory->category_id}}" @if(old('subcategory') == $subcategory->id) selected @endif @if(old('category') != $subcategory->category_id) style="display:none" @endif>{{ $subcategory->subcategory_name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Product Code <span class="red">*</span></label>
								<input type="text" class="form-control" name="product_code" value="{{ old('product_code') }}"/>
							</div>
							<div class="form-group">
								<label>Product Name <span class="red">*</span></label>
								<input type="text" class="form-control" name="product_name" value="{{ old('product_name') }}"/>
							</div>
							<div class="clearfix mb30">
								<div class="display-inline mr10">
									<label>Price</label>
									<div class="clearfix">
										<div class="display-inline mr10">
											<div style="height: 30px; margin: auto 0;">
												<div class="tbl">
													<div class="cell">IDR <span class="red">*</span></div>
												</div>
											</div>
										</div>
										<div class="display-inline">
											<input type="text" class="form-control txtboxToFilter price" id="price" maxlength="12" name="price" value="{{ old('price') }}" onkeyup="calculate()" style="width:150px;" />
										</div>
									</div>
								</div>
								<div class="display-inline mr10">
									<label>Sale</label>
									<div class="clearfix">
										<div class="display-inline mr10" style="width: 50px;">
											<input type="text" class="form-control txtboxToFilter discount" id="discount" maxlength="3" name="sale" onkeyup="calculate()" value="{{ old('sale') }}" style="width:50px;" />
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
											<input type="text" class="form-control" id="total_price" maxlength="9" name="total_price" disabled value="{{ old('total_price') }}" style="width:150px;" />
										</div>
									</div>
								</div>
							</div>
							<div class="clearfix mb30">
								<div class="display-inline mr10">
									<label>Weight</label>
									<div class="clearfix">
										<div class="display-inline">
											<input type="text" class="form-control txtboxToFilter price" id="price" name="weight" value="{{ old('weight') }}" style="width:150px;" />
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
							<div class="input_colour form-group">
								<div class="display-inline mr10"><button class="btn btn-small add-colour" type="button">Add</button></div>
								<div class="display-inline pos-det mr10">Colour <span class="red">*</span></div>
							</div>
							<div class="form-group">
								<div class="display-inline"><button type="button" class="btn btn-small" id="generateDetailClick">Generate</button></div>
							</div>
						</div>
						<div class="wdth50">
							<div class="form-group mb30">
								<label>Product Description <span class="red">*</span></label>
								<textarea id="mceFixed" name="product_description">{{old('product_description')}}</textarea>
							</div>
						</div>
					</div>
					<div class="generate">
						<div class="box-generate">
						</div>
						<div class="form-inline">
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
						<a href=""><button type="button" class="btn btn-pop mr10">Back</button></a>
						<input type="submit" class="btn btn-pop" value="Submit">
					</div>
				</form>
			</div>
		</div>
	</div>
@stop
@section('script')
<script>
$(function() {
	$('#store > ul.submenu').addClass ('open');
	$('li#store').addClass ('open');
	$('#product').addClass ('active');

	// Add Colour
	var max_colour      = 10;
  var incolor         = $(".input_colour");
  var add_colour      = $(".add-colour");

  var y = 0;
  $(add_colour).click(function(e){
      e.preventDefault();
      if(y < max_colour){
          y++;
          $(incolor).append('<div class="display-inline mr10 mb30"> <input type="text" name="" class="form-control div_color" id="div_color'+(y-1)+'" style="width: 100px;"/><div class="inline-block del-colour"></div></div>'); //add input box
      }
  });

  $(incolor).on("click",".del-colour", function(e){
      e.preventDefault(); $(this).parent('div').remove(); x--;
  });

	function validate_generate()
	{
		var i =0;
		$('.div_color').each(function(){
			if ($(this).val() === "") {
            i+=1;
      }
		})
		return i;
	}

	$('#generateDetailClick').click(function(){
		var totalBox = $('.box-generate').length;
		if(validate_generate() > 0)
		{
			alert('Color Cannot Empty');
			return;
		}
		$('.box-generate').empty();
		var sizeandstock='';
		for(i=0; i < y ; i++)
		{
			sizeandstock+='<div class="box-generate mb20 color-stock-'+$('#div_color'+i).val()+'">';
			sizeandstock+='	<div class="form-inline"><label>Product Color : '+$('#div_color'+i).val()+'</label><input type="hidden" name="color[]" value="'+$('#div_color'+i).val()+'"/></div>'
			sizeandstock+='	<div class="SizeAndStock">';
			sizeandstock+='		<div class="form-inline mr20">';
			sizeandstock+='			<div class="mr10 pos-det">Stock <span class="red">*</span> : <input type="text" required="" id="txtboxToFilter" class="form-control" maxlength="4" name="stock[]" value="" style="width: 50px;"></div>';
			sizeandstock+='		</div>';
			sizeandstock+='	</div>';
			sizeandstock+='</div>';
		}

		$('.box-generate').append(sizeandstock);
		$('.box-generate').show();
	});
});

$(document).ready(function(){
	$('.subcategories').hide();

	$('#select_category').on('change',function(){
		var value=$(this).val();
		$('.subcategories').hide();
		$('#select_subcategory').val(0);
		$('.subcategory-category-'+value).show();
	})
});

function calculate()
{
	var price = $('#price').val();
	var total_price = price -( price * $('#discount').val() / 100 ) ;
	$('#total_price').val(total_price);
}
</script>
@stop
