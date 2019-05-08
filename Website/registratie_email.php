<?php
  require_once 'aanroepingen/connectie.php';
  include_once 'aanroepingen/header.php';

  // if(isset($_POST['bevestigen_email'])){
  //   header("Location: registratie_persoonsgegevens.php");
  // }
?>
<aside  class="NavRubriekAside">
  <?php include_once 'aanroepingen/RubNav.php'; ?>
</aside>

<!--foundation-->
<ol class="progress-indicator">
  <li class="is-current" data-step="">
    <span>Verifiëren e-mail</span>
  </li>
  <li class="" data-step="">
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
          Welkom op de registratiepagina. Vul hieronder uw geldige e-mailadres in om te verifiëren. 
        </p>
        
        <form action="registratie_persoonsgegevens.php" method="post">
          <input type="email" placeholder="E-mail" name="email"> 
          <input class="button" type="submit" value="Verzenden" name="verzenden_email">
        </form>

        <p>
          Vervolgens krijgt u een code toegestuurd, bevestig deze code hieronder om door te gaan met het registreren.
          <br>
          Heeft u geen e-mail ontvangen?
          <a class="a-op-wit" href="#">Klik hier</a> 
          om de e-mail opnieuw te sturen.
        </p>
        <form action="registratie_email.php" method="post">
          <input type="text" placeholder="Code"> 
          <input class="button" type="submit" value="Bevestigen" name="bevestigen_email">
        </form>
    </div>
      
<?php
  include_once 'aanroepingen/footer.html';
?>
   