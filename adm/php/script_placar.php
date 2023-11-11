<?php
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}else{

	// Validação
	if ($_POST['nm_time_1'] === "" || $_POST['nm_time_2'] === "" || $_POST['gols_1'] === "" ||  $_POST['gols_2'] === "") {
		echo "Preencha todos os campos!";
	}else{
		include('conecta.php');
		try {
		  $stmt = $conn->prepare('INSERT INTO tb_placar (nm_time_1, gols_1, nm_time_2, gols_2) VALUES(:nm_time_1, :gols_1, :nm_time_2, :gols_2)');
		  $stmt->execute(array(
		    ':nm_time_1' => $_POST['nm_time_1'],
		    ':gols_1' => $_POST['gols_1'],
		    ':nm_time_2' => $_POST['nm_time_2'],
		    ':gols_2' => $_POST['gols_2']
		  ));
		  echo "Cadastrado com sucesso!";
		  echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
		} catch(PDOException $e) {
		    echo $e;
		}
	}
}

?>