

<?php
  $config = ['pagina' => 'product'];

  require_once 'aanroepingen/connectie.php';
  include_once 'aanroepingen/header.php';
?>

<div class="row columns"> 
  <nav aria-label="You are here:" role="navigation">
    <ul class="breadcrumbs">
      <li><a href="#">Home</a></li>
      <li><a href="#">Antiek en Kunst</a></li>
      <li><a href="#">Kasten</a></li>
      <li>    
      <span class="show-for-sr">Current: </span> Viking Fiets
      </li>
    </ul>
  </nav>
</div>


<div class="row Margin">
  <div class="medium-6 columns MarginProduct">
    <img class="thumbnail Fthumbnail" src="Images/Fiets.jpg">
<div class="row small-up-4">
  <div class="column">
    <img class="thumbnail" src="images/fiets.jpg">
</div>
  <div class="column">
    <img class="thumbnail" src="images/fiets.jpg">
</div>
  <div class="column">
    <img class="thumbnail" src="images/fiets.jpg">
</div>
  <div class="column">
    <img class="thumbnail" src="images/fiets.jpg">
    </div>
  </div>
</div>
<div class="medium-6 large-5 columns">
<h3>My Awesome Product</h3>
<section class="row">
<h4><a href="" class="grey"><i>Username</i></a></h4>
    <i class="fi-star yellow"></i>
    <i class="fi-star yellow"></i>
    <i class="fi-star yellow"></i>
    <i class="fi-star grey"></i>
    <i class="fi-star grey"></i>
</section>
<p>Nunc eu ullamcorper orci. Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque faucibus vestibulum. Nulla at nulla justo, eget luctus tortor. Nulla facilisi. Duis aliquet egestas purus in.</p>
<div class="InfoVeiling">
<div class="row">
<div class="small-3 columns">
<label for="middle-label" class="middle">Hoogste bod:</label>
</div>
<div class="small-9 columns">
<p>€ 39,99 </p>
</div>
</div>
<div class="row">
<div class="small-3 columns">
<label for="middle-label" class="middle">Start Prijs:</label>
</div>
<div class="small-9 columns">
<p>€ 24,99 </p>
</div>
</div>
<div class="row">
<div class="small-3 columns">
<label for="middle-label" class="middle">Sluit over:</label>
</div>
<div class="small-9 columns">
<p>08:54:43 </p>
</div>
</div>

<a href="#" class="button large expanded">Bied Mee</a>
<div class="small secondary expanded button-group">
<a class="button">Bericht</a>
<a class="button">Bel</a>
<a class="button">E-mail</a>
</div>
</div>
</div>
</div>

<div class="column row">
<hr>

<div class="tabs-content MarginProduct" data-tabs-content="example-tabs">
<div class="tabs-panel is-active" id="panel1">
<h4>Reviews</h4>
<div class="media-object stack-for-small">
<div class="media-object-section">
<img class="thumbnail" src="images/profielfotoPlaceholder.png">
</div>
<div class="media-object-section">
<h5>Mike Stevenson</h5>
<p>I'm going to improvise. Listen, there's something you should know about me... about inception. An idea is like a virus, resilient, highly contagious. The smallest seed of an idea can grow. It can grow to define or destroy you.</p>
</div>
</div>
<div class="media-object stack-for-small">
<div class="media-object-section">
<img class="thumbnail" src="images/profielfotoPlaceholder.png">
</div>
<div class="media-object-section">
<h5>Mike Stevenson</h5>
<p>I'm going to improvise. Listen, there's something you should know about me... about inception. An idea is like a virus, resilient, highly contagious. The smallest seed of an idea can grow. It can grow to define or destroy you</p>
</div>
</div>
<div class="media-object stack-for-small">
<div class="media-object-section">
<img class="thumbnail" src="images/profielfotoPlaceholder.png">
</div>
<div class="media-object-section">
<h5>Mike Stevenson</h5>
<p>I'm going to improvise. Listen, there's something you should know about me... about inception. An idea is like a virus, resilient, highly contagious. The smallest seed of an idea can grow. It can grow to define or destroy you</p>
</div>
</div>
<label>
My Review
<textarea placeholder="None"></textarea>
</label>
<button class="button">Submit Review</button>
</div>
<div class="tabs-panel" id="panel2">

</div>
</div>
</div>
	

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js"></script>
<script>
      $(document).foundation();
    </script>



<?php
  include_once 'aanroepingen/footer.html';
?>