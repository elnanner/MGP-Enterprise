<?php
include("conectar.php");

$idProvincias = mysql_real_escape_string($_POST["id"]);

$consulta = mysql_query("SELECT * FROM departamentos WHERE idProvincias='$idProvincias'");

echo "<option value=''>Seleccione un departamento</option>";

while($result = mysql_fetch_array($consulta)) {
	echo"<option value=".$result["idDepartamentos"].">".$result["Departamento"]."</option>";
}
?>