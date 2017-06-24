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
            $('#contenido-principal').html(datos+ $('#contenido-principal').html());
            $(function () {
			  $('[data-toggle="popover"]').popover();
			})
        }
    });	
}

cargarNoticias(1);