<?php
require_once'../db/db_connect.php';

class Aluno
{
	private $nome;
	private $cpf;
	private $senha;
	private $matricula;
	private $curso;
	
	function __construct($nome, $cpf, $matricula, $curso)
	{
		$this->nome = $nome;
		$this->cpf = $cpf;
		$this->matricula = $matricula;
		$this->curso = $curso;
		$this->senha = substr($cpf, 0, 6);
		$this->senha = md5($this->senha);
	}
 
	public function getNome()
	{
		return $this->nome;
	}

	public function setNome($nome)
	{
		$this->nome = $nome;

		return $this;
	}
 
	public function getCpf()
	{
		return $this->cpf;
	}
 
	public function setCpf($cpf)
	{
		$this->cpf = $cpf;

		return $this;
	}

	public function getMatricula()
	{
		return $this->matricula;
	}

	public function setMatricula($matricula)
	{
		$this->matricula = $matricula;

		return $this;
	}
 
	public function getCurso()
	{
		return $this->curso;
	}

	public function setCurso($curso)
	{
		$this->curso = $curso;

		return $this;
	}

	public function cadastrar(){
		
		global $connect; 

		$sql = "INSERT INTO nucleo_estagio.aluno (nome, matricula, curso) VALUES('$this->nome', '$this->matricula', '$this->curso');";
		/*
		$sql_id = "SELECT aluno_id FROM nucleo_estagio.aluno WHERE matricula='$this->matricula';";
		$resultado = mysqli_query($connect, $sql_id);
		$aluno_id = mysqli_fetch_assoc($resultado_aluno_id);

		$sql = $sql."INSERT INTO nucleo_estagio.login_aluno (cpf, senha, aluno_aluno_id) VALUES('$this->cpf', '$this->senha', '$aluno_id')";
		*/
		$resultado = mysqli_query($connect, $sql);

		if($resultado){
			return true;
		}else{
			return false;
		}

	}

	public function cadastrarLogin(){

		global $connect;

		$sql = "SELECT aluno_id FROM nucleo_estagio.aluno WHERE matricula='$this->matricula';";
		$resultado = mysqli_query($connect, $sql);
		$aluno_id = mysqli_fetch_assoc($resultado);
		$aluno_id = implode(',', $aluno_id);
		$sql_login = "INSERT INTO nucleo_estagio.login_aluno (cpf, senha, aluno_aluno_id) VALUES('$this->cpf', '$this->senha', '$aluno_id')";
		$resultado_login = mysqli_query($connect, $sql_login);
		
		if($resultado_login){
			return true;
		}else{
			return false;
		}
	}
}
?>