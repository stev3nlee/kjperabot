@extends('administratoronly.layout')
@section('content')

	<style type="text/css">
		.select2 { border-radius: 0; display: block; width: 100%; height: 35px; padding: 2px 10px; font-size: 14px; line-height: 2; background-color: #fff; background-image: none;	border: 1px solid #d0d0d0; position: relative; color: #4c4c4c; }
		input { outline: none; }
		select { outline: none; }
		select:active, select:hover { outline:none; }
		.select2-drop-active { border: none; !important; outline:none; !important; }
		.select2-drop.select2-drop-above.select2-drop-active { border-top: none; !important; }
		.select2-container-active .select2-choice, .select2-container-active .select2-choices { border: none; !important; outline: none !important;	}
		.select2-selection__rendered { border: none; !important; outline: none !important; }
	</style>

	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Website</a><span class="m10"> > </span><span class="active">Newsletter</span>
				</div>
				<div class="title">Emails</div>
				<div class="adminTable">
					@include('errorfile')
					<table id="table_id">
						<thead>
							<tr>
								<td>No</td>
								<td>Email Address</td>
								<td class="text-center">Action</td>
							</tr>
						</thead>
						<tbody>
							@foreach($subscribers as $subscriber)
							 <tr>
								<td width="60">{{ $loop->index+1 }}</td>
								<td>{{ $subscriber->email }}</td>
								<td width="150" class="text-center">
									<a class="fancybox" href="#deleteGallery">
										<div class="img-delete deleteClick" onclick="setdata({{$subscriber->id}})"></div>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot></tfoot>
					</table>
				</div>
				<div class="border-line"></div>
				<div class="title">Newsletter</div>
					<form method="post" action="{{ url('administratoronly/website/newsletter/send') }}"  enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label>To <span class="red">*</span></label>
							<select class="custom-select form-control" name="to" onchange="custom_select(this)">
								<option value="1">All Subscribers</option>
								<option value="2">Preview testing to me</option>
							</select>
						</div>
						<div class="form-group">
								<div class="form-group">
									<label>Thumbnail :</label>
									<input type="file" id="btnAddUpload" name="image">
									<div class="mt5">Tipe File : jpg, jpeg, gif, png</div>
									<div>Pic Resolution : 1440 x 650 pixels</div>
									<div>Maximum File Size : 1MB</div>
								</div>
						</div>
						<div class="form-group">
							<label>Campaign Name <span class="red">*</span></label>
							<input type="text" required class="form-control" name="campaign_name" value="{{old('campaign_name')}}" />
						</div>
						<div class="form-group">
							<label>Template <span class="red">*</span></label>
							<textarea id="mceFixed" name="template">{{old('template')}}</textarea>
						</div>
						<div class="form-group">
							<input type="checkbox" class="check" name="hide_product" value="1">
							<span class="">Hide Product </span>
						</div>
						<div class="show-product">
							<div class="title">Products (Max 6 only)</div>
							<div class="clearfix">
								<div class="row">
									<div class="wdth50">
										<div class="form-group">
											<label>Products 1</label>
											<select class="form-control select2" name="products[]">
												@foreach($products as $product)
												<option value="{{ $product->id }}">{{$product->product_name}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="wdth50">
										<div class="form-group">
											<label>Products 2</label>
											<select class="form-control select2" name="products[]">
												@foreach($products as $product)
												<option value="{{ $product->id }}">{{$product->product_name}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="wdth50">
										<div class="form-group">
											<label>Products 3</label>
											<select class="form-control select2" name="products[]">
												@foreach($products as $product)
												<option value="{{ $product->id }}">{{$product->product_name}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="wdth50">
										<div class="form-group">
											<label>Products 4</label>
											<select class="form-control select2" name="products[]">
												@foreach($products as $product)
												<option value="{{ $product->id }}">{{$product->product_name}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="wdth50">
										<div class="form-group">
											<label>Products 5</label>
											<select class="form-control select2" name="products[]">
												@foreach($products as $product)
												<option value="{{ $product->id }}">{{$product->product_name}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="wdth50">
										<div class="form-group">
											<label>Products 6</label>
											<select class="form-control select2" name="products[]">
												@foreach($products as $product)
												<option value="{{ $product->id }}">{{$product->product_name}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<input type="submit" class="btn btn-pop" value="send"/>
					</form>
				</div>
			</div>

			<!-- DELETE -->
			<div id="deleteGallery" class="width-pop">
				<div class="pad-pop">
					<div class="title-pop">DELETE</div>
					<div class="img-pop">
						<div class="pop-delete"></div>
					</div>
					 <div class="text-center">
						<form action="{{ url('administratoronly/website/newsletter/unsubscribe') }}" method="post">
							{{ csrf_field() }}
							<input type="hidden" required name="id" id="deleteId"/>
							<div class="inline">
								<button class="btn btn-sure">Yes</button>
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
	$('#newsletter').addClass ('active');
});
$('#table_id').dataTable( {
	"order": [[ 0, 'asc' ]]
} );

	function setdata(id)
	{
		$("#deleteId").val(id);
	}

	$('input[name="show-product"]').click(function() {
		if ($(this).is(":checked")) $(".show-product").stop(true, true).slideUp(); else $(".show-product").stop(true, true).slideDown();
	});
</script>
@stop
