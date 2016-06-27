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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Reservar_PuntuarViajero.css"/>
</head>
<body>
	<?php
		include("Login_Cabeza.php");
	?>
	<div id= "cuerpo">
		<?php
			include("Login_Menu.php");
		?>
		<div id= "Puntuar">
			<div id= "titulo">
				<p> Puntuar Viajero </p>
			</div>
				<form method="post" name="puntaje">

					<?php echo '<input type=hidden name="reserva" value="'.$_POST['reserva'].'"/>'; // ESTO SIRVE PARA QUE CUANDO APRETAS EL BOTON NO PIERDA EL POST ?>

					<div id= "formulario">
						Puntaje:
						<select name="puntaje" REQUIRED>
							<option value="">Seleccione el puntaje</option>
							<option value="1"> 1 </option>
							<option value="2"> 2 </option>
							<option value="3"> 3 </option>
							<option value="4"> 4 </option>
							<option value="5"> 5 </option>
						</select>
					</div>
					<div id= "boton">
						<div id= "boton1">
							<input type="submit" name="aceptar" value="Puntuar"/>
						</div>
						<div id= "boton2">
							<input type="button" name="cancelar" value="Cancelar" onClick="location.href='Login_Reservar_Viajeros.php'"/>
						</div>	
					</div>
				</form>

				<?php			  			  			  
				if(isset($_POST['aceptar'])) {
				  	$query = "SELECT * FROM reserva WHERE reserva.idReserva=".$_POST['reserva']."";
					$q = mysql_query($query, $link);
					$resRes=mysql_fetch_array($q);  //TRAIGO LOS DATOS DE EL ID QUE ME LLEGO DE LA RESERVA

					$query = "SELECT * FROM ucomun WHERE ucomun.idUComun=".$resRes['idUComun']."";
					$que = mysql_query($query, $link);
					$resComun=mysql_fetch_array($que);  //TRAIGO LOS DATOS DE USUARIO

					if ($resComun['Puntaje'] == 0) {
						$punt=$_POST['puntaje'];
						$comun=$resComun['idUComun'];
						$cadComun= "update ucomun set ucomun.Puntaje='$punt' where ucomun.idUComun='$comun'";
						mysql_query($cadComun);  //CAMBIA EL PUNTAJE
					}
					else {
						$punt= (($resComun['Puntaje'] + $_POST['puntaje']) /2);
						$comun=$resComun['idUComun'];
						$cadComun= "update ucomun set ucomun.Puntaje='$punt' where ucomun.idUComun='$comun'";
						mysql_query($cadComun);  //CAMBIA EL PUNTAJE
					}

					$reserva=$_POST['reserva'];
					$puntuarviajero= true;
					$cadReserva= "update reserva set reserva.PuntuarViajero='$puntuarviajero' where reserva.idReserva='$reserva'";
					mysql_query($cadReserva);  //CAMBIA A TRUE EL PUNTUARVIAJERO

					?>
					<script type="text/javascript">
						alert ("El viajero fue puntuado correctamente");
						location.href='Login_Reservar_Viajeros.php';
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