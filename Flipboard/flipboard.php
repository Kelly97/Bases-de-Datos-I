<?php
//Buscar los scripts para la base en la carpeta con el mismo nombre
include_once("class/class-conexion.php");
$conexion = new Conexion();
$codigoUsuario = 1;//SESION
$sql = "  SELECT  CODIGO_TIPO_USUARIO,
                  CODIGO_TIPO_USUARIO,
                  CODIGO_ESTADO_USUARIO,
                  substr(NOMBRE_USUARIO,1,1) AS INICIAL,
                  NOMBRE_USUARIO,ALIAS_USUARIO,
                  URL_FOTO_PERFIL,
                  DESCRIPCION
          FROM TBL_USUARIOS
          WHERE CODIGO_USUARIO =".$codigoUsuario; //Cuando realicemos la consulta, se debe omitir el punto y coma al final de esta
$resultadoUsuario = $conexion->ejecutarInstruccion($sql);
$rowUsuario = $conexion->obtenerFila($resultadoUsuario);
 //ESTA ASIGNACION ES DE PRUEBA, SE TOMARÁ EL VALOR DE SESIÓN 
/*$sql = "SELECT B.CATEGORIA
        FROM TBL_INTERESES_X_USUARIO A
        LEFT JOIN TBL_CATEGORIA B
        ON (A.CODIGO_CATEGORIA_INTERES = B.CODIGO_CATEGORIA)
        WHERE CODIGO_USUARIO = ".$codigoUsuario; //Cuando realicemos la consulta, se debe omitir el punto y coma al final de esta
$resultadoUsuario = $conexion->ejecutarInstruccion($sql);
while($row = $conexion->obtenerFila($resultadoUsuario)){
  echo utf8_encode($row['CATEGORIA']).'<br>'; //Para obtener algún valor del arreglo que hemos generado, utilizar como índice el nombre del campo que necesitamos, obligatorio escribirlo en mayúscula para que funcione
}
$conexion->liberarResultado($resultadoUsuario);*/
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
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">
    <link rel="stylesheet" href="css/jquery.webui-popover.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
    <link rel="stylesheet" href="css/perfil.css">
    <link rel="stylesheet" href="css/text-scrolling.css">
  </head>
  
  <body> 
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">
        <img src="images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>      
      <div class="collapse navbar-collapse" id="navbarNav">

        <div style="position: relative;">
          <div id="pnProductNav" class="pn-ProductNav" style="margin-right: 15px;margin-left: 15px;width: 400px;">
              <div id="pnProductNavContents" class="pn-ProductNav_Contents">
                  <a onclick="cargarNoticias(0)" class="pn-ProductNav_Link" aria-selected="true">PARA TI</a>
                  <?php
                    $sql = "SELECT  B.CODIGO_CATEGORIA,
                                    UPPER(B.CATEGORIA) AS CATEGORIA
                            FROM TBL_INTERESES_X_USUARIO A
                            LEFT JOIN TBL_CATEGORIA B
                            ON (A.CODIGO_CATEGORIA_INTERES = B.CODIGO_CATEGORIA)
                            WHERE A.CODIGO_USUARIO = ".$codigoUsuario;
                    $resultadoUsuario = $conexion->ejecutarInstruccion($sql);
                    while($row = $conexion->obtenerFila($resultadoUsuario)){
                      ?>
                        <a onclick="cargarNoticias(<?php echo $row['CODIGO_CATEGORIA']; ?>);return false;" class="pn-ProductNav_Link ">
                          <?php echo utf8_encode($row['CATEGORIA']) ?>
                        </a>
                      <?php
                    }
                    $conexion->liberarResultado($resultadoUsuario);
                  ?>   
                  <a class="pn-ProductNav_Link" data-toggle="modal" data-target="#modal-001">AGREGAR INTERÉS</a>
                  <span id="pnIndicator" class="pn-ProductNav_Indicator"></span>
              </div>            
          </div>
          <button id="pnAdvancerLeft" class="pn-Advancer pn-Advancer_Left" type="button">
            <i class="fa fa-angle-left" aria-hidden="true" style="font-size: 30px;padding-top: 8px;"></i>
          </button>
          <button id="pnAdvancerRight" class="pn-Advancer pn-Advancer_Right" type="button">
            <i class="fa fa-angle-right" aria-hidden="true" style="font-size: 30px;padding-top: 8px;"></i>
          </button>
        </div>

        <ul class="navbar-nav" id="iconos_derecha">
          <li class="nav-item" data-toggle="popover" data-placement="left" data-content="Buscar" data-trigger="hover">
            <a class="nav-item" id="btn-buscar">
              <i class="fa fa-search fa-lg nav-item" aria-hidden="true"></i>
              <div id="btn-buscar-content"  class="webui-popover-content">
                 <input id="txt-buscar" type="text" class="form-control" id="busqueda" placeholder="¿Qué buscas?" style="border-color: transparent;box-shadow: none;" autofocus="true">
              </div>
            </a>
          </li>
          <li class="nav-item" data-toggle="popover" data-placement="left" data-content="Mis revistas" data-trigger="hover">
            <a class="nav-item" data-toggle="modal" data-target="#modal-002">
              <i class="fa fa-pencil fa-lg" aria-hidden="true"></i>
            </a>
          </li>
          <li class="nav-item" data-toggle="popover" data-placement="left" data-content="Notificaciones" data-trigger="hover">
            <a class="nav-item" id="btn-notificaciones">
              <i class="fa fa-bell fa-lg" aria-hidden="true" style="margin-right: -22px;"></i>
              <span id="cantidad_notificaciones" class="badge badge-secondary" style="font-size: 9px;">0</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="popover" data-placement="left" data-content="Redactar Noticia" data-trigger="hover">
            <a class="nav-item" href="redactador_noticias.html" target="blank">
              <i class="fa fa-newspaper-o fa-lg" aria-hidden="true"></i>
            </a>
          </li>
          <li class="nav-item" onclick="perfilUsuario()" data-toggle="popover" data-placement="left" data-content="Perfil" data-trigger="hover">
            <a class="nav-item" href="#perfil" >
              <div style="padding-top: 5px;">
                <div class="miniatura-usuario" style="margin: auto;background-image: url('<?php echo $rowUsuario["URL_FOTO_PERFIL"]; ?>');width: 30px;height: 30px;padding: 0px;">
                      <?php
                      if(is_null($rowUsuario["URL_FOTO_PERFIL"])){
                        ?>
                          <table style="height: 100%;width: 100%;font-size: 20px;font-weight: bold;">
                            <tbody>
                              <tr>
                                <td class="align-middle text-center">
                                  <?php echo utf8_encode($rowUsuario['INICIAL']); ?>
                                </td>
                              </tr>
                            </tbody>
                          </table>   
                      <?php
                      }
                      ?>
                </div>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    

    <div class="container-fluid">  
      <div id="contenido-principal" class="col-lg-12" style="padding: 0px;">
        
      </div>    
    </div>

    <!--Modals-->

    <!-- Modal 001: Elige un interés -->
    <div class="modal fade" id="modal-001" tabindex="-1" role="dialog" aria-hidden="true"><!--/.modal001-->
      <div class="modal-dialog" role="document"><!--/.modal-dialog-->
        <div class="modal-content"><!--/.modal-content-->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="search-passion">
                <span>Elige un interés</span>
            </div>
          </div>
          <div class="modal-body">               
              <div class="favorite">
                <div class="name">
                  <span>Noticias</span>
                </div>
              </div>
              <div class="favorite">
                <div class="name">
                  <span>Automotriz</span>
                </div>
              </div>
              <div class="favorite">
                <div class="name">
                  <span>Jardinería</span>
                </div>
              </div>
                      
          </div><!-- /.modal-body -->
        </div><!--/.modal-content-->
      </div><!--/.modal-dialog-->
    </div><!-- /.modal001 -->
    <!-- FIN Modal 001 -->

    <!--Modal 002: Mis revistas-->
    <div class="modal fade" id="modal-002" tabindex="-1" role="dialog" aria-hidden="true"><!--/.modal002-->
      <div class="modal-dialog" role="document"><!--/.modal-dialog-->
        <div class="modal-content"><!--/.modal-content-->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Añade tu punto de vista a una revista</h4>
          </div>
          <div class="modal-body">
            <table>
              <tr>
                <td>
                  <canvas style="background-color: #F00; width: 5px; height: 75px"></canvas>
                </td>
                <td>
                  <input class="form-control" type="text" style="width: 400px; height: 75px" placeholder="Escribe un comentario o agrega un sitio web">
                <td>
              </tr>
            </table>
            <!--Revistas-->
            <div id="revistas" style="background-color:#E5E5E5; padding: 0px; margin:0px">
              <!--Llamado a la BD sobre "Mis Revistas"-->
              <div id="revistas-flip" width="500" height="144">
                <img src="images/selecciones.jpg" widht="117.75" height="144">
                <img src="images/leer_mas_tarde.jpg" widht="117.75" height="144">
                <button type="button" class="btn" id="nueva-revista" data-toggle="modal" data-target="#modal-003" style="width: 115.75px; height:144px">
                  <span>Nueva</span><br>
                  <span>Revista</span>
                </button>
              </div>
            </div><br>
            <!--FIN Revistas-->
            <button type="button" class="btn">POST</button>
          </div><!--/.modal-body-->
        </div><!--/.modal-content-->
      </div><!--/.modal-dialog-->
    </div><!-- /.modal002 -->
    <!--FIN Modal 002-->

    <!--Modal 003: Agregar Revista -->
    <div class="modal fade" id="modal-003" tabindex="-1" role="dialog" aria-hidden="true"><!--/.modal003-->
      <div class="modal-dialog" role="document"><!--/.modal-dialog-->
        <div class="modal-content"><!--/.modal-content-->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Crear una nueva revista</h4>
          </div>
          <div class="modal-body">
            <input type="text" class="form-control" id="nombre-revista" placeholder="Titulo (requerido)"><br>
            <textarea class="form-control" placeholder="Descripcion (Opcional)"></textarea><br>
            <label>
              <input type="radio" name="privacidad" id="btn-privacidad" value="1">
              <span>Pública</span>
            </label>
            <label>
              <input type="radio" name="privacidad" id="btn-privacidad" value="2">
              <span>Privada</span>
            </label><br>
            <button type="button" class="btn">Crear</button>
          </div><!--/.modal-body-->
        </div><!--/.modal-content-->
      </div><!--/.modal-dialog-->
    </div><!-- /.modal003 -->
    <!--FIN modal 003-->
    <!--FIN Modals-->

    <!--Modal Flipear-->
    <div class="modal fade" id="md-flipear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute;top: 5px;left: 10px;font-size: 35px;">
              <span aria-hidden="true">&times;</span>
            </button>
            <h6 class="modal-title" style="text-align: center;margin-top: 20px;padding-left: 20px;padding-right: 20px;">Recopila lo que te gusta en tu propia revista para leer más tarde o compartir con otros</h6>            
          </div>
          <div id="md-body-flipear" class="modal-body">
            
          </div>
          <div class="modal-footer">
            <button id="btn_aniadir_flip" type="button" class="btn " disabled="TRUE">AÑADIR</button>
          </div>
        </div>
      </div>
    </div>
    <!--FIN Modals-->
    
    <!--Scripts-->
    <script src="js/jquery-3.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/perfil.js"></script>
    <script src="js/jquery.webui-popover.js"></script>
    <script src="js/text-scrolling.js"></script>    
    <script src="js/imagesloaded.pkgd.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/index.js"></script> 
    <!--FIN Scripts-->

  </body>
</html>