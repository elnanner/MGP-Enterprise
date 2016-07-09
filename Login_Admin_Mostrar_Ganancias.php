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
    <link rel="stylesheet" href="Estilos_Login_Admin_Mostrar_Ganancias.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <?php
  		include("Login_Admin_Cabeza.php");
  	?>
  	<div id= "cuerpo">
  	  <?php
  			include("Login_Admin_Menu.php");
  		?>
      <div class="contenido-ganancias">
        <div id= "titulo">
          <p> Modificar Tipo </p>
          <form class="ingreso-fechas"  method="post">
              <div id="formulario">
               Seleccione Fecha Desde: <input type="date" id='fd' name="fechaDesde" value="" min="2016-01-01">
              </div>
              <div id="formulario"> 
                Seleccione Fecha Hasta: <input type="date" id='fh' name="fechaHasta" value="" min="2016-01-01">
              </div>
              <br>
              <div id="boton">
                <input type="submit" name="mostrarGanancias" value="Mostrar Resultados" onclick="return validarFechas()">
                <input type="button" name="cancelar" value="Cancelar" onClick="location.href='Login_Admin_Index.php'"/>
              </div>
          </form>
        </div>
        
        <table>
          <thead>
            <tr>
              <th>Fecha Desde</th>
              <th>Fecha Hasta</th>
							<th>Fecha Alta Usuario</th>
							<th>Usuario</th>
              <th style="text-align:left">Ganancia Obtenida</th><!--la tiro a la izq-->
            </tr>

          </thead>
          <tbody>
            <?php
              if(isset($_POST['mostrarGanancias'])){
                $fechaDesde = $_POST['fechaDesde'];
                $fechaHasta = $_POST['fechaHasta'];
                $consulta = "SELECT * FROM ganancias WHERE (fecha >='".$fechaDesde."') AND (fecha <= '".$fechaHasta."') GROUP BY fecha";
                $tuplas = mysql_query($consulta,$link);
                $numTuplas=mysql_num_rows($tuplas);
                //echo "fecha ".$fechaDesde;
                echo "numero de tuplas ".$numTuplas;
								$gananciaTotal = 0;//si hay tuplas las calcula en el if, sino muestra 0
                if($numTuplas <> 0){//hay tuplas
                  //for ($i=0; $i < $numTuplas; $i++) {
                  while($dato =mysql_fetch_array($tuplas)){
	                  mostrarUsuario($fechaDesde,$fechaHasta,$dato,$numTuplas);//muestro los datos
                	}
									$gananciaTotal = $numTuplas*100;
                }
                else{
                  echo " No Existen datos para as fechas ingresadas";
                }
              }
            ?>

          </tbody>
        </table>
				<table>
					<thead>
							<th style="text-align:right;padding-right: 8px">Ganancia Total</th>
					</thead>
				</table>
				<table>
					<thead>
							<th style="text-align:right;padding-right: 8px"><p><?php if (isset($gananciaTotal)) { echo $gananciaTotal; } ?></p></th>
					</thead>
				</table>
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
	echo "<td style='text-align:left'>".$monto."</td>";
	echo "</tr>";
}
function usuarioTipoEnlace($usuario){
	echo "<td><form action='DatosUsuario.php' method='post'>
  <input type='submit' style ='background: transparent;border: none;font-weight:bolder';id='botonUsuario' name='datoUsuario' value='".$usuario."' />
  </form> </td>";
}

 ?>
