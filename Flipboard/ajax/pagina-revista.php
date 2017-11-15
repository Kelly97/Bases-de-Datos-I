<?php
session_start();
include_once("../class/class-conexion.php");
include_once("../class/class-tiempo.php");
include_once("../class/class-date-interval.php");

$codigoRevista = $_POST['codigoRevista'];//Obtenemos el código por medio de la variable enviada en data
$conexion = new Conexion();
$codigoUsuario = $_SESSION['usuario']['CODIGO_USUARIO'];//sesion
$sql =  "
	SELECT UPPER(A.NOMBRE_REVISTA) NOMBRE_REVISTA, A.DESCRIPCION, A.FECHA_DE_CREACION, A.URL_PORTADA, B.NOMBRE_USUARIO, B.URL_FOTO_PERFIL, substr(B.NOMBRE_USUARIO,1,1) AS INICIAL, A.CODIGO_TIPO_REVISTA, A.CODIGO_USUARIO
	FROM TBL_REVISTAS A
	LEFT JOIN TBL_USUARIOS B
	ON (A.CODIGO_USUARIO = B.CODIGO_USUARIO)
	WHERE (A.CODIGO_REVISTA = $codigoRevista)
	";
$sql2 = "
	SELECT B.NOMBRE_USUARIO, B.URL_FOTO_PERFIL,  substr(B.NOMBRE_USUARIO,1,1) AS INICIAL, B.CODIGO_USUARIO as CODIGO_COLABORADOR
	FROM TBL_COLABORADORES A
	LEFT JOIN TBL_USUARIOS B
	ON (A.CODIGO_COLABORADOR = B.CODIGO_USUARIO)
	WHERE (A.CODIGO_REVISTA = $codigoRevista)
	";
$sql3 = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM ($sql2)";
$sql4 =  "
		SELECT ROWNUM AS NUM_FILA,A.CODIGO_FLIP, A.CODIGO_REVISTA_FLIP,A.FECHA_FLIP, A.CODIGO_USUARIO_FLIP, A.CODIGO_REVISTA_NOTICIA, A.CODIGO_NOTICIA, A.CODIGO_USUARIO_NOTICIA, A.AUTOR_NOTICIA, A.TITULO_NOTICIA, A.DESCRIPCION_NOTICIA, A.CONTENIDO_NOTICIA,A.FECHA_NOTICIA, A.URL_PORTADA_NOTI, NVL(B.CANT_LIKES, 0) CANT_LIKES_NOTICIA, NVL(C.CANT_LIKES, 0) CANT_LIKES_FLIP, NVL(D.CANT_COMENTARIOS, 0) CANT_COMENTARIOS_NOTCIA, NVL(E.CANT_COMENTARIOS,0) CANT_COMENTARIOS_FLIP, F.NOMBRE_USUARIO USUARIO_FLIP, G.NOMBRE_USUARIO USUARIO_NOTICIA, substr(F.NOMBRE_USUARIO,1,1) AS INICIAL_USUARIO_FLIP, substr(G.NOMBRE_USUARIO,1,1) AS INICIAL_USUARIO_NOTICIA, F.URL_FOTO_PERFIL URL_FOTO_PERFIL_FLIP, G.URL_FOTO_PERFIL URL_FOTO_PERFIL_NOTICIA
		FROM (
	        SELECT A.CODIGO_FLIP, A.CODIGO_REVISTA CODIGO_REVISTA_FLIP,TO_CHAR(A.FECHA,'YYYY-MM-DD HH24:MI:SS')  FECHA_FLIP, A.CODIGO_USUARIO_FLIP, B.CODIGO_REVISTA CODIGO_REVISTA_NOTICIA, B.CODIGO_NOTICIA, B.CODIGO_USUARIO CODIGO_USUARIO_NOTICIA,B.AUTOR_NOTICIA, B.TITULO_NOTICIA, B.DESCRIPCION_NOTICIA, B.CONTENIDO_NOTICIA,TO_CHAR(B.FECHA_PUBLICACION,'YYYY-MM-DD HH24:MI:SS')  FECHA_NOTICIA, B.URL_PORTADA_NOTI
	        FROM TBL_FLIPS A
	        RIGHT JOIN TBL_NOTICIAS B
	        ON A.CODIGO_NOTICIA = B.CODIGO_NOTICIA
	        WHERE A.CODIGO_REVISTA = $codigoRevista OR B.CODIGO_REVISTA = $codigoRevista
	        ) A
		LEFT JOIN (
	        SELECT CODIGO_NOTICIA, 
	        COUNT(DISTINCT CODIGO_USUARIO) AS CANT_LIKES
	        FROM TBL_REACCIONES_X_NOTICIAS
	        WHERE CODIGO_REACCION = 1
	        GROUP BY CODIGO_NOTICIA
	        ) B
		ON A.CODIGO_NOTICIA = B.CODIGO_NOTICIA
		LEFT JOIN(
	        SELECT CODIGO_FLIP, 
	        COUNT(DISTINCT CODIGO_USUARIO) AS CANT_LIKES
	        FROM TBL_REACCIONES_X_NOTICIAS
	        WHERE CODIGO_REACCION = 1
	        GROUP BY CODIGO_FLIP
	        ) C
		ON A.CODIGO_FLIP = C.CODIGO_FLIP
		LEFT JOIN (
	        SELECT CODIGO_NOTICIA, COUNT(CODIGO_COMENTARIO) AS CANT_COMENTARIOS
	        FROM TBL_COMENTARIOS
	        GROUP BY CODIGO_NOTICIA
	        ) D
		ON A.CODIGO_NOTICIA = D.CODIGO_NOTICIA
		LEFT JOIN (
	        SELECT CODIGO_FLIP, COUNT(CODIGO_COMENTARIO) AS CANT_COMENTARIOS
	        FROM TBL_COMENTARIOS
	        GROUP BY CODIGO_FLIP
	        ) E
		ON A.CODIGO_FLIP = E.CODIGO_FLIP
		LEFT JOIN TBL_USUARIOS F
		ON A.CODIGO_USUARIO_FLIP = F.CODIGO_USUARIO
		LEFT JOIN TBL_USUARIOS G
		ON A.CODIGO_USUARIO_NOTICIA = G.CODIGO_USUARIO
	";
$sql5 = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM ($sql4)";
$sql6 = "SELECT COUNT(1) AS CANT_REGS
		FROM TBL_REVISTAS_SEGUIDAS A
		WHERE A.CODIGO_REVISTA =". $codigoRevista ." AND A.CODIGO_SEGUIDOR = ".$codigoUsuario;
$resultado = $conexion->ejecutarInstruccion($sql);
$resultado2 = $conexion->ejecutarInstruccion($sql2);
$resultado3 = $conexion->ejecutarInstruccion($sql3);
$resultado6 = $conexion->ejecutarInstruccion($sql6);
$datosRevista = $conexion->obtenerArregloAsociativo($resultado);
$cantidadColaboradores = $conexion->obtenerArregloAsociativo($resultado3)['NUMBER_OF_ROWS'];
$seguir = $conexion->obtenerFila($resultado6)['CANT_REGS'];
?>
<!-- INICIA HEADER DE LA REVISTA -->
<div class="head-revista" style="margin: auto; background-image: url('<?php echo $datosRevista['URL_PORTADA']; ?>');width: 100%;height: 90%;padding: 0px;">
	<div class="head-revista" style="margin: auto; opacity:0.8;background-image: url();width: 100%;height: 100%;padding: 0px;"><!-- Este div tiene fondo negro con transparencia para asegurar que el texto e iconos dentro de el son siempre legible -->
		<table style="height: 100%;width: 100%;font-size: 20px;font-weight: bold;">
			<tbody>
				<tr>
					<td class="align-middle text-center">
					<h2><strong><?php echo ($datosRevista['NOMBRE_REVISTA']); ?></strong></h2>
						<?php
						if(!is_null($datosRevista['DESCRIPCION'])){
		        			?>
							<p><?php echo ($datosRevista['DESCRIPCION']); ?></p>
							<?php
	            		}
	            		?>	
					  	<button type="button" onclick="seguimientoRevista(<?php echo ($codigoRevista.", ".$seguir); ?>)" class="btn btn-default btn-seguir-revista" data-content="
					  	<?php
							if($seguir == 0){
								echo ("Seguir");
		            		}else{
		            			echo "Dejar de Seguir";
		            		}
		            	?>
					  	" data-trigger="hover">
					  		<?php
							if($seguir == 0){
								echo "Seguir";
		            		}else{
		            			?>
		            			<i class="fa fa-check" aria-hidden="true"></i>
		            			<?php
		            			echo " Siguiendo";
		            		}
		            		?>	
					  	</button>
					  	<button type="button" class="btn btn-default btn-seguir-revista" data-content="Añadir/Quitar a/de intereses.">
					  		<i class="fa fa-ellipsis-h" aria-hidden="true"></i>
					  	</button>
					</td>
				</tr>
				<tr>
				  <td class="align-middle text-center">
					<div class="row" style="margin: auto; width: <?php echo ($cantidadColaboradores+2)*40; ?>px;height: 50%;">
				  		<!--Miniatura de la imagen-->
		                	<div class="col miniatura-usuario"; onclick="cargarUsuario(<?php echo $datosRevista["CODIGO_USUARIO"]; ?>)"; style="margin: auto;background-image: url('<?php echo $datosRevista["URL_FOTO_PERFIL"]; ?>');width: 40px;height: 40px;padding: 0px;">
		                		<?php
		                		if(is_null($datosRevista["URL_FOTO_PERFIL"])){
		                			?>
		                				<table style="height: 100%;width: 100%;font-size: 20px;font-weight: bold;">
											<tbody>
												<tr>
													<td class="align-middle text-center">
														<?php echo ($datosRevista['INICIAL']); ?>
													</td>
												</tr>
											</tbody>
										</table>
		                			<?php
		                		}
		                		?>								
						    </div>
					    <!--FIN Miniatura de la imagen-->
				  		<?php
				  		$strAutores = $datosRevista['NOMBRE_USUARIO'];
				  		if($cantidadColaboradores > 0){
				  			for ($i=0; $i < $cantidadColaboradores; $i++) {
				  				$colaborador = $conexion->obtenerArregloAsociativo($resultado2);
				  				if ($cantidadColaboradores - $i > 1) {
				  					$strAutores = $strAutores . ', ' . $colaborador['NOMBRE_USUARIO'];
				  				}
				  				else
				  					$strAutores = $strAutores . ' y ' . $colaborador['NOMBRE_USUARIO'];
				  				?>
				  				<!--Miniatura de la imagen-->
				                	<div class="col miniatura-usuario"; onclick="cargarUsuario(<?php $colaborador['CODIGO_COLABORADOR']; ?>)"; style="margin: auto;background-image: url('<?php echo $colaborador["URL_FOTO_PERFIL"]; ?>');width: 40px;height: 40px;padding: 0px;">
				                		<?php
				                		if(is_null($colaborador["URL_FOTO_PERFIL"])){
				                			?>
				                				<table style="height: 100%;width: 100%;font-size: 20px;font-weight: bold;">
													<tbody>
														<tr>
															<td class="align-middle text-center">
																<?php echo ($colaborador['INICIAL']); ?>
															</td>
														</tr>
													</tbody>
												</table>
				                			<?php
				                		}
				                		?>								
								  </div>
							  <!--FIN Miniatura de la imagen-->
							  <?php
				  			}
	            		}
	            		?>
		            		<div class="col miniatura-usuario" style="margin: auto;width: 40px;height: 40px;padding: 0px;">
		                			<i class="fa fa-user-plus" aria-hidden="true"></i>						
						    </div>
				  	</div>
					<div style="margin: auto;height: 50%;">
				  		<t>Por <?php echo $strAutores; ?></t>
				  	</div>
				  </td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<!-- INICIA BARRA INFERIOR DEL HEADER -->
<?php
$resultado4 = $conexion->ejecutarInstruccion($sql4);
$resultado5 = $conexion->ejecutarInstruccion($sql5);
$cantidadNoticias = $conexion->obtenerArregloAsociativo($resultado5)['NUMBER_OF_ROWS'];
	if ($cantidadNoticias == 0) {
	?>	
		<div class="col" style="text-align: center; padding: 10px">
			SIN CONTENIDO
		</div>
	<?php } else {?>
		<div class="row" style="padding: 10px">
		  <div class="col" style="text-align: center; padding-left: 10px">
		    <?php if ($cantidadNoticias == 1) {
		    	echo $cantidadNoticias." Noticia";
		    } else {
		    	echo $cantidadNoticias." Noticias";
		    }?>
		  </div>
		  <div class="col" style="text-align: center">
		  	<?php
			if($datosRevista['CODIGO_TIPO_REVISTA'] == 2){//Si la revista es privada
    			?>
				<i class="fa fa-lock" aria-hidden="true"></i>
				<?php
    		}
    		?>	
		    BAJA PARA VER MAS
		    <i class="fa fa-chevron-down" aria-hidden="true"></i>
		  </div>
		  <div class="col" style="text-align: right">
		    <button type="button" class="btn btn-default btn-editar-revista" data-content="Editar" data-trigger="hover">Editar</button>
		  </div>
		</div>
	<?php } ?>
</div>
<!-- FINALIZA BARRA INFERIOR DEL HEADER -->
<!-- FINALIZA HEADER DE LA REVISTA -->
<!-- INICIA IMPRESION DE NOTICIAS DE LA REVISTA -->
<?php

while($rowNoticia = $conexion->obtenerArregloAsociativo($resultado4)){
	if (!is_null($rowNoticia["CODIGO_REVISTA_FLIP"]) && $rowNoticia["CODIGO_REVISTA_FLIP"] == $codigoRevista) {
		//if indica si es un flip que pertenece a la revista
		$sqlLikes="SELECT COUNT(1) AS CANT_REGISTROS
				FROM TBL_REACCIONES_X_NOTICIAS
				WHERE CODIGO_USUARIO=". $codigoUsuario."
				AND CODIGO_FLIP=".$rowNoticia['CODIGO_FLIP'];
		$resultadoLikes = $conexion->ejecutarInstruccion($sqlLikes);
		$resultCantR = $conexion->obtenerFila($resultadoLikes);
	?>
		<!-- Inicia impresion de un flip -->
		<div class="card noti-card 
				<?php   
					if($rowNoticia["CANT_LIKES_FLIP"]>3)
						{ echo 'noti-card-width-3 '; }
					elseif($rowNoticia["CANT_LIKES_FLIP"]>2)
						{echo 'noti-card-width-2';}    
				?>" 
			style="position: relative;">
			<div class="botones-noticia-general">
		      	<button onclick="flipear(<?php echo $rowNoticia['CODIGO_NOTICIA'];?>)" type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#md-flipear">
		      		<i class="fa fa-plus" aria-hidden="true"></i>
		      	</button><br>
		      	<button onclick="darLike(<?php echo $rowNoticia['CODIGO_FLIP'];?>)" type="button" class="btn btn-default btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Me gusta" data-trigger="hover">
		      		<i class="fa <?php 
		      					if($resultCantR['CANT_REGISTROS']==0){
		      						echo 'fa-heart-o';
		      					}else{
		      						echo 'fa-heart';
		      					} ?>
		      		" aria-hidden="true" id="<?php echo 'like_'.$rowNoticia['CODIGO_FLIP'];?>" style="<?php 
		      					if($resultCantR['CANT_REGITROS']!=0){
		      						echo 'color:rgb(200, 35, 51);';
		      					} ?>"></i>
		      	</button><br>
		      	<!--<button type="button" class="btn btn-default btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Compartir" data-trigger="hover">
		      		<i class="fa fa-envelope-o" aria-hidden="true"></i>
		      	</button>-->
		    </div>
			<div class="container" style="margin-bottom: 10px;">
				<div class="row">
				      <div class="col-lg-1 col-md-2 col-sm-2 col-2 col-xl-1" style="padding:0px;">
				      	<label>
				      		
						      		<a href="usuario.php?codigoUsuario=<?php echo $rowNoticia["CODIGO_USUARIO_FLIP"]; ?>">

					      	<div class="miniatura-usuario" onclick="cargarUsuario(<?php $rowNoticia["CODIGO_USUARIO_FLIP"]; ?>)"; style="margin: auto;background-image: url('<?php echo $rowNoticia["URL_FOTO_PERFIL_FLIP"]; ?>');width: 40px;height: 40px;padding: 0px;">
			                		<?php
			                		if(is_null($rowNoticia["URL_FOTO_PERFIL_FLIP"])){
			                			?>
			                				<table style="height: 100%;width: 100%;font-size: 20px;font-weight: bold;">
												<tbody>
													<tr>
														<td class="align-middle text-center">
															<?php echo ($rowNoticia['INICIAL_USUARIO_FLIP']); ?>
														</td>
													</tr>
												</tbody>
											</table>
			                			<?php
			                		}
			                		?>								
							</div>
							</a>
						</label>
				      </div>
					      
				      <div class="col-lg-11 col-md-10 col-sm-10 col-10 col-xl-11" >
				      	<table style="height: 100%;">
				      		<tbody>
				      			<tr>
							      	<td class="align-middle">
								        <p class="card-text" style="margin-bottom: -8px;">      
								        	<?php echo ($rowNoticia["USUARIO_FLIP"]);?>      	
								        </p> 
								        <p style="padding: 0px;margin:0px;"> 
								        	<span style="color: gray;font-size: 12px;">
								        		<?php echo fechaIntervalo::calcularintervalo($rowNoticia['FECHA_FLIP']);?>
								        	</span> 								        	
								        </p> 
							        </td> 
						    	</tr>
					        </tbody>
				        </table>  
				      </div> 
				</div>
		   </div>  
		  <img class="card-img-top" src='<?php echo $rowNoticia["URL_PORTADA_NOTI"]; ?>' style="cursor: pointer;" onclick="cargarContenidoNoticia(<?php echo ($rowNoticia['CODIGO_NOTICIA']);?>);" >
		  <div class="card-body" style="text-align: justify;">
		  	<div style="cursor: pointer;" onclick="cargarContenidoNoticia(<?php echo ($rowNoticia['CODIGO_FLIP']);?>);" >

		  		<a><h5 class="card-title" style="text-align: left;"><?php echo ($rowNoticia["TITULO_NOTICIA"]);?></h5></a>
			    <span class="noti-card-autor">
			    	<?php echo ($rowNoticia["USUARIO_FLIP"])." · ".($rowNoticia["AUTOR_NOTICIA"]);?>
			    </span>
			    <p class="card-text">
			    	<?php echo ($rowNoticia["DESCRIPCION_NOTICIA"]);?>
			    </p>
		  	</div>	<br>			    
		    <div>
	        	<span id="<?php echo 'likeContador_'.$rowNoticia['CODIGO_FLIP'];?>"><?php echo $rowNoticia["CANT_LIKES_FLIP"];?></span>
	        	<i class="fa fa-heart" aria-hidden="true" style="font-size: 13px;padding-right: 8px;color: red;">
		        </i>
		        <span id="<?php echo 'comentariosCont_'.$rowNoticia['CODIGO_FLIP'];?>"><?php echo $rowNoticia["CANT_COMENTARIOS_FLIP"];?></span>
		        <i class="fa fa-comment-o" aria-hidden="true" style="font-size: 13px;padding-right: 8px;" ></i>
	        	<a class="btn btn-default" role="button" style="cursor: pointer;" data-toggle="modal" data-target="#modal-agregar_comentario" onclick="cargar_modalComentarios(<?php echo $rowNoticia["CODIGO_FLIP"];?>);">
		        	<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 13px;padding-right: 8px;">				        		
				    </i>
		        	Añadir Comentario
	        	</a>
	        </div>
		  </div>
		</div>
		<!-- Finaliza impresion de un flip -->
	<?php
	$conexion->liberarResultado($resultadoCantRegis);
	}//fin if
	else{ 
		$sqlLikes="SELECT COUNT(1) AS CANT_REGISTROS
				FROM TBL_REACCIONES_X_NOTICIAS
				WHERE CODIGO_USUARIO=". $codigoUsuario."
				AND CODIGO_NOTICIA=".$rowNoticia['CODIGO_NOTICIA'];
		$resultadoCantRegis = $conexion->ejecutarInstruccion($sqlLikes);
		$resultCantR = $conexion->obtenerFila($resultadoCantRegis);
		?>
		<!-- Inicia impresion de una noticia -->
		<div class="card noti-card 
				<?php   
					if($rowNoticia["CANT_LIKES_NOTICIA"]>3)
						{ echo 'noti-card-width-3 '; }
					elseif($rowNoticia["CANT_LIKES_NOTICIA"]>2)
						{echo 'noti-card-width-2';}    
				?>" 
			style="position: relative;">
			<div class="botones-noticia-general">
		      	<button onclick="flipear(<?php echo $rowNoticia['CODIGO_NOTICIA'];?>)" type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#md-flipear">
		      		<i class="fa fa-plus" aria-hidden="true"></i>
		      	</button><br>
		      	<button onclick="darLike(<?php echo $rowNoticia['CODIGO_NOTICIA'];?>)" type="button" class="btn btn-default btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Me gusta" data-trigger="hover">
		      		<i class="fa <?php 
		      					if($resultCantR['CANT_REGISTROS']==0){
		      						echo 'fa-heart-o';
		      					}else{
		      						echo 'fa-heart';
		      					} ?>
		      		" aria-hidden="true" id="<?php echo 'like_'.$rowNoticia['CODIGO_NOTICIA'];?>" style="<?php 
		      					if($resultCantR['CANT_REGISTROS']!=0){
		      						echo 'color:rgb(200, 35, 51);';
		      					} ?>"></i>
		      	</button><br>
		      	<!--<button type="button" class="btn btn-default btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Compartir" data-trigger="hover">
		      		<i class="fa fa-envelope-o" aria-hidden="true"></i>
		      	</button>-->
		    </div>
			<div class="container" style="margin-bottom: 10px;">
				<div class="row">
				      <div class="col-lg-1 col-md-2 col-sm-2 col-2 col-xl-1" style="padding:0px;">

					      	<div class="miniatura-usuario" onclick="cargarUsuario(<?php $rowNoticia["CODIGO_USUARIO_NOTICIA"]; ?>)"; style="margin: auto;background-image: url('<?php echo $rowNoticia["URL_FOTO_PERFIL_NOTICIA"]; ?>');width: 40px;height: 40px;padding: 0px;">
			                		<?php
			                		if(is_null($rowNoticia["URL_FOTO_PERFIL_NOTICIA"])){
			                			?>
			                				<table style="height: 100%;width: 100%;font-size: 20px;font-weight: bold;">
												<tbody>
													<tr>
														<td class="align-middle text-center">
															<?php echo ($rowNoticia['INICIAL_USUARIO_NOTICIA']); ?>
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
								        	<?php echo ($rowNoticia["USUARIO_NOTICIA"]);?>      	
								        </p> 
								        <p style="padding: 0px;margin:0px;"> 
								        	<span style="color: gray;font-size: 12px;">
								        		<?php echo fechaIntervalo::calcularintervalo($rowNoticia['FECHA_NOTICIA']);?>
								        	</span> 								        	
								        </p> 
							        </td> 
						    	</tr>
					        </tbody>
				        </table>  
				      </div> 
				</div>
		   </div>  
		  <img class="card-img-top" src='<?php echo $rowNoticia["URL_PORTADA_NOTI"]; ?>' style="cursor: pointer;" onclick="cargarContenidoNoticia(<?php echo ($rowNoticia['CODIGO_NOTICIA']);?>);" >
		  <div class="card-body" style="text-align: justify;">
		  	<div style="cursor: pointer;" onclick="cargarContenidoNoticia(<?php echo ($rowNoticia['CODIGO_NOTICIA']);?>);" >

		  		<a><h5 class="card-title" style="text-align: left;"><?php echo ($rowNoticia["TITULO_NOTICIA"]);?></h5></a>
			    <span class="noti-card-autor">
			    	<?php echo ($rowNoticia["USUARIO_NOTICIA"])." · ".($rowNoticia["AUTOR_NOTICIA"]);?>
			    </span>
			    <p class="card-text">
			    	<?php echo ($rowNoticia["DESCRIPCION_NOTICIA"]);?>
			    </p>
		  	</div>	<br>			    
		    <div>
	        	<span id="<?php echo 'likeContador_'.$rowNoticia['CODIGO_NOTICIA'];?>"><?php echo $rowNoticia["CANT_LIKES_NOTICIA"];?></span>
	        	<i class="fa fa-heart" aria-hidden="true" style="font-size: 13px;padding-right: 8px;color: red;">
		        </i>
		        <span id="<?php echo 'comentariosCont_'.$rowNoticia['CODIGO_NOTICIA'];?>"><?php echo $rowNoticia["CANT_COMENTARIOS_NOTCIA"];?></span>
		        <i class="fa fa-comment-o" aria-hidden="true" style="font-size: 13px;padding-right: 8px;" ></i>
	        	<a class="btn btn-default" role="button" style="cursor: pointer;" data-toggle="modal" data-target="#modal-agregar_comentario" onclick="cargar_modalComentarios(<?php echo $rowNoticia["CODIGO_NOTICIA"];?>);">
		        	<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 13px;padding-right: 8px;">				        		
				    </i>
		        	Añadir Comentario
	        	</a>
	        </div>
		  </div>
		</div>
		<!-- Finaliza impresion de una noticia -->
	<?php 
	}//fin else
}//fin while
$conexion->liberarResultado($resultado);
$conexion->liberarResultado($resultado2);
$conexion->liberarResultado($resultado3);
$conexion->liberarResultado($resultado4);
$conexion->liberarResultado($resultado5);
$conexion->cerrarConexion();
?>
<!-- FINALIZA IMPRESION DE NOTICIAS DE LA REVISTA -->
