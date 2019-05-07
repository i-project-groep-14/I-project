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

  <section class="row">
    <h4><a href="" class="grey"><i>Username</i></a></h4>
    <i class="fi-star yellow"></i>
    <i class="fi-star yellow"></i>
    <i class="fi-star yellow"></i>
    <i class="fi-star grey"></i>
    <i class="fi-star grey"></i>
  </section>

  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

  <div class="row">
    <section class="productprijzen">
      <h4>Startprijs</h4>
      <p><i class="fi-euro"></i>39,99</p>
    </section>

    <section class="productprijzen">
      <h4>Hoogstebod</h4>
      <p><i class="fi-euro"></i>46,20</p>
    </section>
  </div>

  <div class="row">
    <a class="button">Bieden</a>
    <p id="productopeningstijd">Nog open tot:</p>

    <ul class="row">
      <li class="tijd">1 d</li>
      <li class="tijd">8 u</li>
      <li class="tijd">22 m</li>
    </ul>
  </div>
    
</article>

<section class="productbieders">
  <ul>
    <li class="row">
      <img src="images/profielfotoPlaceholder.png">
      <h2>Username</h2>
      <p><i class="fi-euro"></i>46,20</p>
    </li>
    <li class="row">
      <img src="images/profielfotoPlaceholder.png">
      <h2>Username</h2>
      <p><i class="fi-euro"></i>46,20</p>
    </li>
    <li class="row">
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