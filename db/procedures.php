<?php

function qtdFuncionarios(){

	global $connect;

	$sql = "CALL qtd_funcio_cadast()";

	$resultado = mysqli_query($connect, $sql);

	if($resultado){
		$dados = mysqli_fetch_array($resultado);
		return $dados['0'];
	}else{
		return false;
	}
}


function qtdAlunos(){

	global $connect;

	$sql = "CALL qtd_alunos_cadast()";

	$resultado = mysqli_query($connect, $sql);

	if($resultado){
		$dados = mysqli_fetch_array($resultado);
		return $dados['0'];
	}else{
		return false;
	}
}

function somaHoras($aluno_id){

	global $connect;

	$sql = "CALL soma_horas('$aluno_id');";

	$resultado = mysqli_query($connect, $sql);

	if($resultado){
		$dados = mysqli_fetch_array($resultado);
		if($dados['0']>0){
			return $dados['0']."h";
		}else{
			return false;
		}
		
	}else{
		return false;
	}
}




?>