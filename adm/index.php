<?php  
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin | J-Tec</title>
	<meta charset="utf-8">
</head>
<body>

<a href="categoria.php">Cadsatrar Categoria</a>
<a>Cadastrar Noticia</a>

</body>
</html>