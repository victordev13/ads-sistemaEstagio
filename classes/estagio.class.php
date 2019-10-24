<?php
require_once'../db/db_connect.php';

class Estagio
{
	private $aluno_id;
	private $contrato; 
	private $status_relatorio;
	private $classificacao_relatorio;
	private $convenio;

	function __construct($aluno_id, $contrato, $status_relatorio, $classificacao_relatorio, $convenio)
	{
		$this->aluno_id = $aluno_id;
		$this->contrato = $contrato;
		$this->status_relatorio = $status_relatorio;
		$this->classificacao_relatorio = $classificacao_relatorio;
		$this->convenio = $convenio;
	}

	function cadastrarEstagio(){
		
		global $connect;
		
		$sql = "INSERT INTO nucleo_estagio.estagio (`contrato`, `status_relatorio`, `classifi_relatorio`, `num_doc_convenio`, `data_registro`, `aluno_aluno_id`) VALUES ('$this->contrato', '$this->status_relatorio', '$this->classificacao_relatorio', '$this->convenio', CURDATE(), '$this->aluno_id')";
		
		$resultado = mysqli_query($connect, $sql);

		if($resultado){
			return true;
		}else{
			return false;
		}
	}

}