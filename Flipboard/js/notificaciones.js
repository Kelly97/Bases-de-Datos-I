function notiSeguimiento(codigoNotificacion){
	data = "codigo="+1+"&"+"codigoNotificacion="+codigoNotificacion;
	$.ajax({         
        url : "ajax/actualizar-notificaciones.php",
        data: data,
        method: "POST",
        dataType: "json",
        success: function(datos){  
            cargarUsuario(datos.codigoUsuarioEmisor);     
        }
    });
}
function notiComentarioYReacciones(codigoNotificacion){
	data = "codigo="+2+"&"+"codigoNotificacion="+codigoNotificacion;
	$.ajax({         
        url : "ajax/actualizar-notificaciones.php",
        data: data,
        method: "POST",
        dataType: "json",
        success: function(datos){       
            cargarContenidoNoticia(datos.codigoNoticia);
        }
    });
}
function notiFlip(codigoNotificacion){
	data = "codigo="+3+"&"+"codigoNotificacion="+codigoNotificacion;
	$.ajax({         
        url : "ajax/actualizar-notificaciones.php",
        data: data,
        method: "POST",
        dataType: "json",
        success: function(datos){       
            cargarPaginaRevista(datos.codigoRevista);
        }
    });
}