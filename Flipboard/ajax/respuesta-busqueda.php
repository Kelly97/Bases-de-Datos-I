<?php
session_start();
if (isset($_SESSION['usuario'])) {
  $codigoUsuario = $_SESSION['usuario']['CODIGO_USUARIO'];
} else{
  header('Location: index.php');
}
sleep(1);
include_once("../class/class-conexion.php");
include_once("../class/class-date-interval.php");
$conexion = new Conexion();
$texto = $_POST["buscar"];
$contResult=0;
//echo $texto;
?>

<div id="contenedorRespuestaBusc" class="text-center" style="padding: 40px;">
	<br><br>
	<h2>
		Resultados para '<?php echo $texto; ?>'
	</h2>
	<h4>Resultados Noticias</h4><br>
	<div class="grid">
		<div class="notisizer"></div>
	<?php
		$sqlNoticias = "WITH 
						  TBL_CANT_LIKES AS(
						    SELECT CODIGO_NOTICIA, 
						    COUNT(DISTINCT CODIGO_USUARIO) AS CANT_LIKES
						    FROM TBL_REACCIONES_X_NOTICIAS
						    WHERE CODIGO_REACCION = 1
						    GROUP BY CODIGO_NOTICIA),
						  TBL_CANT_COMENT AS(
						    SELECT CODIGO_NOTICIA, COUNT(CODIGO_COMENTARIO) AS CANT_COMENTARIOS
						    FROM TBL_COMENTARIOS
						    GROUP BY CODIGO_NOTICIA)
						SELECT 
							  G.CATEGORIA,
						      D.CODIGO_USUARIO,
						      D.NOMBRE_USUARIO AS USUARIO_PUBLICA,
						      D.URL_FOTO_PERFIL,
						      substr(D.NOMBRE_USUARIO,1,1) AS INICIAL_USUARIO_PUBLICA,
						      UPPER(C.NOMBRE_REVISTA) AS NOMBRE_REVISTA,
						      C.CODIGO_REVISTA,
						      B.CODIGO_NOTICIA,
						      INITCAP(B.AUTOR_NOTICIA) AS AUTOR_NOTICIA,
						      B.TITULO_NOTICIA,
						      B.DESCRIPCION_NOTICIA,
						      B.URL_PORTADA_NOTI,
						      TO_CHAR(B.FECHA_PUBLICACION,'YYYY-MM-DD HH24:MI:SS') AS FECHA_PUBLICACION,
						      NVL(E.CANT_LIKES,0) AS CANT_LIKES,
						      NVL(F.CANT_COMENTARIOS,0) AS CANT_COMENTARIOS
						FROM TBL_NOTICIAS B
						LEFT JOIN TBL_REVISTAS C
						ON(C.CODIGO_REVISTA=B.CODIGO_REVISTA)
						LEFT JOIN TBL_USUARIOS D
						ON(D.CODIGO_USUARIO=C.CODIGO_USUARIO)	
						LEFT JOIN TBL_CANT_LIKES E
						ON(B.CODIGO_NOTICIA=E.CODIGO_NOTICIA)
						LEFT JOIN TBL_CANT_COMENT F
						ON(B.CODIGO_NOTICIA = F.CODIGO_NOTICIA)	
						LEFT JOIN TBL_CATEGORIA G
						ON(G.CODIGO_CATEGORIA=B.CODIGO_CATEGORIA)				
						WHERE D.CODIGO_ESTADO_USUARIO = 1
						  AND UPPER(B.TITULO_NOTICIA) LIKE UPPER('%". $texto ."%')
						ORDER BY FECHA_PUBLICACION DESC";
		$resultadosNoticias = $conexion->ejecutarInstruccion($sqlNoticias);
		while($rowNoticias = $conexion->obtenerFila($resultadosNoticias)){
			$contResult++;
			$sqlLikes="SELECT COUNT(1) AS CANT_REGITROS
				FROM TBL_REACCIONES_X_NOTICIAS
				WHERE CODIGO_USUARIO=".$codigoUsuario."
				AND CODIGO_NOTICIA=".$rowNoticias['CODIGO_NOTICIA'];
			$resultadoCantRegis = $conexion->ejecutarInstruccion($sqlLikes);
			$resultCantR = $conexion->obtenerFila($resultadoCantRegis);
		?>
			  
				<div class="card noti-card 
							<?php   
								if($rowNoticias["CANT_LIKES"]>3)
									{ echo 'noti-card-width-3 '; }
								elseif($rowNoticias["CANT_LIKES"]>2)
									{echo 'noti-card-width-2';}    
							?>" 
						style="position: relative;">
					<div class="botones-noticia-general">
				      	<button onclick="flipear(<?php echo $rowNoticias['CODIGO_NOTICIA'];?>)" type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#md-flipear">
				      		<i class="fa fa-plus" aria-hidden="true"></i>
				      	</button><br>
				      	<button onclick="darLike(<?php echo $rowNoticias['CODIGO_NOTICIA'];?>)" type="button" class="btn btn-default btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Me gusta" data-trigger="hover">
				      		<i class="fa <?php 
				      					if($resultCantR['CANT_REGITROS']==0){
				      						echo 'fa-heart-o';
				      					}else{
				      						echo 'fa-heart';
				      					} ?>
				      		" aria-hidden="true" id="<?php echo 'like_'.$rowNoticias['CODIGO_NOTICIA'];?>" style="<?php 
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
							      	<div class="miniatura-usuario" onclick="cargarUsuario(<?php echo $rowNoticias["CODIGO_USUARIO"]; ?>)" style="margin: auto;background-image: url('<?php echo $rowNoticias["URL_FOTO_PERFIL"]; ?>');width: 40px;height: 40px;padding: 0px;">
					                		<?php
					                		if(is_null($rowNoticias["URL_FOTO_PERFIL"])){
					                			?>
					                				<table style="height: 100%;width: 100%;font-size: 20px;font-weight: bold;">
														<tbody>
															<tr>
																<td class="align-middle text-center">
																	<?php echo ($rowNoticias['INICIAL_USUARIO_PUBLICA']); ?>
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
										        	<?php echo ($rowNoticias["USUARIO_PUBLICA"]);?>      	
										        </p> 
										        <p style="padding: 0px;margin:0px;"> 
										        	<span style="color: #09c;font-size: 12px;cursor: pointer;" onclick="cargarPaginaRevista(<?php echo $rowNoticias["CODIGO_REVISTA"];?>);">
										        		<?php echo ($rowNoticias["NOMBRE_REVISTA"]);?>
										        	</span> 
										        	<span style="color: gray;font-size: 12px;">
										        		<?php echo fechaIntervalo::calcularintervalo($rowNoticias['FECHA_PUBLICACION']);?>
										        	</span> 								        	
										        </p> 
									        </td> 
								    	</tr>
							        </tbody>
						        </table>  
						      </div> 
						</div>
				    </div>  
				    <img class="card-img-top" src='<?php echo $rowNoticias["URL_PORTADA_NOTI"]; ?>' style="cursor: pointer;" onclick="cargarContenidoNoticia(<?php   echo ($rowNoticias['CODIGO_NOTICIA']);?>);" >
				    <div class="card-body" style="text-align: justify;">
					  	<div style="cursor: pointer;" onclick="cargarContenidoNoticia(<?php echo ($rowNoticias['CODIGO_NOTICIA']);?>);" >

					  		<a><h5 class="card-title" style="text-align: left;"><?php echo ($rowNoticias["TITULO_NOTICIA"]);?></h5></a>
						    <span class="noti-card-autor">
						    	<?php echo ($rowNoticias["USUARIO_PUBLICA"])." · ".($rowNoticias["AUTOR_NOTICIA"]);?>
						    </span>
						    <p class="card-text">
						    	<?php echo ($rowNoticias["DESCRIPCION_NOTICIA"]);?>
						    </p>
					  	</div><br>			    
					    <div>
				        	<span id="<?php echo 'likeContador_'.$rowNoticias['CODIGO_NOTICIA'];?>"><?php echo $rowNoticias["CANT_LIKES"];?></span>
				        	<i class="fa fa-heart" aria-hidden="true" style="font-size: 13px;padding-right: 8px;color: red;">
					        </i>
					        <span id="<?php echo 'comentariosCont_'.$rowNoticias['CODIGO_NOTICIA'];?>"><?php echo $rowNoticias["CANT_COMENTARIOS"];?></span>
					        <i class="fa fa-comment-o" aria-hidden="true" style="font-size: 13px;padding-right: 8px;" ></i>
				        	<a class="btn btn-default" role="button" style="cursor: pointer;" data-toggle="modal" data-target="#modal-agregar_comentario" onclick="cargar_modalComentarios(<?php echo $rowNoticias["CODIGO_NOTICIA"];?>);">
					        	<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 13px;padding-right: 8px;">				        		
							    </i>
					        	Añadir Comentario
				        	</a>
				        </div>
				  	</div>
				</div>
		
		<?php
		}
	?>
	</div>
	<br><br><br>
	<br><h4>Revistas</h4><br>
	<div class="row" style="padding: 20px;">
	<?php
		$conexion->liberarResultado($resultadosNoticias);
		$sqlRevistas = "SELECT *
						  FROM TBL_REVISTAS
						WHERE UPPER(NOMBRE_REVISTA) LIKE UPPER('%". $texto ."%')";
		
		$resultadoRevistas = $conexion->ejecutarInstruccion($sqlRevistas);
		while($rowRevista = $conexion->obtenerFila($resultadoRevistas)){
			$contResult++;
		?>
			<div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12" style="margin-bottom: 1.5em;position: relative;">
				<div class="miniatura-revista" style="background-image: url('<?php echo $rowRevista["URL_PORTADA"];?>');margin: auto;filter:brightness(0.4);">	
				</div>	
				<div style="position: absolute;left: 0px;top: 0px;color: white;text-align: center;width: 100%;padding:13%; ">
					<h5 style="font-weight: lighter;"><?php echo $rowRevista["NOMBRE_REVISTA"]; ?></h5><br>
					<!--<p style="font-size: 13px;"><?php echo $rowRevista["DESCRIPCION"]; ?></p>-->
				</div>		
			</div>
		<?php
		}
	?>
	</div>

	<br><h4>Personas</h4><br>
	<div class="row">
		<?php
		$conexion->liberarResultado($resultadoRevistas);
		$sqlUsuarios = "SELECT A.CODIGO_USUARIO,
							   substr(A.NOMBRE_USUARIO,1,1) AS INICIAL,
						       A.NOMBRE_USUARIO,
						       A.CODIGO_ESTADO_USUARIO,
						       A.ALIAS_USUARIO,
						       A.URL_FOTO_PERFIL,
						       A.CODIGO_TIPO_USUARIO,
						       substr(A.DESCRIPCION,1,40) AS DESCRIPCION,
						       COUNT(*) AS CANTIDAD_REVISTAS
					    FROM TBL_USUARIOS A
						LEFT JOIN TBL_REVISTAS B
						    ON A.CODIGO_USUARIO = B.CODIGO_USUARIO
						WHERE UPPER(ALIAS_USUARIO) LIKE UPPER('%".$texto."%')
						AND A.CODIGO_TIPO_USUARIO!=3
						GROUP BY A.CODIGO_USUARIO,substr(A.NOMBRE_USUARIO,1,1), A.NOMBRE_USUARIO,A.CODIGO_ESTADO_USUARIO, A.ALIAS_USUARIO, A.URL_FOTO_PERFIL,A.CODIGO_TIPO_USUARIO, A.DESCRIPCION";

		$resultadoUsuarios = $conexion->ejecutarInstruccion($sqlUsuarios);

		while($rowUsuario = $conexion->obtenerFila($resultadoUsuarios)){
			$contResult++;
		?>
		<div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12" style="position: relative;margin-bottom: 1.5em;">
			<div class="miniatura-usuario" onclick="cargarUsuario(<?php echo $rowUsuario["CODIGO_USUARIO"]; ?>)" style="cursor: pointer; background-image: url('<?php echo $rowUsuario["URL_FOTO_PERFIL"]; ?>'); margin:auto;margin-bottom: 10px;">
				<?php
                  if(is_null($rowUsuario["URL_FOTO_PERFIL"])){
                    ?>
                      <table style="height: 100%;width: 100%;font-size: 40px;font-weight: bold;">
                        <tbody>
                          <tr>
                            <td class="align-middle text-center">
                              <?php echo ($rowUsuario['INICIAL']); ?>
                            </td>
                          </tr>
                        </tbody>
                      </table>   
                  <?php
                  }
                  ?>
			</div>
			<div style="line-height: 1;">
				<p style="font-size: 18px;">
					<?php echo ($rowUsuario['NOMBRE_USUARIO']); ?>
					<?php if($rowUsuario['CODIGO_ESTADO_USUARIO']==1){
						?>
							<i class="fa fa-check-circle" aria-hidden="true" style="color: #D11818;" data-toggle="popover"  data-content="Cuenta Verificada" data-trigger="hover"></i>
						<?php
					} ?>
				</p>
				<p style="color: gray;"><?php echo "@". $rowUsuario["ALIAS_USUARIO"] ." • ". $rowUsuario["CANTIDAD_REVISTAS"] ." revistas"; ?></p>
				<!--<span style="font-size: 13px;"><?php echo $rowUsuario["DESCRIPCION"]."..."; ?></span>-->
			</div>		
		</div>
		<?php 
		}
		?>
	</div>
</div>

<?php
	if($contResult==0){
		?>
			<div class="text-center" style="padding: 40px;">
				<br><br>
				<h2>
					Resultados para '<?php echo $texto; ?>'
				</h2><br><br>
				<i class="fa fa-frown-o" aria-hidden="true" style="font-size: 10em;color: #b7b5b5;font-weight: 100;"></i>
				<p style="color: #b7b5b5;font-size: 1.6em;font-weight: 100;">
					Lo sentimos, no pudimos encontrar la página que estabas buscando. Tal vez hayas escrito mal la dirección o la página haya sido movida.
				</p>
				<div id="contResult" style="display: none;"><?php echo $contResult; ?></div>
			</div>
		<?php
	}
?>

<script>
	if($("#contResult").html()=="0"){
		$("#contenedorRespuestaBusc").css("display","none");
	}
	isotopeNotiCard();
</script>