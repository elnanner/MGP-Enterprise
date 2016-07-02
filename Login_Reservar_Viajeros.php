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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Reservar_Viajeros.css"/>
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
				<p> Viajeros que me visitaron </p>
			</div>
			<div id= "subLis">
				<?php
					$query = "SELECT * 
							FROM ucomun 	
							INNER JOIN reserva ON ucomun.idUComun=reserva.idUComun 
							INNER JOIN couch ON reserva.idCouch=couch.idCouch
							INNER JOIN localidades ON couch.idLocalidades=localidades.idLocalidades
							WHERE reserva.idUComunCouch=".$_SESSION['idUComun']." ORDER BY reserva.idReserva DESC";
					$q = mysql_query($query, $link);
					$num=mysql_num_rows ($q);

					$entro=false;  //PARA SABER SI HAY COUCHS VISITADOS
					if ($num <> 0) {
						for ($i=0; $i<$num; $i++) {

							$resCouch=mysql_fetch_array($q);

							if (($resCouch['FechaFin'] < date("Y-m-d")) and ($resCouch['Aceptada'] == 1)) {   //SI LA FECHA DE FIN ES MENOR A LA FECHA DE HOY Y LA RECERVA ESTA ACEPTADA, LO MUESTRO!!!
								$entro=true;  //PARA SABER SI HAY COUCHS VISITADOS

								echo '<div id="fila">';

								echo '<div id="nom">';
									echo '<b> '.$resCouch['Nombre'].' '.$resCouch['Apellido'].' </b>';
								echo '</div>';

								echo '<div id="mai">';
									echo '<p> '.$resCouch['Mail'].' </p>';
								echo '</div>';

								echo '<div id="res">';
									echo '<b>Fecha Ingreso:&nbsp</b><p>'.$resCouch['FechaInicio'].'&nbsp</p><b>&nbspFecha Egreso:&nbsp</b><p>'.$resCouch['FechaFin'].'</p>';
								echo '</div>';

								echo '<div id="loc">';
									echo '<p> '.$resCouch['Titulo'].', '.$resCouch['Localidad'].' </p>';
								echo '</div>';

								echo '<div id="boton">';
									if ($resCouch['PuntuarViajero'] == 0) {
										echo '<div id="puntuar">';
											echo '<form action="Login_Reservar_PuntuarViajero.php" method="post">';
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
							echo '<p> Ningun viajero ha visitado mis hospedajes hasta el momento </p>';
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