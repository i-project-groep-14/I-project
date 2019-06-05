    <?php
      $config = ['pagina' => 'wachtwoordvergeten'];
      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';
    ?>

    <div class="holy-grail-middle">
      <h1 class="InlogpaginaKopje"> Wachtwoord Vergeten? </h1>
      <form>
          <input type="text" placeholder="Voer e-mail in" name="email" required>
          <h5>Kies een veiligheidsvraag</h5>
          <select>
            <option>Vragen</option>
            <?php
              $plek = 0;
              $sql = "SELECT COUNT(*) as aantalVragen FROM vraag";
              $query = $dbh->prepare($sql);
              $query -> execute();
              $row = $query -> fetch();

              for($i = 0; $i < $row['aantalVragen']; $i++) {
                $plek = createQuestions($plek);
              }
            ?>
          </select>
          <hr>
          <h5>Antwoord op de veiligheidsvraag</h5>
          <input type="text" placeholder="Antwoord op de veiligheidsvraag" name="text" required>
          <input type="button" class="button inlogbutton" onclick="window.location.href = 'wachtwoordvergeten.php';" value="Nieuw wachtwoord aanvragen">
          <p>Antwoord op de veiligheidsvraag vergeten? Neem <a href="contact.php">contact</a> op met ons.</p>
      </form>
    </div>
    <?php
      include_once 'aanroepingen/footer.html';
    ?>