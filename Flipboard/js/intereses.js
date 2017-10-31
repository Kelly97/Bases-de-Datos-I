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
        success: function(datos){       
            //alert(datos);
            obtenerIntereses(codigoUsuario);
            $('#modal-001').modal('hide');
            actualizarBarraIntereses(codigoInteres);
            $('#alerta_inferior').html('Interés agregado exitosamente.');
            $('#alerta_inferior').show();
            setTimeout(ocultarAlert,3000);
            cargarNoticias(codigoInteres);
        }
    });	
}

function ocultarAlert(){
	$('#alerta_inferior').hide();
}