<?php 
$URL_ATUAL= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

session_start();
require'php/conecta.php';
$id = $_GET['id'];
if(isset($_SESSION['id'])){
$id_user = $_SESSION['id'];  
}else

//Consulta Notícia
$script_noticias = $conn->prepare("SELECT * FROM tb_noticia WHERE id ='$id'");
$script_noticias->execute();
$noticia = $script_noticias->fetch(PDO::FETCH_ASSOC);
$id_categoria = $noticia['id_categoria'];
$id_autor = $noticia['id_autor'];

//Consultar autor
$script_autor = $conn->prepare("SELECT * FROM tb_users WHERE id ='$id_autor'");
$script_autor->execute();
$autor = $script_autor->fetch(PDO::FETCH_ASSOC);

//Consultar seguindo autor
$script_seguindo_autor = $conn->prepare("SELECT * FROM tb_seguidores WHERE id_autor ='$id_autor' and id_seguidor ='$id_user'");
$script_seguindo_autor->execute();

//Consulta Categoria
$script_categoria = $conn->prepare("SELECT * FROM tb_categoria WHERE id ='$id_categoria'");
$script_categoria->execute();
$categoria = $script_categoria->fetch(PDO::FETCH_ASSOC);

//Consulta Notícias da mesma categoria
$script_noticias_categoria = $conn->prepare("SELECT * FROM tb_noticia WHERE id_categoria ='$id_categoria' and id NOT IN ('$id')");
$script_noticias_categoria->execute();

//Consulta Comentarios
$script_comentarios = $conn->prepare("SELECT * FROM tb_comentario WHERE id_noticia ='$id' ORDER BY id DESC");
$script_comentarios->execute();
?>
<!DOCTYPE html>
<html>
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<meta charset="utf-8">
	<title><?php echo $noticia['nm_noticia']; ?></title>
</head>
<body>
	<img height="450" width="700" src="img/<?php echo $noticia['img_1'];?>"><br>
	<h2><?php echo $noticia['nm_noticia']; ?></h2><br>
	<p><?php echo $noticia['ds_noticia']; ?></p>
	<p><?php echo $noticia['nr_curtidas']; ?></p>
	<div><img width="20" height="20" src="img/<?php echo $autor['ds_img']; ?>"><b><?php echo $autor['nm_user'];?></b></div>

	<!-- Seguir autor -->
	<?php if ($script_seguindo_autor->rowCount()>0){ ?>
	<button id="seguir">Deixar de seguir</button>
	<?php }else{ ?>
	<button id="seguir">Seguir</button>
	<?php } ?>	

	<button id="curtir">Curtir</button><br>

<!-- Compartilhar nas redes sociais -->
<button class="copyTest" data-bs-toggle="modal" data-bs-target="#modalCompartilhar">Compartilhar</button>
<br>
			<!-- Modal -->
			<div class="modal fade" id="modalCompartilhar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			    	<span id="edit"></span>
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Compartilhar nas redes sociais</h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-primary" onclick="window.location.href = 'https://www.facebook.com/sharer/sharer.php?u=<?= $URL_ATUAL?>'">Facebook</button>
			        <button type="button" class="btn btn-primary" onclick="window.location.href = 'https://www.linkedin.com/shareArticle?mini=true&url=<?= $URL_ATUAL?>'">LinkedIn</button>
			        <button type="button" class="btn btn-primary" onclick="window.location.href = 'https://api.whatsapp.com/send?text=<?= $URL_ATUAL?>'">WhatsApp</button>
			      </div>
			    </div>
			  </div>
			</div>

	<!-- Noticias da mesma categoria -->
	<h1>Mais da categoria <?php echo $categoria['nm_categoria']; ?></h1>
<?php while ($noticia_categoria = $script_noticias_categoria->fetch(PDO::FETCH_ASSOC)) { ?>
		<div onclick="window.location.href = 'view.php?id=<?= $noticia_categoria['id']?>'">
			<img width="150" height="150" src="img/<?php echo $noticia_categoria['img_1']; ?>">	
			<p><?php echo $noticia_categoria['nm_noticia']."<br>"; ?></p>
  		</div>
<?php }?>

	<!-- Tag "span" usada para retorno do comentario -->
	<span></span><br>
	<!-- Adiconar Comenatario -->
	<textarea id="comentario" placeholder="Deixe um comentario"></textarea>
	<br><button id="comentar">Comentar</button><br>

	<!-- While dos comentarios -->
	<h2>Comentários</h1>
<?php  
while ($comentario = $script_comentarios->fetch(PDO::FETCH_ASSOC)) {

	$id_user = $comentario['id_user'];
	$script_users = $conn->prepare("SELECT * FROM tb_users WHERE id ='$id_user'");
	$script_users->execute();	
	$user = $script_users->fetch(PDO::FETCH_ASSOC);

	?>
	<img height="50" width="50" src="img/<?php echo $user['ds_img'];?>"><b><?php echo $user['nm_user'];?></b><p><i><?php echo $comentario['comentario']?></i></p><p><?php echo $comentario['data'];?></p>
	<hr>
<?php }?>
</body>

<script src="./js/jquery-3.6.0.min.js"></script>
        <script>

// Comentar
$(document).ready(function(){
  $("#comentar").click(function(){
    $.ajax({
    url: "php/script_comentar.php",
    type: "POST",
    data: "comentario="+$("#comentario").val()+"&id_noticia="+<?php echo $id;?>+"&id_user="+<?php echo $id_user;?>,
    dataType: "html"

    }).done(function(resposta) {
        $("span").html(resposta);
        console.log(resposta);

    }).fail(function(jqXHR, textStatus ) {
        console.log("Request failed: " + textStatus);

    }).always(function() {
        console.log("completou");
    });
  });
});

// Curtir
$(document).ready(function(){
  $("#curtir").click(function(){
    $.ajax({
    url: "php/script_like.php",
    type: "POST",
    data: "id_noticia="+<?php echo $id;?>+"&id_user="+<?php echo $id_user;?>,
    dataType: "html"

    }).done(function(resposta) {
        $("span").html(resposta);
        console.log(resposta);

    }).fail(function(jqXHR, textStatus ) {
        console.log("Request failed: " + textStatus);

    }).always(function() {
        console.log("completou");
    });
  });
});

// Seguir
$(document).ready(function(){
  $("#seguir").click(function(){
    $.ajax({
    url: "php/script_seguir.php",
    type: "POST",
    data: "id_autor="+<?php echo $id_autor;?>+"&id_user="+<?php echo $id_user;?>,
    dataType: "html"

    }).done(function(resposta) {
        $("span").html(resposta);
        console.log(resposta);

    }).fail(function(jqXHR, textStatus ) {
        console.log("Request failed: " + textStatus);

    }).always(function() {
        console.log("completou");
    });
  });
});


// Função copiar url
function copyTextToClipboard(text) {
  var textArea = document.createElement("textarea");
  textArea.value = text;

  document.body.appendChild(textArea);
  textArea.select();

  try {
    var successful = document.execCommand('copy');
  } catch (err) {
    console.log('Oops, unable to copy');
  }

  document.body.removeChild(textArea);
}

// Teste
var copyTest = document.querySelector('.copyTest');
copyTest.addEventListener('click', function(event) {
  copyTextToClipboard('<?php echo $URL_ATUAL;?>');
});
        </script>
</html>