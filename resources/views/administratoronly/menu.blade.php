<div class="box-left">
	<div class="box">
		<ul id="accordion" class="accordion">
			<li id="banner">
				<a href="{{ url('/administratoronly/dashboard/') }}">
					<div class="link">Dashboard</div>
				</a>
			</li>
			<li>
				<a>
					<div class="no-link">
						<span class="lnr lnr-magic-wand" style="font-size: 18px; position: relative; top: 2px;"></span>&nbsp; WEBSITE
					</div>
				</a>
			</li>
			@if($userRoles[0]==1)
			<li id="banner">
				<a href="{{ url('/administratoronly/website/slider') }}">
					<div class="link">Slider</div>
				</a>
			</li>
			@endif
			@if($userRoles[1]==1)
			<li id="newsletter">
				<a href="{{ url('/administratoronly/website/newsletter') }}">
					<div class="link">Newsletter</div>
				</a>
			</li>
			@endif
			@if($userRoles[2]==1)
			<li id="pages">
				<a href="{{ url('/administratoronly/website/pages') }}">
					<div class="link">Pages</div>
				</a>
			</li>
		@endif
		@if($userRoles[3]==1)
			<li id="career">
				<a href="{{ url('/administratoronly/website/career') }}">
					<div class="link">Career</div>
				</a>
			</li>
		@endif
		@if($userRoles[4]==1)
			<li id="article">
				<a href="{{ url('/administratoronly/website/article') }}">
					<div class="link">Article</div>
				</a>
			</li>
		@endif
		@if($userRoles[5]==1)
			<li id="contact">
				<a href="{{ url('/administratoronly/website/contact') }}">
					<div class="link">Contact</div>
				</a>
			</li>
		@endif
		@if($userRoles[6]==1 or $userRoles[7]==1)
			<li>
				<a>
					<div class="no-link">
						<span class="lnr lnr-cog" style="font-size: 18px; position: relative; top: 2px;"></span>&nbsp; COMMERCE
					</div>
				</a>
			</li>
			<li id="product">
				<div class="link">Store<i class="lnr lnr-chevron-down"></i></div>
				<ul class="submenu">
					@if($userRoles[6]==1)
					<li><a href="{{ url('/administratoronly/commerce/store/category') }}" id="category">Category</a></li>
					@endif
					@if($userRoles[7]==1)
					<li><a href="{{ url('/administratoronly/commerce/product') }}" id="type">Product List</a></li>
					@endif
				</ul>
			</li>
		@endif
		@if($userRoles[8]==1)
			<li id="member">
				<a href="{{ url('/administratoronly/commerce/member') }}">
					<div class="link">Member</div>
				</a>
			</li>
		@endif
		@if($userRoles[9]==1)
			<li id="order">
				<a href="{{ url('/administratoronly/commerce/order') }}">
					<div class="link">Order</div>
				</a>
			</li>
		@endif
		@if($userRoles[10]==1)
			<li id="payment">
				<a href="{{ url('/administratoronly/commerce/payment') }}">
					<div class="link">Payment</div>
				</a>
			</li>
		@endif
		@if($userRoles[11]==1)
			<li id="shipping">
				<a href="{{ url('/administratoronly/commerce/shipping') }}">
					<div class="link">Shipping</div>
				</a>
			</li>
		@endif
		@if($userRoles[12]==1)
			<li id="others">
				<a href="{{ url('/administratoronly/commerce/others') }}">
					<div class="link">Others</div>
				</a>
			</li>
		@endif
			<li>
				<a>
					<div class="no-link">
						<span class="lnr lnr-cog" style="font-size: 18px; position: relative; top: 2px;"></span>&nbsp; SETTINGS
					</div>
				</a>
			</li>
			@if($userRoles[13]==1)
			<li id="metadata">
				<a href="{{ url('/administratoronly/settings/metadata/index') }}">
					<div class="link">Metadata</div>
				</a>
			</li>
			@endif
			@if($userRoles[14]==1)
			<li id="social-media">
				<a href="{{ url('/administratoronly/settings/social-media/index') }}">
					<div class="link">Social Media</div>
				</a>
			</li>
		@endif
		@if($userRoles[15]==1)
			<li id="tools">
				<a href="{{ url('/administratoronly/settings/tools/index') }}">
					<div class="link">Tools</div>
				</a>
			</li>
		@endif
		@if($userRoles[16]==1 or $userRoles[17]==1)
			<li id="role">
				<div class="link">User Account<i class="lnr lnr-chevron-down"></i></div>
				<ul class="submenu">
					@if($userRoles[16]==1)
					<li><a href="{{ url('/administratoronly/settings/useraccount/group/index') }}" id="group">Group</a></li>
					@endif
					@if($userRoles[17]==1)
					<li><a href="{{ url('/administratoronly/settings/useraccount/account/index') }}" id="account">Account</a></li>
					@endif
				</ul>
			</li>
		@endif
			<li id="change-password">
				<a href="{{ url('/administratoronly/settings/change-password/index') }}">
					<div class="link">Change Password</div>
				</a>
			</li>
		</ul>
	</div>
</div>
