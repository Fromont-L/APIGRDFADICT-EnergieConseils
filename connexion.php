<?php
	session_start();
	require './db_inc.php';
	require './account_class.php';

	$account = new Account();
	$login = FALSE;

	try
	{
		$login = $account->login($_POST['myUserName'], $_POST['myPassword']);
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
		die();
	}

	if ($login)
	{
		echo 'Vous vous êtes connecté avec succès !';
		header("Location: tabs.php");
	}
	else
	{
		echo 'Échec de l\'authentification, veuillez réessayer.';
		header("Location: index.php");
	}

?>