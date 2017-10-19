<?php 
	session_start(); 
	$btnCancel = filter_input(INPUT_POST, 'btnCancel');

	if($btnCancel){
		unset($_SESSION['livroReserva']);
	}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Biblioteca</title>
</head>
<body>
	<?php include_once 'templates/navbar-logado.php'; ?>
	<h3>Dados Pessoais</h3>
	
	<b>Nome: </b><?php echo $_SESSION['nome_aluno']?><br>
	<b>E-Mail: </b><?php echo $_SESSION['email_aluno']; ?><br>
	<b>Login: </b><?php echo $_SESSION['login_aluno']; ?><br>
	<b>Livro Alugado: </b>
		<?php if($_SESSION['livro_alugado'] == 0){echo "Nenhum";}else{echo "Possui livro";} ?>
	<br>

	<form method="POST" action="#">
		<b>Livro Reservado: </b>
		<?php if(isset($_SESSION['livroReserva'])){ echo $_SESSION['livroReserva'];}else{echo "Nada";} ?>
		<input type="submit" value="Cancelar Reserva" name="btnCancel">
	</form>
		
	
	
</body>
</html>