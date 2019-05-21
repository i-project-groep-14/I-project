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
          $plek = 0;
          for($i = 0; $i < 4; $i++) {
            createHomepagePopulair($plek);
          }
          // $sql = "SELECT top 4 * FROM bod 
          //         WHERE voorwerp like :voorwerpnummer";
          // $query = $dbh->prepare($sql);
          // $query -> execute(array(
          //     ':voorwerpnummer' => ...
          // ));

          // select count(*) as topproducten from bod
          // group by voorwerpnummer, gebruiker
          // order by topproducten desc

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
          $plek = 0;
          for($i = 0; $i < 4; $i++) {
            createHomepageBijnaAflopend($plek);
          }
        ?>
      </div>
      <h3 class='HomePageTitel'>Nieuwe veilingen</h3>
      <div class='ProductenContainer'>
        <?php
          $plek = 0;
          for($i = 0; $i < 4; $i++) {
            createHomepageNieuweVeilingen($plek);
          }
        ?>
      </div>
    </div>
    
    <?php 
      include_once 'aanroepingen/footer.html';
    ?>