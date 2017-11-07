var seleccionado;
function mostrarIcono(parametro) {
	if (parametro==1) {
	 document.getElementById('img-icono-nombre').style.visibility = "";
	  document.getElementById('img-icono-nombre').src = "images/editar.png";
	} else{
	  document.getElementById('img-icono-descripcion').style.visibility = "";
	  document.getElementById('img-icono-descripcion').src = "images/editar.png";
	}
}

function ocultarIcono(parametro) {
	if (parametro==1) 
	  document.getElementById('img-icono-nombre').style.visibility = "hidden";
	else
	  document.getElementById('img-icono-descripcion').style.visibility = "hidden";
}


function cargarDetalles(parametro){

if (seleccionado!=null) 
document.getElementById(seleccionado).style.color = "#C6C6C6";

document.getElementById(parametro).style.color = "#000000";
	$.ajax({
		url:"ajax/acciones-perfil.php?accion="+parametro,
		method: "POST",
		dataType:"html",
		success:function(respuesta){
			$("#div-contenido-principal").html(respuesta);
				
	    }
		
	});
  seleccionado=parametro;
}


function editarNombre(){
document.getElementById("txt-nombre-mod").text=document.getElementById("nombre_usuario").text;
document.getElementById("nombre_usuario").hidden="true";
document.getElementById("txt-nombre-mod").hidden="";
document.getElementById("txt-nombre-mod").autofocus="true"
document.getElementById("txt-nombre-mod").selected="true"

}

function editarDescripcion(){
document.getElementById("txt-descripcion-mod").text=document.getElementById("descripcion").text;
document.getElementById("descripcion").hidden="true";
document.getElementById("txt-descripcion-mod").hidden="";
document.getElementById("txt-descripcion-mod").autofocus="true"
document.getElementById("txt-descripcion-mod").selected="true"

}



function editarConfiguracion(id){
 	$("#"+id).removeClass("texto-no-editable");	 
 	$("#"+id).addClass("texto-editable");
	$("#"+id).select();    
}



function enter(e,id) {
    if (e.keyCode == 13) {
         	$("#"+id).addClass("texto-no-editable");	 
		 	$("#"+id).removeClass("texto-editable");
			$("#"+id).blur();   	 

    }
}


function cambiarContrasena(){
	if ($("#edt-contrasena").text()=="Editar") {
		$("#edt-contrasena").text("Cancelar");
		$("#menu-cambiar-contrasena").show();
		$("#menu-cambiar-correo").hide();
	}else{
		$("#edt-contrasena").text("Editar");
		$("#menu-cambiar-contrasena").hide();
	}

}


function cambiarCorreo(){
	if ($("#edt-correo").text()=="Editar") {
		$("#edt-correo").text("Cancelar");
		$("#menu-cambiar-correo").show();
		$("#menu-cambiar-contrasena").hide();
	}else{
		$("#edt-correo").text("Editar");
		$("#menu-cambiar-correo").hide();
	}
}


function cambiarFoto(){

	$( "#files" ).click();
 
}




function upload_image(){//Funcion encargada de enviar el archivo via AJAX
				$(".upload-msg").text('Cargando...');
				var inputFileImage = document.getElementById("files");
				var file = inputFileImage.files[0];
				var data = new FormData();
				data.append('files',file);
				
				/*jQuery.each($('#fileToUpload')[0].files, function(i, file) {
					data.append('file'+i, file);
				});*/
							
				$.ajax({
					url: "upload.php",        // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(data)   // A function to be called if request succeeds
					{
						$(".upload-msg").html(data);
						window.setTimeout(function() {
						$(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
						$(this).remove();
						});	}, 1000);
					}
				});
				
			}
