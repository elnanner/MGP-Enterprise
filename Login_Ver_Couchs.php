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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Ver_Couchs.css"/>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>	
</head>
<body>
	<?php
		include("Login_Cabeza.php");
	?>
	<div id="cuerpo">
		<?php
			include("Login_Menu.php");
		?>
		<div id= "lista">
			<div id="titulo">
				<p> Hospedajes </p>
			</div>
			<div class="scrollbar" id="subLis">
				<?php

					$query = "SELECT * FROM couch ORDER BY idCouch DESC";   //CONSULTA A LA TABLA COUCH
					$q = mysql_query($query, $link);
					$num=mysql_num_rows ($q);
					
					if ($num<>0) {
						for ($i=0; $i<$num; $i++) {

							$resCouch=mysql_fetch_array($q);

							if ($resCouch['Publicado'] == 0) {

								echo '<div id= "fila">';

									$query = "SELECT * FROM imagenes WHERE idCouch='".$resCouch['idCouch']."'";   //CONSULTA A LA TABLA IMAGENES CHOCANDO IDCOUCH
									$qe = mysql_query($query, $link);
									$resImg=mysql_fetch_array($qe);

									echo '<a href="Login_Ver_Couchs_Detalles.php?couch='.$resCouch['idCouch'].'">';

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
							echo 'No disponemos de hospedajes por el momento.';
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