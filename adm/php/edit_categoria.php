<?php
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}else{
		$id = $_POST['id'];
		$nm_categoria = $_POST['nm_categoria'];
		include('conecta.php');
		try {
		  $att_categoria = $conn->prepare("UPDATE tb_categoria SET nm_categoria = '$nm_categoria' WHERE id = '$id'");
		  $att_categoria->execute();
		  echo "<script type='text/javascript'>window.location.reload(true);</script>";
		} catch(PDOException $e) {
		    echo $e;
		}
	}

?>