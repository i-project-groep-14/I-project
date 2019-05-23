    <?php
      $config = ['pagina' => 'index'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';
    ?>

    <div class="holy-grail-middle">
      <?php 
        if(isset($_SESSION['login'])) {
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
              $gebruikersnaam = $_SESSION['gebruikersnaam'];
              for($i = 0; $i < $aantalveilingen; $i++) {
                createHomepageItem("SELECT titel, verkoopprijs, looptijdeindeDag, looptijdeindeTijdstip, voorwerpnummer, startprijs FROM voorwerp 
                                    WHERE verkoper like '%$gebruikersnaam%' and veilingGesloten = 'niet' ORDER BY titel", $plek);
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
            createHomepageItem("SELECT count(b.voorwerpnummer) as topproducten, v.voorwerpnummer, v.titel, v.verkoopprijs, v.looptijdeindeDag,
                        v.looptijdeindeTijdstip, v.startprijs FROM voorwerp v inner join bod b on v.voorwerpnummer = b.voorwerpnummer
                        WHERE veilingGesloten = 'niet'
                        GROUP BY b.voorwerpnummer, v.voorwerpnummer, v.titel, v.verkoopprijs, v.looptijdeindeDag, v.looptijdeindeTijdstip, v.startprijs
                        ORDER BY topproducten desc", $plek
            );
          }
        ?>
      </div>

      <h3 class='HomePageTitel'>Loopt bijna af!</h3>
      <div class='ProductenContainer'>
        <?php
          $plek = 0;
          for($i = 0; $i < 4; $i++) {
            createHomepageItem("SELECT titel, voorwerpnummer, verkoopprijs, looptijdeindeDag, looptijdeindeTijdstip, startprijs FROM voorwerp 
                                WHERE veilingGesloten = 'niet' and (
                                looptijdeindeTijdstip >= CONVERT(TIME,GETDATE()) or
                                looptijdeindeTijdstip < CONVERT(TIME,GETDATE()))
                                ORDER BY looptijdeindeDag asc, looptijdeindeTijdstip asc", $plek
            );
          }
        ?>
      </div>
      <h3 class='HomePageTitel'>Nieuwe veilingen</h3>
      <div class='ProductenContainer'>
        <?php
          $plek = 0;
          for($i = 0; $i < 4; $i++) {
            createHomepageItem("SELECT titel, voorwerpnummer, verkoopprijs, looptijdeindeDag, looptijdeindeTijdstip, startprijs FROM voorwerp 
                            WHERE veilingGesloten = 'niet' and (
                            looptijdbeginTijdstip >= CONVERT(TIME,GETDATE()) or
                            looptijdbeginTijdstip < CONVERT(TIME,GETDATE()))
                            ORDER BY looptijdbeginDag desc, looptijdbeginTijdstip desc", $plek
            );
          }
        ?>
      </div>
    </div>
    
    <?php 
      include_once 'aanroepingen/footer.html';
    ?>