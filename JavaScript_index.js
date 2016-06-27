function obtenerDep(){
	ProvElegida = $("#provincias").val();
	$.ajax({
		url: "ObtenerDepartamento.php",
		type: "post",
		data: "id="+ProvElegida,
		success: function(resultado){
			$("#departamentos").html(resultado);
		}
	});
}

function obtenerLoc(){
	DepElegida = $("#departamentos").val();
	$.ajax({
		url: "ObtenerLocalidad.php",
		type: "post",
		data: "id="+DepElegida,
		success: function(resultado){
			$("#localidades").html(resultado);
		}
	});
}