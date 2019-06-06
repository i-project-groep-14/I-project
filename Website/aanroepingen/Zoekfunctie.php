<?php
require_once "connectie.php";

$zoekterm = "";

// if (isset($_POST['zoeken'])) {
//     try {
//         $zoekterm = $_POST['zoekwoord'];
//         $sql = "SELECT titel FROM voorwerp WHERE titel like '%:zoekterm%'";
//         $query = $dbh->prepare($sql);
//         $query -> execute(array(
//             ':zoekterm' => $zoekterm
//         ));

//         $row = $query -> fetch();
        
//         }
//     } catch (PDOException $e) {
//        die ("Fout met de database: {$e->getMessage()} ");
//     }
// }

?>

<form method="post">
    <div class="ZoekProduct">
        <input class="InputZoekProduct" type="search" name="zoekwoord" placeholder="Zoek product...">
        <input type="submit" class="button" name="zoeken" value="Zoek">
    </div>
</form>


