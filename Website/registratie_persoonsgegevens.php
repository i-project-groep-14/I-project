		<?php
			$config = ['pagina' => 'registratie_persoonsgegevens'];
			
			require_once 'aanroepingen/connectie.php';
			
			if(!isset($_SESSION)) {
				session_start();
			}

			if($_SESSION['email'] == NULL) {
				$message = "U heeft de rechten niet om deze pagina te gebruiken!";
				echo ("<script 
					LANGUAGE='JavaScript'>
					window.alert('$message');
					window.location.href='registratie_email.php';
				</script>");
			}
			
			if(isset($_POST['verzenden_pers'])){
				$sql = "SELECT gebruikersnaam FROM gebruiker 
						WHERE gebruikersnaam like :gebruikersnaam";
				$query = $dbh->prepare($sql);
				$query -> execute(array(
					':gebruikersnaam' => strip_tags($_POST['gebruikersnaam'])
				));
				$row = $query -> fetch();
				if($_POST['gebruikersnaam'] != $row['gebruikersnaam']) {
					//constraints
					$verkopermelding = false;
					if (strlen($_POST['gebruikersnaam']) > 20) {
						$melding = "
						<div data-closable class='callout alert-callout-border alert radius'>
						<strong>Error</strong> - Het aantal karakters van uw gebruikersnaam is te groot. Het maximale toegestane aantal karakters is 20.
						<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
							<span aria-hidden='true'>&times;</span>
						</button>
						</div>";
					} else if (strlen($_POST['voornaam']) > 20) {
						$melding = "
						<div data-closable class='callout alert-callout-border alert radius'>
						<strong>Error</strong> - Het aantal karakters van uw voornaam is te groot. Het maximale toegestane aantal karakters is 20.
						<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
							<span aria-hidden='true'>&times;</span>
						</button>
						</div>";
					} else if (strlen($_POST['achternaam']) > 20) {
						$melding = "
						<div data-closable class='callout alert-callout-border alert radius'>
						<strong>Error</strong> - Het aantal karakters van uw achternaam is te groot. Het maximale toegestane aantal karakters is 20.
						<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
							<span aria-hidden='true'>&times;</span>
						</button>
						</div>";
					} else if (strlen($_POST['adres']) > 20) {
						$melding = "
						<div data-closable class='callout alert-callout-border alert radius'>
						<strong>Error</strong> - Het aantal karakters van uw eerste adres is te groot. Het maximale toegestane aantal karakters is 20.
						<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
							<span aria-hidden='true'>&times;</span>
						</button>
						</div>";
					} else if (isset($_POST['oAdres']) && strlen($_POST['oAdres']) > 20) {
						$melding = "
						<div data-closable class='callout alert-callout-border alert radius'>
						<strong>Error</strong> - Het aantal karakters van uw tweede adres is te groot. Het maximale toegestane aantal karakters is 20.
						<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
							<span aria-hidden='true'>&times;</span>
						</button>
						</div>";
					} else if (strlen($_POST['postcode']) > 7) {
						$melding = "
						<div data-closable class='callout alert-callout-border alert radius'>
						<strong>Error</strong> - Het aantal karakters van uw postcode is te groot. Het maximale toegestane aantal karakters is 7.
						<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
							<span aria-hidden='true'>&times;</span>
						</button>
						</div>";
					} else if (strlen($_POST['postcode']) < 4) {
						$melding = "
						<div data-closable class='callout alert-callout-border alert radius'>
						<strong>Error</strong> - Het aantal karakters van uw postcode is te klein. Het minimale aantal karakters is 4.
						<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
							<span aria-hidden='true'>&times;</span>
						</button>
						</div>";
					} else if (strlen($_POST['plaats']) > 20) {
						$melding = "
						<div data-closable class='callout alert-callout-border alert radius'>
						<strong>Error</strong> - Het aantal karakters van uw plaatsnaam is te groot. Het maximale toegestane aantal karakters is 20.
						<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
							<span aria-hidden='true'>&times;</span>
						</button>
						</div>";
					} else if (strlen($_POST['land']) > 20) {
						$melding = "
						<div data-closable class='callout alert-callout-border alert radius'>
						<strong>Error</strong> - Het aantal karakters van uw land is te groot. Het maximale toegestane aantal karakters is 20.
						<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
							<span aria-hidden='true'>&times;</span>
						</button>
						</div>";
					} else if (strlen($_POST['telnr1']) > 11) {
						$melding = "
						<div data-closable class='callout alert-callout-border alert radius'>
						<strong>Error</strong> - Het aantal karakters van uw eerste telefoonnummer is te groot. Het maximale toegestane aantal karakters is 11.
						<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
							<span aria-hidden='true'>&times;</span>
						</button>
						</div>";
					} else if (!preg_match('/[0-9]/', $_POST['telnr1'])) {
						$melding = "
						<div data-closable class='callout alert-callout-border alert radius'>
						<strong>Error</strong> - Uw eerste telefoonnummer moet cijfers bevatten.
						<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
							<span aria-hidden='true'>&times;</span>
						</button>
						</div>";
					} else if (strlen($_POST['telnr1']) < 10) {
						$melding = "
						<div data-closable class='callout alert-callout-border alert radius'>
						<strong>Error</strong> - Het aantal karakters van uw eerste telefoonnummer is te klein. U moet minimaal 10 karakters invoegen.
						<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
							<span aria-hidden='true'>&times;</span>
						</button>
						</div>";
					} else if (isset($_POST['telnr2']) && strlen($_POST['telnr2']) > 11) {
						$melding = "
						<div data-closable class='callout alert-callout-border alert radius'>
						<strong>Error</strong> - Het aantal karakters van uw tweede telefoonnummer is te groot. Het maximale toegestane aantal karakters is 11.
						<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
							<span aria-hidden='true'>&times;</span>
						</button>
						</div>";
					} else if ($_POST['telnr2'] != NULL && !preg_match('/[0-9]/', $_POST['telnr2'])) {
						$melding = "
						<div data-closable class='callout alert-callout-border alert radius'>
						<strong>Error</strong> - Uw tweede telefoonnummer moet cijfers bevatten.
						<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
							<span aria-hidden='true'>&times;</span>
						</button>
						</div>";
					} else if ($_POST['telnr2'] != NULL && strlen($_POST['telnr2']) < 10) {
						$melding = "
						<div data-closable class='callout alert-callout-border alert radius'>
						<strong>Error</strong> - Het aantal karakters van uw tweede telefoonnummer is te klein. U moet minimaal 10 karakters invoegen.
						<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
							<span aria-hidden='true'>&times;</span>
						</button>
						</div>";
					} else if ($_POST['geboortedatum'] > date("Y-m-d")) {
						$melding = "
						<div data-closable class='callout alert-callout-border alert radius'>
						<strong>Error</strong> - De datum is ouder dan vandaag.
						<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
							<span aria-hidden='true'>&times;</span>
						</button>
						</div>";
					} else if (strlen($_POST['wachtwoord']) < 7) {
						$melding = "
						<div data-closable class='callout alert-callout-border alert radius'>
						<strong>Error</strong> - Het wachtwoord moet 7 of meer karakters hebben.
						<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
							<span aria-hidden='true'>&times;</span>
						</button>
						</div>";
					} else if (!(preg_match('/[A-Za-z]/', $_POST['wachtwoord']) && preg_match('/[0-9]/', $_POST['wachtwoord']))) {
						$melding = "
						<div data-closable class='callout alert-callout-border alert radius'>
						<strong>Error</strong> - Het wachtwoord moet minimaal 1 letter en 1 nummer hebben.
						<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
							<span aria-hidden='true'>&times;</span>
						</button>
						</div>";
					} else {
						if ($_POST['eenVerkoper'] == 3) {
							if (strlen($_POST['verkoopgegevens-rekeningnr']) > 30) {
								$melding = "
								<div data-closable class='callout alert-callout-border alert radius'>
									<strong>Error</strong> - Het aantal karakters van uw rekeningnummer is te groot. Het maximale toegestane aantal karakters is 30.
									<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
										<span aria-hidden='true'>&times;</span>
									</button>
								</div>";
								// hashen!!!!!
								$verkopermelding = true;
							} else if (!preg_match('/[0-9]/', $_POST['verkoopgegevens-rekeningnr'])) {
								$melding = "
								<div data-closable class='callout alert-callout-border alert radius'>
									<strong>Error</strong> - Uw rekeningnummer moet cijfers bevatten.
									<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
										<span aria-hidden='true'>&times;</span>
									</button>
								</div>";
								$verkopermelding = true;
							} else if (strlen($_POST['verkoopgegevens-rekeningnr']) < 18) {
								$melding = "
								<div data-closable class='callout alert-callout-border alert radius'>
									<strong>Error</strong> - Uw rekeningnummer moet minimaal 18 karakters bevatten.
									<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
										<span aria-hidden='true'>&times;</span>
									</button>
								</div>";
								$verkopermelding = true;
							} else if (strlen($_POST['verkoopgegevens-bank']) > 20) {
								$melding = "
								<div data-closable class='callout alert-callout-border alert radius'>
									<strong>Error</strong> - Het aantal karakters van uw bank is te groot. Het maximale toegestane aantal karakters is 20.
									<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
										<span aria-hidden='true'>&times;</span>
									</button>
								</div>";
								$verkopermelding = true;
							} else if (!isset($_POST['controle'])) {
								$melding = "
								<div data-closable class='callout alert-callout-border alert radius'>
									<strong>Error</strong> - U moet een controle-optie selecteren.
									<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
										<span aria-hidden='true'>&times;</span>
									</button>
								</div>";
								$verkopermelding = true;
							} else if ($_POST['controle'] == 'creditcard' && strlen($_POST['creditcardnummer']) > 30) {
								$melding = "
								<div data-closable class='callout alert-callout-border alert radius'>
									<strong>Error</strong> - Het aantal karakters van uw creditcardnummer is te groot. Het maximale toegestane aantal karakters is 20.
									<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
										<span aria-hidden='true'>&times;</span>
									</button>
								</div>";
								$verkopermelding = true;
							} else if ($_POST['controle'] == 'creditcard' && !preg_match('/[0-9]/', $_POST['creditcardnummer'])) {
								$melding = "
								<div data-closable class='callout alert-callout-border alert radius'>
									<strong>Error</strong> - Uw creditcard moet een nummer bevatten.
									<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
										<span aria-hidden='true'>&times;</span>
									</button>
								</div>";
								$verkopermelding = true;
							} else if ($_POST['controle'] == 'creditcard' && strlen($_POST['creditcardnummer']) < 16) {
								$melding = "
								<div data-closable class='callout alert-callout-border alert radius'>
									<strong>Error</strong> - Het aantal karakters van uw creditcardnummer is te klein. Het minimale aantal karakters is 16.
									<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
										<span aria-hidden='true'>&times;</span>
									</button>
								</div>";
								$verkopermelding = true;
							}
						}
						// echo "test1";
						if ($verkopermelding == false) {
							// echo "test";
							// wachtwoord check
							if($_POST['wachtwoord'] == $_POST['bWachtwoord']) {
								if ($_POST['eenVerkoper'] == 3) {
									// if (strlen($_POST['verkoopgegevens-rekeningnr']) > 30) {
									// 	$melding = "
									// 	<div data-closable class='callout alert-callout-border alert radius'>
									// 	<strong>Error</strong> - Het aantal karakters van uw rekeningnummer is te groot. Het maximale toegestane aantal karakters is 30.
									// 	<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
									// 		<span aria-hidden='true'>&times;</span>
									// 	</button>
									// 	</div>";
									// 	// hashen!!!!!
									// } else if (strlen($_POST['verkoopgegevens-bank']) > 20) {
									// 	$melding = "
									// 		<div data-closable class='callout alert-callout-border alert radius'>
									// 		<strong>Error</strong> - Het aantal karakters van uw bank is te groot. Het maximale toegestane aantal karakters is 20.
									// 		<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
									// 			<span aria-hidden='true'>&times;</span>
									// 		</button>
									// 		</div>";
									// } else {
									// 	if ($_POST['controle'] == 'creditcard' && strlen($_POST['creditcardnummer']) > 30) {
									// 		$melding = "
									// 		<div data-closable class='callout alert-callout-border alert radius'>
									// 		<strong>Error</strong> - Het aantal karakters van uw creditcardnummer is te groot. Het maximale toegestane aantal karakters is 20.
									// 		<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
									// 			<span aria-hidden='true'>&times;</span>
									// 		</button>
									// 		</div>";
									// 	} else {
											$_SESSION['rekeningnummer'] = strip_tags($_POST['verkoopgegevens-rekeningnr']);
											$_SESSION['bank'] = strip_tags($_POST['verkoopgegevens-bank']);
											$_SESSION['controlepost'] = strip_tags($_POST['controle']);
											if(isset($_POST['creditcardnummer'])) {
												$_SESSION['creditcardnummer'] = strip_tags($_POST['creditcardnummer']);
											} //else {
											// 	$_SESSION['creditcardnummer'] = NULL;
											// }
											// echo $_SESSION['rekeningnummer'];
											// echo $_SESSION['bank'];
											// echo $_SESSION['controlepost'];
											// echo $_SESSION['creditcardnummer'];
										// }
									// }
								}

								$_SESSION['gebruikersnaam'] = strip_tags($_POST['gebruikersnaam']);
								$_SESSION['voornaam'] = strip_tags($_POST['voornaam']);
								$_SESSION['achternaam'] = strip_tags($_POST['achternaam']);
								$_SESSION['adres'] = strip_tags($_POST['adres']);
								if(isset($_POST['oAdres'])) {
									$_SESSION['oAdres'] = strip_tags($_POST['oAdres']);
								}
								$_SESSION['postcode'] = strip_tags($_POST['postcode']);
								$_SESSION['plaats'] = strip_tags($_POST['plaats']);
								$_SESSION['land'] = strip_tags($_POST['land']);
								$_SESSION['telnr1'] = strip_tags($_POST['telnr1']);
								if(isset($_POST['telnr2'])) {
									$_SESSION['telnr2'] = strip_tags($_POST['telnr2']);
								}
								$_SESSION['geboortedatum'] = strip_tags($_POST['geboortedatum']);
								$_SESSION['wachtwoord'] = strip_tags($_POST['wachtwoord']);
								if(isset($_POST['eenVerkoper'])) {
									$_SESSION['eenVerkoper'] = strip_tags($_POST['eenVerkoper']);
								} else {
									$_SESSION['eenVerkoper'] = 2;
								}
								header('Location: registratie_vraag.php');
							} else {
								$melding = "
								<div data-closable class='callout alert-callout-border alert radius'>
									<strong>Error</strong> - De wachtwoorden komen niet met elkaar overeen.
									<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
										<span aria-hidden='true'>&times;</span>
									</button>
								</div>
								";
							}
						}
					}
				} else {
					$melding = "
					<div data-closable class='callout alert-callout-border alert radius'>
						<strong>Error</strong> - Gebruikersnaam is al in gebruik.
						<button class='close-button' aria-label='Dismiss alert' type='button' data-close>
							<span aria-hidden='true'>&times;</span>
						</button>
					</div>
					";
				}
			}

			include_once 'aanroepingen/header.php';
		?>
		
		<div class="holy-grail-middle">
			<?php
				include_once 'aanroepingen/registratie_progressbar.php';
			?>  
			<br>
			
			<h2 class="HomepaginaKopjes center">Registreren</h2>
			<div class="body-tekst">
				<p class="center">Dit is de tweede stap van het registreren. Vul a.u.b uw persoonlijkegegevens hieronder in.</p>
				<?php 
					if(isset($melding)) {
						echo "<br>";
						echo $melding; 
						echo "<br>";
					}
				?>
				<form action="registratie_persoonsgegevens.php" method="post" class="form-body-center" >
					<div class="grid-container">
						<div class="grid-x grid-padding-x">
							<div class="medium-12 cell">
								<label>Gebruikersnaam:</label>
								<input type="text" placeholder="Gebruikersnaam" name="gebruikersnaam" value="<?php  if(isset($_POST['gebruikersnaam'])) { echo strip_tags($_POST['gebruikersnaam']);} ?>" required>
							</div>
						
							<div class="medium-6 cell">
								<label>Voornaam:</label>
								<input  type="text" placeholder="Voornaam" name="voornaam" value="<?php  if(isset($_POST['voornaam'])) { echo strip_tags($_POST['voornaam']);} ?>" required>
							</div> 
						
							<div class="medium-6 cell">
								<label>Achternaam:</label>
								<input type="text" placeholder="Achternaam" name="achternaam" value="<?php  if(isset($_POST['achternaam'])) { echo strip_tags($_POST['achternaam']);} ?>" required>
							</div>
						
							<div class="medium-6 cell">
								<label>Adres:</label>
								<input type="text" placeholder="Adres" name="adres" value="<?php  if(isset($_POST['adres'])) { echo strip_tags($_POST['adres']);} ?>" required>
							</div>
						
							<div class="medium-6 cell">
								<label>
									Toevoeging Adres (Optioneel): 
									<span class="tooltip">Meer info?
										<span class="tooltiptext">Dit is een extra adres regel voor mensen die buiten Nederland wonen.</span>
									</span>
								</label>
								<input type="text" placeholder="Tweede adres" name="oAdres" value="<?php  if(isset($_POST['oAdres'])) { echo strip_tags($_POST['oAdres']);} ?>">
							</div>
						
							<div class="medium-4 cell">
								<label>Postcode:</label>
								<input type="text" placeholder="Postcode" name="postcode" value="<?php  if(isset($_POST['postcode'])) { echo strip_tags($_POST['postcode']);} ?>" required>
							</div>
						
							<div class="medium-4 cell">
								<label>Plaatsnaam:</label>
								<input type="text" placeholder="Plaats" name="plaats" value="<?php  if(isset($_POST['plaats'])) { echo strip_tags($_POST['plaats']);} ?>" required>
							</div>
						
							<div class="medium-4 cell">
								<label>Landsnaam:</label>
								<input type="text" placeholder="Land" name="land" value="<?php  if(isset($_POST['land'])) { echo strip_tags($_POST['land']);} ?>" required>
							</div>
						
							<div class="medium-6 cell">
								<label>Telefoonnr:</label>
								<input type="tel" placeholder="Telefoonnr" name="telnr1" value="<?php  if(isset($_POST['telnr1'])) { echo strip_tags($_POST['telnr1']);} ?>" required>
							</div>
						
							<div class="medium-6 cell">
								<label>Telefoonnr 2 (Optioneel):</label>
								<input type="tel" placeholder="Telefoonnr" name="telnr2" value="<?php  if(isset($_POST['telnr2'])) { echo strip_tags($_POST['telnr2']);} ?>">
							</div>
						
							<div class="medium-12 cell">
								<label>Geboortedatum:</label>
								<input type="date" name="geboortedatum" value="<?php  if(isset($_POST['geboortedatum'])) { echo strip_tags($_POST['geboortedatum']);} ?>" required>
							</div>
						
							<div class="medium-12 cell">
								<label>Wachtwoord:</label>
								<input type="password" placeholder="Wachtwoord" name="wachtwoord" required>                    
							</div>
						
							<div class="medium-12 cell">
								<label>Bevestig Wachtwoord:</label>
								<input type="password" placeholder="Bevestig wachtwoord" name="bWachtwoord" required>
							</div>
						
							<fieldset class="fieldset medium-12 cell">
								<legend>Wilt u spullen verkopen?</legend>
								<input type="radio" name="eenVerkoper" value="3" id="wel" >
								<label class="side-label" for="wel">Wel</label> 
								<input type="radio" name="eenVerkoper" value="2" id="niet">
								<label for="niet">Niet</label>
						
								<div class="wel-verkopergegevens">
									<label>Rekeningnummer:</label>
									<input type="text" name="verkoopgegevens-rekeningnr" placeholder="Rekeningnummer" value="<?php  if(isset($_POST['verkoopgegevens-rekeningnr'])) { echo strip_tags($_POST['verkoopgegevens-rekeningnr']);} ?>">

									<label>Bank:</label>
									<input type="text" name="verkoopgegevens-bank" placeholder="Bank" value="<?php  if(isset($_POST['verkoopgegevens-bank'])) { echo strip_tags($_POST['verkoopgegevens-bank']);} ?>" >
									<p>
										Om uw verkopersaccount te activeren heeft u een code nodig. Deze code kan opgestuurd worden
										bij post of er wordt naar uw creditcard gegevens gevraagd. Maak een keuze hieronder.
									</p>

									<input type="radio" name="controle" value="creditcard" id="controle-creditcard">
									<label for="controle-creditcard" class="label-next side-label">Creditcard</label>
									<input type="radio" name="controle" value="post" id="controle-post">
									<label for="controle-post">Post</label>

									<div class="controle-creditcard-gegevens">
										<label for="creditcard-gegevens">Creditcardnummer</label>
										<input type="text" name="creditcardnummer" id="creditcard-gegevens" placeholder="Creditcardnummer" value="<?php  if(isset($_POST['creditcardnummer'])) { echo strip_tags($_POST['creditcardnummer']);} ?>">
									</div>
								</div>
							</fieldset>
						</div>
					</div>
						
					<div class="center">
						<p>Mocht u nu nog geen verkoper zijn, kunt u dit altijd later aanpassen.<p>
						<input class="button" type="submit" name="verzenden_pers" value="Verzenden">
					</div>
				</form>
			</div>
		</div>
		
		<?php 
		include_once 'aanroepingen/footer.html';
		?>