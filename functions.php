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
	$sql = "SELECT * FROM login_aluno WHERE cpf = '$cpf' AND senha = '$senha'";

	$res_query = mysqli_query($connect, $sql);

	if(mysqli_num_rows($res_query)){
		$dados = mysqli_fetch_array($res_query);
		$_SESSION['logado'] = true;
		$_SESSION['nivelUsuario'] = 0;
		$_SESSION['login_aluno_id'] = $dados[0];
		$_SESSION['cpf'] = $dados[1];
		$_SESSION['senha'] = $dados[2];
		header("Location: aluno/painel.php");
	}else{
		$_SESSION['erroLogin'] = true;
		$_SESSION['erroLoginUsuario'] = 0;
		header('Location: index.php');
	}
}
function loginAdministrador($usuario, $senha){
	global $connect;
	$sql = "SELECT * FROM login_funcionario WHERE usuario = '$usuario' AND senha = '$senha'";
	$res_query = mysqli_query($connect, $sql);

	if(mysqli_num_rows($res_query)){
		$dados = mysqli_fetch_array($res_query);
		$_SESSION['logado'] = true;
		$_SESSION['nivelUsuario'] = 1;
		$_SESSION['login_funcionario_id'] = $dados[0];
		$_SESSION['usuario'] = $dados[1];
		$_SESSION['senha'] = $dados[2];
		header("Location: admin/painel.php");
	}else{
		$_SESSION['erroLogin'] = true;
		$_SESSION['erroLoginUsuario'] = 1;
		header('Location: index.php');
	}
}

function ValidaSessao($sessao, $nivelUsuario){
	if(!isset($_SESSION)){
		session_start();
	}
	if(!isset($_SESSION[$sessao]) && !isset($_SESSION['nivelUsuario'])){
		header('Location: ../index.php');
	}else{
		if($_SESSION['nivelUsuario'] != $nivelUsuario){
			header('Location: ../index.php');
		}
	}
	
}

function alterarSenha(){

}