<?php 
$to = $row['mailadres'];
$from = "Noreply-EenmaalAndermaal@icasites.nl";
$subject = "Uw veiling ".$row['titel']. " is afgelopen!!!!";

//begin of HTML message 
$message ="
<html>
<head>

</head>
<body >
<div style='background-color:white; width=100%; height:100px;'>
        <h1 style='border-bottom:1px solid black; color: #F2552C;'font-family:Calibri;>
        Beste ".$row['verkoper']."
        </h1>
    </div>
    
    <div style='font-family:Calibri;'>
    <p>Uw veiling '".$row['titel']."' is verlopen en verwijderd. De veiling is gewonnen door '".$row['koper']."' met als hoogste bod: ".$row['verkoopprijs']." . Wij hopen dat u het artikel met succes heeft verkocht. De artikel ter inzage beschikbaar op uw profielpagina </p><Br><br>

        </div>
        Wij zien u graag terug op EenmaalAndermaal <br>
        
        <br><Br>Met vriendelijke groet,<Br><Br>

        <p><a href='iproject14.icasites.nl'<span style='color:#F2552C; text-decoration: none;'>Team EenmaalAndermaal</span></a> | Groep 14</p>
        <img src='http://iproject14.icasites.nl/images/logo.png'  alt='' />
    </div>

</body>
</html>";
//end of message 
$headers  = "From: $from\r\n"; 
$headers .= "Content-Type: text/html; charset=utf-8\n";
// now lets send the email. 
mail($to, $subject, $message, $headers); 
?>