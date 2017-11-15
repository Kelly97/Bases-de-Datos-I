function cargarUsuario(codigoUsuario){
    datos = "codigo_usuario="+codigoUsuario;
    $.ajax({
        url : "ajax/accion-usuario.php?accion=1",
        data: datos,
        method: "POST",
        success:function(respuesta){
            $("#contenido-principal").html(respuesta);
        }
    });       
}