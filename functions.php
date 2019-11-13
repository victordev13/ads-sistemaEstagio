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
function tratarString($string){
	$connect = Conexao();
	$stringTratada = mysqli_real_escape_string($connect, $string);
	return $stringTratada;
	FecharConexao($connect);
}
function loginAluno($cpf, $senha){
 	$connect = Conexao();
	$sql = "SELECT * FROM login_aluno WHERE cpf = '$cpf' AND senha = '$senha'";
	$res_query = mysqli_query($connect, $sql);
	if(mysqli_num_rows($res_query)){
		$dados = mysqli_fetch_array($res_query);
		$_SESSION['logado'] = true;
		$_SESSION['nivelUsuario'] = 0;
		$_SESSION['login_aluno_id'] = $dados[0];
		$_SESSION['aluno_id'] = $dados[3];
		$_SESSION['cpf'] = $dados[1];
		$_SESSION['senha'] = $dados[2];
		header("Location: aluno/painel.php");
	}else{
		$_SESSION['erroLogin'] = true;
		$_SESSION['erroLoginUsuario'] = 0;
		header('Location: index.php');
	}
	FecharConexao($connect);
}
function loginAdministrador($usuario, $senha){
	$connect = Conexao();
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
	FecharConexao($connect);
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
	$connect = Conexao();
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
	FecharConexao($connect);
}
function CursosId(){
	$connect = Conexao();;
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
	$connect = Conexao();
	$sql = " SELECT a.aluno_id, a.nome, a.matricula, a.curso_id, l.cpf, l.senha, c.curso FROM aluno A INNER JOIN login_aluno L ON l.aluno_aluno_id = a.aluno_id INNER JOIN curso C ON c.curso_id = a.curso_id WHERE matricula = '$matricula'";
	$resultado = mysqli_query($connect, $sql);
	if($resultado){
		while($row_aluno = mysqli_fetch_array($resultado)){
			$aluno[] = $row_aluno['aluno_id'];
			$aluno[] = $row_aluno['nome'];
			$aluno[] = $row_aluno['matricula'];
			$aluno[]= $row_aluno['curso_id'];
			$aluno[]= $row_aluno['curso'];
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
function buscarIdEstagio($aluno_id){
	$connect = Conexao();
	$sql = " SELECT estagio_id FROM estagio WHERE aluno_aluno_id = '$aluno_id';";
	$resultado = mysqli_query($connect, $sql);
	if($resultado){
		$dados = mysqli_fetch_array($resultado);
		return $dados['0'];
	}else{
		return false;
	}
}
function updateAluno($nome, $curso, $matricula, $aluno_id){
	$connect = Conexao();
	$sql = "UPDATE nucleo_estagio.aluno SET nome='$nome', matricula='$matricula', curso_id='$curso' WHERE aluno_id='$aluno_id'";
	$resultado = mysqli_query($connect, $sql);
	if($resultado){
		return true;
	}else{ 
		return false;
	}
	FecharConexao($connect);
}
function excluirAluno($aluno_id){
	$connect = Conexao();
	$sql = "DELETE FROM login_aluno WHERE aluno_aluno_id='$aluno_id';";
	$resultado = mysqli_query($connect, $sql);
	$sql = "DELETE FROM aluno WHERE aluno_id='$aluno_id';";
	$resultado = mysqli_query($connect, $sql);
	if($resultado){
		return true;
	}else{ 
		return false;
	}
	FecharConexao($connect);
}
function buscarPerfilFuncionario($funcionario_id){
	$connect = Conexao();
	$sql = "SELECT * FROM funcionario F INNER JOIN login_funcionario L ON f.funcionario_id = l.funcionario_funcionario_id WHERE l.funcionario_funcionario_id = '$funcionario_id';";
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
	FecharConexao($connect);
}
function updatePerfilFuncionario($nome, $email, $usuario, $funcionario_id){
	$connect = Conexao();
	$sql = "UPDATE funcionario SET nome='$nome', email='$email' WHERE funcionario_id='$funcionario_id';";
	$resultado = mysqli_query($connect, $sql);
	$sql = "UPDATE login_funcionario SET usuario='$usuario' WHERE funcionario_funcionario_id='$funcionario_id';";
	$resultado = mysqli_query($connect, $sql);
	if($resultado){
		return true;
	}else{ 
		return false;
	}
	FecharConexao($connect);
}
function buscaEstagioCadastrado($aluno_id){
	$connect = Conexao();
	$sql = "SELECT estagio_id, contrato, num_doc_convenio, data_registro, count(relatorio_de_estagi_id) AS qtd_relatorios FROM estagio INNER JOIN relatorio_de_estagio ON estagio_id = estagio_estagio_id WHERE aluno_aluno_id = '$aluno_id';";
	$resultado = mysqli_query($connect, $sql);
	if($resultado){
		while($row = mysqli_fetch_array($resultado)){
			$estagio[] = $row['contrato'];
			$estagio[] = $row['num_doc_convenio'];
			$estagio[] = $row['data_registro'];
			$estagio[] = $row['qtd_relatorios'];
		}
		if(!$estagio[1]==null){
			return $estagio;
		}else{
			return false;
		}
	}else{
		return false;
	}
	FecharConexao($connect);
}