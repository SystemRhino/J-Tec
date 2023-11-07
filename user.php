<?php 
session_start();
require'php/conecta.php';
if(!isset($_GET['name'])){
    header('location:./login.php');
}

//Consulta User
$nm_user = $_GET['name'];
$script_user = $conn->prepare("SELECT * FROM tb_users WHERE nm_user ='$nm_user'");
$script_user->execute();

//Verifiando se o user existe
if ($script_user->rowCount()==0){
    header('location:./login.php');
}else{
    $user = $script_user->fetch(PDO::FETCH_ASSOC);
    $id = $user['id']; 
}

//Consulta Notícia
$script_noticias = $conn->prepare("SELECT * FROM tb_noticia WHERE id_autor = '$id'");
$script_noticias->execute();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $user['nm_user']; ?></title>
</head>
<body>
<!-- Nav -->
<?php include('nav.php');?>

<img width="250" height="250" src="img/<?php echo $user['ds_img'];?>">
<p><?php echo $user['nm_user'];?></p>
<p><?php echo $user['ds_login'];?></p>
<?php if($user['id_nivel'] = 1){?>
<b style="color: purple;">Admin</b>
<?php }?>


<hr>
<h1>Notícias desse Usuário</h1>
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
?>
</body>
</html>
