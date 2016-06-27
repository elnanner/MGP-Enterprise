<?php 
include("Conectar.php");
?>
<!DOCTYPE html> 
<head>
	<title> CouchInn </title>
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Recuperar_Contrasena.css"/>	
</head>
<body>
	<?php
		include("Cabeza.php");
	?>
	<div id="cuerpo">
		<div id="RecuCon">
			<div id= "titulo">
				<p> Recuperar Contrase&#241a </p>
			</div>
			<form method="post" name="recuperar">
					<div id= "formulario">
						Correo:
						<input type="email" REQUIRED name="mailu" value="<?php if (isset ($_POST['mailu'])) { echo $_POST['mailu'];} else {echo ""; }?>" PLACEHOLDER="Ingrese su correo"/>
					</div>
					<div id= "boton">
						<div id= "boton1">
							<input type="submit" value="Recuperar contrase&#241a"/>
						</div>
						<div id= "boton2">
							<input type="button" name="cancelar" value="Cancelar" onClick="location.href='index.php'"/>
						</div>
					</div>
				</form>
			<?php
					if (isset($_POST['mailu']) <> "") {
						$mail = $_POST['mailu'];
						$query = "SELECT ucomun.Usuario, ucomun.Clave, ucomun.Mail FROM ucomun WHERE ucomun.Mail='$mail'";
						$q = mysql_query($query, $link);
						$result=mysql_fetch_array($q);
						if ($result) {
							$mensaje = "Hola, desde CouchInn nos ponemos en contacto con usted para enviarle su \r\n Usuario: ".$result['Usuario']."\r\n Contraseña: ".$result['Clave']."\r\n Gracias por usar CouchInn";
							mail($result['Mail'], 'CouchInn - Recuperar Contraseña', $mensaje);
							?>
							<script type="text/javascript">
								alert ("Se le ha enviado un correo con su contraseña");
								location.href='Iniciar_Sesion.php';
							</script>
							<?php
						}
						else {
							?>
							<script type="text/javascript">
								alert ("El correo ingresado no pertenece a un usuario registrado");
								//location.href='Recuperar_Contrasena.php';
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
	<script src="JavaScript_Registrar_Usuario.js"></script>
</body>
</html>