<?php
require_once'db/db_connect.php';

function formatarCPF($valor){
	$valor = trim($valor);
	$valor = str_replace(".", "", $valor);
	$valor = str_replace(",", "", $valor);
	$valor = str_replace("-", "", $valor);
	$valor = str_replace("/", "", $valor);
	return $valor;
}

function loginAluno($cpf, $senha){
	
 	global $connect;
	$sql = "SELECT * from login_aluno WHERE cpf = '$cpf' AND senha = '$senha'";

	$res_query = mysqli_query($connect, $sql);

	if(mysqli_num_rows($res_query)){
		$dados = mysqli_fetch_array($res_query);
		header("Location: aluno/painel.php");
	}else{
		header('Location: index.php?erro=loginInvalido');
	}
}
function loginAdministrador($usuario, $senha){
	
	global $connect;
	$sql = "SELECT * from login_administrador WHERE usuario = '$usuario' AND senha = '$senha'";

	$res_query = mysqli_query($connect, $sql);

	if(mysqli_num_rows($res_query)){
		$dados = mysqli_fetch_array($res_query);
		 header("Location: admin/painel.php");
	}else{
		header('Location: index.php?erro=loginInvalido');
	}

}