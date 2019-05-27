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
          </i> $subrubrieknaam
        </a>
      </form>
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

  echo "ActuelePlek: ".$actueleplek;
  echo "VolgendePlek: ".$volgendeplek;

  $sql = "SELECT titel, beschrijving, verkoopprijs, verkoper, plaatsnaam FROM voorwerp
          WHERE voorwerpnummer like :voorwerpnummer
          ORDER BY voorwerpnummer OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
  $query = $dbh->prepare($sql);
  $query -> execute(array(
    ':voorwerpnummer' => $voorwerpnummer
  ));
  $row = $query -> fetch();

  echo $row['titel'];

  $titel = $row['titel'];
  $beschrijving = $row['beschrijving'];
  $hoogstebod = $row['verkoopprijs'];
  $gebruikersnaam = $row['verkoper'];
  $tijd = "Hendrik/Mehmet voeg aub hier die timer toe.";
  $locatie = $row['plaatsnaam'];
  
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

  echo "
    <article class='RubProduct'>
      <img class='FotoRubProduct' src='$afbeelding' alt='Voorwerpfoto'> 
      <div class='InfoRubProduct'>
        <div class='TitelRubProduct'>
          <h4>$titel</h4><br>
        </div>
        <div class='OmschRubProduct'>
          <p>$beschrijving</p>
        </div>
      </div>
      <!--<a href='product.php'>-->
        <form action='product.php' method='POST'>
          <button type='submit' value='$voorwerpnummer' name='voorwerp' class='button ProductButton'>
            <div class='PrijsRubProduct'>
              <h4>€ $hoogstebod</h4>
              <p>$gebruikersnaam</p>
              <p>$tijd</p>
              <p>$locatie</p>
            </div>
          </button>
        </form>
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
function selectAantalVeilingen($gebruiker) {
  global $dbh;
  $sql = "SELECT COUNT(*) as aantalveilingen FROM voorwerp
          WHERE verkoper like :gebruiker";
  $query = $dbh->prepare($sql);
  $query -> execute(array(
    ':gebruiker' => $gebruiker
  ));
  $row = $query -> fetch();

  return $row['aantalveilingen'];
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
    } else {
      $afbeelding = $row['filenaam'];
    }
    
    createHomepageCard($afbeelding, $titel, $hoogstebod, $days, $hours, $mins, $voorwerpnummer, $startprijs);
    global $plek;
    $plek += 1;
}

function createHomepageCard($afbeelding, $titel, $hoogstebod, $days, $hours, $mins, $voorwerpnummer, $startprijs) {
    echo"
      <div class='card'>
        <img src='$afbeelding' alt='$titel'>
        <h4>$titel</h4>
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
        ':voorwerpnummer' => $_SESSION['voorwerp']
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


function createProfVeilingen($actueleplek){
  global $dbh;
  $volgendeplek = $actueleplek +1;
  $sql = "SELECT * FROM voorwerp where verkoper in (
              SELECT gebruikersnaam
              from gebruiker
          )
          AND verkoper = :gebruiker
          ORDER BY voorwerpnummer OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";

  $query = $dbh->prepare($sql);
  $query -> execute(array(
  ':gebruiker' => $_SESSION['gebruikersnaam']
  ));
  $row = $query -> fetch();

  echo "<tr> 
            <td>$row[titel]</td>
            <td>$row[startprijs]</td>
            <td>$row[titel]</td>
            <td>$row[titel]</td>
            <td>$row[titel]</td>
        </tr>";

return $volgendeplek;

}