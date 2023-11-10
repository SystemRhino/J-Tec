<?php  
include('php/conecta.php');
session_start();

//Consulta Placar
$script_placar = $conn->prepare("SELECT * FROM tb_placar");
$script_placar->execute();
$placar = $script_placar->fetch(PDO::FETCH_ASSOC);

//Consulta Notícias em Alta
$script_noticias_alta = $conn->prepare("SELECT * FROM tb_noticia  ORDER BY views DESC");
$script_noticias_alta->execute();

//Consulta Notícias Populares
$script_noticias_populares = $conn->prepare("SELECT * FROM tb_noticia  ORDER BY nr_curtidas DESC");
$script_noticias_populares->execute();

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
//Consulta Últimas Notícia
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
<!-- Nav -->
<?php include('nav.php');?>

<!-- While categoria -->
<?php  while ($categoria = $script_categoria->fetch(PDO::FETCH_ASSOC)) { ?>
	<button onclick="window.location.href = 'index.php?categoria=<?= $categoria['id']?>'"><?php echo $categoria['nm_categoria']; ?></button>
<?php } ?>
<hr>

<!-- Placar -->
<?php if($script_placar->rowCount()>0){?>
<div>
<?php echo $placar['nm_time_1']." ".$placar['gols_1'];?> <b>X</b> <?php echo $placar['nm_time_2']." ".$placar['gols_2'];?>
</div>
<?php }?>
<br>

<!-- While Últimas Noticias -->
	<h1><?php echo $text?></h1>
<?php
// Verificação se tem noticias
if ($script_noticias->rowCount()>0){
while ($noticia = $script_noticias->fetch(PDO::FETCH_ASSOC)) { 
//Consulta Autor
$id_autor = $noticia['id_autor'];
$script_nome_autor = $conn->prepare("SELECT * FROM tb_users WHERE id = '$id_autor'");
$script_nome_autor->execute();
$nome_autor = $script_nome_autor->fetch(PDO::FETCH_ASSOC);
?>
		<div onclick="window.location.href = 'view.php?id=<?= $noticia['id']?>'">
			<img width="150" height="150" src="img/<?php echo $noticia['img_1']; ?>">	
			<p><?php echo $noticia['nm_noticia']."<br>"; ?></p>
			<p>Autor: <?php echo $nome_autor['nm_user']."<br>"; ?></p>
  		</div>
<?php 
}
}else{
	echo "Sem noticia";
}

// Verificação se tem filtro
if(!isset($_GET['categoria'])){ ?>
<hr>

<!-- Notícias em Alta -->
<h1>Em Alta</h1>
<?php while ($noticia_alta = $script_noticias_alta->fetch(PDO::FETCH_ASSOC)) { 
$id_autor_alta = $noticia_alta['id_autor'];
$script_nome_autor_alta = $conn->prepare("SELECT * FROM tb_users WHERE id = '$id_autor_alta'");
$script_nome_autor_alta->execute();
$nome_autor_alta = $script_nome_autor_alta->fetch(PDO::FETCH_ASSOC);
?>
		<div onclick="window.location.href = 'view.php?id=<?= $noticia_alta['id']?>'">
			<img width="150" height="150" src="img/<?php echo $noticia_alta['img_1']; ?>">	
			<p><?php echo $noticia_alta['nm_noticia']."<br>"; ?></p>
			<p>Autor: <?php echo $nome_autor_alta['nm_user']."<br>"; ?></p>
  		</div>
<?php }}?>

<!-- Notícias Populares -->
<h1>Mais Populares</h1>
<?php while ($noticia_populares = $script_noticias_populares->fetch(PDO::FETCH_ASSOC)) { 
$id_autor_popular = $noticia_populares['id_autor'];
$script_nome_autor_popular = $conn->prepare("SELECT * FROM tb_users WHERE id = '$id_autor_popular'");
$script_nome_autor_popular->execute();
$nome_autor_popular = $script_nome_autor_popular->fetch(PDO::FETCH_ASSOC);
?>
		<div onclick="window.location.href = 'view.php?id=<?= $noticia_populares['id']?>'">
			<img width="150" height="150" src="img/<?php echo $noticia_populares['img_1']; ?>">	
			<p><?php echo $noticia_populares['nm_noticia']."<br>"; ?></p>
			<p>Autor: <?php echo $nome_autor_popular['nm_user']."<br>"; ?></p>
  		</div>
<?php }?>

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
	<div onclick="window.location.href = 'view.php?id=<?= $comentario['id_noticia']?>'"><b><?php echo $user['nm_user'];?></b><p><i><?php echo $comentario['comentario']?></i></p><p><?php echo $comentario['data'];?></p></div>
	<hr>
<?php }?>

<!-- Footer -->
<?php include('footer.php');?>
</body>
</html>