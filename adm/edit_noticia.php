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
		  echo "<script type='text/javascript'>window.location.reload(true);</script>";
		} catch(PDOException $e) {
		    echo $e;
		}	
	}
*/
?>


<?php

	session_start();
	include('php/conecta.php');
			// Salvando dados do POST
			$id = $_POST['id'];
			$nm_noticia = $_POST['nm_noticia'];
        	$ds_noticia = $_POST['ds_noticia'];
        	$categoria = $_POST['categoria'];
        	$autor = $_POST['autor'];
        	
			// Consultando noticia
			$stmt = $conn->prepare("SELECT * FROM tb_noticia WHERE id='$id'");
			$stmt->execute();
			$dado = $stmt->fetch(PDO::FETCH_ASSOC);

			// Salvando dados do FILES
			$ds_img = $_FILES["ds_img"];
			$ext = substr($ds_img['name'], -4);
			$nomeFinal = $dado['img_1'];

			$ds_img_2 = $_FILES["ds_img_2"];
			$ext_2 = substr($ds_img_2['name'], -4);
			$nomeFinal_2 = $dado['img_2'];

	if($_FILES['ds_img']['size'] == 0 && $_FILES['ds_img_2']['size'] == 0){
		// Upadate
			try {
			  $att_categoria = $conn->prepare("UPDATE tb_noticia SET nm_noticia = '$nm_noticia', ds_noticia = '$ds_noticia', id_categoria = '$categoria'WHERE id = '$id'"); // Pegar id da noticia
			  $att_categoria->execute();
			  echo "<script type='text/javascript'>window.location.reload(true);</script>";
			} catch(PDOException $e) {
			    echo $e;
			}
		}elseif($_FILES['ds_img']['size'] > 0 && $_FILES['ds_img_2']['size'] == 0){
			// Verificando extensão
			if($ext == '.jpg' || $ext == 'jpeg' || $ext == '.png'){	
				try {
					if (move_uploaded_file($ds_img['tmp_name'], '../img/'.$nomeFinal)) {
						// Upadate
						$att_user = $conn->prepare("UPDATE tb_noticia SET nm_noticia = '$nm_noticia', ds_noticia = '$ds_noticia', id_categoria = '$categoria', img_1 = '$nomeFinal' WHERE id = '$id'");
						$att_user->execute();
						echo "<script type='text/javascript'>window.location.reload(true);</script>";
					}else{
						echo 'erro';
					}
				} catch(PDOException $e) {
					echo $e;
				}
			}else{
				echo 'Envie somente arquivos JPG, JPEG ou PNG!';
			}
	}elseif($_FILES['ds_img']['size'] == 0 && $_FILES['ds_img_2']['size'] > 0){
			// Verificando extensão
			if($ext_2 == '.jpg' || $ext_2 == 'jpeg' || $ext_2 == '.png'){	
				try {
					if (move_uploaded_file($ds_img_2['tmp_name'], '../img/'.$nomeFinal_2)) {
						// Upadate
						$att_user = $conn->prepare("UPDATE tb_noticia SET nm_noticia = '$nm_noticia', ds_noticia = '$ds_noticia', id_categoria = '$categoria', img_2 = '$nomeFinal_2' WHERE id = '$id'");
						$att_user->execute();
						echo "<script type='text/javascript'>window.location.reload(true);</script>";
					}else{
						echo 'erro';
					}
				} catch(PDOException $e) {
					echo $e;
				}
			}else{
				echo 'Envie somente arquivos JPG, JPEG ou PNG!';
			}
	}else{
			// Verificando extensão
			if($ext == '.jpg' || $ext == 'jpeg' || $ext == '.png' || $ext_2 == '.jpg' || $ext_2 == 'jpeg' || $ext_2 == '.png'){	
				try {
					if (move_uploaded_file($ds_img['tmp_name'], '../img/'.$nomeFinal) && move_uploaded_file($ds_img_2['tmp_name'], '../img/'.$nomeFinal_2)) {
						// Upadate
						$att_user = $conn->prepare("UPDATE tb_noticia SET nm_noticia = '$nm_noticia', ds_noticia = '$ds_noticia', id_categoria = '$categoria', img_1 = '$nomeFinal', img_2 = '$nomeFinal_2' WHERE id = '$id'");
						$att_user->execute();
						echo "<script type='text/javascript'>window.location.reload(true);</script>";
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
?>