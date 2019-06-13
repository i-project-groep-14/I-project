<?php
    $config = ['pagina' => 'voorwerpplaatsenpagina'];
    require_once 'aanroepingen/connectie.php';
    include_once 'aanroepingen/header.php';
     
     
    //indicator = niet veilig is niet gesloten
    

    $gebruikersnaam = $_SESSION['gebruikersnaam'];


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

            if (strlen($_POST['titel_product']) > 30) {
                $melding = "
                    <div data-closable class='callout alert-callout-border alert radius'>
                    <strong>Error</strong> - Het aantal karakters van de titel is te groot. Het maximale toegestane aantal karakters is 30.
                    <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>
                    ";
            } else if (!isset($_POST['rubriek'])) {
                $melding = "
                <div data-closable class='callout alert-callout-border alert radius'>
                    <strong>Error</strong> - U heeft geen rubriek ingegeven.
                    <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                ";
            } else if (isset($_POST['rubriek']) && !isset($_POST['sub-rubriek'])) {
                $melding = "
                <div data-closable class='callout alert-callout-border alert radius'>
                    <strong>Error</strong> - U heeft geen geldige rubriek ingegeven.
                    <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                ";
            } else if (isset($_POST['rubriek']) && isset($_POST['sub-rubriek']) && heeftSubriek($_POST['sub-rubriek']) && !isset($_POST['sub-sub-rubriek'])) {
                $melding = "
                <div data-closable class='callout alert-callout-border alert radius'>
                    <strong>Error</strong> - U heeft geen geldige rubriek ingegeven.
                    <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                ";
            } else if (strlen($_POST['beschrijving_product']) > 500) {
                $melding = "
                <div data-closable class='callout alert-callout-border alert radius'>
                <strong>Error</strong> - Het aantal karakters van de product beschrijving is te groot. Het maximale toegestane aantal karakters is 500.
                <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
                <span aria-hidden='true'>&times;</span>
                </button>
                </div>
                ";
            } else if (strlen($_POST['betalingsinstructie']) > 30) {
                $melding = "
                <div data-closable class='callout alert-callout-border alert radius'>
                <strong>Error</strong> - Het aantal karakters van de betalingsinstructie is te groot. Het maximale toegestane aantal karakters is 30.
                <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
                <span aria-hidden='true'>&times;</span>
                </button>
                </div>
                ";
            } else if (strlen($_POST['verzend_details']) > 100) { 
                $melding = "
                <div data-closable class='callout alert-callout-border alert radius'>
                <strong>Error</strong> - Het aantal karakters van de verzend details is te groot. Het maximale toegestane aantal karakters is 100.
                <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
                <span aria-hidden='true'>&times;</span>
                </button>
                </div>
                ";
            } else {
                $titel_product = strip_tags($_POST['titel_product']);
                //$foto_product = $_POST['fileToUpload'];

                $beschrijving_product = strip_tags($_POST['beschrijving_product']);
                $startprijs = strip_tags($_POST['startprijs']);
                
                
                if (empty($_POST['verzendkosten']) ) {
                    $verzendkosten = "Geen";
                } else {
                    $verzendkosten = $_POST['verzendkosten'];
                }

                if (empty($_POST['verzend_details'])) {
                    $verzendinstructie = "Geen";
                } else {
                    $verzendinstructie = $_POST['verzend_details'];
                }

                if (empty($_POST['betalingsinstructie'])) {
                    $betalingsinstructie = "Geen";
                } else {
                    $betalingsinstructie = $_POST['betalingsinstructie'];
                }

                if ($_POST['betaal_methode'] == -1) {
                    echo"Vul a.u.b";
                } else {
                    $betalingswijze = $_POST['betaal_methode']; 
                }

                $looptijd = $_POST['loopdag'];

                $laagste_rubriek = 1;
                if (isset($_POST['rubriek'])) { 
                    $laagste_rubriek = $_POST['rubriek'];
                } //else {
                //     $laagste_rubriek = 1;
                // }
                // $laagste_rubriek = $_POST['rubriek'];
                if(!empty($_POST['sub-rubriek']) ) {
                    $laagste_rubriek = $_POST['sub-rubriek'];
                } //else{
                //     if (isset($_POST['rubriek'])) {
                //         $laagste_rubriek = $_POST['rubriek'];
                //     } else {
                //         $laagste_rubriek = -1;
                //     }
                //     // $laagste_rubriek = $_POST['rubriek']; 
                // }

                if(!empty($_POST['sub-sub-rubriek']) ){
                    $laagste_rubriek = $_POST['sub-sub-rubriek'];
                }//else{
                //     $laagste_rubriek = $_POST['sub-rubriek'];
                // }

                if(!empty($_POST['sub-sub-sub-rubriek']) ){
                    $laagste_rubriek = $_POST['sub-sub-sub-rubriek']; 
                } //else if(empty($_POST['sub-sub-rubriek'])){
                    //$laagste_rubriek = $_POST['sub-rubriek'];
                //} else{
                    //$laagste_rubriek = $_POST['sub-sub-rubriek'];
                //}
                // echo $laagste_rubriek;

                $laagste_rubriek = $_POST['rubriek'];
                

                $sql = "SELECT gebruiker FROM verkoper WHERE gebruiker = :gebruiker ";
                $query = $dbh->prepare($sql);
                $query -> execute(array(
                    ':gebruiker' => $gebruikersnaam
                ));

                $row = $query -> rowCount();

                if($row == 0) {
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

                    $len = count($_FILES['upfile']['name']);
                    for($i = 0; $i < $len; $i++){

                    //Is dit bestand wel goed
                    if (!isset($_FILES['upfile']['error'][$i]) || is_array($_FILES['upfile']['error'][$i])) {
                        throw new RuntimeException('Invalid parameters.');
                    }

                    //De foutmelding voor boven
                    switch ($_FILES['upfile']['error'][$i]) {
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

                   //hoe groot het bestand kan zijn, in dit geval 2 mb
                   if ($_FILES['upfile']['size'][$i] > 20000000) {
                    throw new RuntimeException('Het bestand is te groot.');
                    }
                    
                    //Welke bestanden worden geaccepteert, gecheckt of deze eraan voldoen
                    $finfo = new finfo(FILEINFO_MIME_TYPE);
                    if (false === $ext = array_search(
                        $finfo->file($_FILES['upfile']['tmp_name'][$i]),
                        array(
                            'jpg' => 'image/jpeg',
                            'png' => 'image/png',
                            'gif' => 'image/gif',
                        ), true )) {
                        throw new RuntimeException('Bestand niet geldig.');
                    }
                    //Verplaatsen van afbeeldingen, hier wordt ook de lange unieke naam gegenergeerd met sha1_file en samengevoegd met sprintf
                        
                    $filenaam = sprintf('Images\%s.%s', sha1_file($_FILES['upfile']['tmp_name'][$i]),  $ext);
                    $aantal = 1;
                    while (file_exists($filenaam)) {
                        $filenaam = sprintf('Images\no'.$i.'%s.%s', sha1_file($_FILES['upfile']['tmp_name'][$i]).$aantal,  $ext);
                        $aantal++;
                        if($aantal == 150) {
                            $aantal = 1;
                            echo"Geef een andere naam aan het bestand!";
                        }
                    }


                    if (!$filenaam = sprintf('.\Images\no'.$i.'%s.%s', sha1_file($_FILES['upfile']['tmp_name'][$i]),  $ext)){
                        throw new RuntimeException('Kan bestand niet in de database zetten.');
                    }

                    if(!move_uploaded_file($_FILES['upfile']['tmp_name'][$i],$filenaam)){
                        //throw new RuntimeException('Kan bestand niet verplaatsen.');
                        echo"kan bestand niet verplaatsen";
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
                    $query_foto -> execute(array(
                        ':filenaam' => $filenaam, 
                        ':voorwerp' => $row['voorwerpnummer']
                    ));
                }
                
                $sql_rubriek = "INSERT INTO [voorwerp in rubriek] VALUES (:voorwerp, :laagste_rubriek)";
                $query_rubriek = $dbh->prepare($sql_rubriek);
                $query_rubriek -> execute(array(':voorwerp' => $row['voorwerpnummer'], ':laagste_rubriek' => $laagste_rubriek ));
                echo "<script> window.location.href = 'index.php' </script>";
            }
        }
    } catch (RuntimeException $e) {
        echo $e->getMessage();
    }

        $sql = "SELECT * FROM rubriek WHERE rubriek = 0 ORDER BY rubrieknummer"; //
        $query = $dbh->prepare($sql);
        $query -> execute();
    ?>


<div class="holy-grail-middle">
	<br>
	<h2 class="InlogpaginaKopje center">Voorwerp Plaatsen</h2>
		<div class="">
            <p class="center">Op deze pagina kan er een voorwerp worden geplaatst, vul a.u.b. alle gegevens in.</p>
                <?php 
                    if(isset($melding)) {
						echo "<br>";
						echo $melding; 
						echo "<br>";
                    }
                ?>
			<form action="Voorwerpplaatsenpagina.php" method="post" enctype="multipart/form-data">
				<div class="grid-container">
					<div class="grid-x grid-padding-x">
						<div class="medium-12 cell">
							<label>Titel product:</label>
							<input type="text" placeholder="Titel van uw product" name="titel_product" value="" maxlength="30" required>
                        </div>
                        <div class="medium-12 cell">
  
                            <label>Rubriek: </label>
                            
                            <select id="rubrieken" name="rubriek"  onchange="getSubRubriek(this.value);">
                                <option disabled selected>Kies een rubriek</option>
                            <?php 
                                while($data = $query -> fetch()){
                                   echo"<option value='".$data['rubrieknummer']."'>".$data['rubrieknaam']."</option>";
                                } 
                            ?>
                            </select>

                            <select id="sub-rubriek" name="sub-rubriek"  onchange="getSubSubRubriek(this.value);">
                            </select>

                            <select id="sub-sub-rubriek" name="sub-sub-rubriek" onchange="getSubSubSubRubriek(this.value);">
                            </select>

                            <select id="sub-sub-sub-rubriek" name="sub-sub-sub-rubriek">        
                            </select>
                            
                        </div>

                        <div class="medium-12 cell beschrijving">
                            <label>Beschrijving:</label>
                            <textarea rows="3" name="beschrijving_product" onKeyDown="charLimit(this.form.limitedtextarea,this.form.countdown,500);" maxlength="500" required></textarea>
                        </div>

                        <div class="medium-12 cell">
							<label>Startprijs:</label>
							<input type="number" name="startprijs"  min="0.01" max="10000.00" step="0.01" required>
						</div>

                        <div class="medium-12 cell">
                            <table id="table" width="50%">
                                <thead>
                                    <tr class="center">
                                        <th colspan="3"><label>Voeg foto's toe</label></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="add_row">
                                        <td id="no" width="5%">#</td>
                                        <td width="75%"><input class="file" onchange="ValidateFile(this)" name="upfile[]" type="file" required/></td>
                                        <td width="20%"></td>
                                    </tr>
                                </tbody>

                            </table>
                        

		                <button class="button" type="button" id="add" title='Voeg een bestand toe' value="toevoegen">Voeg nog een bestand toe</button>
                        </div>
						<div class="medium-12 cell">
                            <label >  Betaalmethode </label>
                            <select class = "meerkeuzevak" name="betaal_methode"  required>
                                <option disabled>Kies een betaalmethode...</option>
                                <option value="iDeal">iDeal</option>
                                <option value="PayPal">PayPal</option>
                                <option vlaue="Creditcard">Creditcard</option>
                                <option value="ZelfOphalen">Zelf ophalen</option>
                            </select>
						</div>
                        <div class="medium-12 cell">
							<label>Betalingsinstructie: (Optioneel)</label>
							<input type="text" name="betalingsinstructie" maxlength="30">
						</div>
						
						<div class="medium-12 cell">
							<label>Verzendkosten: (Optioneel)</label>
							<input type="number" name="verzendkosten" value="0" min="0" max="10000.00" step="0.01">
						</div>
						
						<div class="medium-12 cell">
							<label>Verzend details: (Optioneel)</label>
							<input type="text"  maxlength="100"  name="verzend_details" >                    
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
                    <input type="submit" class="veilingknop button submit" name="plaatsen_voorwerp" value="Plaatsen"  >
                </div>
            </div>
        </form>
    </div>
</div>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
    // Valideren
    $('.submit').click(function(){
        var file_val = $('.file').val();
        if(file_val == "")
        {
            alert("Kies a.u.b minstens één bestand.");
            return false;
        }
    });

    //toevoegen van rij met max aantal bestanden        
    var bestand = 0;
    var max = 3;
    $("#add").click(function(){
        bestand++;
        if(bestand <= max){ 
            $("tbody").append('<tr class="add_row"><td>#</td><td><input class="file"  onchange="ValidateFile(this)" name="upfile[]" type="file" required></td><td class="text-center"><button type="button" class="btn button btn-sm" id="delete" title="Verwijder bestand">Verwijder bestand</button></td><tr>');
        }
        if(bestand == max){
            $("#add").css("visibility", "hidden");
        }
    });
              
    // Verwijderen 
    $('#table').on('click', "#delete", function(e) {
        if (!confirm("Weet u zeker dat uw dit bestand wilt verwijderen?"))
        return false;
        $(this).closest('tr').remove();
        e.preventDefault();
        bestand--;
        $("#add").css("visibility", "visible");

    });
}); 


function ValidateFile(file) {
        var FileSize = file.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert('Bestand is groter dn 2MB. Geef a.u.b een kleiner bestand.');
            $(file).val(''); 
        } 
        var file = file.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            alert('Bestand is niet geldig');
            $(file).val(''); 
        }
    }
</script>

<script type="text/javascript"> 


function getSubRubriek(rubrieknummer){
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "get-rubrieken.php?rubrieknummer=" + rubrieknummer, true);
    ajax.send();

    ajax.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            var data = JSON.parse(this.responseText);
            if(data.length == 0){
                 var html = "";
            }else{
                var html = "<option disabled selected> Kies een subrubriek </option>";
            }

            for(var a = 0; a < data.length; a++){
                html += "<option value='" + data[a].rubrieknummer + "'>"+ data[a].rubrieknaam +"</option>";
            }
            
            document.getElementById("sub-rubriek").innerHTML = html;
        }

    };

}

function getSubSubRubriek(rubrieknummer){
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "get-rubrieken.php?rubrieknummer=" + rubrieknummer, true);
    ajax.send();

    ajax.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            var data = JSON.parse(this.responseText);
            if(data.length == 0){
                 var html = "";
            }else{
                var html = "<option disabled selected> Kies een subsubrubriek </option>";//"";
            }
                
            for(var a = 0; a < data.length; a++){
                html += "<option value='" + data[a].rubrieknummer + "'>"+ data[a].rubrieknaam +"</option>";
            }
            
            document.getElementById("sub-sub-rubriek").innerHTML = html;
        }

    };

}

function getSubSubSubRubriek(rubrieknummer){
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "get-rubrieken.php?rubrieknummer=" + rubrieknummer, true);
    ajax.send();

    ajax.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            var data = JSON.parse(this.responseText);
            if(data.length == 0){
                 var html = "";
            }else{
                var html = "<option disabled selected> Kies een subsubsubrubriek </option>";
            }
           //"<option disabled selected> Kies een subsubsubrubriek </option>";
           
                for(var a = 0; a < data.length; a++){
                 html += "<option value='" + data[a].rubrieknummer + "'>"+ data[a].rubrieknaam +"</option>";
                
            }

            document.getElementById("sub-sub-sub-rubriek").innerHTML = html;
        }

    };

}

</script>

<?php 
    include_once 'aanroepingen/footer.html';
?>