<?php
  $config = ['pagina' => 'inlogpagina'];

  require_once 'aanroepingen/connectie.php';

  if(isset($_POST['login'])){
    $sql = "SELECT rol FROM gebruiker 
            WHERE gebruikersnaam like :gebruikersnaam";
    $query = $dbh->prepare($sql);
    $query -> execute(array(
      ':gebruikersnaam' => $_POST['inlogAccNaam']
    ));
    $row = $query -> fetch();

    if($row['rol'] == 1) {
      $melding = "
      <div data-closable class='callout alert-callout-border alert radius'>
      <strong> Error </strong> U bent geblokkeerd, neem <a href='contact.php'> contact </a> met ons op voor meer informatie.
  <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>
";
    } else {
    $inlognaam = strip_tags($_POST['inlogAccNaam']);
    $wachtwoord = strip_tags($_POST['inlogWw']);

    $sql = "SELECT wachtwoord FROM gebruiker 
            WHERE gebruikersnaam like :gebruikersnaam";
    $query = $dbh->prepare($sql);
    $query -> execute(array(
        ':gebruikersnaam' => $inlognaam
    ));

    $row = $query -> fetch();

    if(password_verify($wachtwoord, $row['wachtwoord'])){
      session_destroy();
      session_start();

      $_SESSION['login'] = $_POST['login'];
      $_SESSION['gebruikersnaam'] = strip_tags($inlognaam);

  $melding = "
      <div data-closable class='callout alert-callout-border success'>
  <strong>Yay!</strong> - U bent succesvol ingelogd.
  <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>
";
      header ('Location: index.php');
    } else {
$melding = "
      <div data-closable class='callout alert-callout-border alert radius'>
  <strong>Error</strong> - Gebruikersnaam of wachtwoord onjuist.
  <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>
";
    }
  }}

  include_once 'aanroepingen/header.php';
?>

    <div class="holy-grail-middle">
    <h1 class="InlogpaginaKopje"> Inloggen </h1>
    <?php
    if(isset($melding)) {
						echo "<br>";
						echo $melding; 
            echo "<br>";
    }
            ?>
      <div class="InlogContainer">
       
        <form class="inlogpaginaContainer" method="post" action="inlogpagina.php">
            <input type="text" placeholder="Voer gebruikersnaam in" name="inlogAccNaam" required>
            <input type="password" placeholder="Voer wachtwoord in" name="inlogWw" required>
            <hr>
            <button type="submit" class="button inlogbutton" name="login">Log in</button>

            <input type="button" class="button inlogbutton" onclick="window.location.href = 'wachtwoordvergeten.php';" value="Wachtwoord vergeten?"/>
            <p>Als je nog geen account voor EenmaalAndermaal hebt maak dan <a href="registratie_email.php">hier</a> een account.</p>
        </form>
      </div>
    </div>

    <?php 
      include_once 'aanroepingen/footer.html';
    ?>