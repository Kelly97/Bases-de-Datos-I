function notiSeguimiento(codigoNotificacion){
	data = "codigo="+1+"&"+"codigoNotificacion="+codigoNotificacion;
	$.ajax({         
        url : "ajax/actualizar-notificaciones.php",
        data: data,
        method: "POST",
        dataType: "json",
        success: function(datos){  
            actualizarNotificaciones();
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
            actualizarNotificaciones();     
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
            actualizarNotificaciones();   
            cargarPaginaRevista(datos.codigoRevista);
        }
    });
}