<?php
session_start();
if(!isset($_SESSION['estaLoggeadoUsuarioAdmin']) || isset($_SESSION['estaLoggeadoUsuarioAdmin']) && $_SESSION['estaLoggeadoUsuarioAdmin'] == false){
	die("Ud. no tiene acceso para visitar esta secci&oacute;n.");
}
include("Conectar.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>CouchInn | Reporte Ganancias</title>
    <link rel="stylesheet" href="Estilos_Login_Admin_Mostrar_Ganancias_Listado.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <?php
  		include("Login_Admin_Cabeza.php");
  	?>
  	<div id= "cuerpo">
  	  <?php
  			include("Login_Admin_Menu.php");
  		?>
		</div>
      <div class="contenido-ganancias">
        <div id= "titulo">
          <p> Resultados Reporte de Ganancias </p>
      	</div>
					<table>
	          <thead>
	            <tr>
	              <th>Fecha Desde</th>
	              <th>Fecha Hasta</th>
								<th>Fecha Alta Usuario</th>
								<th class="columnaUsuario">Usuario</th>
	              <th id='thGananciaObtenida'>Ganancia Obtenida</th><!--la tiro a la izq-->
	            </tr>
	          </thead>
					</table>

	          <table>
							<tbody>
	            <?php
	              if(isset($_POST['mostrarGanancias'])){
	                $fechaDesde = $_POST['fechaDesde'];
	                $fechaHasta = $_POST['fechaHasta'];
	                $consulta = "SELECT * FROM ganancias WHERE (fecha >='".$fechaDesde."') AND (fecha <= '".$fechaHasta."') GROUP BY fecha";
	                $tuplas = mysql_query($consulta,$link);
	                $numTuplas= mysql_num_rows($tuplas);
	                //echo "fecha ".$fechaDesde;
	                //echo "numero de tuplas ".$numTuplas;
									$gananciaTotal = 0;//si hay tuplas las calcula en el if, sino muestra 0
	                if($numTuplas <> 0){//hay tuplas
	                  while($dato =mysql_fetch_array($tuplas)){
		                  mostrarUsuario($fechaDesde,$fechaHasta,$dato,$numTuplas);//muestro los datos
	                	}
										$gananciaTotal = $numTuplas*100;
	                }
	                else{
	                  echo '<div id= "formulario">';
	                    echo "No se encontraron datos para las fechas ingresadas";
	                  echo '</div>';
	                }
	              }
	            ?>
	          </tbody>
		        </table>

						<div class="separador">
							<!--solamente es para separar las tablas-->
						</div>

						<table class="tablaGanancia">
							<thead>
									<th style="text-align:right;padding-right: 8px">Ganancia Total</th>
							</thead>
							<tbody>
								<tr>
									<td style="text-align:right;padding-right: 8px">
										<?php if (isset($gananciaTotal)) { echo $gananciaTotal; } ?></th>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="separador">
							<!--solamente es para separar las tablas-->
						</div>
						<div id="boton">
							<input type="button" name="volver" value="Volver" onClick="location.href='Login_Admin_Mostrar_Ganancias.php'"/>
						</div>
				</div>
      <script type="text/javascript">
        function validarFechas(){
          var fechaDesde = document.getElementById('fd').value;//fecha del 1er input
          var fechaHasta = document.getElementById('fh').value;//fecha del 2do nput
          if((fechaDesde == "")||(fechaHasta == "")){//si alguna o 2 de las fechas no fueron seteadas->alert
            alert("Se deben ingresar ambas fechas");
            return false;
          }
          if(fechaDesde>fechaHasta){
            alert("La fecha 'desde' no puede ser posterior a la fecha 'hasta'");
            return false;
          }
          //paso la validacion entondes retorno true;
          alert("Desde: "+fechaDesde+"  "+"Hasta: "+fechaHasta);
          return true;
        }
				</script>
      <?php	include("Pie.php");	?>
  </body>
</html>


<?php
function mostrarUsuario($fechaDesde,$fechaHasta,$dato,$numTuplas){
	$monto = 100;//este se podria poner de otra manera para una futura modif pero no lo pide
	$queryNombreUsuario = "SELECT Usuario FROM ucomun WHERE (idUComun ='".$dato['idUsuario']."')";
	$resultadoUsuario = mysql_query($queryNombreUsuario);
	$nombreUsuario = mysql_fetch_array($resultadoUsuario);
	$usuarioPost = $nombreUsuario['Usuario'];
	$_POST['datoUsuario']=$usuarioPost;// para pasar el dato la re puta madreeeeeee!!!no me saliaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa!!!!!!aaaaaaaaaaa!!!
	echo "<tr>";
	echo "<td>".$fechaDesde."</td>";
	echo "<td>".$fechaHasta."</td>";
	echo "<td>".$dato['fecha']."</td>";
	usuarioTipoEnlace($usuarioPost);
	echo "<td >".$monto."</td>";
	echo "</tr>";
}
function usuarioTipoEnlace($usuario){
	echo "<td class='columnaUsuario'><form class='columnaUsuario'action='DatosUsuario.php' method='post'>
  <input class='columnaUsuario'type='submit' style ='background: transparent;border: none;font-weight:bolder';id='botonUsuario' name='datoUsuario' value='".$usuario."' />
  </form> </td>";
}

 ?>
