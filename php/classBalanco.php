<?php

require_once 'database.php';

class Balanco{

	public function __construct(){
		$database = new Database();
		$dbSet = $database->dbSet();
		$this->conn = $dbSet;
	}

	public function valorRecebimentos(){
			$stmt = $this->conn->prepare("SELECT SUM(valor) AS valores FROM recebimento");
			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_OBJ);
			return $resultado->valores;
	}

	public function valorDespesas(){
			$stmt = $this->conn->prepare("SELECT SUM(valor) AS valores FROM despesa WHERE situacao = :situacao");
			$stmt->bindValue(":situacao", 'Pago');
			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_OBJ);
			return $resultado->valores;
	}

	public function mostraSaldo(){
		return $this->valorRecebimentos()-$this->valorDespesas();
	}

}