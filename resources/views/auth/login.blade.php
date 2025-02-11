<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>PAP | Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/x-icon" href="pap1.png" />
		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="../../../register-form/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="../../../register-form/css/style.css">

        
	</head>

	<body>

		<div class="wrapper" style="background-image: url('../../../register-form/images/bg-registration-form-2.jpg');">
			<div class="inner">
				<form method="POST" action="{{ route('login') }}">
                    @csrf
					<h3>Login</h3>
					<div class="form-wrapper">
						<label for="email" :value="__('Email')">Email</label>
						<input type="text" name="email" class="form-control" :value="old('email')" required autocomplete="username" />
					</div>
					<div class="form-wrapper">
						<label for="password" :value="__('Password')">Password</label>
						<input type="password" name="password" class="form-control" required autocomplete="new-password">
					</div>
					<button type="submit">Login</button>
					<br>
					<a href="{{ route('register') }}" class="center-text">Don't have an account?</a>
				</form>
			</div>
		</div>

		
	</body>
</html>