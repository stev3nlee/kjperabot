@extends('layout')

@section('content')

	<div class="home-new-product content">
		<div class="container">
			<div class="career">
				<div class="text-center">
					<div class="title"> Karir </div>
					<div class="sub-desc"> Kami menyediakan beberapa lowongan pekerjaan. Daftar lowongan berikut dibawah ini: </div>
				</div>
				@if(count($careers) > 0)
				<div class="row career-job">
					@foreach($careers as $career)
					<div class="col-sm-6 col-md-3 col-xs-12">
						<div class="career-list">
							<div class="title mt50"> {{ $career->job_name }} </div>
							<div class="career-header">Syarat-syarat</div>
							<div class="bodytext">
								 {!! $career->requirement !!}
							</div>
							<div class="career-header mt20">Tanggung Jawab</div>
							<div class="bodytext">
								{!! $career->responsibility !!}
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<div class="text-center">
					<div class="title mt50"> Bagaimana cara melamar? </div>
					<div class="sub-desc"> {!! $page->page_description !!} </div>
				</div>
				<div class="text-center checkout">
					<span class="to-home"> <a href="{{ url('/contact') }}" class="btn btn-checkout"> LAMAR DISINI </a>
				</div>
				@else
					<div class="text-center">
					Belum ada lowongan karir
					</div>
				@endif
			</div>
		</div>
	</div>

@stop
