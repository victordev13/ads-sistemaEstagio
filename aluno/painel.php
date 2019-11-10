<?php
	require_once'header.php';
	require_once'../functions.php';
    require_once'../db/procedures.php';

	ValidaSessao("logado", 0);

    $aluno_id = $_SESSION['aluno_id'];
    $horasCompletas = somaHoras($aluno_id);
    $horasRestantes = horasRestantes($aluno_id, $horasCompletas);
?>
<div class="container mt-5">
    <?php
        if(str_pad($horasRestantes, strlen($horasRestantes) - 1) == 0){
            echo "<div class='alert alert-success col-md-8' role='alert'>Parabéns, você completou a quantidade de horas necessárias! <a href='../logout.php' class='alert-link'>Sair</a></div>";
        }
    ?>

    <div class="card-deck">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">Horas complementares cumpridas</div>
                <div class="card-body">
                    <h3 class="display-4"><?php echo $horasCompletas ?></h3>
                </div>
            </div>
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-header">Horas complementares restantes</div>
                <div class="card-body">
                    <h3 class="display-4"><?php echo $horasRestantes ?></h3>
                </div>
            </div>
            
    </div>
    
</div>
<?php
	require_once'footer.php';
?>