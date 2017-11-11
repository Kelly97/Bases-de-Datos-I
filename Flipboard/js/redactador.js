 $(function(){
        $("input[name='file']").on("change", function(){
            var formData = new FormData($("#formulario")[0]);
            var ruta = "ajax/redactar.php?accion=1";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    $("#respuesta").html(datos);
                }
            });
        });
     });

 $(function(){
        $("#aceptarURL").click(function(){
            $("#respuesta").html('<img src="'+$("#fileURL").val()+'">')
        });
     });

/*$(function() {
    $('#froala-editor').froalaEditor({
        // Set the save param.
        saveParam: 'content',

        // Set the save URL.
        saveURL: '../ajax/redactar.php?accion=2',
 
        // HTTP request type.
        saveMethod: 'POST',
 
        // Additional save params.
        saveParams: {codigo_usuario: $("#codigoUsuario").val(),
                     codigo_revista: $("#codigo_revista").val(),
                     categoria_noticia: $("#categoria_noticia").val(),
                     autor: $("#autor").val(),
                     titulo: $("#titulo").val(),
                     descripcion: $("#descripcion").val(),
                     file: $("#file").val(),
                     fileURL: $("#fileURL").val()}
    }).on('froalaEditor.save.after', function (e, editor, response) {
        if(response == 0){
            $("#div-resultado").html('<div class="alert alert-warning"> Ocurrió un error al intentar agregar la noticia, revise los datos e intente nuevamente </div>');
        }
        if(response == 1)
            $("#div-resultado").html('<div class="alert alert-success"> La noticia se agregó correctamente </div>');
    })
}); */

 function guardar(){
    alert("Se ha presionado el boton");
    $("#btn-guardar_noticia").button("loading");

    $("#froala-editor").froalaEditor({
        // Set the save param.
        saveParam: 'content',

        // Set the save URL.
        saveURL: 'ajax/redactar.php?accion=2',
 
        // HTTP request type.
        saveMethod: 'POST',
 
        // Additional save params.
        saveParams: {codigo_usuario: $("#codigoUsuario").val(),
                     codigo_revista: $("#codigo_revista").val(),
                     categoria_noticia: $("#categoria_noticia").val(),
                     autor: $("#autor").val(),
                     titulo: $("#titulo").val(),
                     descripcion: $("#descripcion").val(),
                     file: $("#file").val(),
                     fileURL: $("#fileURL").val()}
    }).on('froalaEditor.save.after', function (e, editor) {
        alert(":D");
    }).on('froalaEditor.save.after', function (e, editor, response) {
        if(response == 0){
            $("#div-resultado").html('<div class="alert alert-warning"> Ocurrió un error al intentar agregar la noticia, revise los datos e intente nuevamente </div>');
        }
        if(response == 1)
            $("#div-resultado").html('<div class="alert alert-success"> La noticia se agregó correctamente </div>');
    })
    $("#btn-guardar_noticia").button("reset");
 };