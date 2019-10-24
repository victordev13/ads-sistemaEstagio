<?php
  require_once "{$_SERVER['DOCUMENT_ROOT']}/ads-sistemaEstagio/dir_map.php";
  require_once'../functions.php';
  ValidaSessao("logado", 1);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Sistema de controle de Estágio</title>
    <link rel="shortcut icon" href="<?php echo IMG_FOLDER; ?>favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_FOLDER; ?>bootstrap-reboot.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_FOLDER; ?>bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_FOLDER; ?>style.css">
    <script type="text/javascript" src="<?php echo JS_FOLDER; ?>jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_FOLDER; ?>jquery.mask.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_FOLDER; ?>bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo JS_FOLDER; ?>functions.js"></script>
    <script>
    $(document).ready(function(){
  	     $('#cpf').mask('000.000.000-00', {reverse: true});
	  });
    </script>
</head>
<body>
<main>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
  <a class="navbar-brand" href="painel.php">
    <img src="<?php echo IMG_FOLDER; ?>fvclogo2.png" height="35" class="d-inline-block align-top" alt="">
    Painel do Administrador</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Consultar
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="busca_aluno.php">Aluno</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Cadastrar
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="cadastro_aluno.php">Aluno</a>
              <a class="dropdown-item" href="cadastro_estagio.php">Estágio</a>
              <a class="dropdown-item" href="cadastro_horas_complementares.php">Horas complementares</a>
              <a class="dropdown-item" href="cadastro_funcionario.php">Funcionário</a>
            </div>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Meu perfil</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?php echo ADMIN_FOLDER; ?>alterar_senha.php">Alterar senha</a>
            <a class="dropdown-item" href="<?php echo URL_FOLDER; ?>logout.php">Sair</a>
        </li>
    </ul>
  </div>
</nav>
</nav>
