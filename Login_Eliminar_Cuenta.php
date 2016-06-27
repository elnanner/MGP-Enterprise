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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Eliminar_Cuenta.css"/>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>	
</head>
<body>
	<?php
		include("Login_Cabeza.php");
	?>
	<div id= "cuerpo">
		<?php
		include("Login_Menu.php");
	?>
		<div id= "eliminar">

			<form method="post" name="borrar">

				<div id= "formulario">
					&#191Esta seguro que quiere eliminar su cuenta?
					<div id="boton">
					<div id= "boton1">
						<input type="submit" name="eliminar" value="Eliminar"/>
					</div>
					<div id= "boton2">
						<input type="button" name="cancelar" value="Cancelar" onClick="location.href='Login_Index.php'"/>
					</div>
					</div>
				</div>
			</form>
				<?php
					if (isset($_POST['eliminar'])) {
						$cadCou= "delete from couch where couch.idUComun=".$_SESSION['idUComun']."";
						mysql_query($cadCou);
						$cadU= "delete from ucomun where ucomun.idUComun=".$_SESSION['idUComun']."";
						mysql_query($cadU); //BOORA EL USUARIO
						?>
						<script type="text/javascript">
							alert ("El usuario fue eliminado");
							location.href='Cerrar_Sesion.php';
						</script>
						<?php
					}
				?>
		</div>
	</div>
	<?php
		include("Pie.php");
	?>
</body>
</html>