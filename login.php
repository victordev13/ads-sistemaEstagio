<?php
session_start();
require_once'db/db_connect.php';
require_once'functions.php';

if($_POST['cpf'] || $_POST['usuario'] && $_POST['pwd']){
	
	$tipoUsuario = $_POST['tipoUsuario'];

	if($tipoUsuario == 0){

		$cpf = mysqli_real_escape_string($connect, $_POST['cpf']);
		$cpf = formatarCPF($cpf);
		$senha = mysqli_real_escape_string($connect, $_POST['senha']);
		$senha = md5($senha);
		echo $cpf;
		loginAluno($cpf, $senha);


	}else if($tipoUsuario == 1){

		$usuario = mysqli_real_escape_string($connect, $_POST['usuario']);
		$senha = mysqli_real_scape_string($connect, $_POST['senha']);
		$senha = md5($senha);
		loginAdministrador($usuario, $senha);

	}
	
}else{
	header('Location: index.php?erro=loginInvalido');
}

?>