	<?php 
	 // Import PHPMailer classes into the global namespace
	 	 use PHPMailer\PHPMailer\PHPMailer;
	    use PHPMailer\PHPMailer\SMTP;
	    use PHPMailer\PHPMailer\Exception;
		
	   // Load Composer's autoloader
	    require 'vendor/autoload.php';

	    //Include Constants File
	    require_once 'db/constants.php';

	session_start();

	//require Email Verification function in email controller.php
	require_once 'emailController.php';
	//Connection to Database
	require 'db/connect.php';

	//Make our Array Variable global
	$errors = array();

	//Initialize Form Variables
	$username = "";
	$email = "";
		
	//Register User
	if (isset($_POST['register-btn'])) {
		//Form Values MAke sure you trim them(Remove All White Spaces)
		$username = trim($_POST['username']);
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
		$passwordConf = trim($_POST['confirm_password']);


		//Validate User Input
		if (empty($username)) {
			$errors['username'] = "Username Field Required";
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = "Email Invalid";
		}
		if (empty($email)) {
			$errors['email'] = "Email Field Required";
		}
		if (empty($password)) {
			$errors['password'] = "Password Field Required";
		}
		if (strlen($password) < 8) {
			$errors['password_length'] = "Password Too Short It Must Be up to Eight 8 Characters";
		}
		if ($password !== $passwordConf) {
			$errors['password'] = "The Two Passwords Do Not Match";
		}

		//Check if Email Already Exists in Database
		$emailQuery = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
		$run_query = mysqli_query($conn, $emailQuery);
		if (mysqli_num_rows($run_query)  > 0) {
			$errors['email'] = "Email Already Exists";
		}

		//Check if Username Already Exists in Database
		$userQuery = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
		$run_query = mysqli_query($conn, $userQuery);
		if (mysqli_num_rows($run_query)  > 0) {
			$errors['user'] = "Username Already Exists";
		}

		//Check if there are no Errors in Our Array Variable of Errors
		if (count($errors) == 0) {
			//Encrypt Password First before sending to Database
			$password = password_hash($password, PASSWORD_DEFAULT);

			//Generate Token
			$token = bin2hex(random_bytes(50));

			// set Verified Attribute to false
			$verified = false;

			//Run Query
			$query = "INSERT INTO users(username, email, verified, token, password) VALUES('$username', '$email', '$verified', '$token', '$password')";
			$run_query = mysqli_query($conn, $query);
			if ($run_query) {
				//Login User After Registration
				$loginCred = "SELECT * FROM users WHERE username = '$username' && password = '$password'";
				$run_query = mysqli_query($conn, $loginCred);
				if (mysqli_num_rows($run_query) > 0) {
					while ($result = mysqli_fetch_assoc($run_query)) {

						//Set User Variables
						$_SESSION['id'] = $result['id'];
						$_SESSION['username'] = $result['username'];
						$_SESSION['email'] = $result['email'];
						$_SESSION['verified'] = $result['verified'];

						//Send Email Verification link After Registration
						

			    		// Instantiation and passing `true` enables exceptions
						  $mail = new PHPMailer(true);

						 try {
					        //Server settings
					        // $mail->SMTPDebug = 2;                      // Enable verbose debug output
					        $mail->isSMTP();                                            // Send using SMTP
					        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
					        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
					        $mail->Username   = $Semail;                     // SMTP username
					        $mail->Password   = $Spass;                               // SMTP password
					        $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
					        $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
					        // $mail->SMTPOptions = array(
					        // 'ssl' => array(
					        //     'verify_peer' => false,
					        //     'verify_peer_name' => false,
					        //     'allow_self_signed' => true
					        //         )
					        // );



					        //Recipients
					        $mail->setFrom($Semail);
					        $mail->addAddress($email);     
					        

					       $body = '
					       			<!DOCTYPE html>
									<html>
									<head>
										<title>Verify Email</title>
									</head>
									<body>
										<div class="wrapper">
											<p>
												Congratulations on your Signup on our Website.
												 Please Click on the Link below to verify your Email
											</p>
											<a href="http://localhost/email_ver/index.php?token='. $token .'">
												Verify Your Email Address
											</a>
										</div>
									</body>
									</html>
					       ';
					       $subject = '<b>Verify Your Email</b>';

					        // Content
					        $mail->isHTML(true);                                  // Set email format to HTML
					        $mail->Subject = strip_tags($subject);
					        $mail->Body    = $body;
					        $mail->AltBody = strip_tags($body);

					        $mail->send();
					        echo 'Message has been sent';
					    } catch (Exception $e) {
					        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
					    }



						//Display Flash Message to User
						$_SESSION['success'] = "You are now Logged in"; 

						//Set class of flash message to success
						$_SESSION['alert-class'] = "alert-success";

						//Redirect User to Dashboard(Index Page)
						header('location: index.php');

						//Exit
						exit();
					}
					
				}
				

			}else{
				$errors['reg_failed'] = "Registration Failed";
			}
		}

	}

	//Log a User In
	if (isset($_POST['login-btn'])) {
		$username = trim( $_POST['username']);
		$password =  trim($_POST['password']);

		//Validate input
		if (empty($username)) {
			$errors['username'] = "Username Field Required";
		}if (empty($password)) {
			$errors['password'] = "Password Field Required";
		}

		if (count($errors) === 0) {
			$query = "SELECT * FROM users WHERE email = '$username' OR  username = '$username' LIMIT 1";
			$run_query = mysqli_query($conn, $query);
			if (mysqli_num_rows($run_query) > 0) {
				while ($result = mysqli_fetch_assoc($run_query)) {
					if (password_verify($password, $result['password'])) {
						//Login User
						$_SESSION['id'] = $result['id'];
						$_SESSION['username'] = $result['username'];
						$_SESSION['email'] = $result['email'];
						$_SESSION['verified'] = $result['verified'];

						//Set Flash Message
						$_SESSION['success'] = "You are Now Logged in!! Welcome";
						$_SESSION['alert-class'] = "alert-success";

						//Redirect to dahboard
						header('location: index.php', '_blank');
						exit();

					}else{
						$errors['password'] = "Password Incorrect";
					}
				}
			
			}else{
				$errors['login_failed'] = "Invalid Login Credentials";
			}
		}
		
	}

	//Logout User
	if (isset($_GET['logout'])) {
		unset($_SESSION['id']);
		unset($_SESSION['username']);
		unset($_SESSION['email']);
		unset($_SESSION['verified']);
		session_destroy();
		header('location: login.php');
		exit();
	}

	//Verify User By Token
	function verifyUser($token){
		global $conn;
		$query = "SELECT * FROM users WHERE token='$token' LIMIT 1";
		$run_query = mysqli_query($conn, $query);

		if (mysqli_num_rows($run_query) > 0) {
			while ($user = mysqli_fetch_assoc($run_query)) {
				$UpdateQuery = "UPDATE users SET verified=1 WHERE token = '$token'";
				if (mysqli_query($conn, $UpdateQuery)) {
					//Login User
						$_SESSION['id'] = $user['id'];
						$_SESSION['username'] = $user['username'];
						$_SESSION['email'] = $user['email'];
						$_SESSION['verified'] = 1;

						//Set Flash Message
						$_SESSION['success'] = "You Email Was Successfully Verified!!";
						$_SESSION['alert-class'] = "alert-success";

						//Redirect to dahboard
						header('location: index.php', '_blank');
						exit();

				}
			}
		}else{
			echo "User Not Found";
		}
	}


	//Forgot  Password
	if (isset($_POST['forgot-password-btn'])) {
		$email = $_POST['email'];


		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = "Email Invalid";
		}
		if (empty($email)) {
			$errors['email'] = "Email Field Required";
		}

		if (count($errors) == 0) {
			$query = "SELECT * FROM users WHERE email = '$email'";
			$run_query = mysqli_query($conn, $query);
			while ($user = mysqli_fetch_assoc($run_query)) {
				$token = $user['token'];

				//Send Password Reset Link
				 $mail = new PHPMailer(true);

					 try {
				        //Server settings
				        // $mail->SMTPDebug = 2;                      // Enable verbose debug output
				        $mail->isSMTP();                                            // Send using SMTP
				        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
				        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
				        $mail->Username   = $Semail;                     // SMTP username
				        $mail->Password   = $Spass;                               // SMTP password
				        $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
				        $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
				        // $mail->SMTPOptions = array(
				        // 'ssl' => array(
				        //     'verify_peer' => false,
				        //     'verify_peer_name' => false,
				        //     'allow_self_signed' => true
				        //         )
				        // );



				        //Recipients
				        $mail->setFrom($Semail);
				        $mail->addAddress($email);     
				        

				       $body = '
				       			<!DOCTYPE html>
								<html>
								<head>
									<title>Reset Your Password</title>
								</head>
								<body>
									<div class="wrapper">
										<p>
											Hello, There Please Click on the Link Below to reset your Password.
										</p>
										<a href="http://localhost/email_ver/index.php?password-token='. $token .'">
											Reset Your Password
										</a>
									</div>
								</body>
								</html>
				       ';
				       $subject = '<b>Reset Your Password</b>';

				        // Content
				        $mail->isHTML(true);                                  // Set email format to HTML
				        $mail->Subject = strip_tags($subject);
				        $mail->Body    = $body;
				        $mail->AltBody = strip_tags($body);

				        $mail->send();
				        echo 'Message has been sent';
				    } catch (Exception $e) {
				        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				    }


				//Redirect to Password Reset Page
				header('location: password_message.php');
				exit(0);


			}
		}
	}


	//Update Password
	if (isset($_POST['reset-password-btn'])) {
		$newPassword = $_POST['new_password'];
		$newConfPassword = $_POST['conf_new_password']; 


		//Validate
		if (empty($newPassword)) {
			$errors['password'] = "Password Field Required";
		}
		if (strlen($newPassword) < 8) {
			$errors['password_length'] = "Password Too Short It Must Be up to Eight 8 Characters";
		}
		if ($newPassword !== $newConfPassword) {
			$errors['password'] = "The Two Passwords Do Not Match";
		}

		$newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
		$email = $_SESSION['email'];

		if (count($errors) == 0) {
			$query = "UPDATE users SET password = '$newPassword' WHERE email = '$email'";
			$run_query = mysqli_query($conn, $query);
			if ($run_query) {
				header('location: login.php');
				exit(0);
			}
		}
	}


	//Reset Password
	function resetPassword($token){
		global $conn;
		$query = "SELECT *  FROM users WHERE token = '$token' LIMIT 1";
		$run_query = mysqli_query($conn, $query);
		if (mysqli_num_rows($run_query) > 0) {
			while ($user = mysqli_fetch_assoc($run_query)) {
				$_SESSION['email'] = $user['email'];
				header('location: reset_password.php');
				exit(0);
			}
		}
	}
?>