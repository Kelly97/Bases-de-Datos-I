$("#btn-registro").click(function(){
	$("#btn-registro").button("loading");
		var parametros= "nombre="+$("#nombre").val()+"&"+
						"correo="+$("#correo").val()+"&"+
						"contrasena="+$("#contrasena").val();		
		alert(parametros);	
		$.ajax({
			url:"ajax/iniciar.php",
			data:parametros,
			method:"POST",
			dataType:"html",
			success:function(respuesta){	
				if (respuesta.codigo_resultado==0){
					$("#div-resultado").html('<div class="alert alert-warning"> '+respuesta.mensaje+"</div>");
				}
				if (respuesta.codigo_resultado==1)
					$("#div-resultado").html('<div class="alert alert-success"> '+respuesta.mensaje+"</div>");
			}						
		});
	$("#btn-registro").button("reset");
});