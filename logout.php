<?php
session_start();
if(isset($_SESSION['logado'])){
	session_destroy();
	session_start();
	$_SESSION['logout'] = true;
	header('Location: index.php');
	exit();
}else{
	header("Location: index.php");
}
?>