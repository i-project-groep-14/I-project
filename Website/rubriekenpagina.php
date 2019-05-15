    <?php
      $config = ['pagina' => 'rubriekenpagina'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';
    ?>

    <div class="holy-grail-middle">
      <h1>DEZE PAGINA IS IN BEWERKING</h1>
      <div class="ContainerRubrieken">
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
        <button class="button fa fi-filter fa-lg" type="button" style="font-size:24px;" data-toggle="example-dropdown-bottom-left"></button>
        <div class="dropdown-pane large " data-position="bottom" data-alignment="left" id="example-dropdown-bottom-left" data-dropdown data-auto-focus="true">
          <!-- My dropdown content in here -->
          <div class="FilterContainer">
            <div class="FilterPrijs">
              <h3>Prijs:</h3>
              <label>Vanaf:</label>
              <input type="text" class="FilterPrijsLaag">
              <label>Tot:</label>
              <input type="text" class="FilterPrijsLaag">
            </div>
            <div class="FilterLocatie">
              <h3>Locatie</h3>
              <br>
              <select class="Filtermeerkeuzevak"> 
                <option>Kies een plaats</option>
                <option>Den Haag</option>
                <option>Amsterdam</option>
                <option>Rotterdam</option>
                <option>Arnhem</option>
              </select>
            </div>
                
            <div class="FilterSorteer">
              <h3>Sorteer op:</h3>
              <br>
              <select class="Filtermeerkeuzevak"> 
                <option>Standaard</option>
                <option>Datum (nieuw-oud)</option>
                <option>Datum (oud-nieuw)</option>
                <option>Sluittijd (kort-lang)</option>
                <option>Sluittijd (lang-kort)</option>
              </select>
            </div>
            <div class="FilterSorteer">
              <h3>Zoeken </h3>
              <br>
              <input type="text" class="Zoeken">
              <input type='submit' class='button' value="Zoeken">
            </div>
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