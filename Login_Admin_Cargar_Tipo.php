<?php 
session_start();
if(!isset($_SESSION['estaLoggeadoUsuarioAdmin']) || isset($_SESSION['estaLoggeadoUsuarioAdmin']) && $_SESSION['estaLoggeadoUsuarioAdmin'] == false){
	die("Ud. no tiene acceso para visitar esta secci&oacute;n.");
}
include("Conectar.php");
?>
<!DOCTYPE html> 
<head>
	<title> CouchInn </title>
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Admin_Cargar_Tipo.css"/>	
</head>
<body>
	<?php
		include("Login_Admin_Cabeza.php");
	?>
	<div id= "cuerpo">
		<?php
			include("Login_Admin_Menu.php");
		?>
		<div id= "CargTipo">
			<div id= "titulo">
				 Cargar Tipo 
				<form method="post" name="registro">
					<div id= "formulario">
						Tipo:
						<input type="text" REQUIRED name="tipo" value="<?php if (isset ($_POST['tipo'])) { echo $_POST['tipo'];} else {echo ""; }?>" PLACEHOLDER="Ingrese un tipo"/>
					</div>
					<div id= "boton">
						<div id= "boton1">
							<input type="submit" name="aceptar" value="Aceptar"/>
						</div>
						<div id= "boton2">
							<input type="button" name="cancelar" value="Cancelar" onClick="location.href='Login_Admin_Index.php'"/>
						</div>
					</div>
				</form>
				<?php
				if (isset ($_POST['aceptar'])) {

					$consulta="SELECT * FROM tipo
					WHERE tipo.Tipo='".$_POST['tipo']."'";
					$res=mysql_query ($consulta);
					$num_resultados=mysql_num_rows ($res);
					if ($num_resultados<>0) {
						?>
						<script type="text/javascript">
							alert ("El tipo ya existe");
							//location.href='Login_Admin_Tipo.php';
						</script>
						<?php						
					}
					else {
						$query= "INSERT INTO tipo (Tipo) VALUES ('".$_POST['tipo']."')";
						mysql_query ($query);

						?>
						<script type="text/javascript">
							alert ("El tipo fue cargado");
							location.href='Login_Admin_Tipo.php';
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