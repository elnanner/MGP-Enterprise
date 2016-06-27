<?php 
session_start();
if(!isset($_SESSION['estaLoggeadoUsuarioAdmin']) || isset($_SESSION['estaLoggeadoUsuarioAdmin']) && $_SESSION['estaLoggeadoUsuarioAdmin'] == false){
	die("Ud. no tiene acceso para visitar esta secci&oacute;n.");
}
include("Conectar.php");
?>
<!DOCTYPE html> 
<head>
	<title> CouchInn </title>
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Admin_Activar_Tipo.css"/>	
</head>
<body>
	<?php
		include("Login_Admin_Cabeza.php");
	?>
	<div id= "cuerpo">
		<?php
			include("Login_Admin_Menu.php");
		?>
		<div id= "activar">

			<form method="post" name="activar">

				<?php echo '<input type=hidden name="idtipo" value="'.$_POST['idtipo'].'"/>'; // ESTO SIRVE PARA QUE CUANDO APRETAS EL BOTON NO PIERDA EL POST ?> 

				<div id= "formulario">
					&#191Esta seguro que quiere activar este tipo?
					<div id="boton">
					<div id= "boton1">
						<input type="submit" name="activar" value="Activar"/>
					</div>
					<div id= "boton2">
						<input type="button" name="cancelar" value="Cancelar" onClick="location.href='Login_Admin_Tipo.php'"/>
					</div>
					</div>
				</div>
			</form>
				<?php
					if (isset($_POST['activar'])) {
						$idtipo= $_POST['idtipo'];
						$elimi= false;
						$cadena= "update tipo set tipo.idTipo='$idtipo', tipo.Eliminado='$elimi' where tipo.idTipo='$idtipo'";
						mysql_query($cadena); //CAMBIO EL BOOLEANO POR FALSE QUE NOO ESTA ELIMINANDO - APARECERA NUEVANEMTE EN LA LISTA
						?>
						<script type="text/javascript">
							alert ("El tipo ha vuelto a ser ingresado en el listado para ser una de las opciones a elegir");
							location.href='Login_Admin_Tipo.php';
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