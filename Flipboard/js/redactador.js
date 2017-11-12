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

 function guardar(){
    $("#btn-guardar_noticia").button("loading");

    var contenido = $("#froala-editor").froalaEditor('html.get');
    var dataForm = new FormData();

    dataForm.append("codigo_usuario", $("#codigoUsuario").val());
    dataForm.append("codigo_revista", $("#codigo_revista").val());
    dataForm.append("categoria_noticia", $("#categoria_noticia").val());
    dataForm.append("autor", $("#autor").val());
    dataForm.append("titulo", $("#titulo").val());
    dataForm.append("descripcion", $("#descripcion").val());
    dataForm.append("contenido", contenido);
    dataForm.append("file", $("#fileSRC").val());
    dataForm.append("fileURL", $("#fileURL").val());

    $.ajax({
        url : "ajax/redactar.php?accion=2",
        data: dataForm,
        type: "POST",
        processData:false,
        contentType:false,
        success: function(resultado){
            if(resultado == 0){
                alert("Ocurrió un error al intentar agregar la noticia, revise los datos e intente nuevamente");
                $("#div-resultado").html('<div class="alert alert-warning"> Ocurrió un error al intentar agregar la noticia, revise los datos e intente nuevamente </div>');
                $("#div-resultado").show();
                setTimeout(ocultarResultado,3000);
            }
            if(resultado == 1){
                alert("La noticia se agregó correctamente");
                $("#div-resultado").html('<div class="alert alert-success"> La noticia se agregó correctamente </div>');
                $("#div-resultado").show();
                setTimeout(ocultarResultado,3000);
            }
        }
    });
    $("#btn-guardar_noticia").button("reset");
 };

 function ocultarResultado(){
    $("#div-resultado").hide();
 }