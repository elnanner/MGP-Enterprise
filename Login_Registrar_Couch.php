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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Registrar_Couch.css"/>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="JavaScript_index.js"></script>
	<script src="Jquery.js" type="text/javascript"></script>

</head>
<body>
	<?php
		include("Login_Cabeza.php");
	?>
	<div id= "cuerpo">
		<?php
			include("Login_Menu.php");
		?>
		<div id= "lista">
			<div id= "titulo">
				<p> Registrar Hospedaje </p>
				<div id="subBus">
				<form  method="post" name="registro">
					<div id= "formulario">
						Titulo:
						<input type="text" REQUIRED name="titulo" value="<?php if (isset ($_POST['titulo'])) { echo $_POST['titulo'];} else {echo ""; }?>" PLACEHOLDER="Ingrese un titulo"/>
					</div>
					<div id= "formulario">
						Tipo:
						<select name="tipo" REQUIRED>
							<option value="">Seleccione un tipo</option>
							<?php
								$query = "SELECT * FROM tipo WHERE tipo.Eliminado=0"; 
								$q = mysql_query($query, $link);
								while($result=mysql_fetch_array($q)) {	
									echo"<option value=".$result["idTipo"].">".$result["Tipo"]."</option>";
								}
							?>
						</select>
					</div>
					<div id= "formulario">
						Capacidad:
						<input type="number" min="1" REQUIRED name="capacidad" value="<?php if (isset ($_POST['capacidad'])) { echo $_POST['capacidad'];} else {echo ""; }?>" PLACEHOLDER="Ingrese la capacidad"/>
					</div>
					<div id= "formulario">
						Provincia:
						<select name="prov" id="provincias" style="width: 16em" onchange="obtenerDep()" REQUIRED>
							<option value="">Seleccione una provincia</option>
							<?php
								$query = "SELECT * FROM provincias"; 
								$q = mysql_query($query, $link);
								while($result=mysql_fetch_array($q)) {	
									echo"<option value=".$result["idProvincias"].">".$result["Provincia"]."</option>";
								}
							?>
						</select>
					</div>
					<div id= "formulario">
						Departamento:
						<select name="dep" id="departamentos" style="width: 16em" onchange="obtenerLoc()" REQUIRED>
							<option value="">Seleccione un departamento</option>

						</select>
					</div>
					<div id= "formulario">
						Localidad:
						<select name="loc" id="localidades" style="width: 16em" REQUIRED>
							<option value="">Seleccione una localidad</option>
						</select>
					</div>
					<div id= "formulario">
						Descripcion:
						<textarea rows="4" cols="40" REQUIRED name="descripcion" MAXLENGTH="140" value="<?php if (isset ($_POST['descripcion'])) { echo $_POST['descripcion'];} else {echo ""; }?>" PLACEHOLDER="Ingrese una descripcion"><?php if (isset ($_POST['descripcion'])) { echo $_POST['descripcion'];} else {echo ""; }?></textarea>	
					</div>
					<div id= "boton">
						<div id= "boton1">
							<input type="submit" name="aceptar" value="Siguiente"/>
						</div>
						<div id= "boton2">
							<input type="button" name="cancelar" value="Cancelar" onClick="location.href='Login_Index.php'"/>
						</div>
					</div>
				</form>
				</div>
				<?php
				if (isset($_POST['aceptar'])) {
					$puntaje=0;
					$query= "INSERT INTO couch (idUComun, Titulo, idTipo, Capacidad, idProvincias, idDepartamentos, idLocalidades, Descripcion, Puntaje) 
					VALUES ('".$_SESSION['idUComun']."','".$_POST['titulo']."','".$_POST['tipo']."','".$_POST['capacidad']."','".$_POST['prov']."','".$_POST['dep']."','".$_POST['loc']."','".$_POST['descripcion']."','".$_POST['puntaje']."')";
					mysql_query ($query);
					?>
						<script type="text/javascript">
							location.href='Login_Registrar_Couch_SubirFoto.php';
						</script>
					<?php
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