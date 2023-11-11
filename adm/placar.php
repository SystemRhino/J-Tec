<?php  
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}
include('php/conecta.php');

//Consulta Placar
$script_placar = $conn->prepare("SELECT * FROM tb_placar");
$script_placar->execute();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Placar | J-Tec</title>
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
  				url: "php/script_placar.php",
  				type: "POST",
  				data: "nm_time_1="+$("#time1").val()+"&gols_1="+$("#gols1").val()+"&nm_time_2="+$("#time2").val()+"&gols_2="+$("#gols2").val(),
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


<input type="text" id="time1" placeholder="Time 1"> <input type="text" id="gols1" placeholder="Total de gols"><br>
<input type="text" id="time2" placeholder="Time 2"> <input type="text" id="gols2" placeholder="Total de gols"><br>
<button id="cadastrar">Cadastrar</button>
<br><br>
</head>
<body>

	<!-- Tabela exibindo dados do placar -->
	<table>
		<thead>
			<tr>
				<th>#ID</th>
				<th>Time 1</th>
				<th>Gols</th>
				<th>X</th>
				<th>Time 2</th>
				<th>Gols</th>
			</tr>
		</thead>
		<tbody>
<?php while ($placar = $script_placar->fetch(PDO::FETCH_ASSOC)) { ?>
			<tr>
				<td><?php echo $placar['id']; ?></td>
				<td><?php echo $placar['nm_time_1']; ?></td>
				<td><?php echo $placar['gols_1']; ?></td>
				<td>X</td>
				<td><?php echo $placar['nm_time_2']; ?></td>
				<td><?php echo $placar['gols_2']; ?></td>
				<td><a href="php/delete_placar.php?id=<?php echo $placar['id'];?>">Excluir</a></td>
				<td><button  data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $placar['id']; ?>">Editar</button></td>
			</tr>

<script type="text/javascript">
		$(document).ready(function(){
			$("#edit_placar_<?php echo $placar['id']; ?>").click(function(){
  			$.ajax({
  				url: "php/edit_placar.php",
  				type: "POST",
  				data: "nm_time_1="+$("#nm_time_1_<?php echo $placar['id']; ?>").val()+"&nm_time_2="+$("#nm_time_2_<?php echo $placar['id']; ?>").val()+"&gols_1="+$("#gols_1_<?php echo $placar['id']; ?>").val()+"&gols_2="+$("#gols_2_<?php echo $placar['id']; ?>").val()+"&id="+<?php echo $placar['id'];?>,
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
			<div class="modal fade" id="exampleModal<?php echo $placar['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			    	<span id="edit"></span>
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Editar Placar #<b id="id_<?php echo $placar['id']; ?>"><?php echo $placar['id']; ?></b></h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			       <input type="text" id="nm_time_1_<?php echo $placar['id']; ?>" placeholder="Time 1" value="<?php echo $placar['nm_time_1']; ?>"><br>

			       <input type="text" id="gols_1_<?php echo $placar['id']; ?>" placeholder="Gols" value="<?php echo $placar['gols_1']; ?>"><br>

			       <input type="text" id="nm_time_2_<?php echo $placar['id']; ?>" placeholder="Time 2" value="<?php echo $placar['nm_time_2']; ?>"><br>

			       <input type="text" id="gols_2_<?php echo $placar['id']; ?>" placeholder="Gols" value="<?php echo $placar['gols_2']; ?>"><br>

			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
			        <button type="button" class="btn btn-primary" id="edit_placar_<?php echo $placar['id']; ?>">Salvar Alterações</button>
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