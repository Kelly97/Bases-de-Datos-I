var codigo_usuario = 1
$(document).ready(function(){
	codigo_usuario = $("#codigo-usuario").val();
});

function cargarUsuario(codigoUsuario){
    datos = "codigo_usuario="+codigoUsuario;
    $.ajax({
        url : "ajax/accion-usuario.php?accion=1",
        data: datos,
        method: "POST",
        success:function(respuesta){
            $("#contenido-principal").html(respuesta);
        }
    });       
}

function seguirUsuario(codigoUsuario, nombre){
	$('btn-seguir-usuario').val("SIGUIENDO");
	$('btn-seguir-usuario').setAttribute=( "onclick","NOseguirUsuario("+codigoUsuario+", "+nombre+");");
    $('#alerta_inferior').html("Comenzó a seguir a "+nombre);
    $('#alerta_inferior').show();
    setTimeout(ocultarAlert,3000);
	/*datos = "codigo_seguidor="+codigo_usuario + "&" +
			"codigo_usuario="+codigoUsuario;
	$.ajax({
        url : "ajax/accion-usuario.php?accion=2",
        data: datos,
        method: "POST",
        success:function(respuesta){
        	if(respuesta == 0){
        		$('#alerta_inferior').html("Ocurrió un error al intentar seguir a "+nombre);
	            $('#alerta_inferior').show();
	            setTimeout(ocultarAlert,3000);
        	}else if(respuesta == 1){
        		document.getElementById('btn-seguir-usuario').setAttribute=( "value", "SIGUIENDO")
	        	document.getElementById('btn-seguir-usuario').setAttribute=( "onclick","NOseguirUsuario("+codigoUsuario+", "+nombre+");");
	            $('#alerta_inferior').html("Comenzó a seguir a "+nombre);
	            $('#alerta_inferior').show();
	            setTimeout(ocultarAlert,3000);
            }
        }
    });*/
}

function NOseguirUsuario(codigoUsuario, nombre){
	$('btn-seguir-usuario').val("SEGUIR");
	$('btn-seguir-usuario').setAttribute=( "onclick","seguirUsuario("+codigoUsuario+", "+nombre+");");
	$('#alerta_inferior').html("Dejó de seguir a "+nombre);
	$('#alerta_inferior').show();
	setTimeout(ocultarAlert,3000);
	/*datos = "codigo_seguidor="+codigo_usuario + "&" +
			"codigo_usuario="+codigoUsuario;
	$.ajax({
        url : "ajax/accion-usuario.php?accion=3",
        data: datos,
        method: "POST",
        success:function(respuesta){
        	if(respuesta == 0){
        		$('#alerta_inferior').html("Ocurrió un error al dejar de seguir a "+nombre);
	            $('#alerta_inferior').show();
	            setTimeout(ocultarAlert,3000);
        	}else if(respuesta == 1){
        		document.getElementById('btn-seguir-usuario').setAttribute=( "value", "SEGUIR")
	        	document.getElementById('btn-seguir-usuario').setAttribute=( "onclick","seguirUsuario("+codigoUsuario+", "+nombre+");");
	            $('#alerta_inferior').html("Dejó de seguir a "+nombre);
	            $('#alerta_inferior').show();
	            setTimeout(ocultarAlert,3000);
            }
        }
    }); */ 
}

function ocultarAlert(){
	$('#alerta_inferior').hide();
}