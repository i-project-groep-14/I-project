<?php
  $config = ['pagina' => 'product'];

 require_once 'aanroepingen/connectie.php';
 include_once 'aanroepingen/header.php'; 
?>
  
<?php  include_once 'aanroepingen/header.php'?>
    
<div class="holy-grail-middle">
<div class="ProductInformatie">
  <div class="row columns">
    <nav aria-label="You are here:">
      <ul class="breadcrumbs">
        <li><a href="#">Home</a></li>
        <li><a href="#">Features</a></li>
        <li class="disabled">Gene Splicing</li>
        <li>
        <span class="show-for-sr">Current: </span> Cloning
        </li>
      </ul>
    </nav>
</div>

    <div class="row">
      <div class="medium-6 columns">
        
        <img class="thumbnail img-product" src="images/fiets.jpg" alt="fiets">
          <div class="row small-up-4">
            <div class="column">
              <img class="thumbnail" src="images/fiets.jpg" alt="fiets">
            </div>
          <div class="column">
            <img class="thumbnail" src="images/fiets.jpg" alt="fiets">
          </div>
            <div class="column">
              <img class="thumbnail" src="images/fiets.jpg" alt="fiets">
            </div>
              <div class="column">
                <img class="thumbnail" src="images/fiets.jpg" alt="fiets">
              </div>
            </div>
        </div>

 <!--Toevoegen informatie aan de rechterkant-->
    <div class="medium-6 large-5 columns lijn">
      <h3>My Awesome Product</h3>
      <p><i>Verkoper</i></p>
      <p>Nunc eu ullamcorper orci. Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque faucibus vestibulum. Nulla at nulla justo, eget luctus tortor. Nulla facilisi. Duis aliquet egestas purus in.</p>
  
      <div class="row">
        <div class="small-3 columns">
          <p class="middle">Plaats:</p>
        </div>
        <div class="small-9 columns">
          <p>Arnhem, Nederland</p>
        </div>

        <div class="small-3 columns">
          <p class="middle">Startprijs:</p>
        </div>
        <div class="small-9 columns">
          <p>5,00 Euro</p>
        </div>

        <div class="small-3 columns">
          <p class="middle">Huidige Prijs:</p>
        </div>
        <div class="small-9 columns">
          <p><b>11,00 Euro</b></p>
        </div>

      </div>
        <a href="#" class="button large expanded">Bieden</a>
        <p>Looptijd:</p>
        <div class="klok">
          <p>2d 12h 40m 33s </p>
        </div>
          <p class="middle">Betaling: IDEAL/Contant</p>
          <p class="middle">Verzending: Via PostNL/Zelf ophalen</p>
      </div>
    </div>

<!--De bieding tab onderin-->
    <div class="column row">
      <hr>
      <ul class="tabs" data-tabs id="example-tabs">
        <li class="tabs-title is-active"><a href="#panel1" >Biedingen</a></li>
      </ul>

      <div class="tabs-content" data-tabs-content="example-tabs">
        <div class="tabs-panel is-active" id="panel1">
        <h4>Biedingen</h4>
        <div class="media-object stack-for-small">
        <div class="media-object-section">
        <img class="thumbnail" src="images/profielfotoPlaceholder.png" alt="profiel">
      </div>

      <div class="media-object-section">
        <h5>Mike Stevenson</h5>
        <p>Geboden: 1.00 Euro</p>
        <p><i>Datum van bod: dd/mm/jj, hh:mm:ss</i></p>
      </div>
    </div>

    <div class="media-object stack-for-small">
      <div class="media-object-section">
        <img class="thumbnail" src="images/profielfotoPlaceholder.png" alt="profiel">
      </div>

      <div class="media-object-section">
        <h5>Mike Stevenson</h5>
        <p>Geboden: 2.00 Euro</p>
        <p><i>Datum van bod: dd/mm/jj, hh:mm:ss</i></p>
      </div>
    </div>

    <div class="media-object stack-for-small">
      <div class="media-object-section">
        <img class="thumbnail" src="images/profielfotoPlaceholder.png" alt="profiel">
      </div>
      
      <div class="media-object-section">
        <h5>Mike Stevenson</h5>
        <p>Geboden: 3.00 Euro</p>
        <p><i>Datum van bod: dd/mm/jj, hh:mm:ss</i></p>
      </div>
    </div>
    <button class="button">Bied mee!</button>
</div>
</div>
</div>
</div>
</div>
<?php include_once 'aanroepingen/footer.html' ?>
 
