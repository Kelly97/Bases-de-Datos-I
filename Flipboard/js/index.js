$(document).ready(function() {
	/*$("#btn-perfil").click(function() {
		abrirPerfil();
	});*/
	cargarNoticias(0);//El cero será reservado para las noticias de portada, del 1 en adelante hará referencia a los intereses.
	ajustarContenedorNoticias();
	$('.your-class').slick({
	      dots: false,
		  infinite: false,
		  speed: 300,
		  slidesToShow: 12,
		  slidesToScroll: 11,
		  responsive: [
		    {
		      breakpoint: 1024,
		      settings: {
		        slidesToShow: 7,
		        slidesToScroll: 6
		      }
		    },
		    {
		      breakpoint: 1000,
		      settings: {
		        slidesToShow: 5,
		        slidesToScroll: 5
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }
		    // You can unslick at a given breakpoint now by adding:
		    // settings: "unslick"
		    // instead of a settings object
		  ]
	  });
});

function ajustarContenedorNoticias(){
	var altoNavbar = $("#navbar-sup").height() + 40;
	$('#contenido-principal').css("margin-top",altoNavbar+"px");
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
            $('#contenido-principal').html(datos);
            $(function () {
			  $('[data-toggle="popover"]').popover()
			})
        }
    });	
}