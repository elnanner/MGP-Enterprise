<?php
include("conectar.php");

$idDepartamentos = mysql_real_escape_string($_POST["id"]);

$consulta = mysql_query("SELECT * FROM localidades WHERE idDepartamentos='$idDepartamentos'");

echo "<option value=''>Seleccione una localidad</option>";

while($result = mysql_fetch_array($consulta)) {
	echo"<option value=".$result["idLocalidades"].">".$result["Localidad"]."</option>";
}
?>