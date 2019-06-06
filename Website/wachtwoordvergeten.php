    <?php
      $config = ['pagina' => 'wachtwoordvergeten'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';

      $resetwachtwoord = false;

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
        } else if ($_POST['veiligheidsvraag'] == 0) {
          $melding = "
          <div data-closable class='callout alert-callout-border alert radius'>
            <strong>Error</strong> - U moet nog een veiligheidsvraag selecteren.
            <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          ";
        } else if (strlen($_POST['email']) > 50) {
          $melding = "
          <div data-closable class='callout alert-callout-border alert radius'>
            <strong>Error</strong> - Het aantal karakters van het mailadres is te groot. Het maximale toegestane aantal karakters is 50.
            <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
        } else {
          //vraag en antwoord laden uit database en vergelijken met ingevoerde waardes
          $sql = "SELECT vraag, antwoordtekst FROM gebruiker 
                  WHERE mailadres like :email";
          $query = $dbh->prepare($sql);
          $query -> execute(array(
              ':email' => $_POST['email']
          ));

          $row = $query -> fetch();

          if($row['vraag'] == $_POST['veiligheidsvraag'] && $row['antwoordtekst'] == $_POST['antwoordtekst']) {
            $resetwachtwoord = true;
            $_SESSION['mail'] = $_POST['email'];
          } else {
            $melding = "
            <div data-closable class='callout alert-callout-border alert radius'>
              <strong>Error</strong> - De veiligheidsvraag en wachtwoord komen niet met elkaar overeen.
              <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
          }
        }
      }

      if(isset($_POST['NWwP'])) {
        $resetwachtwoord = true;
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
              ':wachtwoord' => strip_tags($_POST['wachtwoord']),
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
            $_SESSION['nieuwWachtwoord'] = true;
            $_SESSION['gebruikersnaam'] = $row['gebruikersnaam'];
            // echo $_SESSION['gebruikersnaam'];
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
    ?>

    <div class="holy-grail-middle">
      <h1 class="InlogpaginaKopje"> Wachtwoord Vergeten? </h1>
      <?php
        if(isset($melding)) {
          echo "<br>";
          echo $melding;
          echo "<br>";
        }

        if($resetwachtwoord == false) {
      ?>
          <form action='wachtwoordvergeten.php' method='POST'>
            <h5>Uw e-mailadres</h5>
            <input type="text" placeholder="Voer hier uw e-mail in" name="email" required>
            
            <hr>

            <h5>Kies uw veiligheidsvraag</h5>
            <select name='veiligheidsvraag'>
              <option value="0">...</option>
              <?php
                $plek = 0;
                $sql = "SELECT COUNT(*) as aantalVragen FROM vraag";
                $query = $dbh->prepare($sql);
                $query -> execute();
                $row = $query -> fetch();

                for($i = 0; $i < $row['aantalVragen']; $i++) {
                  $plek = createQuestions($plek);
                }
              ?>
            </select>
            <h5>Antwoord op uw veiligheidsvraag</h5>
            <input type="text" placeholder="Antwoord op de veiligheidsvraag" name="antwoordtekst" required>

            <input class="button" type="submit" value="Nieuw wachtwoord aanvragen" name="NWwA">
          </form>

          <p>Antwoord op de veiligheidsvraag vergeten? Neem <a href="contact.php">contact</a> op met ons.</p>
      <?php
        } else {
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
    </div>

    <?php
      include_once 'aanroepingen/footer.html';
    ?>