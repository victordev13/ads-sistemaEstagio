<?php
    require_once 'header.php';
    require_once '../db/db_connect.php';
	require_once '../classes/aluno.class.php';
	$connect = Conexao();
?>
<body>
<div class="row justify-content-center align-items-center" style="height:80vh; width: 100%">
    <div class="col-md-3">
		<div class="card">
			<div class="card-body"> 
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" id="alterarSenha">
					<?php
					if(isset($_POST)){
						if(isset($_POST['senha_antiga']) && isset($_POST['nova_senha']) && isset($_POST['confirma_nova_senha'])){
							$senhaAntiga = tratarString($_POST['senha_antiga']);
							$senhaAntiga = md5($senhaAntiga);
							$alunoId = $_SESSION['login_aluno_id'];
							$sql = "SELECT senha FROM login_aluno WHERE login_aluno_id = '$alunoId'";
							$resultado = mysqli_query($connect, $sql);
							$dados = mysqli_fetch_array($resultado);
							$senhaCadastrada = $dados[0];
							$senhaNova = tratarString($_POST['nova_senha']);
							$senhaNova = md5($senhaNova);
							$confirmaSenhaNova = tratarString($_POST['confirma_nova_senha']);
							$confirmaSenhaNova = md5($confirmaSenhaNova);
							if($senhaAntiga !=$senhaCadastrada){
								$erro = "Senha cadastrada não confere!";
							}else{
								if($senhaNova != $confirmaSenhaNova){
									$erro = "Nova senha não confere!";
								}else{
									$sql = "UPDATE login_aluno SET senha='$senhaNova' WHERE login_aluno_id='$alunoId'";
									$resultado = mysqli_query($connect, $sql);
									if($resultado){
										$sucesso = "Senha alterada com sucesso!";
									}else{
										$erro = "Ocorreu um erro ao alterar a senha!";
									}
								}
							}
						}
					}
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
					<div class="form-group">
					<label for="senha antiga">Senha Antiga:</label>
						<input type="password" class="form-control" id="senha_antiga" name="senha_antiga" required="" minlength=6 maxlength=12 p" title="Digite a sua senha antiga">
					</div>
					<div class="form-group">
						<label for="nova_senha">Nova senha:</label>
						<input type="password" class="form-control" id="nova_senha" name="nova_senha" required="" minlength=6 maxlength=12 title="A nova senha deve ter entre 6 e 12 caracteres">
					</div>
					<div class="form-group">
						<label for="confirma_nova_senha">Confirme a nova senha:</label>
						<input type="password" class="form-control" id="confirma_nova_senha" name="confirma_nova_senha" required="" minlength=6 maxlength=12 title="Repita a senha">
					</div>
						<button type="submit" class="btn btn-default btn-green-fvc" name="submit">Alterar</button>
				</form>
        	</div>
		</div>
    </div>
</body>
<script>
</script>
<?php
	FecharConexao($connect);
	require_once 'footer.php';
?>