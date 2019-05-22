    <?php
      $config = ['pagina' => 'registratie_email'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/functies.php';

      if(!isset($_SESSION)) {
        session_start();
      }

      if (isset($_POST['verzenden_email'])) {
        if (strlen($_POST['email']) > 50) {
          echo "Het aantal karakters is te groot. Het maximale toegestane aantal karakters is 50.";
          $mailverzonden = false;
        } else {
          $mailverzonden = true;
          $_SESSION['email'] = $_POST['email'];
          
          $code = 
                  // createRandomCode();
                  'f';
          $_SESSION['code'] = $code;
          include_once 'aanroepingen/Reg_email_opmaak.php';
        }
      }

      if (isset($_POST['bevestigen_email'])) {
        if($_POST['code'] == $_SESSION['code']) {
          header('Location: registratie_persoonsgegevens.php');
        } else {
          echo "De code is verkeerd.";
        }
      }
      
      include_once 'aanroepingen/header.php';
    ?>

    <div class="holy-grail-middle">
      <?php
        include_once 'aanroepingen/registratie_progressbar.php';
      ?>
      <br>

      <h2 class="">Registreren</h2>
      <div class=" body-tekst">
        <p>
          Welkom op de registratiepagina. Vul hieronder uw e-mailadres in om te verifiëren. 
        </p>      
        <form action="registratie_email.php" method="post">
          <div class="grid-container">  
            <div class="grid-x grid-padding-x">
                <?php 
                  if(isset($mailverzonden) && $mailverzonden) {
                    echo"<p>Uw mail is verzonden. Het kan even duren voordat u hem ontvangt.</p>";
                  }
                  // Van plek veranderen + betere css?
                ?>
              <div class="medium-12 cell">
                <input type="email" placeholder="E-mail" name="email" value="<?php if(isset($_POST['email']) && !$mailverzonden) { echo htmlentities($_POST['email']);} ?>" required> 
                <input class="button" type="submit" value="Verzenden" name="verzenden_email">
              </div>
            </div>
          </div>
        </form>
        <p>
          Vervolgens krijgt u een code toegestuurd, bevestig deze code hieronder om door te gaan met het registreren.
          <br>
          Heeft u geen e-mail ontvangen?
          <a class="a-op-wit" href="#">Klik hier</a>
          om de e-mail opnieuw te sturen.
        </p>
        <form action="registratie_email.php" method="post">
          <div class="grid-container">  
            <div class="grid-x grid-padding-x">
              <div class="medium-12 cell">
                <input type="text" placeholder="Code" name="code" required> 
                <input class="button" type="submit" value="Bevestigen" name="bevestigen_email">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <?php 
      include_once 'aanroepingen/footer.html';
    ?>