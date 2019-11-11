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
		
		$connect = Conexao();
		
		$sql = "INSERT INTO relatorio_de_estagio (`classificacao`,`status_relatorio`, `data_entrega`, `estagio_estagio_id`) VALUES ('$this->classificacao', '$this->status', '$this->data_entrega', '$this->estagio_id')";
		
		$resultado = mysqli_query($connect, $sql);

		if($resultado){
			return true;
		}else{
			return false;
		}
		FecharConexao($connect);
	}

}