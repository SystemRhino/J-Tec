<?php 
require('conecta.php');
	// Verificando se os inputs estão vazios
	if ($_POST['login'] === "" or $_POST['password'] === "" or $_POST['user'] === "") {
		echo "Preencha todos os campos!";
	}else{
		// Armazenando dados em variáveis
		$login = $_POST['login'];
		$senha = $_POST['password'];
		$user = $_POST['user'];
		$id_nivel = $_POST['id_nivel'];

		// Validando E-mail
		$valid_email = strpos( $_POST['login'], '@' );
		$valid_email_ponto = strpos( $_POST['login'], '.' );
		$valid_user_space = strpos( $_POST['user'], ' ' );
		if ($valid_email === false or $valid_email_ponto === false) {
			echo 'Insira um E-mail válido!';
		}elseif(strlen($login) > 80){
			echo "E-mail atingiu o limite máximo de caracteres (80)";
		}elseif(strlen($user) > 80){
			echo "Nome de usuario atingiu o limite máximo de caracteres (80)";
		}elseif(strlen($senha) > 20){
			echo "Senha atingiu o limite máximo de caracteres (20)";
		}elseif($valid_user_space === false){
			// Consultando E-mail
		    $script_email = $conn->prepare('SELECT * FROM tb_users WHERE ds_login = :login');
		    $script_email->bindValue("login", $login);
		    $script_email->execute();

		    // Consultando User
		    $script_user = $conn->prepare('SELECT * FROM tb_users WHERE nm_user = :user');
		    $script_user->bindValue("user", $user);
		    $script_user->execute();

			  // Verificando se o email ou user ja esta em uso
			  if ($script_user->rowCount() > 0) {
			  	 echo "Usuário já cadastrado!";
			  }elseif ($script_email->rowCount() > 0){
			  	 echo "E-mail já cadastrado!";
			  }else{
				 $stmt = $conn->prepare('INSERT INTO tb_users(ds_login, ds_senha, nm_user, id_nivel) VALUES (:login, :senha, :user, :id_nivel)');
					$stmt->execute(array(
				 ':login' => $login,
				 ':senha' => $senha,
				 ':user' => $user,
				 ':id_nivel' => $id_nivel
				 ));
				 echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
				 }
		}else{
			echo 'Nome de usário não pode conter espaço!';
		}
	}
?>