$(document).ready(function() {
	/*$("#btn-perfil").click(function() {
		abrirPerfil();
	});*/
	cargarNoticias(0);//El cero será reservado para las noticias de portada, del 1 en adelante hará referencia a los intereses.
});

function cargarNoticias(codigo){
	data = "codigo="+codigo;
	$.ajax({ 
		//url que recibe para ser visualizada en el div de contenido principal         
        url : "ajax/noticias.php",
        data: data,
        method: "POST",
        beforeSend: function() {
        	$('#contenido-principal').html('Loading');//buscar un loading decente!!!!           
        },
        success: function(datos){       
            $('#contenido-principal').html(datos);
        }
    });	
}