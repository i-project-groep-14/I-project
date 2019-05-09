<?php
  $config = ['pagina' => 'profiel'];

  require_once 'aanroepingen/connectie.php';
  include_once 'aanroepingen/header.php';
?>

<aside  class="NavRubriekAside">
  <?php 
    include_once 'aanroepingen/RubNav.php' ; 
    include_once 'aanroepingen/RubNavMobiel.php';
  ?>
</aside><br>

<?php
  include_once 'aanroepingen/footer.html';
?>