<?php 
include("Conectar.php");
?>
<!DOCTYPE html> 
<head>
   <title> CouchInn </title>
   <link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Menu.css"/>
   <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
</head>
<body>
   <div id= "cuerpo">
   <div class="wrap">
   <nav>
      <ul class="menu">
         <li><a href='Login_Index.php'> Inicio</a></li>
         <li><a href=''> Notificaciones</a>
         	<ul>
               <li><a href='Login_Reservar_DondeMeQuede.php'> Donde me qued&eacute</a></li>
               <li><a href='Login_Reservar_Listado.php'> Reservas</a></li>
               <li><a href='Login_Reservar_Viajeros.php'> Viajeros</a></li>
            </ul>
         </li>
         <li><a href=''> Mis Hospedajes</a>
            <ul>
               <li><a href='Login_Registrar_Couch.php'>Publicar Hospedaje</a></li>
               <li><a href='Login_MisCouch.php'>Ver Mis Hospedajes</a></li>
            </ul>
         </li>
         <li><a href='Login_Buscar.php'> Buscar Hospedaje</a></li>
         <li><a href=''> Mi Cuenta</a>
            <ul>
               <li><a href='Login_Modificar_Cuenta.php'>Modificar Cuenta</a></li>
               <li><a href='Login_Modificar_Clave.php'>Modificar Contraseña</a></li>
               <li><a href='Login_Eliminar_Cuenta.php'>Eliminar Cuenta</a></li>
               <li><a href='Login_MiCuenta.php'>Ver Mi Cuenta</a></li>
            </ul>
         </li>
         <li><a href='Login_Premium.php'>Premium</a>
      </ul>
      <div class="clearfix"></div>
   </nav>
   </div>
   </div>
</body>
</html>