<?php
      $config = ['pagina' => 'voorwerpplaatsenpagina'];
      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';


      //als ingelogd $gebruikersnaam = $_SESSION['gebruikersnaam']; $plaatsnaam = $_SESSION['plaatsnaam'] $landnaam = $_SESSION['landnaam'];
      //gaat naar de database

    

      //indicator = niet veilig is niet gesloten

      if(isset($_SESSION['verkoper']) != true){
       echo '<script type="text/javascript">
          window.location = "inlogpagina.php"
        </script>';
     
      }

      try{

        if(isset($_POST['plaatsen_voorwerp'])){

            $titel_product = $_POST['titel_product'];
            //$foto_product = $_POST['fileToUpload'];


            $beschrijving_product = $_POST['beschrijving_product'];
            $startprijs = $_POST['startprijs'];
            $laagste_rubriek = $_POST['laagste_rubriek'];


            if(empty($_POST['verzendkosten']) ){
                $verzendkosten = "Geen";
            }else{
                $verzendkosten = $_POST['verzendkosten'];
            } 

            if(empty($_POST['verzend_details'])){
                $verzendinstructie = "Geen";
            }else{
                $verzendinstructie = $_POST['verzend_details'];
            }

            if(empty($_POST['betalingsinstructie'])){
                $betalingsinstructie = "Geen";
            }else{
                $betalingsinstructie = $_POST['betalingsinstructie'];
            }

            if($_POST['betaal_methode'] == -1){
                echo"Vul a.u.b";
            }else{
                $betalingswijze = $_POST['betaal_methode']; 
            }

            $looptijd = $_POST['loopdag'];

            //Foto's uploaden

            try{
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
                        ),
                        true
                    )) {
                        throw new RuntimeException('Bestand niet geldig.');
                    }
                    //Verplaatsen van afbeeldingen, hier wordt ook de lange unieke naam gegenergeerd met sha1_file en samengevoegd met sprintf
                    
                    if (!move_uploaded_file( 
                        $_FILES['upfile']['tmp_name'],
                        sprintf('./Images/%s.%s',
                        sha1_file($_FILES['upfile']['tmp_name']),  $ext)                
                    )) {
                        throw new RuntimeException('Kan bestand niet verplaatsen.');
                    }
                    
                    $filenaam = $_FILES['upfile']['name'];

                    $sql_foto = "INSERT INTO bestand (filenaam, voorwerp) VALUES (:filenaam, :voorwerp)";
                    $query_foto = $dbh->prepare($sql_foto);
                    $query_foto -> execute(array(':filenaam' => $filenaam, ':voorwerp' => 5));
                

                    //echo 'Bestand is succesful geupload.';
                    
                   
                  // echo "bestand: ". 
                  // "<img src='Images\ " .$filenaam. "'>"; 
                   // echo $filenaam ;
                   


            } catch (RuntimeException $e) {

                 echo $e->getMessage();

            }


            $sql_product = "INSERT INTO voorwerp (titel,beschrijving,startprijs,betalingswijze,betalingsinstructie,plaatsnaam,land,looptijd,looptijdbeginDag,looptijdbeginTijdstip,verzendkosten ,verzendinstructies ,looptijdeindeTijdstip,veilingGesloten,verkoper) 
            VALUES (:titel ,:beschrijving ,:startprijs ,:betalingswijze ,:betalingsinstructie ,:plaatsnaam ,:land ,:looptijd ,GETDATE() ,CURRENT_TIMESTAMP ,:verzendkosten ,:verzendinstructie ,CURRENT_TIMESTAMP ,'niet',:verkoper)";
            $query_product = $dbh->prepare($sql_product);
            $query_product -> execute(array(
                ':titel' => $titel_product, 
                ':beschrijving' => $beschrijving_product,
                ':startprijs' => $startprijs,
                ':betalingswijze' => $betalingswijze,
                ':betalingsinstructie' => $betalingsinstructie,
                ':plaatsnaam'=> 'plaatsnaam',
                ':land' => 'Nederland',
                ':looptijd' => $looptijd,
                ':verzendkosten' => $verzendkosten,
                ':verzendinstructie' => $verzendinstructie,
                ':verkoper' => 'Test123'

        ));

        //Rubriek op laagste niveau moet worden genoteerd
        //echo nieuwe selectie box als er meerdere sub rubrieken zijn
        //zoek naar rubrieknummer OP "-" en tot e hoogste volgnummer is eerste rubrieken box
        //daarna als erop is geklikt dan rubrieknummer OP , het nummer van deze rubriek en alle volgnummers daar van aangegeven
        //enzovoort tot dat er geen sub rubrieken zijn dan geef het gekozen rubrieknummer en deze invullen als value='rubrieknummer'

        //Foto's toevoegen


        }

    }catch (RuntimeException $e) {

        echo $e->getMessage();

    }

    
      
      

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

<!--<img src='Images\1b939c49359f68293b655198611803a5df0b66f1.png'>-->


<div class="holy-grail-middle">
<h1>DEZE PAGINA IS IN BEWERKING</h1>
			<br>
			<h2 class="HomepaginaKopjes center">Voorwerp Plaatsen</h2>
			<div class="">
				<p class="center">Op deze pagina kan er een voorwerp worden geplaatst, vul a.u.b. alle gegevens in.</p>
				<form action="Voorwerpplaatsenpagina.php" method="post" enctype="multipart/form-data"  >
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
                        <Input type="submit" class="veilingknop button" name="plaatsen_voorwerp" value="Plaatsen">
                    </div>
                    </div>
              </form>
            </div>
        </div>
<?php 
      include_once 'aanroepingen/footer.html';
?>