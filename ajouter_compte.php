<?php
	session_start();
	require './db_inc.php';
	require './account_class.php';

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

	if (!($login && $admin)) {
		header("Location: tabs.php");
	}

	if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

		$identifiant = $_POST['identifiant'];
		$motDePasse = $_POST['motDePasse'];

		// Ajouter une condition pour l'empêcher de delete son propre compte

		$sql = "SELECT count(*) AS 'nombre' FROM accounts WHERE account_name = '?'";
		$q = $pdo->prepare($sql);
		$q->execute(array($identifiant));
		$compte = $q->fetch(PDO::FETCH_ASSOC);
		$compte = $compte['nombre']; 

		if($compte == 0){

			$newAccount = new Account();
			$newAccount->addAccount($identifiant, $motDePasse);

		}

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
		<title>API GRDF - Tableau de Bord - Création de Compte</title>
	</head>

	<body>

		<?php include 'header.php' ?>

		<div class="container">
			<h1>Ajouter un compte</h1>	
			<form method="post" action="ajouter_compte.php">
				<!--Remplir le nom du compte-->
				<div class="form-group">
					<label for="compte">Entrez le nom du compte</label>
					<input type="text" class="form-control" placeholder="Identifiant" name="identifiant" required/>
				</div>
				<?php
					if (isset($compte)) {
						if ($compte != 0) { 
				?>
				<div id="message" class="alert alert-danger" role="alert">
				  	Ce nom est déjà utilisé, veuillez en choisir un autre
				</div>
				<?php 
						}
						else {
				?>
			 	<div id="message" class="alert alert-success" role="alert">
					Le compte à bien été ajouté
				</div>
				<?php
						}
					}
				?>
				
				<div class="form-group">
					<label for="motDePasse">Entrez un Mot de Passe</label>
					<input type="password" name="motDePasse" id="motDePasse" class="form-control" placeholder="**************" required/>
				</div>
					<button class="btn btn-success btn-lg btn-block my-3" type="submit">Ajouter le nouveau compte</button>
			</form>
		</div>
		
		<script src="assets/javascript/script.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
	</body>


</html>