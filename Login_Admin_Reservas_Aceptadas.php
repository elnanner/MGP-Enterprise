
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
      <title>CouchInn | Reservas Aceptadas</title>
      <link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Admin_Modificar_Tipo.css"/>
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
      </div>
      <div class="contenido-ganancias">
        <div id= "titulo">
          <p> Reporte de Reservas Aceptadas </p>
          <form action="Login_Admin_Reservas_Aceptadas_Listado.php" class="ingreso-fechas"  method="post">
              <div id="formulario">
               Seleccione Fecha Desde: <input type="date" id='fd' name="fechaDesde" value="" min="2016-01-01" max="2026-01-01" REQUIRED>
              </div>
              <div id="formulario">
                Seleccione Fecha Hasta: <input type="date" id='fh' name="fechaHasta" value="" min="2016-01-01" max="2026-01-01"REQUIRED>
              </div>
              <br>
              <div id="boton">
                <input type="submit" name="mostrarReservas" value="Mostrar resultados" onclick="return validarFechas();">
                <input type="button" name="cancelar" value="Cancelar" onClick="location.href='Login_Admin_Index.php'"/>
              </div>
          </form>
        </div>
      </div>

      <?php
        include("Pie.php");
      ?>
			<script type="text/javascript">
        function validarFechas(){
          var fechaDesde = document.getElementById('fd').value;//fecha del 1er input
          var fechaHasta = document.getElementById('fh').value;//fecha del 2do nput
          if((fechaDesde == "")||(fechaHasta == "")){//si alguna o 2 de las fechas no fueron seteadas->alert
            alert("Se deben ingresar ambas fechas");
            return false;
          }
					if(fechaDesde >= '2016-01-01' && fechaHasta >= '2016-01-01' ){
	          if(fechaDesde>fechaHasta){
	            alert("La fecha 'desde' no puede ser posterior a la fecha 'hasta'");
	            return false;
	          }
	          //paso la validacion entondes retorno true;
	          alert("Desde: "+fechaDesde+"  "+"Hasta: "+fechaHasta);
          	return true;
					}
					else{
						alert('El año debe ser igual o mayor que 2016');
					}
        }
				</script>
  </body>
</html>
