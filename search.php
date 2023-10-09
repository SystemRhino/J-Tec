<?php  
include('php/conecta.php');
session_start();


//Consulta Categoria
$script_categoria = $conn->prepare("SELECT * FROM tb_categoria");
$script_categoria->execute();

//Consulta Comentarios
$script_comentarios = $conn->prepare("SELECT * FROM tb_comentario ORDER BY id DESC");
$script_comentarios->execute();

if (!isset($_GET['data']) or $_GET['data']==="") {
	header("Location: ./");
	exit;
}
 
$data = "%".trim($_GET['data'])."%";
 
$search_nm = $conn->prepare('SELECT * FROM `tb_noticia` WHERE `nm_noticia` LIKE :data');
$search_nm->bindParam(':data', $data, PDO::PARAM_STR);
$search_nm->execute();
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

<!-- While Noticias -->
<?php  if ($search_nm->rowCount()<1){ ?>
	<h1>Nenhum resultado encontrado da pesquisa '<?php echo $_GET['data'];?>'</h1>
<?php }else{ ?>
	<h1>Resultado da pesquisa '<?php echo $_GET['data'];?>'</h1>
<?php } ?>
<?php while ($noticia = $search_nm->fetch(PDO::FETCH_ASSOC)) { ?>
		<div onclick="window.location.href = 'view.php?id=<?= $noticia['id']?>'">
			<img width="150" height="150" src="img/<?php echo $noticia['img_1']; ?>">	
			<p><?php echo $noticia['nm_noticia']."<br>"; ?></p>
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
	<b><?php echo $user['nm_user'];?></b><p><i><?php echo $comentario['comentario']?></i></p><p><?php echo $comentario['data'];?></p>
	<hr>
<?php }?>
</body>
</html>