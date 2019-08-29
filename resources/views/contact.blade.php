@extends('layout')

@section('content')

	<div class="home-new-product content">
		<div class="container">
			<div class="contact">
				<div class="title"> Hubungi Kami </div>
				<div class="mb30">
					<iframe src="{{ $company->google_map }}" width="100%" class="google" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				<div class="row">
					<div class="col-md-5 col-sm-5 col-xs-12">
						<div class="title"> Informasi </div>

						<div class="contact-header">Waktu Buka Toko</div>
						<div class="contact-desc">{{ $company->opening_hour }} </div>

						<div class="contact-header">Email</div>
						<div class="contact-desc">{{ $company->email }}</div>

						<div class="contact-header">Whatsapp</div>
						<div class="contact-desc">{{ $company->whatsapp }}</div>

						<div class="contact-header">Instagram</div>
						<div class="contact-desc">{!! $company->support !!}</div>

						<div class="contact-header">Alamat Toko</div>
						<div class="bodytext">
							{!! $company->address !!}
						</div>
					</div>

					<div class="col-md-7 col-sm-7 col-xs-12">
						<div class="title summary"> Formulir Kontak </div>
						<div class="contact-desc"> Tim kami akan membalas paling setidaknya dalam 24 jam. Terima kasih. </div>
						@include('errorfile')
						<form method="post" action="{{ url('contact/submit') }}">
							{{ csrf_field() }}
							<div class="form-group">
								<label>Nama Lengkap <span class="red">*</span></label>
								<input type="text" class="form-control" name="full_name" value="{{old('full_name')}}" />
							</div>
							<div class="form-group">
								<label>Email <span class="red">*</span></label>
								<input type="text" class="form-control" name="email" value="{{old('email')}}" />
							</div>
							<div class="form-group">
								<label>Topik <span class="red">*</span></label>
								<div class="custom-select">
									<div class="replacement">@if(old('topic')!=null) {{$topics[old('topic')-1]->topic}} @else {{$topics[0]->topic}} @endif</div>
									<select class="custom-select" name="topic" onChange="custom_select(this)">
										@foreach($topics as $topic)
										<option value="{{$topic->id}}" @if(old('topic') == $topic->id) selected @endif>{{$topic->topic}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Isi Pesan <span class="red">*</span></label>
								<textarea type="message" class="form-control" name="message" value="{{old('message')}}" /></textarea>
							</div>
							<div>
								<button type="submit" class="btn btn-contact">KIRIM</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop
