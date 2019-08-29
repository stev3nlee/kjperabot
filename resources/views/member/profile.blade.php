@extends('layout4')

@section('content')

	<div class="home-new-product member">
		<div class="container">
			<div class="title"> Profile Saya </div>

			@include ('member/menu')

			<div class="menu-header"> Data Pribadi </div>
			@include('errorfile')
			<form method="post" action="{{url('profile/save')}}">
				{{ csrf_field() }}
			<div class="row hidden-xs">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>Nama Depan <span class="red">*</span></label>
						<input type="text" class="form-control" name="nama_depan" value="{{ $user->first_name }}" />
					</div>
					<div class="form-group">
						<label>Nama Belakang <span class="red">*</span></label>
						<input type="text" class="form-control" name="nama_belakang" value="{{ $user->last_name }}" />
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>Email <span class="red">*</span></label>
						<input type="text" class="form-control" name="email" value="{{ $user->email }}" readonly/>
					</div>
					<div class="form-group">
						<label>Nomor Telepon <span class="red">*</span></label>
						<input type="text" class="form-control" name="nomor_telepon" value="{{ $user->phone }}" />
					</div>
				</div>
			</div>

			<!-- WEBSITE -->
			<div class="menu-header mt30 hidden-xs"> Alamat </div>
			<div class="row hidden-xs">
				<div class="col-md-6 col-sm-6">
					<div class="form-group">
						<label>Negara <span class="red">*</span></label>
						<div class="custom-select">
							<div class="replacement form-control">{{ $countries->where('id',$user->country_id)->first()->country_name }}</div>
							<select class="custom-select form-control select-country" id="select-country" onchange="custom_select(this)" name="negara">
                @foreach($countries as $country)
								<option value="{{$country->id}}" @if($country->id == $user->country_id) selected @endif>{{$country->country_name}}</option>
                @endforeach
							</select>
						</div>
					</div>
					<div class="form-group indonesia" @if($user->country_id != 101) style="display:none;" @endif>
						<label>Kota <span class="red">*</span></label>
						<div class="custom-select">
							<div class="replacement form-control">{{ ($user->city_id != null ? ($cities->where('id',$user->city_id)->first()->city_name ?? "") : "") }}</div>
							<select class="custom-select form-control select-city" onchange="custom_select(this)" id="select-city" name="kota">
								<option value="0"></option>
								@foreach($cities as $city)
								<option value="{{$city->id}}" class="city-province-{{$city->province_id}}" {{ ($user->city_id == $city->id ? "selected" : "") }}>{{ $city->city_name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label>Alamat <span class="red">*</span></label>
						<textarea class="form-control" name="alamat">{{ $user->address }}</textarea>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="form-group indonesia" @if($user->country_id != 101) style="display:none;" @endif>
						<label>Provinsi <span class="red">*</span></label>
						<div class="custom-select">
							<div class="replacement form-control">{{ ($user->province_id != null ? $provinces->where('id',$user->province_id)->first()->province_name : "") }}</div>
							<select class="custom-select form-control select-province" id="select-province" onchange="custom_select(this)" name="provinsi">
								<option value=""></option>
								@foreach($provinces as $province)
								<option value="{{ $province->id }}" {{ ($user->province_id == $province->id ? "selected" : "") }}>{{ $province->province_name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group div-district indonesia" @if($user->country_id != 101) style="display:none;" @endif>
						<label>Kecamatan <span class="red">*</span></label>
						<div class="custom-select">
							<div class="replacement form-control">{{ ($user->district_id != null ? ($districts->where('id',$user->district_id)->first()->district_name ?? "") : "") }}</div>
							<select class="custom-select form-control select-district" onchange="custom_select(this)" name="kecamatan">
                @foreach($districts as $district)
								<option value="{{$district->id}}" {{ ($user->district_id == $district->id ? "selected" : "") }}>{{ $district->district_name }}</option>
                @endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label>Kode Pos <span class="red">*</span></label>
						<input type="text" class="form-control" name="kode_pos" value="{{$user->post_code}}" />
					</div>
				</div>
			</div>
			<div class="row  hidden-xs text-center">
				<input type="submit" class="btn btn-member" value="SIMPAN">
			</div>
			<!-- END WEBSITE -->

			</form>


			<!-- MOBILE -->
			<form method="post" action="{{url('profile/save')}}">
				{{csrf_field()}}
			<div class="row visible-xs hidden-sm hidden-md">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>Nama Depan <span class="red">*</span></label>
						<input type="text" class="form-control" name="nama_depan" value="{{ $user->first_name }}" />
					</div>
					<div class="form-group">
						<label>Nama Belakang <span class="red">*</span></label>
						<input type="text" class="form-control" name="nama_belakang" value="{{ $user->last_name }}" />
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>Email <span class="red">*</span></label>
						<input type="text" class="form-control" name="email" value="{{ $user->email }}" />
					</div>
					<div class="form-group">
						<label>Nomor Telepon <span class="red">*</span></label>
						<input type="text" class="form-control" name="nomor_telepon" value="{{ $user->phone }}" />
					</div>
				</div>
			</div>

			<div class="menu-header mt30 visible-xs"> Alamat </div>
			<div class="row visible-xs hidden-sm hidden-md">
				<div class="col-xs-12">
					<div class="form-group">
						<label>Negara <span class="red">*</span></label>
						<div class="custom-select">
							<div class="replacement form-control">{{ $countries->where('id',$user->country_id)->first()->country_name }}</div>
							<select class="custom-select form-control select-country" id="select-country" onchange="custom_select(this)" name="negara">
                @foreach($countries as $country)
								<option value="{{$country->id}}" @if($country->id == $user->country_id) selected @endif>{{$country->country_name}}</option>
                @endforeach
							</select>
						</div>
					</div>
					<div class="indonesia" @if($user->country_id != 101) style="display:none;" @endif>
						<div class="form-group">
							<label>Provinsi <span class="red">*</span></label>
							<div class="custom-select">
								<div class="replacement form-control">{{ ($user->province_id != null ? $provinces->where('id',$user->province_id)->first()->province_name : "") }}</div>
								<select class="custom-select form-control select-province" id="select-province" onchange="custom_select(this)" name="provinsi">
									<option value=""></option>
									@foreach($provinces as $province)
									<option value="{{ $province->id }}" {{ ($user->province_id == $province->id ? "selected" : "") }}>{{ $province->province_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label>Kota <span class="red">*</span></label>
							<div class="custom-select">
								<div class="replacement form-control">{{ ($user->city_id != null ? ($cities->where('id',$user->city_id)->first()->city_name ?? "") : "") }}</div>
								<select class="custom-select form-control select-city" onchange="custom_select(this)" id="select-city" name="kota">
									<option value="0"></option>
									@foreach($cities as $city)
									<option value="{{$city->id}}" class="city-province-{{$city->province_id}}" {{ ($user->city_id == $city->id ? "selected" : "") }}>{{ $city->city_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group div-district">
  						<label>Kecamatan <span class="red">*</span></label>
  						<div class="custom-select">
  							<div class="replacement form-control">{{ ($user->district_id != null ? ($districts->where('id',$user->district_id)->first()->district_name ?? "") : "") }}</div>
  							<select class="custom-select form-control select-district" onchange="custom_select(this)" name="kecamatan">
                  @foreach($districts as $district)
  								<option value="{{$district->id}}" {{ ($user->district_id == $district->id ? "selected" : "") }}>{{ $district->district_name }}</option>
                  @endforeach
  							</select>
  						</div>
  					</div>
					</div>
					<div class="form-group">
						<label>Post Code <span class="red">*</span></label>
						<input type="text" class="form-control" name="kode_pos" value="{{$user->post_code}}" />
					</div>
					<div class="form-group">
						<label>Alamat <span class="red">*</span></label>
						<textarea class="form-control" name="alamat">{{ $user->address }}</textarea>
					</div>
				</div>
				<div class="text-center">
					<input type="submit" class="btn btn-member" value="SIMPAN">
				</div>
			</div>
			<!-- END MOBILE -->

			</form>




		</div>
	</div>

@stop

@section('script')
	<script>
	$(function() {
		$('#profile').addClass ('active');

		$('.select-country').on("change",function(){
			if($(this).val() == 101){
				$('.indonesia').show();
			}else{
				$('.indonesia').hide();
			}
		});

		$('.select-province').on("change",function(){
			var val = $(this).val();
			$('.select-city').val(0);
			$(".select-city").trigger("change");
			$('.select-city').children('option').hide();
			$('.city-province-'+val).show();

			$('.select-district').val(0);
			$(".select-district").trigger("change");
			$('.select-district').children('option').hide();
		});

		$('.select-city').on("change",function(){
			if($(this).val() != 0){

				$('.div-district').empty();
				var clone = $('.spinner').clone();
				$('.div-district').html(clone);
				clone.show();

				$.ajax({
					url:"{{url('district/get/')}}"+'/'+$(this).val(),
					type:"get",
					data:{id:$(this).val(),_token:'{{csrf_token()}}'},
					success : function(e)
					{
						$('.div-district').empty();
						$('.div-district').html(e);
					},
				});
			}
		});
	});
	</script>
@stop
