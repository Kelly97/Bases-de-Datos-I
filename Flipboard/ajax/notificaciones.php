<?php
/*Conexion: PARA QUE ESTA CONEXION FUNCIONE, SE DEBE CREAR UN USUARIO
LLAMADO DB_FLIPBOARD(mayúsculas) Y SU CONTRASEÑA DEBE SER oracle(en minúsculas).*/
include_once("../class/class-conexion.php");
include_once("../class/class-tiempo.php");
$conexion = new Conexion();
$tiempo = new Tiempo();
$codigoUsuario = 1;
$sql =  '
	SELECT A.CODIGO_NOTIFICACION, A.CODIGO_TIPO_NOTIFICACION, substr(B.NOMBRE_USUARIO,1,1) AS INICIAL ,B.NOMBRE_USUARIO, B.URL_FOTO_PERFIL, C.NOMBRE_REVISTA, D.TITULO_NOTICIA, LOWER(E.TIPO_REACCION) TIPO_REACCION, ((SYSDATE - A.HORA_NOTIFICACION)*1440) TIEMPO
	FROM TBL_NOTIFICACIONES A
	LEFT JOIN TBL_USUARIOS B
	ON (A.CODIGO_USUARIO_EMISOR = B.CODIGO_USUARIO)
	LEFT JOIN TBL_REVISTAS C
	ON (A.CODIGO_REVISTA = C.CODIGO_REVISTA)
	LEFT JOIN TBL_NOTICIAS D
	ON (A.CODIGO_NOTICIA = D.CODIGO_NOTICIA)
	LEFT JOIN TBL_REACCIONES E
	ON (A.CODIGO_REACCION = E.CODIGO_REACCION)
	WHERE (A.CODIGO_USUARIO_RECEPTOR = '.$codigoUsuario.' AND A.CODGIO_ESTADO_NOTIFICACION = 2)
	ORDER BY A.CODIGO_NOTIFICACION DESC
	';
$resultado = $conexion->ejecutarInstruccion($sql);
/*$registros = array();
while(true){ 
  $registro = $conexion->obtenerArregloAsociativo($resultado);
  if (!$registro)
    break;
  else
    array_push($registros, $registro);
}
var_dump($registros);*/
while (true) {
	$registro = $conexion->obtenerArregloAsociativo($resultado);
	if (!$registro)
  		break;
	else{
  		switch ($registro['CODIGO_TIPO_NOTIFICACION']) {
    		case 1://seguimiento
		      echo '
		        <div class="card border-info mb-3" style="max-width: 20rem;text-align: left;cursor: pointer;">  
		          <div class="card-body text-info container">
		            <div class="row">
		              <div class="col-lg-3" style="padding-right: 0px;">
		                <img src="'.$registro['URL_FOTO_PERFIL'].'" style="width: 100%;border-radius: 30px;">
		              </div>
		              <div class="col-lg-9" style="margin-bottom:10px;">
		                <p class="card-text">      
		                <strong>'.$registro['NOMBRE_USUARIO'].'</strong> ha comenzado a seguirte.
		                </p>       
		              </div> 
		              <div class="col-lg-12">
		                <h6 style="color: gray;font-size: 14px;">'.$tiempo->calcularTiempoTranscurrido($registro['TIEMPO']).'</h6>   
		              </div>
		            </div>    
		          </div>
		        </div>';
      		break;
		    case 2://comentario
		      echo '
		        <div class="card border-info mb-3" style="max-width: 20rem;text-align: left;cursor: pointer;">  
		          <div class="card-body text-info container">
		            <div class="row">
		              <div class="col-lg-3" style="padding-right: 0px;">
		                <img src="'.$registro['URL_FOTO_PERFIL'].'" style="width: 100%;border-radius: 30px;">
		              </div>
		              <div class="col-lg-9" style="margin-bottom:10px;">
		                <p class="card-text">      
		                '.$registro['NOMBRE_USUARIO'].' ha comentado en tu noticia <strong>'.$registro['TITULO_NOTICIA'].'</strong> añadida a la revista <strong>'.$registro['NOMBRE_REVISTA'].'</strong>
		                </p>       
		              </div> 
		              <div class="col-lg-12">
		                <h6 style="color: gray;font-size: 14px;">'.$tiempo->calcularTiempoTranscurrido($registro['TIEMPO']).'</h6>   
		              </div>
		            </div>    
		          </div>
		        </div>';
		      break;
		    case 3://reaccion noticia
		      ?>
		        <div class="card border-info mb-3" style="max-width: 20rem;text-align: left;cursor: pointer;">  
		          <div class="card-body text-info container">
		            <div class="row">
		              <div class="col-lg-3" style="padding-right: 0px;">
		              	<!--Miniatura de la imagen-->
		                	<div class="miniatura-usuario" style="margin: auto;background-image: url('<?php echo $registro["URL_FOTO_PERFIL"]; ?>');width: 60px;height: 60px;padding: 0px;">
		                		<?php
		                		if(is_null($registro["URL_FOTO_PERFIL"])){
		                			?>
		                				<table style="height: 100%;width: 100%;font-size: 20px;font-weight: bold;">
											<tbody>
												<tr>
													<td class="align-middle text-center">
														<?php echo utf8_encode($registro['INICIAL']); ?>
													</td>
												</tr>
											</tbody>
										</table>
		                			<?php
		                		}
		                		?>								
						  </div>
						  <!--FIN Miniatura de la imagen-->
		              </div>		              
		              <div class="col-lg-9" style="margin-bottom:10px;">
		                <p class="card-text">      
		                <?php echo utf8_encode($registro['NOMBRE_USUARIO']); ?> reaccionó con un 
		                <?php echo utf8_encode($registro['TIPO_REACCION']); ?> a tu noticia <strong>
		                <?php echo utf8_encode($registro['TITULO_NOTICIA']); ?></strong> añadida a la revista <strong><?php echo utf8_encode($registro['NOMBRE_REVISTA']); ?></strong>
		                </p>       
		              </div> 
		              <div class="col-lg-12">
		                <h6 style="color: gray;font-size: 14px;">
		                	<?php echo $tiempo->calcularTiempoTranscurrido($registro['TIEMPO']);?>
		                </h6>   
		              </div>
		            </div>    
		          </div>
		        </div>'
		        <?php
		      break;
		    case 4://reaccion comentario
		      echo '
		        <div class="card border-info mb-3" style="max-width: 20rem;text-align: left;cursor: pointer;">  
		          <div class="card-body text-info container">
		            <div class="row">
		              <div class="col-lg-3" style="padding-right: 0px;">		                
		                <div class="miniatura-usuario" style="margin: auto;background-image: url('.$registro['URL_FOTO_PERFIL'].');width: 60px;height: 60px;padding: 0px;">
								<table style="height: 100%;width: 100%;font-size: 20px;font-weight: bold;">
									<tbody>
										<tr>
											<td class="align-middle text-center">
												'.$registro['INICIAL'].'
											</td>
										</tr>
									</tbody>
								</table>
						  </div>  
		              </div>
		              <div class="col-lg-9" style="margin-bottom:10px;">
		                <p class="card-text">      
		                '.$registro['NOMBRE_USUARIO'].' reacciono con un '.$registro['TIPO_REACCION'].' a tu comentario en la noticia <strong>'.utf8_encode($registro['TITULO_NOTICIA']).'</strong> añadida a la revista <strong>'.utf8_encode($registro['NOMBRE_REVISTA']).'</strong>
		                </p>       
		              </div> 
		              <div class="col-lg-12">
		                <h6 style="color: gray;font-size: 14px;">'.$tiempo->calcularTiempoTranscurrido($registro['TIEMPO']).'</h6>   
		              </div>
		            </div>    
		          </div>
		        </div>';
		      break;
		    case 5://flip
		      echo '
		        <div class="card border-info mb-3" style="max-width: 20rem;text-align: left;cursor: pointer;">  
		          <div class="card-body text-info container">
		            <div class="row">
		              <div class="col-lg-3" style="padding-right: 0px;">
		                <img src="'.$registro['URL_FOTO_PERFIL'].'" style="width: 100%;border-radius: 30px;">
		              </div>
		              <div class="col-lg-9" style="margin-bottom:10px;">
		                <p class="card-text">      
		                '.$registro['NOMBRE_USUARIO'].' flipeo tu noticia <strong>'.$registro['TITULO_NOTICIA'].'</strong> a la revista <strong>'.$registro['NOMBRE_REVISTA'].'</strong>
		                </p>       
		              </div> 
		              <div class="col-lg-12">
		                <h6 style="color: gray;font-size: 14px;">'.$tiempo->calcularTiempoTranscurrido($registro['TIEMPO']).'</h6>   
		              </div>
		            </div>    
		          </div>
		        </div>';
		      break;
		    default:
		      echo '
			    <div class="card border-secondary mb-3" style="max-width: 20rem; text-align: center;">
			      <div class="card-body text-secondary">
			        <h4 class="card-title"><i class="fa fa-heart-o fa-2x" aria-hidden="true"></i></h4>
			        <p class="card-text">No tienes ninguna notificación en este momento. Cuando alguien te siga, comente, añada o le gusten tus historias, lo verás aquí.</p>
			      </div>
			    </div>'; 
		      break;
    	}
	}
}
$conexion->liberarResultado($resultado);
?>