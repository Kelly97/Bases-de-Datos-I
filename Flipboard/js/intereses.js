function obtenerIntereses(codigoUsuario){
	data = 	"codigo="+1+"&"+
			"usuario="+codigoUsuario;
	$.ajax({
		url : "ajax/intereses.php",
		data: data,
		method: "POST",
		success: function(datos){
			$("#div-intereses").html(datos);
		}
	});
}

function agregarInteres(codigoInteres, codigoUsuario){
	data = "codigo="+2+"&"+
		   "codigoInteres="+codigoInteres+"&"+
		   "usuario="+codigoUsuario;
	$.ajax({         
        url : "ajax/intereses.php",
        data: data,
        method: "POST",
        success: function(){       
            alert("Interés agregado exitosamente");
            obtenerIntereses(codigoUsuario);
        }
    });	
}