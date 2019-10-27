<?php
require_once'../db/db_connect.php';

class Funcionario
{
	private $nome;
	private $email;
	private $usuario;
	private $senha;
	
	function __construct($nome, $email, $usuario, $senha)
	{
		$this->nome = $nome;
		$this->email = $email;
		$this->usuario = $usuario;
		$this->senha = $senha;
	}

	public function cadastrar(){
		
		global $connect; 

		$sql = "INSERT INTO `funcionario` (nome, email) VALUES('$this->nome', '$this->email');";
		$resultado = mysqli_query($connect, $sql);

		$sql = "SET @funcionario_id = LAST_INSERT_ID();";
		$resultado = mysqli_query($connect, $sql);

		$sql = "INSERT INTO `login_funcionario`(`usuario`, `senha`, `funcionario_funcionario_id`) VALUES('$this->usuario', '$this->senha', @funcionario_id);";
		$resultado = mysqli_query($connect, $sql);

		if($resultado){
			return true;
		}else{
			return mysqli_erro($resultado);
		}

	}

	public function cadastrarLogin(){

		global $connect;
/*
		$sql = "SELECT aluno_id FROM nucleo_estagio.funcionario WHERE matricula='$this->matricula';";
		$resultado = mysqli_query($connect, $sql);
		$aluno_id = mysqli_fetch_assoc($resultado);
		$aluno_id = implode(',', $aluno_id);
		$sql_login = "INSERT INTO nucleo_estagio.login_aluno (cpf, senha, aluno_aluno_id) VALUES('$this->cpf', '$this->senha', '$aluno_id')";
		$resultado_login = mysqli_query($connect, $sql_login);
		
		if($resultado_login){
			return true;
		}else{
			return false;
		}*/

		return true;
	}
}

?>