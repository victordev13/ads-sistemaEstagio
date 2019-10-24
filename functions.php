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

function Cursos(){

	global $connect;
	
	$sql = "SELECT curso FROM nucleo_estagio.cursos";
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
	
	$sql = "SELECT curso_id FROM nucleo_estagio.cursos";
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

function getAlunos(){

}


function buscarAluno($matricula){

	global $connect;
	//setar matricula como unique no banco de dados
	$sql = "SELECT * FROM nucleo_estagio.aluno WHERE matricula LIKE '$matricula';";
	$resultado = mysqli_query($connect, $sql);
	if($resultado){
		while($row_aluno = mysqli_fetch_array($resultado)){
			$aluno[] = $row_aluno['aluno_id'];
			$aluno[] = $row_aluno['nome'];
			$aluno[] = $row_aluno['matricula'];
			$aluno[]= $row_aluno['curso'];
		}
		if(!empty($aluno)){
			return $aluno;
		}
	}else{
		return false;
	}
	
}

?>

