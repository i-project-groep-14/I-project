<div class="RubNav row">
  <ul class="multilevel-accordion-menu vertical menu" data-accordion-menu>
    
    <?php
      $rubriekenplek = 0;
      $sql = "SELECT COUNT(*) as aantalHoofdRubrieken FROM rubriek
              WHERE rubriek = 0";
      $query = $dbh->prepare($sql);
      $query -> execute();
      $row = $query -> fetch();

      for($i = 0; $i < $row['aantalHoofdRubrieken']; $i++) {
        $subplek = 0;
        $rubriekenplek = createRubriek($rubriekenplek);
      }
    ?>

  </ul>
</div>





<!-- <div class="RubNav row">
<ul class="multilevel-accordion-menu vertical menu" data-accordion-menu>
  <li>
    <a href="rubriekenpagina.php"><i class="fi-folder-add"></i> Item 1</a>
    <ul class="menu vertical sublevel-1">
      <li>
        <a href="rubriekenpagina.php">Sub-item 1</a>
        <ul class="menu vertical sublevel-2">
          <li><a  href="rubriekenpagina.php">Thing 1</a></li>
          <li><a href="rubriekenpagina.php">Thing 2</a></li>
          <li><a  href="rubriekenpagina.php">Thing 3</a></li>
        </ul>
      </li>
      <li>
        <a href="rubriekenpagina.php">Sub-item 2</a>
        <ul class="menu vertical sublevel-2">
          <li>
            <a href="rubriekenpagina.php">Super-sub-item 1</a>
            <ul class="menu vertical sublevel-3">
              <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
              <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
            </ul>
          </li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
        </ul>
      </li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
    </ul>
  </li>
  <li>
    <a href="rubriekenpagina.php" > Item 1</a>
    <ul class="menu vertical sublevel-1">
      <li>
        <a href="rubriekenpagina.php">Sub-item 1</a>
        <ul class="menu vertical sublevel-2">
          <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 3</a></li>
        </ul>
      </li>
      <li>
        <a href="rubriekenpagina.php">Sub-item 2</a>
        <ul class="menu vertical sublevel-2">
          <li>
            <a href="rubriekenpagina.php">Super-sub-item 1</a>
            <ul class="menu vertical sublevel-3">
              <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
              <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
            </ul>
          </li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
        </ul>
      </li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
    </ul>
  </li>
  <li>
    <a href="rubriekenpagina.php">Item 1</a>
    <ul class="menu vertical sublevel-1">
      <li>
        <a href="rubriekenpagina.php">Sub-item 1</a>
        <ul class="menu vertical sublevel-2">
          <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 3</a></li>
        </ul>
      </li>
      <li>
        <a href="rubriekenpagina.php">Sub-item 2</a>
        <ul class="menu vertical sublevel-2">
          <li>
            <a href="rubriekenpagina.php">Super-sub-item 1</a>
            <ul class="menu vertical sublevel-3">
              <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
              <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
            </ul>
          </li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
        </ul>
      </li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
    </ul>
  </li>
  <li>
    <a href="rubriekenpagina.php">Item 1</a>
    <ul class="menu vertical sublevel-1">
      <li>
        <a href="rubriekenpagina.php">Sub-item 1</a>
        <ul class="menu vertical sublevel-2">
          <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 3</a></li>
        </ul>
      </li>
      <li>
        <a href="rubriekenpagina.php">Sub-item 2</a>
        <ul class="menu vertical sublevel-2">
          <li>
            <a href="rubriekenpagina.php">Super-sub-item 1</a>
            <ul class="menu vertical sublevel-3">
              <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
              <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
            </ul>
          </li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
        </ul>
      </li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
    </ul>
  </li>
  <li>
    <a href="rubriekenpagina.php">Item 1</a>
    <ul class="menu vertical sublevel-1">
      <li>
        <a href="rubriekenpagina.php">Sub-item 1</a>
        <ul class="menu vertical sublevel-2">
          <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 3</a></li>
        </ul>
      </li>
      <li>
        <a href="rubriekenpagina.php">Sub-item 2</a>
        <ul class="menu vertical sublevel-2">
          <li>
            <a href="rubriekenpagina.php">Super-sub-item 1</a>
            <ul class="menu vertical sublevel-3">
              <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
              <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
            </ul>
          </li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
        </ul>
      </li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
    </ul>
  </li>
  <li>
    <a href="rubriekenpagina.php">Item 1</a>
    <ul class="menu vertical sublevel-1">
      <li>
        <a href="rubriekenpagina.php">Sub-item 1</a>
        <ul class="menu vertical sublevel-2">
          <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 3</a></li>
        </ul>
      </li>
      <li>
        <a href="rubriekenpagina.php">Sub-item 2</a>
        <ul class="menu vertical sublevel-2">
          <li>
            <a href="rubriekenpagina.php">Super-sub-item 1</a>
            <ul class="menu vertical sublevel-3">
              <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
              <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
            </ul>
          </li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
        </ul>
      </li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
    </ul>
  </li>
  <li>
    <a href="rubriekenpagina.php">Item 1</a>
    <ul class="menu vertical sublevel-1">
      <li>
        <a href="rubriekenpagina.php">Sub-item 1</a>
        <ul class="menu vertical sublevel-2">
          <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 3</a></li>
        </ul>
      </li>
      <li>
        <a href="rubriekenpagina.php">Sub-item 2</a>
        <ul class="menu vertical sublevel-2">
          <li>
            <a href="rubriekenpagina.php">Super-sub-item 1</a>
            <ul class="menu vertical sublevel-3">
              <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
              <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
            </ul>
          </li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
        </ul>
      </li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
    </ul>
  </li>
  <li>
    <a href="rubriekenpagina.php">Item 1</a>
    <ul class="menu vertical sublevel-1">
      <li>
        <a href="rubriekenpagina.php">Sub-item 1</a>
        <ul class="menu vertical sublevel-2">
          <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 3</a></li>
        </ul>
      </li>
      <li>
        <a href="rubriekenpagina.php">Sub-item 2</a>
        <ul class="menu vertical sublevel-2">
          <li>
            <a href="rubriekenpagina.php">Super-sub-item 1</a>
            <ul class="menu vertical sublevel-3">
              <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
              <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
            </ul>
          </li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
        </ul>
      </li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
    </ul>
  </li>
  <li>
    <a href="rubriekenpagina.php">Item 1</a>
    <ul class="menu vertical sublevel-1">
      <li>
        <a href="rubriekenpagina.php">Sub-item 1</a>
        <ul class="menu vertical sublevel-2">
          <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 3</a></li>
        </ul>
      </li>
      <li>
        <a href="rubriekenpagina.php">Sub-item 2</a>
        <ul class="menu vertical sublevel-2">
          <li>
            <a href="rubriekenpagina.php">Super-sub-item 1</a>
            <ul class="menu vertical sublevel-3">
              <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
              <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
            </ul>
          </li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
        </ul>
      </li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
    </ul>
  </li>
  <li>
    <a href="rubriekenpagina.php">Item 1</a>
    <ul class="menu vertical sublevel-1">
      <li>
        <a href="rubriekenpagina.php">Sub-item 1</a>
        <ul class="menu vertical sublevel-2">
          <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 3</a></li>
        </ul>
      </li>
      <li>
        <a href="rubriekenpagina.php">Sub-item 2</a>
        <ul class="menu vertical sublevel-2">
          <li>
            <a href="rubriekenpagina.php">Super-sub-item 1</a>
            <ul class="menu vertical sublevel-3">
              <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
              <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
            </ul>
          </li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
        </ul>
      </li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
    </ul>
  </li>
  <li>
    <a href="rubriekenpagina.php">Item 1</a>
    <ul class="menu vertical sublevel-1">
      <li>
        <a href="rubriekenpagina.php">Sub-item 1</a>
        <ul class="menu vertical sublevel-2">
          <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 3</a></li>
        </ul>
      </li>
      <li>
        <a href="rubriekenpagina.php">Sub-item 2</a>
        <ul class="menu vertical sublevel-2">
          <li>
            <a href="rubriekenpagina.php">Super-sub-item 1</a>
            <ul class="menu vertical sublevel-3">
              <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
              <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
            </ul>
          </li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
        </ul>
      </li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
    </ul>
  </li>
  <li>
    <a href="rubriekenpagina.php">Item 1</a>
    <ul class="menu vertical sublevel-1">
      <li>
        <a href="rubriekenpagina.php">Sub-item 1</a>
        <ul class="menu vertical sublevel-2">
          <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 3</a></li>
        </ul>
      </li>
      <li>
        <a href="rubriekenpagina.php">Sub-item 2</a>
        <ul class="menu vertical sublevel-2">
          <li>
            <a href="rubriekenpagina.php">Super-sub-item 1</a>
            <ul class="menu vertical sublevel-3">
              <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
              <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
            </ul>
          </li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
        </ul>
      </li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
    </ul>
  </li>
  <li>
    <a href="rubriekenpagina.php">Item 1</a>
    <ul class="menu vertical sublevel-1">
      <li>
        <a href="rubriekenpagina.php">Sub-item 1</a>
        <ul class="menu vertical sublevel-2">
          <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 3</a></li>
        </ul>
      </li>
      <li>
        <a href="rubriekenpagina.php">Sub-item 2</a>
        <ul class="menu vertical sublevel-2">
          <li>
            <a href="rubriekenpagina.php">Super-sub-item 1</a>
            <ul class="menu vertical sublevel-3">
              <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
              <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
            </ul>
          </li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
        </ul>
      </li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
    </ul>
  </li>
  <li>
    <a href="rubriekenpagina.php">Item 1</a>
    <ul class="menu vertical sublevel-1">
      <li>
        <a href="rubriekenpagina.php">Sub-item 1</a>
        <ul class="menu vertical sublevel-2">
          <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 3</a></li>
        </ul>
      </li>
      <li>
        <a href="rubriekenpagina.php">Sub-item 2</a>
        <ul class="menu vertical sublevel-2">
          <li>
            <a href="rubriekenpagina.php">Super-sub-item 1</a>
            <ul class="menu vertical sublevel-3">
              <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
              <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
            </ul>
          </li>
          <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
        </ul>
      </li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
      <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
    </ul>
  </li>
</ul>
</div> -->