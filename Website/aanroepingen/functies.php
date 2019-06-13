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
      if (heeftSubriek($row['rubrieknummer'])) { echo"fi-folder-add"; } else { echo"fi-page"; }
      echo "'></i> ".strip_tags($row['rubrieknaam']).", ".strip_tags($row['rubrieknummer'])."</a>
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

function createSubRubrieken($parentRubriekNummer, $sublevel, $subplek) {
  $aantalSubrieken = selectAantalSubRubrieken($parentRubriekNummer);
  global $subsubplek;
  $subsubplek = 0;
  
  for($i = 0; $i < $aantalSubrieken; $i++) {
    $subrubrieknaam = selectSubRubriekNaam($subplek, $parentRubriekNummer);
    $subrubrieknummer = selectSubRubriekNummer($subplek, $parentRubriekNummer);
    
    global $dbh;
    $sql = "SELECT [rubriek op laagste niveau] as rubriek FROM [voorwerp in rubriek]
            WHERE [rubriek op laagste niveau] = :rubrieknummer";
    $query = $dbh->prepare($sql);
    $query -> execute(array(
        ':rubrieknummer' => $subrubrieknummer
    ));

    $row = $query -> fetch();
    
    echo "
      <li>
        <a href='rubriekenpagina.php?id=$row[rubriek]'>
          <i class='";
            if (heeftSubriek($subrubrieknummer)) { echo"fi-folder-add"; } else { echo"subitem fi-page"; }
            echo    "'>
          </i> ".strip_tags($subrubrieknaam).", ".strip_tags($row['rubriek'])."
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
      
      echo "
        </ul>
      ";
    }

    echo "
      </li>
    ";

    return $subplek+1;
  }
}

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

function selectSubRubriekNaamZonderPlek($rubrieknummer) {
  global $dbh;
  $sql = "SELECT rubrieknaam FROM rubriek
          WHERE rubriek like :rubrieknummer";
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

function selectSubRubriekNummerZonderPlek($rubrieknummer) {
  global $dbh;
  $sql = "SELECT rubrieknummer FROM rubriek
          WHERE rubriek like :rubrieknummer";
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

function selectAantalVeilingen($gebruiker) {
  global $dbh;
  $sql = "SELECT COUNT(*) as aantalveilingen
          FROM voorwerp
          WHERE verkoper like :gebruiker";
  $query = $dbh->prepare($sql);
  $query -> execute(array(
    ':gebruiker' => $gebruiker
  ));
  $row = $query -> fetch();

  return $row['aantalveilingen'];
}






function createVoorwerpInRubriekItem($actueleplek, $rubrieknummer) {
  global $dbh;
  $volgendeplek = $actueleplek+1;

  $sql = "SELECT voorwerp FROM [voorwerp in rubriek]
          WHERE [rubriek op laagste niveau] like :rubriek
          ORDER BY voorwerp OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
  $query = $dbh->prepare($sql);
  $query -> execute(array(
      ':rubriek' => $rubrieknummer
  ));
  $row = $query -> fetch();

  $voorwerpnummer = $row['voorwerp'];

  $sql = "SELECT titel, beschrijving, verkoopprijs, startprijs, verkoper, plaatsnaam, looptijdeindeDag, looptijdeindeTijdstip FROM voorwerp
          WHERE voorwerpnummer like :voorwerpnummer";
  $query = $dbh->prepare($sql);
  $query -> execute(array(
    ':voorwerpnummer' => $voorwerpnummer
  ));
  $row = $query -> fetch();

  $titel = strip_tags($row['titel']);
  $beschrijving = strip_tags($row['beschrijving']);
  $hoogstebod = $row['verkoopprijs'];
  $startprijs = $row['startprijs'];
  $gebruikersnaam = strip_tags($row['verkoper']);
  $locatie = strip_tags($row['plaatsnaam']);

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
  } else if (substr($row['filenaam'],0,2) != "dt" ) {
    $afbeelding = $row['filenaam'];
  } else {
    $afbeelding = strip_tags("http://iproject14.icasites.nl/pics/".$row['filenaam']);
  }

  echo "  
    <article class='RubProduct'>
      <img class='FotoRubProduct' src='$afbeelding' alt='Voorwerpfoto'> 
      <div class='InfoRubProduct'>
        <div class='TitelRubProduct'>
          <h4>$titel</h4><br>
        </div>
        <div class='wrapword'>

          <p class='OmschRubProduct'>$beschrijving</p>

        </div>
      </div>
      <!--<a href='product.php'>-->
      <div class='FormRubPrijs'>
        <form action='product.php' method='POST' style='width: 100%;'>
          <button type='submit' value='$voorwerpnummer' name='voorwerp' class='button ProductButton'>
            <div class='PrijsRubProduct'>
            <p>$gebruikersnaam</p'>
              <h4>€ ";
              if (isset($hoogstebod)) {
                echo $hoogstebod;
              } else {
                echo $startprijs;
              }
              echo"</h4>
              <p>$locatie</p>
              <p style='font-size:20px'>".$days."d ".$hours."h $mins m</p>
            </div>
          </button>
        </form>
        </div>
      <!--</a>-->
    </article>
  ";

  return $volgendeplek;
}

function selectAantalVoorwerpen($rubrieknummer) {
  global $dbh;
  $sql = "SELECT COUNT(*) as aantalVoorwerpen FROM [voorwerp in rubriek]
          WHERE [rubriek op laagste niveau] like :rubrieknummer";
  $query = $dbh->prepare($sql);
  $query -> execute(array(
    ':rubrieknummer' => $rubrieknummer
  ));
  $row = $query -> fetch();
  
  return $row['aantalVoorwerpen'];
}


function createZoekVoorwerpen($voorwerpnummer) {
  global $dbh;
  
  $sql = "SELECT titel, beschrijving, verkoopprijs, startprijs, verkoper, plaatsnaam, looptijdeindeDag, looptijdeindeTijdstip FROM voorwerp
          WHERE voorwerpnummer like :voorwerpnummer";
  $query = $dbh->prepare($sql);
  $query -> execute(array(
    ':voorwerpnummer' => $voorwerpnummer
  ));
  $row = $query -> fetch();

  $titel = strip_tags($row['titel']);
  $beschrijving = strip_tags($row['beschrijving']);
  $hoogstebod = $row['verkoopprijs'];
  $startprijs = $row['startprijs'];
  $gebruikersnaam = strip_tags($row['verkoper']);
  $locatie = strip_tags($row['plaatsnaam']);

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
  } else if (substr($row['filenaam'],0,2) != "dt" ) {
    $afbeelding = $row['filenaam'];
  } else {
    $afbeelding = strip_tags("http://iproject14.icasites.nl/pics/".$row['filenaam']);
  }

  echo "
  <article class='RubProduct'>
  <img class='FotoRubProduct' src='$afbeelding' alt='Voorwerpfoto'> 
  <div class='InfoRubProduct'>
    <div class='TitelRubProduct'>
      <h4>$titel</h4><br>
    </div>
    <div class='wrapword'>

      <p class='OmschRubProduct'>$beschrijving</p>

    </div>
  </div>
  <!--<a href='product.php'>-->
  <div class='FormRubPrijs'>
    <form action='product.php' method='POST' style='width: 100%;'>
      <button type='submit' value='$voorwerpnummer' name='voorwerp' class='button ProductButton'>
        <div class='PrijsRubProduct'>
        <p>$gebruikersnaam</p'>
          <h4>€ ";
          if (isset($hoogstebod)) {
            echo $hoogstebod;
          } else {
            echo $startprijs;
          }
          echo"</h4>
          <p>$locatie</p>
          <p style='font-size:20px'>".$days."d ".$hours."h $mins m</p>
        </div>
      </button>
    </form>
    </div>
  <!--</a>-->
</article>
  ";
}


function heeftParentRubriek($rubrieknummer) {
  global $dbh;
  $sql = "SELECT COUNT(*) as aantalParentRubrieken FROM rubriek
          WHERE rubrieknummer like :rubrieknummer";
  $query = $dbh->prepare($sql);
  $query -> execute(array(
    ':rubrieknummer' => $rubrieknummer
  ));
  $row = $query -> fetch();

  if ($row['aantalParentRubrieken'] > 0) {
    return true;
  } else {
    return false;
  }
}

function selectParentRubriekNaam($rubrieknummer) {
  global $dbh;;
  $sql = "SELECT rubrieknaam FROM rubriek
          WHERE rubrieknummer like :rubrieknummer";
  $query = $dbh->prepare($sql);
  $query -> execute(array(
    ':rubrieknummer' => $rubrieknummer
  ));
  $row = $query -> fetch();
  
  return $row['rubrieknaam'];
}

function selectParentRubriekNummer($rubrieknummer) {
  global $dbh;
  $sql = "SELECT rubriek FROM rubriek
          WHERE rubrieknummer like :rubrieknummer";
  $query = $dbh->prepare($sql);
  $query -> execute(array(
    ':rubrieknummer' => $rubrieknummer
  ));
  $row = $query -> fetch();
  
  if ($row['rubriek'] != 0) {
    return $row['rubriek'];
  }
}

function selectRubriekNaam($rubrieknummer) {
  global $dbh;;
  $sql = "SELECT rubrieknaam FROM rubriek
          WHERE rubrieknummer like :rubrieknummer";
  $query = $dbh->prepare($sql);
  $query -> execute(array(
    ':rubrieknummer' => $rubrieknummer
  ));
  $row = $query -> fetch();
  
  return $row['rubrieknaam'];
}

// function createProductRubrieken($rubrieknummer) {
//   global $nietBovenaan;

//   // echo $rubrieknummer;

//   if ($nietBovenaan) {
//     if (heeftParentRubriek($rubrieknummer)) {
//       $parentRubriekNummer = selectParentRubriekNummer($rubrieknummer);
//       if ($parentRubriekNummer != 0) {
//         global $test;
//         $test = $parentRubriekNummer;
//       }
//       createProductRubrieken($parentRubriekNummer);
//     } else {
//       $nietBovenaan = false;
//       global $test;
//       createProductRubrieken($test);
//     }
//   } else {
//     $naam = selectRubriekNaam($rubrieknummer);

//     global $actueleRubriek;
//     global $actueleParentRubriek;
//     if (selectParentRubriekNummer($rubrieknummer) != $actueleParentRubriek) {
//       echo"
//         <li class='disabled'>";
//         echo strip_tags($naam)."</li>
//       ";

//       if (heeftSubriek($rubrieknummer)) {
//         $subrubrieknummer = selectSubRubriekNummerZonderPlek($rubrieknummer);
//         createProductRubrieken($subrubrieknummer);
//       }
//     } else {
//       $naam = selectRubriekNaam($actueleRubriek);
//       echo"<li><span class='show-for-sr'></span>";
//       echo strip_tags($naam)."</li>";
//     }
//   }
// }


function createProductRubrieken($rubrieknummer) {
  $naam = selectParentRubriekNaam($rubrieknummer);
  
  echo"
    <li";
    if(!heeftSubriek($rubrieknummer)) {
      echo"><span class='show-for-sr'></span>";
    } else {
      echo " class='disabled'>";
    }
    echo"$naam</li>
  ";

  if (heeftParentRubriek($rubrieknummer)) {
    $parentRubriekNummer = selectParentRubriekNummer($rubrieknummer);
    createProductRubrieken($parentRubriekNummer);
  }
  
  // <li><a href="#">Home</a></li>
  // <li><a href="#">Features</a></li>
  // <li class="disabled">Gene Splicing</li>
  // <li><span class="show-for-sr">Current: </span> Cloning</li>
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
    $merge = " OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
    $sql = $sql.$merge;

    $query = $dbh->prepare($sql);
    $query -> execute();

    $row = $query -> fetch();

    $titel = strip_tags($row['titel']);
    $hoogstebod = $row['verkoopprijs'];
    $voorwerpnummer = $row['voorwerpnummer'];
    $looptijdeindeDag = $row['looptijdeindeDag'];
    $looptijdeindeTijdstip = $row['looptijdeindeTijdstip'];
    $startprijs = $row['startprijs'];
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
    } else if (substr($row['filenaam'],0,2) != "dt" ) {
      $afbeelding = $row['filenaam'];
    } else {
      $afbeelding = strip_tags("http://iproject14.icasites.nl/pics/".$row['filenaam']);
    }
    
    createHomepageCard($afbeelding, $titel, $hoogstebod, $days, $hours, $mins, $voorwerpnummer, $startprijs);
    global $plek;
    $plek += 1;
}

function createHomepageCard($afbeelding, $titel, $hoogstebod, $days, $hours, $mins, $voorwerpnummer, $startprijs) {
    echo"
      <div class='card'>
        <img src='$afbeelding' alt='$titel'>
        <h4 class='wrapword'>$titel</h4>
        <p class='price'>€";
        if (isset($hoogstebod)) {
          echo $hoogstebod;
        } else {
          echo $startprijs;
        }
         echo "</p>
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
        ':voorwerpnummer' => $_SESSION['voorwerp']
    ));

    $row = $query -> fetch();
    if ($row['filenaam'] == NULL) {
      $afbeelding = "images/imageplaceholder.png";
    } else if (substr($row['filenaam'],0,2) != "dt" ) {
      $afbeelding = $row['filenaam'];
    } else {
      $afbeelding = strip_tags("http://iproject14.icasites.nl/pics/".$row['filenaam']);
    }
    echo"
    
        <td class='sim-thumb'> <a class='sim-thumb'  data-image='$afbeelding'><img src='$afbeelding' alt=''></a> </td>

    
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
        ':voorwerpnummer' => $_SESSION['voorwerp']
    ));

    $row = $query -> fetch();
                
    $gebruiker = strip_tags($row['gebruiker']);
    $bod = strip_tags($row['bodbedrag']);
    $dag = strip_tags($row['boddag']);
    $tijd = strip_tags($row['bodtijdstip']);

    // $profielfoto = 'images/profielfotoPlaceholder.png';
    
    echo "
    <div class='tab-biedingen media-object stack-for-small'>
      <!--<div class='media-object-section'>
        
      </div>-->
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

    while ($i <= 20) { 
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

    return $volgendeplek;
}


function createProfVeilingen($actueleplek){
  global $dbh;
  $volgendeplek = $actueleplek +1;
  $sql = "SELECT voorwerpnummer, titel, startprijs, betalingswijze, plaatsnaam, looptijdbeginDag, looptijdeindeDag, verkoopprijs, koper, veilingGesloten 
          FROM voorwerp WHERE verkoper in (
              SELECT gebruikersnaam
              FROM gebruiker)
          AND verkoper = :gebruiker
          ORDER BY voorwerpnummer OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";

  $query = $dbh->prepare($sql);
  $query -> execute(array(
      ':gebruiker' => $_SESSION['gebruikersnaam']
  ));
  $row = $query -> fetch();

  echo "
  <tr style='text-align=center;'> 
    <td>
      <form action='product.php' method='POST'>
        <button type='submit' value='$row[voorwerpnummer]' name='voorwerp' class='button ProductButton'>".strip_tags($row['titel'])."</button>
      </form>
    </td>
    <td>".strip_tags($row['startprijs'])."</td>
    <td"; 
      if ($row['betalingswijze'] == 'PayPal') { 
         echo" class='fi-paypal'";
      }
    echo">".strip_tags($row['betalingswijze'])."</td>
    <td>".strip_tags($row['plaatsnaam'])."</td>
    <td>".strip_tags($row['looptijdbeginDag'])."</td>
    <td>".strip_tags($row['looptijdeindeDag'])."</td>
    <td>".strip_tags($row['verkoopprijs'])."</td>
    <td>".strip_tags($row['koper'])."</td>
    <td";
      if ($row['veilingGesloten'] == 'wel') { 
        echo" class='profveilinggesloten'";
      } else {
        echo" class='profveilingopen'";
      }
    echo">";
      if ($row['veilingGesloten'] == 'wel') {
        $veiling = 'gesloten';
      } else {
        $veiling = 'open';
      }
    echo "$veiling</td>
  </tr>";

  return $volgendeplek;
}

function selectAantalBiedingen($gebruiker) {
  global $dbh;
  $sql = "SELECT COUNT(*) as aantalbiedingenPp,gebruiker
          FROM aantalBiedingenPerPersoon
          WHERE gebruiker like :gebruiker
          group by gebruiker";
  $query = $dbh->prepare($sql);
  $query -> execute(array(
    ':gebruiker' => $gebruiker
  ));
  $row = $query -> fetch();

  return $row['aantalbiedingenPp'];
}


function createProfBiedingen($actueleplek) {
  global $dbh;
  $volgendeplek = $actueleplek +1;
  $sql = "SELECT b.voorwerpnummer,MAX(b.bodbedrag) as bod,b.gebruiker,v.titel,v.verkoopprijs,v.startprijs,v.looptijdbeginDag,v.looptijdeindeDag,v.verkoopprijs,v.veilingGesloten
          FROM bod b inner join voorwerp v on b.voorwerpnummer = v.voorwerpnummer
          where b.gebruiker = :gebruiker
          GROUP BY b.voorwerpnummer,b.gebruiker,v.titel,v.verkoopprijs,v.startprijs,v.looptijdbeginDag,v.looptijdeindeDag,v.verkoopprijs,v.veilingGesloten
          ORDER BY b.voorwerpnummer OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";

  $query = $dbh->prepare($sql);
  $query -> execute(array(
  ':gebruiker' => $_SESSION['gebruikersnaam']
  ));
  $row = $query -> fetch();

  echo "<tr>
  
          <td><form action='product.php' method='POST'>
          <button type='submit' value='$row[voorwerpnummer]' name='voorwerp' class='button ProductButton'>$row[titel]</button>
        </form></a></td>
          <td>€ ".strip_tags($row['startprijs'])."</td>
          <td>€ ".strip_tags($row['bod'])."</td>
          <td>€ ".strip_tags($row['verkoopprijs'])."</td>
          <td>".strip_tags($row['looptijdbeginDag'])."</td>
          <td>".strip_tags($row['looptijdeindeDag'])."</td>
          <td";
          if ($row['veilingGesloten'] == 'wel') { 
            echo" class='profveilinggesloten'";
          } else {
            echo" class='profveilingopen'";
          }
        echo">";
          if ($row['veilingGesloten'] == 'wel') {
            $veiling = 'gesloten';
          } else {
            $veiling = 'open';
          }
        echo "$veiling</td>
        </tr>";

return $volgendeplek;

}



function createGebruikers($actueleplek) {
  global $dbh;
  $volgendeplek = $actueleplek+1;
  $sql = "SELECT gebruikersnaam, rol FROM gebruiker
          WHERE rol != 5 and rol != 1
          ORDER BY gebruikersnaam OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
  $query = $dbh->prepare($sql);
  $query -> execute();
  $row = $query -> fetch();

  $gebruiker = $row['gebruikersnaam'];
  $rol = $row['rol'];
  if ($rol == 2) {
    $rol = "Gebruiker";
  } else if ($rol == 3) {
    $rol = "Verkoper";
  } else {
    $rol = "Beheerder";
  }

  echo"
    <tr>
      <td>".strip_tags($gebruiker)."</td>
      <td>$rol</td>
      <td>
        <form action='beheerderspagina.php' method='post'>
          <button type='submit' value='".strip_tags($gebruiker)."' name='gebruiker' class='button'>Blokkeren</button>
<!--          </div>-->
        </form>
      </td>
    </tr>
  ";
  
  return $volgendeplek;
}

function selectAantalGebruikers() {
  global $dbh;
  $sql = "SELECT COUNT(*) as aantalGebruikers FROM gebruiker
          WHERE rol != 5";
  $query = $dbh->prepare($sql);
  $query -> execute();
  $row = $query -> fetch();

  return $row['aantalGebruikers'];
}