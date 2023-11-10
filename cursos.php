<?php
include('php/conecta.php');
include('nav.php');
if(!isset($_GET['id'])){
    header('location:./');
}
$id = $_GET['id'];

//Consulta Comentarios
$script_cursos = $conn->prepare("SELECT * FROM tb_cursos WHERE id ='$id'");
$script_cursos->execute();
$curso = $script_cursos->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<meta charset="utf-8">
	<title><?php echo $curso['nm_curso']; ?></title>
</head>
<body>
<h1><?php echo $curso['nm_curso']; ?></h1>

<p><?php echo $curso['ds_curso']; ?></p>
</body>
</html>