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
    <link rel="stylesheet" href="css/slick-theme.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="css/perfil.css">
  </head>
  
  <body>    
    <nav id="navbar" class="navbar navbar-default navbar-fixed-top">
      <div id="navbar-sup" class="container-fluid" style="padding-left: 0px;">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
        	<img id="myimage" src="images/logo.png" style="max-height: 55px;">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
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
          </ul>                    
          <ul class="nav navbar-nav iconos-derecha" style="border-left: 1px solid #E0E0E0;margin-top: 2px;">
            <li data-toggle="popover" data-placement="left" data-content="Agregar nuevo interés" data-trigger="hover">
              <a data-toggle="modal" data-target="#modal-001">
                <i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i>
              </a>
            </li>
          	<li data-toggle="popover" data-placement="left" data-content="Buscar" data-trigger="hover">
              <a>
                <i class="fa fa-search fa-lg" aria-hidden="true"></i>
              </a>
            </li>
            <li data-toggle="popover" data-placement="left" data-content="Mis revistas" data-trigger="hover">
              <a data-toggle="modal" data-target="#modal-002">
                <i class="fa fa-pencil fa-lg" aria-hidden="true"></i>
              </a>
            </li>
            <li data-toggle="popover" data-placement="left" data-content="Notificaciones" data-trigger="hover">
              <a>
                <i class="fa fa-bell fa-lg" aria-hidden="true"><span class="badge">50</span></i>
              </a>
            </li>
            <li onclick="perfilUsuario()" data-toggle="popover" data-placement="left" data-content="Perfil" data-trigger="hover">
              <a>
                <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i>
              </a>
            </li>
          </ul>          
        </div><!-- /.navbar-collapse -->         
      </div><!-- /.container-fluid -->
    </nav>      

    <div id="contenido-principal" class="container">
      
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
            <div class="search-passion" data-reactid=".0.3.$=1$0.1.0.0.$=10.0">
              <div class="text-input-intl" data-reactid=".0.3.$=1$0.1.0.0.$=10.0.1">
                <span data-reactid=".0.3.$=1$0.1.0.0.$=10.0.1.0"></span>
                <span data-reactid=".0.3.$=1$0.1.0.0.$=10.0.1.1">Elige un interés</span>
                <span data-reactid=".0.3.$=1$0.1.0.0.$=10.0.1.2"></span>
              </div>
            </div>
          </div>
          <div class="modal-body">
            <div class="add-favorite-view" data-red=acti".0.3.$=1$0.1.0">
              <span data-reactid=".0.3.$=1$0.1.0.0">
              <div class="add-favorites" data-reactid=".0.3.$=1$0.1.0.0.$=10">
                <div class="all-favorites" data-reactid=".0.3.$=1$0.1.0.0.$=10.1">
                  <div class="recommended" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1">
                    <div class="favorites" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1">
                      <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.0"></span>
                      <div class="favorite" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:0">
                        <div class="name" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:0.0">
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:0.0.0"></span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:0.0.1">Noticias</span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:0.0.2"></span>
                        </div>
                      </div>
                      <div class="favorite" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:1">
                        <div class="name" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:1.0">
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:1.0.0"></span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:1.0.1">Tecnología</span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:1.0.2"></span>
                        </div>
                      </div>
                      <div class="favorite" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:2">
                        <div class="name" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:2.0">
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:2.0.0"></span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:2.0.1">Diseño</span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:2.0.2"></span>
                        </div>
                      </div>
                      <div class="favorite" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:3">
                        <div class="name" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:3.0">
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:3.0.0"></span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:3.0.1">Fotografía</span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:3.0.2"></span>
                        </div>
                      </div>
                      <div class="favorite" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:4">
                        <div class="name" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:4.0">
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:4.0.0"></span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:4.0.1">Negocios</span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:4.0.2"></span>
                        </div>
                      </div>
                      <div class="favorite" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:5">
                        <div class="name" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:5.0">
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:5.0.0"></span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:5.0.1">Deportes</span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:5.0.2"></span>
                        </div>
                      </div>
                      <div class="favorite" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:6">
                        <div class="name" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:6.0">
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:6.0.0"></span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:6.0.1">Estilo</span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:6.0.2"></span>
                        </div>
                      </div>
                      <div class="favorite" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:7">
                        <div class="name" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:7.0">
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:7.0.0"></span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:7.0.1">Viajes</span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:7.0.2"></span>
                        </div>
                      </div>
                      <div class="favorite" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:8">
                        <div class="name" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:8.0">
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:8.0.0"></span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:8.0.1">Política</span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:8.0.2"></span>
                        </div>
                      </div>
                      <div class="favorite" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:9">
                        <div class="name" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:9.0">
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:9.0.0"></span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:9.0.1">Gastronomía</span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:9.0.2"></span>
                        </div>
                      </div>
                      <div class="favorite" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:a">
                        <div class="name" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:a.0">
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:a.0.0"></span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:a.0.1">Música</span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:a.0.2"></span>
                        </div>
                      </div>
                      <div class="favorite" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:b">
                        <div class="name" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:b.0">
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:b.0.0"></span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:b.0.1">Cine</span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:b.0.2"></span>
                        </div>
                      </div>
                      <div class="favorite" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:c">
                        <div class="name" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:c.0">
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:c.0.0"></span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:c.0.1">Videojuegos</span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:c.0.2"></span>
                        </div>
                      </div>
                      <div class="favorite" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:d">
                        <div class="name" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:d.0">
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:d.0.0"></span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:d.0.1">Automotriz</span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:d.0.2"></span>
                        </div>
                      </div>
                      <div class="favorite" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:e">
                        <div class="name" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:e.0">
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:e.0.0"></span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:e.0.1">Ciencias</span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:e.0.2"></span>
                        </div>
                      </div>
                      <div class="favorite" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:f">
                        <div class="name" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:f.0">
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:f.0.0"></span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:f.0.1">Hogar</span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:f.0.2"></span>
                        </div>
                      </div>
                      <div class="favorite" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:g">
                        <div class="name" data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:g.0">
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:g.0.0"></span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:g.0.1">Celebridades</span>
                          <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.1:g.0.2"></span>
                        </div>
                      </div>
                      <span data-reactid=".0.3.$=1$0.1.0.0.$=10.1.1.1.2"></span>
                    </div>
                  </div>
                </div>
              </div>
              </span>
              <div class="sub-message nodisplay" data-reactid=".0.3.$=1$0.1.0.1"></div>
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
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/index.js"></script> 
    <script src="js/slick.min.js"></script>
    <script src="js/perfil.js"></script>
    <!--FIN Scripts-->

  </body>
</html>