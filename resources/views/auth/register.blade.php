<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>PAP | Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="../../../register-form/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="../../../register-form/css/style.css">
	</head>

	<body>

		<div class="wrapper" style="background-image: url('../../../register-form/images/bg-registration-form-2.jpg');">
			<div class="inner">
				<form method="POST" action="{{ route('register') }}">
                    @csrf
					<h3>Registration Form</h3>
					<div class="form-wrapper">
						<label for="name" :value="__('Name')">Full Name</label>
						<input type="text" name="name" class="form-control" :value="old('name')" required autofocus autocomplete="name" />
					</div>
					<div class="form-wrapper">
						<label for="email" :value="__('Email')">Email</label>
						<input type="text" name="email" class="form-control" :value="old('email')" required autocomplete="username" />
					</div>
					<div class="form-wrapper">
						<label for="password" :value="__('Password')">Password</label>
						<input type="password" name="password" class="form-control" required autocomplete="new-password">
					</div>
					<div class="form-wrapper">
						<label for="password_confirmation" :value="__('Confirm Password')">Confirm Password</label>
						<input type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox"> I caccept the Terms of Use & Privacy Policy.
							<span class="checkmark"></span>
						</label>
					</div>
					<button type="submit">Register Now</button>
				</form>
			</div>
		</div>
		
	</body>
</html>