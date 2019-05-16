<?php
      $config = ['pagina' => 'voorwerpplaatsenpagina'];
      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';

      //als ingelogd $gebruikersnaam = $_SESSION['gebruikersnaam']; $plaatsnaam = $_SESSION['plaatsnaam'] $landnaam = $_SESSION['landnaam'];
      //gaat naar de database

      //indicator = niet veilig is niet gesloten
    
      if(isset($_POST['plaatsen_voorwerp'])){
        $_SESSION['titel_product'] = $_POST['titel_product'];
        $_SESSION['beschrijving_product'] = $_POST['beschrijving_product'];
        $_SESSION['startprijs'] = $_POST['startprijs'];
        $_SESSION['laagste_rubriek'] = $_POST['laagste_rubriek'];
        if(empty($_POST['verzendkosten'] || $_POST['verzend_details'] || $_POST['betalingsinstructie']) ){
            $_SESSION['verzendkosten'] = $_POST['verzendkosten'];
            $_SESSION['verzend_details'] = $_POST['verzend_details'];
            $_SESSION['betalingsinstructie'] = $_POST['betalingsinstructie'];
        }else{
            $_SESSION['verzendkosten'] = "-";
            $_SESSION['verzend_details'] = "-";
            $_SESSION['betalingsinstructie'] = "-";
        } 
        if($_POST['betaal_methode'] == -1){
            echo"Vul a.u.b";
        }else{
           $_SESSION['betaal_methode'] = $_POST['betaal_methode']; 
        }
        
        $_SESSION['loopdag'] = $_POST['loopdag'];
    


        echo $_SESSION['titel_product'] . $_SESSION['beschrijving_product'] . $_SESSION['startprijs'] . $_SESSION['laagste_rubriek'] . $_SESSION['verzendkosten'] . $_SESSION['verzend_details'] . $_SESSION['betaal_methode'] . $_SESSION['betalingsinstructie'] . $_SESSION['loopdag'];

        //Rubriek op laagste niveau moet worden genoteerd
        //echo nieuwe selectie box als er meerdere sub rubrieken zijn
        //zoek naar rubrieknummer OP "-" en tot e hoogste volgnummer is eerste rubrieken box
        //daarna als erop is geklikt dan rubrieknummer OP , het nummer van deze rubriek en alle volgnummers daar van aangegeven
        //enzovoort tot dat er geen sub rubrieken zijn dan geef het gekozen rubrieknummer en deze invullen als value='rubrieknummer'


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

<div class="holy-grail-middle">
<h1>DEZE PAGINA IS IN BEWERKING</h1>
			<br>
			<h2 class="HomepaginaKopjes center">Voorwerp Plaatsen</h2>
			<div class="">
				<p class="center">Op deze pagina kan er een voorwerp worden geplaatst, vul a.u.b. alle gegevens in.</p>
				<form action="Voorwerpplaatsenpagina.php" method="post"  >
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
                                    <input type="file" name="pic" accept="image/*" required>
							</div>
		
							<div class="medium-12 cell">
                                <label> Betaalmethode </label>
                                    <select class = "meerkeuzevak" name="betaal_methode" required>
                                        <option value="">Kies een betaalmethode...</option>
                                        <option value="2">iDeal</option>
                                        <option value="3">PayPal</option>
                                        <option value="4">Zelf ophalen</option>
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