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

	if($login){
		header("Location: tabs.php");
	}

?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<meta name="description" content="API GRDF"/>
		<meta name="author" content="Lucas Fromont, Aymeric Herchuelz"/>
		<link rel="icon" type="image/png" href="assets/image/API_GRDF_logo.jpg"/>
		<link rel="stylesheet" href="assets/css/style.css"/>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<title>API GRDF - Connexion</title>
	</head>

	<body class="index_body">

		<?php include 'header.php' ?>

		<div class="big-container">
			<div class="container">
				<div class="inner-container">
					<h1 class="big_title">Bienvenue sur l'API GRDF ADICT Version Web</h1>
					<h2 class="big_title">Connectez-vous au site API GRDF</h2>
				</div>
					<form method="post" action="connexion.php" class="center">
						<div class="form-group">
							<label for="pseudo">Entrez votre pseudo</label>
							<input type="text" class="form-control" placeholder="Identifiant" name="myUserName"/>
						</div>
						<div class="form-group">
							<label for="password">Entrez votre mot de passe</label>
							<input type="password" class="form-control" placeholder="Mot de Passe" name="myPassword"/>
						</div>
							<button class="btn btn-success btn-lg btn-block mb-3" type="submit">Connexion</button>
					</form>
			</div>
			<div class="big-container">
				<div class="container">
					<div class="inner-container">
						<h3 class="big_title">
							Ce n'est pas la page que vous cherchez ?
							<br/>
							Visiter <a class="colorA" href="https://www.gazelectricitemoinschers.fr">le site d'Énergie-Conseils !</a>
						</h3>
					</div>
				</div>
			</div>
		</div>

		<script src="assets/javascript/script.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
	</body>
</html>