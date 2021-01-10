<?php 

	
// Import PHPMailer classes into the global namespace
		// These must be at the top of your script, not inside a function
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\SMTP;
		use PHPMailer\PHPMailer\Exception;

		// Load Composer's autoloader
		require 'vendor/autoload.php';

		// Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
		    //Server settings
		    $mail->SMTPDebug = 2;                      // Enable verbose debug output
		    $mail->isSMTP();                                            // Send using SMTP
		    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		    $mail->Username   = 'scarlettsney@gmail.com';                     // SMTP username
		    $mail->Password   = 'holyspirit';                               // SMTP password
		    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
		     $mail->SMTPOptions = array(
        	'ssl' => array(
	            'verify_peer' => false,
	            'verify_peer_name' => false,
	            'allow_self_signed' => true
	                )
        );

		    //Recipients
		    $mail->setFrom('ilobatimothy@gmail.com', 'Message from Emeka Iloba Php Mailer now Working Thanks for your Support');
		    $mail->addAddress('scarlettsney@gmail.com', 'Emeka');     // Add a recipient
		    $mail->addAddress('casweeno2000@gmail.com ');               // Name is optional
		    $mail->addReplyTo('scarlettsney@gmail.com', 'Reply Here');
		    $mail->addCC('ilobatimothy@gmail.com');
		    $mail->addBCC('ilobatimothy@gmail.com');

		   

		    // Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Php Mailer Now Working Fine';
		    $mail->Body    = '<b>This is the HTML message body Sir<b> <b>in bold!</b>';
		    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $mail->send();
		    echo 'Message has been sent';
		} catch (Exception $e) {
		    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}








 ?>