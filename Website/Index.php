<?php
  $config = ['pagina' => 'index'];

  require_once 'aanroepingen/connectie.php';
  include_once 'aanroepingen/header.php';
  include_once 'aanroepingen/timerfunctie.php';
?>


<div class="hero-full-screen top-bar">
<?php  include_once 'aanroepingen/Zoekfunctie.php';

 ?>



    
    
 


<?php include_once "aanroepingen/HomepageProducten.php" ?>



<?php
  include_once 'aanroepingen/footer.html';
?>