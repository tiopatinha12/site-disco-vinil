<?php

namespace App\Models;

use PDO;

class Produto {
	public $imagem;
	public string $nome;
	public string $banda;
	public $valor;
	public $quantidade;
	public $id;
	public function __toString() {
		return $this->imagem . $this->nome . $this->banda;
	}
}

class ProdutoModel extends Model {

	static function getAll() {
		$db = new \App\Services\DataBase;
		$conn = $db->getConnection();
		$stt =  $conn
			->prepare("SELECT imagem, nome, banda, valor, quantidade, id FROM produto");
		$stt->execute();
		return $stt->fetchAll(PDO::FETCH_CLASS, "\App\Models\Produto");
	}

	static function buy(Produto $prod, $qtde = 1) {
		$db = new \App\Services\DataBase;
		$conn = $db->getConnection();
		$conn->beginTransaction();
		$stt = $conn->prepare("UPDATE produto SET quantidade = quantidade - :qtde WHERE id = {$prod->id}");
		$stt->bindValue("qtde", $qtde);
		$stt->execute();
		$conn->commit();
	}

	static function delete(Produto $prod) {
		$db = new \App\Services\DataBase;
		$conn = $db->getConnection();
		$conn->beginTransaction();
		$stt = $conn->prepare("DELETE FROM produto WHERE id = {$prod->id}");
		$stt->execute();
		$conn->commit();
	}
	static function add(Produto &$prod) {
		$db = new \App\Services\DataBase;
		$conn = $db->getConnection();
		$conn->beginTransaction();
		$stt = $conn->prepare("INSERT INTO produto (imagem,nome,banda,valor) VALUES (:imagem,:nome,:banda,:valor)");
		$stt->bindParam("imagem", $prod->imagem);
		$stt->bindParam("nome", $prod->nome);
		$stt->bindParam("banda", $prod->banda);
		$stt->bindParam("valor", $prod->valor);
		$stt->execute();
		$auto = $stt->fetch();
		$prod->id = $auto['id'];
		$conn->commit();
	}
}
