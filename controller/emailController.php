<?php 
// These must be at the top of your script, not inside a function
	    use PHPMailer\PHPMailer\PHPMailer;
	    use PHPMailer\PHPMailer\SMTP;
	    use PHPMailer\PHPMailer\Exception;
		
		   // Load Composer's autoloader
		    require 'vendor/autoload.php';

		    //Include Constants File
		    require_once 'db/constants.php';

	   
	function sendVerificationEmail($email, $token){
		// Import PHPMailer classes into the global namespace

		    // Instantiation and passing `true` enables exceptions
		  $mail = new PHPMailer(true);

		 try {
	        //Server settings
	        $mail->SMTPDebug = 2;                      // Enable verbose debug output
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
	        $mail->Subject = $subject;
	        $mail->Body    = $body;
	        $mail->AltBody = strip_tags($body);

	        $mail->send();
	        echo 'Message has been sent';
	    } catch (Exception $e) {
	        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	    }
	}
?>