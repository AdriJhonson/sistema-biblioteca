<?php 
	
	//Função para iniciar uma conexão com o banco de dados;
	function startConnection(){
		$strcon = mysqli_connect('localhost', 'root', '', 'bd_biblioteca') or die('Erro ao se conectar ao banco de dados');
		return $strcon;
	}


?>