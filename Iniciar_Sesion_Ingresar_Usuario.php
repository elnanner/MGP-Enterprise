<?php
//array (EsUsuario , NoUsuario , ClaveIncorrencta)
class user {
	function pido_dato($usu,$cla) {
		include ("Conectar.php");
		$query= "SELECT * FROM ucomun WHERE ucomun.Usuario='$usu'";   //COTEJO QUE EL USUARIO ESTE EN LA BASE DE DATOS
		$res=mysql_query ($query);
		$fila=mysql_fetch_array ($res);
		
		if ($fila['idUComun']<>"") {   //NOMBRE
			if ($fila['Clave'] === $cla) {   //CLAVE
				$array= array(true, false, false); //array (EsUsuario , NoUsuario , ClaveIncorrencta)
				$_SESSION['idUComun']=$fila['idUComun'];
				$_SESSION['Nombre']=$fila['Nombre'];
			}
			else {   //CLAVE INCORRECTA, USUARIO BIEN
				$array= array(false, false, true); //array (EsUsuario , NoUsuario , ClaveIncorrencta)
			}
		}
		else {   //NO ES SUSARIO
			$array= array(false, true, false); //array (EsUsuario , NoUsuario , ClaveIncorrencta)
		}
	return $array;
	}
}
?>

<?php
/*   VIEJO
class user {
	function pido_dato($usu,$cla) {
		include ("conectar.php");
		$query= "SELECT * FROM ucomun WHERE ucomun.Usuario='$usu' and ucomun.Clave='$cla'";
		$res=mysql_query ($query);
		$fila=mysql_fetch_array ($res);
		
		if ($fila['idUComun']<>"") {
			$es_usuario=true;
			$_SESSION['idUComun']=$fila['idUComun'];
			$_SESSION['Nombre']=$fila['Nombre'];
		}
		else {
			$es_usuario=false;
		}
	return $es_usuario;
	}
}
*/
?>