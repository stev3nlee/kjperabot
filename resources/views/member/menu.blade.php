
	<div class="visible-xs visible-sm mb25">
		<div class="custom-select">
			@if(Request::segment(1) == "profile")
			<div class="replacement">Data Pribadi</div>
			@elseif(Request::segment(1) == "wishlist")
			<div class="replacement">Wishlist</div>
			@elseif(Request::segment(1) == "order")
			<div class="replacement">Riwayat Pesanan</div>
			@elseif(Request::segment(1) == "newsletter")
			<div class="replacement">Newsletter</div>
			@elseif(Request::segment(1) == "confirm-payment")
			<div class="replacement">Konfirmasi Pembayaran</div>
			@elseif(Request::segment(1) == "change-password")
			<div class="replacement">Ubah Password</div>
			@endif
			<select name="member" class="custom-select" onChange="change_mymenu(this.value)">
				<option value="{{ url('/profile') }}" @if(Request::segment(1) == "profile") selected @endif>Data Pribadi</option>
				<option value="{{ url('/wishlist') }}" @if(Request::segment(1) == "wishlist") selected @endif>Wishlist</option>
				<option value="{{ url('/order') }}" @if(Request::segment(1) == "order") selected @endif>Riwayat Pesanan</option>
				<option value="{{ url('/newsletter') }}" @if(Request::segment(1) == "newsletter") selected @endif>Newsletter</option>
				<option value="{{ url('/confirm-payment') }}" @if(Request::segment(1) == "confirm-payment") selected @endif>Konfirmasi Pembayaran</option>
				<option value="{{ url('/change-password') }}" @if(Request::segment(1) == "change-password") selected @endif>Ubah Password</option>
				<option value="{{ url('/logout') }}">Keluar</option>
			</select>
		</div>
	</div>

	<div class="menu-member hidden-xs hidden-sm">
		<a href="{{ url('/profile') }}" id="profile" @if(Request::segment(1) == "profile") selected @endif> <div class="link"> Data Pribadi </div> </a>
		<span class="member-bdr"> | </span>
		<a href="{{ url('/wishlist') }}" id="wishlist" @if(Request::segment(1) == "wishlist") selected @endif> <div class="link"> Wishlist </div> </a>
		<span class="member-bdr"> | </span>
		<a href="{{ url('/order') }}" id="order" @if(Request::segment(1) == "order") selected @endif> <div class="link"> Riwayat Pesanan </div> </a>
		<span class="member-bdr"> | </span>
		<a href="{{ url('/newsletter') }}" id="newsletters" @if(Request::segment(1) == "newsletter") selected @endif> <div class="link"> Newsletter </div> </a>
		<span class="member-bdr"> | </span>
		<a href="{{ url('/confirm-payment') }}" id="confirm-payment" @if(Request::segment(1) == "confirm-payment") selected @endif> <div class="link"> Konfirmasi Pembayaran </div> </a>
		<span class="member-bdr"> | </span>
		<a href="{{ url('/change-password') }}" id="change-password" @if(Request::segment(1) == "change-password") selected @endif> <div class="link"> Ubah Password </div> </a>
		<span class="member-bdr"> | </span>
		<a href="{{ url('/logout') }}"> <div class="link" @if(Request::segment(1) == "profile") selected @endif> Keluar </div> </a>
	</div>
