<?php

require_once 'database.php';

class PlanoDentario{
	private $id;
	private $nome;
	private $desconto;

	public function __construct(){
		$database = new Database();
		$dbSet = $database->dbSet();
		$this->conn = $dbSet;
	}

	public function getd(){
		return $this->id;
	}

	public function getNome(){
		return $this->nome;
	}

	public function getDesconto(){
		return $this->desconto;
	}

	public function setId($id){
        $this->id = $id;
    }

	public function setNome($nome){
        if(strlen($nome) <= 45){
        	$this->nome = $nome;
        	return 1;
        }
        return 0;
    }

	public function setDesconto($desconto){
        $this->desconto = $desconto;
    }

	public function insert(){
		try{
			$stmt = $this->conn->prepare("INSERT INTO plano_dentario(nome, desconto) VALUES(:nome, :desconto)");
			$stmt->bindParam(":nome", $this->nome);
			$stmt->bindParam(":desconto", $this->desconto);
			$stmt->execute();
			return $this->conn->lastInsertId();
		}catch(PDOException $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function edit(){
		try{
			$stmt = $this->conn->prepare("UPDATE plano_dentario SET nome = :nome, desconto = :desconto WHERE id = :id");
			$stmt->bindParam(":id", $this->id);
			$stmt->bindParam(":nome", $this->nome);
			$stmt->bindParam(":desconto", $this->desconto);
			$stmt->execute();
			return 1;
		}catch(PDOException $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function delete(){
		try{
			$stmt = $this->conn->prepare("DELETE FROM plano_dentario WHERE id = :id");
			$stmt->bindParam(":id", $this->id);
			$stmt->execute();
			return 1;
		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function viewAll(){
		$stmt = $this->conn->prepare("SELECT * FROM plano_dentario");
		$stmt->execute();
		return $stmt;
	}

	public function viewPlanoDentario(){
		try{
			$stmt = $this->conn->prepare("SELECT * FROM plano_dentario WHERE id = :id");
			$stmt->bindParam(":id", $this->id);
			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_OBJ);
			if(!empty($resultado)){
				return $resultado;
			}else{
				return null;
			}
		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return null;
		}
	}

	public function existe($nome, $id){
		try{
			$stmt = $this->conn->prepare("SELECT * FROM plano_dentario WHERE nome = :nome AND id != :id");
			$stmt->bindParam(":nome",$nome);
			$stmt->bindParam(":id",$id);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			if(!empty($result)){
				return $result->id;
			}
		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return null;
		}
	}

	public function existeNome($nome){
		try{
			$stmt = $this->conn->prepare("SELECT * FROM plano_dentario WHERE nome = :nome");
			$stmt->bindParam(":nome",$nome);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			if(!empty($result)){
				return $result->id;
			}
		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return null;
		}
	}

}

?> 