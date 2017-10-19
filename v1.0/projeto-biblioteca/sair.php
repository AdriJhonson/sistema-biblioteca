<?php 

	session_start();

	unset($_SESSION['id_aluno'], $_SESSION['nome_aluno'], $_SESSION['email_aluno'], $_SESSION['login_aluno'], $_SESSION['livro_alugado']);
	
	$_SESSION['msg'] = "<script>alert('Deslogado com sucesso');</script>";

	header("Location:index.php");



	 		 
	 




?>