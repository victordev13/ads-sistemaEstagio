<?php
	require_once'header.php';
	require_once'../functions.php';

	ValidaSessao("logado", 0);
?>
<div class="container mt-5">
    <div class="card-deck">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">Horas complementares cumpridas</div>
                <div class="card-body">
                    <h3 class="display-4"><?php echo "20h"; ?></h3>
                </div>
            </div>
            <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                <div class="card-header">Horas complementares restantes</div>
                <div class="card-body">
                    <h3 class="display-4"><?php echo "20h"; ?></h3>
                </div>
            </div>
    </div>
</div>
<?php
	require_once'footer.php';
?>