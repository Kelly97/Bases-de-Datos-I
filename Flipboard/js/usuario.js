$(document).ready(function() {
    cargarUsuario();
});

function cargarUsuario(){
    datos = "codigo_usuario="+$("#codigoUsuario").val();
    $.ajax({
        url : "ajax/accion-usuario.php?accion=1",
        data: datos,
        method: "POST",
        success:function(respuesta){
            $("#contenido-principal").html(respuesta);
        }
    });       
}