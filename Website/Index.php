    <?php
      $config = ['pagina' => 'index'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';
    ?>

    <div class="holy-grail-middle">
      <?php 
        if(isset($_SESSION['login'])) {
                                            // verander in 0
          if($_SESSION['aantaleigenveilingen'] != 0) {
            function timeDiff($firstTime,$lastTime){
              $firstTime=strtotime($firstTime);
              $lastTime=strtotime($lastTime);
           
              $timeDiff=$lastTime-$firstTime;
           
              return $timeDiff;
            }

            function createHomepageItem($actueleplek) {
              global $dbh;
              settype($actueleplek, "int");
              $volgendeplek = $actueleplek+1;
              
              $sql = "SELECT veilingGesloten FROM voorwerp 
                      WHERE verkoper like :gebruikersnaam
                      ORDER BY titel OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
              $query = $dbh->prepare($sql);
              $query -> execute(array(
                  ':gebruikersnaam' => $_SESSION['gebruikersnaam']
              ));

              $row = $query -> fetch();

              global $plek;
              
              if ($row['veilingGesloten'] == 'niet') {
                $sql = "SELECT titel, verkoopprijs, looptijdeindeDag, looptijdeindeTijdstip, voorwerpnummer FROM voorwerp 
                        WHERE verkoper like :gebruikersnaam
                        ORDER BY titel OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
                $query = $dbh->prepare($sql);
                $query -> execute(array(
                    ':gebruikersnaam' => $_SESSION['gebruikersnaam']
                ));

                $row = $query -> fetch();

                $titel = $row['titel'];
                $hoogstebod = $row['verkoopprijs'];
                $voorwerpnummer = $row['voorwerpnummer'];
                $looptijdeindeDag = $row['looptijdeindeDag'];
                $looptijdeindeTijdstip = $row['looptijdeindeTijdstip'];$combinedDT = date('Y-m-d H:i:s', strtotime("$looptijdeindeDag $looptijdeindeTijdstip"));
                $difference = timeDiff(date("Y-m-d H:i:s"),$combinedDT);
                $years = abs(floor($difference / 31536000));
                $days = abs(floor(($difference-($years * 31536000))/86400));
                $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
                // $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);

                $sql = "SELECT filenaam FROM bestand
                WHERE voorwerp like :voorwerpnummer";
                $query = $dbh->prepare($sql);
                $query -> execute(array(
                    ':voorwerpnummer' => $voorwerpnummer
                ));

                $row = $query -> fetch();

                if ($row['filenaam'] == NULL) {
                  $afbeelding = "images/imageplaceholder.png";
                } else {
                  $afbeelding = $row['filenaam'];
                }
                
                echo"
                <div class='card'>
                  <img src='$afbeelding' alt='fiets'>
                  <h4>$titel</h4>
                  <p class='price'>€$hoogstebod</p>
                  <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: "."$days"."d $hours"."u</p>
                  <a href='product.php' class='button ProductButton'>Bekijk Meer!</a>
                </div>
                ";
                $plek += 1;
              } else {
                $plek = $volgendeplek;
                createHomepageItem($plek);
              }
            }
            $sql = "SELECT rol FROM gebruiker 
            WHERE gebruikersnaam like :gebruikersnaam";
            $query = $dbh->prepare($sql);
            $query -> execute(array(
                ':gebruikersnaam' => $_SESSION['gebruikersnaam']
            ));

            $row = $query -> fetch();
            if ($row['rol'] != 2) {
              echo "
              <h3 class='HomePageTitel'>Uw veilingen</h3>
              <div class='ProductenContainer'>
              ";
              $plek = 0;
              for($i = 0; $i < 4; $i++) {
                createHomepageItem($plek);
              }
              echo "</div>";
            }
          }
        }
      ?>

      <h3 class='HomePageTitel'>De populairste veilingen</h3>
      <div class='ProductenContainer'>
        <div class="card">
          <img src="images/fiets.jpg" alt="fiets">
          <h4>Viking Fiets</h4>
          <p class="price">€ 19.99</p>
          <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: 7d 12u</p>
          <a href='product.php' class='button ProductButton'>Bekijk Meer!</a>
        </div> 
        <div class="card">
          <img src="images/fiets.jpg" alt="fiets">
          <h4>Viking Fiets</h4>
          <p class="price">€ 19.99</p>
          <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: 7d 12u</p>
          <a href='product.php' class='button ProductButton'>Bekijk Meer!</a>
        </div>
        <div class="card">
          <img src="images/fiets.jpg" alt="fiets">
          <h4>Viking Fiets</h4>
          <p class="price">€ 19.99</p>
          <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: 7d 12u</p>
          <a href='product.php' class='button ProductButton'>Bekijk Meer!</a>
        </div>
        <div class="card">
          <img src="images/fiets.jpg" alt="fiets">
          <h4>Viking Fiets</h4>
          <p class="price">€ 19.99</p>
          <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: 7d 12u</p>
          <a href='product.php' class='button ProductButton'>Bekijk Meer!</a>
        </div>
      </div>

      <h3 class='HomePageTitel'>Loopt bijna af!</h3>
      <div class='ProductenContainer'>
        <div class="card">
          <img src="images/fiets.jpg" alt="fiets">
          <h4>Viking Fiets</h4>
          <p class="price">€ 19.99</p>
          <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: 7d 12u</p>
          <a href='product.php' class='button ProductButton'>Bekijk Meer!</a>
        </div> 
        <div class="card">
          <img src="images/fiets.jpg" alt="fiets">
          <h4>Viking Fiets</h4>
          <p class="price">€ 19.99</p>
          <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: 7d 12u</p>
          <a href='product.php' class='button ProductButton'>Bekijk Meer!</a>
        </div>
        <div class="card">
          <img src="images/fiets.jpg" alt="fiets">
          <h4>Viking Fiets</h4>
          <p class="price">€ 19.99</p>
          <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: 7d 12u</p>
          <a href='product.php' class='button ProductButton'>Bekijk Meer!</a>
        </div>
        <div class="card">
          <img src="images/fiets.jpg" alt="fiets">
          <h4>Viking Fiets</h4>
          <p class="price">€ 19.99</p>
          <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: 7d 12u</p>
          <a href='product.php' class='button ProductButton'>Bekijk Meer!</a>
        </div>
      </div>
      <h3 class='HomePageTitel'>Nieuwe veilingen</h3>
      <div class='ProductenContainer'>
        <div class="card">
          <img src="images/fiets.jpg" alt="fiets">
          <h4>Viking Fiets</h4>
          <p class="price">€ 19.99</p>
          <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: 7d 12u</p>
          <a href='product.php' class='button ProductButton'>Bekijk Meer!</a>
        </div> 
        <div class="card">
          <img src="images/fiets.jpg" alt="fiets">
          <h4>Viking Fiets</h4>
          <p class="price">€ 19.99</p>
          <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: 7d 12u</p>
          <a href='product.php' class='button ProductButton'>Bekijk Meer!</a>
        </div>
        <div class="card">
          <img src="images/fiets.jpg" alt="fiets">
          <h4>Viking Fiets</h4>
          <p class="price">€ 19.99</p>
          <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: 7d 12u</p>
          <a href='product.php' class='button ProductButton'>Bekijk Meer!</a>
        </div>
        <div class="card">
          <img src="images/fiets.jpg" alt="fiets">
          <h4>Viking Fiets</h4>
          <p class="price">€ 19.99</p>
          <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: 7d 12u</p>
          <a href='product.php' class='button ProductButton'>Bekijk Meer!</a>
        </div>
      </div>
    </div>
    
    <?php 
      include_once 'aanroepingen/footer.html';
    ?>