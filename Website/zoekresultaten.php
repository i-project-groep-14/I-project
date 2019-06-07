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
      if ($zoekterm != NULL) {
        $sql = "SELECT voorwerp FROM [voorwerp in rubriek] r inner join voorwerp v on v.voorwerpnummer = r.voorwerp
                WHERE v.titel like '%$zoekterm%'";
        $query = $dbh->prepare($sql);
        $query -> execute();
        $zoeken = false;
        while ($row = $query -> fetch()) {
          createZoekVoorwerpen($row['voorwerp']);
          $zoeken = true;
        }

        if($zoeken == false) {
          if ($row['voorwerp'] == NULL) {
            echo "
            <div data-closable class='callout alert-callout-border alert radius'>
              Er zijn geen zoekresultaten voor $zoekterm.
              <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
          }
        }

        // unset($zoekterm);
      } else {
        echo "
        <div data-closable class='callout alert-callout-border alert radius'>
          <strong>Error</strong> - U heeft niks ingevuld.
          <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>";
      }
      
    }
  ?>

</div>

    <?php 
      include_once 'aanroepingen/footer.html';
    ?>