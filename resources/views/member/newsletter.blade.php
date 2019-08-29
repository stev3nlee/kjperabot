@extends('layout4')

@section('content')

	<div class="home-new-product member">
		<div class="container">
			<div class="title"> Profile Saya </div>
			@include ('member/menu')
      @include('errorfile')
      @if(empty($subscriber))
			<div class="box-subscribed">
				<div class="subsnews-header">Anda sedang tidak mengikuti layanan newsletter dari kami. Layanan newsletter akan memberitahukan produk terbaru dan harga sale.</div>
				<div class="subsnews-desc"> Apakah anda ingin mendapatkan layanan newsletter sekarang?</div>
				<div>
					<a class="fancybox" href="#newsletter"><button type="button" class="btn btn-member subs-news mr50">SUBSCRIBE</button></a>
				</div>
			</div>
			<div id="newsletter" class="width-pop">
				<div class="pad-pop">
					<div class="img-pop hidden-xs">
						<img src="{{url('images/icons/newsletter.png') }}" class="img-responsive"/>
					</div>
					<div class="text-pop mb30">Apakah anda ingin menerima newsletter dari KJ Perabot?</div>
					<div class="clearfix text-center">
						<div class="inline-block mr25">
							<form action="{{url('newsletter/save')}}" method="post">
		            {{ csrf_field() }}
								<input type="hidden" name="is_subscribe" value="1"/>
								<a class="button-subscribed"><button type="submit" class="btn btn-popyes">Yes</button></a>
							</form>
						</div>
						<div class="inline-block">
							<button type="button" class="btn btn-popno close-fancy">No</button>
						</div>
					</div>
				</div>
			</div>
			@else
				@if($subscriber->is_subscribe == 1)
					<div class="box-subscribed">
						<div class="subsnews-header">Anda telah mengikuti layanan newsletter dari kami. Apakah anda ingin keluar dari layanan? </div>
						<div>
							<a class="fancybox" href="#newsletter2"><button type="button" class="btn btn-member subs-news">UNSUBSCRIBE</button></a>
						</div>
					</div>

					<div id="newsletter2" class="width-pop">
						<div class="pad-pop">
							<div class="img-pop hidden-xs">
								<img src="{{url('images/icons/newsletter.png') }}" class="img-responsive"/>
							</div>
							<div class="text-pop mb30">Apakah anda ingin berhenti menerima newsletter dari KJ Perabot?</div>
							<div class="clearfix text-center">
								<div class="inline-block mr25">
									<form action="{{url("newsletter/save")}}" method="post">
										{{csrf_field()}}
										<input type="hidden" name="is_subscribe" value="0"/>
										<a class="button-unsubscribed"><button type="submit" class="btn btn-popyes">Yes</button></a>
									</form>
								</div>
								<div class="inline-block">
									<button type="button" class="btn btn-popno close-fancy">No</button>
								</div>
							</div>
						</div>
					</div>
				@else
					<div class="box-subscribed">
						<div class="subsnews-header">Anda sedang tidak mengikuti layanan newsletter dari kami. Layanan newsletter akan memberitahukan produk terbaru dan harga sale.</div>
						<div class="subsnews-desc"> Apakah anda ingin mendapatkan layanan newsletter sekarang?</div>
						<div>
							<a class="fancybox" href="#newsletter"><button type="button" class="btn btn-member subs-news mr50">SUBSCRIBE</button></a>
						</div>
					</div>
					<div id="newsletter" class="width-pop">
						<div class="pad-pop">
							<div class="img-pop hidden-xs">
								<img src="{{url('images/icons/newsletter.png') }}" class="img-responsive"/>
							</div>
							<div class="text-pop mb30">Apakah anda ingin menerima newsletter dari KJ Perabot?</div>
							<div class="clearfix text-center">
								<div class="inline-block mr25">
									<form action="{{url('newsletter/save')}}" method="post">
				            {{ csrf_field() }}
										<input type="hidden" name="is_subscribe" value="1"/>
										<a class="button-subscribed"><button type="submit" class="btn btn-popyes">Yes</button></a>
									</form>
								</div>
								<div class="inline-block">
									<button type="button" class="btn btn-popno close-fancy">No</button>
								</div>
							</div>
						</div>
					</div>
				@endif
      @endif
		</div>
	</div>
@stop

@section('script')
<script>
$(function() {
	$('#newsletters').addClass ('active');
});
</script>
@stop
