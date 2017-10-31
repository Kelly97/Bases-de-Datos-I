function eliminarInteres(codigoInteres, codigoUsuario){
	data = "codigo="+3+"&"+
		   "codigoInteres="+codigoInteres+"&"+
		   "usuario="+codigoUsuario;
	$.ajax({         
        url : "ajax/intereses.php",
        data: data,
        method: "POST",
        success: function(datos){       
            //alert(datos);
            $('#alerta_inferior').html('Interés eliminado exitosamente.');
            $('#alerta_inferior').show();
            setTimeout(ocultarAlert,3000);
            cargarNoticias(0);
            actualizarBarraIntereses(0);
        }
    });	
}
function actualizarBarraIntereses(codigoInteres){
	data = "codigo="+4+"&"+
           "codigoInteres="+codigoInteres;
	$.ajax({         
        url : "ajax/intereses.php",
        data: data,
        method: "POST",
        success: function(datos){       
            //alert(datos);
            $("#lista_intereses").html(datos);
            $("#pnProductNav #pnProductNavContents #prueba").trigger('click');
            //$('#pnProductNav #pnProductNavContents #lista_intereses #interesActual').trigger('click');
        }
    });	
}

function darLike(codigoNoticia){
    //alert(codigoNoticia);
    data = "codigo="+1+"&"+
            "codigoNoticia="+codigoNoticia;
    $.ajax({         
        url : "ajax/reacciones-noticias.php",
        data: data,
        method: "POST",
        success: function(datos){       
            $('#alerta_inferior').html(datos);
            $('#alerta_inferior').show();
            setTimeout(ocultarAlert,3000);            
        }
    }); 
}

function flipear(codigoNoticia){
    //alert(codigoNoticia);
    $("#noticia").html(codigoNoticia);
}