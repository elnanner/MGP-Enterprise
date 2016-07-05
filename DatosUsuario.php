<?php
session_start();
if(!isset($_SESSION['estaLoggeadoUsuarioAdmin']) || isset($_SESSION['estaLoggeadoUsuarioAdmin']) && $_SESSION['estaLoggeadoUsuarioAdmin'] == false){
	die("Ud. no tiene acceso para visitar esta secci&oacute;n.");
}
include("Conectar.php");
?>
<!DOCTYPE html>
<head>
	<title> CouchInn | Datos Usuario </title>
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_MiCuenta.css"/>
</head>
<body>
	<?php
		include("Login_Admin_Cabeza.php");
	?>
	<div id= "cuerpo">
		<?php
			include("Login_Admin_Menu.php");
		?>
		<div id= "MiCue">
			<div id= "titulo">
				Datos Usuario
					<div id="formu">
						<?php
            if(isset($_POST['datoUsuario']) && !empty($_POST['datoUsuario'])){
              $usuario = $_POST['datoUsuario'];

  						$query = "SELECT * FROM ucomun WHERE ucomun.Usuario='".$usuario."'";
  						$q = mysql_query($query, $link);
  						$res=mysql_fetch_array($q);
            }
            else{//si apreta enter en vez del correo lo mando a index de admin
              header('Location:Login_Admin_Index.php');
            }
						?>

						<div id= "formulario">
							<b> Nombre: </b> <?php echo $res['Nombre'] ?>
						</div>
						<div id= "formulario">
							<b> Apellido: </b> <?php echo $res['Apellido'] ?>
						</div>
						<div id= "formulario">
							<b> Edad: </b> <?php echo $res['Edad'] ?>
						</div>
						<div id= "formulario">
							<b> Correo: </b> <?php echo usuarioTipoEnlace($res['Mail']) ?>
						</div>
						<div id= "formulario">
							<b> Puntaje: </b>
							<?php
							if ($res['Puntaje'] == 0) {
								echo "Sin Puntaje";
							}
							else {
								echo $res['Puntaje'];
							}
							?>
						</div>
					</div>

			</div>
		</div>
	</div>
	<?php
		include("Pie.php");
	?>
</body>
</html>
<?php
function usuarioTipoEnlace($usuario){
  echo "<form action='DatosUsuario.php' method='post'>
  <input type='submit' style ='color: #6d6d6d;background:transparent;border: none;font-size:1em; font-family:Roboto'name='datoUsuario' value='".$usuario."' />
  </form>";
}

?>
