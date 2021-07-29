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

		$id = $_POST['id'];
		
		$sql = "DELETE FROM accounts WHERE account_id = ? ";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));

		$_SESSION['message'] = "Suppression effectuée !";
		header("Location:affichage_admin.php");
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
		<title>API GRDF - Tableau de Bord - Suppression de Compte</title>
	</head>

	<body>

		<?php include 'header.php' ?>

		<div class="container">
			<h1 class="text-center">Supprimer un compte</h1>
			<form method="post" action="supprimer_compte.php" class="center">
				<input type="hidden" name="id" value="<?=  $_GET['id'] ?>"/>
					<p id="text-CRUD" class="text-center">Êtes-vous sûr de vouloir supprimer ce compte ?</p>
					<div class="form-actions">
						<button class="btn btn-danger btn-lg btn-block my-3" type="submit">Oui :'(</button>
						<a class="btn btn-secondary btn-lg btn-block my-3" href="affichage_admin.php">Annuler</a>
					</div>
			</form>
		</div>
		
		<script src="assets/javascript/script.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
	</body>
</html>