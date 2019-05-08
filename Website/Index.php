<?php
  require_once 'aanroepingen/connectie.php';
  include_once 'aanroepingen/header.php';
?>


<div class="hero-full-screen top-bar">

</div>


<aside  class="NavRubriekAside">
  <?php include_once 'aanroepingen/RubNav.php'; ?>
</aside>


<div class="homepaginaContainer">

    <h1 class="HomepaginaKopjes">   Uw biedingen  </h1>
    <div class="homepaginaArtikelen">
    <article class="HomepaginaProducten" >
        <h3>Viking fiets</h3>
        <a href="#" ><img src="images/fiets.JPG"  alt="filmje1"/></a>
        <p>tijd: <?php getdate(); ?></p>
        <p>Huidige prijs:</p>
        <h4>€24,99</h4>
        <p>Locatie: Arnhem</p>
        
        <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
    </article>

    <article class="HomepaginaProducten" >
        <h3>Viking fiets</h3>
        <a href="#" ><img src="images/fiets.JPG" alt="filmje1"/></a>
        <p>Huidige prijs:</p>
        <h4>€24,99</h4>
        <p>Locatie: Arnhem</p>
        <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
</article>
    <article class="HomepaginaProducten" >
        <h3>Viking fiets</h3>
        <a href="#" ><img src="images/fiets.JPG" alt="filmje1"/></a>
        <p>Huidige prijs:</p>
        <h4>€24,99</h4>
        <p>Locatie: Arnhem</p>
        <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
    </article>

    <article class="HomepaginaProducten" >
        <h3>Viking fiets</h3>
        <a href="#" ><img src="images/fiets.JPG" alt="filmje1"/></a>
        <p>Huidige prijs:</p>
        <h4>€24,99</h4>
        <p>Locatie: Arnhem</p>
        <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
    </article>
    </div>
    <h1 class="HomepaginaKopjes">Aangeraden producten </h1>
    <div class="homepaginaArtikelen">
    <article class="HomepaginaProducten" >
        <h3>Viking fiets</h3>
        <a href="#" ><img src="images/fiets.JPG" alt="filmje1"/></a>
        <p>Huidige prijs:</p>
        <h4>€24,99</h4>
        <p>Locatie: Arnhem</p>
        <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
    </article>

    <article class="HomepaginaProducten" >
        <h3>Viking fiets</h3>
        <a href="#" ><img src="images/fiets.JPG" alt="filmje1"/></a>
        <p>Huidige prijs:</p>
        <h4>€24,99</h4>
        <p>Locatie: Arnhem</p>
        <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
    </article>

    <article class="HomepaginaProducten" >
        <h3>Viking fiets</h3>
        <a href="#" ><img src="images/fiets.JPG" alt="filmje1"/></a>
        <p>Huidige prijs:</p>
        <h4>€24,99</h4>
        <p>Locatie: Arnhem</p>
        <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
    </article>

    <article class="HomepaginaProducten" >
        <h3>Viking fiets</h3>
        <a href="#" ><img src="images/fiets.JPG" alt="filmje1"/></a>
        <p>Huidige prijs:</p>
        <h4>€24,99</h4>
        <p>Locatie: Arnhem</p>
        <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
    </article>

    </div>
    <h1 class="HomepaginaKopjes"> Recent bekeken</h1>
    <div class="homepaginaArtikelen">
    <article class="HomepaginaProducten" >
        <h3>Viking fiets</h3>
        <a href="#" ><img src="images/fiets.JPG" alt="filmje1"/></a>
        <p>Huidige prijs:</p>
        <h4>€24,99</h4>
        <p>Locatie: Arnhem</p>
        <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
    </article>

    <article class="HomepaginaProducten" >
        <h3>Viking fiets</h3>
        <a href="#" ><img src="images/fiets.JPG" alt="filmje1"/></a>
        <p>Huidige prijs:</p>
        <h4>€24,99</h4>
        <p>Locatie: Arnhem</p>
        <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
    </article>

    <article class="HomepaginaProducten" >
        <h3>Viking fiets</h3>
        <a href="#" ><img src="images/fiets.JPG" alt="filmje1"/></a>
        <p>Huidige prijs:</p>
        <h4>€24,99</h4>
        <p>Locatie: Arnhem</p>
        <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
    </article>

    <article class="HomepaginaProducten" >
        <h3>Viking fiets</h3>
        <a href="#" ><img src="images/fiets.JPG" alt="filmje1"/></a>
        <p>Huidige prijs:</p>
        <h4>€24,99</h4>
        <p>Locatie: Arnhem</p>
        <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
    </article>

    </div>
</div>



<?php
  include_once 'aanroepingen/footer.html';
?>