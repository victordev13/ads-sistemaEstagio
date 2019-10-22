<?php
require_once'../db/db_connect.php';

class Aluno
{
	public $nome;
	protected $cpf;
	private $senha;
	public $matricula;
	public $curso;
	
	/* function __construct($nome, $cpf, $matricula, $curso)
	{
		$this->nome = $nome;
		$this->cpf = $cpf;
		$this->matricula = $matricula;
		$this->curso = $curso;
	}
	*/

	function setSenha($cpf){
		$this->senha = substr($cpf, 0, 6);
		echo $this->senha;
	}

	function alterarSenha(){
		
	}

}
?>