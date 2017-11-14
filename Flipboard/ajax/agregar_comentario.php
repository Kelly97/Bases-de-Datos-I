<?php  
	session_start();
	  if (isset($_SESSION['usuario'])) {
	    $codigoUsuario = $_SESSION['usuario']['CODIGO_USUARIO'];
	  } else{
	    header('Location: index.php');
	  }
	include_once("../class/class-conexion.php");
  include_once("../class/class-date-interval.php");
	$conexion = new Conexion();

	$codigo_noticia = $_POST["codigo_noticia"];

	$sql ="WITH 
			CANTIDAD_LIKES AS(
			    SELECT CODIGO_NOTICIA, COUNT(DISTINCT CODIGO_USUARIO) AS CANT_LIKES
			    FROM TBL_REACCIONES_X_NOTICIAS
			    WHERE CODIGO_REACCION = 1
			    GROUP BY CODIGO_NOTICIA
			)
			SELECT A.CODIGO_NOTICIA,
			        B.CODIGO_USUARIO,
			        B.NOMBRE_USUARIO,
        			substr(B.NOMBRE_USUARIO,1,1) AS INICIAL_USUARIO_PUBLICA,
			        B.URL_FOTO_PERFIL,
			        A.AUTOR_NOTICIA,
			        A.TITULO_NOTICIA,
			        A.FECHA_PUBLICACION,
			        A.URL_PORTADA_NOTI,
			        C.CANT_LIKES
			FROM TBL_NOTICIAS A
			LEFT JOIN TBL_USUARIOS B
			ON (A.CODIGO_USUARIO = B.CODIGO_USUARIO)
			LEFT JOIN CANTIDAD_LIKES C
			ON (A.CODIGO_NOTICIA = C.CODIGO_NOTICIA)
			WHERE A.CODIGO_NOTICIA = ".$codigo_noticia;

	$sql1 = "SELECT A.CODIGO_NOTICIA,
			        A.CODIGO_USUARIO,
			        B.NOMBRE_USUARIO,
              substr(B.NOMBRE_USUARIO,1,1) AS INICIAL_USUARIO_PUBLICA,
			        B.URL_FOTO_PERFIL
			FROM TBL_REACCIONES_X_NOTICIAS A
			LEFT JOIN TBL_USUARIOS B
			ON (A.CODIGO_USUARIO = B.CODIGO_USUARIO)
			WHERE A.CODIGO_REACCION = 1 
			AND A.CODIGO_NOTICIA = ".$codigo_noticia;


	$sql2="SELECT B.CODIGO_USUARIO,
               A.CODIGO_COMENTARIO, 
              B.NOMBRE_USUARIO,
              substr(B.NOMBRE_USUARIO,1,1) AS INICIAL_USUARIO_PUBLICA,
			        B.URL_FOTO_PERFIL,
			        A.CONTENIDO,
              TO_CHAR(A.FECHA,'YYYY-MM-DD HH24:MI:SS') AS FECHA	        
			FROM TBL_COMENTARIOS A
			LEFT JOIN TBL_USUARIOS B
			ON (A.CODIGO_USUARIO = B.CODIGO_USUARIO)
			WHERE A.CODIGO_NOTICIA = ".$codigo_noticia;

	$resultadoNoticias = $conexion->ejecutarInstruccion($sql);
	$resultadoLikes = $conexion->ejecutarInstruccion($sql1);
	$resultadoComentarios = $conexion->ejecutarInstruccion($sql2);

	switch ($_GET["accion"]) {
		#Mostrar informacion modal
    case '1':

		$datosNoticia = $conexion->obtenerFila($resultadoNoticias);
		$datosNoticia['CANT_LIKES'];
	?>

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="modal-header"> 
		<div class="container" style="margin-bottom: 10px;">  
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font: 40px sans-serif; opacity: 1; width: 30px;">
              <span aria-hidden="true">&times;</span>
            </button>                 
              <div class="row">
                <div class="col-lg-1 col-md-2 col-sm-2 col-2 col-xl-1" style="padding:0px;">
                  <div class="miniatura-usuario" style="margin: auto;background-image: url(<?php echo ($datosNoticia['URL_FOTO_PERFIL']); ?>);width: 40px;height: 40px;padding: 0px;">
                    <?php
                      if(is_null($datosNoticia["URL_FOTO_PERFIL"])){
                    ?>  
                        <table style="height: 100%;width: 100%;font-size: 20px;font-weight: bold;">
                         <tbody>
                          <tr>
                            <td class="align-middle text-center">
                              <?php echo ($datosNoticia['INICIAL_USUARIO_PUBLICA']); ?>
                            </td>
                          </tr>
                        </tbody> 
                      </table>
                    <?php
                      }
                    ?>                
                  </div>
                </div>  
                <div class="col-lg-11 col-md-10 col-sm-10 col-10 col-xl-11" >
                    <table style="height: 100%;">
                      <tbody>
                        <tr>
                          <td class="align-middle">
                            <p class="card-text" style="margin-bottom: -8px;">      
                              <?php echo ($datosNoticia['NOMBRE_USUARIO']); ?>       
                            </p> 
                          </td> 
                      </tr>
                      </tbody>
                    </table>  
                  </div> 
              </div>  
            </div>
          </div>
            <div class="modal-body">
            <img class="card-img-top" src='http://mouse.latercera.com/wp-content/uploads/2017/10/fortnite.jpg'>
            <div class="card-body" style="text-align: justify;">
              <h3 class="card-title" style="text-align: left;"><?php echo ($datosNoticia['TITULO_NOTICIA']); ?></h3>
              <span class="noti-card-autor" style="font-size: 13px;">
                <?php echo ($datosNoticia['NOMBRE_USUARIO']); ?> · <?php echo ($datosNoticia['AUTOR_NOTICIA']); ?>
              </span>
              <div style="margin: 40px 0px;" class="row">
                <span>
                  <button onclick="flipear(<?php echo ($datosNoticia['CODIGO_NOTICIA']); ?>)" type="button" class="btn btn-circle" data-toggle="modal" data-target="#md-flipear" style="background-color: #fff; border-color: #fff; opacity: .5;">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </button>
                  <span style="font-size: 13px;">Flipear</span>
                </span>
                <span>
                  <button onclick="darLike(<?php echo ($datosNoticia['CODIGO_NOTICIA']); ?>)" type="button" class="btn btn-default btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Me gusta" data-trigger="hover" style="background-color: #fff; border-color: #fff;">
                    <i class="fa 
                      <?php 
                   		$fa='';
                      	while($rowLikes = $conexion->obtenerFila($resultadoLikes)){
                      		if($rowLikes['CODIGO_USUARIO']==$codigoUsuario){
  	                          $fa = 'fa-heart';
  	                          echo $fa;
  	                        }	
                      	}
                          if($fa==''){
                          	$fa = 'fa-heart-o';
  	                        echo $fa; 
  	                    }
                      ?>
                    " aria-hidden="true" id="<?php echo 'like_'.$datosNoticia['CODIGO_NOTICIA'];?>" style="<?php 
                          if($datosNoticia['CANT_LIKES']!=0){
                            echo 'color:rgb(0, 0, 0);';
                          } ?>"> </i>
                  </button> 
                  <span id="<?php echo ($datosNoticia['CODIGO_NOTICIA']); ?>" style="font-size: 13px;"><?php echo ($datosNoticia['CANT_LIKES']); ?></span>
                </span>
<!--************************************************************************************************************-->
                  <ul id="div-usuariosLikes" style="margin-left: 30px; list-style-type: none;padding: 0px;">                    
                  </ul>                
<!--************************************************************************************************************-->
              </div>
              <hr>
<!--************************************************************************************************************-->
              <div id="respuestaComentario" style="margin: 20px 0px;">
                
              </div>
              <hr>
<!--************************************************************************************************************-->
                <div>
                  <form>
                    <div class="row">
                      <textarea id="txt_comentario" class="form-control" rows="1" name="txt_comentario" placeholder="<?php 
                        $cont=0;
                        while($rowComentarios = $conexion->obtenerFila($resultadoComentarios)){
                          $cont++;
                        }
                        if($cont>0)
                              echo 'Deja un comentario'; 
                        else
                            echo 'Comienza la conversación...';
                      ?>" style="height: 35px; width: 85%; margin: 0px; border: none; font-size: 14px;resize: none;"></textarea>                       
                      <span>
                        <button onclick="agregarComentario(<?php echo $codigo_noticia ?>,<?php echo $codigoUsuario ?>)" title="Publicar" type="button" class="btn btn-circle" style="background-color: #fff; border-color: #fff; opacity: .5;">
                          <i class="fa fa-plus" aria-hidden="true"></i>
                        </button>
                      </span> 
                    </div> 
                  </form>
                </div>
                <hr>
            </div>
          </div>
        <!-- <script src="js/tarjetasNoticias.js"></script> -->


<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->


	<?php
			break;

    # Mostrar personas que dieron like
		case '2':

      while($rowLikes = $conexion->obtenerFila($resultadoLikes)){
        ?>
        <li style="padding-left: 0;height: 40px;display: inline-block;padding-right: 4px;vertical-align: top;width: 40px;">
            <div class="col-lg-1 col-md-2 col-sm-2 col-2 col-xl-1" style="padding:0px;">
              <div class="miniatura-usuario" title="<?php echo ($rowLikes['NOMBRE_USUARIO']); ?>" style="margin: auto;background-image: url(<?php echo ($rowLikes['URL_FOTO_PERFIL']); ?>);width: 40px;height: 40px;padding: 0px;">
                <?php
                  if(is_null($rowLikes["URL_FOTO_PERFIL"])){
                ?>
                    <table style="height: 100%;width: 100%;font-size: 20px;font-weight: bold;">
                      <tbody>
                        <tr>
                          <td class="align-middle text-center">
                            <?php echo ($rowLikes['INICIAL_USUARIO_PUBLICA']); ?>
                          </td>
                        </tr>
                      </tbody> 
                    </table> 
                <?php
                  }
                ?>              
              </div>
            </div> 
        </li>
      <?php
      }
			break;

    # Mostrar comentarios
    case '3':
      while($rowComentarios = $conexion->obtenerFila($resultadoComentarios)){
    ?>
        <ul style="list-style-type: none; margin: 10px 0px; padding: 0px;">
          <li>
            <div class="row">
              <div>
                <ul style="margin: 0px;padding: 0px;">
                  <li style="padding-left: 0;height: 40px;display: inline-block;padding-right: 0px;vertical-align: top;width: 40px;">
                    <div class="col-lg-1 col-md-2 col-sm-2 col-2 col-xl-1" style="padding:0px;">
                      <div class="miniatura-usuario" style="margin: auto;background-image: url(<?php echo ($rowComentarios['URL_FOTO_PERFIL']); ?>);width: 40px;height: 40px;padding: 0px;">
                        <?php
                          if(is_null($rowComentarios["URL_FOTO_PERFIL"])){
                        ?>
                            <table style="height: 100%;width: 100%;font-size: 20px;font-weight: bold;">
                              <tbody>
                                <tr>
                                  <td class="align-middle text-center">
                                    <?php echo ($rowComentarios['INICIAL_USUARIO_PUBLICA']); ?>
                                  </td>
                                </tr>
                              </tbody> 
                            </table> 
                        <?php
                          }
                        ?>              
                      </div>
                    </div> 
                  </li>
                </ul>
              </div>
              <div class="row" style="margin-left: 30px;">
                <div>
                  <strong style="font-size: 14px;line-height: 16px;" class="card-title" style="text-align: left;">
                    <?php echo ($rowComentarios['NOMBRE_USUARIO']); ?>                  
                  </strong>
                  <?php 
                      if ($rowComentarios["CODIGO_USUARIO"] == $codigoUsuario) {?>
                      <span>
                        <button type="button" onclick="eliminarComentario(<?php echo $codigo_noticia ?>,<?php echo $rowComentarios['CODIGO_COMENTARIO'] ?>)" title="Eliminar" type="button" class="btn btn-circle" style="background-color: #fff; border-color: #fff; opacity: 1; font-size: 20px;">
                          <span aria-hidden="true">&times;</span>
                        </button> 
                      </span>
                    <?php
                    }
                  ?>
                  <p class="card-text" style="font-size: 14px;line-height: 16px;">
                    <?php echo ($rowComentarios["CONTENIDO"]);?>
                  </p>
                  <span style="color: gray;font-size: 12px;">
                    <?php echo fechaIntervalo::calcularintervalo($rowComentarios['FECHA']);?>
                  </span>  
                </div>
              </div>
            </div>
          </li>
        </ul>
        <br>
    <?php
      }
      break;

    # Agregar Comentario
    case '4':

      $comentario = $_POST["contenido"];
      $codigoUsuario = $_POST["codigoUsuario"];
      $codigoNoticia =$_POST["codigo_noticia"];
      $resultado = array();

      if($comentario==""&&$codigoUsuario&&$codigoNoticia){
        $resultado["codigo_resultado"]=0;
        $resultado["mensaje"]="Debe ingresar algo";
        echo json_encode($resultado);
        exit;
      }

      $sql="INSERT INTO TBL_COMENTARIOS(
                CODIGO_COMENTARIO,
                CODIGO_USUARIO,
                CODIGO_NOTICIA,
                CODIGO_FLIP,
                CODIGO_COMENTARIO_SUP,
                CONTENIDO,
                FECHA
            )
            VALUES (
                TBL_COMENTARIOS_CODIGO_COMENTA.NEXTVAL,
                ".$codigoUsuario.",
                ".$codigoNoticia.",
                NULL,
                NULL,
                '".$comentario."',
                SYSDATE
            )";
      $resultadoInsertar = $conexion->ejecutarInstruccion($sql);
      
      $resultado["codigo_resultado"]=1;
      $resultado["mensaje"]="Comentario publicado con exito";
      echo json_encode($resultado);

      break;

    case '5':
        $codigoComentario = $_POST["codigoComentario"];
        $resultado = array();

        $sql="SELECT CODIGO_COMENTARIO,
                  CODIGO_USUARIO,
                  CODIGO_NOTICIA,
                  CODIGO_FLIP,
                  CODIGO_COMENTARIO_SUP,
                  CONTENIDO,
                  FECHA 
              FROM TBL_COMENTARIOS
              WHERE CODIGO_COMENTARIO=".$codigoComentario;
        $resultadoComentario = $conexion->ejecutarInstruccion($sql);

        if($rowComentario = $conexion->obtenerFila($resultadoComentario)){
          $sql="DELETE FROM TBL_COMENTARIOS WHERE CODIGO_COMENTARIO = ".$codigoComentario;
          $resultadoInsertar = $conexion->ejecutarInstruccion($sql);

          $resultado["codigo_resultado"]=1;
          $resultado["mensaje"]="Comentario publicado con exito";
          echo json_encode($resultado);
          exit;
        }
        $resultado["codigo_resultado"]=0;
          $resultado["mensaje"]="Registro no encontrado";
          echo json_encode($resultado);

      break;

		default:
			# code...
			break;
	}

?>



