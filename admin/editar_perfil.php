<?php
    require_once 'header.php';
    require_once '../db/db_connect.php';

if(isset($_SESSION['usuario'])){
  $dados = buscarPerfilFuncionario($_SESSION['funcionario_funcionario_id']);  
}

if(isset($_POST['salvar'])){
  if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['usuario'])){
    
    $nome = mysqli_real_escape_string($connect, $_POST['nome']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $usuario =mysqli_real_escape_string($connect, $_POST['usuario']);

    if(updatePerfilFuncionario($nome, $email, $usuario, $dados['0'])){
        $_SESSION['sucesso'] = "Alterado com sucesso!";
        header("Location: painel.php");
        
    }else{
        $_SESSION['erro'] = "Erro ao alterar cadastro!";
        header("Location: painel.php");
    }
  }
}
?>
<div class="container mt-3 col-md-6">
<h2>Editar</h2>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" id="cadastrarAluno">
  <div class="form-row">
    <div class="form-group col">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" id="nome" placeholder="Nome completo" name="nome" value="<?php echo $dados['1']; ?>" required="">
    </div>
    <div class="form-group col">
      <label for="email">Email</label>
      <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo $dados['2']; ?>" required="">
    </div>    
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="usuario">Usuario</label>
      <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $dados['3']; ?>" required="">
    </div>
  </div>
  <button type="submit" class="btn btn-green-fvc" name="salvar">Salvar</button>
</form>
</div>

<?php
    require_once 'footer.php';
?>