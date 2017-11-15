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
	datos = "codigo_seguidor="+codigo_usuario + "&" +
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
	        	$('#btn-seguir-usuario').val('Siguiendo');
	            $('#alerta_inferior').html("Comenzó a seguir a "+nombre);
	            $('#alerta_inferior').show();
	            setTimeout(ocultarAlert,3000);
            }
        }
    });  
}

function ocultarAlert(){
	$('#alerta_inferior').hide();
}