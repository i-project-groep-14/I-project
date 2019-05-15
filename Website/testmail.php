<?php

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// require 'C:\xampp\phpMyAdmin\vendor\composer\vendor\autoload.php';

// $mail = new PHPMailer(TRUE);

// try {
   
//    $mail->setFrom('darth@empire.com', 'Darth Vader');
//    $mail->addAddress('spamvandanny2000@gmail.com', 'Emperor');
//    $mail->Subject = 'Force';
//    $mail->Body = 'There is a great disturbance in the Force.';
   
//    /* SMTP parameters. */
   
//    /* Tells PHPMailer to use SMTP. */
//    $mail->isSMTP();
   
//    /* SMTP server address. */
//    $mail->Host = 'smtp.gmail.com';

//    /* Use SMTP authentication. */
//    $mail->SMTPAuth = TRUE;
   
//    /* Set the encryption system. */
//    $mail->SMTPSecure = 'tls';
   
//    /* SMTP authentication username. */
//    $mail->Username = 'iproject14';
   
//    /* SMTP authentication password. */
//    $mail->Password = 'YUdMkxu6eT';
   
//    /* Set the SMTP port. */
//    $mail->Port = 587;

//    /* Enable SMTP debug output. */
//    $mail->SMTPDebug = 2;
   
//    /* Finally send the mail. */
//    $mail->send();
// }
// catch (Exception $e)
// {
//    echo $e->errorMessage();
// }
// catch (\Exception $e)
// {
//    echo $e->getMessage();
// }





























    $message = "Line 1\r\nLine 2\r\nLine 3";
    $ontvanger = 'spamvandanny2000@gmail.com';
    $onderwerp = 'Test';
    $tekst = "Line 1\r\nLine 2\r\nLine 3";
    $tekst = wordwrap($tekst, 70, "\r\n");
    $headers = 'From: eenmaailandermaal@.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    
    mail($ontvanger, $onderwerp, $tekst, $headers);

//#!/bin/sh

// EXPECTED_SIGNATURE="$(wget -q -O - https://composer.github.io/installer.sig)"
// php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
// ACTUAL_SIGNATURE="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"

// if [ "$EXPECTED_SIGNATURE" != "$ACTUAL_SIGNATURE" ]
// then
//     >&2 echo 'ERROR: Invalid installer signature'
//     rm composer-setup.php
//     exit 1
// fi

// php composer-setup.php --quiet
// RESULT=$?
// rm composer-setup.php
// exit $RESULT

// wget https://raw.githubusercontent.com/composer/getcomposer.org/76a7060ccb93902cd7576b67264ad91c8a2700e2/web/installer -O - -q | php -- --quiet

// php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
// php -r "if (hash_file('sha384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
// php composer-setup.php
// php -r "unlink('composer-setup.php');"