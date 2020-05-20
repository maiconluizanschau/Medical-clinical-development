<?php

require_once 'database.php';

class Auxiliar_auxilia_Dentista{

	private $dentista_id;
	private $auxiliarid;

	public function __construct(){
		$database = new Database();
		$dbSet = $database->dbSet();
		$this->conn = $dbSet;
	}

	public function getDentistaId(){
		return $this->dentista_id;
	}

	public function getAuxiliarId(){
		return $this->auxiliar_id;
	}

	public function setDentistaId($dentista_id){
        $this->dentista_id = $dentista_id;
    }

	public function setAuxiliarId($auxiliar_id){
        $this->auxiliar_id = $auxiliar_id;
    }

	public function insert(){
		try{
			$stmt = $this->conn->prepare("INSERT INTO auxiliar_auxilia_dentista(dentista_id, auxiliar_id) VALUES(:dentista_id, :auxiliar_id)");
			$stmt->bindParam(":dentista_id", $this->dentista_id);
			$stmt->bindParam(":auxiliar_id", $this->auxiliar_id);
			$stmt->execute();
			return 1;
		}catch(PDOException $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function edit($dentista_id_novo, $auxiliar_id_novo){
		try{
			$stmt = $this->conn->prepare("UPDATE auxiliar_auxilia_dentista SET auxiliar_id = :auxiliar_id_novo, dentista_id = :dentista_id_novo WHERE auxiliar_id = :auxiliar_id_atual AND dentista_id = :dentista_id_atual");
			$stmt->bindParam(":auxiliar_id_novo", $auxiliar_id_novo);
			$stmt->bindParam(":auxiliar_id_atual", $this->auxiliar_id);
			$stmt->bindParam(":dentista_id_novo", $dentista_id_novo);
			$stmt->bindParam(":dentista_id_atual", $this->dentista_id);
			$stmt->execute();
			return 1;
		}catch(PDOException $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function delete(){
		try{
			$stmt = $this->conn->prepare("DELETE FROM auxiliar_auxilia_dentista WHERE dentista_id = :dentista_id AND auxiliar_id = :auxiliar_id");
			$stmt->bindParam(":dentista_id", $this->dentista_id);
			$stmt->bindParam(":auxiliar_id", $this->auxiliar_id);
			$stmt->execute();
			return 1;
		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function viewAll(){
		$stmt = $this->conn->prepare("SELECT * FROM auxiliar_auxilia_dentista");
		$stmt->execute();
		return $stmt;
	}

	public function viewAuxiliarAuxiliaDentista(){
		$stmt = $this->conn->prepare("SELECT * FROM auxiliar_auxilia_dentista WHERE id = :id");
		$stmt->bindParam(":id", $this->id);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_OBJ);
		return $resultado;
	}

	public function nomeDentista($dentista_id, $auxiliar_id){
		try{
		$stmt = $this->conn->prepare("SELECT funcionario.nome FROM auxiliar_auxilia_dentista, funcionario WHERE auxiliar_auxilia_dentista.dentista_id = funcionario.id AND auxiliar_auxilia_dentista.dentista_id = :dentista_id AND auxiliar_auxilia_dentista.auxiliar_id = :auxiliar_id");
			$stmt->bindParam(":dentista_id", $dentista_id);
			$stmt->bindParam(":auxiliar_id", $auxiliar_id);
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

	public function nomeAuxiliar($dentista_id, $auxiliar_id){
		try{
		$stmt = $this->conn->prepare("SELECT funcionario.nome FROM auxiliar_auxilia_dentista, funcionario WHERE auxiliar_auxilia_dentista.auxiliar_id = funcionario.id AND auxiliar_auxilia_dentista.dentista_id = :dentista_id AND auxiliar_auxilia_dentista.auxiliar_id = :auxiliar_id");
			$stmt->bindParam(":dentista_id", $dentista_id);
			$stmt->bindParam(":auxiliar_id", $auxiliar_id);
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

	public function existeDentista($dentista_id){
		try{
			$stmt = $this->conn->prepare("SELECT * FROM auxiliar_auxilia_dentista WHERE dentista_id = :dentista_id");
			$stmt->bindParam(":dentista_id", $dentista_id);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			if(empty($result)){
				return 0;
			}else{
				return 1;
			}
		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function existeAuxiliar($auxiliar_id){
		try{
			$stmt = $this->conn->prepare("SELECT * FROM auxiliar_auxilia_dentista WHERE auxiliar_id = :auxiliar_id");
			$stmt->bindParam(":auxiliar_id", $auxiliar_id);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			if(empty($result)){
				return 0;
			}else{
				return 1;
			}
		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return 0;
		}
	}

}
?>