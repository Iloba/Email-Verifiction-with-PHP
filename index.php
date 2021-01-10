<?php 

	require_once 'controller/controller.php';

	//Verify The User Using the Token
	if (isset($_GET['token'])) {
		$token = $_GET['token'];
		verifyUSer($token);
	}

	//Verify The User Using the Token
	if (isset($_GET['password-token'])) {
		$Passwordtoken = $_GET['password-token'];
		resetPassword($Passwordtoken);
	}

	//Users Who Are Not Logged in Can not Access the Page
	if (!isset($_SESSION['id'])) {
		header('location: login.php');
	}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>ADMIN PAGE</title>
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
		<h2 class="text-center head">ADMIN DASHBOARD</h2>
	</header>
	<div class="container">
		<div class="row">
			<div class="col-md-4 offset-md-4" id="Admin"><br>

				<?php 

					//check if Session Message Exists
					if (isset($_SESSION['success'])) :
						?>
						<!--Alert-->
						<div class="alert <?php echo $_SESSION['alert-class'];  ?>">
					
							<?php
						echo $_SESSION['success'];

						//Unset Mesage after displaying it
						unset($_SESSION['success']);

						//Unset Alert Class Also
						unset($_SESSION['alert-class']);
						?>
						
						</div>
				<?php endif; ?>

			
				<!--Welcome Message for User-->
				<h3>Welcome, <?php echo $_SESSION['username']; ?></h3>

				<!--Logout Link--->
				<a href="index.php?logout=1" class="logout">Logout</a>

				<?php 
					//if User is Not Verified show Verification Aler Prompt
					if (!$_SESSION['verified']) :
						
					?>
					<!--Verify Email Alert--->
				<div class="alert alert-danger">
					You Need to Verify your Email Address.
					We Just Sent a Verify Link to your Email Address, 
					<strong><?php echo $_SESSION['email']; ?></strong>
					Please Click the Link to Verify your Account
					
				</div>
				<?php
					endif;
				 ?>
				
				<?php 
					//If user is verified, Show Verified Button
					if ($_SESSION['verified']) :
					
					?>
					<!--Verified Account Alert-->
				<button class="btn btn-primary btn-lg btn-block">Account Verified!</button>

				<?php
					endif;
				 ?>

				
			</div>
		</div>
	</div>
</body>
</html>