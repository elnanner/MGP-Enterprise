<?php 
include("Conectar.php");
?>
<!DOCTYPE html> 
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Admin_Cabeza.css"/>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>	
</head>
<body>
	<div id="cabeza">
		<div id="img">
			<a href= "Login_Admin_Index.php">
			<img src="Imagen/Logonuevo.png" alt="CouchInn"/>
			</a>
		</div>
		<div id="sesion">
			<div id="sesionDer">
				<input type="button" name="cerrar" Value="Cerrar Sesión" OnClick="location.href='Cerrar_Sesion.php'">
			</div>
		</div>
	</div>
</body>
</html>