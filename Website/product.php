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
              $sql = "SELECT titel, verkoper, beschrijving, plaatsnaam, startprijs, verkoopprijs, betalingswijze, verzendinstructies, looptijdeindeDag, looptijdeindeTijdstip FROM voorwerp
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
            <p>$beschrijving</p>

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
            </div>
            <a href='#' class='button large expanded'>Bieden</a>
            <p>Looptijd:</p>
            <div class='klok'>
              <p>$looptijd</p>
            </div>
            <p class='middle'>Betaling: $betalingswijze</p>
            <p class='middle'>Verzending: $verzendinstructies</p>
              ";
            ?>
          </div>
        </div>

        <!--De bieding tab onderin-->
        <div class="column row">
          <hr>
          <ul class="tabs" data-tabs id="example-tabs">
            <li class="tabs-title is-active"><a href="#panel1" >Biedingen</a></li>
          </ul>

          <div class="tabs-content" data-tabs-content="example-tabs">
            <div class="tabs-panel is-active" id="panel1">
              <h4>Biedingen</h4>
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
                echo"<button class='button'>Bied mee!</button>";
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php 
      include_once 'aanroepingen/footer.html';
    ?>
    
