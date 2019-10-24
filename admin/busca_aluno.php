<?php
    require_once 'header.php';
    require_once '../db/db_connect.php';
    require_once '../classes/aluno.class.php';

    if(isset($_POST)){
        if(isset($_POST['matricula'])){
            $matricula = mysqli_real_escape_string($connect, $_POST['matricula']);
            $resultado = buscarAluno($matricula);
            
            if($resultado == false){
                $erro = "Aluno não encontrado!";
            }else{
                
            }
        }

    }
?>
<div class="container mt-3 col-md-8">
<h2>Buscar Aluno</h2>
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
    <div class="form-group col-md-4">
      <input type="number" class="form-control" id="matricula" name="matricula" required="" placeholder="N° da matrícula">
    </div>
  </div>
  <button type="submit" class="btn btn-green-fvc">Buscar</button>
</form>

<?php
if(isset($resultado)){
    if(!$resultado == false){
        $nome = $resultado[1];
        $matricula = $resultado[2];
        $curso = $resultado[3];

        $table_head = "<table class='table table-striped mt-2'>
        <thead>
          <tr>
            <th scope='col'>Nome</th>
            <th scope='col'>Matricula</th>
            <th scope='col'>Curso</th>
            <th scope-'col'>Ação</th>
          </tr>
        </thead>" ;

        $table_body = "<tbody>
        <tr>
          <th scope='row'>".$nome."</th>
          <td>".$matricula."</td>
          <td>".$curso."</td>
          <td><a href='#'>Selecionar</a></td>
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