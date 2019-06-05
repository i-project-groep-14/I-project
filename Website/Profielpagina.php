 <?php
      $config = ['pagina' => 'Profielpagina'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';

      $sql = "SELECT gebruikersnaam, mailadres, voornaam, achternaam, adresregel1, adresregel2, postcode, land, geboortedatum FROM gebruiker 
              WHERE gebruikersnaam = :gebruiker";
      $query = $dbh->prepare($sql);
      $query -> execute(array(
        ':gebruiker' => $_SESSION['gebruikersnaam']
      ));
      $row = $query -> fetch();

      $gebruiker = strip_tags($row['gebruikersnaam']);
      $mail = strip_tags($row['mailadres']);
      $voornaam = strip_tags($row['voornaam']);
      $achternaam = strip_tags($row['achternaam']);
      $adres = strip_tags($row['adresregel1']);
      $adres2 = strip_tags($row['adresregel2']);
      $postcode = strip_tags($row['postcode']);
      $land = strip_tags($row['land']);
      $geboortedatum = $row['geboortedatum'];
      
      
      $sql = "SELECT telefoon, alttelefoon FROM gebruikerstelefoon WHERE gebruiker = :gebruiker";
      $query = $dbh->prepare($sql);
      $query -> execute(array(
        ':gebruiker' => $gebruiker
      ));
      $hj = $query -> fetch();

      $telefoonnummer = strip_tags($hj['telefoon']);
      $alttelefoon = strip_tags($hj['alttelefoon']);

      if (isset($_POST['VeranderVnaam'])) {
        $voornaam = $_POST['voornaam'];

        $sql = "UPDATE gebruiker 
                SET voornaam = :voornaam
                WHERE gebruikersnaam like :gebruikersnaam";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
          ':voornaam' => strip_tags($voornaam),
          ':gebruikersnaam' => $gebruiker
        ));
      }


      if (isset($_POST['VeranderAnaam'])) {
        $achternaam = $_POST['achternaam'];

        $sql = "UPDATE gebruiker 
                SET achternaam = :achternaam
                WHERE gebruikersnaam like :gebruikersnaam";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
          ':achternaam' => strip_tags($achternaam),
          ':gebruikersnaam' => $gebruiker
        ));
      }

      if (isset($_POST['VeranderAdress'])) {
        $adres = $_POST['adresregel1'];

        $sql = "UPDATE gebruiker 
                SET adresregel1 = :adresregel1
                WHERE gebruikersnaam like :gebruikersnaam";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
          ':adresregel1' => strip_tags($adres),
          ':gebruikersnaam' => $gebruiker
        ));
      }

      if (isset($_POST['VeranderAdresstwee'])) {
        $adres = $_POST['adresregel2'];

        $sql = "UPDATE gebruiker 
                SET adresregel2 = :adresregel2
                WHERE gebruikersnaam like :gebruikersnaam";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
          ':adresregel2' => strip_tags($adres),
          ':gebruikersnaam' => $gebruiker
        ));
      }

      if (isset($_POST['VeranderPostcode'])) {
        $adres = $_POST['postcode'];

        $sql = "UPDATE gebruiker 
                SET postcode = :postcode
                WHERE gebruikersnaam like :gebruikersnaam";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
          ':postcode' => strip_tags($adres),
          ':gebruikersnaam' => $gebruiker
        ));
      }

      if (isset($_POST['VeranderTel'])) {
        $telefoon = $_POST['telefoon'];

        if ($telefoonnummer == NULL) {
          $sql = "INSERT INTO gebruikerstelefoon VALUES (:gebruiker, :telefoon, NULL) ";
          $query = $dbh->prepare($sql);
          $query -> execute(array(
            ':telefoon' => strip_tags($telefoon),
            ':gebruiker' => $gebruiker
          ));
          $telefoonnummer = strip_tags($telefoon);
        } else {
          $sql = "UPDATE gebruikerstelefoon 
                  SET telefoon = :telefoon
                  WHERE gebruiker like :gebruiker";
          $query = $dbh->prepare($sql);
          $query -> execute(array(
            ':telefoon' => strip_tags($telefoon),
            ':gebruiker' => $gebruiker
          ));
          $telefoonnummer = strip_tags($telefoon);
        }
      }

      if (isset($_POST['VeranderTels'])) {
        $telefoon = $_POST['telefoon2'];

        $sql = "UPDATE gebruikerstelefoon 
                SET alttelefoon = :telefoon
                WHERE gebruiker like :gebruiker";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
          ':telefoon' => strip_tags($telefoon),
          ':gebruiker' => $gebruiker
        ));
          
        $alttelefoon = strip_tags($telefoon);
      }

      if (isset($_POST['VeranderLand'])) {
        $adres = $_POST['Land'];

        $sql = "UPDATE gebruiker 
                SET Land = :land
                WHERE gebruikersnaam like :gebruikersnaam";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
          ':land' => strip_tags($adres),
          ':gebruikersnaam' => $gebruiker
       
        ));
      }

      if (isset($_POST['VeranderRol'])) {
        
      }
    ?> 

    
    <div class="holy-grail-middle">
      <h1>Deze pagina is in bewerking</h1>
        <div class="grid-container">
          <div class="grid-x grid-margin-x">
            <div class="cell medium-3">
              <ul class="vertical tabs" data-tabs id="example-tabs">
                <?php 
                  if($_SESSION['rol'] == 3 || $_SESSION['rol'] == 5 ) {
                    echo "<li class='tabs-title is-active'><a href='#panel1v' aria-selected='true'>Veilingen</a></li>";
                  } 
                ?>
                <li class="tabs-title"><a href="#panel2v">Biedingen</a></li>
                <li class="tabs-title"><a href="#panel3v">Gegevens</a></li>
                <?php 
                  if($_SESSION['rol'] == 2 || $_SESSION['rol'] == 5) {
                    echo "<li class='tabs-title'><a href='#panel4v'>Upgrade</a></li>";
                  }
                ?>
              </ul>
            </div>
            <div class="cell medium-9">
              <div class="tabs-content" data-tabs-content="example-tabs">
                <?php 
                  if($_SESSION['rol'] == 3 || $_SESSION['rol'] == 5) {
                    echo "
                    <div class='tabs-panel is-active' id='panel1v'>";

                      $plek = 0;
                      $aantalveilingen = selectAantalVeilingen($_SESSION['gebruikersnaam']);
                      
                      echo "
                      <div style='overflow-x:auto;'>
                        <table>
                          <tr>
                            <td>Titel</td>
                            <td>Startprijs</td>
                            <td>Betalingswijze</td>
                            <td>Plaats</td>
                            <td>StartVeiling</td>
                            <td>EindeVeiling</td>
                            <td>Verkoopprijs</td>
                            <td>Koper</td>
                            <td>VeilingStatus</td>
                          </tr>";

                          for($i = 0; $i < $aantalveilingen ; $i++) {
                            $plek = createProfVeilingen($plek);
                          }
                    echo "
                        </table>
                      </div>
                    </div>";
                  } 
                ?>

<!-- Biedingen -->
              <div class="tabs-panel" id="panel2v">
                <?php 
                  $plek = 0;
                  $aantalveilingen = selectAantalBiedingen($_SESSION['gebruikersnaam']);
                  echo "
                  <div style='overflow-x:auto;'>
                    <table >
                      <tr>
                        <td>Titel</td>
                        <td>Startprijs</td>
                        <td>uw bod</td>
                        <td>huidige prijs</td>
                        <td>Start Veiling</td>
                        <td>Einde Veiling</td>
                        <td>Veilinggesloten</td>
                      </tr>
                  ";
                      for($i = 0; $i < $aantalveilingen ; $i++) {
                        $plek = createProfBiedingen($plek);
                      }
                  echo "
                    </table>
                  </div>";
                ?>
              </div>

<!-- Profiel gegevens -->
              <div class="tabs-panel" id="panel3v">
                <div style="overflow-x:auto;">
                  <table>
                    <tr>
                      <th>Persoonsgegevens</th>
                      <th></th>
                    </tr>
                    <tr>
                      <td>Gebruikersnaam</td>
                      <td><input type="text" value="<?php echo $gebruiker?>" name="Profgebruikersnaam" disabled></td>
                    </tr>
                    <tr>
                      <td>E-mail</td>
                      <td><input type="text" value="<?php echo $mail?>" name="ProfMail" disabled></td>
                    </tr>
                    <tr>
                      <td>Voornaam</td>
                      <form action="profielpagina.php" method='POST'>
                        <td><input type="text" value="<?php echo $voornaam?>" pattern="[^\s]+"  name="voornaam" maxlength="20"></td>
                        <td><input type="submit" class="veilingknop button" name="VeranderVnaam" value="↻" ></td>
                      </form>
                    </tr>
                    <tr>
                      <td>Achternaam</td>
                      <form action="profielpagina.php" method='POST'>
                      <td><input type="text" value="<?php echo $achternaam?>" pattern="[^\s]+" name="achternaam" maxlength="20"></td>
                      <td><input type="submit" class="veilingknop button" name="VeranderAnaam" value="↻" ></td>
                      </form>
                    </tr>
                    <tr>
                      <td>Telefoonnummer</td>
                      <form action="profielpagina.php" method='POST'>
                      <td><input type="tel" value="<?php echo $telefoonnummer?>" pattern="[0-9]{11}" name="telefoon" required></td>
                      <td><input type="submit" class="veilingknop button" name="VeranderTel" value="↻" ></td>
                      </form>
                    </tr>
                      <?php 
                        if($telefoonnummer != NULL) { 
                          echo"
                          <tr>
                            <td>Alternatieve Telefoonnummer</td>
                            <form action='profielpagina.php' method='POST'>
                            <td><input type='tel' value='"; echo $alttelefoon."' pattern='[0-9]{11}' name='telefoon2' required></td>
                            <td><input type='submit' class='veilingknop button' name='VeranderTels' value='↻' ></td>
                            </form>
                          </tr>";
                        }
                      ?>
                    <tr>
                      <td>Adres</td>
                      <form action="profielpagina.php" method='POST'>
                      <td><input type="text" value="<?php echo $adres?>" pattern="[a-zA-Z0-9\s]+" name="adresregel1" maxlength="20"></td>
                      <td><input type="submit" class="veilingknop button" name="VeranderAdress" value="↻" ></td>
                      </form>
                    </tr>
                    <tr>
                      <td>Toevoeging Adres</td>
                      <form action="profielpagina.php" method='POST'>
                      <td><input type="text" value="<?php echo $adres2?>" pattern="[a-zA-Z0-9\s]+"  name="adresregel2" maxlength="20"></td>
                      <td><input type="submit" class="veilingknop button" name="VeranderAdresstwee" value="↻" ></td>
                      </form>
                    </tr>
                    <tr>
                      <td>Postcode</td>
                      <form action="profielpagina.php" method='POST'>
                      <td><input type="text" value="<?php echo $postcode?>" pattern="[^\s]+" name="postcode" maxlength="7"></td>
                      <td><input type="submit" class="veilingknop button" name="VeranderPostcode" value="↻" ></td>
                      </form>
                    </tr>
                    <tr>
                      <td>Land</td>
                      <form action="profielpagina.php" method='POST'>
                      <td><input type="text" value="<?php echo $land?>" pattern="[^\s]+" name="Land" maxlength="20"></td>
                      <td><input type="submit" class="veilingknop button" name="VeranderLand" value="↻" ></td>
                      </form>
                    </tr>
                    <tr>
                      <td>Geboortedatum</td>
                      <td><input type="date" value="<?php echo $geboortedatum?>" name="ProfPlaatsnaam" disabled></td>
                    </tr>
                  </table>
                </div>
              </div>


              <?php 
                if($_SESSION['rol'] == 2 || $_SESSION['rol'] == 5) {
              ?>
                <div class="tabs-panel" id="panel4v">
                  <fieldset class="fieldset medium-12 cell">
                    <legend>Wilt u spullen verkopen?</legend>
                    <form action="profielpagina.php" method='POST'>
                      <label>Verkoper worden?</label>
                    
                      <label>Bank?</label>
                      <input type="text" name="bank" value="<?php strip_tags('') ?>" required >
                      <input type="text" name="rekeningnummer" value="<?php strip_tags('') ?>" required>

                      <select>
                        <option name="controleoptie" value="post">post</option>
                        <option name="controleoptie" value="controle-optie">creditcard</option>
                      </select>

                      <input type="text" name="creditcardnummer" required>
                      <label>Accepteer voorwaarden</label>
                      <input type="radio"  value="3" name="rol" required>

                      <input type="submit" class="veilingknop button" name="VeranderRol" value="↻" >
                    </form>
                  </fieldset>
                </div>
              <?php 
                }
              ?>

            </div>
          </div>
        </div>
      </div>
    </div>

    <?php 
      include_once 'aanroepingen/footer.html';
    ?>
