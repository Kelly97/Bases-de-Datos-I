<?php
/*Conexion: PARA QUE ESTA CONEXION FUNCIONE, SE DEBE CREAR UN USUARIO
LLAMADO DB_FLIPBOARD(mayúsculas) Y SU CONTRASEÑA DEBE SER oracle(en minúsculas).
include_once("class/class-conexion.php");
$conexion = new Conexion();
$codigoUsuario = 1;
$sql = "SELECT nombre,cod_prueba
        FROM tbl_prueba
        WHERE cod_prueba = 1";
$resultadoUsuario = $conexion->ejecutarInstruccion($sql);
while($row = $conexion->obtenerFila($resultadoUsuario)){
  echo $row['NOMBRE'];
}
$conexion->liberarResultado($resultadoUsuario);
*/ 
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
  </head>
  
  <body> 
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">
        <img src="images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        Flipboard
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
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
              <span class="badge badge-secondary" style="font-size: 9px;">0</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="popover" data-placement="left" data-content="Redactar Noticia" data-trigger="hover">
            <a class="nav-item" href="redactador_noticias.html" target="blank">
              <i class="fa fa-newspaper-o fa-lg" aria-hidden="true"></i>
            </a>
          </li>
          <li class="nav-item" onclick="perfilUsuario()" data-toggle="popover" data-placement="left" data-content="Perfil" data-trigger="hover">
            <a class="nav-item" href="#perfil">
              <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i>
            </a>
          </li>
        </ul>
      </div>
    </nav>


   <!--<nav id="navbar" class="navbar navbar-default navbar-fixed-top">
      <div id="navbar-sup" class="container-fluid" style="padding-left: 0px;">
        <div class="navbar-header">
        	<img id="myimage" src="images/logo.png" style="max-height: 55px;">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="your-class">
            <li onclick="cargarNoticias(0)">PORTADA</li>
            <li onclick="cargarNoticias(2)">ARTE</li>
            <li onclick="cargarNoticias(3)">ANIME</li>
            <li onclick="cargarNoticias(4)">DEPORTES</li>
            <li onclick="cargarNoticias(5)">CULTURA</li>
            <li onclick="cargarNoticias(6)">MODA</li>
            <li onclick="cargarNoticias(7)">INGENIERIA</li>
            <li onclick="cargarNoticias(8)">BRICOLAGE</li>
            <li onclick="cargarNoticias(9)">MUNDO</li>
            <li onclick="cargarNoticias(10)">FARANDULA</li>
            <li onclick="cargarNoticias(11)">JARDINERIA</li>
            <li onclick="cargarNoticias(12)">COCINA</li>
            <li onclick="cargarNoticias(13)">HOGAR</li>
            <li onclick="cargarNoticias(14)">NIÑOS</li>
            <li data-toggle="modal" data-target="#modal-001">AGREGAR <i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i></li>
          </ul>                    
          <ul class="nav navbar-nav iconos-derecha" style="border-left: 1px solid #E0E0E0;margin-top: 2px;">
          	<li data-toggle="popover" data-placement="left" data-content="Buscar" data-trigger="hover">              
              <a id="btn-buscar">
                <i class="fa fa-search fa-lg" aria-hidden="true"></i>
                <div id="btn-buscar-content"  class="webui-popover-content">
                   <input id="txt-buscar" type="text" class="form-control" id="busqueda" placeholder="¿Qué buscas?" style="border-color: transparent;box-shadow: none;" autofocus="true">
                </div>
              </a>
            </li>
            <li data-toggle="popover" data-placement="left" data-content="Mis revistas" data-trigger="hover">
              <a data-toggle="modal" data-target="#modal-002">
                <i class="fa fa-pencil fa-lg" aria-hidden="true"></i>
              </a>
            </li>
            <li data-toggle="popover" data-placement="left" data-content="Notificaciones" data-trigger="hover">
              <a id="btn-notificaciones">
                <i class="fa fa-bell fa-lg" aria-hidden="true"><span class="badge">0</span></i> 

              </a>
            </li>
            <li data-toggle="popover" data-placement="left" data-content="Redactar Noticia" data-trigger="hover">
              <a href="redactador_noticias.html" target="blank">
                <i class="fa fa-newspaper-o fa-lg" aria-hidden="true"></i>
              </a>
            </li>
            <li onclick="perfilUsuario()" data-toggle="popover" data-placement="left" data-content="Perfil" data-trigger="hover">
              <a>
                <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i>
              </a>
            </li>
          </ul>          
        </div>        
      </div>
    </nav> --> 

    <div class="container-fluid">  
      <div id="contenido-principal" class="col-lg-12">
        
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
            <h4 class="modal-title">Crea tu pensamiento en una revista</h4>
          </div>
          <div class="modal-body">
            <textarea class="form-control" type="text" placeholder="Escribe un comentario o agrega un sitio web a tu revista"></textarea><br>
            <!--Revistas-->
            <div id="revistas" style="background-color:#E5E5E5; padding: 0px; margin:0px">
              <!--Llamado a la BD sobre "Mis Revistas"-->
              <button type="button" class="btn" id="nueva-revista" data-toggle="modal" data-target="#modal-003"><i>Agregar nueva revista</i></button>
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
    
    <!--Scripts-->
    <script src="js/jquery-3.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/perfil.js"></script>
    <script src="js/jquery.webui-popover.js"></script>
    <script src="js/index.js"></script> 
    <!--FIN Scripts-->

  </body>
</html>