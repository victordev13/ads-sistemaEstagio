<?php
require_once'db/db_connect.php';
require_once'functions.php';

if($_POST['cpf'] || $_POST['usuario'] && $_POST['pwd']){
	
	$tipoUsuario = $_POST['tipoUsuario'];

	if($tipoUsuario == 0){

		$cpf = htmlspecialchars($_POST['cpf']);
		$cpf = formatarCPF($cpf);
		$senha = md5(htmlspecialchars($_POST['senha']));
		loginAluno($cpf, $senha);


	}else if($tipoUsuario == 1){

		$usuario = htmlspecialchars($_POST['usuario']);
		$senha = md5(htmlspecialchars($_POST['senha']));
		loginAdministrador($usuario, $senha);

	}
	
}else{
	header('Location: index.php?erro=loginInvalido');
}
?>