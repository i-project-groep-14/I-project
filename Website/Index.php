    <?php
      $config = ['pagina' => 'index'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';
    ?>

    <div class="holy-grail-middle">
      <?php 
        if(isset($_SESSION['login'])) {
                                            // verander in 0
          if($_SESSION['aantaleigenveilingen'] != 1) {
            function createHomepageItem($plek) {
              global $dbh;
              settype($plek, "int");
              $volgendeplek = $plek+1;

              $sql = "SELECT veilingGesloten FROM voorwerp 
                      WHERE verkoper like :gebruikersnaam
                      ORDER BY titel OFFSET $plek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
              $query = $dbh->prepare($sql);
              $query -> execute(array(
                  ':gebruikersnaam' => $_SESSION['gebruikersnaam']
              ));

              $row = $query -> fetch();
              
              if ($row['veilingGesloten'] == 'niet') {
                $sql = "SELECT titel, verkoopprijs, looptijdeindeDag, looptijdeindeTijdstip FROM voorwerp 
                        WHERE verkoper like :gebruikersnaam
                        ORDER BY titel OFFSET $plek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
                $query = $dbh->prepare($sql);
                $query -> execute(array(
                    ':gebruikersnaam' => $_SESSION['gebruikersnaam']
                ));

                $row = $query -> fetch();

                $titel = $row['titel'];
                $hoogstebod = $row['verkoopprijs'];
                $looptijdeindeDag = $row['looptijdeindeDag'];
                $looptijdeindeTijdstip = $row['looptijdeindeTijdstip'];
                $actueledatum = date("Y-m-d");
                $actueletijd = date("H-i-s");

                $verschilInDagen = $looptijdeindeDag - $actueledatum;
                echo $verschilInDagen;

                //verschil in tijd

                echo"
                <div class='card'>
                  <img src='images/fiets.jpg' alt='fiets'>
                  <h4>$titel</h4>
                  <p class='price'>€$hoogstebod</p>
                  <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: 7d 12u</p>
                  <a href='product.php' class='button ProductButton'>Bekijk Meer!</a>
                </div>
                ";
              } else {
                createHomepageItem($volgendeplek);
              }
            }

            echo "
            <h3 class='HomePageTitel'>Uw veilingen</h3>
            <div class='ProductenContainer'>
            ";
            createHomepageItem(0);
            createHomepageItem(1);
            createHomepageItem(2);
            createHomepageItem(3);
            echo "</div>";
            
            //   <div class='card'>
            //     <img src='images/fiets.jpg' alt='fiets'>
            //     <h4>Viking fiets</h4>
            //     <p class='price'>€ 19.99</p>
            //     <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: 7d 12u</p>
            //     <a href='product.php' class='button ProductButton'>Bekijk Meer!</a>
            //   </div> 
            // <h3 class='HomePageTitel'>Uw veilingen</h3>
            // <div class='ProductenContainer'>
            //   <div class='card'>
            //     <img src='images/fiets.jpg' alt='fiets'>
            //     <h4>Viking fiets</h4>
            //     <p class='price'>€ 19.99</p>
            //     <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: 7d 12u</p>
            //     <a href='product.php' class='button ProductButton'>Bekijk Meer!</a>
            //   </div> 
            //   <div class='card'>
            //     <img src='images/fiets.jpg' alt='fiets'>
            //     <h4>Viking Fiets</h4>
            //     <p class='price'>€ 19.99</p>
            //     <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: 7d 12u</p>
            //     <a href='product.php' class='button ProductButton'>Bekijk Meer!</a>
            //   </div>
            //   <div class='card'>
            //     <img src='images/fiets.jpg' alt='fiets'>
            //     <h4>Viking Fiets</h4>
            //     <p class='price'>€ 19.99</p>
            //     <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: 7d 12u</p>
            //     <a href='product.php' class='button ProductButton'>Bekijk Meer!</a>
            //   </div>
            //   <div class='card'>
            //     <img src='images/fiets.jpg' alt='fiets'>
            //     <h4>Viking Fiets</h4>
            //     <p class='price'>€ 19.99</p>
            //     <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: 7d 12u</p>
            //     <a href='product.php' class='button ProductButton'>Bekijk Meer!</a>
            //   </div>
            // </div>
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