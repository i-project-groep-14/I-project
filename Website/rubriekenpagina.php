<?php
  $config = ['pagina' => 'rubriekenpagina'];

  require_once 'aanroepingen/connectie.php';
  include_once 'aanroepingen/header.php';
?>

<aside class="NavRubriekAside">
<?php include_once 'aanroepingen/RubNav.php';
include_once 'aanroepingen/RubNavMobiel.php'
?>
</aside>
<div class="row columns"> 
  <nav aria-label="You are here:" role="navigation">
    <ul class="breadcrumbs">
      <li><a href="Index.php">Home</a></li>
      <li><a href="#">Antiek en Kunst</a></li>
      <li>    
      <span class="show-for-sr">Current: </span> Kasten
      </li>
    </ul>
  </nav>
</div>
<br>
<div class="rubrieken">
<div class ="tabelvorm">
    <input type="radio" name="Kaas" value="op">Prijs Oplopend<br>
    <input type="radio" name="Kaas" value="af">Prijs Aflopend<br>
    <input type="radio" name="Kaas" value="op">Looptijd Oplopend<br>
    <input type="radio" name="Kaas" value="af">Looptijd Aflopend<br>
</div>

<div class="tabelvorm">
        <h3>Locatie</h3>
        <select class = "meerkeuzevak"> 
          <option>Kies een plaats</option>
          <option>Den Haag</option>
          <option>Amsterdam</option>
          <option>Rotterdam</option>
          <option>Arnhem</option>
          </select>
</div>
<div class="tabelvorm">
        <h3>Prijs</h3>
 <p> Van: </p> <input type="text"> 
 <p> Tot: </p> <input type="text">
</div>
</div>

    <div class="rubriekenContainer">
    <article class="RubriekenProducten" >
        <h3>Een Mooie Kaaskast</h3>
        <div class ="rechts">
       <input type='submit'value='Bieden!' onclick="window.location.href = 'product.php';" class='button'>
       </div>
        <div class ="center">
        <img src="Images/Kaaskast.jpg" alt="Italian Trulli">
        <p>Locatie: Arnhem</p>
        <p>Huidige hoogste bod:</p>
        <h4>189,99</h4>
        <p>Veiling sluit over: </p>
        <h4>6d 11u 12m</h4>
        </div>
    </div>
    </article>

    <div class="rubriekenContainer">
    <article class="RubriekenProducten">
    <h3>Een Geweldige Rubberen Eend</h3>
    <div class = "rechts"> 
       <input type='submit'value='Bieden!' onclick="window.location.href = 'product.php';" class='button'>
       </div>
        <div class ="center">
        <img src="images/Eend.jpg"  alt="filmje1"/>
        <p>Locatie: Arnhem</p>
        <p>Huidige hoogste bod:</p>
        <h4>189,99</h4>
        <p>Veiling sluit over:</p>
        <h4>6d 11u 12m</h4>
       </div>
    </article>

    <div class="rubriekenContainer">
    <article class="RubriekenProducten">
    <h3>Een Salade wel over datum</h3>
    <div class ="rechts">
       <input type='submit'value='Bieden!' onclick="window.location.href = 'product.php';" class='button'>
       </div>
        <div class ="center">
       <img src="images/Salade.jpg"  alt="filmje1"/>
        <p>Locatie: Arnhem</p>
        <p>Huidige hoogste bod:</p>
        <h4>189,99</h4>
        <p>Veiling sluit over:</p>
        <h4>6d 11u 12m</h4>
        </div>
        </article>
        </div>
        </div>
<?php
include_once 'aanroepingen/footer.html';
?>



