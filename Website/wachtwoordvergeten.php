    <?php
      $config = ['pagina' => 'wachtwoordvergeten'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';

      if(isset($_POST['emailcheck'])) {
        if (strlen($_POST['email']) > 50) {
          $melding = "
            <div data-closable class='callout alert-callout-border alert radius'>
              <strong>Error</strong> - Het aantal karakters van het mailadres is te groot. Het maximale toegestane aantal karakters is 50.
              <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
        } else {
          $sql = "SELECT mailadres FROM gebruiker";
          $query = $dbh->prepare($sql);
          $query -> execute();

          $test = false;

          while($row = $query -> fetch()) { 
            if ($row['mailadres'] == $_POST['email']) {
              $test = true;
            }
          }

          if ($test == true) {
            $_SESSION['stap'] = 2;
            $_SESSION['mail'] = $_POST['email'];
          } else {
            $melding = "
            <div data-closable class='callout alert-callout-border alert radius'>
              <strong>Error</strong> - Dit mailadres is niet verbonden met een account.
              <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
          }
        }
      }

      if(isset($_POST['NWwA'])) {
        if (strlen($_POST['antwoordtekst']) > 50) {
          $melding = "
          <div data-closable class='callout alert-callout-border alert radius'>
            <strong>Error</strong> - Het aantal karakters van het antwoord is te groot. Het maximale toegestane aantal karakters is 50.
            <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          ";
        } else {
          //vraag en antwoord laden uit database en vergelijken met ingevoerde waardes
          $sql = "SELECT antwoordtekst FROM gebruiker 
                  WHERE mailadres like :email";
          $query = $dbh->prepare($sql);
          $query -> execute(array(
              ':email' => $_SESSION['mail']
          ));

          $row = $query -> fetch();

          if($row['antwoordtekst'] == $_POST['antwoordtekst']) {
            $_SESSION['stap'] = 3;
          } else {
            $melding = "
            <div data-closable class='callout alert-callout-border alert radius'>
              <strong>Error</strong> - De veiligheidsvraag en antwoordtekst komen niet met elkaar overeen.
              <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
          }
        }
      }

      if(isset($_POST['NWwP'])) {
        $_SESSION['stap'] = false;
        if (strlen($_POST['wachtwoord']) < 7) {
          $melding = "
          <div data-closable class='callout alert-callout-border alert radius'>
            <strong>Error</strong> - Het wachtwoord moet 7 of meer karakters hebben.
            <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
        } else if (!(preg_match('/[A-Za-z]/', $_POST['wachtwoord']) && preg_match('/[0-9]/', $_POST['wachtwoord']))) {
          $melding = "
          <div data-closable class='callout alert-callout-border alert radius'>
            <strong>Error</strong> - Het wachtwoord moet minimaal 1 letter en 1 nummer hebben.
            <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
        } else {
          if ($_POST['wachtwoord'] == $_POST['bWachtwoord']) {
            $sql = "UPDATE gebruiker 
                    SET wachtwoord = :wachtwoord
                    WHERE mailadres like :emailadres";
            $query = $dbh->prepare($sql);
            $query -> execute(array(
              ':wachtwoord' => password_hash(strip_tags($_POST['wachtwoord']), PASSWORD_DEFAULT),
              ':emailadres' => $_SESSION['mail']
            ));

            $sql = "SELECT gebruikersnaam FROM gebruiker 
                    WHERE mailadres like :mailadres";
            $query = $dbh->prepare($sql);
            $query -> execute(array(
                ':mailadres' => $_SESSION['mail']
            ));

            $row = $query -> fetch();

            unset($_SESSION['mail']);

            $_SESSION['gebruikersnaam'] = $row['gebruikersnaam'];
            $_SESSION['nieuwWachtwoord'] = true;
            echo "<script> window.location.href = 'index.php' </script>";
          } else {
            $melding = "
            <div data-closable class='callout alert-callout-border alert radius'>
              <strong>Error</strong> - De wachtwoorden komen niet met elkaar overeen.
              <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
          }
        }
      }

      // if(isset($_POST['NWwA'])) {
      //   if (strlen($_POST['antwoordtekst']) > 50) {
      //     $melding = "
      //     <div data-closable class='callout alert-callout-border alert radius'>
      //       <strong>Error</strong> - Het aantal karakters van het antwoord is te groot. Het maximale toegestane aantal karakters is 50.
      //       <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
      //         <span aria-hidden='true'>&times;</span>
      //       </button>
      //     </div>
      //     ";
      //   } else if ($_POST['veiligheidsvraag'] == 0) {
      //     $melding = "
      //     <div data-closable class='callout alert-callout-border alert radius'>
      //       <strong>Error</strong> - U moet nog een veiligheidsvraag selecteren.
      //       <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
      //         <span aria-hidden='true'>&times;</span>
      //       </button>
      //     </div>
      //     ";
      //   } else if (strlen($_POST['email']) > 50) {
      //     $melding = "
      //     <div data-closable class='callout alert-callout-border alert radius'>
      //       <strong>Error</strong> - Het aantal karakters van het mailadres is te groot. Het maximale toegestane aantal karakters is 50.
      //       <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
      //         <span aria-hidden='true'>&times;</span>
      //       </button>
      //     </div>";
      //   } else {
      //     //vraag en antwoord laden uit database en vergelijken met ingevoerde waardes
      //     $sql = "SELECT vraag, antwoordtekst FROM gebruiker 
      //             WHERE mailadres like :email";
      //     $query = $dbh->prepare($sql);
      //     $query -> execute(array(
      //         ':email' => $_POST['email']
      //     ));

      //     $row = $query -> fetch();

      //     if($row['vraag'] == $_POST['veiligheidsvraag'] && $row['antwoordtekst'] == $_POST['antwoordtekst']) {
      //       $_SESSION['stap'] = false;
      //       $_SESSION['mail'] = $_POST['email'];
      //     } else {
      //       $melding = "
      //       <div data-closable class='callout alert-callout-border alert radius'>
      //         <strong>Error</strong> - De veiligheidsvraag en wachtwoord komen niet met elkaar overeen.
      //         <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
      //           <span aria-hidden='true'>&times;</span>
      //         </button>
      //       </div>";
      //     }
      //   }
      // }

      // if(isset($_POST['NWwP'])) {
      //   $_SESSION['stap'] = false;
      //   if (strlen($_POST['wachtwoord']) < 7) {
      //     $melding = "
      //     <div data-closable class='callout alert-callout-border alert radius'>
      //       <strong>Error</strong> - Het wachtwoord moet 7 of meer karakters hebben.
      //       <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
      //         <span aria-hidden='true'>&times;</span>
      //       </button>
      //     </div>";
      //   } else if (!(preg_match('/[A-Za-z]/', $_POST['wachtwoord']) && preg_match('/[0-9]/', $_POST['wachtwoord']))) {
      //     $melding = "
      //     <div data-closable class='callout alert-callout-border alert radius'>
      //       <strong>Error</strong> - Het wachtwoord moet minimaal 1 letter en 1 nummer hebben.
      //       <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
      //         <span aria-hidden='true'>&times;</span>
      //       </button>
      //     </div>";
      //   } else {
      //     if ($_POST['wachtwoord'] == $_POST['bWachtwoord']) {
      //       $sql = "UPDATE gebruiker 
      //               SET wachtwoord = :wachtwoord
      //               WHERE mailadres like :emailadres";
      //       $query = $dbh->prepare($sql);
      //       $query -> execute(array(
      //         ':wachtwoord' => password_hash(strip_tags($_POST['wachtwoord']), PASSWORD_DEFAULT),
      //         ':emailadres' => $_SESSION['mail']
      //       ));

      //       $sql = "SELECT gebruikersnaam FROM gebruiker 
      //               WHERE mailadres like :mailadres";
      //       $query = $dbh->prepare($sql);
      //       $query -> execute(array(
      //           ':mailadres' => $_SESSION['mail']
      //       ));

      //       $row = $query -> fetch();

      //       unset($_SESSION['mail']);
      //       $_SESSION['nieuwWachtwoord'] = true;
      //       $_SESSION['gebruikersnaam'] = $row['gebruikersnaam'];
      //       // echo $_SESSION['gebruikersnaam'];
      //       echo "<script> window.location.href = 'index.php' </script>";
      //     } else {
      //       $melding = "
      //       <div data-closable class='callout alert-callout-border alert radius'>
      //         <strong>Error</strong> - De wachtwoorden komen niet met elkaar overeen.
      //         <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
      //           <span aria-hidden='true'>&times;</span>
      //         </button>
      //       </div>";
      //     }
      //   }
      // }


    ?>

    <div class="holy-grail-middle">
      <h1 class="InlogpaginaKopje"> Wachtwoord Vergeten? </h1>
        <?php
          if(isset($melding)) {
            echo "<br>";
            echo $melding;
            echo "<br>";
          }

          if($_SESSION['stap'] == 1) {
        ?>

        <form action='wachtwoordvergeten.php' method='POST'>
          <h5>Uw e-mailadres</h5>
          <input type="email" placeholder="Voer hier uw e-mail in" name="email" required>
          <input class="button" type="submit" value="Stuur uw email" name="emailcheck">
        </form>
        
        <?php
          } else if ($_SESSION['stap'] == 2) {
            $sql = "SELECT vraag FROM gebruiker 
                    WHERE mailadres like :mailadres";
            $query = $dbh->prepare($sql);
            $query -> execute(array(
                ':mailadres' => $_SESSION['mail']
            ));

            $row = $query -> fetch();
            $vraag = $row['vraag'];

            $sql = "SELECT tekstvraag FROM vraag 
                    WHERE vraagnummer = :vraag";
            $query = $dbh->prepare($sql);
            $query -> execute(array(
                ':vraag' => $vraag
            ));

            $row = $query -> fetch();
            $vraag = $row['tekstvraag'];

            echo $vraag;
          ?>

          <h5>Antwoord op uw veiligheidsvraag</h5>
          <form action='wachtwoordvergeten.php' method='POST'>
            <input type="text" placeholder="Antwoord op de veiligheidsvraag" name="antwoordtekst" required>
            <input class="button" type="submit" value="Nieuw wachtwoord aanvragen" name="NWwA">
          </form>
          
          <p>Antwoord op uw veiligheidsvraag vergeten? Neem <a href="contact.php">contact</a> op met ons.</p>

          <?php
            } else if ($_SESSION['stap'] == 3) {
          ?>

          <form action='wachtwoordvergeten.php' method='POST'>
            <div class="medium-12 cell">
							<h5>Uw nieuwe wachtwoord:</h5>
							<input type="password" placeholder="Wachtwoord" name="wachtwoord" required>
						</div>
						
						<div class="medium-12 cell">
							<h5>Bevestig het wachtwoord:</h5>
							<input type="password" placeholder="Bevestig wachtwoord" name="bWachtwoord" required>
						</div>
            <input class="button" type="submit" value="Nieuw wachtwoord plaatsen" name="NWwP">
          </form>

          <?php
            }
          ?>


            

            <!-- <hr> -->

            
            <!-- <h5>Kies uw veiligheidsvraag</h5>
            <select name='veiligheidsvraag'>
              <option value="0">...</option> -->
              <?php
                // $plek = 0;
                // $sql = "SELECT COUNT(*) as aantalVragen FROM vraag";
                // $query = $dbh->prepare($sql);
                // $query -> execute();
                // $row = $query -> fetch();

                // for($i = 0; $i < $row['aantalVragen']; $i++) {
                //   $plek = createQuestions($plek);
                // }
              ?>
            <!-- </select> -->

            <!-- <input type="text" placeholder="Antwoord op de veiligheidsvraag" name="antwoordtekst" required>

            <input class="button" type="submit" value="Nieuw wachtwoord aanvragen" name="NWwA">
          </form>

          <p>Antwoord op de veiligheidsvraag vergeten? Neem <a href="contact.php">contact</a> op met ons.</p> -->
      



          <!-- <form action='wachtwoordvergeten.php' method='POST'>
            <div class="medium-12 cell">
							<h5>Uw nieuwe wachtwoord:</h5>
							<input type="password" placeholder="Wachtwoord" name="wachtwoord" required>                    
						</div>
						
						<div class="medium-12 cell">
							<h5>Bevestig het wachtwoord:</h5>
							<input type="password" placeholder="Bevestig wachtwoord" name="bWachtwoord" required>
						</div>
            <input class="button" type="submit" value="Nieuw wachtwoord plaatsen" name="NWwP">
          </form> -->
      
    </div>

    <?php
      include_once 'aanroepingen/footer.html';
    ?>