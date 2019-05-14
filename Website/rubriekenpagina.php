    <?php
      $config = ['pagina' => 'rubriekenpagina'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';
    ?>

    <div class="holy-grail-middle">
      <div class="row columns"> 
        <nav aria-label="You are here:">
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
      <div class="rubriekenTop">
        <div class ="tabelvorm-links">
          <h3> Filters </h3>
          <input type="radio" name="Kaas" value="op">Prijs Oplopend<br>
          <input type="radio" name="Kaas" value="af">Prijs Aflopend<br>
          <input type="radio" name="Kaas" value="op">Looptijd Oplopend<br>
          <input type="radio" name="Kaas" value="af">Looptijd Aflopend<br>
        </div>
        <div class="tabelvorm-midden">
          <h3>Locatie</h3>
          <select class = "meerkeuzevak"> 
            <option>Kies een plaats</option>
            <option>Den Haag</option>
            <option>Amsterdam</option>
            <option>Rotterdam</option>
            <option>Arnhem</option>
          </select>
        </div>
        <div class="tabelvorm-rechts">
          <h3>Prijs</h3>
          <div class="prijsbreedte">
            <p> Van: </p> <input type="text"> 
            <p> Tot: </p> <input type="text">
          </div>
        </div>
      </div>

      <br>
      <div class="rubriekenContainer">
        <article class="RubriekenProducten" >
          <h3>Een Mooie Kaaskast</h3>
          <div class ="center">
            <img src="Images/Kaaskast.jpg" alt="Kaaskast">
            <p>Locatie: Arnhem</p>
            <p>Huidige hoogste bod:</p>
            <h4>189,99</h4>
            <p>Veiling sluit over:</p>
            <h4>6d 11u 12m</h4>
            <div class ="rechts">
              <input type='submit' value='Bieden!' onclick="window.location.href = 'product.php';" class='button'>
            </div>
          </div>
        </article>
      </div>
      <br>
      <div class="rubriekenContainer">
        <article class="RubriekenProducten">
          <h3>Een Geweldige Rubberen Eend</h3>
          <div class ="center">
            <img src="images/Eend.jpg"  alt="Eend"/>
            <p>Locatie: Arnhem</p>
            <p>Huidige hoogste bod:</p>
            <h4>189,99</h4>
            <p>Veiling sluit over:</p>
            <h4>6d 11u 12m</h4>
            <div class ="rechts">
              <input type='submit' value='Bieden!' onclick="window.location.href = 'product.php';" class='button'>
            </div>
          </div>
        </article>
      </div>
      <br>
      <div class="rubriekenContainer">
        <article class="RubriekenProducten">
          <h3>Een Salade wel over datum</h3>
          <div class ="center">
            <img src="images/Salade.jpg" alt="filmje1"/>
            <p>Locatie: Arnhem</p>
            <p>Huidige hoogste bod:</p>
            <h4>189,99</h4>
            <p>Veiling sluit over:</p>
            <h4>6d 11u 12m</h4>
            <div class ="rechts">
              <input type='submit' value='Bieden!' onclick="window.location.href = 'product.php';" class='button'>
            </div>
          </div>
        </article>
      </div>
    </div>

    <?php 
      include_once 'aanroepingen/footer.html';
    ?>