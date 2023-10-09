<?php  
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}
include('php/conecta.php');

//Consulta Categoria
$script_users = $conn->prepare("SELECT * FROM tb_users");
$script_users->execute();

//Consulta Nivel
$script_nivel = $conn->prepare("SELECT * FROM tb_nivel");
$script_nivel->execute();
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
	<script type="text/javascript">
		$(document).ready(function(){
			$("#cadastrar").click(function(){
  			$.ajax({
  				url: "php/script_categoria.php",
  				type: "POST",
  				data: "categoria="+$("#categoria").val(),
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
<body>
	<!-- Tag "span" usada para retorno do ajax -->
	<span></span><br>


<input type="text" id="categoria" placeholder="Nome da categoria"><br>
<button id="cadastrar">Cadastrar</button>
<br><br>
</head>
<body>

	<!-- Tabela exibindo dados da categoria -->
	<table>
		<thead>
			<tr>
				<th>#ID</th>
				<th>Nome</th>
				<th>E-mail</th>
				<th>Senha</th>
				<th>Nivel</th>
			</tr>
		</thead>
		<tbody>
<?php while ($users = $script_users->fetch(PDO::FETCH_ASSOC)) { ?>
			<tr>
				<td><?php echo $users['id']; ?></td>
				<td><?php echo $users['nm_user']; ?></td>
				<td><?php echo $users['ds_login']; ?></td>
				<td><?php echo $users['ds_senha']; ?></td>
				<td>
					<?php if($users['id_nivel'] == 1){ ?>
						<b style="color: purple;">Admin</b>
					<?php }else{ ?>
						<b style="color: green;">User</b>
					<?php } ?>
					
				</td>
				<td><a href="php/delete_user.php?id=<?php echo $users['id'];?>">Excluir</a></td>
				<td><button  data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $users['id']; ?>">Editar</button></td>
			</tr>

<script type="text/javascript">
		$(document).ready(function(){
			$("#edit_categoria_<?php echo $users['id']; ?>").click(function(){
  			$.ajax({
  				url: "php/edit_users.php",
  				type: "POST",
  				data: "nm_user="+$("#nm_user_<?php echo $users['id']; ?>").val()+"&ds_login="+<?php echo $users['id'];?>+"&ds_login="+$("#ds_login_<?php echo $users['id']; ?>").val()+"&ds_senha="+$("#ds_senha_<?php echo $users['id']; ?>").val()+"&id_nivel="+$("#id_nivel_<?php echo $users['id']; ?>").val(),
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
			<div class="modal fade" id="exampleModal<?php echo $users['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			    	<span id="edit"></span>
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Editar User #<b id="id_<?php echo $users['id']; ?>"><?php echo $users['id']; ?></b></h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<!-- Inputs -->
			       <input type="text" id="nm_user_<?php echo $users['id']; ?>" placeholder="Nome" value="<?php echo $users['nm_user']; ?>"><br>
			       <input type="text" id="ds_login_<?php echo $users['id']; ?>" placeholder="E-mail" value="<?php echo $users['ds_login']; ?>"><br>
			       <input type="text" id="ds_senha_<?php echo $users['id']; ?>" placeholder="Senha" value="<?php echo $users['ds_senha']; ?>"><br>
					
					<!--  
			       <select id="id_nivel_<?php echo $users['id']; ?>">
			       	<?php while ($nivel = $script_nivel->fetch(PDO::FETCH_ASSOC)) { ?>
			       	<option value="<?php echo $nivel['id']; ?>"><?php echo $nivel['nm_nivel']; ?></option>
			       <?php } ?>
			       </select>
					-->
					
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
			        <button type="button" class="btn btn-primary" id="edit_categoria_<?php echo $users['id']; ?>">Salvar Alterações</button>
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