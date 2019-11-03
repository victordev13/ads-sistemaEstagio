<?php
    require_once 'header.php';
    require_once '../db/db_connect.php';
    require_once '../classes/aluno.class.php';
    require_once '../classes/relatorio_estagio.class.php';

    if(isset($_POST)){
        if(isset($_POST['matricula'])){
            $matricula = mysqli_real_escape_string($connect, $_POST['matricula']);
            $resultado = buscarAluno($matricula);
            
            if($resultado == false){
                $erro = "Aluno não encontrado!";
            }
        }

        if(isset($_POST['aluno_id']) && isset($_POST['classificacao']) && isset($_POST['status']) && isset($_POST['data_entrega'])){
          $aluno_id = mysqli_real_escape_string($connect, $_POST['aluno_id']);;
          $classificacao = mysqli_real_escape_string($connect, $_POST['classificacao']);
          $status = mysqli_real_escape_string($connect, $_POST['status']);
          $data_entrega = mysqli_real_escape_string($connect, $_POST['data_entrega']); 

          $estagio_id = buscarIdEstagio($aluno_id);
          $relatorio_estagio = new RelatorioEstagio($estagio_id, $classificacao, $status, $data_entrega);
          
          if($relatorio_estagio->cadastrarRelatorioEstagio()){
            $sucesso = "Relatório cadastrado com sucesso!";
          }else{    
            $erro = "Erro ao cadastrar Relatório!<br>Verifique se o aluno possui estágio cadastrado.";
          }
        }
    }
?>


<div class="container mt-3 col-md-6">
<h2>Cadastrar Relatório de Estágio</h2>
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

        $form_classificacao = "<div class='form-group col-md-5'>
        <label for='classificacao'>Classificação do Relatório</label>
        <select class='form-control form-control-sm' id='classificacao' name='classificacao' required=''>
            <option selected>Selecione...</option>
            <option value='Parcial'>Parcial</option>
            <option value='Final'>Final</option>
        </select>
        </div>";

        $form_status = "<div class='form-group col-md-4'>
        <label for='status'>Status</label>
        <select class='form-control form-control-sm' id='status' name='status' required=''>
            <option selected>Selecione...</option>
            <option value='Entregue'>Entregue</option>
            <option value='Não entregue'>Não entregue</option>
        </select>
        </div>";

        $data_atual = date('Y-m-d');
        $form_data_entrega = "<div class='form-group col-md-3'>
        <label for='data_entrega'>Data de entrega</label>
        <input type='date' class='form-control' id='data_entrega' name='data_entrega' required='' value='".$data_atual."'>
        </div>";

        $form_footer = "</div>
        <button type='submit' class='btn btn-green-fvc'>Cadastrar</button>
      </form>
      </div>";

        echo $form_header;
        echo $form_nome_aluno;
        echo $form_hidden_aluno_id;
        echo $form_matricula_aluno;
        echo $form_classificacao;
        echo $form_status;
        echo $form_data_entrega;
        echo $form_footer;
    }
}
?>
</div>

<?php
    require_once 'footer.php';
?>