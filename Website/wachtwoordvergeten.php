<?php
  $config = ['pagina' => 'wachtwoordvergeten'];

  require_once 'aanroepingen/connectie.php';
  include_once 'aanroepingen/header.php';
?>

<br>

 <h1 class="InlogpaginaKopje"> Wachtwoord Vergeten? </h1>
<form class="inlogpaginaContainer">
        <div>
        <input type="text" placeholder="Voer e-mail in" name="email" required>
        <h5>Kies een veiligheidsvraag</h5>
        <select>
            <option>Vragen</option>
            <option>In welke straat ben je geboren?</option>
            <option>Wat is de meisjesnaam van je moeder?</option>
            <option>Wat is je lievelingsgerecht?</option>
            <option>Hoe heet je oudste zusje?</option>
            <option>Hoe heet je huisdier?</option>
        </select>
        <hr>
        <h5>Antwoord op de veiligheidsvraag</h5>
        <input type="text" placeholder="Antwoord op de veiligheidsvraag" name="text" required>
        <input type="button" class="button inlogbutton" onclick="window.location.href = 'wachtwoordvergeten.php';" value="Nieuw wachtwoord aanvragen"/>
        <p>Antwoord op de veiligheidsvraag vergeten? Neem contact op met ons.</p>
        </div>
 </form>
<?php
  include_once 'aanroepingen/footer.html';
?>