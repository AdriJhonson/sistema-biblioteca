<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Consulta</title>
</head>
<body>
	<?php 
		if(isset($_SESSION['id_aluno'])){
			include_once 'templates/navbar-logado.php';
		}else{
			include_once 'templates/navbar.php';
		}
	?>
	<form action="#" method="POST">
		<table>
			<tr>
				<td><input type="text" name = "tituloLivro" placeholder="Nome do livro"></td>
				<td>
					<select name="categoria">
						<option value="todos">Todos</option>
						<option value="tec_informatica">Tec. Informática</option>
						<option value="tec_enfermagem">Tec. Enfermagem</option>
						<option value="tec_financas">Tec. Finanças</option>
						<option value="tec_moda">Tec. Moda</option>
					</select>
				</td>
				<td><input type="submit" value="Procurar" name="btnBusca"></td>
			</tr>
		</table>
	</form>
	<p></p>
</body>
</html>
<?php 
	include_once 'conexao.php';
	$btnBusca = filter_input(INPUT_POST, 'btnBusca');

	if($btnBusca){

		$nomeLivro = $_POST['tituloLivro'];
		$categoria = $_POST['categoria'];
		
		$strcon = startConnection();
		$resultSet= null;
		
		if($categoria == 'todos'){
			$sql1 = "SELECT l.id_livro, l.editora,
   				MIN(l.titulo_livro), 
    			group_concat(a.nome_autor),
    			group_concat(a.id_autor)
				from tb_livros as l
				join tb_autores as a
    			on (l.id_livro = a.id_livro_escrito)
    			WHERE l.titulo_livro LIKE '%$nomeLivro%'
				group by (l.id_livro)";

			$resultSet = mysqli_query($strcon, $sql1);
		}else{
			$sql2 = "SELECT l.id_livro, l.editora,
					MIN(l.titulo_livro), 
					group_concat(a.nome_autor),
					group_concat(a.id_autor)
					from tb_livros as l join tb_autores as a
					on (l.id_livro = a.id_livro_escrito)
					WHERE categoria = '$categoria' AND titulo_livro LIKE '%$nomeLivro%'
					group by (l.id_livro)";

			$resultSet = mysqli_query($strcon, $sql2);
		}

		echo "<table border = 1>";
			echo "<tr>";
				echo "<th>Título</th>";
				echo "<th>Editora</th>";
				echo "<th>Autor</th>";
				echo "<th>Reservar</th>";
			echo "</tr>";


		if($resultSet && ($resultSet->num_rows != 0)){
			while($row = mysqli_fetch_assoc($resultSet)){
				echo "<tr><td>".utf8_encode($row['MIN(l.titulo_livro)'])."</td>";
			echo "<td>".utf8_encode($row['editora'])."</td>";
			echo "<td>".utf8_encode($row['group_concat(a.nome_autor)'])."</td>";
			echo "<td><a href='reserva.php?titulo=".$row['MIN(l.titulo_livro)']."'>Reservar</a></td></tr>";
			}
		}

	}



?>	