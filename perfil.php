<?php 
session_start();
require'php/conecta.php';
if(!isset($_SESSION['id'])){
    header('location:./login.php');
}

//Consulta Notícia
$id = $_SESSION['id'];
$script_user = $conn->prepare("SELECT * FROM tb_users WHERE id ='$id'");
$script_user->execute();
$user = $script_user->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<meta charset="utf-8">
	<title><?php echo $user['nm_user']; ?></title>
</head>
<body>
<!-- Nav -->
<?php include('nav.php');?>
<img width="250" height="250" src="img/<?php echo $user['ds_img'];?>">
<p><?php echo $user['nm_user'];?></p>
<p><?php echo $user['ds_login'];?></p>
<?php if($user['id_nivel'] = 1){?>
<b style="color: purple;">Admin</b>
<?php }?>
</body>

<script src="./js/jquery-3.6.0.min.js"></script>
</html>