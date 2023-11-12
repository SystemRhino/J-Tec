<?php 
if(isset($dir) && $dir = "adm"){
$pre = "../";
}else{
  $pre = "";
}
?>
<nav style="background-color: grey;">
  <a href="/J-TEC/">Home</a> |
  <a href="<?php echo $pre;?>cursos.php">Cursos</a> |


  <!-- Verificação de sessão -->
<?php if(isset($_SESSION['id'])){?>
  <a href="<?php echo $pre;?>perfil.php">Perfil</a> | <a href="php/logout.php">Sair</a> |
<?php }else{?>
  <a href="<?php echo $pre;?>login.php">Login</a> |
<?php }?>

<?php if(isset( $_SESSION['nivel']) && $_SESSION['nivel'] == 1){?>
  <a href="<?php echo $pre;?>adm/">Admin</a> |
<?php }?>

  <head>
    <meta name="Cache-Control" content="max-age=0,must-revalidate">
    <meta charset="utf-8">
  </head>

  <!-- Pesquisar -->
<form action="<?php echo $pre;?>search.php" method="GET">
	<input type="text" name="data" placeholder="Pesquise uma noticia">
	<input type="submit" value="Pesquisar">
</form>
<hr>
</nav>