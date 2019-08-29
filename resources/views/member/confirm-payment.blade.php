@extends('layout')

@section('content')

	<div class="home-new-product member">
		<div class="container">

			<div class="row">
				<div class="col-md-12">
					<div class="menu-header text-center"> Konfirmasi Pembayaran </div>
          @include('errorfile')
					<div class="confirmPayment">
					<form action="{{ url('/confirm-payment/save') }}" method="post" enctype="multipart/form-data" id="frm-submit">
						<div class="form-group">
							 {{csrf_field()}}
						</div>
						<div class="form-group">
							<label>Nomor Order <span class="red">*</span></label>
							@if(Request::segment(2)==null)
							<input type="text" class="form-control" id="order-no" name="order_no" value="{{old('order_no')}}" />
							@else
								<input type="text" class="form-control" id="order-no" name="order_no" value="{{ Request::segment(2) }}" disabled/>
							@endif
						</div>
						<div class="form-group">
							<label>Kirim ke Bank <span class="red">*</span></label>
							<input type="text" class="form-control" name="lname" value="BCA - 6871513322 - PT Karya Jaya Sembilan Saudara" disabled="disabled" />
						</div>
						<div class="form-group">
							<label>Nomor Akun Bank<span class="red">*</span></label>
							<input type="text" class="form-control" name="account_no" value="{{old('account_no')}}" />
						</div>
						<div class="form-group">
							<label>Nama Akun Bank<span class="red">*</span></label>
							<input type="text" class="form-control" name="account_name" value="{{old('account_name')}}" />
						</div>
						<div class="form-group">
							<label> Biaya yang sudah ditransfer<span class="red">*</span></label>
							<input type="text" class="form-control" name="nominal" value="{{old('nominal')}}" />
						</div>
						<div class="form-group upload">
							<label>Upload Image <span class="red">*</span></label>
							<input type="file" name="image">
							<div class="upload-confirm">.JPG/.PNG/.PDF files only. Maximum 10MB size.</div>
						</div>
						<div class="text-center">
							<input type="button" id="btn-submit" class="btn btn-login" value="KONFIRMASI">
						</div>
					</form>
					</div>
				</div>

			</div>
		</div>
	</div>

@stop
@section('script')
	<script>
	$('#btn-submit').click(function(){
		$('#order-no').prop("disabled", false);
		$('#frm-submit').submit()
	});
	</script>
@stop
