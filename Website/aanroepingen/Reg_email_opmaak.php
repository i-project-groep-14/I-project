

<?php 
    //change this to your email. 
    $to = $_POST['email'];
    $from = "Noreply-EenmaalAndermaal@icasites.nl";
    $subject = 'Bevestingingscode EenmaalAndermaal';

    //begin of HTML message 
    $message ="
<html> 
  <body> 
    <h1 style='border-bottom:1px solid black; color: #F2552C;'>Welkom bij EenmaalAndermaal</h1>
    <img src='Images/eend.jpg' >
        <p> Beste gebruiker,<br> 
        ".$code."</p>

        
   
    
  </body>
</html>";
   //end of message 
    $headers  = "From: $from\r\n"; 
    $headers .= "Content-type: text/html\r\n";
    // now lets send the email. 
    mail($to, $subject, $message, $headers); 
?>