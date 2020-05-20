<?php

require_once 'classFuncionario.php';

class Dentista extends Funcionario{

	private $funcionario_id;
	private $cro;

	public function __construct(){
		$database = new Database();
		$dbSet = $database->dbSet();
		$this->conn = $dbSet;
	}

	public function getFuncionarioId(){
		return $this->funcionario_id;
	}

	public function getCro(){
		return $this->cro;
	}

	public function setFuncionarioId($funcionario_id){
        $this->funcionario_id = $funcionario_id;
    }

	public function setCro($cro){
		if(strlen($cro) <= 5){
			$this->cro = $cro;
			return 1;
		}
		return 0;
	}

	public function insert(){
		try{
			$stmt = $this->conn->prepare("INSERT INTO dentista(funcionario_id, cro) VALUES(:funcionario_id, :cro)");
			$stmt->bindParam(":cro", $this->cro);
			$stmt->bindParam(":funcionario_id", $this->funcionario_id);
			$stmt->execute();
			return $this->conn->lastInsertId();
		}catch(PDOException $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function edit(){
		try{
			$stmt = $this->conn->prepare("UPDATE dentista SET cro = :cro WHERE funcionario_id = :funcionario_id");
			$stmt->bindParam(":cro", $this->cro);
			$stmt->bindParam(":funcionario_id", $this->funcionario_id);
			$stmt->execute();
			return 1;
		}catch(PDOException $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function delete(){
		try{
			$stmt = $this->conn->prepare("DELETE FROM dentista WHERE funcionario_id = :funcionario_id");
			$stmt->bindParam(":funcionario_id", $this->funcionario_id);
			$stmt->execute();
			return 1;
		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function viewAll(){
		$stmt = $this->conn->prepare("SELECT * FROM dentista JOIN funcionario ON dentista.funcionario_id = funcionario.id ");
		$stmt->execute();
		return $stmt;
	}

	public function viewDentista(){
		try{
			$stmt = $this->conn->prepare("SELECT * FROM dentista WHERE funcionario_id = :funcionario_id");
			$stmt->bindParam(":funcionario_id", $this->funcionario_id);
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

	public function existeNomeCro($nome, $cro){
		try{
			$stmt = $this->conn->prepare("SELECT * FROM dentista, funcionario WHERE nome = :nome AND cro = :cro AND funcionario.id = dentista.funcionario_id");
			$stmt->bindParam(":nome", $nome);
			$stmt->bindParam(":cro", $cro);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			if(!empty($result)){
				return $result->funcionario_id;
			}
		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return null;
		}
	}

}

?>