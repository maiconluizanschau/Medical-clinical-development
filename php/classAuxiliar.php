<?php

require_once 'classFuncionario.php';

class Auxiliar extends Funcionario{
	private $funcionario_id;

	public function __construct(){
		$database = new Database();
		$dbSet = $database->dbSet();
		$this->conn = $dbSet;
	}

	public function getFuncionarioId(){
		return $this->funcionario_id;
	}

	public function setFuncionarioId($funcionario_id){
        $this->funcionario_id = $funcionario_id;
    }

	public function insert(){
		try{
			$stmt = $this->conn->prepare("INSERT INTO auxiliar(funcionario_id) VALUES(:funcionario_id)");
			$stmt->bindParam(":funcionario_id", $this->funcionario_id);
			$stmt->execute();
			return $this->conn->lastInsertId();
		}catch(PDOException $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function delete(){
		try{
			$stmt = $this->conn->prepare("DELETE FROM auxiliar WHERE funcionario_id = :funcionario_id");
			$stmt->bindParam(":funcionario_id", $this->funcionario_id);
			$stmt->execute();
			return 1;
		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function viewAll(){
		$stmt = $this->conn->prepare("SELECT * FROM auxiliar JOIN funcionario ON auxiliar.funcionario_id = funcionario.id");
		$stmt->execute();
		return $stmt;
	}

	public function viewAuxiliar(){
		try{
			$stmt = $this->conn->prepare("SELECT * FROM auxiliar WHERE funcionario_id = :funcionario_id");
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

	public function existeNomeCpf($nome, $cpf){
		try{
			if(empty($cpf)){
				$stmt = $this->conn->prepare("SELECT * FROM auxiliar, funcionario WHERE nome = :nome AND funcionario.id = auxiliar.funcionario_id");
			}else{
				$stmt = $this->conn->prepare("SELECT * FROM auxiliar, funcionario WHERE nome = :nome AND cpf = :cpf AND funcionario.id = auxiliar.funcionario_id");
				$stmt->bindParam(":cpf", $cpf);
			}
				$stmt->bindParam(":nome", $nome);
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
