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
              if ($_SESSION['aantaleigenveilingen'] >= 4) {
                $aantalveilingen = 4;
              } else {
                $aantalveilingen = $_SESSION['aantaleigenveilingen'];
              }

              $plek = 0;
              for($i = 0; $i < $aantalveilingen; $i++) {
                createHomepageUwVeilingen($plek);
              }
              echo "</div>";
            }
          }
        }
      ?>

      <h3 class='HomePageTitel'>De populairste veilingen</h3>
      <div class='ProductenContainer'>
        <?php
          // $sql = "SELECT top 4 * FROM bod 
          //         WHERE voorwerp like :voorwerpnummer";
          // $query = $dbh->prepare($sql);
          // $query -> execute(array(
          //     ':voorwerpnummer' => ...
          // ));

          // $row = $query -> fetch();

        // createHomepageCard();
        // createHomepageCard();
        // createHomepageCard();
        // createHomepageCard();
        ?>
      </div>

      <h3 class='HomePageTitel'>Loopt bijna af!</h3>
      <div class='ProductenContainer'>
        <?php
        //   $sql = "SELECT voorwerpnummer, titel, verkoopprijs, looptijdeindeDag, looptijdeindeTijdstip FROM voorwerp 
        //           WHERE looptijdeindeDag like :voorwerpnummer";
        //   $query = $dbh->prepare($sql);
        //   $query -> execute(array(
        //       ':voorwerpnummer' => ...
        //   ));

        //   $row = $query -> fetch();

        //   $titel = $row['titel'];
        //   $hoogstebod = $row['verkoopprijs'];
        //   $voorwerpnummer = $row['voorwerpnummer'];
        //   $looptijdeindeDag = $row['looptijdeindeDag'];
        //   $looptijdeindeTijdstip = $row['looptijdeindeTijdstip'];
        //   $combinedDT = date('Y-m-d H:i:s', strtotime("$looptijdeindeDag $looptijdeindeTijdstip"));
        //   $difference = timeDiff(date("Y-m-d H:i:s"),$combinedDT);
        //   $years = abs(floor($difference / 31536000));
        //   $days = abs(floor(($difference-($years * 31536000))/86400));
        //   $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
        //   $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));
        //   $secs = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))-($mins * 3600)/60));

        //   $sql = "SELECT filenaam FROM bestand 
        //           WHERE voorwerp like :voorwerpnummer";
        //   $query = $dbh->prepare($sql);
        //   $query -> execute(array(
        //       ':voorwerpnummer' => $voorwerpnummer
        //   ));

        //   $row = $query -> fetch();

        // createHomepageCard($row['filenaam']);
        // createHomepageCard();
        // createHomepageCard();
        // createHomepageCard();
        ?>
      </div>
      <h3 class='HomePageTitel'>Nieuwe veilingen</h3>
      <div class='ProductenContainer'>
        
      </div>
    </div>
    
    <?php 
      include_once 'aanroepingen/footer.html';
    ?>