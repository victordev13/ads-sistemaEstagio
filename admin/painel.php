<?php
require_once'header.php';
require_once'../functions.php';

?>

<div class="container mt-5">
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
    <div class="card-deck">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">Alunos cadastrados</div>
                <div class="card-body">
                    <h3 class="display-4"><?php mostraQtdAlunos(); ?></h3>
                </div>
            </div>
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">Funcionário cadastrados</div>
                <div class="card-body">
                    <h3 class="display-4"><?php echo 20; ?></h3>
                </div>
            </div>
    </div>
</div>



<?php  
    require_once'footer.php'; 
?>