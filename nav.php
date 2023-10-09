<nav style="background-color: grey;">
  <a href="/J-TEC/">Home</a> |
  <a href="cursos.php">Cursos</a> |


  <!-- Verificação de sessão -->
<?php if(isset($_SESSION['id'])){?>
  <a href="perfil.php">Perfil</a> |
<?php }else{?>
  <a href="login.php">Login</a> |
<?php }?>

<?php if($_SESSION['nivel'] = 1){?>
  <a href="./adm/">Adm</a> |
<?php }?>

  <!-- Pesquisar -->
<form action="search.php" method="GET">
	<input type="text" name="data" placeholder="Pesquise uma noticia">
	<input type="submit" value="Pesquisar">
</form>
<hr>
</nav>