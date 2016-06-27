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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Admin_Eliminar_Tipo.css"/>	
</head>
<body>
	<?php
		include("Login_Admin_Cabeza.php");
	?>
	<div id= "cuerpo">
		<?php
			include("Login_Menu.php");
		?>
		<div id= "eliminar">

			<form method="post" name="borrar">

				<?php echo '<input type=hidden name="idtipo" value="'.$_POST['idtipo'].'"/>'; // ESTO SIRVE PARA QUE CUANDO APRETAS EL BOTON NO PIERDA EL POST ?> 

				<div id= "formulario">
					&#191Esta seguro que quiere eliminar este tipo?
				</div>
					<div id="boton">
					<div id= "boton1">
						<input type="submit" name="eliminar" value="Eliminar"/>
					</div>
					<div id= "boton2">
						<input type="button" name="cancelar" value="Cancelar" onClick="location.href='Login_Admin_Tipo.php'"/>
					</div>
					</div>

			</form>
				<?php
					if (isset($_POST['eliminar'])) {

						$query = "SELECT * FROM couch WHERE couch.idTipo=".$_POST['idtipo']."";   //CONSULTA A LA TABLA TIPO
						$qe = mysql_query($query, $link);
						$num = mysql_num_rows ($qe);

						if ($num <> 0) {
							$idtipo= $_POST['idtipo'];
							$elimi= true;
							$cadena= "update tipo set tipo.idTipo='$idtipo', tipo.Eliminado='$elimi' where tipo.idTipo='$idtipo'";
							mysql_query($cadena); //CAMBIO EL BOOLEANO POR TRUE QUE ESTA ELIMINANDO
							?>
							<script type="text/javascript">
								alert ("Hay couchs que usan este tipo.\nNo fue eliminado pero se lo saco de las opciones para elegir.");
								location.href='Login_Admin_Tipo.php';
							</script>
							<?php
						}
						else {
							$cad= "delete from tipo where tipo.idTipo=".$_POST['idtipo']."";
							mysql_query($cad); //BORRA EL TIPO
							?>
							<script type="text/javascript">
								alert ("El tipo fue eliminado");
								location.href='Login_Admin_Tipo.php';
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