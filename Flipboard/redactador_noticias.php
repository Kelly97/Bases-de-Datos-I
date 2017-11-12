<?php
    //Buscar los scripts para la base en la carpeta con el mismo nombre
    include_once("class/class-conexion.php");
    $conexion = new Conexion();
    $codigoUsuario = 1;//SESION
    $sql = "SELECT  CODIGO_TIPO_USUARIO,
                    CODIGO_ESTADO_USUARIO,
                    substr(NOMBRE_USUARIO,1,1) AS INICIAL,
                    NOMBRE_USUARIO,
                    ALIAS_USUARIO,
                    URL_FOTO_PERFIL,
                    A.DESCRIPCION,
                    B.CODIGO_REVISTA,
                    B.NOMBRE_REVISTA
            FROM TBL_USUARIOS A
            LEFT JOIN TBL_REVISTAS B
              ON A.CODIGO_USUARIO = B.CODIGO_USUARIO
            WHERE A.CODIGO_USUARIO =".$codigoUsuario;

    $resultadoUsuario = $conexion->ejecutarInstruccion($sql);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flipboard</title>
    <link rel="icon" href="images/favicon.jpg">
    <link href="css/bootstrap.min.css" rel="stylesheet">  
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <!-- EDITOR DE TEXTO 
    <script src="//cdn.ckeditor.com/4.7.0/standard/ckeditor.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    FIN EDITOR TEXTO -->

    <!-- SUBIR IMAGEN 
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    FIN SUBIR IMAGEN -->


    <!-- EDITOR DE TEXTO --> 
    <link href="css/froala_editor.pkgd.css" rel="stylesheet" type="text/css">
    <link href="css/froala_style.min.css" rel="stylesheet" type="text/css">
    <!-- FIN EDITOR DE TEXTO --> 
    
  </head>
  
  <body>    
    <div>
	    <nav id="navbar" class="navbar navbar-default navbar-fixed-top">
	      <div id="navbar-sup" class="container-fluid" style="padding-left: 0px;">
	        <!-- Brand and toggle get grouped for better mobile display -->
	        <div class="navbar-header">
	        	<img id="myimage" src="images/logo.png" style="max-height: 55px;">
	          
	        </div>
	         
	        </div><!-- /.navbar-collapse -->      
	      </div><!-- /.container-fluid -->
	    </nav>
	</div>      
	<!-- FIN NAV -->
	<br><br><br>
    
    <div class="container" style="width: 700px; ">
    	<div class="row">
            <div class="col-lg-12">
                <?php echo '<input type="radio" id="codigoUsuario" value="'. $codigoUsuario .'" style="display: none">'?>
        		<label><strong><h4>Título Noticia:</h4></strong></label>
        		<input type="text" name="titulo" id="titulo" class="form-control" required autofocus><br><hr>
        		
        		<label><strong><h4>Categoría Noticia:</h4></strong></label>
        		<select id="categoria_noticia" name="categoria_noticia" class="form-control" required>
        			<option>Seleccione una opción</option>
        			<option value="1">ARTE</option>
    	            <option value="2">ANIME</option>
    	            <option value="3">DEPORTES</option>
    	            <option value="4">CULTURA</option>
    	            <option value="5">MODA</option>
    	            <option value="6">INGENIERIA</option>
    	            <option value="7">BRICOLAGE</option>
    	            <option value="8">MUNDO</option>
    	            <option value="9">FARANDULA</option>
    	            <option value="10">JARDINERIA</option>
    	            <option value="11">COCINA</option>
    	            <option value="12">HOGAR</option>
    	            <option value="13">NIÑOS</option>
        		</select><br><hr>
        	
        		 <!-- Subir imagen -->
        		<label><strong><h4>Imagen portada:</h4></strong></label>	 
        		<div>
        		 	<form method="post" id="formulario" enctype="multipart/form-data">
                        <input type="button" id="btn-file" value="Subir Archivo" data-toggle="modal" data-target="#modal-file">
                        <input type="button" id="btn-file" value="Copiar URL" data-toggle="modal" data-target="#modal-fileURL"><br>

                        <div class="modal fade" id="modal-file" tabindex="-1" role="dialog" aria-hidden="true"><!--/.modal001-->
                          <div class="modal-dialog" role="document"><!--/.modal-dialog-->
                            <div class="modal-content"><!--/.modal-content-->        
                              <div class="modal-header" style="text-align: center;">
                                <p style="text-align: center;"><h6 class="modal-title" style="margin-top: 10px;padding-left: 20px;padding-right: 20px;">SUBIR Archivo</h6></p>  
                              </div>         
                              <div class="modal-body">
                                  <input type="file" name="file" id="file">
                                  <input type="text" id="fileSRC" style="display:none">        
                              </div><!-- /.modal-body -->
                            </div><!--/.modal-content-->
                          </div><!--/.modal-dialog-->
                        </div><!-- /.modal001 -->

                        <div class="modal fade" id="modal-fileURL" tabindex="-1" role="dialog" aria-hidden="true"><!--/.modal001-->
                          <div class="modal-dialog" role="document"><!--/.modal-dialog-->
                            <div class="modal-content"><!--/.modal-content-->        
                              <div class="modal-header" style="text-align: center;">
                                <p style="text-align: center;"><h6 class="modal-title" style="margin-top: 10px;padding-left: 20px;padding-right: 20px;">COPIAR URL</h6>  </p>  
                              </div>         
                              <div class="modal-body">
                                  <input type="text" name="fileURL" id="fileURL" placeholder="Ingrese la URL de la imagen" style="width: 250px">
                                  <input type="button" id="aceptarURL" value="Buscar">    
                              </div><!-- /.modal-body -->
                            </div><!--/.modal-content-->
                          </div><!--/.modal-dialog-->
                        </div><!-- /.modal001 -->

    				</form>
                    <br>
    			    <div id="respuesta"></div>
        		</div><br><hr>
        		<!-- Fin subir imagen -->

                <label><strong><h4>Revista:</h4></strong></label>
                <div>
                    <div>
                        <select id="codigo_revista" name="codigo_revista" class="form-control" required>
                            <option>Seleccione una opción</option>
                    <?php
                        while($rowUsuario = $conexion->obtenerFila($resultadoUsuario)){
                            echo "<option value=". $rowUsuario["CODIGO_REVISTA"] .">". $rowUsuario["NOMBRE_REVISTA"] ."</option>";
                        }
                    ?>
                        </select><br><hr>
                    </div>
                </div>

        		<label><strong><h4>Descripción Breve:</h4></strong></label>
        		<textarea id="descripcion" class="form-control" rows="5" name="descripcion" required></textarea><br><hr>
        		
    			<label><strong><h4>Autor:</h4></strong></label>
    			<input type="text" name="autor" id="autor" class="form-control" required><br><hr><br>
        		
        		<!-- Inicio editor texto -->
        		<!--<form>
    		        <textarea name="editor1" id="editor1" rows="30" cols="80">
    		            Esta es el área para redactar la noticia.
    		        </textarea>
    		        <script>
    		            // Replace the <textarea id="editor1"> with a CKEditor
    		            // instance, using default configuration.
    		            CKEDITOR.replace( 'editor1' );
    		        </script>
    		    </form><br><hr>-->
    		    <!-- Fin edicion texto -->

                <!-- Inicio editor texto -->
                <label><strong><h4>Contenido de la Noticia:</h4></strong></label>
                <div id="froala-editor"></div><br><hr>
                <!-- FIN Inicio editor texto -->

    		    <div style="text-align: right;">
    		    	<input type="button" class="btn btn-primary btn-lg" id="btn-guardar_noticia" name="btn-guardar_noticia" style="border-radius: 0px; background-color: #0099cc;" value="Guardar Noticia" onclick="guardar()"><br><br>
    		    </div>

                <div id="div-resultados" class="alert alerta-inferior" role="alert">      
      
                </div>
            </div>
    	</div> <!-- fin div row -->
    </div>  <!-- fin div container -->
   

      <!--Scripts-->
      <script src="js/jquery-3.2.1.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/redactador.js"></script> 
      <script src="js/slick.min.js"></script>
      <script src="js/froala_editor.pkgd.min.js"></script>
      <script>
            $(function() {
                $('#froala-editor').froalaEditor({
                      toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|', 'fontFamily', 'fontSize', 'color', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'quote', '-', 'insertLink', 'insertImage', 'insertVideo', 'insertFile', 'insertTable', '|', 'insertHR', 'selectAll', 'clearFormatting', '|', 'print', 'help', 'html', '|', 'undo', 'redo'],
                      pluginsEnabled: null
                    })
            });
      </script>

    <!--FIN Scripts-->

  </body>
</html>



           