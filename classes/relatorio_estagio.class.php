<?php
require_once'../db/db_connect.php';

class RelatorioEstagio
{
	private $estagio_id;
	private $classificacao; 
	private $status;
	private $data_entrega;

	function __construct($estagio_id, $classificacao, $status, $data_entrega)
	{
		$this->estagio_id = $estagio_id;
		$this->classificacao = $classificacao;
		$this->status= $status;
		$this->data_entrega = $data_entrega;
	}

	function cadastrarRelatorioEstagio(){
		
		global $connect;
		
		$sql = "INSERT INTO relatorio_estagio (`estagio_id`,`num_doc_convenio`, `data_registro`, `aluno_aluno_id`) VALUES ('$this->contrato', '$this->convenio', CURDATE(), '$this->aluno_id')";
		
		$resultado = mysqli_query($connect, $sql);

		if($resultado){
			return true;
		}else{
			return false;
		}
	}

}