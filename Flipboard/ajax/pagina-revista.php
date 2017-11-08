<?php
include_once("../class/class-conexion.php");
include_once("../class/class-tiempo.php");

$codigoRevista = $_POST['codigoRevista'];//Obtenemos el código por medio de la variable enviada en data
$conexion = new Conexion();
$codigoUsuario = 1;//sesion
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
					<td>
				  	<div class="row" style="width: <?php echo ($cantidadColaboradores+2)*45; ?>px;height: 100%;">
				  		<!--Miniatura de la imagen-->
	                	<div class="miniatura-usuario" style="margin: auto;background-image: url('<?php echo $datosRevista["URL_FOTO_PERFIL"]; ?>');width: 40px;height: 40px;padding: 0px;">
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
			                	<div class="miniatura-usuario" style="margin: auto;background-image: url('<?php echo $colaborador["URL_FOTO_PERFIL"]; ?>');width: 40px;height: 40px;padding: 0px;">
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
				  		<button type="button" class="btn btn-default btn-circle-revista" >
				  			<i class="fa fa-user-plus fa-2x" aria-hidden="true"></i>
				  		</button>
				  	</div>
				  	
				  	<div>
				  		<t>Por <?php echo $strAutores; ?></t>
				  	</div>
				  </td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

		<div class="col" style="text-align: center; padding: 10px">
			SIN CONTENIDO
		</div>

		<div class="row">
		  <div class="col" style="text-align: center; padding: 10px">
		    # Noticias
		  </div>
		  <div class="col" style="text-align: center; padding: 10px">
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
		  <div class="col" style="text-align: center; padding: 10px">
		    Botones
		  </div>
		</div>
</div>