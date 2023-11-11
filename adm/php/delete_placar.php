<?php
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}else{
		$id = $_GET['id'];
		include('conecta.php');
		try {
		  $delete_placar = $conn->prepare("DELETE FROM tb_placar WHERE (`id` = '$id')");
		  $delete_placar->execute();
		  header('location:../placar.php');
		} catch(PDOException $e) {
		    echo $e;
		}
	}

?>