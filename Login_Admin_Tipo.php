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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Admin_Tipo.css"/>
</head>
<body>
	<?php
		include("Login_Admin_Cabeza.php");
	?>
	<div id= "cuerpo">
		<?php
			include("Login_Admin_Menu.php");
		?>
		<div id= "lista">
			<div id= "titulo">
				<p> Tipos </p>
			</div>
			<div id= "subLis">
				<?php

					$query = "SELECT * FROM tipo";   //CONSULTA A LA TABLA TIPO
					$qe = mysql_query($query, $link);
					$num = mysql_num_rows ($qe);

					if ($num <> 0) {
						for ($i=0; $i<$num; $i++) {

							echo '<div id="fila">';
							
							$resTipo=mysql_fetch_array($qe);

							echo '<div id="tipo">';
								echo '<p> '.$resTipo['Tipo'].' </p>';
							echo '</div>';

							echo '<div id="editareliminar">';
								echo '<div id="editar">';
									echo '<form action="Login_Admin_Modificar_Tipo.php" method="post">';
										echo '<input type=hidden name="idtipo" value="'.$resTipo['idTipo'].'"/>';
										echo '<input id="boton2" type="submit" value="Modificar"/>';
									echo '</form>';
								echo '</div>';

								echo '<div id="eliminar">';
									if ($resTipo['Eliminado'] == 1) {
										echo '<form action="Login_Admin_Activar_Tipo.php" method="post">';
											echo '<input type=hidden name="idtipo" value="'.$resTipo['idTipo'].'"/>';
											echo '<input id=boton1 type="submit" value="Activar"/>';
										echo '</form>';
									}
									else {
										echo '<form action="Login_Admin_Eliminar_Tipo.php" method="post">';
											echo '<input type=hidden name="idtipo" value="'.$resTipo['idTipo'].'"/>';
											echo '<input id="boton3" type="submit" value="Eliminar"/>';
										echo '</form>';
									}
								echo '</div>';
							echo '</div>';

							echo '</div>';
						}
					}
					else {
						echo '<div id="noTipo">';
							echo '<p> No tiene ningun tipo publicado hasta el momento </p>';
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