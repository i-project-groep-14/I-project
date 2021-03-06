    <?php
      $config = ['pagina' => 'registratie_vraag'];

      require_once 'aanroepingen/connectie.php';
    
      if(!isset($_SESSION)) {
        session_start();
      }

      if($_SESSION['voornaam'] == NULL) {
				$message = "U heeft de rechten niet om deze pagina te gebruiken!";
				echo ("<script 
					LANGUAGE='JavaScript'>
					window.alert('$message');
					window.location.href='registratie_persoonsgegevens.php';
				</script>");
			}

      if(isset($_POST['register']) && isset($_POST['veiligheidsvraag'])) {
        if (strlen($_POST['veiligheidsvraag_antwoord']) > 50) {
          $melding = "
          <div data-closable class='callout alert-callout-border alert radius'>
          <strong>Error</strong> - Het aantal karakters is te groot. Het maximale toegestane aantal karakters is 50.
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
        } else {
          // $_SESSION['register'] = $_POST['register'];
          // $_SESSION['veiligheidsvraag'] = $_POST['veiligheidsvraag'];
          // $_SESSION['veiligheidsvraag_antwoord'] = $_POST['veiligheidsvraag_antwoord'];

          $email = $_SESSION['email'];
    
          $gebruikersnaam = $_SESSION['gebruikersnaam'];
          $voornaam = $_SESSION['voornaam'];
          $achternaam = $_SESSION['achternaam'];
          $adres = $_SESSION['adres'];
          if(isset($_SESSION['oAdres'])) {
            $oAdres = $_SESSION['oAdres'];
          } //else {
          //   $oAdres = 'NULL';
          // }
          $postcode = $_SESSION['postcode'];
          $plaats = $_SESSION['plaats'];
          $land = $_SESSION['land'];
          $telefoonnr1 = $_SESSION['telnr1'];
          if(isset($_SESSION['telnr2'])) {
            $telefoonnr2 = $_SESSION['telnr2'];
          }
          $geboortedatum = $_SESSION['geboortedatum'];
          $wachtwoord = $_SESSION['wachtwoord'];
          $rol = $_SESSION['eenVerkoper'];
          if ($rol == 3) {
            $rekeningnummer = $_SESSION['rekeningnummer'];
            $bank = $_SESSION['bank'];
            $controlepost = $_SESSION['controlepost'];
            $creditcardnummer = $_SESSION['creditcardnummer'];
          }
    
          $vraag = $_POST['veiligheidsvraag'];
          $antwoord = strip_tags($_POST['veiligheidsvraag_antwoord']);
    
          $sql = "INSERT INTO gebruiker VALUES (:gebruikersnaam, :voornaam, :achternaam, :adresregel1, :adresregel2, :postcode, :plaatsnaam, :land, :geboortedatum, :mailadres,:wachtwoord, :vraag, :antwoordtekst, :rol)";
          $query = $dbh->prepare($sql);
          $query -> execute(array(
            ':gebruikersnaam' => $gebruikersnaam,
            ':voornaam' => $voornaam,
            ':achternaam' => $achternaam,
            ':adresregel1' => $adres,
            ':adresregel2' => $oAdres,
            ':postcode' => $postcode,
            ':plaatsnaam' => $plaats,
            ':land' => $land,
            ':geboortedatum' => $geboortedatum,
            ':mailadres' => $email,
            ':wachtwoord' => password_hash($wachtwoord, PASSWORD_DEFAULT),
            ':vraag' => $vraag,
            ':antwoordtekst' => $antwoord,
            ':rol' => $rol//,
            //':profielfoto' => NULL
            )
          );
    
          

          if(isset($telefoonnr2)) {
            $sql = "INSERT INTO gebruikerstelefoon (gebruiker,telefoon,alttelefoon) VALUES (:gebruiker,:telefoon, :alttelefoon)";
            $query = $dbh->prepare($sql);
            $query -> execute(array(
              ':gebruiker' => $gebruikersnaam,
              ':telefoon' => $telefoonnr1,
              ':alttelefoon' => $telefoonnr2
              )
            );
          }else{
            $sql = "INSERT INTO gebruikerstelefoon (gebruiker,telefoon) VALUES (:gebruiker, :telefoon)";
            $query = $dbh->prepare($sql);
            $query -> execute(array(
              ':gebruiker' => $gebruikersnaam,
              ':telefoon' => $telefoonnr1
              )
            );
          }
    
          if ($rol == 3) {
            $sql = "INSERT INTO verkoper VALUES (:gebruiker, :bank, :bankrekening, :controleoptie, :creditcard)";
            $query = $dbh->prepare($sql);
            $query -> execute(array(
              ':gebruiker' => $gebruikersnaam,
              ':bank' => $bank,
              ':bankrekening' => $rekeningnummer,
              ':controleoptie' => $controlepost,
              ':creditcard' => $creditcardnummer
              )
            );
          }
            
          session_destroy();
          session_start();
          $_SESSION['login'] = true;
          $_SESSION['gebruikersnaam'] = $gebruikersnaam;
          $_SESSION['voornaam'] = $voornaam;

          header('Location: index.php');
        }
      }

      include_once 'aanroepingen/header.php';
    ?>

    <div class="holy-grail-middle">
      <?php
        include_once 'aanroepingen/registratie_progressbar.php';
      ?>
      <br>
      <h2>Veiligheidsvraag</h2>
      <div class="body-tekst">
        <p>
          Dit is de derde stap van het registreren. 
          Hierin wordt naar een veiligheidsvraag gevraagd die wordt gevraagd als de gebruiker het wachtwoord is vergeten.
          Kies hieronder uit welke vraag en geef een antwoordt. Dit antwoordt is nodig om uw wachtwoord te herstellen. 
        </p>

        <?php 
					if(isset($melding)) {
						echo "<br>";
						echo $melding; 
						echo "<br>";
					}
				?>

        <form action="registratie_vraag.php" method="post">
          <div class="grid-container">
            <div class="grid-x grid-padding-x">
              <div class="medium-12 cell">
                <label>Kies één veiligheidsvraag.</label>
                <select name="veiligheidsvraag" >
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
                  <!-- <option value="1" >Vraag 1</option>
                  <option value="2" >Vraag 2</option>
                  <option value="3" >Vraag 3</option>
                  <option value="4" >Vraag 4</option>
                  <option value="5" >Vraag 5</option> -->
                </select>
              </div>
              <br>
              <br>
              <div class="medium-12 cell">
                <label>Vul het antwoordt in a.u.b.</label>
                <input type="text" name="veiligheidsvraag_antwoord" value="<?php  if(isset($_POST['veiligheidsvraag_antwoord'])) { echo htmlentities($_POST['veiligheidsvraag_antwoord']);} ?>" required>
              </div>
              <div class="center">
                <input class="button" type="submit" value="Verzenden" name="register">
                <div class="rechts">
                  <button class="button" onclick="window.location.href = 'registratie_persoonsgegevens.php';">Terug</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    
    <?php 
      include_once 'aanroepingen/footer.html';
    ?>