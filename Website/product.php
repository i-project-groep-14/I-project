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
                //Rubrieken pakken waar dit product(meegegeven van als je op een link klikt)
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
                    ':voorwerpnummer' => $_SESSION['voorwerpnummer']
                ));

                $row = $query -> fetch();
                $afbeelding = $row['filenaam'];
                
                // $afbeelding = $row['filenaam'];
                // $afbeelding1 = $row['filenaam'];
                // $afbeelding = 'images/fiets.jpg';

                function createFotos($plek) {
                  global $dbh;
                  $volgendeplek = $plek+1;
                  $sql = "SELECT filenaam FROM bestand
                        WHERE voorwerp like :voorwerpnummer
                        ORDER BY filenaam OFFSET $plek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
                  $query = $dbh->prepare($sql);
                  $query -> execute(array(
                      ':voorwerpnummer' => $_SESSION['voorwerpnummer']
                  ));

                  $row = $query -> fetch();
                  $afbeelding = $row['filenaam'];
                  echo"
                    <div class='column'>
                      <img class='thumbnail' src='$afbeelding' alt='afbeelding'>
                    </div>
                  ";
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
                $sql = "SELECT titel, verkoper, beschrijving, plaatsnaam, startprijs, verkoopprijs, betalingswijze, verzendinstructies FROM voorwerp
                        WHERE voorwerpnummer like :voorwerpnummer";
                $query = $dbh->prepare($sql);
                $query -> execute(array(
                    ':voorwerpnummer' => $_SESSION['voorwerpnummer']
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
                // $titel = 'My Awesome Product';
                // $verkoper = 'Verkoper';
                // $beschrijving = 'Nunc eu ullamcorper orci. Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque faucibus vestibulum. Nulla at nulla justo, eget luctus tortor. Nulla facilisi. Duis aliquet egestas purus in.';
                // $locatie = 'Arnhem, Nederland';
                // $startprijs = '5,-';
                // $hoogstebod = '11,-';
                // $betalingswijze = 'IDEAL/Contant';
                // $verzendinstructies = 'Via PostNL/Zelf ophalen';

                $looptijd = '2d 12h 40m 33s';
            
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
                $sql = "SELECT gebruiker, bodbedrag, boddag, bodtijdstip FROM bod
                        WHERE voorwerpnummer like :voorwerpnummer";
                $query = $dbh->prepare($sql);
                $query -> execute(array(
                    ':voorwerpnummer' => $_SESSION['voorwerpnummer']
                ));

                $row = $query -> fetch();
                
                $gebruiker = $row['gebruiker'];
                $bod = $row['bodbedrag'];
                $dag = $row['boddag'];
                $tijd = $row['bodtijdstip'];
                // $gebruiker = 'Mike stevenson';
                // $bod = '1,-';
                // $dag = 'Een dag';
                // $tijd = 'Een tijd';

                $profielfoto = 'images/profielfotoPlaceholder.png';

                function biedingen($profielfoto, $gebruiker, $bodbedrag, $datum, $tijd) {
                  echo "
                  <div class='media-object stack-for-small'>
                    <div class='media-object-section'>
                      <img class='thumbnail' src='$profielfoto' alt='profielfoto'>
                    </div>

                    <div class='media-object-section'>
                      <h5>$gebruiker</h5>
                      <p>Geboden:€$bodbedrag</p>
                      <p><i>Datum van bod: $datum $tijd</i></p>
                    </div>
                  </div>";
                }

              biedingen($profielfoto, $gebruiker, $bod, $dag, $tijd);
              biedingen($profielfoto, $gebruiker, $bod, $dag, $tijd);
              biedingen($profielfoto, $gebruiker, $bod, $dag, $tijd);
              ?>
              
              <button class="button">Bied mee!</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php 
      include_once 'aanroepingen/footer.html';
    ?>
    
