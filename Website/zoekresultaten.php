<?php
      $config = ['pagina' => 'zoekresultaten'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';
    ?>

<div class="holy-grail-middle">
  <h1 class="InlogpaginaKopje">Zoekresultaten</h1>
  <?php
    if (isset($_POST['zoeken'])) {
      $zoekterm = $_POST['zoekwoord'];
      $sql = "SELECT voorwerp FROM [voorwerp in rubriek] r inner join voorwerp v on v.voorwerpnummer = r.voorwerp
              WHERE v.titel like '%$zoekterm%'";
      $query = $dbh->prepare($sql);
      $query -> execute();

      while ($row = $query -> fetch()) {
        createZoekVoorwerpen($row['voorwerp']);
      }

      if ($row['voorwerp'] == NULL) {
        echo "
        <div data-closable class='callout alert-callout-border alert radius'>
          Er zijn geen zoekresultaten voor $zoekterm
          <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>";
      }

      // echo $zoekterm;
    }
  ?>
</div>

    <?php 
      include_once 'aanroepingen/footer.html';
    ?>