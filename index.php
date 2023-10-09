<?php  
include('php/conecta.php');
session_start();

//Consulta Notícia
$script_noticias_alta = $conn->prepare("SELECT * FROM tb_noticia  ORDER BY nr_curtidas DESC");
$script_noticias_alta->execute();

//Consulta Comentarios
$script_comentarios = $conn->prepare("SELECT * FROM tb_comentario ORDER BY id DESC LIMIT 5");
$script_comentarios->execute();

//Consulta Categoria
$script_categoria = $conn->prepare("SELECT * FROM tb_categoria");
$script_categoria->execute();

if(isset($_GET['categoria'])){
$id_categoria = $_GET['categoria'];
//Consulta Notícia Filtro Categoria
$script_noticias = $conn->prepare("SELECT * FROM tb_noticia WHERE id_categoria = '$id_categoria'");
$script_noticias->execute();
$text = "Busca por Categoria";
}else{
//Consulta Notícia
$script_noticias = $conn->prepare("SELECT * FROM tb_noticia ORDER BY id DESC LIMIT 5");
$script_noticias->execute();
$text = "Últimas Notícias";
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home | J-Tec	</title>
</head>
<body>
<!-- Pesquisar -->
<form action="search.php" method="GET">
	<input type="text" name="data" placeholder="Pesquise uma noticia">
	<input type="submit" value="Pesquisar">
</form>
<hr>

<!-- While categoria -->
<?php  while ($categoria = $script_categoria->fetch(PDO::FETCH_ASSOC)) { ?>
	<button onclick="window.location.href = 'index.php?categoria=<?= $categoria['id']?>'"><?php echo $categoria['nm_categoria']; ?></button>
<?php } ?>
<hr>

<!-- While Noticias -->
	<h1><?php echo $text?></h1>
<?php
// Verificação se tem noticias
if ($script_noticias->rowCount()>0){
while ($noticia = $script_noticias->fetch(PDO::FETCH_ASSOC)) { 
?>
		<div onclick="window.location.href = 'view.php?id=<?= $noticia['id']?>'">
			<img width="150" height="150" src="img/<?php echo $noticia['img_1']; ?>">	
			<p><?php echo $noticia['nm_noticia']."<br>"; ?></p>
  		</div>
<?php 
}
}else{
	echo "Sem noticia";
}
// Verificação se tem filtro
if(!isset($_GET['categoria'])){ ?>
<hr>
<h1>Em Alta</h1>
<?php while ($noticia_alta = $script_noticias_alta->fetch(PDO::FETCH_ASSOC)) { ?>
		<div onclick="window.location.href = 'view.php?id=<?= $noticia_alta['id']?>'">
			<img width="150" height="150" src="img/<?php echo $noticia_alta['img_1']; ?>">	
			<p><?php echo $noticia_alta['nm_noticia']."<br>"; ?></p>
  		</div>
<?php }}?>

<!-- While Comentarios -->
<hr>
<h1>Últimos comentarios</h1>
<?php  
while ($comentario = $script_comentarios->fetch(PDO::FETCH_ASSOC)) {
	$id_user = $comentario['id_user'];
	$script_users = $conn->prepare("SELECT * FROM tb_users WHERE id ='$id_user'");
	$script_users->execute();	
	$user = $script_users->fetch(PDO::FETCH_ASSOC);
	?>
	<b><?php echo $user['nm_user'];?></b><p><i><?php echo $comentario['comentario']?></i></p><p><?php echo $comentario['data'];?></p>
	<hr>
<?php }?>
</body>
</html>