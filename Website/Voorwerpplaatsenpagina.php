<?php
      $config = ['pagina' => 'voorwerpplaatsenpagina'];
      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';
    ?>

<div class="holy-grail-middle">
			<br>
			<h2 class="HomepaginaKopjes center">Voorwerp Plaatsen</h2>
			<div class="body-tekst">
				<p class="center">Op deze pagina kan er een voorwerp worden geplaatst</p>
				<form action="registratie_persoonsgegevens.php" method="post" class="form-body-center" >
					<div class="grid-container">
						<div class="grid-x grid-padding-x">
							<div class="medium-12 cell">
								<label>Titel product:</label>
								<input type="text" placeholder="Titel van uw product" name="titel" required>
                            </div>
                            <div class="medium-12 cell">
                            <label> Rubriek: </label>
                            <select class = "meerkeuzevak"> 
                                <option>Rubriek</option>
                                <option>Rubriek1</option>
                                <option>Rubriek2</option>
                                <option>Rubriek3</option>
                                <option>Rubriek4</option>
                            </select>
                            <select class = "meerkeuzevak"> 
                                <option>SubRubriek</option>
                                <option>Rubriek1</option>
                                <option>Rubriek2</option>
                                <option>Rubriek3</option>
                                <option>Rubriek4</option>
                            </select>
                            <select class = "meerkeuzevak"> 
                                <option>SubSubRubriek</option>
                                <option>Rubriek1</option>
                                <option>Rubriek2</option>
                                <option>Rubriek3</option>
                                <option>Rubriek4</option>
                            </select>
                            <select class = "meerkeuzevak"> 
                                <option>SubSubSubRubriek</option>
                                <option>Rubriek1</option>
                                <option>Rubriek2</option>
                                 <option>Rubriek3</option>
                                <option>Rubriek4</option>
                            </select>
                        </div>					
                            <div class="medium-12 cell beschrijving">
                                <label>Beschrijving:</label>
								    <input type="text" placeholder="Beschrijving van uw product" name="Beschrijving" required>
                            </div>
						
							<div class="medium-12 cell">
                                <label> Voeg foto's toe </label>
                                <form action="/action_page.php">
                                <input type="file" name="pic" accept="image/*">
                                </form>
							</div>
		
							<div class="medium-12 cell">
                                <label> Betaalmethode </label>
                                    <select class = "meerkeuzevak">
                                        <option>Kies een betaalmethode...</option>
                                        <option>iDeal</option>
                                        <option>PayPal</option>
                                    </select>
							</div>
						
							<div class="medium-12 cell">
								<label>Verzendkosten:</label>
								<input type="text" name="verzendkosten" required>
							</div>
						
							<div class="medium-12 cell">
								<label>Verzend details:</label>
								<input type="text" name="verzend details" required>                    
							</div>
						    <div class="medium-12 cell">
                                <label> Looptijd: </label>
                                    <select class = "meerkeuzevak"> 
                                         <option>Looptijd in dagen...</option>
                                         <option>2 Dagen</option>
                                         <option>3 Dagen</option>
                                         <option>5 Dagen</option>
                                         <option>10 Dagen</option>
                                    </select>
                                </div>				
						    </div>
                        </div>
                    <div class="medium-12 cell">
                        <button type="submit" class="veilingknop button" name="login"> Veilen </button>
                </div>
            </div>
        </div>
<?php 
      include_once 'aanroepingen/footer.html';
?>