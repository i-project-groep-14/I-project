


<?php
  $config = ['pagina' => 'rubriekenpagina'];

  require_once 'aanroepingen/connectie.php';
  include_once 'aanroepingen/header.php';
?>

<div class = "inline">
<aside class="NavRubriekAside">
<?php include_once 'aanroepingen/RubNav.php';
include_once 'aanroepingen/RubNavMobiel.php'
?>
</aside>

<br>
<div class="rubrieken">
<h5 class="marginlinks"> Antiek en Kunst > Kasten > Kaaskasten </h5>
       
<select class = "meerkeuzevak"> 
     <option>Kies een plaats</option>
     <option>Den Haag</option>
     <option>Amsterdam</option>
     <option>Rotterdam</option>
     <option>Arnhem</option>
</select>

<input type="radio" name="Kaas" value="op">Prijs Oplopend<br>
<input type="radio" name="Kaas" value="af">Prijs Aflopend<br>
<input type="radio" name="Kaas" value="op">Looptijd Oplopend<br>
<input type="radio" name="Kaas" value="af">Looptijd Aflopend<br>
</div>
</div>

    <div class="rubriekenContainer">
    <article class="RubriekenProducten" >
        <h3>Een Mooie Kaaskast</h3>
        <div class ="rechts">
       <input type='submit'value='Bieden!' onclick="window.location.href = 'product.php';" class='button'>
       <p> Hele mooie kaaskast maar past helaas </p> 
       <p> niet meer bij mij in de schuur want </p> 
       <p> hij is zo groot als mijn auto </p>
       <p> dus dat is wel jammer maarja je moet toch wat he. </p> 
       </div>
        <div class ="center">
        <img src="Images/Kaaskast.jpg" alt="Italian Trulli">
        <p>Username 4868</p>
        <p>Locatie: Arnhem</p>
        <p>Huidige hoogste bod:</p>
        <h4>189,99</h4>
        <p> Veiling sluit over: </p>
        <h4> 6d 11u 12m </h4>
        </div>
    </div>
    </article>

    <div class="rubriekenContainer">
    <article class="RubriekenProducten">
    <h3>Een Geweldige Rubberen Eend</h3>
    <div class ="rechts">
       <input type='submit'value='Bieden!' onclick="window.location.href = 'product.php';" class='button'>
       <p> Hele mooie Eend maar past helaas </p> 
       <p> niet meer bij mij in de schuur want </p> 
       <p> hij is zo groot als mijn auto </p>
       <p> dus dat is wel jammer maarja je moet toch wat he. </p> 
       </div>
        <div class ="center">
        <a href="#"><img src="images/Eend.jpg"  alt="filmje1"/></a>
        <p>Username 4868</p>
        <p>Locatie: Arnhem</p>
        <p>Huidige hoogste bod:</p>
        <h4>189,99</h4>
        <p> Veiling sluit over: </p>
        <h4> 6d 11u 12m </h4>
       </div>
       </div>
    </article>

    <div class="rubriekenContainer">
    <article class="RubriekenProducten">
    <h3>Een     Salade wel over datum</h3>
    <div class ="rechts">
       <input type='submit'value='Bieden!' onclick="window.location.href = 'product.php';" class='button'>
       <p> Hele fijne salade wel over datum helaas </p> 
       <p> maar dat mag de pret niet bederven </p> 
       <p> hij is zo groot als mijn auto </p>
       <p> dus genoeg te eten voor een heel weeshuis </p> 
       </div>
        <div class ="center">
        <a href="#"><img src="images/Salade.jpg"  alt="filmje1"/></a>
        <p>Username 4868</p>
        <p>Locatie: Arnhem</p>
        <p>Huidige hoogste bod:</p>
        <h4>189,99</h4>
        <p> Veiling sluit over: </p>
        <h4> 6d 11u 12m </h4>
       </div>
    </article>

    </div>
<?php
include_once 'aanroepingen/footer.html';
?>




