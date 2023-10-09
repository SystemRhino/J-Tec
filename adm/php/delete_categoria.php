<?php
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}else{
		$id = $_GET['id'];
		include('conecta.php');
		try {
		  $delete_categoria = $conn->prepare("DELETE FROM tb_categoria WHERE (`id` = '$id')");
		  $delete_categoria->execute();
		  header('location:../categoria.php');
		} catch(PDOException $e) {
		    echo $e;
		}
	}

?>