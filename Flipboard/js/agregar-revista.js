function agregarRevista(codigo_usuario){
	data =  "codigo="+'1'+"&"+
			"codigo_usuario="+codigo_usuario+"&"+
			"nombre_revista="+$("#nombre-revista").val()+"&"+
			"descripcion="+$("#descripcion").val()+"&"+
			"codigo_tipo_revista="+$("#privacidad").val()+"&"+
			"fecha_creacion="+$("#fecha_creacion").val();

	$.ajax({
		url : "ajax/accion-agregar-revista.php",
		data: data,
		method: "POST",
		success: function(datos){
			alert(datos);
            $('#alerta_inferior').html('Revista creada exitosamente.');
            $('#alerta_inferior').show();
            setTimeout(ocultarAlert,3000);
		}
	});
}

function ocultarAlert(){
	$('#alerta_inferior').hide();
}