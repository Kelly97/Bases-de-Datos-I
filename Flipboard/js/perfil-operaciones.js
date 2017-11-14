
function eliminarInteres(codigoInteres, codigoUsuario){
     //alert("ajax/acciones-perfil.php?accion=6&CODIGO_CATEGORIA="+codigoInteres+"&CODIGO_USUARIO="+codigoUsuario);

     $.ajax({
		url:"ajax/acciones-perfil.php?accion=6&CODIGO_CATEGORIA="+codigoInteres+"&CODIGO_USUARIO="+codigoUsuario,
		method: "GET",
		dataType:"html",
		success:function(respuesta){
			$("#int-"+codigoInteres).hide();
				
	    }
	});
}











