<?php

require_once 'database.php';
require_once 'classRecepcionista.php';

class Recebimento{
	
	private $id;
	private $valor;
	private $data;
	private $recepcionista_id;
	private $paciente_id;
	private $modo_pagamento;

	public function __construct(){
		$database = new Database();
		$dbSet = $database->dbSet();
		$this->conn = $dbSet;
	}

	public function getId(){
		return $this->id;
	}

	public function getValor(){
		return $this->valor;
	}

	public function getData(){
		return $this->data;
	}

	public function getModoPagamento(){
		return $this->modo_pagamento;
	}

	public function getRecepcionistaId(){
		return $this->recepcionista_id;
	}

	public function getPacienteId(){
		return $this->paciente_id;
	}

	public function setId($id){
        $this->id = $id;
    }

	public function setValor($valor){
     	if($valor > 0){   
        	$this->valor = $valor;
    		return 1;
    	}
    	return 0;
    }

	public function setData($data){
        $this->data = $data;
    }

	public function setModoPagamento($modo_pagamento){
        if(strlen($modo_pagamento) <= 45){
        	$this->modo_pagamento = $modo_pagamento;
        	return 1;
       	}
       	return 0;
    }

	public function setRecepcionistaId($recepcionista_id){
        $this->recepcionista_id = $recepcionista_id;
    }

	public function setPacienteId($paciente_id){
        $this->paciente_id = $paciente_id;
    }

	public function insert(){
		try{	
			$stmt = $this->conn->prepare("INSERT INTO recebimento(valor, data, modo_pagamento, recepcionista_id, paciente_id) VALUES(:valor, :data, :modo_pagamento, :recepcionista_id, :paciente_id)");
			$stmt->bindParam(":valor", $this->valor);
			$stmt->bindParam(":data", $this->data);
			$stmt->bindParam(":modo_pagamento", $this->modo_pagamento);
			$stmt->bindParam(":recepcionista_id", $this->recepcionista_id);
			$stmt->bindParam(":paciente_id", $this->paciente_id);
			$stmt->execute();
			return 1;
		}catch(PDOException $e){
			echo $e->getMessage();
			return 0;	
		}
	}	

	public function edit(){
		try{
			$stmt = $this->conn->prepare("UPDATE recebimento SET valor = :valor, data = :data, modo_pagamento = :modo_pagamento, recepcionista_id = :recepcionista_id, paciente_id = :paciente_id WHERE id = :id");
			$stmt->bindParam(":id", $this->id);
			$stmt->bindParam(":valor", $this->valor);
			$stmt->bindParam(":data", $this->data);
			$stmt->bindParam(":modo_pagamento", $this->modo_pagamento);
			$stmt->bindParam(":recepcionista_id", $this->recepcionista_id);
			$stmt->bindParam(":paciente_id", $this->paciente_id);
			$stmt->execute();
			return 1;
		}catch(PDOException $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function delete(){
		try{
			$stmt = $this->conn->prepare("DELETE FROM recebimento WHERE id = :id");
			$stmt->bindParam(":id", $this->id);
			$stmt->execute();
			return 1;
		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function viewAll(){
		$stmt = $this->conn->prepare("SELECT * FROM recebimento");
		$stmt->execute();
		return $stmt;
	}

	public function viewPlanoDentario(){
		$stmt = $this->conn->prepare("SELECT * FROM plano_dentario WHERE id = :id");
		$stmt->bindParam(":id", $this->id);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_OBJ);
		return $resultado;
	}

	public function viewRecebimento(){
		$stmt = $this->conn->prepare("SELECT * FROM recebimento WHERE id = :id");
		$stmt->bindParam(":id", $this->id);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_OBJ);
		return $resultado;
	}

	public function nomeRecepcionista(){
		try{
			$stmt = $this->conn->prepare("SELECT funcionario.nome FROM recebimento, funcionario WHERE recebimento.recepcionista_id = funcionario.id AND recebimento.id = :id");
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

	public function nomePaciente(){
		try{
			$stmt = $this->conn->prepare("SELECT paciente.nome FROM recebimento, paciente WHERE recebimento.paciente_id = paciente.id AND recebimento.id = :id");
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