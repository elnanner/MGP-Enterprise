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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Registrar_Couch_SubirFoto.css"/>
</head>
<body>
	<?php
		include("Login_Cabeza.php");
	?>
	<div id= "cuerpo">
		<?php
			include("Login_Menu.php");
		?>
		<div id= "Subir">
			<div id= "titulo">
				<p> Subir Fotos </p>

				<form action="#" method="post" enctype="multipart/form-data">
					<div id= "formulariotexto">
						<?php
						$query = "SELECT MAX(idCouch) AS idCouch FROM couch"; 
						$res=mysql_query ($query);
						$fila=mysql_fetch_array ($res);	   //OPTIENE EL ULTIMO COUCH CARGADO

						$query = "SELECT * FROM imagenes WHERE imagenes.idCouch='".$fila["idCouch"]."'";
						$q = mysql_query($query, $link);
						$numCantFoto=mysql_num_rows ($q);
						if ($numCantFoto == 0) {
							echo "Fotos subidas: 0";
						}
						else {
							echo "Fotos subidas: ".$numCantFoto;
						}
						?>
					</div>
					<div id= "formulario">
						<input name="foto1" type="file" id="foto1"/>
					</div>
					<div id= "boton">
						<div id= "boton1">
							<input type="submit" name="guardar" value="Confirmar esta foto" />
						</div>
						<div id= "boton2">
							<input type="submit" name="guardarTodo" value="Finalizar" />
						</div>
						<div id= "boton3">
							<input type="submit" name="cancelar" value="Cancelar"/>
						</div>
					</div>
				</form>


				<?php
				if(isset($_POST['cancelar'])) {
					$query = "SELECT MAX(idCouch) AS idCouch FROM couch"; 
					$res=mysql_query ($query);
					$fila=mysql_fetch_array ($res);	   //OPTIENE EL ULTIMO COUCH CARGADO

					$cadImg= "delete from imagenes where imagenes.idCouch=".$fila["idCouch"]."";
					mysql_query($cadImg); //BOORA TODAS LAS FOTOS DE ES COUCH
					$cad= "delete from couch where couch.idCouch=".$fila["idCouch"].""; 
					mysql_query($cad); //BORRA EL COUCH

					header('Location: Login_Index.php');
				}
				else {			  			  			  
					if(isset($_POST['guardar'])) {
					  	
						$query = "SELECT MAX(idCouch) AS idCouch FROM couch"; 
						$res=mysql_query ($query);
						$fila=mysql_fetch_array ($res);	   //OPTIENE EL ULTIMO COUCH CARGADO

						$nombrefoto1=$_FILES['foto1']['name'];
						$ruta1=$_FILES['foto1']['tmp_name'];
						if(is_uploaded_file($ruta1)) { 
							if($_FILES['foto1']['type'] == 'image/png' OR $_FILES['foto1']['type'] == 'image/gif' OR $_FILES['foto1']['type'] == 'image/jpeg') {
								$tips = 'jpg';
								$type = array('image/jpeg' => 'jpg');
								$name = 'ID'.$fila['idCouch'].' - '.$nombrefoto1.'.'.$tips;
								$destino1 =  "imagenes/".$name;
								copy($ruta1,$destino1);
								//echo $destino1;

								$ruta_imagen = $destino1;

								$miniatura_ancho_maximo = 900;
								$miniatura_alto_maximo = 700;

								$info_imagen = getimagesize($ruta_imagen);
								$imagen_ancho = $info_imagen[0];
								$imagen_alto = $info_imagen[1];
								$imagen_tipo = $info_imagen['mime'];

								switch ( $imagen_tipo ){
									  case "image/jpg":
									  case "image/jpeg":
									    $imagen = imagecreatefromjpeg( $ruta_imagen );
									    break;
									  case "image/png":
									    $imagen = imagecreatefrompng( $ruta_imagen );
									    break;
									  case "image/gif":
									    $imagen = imagecreatefromgif( $ruta_imagen );
									    break;
								}

								$lienzo = imagecreatetruecolor( $miniatura_ancho_maximo, $miniatura_alto_maximo );

								imagecopyresampled($lienzo, $imagen, 0, 0, 0, 0, $miniatura_ancho_maximo, $miniatura_alto_maximo, $imagen_ancho, $imagen_alto);


								imagejpeg($lienzo, $destino1, 80);
							}
						}

						if (isset($destino1)) {	
							$query = "SELECT * FROM imagenes WHERE imagenes.Imagen='".$destino1."'";
							$q = mysql_query($query, $link);
							$num=mysql_num_rows ($q);
							if ($num == 0) {
								//FALTA QUE RECIBA EL IDCOUCH PARA QUE LO GUARDE Y QUEDE ASOCIADO
								$act = "INSERT INTO imagenes (idCouch, Nombre, Imagen) VALUES ('".$fila["idCouch"]."','".$_POST['nombre']."','".$destino1."')";
								mysql_query($act);
								
								header('Location: Login_Registrar_Couch_SubirFoto.php');
							}
							else {
								?>
								<script type="text/javascript">
									alert ("Esa foto ya ha sido cargada");
								</script>
								<?php
							}
						}
						else {
							?>
							<script type="text/javascript">
								alert ("Debe seleccionar una foto");
							</script>
							<?php
						}	
					}
					else {
						if(isset($_POST['guardarTodo'])) {
					  	
							$query = "SELECT MAX(idCouch) AS idCouch FROM couch"; 
							$res=mysql_query ($query);
							$fila=mysql_fetch_array ($res);	   //OPTIENE EL ULTIMO COUCH CARGADO

							$nombrefoto1=$_FILES['foto1']['name'];
							$ruta1=$_FILES['foto1']['tmp_name'];
							if(is_uploaded_file($ruta1)) { 
								if($_FILES['foto1']['type'] == 'image/png' OR $_FILES['foto1']['type'] == 'image/gif' OR $_FILES['foto1']['type'] == 'image/jpeg') {
									$tips = 'jpg';
									$type = array('image/jpeg' => 'jpg');
									$name = 'ID'.$fila['idCouch'].' - '.$nombrefoto1.'.'.$tips;
									$destino1 =  "imagenes/".$name;
									copy($ruta1,$destino1);

									$ruta_imagen = $destino1;

									$miniatura_ancho_maximo = 900;
									$miniatura_alto_maximo = 700;

									$info_imagen = getimagesize($ruta_imagen);
									$imagen_ancho = $info_imagen[0];
									$imagen_alto = $info_imagen[1];
									$imagen_tipo = $info_imagen['mime'];

									switch ( $imagen_tipo ){
										  case "image/jpg":
										  case "image/jpeg":
										    $imagen = imagecreatefromjpeg( $ruta_imagen );
										    break;
										  case "image/png":
										    $imagen = imagecreatefrompng( $ruta_imagen );
										    break;
										  case "image/gif":
										    $imagen = imagecreatefromgif( $ruta_imagen );
										    break;
									}

									$lienzo = imagecreatetruecolor( $miniatura_ancho_maximo, $miniatura_alto_maximo );

									imagecopyresampled($lienzo, $imagen, 0, 0, 0, 0, $miniatura_ancho_maximo, $miniatura_alto_maximo, $imagen_ancho, $imagen_alto);


									imagejpeg($lienzo, $destino1, 80);
								}
							}

							if (isset($destino1)) {	
								$query = "SELECT * FROM imagenes WHERE imagenes.Imagen='".$destino1."'";
								$q = mysql_query($query, $link);
								$num=mysql_num_rows ($q);
								if ($num == 0) {
									//FALTA QUE RECIBA EL IDCOUCH PARA QUE LO GUARDE Y QUEDE ASOCIADO
									$act = "INSERT INTO imagenes (idCouch, Nombre, Imagen) VALUES ('".$fila["idCouch"]."','".$_POST['nombre']."','".$destino1."')";
									mysql_query($act);

									header('Location: Login_Index.php');
								}
								else {
									?>
									<script type="text/javascript">
										alert ("Esa foto ya ha sido cargada");
									</script>
									<?php
								}
							}
							else {
								if ($numCantFoto == 0) {
									?>
									<script type="text/javascript">
										alert ("Debe seleccionar una foto");
									</script>
									<?php
								}
								else {
									header('Location: Login_Index.php');
								}
							}
						}
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