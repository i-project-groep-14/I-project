<?php
  require_once 'aanroepingen/connectie.php';
  include_once 'aanroepingen/header.php';
?>

<aside class="NavRubriekAside">
<?php include_once 'aanroepingen/RubNav.php'; ?>
</aside>
<br>
<h5 class="center">SubSubSubRubriek </h5> 
       
<select class = "meerkeuzevak"> 
     <option>Kies een plaats</option>
     <option>Den Haag</option>
     <option>Amsterdam</option>
     <option>Rotterdam</option>
     <option>Arnhem</option>
</select>

<input type="radio" name="Kaas" value="Bike">Prijs Oplopend<br>
<input type="radio" name="Kaas" value="Car">Prijs Aflopend<br>
<input type="radio" name="Kaas" value="Boat">Looptijd Oplopend<br>
<input type="radio" name="Kaas" value="Bo5at">Looptijd Aflopend<br>

<div class="rubriekenContainer">
    <article class="RubriekenProducten">
        <div class ="center">
        <h3>Een Mooie Kaaskast</h3>
        <a href="#"><img src="images/kaaskast.JPG"  alt="filmje1"/></a>
        <p>Username 4868</p>
        <p>Locatie: Arnhem</p>
        <p>Huidige hoogste bod:</p>
        <h4>189,99</h4>
        <p> Veiling sluit over: </p>
        <h4> 6d 11u 12m </h4>
        </div>
        <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
    </article>

    <div class="rubriekenContainer">
    <article class="RubriekenProducten">
        <div class ="center">
        <h3>Een Mooie Kaaskast</h3>
        <a href="#"><img src="images/kaaskast.JPG"  alt="filmje1"/></a>
        <p>Username 4868</p>
        <p>Locatie: Arnhem</p>
        <p>Huidige hoogste bod:</p>
        <h4>189,99</h4>
        <p> Veiling sluit over: </p>
        <h4> 6d 11u 12m </h4>
        </div>
        <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
    </article>

    <div class="rubriekenContainer">
    <article class="RubriekenProducten">
        <div class ="center">
        <h3>Een Mooie Kaaskast</h3>
        <a href="#"><img src="images/kaaskast.JPG"  alt="filmje1"/></a>
        <span>Username 4868</span>
        <span>Locatie: Arnhem</span>
        <span>Huidige hoogste bod:</span>
        <h4>189,99</h4>
        <span> Veiling sluit over: </span>
        <h4> 6d 11u 12m </h4>
        </div>
        <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
    </article>

<?php
include_once 'aanroepingen/footer.html';
?>




