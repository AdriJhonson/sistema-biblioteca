<?php 
	session_start();
	$titulo_livro = $_GET['titulo'];


	if(isset($_SESSION['id_aluno'])){
		
		if(isset($_SESSION['livroReserva'])){
			$_SESSION['msg'] = "<script>alert('Você já resevou um livro.');</script>";
			header("Location:index.php");
		}else{
			$_SESSION['msg'] = "<script>alert('O livro foi reservado com sucesso.');</script>";
			$_SESSION['livroReserva'] = $titulo_livro;
			header("Location:index.php");
		}
	}else{
		$_SESSION['msg'] = "<script>alert('Você precisa está logado para realizar a reservar de um livro.');</script>";
		header("Location:index.php");
	}


?>