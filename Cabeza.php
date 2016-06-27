<?php 
include("Conectar.php");
?>
<!DOCTYPE html> 
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Cabeza.css"/>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>	
</head>
<body>
	<div id="cabeza">
		<div id="img">
			<a href= "index.php">
			<img src="Imagen/Logonuevo.png" alt="CouchInn"/>
			</a>
		</div>
		<div id="sesion">
			<div id="sesionIzq">
				<input type="button" name="registrar" Value="Registrate" OnClick="location.href='Registrar_Usuario.php'">
			</div>
			<div id="sesionDer">
				<input type="button" name="iniciar" Value="Iniciar Sesión" OnClick="location.href='Iniciar_Sesion.php'">
			</div>
		</div>
	</div>
</body>
</html>