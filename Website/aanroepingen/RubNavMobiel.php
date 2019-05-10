<nav class="MobileNav" role="navigation">
  <div id="myNav" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="overlay-content">
      <a href="#">Antiek en Kunst</a>
      <a href="#">Audio, Tv en Foto</a>
      <a href="#">Auto's</a>
      <a href="#">Auto diversen</a>
      <a href="#">Muziek en Instrumenten</a>
      <a href="#">Diversen</a>
      <a href="#">Watersport en Boten</a>
      <a href="#">Diversen</a>
      <a href="#">Sport en Fitness</a>
    </div>
  </div>
  
  <span style="font-size:40px;cursor:pointer" onclick="openNav()">&nbsp; &#9776;</span>     
  <script>
    function openNav() {
      document.getElementById("myNav").style.width = "100%";
    }
    
    function closeNav() {
      document.getElementById("myNav").style.width = "0%";
    }
  </script>
</nav>