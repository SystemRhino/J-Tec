<?php 
session_start();
require'php/conecta.php';
if(!isset($_SESSION['id'])){
    header('location:./login.php');
}

//Consulta User
$id = $_SESSION['id'];
$script_user = $conn->prepare("SELECT * FROM tb_users WHERE id ='$id'");
$script_user->execute();
$user = $script_user->fetch(PDO::FETCH_ASSOC);

//Consulta Notícia
$script_noticias = $conn->prepare("SELECT * FROM tb_noticia WHERE id_autor = '$id'");
$script_noticias->execute();

//Consulta Count Notícia
$script_count_noticias = $conn->prepare("SELECT COUNT(*) FROM tb_noticia WHERE id_autor='$id'");
$script_count_noticias->execute();
$count_not = $script_count_noticias->fetch(PDO::FETCH_ASSOC);
$n_de_noticias = $count_not['COUNT(*)'];

//Consulta Count like
$script_count_like = $conn->prepare("SELECT COUNT(*) FROM tb_noticia WHERE id_autor='$id'");
$script_count_like->execute();
$count_like = $script_count_like->fetch(PDO::FETCH_ASSOC);

// Verificação like
if ($count_like['COUNT(*)'] == 0) {
  $like = '0';
}else{
  //Consulta Soma Like
  $script_soma_likes = $conn->prepare("SELECT sum(nr_curtidas) FROM tb_noticia WHERE id_autor='$id'");
  $script_soma_likes->execute();
  $likes = $script_soma_likes->fetch(PDO::FETCH_ASSOC);
  $like = $likes['sum(nr_curtidas)'];
}

//Consulta Count views
$script_count_views = $conn->prepare("SELECT COUNT(*) FROM tb_noticia WHERE id_autor='$id'");
$script_count_views->execute();
$count_views = $script_count_views->fetch(PDO::FETCH_ASSOC);

if ($count_views['COUNT(*)'] == 0) {
  $views = '0';
}else{
  //Consulta Soma Views
  $script_soma_views = $conn->prepare("SELECT sum(views) FROM tb_noticia WHERE id_autor='$id'");
  $script_soma_views->execute();
  $count_views = $script_soma_views->fetch(PDO::FETCH_ASSOC);
  $views = $count_views['sum(views)'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="Cache-Control" content="max-age=0,must-revalidate">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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


<!-- Tag "span" usada para retorno do ajax -->
<span></span>

<!-- Form Editar -->
<br>
<form id="form_edit_user" method="post" enctype="multipart/form-data">
<input type="file" name="ds_img"><br>
<input name="nm_user" value="<?php echo $user['nm_user'];?>"><br>
<input name="ds_login"  value="<?php echo $user['ds_login'];?>"><br>
<input name="ds_senha" value="<?php echo $user['ds_senha'];?>"><br>
<button type="submit" id="salvar">Salvar</button>
</form>

<hr>
<h1>Suas Noticias</h1>
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
<script src="js/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#form_edit_user').submit(function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário
    var form_data = new FormData(this);

  $.ajax({
    url: 'php/edit_user.php', // Arquivo PHP para processar os dados
    type: 'POST',
    data: form_data, 
    contentType: false,
    processData: false,
    success: function(response) {
		$("span").html(response); // Exibe a resposta do servidor
    
      },
    error: function(xhr, status, error) {
    console.log(xhr.responseText);

      }
    });
  });
});
	</script>

<h2>Estatisticas</h2>
<br>
<div>
  <h4>Número de noticias</h4>
  <p><?php echo $n_de_noticias;?></p>
</div>

<div>
  <h4>Número de avaliações</h4>
  <p><?php echo $like;?></p>
</div>

<div>
  <h4>Número de views</h4>
  <p><?php echo $views;?></p>
</div>
</html>
