<?php
  require_once 'aanroepingen/connectie.php';
  include_once 'aanroepingen/header.html';
?>

<aside  class="NavRubriekAside">
  <?php include_once 'aanroepingen/RubNav.php'; ?>
</aside>

<h1><a href="">Rubriek/subrubriek/subsubrubriek/subsubsubrubriek</a></h1>

<div class="productfotocontainer">
  <img src="images/fiets.jpg">
  <ul class="row">
    <li><img src="images/fiets.jpg"></li>
    <li><img src="images/fiets.jpg"></li>
    <li><img src="images/fiets.jpg"></li>
    <li><img src="images/fiets.jpg"></li>
  </ul>
</div>

<article class="producttekstcontainer">
  <h1>Fietstitel</h1>

  <h4><a href=""><i>Username</i></a></h4>
  <i class="fi-star yellow"></i>
  <i class="fi-star yellow"></i>
  <i class="fi-star yellow"></i>
  <i class="fi-star"></i>
  <i class="fi-star"></i>

  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

  <section class="productprijzen">
    <h4>Startprijs</h4>
    <p><i class="fi-euro"></i>39,99</p>
  </section>

  <section class="productprijzen">
    <h4>Hoogstebod</h4>
    <p><i class="fi-euro"></i>46,20</p>
  </section>

  <button class="productbieden">Bieden</button>
  <h4>Nog open tot:</h4>
    
</article>

<section class="productbieders">
  <ul>
    <li>
      <img src="images/profielfotoPlaceholder.png">
      <h2>Username</h2>
      <p><i class="fi-euro"></i>46,20</p>
    </li>
    <li>
      <img src="images/profielfotoPlaceholder.png">
      <h2>Username</h2>
      <p><i class="fi-euro"></i>46,20</p>
    </li>
    <li>
      <img src="images/profielfotoPlaceholder.png">
      <h2>Username</h2>
      <p><i class="fi-euro"></i>46,20</p>
    </li>
  </ul>
</section>

<br><br><br><br><br>

<?php
  include_once 'aanroepingen/footer.html';
?>