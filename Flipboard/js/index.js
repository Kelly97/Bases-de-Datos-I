$(document).ready(function() {
	cargarNoticias(0);//El cero será reservado para las noticias de portada, del 1 en adelante hará referencia a los intereses.
	ajustarContenedorNoticias();
	actualizarNotificaciones();
	setInterval('actualizarNotificaciones()',10000);	
	$("#contenido-principal").css("margin-top",($("#nav_flipboard").height()+20)+"px");	
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

	$('#btn-notificaciones').click(function(){
		WebuiPopovers.updateContentAsync('#btn-notificaciones','ajax/notificaciones.php');	
	});	

	$('#txt-buscar').change(function(){
		buscar();
		WebuiPopovers.hideAll();		
	});
	
	$('#md-flipear').on('show.bs.modal', function (e) {
	  cargarRevistas();
	  $("#btn_aniadir_flip").attr("disabled", true);
	});
	$('#md-aniadir-colaborador').on('show.bs.modal', function (e) {
	  cargarColaboradores();
	  $("#btn_aniadir_colaborador").attr("disabled", true);
	});

	$('#modal-003').on('hide.bs.modal', function (e) {
		if($("#codVerificacion").html()=="1"){
			setTimeout(function(){
				$('#md-flipear').modal('show');
			},1000);
		}
	  $("#codVerificacion").html("");//Reiniciando el modal.
	});

	$("#btn_aniadir_flip").click(function () {	 
		//alert($('input:radio[name=opt_revistas]:checked').val());//Alerta que contiene el codigo de revista
		codRevista = $('input:radio[name=opt_revistas]:checked').val();
		codNoticia = $("#noticia").html();
		//alert(codNoticia+" "+codRevista);
		data = "codigo="+2+"&"+
		   "codRevista="+codRevista+"&"+
		   "codNoticia="+codNoticia;
		$.ajax({         
	        url : "ajax/reacciones-noticias.php",
	        data: data,
	        method: "POST",
	        success: function(datos){  
	        	$('#md-flipear').modal('hide');    
	            $('#alerta_inferior').html(datos);
	            $('#alerta_inferior').show();
	            setTimeout(ocultarAlert,3000);
	        }
	    });	
	});

	$("#btn_aniadir_colaborador").click(function () {	 
		//alert($('input:radio[name=opt_revistas]:checked').val());//Alerta que contiene el codigo de revista
		codColaborador = $('input:radio[name=opt_colaboradores]:checked').val();
		codRevista = $("#codRevista").html();
		//alert(codColaborador+" "+codRevista);
		data = "codigo="+1+"&"+
		   "codColaborador="+codColaborador+"&"+
		   "codRevista="+codRevista;
		$.ajax({         
	        url : "ajax/aniadir-colaborador.php",
	        data: data,
	        method: "POST",
	        success: function(datos){  
	        	$('#md-aniadir-colaborador').modal('hide');    
	            $('#alerta_inferior').html(datos);
	            $('#alerta_inferior').show();
	            setTimeout(ocultarAlert,3000);
	            cargarPaginaRevista(codRevista);
	        }
	    });	
	});

	$("#btn-perfil").click(function () {	 
		perfilUsuario();
	});

	$("#btn-usuarios").click(function () {	 
		Usuarios();
	});


	$("#btn-categorias").click(function () {	 
		Categorias();
	});

 
	
});

$(document).scroll(function(e){
	WebuiPopovers.hideAll();
	e.stopPropagation();
});

$(window).resize(function(){
	ajustarContenedorNoticias();	
});




function buscar(){
	var buscar = $('#txt-buscar').val();
	data = "buscar="+buscar;
	$.ajax({       
        url : "ajax/respuesta-busqueda.php",
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
        }        
    });	
}

function ajustarContenedorNoticias(){
	var anchoNavbar= $("#iconos_derecha").width()+$('.navbar-brand').width()+$('.navbar-toggler').width()+60;
	var altoNavbar = $("#iconos_derecha").height();
	$('#contenido-principal').css("height",$(window).height()-altoNavbar);
	$('#pnProductNav').css("width",($(window).width()-anchoNavbar) +"px");
}

var codigoCat = 0;
function cargarNoticias(codigoCategoria){
	codigoCat=codigoCategoria;
	data = "codigo="+2+"&"+
           "codigoCategoria="+codigoCategoria;
	$.ajax({       
        url : "ajax/acciones-noticias.php",
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
			$(document).scrollTop(0);
			cargarTarjetasPortada(codigoCategoria);			

        }        
    });	 
}

$(window).resize(function(){
	isotopeNotiCard();
});

$(document).scroll(function(){
	//Evento al llegar al final del documento
	if(($(window).scrollTop() + $(window).height()) === $(document).height()) {
		if($(".waypointCargaNoticias").css("display")=="block"){
			cargarTarjetasPortada(codigoCat);
			//alert(codigoCat);
		}		
	 }
});




var inicializarIsotope = false;
var categoriaSeleccionada=0;
var scrollVertical = 0;
function cargarTarjetasPortada(codigoCategoria){
	if(!(categoriaSeleccionada==codigoCategoria)){
		inicializarIsotope = false;
		categoriaSeleccionada=codigoCategoria;
	}
    data = "codigoCategoria="+codigoCategoria+"&"+
           "codigo="+0;
    $.ajax({       
        url : "ajax/noticias.php",
        data: data,
        method: "POST",
        success: function(datos){       
            
            if(!inicializarIsotope){
            	$('#grid_Noticias').append(datos);
            	isotopeNotiCard();
            	inicializarIsotope = true;
            }else{
            	scrollVertical = $(document).scrollTop();
            	$('#grid_Noticias').isotope("destroy");
            	$('#grid_Noticias').append(datos);
            	isotopeNotiCard();
            	$(document).scrollTop(scrollVertical);
            }     

        }        
    }); 
}

function cargarContenidoNoticia(codigo){
	data = "codigoNoticia="+codigo+"&"+
		   "codigo="+1;
	$.ajax({       
        url : "ajax/acciones-noticias.php",
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
        }        
    });	
}

function perfilUsuario(){	
	$.ajax({       
        url : "perfil.php",
        method: "POST",
        beforeSend: function() {
        	$('#contenido-principal').html('<div id="loading"><div id="loading-center-absolute"><div class="object" id="object_one"></div><div class="object" id="object_two"></div><div class="object" id="object_three"></div><div class="object" id="object_four"></div></div>');         
        },
        success: function(datos){       
            $('#contenido-principal').html(datos);
            $(function () {
			  $('[data-toggle="popover"]').popover();
			})
        }        
    });	
}


function isotopeNotiCard(){
	var $grid = $('.grid').isotope({
	  itemSelector: '.noti-card',
	  percentPosition: true,
	  layoutMode: 'packery',			  
	  packery: {
	    columnWidth: '.notisizer',
	    gutter: 15
	  }
	});
	// layout Isotope after each image loads
	$grid.imagesLoaded().progress( function() {
	  $grid.isotope();
	});	
	var anchoGrid = $('.grid').width();
	var anchoNoticia = 0;
	var anchoNoticia2 = 0;
	var anchoNoticia3 = 0;
	if(anchoGrid < 576){
		anchoNoticia = 99;
		anchoNoticia2 = 99;
		anchoNoticia3 = 99;
	} else if(anchoGrid < 768){
		anchoNoticia = 99;
		anchoNoticia2 = 99;
		anchoNoticia3 = 99;
	} else if(anchoGrid < 992){
		anchoNoticia = 49;
		anchoNoticia2 = 49;
		anchoNoticia3 = 99;
	} else if(anchoGrid < 1200 || anchoGrid > 1200){
		anchoNoticia = 32;
		anchoNoticia2 = 65.6;
		anchoNoticia3 = 99;
	}
	$('.notisizer').css("width", anchoNoticia + "%" );
	$('.noti-card').css("width", anchoNoticia + "%" );
	$('.noti-card-width-2').css("width", anchoNoticia2 + "%" );
	$('.noti-card-width-3').css("width", anchoNoticia3 + "%" );
	  $grid.isotope({
	    // update columnWidth to a percentage of container width
	    packery: { 
	    	columnWidth:  '.notisizer' ,
	    	gutter: 15
	    }
	  });
}

var cont = 0;//variable para manejar la reproduccion de sonido de notificacion
function actualizarNotificaciones(){
	
	$.ajax({       
        url : "ajax/campana-notificaciones.php",
        method: "POST",
        success: function(datos){   
        	var cantNoti=datos;
        	if(cont!=cantNoti && cont<cantNoti){
        		document.getElementById('player').play();
				cont = cantNoti;  
        	}
        	  
            $('#cantidad_notificaciones').html(datos); 
            if(datos == 0){
            	$('#cantidad_notificaciones').css('background-color','gray');
            }else{
            	$('#cantidad_notificaciones').css('background-color','red');
            }         
        }        
    });	
}

function cargarRevistas(){
	$.ajax({       
        url : "ajax/tarjetas_revistas.php",
        method: "POST",
        beforeSend: function() {
        	$('#md-body-flipear').html('<div style="text-align:center;"><span class="loading-sencillo">Cargando</span><span class="l-1"></span><span class="l-2"></span><span class="l-3"></span><span class="l-4"></span><span class="l-5"></span><span class="l-6"></span></div>');         
        },
        success: function(datos){       
            $('#md-body-flipear').html(datos);
        }
    });	
}
function cargarColaboradores(){
	data="codigoRevista="+$("#codRevista").html();
	$.ajax({       
        url : "ajax/cargar-colaboradores.php",
        data: data,
        method: "POST",
        beforeSend: function() {
        	$('#md-body-colaboradores').html('<div style="text-align:center;"><span class="loading-sencillo">Cargando</span><span class="l-1"></span><span class="l-2"></span><span class="l-3"></span><span class="l-4"></span><span class="l-5"></span><span class="l-6"></span></div>');         
        },
        success: function(datos){       
            $('#md-body-colaboradores').html(datos);
        }
    });	
}

function habilitarBotonAniadirFlip(){
	$("#btn_aniadir_flip").attr("disabled", false);
}

function habilitarBotonAniadirColaborador(){
	$("#btn_aniadir_colaborador").attr("disabled", false);
}

function agregarNuevaRevista(){
	$('#md-flipear').modal('hide');	
	setTimeout(function(){
		$('#modal-003').modal('show');
		$("#codVerificacion").html("1");//Indicando que se abre el modal despues del flip
	},500);
	
}

//***************************************************************************************************************************************
function Usuarios(){	
	$.ajax({       
        url : "ajax/usuarios.php?accion=1",
        method: "POST",
        beforeSend: function() {
        	$('#contenido-principal').html('<div id="loading"><div id="loading-center-absolute"><div class="object" id="object_one"></div><div class="object" id="object_two"></div><div class="object" id="object_three"></div><div class="object" id="object_four"></div></div>');         
        },
        success: function(datos){       
            $('#contenido-principal').html(datos);
            $(function () {
			  $('[data-toggle="popover"]').popover();
			})
        }        
    });	
}

function mostrarUsuario(codigoEstado){
	if (seleccionado!=null) 
	document.getElementById(seleccionado).style.color = "#C6C6C6";

	document.getElementById(codigoEstado).style.color = "#000000";	
	parametro = "parametro="+codigoEstado;
	$.ajax({       
        url : "ajax/usuarios.php?accion=2",
        data : parametro,
        method: "POST",
        success: function(datos){       
            $('#div-contenidoPrincipal').html(datos);
        }        
    });	
    seleccionado=codigoEstado;
}


function cambiarTipo_usuario(codigoUsuario, codTipo_usuario){
	data="codigoUsuario="+codigoUsuario+"&"+
		 "codigoTipo_Usuario="+codTipo_usuario;
	$.ajax({
	    url: "ajax/usuarios.php?accion=3",
	    data: data,
	    method: "POST",
	    success: function (respuesta) {
	      	Usuarios();
	    }
	}); 

}

function eliminarUsuario(codigoUsuario,nombreUsuario){
        data="codigoUsuario="+codigoUsuario;
		$.ajax({
	        url: "ajax/usuarios.php?accion=4",
	        data: data,
	        method: "POST",
	        success: function (respuesta) {
	          Usuarios();
	        }
	    }); 
	        	
}

function agregarUsuario(codigoUsuario, codigoTipo_Usuario){
	data="codigoUsuario="+codigoUsuario+"&"+
		 "codigoTipo_Usuario="+codigoTipo_Usuario;
	$.ajax({
	    url: "ajax/usuarios.php?accion=5",
	    data: data,
	    method: "POST",
	    success: function (respuesta) {
	      	Usuarios();
	    }
	}); 

}

//********************************************************************************************************************************
function Categorias(){	
	$.ajax({       
        url : "ajax/categorias.php?accion=1",
        method: "POST",
        success: function(datos){       
            $('#contenido-principal').html(datos);
            $(function () {
			  $('[data-toggle="popover"]').popover();
			})
        }        
    });	
}

function eliminarCategoria(codigoCategoria){
	data="codigoCategoria="+codigoCategoria;
	$.ajax({
	    url: "ajax/categorias.php?accion=2",
	    data: data,
	    method: "POST",
	    success: function (respuesta) {
	    	alert(respuesta);
	      	Categorias();
	    }
	}); 

}


function agregarCategoria(){
	parametro ="categoria="+$("#nombre_categoria").val();
	$.ajax({
	    url: "ajax/categorias.php?accion=3",
	    data: parametro,
	    method: "POST",
	    dataType: "json",
	    success: function (respuesta) {
	    	if (respuesta.codigo_resultado==0){
				$("#div_respuesta").html('<div class="alert alert-warning" style="text-align:center;"> '+respuesta.mensaje+"</div>");
			}
			if (respuesta.codigo_resultado==1){	
	        	$('#modal-agregar_categoria').modal('hide'); 
	        	Categorias();
	      	}
	    },
		error:function(){
			alert("Ups, no se pudo cargar el contenido.");
		}
	}); 

}

/*
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
++++++++++++++++++++++++++++++++++++++++  Agregar comentario  ++++++++++++++++++++++++++++++++++++++++
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
*/

function agregarComentario(codigoNoticia, codigoUsuario){
	data = "codigo_noticia="+codigoNoticia+"&"+
			"codigoUsuario="+codigoUsuario+"&"+
			"contenido="+$("#txt_comentario").val();
			;
	$.ajax({       
        url : "ajax/agregar_comentario.php?accion=4",
        data: data,
        method: "POST",
        dataType: "json",
        success:function(resultado){
			if (resultado.codigo_resultado==1){
				$("#txt_comentario").val("");
				cargarComentarios(codigoNoticia);
			}else
				alert(resultado.mensaje);

			$(function () {
			  $('[data-toggle="popover"]').popover();
			})
		},
		error:function(){
			alert("Ups, no se pudo cargar el contenido.");
		}       
    });	
}


function cargarComentarios(codigo){
codigo_noticia = "codigo_noticia="+codigo;
	$.ajax({
		url:"ajax/agregar_comentario.php?accion=3",
		data: codigo_noticia,
		method: "POST",
		success:function(resultado){
			$("#respuestaComentario").html(resultado);
			$(function () {
			  $('[data-toggle="popover"]').popover();
			})
		},
		error:function(){
			alert("Ups, no se pudo cargar el contenido.");
		}
	});
}


function cargarLikes(codigo){
	codigo_noticia = "codigo_noticia="+codigo;
	$.ajax({
		url:"ajax/agregar_comentario.php?accion=2",
		data: codigo_noticia,
		method: "POST",
		success:function(resultado){
			$("#div-usuariosLikes").html(resultado);
		},
		error:function(){
			alert("Ups, no se pudo cargar el contenido.");
		}
	});
}

function cargar_modalComentarios(codigo){
	codigo_noticia = "codigo_noticia="+codigo;
	$.ajax({
		url:"ajax/agregar_comentario.php?accion=1",
		data: codigo_noticia,
		method: "POST",
		success:function(resultado){
			$("#div-modalComentario").html(resultado);

			cargarLikes(codigo);
			cargarComentarios(codigo);
			$(function () {
			  $('[data-toggle="popover"]').popover();
			})
		},
		error:function(){
			alert("Ups, no se pudo cargar el contenido.");
		}
	});
}

function eliminarComentario(codigoNoticia, codigoComentario){
	data = "codigo_noticia="+codigoNoticia+"&"+
			"codigoComentario="+codigoComentario;
			;
	$.ajax({       
        url : "ajax/agregar_comentario.php?accion=5",
        data: data,
        method: "POST",
        dataType: "json",
        success:function(resultado){
			if (resultado.codigo_resultado==1){
				cargarComentarios(codigoNoticia);
			}else
				alert(resultado.mensaje);
			$(function () {
			  $('[data-toggle="popover"]').popover();
			})
		},
		error:function(){
			alert("Ups, no se pudo cargar el contenido.");
		}       
    });	
}


/*
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
*/
function seguimientoRevista(codigoRevista, tipoOperacion) {
	data = "codigoRevista="+codigoRevista+"&tipoOperacion="+tipoOperacion;
			;
	$.ajax({       
        url : "ajax/accion-seguimiento-revista.php",
        data: data,
        method: "POST",
        success:function(datos){
			cargarPaginaRevista(codigoRevista);
			$('#alerta_inferior').html(datos);
            $('#alerta_inferior').show();
            setTimeout(ocultarAlert,3000);
		},      
    });
}


