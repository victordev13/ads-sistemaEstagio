<?php
require_once'../db/db_connect.php';

class Estagio
{
	private $aluno_id;
	private $contrato; 
	private $convenio;

	function __construct($aluno_id, $contrato, $convenio)
	{
		$this->aluno_id = $aluno_id;
		$this->contrato = $contrato;
		$this->convenio = $convenio;
	}

	function cadastrarEstagio(){
		
		global $connect;
		
		$sql = "INSERT INTO estagio (`contrato`,`num_doc_convenio`, `data_registro`, `aluno_aluno_id`) VALUES ('$this->contrato', '$this->convenio', CURDATE(), '$this->aluno_id')";
		
		$resultado = mysqli_query($connect, $sql);

		if($resultado){
			return true;
		}else{
			return false;
		}
	}

}