<?php
	session_start();
	  if (!(isset($_SESSION['usuario']))) {
	  	header('Location: index.php');
	  }

	include_once("../class/class-conexion.php");
	$conexion = new Conexion();

	$sql="SELECT CODIGO_CATEGORIA,
		        CATEGORIA
		FROM TBL_CATEGORIA";
	$resultadoCategorias = $conexion->ejecutarInstruccion($sql);
	$resultado = array();

	switch ($_GET["accion"]) {
		case '1':
		?>
			<div  align="center" style="padding-top: 90px;">
			   	<div >     
			    	<div>  
			      		<strong style="cursor: pointer; font-size: 3rem;">CATEGORIAS</strong>
			     	</div><br><br>
			        <div>
			           	<hr><br><hr>
			           	<div class="container-fluid"> 
			             	<div id="div-contenidoPrincipal" style="align-items: center" class="col-lg-12" style="padding: 0px;">
			               	</div>    
			           	 </div>
			        </div>
			    </div>

				<div class="row  col-lg-9"> 	
	<?php 
			while ($rowCategorias = $conexion->obtenerFila($resultadoCategorias)) {
				$random_number = intval( "0" . rand(1,9) . rand(0,9) . rand(1,9) . rand(0,9) . rand(1,9) . rand(0,9) );
	?>
			    <div style="padding: 0px; margin: 30px 30px;width: 170px;">
			    	<div class="thumbnail" style="width: 170px;">
		            	<div class="container">
		              		<div>
               					<div class="image" style="margin: auto;background-color: #<?php echo $random_number?>;width: 170px;height: 250px;margin: 0px;padding: 0px;border-radius: 5px; object-fit: cover; ">

			                        <table style="height: 100%;width: 100%;font-size: 16px;color:white;font-weight: bold;">
			                         	<tbody>
			                          		<tr>
			                            		<td class="align-middle text-center">
			                              			<?php echo ($rowCategorias['CATEGORIA']); ?>
			                            		</td>
			                          		</tr>
			                        	</tbody> 
			                      	</table>

               		  			</div>
               		  			<div class="middle  center" style="width: 170px;">
							    	<i class="fa" style="color: white; cursor: pointer; " aria-hidden="true"><?php echo ($rowCategorias['CODIGO_CATEGORIA']); ?></i>
							    	<span></span>
							  	</div>
               		  		</div>
	                   		<button id="btn-eliminar" type="button" class="close" style="color: white;font-size: 30px;position: absolute;z-index: 30;left:95%;right: 0px;top: 0px;" onclick="eliminarCategoria(<?php echo ($rowCategorias['CODIGO_CATEGORIA']); ?>)" data-toggle="tooltip" data-placement="left" title="Eliminar Categoria">
			          			<span aria-hidden="true">&times;</span>
			          		</button>
						</div>
						<div class="container">
							<p></p>
						</div>
						
				 	</div>
				</div>
	<?php
				
			}
	?>
					<div style="padding: 0px; margin: 30px 30px;width: 170px;">
				    	<div class="thumbnail" style="width: 170px;">
			            	<div class="container">
               					<div class="image" style="margin: auto;background-color: #ccc;width: 170px;height: 250px;margin: 0px;padding: 0px;border-radius: 5px; object-fit: cover; ">

			                        <table style="height: 100%;width: 100%;font-size: 50px;color:white;font-weight: bold;">
			                         	<tbody>
			                          		<tr>
			                            		<td class="align-middle text-center">
			                              			<i class="fa fa-plus" id="i1" style="cursor: pointer;" title="Agregar Categoria" aria-hidden="true" data-toggle="modal" data-target="#modal-agregar_categoria"></i>
			                            		</td>
			                          		</tr>
			                        	</tbody> 
			                      	</table>

               		  			</div>
							</div>							
					 	</div>
					</div>
				</div>
			<br><hr><br>
		</div><!-- Fin div principal -->


		<!-- Modal agregar categoria -->
      <div class="modal fade" tabindex="-1" role="dialog" id="modal-agregar_categoria">
        <div class="modal-dialog" role="document">
          <div class="modal-content";>  
          <div class="modal-header" align="center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute;top: 5px;left: 10px;font-size: 35px;">
              <span aria-hidden="true">&times;</span>
            </button>
            <p style="text-align: center;"><h6 class="modal-title" style="margin-top: 10px;padding-left: 20px;padding-right: 20px;">Crear Categoria</h6> </p>  
          </div>
          <div class="modal-body">
            <input type="text" class="form-control" id="nombre_categoria" placeholder="Nombre Categoria (requerido)"><br>
            <div id="div_respuesta"></div><br>
            <button type="button" class="btn btn-primary" onclick="agregarCategoria();">Crear</button>
          </div><!--/.modal-body-->     
	
            
          </div>
         </div>
      </div>
      <!-- Fin Modal agregar categoria -->
<?php
			break;
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   
		# ELIMINAR CATEGORIA 
		case '2':
				$codigo_categoria = $_POST["codigoCategoria"];

				$sql="SELECT COUNT (1) AS CANT_NOTICIAS 
					FROM TBL_NOTICIAS
					WHERE CODIGO_CATEGORIA =".$codigo_categoria;
				$noticias_categoria = $conexion->ejecutarInstruccion($sql);
				$cant_noticias = $conexion->obtenerFila($noticias_categoria);
				if (($cant_noticias["CANT_NOTICIAS"])!=0) {
					$sql="DELETE FROM TBL_NOTICIAS
					WHERE CODIGO_CATEGORIA =".$codigo_categoria;
					$noticias_categoria = $conexion->ejecutarInstruccion($sql);
				}

				$sql="SELECT COUNT (1) AS CANT_USUARIOS
					FROM TBL_INTERESES_X_USUARIO
					WHERE CODIGO_CATEGORIA_INTERES=".$codigo_categoria;
				$usuarios_categoria = $conexion->ejecutarInstruccion($sql);
				$cant_usuarios = $conexion->obtenerFila($usuarios_categoria);
				if (($cant_usuarios["CANT_USUARIOS"])!=0) {
					$sql="DELETE FROM TBL_INTERESES_X_USUARIO
					WHERE CODIGO_CATEGORIA_INTERES =".$codigo_categoria;
					$usuarios_categoria = $conexion->ejecutarInstruccion($sql);
				}

				$sql="SELECT CODIGO_CATEGORIA,
        					CATEGORIA
					FROM TBL_CATEGORIA
					WHERE CODIGO_CATEGORIA=".$codigo_categoria;
				$resultadoCategoria = $conexion->ejecutarInstruccion($sql);
				if ($resultadoCategoria) {
					$sql="DELETE FROM TBL_CATEGORIA
					WHERE CODIGO_CATEGORIA =".$codigo_categoria;
					$resultadoCategoria = $conexion->ejecutarInstruccion($sql);
					if ($resultadoCategoria) {
						echo "Categoria eliminada con exito";
					}
				}				

			break;

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   
		#	AGREGAR CATEGORIAS
		case '3':
			$categoria = $_POST["categoria"];
			if ($categoria=="") {
				$resultado["codigo_resultado"]=0;
				$resultado["mensaje"]="Debe ingresar un nombre";
				echo json_encode($resultado);
				exit;
			}
			$sql="SELECT CODIGO_CATEGORIA,
				        CATEGORIA
				FROM TBL_CATEGORIA
				WHERE upper(CATEGORIA)=upper('".$categoria."')";
			$resultadoCategoria=$conexion->ejecutarInstruccion($sql);

			if ($rowCategorias = $conexion->obtenerFila($resultadoCategoria)) {
				$resultado["codigo_resultado"]=0;
				$resultado["mensaje"]="Ya existe una categoria con ese nombre";
				echo json_encode($resultado);
				exit;
			}

			$sql = "INSERT INTO TBL_CATEGORIA(
					    CODIGO_CATEGORIA,
					    CATEGORIA
					) VALUES (
					    TBL_CATEGORIA_CODIGO_CATEGORIA.NEXTVAL,
					    INITCAP(TRIM('".$categoria."'))
					)";
			$resultadoInsertar = $conexion->ejecutarInstruccion($sql);

			$resultado["codigo_resultado"]=1;
			$resultado["mensaje"]="Categoria ingresada con exito";
			echo json_encode($resultado);

			break;

		default:
			# code...
			break;
	}

?>
