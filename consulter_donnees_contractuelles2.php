<?php
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

	if(isset($_POST['id_pceCDC']))
	{

	  // Exécute le code java consulterdonneescontractuelles.jar
		$cmd = "\"jdk-8.0.292.10-hotspot\\jre\\bin\\java.exe\" -jar consulterdonneescontractuelles.jar"
		. " \"" . $_POST['id_pceCDC'] . "\"" 
		. " \"" . $_POST['bearerCDC'] . "\"" 
		. " 2>&1";

		exec($cmd, $output);
		// Permet de savoir combien il y a de lignes dans la réponse
		$tailleReponse = count($output);
		if($tailleReponse >= 1){
			// Retourne la valeur de la dernière ligne (retour traitement)
			$reponseCode = ((array)json_decode(json_fix(utf8_encode($output[$tailleReponse - 1]))));
			// $reponse = ((array)json_decode(utf8_encode($output[0])));
			// $reponseBrut = var_dump($output[2]);
			$reponseEstPositive = true;
		}
		// Insérer le message d'erreur d'access_token au cas où (mais surement pas là) "erreur": "Une authentification est nécessaire pour accéder à la ressource. "
	} else {
		$reponseEstPositive = false;
		$reponse = "";
		$cmd = "";
	}
?>
<div class="container my-3">
<h1 class="text-center">Consulter les Données Contractuelles</h1>
</div>

<div class="container">
	<div class="row py-5">	
		<div class="col-12">
			<form method="POST" action="tabs.php">

				<!--Renseigner l'access_token-->
				<label>Insérer l'access_token : </label>
				<input type="text" id="bearerCDC" name="bearerCDC"/>
				<br/>

				<!--Renseigner l'id_pce-->
				<label>Insérer l'ID PCE : </label>
				<br/>
				<input type="text" id="id_pceCDC" name="id_pceCDC"/>
				<br/>

				<input type="submit" value="Terminer"/>
			</form> 
		</div>

		<div class="col-12">
		<?php
			if($reponseEstPositive){
				echo prettifyCDC($output);
				$_SESSION['cdc'] = prettifyCDC($output);
			} else {
				if(isset($_SESSION['cdc'])){
					echo $_SESSION['cdc'];
				}
			}
		?>
		</div>
	</div>
</div>