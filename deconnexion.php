<?php

session_start();

require './db_inc.php';
require './account_class.php';

$account = new Account();
$login = FALSE;

try {
    $login = $account->SessionLogin();
}
catch (Exception $e) {
    echo $e->getMessage();
    die();
}

if (!$login) {
    header("Location: index.php");
}


$account->logout();
header("Location: index.php");




?>