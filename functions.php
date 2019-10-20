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
		//capturando os dados e armazenando no array $dados
		$dados = mysqli_fetch_array($res_query);
		//iniciando as sessoes auxiliares e os dados
		$_SESSION['logado'] = true;
		$_SESSION['nivelUsuario'] = 0;
		$_SESSION['cpf'] = $cpf;
		$_SESSION['senha'] = $senha;
		//direcionando o usuario para o painel do Aluno
		header("Location: aluno/painel.php");
	}else{
		//criando sessao de erro, onde será recuperada no arquivo index
		$_SESSION['erroLogin'] = true;
		//criando sessao onde identifica o tipo de usuario através do index 0(Aluno)
		$_SESSION['erroLoginUsuario'] = 0;
		header('Location: index.php');
	}
}
//Função que realiza o Login como Administrador com dados recebidos em login.php.
function loginAdministrador($usuario, $senha){
	//pega a variável global de conexão com o banco de dados
	global $connect;
	//query para validar os dados recebidos de acordo com o registrado no banco de dados.
	$sql = "SELECT * FROM login_funcionario WHERE usuario = '$usuario' AND senha = '$senha'";
	$res_query = mysqli_query($connect, $sql);

	//verifica se há ao menos 1 linha correspondente aos dados passados na query.
	if(mysqli_num_rows($res_query)){
		//capturando os dados e armazenando no array $dados
		$dados = mysqli_fetch_array($res_query);
		//iniciando as sessões auxiliares e os dados
		$_SESSION['logado'] = true;
		$_SESSION['nivelUsuario'] = 1;
		$_SESSION['usuario'] = $dados[1];
		$_SESSION['senha'] = $dados[2];
		//direcionando o usuario para o Painel do Administrador
		header("Location: admin/painel.php");
	}else{
		//criando sessao de erro, onde será recuperada no arquivo index
		$_SESSION['erroLogin'] = true;
		//criando sessao onde identifica o tipo de usuario através do index 1(Admin)
		$_SESSION['erroLoginUsuario'] = 1;
		header('Location: index.php');
	}
}
//Função onde verifica se o usuário está logado e o direciona para a página inicial, caso não esteja
function ValidaSessao($sessao, $nivelUsuario){
	session_start();

	//verifica se existem as sessoes passada por parametro e nivelUsuario
	if(!isset($_SESSION[$sessao]) && !isset($_SESSION['nivelUsuario'])){
		header('Location: ../index.php');
	}else{
		//caso nao existam, o usuario é redirecionado para a página de login
		if($_SESSION['nivelUsuario'] != $nivelUsuario){
			header('Location: ../index.php');
		}
	}
	
}