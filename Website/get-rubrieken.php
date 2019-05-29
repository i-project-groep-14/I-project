<?php 
    require_once 'aanroepingen/connectie.php';
    if(isset($_GET['rubrieknummer'])){
        $rubrieknummer= $_GET['rubrieknummer'];
        $sql = "SELECT * FROM rubriek WHERE rubriek = :rubrieknummer";
        $query = $dbh->prepare($sql);
        $query -> execute(array(':rubrieknummer' => $rubrieknummer));

        $data = array();

        while($row = $query -> fetch()){
         array_push($data,$row);
         //echo json_encode($data);
        }
        echo json_encode($data);
    }

?>