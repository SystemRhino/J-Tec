<?php
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}else{

	// Validação
	if ($_POST['categoria'] === "") {
		echo "Escreva algo como nome!";
	}elseif (strlen($_POST['categoria']) > 45) {
		echo "Número máximo de caracteres atigindo (45)";
	}else{
		include('conecta.php');
		
		try {
		  $stmt = $conn->prepare('INSERT INTO tb_categoria (nm_categoria) VALUES(:nm_categoria)');
		  $stmt->execute(array(
		    ':nm_categoria' => $_POST['categoria']
		  ));
		  echo "Cadastrado com sucesso!";
		  echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
		} catch(PDOException $e) {
		    echo $e;
		}
	}
}

?>