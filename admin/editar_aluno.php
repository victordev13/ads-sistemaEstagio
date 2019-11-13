<?php
    require_once 'header.php';
    require_once '../db/db_connect.php';
    require_once '../classes/aluno.class.php';
if(isset($_GET['m'])){
  $matricula = tratarString($_GET['m']);
  $dados = buscarAluno($matricula);
}
if(isset($_POST['editar'])){
  if(isset($_POST['nome']) && isset($_POST['curso']) && isset($_POST['matricula'])){
    $nome = tratarString($_POST['nome']);
    $curso =tratarString($_POST['curso']);
    $matricula =tratarString($_POST['matricula']);
    $dados = buscarAluno($matricula);  
    if(updateAluno($nome, $curso, $matricula, $dados['0'])){
        $_SESSION['sucesso'] = "Alterado com sucesso!";
        header("Location: busca_aluno.php");
    }else{
        $_SESSION['erro'] = "Erro ao alterar cadastro!";
        header("Location: busca_aluno.php");
    }
  }
}
?>
<div class="container mt-3 col-md-6">
<h2>Editar aluno</h2>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" id="cadastrarAluno">
  <div class="form-row">
    <div class="form-group col">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" id="nome" placeholder="Nome completo" name="nome" value="<?php echo $dados['1']; ?>" required="">
    </div>
    <div class="form-group col">
      <label for="cpf">CPF</label>
      <input type="text" class="cpf form-control" id="cpf" placeholder="CPF" name="cpf" value="<?php echo $dados['5']; ?>" minlength=11 maxlength=11 disabled>
    </div>    
  </div>
  <div class="form-row">
  <div class="form-group col">
      <label for="curso ">Curso</label>
      <select id="curso" class="form-control" name="curso" required="">
        <option selected>Selecione...</option>
        <?php
            $cursos = Cursos();
            $cursos_id = CursosId();
            if($cursos){
                for($i = 0; $i <count($cursos_id); $i++){
                    if($cursos_id[$i] == $dados['3']){
                      $selected = "selected";
                    }else{
                      $selected="";
                    }
                    echo "<option value='".$cursos_id[$i]."' ".$selected.">".$cursos[$i]."</option>"."\n";
                }
            }
        ?>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="matricula">Matricula</label>
      <input type="number" class="form-control" id="matricula" name="matricula" value="<?php echo $dados['2']; ?>" required="">
    </div>
  </div>
  <button type="submit" class="btn btn-green-fvc" name="editar">Alterar</button>
</form>
</div>
<?php
    require_once 'footer.php';
?>