@extends('layout')

@section('content')

	<div class="home-new-product content">
		<div class="container">
			<div class="contact">
				<div class="title"> Tentang Kami </div>
				<div class="bodytext">
					{!!$page->page_description!!}
				</div>
			</div>
		</div>
	</div>

@stop
