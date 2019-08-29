@extends('layout')

@section('content')
	<div class="log-log">
		<div class="container">
			<div class="title">Log In</div>
				<div class="row">
					<div class="col-sm-6 col-md-6 col-xs-12">
						<form action="{{ url('/login') }}" method="post">
							<div class="form-group">
								<label>AlAMAT E-MAIL/USERNAME</label>
								<input class="form-control" type="text" name="email"/>
							</div>
							<div class="form-group">
								<label>PASSWORD</label>
								<input class="form-control" type="password" name="password"/>
							</div>
							<div>
								<button type="submit" class="btn btn-blue">MASUK</button>
							</div>
						</form>
						<div class="clearfix mt20">
							<a href="{{ url('/forgot-password') }}"  class="link">Lupa Password?</a>
						</div>
					</div>
				</div>
		</div>
	</div>
	<div class="log-reg">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="title"> Belum Terdaftar? </div>
					<div> Bergabunglah dengan Guru Bumi dan dapatkan akses materi pembelajaran anak-anak! Dapatkan juga kesempatan berkontribusi dalam pendidikan anak Indonesia! </div>
					<div class="mt20">
						<a href="{{ url('/register') }}" class="btn"> DAFTAR </a>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop
@section('script')

@stop
