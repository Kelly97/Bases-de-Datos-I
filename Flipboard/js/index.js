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
		  slidesToShow: 8,
		  slidesToScroll: 7,
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
		      breakpoint: 900,
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 3
		      }
		    }
		    // You can unslick at a given breakpoint now by adding:
		    // settings: "unslick"
		    // instead of a settings object
		  ]
	  });
	$('[data-toggle="popover"]').popover();
	$('#btn-buscar').webuiPopover({
		url:'#btn-buscar-content',
		animation:'pop'
	});
	$('#btn-buscar').click(function(){
		if($('#txt-buscar').css("display")=="block"){
			$('#txt-buscar').focus();
		}
	});
	$('#btn-notificaciones').webuiPopover({
	   type:'async',
	   url:'ajax/notificaciones.php',
	   animation:'pop',
	   height:300
	});


});
$(document).scroll(function(){
	//WebuiPopovers.hideAll();
});
$(window).resize(function(){
	ajustarContenedorNoticias();
});

function ajustarContenedorNoticias(){
	var altoNavbar = $(".iconos-derecha").height() + 40;
	$('#contenido-principal').css("margin-top",altoNavbar+"px");
	$('#contenido-principal').css("height",$(window).height()-altoNavbar);
	var anchoIntereses = $(window).width() - $(".iconos-derecha").width() - $("#myimage").width() - 100;
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
        	$('#contenido-principal').html('<div id="loading"><div id="loading-center-absolute"><div class="object" id="object_one"></div><div class="object" id="object_two"></div><div class="object" id="object_three"></div><div class="object" id="object_four"></div></div>');         
        },
        success: function(datos){       
            $('#contenido-principal').html(datos);
            $(function () {
			  $('[data-toggle="popover"]').popover();
			})
			
			var $grid = $('.grid').imagesLoaded( function() {
			  // init Isotope after all images have loaded
			  $grid.isotope({
			      itemSelector: '.noti-card',
				  percentPosition: true,
				  masonry: {
				    columnWidth: '.noti-card'
				  }
			  });
			});
        }
    });	
}

function perfilUsuario(){
	$('#contenido-principal').load('ajax/perfil.html', function(data) {
			$(this).html(data);
		});
}



