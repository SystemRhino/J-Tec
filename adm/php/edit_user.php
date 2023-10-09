<?php
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}else{
		$id = $_POST['id'];
		$nm_user = $_POST['nm_user'];
        $ds_login = $_POST['ds_login'];
        $ds_senha = $_POST['ds_senha'];
        $id_nivel = $_POST['id_nivel'];
		include('conecta.php');
		try {
		  $att_user = $conn->prepare("UPDATE tb_users SET `ds_login` = '$ds_login', `ds_senha` = '$ds_senha', `nm_user` = '$nm_user', `ds_img` = 'user.png', `id_nivel` = '$id_nivel' WHERE (`id` = '$id');
          ");
		  $att_user->execute();
		  echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
		} catch(PDOException $e) {
		    echo $e;
		}
	}

?>