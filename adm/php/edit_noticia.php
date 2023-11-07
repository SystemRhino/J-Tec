<?php
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}else{
		$id = $_POST['id'];
		$nm_noticia = $_POST['nm_noticia'];
        $ds_noticia = $_POST['ds_noticia'];
        $categoria = $_POST['categoria'];
        $autor = $_POST['autor'];
		include('conecta.php');
		try {
		  $att_categoria = $conn->prepare("UPDATE tb_noticia SET nm_noticia = '$nm_noticia', ds_noticia = '$ds_noticia', id_categoria = '$categoria', id_autor = '$autor' WHERE id = '$id'");
		  $att_categoria->execute();
		  echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
		} catch(PDOException $e) {
		    echo $e;
		}
	}

?>