<?php
$config = ['pagina' => 'registratie_vraag'];

require_once 'aanroepingen/connectie.php';
include_once 'aanroepingen/header.php';

if(isset($_POST['register']) && isset($_POST['veiligheidsvraag'])) {
  if (strlen($_POST['veiligheidsvraag_antwoord']) > 50) {
    echo "Het aantal karakters is te groot. Het maximale toegestane aantal karakters is 50.";
  } else if ($_POST['veiligheidsvraag'] == 0) {
    echo "U moet nog een veiligheidsvraag selecteren.";
  } else {
    header('Location: index.php');
  }
}

include_once 'aanroepingen/RubNav.php';
include_once 'aanroepingen/RubNavMobiel.php';
?>
  
<?php
  include_once 'aanroepingen/registratie_progressbar.php';
?>
  
  <h2 class="HomepaginaKopjes center">Veiligheidsvraag</h2>
  <div class="body-tekst">
    <p>
    Dit is de derde stap van het registreren. 
    Hierin wordt naar een veiligheidsvraag gevraagd die wordt gevraagd als de gebruiker het wachtwoord is vergeten.
    Kies hieronder uit welke vraag en geef een antwoordt. Dit antwoordt is nodig om uw wachtwoord te herstellen. 
    </p>
  
    <form action="" method="post">
    <div class="grid-container">  
      <div class="grid-x grid-padding-x">
        <div class="medium-12 cell">
      
          <label>Kies één veiligeheidsvraag.</label>
          <select name="veiligheidsvraag">
            <option value="0">...</option>
            <option value="1">Vraag 1</option>
            <option value="2">Vraag 2</option>
            <option value="3">Vraag 3</option>
            <option value="4">Vraag 4</option>
            <option value="5">Vraag 5</option>
          </select>
        </div>
          <br>
          <br>
        <div class="medium-12 cell">
          <label>Vul het antwoordt in a.u.b.</label>
          <input type="text" name="veiligheidsvraag_antwoord" required>
        </div>
        <div class="center">
          <input class="button" type="submit" value="Verzenden" name="register">
          <div class=" btn-pos-right">
            <button class="button" onclick="window.location.href = 'registratie_persoonsgegevens.php';">Terug</button>
          </div>
        </div>

          </div>
          </div>
    </form>
  </div>
  
<?php
  include_once 'aanroepingen/footer.html';
?>