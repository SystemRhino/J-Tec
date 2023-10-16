<?php
session_start();
    include('php/conecta.php');
    $img_1 = $_FILES["img_1"];
	$ext_1 = substr($img_1['name'], -4);
    $nomeFinal_1 = time().uniqid().$ext_1;

    $img_2 = $_FILES["img_2"];
	$ext_2 = substr($img_2['name'], -4);
    $nomeFinal_2 = time().uniqid().$ext_2;

if($ext_1 == '.jpg' || $ext_1 == 'jpeg' || $ext_1 == '.png' || $ext_2 == '.jpg' || $ext_2 == 'jpeg' || $ext_2 == '.png'){
    try{
        if (move_uploaded_file($img_1['tmp_name'], '../img/'.$nomeFinal_1) && move_uploaded_file($img_2['tmp_name'], '../img/'.$nomeFinal_2)) {
        $stmt = $conn->prepare('INSERT INTO tb_noticia(nm_noticia, ds_noticia, img_1, img_2, nr_curtidas, data_post, hora_post, id_categoria, id_autor, views) VALUES(:nm_noticia, :ds_noticia, :img_1, :img_2, :nr_curtidas, NOW(), NOW(), :id_categoria, :id_autor, :views)');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);   
        $stmt->execute(array(
            ':nm_noticia' => $_POST['nm_noticia'],
            ':ds_noticia' => $_POST['ds_noticia'],
            ':img_1' => $nomeFinal_1,
            ':img_2' => $nomeFinal_2,
            ':nr_curtidas' => 0,
            ':id_categoria' => $_POST['id_categoria'],
            ':id_autor' => $_SESSION['id'],
            ':views' => 0
        ));
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
    } }catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}else{
    echo 'Envie somente arquivos JPG, JPEG ou PNG!';
}
?>