<?php
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}else{
		$id = $_GET['id'];
		include('conecta.php');
		try {
		  $delete_noticia = $conn->prepare("DELETE FROM tb_noticia WHERE (`id` = '$id')");
		  $delete_noticia->execute();
		  header('location:../noticia.php');
		} catch(PDOException $e) {
		    echo $e;
		}
	}

?>