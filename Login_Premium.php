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
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Premium.css"/>
</head>
<body>
	<?php
		include("Login_Cabeza.php");
	?>
	<div id= "cuerpo">
		<?php
			include("Login_Menu.php");
		?>
		<?php
		$query = "SELECT * FROM ucomun WHERE idUComun=".$_SESSION['idUComun']."";
		$que = mysql_query($query, $link);
		$resU=mysql_fetch_array($que);
		if($resU['Premium'] == 0) {
			echo '<div id= "Premium">';
				echo '<div id= "titulo">';
					echo ' Hacerme Premium';
				echo '</div>';
				echo '<div id="exp">';
					echo "Usted puede ser usuario premium de CouchInn, abonando una cuota &uacutenica de $100, obteniendo as&iacute beneficios exclusivos en nuestro sitio.";
				echo '</div>';
				echo '<form method="post" name="registro">';
					echo '<div id= "formulario">';
						echo 'Número de Tarjeta:';
						echo '<input type="number" required name="numtar" PLACEHOLDER="Ingrese el numero de tarjeta"/>';
					echo '</div>';
					echo '<div id= "formularioEx">';
						echo '<div id= "formularioBoton">';
							echo '<input type="submit" name="validar" value="Validar"/>';
						echo '</div>';
						echo '<div id= "formularioBoton2">';
							?><input type="button" name="cancelar" value="Cancelar" onClick="location.href='Login_Index.php'"/><?php  //NO LOGRE HACER ANDARLO SINO ES HTML
						echo '</div>';
					echo '</div>';
				echo '</form>';
				if (isset ($_POST['validar'])) {

					$consulta="SELECT * FROM tarjetas
					WHERE tarjetas.Tarjeta='".$_POST['numtar']."'";
					$res=mysql_query ($consulta);
					$num_resultados=mysql_num_rows ($res);
					if ($num_resultados<>0) {
						$idUComun=$_SESSION['idUComun'];
						$boolean=true;
						$cad= "update ucomun set ucomun.Premium='$boolean' where ucomun.idUComun='$idUComun'";
						mysql_query($cad);
						/*aqui se ingresa una nueva tupla a la tabla de ganancias con la fecha actual*/
						$fechaActual = date('Y-m-d');//como lo guarda en la tabla el tipo date
						$actualUser = $_SESSION['idUComun'];//guardo el id de usuario que paso a premium para meterlo en la tabla
						$insertarFecha = "INSERT INTO ganancias (fecha, idUsuario) VALUES('$fechaActual','$actualUser')";
						mysql_query($insertarFecha);
						?>
						<script type="text/javascript">
							alert ("La operacion fue correcta \nUsted ya es un usuario premium");
							location.href='Login_Index.php';
						</script>
						<?php
					}
					else {
						?>
						<script type="text/javascript">
							alert ("La operacion ha sido rechazada, comuniquese con su banco");
							location.href='Login_Premium.php';
						</script>
						<?php
					}
				}
			echo '</div>';
		}
		else {
			echo '<div id= "soyPremium">';
			echo '<div id= "soytitulo">';
				echo 'Hacerme Premium';
			echo '</div>';
			echo '<div id="soyexp">';
				echo "Usted ya es usuario premium de CouchInn, gracias por elegir nuestro sitio.";
			echo '</div>';
			echo '<form method="post" name="registro">';
				echo '<div id= "soyformularioBoton">';
					echo '<div id= "soyBoton">';
						?><input type="button" name="volver" value="Volver" onClick="location.href='Login_Index.php'"/><?php  //NO LOGRE HACER ANDARLO SINO ES HTML
					echo '</div>';
				echo '</div>';
			echo '</form>';
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
