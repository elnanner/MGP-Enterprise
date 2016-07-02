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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Reservar_AceptarRechazar.css"/>	
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
		<div id= "AceptarRechazar">

			<form method="post" name="borrar">

				<?php echo '<input type=hidden name="reserva" value="'.$_POST['reserva'].'"/>'; // ESTO SIRVE PARA QUE CUANDO APRETAS EL BOTON NO PIERDA EL POST ?> 
				<?php
					$query = "SELECT * FROM reserva WHERE reserva.idReserva=".$_POST['reserva']."";
					$q = mysql_query($query, $link);
					$num=mysql_num_rows ($q);
					$resCouch=mysql_fetch_array($q);
				?>

				<div id= "formulario">
					Un usuario desea reservar este couch desde <?php echo $resCouch['FechaInicio'] ?> hasta <?php echo $resCouch['FechaFin'] ?> para <?php echo $resCouch['CapacidadPersonas'] ?> personas. &#191Acepta la reserva?
					<div id="boton">
						<div id= "boton1">
							<input type="submit" name="aceptar" value="Aceptar"/>
						</div>
						<div id= "boton2">
							<input type="submit" name="rechazar" value="Rechazar"/>
						</div>
						<div id= "boton3">
							<input type="button" name="cancelar" value="Cancelar" onClick="location.href='Login_Reservar_Listado.php'"/>
						</div>
					</div>
				</div>
			</form>
				<?php
					if (isset($_POST['rechazar'])) {
						$idReserva= $_POST['reserva'];
						$boo= false;
						$cadRech= "update reserva set reserva.Aceptada='$boo' where reserva.idReserva='$idReserva'";
						mysql_query($cadRech);
						//PARA EL MAIL 
						$query = "SELECT * 
								  FROM couch 
								  INNER JOIN localidades ON couch.idLocalidades=localidades.idLocalidades
								  WHERE couch.idCouch=".$resCouch['idCouch']."";
						$q = mysql_query($query, $link);
						$resTituloLugar=mysql_fetch_array($q);
						//ENVIA UN MAIL AL VIAJERO PARA INFORMARLE QUE LE RECHAZARON LA RECERVA
						$query = "SELECT * FROM ucomun WHERE ucomun.idUComun=".$resCouch['idUComun']."";
						$q = mysql_query($query, $link);
						$resViajero=mysql_fetch_array($q);
						$mensajeAlViajero = "Hola, desde CouchInn nos ponemos en contacto con usted para comunicarle que la reserva solicitada ha sido rechazada. \r\n En el hospedaje: ".$resTituloLugar['Titulo']." en la localidad: ".$resTituloLugar['Localidad']." entre las fechas: ".$resCouch['FechaInicio']." y ".$resCouch['FechaFin']." \r\n Gracias por usar CouchInn";
						mail($resViajero['Mail'], 'CouchInn - Reserva Rechazada', $mensajeAlViajero);

						?>
						<script type="text/javascript">
							alert ("La reserva fue rechazada");
							location.href='Login_Reservar_Listado.php';
						</script>
						<?php
					}

					if (isset($_POST['aceptar'])) {
						
						$query = "SELECT * FROM reserva WHERE reserva.idCouch=".$resCouch['idCouch']."";
						$que = mysql_query($query, $link);
						$numVALIDAR=mysql_num_rows ($que);

						//PARA VER SI HAY RESERVAS ENTRE FECHAS YA ACEPTADAS
						$ControlAceptada= false;
						for ($i=0; $i<$numVALIDAR; $i++) {

							$resVALIDAR=mysql_fetch_array($que);

							//echo $resVALIDAR['idReserva']."---".$resVALIDAR['FechaInicio']."---".$resVALIDAR['FechaFin']."---".$resVALIDAR['idReserva']."---".$resCouch['FechaInicio']."---".$resCouch['FechaFin'];
							if (($resVALIDAR['FechaInicio'] > $resCouch['FechaInicio']) and ($resVALIDAR['FechaInicio'] < $resCouch['FechaFin']) or
								($resVALIDAR['FechaFin'] > $resCouch['FechaInicio']) and ($resVALIDAR['FechaFin'] < $resCouch['FechaFin'])) {
									if ($resVALIDAR['Aceptada'] == 1) {
										$ControlAceptada= true;
									}
							}
						}
						//SI NO HAY RESERVAS YA HACEPTADAS ENTRO Y ACEPTO LA RESERVA
						if ($ControlAceptada == false) {
							
							$query = "SELECT * FROM reserva WHERE reserva.idCouch=".$resCouch['idCouch']."";
							$que = mysql_query($query, $link);
							$numVALIDAR=mysql_num_rows ($que);
							
							for ($x=0; $x<$numVALIDAR; $x++) {

								$resVALIDAR=mysql_fetch_array($que);

								//echo $resVALIDAR['idReserva']."---".$resVALIDAR['FechaInicio']."---".$resVALIDAR['FechaFin']."---".$resVALIDAR['idReserva']."---".$resCouch['FechaInicio']."---".$resCouch['FechaFin'];
								if (($resVALIDAR['FechaInicio'] > $resCouch['FechaInicio']) and ($resVALIDAR['FechaInicio'] < $resCouch['FechaFin']) or
									($resVALIDAR['FechaFin'] > $resCouch['FechaInicio']) and ($resVALIDAR['FechaFin'] < $resCouch['FechaFin'])) {
										$idReserva= $resVALIDAR['idReserva'];
										$boo=false;
										$cadRech= "update reserva set reserva.Aceptada='$boo' where reserva.idReserva='$idReserva'";
										mysql_query($cadRech);
								}
							}
							$idReserva= $_POST['reserva'];
							$boo= true;
							$cadAcep= "update reserva set reserva.Aceptada='$boo' where reserva.idReserva='$idReserva'";
							mysql_query($cadAcep);  //PONE EN TRUE LA RESERVA, PASA A ESTAR ACEPTADA
							
							//PARA EL MAIL 
							$query = "SELECT * 
									  FROM couch 
									  INNER JOIN localidades ON couch.idLocalidades=localidades.idLocalidades
									  WHERE couch.idCouch=".$resCouch['idCouch']."";
							$q = mysql_query($query, $link);
							$resTituloLugar=mysql_fetch_array($q);
							//PARA EL DUEÑO DEL COUCH (ENVIO DATOS DEL VIAJERO)
							$query = "SELECT * FROM ucomun WHERE ucomun.idUComun=".$resCouch['idUComun']."";
							$q = mysql_query($query, $link);
							$resViajero=mysql_fetch_array($q);
							$mensajeAlDueno = "Hola, desde CouchInn nos ponemos en contacto con usted para enviarle la informacion del viajero \r\n Nombre: ".$resViajero['Nombre']."\r\n Apellido: ".$resViajero['Apellido']."\r\n Edad: ".$resViajero['Edad']."\r\n Mail: ".$resViajero['Mail']."\r\n Puntaje: ".$resViajero['Puntaje']."\r\n En el hospedaje: ".$resTituloLugar['Titulo']." en la localidad: ".$resTituloLugar['Localidad']." entre las fechas: ".$resCouch['FechaInicio']." y ".$resCouch['FechaFin']." \r\n Gracias por usar CouchInn";
							//PARA EL VIAJERO (ENVIO DATOS DEL DUEÑO DEL COUCH)
							$query = "SELECT * FROM ucomun WHERE ucomun.idUComun=".$resCouch['idUComunCouch']."";
							$q = mysql_query($query, $link);
							$resDueno=mysql_fetch_array($q);
							$mensajeAlViajero = "Hola, desde CouchInn nos ponemos en contacto con usted para enviarle la informacion del dueño del couch \r\n Nombre: ".$resDueno['Nombre']."\r\n Apellido: ".$resDueno['Apellido']."\r\n Edad: ".$resDueno['Edad']."\r\n Mail: ".$resDueno['Mail']."\r\n Puntaje: ".$resDueno['Puntaje']."\r\n En el hospedaje: ".$resTituloLugar['Titulo']." en la localidad: ".$resTituloLugar['Localidad']." entre las fechas: ".$resCouch['FechaInicio']." y ".$resCouch['FechaFin']." \r\n Gracias por usar CouchInn";

							mail($resDueno['Mail'], 'CouchInn - Reserva Aceptada', $mensajeAlDueno);  //PARA EL DUEÑO DEL COUCH (ENVIO DATOS DEL VIAJERO)
							mail($resViajero['Mail'], 'CouchInn - Reserva Aceptada', $mensajeAlViajero);  //PARA EL VIAJERO (ENVIO DATOS DEL DUEÑO DEL COUCH)

							?>
							<script type="text/javascript">
								alert ("La reserva fue aceptada");
								location.href='Login_Reservar_Listado.php';
							</script>
							<?php
						}
						//SI YA HAY RESERVAS ACEPTADAS EN ESA FECHA RECHADO LA RESERVA
						else {
							$idReserva= $_POST['reserva'];
							$boo= false;
							$cadRech= "update reserva set reserva.Aceptada='$boo' where reserva.idReserva='$idReserva'";
							mysql_query($cadRech);
							//PARA EL MAIL 
							$query = "SELECT * 
									  FROM couch 
									  INNER JOIN localidades ON couch.idLocalidades=localidades.idLocalidades
									  WHERE couch.idCouch=".$resCouch['idCouch']."";
							$q = mysql_query($query, $link);
							$resTituloLugar=mysql_fetch_array($q);
							//ENVIA UN MAIL AL VIAJERO PARA INFORMARLE QUE LE RECHAZARON LA RECERVA
							$query = "SELECT * FROM ucomun WHERE ucomun.idUComun=".$resCouch['idUComun']."";
							$q = mysql_query($query, $link);
							$resViajero=mysql_fetch_array($q);
							$mensajeAlViajero = "Hola, desde CouchInn nos ponemos en contacto con usted para comunicarle que la reserva solicitada ha sido rechazada. \r\n En el hospedaje: ".$resTituloLugar['Titulo']." en la localidad: ".$resTituloLugar['Localidad']." entre las fechas: ".$resCouch['FechaInicio']." y ".$resCouch['FechaFin']." \r\n Gracias por usar CouchInn";
							mail($resViajero['Mail'], 'CouchInn - Reserva Rechazada', $mensajeAlViajero);

							?>
							<script type="text/javascript">
								alert ("La reserva no pudo aceptarse porque ya hay una reserva confirmada en esa fecha\r\nLa reserva fue rechazada");
								location.href='Login_Reservar_Listado.php';
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