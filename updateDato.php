<?php
include('Conectar.php');
$consulta = "UPDATE comments SET comments.respuesta='".$_GET['dato']."' WHERE idComment='".$_GET['idComment']."' ";
mysql_query($consulta);


 ?>
