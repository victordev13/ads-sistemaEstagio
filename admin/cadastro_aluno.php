<?php
    require_once 'header.php';
    require_once '../db/db_connect.php';
    require_once '../classes/aluno.class.php';

    if(isset($_POST)){
        if(isset($_POST['nome']) && isset($_POST['cpf']) && isset($_POST['curso']) && isset($_POST['matricula'])){
            $nome = mysqli_real_escape_string($connect, $_POST['nome']);
            $cpf = mysqli_real_escape_string($connect, $_POST['cpf']);
            $cpf = formatarCPF($cpf);
            $curso = mysqli_real_escape_string($connect, $_POST['curso']);
            $matricula = mysqli_real_escape_string($connect, $_POST['matricula']);

            $aluno = new Aluno($nome, $cpf, $matricula, $curso);

            $cadastro = $aluno->cadastrar();

            if($cadastro){
              $login = $aluno->cadastrarLogin();

              if($login){
                $sucesso = "Aluno ".$nome." cadastrado com sucesso!";
              }else{
                $erro = "Ocorreu um erro ao inserir os dados!";
              }

            }else{
                $erro = "Ocorreu um erro ao inserir os dados!";
            }
        }   
    }
?>
<div class="container mt-3 col-md-6">
<h2>Cadastrar novo aluno</h2>
<?php

 if(!empty($erro)){
    echo "<div class='alert alert-danger alerta-sm' role='alert'>";
    echo $erro;
    echo "</div>";
}

if(!empty($sucesso)){
    echo "<div class='alert alert-success alerta-sm' role='alert'>";
    echo $sucesso;
    echo "</div>";
}

?>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" id="cadastrarAluno">
  <div class="form-row">
    <div class="form-group col">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" id="nome" placeholder="Nome completo" name="nome" required="">
    </div>
    <div class="form-group col">
      <label for="cpf">CPF</label>
      <input type="text" class="cpf form-control" id="cpf" placeholder="CPF" name="cpf" minlength=11 maxlength=11 required="">
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
                    echo "<option value='".$cursos_id[$i]."'>".$cursos[$i]."</option>"."\n";
                }
            }
        ?>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="matricula">Matricula</label>
      <input type="number" class="form-control" id="matricula" name="matricula" required="">
    </div>
  </div>
  <button type="submit" class="btn btn-green-fvc">Cadastrar</button>
</form>
</div>

<?php
    require_once 'footer.php';
?>