<?php

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
    
    createHomepageCard($afbeelding, $titel, $hoogstebod, $days, $hours, $mins);
    global $plek;
    $plek += 1;
}

function createHomepageCard($afbeelding, $titel, $hoogstebod, $days, $hours, $mins) {
    echo"
      <div class='card'>
        <img src='$afbeelding' alt='fiets'>
        <h4>$titel</h4>
        <p class='price'>€$hoogstebod</p>
        <p> <i class='fa fi-clock' style='font-size:24px'>&nbsp;</i>Sluit over: ".$days."d $hours"."u $mins"."m</p>
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