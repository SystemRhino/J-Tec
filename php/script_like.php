<?php
include('conecta.php');
$id_noticia = $_POST['id_noticia'];
$id_user = $_POST['id_user'];

	// Consultar likes
	$script_like = $conn->prepare("SELECT * FROM tb_like WHERE id_noticia = '$id_noticia' and id_user = '$id_user'");
	$script_like->execute();
	$like = $script_like->fetch(PDO::FETCH_ASSOC);

	// Consultar quantos likes
	$script_noticia = $conn->prepare("SELECT * FROM tb_noticia WHERE id = '$id_noticia'");
	$script_noticia->execute();
	$qnt_like = $script_noticia->fetch(PDO::FETCH_ASSOC);

	// Verificar se o usuario ja curtiu
	if ($script_like->rowCount()>0){
		$id_like = $like['id'];
		$qnt = $qnt_like['nr_curtidas']-1;
		  $att_like = $conn->prepare("UPDATE `tb_noticia` SET `nr_curtidas` = '$qnt' WHERE (`id` = '$id_noticia');");
		  $att_like->execute();

		   // Remove curtida
		  $att_like = $conn->prepare("DELETE FROM tb_like WHERE (`id` = '$id_like')");
		  $att_like->execute();
		  echo "<script type='text/javascript'>window.location.reload(true);</script>";

	}else{
		$qnt = $qnt_like['nr_curtidas']+1;
		  $att_like = $conn->prepare("UPDATE `tb_noticia` SET `nr_curtidas` = '$qnt' WHERE (`id` = '$id_noticia');");
		  $att_like->execute();

		// Adiciona curtida  
		$stmt = $conn->prepare('INSERT INTO tb_like (id_user, id_noticia) VALUES(:id_user, :id_noticia)');
    	$stmt->execute(array(
	    ':id_user' => $id_user,
	    ':id_noticia' => $id_noticia
  		));
  		echo "<script type='text/javascript'>window.location.reload(true);</script>";
	}


?>