$(document).ready(function() {
    cargarNoticia();
});

function cargarNoticia(){
    datos = "codigo="+"1"+"&"+
            "codigoNoticia="+$("#codigoNoticia").val();

    $.ajax({
        url : "ajax/acciones-noticias.php",
        data: datos,
        method: "POST",
        success:function(respuesta){
            $("#contenido-principal").html(respuesta);
        }
    });       
}