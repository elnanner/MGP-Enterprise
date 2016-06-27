<?php 
include("Conectar.php");
?>
<!DOCTYPE html> 
<head>
	<title> CouchInn </title>
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Buscar_VerCouch.css"/>	
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
</head>
<body>
	<?php
		include("Cabeza.php");
	?>
	<div id= "cuerpo">
		<div id= "busque">
			<div id= "tituloBusque">
				<p> B&uacutesqueda </p>
			</div>
			<?php
			if (($_POST['titulo'] <> "")||($_POST['tipo'] <> "")||($_POST['capacidad'] <> "")||($_POST['loc'] <> "")||($_POST['puntaje'] <> "")||($_POST['descripcion'] <> "")) {

				if ($_POST['titulo'] <> "") {	
					echo '<div id= "formulario">';	
						echo 'Titulo: '.$_POST['titulo'];
					echo '</div>';
				}
				if ($_POST['tipo'] <> "") {	
					$query = "SELECT * FROM tipo WHERE idTipo='".$_POST['tipo']."'";
					$qe = mysql_query($query, $link);
					$resTipo=mysql_fetch_array($qe);
					echo '<div id= "formulario">';	
						echo 'Tipo: '.$resTipo['Tipo'];
					echo '</div>';
				}
				if ($_POST['capacidad'] <> "") {	
					echo '<div id= "formulario">';	
						echo 'Capacidad: '.$_POST['capacidad'];
					echo '</div>';
				}
				if ($_POST['loc'] <> "") {	
					$query = "SELECT * FROM localidades WHERE idLocalidades='".$_POST['loc']."'";
					$qe = mysql_query($query, $link);
					$resLoc=mysql_fetch_array($qe);
					echo '<div id= "formulario">';	
						echo 'Localidades: '.$resLoc['Localidad'];
					echo '</div>';
				}
				if ($_POST['puntaje'] <> "") {	
					echo '<div id= "formulario">';	
						echo 'Puntaje: '.$_POST['puntaje'];
					echo '</div>';
				}
				if ($_POST['descripcion'] <> "") {	
					echo '<div id= "formulario">';	
						echo 'Descripcion: '.$_POST['descripcion'];
					echo '</div>';
				}
			}
			else {
				echo '<div id= "formulario1">';	
						echo 'No ha filtrado por ninguna característica';
					echo '</div>';
			}
			?>
		</div>
		<div id= "lista">
			<div id= "titulo">
				<p> Resultados de B&uacutesqueda </p>
			</div>
			<div id= "order">
				<form action="Buscar_VerCouch.php" method="post" name="ord">
					Ordenar
					<select name="orden">
						<option value="no"> Ninguno </option>
						<option value="couch.idCouch"> Hospedaje </option>
						<option value="tipo.idTipo"> Tipo </option>
						<option value="couch.Capacidad"> Capacidad </option>
						<option value="couch.Puntaje"> Puntaje </option>
					</select>
					por
					<select name="metodo">
						<option value="no"> Ninguno </option>
						<option value="ASC"> Ascendente </option>
						<option value="DESC"> Descendente </option>
					</select>
					<?php
					echo '<input type="hidden" name="titulo" value="'.$_POST['titulo'].'"/>';
					echo '<input type="hidden" name="tipo" value="'.$_POST['tipo'].'"/>';
					echo '<input type="hidden" name="capacidad" value="'.$_POST['capacidad'].'"/>';
					echo '<input type="hidden" name="loc" value="'.$_POST['loc'].'"/>';
					echo '<input type="hidden" name="puntaje" value="'.$_POST['puntaje'].'"/>';
					echo '<input type="hidden" name="descripcion" value="'.$_POST['descripcion'].'"/>';
					?>
					<div id="botonorder">
						<input type="submit" value="Ordenar"/>
					</div>
				</form>
			</div>
			<div class="scrollbar" id="subLis">
				<?php
				$sql = "SELECT *
						FROM couch
						INNER JOIN tipo ON couch.idTipo=tipo.idTipo 
						INNER JOIN localidades ON couch.idLocalidades=localidades.idLocalidades";
				$where = "WHERE ";

				if ($_POST['titulo'] <> "")
				{		
					//SELECT * FROM couch WHERE Titulo LIKE "%casa%"
					/* SELECT * FROM couch 
					INNER JOIN tipo ON couch.idTipo=tipo.idTipo 
					INNER JOIN localidades ON couch.idLocalidades=localidades.idLocalidades 
					WHERE Titulo LIKE "%casa%" and Descripcion LIKE "%casa%" */
					if (strlen($where)==6) {
						$where.=" Titulo LIKE '%".$_POST['titulo']."%'";
					}
					else {
						$where.=" and Titulo LIKE '%".$_POST['titulo']."%'";
				    }
				}
				if ($_POST['descripcion'] <> "")
				{
					if (strlen($where)==6) {
						$where.=" Descripcion LIKE '%".$_POST['descripcion']."%'";
					}
					else {
						$where.=" and Descripcion LIKE '%".$_POST['descripcion']."%'";
				    }
				}
				if ($_POST['tipo'] <> "")
				{		
					if (strlen($where)==6) {
						$where.=" tipo.idTipo=".$_POST['tipo'];
					}
					else {
						$where.=" and tipo.idTipo=".$_POST['tipo'];
				    }
				}
				if ($_POST['loc'] <> "")
				{		
					if (strlen($where)==6) {
						$where.=" localidades.idLocalidades=".$_POST['loc'];
					}
					else {
						$where.=" and localidades.idLocalidades=".$_POST['loc'];
				    }
				}
				if ($_POST['capacidad'] <> "")
				{		
					if (strlen($where)==6) {
						$where.=" couch.Capacidad>=".$_POST['capacidad'];
					}
					else {
						$where.=" and couch.Capacidad>=".$_POST['capacidad'];
				    }
				}
				if ($_POST['puntaje'] <> "")
				{		
					if (strlen($where)==6) {
						$where.=" couch.Puntaje>=".$_POST['puntaje'];
					}
					else {
						$where.=" and couch.Puntaje>=".$_POST['puntaje'];
				    }
				}

				if (strlen($where) > 6)
				{
					$sql.=" ".$where;
				}

				if (isset($_POST['orden']) and $_POST['metodo'])
				{
					if ($_POST['orden']!='no')
					{
						if ($_POST['metodo']!='no')
						{
							$sql.=" ORDER BY ".$_POST['orden']." ".$_POST['metodo'];
						}
					}
				}

				//echo $sql;  //PARA VER SI FUNCIONA LA CONSULTA SQL
				
				$resultado=mysql_query($sql);
				$num_resultados=mysql_num_rows($resultado);
						
					if ($num_resultados<>0) {
						for ($i=0; $i<$num_resultados; $i++) {

							$resCouch=mysql_fetch_array($resultado);

							if ($resCouch['Publicado'] == 0) {

								echo '<div id= "fila">';

									$query = "SELECT * FROM imagenes WHERE idCouch='".$resCouch['idCouch']."'";   //CONSULTA A LA TABLA IMAGENES CHOCANDO IDCOUCH
									$qe = mysql_query($query, $link);
									$resImg=mysql_fetch_array($qe);

									echo '<a href="Ver_Couchs_Detalles.php?couch='.$resCouch['idCouch'].'&img='.$resImg['idImagenes'].'">';

									echo '<div id= "imag">';
										
										$query = "SELECT * FROM ucomun WHERE idUComun='".$resCouch['idUComun']."'";   //CONSULTA A LA TABLA USUARIO CHOCANDO IDUCOMUN
										$qe = mysql_query($query, $link);
										$resUser=mysql_fetch_array($qe);
										if ($resUser['Premium'] and $resImg['Imagen']) {   //SI PREMIUM ES TRUE Y SI SUBIO UNA IMAGEN
											$dir = $resImg['Imagen'];
											//echo $dir; PARA VER SI ANDA 
											echo'<img class="redondo" src="'.$dir.'" width="74" height="74"/>';
										}
										else {
											echo'<img class="redondo" src="Imagen/sillon.png" width="74" height="74"/>';
										}
									echo '</div>';

									echo '<div id= "titu">';
										echo '<b> '.$resCouch['Titulo'].' </b>';
									echo '</div>';

									echo '<div id= "cap">';
										echo '<b> Capacidad: </b>'.$resCouch['Capacidad'];
									echo '</div>';

									echo '<div id= "punt">';
										echo '<b> Puntaje: </b>'.$resCouch['Puntaje'];
									echo '</div>';

									echo '<div id= "ciudad">';
										$query = "SELECT * FROM provincias WHERE idProvincias='".$resCouch['idProvincias']."'";   //CONSULTA PROVINIA
										$qe = mysql_query($query, $link);
										$resID=mysql_fetch_array($qe);
										$ciudad= $resID['Provincia'];

										$query = "SELECT * FROM departamentos WHERE idDepartamentos='".$resCouch['idDepartamentos']."'";   //CONSULTA DEPARTAMENTO
										$qe = mysql_query($query, $link);
										$resID=mysql_fetch_array($qe);
										$ciudad= $ciudad.", ".$resID['Departamento'];

										$query = "SELECT * FROM localidades WHERE idLocalidades='".$resCouch['idLocalidades']."'";   //CONSULTA LOCALIDAD
										$qe = mysql_query($query, $link);
										$resID=mysql_fetch_array($qe);
										$ciudad= $ciudad.", ".$resID['Localidad'];
										echo $ciudad;
									echo '</div>';

									echo '<div id= "des">';
										echo '<p> '.$resCouch['Descripcion'].' </p>';
									echo '</div>';

									echo '</a>';

								echo '</div>';
							}
						}
					}
					else {
						echo '<div id="noCouch">';
							echo 'No disponemos de hospedajes con los requisitos ingresados';
						echo '</div>';
					}
				?>	
			</div>
			<div id="boton">
				<div id="botonvolver">
					<input type="button" name="volver" value="Volver" onClick="location.href='index.php'"/>
				</div>
			</div>
		</div>
	</div>
	<?php
		include("Pie.php");
	?>
</body>
</html>