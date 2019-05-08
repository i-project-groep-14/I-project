<?php
  require_once 'aanroepingen/connectie.php';
  include_once 'aanroepingen/header.php';

  if(isset($_POST['verzenden_email'])){
    // header("Location: registratie_vraag.php");
    $_SESSION['email'] = "test";
    //  $_POST['email'];
    echo "$_SESSION['email']";
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

          <form action="registratie_vraag.php" method="post" >
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

              <label>Wilt u spullen verkopen?</label>
              <label class="label-next" for="wel">Ja</label>
              <input type="radio" name="eenVerkoper" value="3" id="wel">
              <label for="niet">Nee</label>
              <input type="radio" name="eenVerkoper" value="2" id="niet"> <br>
              Mocht u nu nog geen verkoper zijn, kunt u dit altijd later aanpassen.<br><br>

              <input class="button" type="submit" name="verzenden_pers" value="Verzenden">
          
          </form>
        </div>

<?php
  include_once 'aanroepingen/footer.html';
?>

