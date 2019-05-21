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