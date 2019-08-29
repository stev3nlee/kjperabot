@extends('layout')

@section('content')

	<div class="home-new-product member">
		<div class="container">

			<div class="row">
        @include('errorfile')
				<div class="visible-xs col-xs-12">
					<form action="{{ url('login') }}" method="post">
						{{csrf_field()}}
					<div class="menu-header"> Login </div>
						<div class="form-group">
							<label>Email <span class="red">*</span></label>
							<input type="text" class="form-control w500" name="email" placeholder="info@domain.com" />
						</div>
						<div class="form-group">
							<label>Password <span class="red">*</span></label>
							<input type="password" class="form-control w500" name="password" placeholder="********" />
						</div>
						<div class="">
							<input type="submit" value="MASUK" class="btn btn-login"/>
						</div>
						<div class="forget-btn mb50">
							<a href="{{ url('/forget') }}"> Lupa Kata Sandi </a>
						</div>
					</form>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
          <form method="post" action="{{ url('register') }}">
            {{ csrf_field() }}
  					<div class="menu-header"> Daftar Akun </div>
  					<div class="form-group">
  						<label>Email <span class="red">*</span></label>
  						<input type="text" class="form-control w500" name="email" placeholder="info@domain.com" />
  					</div>
  					<div class="form-group">
  						<label>Nama Depan <span class="red">*</span></label>
  						<input type="text" class="form-control w500" name="nama_depan" placeholder="Jane" />
  					</div>
  					<div class="form-group">
  						<label>Nama Belakang <span class="red">*</span></label>
  						<input type="text" class="form-control w500" name="nama_belakang" placeholder="Doe" />
  					</div>
  					<div class="form-group">
  						<label>Kata Sandi <span class="red">*</span></label>
  						<input type="password" class="form-control w500" name="kata_sandi" placeholder="********" />
  					</div>
  					<div class="form-group">
  						<label> Konfirmasi Kata Sandi <span class="red">*</span></label>
  						<input type="password" class="form-control w500" name="kata_sandi_confirmation" placeholder="********" />
  					</div>
  					<div class="">
              <input type="submit" value="DAFTAR" class="btn btn-login"/>
  					</div>
          </form>
				</div>
				<div class="col-md-6 col-sm-6 hidden-xs">
					<form method="post" action="{{ url('login') }}">
						{{ csrf_field() }}
						<div class="menu-header"> Login </div>
						<div class="form-group">
							<label>Email <span class="red">*</span></label>
							<input type="text" class="form-control w500" name="email" placeholder="info@domain.com" />
						</div>
						<div class="form-group">
							<label>Password <span class="red">*</span></label>
							<input type="password" class="form-control w500" name="password" placeholder="********" />
						</div>
						<div class="">
							<input type="submit" value="MASUK" class="btn btn-login"/>
						</div>
					</form>
					<div class="forget-btn">
						<a href="{{ url('/forget') }}"> Lupa Kata Sandi </a>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop
