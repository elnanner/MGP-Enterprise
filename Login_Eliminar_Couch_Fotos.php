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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Eliminar_Couch_Fotos.css"/>
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

				<?php 
					$couch=$_GET['couch'];
					$imagen=$_GET['imagen'];
				?> 

				<div id= "formulario">
					&#191Esta seguro que quiere eliminar esta foto?
					<div id= "boton">
						<div id= "boton1">
						<input type="submit" name="eliminar" value="Eliminar"/>
						</div>
						<div id="boton2">
						<input type="button" name="cancelar" value="Cancelar" onClick="location.href=location.href= 'Login_Modificar_Couch_Fotos.php?couch=<?php echo $couch; ?>'"/>
						</div>
					</div>
				</div>
			</form>
				<?php
					if (isset($_POST['eliminar'])) {
						$query = "SELECT * FROM imagenes WHERE imagenes.idImagenes=".$imagen.""; 
						$q=mysql_query ($query);
						$resImagen=mysql_fetch_array ($q);
						
						$query = "SELECT * FROM imagenes WHERE imagenes.idCouch=".$resImagen['idCouch'].""; 
						$q=mysql_query ($query);
						$num=mysql_num_rows ($q);

						if ($num > 1) {
							$cadI= "delete from imagenes where imagenes.idImagenes=".$imagen."";
							mysql_query($cadI); //BOORA LA IMAGEN
							?>
							<script type="text/javascript">
								alert ("La foto fue eliminada");
								location.href= "Login_Modificar_Couch_Fotos.php?couch=<?php echo $couch; ?>";
							</script>
							<?php
						}
						else {
							echo $couch;
							?>
							<script type="text/javascript">
								alert ("No se puede eliminar la foto");
								location.href= "Login_Modificar_Couch_Fotos.php?couch=<?php echo $couch; ?>";
							</script>
							<?php
						}
					}
				?>
		</div>
	</div>
	<?php
		include("Pie.php");
	?>
</body>
</html>