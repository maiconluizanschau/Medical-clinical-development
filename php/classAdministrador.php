<?php
	
require_once 'classFuncionario.php';
require_once 'classDespesa.php';

class Administrador extends Funcionario{
	private $funcionario_id;
	private $nome_usuario;
	private $senha;

	public function __construct(){
		$database = new Database();
		$dbSet = $database->dbSet();
		$this->conn = $dbSet;
	}

	public function getFuncionarioId(){
		return $this->funcionario_id;
	}

	public function getNomeUsuario(){
		return $this->nome_usuario;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setFuncionarioId($funcionario_id){
        $this->funcionario_id = $funcionario_id;
    }

	public function setNomeUsuario($nome_usuario){
        if(strlen($nome_usuario) <= 255){
        	$this->nome_usuario = $nome_usuario;
        	return 1;
        }
        return 0;
    }

	public function setSenha($senha){
        $this->senha = sha1($senha);
    }

	public function insert(){
		try{
			$stmt = $this->conn->prepare("INSERT INTO administrador(funcionario_id, nome_usuario, senha) VALUES(:funcionario_id, :nome_usuario, :senha)");
			$stmt->bindParam(":funcionario_id", $this->funcionario_id);
			$stmt->bindParam(":nome_usuario", $this->nome_usuario);
			$stmt->bindParam(":senha", $this->senha);
			$stmt->execute();
			return $this->conn->lastInsertId();
		}catch(PDOException $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function edit(){
		try{
			$stmt = $this->conn->prepare("UPDATE administrador SET nome_usuario = :nome_usuario, senha = :senha WHERE funcionario_id = :funcionario_id");
			$stmt->bindParam(":funcionario_id", $this->funcionario_id);
			$stmt->bindParam(":nome_usuario", $this->nome_usuario);
			$stmt->bindParam(":senha", $this->senha);
			$stmt->execute();
			return 1;
		}catch(PDOException $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function delete(){
		try{
			$stmt = $this->conn->prepare("DELETE FROM administrador WHERE funcionario_id = :funcionario_id");
			$stmt->bindParam(":funcionario_id", $this->funcionario_id);
			$stmt->execute();
			return 1;
		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function existe(){
		try{
			$stmt = $this->conn->prepare("SELECT * FROM administrador WHERE nome_usuario = :nome_usuario AND senha = :senha");
			$stmt->bindParam(":nome_usuario", $this->nome_usuario);
			$stmt->bindParam(":senha", $this->senha);
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

	public function viewAll(){
		$stmt = $this->conn->prepare("SELECT * FROM administrador JOIN funcionario ON administrador.funcionario_id = funcionario.id ");
		$stmt->execute();
		return $stmt;
	}

	public function viewAdministrador(){
		$stmt = $this->conn->prepare("SELECT * FROM administrador WHERE funcionario_id = :funcionario_id");
		$stmt->bindParam(":funcionario_id", $this->funcionario_id);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_OBJ);
		return $resultado;
	}

}
?>