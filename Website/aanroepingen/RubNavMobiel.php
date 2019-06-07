
<div class="MobielZoekProduct">
  <button class="collapsible">Zoeken</button>
  <div class="content">
    <Br>
    <form action="<?php echo $config['pagina'].".php"; ?>" method="">
      <input type="search" placeholder="Zoek Product..."><br>
      <select>
        <option>Rubrieken</option>
        <option>Auto's kaas en kaaskasten</option>
        <option>Rubrieken</option>
        <option>Rubrieken</option>
      </select>
      <input class="button" type="submit" value="Zoeken">
    </form>
  </div>
</div>



<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
