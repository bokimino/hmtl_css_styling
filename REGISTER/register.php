<?php
   session_start()?>
<!DOCTYPE html>
<html>
	<head>
		<title>Register</title>
		<meta charset="utf-8" />
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<meta name="viewport" content="width=device-width,initial-scale=1.0" />

		<!-- Latest compiled and minified Bootstrap 4.6 CSS -->
		<link
			rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
			integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
			crossorigin="anonymous"
		/>
		<!-- CSS script -->
		<link rel="stylesheet" href="style.css" />
		<!-- Latest Font-Awesome CDN -->
		<script
			src="https://kit.fontawesome.com/3257d9ad29.js"
			crossorigin="anonymous"
		></script>
	</head>
	<body>
	    <nav class="navbar navbar-light bg-light">
			<a class="navbar-brand" href="./index.html">
				<img src="./../images/booklogo.png" width="50" height="50" alt="" />
			</a>
		</nav>

		<div class="container">
			<h1 class="text-info text-center m-5">Register</h1>
		</div>
		<div class="container">
			<form
				id="registrationForm"
				action="process_registration.php"
				method="POST"
			>
				<div class="form-group row">
					<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-10">
						<input
							type="email"
							class="form-control"
							id="inputEmail"
							name="email"
							required
							/>
							<?php if (isset($_SESSION['emailError'])): ?>
                                    <p class="text-danger"><?php echo $_SESSION['emailError']; ?></p>
                            <?php unset($_SESSION['emailError']); ?>
                            <?php endif; ?>	
					</div>
				</div>
				<div class="form-group row">
					<label for="inputPassword" class="col-sm-2 col-form-label"
						>Password</label
					>
					<div class="col-sm-10">
						<input
							type="password"
							class="form-control"
							id="inputPassword"
							name="password"
						/>

						<?php if (isset($_SESSION['passwordError'])): ?>
						        <p class="text-danger"><?php echo $_SESSION['passwordError']; ?></p>
						<?php unset($_SESSION['passwordError']); ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-10">
						<button type="submit" class="btn btn-primary">Register</button>
					</div>
				</div>
			</form>
		</div>



		<!-- jQuery library -->
		<script
			src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
			integrity="ha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
			crossorigin="anonymous"
		></script>

		<!-- Latest Compiled Bootstrap 4.6 JavaScript -->
		<script
			src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
			integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
			crossorigin="anonymous"
		></script>
		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
			integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
			crossorigin="anonymous"
		></script>
	</body>
</html>
