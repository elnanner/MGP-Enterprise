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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Modificar_Cuenta.css"/>	
</head>
<body>
	<?php
		include("Login_Cabeza.php");
	?>
	<div id= "cuerpo">
		<?php
			include("Login_Menu.php");
		?>
		<div id= "ModUsu">
			<div id= "titulo">
				<p> Modificar Cuenta </p>
				<div id="subBus">
				<form method="post" name="registro">
					<?php
					if (!isset($_POST['idUComun'])) {
						$query = "SELECT * FROM ucomun WHERE ucomun.idUComun=".$_SESSION['idUComun']."";
						$q = mysql_query($query, $link);
						$res=mysql_fetch_array($q);

						echo '<input type=hidden name="idUComun" value="'.$res['idUComun'].'"/>';
						echo '<input type=hidden name="user" value="'.$res['Usuario'].'"/>';
						echo '<input type=hidden name="clave" value="'.$res['Clave'].'"/>';
						echo '<input type=hidden name="premium" value="'.$res['Premium'].'"/>';

						echo '<div id= "formulario">';
							echo 'Nombre: ';
							echo '<input type="text" pattern="([a-zA-ZÁÉÍÓÚñáéíóú][\s]*)+([a-zA-ZÁÉÍÓÚñáéíóú][\s]*)+([a-zA-ZÁÉÍÓÚñáéíóú][\s]*)" REQUIRED name="nombre" value="'.$res['Nombre'].'"/>';
						echo '</div>';
						echo '<div id="ejemplo">';
							echo 'Formato solicitado: Solo letras';
						echo '</div>';
						echo '<div id= "formulario">';
							echo 'Apellido: ';
							echo '<input type="text" pattern="([a-zA-ZÁÉÍÓÚñáéíóú][\s]*)+([a-zA-ZÁÉÍÓÚñáéíóú][\s]*)+([a-zA-ZÁÉÍÓÚñáéíóú][\s]*)" REQUIRED name="apellido" value="'.$res['Apellido'].'"/>';
						echo '</div>';
						echo '<div id="ejemplo">';
							echo 'Formato solicitado: Solo letras';
						echo '</div>';
						echo '<div id= "formulario">';
							echo 'Edad: ';
							echo '<input type="number" REQUIRED name="edad" min="18" max="105" style="width: 12em" value="'.$res['Edad'].'"/>';
						echo '</div>';
						echo '<div id="ejemplo">';
							echo 'Formato solicitado: Solo números';
						echo '</div>';
						echo '<div id= "formulario">';
							echo 'Correo: ';
							echo '<input type="email" REQUIRED name="mai" value="'.$res['Mail'].'"/>';
						echo '</div>';
						echo '<div id="ejemplo">';
							echo 'Ejemplo: example@server.com';
						echo '</div>';
						echo '<div id= "formulario">';
							echo 'Contrase&ntildea: ';
							echo '<input type="password" REQUIRED name="claVieja" MINLENGTH="6" MAXLENGTH="10"/>';
						echo '</div>';
						echo '<div id="ejemplo">';
							echo 'Mínimo 6 caracteres y máximo 10 caracteres';
						echo '</div>';
						echo '<div id="boton">';
							echo '<div id="boton1">';
								echo '<input type="submit" name="modificar" value="Modificar"/>';
							echo '</div>';
							echo '<div id= "boton2">';
								?><input type="button" name="cancelar" value="Cancelar" onClick="location.href='Login_Index.php'"/><?php
							echo '</div>';
						echo '</div>';
					} 
					else {
						echo '<input type=hidden name="idUComun" value="'.$_POST['idUComun'].'"/>';
						echo '<input type=hidden name="user" value="'.$_POST['user'].'"/>';
						echo '<input type=hidden name="clave" value="'.$_POST['clave'].'"/>';
						echo '<input type=hidden name="premium" value="'.$_POST['premium'].'"/>';

						echo '<div id= "formulario">';
							echo 'Nombre:';
							echo '<input type="text" pattern="([a-zA-ZÁÉÍÓÚñáéíóú][\s]*)+([a-zA-ZÁÉÍÓÚñáéíóú][\s]*)+([a-zA-ZÁÉÍÓÚñáéíóú][\s]*)" REQUIRED name="nombre" value="'.$_POST['nombre'].'"/>';
						echo '</div>';
						echo '<div id="ejemplo">';
							echo 'Formato solicitado: Solo letras';
						echo '</div>';
						echo '<div id= "formulario">';
							echo 'Apellido:';
							echo '<input type="text" pattern="([a-zA-ZÁÉÍÓÚñáéíóú][\s]*)+([a-zA-ZÁÉÍÓÚñáéíóú][\s]*)+([a-zA-ZÁÉÍÓÚñáéíóú][\s]*)" REQUIRED name="apellido" value="'.$_POST['apellido'].'"/>';
						echo '</div>';
						echo '<div id="ejemplo">';
							echo 'Formato solicitado: Solo letras';
						echo '</div>';
						echo '<div id= "formulario">';
							echo 'Edad:';
							echo '<input type="number" REQUIRED name="edad" min="18" max="105" style="width: 12em" value="'.$_POST['edad'].'"/>';
						echo '</div>';
						echo '<div id="ejemplo">';
							echo 'Formato solicitado: Solo números';
						echo '</div>';
						echo '<div id= "formulario">';
							echo 'Correo:';
							echo '<input type="email" REQUIRED name="mai" value="'.$_POST['mai'].'"/>';
						echo '</div>';
						echo '<div id="ejemplo">';
							echo 'Ejemplo: example@server.com';
						echo '</div>';
						echo '<div id= "formulario">';
							echo 'Contrase&ntildea:';
							echo '<input type="password" REQUIRED name="claVieja" MINLENGTH="6" MAXLENGTH="10"/>';
						echo '</div>';
						echo '<div id="ejemplo">';
							echo 'Mínimo 6 caracteres y máximo 10 caracteres';
						echo '</div>';
						echo '<div id="boton">';
							echo '<div id="boton1">';
								echo '<input type="submit" name="modificar" value="Modificar"/>';
							echo '</div>';
							echo '<div id= "boton2">';
								?><input type="button" name="cancelar" value="Cancelar" onClick="location.href='Login_Index.php'"/><?php
							echo '</div>';
						echo '</div>';
					}
					?>
				</form>
				</div>
				<?php
				if (isset($_POST['mai']) and $_POST['modificar']) {

					if ($_POST['claVieja'] === $_POST['clave']) {
						
						$consulta="SELECT * FROM ucomun
						WHERE ucomun.Usuario='".$_POST['mai']."'";
						$resul=mysql_query ($consulta);
						$num_resul=mysql_num_rows ($resul);
						$resMail=mysql_fetch_array($resul);
						if ($num_resul<>0 and $resMail['Usuario']<>$_POST['user']) {
							?>
							<script type="text/javascript">
								alert ("Ya existe ese nombre de usuario");
							</script>
							<?php
						}
						else {
							$idUComun= $_POST['idUComun'];
							$mail=$_POST['mai'];
							$clave= $_POST['clave'];
							$nombre= $_POST['nombre'];
							$apellido= $_POST['apellido'];
							$edad= $_POST['edad'];
							$prem=$_POST['premium'];
							$cad= "update ucomun set ucomun.idUComun='$idUComun', ucomun.Usuario='$mail', ucomun.Clave='$clave', ucomun.Nombre='$nombre', ucomun.Apellido='$apellido', ucomun.Edad='$edad', ucomun.Mail='$mail', ucomun.Premium='$prem' where ucomun.idUComun='$idUComun'";
							mysql_query($cad);
							?>
							<script type="text/javascript">
								alert ("El usuario ha sido modificado correctamente");
								location.href='Login_Index.php';
							</script>
							<?php
						}
					}
					else {
						?>
						<script type="text/javascript">
							alert ("La clave de su usuario no es correcta, reingrese sus datos");
							//location.href='Login_Modificar_Cuenta.php';
						</script>
						<?php
					}	
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