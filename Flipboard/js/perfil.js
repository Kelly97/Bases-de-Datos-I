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
