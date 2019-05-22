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
            <img class='thumbnail img-product' src=$afbeelding alt='afbeelding'>
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
                <h1> Aanloggen </h1>
                <p>U moet aangelogd zijn om mee te kunnen bieden op veilingen!</p>
                <p> Klik <a href='inlogpagina.php'> hier </a> om mee te bieden!!!!!!!!!!</p>
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
                <input type='text' name='fname' placeholder='€' type='number' pattern='[-+]?[0-9]*[.,]?[0-9]+' required><br>
                <input type='submit' class='button large expanded' value='Plaats bod'>
              </form>

              </div>";
            }
            echo "<p><button class='button large expanded' data-open='exampleModal1'>Bieden</button></p>
            <p>Looptijd:</p>
            <div class='klok'>
              <p>$looptijd</p>
            </div>
            <p class='middle'>Betaling: $betalingswijze </p>
              ";
            ?>
          </div>
        </div>

        <!--De bieding tab onderin-->
        <div class="column row">
          <hr>
          <ul class="tabs" data-tabs id="example-tabs">
            <li class="tabs-title is-active"><a href="#panel1" >Biedingen</a></li>
            <li class="tabs-title"><a href="#panel2">Beschrijving</a></li>
            <li class="tabs-title"><a href="#panel3">Voorwaarden</a></li>
          </ul>

        <div class="tab-biedingen tabs-content" data-tabs-content="example-tabs">
          <div class=" tabs-panel is-active" id="panel1">
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
        <div class="tabs-panel" id="panel2">
          <div class="row medium-up-3 large-up-5">
            <div class="tab-biedingen-omschrijving">
              <?php echo $beschrijving?>
            </div>
          </div>
        </div>
        <div class="tabs-panel" id="panel3">
          <div class="row medium-up-3 large-up-5">
            <div class="tab-biedingen-omschrijving">
              <?php echo "
              <p class='middle'>Verzendingkosten:  $verzendkosten</p>
              <p class='middle'>Verzendinginstructies:  $verzendinstructies</p>
              <p class='middle'>Betalinginstructies:  $betalingsinstructie</p>
              "
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</div>
              
        
      
    

    <?php 
      include_once 'aanroepingen/footer.html';
    ?>
    
