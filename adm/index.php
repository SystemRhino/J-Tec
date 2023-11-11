<?php  
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}
$dir = basename(__DIR__);
include('../nav.php')
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin | J-Tec</title>
	<meta charset="utf-8">
</head>
<body>

<a href="categoria.php">Categoria</a>
<a href="users.php">Users</a>
<a href="noticia.php">Noticia</a>
<a href="placar.php">Placar</a>
</body>
</html>