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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Modificar_Clave.css"/>	
</head>
<body>
	<?php
		include("Login_Cabeza.php");
	?>
	<div id= "cuerpo">
		<?php
			include("Login_Menu.php");
		?>
		<div id= "ModCla">
			<div id= "titulo">
				<p> Modificar Contrase&ntildea </p>

				<form method="post" name="registro">

					<?php
					$query = "SELECT * FROM ucomun WHERE ucomun.idUComun=".$_SESSION['idUComun']."";
					$q = mysql_query($query, $link);
					$res=mysql_fetch_array($q);
					?>
					<?php echo '<input type=hidden name="idUComun" value="'.$res['idUComun'].'"/>'; ?>
					<?php echo '<input type=hidden name="clave" value="'.$res['Clave'].'"/>'; ?>
					<div id="subBus">
					<div id= "formulario">
						Contrase&ntildea:
						<input type="password" REQUIRED name="claVieja" MINLENGTH="6" MAXLENGTH="10" PLACEHOLDER="Ingrese su contraseña"/>
					</div>
					<div id="ejemplo">
						Mínimo 6 caracteres y máximo 10 caracteres
					</div>
					<div id= "formulario">
						Contrase&ntildea Nueva:
						<input type="password" REQUIRED name="cla1" MINLENGTH="6" MAXLENGTH="10" PLACEHOLDER="Ingrese una contraseña"/>
					</div>
					<div id="ejemplo">
						Mínimo 6 caracteres y máximo 10 caracteres
					</div>
					<div id= "formulario">
						Repetir:
						<input type="password" REQUIRED name="cla2" MINLENGTH="6" MAXLENGTH="10" PLACEHOLDER="Ingrese una contraseña"/>
					</div>
					<div id="ejemplo">
						Mínimo 6 caracteres y máximo 10 caracteres
					</div>
					<div id= "boton">
						<div id= "boton1">
							<input type="submit" name="modificar" value="Modificar"/>
						</div>
						<div id= "boton2">
							<input type="button" name="cancelar" value="Cancelar" onClick="location.href='Login_Index.php'"/>
						</div>
					</div>
					</div>
				</form>
				<?php
				if (isset($_POST['claVieja']) and $_POST['modificar']) {

					if ($_POST['claVieja'] === $_POST['clave']) {

						if ($_POST['cla1'] === $_POST['cla2']) {
							
							$idUComun= $_POST['idUComun'];
							$clave= $_POST['cla1'];
							$cad= "update ucomun set ucomun.Clave='$clave' where ucomun.idUComun='$idUComun'";
							mysql_query($cad);
							?>
							<script type="text/javascript">
								alert ("La clave ha sido modificado correctamente");
								location.href='Login_Index.php';
							</script>
							<?php
						}
						else {
							?>
							<script type="text/javascript">
								alert ("No coinciden las claves ingresadas, reingrese sus datos");
								//location.href='Login_Modificar_Cuenta.php';
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