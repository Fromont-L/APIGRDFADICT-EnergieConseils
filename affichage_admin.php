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

	$sql = 'SELECT * FROM `accounts`';

	// On prépare la requête
	$query = $pdo->prepare($sql);

	// On exécute la requête
	$query->execute();

	$pageAdminAffichee = TRUE;
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
		<title>API GRDF - Tableau de Bord - Affichage des Comptes</title>
	</head>
	<body>

		<?php include 'header.php'?>

		<div class="container my-3">
			<h1 class="text-center">Bienvenue dans l'affichage des comptes de l'API GRDF ADICT</h1>
		</div>
		
		<div class="row">
			<a href="ajouter_compte.php" class="btn btn-success">Ajouter un utilisateur</a>
			<div class="table-responsive">
				<h2>Tableau des utilisateurs</h2>
				<table class="table table-hover table-bordered">
					<!--Nom colonnes des utilisateurs-->
					<thead>
						<th>ID</th>
						<th>Identifiant</th>
						<th>Options</th>
					</thead>
					<tbody>
					<?php
						//Formulation de la requête $sql
						foreach ($pdo->query($sql) as $row) {
					?>
						<tr>
							<td><?= $row['account_id']?></td>
							<td><?= $row['account_name']?></td>
							<td>
								<?php
									if ($row['account_id'] != 1) { ?>
										<a class="btn btn-danger btn-sm" href="<?= 'supprimer_compte.php?id=' . $row['account_id'] ?>">Supprimer</a>
									<?php } else { ?>
										<a class="btn btn-dark btn-sm disabled" href="affichage_admin">Ne pas toucher</a>
								<?php } ?>
							</td>
						</tr>
					</tbody>
					<?php
						}
					?>
					</tbody>
				</table>
			</div>
		</div>

		<script src="assets/javascript/script.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
	</body>
</html>