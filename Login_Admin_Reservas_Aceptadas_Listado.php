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
    <title>CouchInn | Reporte Reservas Aceptadas</title>
    <link rel="stylesheet" href="Estilos_Login_Admin_Reservas_Aceptadas_Listado.css" media="screen" title="no title" charset="utf-8">
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
      <div class="contenido-reservas">
        <div id= "titulo">
          <p> Resultados Reporte de Reservas Aceptadas </p>
      	</div>
        <table>
          <thead>
            <tr>
              <th>Fecha Desde</th>
              <th>Fecha Hasta</th>
              <th>Fecha Aceptada</th>
              <th>Hospedaje</th>
              <th>Dueño de Hospedaje</th>
              <th>Usuario que Reserva</th>

            </tr>

          </thead>
        </table>

        <div class="separador">
        <!--solamente es para separar las tablas-->
        </div>

        <table>
          <tbody>
            <?php
              if(isset($_POST['mostrarReservas'])){
                $fechaDesde = $_POST['fechaDesde'];
                $fechaHasta = $_POST['fechaHasta'];
                $consulta = $consulta = "SELECT * FROM reserva WHERE (FechaInicio >='".$fechaDesde."') AND (FechaFin <= '".$fechaHasta."') AND (Aceptada = 1) ";
                $tuplas = mysql_query($consulta,$link);
                $numTuplas=mysql_num_rows($tuplas);
                //echo "fecha ".$fechaDesde;
                //echo "numero de tuplas ".$numTuplas;
                if($numTuplas <> 0){//hay tuplas
                  while($dato =mysql_fetch_array($tuplas)){
                    mostrar($fechaDesde,$fechaHasta,$dato);//muestro los datos
                  }
                }
                else{
                  echo " No Existen datos para las fechas ingresadas";
                }
              }
            ?>

          </tbody>
        </table>
					<div class="separador">
					       <!--solamente es para separar las tablas-->
					</div>
					<div id="boton">
						<input type="button" name="volver" value="Volver" onClick="location.href='Login_Admin_Reservas_Aceptadas.php'"/>
					</div>
			</div>
      <?php	include("Pie.php");	?>
  </body>
</html>


<?php
function mostrar($fechaDesde,$fechaHasta,$dato){
  //$dato contiene la tupla con la reserva, obtener los datos consultando las demas tablas :(
  $queryHospedaje = mysql_query("SELECT Titulo as titulo FROM couch WHERE (idCouch = '".$dato['idCouch']."')  ");
	$hospedaje = mysql_fetch_assoc($queryHospedaje);
  $dueño = mysql_fetch_assoc(mysql_query("SELECT Usuario as duenio FROM ucomun WHERE (idUComun ='".$dato['idUComunCouch']."')"));
  $usuarioReserva = mysql_fetch_assoc(mysql_query("SELECT Usuario as usuarioReserva FROM ucomun WHERE (idUComun ='".$dato['idUComun']."')"));
  $fechaAceptada = mysql_fetch_assoc(mysql_query("SELECT FechaAceptada as fechaAceptada FROM reserva WHERE (FechaAceptada ='".$dato['FechaAceptada']."')"));
  //$resultadoUsuario = mysql_query($queryNombreUsuario);
//	$nombreUsuario = mysql_fetch_array($resultadoUsuario);
//	$usuarioPost = $nombreUsuario['Usuario'];
//	$_POST['datoUsuario']=$usuarioPost;// para pasar el dato la re puta madreeeeeee!!!no me saliaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa!!!!!!aaaaaaaaaaa!!!
	echo "<tr>";
	echo "<td class='col-fechaDesde'>".$fechaDesde."</td>";
	echo "<td class='col-fechaHasta'>".$fechaHasta."</td>";
  echo "<td class='col-fechaAceptada'>".$fechaAceptada['fechaAceptada']."</td>";
  echo "<td class='col-hospedaje'>".$hospedaje['titulo']."</td>";
	usuarioTipoEnlace($dueño['duenio']);
  usuarioTipoEnlace($usuarioReserva['usuarioReserva']);
	echo "</tr>";
}
function usuarioTipoEnlace($usuario){
	echo "<td class='col-usuario'><form action='DatosUsuario.php' method='post'>
  <input type='submit' style ='color: #96ac3c; 	background: transparent;border: none;font-weight:bolder';id='botonUsuario' name='datoUsuario' value='".$usuario."' />
  </form> </td>";
}

 ?>
