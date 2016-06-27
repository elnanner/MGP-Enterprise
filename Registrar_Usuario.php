<?php 
include("Conectar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="Estilos_Registrar_Usuario.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<title>CouchInn</title>
</head>
<body>
	<?php
		include("Cabeza.php");
	?> 
	<div id="cuerpo">
		<div id="RegisUsu">
			<div id= "titulo">
				<p> Registrate </p>
			</div>
			<div id="subBus">
			<form method="post" name="registro">
					<div id= "formulario">
						(*) Nombre: 
						<input type="text" maxlength="20" pattern="([a-zA-ZÁÉÍÓÚñáéíóú][\s]*)+([a-zA-ZÁÉÍÓÚñáéíóú][\s]*)+([a-zA-ZÁÉÍÓÚñáéíóú][\s]*)" REQUIRED name="nombre" value="<?php if (isset ($_POST['nombre'])) { echo $_POST['nombre'];} else {echo ""; }?>" PLACEHOLDER="Ingrese su nombre"/>
					</div>
					<div id="ejemplo">
						Formato solicitado: Solo letras
					</div>
					<div id= "formulario">
						(*) Apellido:
						<input type="text" maxlength="25" pattern="([a-zA-ZÁÉÍÓÚñáéíóú][\s]*)+([a-zA-ZÁÉÍÓÚñáéíóú][\s]*)+([a-zA-ZÁÉÍÓÚñáéíóú][\s]*)" REQUIRED name="apellido" value="<?php if (isset ($_POST['apellido'])) { echo $_POST['apellido'];} else {echo ""; }?>" PLACEHOLDER="Ingrese su apellido"/>
					</div>
					<div id="ejemplo">
						Formato solicitado: Solo letras
					</div>
					<div id= "formulario">
						(*) Edad:
						<input type="number" REQUIRED name="edad" min="18" max="105" style="width: 12em" value="<?php if (isset ($_POST['edad'])) { echo $_POST['edad'];} else {echo ""; }?>" PLACEHOLDER="Ingrese su edad"/>
					</div>
					<div id="ejemplo">
						Formato solicitado: Solo números
					</div>
					<div id= "formulario">
						(*) Correo:
						<input type="email" REQUIRED name="mai" value="<?php if (isset ($_POST['mai'])) { echo $_POST['mai'];} else {echo ""; }?>" PLACEHOLDER="Ingrese su correo"/>
					</div>
					<div id="ejemplo">
						Ejemplo: example@server.com
					</div>
					<div id= "formulario">
						(*) Contrase&ntildea:
						<input type="password" REQUIRED name="cla1" MINLENGTH="6" MAXLENGTH="10" PLACEHOLDER="Ingrese una contraseña"/>
					</div>
					<div id="ejemplo">
						Mínimo 6 caracteres y máximo 10 caracteres
					</div>
					<div id= "formulario">
						(*) Repetir:
						<input type="password" REQUIRED name="cla2" MINLENGTH="6" MAXLENGTH="10" PLACEHOLDER="Repita la contraseña"/>
					</div>
					<div id="ejemplo">
						Mínimo 6 caracteres y máximo 10 caracteres
					</div>
					<div id="obligatorio">
						<p> (*) Campo obligatorio </p>
					</div>
					<div id= "boton">
					<div id= "boton1">
							<input type="submit" name="aceptar" value="Registrar"/>
						</div>
						<div id= "boton2">
							<input type="button" name="cancelar" value="Cancelar" onClick="location.href='index.php'"/>
						</div>
					</div>
				</form>
				</div>
			<?php
				if (isset($_POST['mai']) and $_POST['aceptar']) {

					if ($_POST['cla1'] === $_POST['cla2']) {
						
						$consulta="SELECT * FROM ucomun 
						WHERE ucomun.Nombre='".$_POST['nombre']."' and ucomun.Apellido='".$_POST['apellido']."'";
						$res=mysql_query ($consulta);
						$num_resultados=mysql_num_rows ($res);
						if ($num_resultados<>0) {
							?>
							<script type="text/javascript">
								alert ("Ya existe un usuario con ese nombre y apellido");
								//location.href='Registrar_Ususario.php';
							</script>
							<?php
						}
						else {
							$consulta="SELECT * FROM ucomun
							WHERE ucomun.Usuario='".$_POST['mai']."'";
							$resul=mysql_query ($consulta);
							$num_resul=mysql_num_rows ($resul);
							if ($num_resul<>0) {
								?>
								<script type="text/javascript">
									alert ("Ya existe ese nombre de usuario");
									//location.href='Registrar_Ususario.php';
								</script>
								<?php
							}
							else {
								$query= "INSERT INTO ucomun (Usuario, Clave, Nombre, Apellido, Edad, Mail, Premium) 
								VALUES ('".$_POST['mai']."','".$_POST['cla1']."','".$_POST['nombre']."','".$_POST['apellido']."','".$_POST['edad']."','".$_POST['mai']."','".false."')";
								mysql_query ($query);
								?>
								<script type="text/javascript">
									alert ("El usuario ha sido creado correctamente \nBienvenido a CouchInn");
									location.href='Iniciar_Sesion.php';
								</script>
								<?php
							}
						}
					}
					else {
						?>
						<script type="text/javascript">
							alert ("No coinciden las claves ingresadas, reingrese sus datos");
							//location.href='Registrar_Ususario.php';
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
