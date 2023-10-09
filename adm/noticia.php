<?php  
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}
include('php/conecta.php');

//Consulta Categoria
$script_categoria = $conn->prepare("SELECT * FROM tb_categoria");
$script_categoria->execute();

//Consulta Nivel
$script_noticia = $conn->prepare("SELECT * FROM tb_noticia");
$script_noticia->execute();
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

<input type="text" id="user" placeholder="Titulo da Notícia"><br>
<input type="text" id="login" placeholder="Descrição"><br> <!-- Aqui, TextArea -->
<input type="text" id="password" placeholder="Senha"><br> 
<select id="id_nivel">
	<option value="1">Admin</option>
	<option value="2">User</option>
</select>
<button id="cadastrar_user">Cadastrar</button><br><br>
</body>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#cadastrar_user").click(function(){
  			$.ajax({
  				url: "php/script_user.php",
  				type: "POST",
  				data: "login="+$("#login").val()+"&password="+$("#password").val()+"&user="+$("#user").val()+"&id_nivel="+$("#id_nivel").val(),
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
	</script>

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

				<td><a href="php/delete_noticia.php?id=<?php echo $noticia['id'];?>">Excluir</a></td>
				<td><button  data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $noticia['id']; ?>">Editar</button></td>
			</tr>

<script type="text/javascript">
		$(document).ready(function(){
			$("#edit_user_<?php echo $noticia['id']; ?>").click(function(){
  			$.ajax({
  				url: "php/edit_user.php",
  				type: "POST",
  				data: "nm_user="+$("#nm_user_<?php echo $noticia['id']; ?>").val()+"&ds_login="+<?php echo $noticia['id'];?>+"&ds_login="+$("#ds_login_<?php echo $noticia['id']; ?>").val()+"&ds_senha="+$("#ds_senha_<?php echo $noticia['id']; ?>").val()+"&id_nivel="+$("#id_nivel_<?php echo $noticia['id']; ?>").val()+"&id="+<?php echo $noticia['id'];?>,
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
	</script>

			<!-- Modal -->
			<div class="modal fade" id="exampleModal<?php echo $noticia['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			    	<span id="edit"></span>
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Editar User #<b id="id_<?php echo $noticia['id']; ?>"><?php echo $noticia['id']; ?></b></h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<!-- Inputs -->
			       <input type="text" id="nm_user_<?php echo $noticia['id']; ?>" placeholder="Nome" value="<?php echo $noticia['nm_user']; ?>"><br>
			       <input type="text" id="ds_login_<?php echo $noticia['id']; ?>" placeholder="E-mail" value="<?php echo $noticia['ds_login']; ?>"><br>
			       <input type="text" id="ds_senha_<?php echo $noticia['id']; ?>" placeholder="Senha" value="<?php echo $noticia['ds_senha']; ?>"><br>
					
					 
			       <select id="id_nivel_<?php echo $noticia['id']; ?>">
				   <option value="<?php echo $noticia['id_nivel']; ?>">
				   <?php if($noticia['id_nivel'] == 1){ 
						echo "Admin";
					 }else{ 
						echo "User";
					 } ?>
					</option>
			       	<option value="2">User</option>
					   <option value="1">Admin</option>
			       </select>
					
					
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
			        <button type="button" class="btn btn-primary" id="edit_user_<?php echo $noticia['id']; ?>">Salvar Alterações</button>
			      </div>
			    </div>
			  </div>
			</div>

<?php }?>
		</tbody>
	</table>
	<br>

</body>
</html>