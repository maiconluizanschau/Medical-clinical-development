<?php

require_once 'database.php';

class Especialidade{

	private $nome;

	public function __construct(){
		$database = new Database();
		$dbSet = $database->dbSet();
		$this->conn = $dbSet;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		if(strlen($nome) <= 45){
			$this->nome = $nome;
			return 1;
		}
		return 0;
	}

	public function insert(){
		try{	
			$stmt = $this->conn->prepare("INSERT INTO especialidade(nome) VALUES(:nome)");
			$stmt->bindParam(":nome", $this->nome);
			$stmt->execute();
			return 1;
		}catch(PDOException $e){
			echo $e->getMessage();
			return 0;	
		}
	}	

	public function edit($nome){
		try{
			$stmt = $this->conn->prepare("UPDATE especialidade SET nome = :nome WHERE nome = :nome_atual");
			$stmt->bindParam(":nome", $nome);
			$stmt->bindParam(":nome_atual", $this->nome);
			$stmt->execute();
			return 1;
		}catch(PDOException $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function delete(){
		try{
			$stmt = $this->conn->prepare("DELETE FROM especialidade WHERE nome = :nome");
			$stmt->bindParam(":nome", $this->nome);
			$stmt->execute();
			return 1;
		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function viewAll(){
		$stmt = $this->conn->prepare("SELECT * FROM especialidade");
		$stmt->execute();
		return $stmt; 
	}

	public function viewEspecialidade(){
		$stmt = $this->conn->prepare("SELECT * FROM especialidade WHERE nome = :nome");
		$stmt->bindParam(":nome", $this->nome);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_OBJ);
		if(!empty($resultado)){
			return $resultado;
		}
		else{
			return null;
		}
	}

	public function nomeValido($nome){
		$stmt = $this->conn->prepare("SELECT * FROM especialidade WHERE nome = :novo_nome AND nome != :nome_atual");
		$stmt->bindParam(":novo_nome", $nome);
		$stmt->bindParam(":nome_atual", $this->nome);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_OBJ);
		if(!empty($resultado)){
			return false;
		}
		else{
			return true;
		}
	}

}
?>