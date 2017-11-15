function cargarNoticia(codigoNoticia){
    datos = "codigo="+"1"+"&"+
            "codigoNoticia="+codigoNoticia;

    $.ajax({
        url : "ajax/acciones-noticias.php",
        data: datos,
        method: "POST",
        success:function(respuesta){
            $("#contenido-principal").html(respuesta);
        }
    });       
}