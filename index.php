<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de controle de Estágio</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <script src="js/bootstrap.js"></script>
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
                    <form action="login.php" method="POST">
                        <div class="form-group">    
                            <label for="email">CPF:</label>
                            <input type="text" class="cpf form-control" id="cpf" placeholder="CPF" name="cpf" required="" minlength=11 maxlength=11>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Senha:</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Senha" name="pwd" required="" minlength=6 maxlength=12>
                        </div>
                        <button type="submit" class="btn btn-default btn-green-fvc">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>