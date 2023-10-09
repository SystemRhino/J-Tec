<?php
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}else{
		$id = $_GET['id'];
		include('conecta.php');
		try {
		  $delete_categoria = $conn->prepare("DELETE FROM tb_users WHERE (`id` = '$id')");
		  $delete_categoria->execute();
		  header('location:../users.php');
		} catch(PDOException $e) {
		    echo $e;
		}
	}

?>