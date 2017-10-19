<?php 
	include_once 'conexao.php';
	session_start();

	if(isset($_POST['acao'])){
		if($_POST['acao'] == 'login'){
			logar();
		}
	}

	function logar(){
		$login = $_POST['inpLogin'];
		$senha = $_POST['inpSenha'];

		if(!empty($login) && !empty($senha)){

			$strcon = startConnection();

			$sqlBusca = "SELECT * FROM tb_alunos WHERE login_aluno = '$login' LIMIT 1";
			
			$result = mysqli_query($strcon, $sqlBusca);

			if($result && ($result->num_rows != 0)){
				$row_aluno = mysqli_fetch_assoc($result);
				if($senha == $row_aluno['senha_aluno']){
					$_SESSION['id_aluno'] 		= $row_aluno['id_aluno'];
					$_SESSION['nome_aluno']	 = $row_aluno['nome_aluno'];
					$_SESSION['email_aluno'] = $row_aluno['email_aluno'];
					$_SESSION['login_aluno'] = $row_aluno['login_aluno'];
					$_SESSION['livro_alugado'] = $row_aluno['livro_alugado'];
					$_SESSION['msg'] = "<script>alert('Seja bem-vindo');</script>";
					header("Location:index.php");
				}else{	
					$_SESSION['msgErro'] = "<b>Senha ou Login inválidos</b>";
					header("Location:login.php");
				}
			}else{
				$_SESSION['msgErro'] = "<b>Senha ou Login inválidos</b>";
				header("Location:login.php");
			}

		}else{
			$_SESSION['msgErro'] = "<b>Preencha todos os campos</b>";
			header("Location:login.php");
		}
	}




?>