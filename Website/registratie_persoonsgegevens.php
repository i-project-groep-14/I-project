<?php
  require_once 'aanroepingen/connectie.php';
  include_once 'aanroepingen/header.php';

  if(isset($_POST['verzenden_pers'])){
    header("Location: registratie_vraag.php");
    $_POST['email'] = $_SESSION['email'];
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
  <li class="is-current" data-step="">
  <span>Gegevens invullen</span>
  </li>
  <li class="" data-step="">
  <span>Veiligheid</span>
  </li>
  <li class="" data-step="">
      <span>Klaar</span>
</li>
</ol>
<!--end-->

        <h2 class="HomepaginaKopjes">Registreren</h2>
        <div class="body-tekst">
          <p>
              Dit is de tweede stap van het registreren. Vul a.u.b uw persoonlijkegegevens hieronder in. 
          </p>

          <form action="registratie_persoonsgegevens.php" method="post" >
              <label>Gebruikersnaam:</label>
              <input type="text" placeholder="Gebruikersnaam" name="gebruikersnaam">

              <label>Voornaam:</label>
              <input  type="text" placeholder="Voornaam" name="voornaam" >

              <label>Achternaam:</label>
              <input type="text" placeholder="Achternaam" naam="achternaam" >

              <label>Adres:</label>
              <input type="text" placeholder="Adres" name="adres">

              <label>Toevoeging Adres (Optioneel): </label>
              <div class="tooltip">Meer informatie?
                <span class="tooltiptext">Dit is een extra adres regel voor mensen die buiten Nederland wonen.</span>
              </div>
              <input type="text" placeholder="Tweede adres" name="oAdres">

              <label>Postcode:</label>
              <input type="text" placeholder="Postcode" name="postcode">

              <label>Plaatsnaam:</label>
              <input type="text" placeholder="Plaats" name="plaats">

              <label>Landsnaam:</label>
              <input type="text" placeholder="Land" name="land">

              <label>Telefoonnr:</label>
              <input type="tel" placeholder="Telefoonnr" name="telnr1">

              <label>Telefoonnr 2 (Optioneel):</label>
              <input type="tel" placeholder="Telefoonnr" name="telnr2">
              <!-- Achterhalen of dit kan/mag -->

              <label>Geboortedatum:</label>
              <input type="date" name="geboortedatum">

              <label>Wachtwoord:</label>
              <input type="text" placeholder="Wachtwoord" name="wachtwoord">

              <label>Bevestig Wachtwoord:</label>
              <input type="text" placeholder="Bevestig wachtwoord" name="bWachtwoord">

              <label>Wordt dit een verkopersaccount?</label>
              <label class="label-next" for="wel">Wel</label>
              <input type="radio" name="eenVerkoper" id="wel">
              <label for="niet">Niet</label>
              <input type="radio" name="eenVerkoper" id="niet"> <br>
              Dit kan na een normaal account, nog altijd een verkopersaccount worden.<br><br>

              <input class="button" type="submit" name="verzenden_pers" value="Verzenden">
          
          </form>
        </div>

<?php
  include_once 'aanroepingen/footer.html';
?>

