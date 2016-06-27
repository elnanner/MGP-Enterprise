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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Eliminar_Couch.css"/>
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
				<?php echo '<input type=hidden name="couch" value="'.$_POST['couch'].'"/>'; // ESTO SIRVE PARA QUE CUANDO APRETAS EL BOTON NO PIERDA EL POST ?> 

				<div id= "formulario">
					&#191Esta seguro que quiere eliminar este hospedaje?
					<div id="boton">
					<div id= "boton1">
						<input type="submit" name="eliminar" value="Eliminar"/>
					</div>
					<div id= "boton2">
						<input type="button" name="cancelar" value="Cancelar" onClick="location.href='Login_MisCouch.php'"/>
					</div>
					</div>
				</div>
			</form>
				<?php
					if (isset($_POST['eliminar'])) {
						$query = "SELECT * FROM reserva WHERE reserva.idCouch=".$_POST['couch']."";
						$q = mysql_query($query, $link);
						$num=mysql_num_rows ($q);
						
						$Aceptadas2= false;
						for ($i=0; $i<$num; $i++) {
							$resRes=mysql_fetch_array($q);
							if ($resRes['Aceptada'] == 2) {
								$Aceptadas2= true;
							}
						}

						if (($num <> 0) and ($Aceptadas2 == true)) {
							$idcouch= $_POST['couch'];
							$publi= true;
							$cadena= "update couch set couch.Publicado='$publi' where couch.idCouch='$idcouch'";
							mysql_query($cadena); //CAMBIO EL BOOLEANO POR TRUE QUE ESTA DESPUBLICADO - DESAPARECE DEL LISTADO
							?>
							<script type="text/javascript">
								alert ("El hospedaje no pudo eliminarse ya que tiene reservas pendientes\nEl mismo fue quitado del listado de hospedajes");
								location.href='Login_MisCouch.php';
							</script>
							<?php
						}
						else {
							$cadRes= "delete from reserva where reserva.idCouch=".$_POST['couch']."";
							mysql_query($cadRes); //BORRA TODAS LAS RESERVAS
							$cadImg= "delete from imagenes where imagenes.idCouch=".$_POST['couch']."";
							mysql_query($cadImg); //BORRA TODAS LAS FOTOS DE ES COUCH
							$cad= "delete from couch where couch.idCouch=".$_POST['couch'].""; 
							mysql_query($cad); //BORRA EL COUCH
							?>
							<script type="text/javascript">
								alert ("El hospedaje fue eliminado");
								location.href='Login_MisCouch.php';
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