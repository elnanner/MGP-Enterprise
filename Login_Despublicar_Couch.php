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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Despublicar_Couch.css"/>	
</head>
<body>
	<?php
		include("Login_Cabeza.php");
	?>
	<div id= "cuerpo">
		<?php
		include("Login_Menu.php");
	?>
	<div id= "cuerpo">
		<div id= "despublicar">

			<form method="post" name="activar">

				<?php echo '<input type=hidden name="couch" value="'.$_POST['couch'].'"/>'; // ESTO SIRVE PARA QUE CUANDO APRETAS EL BOTON NO PIERDA EL POST ?> 

				<div id= "formulario">
					&#191Esta seguro que quiere despublicar este hospedaje?
					<div id="boton">
						<div id= "boton1">
							<input type="submit" name="aceptar" value="Aceptar"/>
						</div>
						<div id= "boton2">
							<input type="button" name="cancelar" value="Cancelar" onClick="location.href='Login_MisCouch.php'"/>
						</div>
					</div>
				</div>
			</form>
				<?php
					if (isset($_POST['aceptar'])) {
						$idcouch= $_POST['couch'];
						$publi= true;
						$cadena= "update couch set couch.idCouch='$idcouch', couch.Publicado='$publi' where couch.idCouch='$idcouch'";
						mysql_query($cadena); //CAMBIO EL BOOLEANO POR FALSE QUE NOO ESTA ELIMINANDO - APARECERA NUEVANEMTE EN LA LISTA
						?>
						<script type="text/javascript">
							alert ("El hospedaje se ha despublicado hasta que desee volver a publicarlo");
							location.href='Login_MisCouch.php';
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