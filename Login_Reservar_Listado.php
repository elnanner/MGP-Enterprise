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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Reservar_Listado.css"/>
   	<script src="script.js"></script>
</head>
<body>
	<?php
		include("Login_Cabeza.php");
	?>
	<div id= "cuerpo">
		<?php
			include("Login_Menu.php");
		?>
		<div id= "lista">
			<div id= "titulo">
				<p> Reservas </p>
			</div>
			<div id= "subLis">
				<?php
					// SELECT * FROM couch INNER JOIN reserva ON couch.idCouch=reserva.idCouch WHERE reserva.idUComunCouch=".$_SESSION['idUComun']."  ORDER BY couch.idCouch DESC
					$query = "SELECT * FROM couch INNER JOIN reserva ON couch.idCouch=reserva.idCouch WHERE reserva.idUComunCouch=".$_SESSION['idUComun']." ORDER BY couch.idCouch DESC";
					$q = mysql_query($query, $link);
					$num=mysql_num_rows ($q);

					if ($num <> 0) {
						for ($i=0; $i<$num; $i++) {

							$resCouch=mysql_fetch_array($q);

							echo '<div id="fila">';

							$query = "SELECT * FROM imagenes WHERE idCouch='".$resCouch['idCouch']."'";   //CONSULTA A LA TABLA IMAGENES CHOCANDO IDCOUCH
							$qe = mysql_query($query, $link);
							$resImg=mysql_fetch_array($qe);

							echo '<div id="imag">';
								if ($resImg['Imagen']) {   //PREGUNTA SI TIENE IMAGEN SINO MUESTRA EL SILLON
									$dir = $resImg['Imagen'];
									echo'<img class="redondo" src="'.$dir.'" width="74" height="74"/>';
								}
								else {
									echo'<img class="redondo" src="Imagen/sillon.png" width="74" height="74"/>';
								}
							echo '</div>';

							echo '<div id="titu">';
								echo '<b> '.$resCouch['Titulo'].' </b>';
							echo '</div>';

							echo '<div id="des">';
								echo '<p> '.$resCouch['Descripcion'].' </p>';
							echo '</div>';

							echo '<div id="datoUsuario">';
								$query = "SELECT * FROM ucomun WHERE idUComun='".$resCouch['idUComun']."'";
								$resultado =mysql_query($query);
								$nombreUsuario = mysql_fetch_array($resultado);

								echo '<b>Nombre:&nbsp</b><p>'.$nombreUsuario['Nombre'].'&nbsp</p><b>&nbspPuntaje:&nbsp</b><p>'.$nombreUsuario['Puntaje'].'&nbsp</p>';
							echo '</div>';

							echo '<div id="res">';
								echo '<b>Fecha Ingreso:&nbsp</b><p>'.$resCouch['FechaInicio'].'&nbsp</p><b>&nbspFecha Egreso:&nbsp</b><p>'.$resCouch['FechaFin'].'&nbsp</p><b>&nbspCapacidad:&nbsp</b><p>'.$resCouch['CapacidadPersonas'].'</p>';
							echo '</div>';

							echo '<div id="boton">';
								if ($resCouch['Aceptada'] == 2) {
									echo '<div id="responder">';
										echo '<form action="Login_Reservar_AceptarRechazar.php" method="post">';
											echo '<input type=hidden name="reserva" value="'.$resCouch['idReserva'].'"/>';
											echo '<input type="submit" value="Responder"/>';
										echo '</form>';
									echo '</div>';
								}
								else {
									if ($resCouch['Aceptada'] == 1) {
										echo '<div id="aceptado">';
											echo 'Aceptada';
										echo '</div>';
									}
									else {
										if ($resCouch['Aceptada'] == 0) {
											echo '<div id="rechazado">';
												echo 'Rechazada';
											echo '</div>';
										}
									}
								}
							echo '</div>';

							echo '</div>';
						}
					}
					else {
						echo '<div id="noCouch">';
							echo '<p> No tiene ninguna reserva solicitada hasta el momento </p>';
						echo '</div>';
					}
				?>
			</div>
		</div>
	</div>
	<?php
		include("Pie.php");
	?>
</body>
</html>
