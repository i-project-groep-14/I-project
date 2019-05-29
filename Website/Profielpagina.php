<?php
      $config = ['pagina' => 'Profielpagina'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';
      $sql = "SELECT * FROM gebruiker where gebruikersnaam=:gebruiker";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
          ':gebruiker' => $_SESSION['gebruikersnaam']
        ));
        $row = $query -> fetch();

        
        
        
        
        
    ?>

    
    <div class="holy-grail-middle">
    <div class="grid-container">
  <div class="grid-x grid-margin-x">
    <div class="cell medium-3">
      <ul class="vertical tabs" data-tabs id="example-tabs">
      <?php if($_SESSION['rol'] == 3 || $_SESSION['rol'] == 5 ){?>
        <li class="tabs-title is-active"><a href="#panel1v" aria-selected="true">Veilingen</a></li>
      <?php  } ?>
        <li class="tabs-title"><a href="#panel2v">Biedingen</a></li>
        <li class="tabs-title"><a href="#panel3v">Gegevens</a></li>
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
          <form action="profielpagina.php" method='POST'>
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
                  <td><input type="text"  value="<?php echo $row['mailadres']?>" name="ProfMail"></td>
                </tr>
                <tr>
                  <td>Voornaam</td>
                  <td><input type="text"  value="<?php echo $row['voornaam']?>" name="voornaam"></td>

                </tr>
                <tr>
                  <td>Achternaam</td>
                  <td><input type="text"  value="<?php echo $row['achternaam']?>" name="ProfAchternaam"></td>

                </tr>
                <tr>
                  <td>Telefoonnummer</td>
                  <!--<td><input type="text"  value="<?php echo $row['telefoon']?>" name="ProfTelefoon"></td>-->
                </tr>
                <tr>
                  <td>Alternatieve Telefoonnummer</td>
                  <!--<td><input type="text"  value="<?php echo $row['telefoon']?>" name="ProfTelefoon2"></td>-->
                </tr>

                <tr>
                  <td>Adres</td>
                  <td><input type="text"  value="<?php echo $row['adresregel1']?>" name="ProfAdresregel1"></td>
                </tr>
                <tr>
                  <td>Toevoeging Adres</td>
                  <td><input type="text"  value="<?php echo $row['adresregel2']?>" name="ProfAdresregel2"></td>
                </tr>
                <tr>
                  <td>Postcode</td>
                  <td><input type="text"  value="<?php echo $row['postcode']?>" name="ProfPostcode"></td>
                </tr>
                <tr>
                  <td>Land</td>
                  <td><input type="text"  value="<?php echo $row['land']?>" name="ProfLand"></td>
                </tr>
                <tr>
                  <td>Geboortedatum</td>
                  <td><input type="date"  value="<?php echo $row['geboortedatum']?>" name="ProfPlaatsnaam"></td>
                  <td><input type="submit" class="veilingknop button" name="test" value="test" ></td>
                </tr>
                
              </table>
              
            </div>
          </form>
          <?php


    $gebruiker = $_SESSION['gebruikersnaam'];
    

    if (isset($_POST['test'])) {
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
?>
    
      
  
        </div>
         <!-- EINDE Profiel gegevens -->
      </div>
     


      
    </div>
  </div>
</div>




    </div>
    <?php 
      include_once 'aanroepingen/footer.html';
    ?>
