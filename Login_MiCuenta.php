<?php 
session_start();
if(!isset($_SESSION['estaLoggeadoUsuario']) || isset($_SESSION['estaLoggeadoUsuario']) && $_SESSION['estaLoggeadoUsuario'] == false){
	die("Ud. no tiene acceso para visitar esta secci&oacute;n.");
}
include("Conectar.php");
?>
<!DOCTYPE html> 
<head>
	<title> CouchInn </title>
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_MiCuenta.css"/>	
</head>
<body>
	<?php
		include("Login_Cabeza.php");
	?>
	<div id= "cuerpo">
		<?php
			include("Login_Menu.php");
		?>
		<div id= "MiCue">
			<div id= "titulo">
				Mi Cuenta
					<div id="formu">
						<?php
						$query = "SELECT * FROM ucomun WHERE ucomun.idUComun=".$_SESSION['idUComun']."";
						$q = mysql_query($query, $link);
						$res=mysql_fetch_array($q);
						?>

						<div id= "formulario">
							<b> Nombre: </b> <?php echo $res['Nombre'] ?>
						</div>
						<div id= "formulario">
							<b> Apellido: </b> <?php echo $res['Apellido'] ?>
						</div>
						<div id= "formulario">
							<b> Edad: </b> <?php echo $res['Edad'] ?>
						</div>
						<div id= "formulario">
							<b> Correo: </b> <?php echo $res['Mail'] ?>
						</div>
						<div id= "formulario">
							<b> Puntaje: </b> 
							<?php
							if ($res['Puntaje'] == 0) {
								echo "Sin Puntaje";
							}
							else {
								echo $res['Puntaje'];
							}
							?>
						</div>
					</div>
				
			</div>
		</div>
	</div>
	<?php
		include("Pie.php");
	?>
</body>
</html>