<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<!--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">-->
	<title>Admin</title>

	<!-- Favicon -->
	<link rel="icon" type="image/ico" href="{{ asset('adminasset/uploads/favicon.ico') }}">

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('adminasset/css/fonts.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('adminasset/css/web.css') }}">

	<!-- JS -->
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script type="text/javascript" src="{{ asset('adminasset/js/jquery-1.11.1.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('adminasset/js/web.js') }}"></script>

</head>
<body>
	<div class="full-height">
		<div class="tbl">
			<div class="cell">
				<div class="box-login">
					<div class="box-sign effect8">
						<div class="logo">
							<img src="{{ asset('adminasset/uploads/logo2.png') }}"/>
						</div>
						@include('errorfile')
						<form method="post" action="{{ url('administratoronly/login') }}" name="loginform">
							{{csrf_field()}}
							<div class="form-group">
								<div class="form-error"></div>
								<label>Email</label>
								<input type="text" class="form-control" required name="email" />
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" class="form-control" required name="password" />
							</div>
							<div class="form-group">
								<input type="checkbox" id="admin_rememberme" name="remember" /><label>Remember Me </label>
							</div>
							<div>
								<input type="submit" name="login" class="btn btn200" value="Login" />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
