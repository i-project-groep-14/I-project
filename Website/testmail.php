<?php

$message = "Line 1\r\nLine 2\r\nLine 3";
$ontvanger = 'spamvandanny2000@gmail.com';
$onderwerp = 'Test';
$tekst = "Line 1\r\nLine 2\r\nLine 3";
$tekst = wordwrap($tekst, 70, "\r\n");
$headers = 'From: Noreply-EenmaalAndermaal@icasites.nl' . "\r\n" .
'X-Mailer: PHP/' . phpversion();

mail($ontvanger, $onderwerp, $tekst, $headers);