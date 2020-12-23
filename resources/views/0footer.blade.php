<div class="fix-wa">
	<a href="https://api.whatsapp.com/send?phone=6282246477047" target="_blank">
		<img src="{{ url('images/icons/whatsapp.png?v.1')}}">
	</a>
</div>

		<footer id="footer">
			<div class="container">
				<div class="row hidden-xs">
					<div class="col-md-2 hidden-sm hidden-xs">
						<div class="img-logo"><a href="{{ url('/') }}"><img src="{{ asset($company->logo_path) }}" class="img-responsive"/></a></div>
					</div>
					<div class="col-sm-2 col-md-2">
						<div class="t-footer mnt20">KJ Perabot</div>
						<ul class="list-footer">
							<li><a href="{{ url('/') }}">Beranda</a></li>
							<li><a href="{{ url('/about') }}">Tentang kami</a></li>
							<!--<li><a href="{{ url('/article') }}">Artikel</a></li>-->
							<li><a href="{{ url('/career') }}">Karir</a></li>
						</ul>
					</div>
					<div class="col-sm-2 col-md-2">
						<div class="t-footer">Toko</div>
						<ul class="list-footer">
							<li><a href="{{ url('/product') }}">Produk</a></li>
							<li><a href="{{ url('/category') }}">Kategori</a></li>
							<!-- <li><a href="{{ url('/confirm-payment') }}">Konfirmasi Pembayaran</a></li> -->
						</ul>
					</div>
					<div class="col-sm-3 col-md-2">
						<div class="t-footer">Bantuan</div>
						<ul class="list-footer">
							<li><a href="{{ url('/contact') }}">Hubungi Kami</a></li>
							<li><a href="{{ url('/terms-conditions') }}">Syarat dan Ketentuan</a></li>
						</ul>
					</div>
					<div class="col-sm-5 col-md-4">
						<div class="t-footer">Join Our Newsletter</div>
						@if(session()->has('flash_message_newsletter'))
						<div class="alert alert-{{ Session::get('flash_message_newsletter_level') }}">
						    {{ Session::get('flash_message_newsletter') }}
						</div>
						@endif
						<form action="{{ url('newsletter/subscribe') }}" method="post">
							{{csrf_field()}}
							<div class="input-group mb30">
								<input type="email" class="form-control form-email" required="required" id="subscribe-email" name="email" placeholder="E-mail Address">
								<span class="input-group-addon">
									<input type="submit" class="btn btn-subs btn-subscribe" value="SUBMIT">
								</span>
							</div>
						</form>
						<div class="mt20">
							<ul class="list-soc">
								Follow us :
								<li><a href="{{ $company->facebook }}" target="_blank"><img src="{{ asset('icons/fb.svg') }}" class="img-responsive"></a></li>
								<li><a href="{{ $company->instagram }}" target="_blank"><img src="{{ asset('icons/ig.svg') }}" class="img-responsive"></a></li>
								<li><a href="https://vt.tiktok.com/ZSnWF3Ud/" target="_blank"><img src="{{ asset('icons/tiktok.svg') }}" class="img-responsive"></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2 hidden-sm hidden-xs"></div>
					<div class="col-md-10 col-sm-12 col-xs-12">
						<div class="footer-bottom">
							<div class="tbl">
								<div class="cell">
									<div class="cp">&copy; {{date("Y")}} KJ Perabot. Crafted By <a href="http://dilenium.com/" target="_blank">Dilenium</a>.</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>
</section>

<div id="offcanvas-menu">
	<div class="clearfix">
		<div class="close-menu clearfix pull-right">
			<img src="{{ asset('icons/close-menu.svg') }}" class="img-responsive"/>
		</div>
	</div>
	<div class="list mb15">
		<form action="{{ url('/search') }}" method="get">
			<input type="text" class="form-search form-canvas" name="q" placeholder="Cari produk..">
		</form>
	</div>
	@if(!Auth::check())
	<div class="border-menu">
		<div class="list mb15">
			<a href="{{ url('/') }}">HOME</a>
		</div>
		<div class="list mb15">
			<a href="{{ url('/sign') }}">LOGIN/DAFTAR</a>
		</div>
	</div>
	@else
	<div class="border-menu">
		<div class="list mb15">
			<a href="{{ url('/') }}">HOME</a>
		</div>
		<div class="list mb15">
			<a href="{{ url('/profile') }}">HALO, {{ strtoupper(Auth::user()->first_name) }} {{ strtoupper(Auth::user()->last_name) }}</a>
		</div>
		<div class="list mb15">
			<a href="{{ url('/logout') }}">KELUAR</a>
		</div>
	</div>
	@endif
	<div class="border-menu">
		<div class="list mb15">
			<a href="{{ url('/category') }}">KATEGORI</a>
		</div>
		<div class="list mb15">
			<a href="{{ url('/product') }}">PRODUK</a>
		</div>
	</div>
	<div class="border-menu">
		<!-- <div class="list mb15">
			<a href="{{ url('/confirm-payment') }}">Konfirmasi Pembayaran</a>
		</div> -->
		<div class="list mb15">
			<a href="{{ url('/about') }}">Tentang Kami</a>
		</div>
		<!--
		<div class="list mb15">
			<a href="{{ url('/article') }}">Artikel</a>
		</div>
		-->
		<div class="list mb15">
			<a href="{{ url('/career') }}">Karir</a>
		</div>
		<div class="list mb15">
			<a href="{{ url('/contact') }}">Hubungi Kami</a>
		</div>
		<div class="list mb15">
			<a href="{{ url('/terms-conditions') }}">Syarat dan Ketentuan</a>
		</div>
	</div>
	<!-- NEW -->
	<div class="t-footer">Join Our Newsletter</div>
	<form action="https://kjperabot.co.id/newsletter/subscribe" method="post">
		<input type="hidden" name="_token" value="Uh4vqwwqjLILG8net5RMit5b4jnbIuvAnxIDRXhE">
		<div class="input-group">
			<input type="email" class="form-control form-email" required="required" id="subscribe-email" name="email" placeholder="E-mail Address">
			<span class="input-group-addon">
				<input type="submit" class="btn btn-subs btn-subscribe" value="SUBMIT">
			</span>
		</div>
	</form>
	<div class="mt20">
		<ul class="list-soc">
			Follow us :
			<li><a href="{{ $company->facebook }}" target="_blank"><img src="{{ asset('icons/fb.svg') }}" class="img-responsive"></a></li>
			<li><a href="{{ $company->instagram }}" target="_blank"><img src="{{ asset('icons/ig.svg') }}" class="img-responsive"></a></li>
			<li><a href="https://vt.tiktok.com/ZSnWF3Ud/" target="_blank"><img src="{{ asset('icons/tiktok.svg') }}" class="img-responsive"></a></li>
		</ul>
	</div>
	<!-- END NEW -->
</div>
<div class="spinner text-center" style="display:none">
	<img src="{{ asset('icons/Spinner.gif') }}" />
</div>
</body>

@yield('script')
</html>
