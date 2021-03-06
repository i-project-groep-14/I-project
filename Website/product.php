    <?php
      $config = ['pagina' => 'product'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';

      if (isset($_POST['voorwerp'])) {
        $_SESSION['voorwerp'] = $_POST['voorwerp'];
      }

      $sql = "SELECT veilingGesloten, looptijdeindeDag, looptijdeindeTijdstip FROM voorwerp
              WHERE voorwerpnummer = :voorwerpnummer";
      $query = $dbh->prepare($sql);
      $query -> execute(array(
          ':voorwerpnummer' => $_SESSION['voorwerp']
      ));
      $row = $query -> fetch();

      $looptijdeindeDag = $row['looptijdeindeDag'];
      $looptijdeindeTijdstip = $row['looptijdeindeTijdstip'];
      $combinedDT = date('Y-m-d H:i:s', strtotime("$looptijdeindeDag $looptijdeindeTijdstip"));
      if($row['veilingGesloten'] = 'niet' && timeDiff(date("Y-m-d H:i:s"),$combinedDT) <= 0) {
        $sql = "UPDATE voorwerp
                SET veilingGesloten = 'wel'
                WHERE voorwerpnummer = :voorwerpnummer";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
            ':voorwerpnummer' => $_SESSION['voorwerp']
        ));
        
        $sql = "SELECT gebruiker FROM bod 
                WHERE voorwerpnummer like :voorwerpnummer";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
            ':voorwerpnummer' => $_SESSION['voorwerp']
        ));

        $row = $query -> fetch();

        $sql = "UPDATE voorwerp
                SET koper = :gebruiker
                WHERE voorwerpnummer = :voorwerpnummer";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
            ':gebruiker' => $row['gebruiker'],
            ':voorwerpnummer' => $_SESSION['voorwerp']
        ));
        
        $sql = "SELECT v.verkoper, g.mailadres,v.titel,v.verkoopprijs,v.koper
                FROM voorwerp v inner join gebruiker g on v.verkoper = g.gebruikersnaam
                where v.voorwerpnummer = :voorwerpnummer";
                $query = $dbh->prepare($sql);
        $query -> execute(array(
            ':voorwerpnummer' => $_SESSION['voorwerp']
        ));
        $row = $query -> fetch();

        include_once 'aanroepingen/EindeveilingMail.php';
        
      }

      $sql = "SELECT veilingGesloten FROM voorwerp
            WHERE voorwerpnummer = :voorwerpnummer";
      $query = $dbh->prepare($sql);
      $query -> execute(array(
        ':voorwerpnummer' => $_SESSION['voorwerp']
      ));
      $row = $query -> fetch();

      if (isset($_POST['bodgeplaatst']) && $row['veilingGesloten'] == 'niet') {
      // echo "test";
      $voorwerpnummer = $_SESSION['voorwerp'];
      $bod = (float) $_POST['bod'];
      $gebruiker = $_SESSION['gebruikersnaam'];

      $melding = "  
      <div data-closable class='callout alert-callout-border success'>
        <strong>Yay!</strong> - Uw bieding is geplaatst.
        <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";

      //echo $bod;

      $sql = "INSERT INTO bod VALUES (:voorwerpnummer, :bodbedrag, :gebruiker, GETDATE(), CONVERT(TIME,GETDATE()))";
      $query = $dbh->prepare($sql);
      $query -> execute(array(
        ':voorwerpnummer' => $voorwerpnummer,
        ':bodbedrag' => $bod,
        ':gebruiker' => $gebruiker
      ));

        $sql = "UPDATE voorwerp
              SET verkoopprijs = :bod
              WHERE voorwerpnummer = :voorwerpnummer";
      $query = $dbh->prepare($sql);
      $query -> execute(array(
        ':bod' => $bod,
        ':voorwerpnummer' => $voorwerpnummer
      ));

      }

    ?>
        
    <div class="holy-grail-middle">
      <?php 
				if(isset($melding)) {
				  echo "<br>";
					echo $melding; 
					echo "<br>";
				}
			?>
      <div class="ProductInformatie">
        <div class="row columns">
          <nav aria-label="You are here:">
            <ul class="breadcrumbs">
              <?php
                // $sql = "SELECT [rubriek op laagste niveau] as rubriek FROM [voorwerp in rubriek]
                //         WHERE voorwerp like :voorwerpnummer";
                // $query = $dbh->prepare($sql);
                // $query -> execute(array(
                //     ':voorwerpnummer' => $_SESSION['voorwerp']
                // ));
                // $row = $query -> fetch();
                
                // $actueleRubriek = $row['rubriek'];
                // $actueleParentRubriek = selectParentRubriekNummer($actueleRubriek);
                
                // if (heeftParentRubriek($actueleRubriek)) {
                //   $nietBovenaan = true;
                //   createProductRubrieken($actueleRubriek);
                // }

                $sql = "SELECT [rubriek op laagste niveau] as rubriek FROM [voorwerp in rubriek]
                        WHERE voorwerp like :voorwerpnummer";
                $query = $dbh->prepare($sql);
                $query -> execute(array(
                    ':voorwerpnummer' => $_SESSION['voorwerp']
                ));
                $row = $query -> fetch();

                if (heeftParentRubriek($row['rubriek'])) {
                  createProductRubrieken($row['rubriek']);
                }
              ?>
            </ul>
          </nav>
        </div>

        <div class="row">
          <div class="medium-6 columns">
            <?php
                $sql = "SELECT filenaam FROM bestand
                        WHERE voorwerp like :voorwerpnummer";
                $query = $dbh->prepare($sql);
                $query -> execute(array(
                    ':voorwerpnummer' => $_SESSION['voorwerp']
                ));

                $row = $query -> fetch();
                if ($row['filenaam'] == NULL) {
                  $afbeelding = "images/imageplaceholder.png";
                } else if (substr($row['filenaam'],0,2) != "dt" ) {
                  $afbeelding = $row['filenaam'];
                } else {
                  $afbeelding = strip_tags("http://iproject14.icasites.nl/pics/".$row['filenaam']);
                }
                
            echo"
            <div class='row align-center'>
              <div class='product-image-gallery'>
            <img id='main-product-image' class='thumbnail img-product' src=$afbeelding alt=' ' >
            
            <table>
            ";
              createFotos(0);
              createFotos(1);
              createFotos(2);
              createFotos(3);
            echo"
            </table>
                
            </div>
            </div>
            ";
            ?>

          </div>

          <!--Toevoegen informatie aan de rechterkant-->
          <div class="medium-6 large-5 columns lijn">
            <?php
              $sql = "SELECT titel, verkoper, beschrijving, land, startprijs, verkoopprijs,verzendkosten, betalingswijze,betalingsinstructie, verzendinstructies, looptijdeindeDag, looptijdeindeTijdstip, veilingGesloten FROM voorwerp
                      WHERE voorwerpnummer like :voorwerpnummer";
              $query = $dbh->prepare($sql);
              $query -> execute(array(
                  ':voorwerpnummer' => $_SESSION['voorwerp']
              ));

              $row = $query -> fetch();
                
              $titel = strip_tags($row['titel']);
              $verkoper = strip_tags($row['verkoper']);
              $beschrijving = strip_tags($row['beschrijving']);
              $locatie = strip_tags($row['land']);
              $startprijs = $row['startprijs'];
              if($row['verkoopprijs'] == NULL) {
                $hoogstebod = $startprijs;
              } else {
                $hoogstebod = $row['verkoopprijs'];
              }
              $betalingswijze = strip_tags($row['betalingswijze']);
              $verzendinstructies = strip_tags($row['verzendinstructies']);
              $verzendkosten = strip_tags($row['verzendkosten']);
              $betalingsinstructie = strip_tags($row['betalingsinstructie']);
              $veilinggesloten = $row['veilingGesloten'];
                
              $looptijdeindeDag = $row['looptijdeindeDag'];
              $looptijdeindeTijdstip = $row['looptijdeindeTijdstip'];

              $combinedDT = date('Y-m-d H:i:s', strtotime("$looptijdeindeDag $looptijdeindeTijdstip"));
              $difference = timeDiff(date("Y-m-d H:i:s"),$combinedDT);
              $years = abs(floor($difference / 31536000));
              $days = abs(floor(($difference-($years * 31536000))/86400));
              $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
              $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));
              $secs = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))-($mins * 3600)/60));

              // $looptijd = $days.'d '.$hours.'u '.$mins.'m '.$secs.'s';
              
              // bieding moet nog gefixed worden
              if($hoogstebod > 1 && $hoogstebod <= 50) {
                $stapbieding  = .50;
              } else if($hoogstebod > 50 && $hoogstebod <= 500) {
                $stapbieding = 1;
              } else if($hoogstebod > 500 && $hoogstebod <= 1000) {
                $stapbieding = 5;
              } else if($hoogstebod > 1000 && $hoogstebod <= 5000) {
                $stapbieding = 10;
              } else {
                $stapbieding = 50;
              }
              // echo $stapbieding;
              $minimalebod = $hoogstebod + $stapbieding;
              // bieding
              echo"
            <h3 class='wrapword'>$titel</h3>
            <p><i>$verkoper</i></p>
            <div class='row'>
              <div class='small-3 columns'>
                <p class='middle'>Land:</p>
              </div>
              <div class='small-9 columns'>
                <p>$locatie</p>
              </div>
              
              <div class='small-3 columns'>
                <p class='middle'>Startprijs:</p>
              </div>
              <div class='small-9 columns'>
                <p>€$startprijs</p>
              </div>
              <div class='small-3 columns'>
                <p class='middle'>Huidige Prijs:</p>
              </div>
              <div class='small-9 columns'>";
                if($hoogstebod != $startprijs) {
                  echo"<p><b>€ $hoogstebod</b></p>";
                }
              echo"
              </div>
            </div>";
            if(!isset($_SESSION['login'])) {
              echo"
              <div class='reveal' id='exampleModal1' data-reveal>
                <button class='close-button' data-close aria-label='Close modal' type='button'>
                  <span aria-hidden='true'>&times;</span>
                </button>
                <div class='popupbieden'>
                  <h3 class='InlogpaginaKopje'> Log in om mee te bieden! </h3>
                  <br>
                  <p> Klik <a href='inlogpagina.php'> hier </a> om in te loggen, zodat u daarna meteen kunt bieden!</p>
                </div>
              </div>";
            } else {
              echo"
              <div class='reveal' id='exampleModal1' data-reveal>
                <button class='close-button' data-close aria-label='Close modal' type='button'>
                  <span aria-hidden='true'>&times;</span>
                </button>
                <form action='product.php' method='POST'>
                  <h1 class='InlogpaginaKopje'> Bieden </h1> 
                  <i> (Bieden vanaf: €";
                  if (isset($hoogstebod)) {
                    echo $minimalebod;
                  } else {
                    echo $startprijs;
                  }
                  echo ")</i><Br>
                  <Br>
                  <input type='number' name='bod' min='$minimalebod' step='1' required>
                  <input type='submit' class='button large expanded' value='Plaats bod' name='bodgeplaatst'>
                </form>
              </div>";
            }// tabel met top 4 biedingen moet nog dynamisch gemaakt worden
            if ($veilinggesloten == 'niet') {
              if(isset($_SESSION['gebruikersnaam'])) {
                if ($_SESSION['gebruikersnaam'] != $verkoper) {
                  echo"<p><button class='button large expanded' data-open='exampleModal1'>Bieden</button></p>";
                }
              } else {
                echo"<p><button class='button large expanded' data-open='exampleModal1'>Bieden</button></p>";
              }
            }
            echo "<p>Looptijd:</p>
            <div class='klok'>
            <div id='clockdiv'>
              <div>
                <span class='days' id='countdown'></span>
              </div>
            </div>
            <!--<p><i style='font-size: 10px;'>(Dagen / Uren / Minuten / Seconden)</i></p>-->
            </div>
              ";
              $_SESSION['hoogstebod'] = $hoogstebod;
            ?>
          </div>
        </div>

        <!--De bieding tab onderin-->
        <div class="column row">
          <hr>
          <ul class="tabs" data-tabs id="example-tabs">
            <li class="tabs-title is-active"><a href="#panel1" >Beschrijving</a></li>
            <li class="tabs-title"><a href="#panel2">Voorwaarden</a></li>
            <li class="tabs-title"><a href="#panel3">Bied geschiedenis</a></li>
          </ul>

        <div class="tab-biedingen tabs-content" data-tabs-content="example-tabs">
          <div class=" tabs-panel tabs-panelv is-active wrapword" id="panel1">
            <?php echo $beschrijving; ?>
          </div>
          <div class="tabs-panel tabs-panelv" id="panel2">
            <div class="row medium-up-3 large-up-5">
              <div class="tab-biedingen-omschrijving">
                <?php echo "
                <p class='middle'>Verzendingkosten: $verzendkosten</p>
                <p class='middle'>Verzendinginstructies: $verzendinstructies</p>
                <p class='middle'>Betalinginstructies: $betalingsinstructie</p>
                <p class='middle'>Betaling: $betalingswijze </p>
                ";
                ?>
              </div>
            </div>
          </div>
          <div class="tabs-panel tabs-panelv" id="panel3">
            <div class="row medium-up-3 large-up-5">
              <div class="tab-biedingen-omschrijving">
                <?php
                  $plek = 0;
                  $sql = "SELECT COUNT(*) as aantalBiedingen FROM bod
                          WHERE voorwerpnummer like :voorwerpnummer";
                  $query = $dbh->prepare($sql);
                  $query -> execute(array(
                    ':voorwerpnummer' => $_SESSION['voorwerp']
                  ));
                  $row = $query -> fetch();

                  for($i = 0; $i < $row['aantalBiedingen']; $i++) {
                    createBiedingen($plek);
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<!-- Afbeelding vergroten -->
<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption">

  </div>
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
</script>



<script>
$('.sim-thumb').on('click', function() {
  $('#main-product-image').attr('src', $(this).data('image'));
})


var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("main-product-image");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}


</script>