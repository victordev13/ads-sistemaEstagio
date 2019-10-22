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
        <div class="col-md-3">
            <div class="card">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>