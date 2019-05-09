<?php
  require_once 'aanroepingen/connectie.php';
  include_once 'aanroepingen/header.php';
  include_once 'aanroepingen/timerfunctie.php';
?>


<div class="hero-full-screen top-bar">
<?php  include_once 'aanroepingen/Zoekfunctie.php';?>
</div>


<aside  class="NavRubriekAside">
  <?php include_once 'aanroepingen/RubNav.php'; 
        include_once 'aanroepingen/RubNavMobiel.php'
  ?>

</aside>


<?php include_once "HomepageProducten.php" ?>



<?php
  include_once 'aanroepingen/footer.html';
?>