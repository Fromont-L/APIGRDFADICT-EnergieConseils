<?php

	session_start();
	require './db_inc.php';
	require './account_class.php';

	$account = new Account();
	$login = FALSE;

	try
	{
		$login = $account->sessionLogin();
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
		die();
	}
	
	/*
	function get_token()
	{
		// Exécute le code java tokentest.jar
		exec("\"jdk-8.0.292.10-hotspot\\jre\\bin\\java.exe\" -jar tokentest.jar 2>&1", $output);
		// Retourne la valeur de access_token
		return ((array)json_decode(utf8_encode($output[0])))['access_token'];
	}
	*/

	if(isset($_POST['bearerCDA']))
	{

	  // Exécute le code java consulterdroitacces.jar
		$cmd = "\"jdk-8.0.292.10-hotspot\\jre\\bin\\java.exe\" -jar consulterdroitacces.jar"
		. " \"" . $_POST['bearerCDA'] . "\"" 
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
		$reponse = "lol";
		$cmd = "lol2";
	}
?>

<!DOCTYPE html>
<html lang=fr>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<meta name="description" content="Tricatel, plats industriels"/>
		<meta name="author" content="Lucas Fromont"/>
		<link rel="icon" type="image/png" href="assets/image/tricatel_logo.jpg"/>
		<link rel="stylesheet" href="assets/css/style.css"/>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<title>Déclarer un droit d'accès</title>
	</head>
	<body class="index_body">
		<?php include 'header.php'?>

		<div class="container my-3">
		<h1 class="text-center">Consulter un Droit d'Accès</h1>
		</div>

		<div class="container">
			<div class="row py-5">	
				<div class="col-12">
					<form method="POST" action="consulter_droit_acces.php">

						<!--Renseigner l'access_token-->
						<label>Insérer l'access_token : </label>
						<input type="text" id="bearerCDA" name="bearerCDA"/>
						<br/>

						<input type="submit" value="Terminiert"/>
					</form> 
				</div>

				<div class="col-12">
				<?php
					if($reponseEstPositive){
						for ($i=0; $i < $tailleReponse - 1; $i++) {
							?>
							<div class="boxresult col-6">
							<?php 
							foreach (((array)json_decode(utf8_encode($output[$i]))) as $key => $value){
						    ?>
						    <p><?= $key . " : " . $value ?></p>
						    <?php
							}
							?>
							</div>
							<?php
						}
					}
				?>
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

		<?php include 'footer.php'?>
		

		<script src="assets/javascript/script.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>


	</body>
</html>