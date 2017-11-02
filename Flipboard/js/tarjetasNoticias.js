function eliminarInteres(codigoInteres, codigoUsuario){//eliminar interes
	data = "codigo="+3+"&"+
		   "codigoInteres="+codigoInteres+"&"+
		   "usuario="+codigoUsuario;
	$.ajax({         
        url : "ajax/intereses.php",
        data: data,
        method: "POST",
        success: function(datos){       
            //alert(datos);
            $('#alerta_inferior').html('Interés eliminado exitosamente.');
            $('#alerta_inferior').show();
            setTimeout(ocultarAlert,3000);
            cargarNoticias(0);
            actualizarBarraIntereses(0);
        }
    });	
}

function actualizarBarraIntereses(codigoInteres){//Actualizar barra de intereses
	data = "codigo="+4+"&"+
           "codigoInteres="+codigoInteres;
	$.ajax({         
        url : "ajax/intereses.php",
        data: data,
        method: "POST",
        success: function(datos){       
            //alert(datos);
            $("#lista_intereses").html(datos);
            $("#pnProductNav #pnProductNavContents #prueba").trigger('click');
            //$('#pnProductNav #pnProductNavContents #lista_intereses #interesActual').trigger('click');
        }
    });	
}

function darLike(codigoNoticia){//Dar o quitar like de pagina
    //alert(codigoNoticia);
    data = "codigo="+1+"&"+
            "codigoNoticia="+codigoNoticia;
    $.ajax({         
        url : "ajax/reacciones-noticias.php",
        data: data,
        method: "POST",
        success: function(datos){       
            $('#alerta_inferior').html(datos);
            $('#alerta_inferior').show();
            setTimeout(ocultarAlert,3000);            
        }
    }); 
}

function flipear(codigoNoticia){//Flipear Noticia
    //alert(codigoNoticia);
    $("#noticia").html(codigoNoticia);
}

function cargarPaginaRevista(codigoRevista){//Cargar la revista que se elige
    data = "codigoRevista="+codigoRevista;//código de la revista a cargar
    $.ajax({       
        url : "ajax/pagina-revista.php",//direccion que contiene el cuerpo de la revista
        data: data,//envia todo lo que esté dentro de la variable data
        method: "POST",
        beforeSend: function() {
            $('#contenido-principal').html('<div id="loading"><div id="loading-center-absolute"><div class="object" id="object_one"></div><div class="object" id="object_two"></div><div class="object" id="object_three"></div><div class="object" id="object_four"></div></div>');         
            //mientras espera que reaccione la página de las revistas, carga un loading
        },
        success: function(datos){       
            $('#contenido-principal').html(datos);//se carga en el contenedor (div) del centro el contenido de la página que enviamos en la url

            $(function () {
              $('[data-toggle="popover"]').popover();//sirve para habilitar los popover al posicionar el mouse sobre algún elemento
            })
        }        
    }); 
}
