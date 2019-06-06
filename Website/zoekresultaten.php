<?php
      $config = ['pagina' => 'zoekresultaten'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';

      if (isset($_POST['zoeken'])) {
        $zoekterm = $_POST['zoekwoord'];
        $sql = "SELECT [rubriek op laagste niveau] as rubriek FROM [voorwerp in rubriek] r inner join voorwerp v on v.voorwerpnummer = r.voorwerp
                WHERE v.titel like '%$zoekterm%'";
        $query = $dbh->prepare($sql);
        $query -> execute();

        $plek = 0;
        while ($row = $query -> fetch()) {  
          $aantalVoorwerpen = selectAantalVoorwerpen($row['rubriek']);
  
          for($i = 0; $i < $aantalVoorwerpen; $i++) {
            $plek = createVoorwerpInRubriekItem($plek, $row['rubriek']);
          }
        }

        // echo $zoekterm;
      }

    ?>

<div class="holy-grail-middle">
<h1 class="InlogpaginaKopje">Zoekresultaten</h1>









</div> 
<?php 
      include_once 'aanroepingen/footer.html';
    ?>