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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Buscar.css"/>	
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
</head>
<body>
	<?php
		include("Login_Cabeza.php");
	?>
	<div id= "cuerpo">
		<?php
			include("Login_Menu.php");
		?>
		<div id="buscar">
			<div id= "titulo">
				<p> Busca tu destino </p>
			</div>
			<div id= "SubBus">
				<form action="Login_Buscar_VerCouch.php" method="post" name="buscar">
					<div class= "select" id= "formulario">
						Titulo:
						<input type="text" name="titulo" value="" PLACEHOLDER="Ingrese un titulo"/>
					</div>
					<div class= "select" id= "formulario">
						Tipo:
						<select name="tipo" style="width:16em">
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
					<div class= "select" id= "formulario">
						Capacidad:
						<select name="capacidad" style="width: 16em">
							<option value="">Seleccione la capacidad</option>
							<option value="1"> 1 </option>
							<option value="2"> 2 </option>
							<option value="3"> 3 </option>
							<option value="4"> 4 </option>
							<option value="5"> 5 </option>
							<option value="6"> Mas... </option>
						</select>
					</div>
					<div class= "select" id= "formulario">
						Localidad:
						<select name="loc" id="localidades" style="width: 16em"> 
							<option value="">Seleccione una localidad</option>
							<?php
								$query = "SELECT * FROM localidades"; 
								$q = mysql_query($query, $link);
								while($result=mysql_fetch_array($q)) {	
									echo"<option value=".$result["idLocalidades"].">".$result["Localidad"]."</option>";
								}
							?>
						</select>
					</div>
					<div class= "select" id= "formulario">
						Puntaje:
						<select name="puntaje" style="width: 16em">
							<option value="">Seleccione el puntaje</option>
							<option value="1"> 1 </option>
							<option value="2"> 2 </option>
							<option value="3"> 3 </option>
							<option value="4"> 4 </option>
							<option value="5"> 5 </option>
						</select>
					</div>
					<div class= "select" id= "formulario1">
						Descripcion:
						<textarea rows="4" cols="40" name="descripcion" value="" MAXLENGTH="140" PLACEHOLDER="Ingrese una descripcion"></textarea>	
					</div>
					<div id="boton">
						<input type="submit" name="buscar" value="Buscar" onclick="buscar"/>
					</div>
				</form>
			</div>
		</div>
	<?php
		include("Pie.php");
	?>
</body>
</html>