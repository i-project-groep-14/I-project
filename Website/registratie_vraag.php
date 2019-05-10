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
?>
  
<?php
  include_once 'aanroepingen/registratie_progressbar.php';
?>
  
  <h2 class="HomepaginaKopjes">Veiligheidsvraag</h2>
  <div class="body-tekst">
    <p>
    Dit is de derde stap van het registreren. 
    Hierin wordt naar een veiligheidsvraag gevraagd die wordt gevraagd als de gebruiker het wachtwoord is vergeten.
    Kies hieronder uit welke vraag en geef een antwoordt. Dit antwoordt is nodig om uw wachtwoord te herstellen. 
    </p>
  
    <form action="" method="post">
      <label>Kies één veiligeheidsvraag.</label>
      <select name="veiligheidsvraag">
        <option value="0">...</option>
        <option value="1">Vraag 1</option>
        <option value="2">Vraag 2</option>
        <option value="3">Vraag 3</option>
        <option value="4">Vraag 4</option>
        <option value="5">Vraag 5</option>
      </select>
    
      <br>
      <br>
  
      <label>Vul het antwoordt in a.u.b.</label>
      <input type="text" name="veiligheidsvraag_antwoord" required>
  
      <br> 
  
      <input class="button" type="submit" value="Verzenden" name="register">
      <button class="button btn-pos-right" onclick="window.location.href = 'registratie_persoonsgegevens.php';">Terug</button>
    </form>
  </div>
  
<?php
  include_once 'aanroepingen/footer.html';
?>