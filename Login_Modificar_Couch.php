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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Modificar_Couch.css"/>	

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
		<div id= "RegisUsu">
			<div id= "titulo">
				<p> Modificar Hospedaje </p>
				<div id="subBus">
				<form method="post" name="registro">

					<?php
						$couch= $_POST['couch'];
						$query = "SELECT * FROM couch WHERE idCouch=$couch"; 
						$q = mysql_query($query, $link);
						$res=mysql_fetch_array($q);				
					?>

						<?php echo '<input type=hidden name="couch" value="'.$_POST['couch'].'"/>'; // ESTO SIRVE PARA QUE CUANDO APRETAS EL BOTON NO PIERDA EL POST ?> 
						<?php echo '<input type=hidden name="idUComun" value="'.$res['idUComun'].'"/>'; ?>
						<?php echo '<input type=hidden name="puntaje" value="'.$res['Puntaje'].'"/>'; ?>

					<div id= "formulario">
						Titulo:
						<input type="text" REQUIRED name="titulo" value="<?php echo $res['Titulo'] ?>"/>
					</div>
					<div id= "formulario">
						Tipo:
						<select name="tipo" REQUIRED>
							<?php
								$query = "SELECT * FROM tipo WHERE idTipo=".$res['idTipo'].""; 
								$que = mysql_query($query, $link);
								$resTipo=mysql_fetch_array($que);
							?>
							<option value="<?php echo $resTipo['idTipo'] ?>"><?php echo $resTipo['Tipo'] ?></option>
							<?php
								$query = "SELECT * FROM tipo"; 
								$q = mysql_query($query, $link);
								while($result=mysql_fetch_array($q)) {	
									echo"<option value=".$result["idTipo"].">".$result["Tipo"]."</option>";
								}
							?>
						</select>
					</div>
					<div id= "formulario">
						Capacidad:
						<input type="number" min="1" REQUIRED name="capacidad" value="<?php echo $res['Capacidad'] ?>"/>
					</div>
					<div id= "formulario">
						Provincia:
						<select name="prov" id="provincias" style="width: 16em" onchange="obtenerDep()" REQUIRED>
							<?php
								$query = "SELECT * FROM provincias WHERE idProvincias=".$res['idProvincias'].""; 
								$que = mysql_query($query, $link);
								$resProv=mysql_fetch_array($que);
							?>
							<option value="<?php echo $resProv['idProvincias'] ?>"><?php echo $resProv['Provincia'] ?></option>
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
							<?php
								$query = "SELECT * FROM departamentos WHERE idDepartamentos=".$res['idDepartamentos'].""; 
								$que = mysql_query($query, $link);
								$resDepar=mysql_fetch_array($que);
							?>
							<option value="<?php echo $resDepar['idDepartamentos'] ?>"><?php echo $resDepar['Departamento'] ?></option>
						</select>
					</div>
					<div id= "formulario">
						Localidad:
						<select name="loc" id="localidades" style="width: 16em" REQUIRED>
							<?php
								$query = "SELECT * FROM localidades WHERE idLocalidades=".$res['idLocalidades'].""; 
								$que = mysql_query($query, $link);
								$resLocal=mysql_fetch_array($que);
							?>
							<option value="<?php echo $resLocal['idLocalidades'] ?>"><?php echo $resLocal['Localidad'] ?></option>
						</select>
					</div>
					<div id= "formulario">
						Descripcion:
						<textarea rows="4" cols="40" REQUIRED name="descripcion" MAXLENGTH="140" value="<?php echo $res['Descripcion'] ?>"><?php echo $res['Descripcion'] ?></textarea>	
					</div>
					<div id= "boton">
						<div id= "boton1">
							<input type="submit" name="modificar" value="Modificar"/>
						</div>
						<div id= "boton2">
							<input type="button" name="cancelar" value="Cancelar" onClick="location.href='Login_MisCouch.php'"/>
						</div>
					</div>
				</form>
				</div>
				<?php
				if (isset ($_POST['modificar'])) {
					$couch= $_POST['couch'];
					$user=$_POST['idUComun'];
					$titu= $_POST['titulo'];
					$tipo= $_POST['tipo'];
					$capac= $_POST['capacidad'];
					$prov= $_POST['prov'];
					$dep= $_POST['dep'];
					$loc= $_POST['loc'];
					$desc= $_POST['descripcion'];
					$punt=$_POST['puntaje'];
					$cad= "update couch set couch.idCouch='$couch', couch.idUComun='$user', couch.Titulo='$titu', couch.idTipo='$tipo', couch.Capacidad='$capac', couch.idProvincias='$prov', couch.idDepartamentos='$dep', couch.idLocalidades='$loc', couch.Descripcion='$desc', couch.Puntaje='$punt' where couch.idCouch='$couch'";
					mysql_query($cad);

					?>
					<script type="text/javascript">
						alert ("El couch fue modificado");
						location.href='Login_MisCouch.php';
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