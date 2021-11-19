<?php

namespace App\Controllers;

use \App\Models\Produto;

class CadastroController {
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
}
