<?php
	
	/*
	// Automatise l'access-token, mais risque de bloquer l'utilisateur si trop de requêtes en même temps
	function get_token()
	{
		// Exécute le code java tokentest.jar
		exec("\"jdk-8.0.292.10-hotspot\\jre\\bin\\java.exe\" -jar tokentest.jar 2>&1", $output);
		// Retourne la valeur de access_token
		return ((array)json_decode($output[0]))['access_token'];
	}
	*/

	if(isset($_POST['id_pce']))
	{

	  // Exécute le code java declarer_droit_acces.jar
		$cmd = "\"jdk-8.0.292.10-hotspot\\jre\\bin\\java.exe\" -jar declarerdroitacces.jar \"" 
	   . $_POST['raison_socialeDDA'] . "\" \""  
	   . $_POST['code_postalDDA'] . "\" \"" 
	   . $_POST['courriel_titulaireDDA'] . "\" \"" 
	   . $_POST['date_consentement_declareeDDA'] . "\" \"" 
	   . $_POST['date_fin_autorisation_demandeeDDA'] . "\" \"" 
	   . $_POST['perim_donnees_techniques_et_contractuellesDDA'] . "\" \"" 
	   . $_POST['perim_historique_de_donneesDDA'] . "\" \"" 
	   . $_POST['perim_flux_de_donneesDDA'] . "\" \"" 
	   . $_POST['perim_donnees_informativesDDA'] . "\" \"" 
	   . $_POST['perim_donnees_publieesDDA']  . "\" \""
	   . $_POST['id_pceDDA'] . "\" \""
	   . $_POST['bearerDDA'] . "\""
	   . " 2>&1";

		exec($cmd, $output);
		// Retourne la valeur de access_token
		// $erreur = ((array)json_decode($output[0]))['message_retour_traitement'];
		// $erreur = var_dump($output[0]);
		// celui du dessus ne fonctionne pas ? faire ->
		$erreur = var_dump($output[0]);
	} else {
		$erreur = "";
		$cmd = "";
	}

?>

<div class="container my-3">
<h1 class="text-center">Déclarer un Droit d'Accès</h1>
</div>

<div class="container">
	<div class="row py-5">	
		<div class="col-6">
			<form method="POST" action="tabs.php">

				<!--Renseigner l'access_token-->
				<label>Insérer l'access_token : </label>
				<input type="text" id="bearerDDA" name="bearerDDA"/>
				<br/>

				<!--Insérer l'ID PCE du client-->
				<label>ID PCE : </label><br/>
				<input type="text" id="id_pceDDA" name="id_pceDDA"/>
				<br/>

				<!--Insérer le nom de l'entreprise-->
				<label>Raison Sociale : </label>
				<input type="text" id="raison_socialeDDA" name="raison_socialeDDA"/>
				<br/>

				<!--Insérer le Code Postal-->
				<label>Code Postal : </label>
				<input type="text" id="code_postalDDA" name="code_postalDDA"/>
				<br/>

				<!--Insérer l'adresse mail de l'entreprise-->
				<label>Adresse mail du Titulaire : </label>
				<input type="text" id="courriel_titulaireDDA" name="courriel_titulaireDDA"/>
				<br/>

				<!--Choisir la date du consentement déclarée-->
				<label>Date de Consentement Déclarée : </label>
				<input type="text" id="date_consentement_declareeDDA" name="date_consentement_declareeDDA"/>
				<br/>

				<!--Choisir la date de fin de l'autorisation demandée-->
				<label>Date de Fin de l'Autorisation Demandée : </label>
				<input type="text" id="date_fin_autorisation_demandeeDDA" name="date_fin_autorisation_demandeeDDA"/>
				<br/>

				<!--Choisir d'afficher les données techniques et contractuelles (vrai par défaut)-->
				<label>Afficher les Données Techniques et Contractuelles : </label>
				<br/>
				<input type="radio" id="perim_donnees_techniques_et_contractuellesDDA" name="perim_donnees_techniques_et_contractuellesDDA" value="vrai" checked/>
				<label for="vrai">Vrai</label>
				<input type="radio" id="perim_donnees_techniques_et_contractuellesDDA" name="perim_donnees_techniques_et_contractuellesDDA" value="faux"/>
				<label for="faux">Faux</label>
				<br/>

				<!--Choisir d'afficher l'historique de données (vrai par défaut)-->
				<label>Afficher l'Historique de Données : </label>
				<br/>
				<input type="radio" id="perim_historique_de_donneesDDA" name="perim_historique_de_donneesDDA" value="vrai" checked/>
				<label for="vrai">Vrai</label>
				<input type="radio" id="perim_historique_de_donneesDDA" name="perim_historique_de_donneesDDA" value="faux"/>
				<label for="faux">Faux</label>
				<br/>

				<!--Choisir d'afficher le flux de données (vrai par défaut)-->
				<label>Afficher le Flux de Données : </label>
				<br/>
				<input type="radio" id="perim_flux_de_donneesDDA" name="perim_flux_de_donneesDDA" value="vrai" checked/>
				<label for="vrai">Vrai</label>
				<input type="radio" id="perim_flux_de_donneesDDA" name="perim_flux_de_donneesDDA" value="faux"/>
				<label for="faux">Faux</label>
				<br/>

				<!--Choisir d'afficher les données informatives (vrai par défaut)-->
				<label>Afficher les Données Informatives : </label>
				<br/>
				<input type="radio" id="perim_donnees_informativesDDA" name="perim_donnees_informativesDDA" value="vrai" checked/>
				<label for="vrai">Vrai</label>
				<input type="radio" id="perim_donnees_informativesDDA" name="perim_donnees_informativesDDA" value="faux"/>
				<label for="faux">Faux</label>
				<br/>
				
				<!--Choisir d'afficher les données publiées (vrai par défaut)-->
				<label>Afficher les Données Publiées : </label>
				<br/>
				<input type="radio" id="perim_donnees_publieesDDA" name="perim_donnees_publieesDDA" value="vrai" checked/>
				<label for="vrai">Vrai</label>
				<input type="radio" id="perim_donnees_publieesDDA" name="perim_donnees_publieesDDA" value="faux"/>
				<label for="faux">Faux</label>
				<br/>

				<input type="submit" value="Terminer"/>
			</form> 
		</div>
	
		<div class="col-6">
			<p><?= $erreur ?></p>
		</div>
	</div>

	<div class="container">
		<div class="col-12">
			<p><?= $cmd ?></p>
		</div>
	</div>
</div>
<br/>
<br/>
<br/>
<br/>