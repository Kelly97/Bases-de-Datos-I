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
$("#txt-contrasenia-actual").val("");
$("#txt-nueva-contrasenia").val("");
$("#txt-confirmar-contrasenia").val("");


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







function cambiarDatos(event){
	var parametros;
	var x = event.which || event.keyCode;
		if ((x==13)&&($('#nombre-principal').val().length >= 1)){

		$.ajax({
			url:"ajax/acciones-perfil.php?accion=7&"+"TIPO=1&"+"NOMBRE="+document.getElementById("nombre-principal").value,
			dataType:"html",
			method: "GET",
			success:function(data){
				{
						$(".upload-msg").html(data);
						window.setTimeout(function() {
						$(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
						$(this).remove();
						});	}, 2000);
					}	
		    }
		});

		$.ajax({
			url:"ajax/acciones-perfil.php?accion=7&"+"TIPO=2&"+"DESCRIPCION="+document.getElementById("descripcion").value,
			dataType:"html",
			method: "GET",
			success:function(data){
				{
						$(".upload-msg").html(data);
						window.setTimeout(function() {
						$(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
						$(this).remove();
						});	}, 2000);
					}	
		    }
		});

		
	
   } 
   if ((x==13)&&(document.getElementById("nombre-principal").value)=="") {
   	var data= "<div class='alert alert-danger alert-dismissible' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Escriba su nombre</strong> </div>";
   		$(".upload-msg").html(data);
		window.setTimeout(function() {
		$(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
		$(this).remove();
		});	}, 3000);
   }

}




function nuevoNombreConf(event){
	var x = event.which || event.keyCode;
		if ((x==13)&&($('#nombre-usuario-conf').val().length >= 1)){

		$.ajax({
			url:"ajax/acciones-perfil.php?accion=7&"+"TIPO=1&"+"NOMBRE="+document.getElementById("nombre-usuario-conf").value,
			dataType:"html",
			method: "GET",
			success:function(data){
				
						$(".upload-msg").html(data);
						window.setTimeout(function() {
						$(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
						$(this).remove();
						});	}, 2000);
					$("#conf-mensajes").html("<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Nombre Actualizado</strong></div>");

		    }
		});
	}

}



function nuevoCorreo(){

	 if(($("#txt-email").val()!="")&&($("#txt-password").val()!="")&&(validarCorreo($("#txt-email").val())==1)){
	 		
	 		$.ajax({
			url:"ajax/acciones-perfil.php?accion=8&NUEVO_CORREO="+$("#txt-email").val()+"&CONTRASENIA="+$("#txt-password").val(),
			dataType:"html",
			method: "GET",
			success:function(data){
				if (data==1){
				  $("#conf-mensajes").html("<div class='alert alert-success' role='alert'><button type='button'  data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Datos Actualizados</strong></div>");
				  $("#correo").val($("#txt-email").val());
				  cambiarCorreo();

				}
				else
				  $("#conf-mensajes").html("<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>La contraseña no coincide</strong></div>");

		    }
		});



	 } else if(($("#txt-password").val()=="")||($("#txt-email").val()==""))
	  	 	$("#conf-mensajes").html("<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Debe llenar todos los campos</strong></div>");

	 else
	 	$("#conf-mensajes").html("<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Formato del correo incorrecto</strong></div>");

}


function validarCorreo(correo){
	var arroba=0;
	var punto=0;
	var resultado=0;
	var otros=0;

   for (var i = 0 ; i < correo.length; i++) {
   	 if(correo.charAt(i)=="@")
   	 	arroba=1;
   	 if(correo.charAt(i)==".")
   	 	punto=1;
   	 if(correo.charAt(i)==",")
   	 	otros=1;
   }
   if((arroba==1)&&(punto==1)&&(otros==0))
   	 	resultado=1;
   return resultado;
}



function nuevaContrasenia(){
var contraseniaActual=$("#txt-contrasenia-actual").val();
var contraseniaNueva=$("#txt-nueva-contrasenia").val();
var confirmarContrasenia=$("#txt-confirmar-contrasenia").val();
var datos= "ajax/acciones-perfil.php?accion=9&CONTRASENIA_ACTUAL="+contraseniaActual+"&CONTRASENIA="+$("#txt-nueva-contrasenia").val();
	if(contraseniaNueva!=confirmarContrasenia)
	    $("#conf-mensajes").html("<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Las nuevas contraseñas no coinciden</strong></div>");
	else if((contraseniaActual=="")||(contraseniaNueva="")||(confirmarContrasenia==""))
        $("#conf-mensajes").html("<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Debe llenar todos los espacios</strong></div>");
    else {
    	$.ajax({
			url: datos,
			dataType:"html",
			method: "GET",
			success:function(data){
				
				if (data==1){
				  $("#conf-mensajes").html("<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Datos Actualizados</strong></div>");
				  cambiarContrasena();

				}
				else
				  $("#conf-mensajes").html("<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>La contraseña actual no coincide</strong></div>");

		    }
		});

    }


}




function llenarConfi(){
	
}