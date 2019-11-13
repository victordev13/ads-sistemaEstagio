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
	public function cadastrar(){	
		$connect = Conexao();
		$sql = "INSERT INTO nucleo_estagio.aluno (nome, matricula, curso_id) VALUES('$this->nome', '$this->matricula', '$this->curso');";
		$resultado = mysqli_query($connect, $sql);
		if($resultado){
			return true;
		}else{
			return false;
		}
		FecharConexao($connect);
	}
	public function cadastrarLogin(){
		$connect = Conexao();
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
		FecharConexao($connect);
	}	
}
?>