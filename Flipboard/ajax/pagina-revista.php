<?php
session_start();
include_once("../class/class-conexion.php");
include_once("../class/class-tiempo.php");

$codigoRevista = $_POST['codigoRevista'];//Obtenemos el código por medio de la variable enviada en data
$conexion = new Conexion();
$codigoUsuario = $_SESSION['usuario']['CODIGO_USUARIO'];//sesion
$sql =  "
	SELECT UPPER(A.NOMBRE_REVISTA) NOMBRE_REVISTA, A.DESCRIPCION, A.FECHA_DE_CREACION, A.URL_PORTADA, B.NOMBRE_USUARIO, B.URL_FOTO_PERFIL, substr(B.NOMBRE_USUARIO,1,1) AS INICIAL, A.CODIGO_TIPO_REVISTA
	FROM TBL_REVISTAS A
	LEFT JOIN TBL_USUARIOS B
	ON (A.CODIGO_USUARIO = B.CODIGO_USUARIO)
	WHERE (A.CODIGO_REVISTA = $codigoRevista)
	";
$sql2 = "
	SELECT B.NOMBRE_USUARIO, B.URL_FOTO_PERFIL,  substr(B.NOMBRE_USUARIO,1,1) AS INICIAL
	FROM TBL_COLABORADORES A
	LEFT JOIN TBL_USUARIOS B
	ON (A.CODIGO_COLABORADOR = B.CODIGO_USUARIO)
	WHERE (A.CODIGO_REVISTA = $codigoRevista)
	";
$sql3 = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM ($sql2)";
$resultado = $conexion->ejecutarInstruccion($sql);
$resultado2 = $conexion->ejecutarInstruccion($sql2);
$resultado3 = $conexion->ejecutarInstruccion($sql3);
$datosRevista = $conexion->obtenerArregloAsociativo($resultado);
$cantidadColaboradores = $conexion->obtenerArregloAsociativo($resultado3)['NUMBER_OF_ROWS'];
?>
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
					  	<button type="button" class="btn btn-default btn-seguir-revista" data-content="Seguir" data-trigger="hover">
					  		Seguir
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
	                	<div class="col miniatura-usuario" style="margin: auto;background-image: url('<?php echo $datosRevista["URL_FOTO_PERFIL"]; ?>');width: 40px;height: 40px;padding: 0px;">
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
			                	<div class="col miniatura-usuario" style="margin: auto;background-image: url('<?php echo $colaborador["URL_FOTO_PERFIL"]; ?>');width: 40px;height: 40px;padding: 0px;">
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
<?php
$sql4 =  "
	WITH CANTIDAD_LIKES AS(
        SELECT CODIGO_NOTICIA, 
        COUNT(DISTINCT CODIGO_USUARIO) AS CANT_LIKES
        FROM TBL_REACCIONES_X_NOTICIAS
        WHERE CODIGO_REACCION = 1
        GROUP BY CODIGO_NOTICIA
        ),
    CANTIDAD_LIKES_FLIP AS(
        SELECT CODIGO_FLIP, 
        COUNT(DISTINCT CODIGO_USUARIO) AS CANT_LIKES
        FROM TBL_REACCIONES_X_NOTICIAS
        WHERE CODIGO_REACCION = 1
        GROUP BY CODIGO_FLIP
        ),
    CANTIDAD_COMENTARIOS AS(
        SELECT CODIGO_NOTICIA, COUNT(CODIGO_COMENTARIO) AS CANT_COMENTARIOS
        FROM TBL_COMENTARIOS
        GROUP BY CODIGO_NOTICIA
        ),
    CANTIDAD_COMENTARIOS_FLIP AS(
        SELECT CODIGO_FLIP, COUNT(CODIGO_COMENTARIO) AS CANT_COMENTARIOS
        FROM TBL_COMENTARIOS
        GROUP BY CODIGO_FLIP
        ),
    NOTICIAS_FLIPS_REVISTA AS(
        SELECT A.CODIGO_FLIP, A.CODIGO_REVISTA CODIGO_REVISTA_FLIP, A.FECHA FECHA_FLIP, A.CODIGO_USUARIO_FLIP, B.CODIGO_REVISTA CODIGO_REVISTA_NOTICIA, B.CODIGO_NOTICIA, B.CODIGO_USUARIO CODIGO_USUARIO_NOTICIA,B.AUTOR_NOTICIA, B.TITULO_NOTICIA, B.DESCRIPCION_NOTICIA, B.CONTENIDO_NOTICIA, B.FECHA_PUBLICACION FECHA_NOTICIA, B.URL_PORTADA_NOTI
        FROM TBL_FLIPS A
        RIGHT JOIN TBL_NOTICIAS B
        ON A.CODIGO_NOTICIA = B.CODIGO_NOTICIA
        WHERE A.CODIGO_REVISTA = $codigoRevista OR B.CODIGO_REVISTA = $codigoRevista
    )
	SELECT ROWNUM NUM_FILA,A.*, B.CANT_LIKES CANT_LIKES_NOTICIA, C.CANT_LIKES CANT_LIKES_FLIP, D.CANT_COMENTARIOS CANT_COMENTARIOS_NOTCIA,
	    E.CANT_COMENTARIOS CANT_COMENTARIOS_FLIP, F.NOMBRE_USUARIO USUARIO_FLIP, G.NOMBRE_USUARIO USUARIO_NOTICIA,
	    substr(F.NOMBRE_USUARIO,1,1) AS INICIAL_USUARIO_FLIP, substr(G.NOMBRE_USUARIO,1,1) AS INICIAL_USUARIO_NOTICIA,
	    F.URL_FOTO_PERFIL URL_FOTO_PERFIL_FLIP, G.URL_FOTO_PERFIL URL_FOTO_PERFIL_NOTICIA, F.CODIGO_USUARIO CODIGO_USUARIO_FLIP,
	    G.CODIGO_USUARIO CODIGO_USUARIO_NOTICIA
	FROM NOTICIAS_FLIPS_REVISTA A
	LEFT JOIN CANTIDAD_LIKES B
	ON A.CODIGO_NOTICIA = B.CODIGO_NOTICIA
	LEFT JOIN CANTIDAD_LIKES_FLIP C
	ON A.CODIGO_FLIP = C.CODIGO_FLIP
	LEFT JOIN CANTIDAD_COMENTARIOS D
	ON A.CODIGO_NOTICIA = D.CODIGO_NOTICIA
	LEFT JOIN CANTIDAD_COMENTARIOS_FLIP E
	ON A.CODIGO_FLIP = E.CODIGO_FLIP
	LEFT JOIN TBL_USUARIOS F
	ON A.CODIGO_USUARIO_FLIP = F.CODIGO_USUARIO
	LEFT JOIN TBL_USUARIOS G
	ON A.CODIGO_USUARIO_NOTICIA = G.CODIGO_USUARIO
	";
$sql5 = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM ($sql4)";
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
		    	echo "$cantidadNoticias Noticia";
		    } else {
		    	echo "$cantidadNoticias Noticias";
		    }?>
		  </div>
		  <div class="col" style="text-align: center">
		  	<?php
			if($datosRevista['CODIGO_TIPO_REVISTA'] == 2){
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