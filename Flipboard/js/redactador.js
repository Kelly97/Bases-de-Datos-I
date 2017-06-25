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

 $("#btn-guardar_noticia").click(function(){
    $("#btn-guardar_noticia").button("loading");
        var parametros= "titulo="+$("#titulo").val()+"&"+
                        "categoria_noticia="+$("#categoria_noticia").val()+"&"+
                        "file="+$("#file").val()+"&"+
                        "descripcion="+$("#descripcion").val()+"&"+
                        "autor="+$("#autor").val()+"&"+
                        "editor="+$("#editor1").val();       
        //alert(parametros);  
        $.ajax({
            url:"ajax/redactar.php?accion=2",
            data:parametros,
            method:"POST",
            dataType:"html",
            success:function(respuesta){ 
                //alert(respuesta);   
                if (respuesta.codigo_resultado==0){
                    $("#div-resultado").html('<div class="alert alert-warning"> '+respuesta.mensaje+"</div>");
                }
                if (respuesta.codigo_resultado==1)
                    $("#div-resultado").html('<div class="alert alert-success"> '+respuesta.mensaje+"</div>");
            }                       
        });
    $("#btn-guardar_noticia").button("reset");
});

