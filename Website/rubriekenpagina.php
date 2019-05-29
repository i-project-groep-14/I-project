    <?php
      $config = ['pagina' => 'rubriekenpagina'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';
    ?>

    <div class="holy-grail-middle">
      <!-- <form> -->
      <div class="row columns"> 
        <nav aria-label="You are here:">
          <ul class="breadcrumbs">
            <?php
              $actueleRubriek = $_GET['id'];
              $actueleParentRubriek = selectParentRubriekNummer($actueleRubriek);
                  
              if (heeftParentRubriek($actueleRubriek)) {
                $nietBovenaan = true;
                createProductRubrieken($actueleRubriek);
              }
            ?>
            <!-- <li><a href="Index.php">Home</a></li>
            <li><a href="#">Antiek en Kunst</a></li>
            <li><span class="show-for-sr">Current: </span> Kasten</li> -->
          </ul>
        </nav>
      </div>
      <!-- <br> -->

<!-- BEGIN FILTER -->
      <div class="ContainerRubriekenfilter">
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
            <input type="text" id="myInput" onkeyup="zoekFunctie()" placeholder="Zoeken op rubriek...">
            <input type='submit' class='button' value="Zoeken">
          </div>
        </div>
<!--  EINDE FILTER  -->


        <!-- </form> -->
      </div>

      <?php    
        $aantalVoorwerpen = selectAantalVoorwerpen($_GET['id']);

        $plek = 0;

        for($i = 0; $i < $aantalVoorwerpen; $i++) {
          $plek = createVoorwerpInRubriekItem($plek, $_GET['id']);
        }
      ?>
    </div>

    <?php 
      include_once 'aanroepingen/footer.html';
    ?>