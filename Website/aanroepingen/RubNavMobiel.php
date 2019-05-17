
<div class="MobielZoekProduct">
<button class="collapsible">Zoeken</button>
<div class="content">
  <Br>
  <form action="" method="">
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



<nav class="MobileNav">
<ul class="multilevel-accordion-menu vertical menu" data-accordion-menu>
  <li>
    <a href="#">Item 1</a>
    <ul class="menu vertical sublevel-1">
      <li>
        <a href="#">Sub-item 1</a>
        <ul class="menu vertical sublevel-2">
          <li><a class="subitem" href="#">Thing 1</a></li>
          <li><a class="subitem" href="#">Thing 2</a></li>
          <li><a class="subitem" href="#">Thing 3</a></li>
        </ul>
      </li>
      <li>
        <a href="#">Sub-item 2</a>
        <ul class="menu vertical sublevel-2">
          <li>
            <a href="#">Super-sub-item 1</a>
            <ul class="menu vertical sublevel-3">
              <li><a class="subitem" href="#">Thing 1</a></li>
              <li><a class="subitem" href="#">Thing 2</a></li>
            </ul>
          </li>
          <li><a class="subitem" href="#">Thing 2</a></li>
        </ul>
      </li>
      <li><a class="subitem" href="#">Thing 1</a></li>
      <li><a class="subitem" href="#">Thing 2</a></li>
    </ul>
  </li>
  <li>
    <a href="#">Item 1</a>
    <ul class="menu vertical sublevel-1">
      <li>
        <a href="#">Sub-item 1</a>
        <ul class="menu vertical sublevel-2">
          <li><a class="subitem" href="#">Thing 1</a></li>
          <li><a class="subitem" href="#">Thing 2</a></li>
          <li><a class="subitem" href="#">Thing 3</a></li>
        </ul>
      </li>
      <li>
        <a href="#">Sub-item 2</a>
        <ul class="menu vertical sublevel-2">
          <li>
            <a href="#">Super-sub-item 1</a>
            <ul class="menu vertical sublevel-3">
              <li><a class="subitem" href="#">Thing 1</a></li>
              <li><a class="subitem" href="#">Thing 2</a></li>
            </ul>
          </li>
          <li><a class="subitem" href="#">Thing 2</a></li>
        </ul>
      </li>
      <li><a class="subitem" href="#">Thing 1</a></li>
      <li><a class="subitem" href="#">Thing 2</a></li>
    </ul>
  </li>
  <li>
    <a href="#">Item 3</a>
    <ul class="menu vertical sublevel-1">
      <li><a class="subitem" href="#">Thing 1</a></li>
      <li><a class="subitem" href="#">Thing 2</a></li>
    </ul>
  </li>
  <li>
    <a href="#">Item 4</a>
    <ul class="menu vertical sublevel-1">
      <li>
        <a href="#">Sub-item 3</a>
        <ul class="menu vertical sublevel-2">
          <li><a class="subitem" href="#">Thing 1</a></li>
          <li><a class="subitem" href="#">Thing 2</a></li>
        </ul>
      </li>
      <li><a class="subitem" href="#">Thing 1</a></li>
      <li><a class="subitem" href="#">Thing 2</a></li>
    </ul>
  </li>
</ul>
</nav>

