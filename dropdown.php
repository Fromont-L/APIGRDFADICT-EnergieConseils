<?php

	require './db_inc.php';

	// ENUM Origine
	function enumDropdown($table_name, $column_name, $selected='')
	{
		global $pdo;
		
		$selectDropdown = "<select class=\"selectajout\" name=\"$column_name\">";

		$query = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $table_name . "' AND COLUMN_NAME = '" . $column_name . "';";

		$result = $pdo->prepare($query);
		$result->execute();

		$row = $result->fetch(PDO::FETCH_ASSOC);
		$enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE'])-6))));
	

		foreach($enumList as $value)
			if($value == $selected){
				$selectDropdown .= "<option value=\"$value\" selected=\"selected\">$value</option>";
			}
			else{
				$selectDropdown .= "<option value=\"$value\">$value</option>";
			}

		$selectDropdown .= "</select>";

		return $selectDropdown;
	}

?>
