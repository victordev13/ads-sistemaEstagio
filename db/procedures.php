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



?>