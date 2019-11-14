<?php
	$serverName = "remotemysql.com:3306";
	$username = "d7kUqaJghf";
	$password = "JqRZrvNDMi";
	$dbName = "d7kUqaJghf";
	
	try{
		$conn = new PDO("mysql:host=$serverName;dbname=$dbName", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
?>