<?php
    require_once 'header.php';
    require_once '../db/db_connect.php';
    require_once '../classes/horas_complementares.class.php';

    if(isset($_POST)){
        if(isset($_POST['matricula'])){
            $matricula = tratarString($_POST['matricula']);
            $matricula = str_pad($matricula, 9, "0", STR_PAD_LEFT);
            $resultado = buscarAluno($matricula);
            
            if($resultado == false){
                $erro = "Aluno não encontrado!";
            }
        }

        if(isset($_POST['aluno_id']) && isset($_POST['evento']) && isset($_POST['entidade']) && isset($_POST['data_ocorrencia']) && isset($_POST['carga_horaria'])){
          $aluno_id = tratarString($_POST['aluno_id']);;
          $evento = tratarString($_POST['evento']);
          $entidade = tratarString($_POST['entidade']);
          $data_ocorrencia = tratarString($_POST['data_ocorrencia']); 
          $carga_horaria = tratarString($_POST['carga_horaria']);

          $horas_complementares = new HorasComplementares($aluno_id, $evento, $entidade, $data_ocorrencia, $carga_horaria);
          if($horas_complementares->cadastrarHorasComplementares()){
            $sucesso = "Horas cadastradas com sucesso!";
          }else{
              var_dump($horas_complementares->cadastrarHorasComplementares());
            $erro = "Erro ao cadastrar Horas!";
          }
        }
    }
?>


<div class="container mt-3 col-md-6">
<h2>Cadastrar Horas Complementares</h2>
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
        <label for='nome'>Matrícula</label>
        <input type='text' class='form-control' id='matricula' name='matricula' required='' value='".$matricula."' disabled=''>
        </div>";

        $form_evento = "<div class='form-group col-md-6'>
        <label for='evento'>Título do Evento</label>
        <input type='text' class='form-control' id='evento' name='evento' required=''>
        </div>";

        $form_entidade = "<div class='form-group col-md-6'>
        <label for='entidade'>Entidade Responsável</label>
        <input type='text' class='form-control' id='entidade' name='entidade' required=''>
        </div>";

        $form_data_ocorrencia = "<div class='form-group col-md-3'>
        <label for='data_ocorrencia'>Data de ocorrência</label>
        <input type='date' class='form-control' id='data_ocorrencia' name='data_ocorrencia' required=''>
        </div>";
        
        $form_carga_horaria = "<div class='form-group col-md-3'>
        <label for='carga_horaria'>Carga horária</label>
        <input type='number' class='form-control' id='carga_horaria' name='carga_horaria' min='1' max='500' required=''>
      </div>";
        
        $form_footer = "</div>
        <button type='submit' class='btn btn-green-fvc'>Cadastrar</button>
      </form>
      </div>";

        echo $form_header;
        echo $form_nome_aluno;
        echo $form_hidden_aluno_id;
        echo $form_matricula_aluno;
        echo $form_evento;
        echo $form_entidade;
        echo $form_data_ocorrencia;
        echo $form_carga_horaria;
        echo $form_footer;
    }
}
?>
</div>

<?php
    require_once 'footer.php';
?>