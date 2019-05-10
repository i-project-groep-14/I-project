<?php
  $config = ['pagina' => 'index'];

  require_once 'aanroepingen/connectie.php';
  include_once 'aanroepingen/header.php';
  include_once 'aanroepingen/timerfunctie.php';
?>


<div class="hero-full-screen top-bar">
<?php
  include_once 'aanroepingen/Zoekfunctie.php';
?>
</div>

<?php
  if(isset($_SESSION['login'])) {
    echo "
    <h1 class='HomepaginaKopjes'> Uw biedingen</h1>
    <div class='Product-grid-container'>
        <div class='Product-grid'>
            <div class='Product-grid-item first-item'>
                <h3>Viking fiets</h3>
                <a href='#' ><img src='images/fiets.JPG'  alt='filmje1'/></a>
                <p>tijd: <?php getdate(); ?></p>
                <p>Huidige prijs:</p>
                <h4>€24,99</h4>
                <p>Locatie: Arnhem</p>
                
                <a href='product.php'><input type='submit'value='Bekijk meer!' class='button'></a>
            </div>
            <div class='Product-grid-item first-item'>
                <h3>Viking fiets</h3>
                <a href='#' ><img src='images/fiets.JPG'  alt='filmje1'/></a>
                <p>tijd: <?php getdate(); ?></p>
                <p>Huidige prijs:</p>
                <h4>€24,99</h4>
                <p>Locatie: Arnhem</p>
                
                <a href='product.php'><input type='submit'value='Bekijk meer!' class='button'></a>
            </div>
            <div class='Product-grid-item first-item'>
                <h3>Viking fiets</h3>
                <a href='#' ><img src='images/fiets.JPG'  alt='filmje1'/></a>
                <p>tijd: <?php getdate(); ?></p>
                <p>Huidige prijs:</p>
                <h4>€24,99</h4>
                <p>Locatie: Arnhem</p>
                
                <a href='product.php'><input type='submit'value='Bekijk meer!' class='button'></a>
            </div>
            <div class='Product-grid-item first-item'>
                <h3>Viking fiets</h3>
                <a href='#' ><img src='images/fiets.JPG'  alt='filmje1'/></a>
                <p>tijd: <?php getdate(); ?></p>
                <p>Huidige prijs:</p>
                <h4>€24,99</h4>
                <p>Locatie: Arnhem</p>
                
                <a href='product.php'><input type='submit'value='Bekijk meer!' class='button'></a>
            </div>
        </div>  
    </div>
    ";
  }
?>

<h1 class="HomepaginaKopjes">Aangeraden producten </h1>

<div class='Product-grid-container Product-Flex-End'>
    <div class='Product-grid'>
        <div class='Product-grid-item first-item'>
            <h3>Viking fiets</h3>
            <a href="#" ><img src="images/fiets.JPG"  alt="filmje1"/></a>
            <p>tijd: <?php echo  date("d/m/Y"); ?></p>
            <p>Huidige prijs:</p>
            <h4>€24,99</h4>
            <p>Locatie: Arnhem</p>
            <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
        </div>
        <div class='Product-grid-item first-item'>
            <h3>Viking fiets</h3>
            <a href="#" ><img src="images/fiets.JPG"  alt="filmje1"/></a>
            <p>tijd: <?php getdate(); ?></p>
            <p>Huidige prijs:</p>
            <h4>€24,99</h4>
            <p>Locatie: Arnhem</p>
            
            <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
        </div>
        <div class='Product-grid-item first-item'>
            <h3>Viking fiets</h3>
            <a href="#" ><img src="images/fiets.JPG"  alt="filmje1"/></a>
            <p>tijd: <?php getdate(); ?></p>
            <p>Huidige prijs:</p>
            <h4>€24,99</h4>
            <p>Locatie: Arnhem</p>
            
            <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
        </div>
        <div class='Product-grid-item first-item'>
            <h3>Viking fiets</h3>
            <a href="#" ><img src="images/fiets.JPG"  alt="filmje1"/></a>
            <p>tijd: <?php getdate(); ?></p>
            <p>Huidige prijs:</p>
            <h4>€24,99</h4>
            <p>Locatie: Arnhem</p>
            
            <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
        </div>
    </div>  
</div>

<h1 class="HomepaginaKopjes"> Recent bekeken</h1>

<div class='Product-grid-container'>
    <div class='Product-grid'>
        <div class='Product-grid-item first-item'>
            <h3>Viking fiets</h3>
            <a href="#" ><img src="images/fiets.JPG"  alt="filmje1"/></a>
            <p>tijd: <?php getdate(); ?></p>
            <p>Huidige prijs:</p>
            <h4>€24,99</h4>
            <p>Locatie: Arnhem</p>
            
            <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
        </div>
        <div class='Product-grid-item first-item'>
            <h3>Viking fiets</h3>
            <a href="#" ><img src="images/fiets.JPG"  alt="filmje1"/></a>
            <p>tijd: <?php getdate(); ?></p>
            <p>Huidige prijs:</p>
            <h4>€24,99</h4>
            <p>Locatie: Arnhem</p>
            
            <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
        </div>
        <div class='Product-grid-item '>
            <h3>Viking fiets</h3>
            <a href="#" ><img src="images/fiets.JPG"  alt="filmje1"/></a>
            <p>tijd: <?php getdate(); ?></p>
            <p>Huidige prijs:</p>
            <h4>€24,99</h4>
            <p>Locatie: Arnhem</p>
            
            <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
        </div>
        <div class='Product-grid-item first-item'>
            <h3>Viking fiets</h3>
            <a href="#" ><img src="images/fiets.JPG"  alt="filmje1"/></a>
            <p>tijd: <?php getdate(); ?></p>
            <p>Huidige prijs:</p>
            <h4>€24,99</h4>
            <p>Locatie: Arnhem</p>
            
            <input type='submit'value='Bekijk meer!' onclick="window.location.href = 'product.php';" class='button'>
        </div>
    </div>  
</div>

<?php
  include_once 'aanroepingen/footer.html';
?>