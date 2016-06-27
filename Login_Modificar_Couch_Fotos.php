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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Modificar_Couch_Fotos.css"/>	
</head>
<body>
	<?php
		include("Login_Cabeza.php");
	?>
	<div id= "cuerpo">
		<?php
			include("Login_Menu.php");
		?>
		<div id= "LisFoto">
			<div id= "titulo">
				<p> Fotos </p>
			</div>
			<div class="scrollbardos" id="subLis">
				<?php
				$couch=$_GET['couch'];
				?>
				<div id= "subir"> 
					<?php
						echo '<form action="Login_SubirFoto_Couch.php" method="get">';
							echo 'Subir otra foto: <input type=hidden name="couch" value="'.$couch.'"/>';
							echo '<input id="subirboton" type="submit" value="Subir"/>';
						echo '</form>';
					?>
				</div>

				<?php
				$query = "SELECT * FROM imagenes WHERE idCouch='".$couch."'";   //CONSULTA A LA TABLA IMAGENES CHOCANDO IDCOUCH
				$qe = mysql_query($query, $link);
				$num=mysql_num_rows ($qe);
				for ($i=0; $i<$num; $i++) {
					$resImg=mysql_fetch_array($qe);
					
					echo '<div id= "foto">';
						echo '<div id= "fotoDer">';

						if ($resImg['Imagen']<>"") {	
							echo'<img src="'.$resImg['Imagen'].'" width="320" height="240"/>';
						}
						else {
							echo'<img src="Imagen/sillon.png" width="320" height="240"/>';
						}

						echo '</div>';
						echo '<div id= "fotoElim">';
							echo '<form action="Login_Eliminar_Couch_Fotos.php" method="get">';
								echo '<input type=hidden name="couch" value="'.$couch.'"/>';
								echo '<input type=hidden name="imagen" value="'.$resImg['idImagenes'].'"/>';
								echo '<input id="el" type="submit" value="Eliminar"/>';
							echo '</form>';
						echo '</div>';
					echo '</div>';
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