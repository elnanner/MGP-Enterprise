<?php 
session_start();
include("Iniciar_Sesion_Ingresar_Usuario.php");
include("Conectar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="Estilos_Iniciar_Sesion.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<title>CouchInn</title>
</head>
<body>
	<?php
		include("Cabeza.php");
	?> 
	<div id="cuerpo">
		<div id="IniSes">
			<div id= "titulo">
				<p> Iniciar Sesi&oacuten </p>
			</div>
			<div id="subBus">
			<form method="post" name="sesio">
					<div id= "formulario">
						 Correo: 
						<input type="email" name="usuariou" required value="<?php if (isset ($_POST['usuariou'])) { echo $_POST['usuariou'];} else {echo ""; }?>" PLACEHOLDER="Ingrese su correo"/>
					</div>
					<div id= "formulario">
						 Contrase&ntildea: 
						<input type="password" name="claveu" required PLACEHOLDER="Ingrese su contraseña"/>
					</div>
					<div id=recuperar>
						<a href= "Recuperar_Contrasena.php">
							 &#191Olvidaste tu contrase&#241a&#63 
						</a>
					</div>
					<div id='boton'>
						<input type="submit" name="iniciar" value="Iniciar Sesión"/>
					</div>
				</form>
				</div>
			<?php
				//array (EsUsuario , NoUsuario , ClaveIncorrencta)
				if  (isset($_POST['iniciar'])) {
					if (isset($_POST['usuariou']) and $_POST['claveu']) {
						$usuario= new user;
						$usua= $_POST['usuariou'];
						$clav= $_POST['claveu'];

						$array2=array();
						$array2=$usuario->pido_dato ($usua,$clav); 

						//for ($i=0; $i<4; $i++) {
						//	if ($array2[$i]==true) {
						//		echo "bien ".$i;
						//	}
						//}

						if ($array2[0]==true) {  //EsUsuario
							if ($_SESSION['idUComun'] == 1) {  //VERIFICA SI SOS EL ADMIN.. SINO LO SOS SOS USER COMUN
								$_SESSION['estaLoggeadoUsuarioAdmin'] = true;
								$_SESSION['estaLoggeadoUsuario'] = false;
								header('Location: Login_Admin_Index.php');
							}
							else {
								$_SESSION['estaLoggeadoUsuario'] = true;
								$_SESSION['estaLoggeadoUsuarioAdmin'] = false;
								header('Location: Login_Index.php');
							}
						}
						else {
							if ($array2[1]==true) {   //NoUsuario
								?> 
								<script type="text/javascript">
								alert ('Los datos ingresados no son correctos, por favor revise los datos ingresados. \nSi no se encuentra registrado, registrese!');
								</script>
								<?php
							}
							else {
								if ($array2[2]==true) {   //ClaveIncorrecto
									?> 
									<script type="text/javascript">
										alert ('La clave es incorrecto');
									</script>
									<?php
								}
							}
						}
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