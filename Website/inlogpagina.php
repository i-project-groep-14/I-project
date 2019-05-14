<?php
  $config = ['pagina' => 'inlogpagina'];

  require_once 'aanroepingen/connectie.php';

  if(isset($_POST['login'])){
    $inlognaam = $_POST['inlogAccNaam'];
    $wachtwoord = $_POST['inlogWw'];

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
      $_SESSION['gebruikersnaam'] = $inlognaam;

      echo "U bent succesvol ingelogd.";
      header ('Location: index.php');
    } else {
      echo "Gebruikersnaam of wachtwoord onjuist.";
    }
  }

  include_once 'aanroepingen/header.php';
?>

    <div class="holy-grail-middle">
      <h1 class="InlogpaginaKopje"> Inloggen </h1>
      <form class="inlogpaginaContainer" method="post" action="inlogpagina.php">
          <input type="text" placeholder="Voer gebruikersnaam in" name="inlogAccNaam" required>
          <input type="password" placeholder="Voer wachtwoord in" name="inlogWw" required>
          <hr>
          <button type="submit" class="button inlogbutton" name="login">Log in</button>

          <input type="button" class="button inlogbutton" onclick="window.location.href = 'wachtwoordvergeten.php';" value="Wachtwoord vergeten?"/>
          <p>Als je nog geen account voor EenmaalAndermaal hebt maak dan <a href="registratie_email.php">hier</a> een account.</p>
      </form>
    </div>

    <?php 
      include_once 'aanroepingen/footer.html';
    ?>