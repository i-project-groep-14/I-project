    <?php
      $config = ['pagina' => 'rubriekenpagina'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';

    ?>

    <div class="holy-grail-middle">
      <!-- <form> -->
      <div class="row columns"> 
        <nav aria-label="You are here:">
          <ul class="breadcrumbs">
            <?php
              $actueleRubriek = $_GET['id'];
              $actueleParentRubriek = selectParentRubriekNummer($actueleRubriek);
                  
              if (heeftParentRubriek($actueleRubriek)) {
                $nietBovenaan = true;
                createProductRubrieken($actueleRubriek);
              }
            ?>
            <!-- <li><a href="Index.php">Home</a></li>
            <li><a href="#">Antiek en Kunst</a></li>
            <li><span class="show-for-sr">Current: </span> Kasten</li> -->
          </ul>
        </nav>
      </div>
      <!-- <br> -->

<!-- BEGIN FILTER -->
      <div class="ContainerRubriekenfilter">
        <form action="rubriekenpagina.php?id=<?php echo $_GET['id'];?>" method="post">
          <div class="FilterContainer">
            <div class="FilterPrijs">
              <h3>Prijs:</h3>
              <label>Vanaf:</label>
              <input type="text" name="filterprijslaagste" class="FilterPrijsLaag">
              <label>Tot:</label>
              <input type="text" name="filterprijshoogste" class="FilterPrijsLaag">
            </div>
            
            <!-- <div class="FilterLocatie">
              <h3>Locatie</h3>
              <br>
              <select class="Filtermeerkeuzevak"> 
                <option>Kies een plaats</option>
                <option>Den Haag</option>
                <option>Amsterdam</option>
                <option>Rotterdam</option>
                <option>Arnhem</option>
              </select>
            </div> -->
                    
            <div class="FilterSorteer">
              <h3>Sorteer op:</h3>
              <br>
              <select class="Filtermeerkeuzevak" name="sorteren"> 
                <option value="0">...</option>
                <option value="looptijdbeginDag asc, looptijdbeginTijdstip asc">Nieuwste</option>
                <option value="looptijdbeginDag desc, looptijdbeginTijdstip desc">Oudste</option>
                <option value="titel asc">Titel A-Z</option>
                <option value="titel desc">Titel Z-A</option>
                <option value="looptijdeindeDag asc, looptijdeindeTijdstip asc">Bijna aflopend</option>
              </select>
            </div>

            <div class="FilterZoek">
              <h3>Zoeken</h3>
              <br>
              <div class="ZoekProduct">
                <input class="InputZoekProduct" type="search" name="zoekwoord" placeholder="Zoek product...">
              </div>
            </div>
            <input type="submit" name="zoeken" value="Zoek">
          </div>
        </form>
<!--  EINDE FILTER  -->

    <?php
      if (isset($_POST['zoeken'])) {
        if(isset($_POST['zoekwoord']) && isset($_POST['filterprijslaagste']) && isset($_POST['filterprijshoogste']) && isset($_POST['sorteren'])) {
          $zoekterm = $_POST['zoekwoord'];
          $filterprijslaagste = $_POST['filterprijslaagste'];
          $filterprijshoogste = $_POST['filterprijshoogste'];
          $sorteren = $_POST['sorteren'];
          $sql = "SELECT voorwerp FROM [voorwerp in rubriek] r inner join voorwerp v on v.voorwerpnummer = r.voorwerp
                  WHERE [rubriek op laagste niveau] like :rubriek 
                  and v.titel like '%$zoekterm%'
                  and startprijs >= :filterprijslaagste and verkoopprijs >= :filterprijslaagste 
                  and startprijs <= :filterprijshoogste and verkoopprijs <= :filterprijshoogste
                  order by :sorteren";

          $query = $dbh->prepare($sql);
          $query -> execute(array(
            ':rubriek' => $_GET['id'],
            ':filterprijslaagste' => $filterprijslaagste,
            ':filterprijshoogste' => $filterprijshoogste,
            ':sorteren' => $sorteren
          ));
        }

        if(!isset($_POST['zoekwoord']) && isset($_POST['filterprijslaagste']) && isset($_POST['filterprijshoogste']) && isset($_POST['sorteren'])) {
          $filterprijslaagste = $_POST['filterprijslaagste'];
          $filterprijshoogste = $_POST['filterprijshoogste'];
          $sorteren = $_POST['sorteren'];
          $sql = "SELECT voorwerp FROM [voorwerp in rubriek] r inner join voorwerp v on v.voorwerpnummer = r.voorwerp
                  WHERE [rubriek op laagste niveau] like :rubriek
                  and startprijs >= :filterprijslaagste and verkoopprijs >= :filterprijslaagste 
                  and startprijs <= :filterprijshoogste and verkoopprijs <= :filterprijshoogste
                  order by :sorteren";

          $query = $dbh->prepare($sql);
          $query -> execute(array(
            ':rubriek' => $_GET['id'],
            ':filterprijslaagste' => $filterprijslaagste,
            ':filterprijshoogste' => $filterprijshoogste,
            ':sorteren' => $sorteren
          ));
        }

        if(isset($_POST['zoekwoord']) && !isset($_POST['filterprijslaagste']) && isset($_POST['filterprijshoogste']) && isset($_POST['sorteren'])) {
          $zoekterm = $_POST['zoekwoord'];
          $filterprijshoogste = $_POST['filterprijshoogste'];
          $sorteren = $_POST['sorteren'];
          $sql = "SELECT voorwerp FROM [voorwerp in rubriek] r inner join voorwerp v on v.voorwerpnummer = r.voorwerp
                  WHERE [rubriek op laagste niveau] like :rubriek 
                  and v.titel like '%$zoekterm%'
                  and startprijs <= :filterprijshoogste and verkoopprijs <= :filterprijshoogste
                  order by :sorteren";

          $query = $dbh->prepare($sql);
          $query -> execute(array(
            ':rubriek' => $_GET['id'],
            ':filterprijshoogste' => $filterprijshoogste,
            ':sorteren' => $sorteren
          ));
        }

        if(isset($_POST['zoekwoord']) && isset($_POST['filterprijslaagste']) && !isset($_POST['filterprijshoogste']) && isset($_POST['sorteren'])) {
          $zoekterm = $_POST['zoekwoord'];
          $filterprijslaagste = $_POST['filterprijslaagste'];
          $sorteren = $_POST['sorteren'];
          $sql = "SELECT voorwerp FROM [voorwerp in rubriek] r inner join voorwerp v on v.voorwerpnummer = r.voorwerp
                  WHERE [rubriek op laagste niveau] like :rubriek 
                  and v.titel like '%$zoekterm%'
                  and startprijs >= :filterprijslaagste and verkoopprijs >= :filterprijslaagste 
                  order by :sorteren";

          $query = $dbh->prepare($sql);
          $query -> execute(array(
            ':rubriek' => $_GET['id'],
            ':filterprijslaagste' => $filterprijslaagste,
            ':sorteren' => $sorteren
          ));
        }
        
        if(isset($_POST['zoekwoord']) && isset($_POST['filterprijslaagste']) && isset($_POST['filterprijshoogste']) && !isset($_POST['sorteren'])) {
          $zoekterm = $_POST['zoekwoord'];
          $filterprijslaagste = $_POST['filterprijslaagste'];
          $filterprijshoogste = $_POST['filterprijshoogste'];
          $sql = "SELECT voorwerp FROM [voorwerp in rubriek] r inner join voorwerp v on v.voorwerpnummer = r.voorwerp
                  WHERE [rubriek op laagste niveau] like :rubriek 
                  and v.titel like '%$zoekterm%'
                  and startprijs >= :filterprijslaagste and verkoopprijs >= :filterprijslaagste 
                  and startprijs <= :filterprijshoogste and verkoopprijs <= :filterprijshoogste";

          $query = $dbh->prepare($sql);
          $query -> execute(array(
            ':rubriek' => $_GET['id'],
            ':filterprijslaagste' => $filterprijslaagste,
            ':filterprijshoogste' => $filterprijshoogste
          ));
        }

        if(!isset($_POST['zoekwoord']) && !isset($_POST['filterprijslaagste']) && isset($_POST['filterprijshoogste']) && isset($_POST['sorteren'])) {
          $filterprijshoogste = $_POST['filterprijshoogste'];
          $sorteren = $_POST['sorteren'];
          $sql = "SELECT voorwerp FROM [voorwerp in rubriek] r inner join voorwerp v on v.voorwerpnummer = r.voorwerp
                  WHERE [rubriek op laagste niveau] like :rubriek 
                  and startprijs <= :filterprijshoogste and verkoopprijs <= :filterprijshoogste
                  order by :sorteren";

          $query = $dbh->prepare($sql);
          $query -> execute(array(
            ':rubriek' => $_GET['id'],
            ':filterprijshoogste' => $filterprijshoogste,
            ':sorteren' => $sorteren
          ));
        }

        if(!isset($_POST['zoekwoord']) && isset($_POST['filterprijslaagste']) && !isset($_POST['filterprijshoogste']) && isset($_POST['sorteren'])) {
          $filterprijslaagste = $_POST['filterprijslaagste'];
          $sorteren = $_POST['sorteren'];
          $sql = "SELECT voorwerp FROM [voorwerp in rubriek] r inner join voorwerp v on v.voorwerpnummer = r.voorwerp
                  WHERE [rubriek op laagste niveau] like :rubriek 
                  and startprijs >= :filterprijslaagste and verkoopprijs >= :filterprijslaagste 
                  order by :sorteren";

          $query = $dbh->prepare($sql);
          $query -> execute(array(
            ':rubriek' => $_GET['id'],
            ':filterprijslaagste' => $filterprijslaagste,
            ':sorteren' => $sorteren
          ));
        }

        if(!isset($_POST['zoekwoord']) && isset($_POST['filterprijslaagste']) && isset($_POST['filterprijshoogste']) && !isset($_POST['sorteren'])) {
          $filterprijslaagste = $_POST['filterprijslaagste'];
          $filterprijshoogste = $_POST['filterprijshoogste'];
          $sql = "SELECT voorwerp FROM [voorwerp in rubriek] r inner join voorwerp v on v.voorwerpnummer = r.voorwerp
                  WHERE [rubriek op laagste niveau] like :rubriek 
                  and startprijs >= :filterprijslaagste and verkoopprijs >= :filterprijslaagste 
                  and startprijs <= :filterprijshoogste and verkoopprijs <= :filterprijshoogste";

          $query = $dbh->prepare($sql);
          $query -> execute(array(
            ':rubriek' => $_GET['id'],
            ':filterprijslaagste' => $filterprijslaagste,
            ':filterprijshoogste' => $filterprijshoogste,
          ));
        }

        if(isset($_POST['zoekwoord']) && !isset($_POST['filterprijslaagste']) && !isset($_POST['filterprijshoogste']) && isset($_POST['sorteren'])) {
          $zoekterm = $_POST['zoekwoord'];
          $sorteren = $_POST['sorteren'];
          $sql = "SELECT voorwerp FROM [voorwerp in rubriek] r inner join voorwerp v on v.voorwerpnummer = r.voorwerp
                  WHERE [rubriek op laagste niveau] like :rubriek 
                  and v.titel like '%$zoekterm%'
                  order by :sorteren";

          $query = $dbh->prepare($sql);
          $query -> execute(array(
            ':rubriek' => $_GET['id'],

            ':sorteren' => $sorteren
          ));
        }

        if(isset($_POST['zoekwoord']) && !isset($_POST['filterprijslaagste']) && isset($_POST['filterprijshoogste']) && !isset($_POST['sorteren'])) {
          $zoekterm = $_POST['zoekwoord'];
          $filterprijshoogste = $_POST['filterprijshoogste'];
          $sql = "SELECT voorwerp FROM [voorwerp in rubriek] r inner join voorwerp v on v.voorwerpnummer = r.voorwerp
                  WHERE [rubriek op laagste niveau] like :rubriek 
                  and v.titel like '%$zoekterm%'
                  and startprijs <= :filterprijshoogste and verkoopprijs <= :filterprijshoogste";

          $query = $dbh->prepare($sql);
          $query -> execute(array(
            ':rubriek' => $_GET['id'],
            ':filterprijshoogste' => $filterprijshoogste,
          ));
        }

        if(isset($_POST['zoekwoord']) && isset($_POST['filterprijslaagste']) && !isset($_POST['filterprijshoogste']) && !isset($_POST['sorteren'])) {
          $zoekterm = $_POST['zoekwoord'];
          $filterprijslaagste = $_POST['filterprijslaagste'];
          $sql = "SELECT voorwerp FROM [voorwerp in rubriek] r inner join voorwerp v on v.voorwerpnummer = r.voorwerp
                  WHERE [rubriek op laagste niveau] like :rubriek 
                  and v.titel like '%$zoekterm%'
                  and startprijs >= :filterprijslaagste and verkoopprijs >= :filterprijslaagste"; 

          $query = $dbh->prepare($sql);
          $query -> execute(array(
            ':rubriek' => $_GET['id'],
            ':filterprijslaagste' => $filterprijslaagste
          ));
        }

        if(!isset($_POST['zoekwoord']) && !isset($_POST['filterprijslaagste']) && !isset($_POST['filterprijshoogste']) && isset($_POST['sorteren'])) {
          $sorteren = $_POST['sorteren'];
          $sql = "SELECT voorwerp FROM [voorwerp in rubriek] r inner join voorwerp v on v.voorwerpnummer = r.voorwerp
                  WHERE [rubriek op laagste niveau] like :rubriek 
                  order by :sorteren";

          $query = $dbh->prepare($sql);
          $query -> execute(array(
            ':rubriek' => $_GET['id'],
            ':sorteren' => $sorteren
          ));
        }

        if(!isset($_POST['zoekwoord']) && !isset($_POST['filterprijslaagste']) && isset($_POST['filterprijshoogste']) && !isset($_POST['sorteren'])) {

          $filterprijshoogste = $_POST['filterprijshoogste'];
          $sql = "SELECT voorwerp FROM [voorwerp in rubriek] r inner join voorwerp v on v.voorwerpnummer = r.voorwerp
                  WHERE [rubriek op laagste niveau] like :rubriek 
                  and startprijs <= :filterprijshoogste and verkoopprijs <= :filterprijshoogste";

          $query = $dbh->prepare($sql);
          $query -> execute(array(
            ':rubriek' => $_GET['id'],
            ':filterprijshoogste' => $filterprijshoogste,
          ));
        }

        if(isset($_POST['zoekwoord']) && !isset($_POST['filterprijslaagste']) && !isset($_POST['filterprijshoogste']) && !isset($_POST['sorteren'])) {
          $zoekterm = $_POST['zoekwoord'];
          $sql = "SELECT voorwerp FROM [voorwerp in rubriek] r inner join voorwerp v on v.voorwerpnummer = r.voorwerp
                  WHERE [rubriek op laagste niveau] like :rubriek 
                  and v.titel like '%$zoekterm%'";

          $query = $dbh->prepare($sql);
          $query -> execute(array(
            ':rubriek' => $_GET['id'],
          ));
        }
          
        
        $zoeken = false;
        while ($row = $query -> fetch()) {
          createZoekVoorwerpen($row['voorwerp']);
          $zoeken = true;
        }
        if($zoeken == false) {
          if ($row['voorwerp'] == NULL) {
            echo "
            <div data-closable class='callout alert-callout-border alert radius'>
              Er zijn geen zoekresultaten.
              <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
          }
        }
      }
    ?>
        <!-- </form> -->
      </div>

      <?php    
        if (!isset($_POST['zoeken'])) {
          $aantalVoorwerpen = selectAantalVoorwerpen($_GET['id']);

          $plek = 0;

          for($i = 0; $i < $aantalVoorwerpen; $i++) {
            $plek = createVoorwerpInRubriekItem($plek, $_GET['id']);
          }

          if ($aantalVoorwerpen == 0) {
            echo "
            <div data-closable class='callout alert-callout-border alert radius'>
              Er zijn geen producten in deze rubriek.
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

<script>
var upgradeTime = <?php echo $difference?>;
var seconds = upgradeTime;
function timer() {
  var days        = Math.floor(seconds/24/60/60);
  var hoursLeft   = Math.floor((seconds) - (days*86400));
  var hours       = Math.floor(hoursLeft/3600);
  var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
  var minutes     = Math.floor(minutesLeft/60);
  var remainingSeconds = seconds % 60;
  function pad(n) {
    return (n < 10 ? "0" + n : n);
  }
  document.getElementById('countdown').innerHTML = pad(days) + "d " + pad(hours) + "h " + pad(minutes) + "m " + pad(remainingSeconds) + "s ";
  if (seconds <= 0) {
    clearInterval(countdownTimer);
    document.getElementById('countdown').innerHTML = "Veiling is afgelopen!";
  } else {
    seconds--;
  }
}

var countdownTimer = setInterval('timer()', 1000);

function zoekFunctie() {
  // Declare variables 
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

</script>
