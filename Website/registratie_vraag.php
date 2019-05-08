<?php
  require_once 'aanroepingen/connectie.php';
  include_once 'aanroepingen/header.php';

  if(isset($_POST['verzenden_pers'])){
    $_SESSION['gebruikersnaam'] = $_POST['gebruikersnaam'];
    $_SESSION['voornaam'] = $_POST['voornaam'];
    $_SESSION['achternaam'] = $_POST['achternaam'];
    $_SESSION['adres'] = $_POST['adres'];
    if(isset($_POST['oAdres'])) {
      $_SESSION['oAdres'] = $_POST['oAdres'];
    }
    $_SESSION['postcode'] = $_POST['postcode'];
    $_SESSION['plaats'] = $_POST['plaats'];
    $_SESSION['land'] = $_POST['land'];
    $_SESSION['telnr1'] = $_POST['telnr1'];
    if(isset($_POST['telnr2'])) {
      $_SESSION['telnr2'] = $_POST['telnr2'];
    }
    $_SESSION['geboortedatum'] = $_POST['geboortedatum'];
    $_SESSION['wachtwoord'] = $_POST['wachtwoord'];
    $_SESSION['bWachtwoord'] = $_POST['bWachtwoord'];
    if(isset($_POST['eenVerkoper'])) {
      $_SESSION['eenVerkoper'] = $_POST['eenVerkoper'];
    } else {
      $_SESSION['eenVerkoper'] = 2;
    }
  }
?>

<aside  class="NavRubriekAside">
  <?php include_once 'aanroepingen/RubNav.php'; ?>
</aside>

<!--foundation-->
<ol class="progress-indicator">
  <li class="is-complete" data-step="">
    <span>Verifiëren e-mail</span>
  </li>
  <li class="is-complete" data-step="">
    <span>Gegevens invullen</span>
  </li>
  <li class="is-current" data-step="">
    <span>Veiligheid</span>
  </li>
  <li class="" data-step="">
      <span>Klaar</span>
</li>
</ol>
<!--end-->

    <h2 class="HomepaginaKopjes">Veiligheidsvraag</h2>
    <div class="body-tekst">
      <p>
        Dit is de derde stap van het registreren. 
        Hierin wordt naar een veiligheidsvraag gevraagd die wordt gevraagd als de gebruiker het wachtwoord is vergeten.
        Kies hieronder uit welke vraag en geef een antwoordt. Dit antwoordt is nodig om uw wachtwoord te herstellen. 
      </p>
      
      <form action="index.php" method="post">
        <label>Kies één veiligeheidsvraag.</label>
        <select name="veiligheidsvraag" required>
          <option>...</option>
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
      </form>
    </div>

<?php
echo "$email";

  include_once 'aanroepingen/footer.html';
?>