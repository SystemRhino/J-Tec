<?php
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}else{
		$id = $_POST['id'];
		$nm_time_1 = $_POST['nm_time_1'];
		$nm_time_2 = $_POST['nm_time_2'];
		$gols_1 = $_POST['gols_1'];
		$gols_2 = $_POST['gols_2'];
		include('conecta.php');
		try {
		  $att_placar = $conn->prepare("UPDATE tb_placar SET nm_time_1 = '$nm_time_1', nm_time_2 = '$nm_time_2', gols_1 = '$gols_1', nm_time_2 = '$nm_time_2' WHERE id = '$id'");
		  $att_placar->execute();
		  echo "<script type='text/javascript'>window.location.reload(true);</script>";
		} catch(PDOException $e) {
		    echo $e;
		}
	}

?>