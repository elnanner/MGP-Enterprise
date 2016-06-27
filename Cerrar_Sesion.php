<?php 
session_start();
include("conectar.php");
session_unset();
session_destroy();
header("Location: index.php");

?>