<?php

function timeDiff($firstTime,$lastTime){
    $firstTime=strtotime($firstTime);
    $lastTime=strtotime($lastTime);
 
    $timeDiff=$lastTime-$firstTime;
 
    return $timeDiff;
}

function createHomepageUwVeilingen($actueleplek) {
    global $dbh;
    settype($actueleplek, "int");
    $volgendeplek = $actueleplek+1;
    
    $sql = "SELECT veilingGesloten FROM voorwerp 
            WHERE verkoper like :gebruikersnaam
            ORDER BY titel OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
    $query = $dbh->prepare($sql);
    $query -> execute(array(
        ':gebruikersnaam' => $_SESSION['gebruikersnaam']
    ));

    $row = $query -> fetch();

    global $plek;
    
    if ($row['veilingGesloten'] == 'niet') {
      $sql = "SELECT titel, verkoopprijs, looptijdeindeDag, looptijdeindeTijdstip, voorwerpnummer FROM voorwerp 
              WHERE verkoper like :gebruikersnaam
              ORDER BY titel OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
      $query = $dbh->prepare($sql);
      $query -> execute(array(
          ':gebruikersnaam' => $_SESSION['gebruikersnaam']
      ));

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
      
      createHomepageCard($afbeelding, $titel, $hoogstebod, $days, $hours);
      $plek += 1;
    } else {
      $plek = $volgendeplek;
      createHomepageUwVeilingen($plek);
    }
}

function createHomepageBijnaAflopend($actueleplek) {
    global $dbh;
    // settype($actueleplek, "int");
    $volgendeplek = $actueleplek+1;

    $sql = "SELECT titel, voorwerpnummer, verkoopprijs, looptijdeindeDag, looptijdeindeTijdstip FROM voorwerp 
            WHERE veilingGesloten = 'niet' and (
            looptijdeindeTijdstip >= CONVERT(TIME,GETDATE()) or
            looptijdeindeTijdstip < CONVERT(TIME,GETDATE()))
            ORDER BY looptijdeindeDag asc, looptijdeindeTijdstip asc
            OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
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
    
    createHomepageCard($afbeelding, $titel, $hoogstebod, $days, $hours);
    global $plek;
    $plek += 1;
}

function createHomepagePopulair($actueleplek) {
    global $dbh;
    // settype($actueleplek, "int");
    $volgendeplek = $actueleplek+1;

    $sql = "SELECT count(b.voorwerpnummer) as topproducten, v.voorwerpnummer, v.titel, v.verkoopprijs, v.looptijdeindeDag, v.looptijdeindeTijdstip
            FROM voorwerp v inner join bod b on v.voorwerpnummer = b.voorwerpnummer
            WHERE veilingGesloten = 'niet'
            GROUP BY b.voorwerpnummer, v.voorwerpnummer, v.titel, v.verkoopprijs, v.looptijdeindeDag, v.looptijdeindeTijdstip
            ORDER BY topproducten desc OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
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
    
    createHomepageCard($afbeelding, $titel, $hoogstebod, $days, $hours);
    global $plek;
    $plek += 1;
}

function createHomepageNieuweVeilingen($actueleplek) {
    global $dbh;
    // settype($actueleplek, "int");
    $volgendeplek = $actueleplek+1;

    $sql = "SELECT titel, voorwerpnummer, verkoopprijs, looptijdeindeDag, looptijdeindeTijdstip FROM voorwerp 
            WHERE veilingGesloten = 'niet' and (
            looptijdbeginTijdstip >= CONVERT(TIME,GETDATE()) or
            looptijdbeginTijdstip < CONVERT(TIME,GETDATE()))
            ORDER BY looptijdbeginDag desc, looptijdbeginTijdstip desc
            OFFSET $actueleplek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
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
    
    createHomepageCard($afbeelding, $titel, $hoogstebod, $days, $hours);
    global $plek;
    $plek += 1;
}

function createHomepageCard($afbeelding, $titel, $hoogstebod, $days, $hours) {
    echo"
      <div class='card'>
        <img src='$afbeelding' alt='fiets'>
        <h4>$titel</h4>
        <p class='price'>€$hoogstebod</p>
        <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: "."$days"."d $hours"."u</p>
        <a href='product.php' class='button ProductButton'>Bekijk Meer!</a>
      </div>
    ";
}

function createFotos($plek) {
    global $dbh;
    $volgendeplek = $plek+1;
    $sql = "SELECT filenaam FROM bestand
          WHERE voorwerp like :voorwerpnummer
          ORDER BY filenaam OFFSET $plek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
    $query = $dbh->prepare($sql);
    $query -> execute(array(
        ':voorwerpnummer' => $_SESSION['voorwerpnummer']
    ));

    $row = $query -> fetch();
    $afbeelding = $row['filenaam'];
    echo"
      <div class='column'>
        <img class='thumbnail' src='$afbeelding' alt='afbeelding'>
      </div>
    ";
}

function createBiedingen($plek) {
    global $dbh;
    $volgendeplek = $plek+1;
    $sql = "SELECT gebruiker, bodbedrag, boddag, bodtijdstip FROM bod
            WHERE voorwerpnummer like :voorwerpnummer
            ORDER BY bodbedrag OFFSET $plek ROWS FETCH NEXT $volgendeplek ROWS ONLY";
    $query = $dbh->prepare($sql);
    $query -> execute(array(
        ':voorwerpnummer' => $_SESSION['voorwerpnummer']
    ));

    $row = $query -> fetch();
                
    $gebruiker = $row['gebruiker'];
    $bod = $row['bodbedrag'];
    $dag = $row['boddag'];
    $tijd = $row['bodtijdstip'];
    // $gebruiker = 'Mike stevenson';
    // $bod = '1,-';
    // $dag = 'Een dag';
    // $tijd = 'Een tijd';

    $profielfoto = 'images/profielfotoPlaceholder.png';
    
    echo "
    <div class='media-object stack-for-small'>
      <div class='media-object-section'>
        <img class='thumbnail' src='$profielfoto' alt='profielfoto'>
      </div>

      <div class='media-object-section'>
        <h5>$gebruiker</h5>
        <p>Geboden: €$bod</p>
        <p><i>Datum van bod: $dag $tijd</i></p>
      </div>
    </div>";
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