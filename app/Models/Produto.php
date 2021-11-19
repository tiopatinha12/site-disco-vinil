<?php

namespace App\Models;

class Produto {
	public string $imagem;
	public string $nome;
	public string $banda;
	public $valor;
	public $quantidade;
	public $id;

	public function __toString() {
		return $this->nome . $this->banda;
	}
}
