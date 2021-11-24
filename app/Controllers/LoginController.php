<?php


namespace App\Controllers;

class LoginController {

	public static function AdminLogin() {
		$db = new \App\Services\DataBase;
		$conn = $db->getConnection();
		$stt = $conn->prepare("SELECT nome, senha FROM administrador WHERE nome = :name");
		$stt->bindParam("name", $_POST['usuario']);
		$stt->execute();
		$resultado = $stt->fetch();
		session_start();
		if (password_verify($_POST['senha'], $resultado['senha'])) {
			$_SESSION['usuario'] = $_POST['usuario'];
			\App\Controllers\StaticPagesController::serveAddProduto();
		} else {
			header("Location:/login");
		}
	}
}
