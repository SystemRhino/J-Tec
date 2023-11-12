<?php  
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}
include('php/conecta.php');
include('php/nav.php');

//Consulta Categoria
$script_categoria = $conn->prepare("SELECT * FROM tb_categoria");
$script_categoria->execute();

//Consulta Noitcia
$script_noticia = $conn->prepare("SELECT * FROM tb_noticia");
$script_noticia->execute();

//Consulta Noitcia
$script_user = $conn->prepare("SELECT * FROM tb_users");
$script_user->execute();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Categoria | J-Tec</title>
	<meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
	<!-- CSS -->
	<style>
		table {
			border:1px solid #b3adad;
			border-collapse:collapse;
			padding:5px;
		}
		table th {
			border:1px solid #b3adad;
			padding:5px;
			background: #f0f0f0;
			color: #313030;
		}
		table td {
			border:1px solid #b3adad;
			text-align:center;
			padding:5px;
			background: #ffffff;
			color: #313030;
		}
	</style>

	<!-- JS -->
	<script src="js/jquery-3.6.0.min.js"></script>
<body>

	<!-- Tag "span" usada para retorno do ajax -->
	<span></span><br>

	<!-- Fomr cadastro noticias -->
<form id="form_noticia" method="post" enctype="multipart/form-data">
<input type="file" name="img_1"><br>
<input type="file" name="img_2"><br>
<input type="text" name="nm_noticia" placeholder="Titulo da Notícia"><br>
<textarea name="ds_noticia" placeholder="Descrição"></textarea><br>

<select name="id_categoria">
<?php while ($categoria = $script_categoria->fetch(PDO::FETCH_ASSOC)) {?>	
	<option value="<?php echo $categoria['id']?>"><?php echo $categoria['nm_categoria']?></option>
<?php }?>
</select><br>

<select name="id_autor">
<?php while ($user = $script_user->fetch(PDO::FETCH_ASSOC)) {?>	
	<option value="<?php echo $user['id']?>"><?php echo $user['nm_user']?></option>
<?php }?>
</select><br><br>

<button type="submit" id="enviar">Enviar</button>
</form>
</body>

	<!-- Tabela exibindo dados da categoria -->
	<table>
		<thead>
			<tr>
				<th>#ID</th>
				<th>Titulo</th>
				<th>Descrição</th>
				<th>Imagem 1</th>
				<th>Imagem 2</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Categoria</th>
                <th>Autor</th>
                <th>Views</th>
			</tr>
		</thead>
		<tbody>
<?php while ($noticia = $script_noticia->fetch(PDO::FETCH_ASSOC)) { ?>
			<tr>
				<td><?php echo $noticia['id']; ?></td>
				<td><?php echo $noticia['nm_noticia']; ?></td>
				<td><?php echo $noticia['ds_noticia']; ?></td>
				<td><img width="50" height="50" src="../img/<?php echo $noticia['img_1']; ?>"></td>
				<td><img width="50" height="50" src="../img/<?php echo $noticia['img_2']; ?>"></td>
                <td><?php echo $noticia['data_post']; ?></td>
                <td><?php echo $noticia['hora_post']; ?></td>
<?php
//Consulta Categoria Where
$id_categoria = $noticia['id_categoria'];
$script_categoria = $conn->prepare("SELECT * FROM tb_categoria WHERE id = '$id_categoria'");
$script_categoria->execute();
$categoria = $script_categoria->fetch(PDO::FETCH_ASSOC);
?>
                <td><?php echo $categoria['nm_categoria']; ?></td>
<?php
//Consulta User
$id_autor = $noticia['id_autor'];
$script_user = $conn->prepare("SELECT * FROM tb_users WHERE id = '$id_autor'");
$script_user->execute();
$user = $script_user->fetch(PDO::FETCH_ASSOC);
?>
                <td><?php echo $user['nm_user']; ?></td>
                <td><?php echo $noticia['views']; ?></td>

				<td><button  onclick="window.location.href = 'php/delete_noticia.php?id=<?php echo $noticia['id'];?>'">Excluir</button></td>
				<td><button  data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $noticia['id']; ?>">Editar</button></td>
				<td><button onclick="window.location.href = '../view.php?id=<?php echo $noticia['id']; ?>'">Ver</button></td>
			</tr>

<!--<script type="text/javascript">
		$(document).ready(function(){
			$("#edit_noticia_<?php echo $noticia['id']; ?>").click(function(){
  			$.ajax({
  				url: "php/edit_noticia.php",
  				type: "POST",
  				data: "nm_noticia="+$("#nm_noticia_<?php echo $noticia['id']; ?>").val()+"&ds_noticia="+$("#ds_noticia_<?php echo $noticia['id']; ?>").val()+"&categoria="+$("#option_categoria_<?php echo $noticia['id']; ?>").val()+"&autor="+$("#option_user_<?php echo $noticia['id']; ?>").val()+"&id="+<?php echo $noticia['id'];?>,
  				dataType: "html"
  			}).done(function(resposta) {
	    $("span").html(resposta);

		}).fail(function(jqXHR, textStatus ) {
	    console.log("Request failed: " + textStatus);

		}).always(function() {
	    console.log("completou");
		});
  	});
});
	</script>-->

			<!-- Modal -->
			<div class="modal fade" id="exampleModal<?php echo $noticia['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			    	<span id="edit"></span>
			      <div class="modal-header">
					<span></span>
			        <h5 class="modal-title" id="exampleModalLabel">Editar User #<b id="id_<?php echo $noticia['id']; ?>"><?php echo $noticia['id']; ?></b></h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<!-- Inputs -->
			      	<form id="form_edit_noticia_<?php echo $noticia['id']; ?>" method="post" enctype="multipart/form-data">
					<input type="file" name="ds_img"><br>
					<input type="file" name="ds_img_2"><br>

					<input style="display: none;" type="text" name="id" placeholder="id" value="<?php echo $noticia['id']; ?>"><br>

			       <input type="text" name="nm_noticia" placeholder="Titulo" value="<?php echo $noticia['nm_noticia']; ?>"><br>
			       <input type="text" name="ds_noticia" placeholder="Descrição" value="<?php echo $noticia['ds_noticia']; ?>"><br>


<?php 
//Consulta Select Categoria
$script_categoria_select = $conn->prepare("SELECT * FROM tb_categoria");
$script_categoria_select->execute();

//Consulta User
$script_user_select = $conn->prepare("SELECT * FROM tb_users");
$script_user_select->execute();
?>

					<!-- Select Categoria -->
					<select name="categoria">
					<?php while($categoria_select = $script_categoria_select->fetch(PDO::FETCH_ASSOC)){?>
					<option value="<?php echo $categoria_select['id'];?>"><?php echo $categoria_select['nm_categoria'];?></option>
					<?php }?>
				   </select>
<br>
				   <!-- Select User -->
				   <select name="autor">
					<?php while($user_select = $script_user_select->fetch(PDO::FETCH_ASSOC)){?>
					<option value="<?php echo $user_select['id'];?>"><?php echo $user_select['nm_user'];?></option>
					<?php }?>
				   </select>
					
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
			        <button type="submit" class="btn btn-primary" name="edit_noticia_<?php echo $noticia['id']; ?>">Salvar Alterações</button>
			        </form>
			      </div>
			    </div>
			  </div>
			</div>

<script type="text/javascript">
$(document).ready(function() {
  $('#form_edit_noticia_<?php echo $noticia['id']; ?>').submit(function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário
    var form_data = new FormData(this);

  $.ajax({
    url: 'edit_noticia.php', // Arquivo PHP para processar os dados
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

<?php }?>
		</tbody>
	</table>
	<br>

	<script>
  $(document).ready(function() {
  $('#form_noticia').submit(function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário
    var form_data = new FormData(this);

  $.ajax({
    url: 'script_noticia.php', // Arquivo PHP para processar os dados
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

</body>
</html>