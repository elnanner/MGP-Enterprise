<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Couchinn | Datos Usuario</title>
  </head>
  <body>
    <table>
      <h2>Datos Usuario</h2>
      <thead>
        <tr>
          <td>Nombre de Usuario</td>
          <td>Nombre</td>
          <td>Apellido</th>
        </tr>
      </thead>
      <br>
      <tbody>
        <tr>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <?php
          if(isset($_POST['datoUsuario']) && !empty($_POST['datoUsuario'])){
            $usuario = $_POST['datoUsuario'];
            echo "<tr>";
            echo "<td>".usuarioTipoEnlace($usuario)."</td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "</tr>";
          }

         ?>

      </tbody>
    </table>


  </body>
</html>
<?php
function usuarioTipoEnlace($usuario){
  echo "<td><form action='DatosUsuario.php' method='post'>
  <input type='submit' style ='background: transparent;border: none;font-weight:bolder';id='botonUsuario' name='datoUsuario' value='".$usuario."' />
  </form> </td>";
}

 ?>
