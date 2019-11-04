<?php
    require_once 'header.php';
    require_once '../db/db_connect.php';
    require_once '../classes/aluno.class.php';
    require_once '../classes/estagio.class.php';

    if(isset($_POST)){
        if(isset($_POST['matricula'])){
            $matricula = mysqli_real_escape_string($connect, $_POST['matricula']);
            $matricula = str_pad($matricula, 9, "0", STR_PAD_LEFT);
            $resultado = buscarAluno($matricula);
            
            if($resultado == false){
                $erro = "Aluno não encontrado!";
            }
        }

        if(isset($_POST['aluno_id']) && isset($_POST['contrato']) && isset($_POST['convenio'])){
          $aluno_id = mysqli_real_escape_string($connect, $_POST['aluno_id']);;
          $contrato = mysqli_real_escape_string($connect, $_POST['contrato']);
          $convenio = mysqli_real_escape_string($connect, $_POST['convenio']);

          $estagio = new Estagio($aluno_id, $contrato, $convenio);

          if($estagio->cadastrarEstagio()){
            $sucesso = "Estágio cadastrado com sucesso!";
          }else{
            $erro = "Erro ao cadastrar estágio!";
          }
        }
    }
?>


<div class="container mt-3 col-md-6">
<h2>Cadastrar Estágio</h2>
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
  <div class="form-inline mt-4">
    <div class="form-group mx-sm-3 mb-2">
        <label for="matricula" class="my-1 mr-2">Escolher aluno: </label>
      <input type="number" class="form-control" id="matricula" name="matricula" required="" placeholder="N° da matrícula">
    </div>
      <button type="submit" class="btn btn-green-fvc mb-2">Buscar</button>
  </div>
  
</form>

<?php
if(isset($resultado)){
    if(!$resultado == false){
        $aluno_id = $resultado[0];
        $nome = $resultado[1];
        $matricula = $resultado[2];
        $curso = $resultado[3];
        
        $form_header = "<form method='POST' action='".$_SERVER['PHP_SELF']." 'id='cadastrarAluno'><div class='form-row mt-3'>";
        
        $form_hidden_aluno_id = "<input type='hidden' id='aluno_id' name='aluno_id' required='' value='".$aluno_id."'>";

        $form_nome_aluno = "<div class='form-group col-md-6'>
        <label for='nome'>Nome</label>
        <input type='text' class='form-control' id='nome' name='nome' required='' value='".$nome."' disabled=''>
        </div>";

        $form_matricula_aluno = "<div class='form-group col-md-6'>
        <label for='nome'>Matricula</label>
        <input type='text' class='form-control' id='matricula' name='matricula' required='' value='".$matricula."' disabled=''>
        </div>";

        $form_contrato = "<div class='form-group col-md-2'>
        <label for='contrato'>N° Contrato</label>
        <input type='number' class='form-control' id='contrato' name='contrato' required=''>
        </div>";
        
        $form_num_doc_convenio = "<div class='form-group col-md-3'>
        <label for='convenio'>N° Convênio</label>
        <input type='number' class='form-control' id='convenio' name='convenio' required=''>
      </div>";
        
        $form_footer = "</div>
        <button type='submit' class='btn btn-green-fvc'>Cadastrar</button>
      </form>
      </div>";

        echo $form_header;
        echo $form_nome_aluno;
        echo $form_hidden_aluno_id;
        echo $form_matricula_aluno;
        echo $form_contrato;
        echo $form_num_doc_convenio;
        echo $form_footer;
    }
}
?>
</div>

<?php
    require_once 'footer.php';
?>