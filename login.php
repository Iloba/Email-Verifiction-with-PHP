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
		<h1 class="text-center">PHP MAILING SYSTEM LOGIN PAGE</h1>
	</header>
	
	<div class="container" >
		
		<div class="row">
			<div class="col-md-4">
				&nbsp;
			</div>
			<div class="col-md-4" id="form-section">
				<h3 class="text-center"><b>Login Here</b></h3>  <br>
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
				<form action="login.php" method="POST">
					<label>Username or Email</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text"  class="form-control" name="username" placeholder="Username"  value="<?php echo $username; ?>" required="">
					</div>

					<label>Password</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input type="password"  class="form-control" name="password" placeholder="Password"  required="">
					</div>

					

					<input type="submit" name="login-btn" value="login" class="btn btn-success btn-block" >
					<a href="register.php">Don't Have an account? Register Here</a>
					<div class="text-center"><a  href="forgot_password.php">Forgot Password?</a></div>
				</form>
			</div>
			<div class="col-md-4">
				&nbsp;
			</div>
		</div>
	</div>
</body>
</html>