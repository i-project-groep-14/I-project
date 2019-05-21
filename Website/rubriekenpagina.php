    <?php
      $config = ['pagina' => 'rubriekenpagina'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';
    ?>

    <div class="holy-grail-middle">
<!--  BEGIN FILTER  -->
      <form>
      <div class="ContainerRubriekenfilter">
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
            <div class="FilterZoek">
              <h3>Zoeken </h3>
              <br>
              <input type="text" class="Zoeken" placeholder="Zoek product...">
              <input type='submit' class='button' value="Zoeken">
            </div>
          </div>
          </form>
        </div>
<!--  EINDE FILTER  -->



<article class="RubProduct">
  <img class="FotoRubProduct" src="Images/Eend.jpg"  alt="Eend"> 
    <div class="InfoRubProduct">
      <div class="TitelRubProduct">
        <h4><a href='product.php'>Een Geweldige Rubberen Eend<br></a></h4>
      </div>
    <div class="OmschRubProduct">
      <p> Elektrische fietsen met bafang voorwiel of middenmotor. Model rocky shimano 3 versnellingsnaaf. Van 1199,00 voor 999,00 model grace shimano 7 versnellingsnaaf.    </p>
    </div>
    </div>
      <a href='product.php'><div class="PrijsRubProduct">
      <h4>€ 800</h4>
      <p>$gebruikersnaam</p>
      <p>09:09:09</p>
      <p> Arnhem</p>
      </div></a>
</article>

<article class="RubProduct">
  <img class="FotoRubProduct" src="Images/Eend.jpg"  alt="Eend"> 
    <div class="InfoRubProduct">
      <div class="TitelRubProduct">
        <h4><a href='product.php'>Een Geweldige Rubberen Eend<br></a></h4>
      </div>
    <div class="OmschRubProduct">
      <p> Elektrische fietsen met bafang voorwiel of middenmotor. Model rocky shimano 3 versnellingsnaaf. Van 1199,00 voor 999,00 model grace shimano 7 versnellingsnaaf.    </p>
    </div>
    </div>
      <a href='product.php'><div class="PrijsRubProduct">
      <h4>€ 800</h4>
      <p>$gebruikersnaam</p>
      <p>09:09:09</p>
      <p> Arnhem</p>
      </div></a>
</article>

<article class="RubProduct">
  <img class="FotoRubProduct" src="Images/Eend.jpg"  alt="Eend"> 
    <div class="InfoRubProduct">
      <div class="TitelRubProduct">
        <h4><a href='product.php'>Een Geweldige Rubberen Eend<br></a></h4>
      </div>
    <div class="OmschRubProduct">
      <p> Elektrische fietsen met bafang voorwiel of middenmotor. Model rocky shimano 3 versnellingsnaaf. Van 1199,00 voor 999,00 model grace shimano 7 versnellingsnaaf.    </p>
    </div>
    </div>
      <a href='product.php'><div class="PrijsRubProduct">
      <h4>€ 800</h4>
      <p>$gebruikersnaam</p>
      <p>09:09:09</p>
      <p> Arnhem</p>
      </div></a>
  </article>

  <article class="RubProduct">
  <img class="FotoRubProduct" src="Images/Eend.jpg"  alt="Eend"> 
    <div class="InfoRubProduct">
      <div class="TitelRubProduct">
        <h4><a href='product.php'>Een Geweldige Rubberen Eend<br></a></h4>
      </div>
    <div class="OmschRubProduct">
      <p> Elektrische fietsen met bafang voorwiel of middenmotor. Model rocky shimano 3 versnellingsnaaf. Van 1199,00 voor 999,00 model grace shimano 7 versnellingsnaaf.    </p>
    </div>
    </div>
      <a href='product.php'><div class="PrijsRubProduct">
      <h4>€ 800</h4>
      <p>$gebruikersnaam</p>
      <p>09:09:09</p>
      <p> Arnhem</p>
      </div></a>
  </article>
	

    </div>




    <?php 
      include_once 'aanroepingen/footer.html';
    ?>