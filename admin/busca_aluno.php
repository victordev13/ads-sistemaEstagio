<?php
    require_once 'header.php';
    require_once '../db/db_connect.php';
    require_once '../classes/aluno.class.php';

    if(isset($_POST)){
        if(isset($_POST['matricula'])){
            $matricula = mysqli_real_escape_string($connect, $_POST['matricula']);
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
        <p>Deseja excluir o registro?</p>
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
        $curso = $resultado[4];

        $table_head = "<table class='table table-striped mt-2'>
        <thead>
          <tr>
            <th scope='col'>Nome</th>
            <th scope='col'>Matricula</th>
            <th scope='col'>Curso</th>
            <th scope-'col'></th>
          </tr>
        </thead>" ;

        $table_body = "<tbody>
        <tr>
          <th scope='row'>".$nome."</th>
          <td>".$matricula."</td>
          <td>".$curso."</td>
          <td>
          <a href='editar_aluno.php?m=".$matricula."'' class='btn btn-primary btn-sm'>Editar</a>
          <a href='#' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modal'>X</a>
          </td>
        </tr>
      </tbody>
    </table>";
        
    echo $table_head;
    echo $table_body;

    }
}
?>
</div>

<?php
    require_once 'footer.php';
?>