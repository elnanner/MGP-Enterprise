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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_MisCouch.css"/>
   	<script src="script.js"></script>
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
				<p> Mis Hospedajes </p>
			</div>
			<div id= "subLis">
				<?php

					$query = "SELECT * FROM couch WHERE idUComun=".$_SESSION['idUComun']." ORDER BY idCouch DESC";   //CONSULTA A LA TABLA COUCH
					$q = mysql_query($query, $link);
					$num=mysql_num_rows ($q);

					if ($num <> 0) {
						for ($i=0; $i<$num; $i++) {

							echo '<div id="fila">';
							
							$resCouch=mysql_fetch_array($q);

							$query = "SELECT * FROM imagenes WHERE idCouch='".$resCouch['idCouch']."'";   //CONSULTA A LA TABLA IMAGENES CHOCANDO IDCOUCH
							$qe = mysql_query($query, $link);
							$resImg=mysql_fetch_array($qe);

							echo '<a href="Login_Ver_Couchs_Detalles.php?couch='.$resCouch['idCouch'].'&img='.$resImg['idImagenes'].'">';

							echo '<div id="imag">';
								if ($resImg['Imagen']) {   //PREGUNTA SI TIENE IMAGEN SINO MUESTRA EL SILLON
									$dir = $resImg['Imagen'];
									echo'<img class="redondo" src="'.$dir.'" width="74" height="74"/>';
								}
								else {
									echo'<img class="redondo" src="Imagen/sillon.png" width="74" height="74"/>';
								}
							echo '</div>';

							echo '<div id="titu">';
								echo '<b> '.$resCouch['Titulo'].' </b>';
							echo '</div>';

							echo '<div id="publicar">';
								if ($resCouch['Publicado'] == 0) {
									echo '<form action="Login_Despublicar_Couch.php" method="post">';
										echo '<input type=hidden name="couch" value="'.$resCouch['idCouch'].'"/>';
										echo '<input type="submit" value="Despublicar"/>';
									echo '</form>';
								}
								else {
									echo '<form action="Login_Publicar_Couch.php" method="post">';
										echo '<input type=hidden name="couch" value="'.$resCouch['idCouch'].'"/>';
										echo '<input type="submit" value="Publicar"/>';
									echo '</form>';
								}
							echo '</div>';

							echo '<div id="editar">';
								echo '<form action="Login_Modificar_Couch.php" method="post">';
									echo '<input type=hidden name="couch" value="'.$resCouch['idCouch'].'"/>';
									echo '<input type="submit" value="Modificar"/>';
								echo '</form>';
							echo '</div>';

							echo '<div id="des">';
								echo '<p> '.$resCouch['Descripcion'].' </p>';
							echo '</div>';

							echo '<div id="foto">';
								echo '<form action="Login_Modificar_Couch_Fotos.php" method="get">';
									echo '<input type=hidden name="couch" value="'.$resCouch['idCouch'].'"/>';
									echo '<input type="submit" value="Fotos"/>';
								echo '</form>';
							echo '</div>';

							echo '<div id="eliminar">';
								echo '<form action="Login_Eliminar_Couch.php" method="post">';
									echo '<input type=hidden name="couch" value="'.$resCouch['idCouch'].'"/>';
									echo '<input type="submit" value="Eliminar"/>';
								echo '</form>';
							echo '</div>';

							echo '</a>';

							echo '</div>';
						}
					}
					else {
						echo '<div id="noCouch">';
							echo '<p> No tiene ningun hospedaje publicado hasta el momento </p>';
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