<?php

$hostname = "(local)"; //Naam van de Server
$dbname = "EenmaalAndermaal"; //Naam van de DB
$username = "sa";      //Inlognaam
$pw = "test123";      //Password

$db = new PDO ("sqlsrv:Server=$hostname;Database=$dbname;","$username","$pw");



?>