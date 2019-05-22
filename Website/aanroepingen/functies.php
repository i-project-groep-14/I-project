<?php

function createRubriek($actueleplek) {
  global $dbh;
  $volgendeplek = $actueleplek+1;
  $sql = "SELECT rubrieknaam, rubrieknummer FROM rubriek
          WHERE rubriek = 0
          ORDER BY rubrieknaam OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
  $query = $dbh->prepare($sql);
  $query -> execute();
  $row = $query -> fetch();
  
  echo "
    <li>
      <a href='rubriekenpagina.php'><i class='fi-folder-add'></i> $row[rubrieknaam]</a>
  ";

  if (heeftSubriek($row['rubrieknummer'])) {
    createSubRubrieken($row['rubrieknummer'], 1);
  }

  echo "
    </li>
  ";

  global $plek;
  $plek++;
}

  // <li>
  //   <a href="rubriekenpagina.php"><i class="fi-folder-add"></i> Item 1</a>
  //   <ul class="menu vertical sublevel-1">
  //     <li>
  //       <a href="rubriekenpagina.php">Sub-item 1</a>
  //       <ul class="menu vertical sublevel-2">
  //         <li><a  href="rubriekenpagina.php">Thing 1</a></li>
  //         <li><a href="rubriekenpagina.php">Thing 2</a></li>
  //         <li><a  href="rubriekenpagina.php">Thing 3</a></li>
  //       </ul>
  //     </li>
  //     <li>
  //       <a href="rubriekenpagina.php">Sub-item 2</a>
  //       <ul class="menu vertical sublevel-2">
  //         <li>
  //           <a href="rubriekenpagina.php">Super-sub-item 1</a>
  //           <ul class="menu vertical sublevel-3">
  //             <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
  //             <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
  //           </ul>
  //         </li>
  //         <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
  //       </ul>
  //     </li>
  //     <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
  //     <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
  //   </ul>
  // </li>

function createSubRubrieken($parentRubriek, $sublevel) {
    global $plekSubrubriek;
    $aantalSubrieken = selectAantalSubRubrieken($plekSubrubriek, $parentRubriek);
    
    

    for($i = 0; $i < $aantalSubrieken; $i++) {
      $subrubriek = selectSubRubriek($plekSubrubriek, $parentRubriek);

      if (heeftSubriek($subrubriek)) {
        createSubRubriekenMetSubrubrieken($subrubriek, $sublevel+1);
      } else {
        echo"
          <li><a class='subitem' href='rubriekenpagina.php'>$subrubriek</a></li>
        ";
      }
    }

    

    $plekSubrubriek++;



    // global $plekSubrubriek;
    // $aantalSubrieken = selectAantalSubRubrieken($plekSubrubriek, $row['rubrieknummer']);
    // echo "
    //   <ul class='menu vertical sublevel-1'>
    //     <li>
    // ";
    // for($i = 0; $i < $aantalSubrieken; $i++) {
    //   $subrieken = selectSubRubriek($plekSubrubriek, $row['rubrieknummer']);
    //   echo"
    //         <li><a class='subitem' href='rubriekenpagina.php'>$subrieken</a></li>
    //   ";
    //   echo $plekSubrubriek;
    // }

    // echo "
    //     </li>
    //   </ul>
    // ";
}

function createSubRubriekenMetSubrubrieken($subrubriek, $sublevel) {
    echo "
      <ul class='menu vertical sublevel-$sublevel'>
    ";
  
  //     <li>
  //       <a href="rubriekenpagina.php">Sub-item 1</a>
  //       <ul class="menu vertical sublevel-2">
  //         <li><a  href="rubriekenpagina.php">Thing 1</a></li>
  //         <li><a href="rubriekenpagina.php">Thing 2</a></li>
  //         <li><a  href="rubriekenpagina.php">Thing 3</a></li>
  //       </ul>
  //     </li>
  //     <li>

    echo "
      </ul>
    ";
}

function heeftSubriek($rubriek) {
  global $dbh;
  $sql = "SELECT COUNT(*) as aantalSubRubrieken FROM rubriek
          WHERE rubriek like :rubrieknummer";
  $query = $dbh->prepare($sql);
  $query -> execute(array(
    ':rubrieknummer' => $rubriek
  ));
  $row = $query -> fetch();

  if ($row['aantalSubRubrieken'] > 0) {
    return true;
  } else {
    return false;
  }
}

function selectSubRubriek($actueleplek, $rubriek) {
  global $dbh;
  $volgendeplek = $actueleplek+1;
  $sql = "SELECT rubrieknaam FROM rubriek
          WHERE rubriek like :rubrieknummer
          ORDER BY rubrieknaam OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
  $query = $dbh->prepare($sql);
  $query -> execute(array(
    ':rubrieknummer' => $rubriek
  ));
  $row = $query -> fetch();

  global $plekSubrubriek;
  $plekSubrubriek += 1;
  return $row['rubrieknaam'];
}

function selectAantalSubRubrieken($actueleplek, $rubriek) {
  global $dbh;
  $sql = "SELECT COUNT(*) as aantalRubrieken FROM rubriek
          WHERE rubriek like :rubrieknummer";
  $query = $dbh->prepare($sql);
  $query -> execute(array(
    ':rubrieknummer' => $rubriek
  ));
  $row = $query -> fetch();

  return $row['aantalRubrieken'];
}



function timeDiff($firstTime,$lastTime){
    $firstTime=strtotime($firstTime);
    $lastTime=strtotime($lastTime);
 
    $timeDiff=$lastTime-$firstTime;
 
    return $timeDiff;
}



function createHomepageItem($sql, $actueleplek) {
    global $dbh;
    $volgendeplek = $actueleplek+1;
    $test = " OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
    $sql = $sql.$test;

    $query = $dbh->prepare($sql);
    $query -> execute();

    $row = $query -> fetch();

    $titel = $row['titel'];
    $hoogstebod = $row['verkoopprijs'];
    $voorwerpnummer = $row['voorwerpnummer'];
    $looptijdeindeDag = $row['looptijdeindeDag'];
    $looptijdeindeTijdstip = $row['looptijdeindeTijdstip'];
    $combinedDT = date('Y-m-d H:i:s', strtotime("$looptijdeindeDag $looptijdeindeTijdstip"));
    $difference = timeDiff(date("Y-m-d H:i:s"),$combinedDT);
    $years = abs(floor($difference / 31536000));
    $days = abs(floor(($difference-($years * 31536000))/86400));
    $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
    $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));

    $sql = "SELECT filenaam FROM bestand
    WHERE voorwerp like :voorwerpnummer";
    $query = $dbh->prepare($sql);
    $query -> execute(array(
        ':voorwerpnummer' => $voorwerpnummer
    ));

    $row = $query -> fetch();

    if ($row['filenaam'] == NULL) {
      $afbeelding = "images/imageplaceholder.png";
    } else {
      $afbeelding = $row['filenaam'];
    }
    
    createHomepageCard($afbeelding, $titel, $hoogstebod, $days, $hours, $mins, $voorwerpnummer);
    global $plek;
    $plek += 1;
}

function createHomepageCard($afbeelding, $titel, $hoogstebod, $days, $hours, $mins, $voorwerpnummer) {
    echo"
      <div class='card'>
        <img src='$afbeelding' alt='$titel'>
        <h4>$titel</h4>
        <p class='price'>€$hoogstebod</p>
        <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: ".$days."d $hours"."u $mins"."m</p>
        <!--<a href='product.php' class='button ProductButton'>Bekijk Meer!</a>-->
        <form action='product.php' method='POST'>
          <button type='submit' value='$voorwerpnummer' name='voorwerp' class='button ProductButton'>Bekijk Meer!</button>
        </form>
      </div>
    ";
}



function createFotos($actueleplek) {
    global $dbh;
    $volgendeplek = $actueleplek+1;
    $sql = "SELECT filenaam FROM bestand
            WHERE voorwerp like :voorwerpnummer
            ORDER BY filenaam OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
    $query = $dbh->prepare($sql);
    $query -> execute(array(
        ':voorwerpnummer' => $_POST['voorwerp']
    ));

    $row = $query -> fetch();
    if ($row['filenaam'] == NULL) {
      $afbeelding = "images/imageplaceholder.png";
    } else {
      $afbeelding = $row['filenaam'];
    }
    echo"
      <div class='column'>
        <img class='thumbnail' src='$afbeelding' alt='afbeelding'>
      </div>
    ";
}



function createBiedingen($actueleplek) {
    global $dbh;
    $volgendeplek = $actueleplek+1;
    $sql = "SELECT gebruiker, bodbedrag, boddag, bodtijdstip FROM bod
            WHERE voorwerpnummer like :voorwerpnummer
            ORDER BY bodtijdstip DESC OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
    $query = $dbh->prepare($sql);
    $query -> execute(array(
        ':voorwerpnummer' => $_POST['voorwerp']
    ));

    $row = $query -> fetch();
                
    $gebruiker = $row['gebruiker'];
    $bod = $row['bodbedrag'];
    $dag = $row['boddag'];
    $tijd = $row['bodtijdstip'];

    $profielfoto = 'images/profielfotoPlaceholder.png';
    
    echo "
    <div class='tab-biedingen media-object stack-for-small'>
      <div class='media-object-section'>
        <img class='tab-biedingen-thumb thumbnail' src='$profielfoto' alt='profielfoto'>
      </div>
      <div class='media-object-section'>
        <p>$gebruiker Geboden: €$bod</p>
      </div>
    </div>";
    global $plek;
    $plek += 1;
}



function createRandomCode() {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVW0123456789"; 
    srand((double)microtime()*1000000); 
    $i = 0; 
    $code = '';

    while ($i <= 7) { 
        $num = rand() % 62; 
        $tmp = substr($chars, $num, 1); 
        $code = $code . $tmp; 
        $i++; 
    }

    return $code;
}


function createQuestions($actueleplek) {
    global $dbh;
    $volgendeplek = $actueleplek+1;
    $sql = "SELECT * FROM vraag
            ORDER BY tekstvraag OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
    $query = $dbh->prepare($sql);
    $query -> execute();

    $row = $query -> fetch();

    echo"
      <option value='$row[vraagnummer]'>$row[tekstvraag]</option>
    ";

    global $plek;
    $plek += 1;
}