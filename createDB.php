<?php
	$servername = "localhost";
	$username = "root";
	$password = "";

	//Création de la connexion
	$conn = new mysqli($servername, $username, $password);

	//Vérification de la connexion
	if ($conn->connect_error){
		die("Echec de la connexion : " . $conn->connect_error);
	}

	//Création de la base de donnée
	$sql = "CREATE DATABASE GRDFADICTEnergieConseils CHARACTER SET utf8 COLLATE utf8_general_ci";
	if ($conn->query($sql) === TRUE) {
		echo "Base de données créée avec succès ! ";
	} else {
		echo "Erreur dans la création de la base de données... : " . $conn->error;
	}
	

	//Code complet pour la création d'une table dans une base de données
	
	//Déclarer les variables
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "GRDFADICTEnergieConseils";

	//Création de la connexion
	$conn = new mysqli($servername, $username, $password, $dbname);

	//Vérification de la connexion
	if ($conn->connect_error) {
		die("Echec de la connexion : " . $conn->connect_error);
	}

	//Remplace tous les $sql
	$sql = file_get_contents('file2.sql');

	//Vérification sur la création / message d'erreur
	if ($conn->multi_query($sql) === TRUE) {
		echo " <br/>L'ajout des valeurs dans la table s'est réalisée avec succès! Le dernier ID inséré est : ";
	} else {
		echo "<br/>Erreur... et oui : " . $sql . "<br/>" . $conn->error;
	}

	//Pour fermer la connexion
	$conn->close();
?>