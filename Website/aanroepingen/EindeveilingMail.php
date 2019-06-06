<?php 
$to = $row['mailadres'];
$from = "Noreply-EenmaalAndermaal@icasites.nl";
$subject = 'Bevestingingscode EenmaalAndermaal';

//begin of HTML message 
$message ="
<html> 
<body >
<div style='background-color:white; width=100%; height:100px;'>
        <h1 style='border-bottom:1px solid black; color: #F2552C;'font-family:Calibri;>
        Beste ".$row['verkoper']."
        </h1>
    </div>

</body>
</html>";
//end of message 
$headers  = "From: $from\r\n"; 
$headers .= "Content-type: text/html\r\n";
// now lets send the email. 
mail($to, $subject, $message, $headers); 
?>