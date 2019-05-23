<?php
function createRubriek($actueleplek) {
  global $dbh;
  global $subplek;
  $volgendeplek = $actueleplek+1;
  $sublevel = 1;
  $sql = "SELECT rubrieknaam, rubrieknummer FROM rubriek
          WHERE rubriek = 0
          ORDER BY rubrieknummer OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
  $query = $dbh->prepare($sql);
  $query -> execute();
  $row = $query -> fetch();
  
  echo "
    <li>
      <a href='rubriekenpagina.php'><i class='";
      if (heeftSubriek($row['rubrieknummer'])) { echo"fi-folder-add"; }
      echo "'></i> $row[rubrieknaam]</a>
  ";

  if (heeftSubriek($row['rubrieknummer'])) {
    echo "
      <ul class='menu vertical sublevel-$sublevel'>
    ";

    $aantalSubrieken = selectAantalSubRubrieken($row['rubrieknummer']);
  
    for($i = 0; $i < $aantalSubrieken; $i++) {
      $subplek = createSubRubrieken($row['rubrieknummer'], $sublevel+1, $subplek);
    }
    
    echo "
      </ul>
    ";
  }

  echo "
    </li>
  ";

  
  return $actueleplek+1;
}

//   // <li>
//   //   <a href="rubriekenpagina.php"><i class="fi-folder-add"></i> Item 1</a>
//   //   <ul class="menu vertical sublevel-1">
// // // //   //     <li>
// // // //   //       <a href="rubriekenpagina.php">Sub-item 1</a>
// // // //   //       <ul class="menu vertical sublevel-2">
// // // //   //         <li><a  href="rubriekenpagina.php">Thing 1</a></li>
// // // //   //         <li><a href="rubriekenpagina.php">Thing 2</a></li>
// // // //   //         <li><a  href="rubriekenpagina.php">Thing 3</a></li>
// // // //   //       </ul>
// // // //   //     </li>
// // // //   //     <li>
// // // //   //       <a href="rubriekenpagina.php">Sub-item 2</a>
// // // //   //       <ul class="menu vertical sublevel-2">
// // // //   //         <li>
// // // //   //           <a href="rubriekenpagina.php">Super-sub-item 1</a>
// // // //   //           <ul class="menu vertical sublevel-3">
// // // //   //             <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
// // // //   //             <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
// // // //   //           </ul>
// // // //   //         </li>
// // // //   //         <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
// // // //   //       </ul>
// // // //   //     </li>
// // // //   //     <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
// // // //   //     <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
//   //   </ul>
//   //   <li><a class="subitem" href="rubriekenpagina.php">Thing 1</a></li>
//   //   <li><a class="subitem" href="rubriekenpagina.php">Thing 2</a></li>
//   // </li>

function createSubRubrieken($parentRubriekNummer, $sublevel, $subplek) {
  $aantalSubrieken = selectAantalSubRubrieken($parentRubriekNummer);
  global $subsubplek;
  $subsubplek = 0;
  
  for($i = 0; $i < $aantalSubrieken; $i++) {
    $subrubrieknaam = selectSubRubriekNaam($subplek, $parentRubriekNummer);
    $subrubrieknummer = selectSubRubriekNummer($subplek, $parentRubriekNummer);
    
    echo "
      <li>
        <a href='rubriekenpagina.php'>
          <i class='";
            if (heeftSubriek($subrubrieknummer)) { echo"fi-folder-add"; }
            echo    "'>
          </i> $subrubrieknaam
        </a>
    ";

    if (heeftSubriek($subrubrieknummer)) {

      echo "
        <ul class='menu vertical sublevel-$sublevel'>
      ";

      $aantalSubrieken = selectAantalSubRubrieken($subrubrieknummer);
  
      for($i = 0; $i < $aantalSubrieken; $i++) {
        $subsubplek = createSubRubrieken($subrubrieknummer, $sublevel+1, $subsubplek);
      }

      // $subplek = createSubRubrieken($subrubrieknummer, $sublevel+1, $subplek);
      // $subsubplek = createSubRubrieken($subrubrieknummer, $sublevel+1, $subsubplek);
      
      echo "
        </ul>
      ";
    }

    echo "
      </li>
    ";
    
    // global $subplek;
    // $subplek += 1;
    return $subplek+1;
  }




  //   $test++;
  // echo "
  //   <li>
  //     <a href='rubriekenpagina.php'><i class='fi-folder-add'></i> test</a>
  // ";

  // if (heeftSubriek($parentRubriekNummer)) {
  //   echo "
  //     <ul class='menu vertical sublevel-$sublevel'>
  //   ";
  //   createSubRubrieken($parentRubriekNummer, $sublevel+1);
  //   echo "
  //     </ul>
  //   ";
  // } else {
  //   echo "
  //     <li><a class='subitem' href='rubriekenpagina.php'>...</a></li>
  //   ";
  // }

  // echo "
  //   </li>
  // ";


    // global $test;
    // $aantalSubrieken = selectAantalSubRubrieken($test, $parentRubriekNummer);
    
    // for($i = 0; $i < $aantalSubrieken; $i++) {
    //   $subrubriek = selectSubRubriekNaam($parentRubriekNummer);
    //   $test++;

    //   if (heeftSubriek($subrubriek)) {
    //     // createSubRubriekenMetSubrubrieken($subrubriek, $sublevel+1);

        
    //   } else {
    //     echo"
    //       <li><a class='subitem' href='rubriekenpagina.php'>$subrubriek</a></li>
    //     ";
    //   }
    // }


    // global $test;
    // $aantalSubrieken = selectAantalSubRubrieken($test, $row['rubrieknummer']);
    // echo "
    //   <ul class='menu vertical sublevel-1'>
    //     <li>
    // ";
    // for($i = 0; $i < $aantalSubrieken; $i++) {
    //   $subrieken = selectSubRubriekNaam($test, $row['rubrieknummer']);
    //   echo"
    //         <li><a class='subitem' href='rubriekenpagina.php'>$subrieken</a></li>
    //   ";
    //   echo $test;
    // }

    // echo "
    //     </li>
    //   </ul>
    // ";
}

// function createSubRubriekenMetSubrubrieken($subrubriek, $sublevel) {
//     echo "
//       <ul class='menu vertical sublevel-$sublevel'>
//     ";
  
//   //     <li>
//   //       <a href="rubriekenpagina.php">Sub-item 1</a>
//   //       <ul class="menu vertical sublevel-2">
//   //         <li><a  href="rubriekenpagina.php">Thing 1</a></li>
//   //         <li><a href="rubriekenpagina.php">Thing 2</a></li>
//   //         <li><a  href="rubriekenpagina.php">Thing 3</a></li>
//   //       </ul>
//   //     </li>
//   //     <li>

//     echo "
//       </ul>
//     ";
// }

function heeftSubriek($rubrieknummer) {
  global $dbh;
  $sql = "SELECT COUNT(*) as aantalSubRubrieken FROM rubriek
          WHERE rubriek like :rubrieknummer";
  $query = $dbh->prepare($sql);
  $query -> execute(array(
    ':rubrieknummer' => $rubrieknummer
  ));
  $row = $query -> fetch();

  if ($row['aantalSubRubrieken'] > 0) {
    return true;
  } else {
    return false;
  }
}

function selectSubRubriekNaam($actueleplek, $rubrieknummer) {
  global $dbh;
  $volgendeplek = $actueleplek+1;
  $sql = "SELECT rubrieknaam FROM rubriek
          WHERE rubriek like :rubrieknummer
          ORDER BY rubrieknummer OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
  $query = $dbh->prepare($sql);
  $query -> execute(array(
    ':rubrieknummer' => $rubrieknummer
  ));
  $row = $query -> fetch();
  
  return $row['rubrieknaam'];
}

function selectSubRubriekNummer($actueleplek, $rubrieknummer) {
  global $dbh;
  $volgendeplek = $actueleplek+1;
  $sql = "SELECT rubrieknummer FROM rubriek
          WHERE rubriek like :rubrieknummer
          ORDER BY rubrieknummer OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
  $query = $dbh->prepare($sql);
  $query -> execute(array(
    ':rubrieknummer' => $rubrieknummer
  ));
  $row = $query -> fetch();
  
  return $row['rubrieknummer'];
}

function selectAantalSubRubrieken($rubrieknummer) {
  global $dbh;
  $sql = "SELECT COUNT(*) as aantalRubrieken FROM rubriek
          WHERE rubriek like :rubrieknummer";
  $query = $dbh->prepare($sql);
  $query -> execute(array(
    ':rubrieknummer' => $rubrieknummer
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

    global $test;
    $test += 1;
}