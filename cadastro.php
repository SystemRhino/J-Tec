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

	<!-- Fomr cadastro user -->
<form id="form_cadastro" method="post" enctype="multipart/form-data">
<input type="file" name="ds_img"><br>
<input type="text" name="user" placeholder="Nome de usuário"><br>
<input type="text" name="login" placeholder="E-mail"><br>
<input type="text" name="password" placeholder="Senha"><br>
<button type="submit" id="enviar">Cadastrar</button>
<a href="login.php">Login</a>
</form>
</body>

	<script type="text/javascript">
$(document).ready(function() {
  $('#form_cadastro').submit(function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário
    var form_data = new FormData(this);

  $.ajax({
    url: 'php/script_cadastro.php', // Arquivo PHP para processar os dados
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
</html>