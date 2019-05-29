<div class="RubNav row">
  <ul class="multilevel-accordion-menu vertical menu" data-accordion-menu>
    
    <?php
      $rubriekenplek = 0;
      $sql = "SELECT COUNT(*) as aantalHoofdRubrieken FROM rubriek
              WHERE rubriek = 0";
      $query = $dbh->prepare($sql);
      $query -> execute();
      $row = $query -> fetch();

      for($i = 0; $i < $row['aantalHoofdRubrieken']; $i++) {
        $subplek = 0;
        $rubriekenplek = createRubriek($rubriekenplek);
      }
    ?>

  </ul>
</div>
