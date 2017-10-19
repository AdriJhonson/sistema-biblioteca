<?php 
	include_once 'conexao.php'; 
	session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Home</title>
</head>
<body>
	<?php
		//Mensagens de aviso;
		if(isset($_SESSION['msg'])){
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}

		//Navbar;
		if(isset($_SESSION['id_aluno'])){
			include_once 'templates/navbar-logado.php';
		}else{
			include_once 'templates/navbar.php';
		}

		$titLivros = array();
		$autores = array();

		//Puxando os dados do banco de dados;
		$strcon = startConnection();

		$sql = "SELECT l.id_livro, l.editora,
   				MIN(l.titulo_livro), 
    			group_concat(a.nome_autor),
    			group_concat(a.id_autor)
				from tb_livros as l join tb_autores as a
    			on (l.id_livro = a.id_livro_escrito)
				group by (l.id_livro)";

		$result_set = mysqli_query($strcon, $sql);

		echo "<table border = 1>";
			echo "<tr>";
				echo "<th>Título</th>";
				echo "<th>Editora</th>";
				echo "<th>Autor</th>";
				echo "<th>Reservar</th>";
			echo "</tr>";


		while($row = mysqli_fetch_assoc($result_set)){
			echo "<tr><td>".utf8_encode($row['MIN(l.titulo_livro)'])."</td>";
			echo "<td>".utf8_encode($row['editora'])."</td>";
			echo "<td>".utf8_encode($row['group_concat(a.nome_autor)'])."</td>";
			echo "<td><a href='reserva.php?titulo=".$row['MIN(l.titulo_livro)']."'>Reservar</a></td></tr>";
		}

		echo "</table>";

	?>
</body>
</html>