    <?php
      $config = ['pagina' => 'registratie_email'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/functies.php';

      if(!isset($_SESSION)) {
        session_start();
      }

      if (isset($_POST['verzenden_email'])) {
        if (strlen($_POST['email']) > 50) {
          $melding = "
          <div data-closable class='callout alert-callout-border alert radius'>
            <strong>Error</strong> - Het aantal karakters is te groot. Het maximale toegestane aantal karakters is 50.
            <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
            <span aria-hidden='true'>&times;</span>
            </button>
        </div>
        ";
          $mailverzonden = false;
        } else {
          $mailverzonden = true;
          $_SESSION['email'] = strip_tags($_POST['email']);
          
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
          $melding = "
          <div data-closable class='callout alert-callout-border alert radius'>
            <strong>Error</strong> - De code is verkeerd.
            <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
            <span aria-hidden='true'>&times;</span>
            </button>
        </div>
        ";
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

                <?php
                    if(isset($melding)) {
                        echo "<br>";
                        echo $melding; 
                        echo "<br>";
                      }
                ?>

        <form action="registratie_email.php" method="post">
          <div class="grid-container">  
            <div class="grid-x grid-padding-x">
                <?php 
                  if(isset($mailverzonden) && $mailverzonden) {
                    echo"
                    <div data-closable class='callout alert-callout-border success'>
                      Uw mail is verzonden. Het kan even duren voordat u hem ontvangt.
                      <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
                        <span aria-hidden='true'>&times;</span>
                      </button>
                    </div>";
                  }
                  // Van plek veranderen + betere css?
                ?>
              <div class="medium-12 cell">
                <input type="email" placeholder="voorbeeld@voorbeeld.nl" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email" maxlength="50" value="<?php if(isset($_POST['email']) && !$mailverzonden) { echo htmlentities($_POST['email']);} ?>" required> 
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