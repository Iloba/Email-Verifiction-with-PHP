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
        $mail->Username   = 'ilobatimothy@gmail.com';                     // SMTP username
        $mail->Password   = 'holyspirit2003';                               // SMTP password
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
        $mail->setFrom('scarlettsney@gmail.com', 'Emeka Iloba');
        $mail->addAddress('scarlettsney@gmail.com', 'Sney');     // Add a recipient
        $mail->addAddress('cafemalali@gmail.com');     
        $mail->addAddress('casweeno2000@gmail.com');            // Name is optional
        $mail->addReplyTo('scarlettsney@gmail.com', 'Information');
        $mail->addCC('scarlettsney@gmail.com');
        $mail->addBCC('scarlettsney@gmail.com');

       $body = '<p><strong style="color: red;">Hello there this is Emeka</strong> This is My First Email with Php Mailer</p>';

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Test Email From Php';
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>