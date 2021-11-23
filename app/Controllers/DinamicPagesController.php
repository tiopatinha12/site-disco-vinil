<?php

namespace App\Controllers;

use \App\Models\Produto;

class DinamicPagesController {
	public static function addProduto() {
		$prod = new Produto;
		$imagem = $_FILES['imagem'];
		$prod->nome = $_POST['nome'];
		$prod->banda = $_POST['banda'];
		$prod->valor = $_POST['valor'];
		$prod->quantidade = $_POST['quantidade'];

		preg_match("/(\.gif|\.bmp|\.png|\.jpg|\.jpeg)$/i", $imagem["name"], $ext);
		$novonome =  hash("sha256", $prod) . $ext[0];
		$novocaminho = "resources/imgBD/" . $novonome;

		move_uploaded_file($imagem["tmp_name"], $novocaminho);
		$prod->imagem = $novonome;
		\App\Models\ProdutoModel::add($prod);
		header("Location:/add");
	}
	public static function serveCheckout() {
		$array = $_POST['cart'];
		$db = new \App\Services\DataBase;
		$conn = $db->getConnection();
		$stt = $conn->prepare("SELECT * from produto WHERE id IN ($array)");
		$stt->execute();
		$produtos = $stt->fetchAll(\PDO::FETCH_CLASS, "\App\Models\Produto");
		if ($produtos == false) {
			return;
		}

		$total = array_reduce(
			$produtos,
			function ($i, $obj) {
				return $i += $obj->valor;
			}
		);

		view("checkout", ['cart' => $produtos, 'total' => $total]);
	}
}
