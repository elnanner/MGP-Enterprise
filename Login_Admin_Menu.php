<?php
include("Conectar.php");
?>
<!DOCTYPE html>
<head>
   <title> CouchInn </title>
   <link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Admin_Menu.css"/>
   <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
</head>
<body>
   <div id= "cuerpo">
   <div class="wrap">
   <nav>
      <ul class="menu">
         <li><a href='Login_Admin_Index.php'> Inicio</a></li>
         <li><a href=''> Tipos</a>
            <ul>
               <li><a href='Login_Admin_Cargar_Tipo.php'>Cargar Tipo</a></li>
               <li><a href='Login_Admin_Tipo.php'>Ver Tipos</a></li>
            </ul>
         </li>
         <li><a href=''> Generar Reportes</a>
            <ul>
               <li><a href='Login_Admin_Mostrar_Ganancias.php'>Ganancias</a></li>
               <li><a href='Login_Admin_Reservas_Aceptadas.php'>Reservas Aceptadas</a></li>
            </ul>
         </li>
         <li><a href='.php'> Eliminar Usuario</a></li>
         <li><a href='.php'> Eliminar Hospedaje</a></li>
      </ul>
      <div class="clearfix"></div>
   </nav>
   </div>
   </div>
</body>
</html>
