
function restablecerPortada(valor) {
	if (valor=="1"){
		$("#btn-cambiar-portada").show();
		 
	}else{
		$("#btn-cambiar-portada").hide();
	
	}
}


function seleccionado(idf){

		for (var i = 1; i < 5; i++) {
			 $("#item-menu-"+i).addClass("elemento-menu");
			 $("#item-menu-"+i).removeClass("seleccionado");
		}

			$("#"+idf).addClass("seleccionado");
}


function cargarDetalles(idRevista, codigo){
	
   $.ajax({
		url:"ajax/acciones-editor-perfil.php?accion="+codigo+"&"+"idRevista="+idRevista,
		method: "POST",
		dataType:"html",
		success:function(respuesta){
			$("#contenido-principal").html(respuesta);
				
	    }
		
	});
}


function selecionarTexto(){
	$("#url").select();
}

function editarConfiguracion(id){
 	$("#"+id).removeClass("texto-no-editable");	 
 	$("#"+id).addClass("texto-editable");
	$("#"+id).select();    
}


function opcion(){
	if(document.getElementById("chk").checked){
        $("#estado-toggle").text("Cualquier persona puede ver y seguir esta revista");
	}else{
		$("#estado-toggle").text("Solo tú y las personas que tú invites a colaborar podrán ver y seguir esta revista");
	}
}