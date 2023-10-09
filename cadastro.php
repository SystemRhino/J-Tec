<?php
session_start();
// Verificação da sessão
if (isset($_SESSION['id'])) {
  	header('location:index.php');
  } 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cadastro | J-tec</title>
	<meta charset="utf-8">
</head>
	<script src="js/jquery-3.6.0.min.js"></script>
<body>

	<!-- Tag "span" usada para retorno do ajax -->
	<span></span><br>

<input type="text" id="user" placeholder="Nome de usuário"><br>
<input type="text" id="login" placeholder="E-mail"><br>
<input type="text" id="password" placeholder="Senha"><br>
<button id="cadastrar">Cadastrar</button><br>
<a href="login.php">Login</a>
</body>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#cadastrar").click(function(){
  			$.ajax({
  				url: "php/script_cadastro.php",
  				type: "POST",
  				data: "login="+$("#login").val()+"&password="+$("#password").val()+"&user="+$("#user").val(),
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
</html>