@extends('layout')

@section('content')

	<div class="home-new-product member">
		<div class="container">

			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="menu-header"> Silakan masukan password baru dan konfirmasi password kembali </div>
					@include('errorfile')
					<form method="post" action="{{ url('reset/password') }}">
  					<div class="form-group mt50 mb50">
						{{csrf_field()}}
						<input type="hidden" name="id" value="{{$user_id}}"/>
						<label for="kata_sandi">Kata sandi baru<span class="red">*</span></label>
						<input type="password" id="kata_sandi" class="form-control w500" name="kata_sandi" />
						<br>
						<label for="kata_sandi_confirmation">Konfirmasi kata sandi<span class="red">*</span></label>
						<input type="password" id="kata_sandi_confirmation" class="form-control w500" name="kata_sandi_confirmation"  />
  					</div>
  					<div class="">
              <input type="submit" value="KIRIM" class="btn btn-login"/>
  					</div>
          </form>
				</div>
			</div>
		</div>
	</div>

@stop
