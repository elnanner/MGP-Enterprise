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
    <link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Admin_Modificar_Tipo.css"/>
    <link rel="stylesheet" href="Login_Admin_Mostrar_Ganancias.css" media="screen" title="no title" charset="utf-8">


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
        <form class="ingreso-fechas"  method="post">
            Seleccione Fecha Desde: <input type="date" id='fd' name="fechaDesde" value="" min="2016-01-01">
            Seleccione Fecha Hasta: <input type="date" id='fh' name="fechaHasta" value="" min="2016-01-01">
            <br>
            <input type="submit" name="mostrarGanancias" value="Mostrar Resultados" onclick="return validarFechas()">

        </form>
        <table>
          <thead>
            <tr>
              <td>Fecha Desde</td>
              <td>Fecha Hasta</td>
              <td>Ganancia Obtenida</td>
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
                if($numTuplas <> 0){//hay tuplas
                  //for ($i=0; $i < $numTuplas; $i++) {
                    $dato =mysql_fetch_array($tuplas);
	                  mostrar($fechaDesde,$fechaHasta,$dato,$numTuplas);//muestro los datos
                  //}

                }
                else{
                  echo " No Existen datos para as fechas ingresadas";
                }
              }
            ?>
             <tr>
               <td id="1"></td>
               <td id="2"></td>
               <td id='3'></td>
             </tr>
          </tbody>
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
      <?php	include("Pie.php"); 	?>
  </body>
</html>
<?php
  function mostrar($fechaDesde,$fechaHasta,$dato,$numTuplas){
    $res = $numTuplas*100;
    echo "<tr>";
    echo "<td>".$fechaDesde."</td>";
    echo "<td>".$fechaHasta."</td>";
  //  echo "<td>".$res."</td>";
    echo "</tr>";
  }
 ?>
