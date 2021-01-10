<?php 

	require_once'controller/controller.php';
	
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>PHP MAILING SYSTEM</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!--font awsome-->
 	<link href="scss/fontawesome.css" rel="stylesheet">
	<link href="scss/brands.css" rel="stylesheet">
	<link href="scss/solid.css" rel="stylesheet">
	<link rel="icon"  href="img/save.svg">
</head>
<body>
	<header>
		<h2 class="text-center head">USER REGISTRATION SYSTEM WITH EMAIL VERIFICATION</h2>
	</header>
	
	<div class="container" >
		
		<div class="row">
			<div class="col-md-4">
				&nbsp;
			</div>
			<div class="col-md-4" id="form-section">
				<h2 class="text-center">Register</h2> <br>
				<form action="register.php" method="POST">
					<!--Check if there are Any Errors--->
					<?php if (count($errors) > 0): ?>
						<!--Error MEssages--->
						<div class="alert alert-danger">
						<!--loop through array of Errors-->
						<?php foreach ($errors as $error ) :
							?>
								<li><?php echo $error; ?></li>
							<?php
								endforeach;

						 ?>
						</div>
					<?php endif ?>
					

					<label>Username</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text"  class="form-control" name="username" value="<?php echo $username; ?>" placeholder="Username"  required="">
					</div>

					<label>Email</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input type="Email"  class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Email"  
						required="">
					</div>

					<label>Password</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="password"  class="form-control" name="password" placeholder="Password"  required="">
					</div>

					<label>Password Confirm</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="password"  class="form-control" name="confirm_password" placeholder=" Confirm Password"  required="">
					</div><br>

					<input type="submit" name="register-btn" class="btn btn-success btn-block" value="Register">
					<a href="login.php">Already Have an account? Login Here</a>
				</form>
			</div>
			<div class="col-md-4">
				&nbsp;
			</div>
		</div>
	</div>
</body>
</html>