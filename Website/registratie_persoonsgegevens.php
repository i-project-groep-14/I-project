<?php
  require_once 'aanroepingen/connectie.php';
  include_once 'aanroepingen/header.html';
  if(isset($_POST['verzenden_pers'])){
    header("Location: registratie_vraag.php");
}
?>

<aside  class="NavRubriekAside">
  <?php include_once 'aanroepingen/RubNav.php'; ?>
</aside>

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
 
        <h2 class="HomepaginaKopjes">Registreren</h2>
        <div class="body-tekst">
        <p>
            Dit is de tweede stap van het registreren. Vul a.u.b uw persoonlijkegegevens hieronder in. 
        </p>
        <form action="registratie_persoonsgegevens.php" method="post" >
            Gebruikersnaam:
            <input type="text" placeholder="Gebruikersnaam" name="gebruikersnaam">
            Voornaam:
            <input  type="text" placeholder="Voornaam" name="voornaam" >
            Achternaam:
            <input type="text" placeholder="Achternaam" naam="achternaam" >
            Adres:
            <input type="text" placeholder="Adres" name="adres">
            Toevoeging Adres (Optioneel): 
            <div class="tooltip">Meer informatie?
              <span class="tooltiptext">Dit is een extra adres regel voor mensen die buiten Nederland wonen.</span>
            </div>
            <input type="text" placeholder="Tweede adres" name="oAdres">
            Postcode:
            <input type="text" placeholder="Postcode" name="postcode">
            Plaatsnaam:
            <input type="text" placeholder="Plaats" name="plaats">        
            Landsnaam:
            <input type="text" placeholder="Land" name="land">
            Telefoonnr:
            <input type="tel" placeholder="Telefoonnr" name="telnr1">
            Telefoonnr 2 (Optioneel):
            <input type="tel" placeholder="Telefoonnr" name="telnr2">
            Geboortedatum:
            <input type="date" name="geboortedatum">
            Wachtwoord:
            <input type="text" placeholder="Wachtwoord" name="wachtwoord">
            Bevestig Wachtwoord:
            <input type="text" placeholder="Bevestig wachtwoord" name="bWachtwoord">
            Wordt dit een verkopersaccount?<br>
            <label class="label-next side-label" for="wel">Wel</label>
            <input type="radio" name="eenVerkoper" id="wel"> 
            <label for="niet">Niet</label>
            <input type="radio" name="eenVerkoper" id="niet"> <br>
            <div class="wel-verkopergegevens">
              <label for="verkoopgegevens-rekeningnr">Rekeningnummer:</label>
              <input type="text" name="verkoopgegevens-rekeningnr" placeholder="Rekeningnummer">
              <label for="verkoopgegevens-bank">Bank:</label>
              <input type="text" name="verkoopgegevens-bank" placeholder="Bank">
              <label for="controle-creditcard" class="label-next side-label">Creditcard:</label>
              <input type="radio" name="controle" id="controle-creditcard">
              <label for="controle-post">Post:</label>
              <input type="radio" name="controle" id="controle-post">
              <div class="controle-creditcard-gegevens">
                <label for="creditcard-gegevens">Creditcardnummer</label>
                <input type="text" name="creditcardnummer" id="creditcard-gegevens" placeholder="Creditcardnummer">
              </div>
            </div> 
            Dit kan na een normaal account, nog altijd een verkopersaccount worden.<br><br>
            <input class="button" type="submit" name="verzenden_pers" value="Verzenden">
        
        </form>
</div>

<?php
  include_once 'aanroepingen/footer.html';
?>

