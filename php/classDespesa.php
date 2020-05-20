<?php

require_once 'database.php';

class Despesa{

	private $id;
	private $nome;
	private $data;
	private $valor;
	private $tipo;
	private $situacao;
	private $administrador_id;

	public function __construct(){
		$database = new Database();
		$dbSet = $database->dbSet();
		$this->conn = $dbSet;
	}

	public function getId(){
		return $this->id;
	}

	public function getNome(){
		return $this->nome;
	}

	public function getData(){
		return $this->data;
	}

	public function getValor(){
		return $this->valor;
	}

	public function getTipo(){
			return $this->tipo;
	}

	public function getSituacao(){
		return $this->situacao;
	}

	public function getAdministradorId(){
		return $this->administrador_id;
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

	public function setData($data){
		$this->data = $data;
	}

	public function setValor($valor){
		if($valor > 0){
			$this->valor = $valor;
			return 1;
		}
		return 0;
	}

	public function setTipo($tipo){
		if(strlen($tipo) <= 45){
			$this->tipo = $tipo;
			return 1;
		}else{
			return 0;
		}
	}

	public function setSituacao($situacao){
		$this->situacao = $situacao;
	}

	public function setAdministradorId($administrador_id){
		$this->administrador_id = $administrador_id;
	}

	public function insert(){
		try{	
			$stmt = $this->conn->prepare("INSERT INTO despesa(nome,data,valor,tipo,situacao, administrador_id) VALUES(:nome, :data, :valor, :tipo, :situacao, :administrador_id)");
			$stmt->bindParam(":nome", $this->nome);
			$stmt->bindParam(":data", $this->data);
			$stmt->bindParam(":valor", $this->valor);
			$stmt->bindParam(":tipo", $this->tipo);
			$stmt->bindParam(":situacao", $this->situacao);
			$stmt->bindParam(":administrador_id", $this->administrador_id);
			$stmt->execute();
			return 1;
		}catch(PDOException $e){
			echo $e->getMessage();
			return 0;	
		}
	}	

	public function edit(){
		try{
			$stmt = $this->conn->prepare("UPDATE despesa SET nome = :nome, data = :data, valor = :valor, tipo = :tipo, situacao = :situacao, administrador_id = :administrador_id WHERE id = :id");
			$stmt->bindParam(":id", $this->id);
			$stmt->bindParam(":nome", $this->nome);
			$stmt->bindParam(":data", $this->data);
			$stmt->bindParam(":valor", $this->valor);
			$stmt->bindParam(":tipo", $this->tipo);
			$stmt->bindParam(":situacao", $this->situacao);
			$stmt->bindParam(":administrador_id", $this->administrador_id);
			$stmt->execute();
			return 1;
		}catch(PDOException $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function delete(){
		try{
			$stmt = $this->conn->prepare("DELETE FROM despesa WHERE id = :id");
			$stmt->bindParam(":id", $this->id);
			$stmt->execute();
			return 1;
		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function viewAll(){
		$stmt = $this->conn->prepare("SELECT * FROM despesa");
		$stmt->execute();
		return $stmt;
	}

	public function viewDespesa(){
		$stmt = $this->conn->prepare("SELECT * FROM despesa WHERE id = :id");
		$stmt->bindParam(":id", $this->id);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_OBJ);
		return $resultado;
	}

	public function nomeAdministrador(){
		try{
			$stmt = $this->conn->prepare("SELECT funcionario.nome FROM despesa, funcionario WHERE despesa.administrador_id = funcionario.id AND despesa.id = :id");
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