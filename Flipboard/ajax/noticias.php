<?php
//sleep(1);
//SOLO MUESTRAn LAS NOTICIAS DE USUARIOS VERIFICADOS
$codigoUsuario=1;//sesion
include_once("../class/class-conexion.php");
include_once("../class/class-tiempo.php");
$conexion = new Conexion();
switch ($_POST["codigo"]) {
	case 0:
		$sql="WITH
			  TBL_CANT_LIKES AS(
			    SELECT CODIGO_NOTICIA, COUNT(DISTINCT CODIGO_USUARIO) AS CANT_LIKES
			    FROM TBL_REACCIONES_X_NOTICIAS
			    WHERE CODIGO_REACCION = 1
			    GROUP BY CODIGO_NOTICIA),
			  TBL_CANT_COMENT AS(
			    SELECT CODIGO_NOTICIA, COUNT(CODIGO_COMENTARIO) AS CANT_COMENTARIOS
			    FROM TBL_COMENTARIOS
			    GROUP BY CODIGO_NOTICIA),
			  TBL_NOTICIAS_PORTADA AS (
			    SELECT B.CODIGO_NOTICIA
			    FROM TBL_SEGUIDORES A
			    LEFT JOIN TBL_NOTICIAS B
			    ON(B.CODIGO_USUARIO=A.CODIGO_USUARIO_SEGUIDO)
			    LEFT JOIN TBL_USUARIOS C
			    ON(B.CODIGO_USUARIO=C.CODIGO_USUARIO)
			    WHERE A.CODIGO_USUARIO_SEGUIDOR=".$codigoUsuario."
			    AND C.CODIGO_ESTADO_USUARIO=1
			    UNION
			    SELECT B.CODIGO_NOTICIA
			    FROM TBL_REVISTAS_SEGUIDAS A
			    LEFT JOIN TBL_NOTICIAS B
			    ON(A.CODIGO_REVISTA=B.CODIGO_REVISTA)
			    LEFT JOIN TBL_USUARIOS C
			    ON(B.CODIGO_USUARIO=C.CODIGO_USUARIO)
			    WHERE A.CODIGO_SEGUIDOR= ".$codigoUsuario."
			    AND C.CODIGO_ESTADO_USUARIO=1
			    UNION
			    SELECT B.CODIGO_NOTICIA
			    FROM TBL_INTERESES_X_USUARIO A
			    RIGHT JOIN TBL_NOTICIAS B
			    ON(A.CODIGO_CATEGORIA_INTERES=B.CODIGO_CATEGORIA)
			    LEFT JOIN TBL_USUARIOS C
			    ON(B.CODIGO_USUARIO=C.CODIGO_USUARIO)
			    WHERE A.CODIGO_USUARIO=".$codigoUsuario."
			    AND C.CODIGO_ESTADO_USUARIO=1
			    )
			SELECT A.CODIGO_CATEGORIA,
			      A.CATEGORIA,
			      D.NOMBRE_USUARIO AS USUARIO_PUBLICA,
			      D.URL_FOTO_PERFIL,
			      substr(D.NOMBRE_USUARIO,1,1) AS INICIAL_USUARIO_PUBLICA,
			      UPPER(C.NOMBRE_REVISTA) AS NOMBRE_REVISTA,
			      B.CODIGO_NOTICIA,
			      B.AUTOR_NOTICIA,
			      B.TITULO_NOTICIA,
			      B.DESCRIPCION_NOTICIA,
			      B.URL_PORTADA_NOTI,
			      ((SYSDATE - B.FECHA_PUBLICACION)*1440) AS FECHA_PUBLICACION,
			      NVL(E.CANT_LIKES,0) AS CANT_LIKES,
			      NVL(F.CANT_COMENTARIOS,0) AS CANT_COMENTARIOS
			FROM TBL_CATEGORIA A
			LEFT JOIN TBL_NOTICIAS B
			ON(A.CODIGO_CATEGORIA=B.CODIGO_CATEGORIA)
			LEFT JOIN TBL_REVISTAS C
			ON(C.CODIGO_REVISTA=B.CODIGO_REVISTA)
			LEFT JOIN TBL_USUARIOS D
			ON(D.CODIGO_USUARIO=C.CODIGO_USUARIO)
			LEFT JOIN TBL_CANT_LIKES E
			ON(B.CODIGO_NOTICIA=E.CODIGO_NOTICIA)
			LEFT JOIN TBL_CANT_COMENT F
			ON(B.CODIGO_NOTICIA = F.CODIGO_NOTICIA)
			RIGHT JOIN TBL_NOTICIAS_PORTADA G
			ON(B.CODIGO_NOTICIA=G.CODIGO_NOTICIA)
			WHERE D.CODIGO_ESTADO_USUARIO = 1
			ORDER BY FECHA_PUBLICACION";
			$resultadoNoticias = $conexion->ejecutarInstruccion($sql);
		?>
		  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xl-12" style="text-align: center;padding-bottom: 40px;padding-top: 40px; width: 100%;">
		     <h2>NOTICIAS DE PORTADA</h2>
		     <h5 style="color: #999;">Noticias de gran relevancia en un solo lugar</h5>
		  </div>


		<div class="grid">
			<?php
			while($rowNoticia = $conexion->obtenerFila($resultadoNoticias)){
				?>		  
				<div class="card noti-card" style="position: relative;">
					<div class="botones-noticia-general">
				      	<button onclick="flipear(<?php echo $rowNoticia['CODIGO_NOTICIA'];?>)" type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#md-flipear" data-container="body" data-toggle="popover" data-placement="left" data-content="Flipear" data-trigger="hover">
				      		<i class="fa fa-plus" aria-hidden="true"></i>
				      	</button><br>
				      	<button onclick="darLike(<?php echo $rowNoticia['CODIGO_NOTICIA'];?>)" type="button" class="btn btn-default btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Me gusta" data-trigger="hover">
				      		<i class="fa fa-heart-o" aria-hidden="true"></i>
				      	</button><br>
				      	<!--<button type="button" class="btn btn-default btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Compartir" data-trigger="hover">
				      		<i class="fa fa-envelope-o" aria-hidden="true"></i>
				      	</button>-->
				    </div>
					<div class="container" style="margin-bottom: 10px;">
						<div class="row">
						      <div class="col-lg-1 col-md-2 col-sm-2 col-2 col-xl-1" style="padding:0px;">
						      	<div class="miniatura-usuario" style="margin: auto;background-image: url('<?php echo $rowNoticia["URL_FOTO_PERFIL"]; ?>');width: 40px;height: 40px;padding: 0px;">
				                		<?php
				                		if(is_null($rowNoticia["URL_FOTO_PERFIL"])){
				                			?>
				                				<table style="height: 100%;width: 100%;font-size: 20px;font-weight: bold;">
													<tbody>
														<tr>
															<td class="align-middle text-center">
																<?php echo utf8_encode($rowNoticia['INICIAL_USUARIO_PUBLICA']); ?>
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
										        	<?php echo utf8_encode($rowNoticia["USUARIO_PUBLICA"]);?>      	
										        </p> 
										        <p style="padding: 0px;margin:0px;"> 
										        	<span style="color: #09c;font-size: 12px;">
										        		<?php echo utf8_encode($rowNoticia["NOMBRE_REVISTA"]);?>
										        	</span> 								        	
										        </p> 
									        </td> 
								    	</tr>
							        </tbody>
						        </table>  
						      </div> 
						</div>
				   </div>  
				  <img class="card-img-top" src='<?php echo $rowNoticia["URL_PORTADA_NOTI"]; ?>' alt="Card image cap">
				  <div class="card-body" style="text-align: justify;">
				    <h5 class="card-title" style="text-align: left;"><?php echo utf8_encode($rowNoticia["TITULO_NOTICIA"]);?></h5>
				    <span class="noti-card-autor">
				    	<?php echo utf8_encode($rowNoticia["USUARIO_PUBLICA"])." · ".utf8_encode($rowNoticia["AUTOR_NOTICIA"]);?>
				    </span>
				    <p class="card-text">
				    	<?php echo utf8_encode($rowNoticia["DESCRIPCION_NOTICIA"]);?>
				    </p>
				    <p>
				    	<span style="color: gray;font-size: 12px;">
			        		<?php echo Tiempo::calcularTiempoTranscurrido($rowNoticia['FECHA_PUBLICACION']);?>
			        	</span> 
				    </p>
				    <p>
			        	<?php echo $rowNoticia["CANT_LIKES"];?>
			        	<i class="fa fa-heart" aria-hidden="true" style="font-size: 13px;padding-right: 8px;color: red;">
				        </i>
				        <?php echo $rowNoticia["CANT_COMENTARIOS"];?>
				        <i class="fa fa-comment-o" aria-hidden="true" style="font-size: 13px;padding-right: 8px;"></i>
			        	<a class="btn btn-default" role="button" style="cursor: pointer;">
				        	<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 13px;padding-right: 8px;">				        		
				        	</i>
				        	Añadir Comentario
			        	</a>
			        </p>
				  </div>
				</div>
			<?php 
			}				
			?>			

		</div>
		    
		<?php
		break;

	default:
		$sql = "WITH TBL_CANT_LIKES AS(
			    SELECT CODIGO_NOTICIA, 
			    COUNT(DISTINCT CODIGO_USUARIO) AS CANT_LIKES
			    FROM TBL_REACCIONES_X_NOTICIAS
			    WHERE CODIGO_REACCION = 1
			    GROUP BY CODIGO_NOTICIA),
			    TBL_CANT_COMENT AS(
			    SELECT CODIGO_NOTICIA, COUNT(CODIGO_COMENTARIO) AS CANT_COMENTARIOS
			    FROM TBL_COMENTARIOS
			    GROUP BY CODIGO_NOTICIA)
			SELECT A.CATEGORIA,
			      D.NOMBRE_USUARIO AS USUARIO_PUBLICA,
			      D.URL_FOTO_PERFIL,
			      substr(D.NOMBRE_USUARIO,1,1) AS INICIAL_USUARIO_PUBLICA,
			      UPPER(C.NOMBRE_REVISTA) AS NOMBRE_REVISTA,
			      B.CODIGO_NOTICIA,
			      B.AUTOR_NOTICIA,
			      B.TITULO_NOTICIA,
			      B.DESCRIPCION_NOTICIA,
			      B.URL_PORTADA_NOTI,
			      ((SYSDATE - B.FECHA_PUBLICACION)*1440) AS FECHA_PUBLICACION,    
			      NVL(E.CANT_LIKES,0) AS CANT_LIKES,
			      NVL(F.CANT_COMENTARIOS,0) AS CANT_COMENTARIOS
			FROM TBL_CATEGORIA A
			LEFT JOIN TBL_NOTICIAS B
			ON(A.CODIGO_CATEGORIA=B.CODIGO_CATEGORIA)
			LEFT JOIN TBL_REVISTAS C
			ON(C.CODIGO_REVISTA=B.CODIGO_REVISTA)
			LEFT JOIN TBL_USUARIOS D
			ON(D.CODIGO_USUARIO=C.CODIGO_USUARIO)
			LEFT JOIN TBL_CANT_LIKES E
			ON(B.CODIGO_NOTICIA=E.CODIGO_NOTICIA)
			LEFT JOIN TBL_CANT_COMENT F
			ON(B.CODIGO_NOTICIA = F.CODIGO_NOTICIA)
			WHERE A.CODIGO_CATEGORIA = ".$_POST['codigo']."
			AND D.CODIGO_ESTADO_USUARIO = 1
			ORDER BY FECHA_PUBLICACION"; 
	$resultadoNoticias = $conexion->ejecutarInstruccion($sql);


	$sql2 = "SELECT CATEGORIA
			FROM TBL_CATEGORIA
			WHERE CODIGO_CATEGORIA=".$_POST["codigo"];
	$resultadoCategoria = $conexion->ejecutarInstruccion($sql2);
	$categoria = $conexion->obtenerFila($resultadoCategoria);
		?>
		  <div class="col-lg-12 col-md-12" style="text-align: center;padding-bottom: 40px;padding-top: 40px;">
	        <h2><?php echo utf8_encode($categoria['CATEGORIA']); ?></h2>
	        <button onclick="eliminarInteres(<?php echo $_POST["codigo"]; ?>,<?php echo $codigoUsuario; ?>);" class="btn btn-default btn-seguir" role="button" style="border:none;">
	        	<i class="fa fa-times" aria-hidden="true"></i>
	        </button>
		  </div>
		  
		  <div class="grid">		  	
		  	<?php				
			while($rowNoticia = $conexion->obtenerFila($resultadoNoticias)){				
			  ?>			  
				<div class="card noti-card" style="position: relative;">
					<div class="botones-noticia-general">
				      	<button onclick="flipear(<?php echo $rowNoticia['CODIGO_NOTICIA'];?>)" type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#md-flipear" data-container="body" data-toggle="popover" data-placement="left" data-content="Flipear" data-trigger="hover">
				      		<i class="fa fa-plus" aria-hidden="true"></i>
				      	</button><br>
				      	<button onclick="darLike(<?php echo $rowNoticia['CODIGO_NOTICIA'];?>)" type="button" class="btn btn-default btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Me gusta" data-trigger="hover">
				      		<i class="fa fa-heart-o" aria-hidden="true"></i>
				      	</button><br>
				      	<!--<button type="button" class="btn btn-default btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Compartir" data-trigger="hover">
				      		<i class="fa fa-envelope-o" aria-hidden="true"></i>
				      	</button>-->
				    </div>
					<div class="container" style="margin-bottom: 10px;">
						<div class="row">
						      <div class="col-lg-1 col-md-2 col-sm-2 col-2 col-xl-1" style="padding:0px;">
						      	<div class="miniatura-usuario" style="margin: auto;background-image: url('<?php echo $rowNoticia["URL_FOTO_PERFIL"]; ?>');width: 40px;height: 40px;padding: 0px;">
				                		<?php
				                		if(is_null($rowNoticia["URL_FOTO_PERFIL"])){
				                			?>
				                				<table style="height: 100%;width: 100%;font-size: 20px;font-weight: bold;">
													<tbody>
														<tr>
															<td class="align-middle text-center">
																<?php echo utf8_encode($rowNoticia['INICIAL_USUARIO_PUBLICA']); ?>
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
										        	<?php echo utf8_encode($rowNoticia["USUARIO_PUBLICA"]);?>      	
										        </p> 
										        <p style="padding: 0px;margin:0px;"> 
										        	<span style="color: #09c;font-size: 12px;">
										        		<?php echo utf8_encode($rowNoticia["NOMBRE_REVISTA"]);?>
										        	</span> 								        	
										        </p> 
									        </td> 
								    	</tr>
							        </tbody>
						        </table>  
						      </div> 
						</div>
				   </div>  
				  <img class="card-img-top" src='<?php echo $rowNoticia["URL_PORTADA_NOTI"]; ?>' alt="Card image cap">
				  <div class="card-body" style="text-align: justify;">
				    <h5 class="card-title" style="text-align: left;"><?php echo utf8_encode($rowNoticia["TITULO_NOTICIA"]);?></h5>
				    <span class="noti-card-autor">
				    	<?php echo utf8_encode($rowNoticia["USUARIO_PUBLICA"])." · ".utf8_encode($rowNoticia["AUTOR_NOTICIA"]);?>
				    </span>
				    <p class="card-text">
				    	<?php echo utf8_encode($rowNoticia["DESCRIPCION_NOTICIA"]);?>
				    </p>
				    <p>
				    	<span style="color: gray;font-size: 12px;">
			        		<?php echo Tiempo::calcularTiempoTranscurrido($rowNoticia['FECHA_PUBLICACION']);?>
			        	</span> 
				    </p>
				    <p>
			        	<?php echo $rowNoticia["CANT_LIKES"];?>
			        	<i class="fa fa-heart" aria-hidden="true" style="font-size: 13px;padding-right: 8px;color: red;">
				        </i>
				        <?php echo $rowNoticia["CANT_COMENTARIOS"];?>
				        <i class="fa fa-comment-o" aria-hidden="true" style="font-size: 13px;padding-right: 8px;"></i>
			        	<a class="btn btn-default" role="button" style="cursor: pointer;">
				        	<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 13px;padding-right: 8px;">				        		
				        	</i>
				        	Añadir Comentario
			        	</a>
			        </p>
				  </div>
				</div>
			<?php 
			}
			?>

			
		  </div>

		<?php
		break;	
}
?>

<script src="js/tarjetasNoticias.js"></script>