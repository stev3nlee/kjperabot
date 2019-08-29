@extends('layout4')

@section('content')

	<div class="home-new-product member">
		<div class="container">
			<div class="title"> Ubah Password </div>
			@include ('member/menu')
      @include ('errorfile')
      <form method="post" action="{{ url('/change-password/save') }}">
        {{ csrf_field() }}
  			<div class="menu-header"> Ganti Password </div>
  			<div class="row">
  				<div class="col-md-6 col-sm-6 col-xs-12">
  					<div class="form-group">
  						<label>Password Lama <span class="red">*</span></label>
  						<input type="password" class="form-control" name="password_lama" />
  					</div>
  					<div class="form-group">
  						<label>Password Baru <span class="red">*</span></label>
  						<input type="password" class="form-control" name="password_baru" />
  					</div>
  					<div class="form-group">
  						<label>Konfirmasi Password <span class="red">*</span></label>
  						<input type="password" class="form-control" name="password_baru_confirmation" />
  					</div>
  				</div>
  			</div>
  			<div class="">
          <input type="submit" value="SIMPAN" class="btn btn-member"/>
  			</div>
      </form>
		</div>
	</div>

@stop

@section('script')
<script>
$(function() {
	$('#change-password').addClass ('active');
});
</script>
@stop
