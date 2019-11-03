<?php
    require_once 'header.php';
    require_once '../db/db_connect.php';
    require_once'../db/procedures.php';

    if(isset($_POST)){
        if(isset($_POST['matricula'])){
            $matricula = mysqli_real_escape_string($connect, $_POST['matricula']);
            $matricula = str_pad($matricula, 9, "0", STR_PAD_LEFT);
            $resultado = buscarAluno($matricula);
            
            if($resultado == false){
                $_SESSION['erro'] = "Aluno não encontrado!";
            }
        }
    }

    if(isset($_POST['excluir'])){
      if(excluirAluno($_SESSION['aluno_id'])){
        $_SESSION['sucesso'] = "Aluno excluído com sucesso!";
      }else{
        $_SESSION['erro'] = "Erro ao excluir aluno!";
      }
    }
?>
<div class="modal fade" tabindex="-1" role="dialog" id="modal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Aviso!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Deseja excluir o aluno e todos os seus registros?</p>
      </div>
      <div class="modal-footer">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
          <button type="submit" class="btn btn-danger" value="1" name="excluir">Excluir</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!--modal excluir horas -->
<div class="modal fade" tabindex="-1" role="dialog" id="ExcluirEstagio">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Aviso!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Deseja excluir o estágio?</p>
      </div>
      <div class="modal-footer">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
          <button type="submit" class="btn btn-danger" value="1" name="excluir_horas">Excluir</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="container mt-3 col-md-8">
<h2>Buscar Aluno</h2>
<?php

if(isset($_SESSION['erro'])){
    echo "<div class='alert alert-danger alerta-sm' role='alert'>";
    echo $_SESSION['erro'];
    echo "</div>";
    unset($_SESSION['erro']);
}

if(isset($_SESSION['sucesso'])){
    echo "<div class='alert alert-success alerta-sm' role='alert'>";
    echo $_SESSION['sucesso'];
    echo "</div>";
    unset($_SESSION['sucesso']);
}

?>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" id="cadastrarAluno">
  <div class="form-row">
    <div class="form-group col-md-4">
      <input type="number" class="form-control" id="matricula" name="matricula" required="" placeholder="N° da matrícula">
    </div>
  </div>
  <span class="input-group-btn">
                <button type="submit" class="btn btn-green-fvc">Buscar
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
</form>

<?php
if(isset($resultado)){
    if(!$resultado == false){
        $_SESSION['aluno_id'] = $resultado[0];
        $nome = $resultado[1];
        $matricula = $resultado[2];
        $curso_id = $resultado[3];
        $curso = $resultado[4];

        $table_aluno_head = "<hr><h2>Aluno</h2>
        <table class='table table-striped mt-2'>
        <thead>
          <tr>
            <th scope='col'>Nome</th>
            <th scope='col'>Matricula</th>
            <th scope='col'>Curso</th>
            <th scope-'col'></th>
          </tr>
        </thead>" ;

        $table_aluno_body = "<tbody>
        <tr>
          <th scope='row'>".$nome."</th>
          <td>".$matricula."</td>
          <td>".$curso."</td>
          <td>
          <a href='editar_aluno.php?m=".$matricula."'' class='btn btn-primary btn-sm float-left mr-1'>Editar</a>
          <a href='#' class='btn btn-danger btn-sm float-left mr-1' data-toggle='modal' data-target='#modal'>X</a>
          </td>
        </tr>
      </tbody>
    </table><br>";
        
    echo $table_aluno_head;
    echo $table_aluno_body;

    $dados_estagio = buscaEstagioCadastrado($_SESSION['aluno_id']);

    if($dados_estagio){
      $contrato = $dados_estagio['0'];
      $convenio = $dados_estagio['1'];
      $data_registro = $dados_estagio['2'];
      $qdt_relatorios = $dados_estagio['3'];

      $table_estagio_head = "<h3>Estágio</h3>
      <table class='table table-striped mt-2'>
          <thead>
            <tr>
              <th scope='col'>Contrato</th>
              <th scope='col'>Convenio</th>
              <th scope='col'>Data do registro</th>
              <th scope='col'>Relatórios entregues</th>
            
           </tr>
          </thead>";

          $table_estagio_body = "<tbody>
          <tr>
            <th scope='row'>".$contrato."</th>
            <td>".$convenio."</td>
            <td>".$data_registro."</td>
            <td>".$qdt_relatorios."</td>
            
          </tr>
        </tbody>
      </table><br>";
        
    echo $table_estagio_head;
    echo $table_estagio_body;

    }else{
      echo "Aluno não possui estágio cadastrado!<br>"; 
    }

    $horas = somaHoras($_SESSION['aluno_id']);
    $horas_restantes = horasRestantes($_SESSION['aluno_id'], $curso_id, $horas);

    if($horas){

     $table_horas_head = "<h3>Horas complementares</h3>
    <table class='table table-striped mt-2'>
        <thead>
          <tr>
            <th scope='col'>Horas cadastradas</th>
            <th scope='col'>Horas restantes</th>
          </tr>
        </thead>" ;

        $table_horas_body = "<tbody>
        <tr>
          <th scope='row'>".$horas."</th>
          <td>".$horas_restantes."</td>
        </tr>
      </tbody>
    </table>";
        
    echo $table_horas_head;
    echo $table_horas_body;
    }else{
      echo "Aluno não possui Horas cadastradas!"; 
    }
  }
}
?>
</div>

<?php
    require_once 'footer.php';
?>