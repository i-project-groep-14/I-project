    <?php
      $config = ['pagina' => 'product'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php'; 
    ?>
      
    <?php  include_once 'aanroepingen/header.php'?>
        
    <div class="holy-grail-middle">
      <div class="ProductInformatie">
        <div class="row columns">
          <nav aria-label="You are here:">
            <ul class="breadcrumbs">
              <?php
                //Rubrieken pakken waar dit product inzit(meegegeven van als je op een link klikt)
              ?>
              <li><a href="#">Home</a></li>
              <li><a href="#">Features</a></li>
              <li class="disabled">Gene Splicing</li>
              <li><span class="show-for-sr">Current: </span> Cloning</li>
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
                    ':voorwerpnummer' => $_POST['voorwerp']
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
              $sql = "SELECT titel, verkoper, beschrijving, plaatsnaam, startprijs, verkoopprijs,verzendkosten, betalingswijze,betalingsinstructie, verzendinstructies, looptijdeindeDag, looptijdeindeTijdstip FROM voorwerp
                      WHERE voorwerpnummer like :voorwerpnummer";
              $query = $dbh->prepare($sql);
              $query -> execute(array(
                  ':voorwerpnummer' => $_POST['voorwerp']
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

              $looptijd = $days.'d '.$hours.'u '.$mins.'m '.$secs.'s';
              
              // bieding moet nog gefixed worden
              if($hoogstebod > 1 && $hoogstebod < 49.99){
                $stapbieding  =  0.50;
              } else {

              }
              // echo $stapbieding;
              $minimalebod = $hoogstebod + 1 ;
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
              <div class='small-9 columns'>
                <p><b>€$hoogstebod</b></p>
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
              <form action=''>
                <h1 class='InlogpaginaKopje'> Bieden </h1> 
                <i> (Bieden vanaf: € $hoogstebod)</i><Br>
                <Br>
                <input type='number' name='bod'  min='$minimalebod' step='1' required>
                <input type='submit' class='button large expanded' value='Plaats bod'>
              </form>

              </div>";
            }
            echo "<p><button class='button large expanded' data-open='exampleModal1'>Bieden</button></p>
            <p>Looptijd:</p>
            <div class='klok'>
            <div id='clockdiv'>
              <div>
                <span class='days' id='countdown'></span>
                
              </div>
            </div>
            <p><i style='font-size: 10px;'>(Dagen / Uren / Minuten / Seconden)</i></p>
            </div>
            
              ";
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
          <div class=" tabs-panel is-active" id="panel1">
          <?php echo $beschrijving?>
            </div>
        <div class="tabs-panel" id="panel2">
          <div class="row medium-up-3 large-up-5">
            <div class="tab-biedingen-omschrijving">
              <?php echo "
              <p class='middle'>Verzendingkosten:  $verzendkosten</p>
              <p class='middle'>Verzendinginstructies:  $verzendinstructies</p>
              <p class='middle'>Betalinginstructies:  $betalingsinstructie</p>
              <p class='middle'>Betaling: $betalingswijze </p>
              " 
              ?>
            </div>
          </div>
        </div>
        <div class="tabs-panel" id="panel3">
          <div class="row medium-up-3 large-up-5">
            <div class="tab-biedingen-omschrijving">
              <?php
                $plek = 0;
                $sql = "SELECT COUNT(*) as aantalBiedingen FROM bod
                        WHERE voorwerpnummer like :voorwerpnummer";
                $query = $dbh->prepare($sql);
                $query -> execute(array(
                  ':voorwerpnummer' => $_POST['voorwerp']
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
                  <div id="caption"></div>
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
  document.getElementById('countdown').innerHTML = pad(days) + ":" + pad(hours) + ":" + pad(minutes) + ":" + pad(remainingSeconds);
  if (seconds == 0) {
    clearInterval(countdownTimer);
    document.getElementById('countdown').innerHTML = "Completed";
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