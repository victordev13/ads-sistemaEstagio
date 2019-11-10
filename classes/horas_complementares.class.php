<?php
require_once'../db/db_connect.php';

class HorasComplementares
{
	private $aluno_id;
	private $evento; 
	private $entidade;
	private $data_ocorrencia;
	private $carga_horaria;

	function __construct($aluno_id, $evento, $entidade, $data_ocorrencia, $carga_horaria)
	{
		$this->aluno_id = $aluno_id;
		$this->evento = $evento;
		$this->entidade = $entidade;
		$this->data_ocorrencia = $data_ocorrencia;
		$this->carga_horaria = $carga_horaria;
	}

	function cadastrarHorasComplementares(){
		
		$connect = Conexao();
		
		$sql = "INSERT INTO `horas_complementares`(`evento`, `entidade`, `data_ocorrencia`, `carga_horaria`, `aluno_aluno_id`) VALUES ('$this->evento', '$this->entidade', '$this->data_ocorrencia', '$this->carga_horaria', '$this->aluno_id')";
		
		$resultado = mysqli_query($connect, $sql);

		if($resultado){
			return true;
		}else{
			return $resultado;
		}
		FecharConexao();
	}

}