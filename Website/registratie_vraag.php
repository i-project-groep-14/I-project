<?php
  require_once 'aanroepingen/connectie.php';
  include_once 'aanroepingen/header.php';

  if(isset($_POST['verzenden_vraag'])){
    header("Location: registratie_klaar.php");
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
        <form action="registratie_vraag.php" methode="post">
            <p>Kies één veiligeheidsvraag.</p>
            <select>
                <option>Vragen</option>
                <option>In welke straat ben je geboren?</option>
                <option>Wat is de meisjesnaam je moeder?</option>
                <option>Wat is je lievelingsgerecht?</option>
                <option>Hoe heet je oudste zusje?</option>
                <option>Hoe heet je huisdier?</option>
            </select>
            <br><br>
            <label>Vul het antwoordt in a.u.b. 
            <input type="text" name="vraag_antwoord">
            </label>
            <br>
            <input class="button" type="submit" value="Verzenden" name="verzenden_vraag">
        </form>
</div>
<?php
  include_once 'aanroepingen/footer.html';
?>