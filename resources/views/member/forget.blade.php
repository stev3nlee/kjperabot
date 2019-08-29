@extends('layout')

@section('content')

	<div class="home-new-product member">
		<div class="container">

			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="menu-header"> Dapatkan Akun Kembali </div>
					@include('errorfile')
          <form method="post" action="{{ url('forget') }}">
  					<div class="form-group mt50 mb50">
              {{csrf_field()}}
  						<label>Email Terdaftar<span class="red">*</span></label>

  						<input type="text" class="form-control w500" name="email" value="{{old('email')}}" placeholder="info@domain.com" />

  					</div>
  					<div class="forget-text">
  						An e-mail containing instructions to reset your password wil be sent to your registered e-mail. Make sure to add noreplay@kjperabot.id to your contact list so it doesn’t get sorted into Spam.
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
