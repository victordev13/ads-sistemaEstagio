<?php
function qtdFuncionarios(){
	$connect = Conexao();
	$sql = "CALL qtd_funcio_cadast()";
	$resultado = mysqli_query($connect, $sql);
	if($resultado){
		$dados = mysqli_fetch_array($resultado);
		return $dados['0'];
	}else{
		return false;
	}
	FecharConexao($connect);	
}
function qtdAlunos(){
	$connect = Conexao();
	$sql = "CALL qtd_alunos_cadast()";
	$resultado = mysqli_query($connect, $sql);
	if($resultado){
		$dados = mysqli_fetch_array($resultado);
		return $dados['0'];
	}else{
		return false;
	}
	FecharConexao($connect);
}
function somaHoras($aluno_id){
	$connect = Conexao();
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
	FecharConexao($connect);
}
function horasRestantes($aluno_id, $horasCompletas){
	$connect = Conexao();
	$sql = "SELECT total_h_complement FROM aluno INNER JOIN curso ON aluno.curso_id=curso.curso_id WHERE aluno.aluno_id = '$aluno_id';";
	$resultado = mysqli_query($connect, $sql);
	if($resultado){
		$dados = mysqli_fetch_array($resultado);
		$total = $dados['0'] - intval($horasCompletas);
		if($total > 0){
			return $total."h";
		}else{
			return 0;
		}
	}else{
		return false;
	}
	FecharConexao($connect);
}



?>