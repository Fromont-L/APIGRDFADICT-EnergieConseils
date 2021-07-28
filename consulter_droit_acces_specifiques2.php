<?php
	// Fonction pour respecter la convention JSON de l'API
	function convertir_liste($arr){
		if (is_array($arr)) {
			$resultatConvertion = "[";
			$isFirst = true;
			foreach($arr as $cb){
				if(!$isFirst) {
					$resultatConvertion .= ", ";
				}
				$resultatConvertion .= "\\\"" . $cb . "\\\"";
				$isFirst = false;
			}
			$resultatConvertion .= "]";
			return $resultatConvertion;
		} else {
			return "[]";
		}
	}
	
	/*
	// Automatise l'access-token, mais risque de bloquer l'utilisateur si trop de requêtes en même temps
	function get_token()
	{
		// Exécute le code java tokentest.jar
		exec("\"jdk-8.0.292.10-hotspot\\jre\\bin\\java.exe\" -jar tokentest.jar 2>&1", $output);
		// Retourne la valeur de access_token
		return ((array)json_decode(utf8_encode($output[0])))['access_token'];
	}
	*/

	if(isset($_POST['bearerCDAS']))
	{

		// Permet de faire une sélection parmi la liste de choix de role_tiers
		if(isset($_POST['role_tiersCDAS'])) {
			$role_tiers_list = convertir_liste($_POST['role_tiersCDAS']);
		} else {
			$role_tiers_list = "[]";
		}
		// Permet de faire une sélection parmi la liste de choix de etat_droit_acces
		if(isset($_POST['etat_droit_accesCDAS'])) {
			$etat_droit_acces_list = convertir_liste($_POST['etat_droit_accesCDAS']);
		} else {
			$etat_droit_acces_list = "[]";
		}	
		// Permet de faire une sélection parmi la liste de choix de statut_controle_preuve
		if(isset($_POST['statut_controle_preuveCDAS'])) {
			$statut_controle_preuve_list = convertir_liste($_POST['statut_controle_preuveCDAS']);
		} else {
			$statut_controle_preuve_list = "[]";
		}
		// Permet de faire une sélection parmi la liste des id_pce choisis (3 max.)
		$id_pce_CDAS_liste = array();
		if(isset($_POST['id_pceCDAS1']) && $_POST['id_pceCDAS1'] != "") {
			array_push($id_pce_CDAS_liste, $_POST['id_pceCDAS1']);
		}
		if(isset($_POST['id_pceCDAS2']) && $_POST['id_pceCDAS2'] != "") {
			array_push($id_pce_CDAS_liste, $_POST['id_pceCDAS2']);
		}
		if(isset($_POST['id_pceCDAS3']) && $_POST['id_pceCDAS3'] != "") {
			array_push($id_pce_CDAS_liste, $_POST['id_pceCDAS3']);
		}
			
			$id_pce_list = convertir_liste($id_pce_CDAS_liste);
		
		// Exécute le code java consulterdroitacces.jar
		$cmd = "\"jdk-8.0.292.10-hotspot\\jre\\bin\\java.exe\" -jar consulterdroitaccesspecifiques.jar"
		. " \"" . $role_tiers_list . "\""
		. " \"" . $etat_droit_acces_list . "\""
		. " \"" . $statut_controle_preuve_list . "\""
		. " \"" . $id_pce_list . "\""
		. " \"" . utf8_encode($_POST['bearerCDAS']) . "\"" 
		. " 2>&1";

		exec($cmd, $output);
		// Permet de savoir combien il y a de lignes dans la réponse (en enlever une parce que Java...)
		$tailleReponse = count($output) - 1;
		if($tailleReponse >= 2){
			// Retourne la valeur de la dernière ligne (retour traitement)
			$reponseCode = ((array)json_decode(utf8_encode($output[$tailleReponse - 1])));
			// $reponse = ((array)json_decode(utf8_encode($output[0])));
			// $reponseBrut = var_dump($output[2]);
			if(isset($reponseCode['code_statut_traitement']) && $reponseCode['code_statut_traitement'] == "0000000000"){
				$reponseEstPositive = true;
			} else {
				$reponseEstPositive = false;
			}
		}
		
	} else {
		$reponseEstPositive = false;
		$reponse = "";
		$cmd = "";
	}
?>

<div class="container my-3">
<h1 class="text-center">Consulter un Droit d'Accès Spécifiques</h1>
</div>
<div class="container">
	<div class="row py-5">	
		<div class="col-12">
			<form method="POST" action="tabs.php">

				<!--Renseigner l'access_token-->
				<label>Insérer l'access_token : </label>
				<input type="text" id="bearerCDAS" name="bearerCDAS"/>
				<br/>

				<!--Renseigner le role_tiers-->
				<div>
					<input type="checkbox" value="AUTORISE_CONTRAT_FOURNITURE" name="role_tiersCDAS[]">
					<label for="role_tiersCDAS[]">AUTORISE_CONTRAT_FOURNITURE</label>
					<input type="checkbox" value="DETENTEUR_CONTRAT_FOURNITURE" name="role_tiersCDAS[]">
					<label for="role_tiersCDAS[]">DETENTEUR_CONTRAT_FOURNITURE</label>
				</div>

				<!--Renseigner l'etat_droit_acces-->
				<div>
					<input type="checkbox" value="Active" name="etat_droit_accesCDAS[]">
					<label for="etat_droit_accesCDAS[]">Active</label>
					<input type="checkbox" value="A valider" name="etat_droit_accesCDAS[]">
					<label for="etat_droit_accesCDAS[]">A valider</label>
					<input type="checkbox" value="Révoquée" name="etat_droit_accesCDAS[]">
					<label for="etat_droit_accesCDAS[]">Révoquée</label>
					<input type="checkbox" value="A revérifier" name="etat_droit_accesCDAS[]">
					<label for="etat_droit_accesCDAS[]">A revérifier</label>
					<input type="checkbox" value="Obsolète" name="etat_droit_accesCDAS[]">
					<label for="etat_droit_accesCDAS[]">Obsolète</label>
					<input type="checkbox" value="Refusée" name="etat_droit_accesCDAS[]">
					<label for="etat_droit_accesCDAS[]">Refusée</label>
				</div>

				<!--Renseigner le statut_controle_preuve-->
				<div>
					<input type="checkbox" value="Preuve en attente" name="statut_controle_preuveCDAS[]">
					<label for="statut_controle_preuveCDAS[]">Preuve en attente</label>
					<input type="checkbox" value="Preuve en cours de vérification" name="statut_controle_preuveCDAS[]">
					<label for="statut_controle_preuveCDAS[]">Preuve en cours de vérification</label>
					<input type="checkbox" value="Preuve Vérifiée OK" name="statut_controle_preuveCDAS[]">
					<label for="statut_controle_preuveCDAS[]">Preuve Vérifiée OK</label>
					<input type="checkbox" value="Preuve Vérifiée KO" name="statut_controle_preuveCDAS[]">
					<label for="statut_controle_preuveCDAS[]">Preuve Vérifiée KO</label>
				</div>

				<!--Renseigner le role_tiers-->
				<div>
					<label>Insérer l'ID_PCE n°1 : </label>
					<br/>
					<input type="text" id="id_pceCDAS1" name="id_pceCDAS1"/>
					<br/>
					<label>Insérer l'ID_PCE n°2 : </label>
					<br/>
					<input type="text" id="id_pceCDAS2" name="id_pceCDAS2"/>
					<br/>
					<label>Insérer l'ID_PCE n°3 : </label>
					<br/>
					<input type="text" id="id_pceCDAS3" name="id_pceCDAS3"/>
					<br/>
				</div>

				<input type="submit" value="Terminer"/>
			</form> 
		</div>

		<div class="col-12">
		<?php
			if($reponseEstPositive){
				echo prettifyCDAS($output);
				$_SESSION['cdas'] = prettifyCDAS($output);
			} else {
				if(isset($_SESSION['cdas'])){
					echo $_SESSION['cdas'];
				}
			}
		?>
		</div>
	</div>

	<div class="container">
		<div class="col-12">
			<p><?= $cmd ?></p>
			<p><?= var_dump( (array) ((array)json_decode(json_fix(utf8_encode($output[0]))))['resultat']) ?></p>
		</div>
	</div>
</div>
<br/>
<br/>
<br/>
<br/>