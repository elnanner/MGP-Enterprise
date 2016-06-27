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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Reservar_Couch.css"/>	
</head>
<body>
	<?php
		include("Login_Cabeza.php");
	?>
	<div id= "cuerpo">
		<?php
			include("Login_Menu.php");
		?>
		<div id= "Resercouch">
			<div id= "titulo">
				<p> Reservar Hospedaje </p>
			</div>
			<div id="subBus">
					<?php
				$couch= $_POST['couch'];
				$query= "SELECT * FROM couch WHERE idCouch=$couch"; 
				$q= mysql_query($query, $link);
				$resCouch= mysql_fetch_array($q);
				
				if ($_SESSION['idUComun'] == $resCouch['idUComun']) {
					echo '<div id="idIguales">';
						echo "No puede realizar reserva ya que este hospedaje es suyo";
					echo '</div>';
				}
				else {
					echo '<form  method="post" name="registro">';

						echo '<input type=hidden name="couch" value="'.$_POST['couch'].'"/>'; // ESTO SIRVE PARA QUE CUANDO APRETAS EL BOTON NO PIERDA EL POST 

						echo '<div id="formulario">';
							echo 'Capacidad: ';
							?><input type="number" min="1" REQUIRED name="capacidad" PLACEHOLDER="Ingrese la cant. de personas" value="<?php if (isset ($_POST['capacidad'])) { echo $_POST['capacidad'];} else {echo "";}?>"/><?php
						echo '</div>';
						echo '<div id="formulario">';
							echo 'Fecha Ingreso: ';
							?><input type="date" REQUIRED name="fechaInicio" min="2016-01-01" value="<?php if (isset ($_POST['fechaInicio'])) { echo $_POST['fechaInicio'];} else {echo "";}?>"/><?php
						echo '</div>';
						echo '<div id="formulario">';
							echo 'Fecha Egreso: ';
							?><input type="date" REQUIRED name="fechaFin" min="2016-01-01" value="<?php if (isset ($_POST['fechaFin'])) { echo $_POST['fechaFin'];} else {echo "";}?>"/><?php
						echo '</div>';
						echo '<div id= "boton">';
							echo '<div id= "boton1">';
								echo '<input type="submit" name="aceptar" value="Reservar"/>';
							echo '</div>';
							echo '<div id= "boton2">';
								?><input type="button" name="cancelar" value="Cancelar" onClick="location.href='Login_Index.php'"/><?php
							echo '</div>';
						echo '</div>';
					echo '</form>';

					/* setlocale(LC_ALL,"es_ES");   ESTO DA LA FECHA ACTUAL
					echo "la fecha actual es " . date("d") . " del " . date("m") . " de " . date("Y"); */
					if (isset($_POST['aceptar'])) {

					if ($_POST['capacidad'] <= $resCouch['Capacidad']) {

						if ($_POST['fechaInicio'] > date("Y-m-d")) {
							if ($_POST['fechaInicio'] <= $_POST['fechaFin']) {  //POR SI SOLO SE QUEDA UN DIA
								$aceptada= 2;  //CONULTO POR EL 2, SI ES 2 ESTA VACIO AUN NO RESPONDIO SOBRE LA RESERVA (Aceptada o Rechazada)
								$query= "INSERT INTO reserva (idCouch, idUComunCouch, idUComun, FechaInicio, FechaFin, CapacidadPersonas, Aceptada) 
								VALUES ('".$couch."','".$resCouch['idUComun']."','".$_SESSION['idUComun']."','".$_POST['fechaInicio']."','".$_POST['fechaFin']."','".$_POST['capacidad']."','".$aceptada."')";
								mysql_query ($query);
								?>
								<script type="text/javascript">
									alert ("La reserva fue realizada correctamente, la solicitud queda pendiente a confirmar");
									location.href='Login_Index.php';
								</script>
								<?php
							}
							else {
								?>
								<script type="text/javascript">
									alert ("La fecha de ingreso es mayor a la fecha de egreso");
									//location.href='Login_Index.php';
								</script>
								<?php
							}
						}
						else {
							?>
							<script type="text/javascript">
								alert ("La fecha de ingreso es menor a la fecha actual");
								//location.href='Login_Index.php';
							</script>
							<?php
						}
					}
					else {
						?>
						<script type="text/javascript">
							alert ("La cantidad de personas ingresadas supera la capacidad del hospedaje");
							//location.href='Login_Index.php';
						</script>
						<?php
					}
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