<?php
	session_start();
	require './db_inc.php';
	require './account_class.php';

	require 'dropdown.php';

	$account = new Account();
	$login = FALSE;
	$$admin = FALSE;

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

	if($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET)) {

		$sql = "SELECT * FROM plat WHERE id = " . $_GET['id'];
		$q = $pdo->prepare($sql);
		$q->execute();
		$plat = $q->fetch(PDO::FETCH_ASSOC);

		$id = $plat['id'];
		$nom = $plat['nom'];
		$description = $plat['description'];
		$origine = $plat['origine'];
		$type = $plat['type'];
		$type2 = $plat['type2'];
		$pratique_alimentaire = $plat['pratique_alimentaire'];
		$lien_image = $plat['lien_image'];
	}

	if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

		$id = $_POST['id'];
		$nom = $_POST['nom'];
		$description = $_POST['description'];
		$origine = $_POST['origine'];
		$type = $_POST['type'];
		$type2 = $_POST['type2'];
		$pratique_alimentaire = $_POST['pratique_alimentaire'];
		$lien_image = $_POST['lien_image'];

		$sql = "SELECT * FROM plat WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$plat2 = $q->fetch(PDO::FETCH_ASSOC);

		$sql2 = "SELECT count(*) AS nb FROM plat WHERE nom = ?";
		$q2 = $pdo->prepare($sql2);
		$q2->execute(array($nom));
		$nombre = $q2->fetch(PDO::FETCH_ASSOC);

		// Vérifier pour empêcher de modifier le nom s'il est déjà pris
		
		if($nombre['nb'] == 0){
			$sql = "UPDATE plat SET nom = ?, description = ?, origine = ?, type = ?, type2 = ?, pratique_alimentaire = ?, lien_image = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($nom, $description, $origine, $type, $type2, $pratique_alimentaire, $lien_image, $id));

			$_SESSION['message'] = "Modification effectuée !";
			header("Location:info.php?id=" . $id);
		}
		// Si le nom du plat est le même nom et qu'il n'a pas modifié c'est bon
		else if(is_array($plat2)){
			if($plat2['nom'] == $nom){
			$sql = "UPDATE plat SET nom = ?, description = ?, origine = ?, type = ?, type2 = ?, pratique_alimentaire = ?, lien_image = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($nom, $description, $origine, $type, $type2, $pratique_alimentaire, $lien_image, $id));

			$_SESSION['message'] = "Modification effectuée !";
			header("Location:info.php?id=" . $id);
			}
			else{
				$_SESSION['erreur'] = "Ce nom est déjà utilisé, veuillez en choisir un autre !";
				header("Location:modifier.php?id=" . $id);
			}
		}
		else{
			$_SESSION['erreur'] = "Ce nom est déjà utilisé, veuillez en choisir un autre !";
			header("Location:modifier.php?id=" . $id);
		}
			
	
	}

?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<meta name="description" content="Tricatel, plats industriels"/>
		<meta name="author" content="Lucas Fromont"/>
		<link rel="icon" type="image/png" href="assets/image/tricatel_logo.jpg"/>
		<link rel="stylesheet" href="assets/css/style.css"/>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<title>Tricatel - Modifier</title>
	</head>

	<body>

		<?php include 'header.php' ?>


		<div class="container">
			<h1>Modifier un plat</h1>	
			<form method="post" action="modifier.php" class="center">
				<input type="hidden" class="form-control" value="<?= !empty($_GET['id'])?$_GET['id']:'' ?>" name="id" required/>
				<!--Remplir le nom du plat-->
				<div class="form-group">
					<label for="nom">Entrez le nom du plat</label>
					<input type="text" class="form-control" value="<?= !empty($nom)?$nom:''; ?>" name="nom" required/>
				</div>

				<?php
					if (isset($_SESSION['erreur'])) { ?>
				<div id="erreur" class="alert alert-danger" role="alert">
				  	<?= $_SESSION['erreur'] ?>
				</div>
				<?php 
						unset($_SESSION['erreur']);
					} 
				?>
				<!--Remplir la description du plat-->
				<div class="form-group">
					<label for="description">Entrez une description du plat</label>
					<input type="text" class="form-control" value="<?php echo !empty($description)?$description:''; ?>" placeholder="C'est vraiment le meilleur plat du monde, je pourrai en manger tous les jours sans me lasser..." name="description" required/>
				</div>
				<!--Remplir l'origine du plat-->
				<div class="form-group">
					<label for="origine">Entrez l'origine du plat : </label>
					
					<?= enumDropdown("plat", "origine", !empty($origine)?$origine:'') ?>
					
				</div>
				<div class="form-group">
					<label for="type">Sélectionnez les caractéristiques du plat : </label>
					<?= enumDropdown("plat", "type", !empty($type)?$type:'') ?>
				</div>
				<div class="form-group">
					<label for="selsucre">Sélectionnez le goût : </label>
					<?= enumDropdown("plat", "type2", !empty($type2)?$type2:'') ?>
				</div>
				<div class="form-group">
					<label for="pratique_alimentaire">Sélectionnez la pratique alimentaire : </label>
					<?= enumDropdown("plat", "pratique_alimentaire", !empty($pratique_alimentaire)?$pratique_alimentaire:'') ?>
				</div>
				<div class="form-group">
					<label for="lien_image">Entrez l'URL d'une image valide</label>
					<input type="url" name="lien_image" id="lien_image" class="form-control" value="<?php echo !empty($lien_image)?$lien_image:''; ?>" placeholder="https://example.com" required/>
				</div>
					<button class="btn btn-success btn-lg btn-block my-3" type="submit">Modifier le plat</button>
			</form>
		</div>

		<?php include 'footer.php' ?>
		
		<script src="assets/javascript/script.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
	</body>


</html>