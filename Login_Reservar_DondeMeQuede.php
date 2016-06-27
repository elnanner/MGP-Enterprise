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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Reservar_DondeMeQuede.css"/>
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
				<p> Hospedajes donde me qued&eacute </p>
			</div>
			<div id= "subLis">
				<?php
					$query = "SELECT * FROM couch INNER JOIN reserva ON couch.idCouch=reserva.idCouch WHERE reserva.idUComun=".$_SESSION['idUComun']." ORDER BY reserva.idReserva DESC";
					$q = mysql_query($query, $link);
					$num=mysql_num_rows ($q);

					$entro=false;  //PARA SABER SI HAY COUCHS VISITADOS
					if ($num <> 0) {
						for ($i=0; $i<$num; $i++) {

							$resCouch=mysql_fetch_array($q);

							//if (($resCouch['FechaFin'] < date("Y-m-d")) and ($resCouch['Aceptada'] == 1)) {
							//	echo "bien---".$resCouch['FechaFin']."---".date("Y/m/d");
							//}  //PARA CORROBORAR QUE FUNCIONE EL IF, CON LAS FECHAS Y ACEPTADOS

							if (($resCouch['FechaFin'] < date("Y-m-d")) and ($resCouch['Aceptada'] == 1)) {   //SI LA FECHA DE FIN ES MENOR A LA FECHA DE HOY Y LA RECERVA ESTA ACEPTADA, LO MUESTRO!!!
								$entro=true;  //PARA SABER SI HAY COUCHS VISITADOS
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

								echo '<div id="res">';
									echo '<b>Fecha Ingreso:&nbsp</b><p>'.$resCouch['FechaInicio'].'&nbsp</p><b>&nbspFecha Egreso:&nbsp</b><p>'.$resCouch['FechaFin'].'&nbsp</p><b>&nbspCapacidad:&nbsp</b><p>'.$resCouch['CapacidadPersonas'].'</p>';
								echo '</div>';

								echo '<div id="boton">';
									if ($resCouch['PuntuarCouch'] == 0) {
										echo '<div id="puntuar">';
											echo '<form action="Login_Reservar_PuntuarCouch.php" method="post">';
												echo '<input type=hidden name="reserva" value="'.$resCouch['idReserva'].'"/>';
												echo '<input type="submit" value="Puntuar"/>';
											echo '</form>';
										echo '</div>';
									}
									else {
										echo '<div id="yaPuntuado">';
											//echo 'Ya Puntuado';
										echo '</div>';
									}
								echo '</div>';

								echo '</div>';
							}
						}
					}
					if ($entro == false) {
						echo '<div id="noCouch">';
							echo '<p> No ha visitado ninguno de nuestros hospedajes hasta el momento </p>';
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