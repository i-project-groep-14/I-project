<?php
  include_once 'aanroepingen/header.html';
?>

<aside  class="NavRubriekAside">
  <?php include_once 'aanroepingen/RubNav.php'; ?>
</aside>
<br>
<h1 class="InlogpaginaKopje"> Wachtwoord vergeten? </h1>

<form class="inlogpaginaContainer">
        <div>
        <input type="text" placeholder="Voer Email in" name="email" required>
        <h5>Kies een veiligheidsvraag</h5>
        <select>
            <option>Vraag 1</option>
            <option>Vraag 2</option>
            <option>Vraag 3</option>
            <option>Vraag 4</option>
        </select>
        <h5>Antwoord op de veiligheidsvraag</h5>
        <input type="text" placeholder="Antwoord op de veiligheidsvraag" name="text" required>
        <hr>
        <button type="submit" class="button inlogbutton">Nieuw wachtwoord aanvragen</button>
        </div>
 </form>




































<?php
  include_once 'aanroepingen/footer.html';
?>