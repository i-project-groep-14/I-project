<?php
      $config = ['pagina' => 'Profielpagina'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';
      $sql = "SELECT * FROM gebruiker where gebruikersnaam = :gebruiker";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
          ':gebruiker' => $_SESSION['gebruikersnaam']
        ));
        $row = $query -> fetch();
        
        $sql = "SELECT * FROM gebruikerstelefoon where gebruiker = :gebruiker";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
          ':gebruiker' => $_SESSION['gebruikersnaam']
        ));
        $hj = $query -> fetch();
        
    ?>

    
    <div class="holy-grail-middle">
    <h1>Deze pagina is in bewerking</h1>
    <div class="grid-container">
  <div class="grid-x grid-margin-x">
    <div class="cell medium-3">
      <ul class="vertical tabs" data-tabs id="example-tabs">
      <?php if($_SESSION['rol'] == 3 || $_SESSION['rol'] == 5 ){?>
        <li class="tabs-title is-active"><a href="#panel1v" aria-selected="true">Veilingen</a></li>
      <?php  } ?>
        <li class="tabs-title"><a href="#panel2v">Biedingen</a></li>
        <li class="tabs-title"><a href="#panel3v">Gegevens</a></li>
        <?php if($_SESSION['rol'] == 2 || $_SESSION['rol'] == 5){?>
        <li class="tabs-title"><a href="#panel4v">Upgrade</a></li>
        <?php }?>
      </ul>
    </div>
    <div class="cell medium-9">
      <div class="tabs-content" data-tabs-content="example-tabs">
      <?php if($_SESSION['rol'] == 3 || $_SESSION['rol'] == 5){?>
        <div class="tabs-panel is-active" id="panel1v">
          <!-- aantal veilingen-->
          
         <?php 
         $plek = 0;
         $aantalveilingen = selectAantalVeilingen($_SESSION['gebruikersnaam']);
          echo "<div style='overflow-x:auto;'>
          
          <table >
         
            <tr>
            
              <td>Titel</td>
              <td>Startprijs</td>
              <td>Betalingswijze</td>
              <td>Plaats</td>
              <td>StartVeiling</td>
              <td>EindeVeiling</td>
              <td>Verkoopprijs</td>
              <td>Koper</td>
              <td>Veilinggesloten</td>
            </tr>
            ";
            for($i = 0; $i < $aantalveilingen ; $i++) {
              $plek = createProfVeilingen($plek);
            }
        echo "
          </table>
        </div>"
         ?>
         <!-- einde aantal veilingen -->
        </div>
        <?php  } ?>
        <div class="tabs-panel" id="panel2v">
            <!-- aantal biedingen-->
            <?php 
         $plek = 0;
         $aantalveilingen = selectAantalBiedingen($_SESSION['gebruikersnaam']);
          echo "<div style='overflow-x:auto;'>
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
        </div>"
         ?>
<!-- einde aantal biedingen -->
        </div>
        <div class="tabs-panel" id="panel3v">
          <!-- Profiel gegevens -->
          <div style="overflow-x:auto;">
              <table>
                <tr>
                  <th>Persoonsgegevens</th>
                  <th></th>
                </tr>
                <tr>
                  <td>Gebruikersnaam</td>
                  
                  <td><input type="text"  value="<?php  echo $row['gebruikersnaam']?>" name="Profgebruikersnaam" disabled></td>
                  
                </tr>
                <tr>
                  <td>E-mail</td>
                  <td><input type="text"  value="<?php echo $row['mailadres']?>" name="ProfMail" disabled></td>
                </tr>
                <tr>
                  <td>Voornaam</td>
                  <form action="profielpagina.php" method='POST'>
                  <td><input type="text"  value="<?php echo $row['voornaam']?>" pattern="[^\s]+"  name="voornaam"></td>
                  <td><input type="submit" class="veilingknop button" name="VeranderVnaam" value="↻" ></td>
                  </form>
                </tr>
                <tr>
                  <td>Achternaam</td>
                  <form action="profielpagina.php" method='POST'>
                  <td><input type="text"  value="<?php echo $row['achternaam']?>" pattern="[^\s]+" name="achternaam"></td>
                  <td><input type="submit" class="veilingknop button" name="VeranderAnaam" value="↻" ></td>
                  </form>
                </tr>
                <tr>
                  <td>Telefoonnummer</td>
                  <form action="profielpagina.php" method='POST'>
                  <td><input type="number"  value="<?php echo (int)$hj['telefoon']?>" name="telefoon"></td>
                  <td><input type="submit" class="veilingknop button" name="VeranderTel" value="↻" ></td>
                  </form>
                </tr>
                <tr>
                  <td>Alternatieve Telefoonnummer</td>
                  <form action="profielpagina.php" method='POST'>
                  <td><input type="number"  value="<?php echo (int)$hj['alttelefoon']?>" name="telefoon2"></td>
                  <td><input type="submit" class="veilingknop button" name="VeranderTels" value="↻" ></td>
                  </form>
                </tr>

                <tr>
                  <td>Adres</td>
                  <form action="profielpagina.php" method='POST'>
                  <td><input type="text"  value="<?php echo $row['adresregel1']?>" pattern="[a-zA-Z0-9\s]+" name="adresregel1"></td>
                  <td><input type="submit" class="veilingknop button" name="VeranderAdress" value="↻" ></td>
                  </form>
                </tr>
                <tr>
                  <td>Toevoeging Adres</td>
                  <form action="profielpagina.php" method='POST'>
                  <td><input type="text"  value="<?php echo $row['adresregel2']?>" pattern="[a-zA-Z0-9\s]+"  name="adresregel2"></td>
                  <td><input type="submit" class="veilingknop button" name="VeranderAdresstwee" value="↻" ></td>
                  </form>
                </tr>
                <tr>
                  <td>Postcode</td>
                  <form action="profielpagina.php" method='POST'>
                  <td><input type="text"  value="<?php echo $row['postcode']?>" pattern="[^\s]+" name="postcode"></td>
                  <td><input type="submit" class="veilingknop button" name="VeranderPostcode" value="↻" ></td>
                  </form>
                </tr>
                <tr>
                  <td>Land</td>
                  <form action="profielpagina.php" method='POST'>
                  <td><input type="text"  value="<?php echo $row['land']?>" pattern="[^\s]+" name="Land"></td>
                  <td><input type="submit" class="veilingknop button" name="VeranderLand" value="↻" ></td>
                  </form>
                </tr>
                <tr>
                  <td>Geboortedatum</td>
                  <td><input type="date"  value="<?php echo $row['geboortedatum']?>" name="ProfPlaatsnaam" disabled></td>
                  
                </tr>
                
              </table>
              
            </div>
          
          <?php


    $gebruiker = $_SESSION['gebruikersnaam'];
    

    if (isset($_POST['VeranderVnaam'])) {
      $voornaam = $_POST['voornaam'];
            $sql = "UPDATE gebruiker 
                           SET voornaam = :voornaam
                           WHERE gebruikersnaam like :gebruikersnaam";
            $query = $dbh->prepare($sql);
            $query -> execute(array(
                ':voornaam' => $voornaam,
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
                ':achternaam' => $achternaam,
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
                ':adresregel1' => $adres,
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
                ':adresregel2' => $adres,
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
                ':postcode' => $adres,
                ':gebruikersnaam' => $gebruiker
            ));
    }

    if (isset($_POST['VeranderTel'])) {
      $telefoon = $_POST['telefoon'];
            $sql = "UPDATE gebruikerstelefoon 
                           SET telefoon = :telefoon
                           WHERE gebruiker like :gebruiker";
            $query = $dbh->prepare($sql);
            $query -> execute(array(
                ':telefoon' => $telefoon,
                ':gebruiker' => $gebruiker
            ));
    }

    if (isset($_POST['VeranderTels'])) {
      $telefoon = $_POST['telefoon2'];
            $sql = "UPDATE gebruikerstelefoon 
                           SET alttelefoon = :telefoon
                           WHERE gebruiker like :gebruiker";
            $query = $dbh->prepare($sql);
            $query -> execute(array(
                ':telefoon' => $telefoon,
                ':gebruiker' => $gebruiker
            ));
    }
    if (isset($_POST['VeranderLand'])) {
      $adres = $_POST['Land'];
            $sql = "UPDATE gebruiker 
                           SET Land = :Land
                           WHERE gebruikersnaam like :gebruikersnaam";
            $query = $dbh->prepare($sql);
            $query -> execute(array(
                ':Land' => $adres,
                ':gebruikersnaam' => $gebruiker
            ));
    }

         
         
      
?>


        </div>
         <!-- EINDE Profiel gegevens -->
         <?php if($_SESSION['rol'] == 2 || $_SESSION['rol'] == 5){?>
         <div class="tabs-panel" id="panel4v">
         <fieldset class="fieldset medium-12 cell">
         <legend>Wilt u spullen verkopen?</legend>
            <form action="profielpagina.php" method='POST'>
            <label>Verkoper worden?</label>
            
            <label>Bank?</label>
              <input type="text" name="bank" required >
              <input type="text" name="rekeningnummer"required>
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
<?php 


if (isset($_POST['VeranderRol'])) {
  $rol = $_POST['rol'];
        $sql = "UPDATE gebruiker 
        SET rol = :rol
        WHERE gebruikersnaam like :gebruikersnaam";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
          ':rol' => $rol,
          ':gebruikersnaam' => $gebruiker
      ));       
  
  $sql = "INSERT INTO verkoper VALUES (:gebruiker, :bank, :bankrekening, :controleoptie, :creditcard)";
    $query = $dbh->prepare($sql);
    $query -> execute(array(
      ':gebruiker' => $_SESSION['gebruikersnaam'],
      ':bank' => $_POST['bank'],
      ':bankrekening' => $_POST['rekeningnummer'],
      ':controleoptie' => $_POST['controleoptie'],
      ':creditcard' => $_POST['creditcardnummer']
      )
    );
}
?>
         
        </div>
      <?php } ?>

      </div>
    </div>
    

    
  </div>
</div>




    </div>
    <?php 
      include_once 'aanroepingen/footer.html';
    ?>
