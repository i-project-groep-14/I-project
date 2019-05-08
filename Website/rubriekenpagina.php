<?php
  require_once 'aanroepingen/connectie.php';
  include_once 'aanroepingen/header.php';
?>

<aside class="NavRubriekAside">
<?php include_once 'aanroepingen/RubNav.php'; ?>
</aside>
<br>
<h5>SubSubSubRubriek </h5> 
       
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
    <article class="RubriekenProducten" >
        <h3>Een Mooie Kaaskast</h3>
        <p>Username 4868</p>
        <p>Locatie: Arnhem</p>
        <p>Huidige hoogste bod:</p>
        <h4>189,99</h4>
        <p> Veiling sluit over: </p>
        <h4> 6d 11u 12m </h4>
    </div>
    </article>

    <div class="rubriekenContainer">
    <article class="RubriekenProducten" >
    <h3>Enorme Gietijzeren Eend</h3>
        <p>Username 4868</p>
        <p>Locatie: Arnhem</p>
        <p>Huidige hoogste bod:</p>
        <h4>721,99 </h4>
        <p> Veiling sluit over: </p>
        <h4> 6d 11u 12m </h4>
        <p class="rechts"> Eenden worden soms verward met verscheidene soorten niet verwante vogels met gelijkaardige vormen, zoals duikers, futen, rallen, koeten en waterhoentjes. Soms wordt met "eend" alleen vrouwtjeseenden bedoeld. Een mannetjeseend heet een "woerd". Een jonge eend wordt pijltje (soms piel) genoemd. In het algemeen worden jongen van kippen en eenden ook wel "pulletje" of "pulleke" genoemd. Een woerd van de wilde eend, de meest voorkomende soort, is naast de kleur ook te herkennen aan enkele gekrulde veren op de staart (dit is niet altijd zichtbaar). </p>
        <img src="images/Eend.jpg" alt="Eend">
    </article>
    </div>

    <div class="rubriekenContainer">
    <article class="RubriekenProducten" >
    <h3>Enorme Rubberen Eend</h3>
        <p>Username 4868</p>
        <p>Locatie: Arnhem</p>
        <p>Huidige hoogste bod:</p>
        <h4>134,99 </h4>
        <p> Veiling sluit over: </p>
        <h4> 6d 11u 12m </h4>
    </article>
    </div>
    </div>





























<?php
include_once 'aanroepingen/footer.html';
?>




