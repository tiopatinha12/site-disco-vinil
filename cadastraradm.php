<?php

$DB_servername = "localhost";
$DB_username = "root";
$DB_password = "";
$DB_name = "disco-mania";
try {
	$conn = new PDO("mysql:host=$DB_servername;dbname=$DB_name", $DB_username, $DB_password);
	$conn->beginTransaction();
	$senha = password_hash("admin", PASSWORD_DEFAULT);
	$conn->prepare("insert into administrador (nome,senha) values ('admin','$senha')")
		->execute();
	$conn->commit();
} catch (PDOException $ex) {
	echo "Error: " . $ex->getMessage();
	$conn = null;
}
