<?php
if(!isset($_POST['nm_user']) || !isset($_POST['ds_login']) || !isset($_POST['ds_senha'])){
	session_start();
	include('conecta.php');
			// Salvando dados do POST
			$id = $_SESSION['id'];
			$nm_user = $_POST['nm_user'];
			$ds_login = $_POST['ds_login'];
			$ds_senha = $_POST['ds_senha'];

			// Consultando login e senha
			$stmt = $conn->prepare("SELECT * FROM tb_users WHERE id='$id'");
			$stmt->execute();
			$dado = $stmt->fetch(PDO::FETCH_ASSOC);

			// Salvando dados do FILES
			$ds_img = $_FILES["ds_img"];
			$ext = substr($ds_img['name'], -4);
			$nomeFinal = $dado['ds_img'];

	if($_FILES['ds_img']['size'] == 0){
		// Upadate
		try {
			$att_user = $conn->prepare("UPDATE tb_users SET `ds_login` = '$ds_login', `ds_senha` = '$ds_senha', `nm_user` = '$nm_user' WHERE (`id` = '$id')");
			$att_user->execute();
			echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
		} catch(PDOException $e) {
			echo $e;
			}
	}else{
			// Verificando extensão
			if($ext == '.jpg' || $ext == 'jpeg' || $ext == '.png'){	
				try {
					if (move_uploaded_file($ds_img['tmp_name'], '../img/'.$nomeFinal)) {
						// Upadate
						$att_user = $conn->prepare("UPDATE tb_users SET `ds_login` = '$ds_login', `ds_senha` = '$ds_senha', `nm_user` = '$nm_user', `ds_img` = '$nomeFinal' WHERE (`id` = '$id');
						");
						$att_user->execute();
						echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
					}else{
						echo 'erro';
					}
				} catch(PDOException $e) {
					echo $e;
				}
			}else{
				echo 'Envie somente arquivos JPG, JPEG ou PNG!';
			}
	}
}else{
	echo 'Não deixe campos vazios!';
}

?>