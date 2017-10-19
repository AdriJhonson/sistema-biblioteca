<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>
	<?php
		session_start(); 
		include('templates/navbar.php'); 
		if(isset($_SESSION['msgErro'])){
			echo $_SESSION['msgErro'];
			unset($_SESSION['msgErro']);
		}
	?>
	<br>
	<form action="processa.php" method="POST">
		<table>
			<tr>
				<td>Login </td>
				<td><input type="text" name="inpLogin"></td>
			</tr>
			<tr>
				<td>Senha</td>
				<td><input type="password" name="inpSenha"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="acao" value="login"></td>
				<td><input type="submit" name="btnLogin" value="Enviar"></td>
			</tr>
		</table>
	</form>
</body>
</html>