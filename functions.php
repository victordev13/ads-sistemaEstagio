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
		$_SESSION['funcionario_funcionario_id'] = $dados[3];

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

function Cursos(){

	global $connect;
	
	$sql = "SELECT curso FROM nucleo_estagio.curso";
	$resultado = mysqli_query($connect, $sql);

	if($resultado){
		while($reg = $resultado->fetch_array()) {
			$dados[] = $reg['curso']; 
		}
		return $dados;
	}else{
		return false;
	}
}


function CursosId(){

	global $connect;
	
	$sql = "SELECT curso_id FROM nucleo_estagio.curso";
	$resultado = mysqli_query($connect, $sql);

	if($resultado){
		while($reg = $resultado->fetch_array()) {
			$dados[] = $reg['curso_id']; 
		}
		return $dados;
	}else{
		return false;
	}
}

function buscarAluno($matricula){

	global $connect;
	//setar matricula como unique no banco de dados
	$sql = "SELECT * FROM nucleo_estagio.aluno, nucleo_estagio.login_aluno WHERE matricula LIKE '$matricula';";
	$resultado = mysqli_query($connect, $sql);
	if($resultado){
		while($row_aluno = mysqli_fetch_array($resultado)){
			$aluno[] = $row_aluno['aluno_id'];
			$aluno[] = $row_aluno['nome'];
			$aluno[] = $row_aluno['matricula'];
			$aluno[]= $row_aluno['curso_id'];
			$aluno[]= $row_aluno['cpf'];
			$aluno[]= $row_aluno['senha'];
		}
		if(!empty($aluno)){
			return $aluno;
		}
	}else{
		return false;
	}
	
}

function updateAluno($nome, $curso, $matricula, $aluno_id){
	global $connect; 
	$sql = "UPDATE nucleo_estagio.aluno SET nome='$nome', matricula='$matricula', curso_id='$curso' WHERE aluno_id='$aluno_id'";
	$resultado = mysqli_query($connect, $sql);
	if($resultado){
		return true;
	}else{ 
		return false;
	}
}

function excluirAluno($aluno_id){
	global $connect; 

	$sql = "DELETE FROM nucleo_estagio.aluno WHERE aluno_id='$aluno_id'";
	$resultado = mysqli_query($connect, $sql);

	if($resultado){
		return true;
	}else{ 
		return false;
	}
}

function buscarPerfilFuncionario($usuario){

	global $connect;

	$sql = "SELECT * FROM nucleo_estagio.funcionario, nucleo_estagio.login_funcionario WHERE login_funcionario.usuario LIKE '$usuario';";
	$resultado = mysqli_query($connect, $sql);
	
	if($resultado){
		while($row_perfil = mysqli_fetch_array($resultado)){
			$perfil[] = $row_perfil['funcionario_id'];
			$perfil[] = $row_perfil['nome'];
			$perfil[] = $row_perfil['email'];
			$perfil[]= $row_perfil['usuario'];
		}
		if(!empty($perfil)){
			return $perfil;
		}
	}else{
		return false;
	}
}


function updatePerfilFuncionario($nome, $email, $usuario, $funcionario_id){
	global $connect; 

	$sql = "UPDATE funcionario SET nome='$nome', email='$email' WHERE funcionario_id='$funcionario_id';";
	$resultado = mysqli_query($connect, $sql);
	
	$sql = "UPDATE login_funcionario SET usuario='$usuario' WHERE funcionario_funcionario_id='$funcionario_id';";
	$resultado = mysqli_query($connect, $sql);

	if($resultado){
		return true;
	}else{ 
		return false;
	}
}


function mostraQtdAlunos(){
	echo 20;
}

function mostraQtdFuncionarios(){
	echo 20;
}