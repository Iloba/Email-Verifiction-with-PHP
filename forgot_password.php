<?php 

		require_once'controller/controller.php';
	
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Forgot PAssword</title>
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
				<h3 class="text-center"><b>Recover your Pssword</b></h3>  <br>
				<p class="text">
					please Enter your Email Address you used to sign up on this Site and we will
					assist you in recovering your password
				</p>
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
				<form action="forgot_password.php" method="POST">
					<label>Email</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="Email"  class="form-control" name="email" placeholder="Email"  required="">
					</div>

					
					

					<input type="submit" name="forgot-password-btn" value="Recover Password" class="btn btn-info btn-block" >
				</form>
			</div>
			<div class="col-md-4">
				&nbsp;
			</div>
		</div>
	</div>
</body>
</html>