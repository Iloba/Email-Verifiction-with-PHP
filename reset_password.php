<?php 

		require_once'controller/controller.php';
		if (!isset($_SESSION['email'])) {
			header('location: login.php');
		}
	
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
				<h3 class="text-center"><b>Reset Password Here</b></h3>  <br>
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
				<form action="reset_password.php" method="POST">
					<label>New Password</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="password"  class="form-control" name="new_password" placeholder="New Password"  required="">
					</div>

					<label>Confirm Password</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input type="password"  class="form-control" name="conf_new_password" placeholder="Password"  required="">
					</div>

					

					<input type="submit" name="reset-password-btn" value="Reset Password" class="btn btn-success btn-block" >
				</form>
			</div>
			<div class="col-md-4">
				&nbsp;
			</div>
		</div>
	</div>
</body>
</html>