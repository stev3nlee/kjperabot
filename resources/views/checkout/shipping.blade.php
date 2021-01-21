@extends('layout3')

@section('content')

	<div class="home-new-product content">
		<div class="container">
			<div class="checkout">
				<div class="row">
          @include('errorfile')
					<div class="col-md-7 col-sm-7 col-xs-12">
						<div class="title"> Alamat Pengiriman </div>
						<form method="post" action="{{url('checkout/payment')}}" id="frm-checkout">
              {{csrf_field()}}
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Nama <span class="red">*</span></label>
										<input type="text" class="form-control" name="nama_depan" value="{{ $user->first_name }}" />
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="form-group mt27">
										<input type="text" class="form-control" name="nama_belakang" value="{{ $user->last_name }}" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Email <span class="red">*</span></label>
										<input type="text" class="form-control" name="email" value="{{ $user->email }}" />
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Nomor Telepon <span class="red">*</span></label>
										<input type="text" id="txtboxToFilter" class="form-control" name="nomor_telepon" value="{{ $user->phone }}" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="form-group">
										<label>Provinsi <span class="red">*</span></label>
										<div class="custom-select">
											<div class="replacement form-control">{{ ($user->province_id != null ? $provinces->where('id',(int)$user->province_id)->first()->province_name : "") }}</div>
											<select class="custom-select form-control" name="provinsi" id="select-province-shipping" onChange="custom_select(this)">
                        @foreach($provinces as $province)
												<option value="{{ $province->id }}" @if($province->id == $user->province_id) selected @endif>{{ $province->province_name }}</option>
                        @endforeach
											</select>
										</div>
									</div>
								</div>
								{{--
								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="form-group">
										<label>Kota <span class="red">*</span></label>
										<div class="custom-select">
											<div class="replacement form-control">{{ ($user->city_id != null ? $cities->where('id',(int)$user->city_id)->first()->city_name : "") }}</div>
											<select class="custom-select form-control" id="select-city-shipping" name="kota" onChange="custom_select(this)">
												<option value="0"></option>
                        @foreach($cities as $city)
												<option value="{{ $city->id }}" @if($city->id == $user->city_id) selected @endif class="city-province-{{$city->province_id}}">{{ $city->city_name }}</option>
                        @endforeach
											</select>
										</div>
									</div>
								</div>
								--}}
                <div class="col-md-4 col-sm-4 col-xs-12">
									<div class="form-group shipping_district">
										<label>Kota <span class="red">*</span></label>
										<input class="typeahead form-control" id="jne-shipping-label" name="kota_shipping" type="text" placeholder="" autocomplete="off">
										<input id="jne-shipping-code" name="jne_shipping_code" type="hidden">

										{{--
										<div class="custom-select">
											<div class="replacement form-control">{{ ($user->district_id != null ? $districts->where('id',(int)$user->district_id)->first()->district_name : "") }}</div>
											<select class="custom-select form-control" name="kecamatan" onChange="custom_select(this)">
                        <option value="0" data-reg="0" data-yes="0"></option>
                        @foreach($districts as $district)
												<option value="{{ $district->id }}" @if($district->id == $user->district_id) selected @endif data-reg="{{$district->reg}}" data-oke="{{$district->oke}}">{{ $district->district_name }}</option>
                        @endforeach
											</select>
										</div>

                    <script>
                    $('#shipping_district').change(function(){
                      var val = $('input[name="shipping"]:checked').val();
                      if(val==1){
                        var value = $('option:selected', this).attr('data-reg');
                      }else{
                        var value = $('option:selected', this).attr('data-oke');
                      }
                      $('#shipping_value').html(value);
                      calculate_shipping()
                    });
                    </script>
										--}}
									</div>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="form-group">
										<label>Kode Pos <span class="red">*</span></label>
										<input type="text" class="form-control" name="kode_pos" value="{{ $user->post_code }}" />
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Alamat <span class="red">*</span></label>
								<textarea class="form-control" name="alamat"> {!! $user->address !!} </textarea>
							</div>
							<div class="form-group">
								<label>Catatan </label>
								<textarea class="form-control" name="catatan" placeholder="Catatan tambahan"> </textarea>
							</div>

							<div class="clearfix mt50">
								<div class="pull-left">
									<div class="title"> Alamat Billing </div>
								</div>
								<div class="pull-right">
									<div class="option-check checkout">
										<input class="labeled-checkbox check-title" name="same_address" type="checkbox" id="labeled-bill" value="1">
										<label for="labeled-bill">
											<span class="labeled-checkbox-unchecked"></span>
											<span class="labeled-checkbox-checked"></span>
											<span class="tick-address">Sama dengan alamat pengiriman</span>
										</label>
									</div>
								</div>
							</div>

							<div class="same_address"  style="display:none;">
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label>Nama <span class="red">*</span></label>
											<input type="text" class="form-control" name="nama_depan_billing" value="{{$user->first_name}}" />
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group mt27">
											<input type="text" class="form-control" name="nama_belakang_billing" value="{{$user->last_name}}" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label>Email <span class="red">*</span></label>
											<input type="text" class="form-control" name="email_billing" value="{{$user->email}}" />
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label>Nomor Telepon <span class="red">*</span></label>
											<input type="text" id="txtboxToFilter" class="form-control" name="nomor_telepon_billing" value="{{$user->phone}}" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-sm-4 col-xs-12">
										<div class="form-group">
											<label>Provinsi <span class="red">*</span></label>
											<div class="custom-select">
												<div class="replacement form-control">{{ ($user->province_id != null ? $provinces->where('id',$user->province_id)->first()->province_name : "") }}</div>
												<select class="custom-select form-control" name="provinsi_billing" id="select-province-billing" onChange="custom_select(this)">
                          @foreach($provinces as $province)
  												<option value="{{ $province->id }}" @if($province->id == $user->province_id) selected @endif>{{ $province->province_name }}</option>
                          @endforeach
												</select>
											</div>
										</div>
									</div>
									{{--
									<div class="col-md-4 col-sm-4 col-xs-12">
										<div class="form-group">
											<label>Kota <span class="red">*</span></label>
											<div class="custom-select">
												<div class="replacement form-control">{{ ($user->city_id != null ? $cities->where('id',$user->city_id)->first()->city_name : "") }}</div>
												<select class="custom-select form-control" name="kota_billing" id="select-city-billing" onChange="custom_select(this)">
													<option value="0"></option>
                          @foreach($cities as $city)
  												<option value="{{ $city->id }}" @if($city->id == $user->city_id) selected @endif class="city-province-billing-{{$city->province_id}}">{{ $city->city_name }}</option>
                          @endforeach
												</select>
											</div>
										</div>
									</div>
									--}}
                  <div class="col-md-4 col-sm-4 col-xs-12">
  									<div class="form-group billing_district">
  										<label>Kota <span class="red">*</span></label>
											<input class="typeahead form-control" id="jne-billing-label" name="kota_billing" type="text" placeholder="" autocomplete="off">
											<input id="jne-billing-code" name="jne_billing_code" type="hidden">
											{{--
  										<div class="custom-select">
  											<div class="replacement form-control">{{ ($user->district_id != null ? $districts->where('id',$user->district_id)->first()->district_name : "") }}</div>
  											<select class="custom-select form-control" name="kecamatan_billing" onChange="custom_select(this)">
                          @foreach($districts as $district)
  												<option value="{{ $district->id }}" @if($district->id == $user->district_id) selected @endif>{{ $district->district_name }}</option>
                          @endforeach
  											</select>
  										</div>
											--}}
  									</div>
  								</div>

									<div class="col-md-4 col-sm-4 col-xs-12">
										<div class="form-group">
											<label>Kode pos <span class="red">*</span></label>
											<input type="text" class="form-control" name="kode_pos_billing" value="{{ $user->post_code }}" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Alamat <span class="red">*</span></label>
									<textarea class="form-control" name="alamat_billing">{{$user->address}}</textarea>
								</div>
							</div>
							<div class="mt50" id='div-metode-pengiriman'></div>
							<div class="mt90 hidden-xs">
								<span class=""> <input type="button" class="btn btn-checkout btn-submit" value="LANJUT">
							</div>
							@php $weight=0; @endphp
							@foreach($carts as $cart)
								@php $weight+=$cart->weight * $cart->qty; @endphp
							@endforeach
							<input type="hidden" name="weight" value="{{$weight}}">
						</form>
					</div>
					<div class="col-md-5 col-sm-5 col-xs-12">
						<div class="title summary"> Ringkasan </div>
						<div id="order-item" class="data-table detail-order">
              @php $subtotal = 0; @endphp
              @foreach($carts as $cart)
                @php $price = ($cart->sale_price == 0 ? $cart->product_price : $cart->sale_price); @endphp
							<div class="list items">
								<div class="w100">
									<img src="{{ asset(explode("::",$cart->image_path)[0]) }}" class="img-responsive" />
								</div>
								<div class="in">
									<div>
										<div class="cart-header">{{ $cart->product_name }}</div>
										<div class="cart-color">Warna : {{ $cart->color }}</div>
										<div class="cart-color">Berat : {{ $cart->weight * $cart->qty }} KG</div>

									</div>
									<div class="summary-cart">
										<div class="cart-price">Quantity: {{ $cart->qty }}</div>
										<div class="cart-price">Rp. {{ number_format($price * $cart->qty) }}</div>
									</div>
								</div>
							</div>
              @php $subtotal += $price * $cart->qty @endphp
              @endforeach
						</div>
						<div class="row summary-cart-info">
							<div class="col-sm-6 col-md-6 col-xs-6">
								<div> Subtotal </div>
								@if($company->tax_vat > 0)
								<div> Tax </div>
								@endif
								<div> Shipping </div>
								<!--<div> Discount </div>-->
								<div class="total-cart"> TOTAL </div>
							</div>
							<div class="col-sm-6 col-md-6 col-xs-6">
                @php $shipping=0; $tax=$company->tax_vat * $subtotal /100; @endphp
								<div> Rp. <span id="subtotal_value">{{ number_format($subtotal) }} </div>
								@if($company->tax_vat > 0)
								<div> Rp. <span id="tax_value">{{ number_format($tax) }} </div>
								@endif
								<div> Rp. <span id="shipping_value">{{ number_format($shipping) }}</span> </div>
								<!--<div> Rp. 100.000 </div>-->
								<div class="total-cart"> Rp. <span id="grandtotal">{{ number_format($subtotal + $tax + $shipping ) }}</span></div>
							</div>
						</div>
						<div class="mt50 visible-xs">
							<input type="button" class="btn btn-checkout btn-submit" value="LANJUT">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<style>
	.ui-autocomplete-loading { background:url({{ url('icons/Spinner.gif') }}) no-repeat right center }
	</style>
@stop
@section('script')
<script>

	jQuery("#jne-shipping-label").autocomplete({
	    source: function (request, response) {
	        jQuery.get("{{url('district/shipping/get/')}}", {
	            query: request.term
	        }, function (data) {

						var temp = JSON.parse(data).detail;
						var city=[];
						if(temp == null){
							console.log("got here");
							city[0]={'label':'Tujuan tidak ditemukan','value':'Tujuan tidak ditemukan','code':0};
						}else{
							$.each(temp,function( index , value ){
								city[index]={'label':value.label,'value':value.label,'code':value.code};
							});
						}


	            response(city);
	        });
	    },
	    minLength: 3,
			select: function(event, ui) {
					$('#jne-shipping-code').val(ui.item.code);
 				 getJnePrice(ui.item.code);
		 }
	});

	function getJnePrice(code)
	{
		var clone = $('.spinner').clone();
		$('#div-metode-pengiriman').empty();
		$('#div-metode-pengiriman').append(clone.show());
		$('.btn-submit').prop('disabled',true);
		$.ajax({
			url : '{{ url('checkout/getjneprice') }}',
			data:{code:code,_token:'{{ csrf_token() }}'},
			type: 'post',
			success : function(e) {
				$('.btn-submit').prop('disabled',false);
				$('#div-metode-pengiriman').empty();
				$('#div-metode-pengiriman').html(e);
			}
		});
	}

	jQuery("#jne-billing-label").autocomplete({
	    source: function (request, response) {
	        jQuery.get("{{url('district/shipping/get/')}}", {
	            query: request.term
	        }, function (data) {
						var temp = JSON.parse(data).detail;
						var city=[];
						$.each(temp,function( index , value ){
							city[index]={'label':value.label,'value':value.label,'code':value.code};
						});
	            response(city);
	        });
	    },
	    minLength: 3,
			select: function(event, ui) {
				 $('#jne-billing-code').val(ui.item.code);  // ui.item.value contains the id of the selected label
		 }
	});

  $('.btn-submit').click(function(){
    $('#frm-checkout').submit()
  });
	/*
  $('#select-city-shipping').change(function(){
    if($(this).val() != 0){
			$('.shipping_district').empty();
			var clone = $('.spinner').clone();
			$('.shipping_district').html(clone);
			clone.show();
			$.ajax({
				url:"{{url('district/shipping/get/')}}"+'/'+$(this).val(),
				type:"get",
				data:{id:$(this).val(),_token:'{{csrf_token()}}'},
				success : function(e)
				{
					$('.shipping_district').empty()
					$('.shipping_district').html(e);
				},
			});
		}
  });
	*/
  $('#select-province-shipping').on("change",function(){
		var val = $(this).val();
		$('#select-city-shipping').val(0);
		$("#select-city-shipping").trigger("change");
		$('#select-city-shipping').children('option').hide();
		$('.city-province-'+val).show();
	});

  $('#select-province-billing').on("change",function(){
		var val = $(this).val();
		$('#select-city-billing').val(0);
		$("#select-city-billing").trigger("change");
		$('#select-city-billing').children('option').hide();
		$('.city-province-billing-'+val).show();
	});

	{{--
  $('#select-city-billing').change(function(){
    if($(this).val() != 0){
			$('.billing_district').empty();
			var clone = $('.spinner').clone();
			$('.billing_district').html(clone);
			clone.show();
			$.ajax({
				url:"{{url('district/billing/get/')}}"+'/'+$(this).val(),
				type:"get",
				data:{id:$(this).val(),_token:'{{csrf_token()}}'},
				success : function(e)
				{
					$('.billing_district').empty()
					$('.billing_district').html(e);
				},
			});
		}
  });
	--}}

  function calculate_shipping(){
    var subtotal  = parseInt($('#subtotal_value').html().replace(",",""));
    var tax = parseInt($('#tax_value').html().replace(",",""));
    var shipping = parseInt($('#shipping_value').html().replace(",",""));

    var grandtotal = subtotal + tax +shipping;
    $('#grandtotal').html(grandtotal);
    $('#subtotal_value').number(true);
    $('#tax_value').number(true);
    $('#shipping_value').number(true);
    $('#grandtotal').number(true);
  }

  $('input[name="shipping"]').change(function(){
    $('#shipping_district').trigger("change");
  });
</script>
@stop
