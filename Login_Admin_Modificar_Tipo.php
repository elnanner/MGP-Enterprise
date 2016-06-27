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
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Admin_Modificar_Tipo.css"/>	
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
				<p> Modificar Tipo </p>

				<form method="post" name="registro">
					<?php
					if (!isset($_POST['tipo'])) {
						$idtipo= $_POST['idtipo'];
						$query = "SELECT * FROM tipo WHERE idTipo=$idtipo"; 
						$q = mysql_query($query, $link);
						$res=mysql_fetch_array($q);				

						echo '<input type=hidden name="idtipo" value="'.$_POST['idtipo'].'"/>'; // ESTO SIRVE PARA QUE CUANDO APRETAS EL BOTON NO PIERDA EL POST

						echo '<div id= "formulario">';
							echo '<div "id= tip">';
								echo 'Tipo: ';
								echo '<input type="text" REQUIRED name="tipo" MAXLENGTH="25" value="'.$res['Tipo'].'"/>';
							echo '</div>';
						echo '</div>';
						echo '<div id= "boton">';
							echo '<div id= "boton1">';
								echo '<input type="submit" name="modificar" value="Modificar"/>';
							echo '</div>';
							echo '<div id= "boton2">';
								?><input type="button" name="cancelar" value="Cancelar" onClick="location.href='Login_Admin_Tipo.php'"/><?php
							echo '</div>';
							
						echo '</div>';
					}
					else {
						echo '<input type=hidden name="idtipo" value="'.$_POST['idtipo'].'"/>'; // ESTO SIRVE PARA QUE CUANDO APRETAS EL BOTON NO PIERDA EL POST

						echo '<div id= "formulario">';
							echo '<div "id= tip">';
								echo 'Tipo: ';
								echo '<input type="text" REQUIRED name="tipo" MAXLENGTH="25" value="'.$_POST['tipo'].'"/>';
							echo '</div>';
						echo '</div>';
						echo '<div id= "boton">';
							echo '<div id= "boton1">';
								echo '<input type="submit" name="modificar" value="Modificar"/>';
							echo '</div>';
							echo '<div id= "boton2">';
								?><input type="button" name="cancelar" value="Cancelar" onClick="location.href='Login_Admin_Tipo.php'"/><?php
							echo '</div>';
							
						echo '</div>';
					}
					?>
				</form>
				<?php
					if (isset ($_POST['modificar'])) {

						$consulta="SELECT * FROM tipo
						WHERE tipo.Tipo='".$_POST['tipo']."'";
						$res=mysql_query ($consulta);
						$num_resultados=mysql_num_rows ($res);  //PARA COTEJAR QUE EL TIPO NO EXISTA

						if ($num_resultados<>0) {
							?>
							<script type="text/javascript">
								alert ("El tipo ya existe");
								//location.href='Login_Admin_Tipo.php';
							</script>
							<?php						
						}
						else {
							$idtipo= $_POST['idtipo'];
							$tipo=$_POST['tipo'];
							$cad= "update tipo set tipo.idTipo='$idtipo', tipo.Tipo='$tipo' where tipo.idTipo='$idtipo'";
							mysql_query($cad);

							?>
							<script type="text/javascript">
								alert ("El tipo fue modificado");
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