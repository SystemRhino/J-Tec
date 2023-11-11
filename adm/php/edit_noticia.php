<?php
/* 
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
		  $att_noticia = $conn->prepare("UPDATE tb_noticia SET nm_noticia = '$nm_noticia', ds_noticia = '$ds_noticia', id_categoria = '$categoria', id_autor = '$autor' WHERE id = '$id'");
		  $att_noticia->execute();
		  echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
		} catch(PDOException $e) {
		    echo $e;
		}
	}
*/
?>


<?php

	session_start();
	include('conecta.php');
			// Salvando dados do POST
			$id = $_SESSION['id'];
			$nm_noticia = $_POST['nm_noticia'];
        	$ds_noticia = $_POST['ds_noticia'];
        	$categoria = $_POST['categoria'];
        	$autor = $_POST['autor'];
        	
			// Consultando login e senha
			$stmt = $conn->prepare("SELECT * FROM tb_noticia WHERE id_autor='$id'");
			$stmt->execute();
			$dado = $stmt->fetch(PDO::FETCH_ASSOC);
if ($id !== $dado['id_autor']) {
			// Salvando dados do FILES
			$ds_img = $_FILES["ds_img"];
			$ext = substr($ds_img['name'], -4);
			$nomeFinal = $dado['img_1'];

	if($_FILES['ds_img']['size'] == 0){
		// Upadate
			try {
			  $att_categoria = $conn->prepare("UPDATE tb_noticia SET nm_noticia = '$nm_noticia', ds_noticia = '$ds_noticia', id_categoria = '$categoria'WHERE id = '$id'"); // Pegar id da noticia
			  $att_categoria->execute();
			  echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
			} catch(PDOException $e) {
			    echo $e;
			}
		}
	}else{
			// Verificando extensão
			if($ext == '.jpg' || $ext == 'jpeg' || $ext == '.png'){	
				try {
					if (move_uploaded_file($ds_img['tmp_name'], '../img/'.$nomeFinal)) {
						// Upadate
						$att_user = $conn->prepare("UPDATE tb_noticia SET nm_noticia = '$nm_noticia', ds_noticia = '$ds_noticia', id_categoria = '$categoria' img_1 = '$nomeFinal' WHERE id = '$id'");
						$att_user->execute();
						echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
					}else{
						echo 'erro';
					}
				} catch(PDOException $e) {
					echo $e;
				}
			}else{
				echo 'Envie somente arquivos JPG, JPEG ou PNG!';
			}
	}
}

?>