    <?php
      $config = ['pagina' => 'index'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';
    ?>

    <div class="holy-grail-middle">
    <?php if(isset($_SESSION['login'])) {
    echo "
    <h3 class='HomePageTitel'>Uw veilingen</h3>
    <div class='ProductenContainer'>
      <div class='Product'>
        <img src='/images/fiets.jpg' alt='fiets'>
        <h3>Viking fiets</h3>
        <p>tijd:99:99:99 <span style='float:right'> Hoogste bod: $1999999999.99</span></p>
        <a href='product.php'><input type='submit'value='Bekijk meer!' class='button ProductButton'></a>
        </div>
      <div class='Product'>
        <img src='/images/fiets.jpg' alt='fiets'>
        <h3>Viking fiets</h3>
        <p>tijd:99:99:99 <span style='float:right'> Hoogste bod: $1999999999.99</span></p>
        <a href='product.php'><input type='submit'value='Bekijk meer!' class='button ProductButton'></a>
      </div>
      <div class='Product'>
        <img src='/images/fiets.jpg' alt='fiets'>
        <h3>Viking fiets</h3>
        <p>tijd:99:99:99 <span style='float:right'> Hoogste bod: $1999999999.99</span></p>
        <a href='product.php'><input type='submit'value='Bekijk meer!' class='button ProductButton'></a>
      </div>
      <div class='Product'>
        <img src='/images/fiets.jpg' alt='fiets'>
        <h3>Viking fiets</h3>
        <p>tijd:99:99:99 <span style='float:right'> Hoogste bod: $1999999999.99</span></p>
        <a href='product.php'><input type='submit'value='Bekijk meer!' class='button ProductButton'></a>
      </div>
    </div>";
  }
    echo "
      <h3 class='HomePageTitel'>De populairste veilingen</h3>
      <div class='ProductenContainer'>
        <div class='Product'>
          <img src='/images/fiets.jpg' alt='fiets'>
          <h3>Viking fiets</h3>
          <p>tijd:99:99:99 <span style='float:right'> Hoogste bod: $1999999999.99</span></p>
          <a href='product.php'><input type='submit'value='Bekijk meer!' class='button ProductButton'></a>
        </div>
        <div class='Product'>
          <img src='/images/fiets.jpg' alt='fiets'>
          <h3>Viking fiets</h3>
          <p>tijd:99:99:99 <span style='float:right'> Hoogste bod: $1999999999.99</span></p>
          <a href='product.php'><input type='submit'value='Bekijk meer!' class='button ProductButton'></a>
        </div>
        <div class='Product'>
          <img src='/images/fiets.jpg' alt='fiets'>
          <h3>Viking fiets</h3>
          <p>tijd:99:99:99 <span style='float:right'> Hoogste bod: $1999999999.99</span></p>
          <a href='product.php'><input type='submit'value='Bekijk meer!' class='button ProductButton'></a>
        </div>
        <div class='Product'>
          <img src='/images/fiets.jpg' alt='fiets'>
          <h3>Viking fiets</h3>
          <p>tijd:99:99:99 <span style='float:right'> Hoogste bod: $1999999999.99</span></p>
          <a href='product.php'><input type='submit'value='Bekijk meer!' class='button ProductButton'></a>
        </div>
      </div>

      <h3 class='HomePageTitel'>Loopt bijna af!</h3>
      
      <div class='ProductenContainer'>
        <div class='Product'>
          <img src='/images/fiets.jpg' alt='fiets'>
          <h3>Viking fiets</h3>
          <p>tijd:99:99:99 <span style='float:right'> Hoogste bod: $1999999999.99</span></p>
          <a href='product.php'><input type='submit'value='Bekijk meer!' class='button ProductButton'></a>
        </div>
        <div class='Product'>
          <img src='/images/fiets.jpg' alt='fiets'>
          <h3>Viking fiets</h3>
          <p>tijd:99:99:99 <span style='float:right'> Hoogste bod: $1999999999.99</span></p>
          <a href='product.php'><input type='submit'value='Bekijk meer!' class='button ProductButton'></a>
        </div>
        <div class='Product'>
          <img src='/images/fiets.jpg' alt='fiets'>
          <h3>Viking fiets</h3>
          <p>tijd:99:99:99 <span style='float:right'> Hoogste bod: $1999999999.99</span></p>
          <a href='product.php'><input type='submit'value='Bekijk meer!' class='button ProductButton'></a>
        </div>
        <div class='Product'>
          <img src='/images/fiets.jpg' alt='fiets'>
          <h3>Viking fiets</h3>
          <p>tijd:99:99:99 <span style='float:right'> Hoogste bod: $1999999999.99</span></p>
          <a href='product.php'><input type='submit'value='Bekijk meer!' class='button ProductButton'></a>
        </div>
      </div>

      <h3 class='HomePageTitel'>Nieuwe veilingen</h3>
      
      <div class='ProductenContainer'>
        <div class='Product'>
          <img src='/images/fiets.jpg' alt='fiets'>
          <h3>Viking fiets</h3>
          <p>tijd:99:99:99 <span style='float:right'> $1999999999.99</span></p>
          <a href='product.php'><input type='submit'value='Bekijk meer!' class='button ProductButton'></a>
        </div>  
        <div class='Product'>
          <img src='/images/fiets.jpg' alt='fiets'>
          <h3>Viking fiets</h3>
          <p>tijd:99:99:99 <span style='float:right'> Hoogste bod: $1999999999.99</span></p>
          <a href='product.php'><input type='submit'value='Bekijk meer!' class='button ProductButton'></a>
        </div>  
        <div class='Product'>
          <img src='/images/fiets.jpg' alt='fiets'>
          <h3>Viking fiets</h3>
          <p>tijd:99:99:99 <span style='float:right'> Hoogste bod: $1999999999.99</span></p>
          <a href='product.php'><input type='submit'value='Bekijk meer!' class='button ProductButton'></a>
        </div> 
        <div class='Product'>
          <img src='/images/fiets.jpg' alt='fiets'>
          <h3>Viking fiets</h3>
          <p>tijd:99:99:99 <span style='float:right'> Hoogste bod: $1999999999.99</span></p>
          <a href='product.php'><input type='submit'value='Bekijk meer!' class='button ProductButton'></a>
        </div>
      </div>";
  

  
?>
</div>
    <?php 
      include_once 'aanroepingen/footer.html';
    ?>