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
	<title>Login | J-tec</title>
	<meta s>
</head>
<body>

	<!-- Tag "span" usada para retorno do ajax -->
	<span></span><br>

<input type="email" id="login" placeholder="E-mail"><br>
<input type="text" id="password" placeholder="Senha"><br>
<button id="entrar">Entrar</button><br>
<a href="cadastro.php">Cadastrar</a>
</body>
	<!-- JS -->
	<script src="js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#entrar").click(function(){
  			$.ajax({
  				url: "php/script_login.php",
  				type: "POST",
  				data: "login="+$("#login").val()+"&password="+$("#password").val(),
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