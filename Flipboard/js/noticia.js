/*
function ajustarContenedorNoticias(){
    var altoNavbar = $(".iconos-derecha").height() + 40;
    $('#contenido-principal').css("margin-top",altoNavbar+"px");
    var anchoIntereses = $(window).width() - $(".iconos-derecha").width()-170;
    $('.your-class').css("width",anchoIntereses+"px");
}

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

cargarNoticias(1);*/