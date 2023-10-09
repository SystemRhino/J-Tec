<?php
include('conecta.php');
$id_autor = $_POST['id_autor'];
$id_user = $_POST['id_user'];

	// Consultar se usuario segue autor
	$script_segue_autor = $conn->prepare("SELECT * FROM tb_seguidores WHERE id_autor = '$id_autor' and id_seguidor = '$id_user'");
	$script_segue_autor->execute();

	// Verificar se usuario segue autor
	if ($script_segue_autor->rowCount()>0){

		   // Remove seguidor
		  $att_seguidor = $conn->prepare("DELETE FROM tb_seguidores WHERE id_autor = '$id_autor' and id_seguidor = '$id_user'");
		  $att_seguidor->execute();
		  echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";

	}else{

		// Adiciona seguidor
		$stmt = $conn->prepare('INSERT INTO tb_seguidores (id_seguidor, id_autor) VALUES(:id_seguidor, :id_autor)');
    	$stmt->execute(array(
	    ':id_seguidor' => $id_user,
	    ':id_autor' => $id_autor
  		));
  		echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
	}


?>