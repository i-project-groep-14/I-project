

<?php 
    //change this to your email. 
    $to = $_POST['email'];
    $from = "Noreply-EenmaalAndermaal@icasites.nl";
    $subject = 'Bevestingingscode EenmaalAndermaal';

    //begin of HTML message 
    $message ="
<html> 
  <body > 
    <div style='background-color:white; width=100%; height:100px;'>
        <h1 style='border-bottom:1px solid black; color: #F2552C;'font-family:Calibri;>
            Bevestiging registratie / activatie
        </h1>
    </div>
    <div style='font-family:Calibri;'>
    <h2>Beste toekomstige gebruiker/verkoper,</h2><p> 
        Hartelijk dank voor het registreren op de website van EenmaalAndermaal. Vul onderstaande code in op de website om daarmee uw registratie te bevestigen en definitief te maken.</p><Br><br>

        <div style='height:150px; text-align:center; background-color:#F2552C; color:white; font-size:24px; font-weight:bold;'>".$code."</div>
        
        <br><Br>Met vriendelijke groet,<Br><Br>

        <p><span style='color:#F2552C;'>Team EenmaalAndermaal</span> | Groep 14</p>
    </div>
        
   
    
  </body>
</html>";
   //end of message 
    $headers  = "From: $from\r\n"; 
    $headers .= "Content-type: text/html\r\n";
    // now lets send the email. 
    mail($to, $subject, $message, $headers); 
?>