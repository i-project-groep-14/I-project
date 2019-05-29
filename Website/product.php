    <?php
      $config = ['pagina' => 'product'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';

      if (isset($_POST['voorwerp'])) {
        $_SESSION['voorwerp'] = $_POST['voorwerp'];
      }

      if (isset($_POST['bodgeplaatst'])) {
        $voorwerpnummer = $_SESSION['voorwerp'];
        $bod = $_POST['bod'];
        $gebruiker = $_SESSION['gebruikersnaam'];        

        $sql = "INSERT INTO bod VALUES
                (:voorwerpnummer, :bodbedrag, :gebruiker, GETDATE(), CONVERT(TIME,GETDATE()))";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
          ':voorwerpnummer' => $voorwerpnummer,
          ':bodbedrag' => $bod,
          ':gebruiker' => $gebruiker
          )
        );

        $sql = "UPDATE voorwerp
                SET verkoopprijs = :bod
                WHERE voorwerpnummer = :voorwerpnummer";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
          ':bod' => $bod,
          ':voorwerpnummer' => $voorwerpnummer
          )
        );
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

        $sql = "UPDATE voorwerp
                SET koper = :gebruiker
                WHERE voorwerpnummer = :voorwerpnummer";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
            ':gebruiker' => $_SESSION['gebruikersnaam'],
            ':voorwerpnummer' => $_SESSION['voorwerp']
        ));
      }

    ?>
    
    <?php  include_once 'aanroepingen/header.php'?>
        
    <div class="holy-grail-middle">
      <div class="ProductInformatie">
        <div class="row columns">
          <nav aria-label="You are here:">
            <ul class="breadcrumbs">
              <?php
                $sql = "SELECT [rubriek op laagste niveau] as rubriek FROM [voorwerp in rubriek]
                        WHERE voorwerp like :voorwerpnummer";
                $query = $dbh->prepare($sql);
                $query -> execute(array(
                    ':voorwerpnummer' => $_SESSION['voorwerp']
                ));
                $row = $query -> fetch();
                
                $actueleRubriek = $row['rubriek'];
                $actueleParentRubriek = selectParentRubriekNummer($actueleRubriek);
                
                if (heeftParentRubriek($actueleRubriek)) {
                  $nietBovenaan = true;
                  createProductRubrieken($actueleRubriek);
                }
              ?>
              <!-- <li><a href="#">Home</a></li>
              <li><a href="#">Features</a></li>
              <li class="disabled">Gene Splicing</li>
              <li><span class="show-for-sr">Current: </span> Cloning</li> -->
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
                } else {
                  $afbeelding = $row['filenaam'];
                }
                
                
                
                
            echo"
            <img id='myImg' class='thumbnail img-product' src=$afbeelding alt='afbeelding' >
            <div class='row small-up-4'>";
              createFotos(1);
              createFotos(2);
              createFotos(3);
              createFotos(4);
            echo"
            </div>
            ";
            ?>

          </div>

          <!--Toevoegen informatie aan de rechterkant-->
          <div class="medium-6 large-5 columns lijn">
            <?php
              $sql = "SELECT titel, verkoper, beschrijving, plaatsnaam, startprijs, verkoopprijs,verzendkosten, betalingswijze,betalingsinstructie, verzendinstructies, looptijdeindeDag, looptijdeindeTijdstip  FROM voorwerp
                      WHERE voorwerpnummer like :voorwerpnummer";
              $query = $dbh->prepare($sql);
              $query -> execute(array(
                  ':voorwerpnummer' => $_SESSION['voorwerp']
              ));

              $row = $query -> fetch();
                
              $titel = $row['titel'];
              $verkoper = $row['verkoper'];
              $beschrijving = $row['beschrijving'];
              $locatie = $row['plaatsnaam'];
              $startprijs = $row['startprijs'];
              $hoogstebod = $row['verkoopprijs'];
              $betalingswijze = $row['betalingswijze'];
              $verzendinstructies = $row['verzendinstructies'];
              $verzendkosten = $row['verzendkosten'];
              $betalingsinstructie = $row['betalingsinstructie'];
                
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
                $stapbieding  =  1; //stond op .50
              } else if($hoogstebod > 50 && $hoogstebod <= 100) {
                $stapbieding = 1;
              } else if($hoogstebod > 100 && $hoogstebod <= 500) {
                $stapbieding = 10;
              } else if($hoogstebod > 500 && $hoogstebod <= 2000) {
                $stapbieding = 100;
              } else {
                $stapbieding = 1;
              }
              // echo $stapbieding;
              $minimalebod = $hoogstebod + $stapbieding;
              // bieding
              echo"
            <h3>$titel</h3>
            <p><i>$verkoper</i></p>
            <div class='row'>
              <div class='small-3 columns'>
                <p class='middle'>Plaats:</p>
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
                if(isset($hoogstebod)) {
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
                    echo $hoogstebod;
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
            echo "
            <div>
              <table>
                <tr>
                  <th>Naam</th>
                  <th>Bod</th>
                </tr>
                <tr>
                  <td>Jill</td>
                  <td>€50</td>
                </tr>
              </table>
            </div>
            
            <p><button class='button large expanded' data-open='exampleModal1'>Bieden</button></p>
            <p>Looptijd:</p>
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
          <div class=" tabs-panel tabs-panelv is-active" id="panel1">
          <?php echo $beschrijving; ?>
            </div>
        <div class="tabs-panel tabs-panelv" id="panel2">
          <div class="row medium-up-3 large-up-5">
            <div class="tab-biedingen-omschrijving">
              <?php echo "
              <p class='middle'>Verzendingkosten:  $verzendkosten</p>
              <p class='middle'>Verzendinginstructies:  $verzendinstructies</p>
              <p class='middle'>Betalinginstructies:  $betalingsinstructie</p>
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
              
              <?php 
              if(isset($_SESSION['login'])) {
                // echo"<button class='button'>Bied mee!</button>";  is dit niet dubbel op??
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
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
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