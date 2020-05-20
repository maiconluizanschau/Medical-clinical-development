<?php

require_once 'database.php';

class Dentista_consulta_Paciente{

	private $id;
	private $dentista_id;
	private $paciente_id;
	private $data;
	private $horario;
	private $valor;
	private $situacao;
	private $operacao;

	public function __construct(){
		$database = new Database();
		$dbSet = $database->dbSet();
		$this->conn = $dbSet;
	}

	public function getId(){
		return $this->id;
	}

	public function getDentistaId(){
		return $this->dentista_id;
	}

	public function getPacienteId(){
		return $this->paciente_id;
	}

	public function getData(){
		return $this->data;
	}

	public function getHorario(){
		return $this->horario;
	}

	public function getValor(){
		return $this->valor;
	}

	public function getSituacao(){
		return $this->situacao;
	}

	public function getOperacao(){
		return $this->operacao;
	}

	public function setId($id){
        $this->id = $id;
    }

	public function setDentistaId($dentista_id){
        $this->dentista_id = $dentista_id;
    }

	public function setPacienteId($paciente_id){
        $this->paciente_id = $paciente_id;
    }

	public function setData($data){
        $this->data = $data;
    }

	public function setHorario($horario){
        $this->horario = $horario;
    }

	public function setValor($valor){
        if($valor > 0){
        	$this->valor = $valor;
        	return 1;
        }
        return 0;
    }

	public function setSituacao($situacao){
        $this->situacao = $situacao;
    }

	public function setOperacao($operacao){
        if(strlen($operacao) <= 45){
        	$this->operacao = $operacao;
        	return 1;
        }
        return 0;
    }

	public function insert(){
		try{
			$stmt = $this->conn->prepare("INSERT INTO dentista_consulta_paciente(paciente_id, dentista_id, data, horario, valor, situacao, operacao) VALUES(:paciente_id, :dentista_id, :data, :horario, :valor, :situacao, :operacao)");
			$stmt->bindParam(":paciente_id", $this->paciente_id);
			$stmt->bindParam(":dentista_id", $this->dentista_id);
			$stmt->bindParam(":data", $this->data);
			$stmt->bindParam(":horario", $this->horario);
			$stmt->bindParam(":valor", $this->valor);
			$stmt->bindParam(":situacao", $this->situacao);
			$stmt->bindParam(":operacao", $this->operacao);
			$stmt->execute();
			return $this->conn->lastInsertId();
		}catch(PDOException $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function edit(){
		try{
			$stmt = $this->conn->prepare("UPDATE dentista_consulta_paciente SET data = :data, horario = :horario, valor = :valor, situacao = :situacao, operacao = :operacao WHERE id = :id");
			$stmt->bindParam(":data", $this->data);
			$stmt->bindParam(":horario", $this->horario);
			$stmt->bindParam(":valor", $this->valor);
			$stmt->bindParam(":situacao", $this->situacao);
			$stmt->bindParam(":operacao", $this->operacao);
			$stmt->bindParam(":id", $this->id);
			$stmt->execute();
			return $this->id;
		}catch(PDOException $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function delete(){
		try{
			$stmt = $this->conn->prepare("DELETE FROM dentista_consulta_paciente WHERE id = :id");
			$stmt->bindParam(":id", $this->id);
			$stmt->execute();
			return 1;
		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function viewAll(){
		$stmt = $this->conn->prepare("SELECT * FROM dentista_consulta_paciente");
		$stmt->execute();
		return $stmt;
	}

	public function viewConsulta(){
		$stmt = $this->conn->prepare("SELECT * FROM dentista_consulta_paciente WHERE id = :id");
		$stmt->bindParam(":id", $this->id);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_OBJ);
		return $resultado;
	}

	public function horarioValido(){
		try{
			$stmt = $this->conn->prepare("SELECT * FROM dentista_consulta_paciente WHERE dentista_id = :dentista_id AND data = :data AND horario = :horario AND id != :id");
			$stmt->bindParam(":dentista_id", $this->dentista_id);
			$stmt->bindParam(":data", $this->data);
			$stmt->bindParam(":horario", $this->horario);
			$stmt->bindParam(":id", $this->id);
			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_OBJ);
			if(empty($resultado)){
				return true;
			}else{
				return false;
			}
		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function horarioValidoCadastro(){
		try{
			$stmt = $this->conn->prepare("SELECT * FROM dentista_consulta_paciente WHERE dentista_id = :dentista_id AND data = :data AND horario = :horario");
			$stmt->bindParam(":dentista_id", $this->dentista_id);
			$stmt->bindParam(":data", $this->data);
			$stmt->bindParam(":horario", $this->horario);
			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_OBJ);
			if(empty($resultado)){
				return true;
			}else{
				return false;
			}
		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function nomePaciente(){
		try{
			$stmt = $this->conn->prepare("SELECT paciente.nome FROM dentista_consulta_paciente, paciente WHERE dentista_consulta_paciente.paciente_id = paciente.id AND dentista_consulta_paciente.id = :id");
			$stmt->bindParam(":id", $this->id);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			if(empty($result)){
				return "";
			}else{
				return $result->nome;
			}
		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function nomeDentista(){
		try{
			$stmt = $this->conn->prepare("SELECT funcionario.nome FROM dentista_consulta_paciente, funcionario WHERE dentista_consulta_paciente.dentista_id = funcionario.id AND dentista_consulta_paciente.id = :id");
			$stmt->bindParam(":id", $this->id);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			if(empty($result)){
				return "";
			}else{
				return $result->nome;
			}
		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return 0;
		}
	}

}

?>