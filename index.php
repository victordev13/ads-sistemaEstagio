<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de controle de Estágio</title>
    <link rel="shortcut icon" href="img/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.mask.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
    <script>
    $(document).ready(function(){
  	     $('#cpf').mask('000.000.000-00', {reverse: true});
	});
    </script>
</head>
<body class="bg-green">
    <div class="row justify-content-center align-items-center" style="height:100vh; width: 100%">
            <div class="card login" style="width: 19rem; min-width: 250px!important;">
                <div class="card-body"> 
                <img src="img/fvclogo.png" class="logo-form">
                    <form action="login.php" method="POST" id="formLogin">
                        <?php
                            session_start();
                            if(isset($_SESSION['logado']) && isset($_SESSION['nivelUsuario'])){
                                if($_SESSION['nivelUsuario'] == 0){
                                    echo "<div class='alert alert-warning alerta-sm' role='alert'>";
                                    echo "Você está logado como Aluno! <a href='aluno/painel.php' class='alert-link'>Acessar</a>";
                                    echo "</div>";
                                }else if($_SESSION['nivelUsuario'] == 1){
                                    echo "<div class='alert alert-danger alerta-sm' role='alert'>";
                                    echo "Você está logado como Administrador! <a href='admin/painel.php' class='alert-link'>Acessar</a>";
                                    echo "</div>";
                                }
                            }
                            if(isset($_SESSION['erroLogin']) && isset($_SESSION['erroLoginUsuario'])){
                                if($_SESSION['erroLoginUsuario'] == 0){
                                    echo "<div class='alert alert-danger alerta-sm' role='alert'>";
                                    echo "CPF e/ou Senha inválido(s) ";
                                    echo "</div>";
                                    session_destroy();
                                }else if($_SESSION['erroLoginUsuario'] == 1){
                                    echo "<div class='alert alert-danger alerta-sm' role='alert'>";
                                    echo "Usuário e/ou Senha inválido(s) ";
                                    echo "</div>";
                                    session_destroy();
                                }
                            }
                            if(isset($_SESSION['logout'])){
                                    echo "<div class='alert alert-warning alerta-sm' role='alert'>";
                                    echo "Logout efetuado com sucesso!";
                                    echo "</div>";
                                    session_destroy();
                            }
                        ?>
                        <div class="form-group">
                            <label for="tipoUsuario">Tipo de usuário:</label>
                            <select class="form-control form-control-sm" id="tipoUsuario" name="tipoUsuario" onchange="validaTipoUsuario();" required="">
                                <option value="0" selected>Aluno</option>
                                <option value="1">Administrador</option>
                            </select>
                        </div>
                        <div class="form-group" id="campoCpf">    
                            <label for="cpf">CPF:</label>
                            <input type="text" class="cpf form-control" id="cpf" placeholder="CPF" name="cpf" minlength=11 maxlength=11>
                        </div>
                        <div class="form-group" id="campoUsuario" style="display: none">    
                            <label for="usuario">Usuario:</label>
                            <input type="text" class="form-control" id="usuario" placeholder="Nome de Usuário" name="usuario" minlength=4 maxlength=20>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Senha:</label>
                            <input type="password" class="form-control" id="senha" placeholder="Senha" name="senha" required="" minlength=6 maxlength=12>
                        </div>
                        <button type="submit" class="btn btn-default btn-green-fvc">Login</button>
                        <a href="#" data-toggle="modal" data-target="#creditos">
                            <img src="img/bit.png" class="float-right" style="width: 50px; margin-top: -10px">
                        </a> 
                    </form>
                </div>
            </div>
        </div>
<!-- Créditos -->
<div class="modal fade bd-example-modal-lg" id="creditos" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalLongoExemplo">Créditos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Sobre</h5>
        <p>Software desenvolvido na disciplina de Projeto Integrado do 4° Período em Análise e Desenvolvimento de Sistemas da <a href="https://ivc.br" target="blank">Faculdade Vale do Cricaré</a> em São Mateus-ES, no ano de 2019/2.<br>Orientado pelo professor Walece Negris Pereira.</p>
            <p><b>Desenvolvido por BIT Soluções.</b></p>
            <p><b>Equipe:</b></p>
            <div class="row">
                <div class="card ml-3" style="width: 9rem;">
                    <img class="card-img-top" src="img/andressa.jpeg">
                    <div class="card-body">
                        <a href="mailto:andressacosta832015@gmail.com"><h6 class="card-title text-dark">Andressa Costa de J.</h6></a>
                        <hr>
                        <p style="font-size: 8pt; font-weight: bold;">Analista de Requisitos/ Documentação</p>
                    </div>
                </div></a>
                <div class="card ml-2" style="width: 9rem;">
                    <img class="card-img-top" src="img/jessica.jpeg">
                    <div class="card-body">
                    <a href="mailto:salesdossantosjessicas@gmail.com"><h6 class="card-title text-dark">Jéssica Sales dos S.</h6></a>
                        <hr>
                        <p style="font-size: 8pt; font-weight: bold;">DBA/ Documentação</p>
                    </div>
                </div>
                <div class="card ml-2" style="width: 9rem;">
                    <img class="card-img-top" src="img/joao.webp">
                    <div class="card-body">
                    <a href="mailto:jvictor.jovdsc@gmail.com"><h6 class="card-title text-dark">João Victor da S.</h6></a>
                    <hr>
                    <p style="font-size: 8pt; font-weight: bold;">DBA/ Documentação</p>
                    </div>
                </div>
                 <div class="card ml-2" style="width: 9rem;">
                    <img class="card-img-top" src="img/lucas.webp">
                    <div class="card-body">
                        <a href="mailto:lucastagnert58@gmail.com"><h6 class="card-title text-dark">Lucas Teixeira V.</h6></a>
                        <hr>
                        <p style="font-size: 8pt; font-weight: bold;">Documentação</p>
                    </div>
                </div>
                 <div class="card ml-2" style="width: 9rem;">
                    <img class="card-img-top" src="img/victor.jfif">
                    <div class="card-body">
                        <a href="mailto:vtrcarvalho.13@gmail.com"><h6 class="card-title text-dark">Victor de C. Silva</h6></a>
                        <hr>
                        <p style="font-size: 8pt; font-weight: bold;">Gerente/ Desenvolvedor/ Analista/ Documentação</p>
                    </div>
                </div>
            </div>
        <img src="img/bit.png" class="float-right" style="width: 100px">
      </div>
    </div>
  </div>
</div>
</body>
</html>