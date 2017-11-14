$("#btn-registro").click(function(){
	$("#btn-registro").button("loading");
	{
		var parametros= "nombre="+$("#nombre").val()+"&"+
						"correo="+$("#correo").val()+"&"+
						"contrasena="+$("#contrasena").val();	
		$.ajax({
			url:"ajax/registrar.php",
			data:parametros,
			method:"POST",
			dataType:"json",
			beforeSend:function(){
				$(".form-inicio").find('input, button, checkbox').attr("disabled",true);
			},
			success:function(respuesta){	
				//$("#div-resultado").html('<div class="alert alert-warning"> '+respuesta+"</div>");
				if (respuesta.codigo_resultado==0){
					$("#div-resultado").html('<div class="alert alert-warning"> '+respuesta.mensaje+"</div>");
				}
				if (respuesta.codigo_resultado==1)
					window.location="index.php";
			},
			complete:function(){
				$(".form-inicio").find('input, button, checkbox').attr("disabled",false);
			},
			error:function(){
			}					
		});
	}
	
	$("#btn-registro").button("reset");
});