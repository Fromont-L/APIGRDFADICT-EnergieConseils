<?php

	session_start();

	require './db_inc.php';
	require './account_class.php';

	// Se connecter avec un compte

	$login = FALSE;

	try
	{
		$login = $account->login('myUserName', 'myPassword');
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
		die();
	}

	if ($login)
	{
		echo 'Authentication successful.';
		echo 'Account ID: ' . $account->getId() . '<br>';
		echo 'Account name: ' . $account->getName() . '<br>';
	}
	else
	{
		echo 'Authentication failed.';
	}

	// Vérifier si la session est active

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

	if ($login)
	{
		echo 'Authentication successful.';
		echo 'Account ID: ' . $account->getId() . '<br>';
		echo 'Account name: ' . $account->getName() . '<br>';
	}
	else
	{
		echo 'Authentication failed.';
	}

	// Se déconnecter

	try
	{
		$login = $account->login('myUserName', 'myPassword');
		
		if ($login)
		{
			echo 'Authentication successful.';
			echo 'Account ID: ' . $account->getId() . '<br>';
			echo 'Account name: ' . $account->getName() . '<br>';
		}
		else
		{
			echo 'Authentication failed.<br>';
		}
		
		$account->logout();
		
		$login = $account->sessionLogin();
		
		if ($login)
		{
			echo 'Authentication successful.';
			echo 'Account ID: ' . $account->getId() . '<br>';
			echo 'Account name: ' . $account->getName() . '<br>';
		}
		else
		{
			echo 'Authentication failed.<br>';
		}
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
		die();
	}

	echo 'Logout successful.';

	// Fermer les autres sessions ouvertes (s'il y en a)

	try
	{
		$login = $account->login('myUserName', 'myPassword');
		
		if ($login)
		{
			echo 'Authentication successful.';
			echo 'Account ID: ' . $account->getId() . '<br>';
			echo 'Account name: ' . $account->getName() . '<br>';
		}
		else
		{
			echo 'Authentication failed.<br>';
		}
		
		$account->closeOtherSessions();
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
		die();
	}

	echo 'Sessions closed successfully.';