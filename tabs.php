<?php
	session_start();
	require './db_inc.php';
	require './account_class.php';
	require 'jolifyCCP.php';
	require 'jolifyCCI.php';
	require 'jolifyCDA.php';
	require 'jolifyCDAS.php';
	require 'jolifyCDC.php';
	require 'jolifyCDT.php';

	$account = new Account();
	$login = FALSE;
	$admin = FALSE;

	try
	{
		$login = $account->sessionLogin();
		$admin = $account->isAdmin();
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
		die();
	}

	if (!$login){
		header ('Location: index.php');
	}

	function json_fix($texte_json) {
		$reponseFinale = "{\"resultat\":" . $texte_json . "}";
		$reponseFinale = str_replace("}{", "},{", $reponseFinale);
		return $reponseFinale;
	}

	$pageTabsAffichee = TRUE;

?>

<!DOCTYPE html>
<html lang=fr>
	<head>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<meta name="description" content="API GRDF"/>
		<meta name="author" content="Lucas Fromont, Aymeric Herchuelz"/>
		<link rel="icon" type="image/png" href="assets/image/API_GRDF_logo.jpg"/>
		<link rel="stylesheet" href="assets/css/style.css"/>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<title>API GRDF - Tableau de Bord</title>
	</head>
	<body class="index_body">

		<?php include 'header.php'?>

		<div class="container my-3">
			<h1 class="big_title">Bienvenue sur GRDF, l'API en ligne</h1>
		</div>
		
		<div class="container">
			<nav class="tab navbar sticky-top navbar-expand-lg navbar-light bg-header bar11">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav2"aria-controls="navbarNav2" aria-expended="false">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav2">
					<ul class="navbar-nav mr-auto">
					</ul>
					<ul class="navbar-nav mx-3">
						<button class="tablink btn btn-sm" onclick="openPage('RecupererAccessToken', this, '#FFFFFF')" id="BoutonRecupererAccessToken">R??cup??rer Access Token</button>
						<button class="tablink btn btn-sm" onclick="openPage('DeclarerDroitAcces', this, '#FFFFFF')" id="BoutonDeclarerDroitAcces">Declarer Droit Acces</button>
						
						<button class="tablink btn btn-sm" onclick="openPage('ConsulterDroitAcces', this, '#FFFFFF')" id="BoutonConsulterDroitAcces">Consulter Droit d'Acc??s</button>
						<button class="tablink btn btn-sm" onclick="openPage('ConsulterDroitAccesSpecifiques', this, '#FFFFFF')" id="BoutonConsulterDroitAccesSpecifiques">Consulter Droit Acc??s Sp??cifiques</button>

						<button class="tablink btn btn-sm" onclick="openPage('ConsulterDonneesContractuelles', this, '#FFFFFF')" id="BoutonConsulterDonneesContractuelles">Consulter Donn??es Contractuelles</button>
						<button class="tablink btn btn-sm" onclick="openPage('ConsulterDonneesTechniques', this, '#FFFFFF')" id="BoutonConsulterDonneesTechniques">Consulter Donn??es Techniques</button>

						<button class="tablink btn btn-sm" onclick="openPage('ConsulterConsommationsPubliees', this, '#FFFFFF')" id="BoutonConsulterConsommationsPubliees">Consulter Consommation Publi??es</button>
						<button class="tablink btn btn-sm" onclick="openPage('ConsulterConsommationsInformatives', this, '#FFFFFF')" id="BoutonConsulterConsommationsInformatives">Consulter Consommations Informatives</button>

					</ul>
				</div>
			</nav>

			<div id="RecupererAccessToken" class="tabcontent">
				<h3>R??cup??rer un Access Token</h3>
				<p>Copiez-collez le pour le rentrer dans les autres pages</p>
				<?php include 'access_token2.php' ?>
			</div>

			<div id="DeclarerDroitAcces" class="tabcontent">
				<h3>DeclarerDroitAcces</h3>
				<p>D??clarez votre droit d'acc??s</p>
				<?php include 'declarer_droit_acces2.php'?>
			</div>

			<div id="ConsulterDroitAcces" class="tabcontent">
			  <h3>Consulter mes Droits d'Acc??s</h3>
			  <p>Retrouvez les droits d'acc??s que vous avez d??clar??s</p>
			  <?php include 'consulter_droit_acces2.php' ?>
			</div>

			<div id="ConsulterDroitAccesSpecifiques" class="tabcontent">
				<h3>Consulter mes Droits d'Acc??s Sp??cifiques</h3>
				<p>Retrouvez les droits d'acc??s que vous avez d??clar??s, mais cette fois-ci en selectionnant jusqu'?? 3 PCE de votre choix</p>
				<?php include 'consulter_droit_acces_specifiques2.php' ?>
			</div>

			<div id="ConsulterDonneesContractuelles" class="tabcontent">
			  <h3>Consulter les Donn??es Contractuelles du client</h3>
			  <p>Affiche les donn??es contractuelles</p>
			  <?php include 'consulter_donnees_contractuelles2.php' ?>
			</div>

			<div id="ConsulterDonneesTechniques" class="tabcontent">
			  <h3>Consulter les Donn??es Techniques du client</h3>
			  <p>Affiche les donn??es techniques</p>
			  <?php include 'consulter_donnees_techniques2.php' ?>
			</div>

			<div id="ConsulterConsommationsPubliees" class="tabcontent">
				<h3>Consulter les Consommations Publi??es</h3>
				<p>Affiche les r??sultats mois par mois des consommations de gaz</p>
				<?php include 'consulter_consommations_publiees2.php' ?>
			</div>

			<div id="ConsulterConsommationsInformatives" class="tabcontent">
			  <h3>Consulter les Consommations informatives</h3>
			  <p>Affiche les r??sultats jour par jour des consommations de gaz</p>
			  <?php include 'consulter_consommations_informatives2.php' ?>
			</div>

		</div>

		<script src="assets/javascript/script.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>

		<?php
			if(isset($_POST['token_button'])) {
				echo '<script type="text/javascript">document.getElementById("BoutonRecupererAccessToken").click();</script>';
			}
			else if(isset($_POST['id_pce'])) {
				echo '<script type="text/javascript">document.getElementById("BoutonDeclarerDroitAcces").click();</script>';		
			}
			else if(isset($_POST['bearerCDA'])) {
				echo '<script type="text/javascript">document.getElementById("BoutonConsulterDroitAcces").click();</script>';
			}
			else if(isset($_POST['bearerCDAS'])) {
				echo '<script type="text/javascript">document.getElementById("BoutonConsulterDroitAccesSpecifiques").click();</script>';
			}
			else if(isset($_POST['bearerCCP'])) {
				echo '<script type="text/javascript">document.getElementById("BoutonConsulterConsommationsPubliees").click();</script>';
			}
			else if(isset($_POST['bearerCCI'])) {
				echo '<script type="text/javascript">document.getElementById("BoutonConsulterConsommationsInformatives").click();</script>';
			}
			else if(isset($_POST['bearerCDC'])) {
				echo '<script type="text/javascript">document.getElementById("BoutonConsulterDonneesContractuelles").click();</script>';
			}
			else if(isset($_POST['bearerCDT'])) {
				echo '<script type="text/javascript">document.getElementById("BoutonConsulterDonneesTechniques").click();</script>';
			}
			else {
				echo '<script type="text/javascript">document.getElementById("BoutonRecupererAccessToken").click();</script>';
			} 
		?>
	</body>
</html>