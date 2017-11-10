function agregarRevista(codigo_usuario){
	data =  "codigo="+'1'+"&"+
			"codigo_usuario="+codigo_usuario+"&"+
			"nombre_revista="+$("#nombre-revista").val()+"&"+
			"descripcion="+$("#descripcion").val()+"&"+
			"codigo_tipo_revista="+$("#privacidad").val();

	$.ajax({
		url : "ajax/accion-agregar-revista.php",
		data: data,
		method: "POST",
		success: function(datos){
            $('#alerta_inferior').html(datos);
            $('#alerta_inferior').show();
            setTimeout(ocultarAlert,3000);
		}
	});
}

function ocultarAlert(){
	$('#alerta_inferior').hide();
}