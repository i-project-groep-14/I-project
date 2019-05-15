<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'C:\xampp\phpMyAdmin\vendor\composer\vendor\autoload.php';

$mail = new PHPMailer(TRUE);

try {
   
   $mail->setFrom('darth@empire.com', 'Darth Vader');
   $mail->addAddress('spamvandanny2000@gmail.com', 'Emperor');
   $mail->Subject = 'Force';
   $mail->Body = 'There is a great disturbance in the Force.';
   
   /* SMTP parameters. */
   
   /* Tells PHPMailer to use SMTP. */
   $mail->isSMTP();
   
   /* SMTP server address. */
   $mail->Host = 'ftp2.iproject.icasites.nl';

   /* Use SMTP authentication. */
   $mail->SMTPAuth = TRUE;
   
   /* Set the encryption system. */
   $mail->SMTPSecure = 'tls';
   
   /* SMTP authentication username. */
   $mail->Username = 'iproject14';
   
   /* SMTP authentication password. */
   $mail->Password = 'YUdMkxu6eT';
   
   /* Set the SMTP port. */
   $mail->Port = 587;

   /* Enable SMTP debug output. */
   $mail->SMTPDebug = 2;
   
   /* Finally send the mail. */
   $mail->send();
}
catch (Exception $e)
{
   echo $e->errorMessage();
}
catch (\Exception $e)
{
   echo $e->getMessage();
}



// $message = "Line 1\r\nLine 2\r\nLine 3";
// $ontvanger = 'spamvandanny2000@gmail.com';
// $onderwerp = 'Test';
// $tekst = "Line 1\r\nLine 2\r\nLine 3";
// $tekst = wordwrap($tekst, 70, "\r\n");
// $headers = 'From: eenmaailandermaal@.com' . "\r\n" .
// 'X-Mailer: PHP/' . phpversion();

// mail($ontvanger, $onderwerp, $tekst, $headers);