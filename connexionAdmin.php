<?php
	session_start();
	require './db_inc.php';
	require './account_class.php';

	$account = new Account();
	$login = FALSE;

	try
	{
		$login = $account->login($_POST['myUserNameAdmin'], $_POST['myPasswordAdmin']);
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
		die();
	}

	if ($login)
	{
		echo 'Vous vous êtes connecté avec succès !';
		header("Location: administration.php");
	}
	else
	{
		echo 'Échec de l\'authentification, veuillez réessayer.';
		header("Location: admin.php");
	}

?>

