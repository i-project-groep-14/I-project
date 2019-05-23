<?php
    $config = ['pagina' => 'voorwerpplaatsenpagina'];
    require_once 'aanroepingen/connectie.php';
    include_once 'aanroepingen/header.php';
     
     
    //indicator = niet veilig is niet gesloten
    

    // if (isset($_SESSION['gebruikersnaam'])){
    $gebruikersnaam = $_SESSION['gebruikersnaam'];
    // } else{
        // $gebruikersnaam = ' ';
    // }

    $sql = "SELECT gebruiker FROM verkoper WHERE gebruiker = :gebruiker ";
    $query = $dbh->prepare($sql);
    $query -> execute(array(':gebruiker' => $gebruikersnaam));

    //$row = $query -> fetch();
    $row = $query -> rowCount();
      
        
    if($_SESSION['rol'] == 2) {
        $message = "U heeft de rechten niet om deze pagina te gebruiken!".$_SESSION['rol'];
        echo ("<script 
            LANGUAGE='JavaScript'>
            window.alert('$message');
            window.location.href='index.php';
        </script>");
    } //else {
        // echo "DIT IS ROL 3 |".$_SESSION['rol'];
    // }

        $plaatsnaam = $_SESSION['plaatsnaam'];
        $landnaam = $_SESSION['land'];


    try{

        if(isset($_POST['plaatsen_voorwerp'])) {

            $titel_product = $_POST['titel_product'];
            //$foto_product = $_POST['fileToUpload'];

            $beschrijving_product = $_POST['beschrijving_product'];
            $startprijs = $_POST['startprijs'];
            $laagste_rubriek = $_POST['laagste_rubriek'];
            
            if (empty($_POST['verzendkosten']) ){
                $verzendkosten = "Geen";
            } else{
                $verzendkosten = $_POST['verzendkosten'];
            } 

            if (empty($_POST['verzend_details'])){
                $verzendinstructie = "Geen";
            } else{
                $verzendinstructie = $_POST['verzend_details'];
            }

            if (empty($_POST['betalingsinstructie'])){
                $betalingsinstructie = "Geen";
            } else{
                $betalingsinstructie = $_POST['betalingsinstructie'];
            }

            if ($_POST['betaal_methode'] == -1){
                echo"Vul a.u.b";
            } else{
                $betalingswijze = $_POST['betaal_methode']; 
            }

            $looptijd = $_POST['loopdag'];

            $sql = "SELECT gebruiker FROM verkoper WHERE gebruiker = :gebruiker ";
            $query = $dbh->prepare($sql);
            $query -> execute(array(
                ':gebruiker' => $gebruikersnaam
            ));

            $row = $query -> rowCount();

            if($row == 0){
                $message = "U heeft de rechten niet om deze pagina te gebruiken!".$_SESSION['rol'];
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('$message');
                window.location.href='index.php';
                </script>");
            }

            //In de database zetten van product
            $sql_product = "INSERT INTO voorwerp (titel,beschrijving,startprijs,betalingswijze,betalingsinstructie,plaatsnaam,land,looptijd,looptijdbeginDag,looptijdbeginTijdstip,verzendkosten ,verzendinstructies ,looptijdeindeTijdstip,veilingGesloten,verkoper) 
                            VALUES (:titel ,:beschrijving ,:startprijs ,:betalingswijze ,:betalingsinstructie ,:plaatsnaam ,:land ,:looptijd ,GETDATE() ,CURRENT_TIMESTAMP ,:verzendkosten ,:verzendinstructie ,CURRENT_TIMESTAMP ,'niet',:verkoper)";
            $query_product = $dbh->prepare($sql_product);
            $query_product -> execute(array(
                ':titel' => $titel_product, 
                ':beschrijving' => $beschrijving_product,
                ':startprijs' => $startprijs,
                ':betalingswijze' => $betalingswijze,
                ':betalingsinstructie' => $betalingsinstructie,
                ':plaatsnaam'=> $plaatsnaam,
                ':land' => $landnaam,
                ':looptijd' => $looptijd,
                ':verzendkosten' => $verzendkosten,
                ':verzendinstructie' => $verzendinstructie,
                ':verkoper' => $gebruikersnaam
             ));

            //FOTOS UPLOADEN
            try {
                //Is dit bestand wel goed
                if (
                    !isset($_FILES['upfile']['error']) ||
                    is_array($_FILES['upfile']['error'])
                ) {
                    throw new RuntimeException('Invalid parameters.');
                }

                //De foutmelding voor boven
                switch ($_FILES['upfile']['error']) {
                    case UPLOAD_ERR_OK:
                    break;
                    case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('Geen bestand verzonden');
                    case UPLOAD_ERR_INI_SIZE:
                    case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Het bestand is te groot.');
                    default:
                    throw new RuntimeException('Onbekende foutmelding');
                }
                //hoe groot het bestand kan zijn, in dit geval 1 mb
                if ($_FILES['upfile']['size'] > 1000000) {
                    throw new RuntimeException('Het bestand is te groot.');
                }
                
                //Welke bestanden worden geaccepteert, gecheckt of deze eraan voldoen
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                if (false === $ext = array_search(
                    $finfo->file($_FILES['upfile']['tmp_name']),
                    array(
                        'jpg' => 'image/jpeg',
                        'png' => 'image/png',
                        'gif' => 'image/gif',
                    ), true )) {
                    throw new RuntimeException('Bestand niet geldig.');
                }
                //Verplaatsen van afbeeldingen, hier wordt ook de lange unieke naam gegenergeerd met sha1_file en samengevoegd met sprintf
                    
                $filenaam = sprintf('.\Images\%s.%s', sha1_file($_FILES['upfile']['tmp_name']),  $ext);
                $i = 1;
                while (file_exists($filenaam)) {
                    $filenaam = sprintf('.\Images\%s.%s', sha1_file($_FILES['upfile']['tmp_name']).$i,  $ext);
                    $i++;
                    if($i == 150) {
                        $i = 1;
                        echo"Geef een andere naam aan het bestand!";
                    }
                }

                if (!$filenaam){
                    throw new RuntimeException('Kan bestand niet in de database zetten.');
                }

                if(!move_uploaded_file($_FILES['upfile']['tmp_name'],$filenaam)){
                    //throw new RuntimeException('Kan bestand niet verplaatsen.');
                }
                    
                   

                $sql = "SELECT voorwerpnummer FROM voorwerp 
                        WHERE titel = :titel AND beschrijving = :beschrijving AND startprijs = :startprijs AND betalingswijze = :betalingswijze";
                $query = $dbh->prepare($sql);
                $query -> execute(array(
                    ':titel' => $titel_product, 
                    ':beschrijving' => $beschrijving_product,
                    ':startprijs' => $startprijs,
                    ':betalingswijze' => $betalingswijze
                ));

                $row = $query -> fetch();

                $sql_foto = "INSERT INTO bestand (filenaam, voorwerp) VALUES (:filenaam, :voorwerp)";
                $query_foto = $dbh->prepare($sql_foto);
                $query_foto -> execute(array(':filenaam' => $filenaam, ':voorwerp' => $row['voorwerpnummer']));

        
            } catch (RuntimeException $e) {
                echo $e->getMessage();
            }
        }
    } catch (RuntimeException $e) {
        echo $e->getMessage();
    }



        //Rubriek op laagste niveau moet worden genoteerd
        //echo nieuwe selectie box als er meerdere sub rubrieken zijn
        //zoek naar rubrieknummer OP "-" en tot e hoogste volgnummer is eerste rubrieken box
        //daarna als erop is geklikt dan rubrieknummer OP , het nummer van deze rubriek en alle volgnummers daar van aangegeven
        //enzovoort tot dat er geen sub rubrieken zijn dan geef het gekozen rubrieknummer en deze invullen als value='rubrieknummer'



    ?>
<!--Dit script zorgt ervoor dat het aantal characters niet overschreven wordt, limitNum is het maximaal aantal characters-->
<script language="javascript" type="text/javascript">
   function charLimit(limitField, limitCount, limitNum) {
        if (limitField.value.length > limitNum) {
            limitField.value = limitField.value.substring(0, limitNum);
        } else {
            limitCount.value = limitNum - limitField.value.length;
        }
    }
</script>


<div class="holy-grail-middle">
    <h1>DEZE PAGINA IS IN BEWERKING</h1>
	<br>
	<h2 class="HomepaginaKopjes center">Voorwerp Plaatsen</h2>
		<div class="">
            <p class="center">Op deze pagina kan er een voorwerp worden geplaatst, vul a.u.b. alle gegevens in.</p>
            
			<form action="Voorwerpplaatsenpagina.php" method="post" enctype="multipart/form-data">
				<div class="grid-container">
					<div class="grid-x grid-padding-x">
						<div class="medium-12 cell">
							<label>Titel product:</label>
							<input type="text" placeholder="Titel van uw product" name="titel_product" value="" required>
                        </div>
                        <div class="medium-12 cell">
  
                            <label>Rubriek: </label>
                            <select name="laagste_rubriek"> 
                                <option value="-1">Rubriek</option>
                                <optgroup label="Rubriek1">
                                    <option value="5">SubSubSubRubriek1</option>
                                    <option value="6">SubSubSubRubriek2</option>
                                    <option value="7">SubSubSubRubriek3</option>
                                    <option value="8">SubSubSubRubriek4</option>
                                </optgroup>
                                <optgroup label="Rubriek2">
                                    <option value="9">SubSubSubRubriek1</option>
                                    <option value="10">SubSubSubRubriek2</option>
                                    <option value="11">SubSubRubriek - SubSubSubRubriek3</option>
                                    <option value="12">SubSubRubriek - SubSubSubRubriek4</option>
                                </optgroup>
                                <optgroup label="Rubriek3">
                                    <option value="13">SubSubSubRubriek1</option>
                                    <option value="14">SubSubSubRubriek2</option>
                                    <option value="15">SubSubSubRubriek3</option>
                                    <option value="16">SubSubSubRubriek4</option>
                                </optgroup>
                                <optgroup label="Rubriek4">
                                    <option value="17">SubSubSubRubriek1</option>
                                    <option value="18">SubSubSubRubriek2</option>
                                    <option value="19">SubSubSubRubriek3</option>
                                    <option value="20">SubSubSubRubriek4</option>
                                </optgroup>
                            </select>
                                
                            <!--
                                Laagste level wordt meegenomen
                                Laten zien van de rubrieknaam en de bovenste level van dit rubriek zodat het beter is voor dubbele namen
                            -->
                        </div>	

                        <div class="medium-12 cell beschrijving">
                            <label>Beschrijving:</label>
                            <textarea rows="3" name="beschrijving_product" onKeyDown="charLimit(this.form.limitedtextarea,this.form.countdown,100);" required></textarea>
                        </div>

                        <div class="medium-12 cell">
							<label>Startprijs:</label>
							<input type="number" name="startprijs"  min="0.01" max="10000.00" step="0.01" required>
						</div>

                        <div class="medium-12 cell">
                            <label> Voeg foto's toe</label>
                            <input type="file" name="upfile" id="upfile"  accept="image/*" multiple="" required>
						</div>
		
						<div class="medium-12 cell">
                            <label> Betaalmethode </label>
                            <select class = "meerkeuzevak" name="betaal_methode" required>
                                <option value="-1">Kies een betaalmethode...</option>
                                <option value="iDeal">iDeal</option>
                                <option value="PayPal">PayPal</option>
                                <option vlaue="Creditcard">Creditcard</option>
                                <option value="ZelfOphalen">Zelf ophalen</option>
                            </select>
						</div>
                        <div class="medium-12 cell">
							<label>Betalingsinstructie: (Optioneel)</label>
							<input type="text" name="betalingsinstructie" >
						</div>
						
						<div class="medium-12 cell">
							<label>Verzendkosten: (Optioneel)</label>
							<input type="text" name="verzendkosten" >
						</div>
						
						<div class="medium-12 cell">
							<label>Verzend details: (Optioneel)</label>
							<input type="text" name="verzend_details" >                    
						</div>
						<div class="medium-12 cell">
                            <label> Looptijd: </label>
                            <select class = "meerkeuzevak" name="loopdag"> 
                                <option value="1">1 Dag</option>
                                <option value="3">3 Dagen</option>
                                <option value="5">5 Dagen</option>
                                <option value="7" selected>7 Dagen</option>
                                <option value="10">10 Dagen</option>                             
                            </select>
                        </div>				
					</div>
                    <div class="medium-12 cell">
                    <input type="submit" class="veilingknop button" name="plaatsen_voorwerp" value="Plaatsen" onclick="location.href = 'index.php';">
                </div>
            </div>
        </form>
    </div>
</div>
<?php 
    include_once 'aanroepingen/footer.html';
?>