<?php

require_once 'classRecepcionista.php';

class Paciente{

	private $id;
	private $nome;
	private $sobrenome;
	private $nascimento;
	private $cpf;
	private $plano_dentario_id;

	public function __construct(){
		$database = new Database();
		$dbSet = $database->dbSet();
		$this->conn = $dbSet;
	}

	public function getId(){
		return $this->id;
	}

	public function getPlanoDentarioId(){
		return $this->plano_dentario_id;
	}

	public function getNome(){
		return $this->nome;
	}

	public function getSobrenome(){
		return $this->sobrenome;
	}

	public function getNascimento(){
		return $this->nascimento;
	}

	public function getCpf(){
		return $this->cpf;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function setPlanoDentarioId($plano_dentario_id){
        $this->plano_dentario_id = $plano_dentario_id;
    }

    public function setNome($nome){
        if(strlen($nome) <= 45) {
            $this->nome = $nome;
            return 1;
        }
        return 0;
    }

    public function setSobrenome($sobrenome){
        if(strlen($sobrenome) <= 90) {
            $this->sobrenome = $sobrenome;
            return 1;
        }
        return 0;
    }

    public function setNascimento($nascimento){
    	$this->nascimento = $nascimento;
    }

    public function setCpf($cpf){
    	if(!empty($cpf)){
    		$this->cpf = $cpf;
    	}
    }

    public function validaCPF($cpf) {
		// Verifica se o CPF foi informado
		if(empty($cpf)) {
			return true;
		}

		// Elimina possível máscara
		$cpf = preg_replace("/[^0-9]/", "", $cpf);
		$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
		
		// Verifica se o número de dígitos informados é igual a 11 
		if (strlen($cpf) != 11) {
			return false;
		}

		// Verifica se nenhuma das sequências inválidas abaixo foi digitada. Caso afirmativo, retorna falso
		else if ($cpf == '00000000000' || 
			$cpf == '11111111111' || 
			$cpf == '22222222222' || 
			$cpf == '33333333333' || 
			$cpf == '44444444444' || 
			$cpf == '55555555555' || 
			$cpf == '66666666666' || 
			$cpf == '77777777777' || 
			$cpf == '88888888888' || 
			$cpf == '99999999999') {
			return false;
		}
		 // Verifica se o CPF é válido por meio dos dígitos verificadores
	  	else {   
			for ($t = 9; $t < 11; $t++) {
				
				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf{$c} * (($t + 1) - $c);
				}
				$d = ((10 * $d) % 11) % 10;
				if ($cpf{$c} != $d) {
					return false;
				}
			}

			return true;
		}
	}

	public function insert(){
		try{
			$stmt = $this->conn->prepare("INSERT INTO paciente(nome, sobrenome, nascimento, cpf, plano_dentario_id) VALUES(:nome, :sobrenome, :nascimento, :cpf, :plano_dentario_id)");
			$stmt->bindParam(":nome", $this->nome);
			$stmt->bindParam(":sobrenome", $this->sobrenome);
			$stmt->bindParam(":nascimento", $this->nascimento);
			$stmt->bindParam(":cpf", $this->cpf);
			$stmt->bindParam(":plano_dentario_id", $this->plano_dentario_id);
			$stmt->execute();
			return $this->conn->lastInsertId();
		}catch(PDOException $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function edit(){
		try{
			$stmt = $this->conn->prepare("UPDATE paciente SET nome = :nome, sobrenome = :sobrenome, nascimento = :nascimento, cpf = :cpf, plano_dentario_id = :plano_dentario_id WHERE id = :id");
			$stmt->bindParam(":nome", $this->nome);
			$stmt->bindParam(":sobrenome", $this->sobrenome);
			$stmt->bindParam(":nascimento", $this->nascimento);
			$stmt->bindParam(":cpf", $this->cpf);
			$stmt->bindParam(":plano_dentario_id", $this->plano_dentario_id);
			$stmt->bindParam(":id", $this->id);
			$stmt->execute();
			return 1;
		}catch(PDOException $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function editNomeCpf(){
		try{
			if(empty($this->cpf)){
			$stmt = $this->conn->prepare("UPDATE paciente SET nome = :nome WHERE id = :id");
			}else{
			$stmt = $this->conn->prepare("UPDATE paciente SET nome = :nome, cpf = :cpf WHERE id = :id");
			$stmt->bindParam(":cpf", $this->cpf);
			}
			$stmt->bindParam(":nome", $this->nome);
			$stmt->bindParam(":id", $this->id);
			$stmt->execute();
			return 1;
		}catch(PDOException $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function cpfObrigatorio(){
		try{
				$stmt = $this->conn->prepare("SELECT * FROM paciente WHERE nome = :nome");
				$stmt->bindParam(":nome", $this->nome);
				$stmt->execute();
				$result = $stmt->fetch(PDO::FETCH_OBJ);

			if(!is_null($result->cpf)){
				return true;
			}

		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return false;
		}
	}

	public function delete(){
		try{
			$stmt = $this->conn->prepare("DELETE FROM paciente WHERE id = :id");
			$stmt->bindParam(":id", $this->id);
			$stmt->execute();
			return 1;
		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function viewAll(){
		$stmt = $this->conn->prepare("SELECT * FROM paciente");
		$stmt->execute();
		return $stmt;
	}

	public function viewPaciente(){
		try{
			$stmt = $this->conn->prepare("SELECT * FROM paciente WHERE id = :id");
			$stmt->bindParam(":id", $this->id);
			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_OBJ);
			return $resultado;
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

	public function existeNomeCpf(){
		try{
			if(!$this->cpfObrigatorio()){
				if(empty($this->cpf)){
					$stmt = $this->conn->prepare("SELECT * FROM paciente WHERE nome = :nome");
				}else{
					$stmt = $this->conn->prepare("SELECT * FROM paciente WHERE nome = :nome AND cpf = :cpf");
					$stmt->bindParam(":cpf", $this->cpf);
				}
			}else{
				if(empty($this->cpf)){
					return null;
				}else{
					$stmt = $this->conn->prepare("SELECT * FROM paciente WHERE nome = :nome AND cpf = :cpf");
					$stmt->bindParam(":cpf", $this->cpf);
				}
			}
			$stmt->bindParam(":nome", $this->nome);
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

	public function semNomeCpf(){
		if(empty($this->cpf) && empty($this->nome))
			return true;

	}

	public function existeCpf(){
		try{
			if(empty($this->cpf)){
				return false;
			}else{
				$stmt = $this->conn->prepare("SELECT * FROM paciente WHERE cpf = :cpf AND id != :id");
				$stmt->bindParam(":id", $this->id);	
				$stmt->bindParam(":cpf", $this->cpf);	
				$stmt->execute();
				$result = $stmt->fetch(PDO::FETCH_OBJ);
				if(empty($result)){
					return false;
				}else{
					return true;
				}
			}
		}catch(PDOExcecption $e){
			echo $e->getMessage();
			return 0;
		}
	}

	public function nomePlanoDentario(){
		$stmt = $this->conn->prepare("SELECT plano_dentario.nome FROM plano_dentario, paciente WHERE plano_dentario.id = paciente.plano_dentario_id AND paciente.id = :id");
		$stmt->bindParam(":id", $this->id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		if(empty($result)){
			return "";
		}else{
			return $result->nome;
		}
	}

}

?>