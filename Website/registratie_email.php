<?php
  $config = ['pagina' => 'registratie_email'];

  require_once 'aanroepingen/connectie.php';
  include_once 'aanroepingen/header.php';

  if (isset($_POST['verzenden_email'])) {
    if (strlen($_POST['email']) > 50) {
      echo "Het aantal karakters is te groot. Het maximale toegestane aantal karakters is 50.";
    } else {
      $_SESSION['email'] = $_POST['email'];
      header('Location: registratie_persoonsgegevens.php');
    }
  }
?>

<?php
  include_once 'aanroepingen/registratie_progressbar.php';
?>


 <h2 class="HomepaginaKopjes">Registreren</h2>
    <div class="body-tekst">
        <p>
          Welkom op de registratiepagina. Vul hieronder uw geldige e-mailadres in om te verifiëren. 
        </p>      
        <form action="" method="post">
          <input type="email" placeholder="E-mail" name="email" required> 
          <input class="button" type="submit" value="Verzenden" name="verzenden_email">
        </form>
        <p>
          Vervolgens krijgt u een code toegestuurd, bevestig deze code hieronder om door te gaan met het registreren.
          <br>
          Heeft u geen e-mail ontvangen?
          <a class="a-op-wit" href="#">Klik hier</a>
          om de e-mail opnieuw te sturen.
        </p>
        <form action="" method="post">
          <input type="text" placeholder="Code" required> 
          <input class="button" type="submit" value="Bevestigen" name="bevestigen_email">
        </form>
    </div>
      
<?php
  include_once 'aanroepingen/footer.html';
?>
   