<?php
	session_start();
	  if (!(isset($_SESSION['usuario']))) {
	  	header('Location: index.php');
	  }

	include_once("../class/class-conexion.php");
	$conexion = new Conexion();
	switch ($_GET["accion"]) {
		case '1':	
?>

	 <div  align="center" style="padding-top: 90px;">
	   <div >     
	     <div>  
	      	<strong style="cursor: pointer; font-size: 3rem;">USUARIOS</strong>
	     </div><br><br>
	        <div>
	           <!-- Tipo Usuario -->
	          <table class="menu-inferior" align="center">
	           	<tr>
	           		<td onclick="mostrarUsuario(2)" id="2">
	           		<div style="padding-right: 20px;">
		           		<p >Proveedor de Noticia</p>
	           	    </div>
	           		</td>
	           	    <td>
	           	   		<div id="vertical-bar"></div>
	           	    </td>
	           	    <td onclick="mostrarUsuario(1)" id="1">
		           		<div style="padding-right: 20px;">
			           		<p >Usuario Normal</p>
		           	    </div>
		           	</td>
	           	</tr>
	           </table>
	           <hr><br><hr>
	           <div class="container-fluid"> 
	             <div id="div-contenidoPrincipal" style="align-items: center" class="col-lg-11" style="padding: 0px;">
	               </div>    
	           	 </div>
	           </div><!-- Fin div tipo usuario -->
	      </div>
	</div><!-- Fin div principal -->
	
<?php
			break;

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   
//		USUARIOS VALIDADOS y NO VALIDADOS
		case '2':
			$codigo_tipo_usuario = $_POST["parametro"];
			$sql ="SELECT  CODIGO_USUARIO,
					       NOMBRE_USUARIO,
					       ALIAS_USUARIO,
					       CORREO,
					       URL_FOTO_PERFIL,
        				   substr(NOMBRE_USUARIO,1,1) AS INICIAL_USUARIO_PUBLICA,
        				   CODIGO_ESTADO_USUARIO
					FROM TBL_USUARIOS 
					WHERE CODIGO_TIPO_USUARIO = ".$codigo_tipo_usuario;
			$resultadoUsuario = $conexion->ejecutarInstruccion($sql);

	?>
		<div  align="center"> 
	<?php
		if ($codigo_tipo_usuario==2) {
	?>
		   	<div >  
			   	<strong style="cursor: pointer; font-size: 20px;">Usuarios Validados</strong>
			</div>
			<div class="row  col-lg-11"> 	
	<?php 
			while ($rowUsuarios = $conexion->obtenerFila($resultadoUsuario)) {	
				if ($rowUsuarios["CODIGO_ESTADO_USUARIO"]==1) { 	
	?>
			    <div class="row" style="padding: 0px; margin: 30px 20px;background-color: #fff; border:solid; border-radius: 5px; border-color: rgba(204,204,204,.7); width: 300px;">
			    	<div class="thumbnail" style="width: 300px;">
		            	<div class="container">
		              		<div>
               					<div class="miniatura-revista" style="margin: auto;background-image: url(<?php echo ($rowUsuarios['URL_FOTO_PERFIL']); ?>);width: 225px;height: 250px;margin-top: 10px;border-radius: 5px;">
    <?php
			                    if(is_null($rowUsuarios["URL_FOTO_PERFIL"])){
	?>  
			                        <table style="height: 100%;width: 100%;font-size: 60px;font-weight: bold;">
			                         	<tbody>
			                          		<tr>
			                            		<td class="align-middle text-center">
			                              			<?php echo ($rowUsuarios['INICIAL_USUARIO_PUBLICA']); ?>
			                            		</td>
			                          		</tr>
			                        	</tbody> 
			                      	</table>
	<?php
			                    }
	?> 
               		  			</div>
               		  		</div>
	                   		<button id="btn-eliminar" type="button" class="close" style="color: black;font-size: 30px;position: absolute;z-index: 30;right: 10px;top: 0px;" onclick="eliminarUsuario(<?php echo ($rowUsuarios['CODIGO_USUARIO']); ?> ,'<?php echo ($rowUsuarios['NOMBRE_USUARIO']); ?>')" data-toggle="tooltip" data-placement="left" title="Eliminar Usuario">
			          			<span aria-hidden="true">&times;</span>
			          		</button>
						</div>
						<div class="container">
							<p></p>
						</div>
						<div class="caption">
				        	<table style="width: 95%;">
				        		<tbody>
				        			<tr>
				        				<td style="font-size: 15px;padding-right: 10px;">Usuario:</td>
				        				<td style="font-size: 12px;"><?php echo ($rowUsuarios['ALIAS_USUARIO']); ?></td>
				        			</tr>
				        			<tr>
				        				<td style="font-size: 15px;padding-right: 10px;">Correo:</td>
				        				<td style="font-size: 12px;"><?php echo ($rowUsuarios['CORREO']); ?></td>
				        			</tr>
				        			<tr>
				        				<td style="font-size: 15px;padding-right: 10px;">Nombre:</td>
				        				<td style="font-size: 12px;"><?php echo ($rowUsuarios['NOMBRE_USUARIO']); ?></td>
				        			</tr>
				        		</tbody>
				        	</table><br>
			        		<p style="text-align: center;">
				        		<button class="btn btn-primary btn-lg" type="submit" style="font-size: 15px; background-color: #dbdbdb; color: #000;"  data-toggle="tooltip" data-placement="left" title="Descender a Normal" onclick="cambiarTipo_usuario(<?php echo ($rowUsuarios['CODIGO_USUARIO']); ?> , <?php echo $codigo_tipo_usuario ?>)">Normal</button>       	
				        	</p>
				      	</div>
				 	</div>
				</div>
	<?php
				}
			}
	?>
			</div>
			<br><hr><br>
	<?php
		}else {
	?>
		    <div >  
		      	<strong style="cursor: pointer; font-size: 20px;">Usuarios no validados</strong>
		     </div>
			 <div class="row  col-lg-11">		 	
	<?php 
			$resultadoUsuario = $conexion->ejecutarInstruccion($sql);
			while ($rowUsuarios = $conexion->obtenerFila($resultadoUsuario)) {	
				if ($rowUsuarios["CODIGO_ESTADO_USUARIO"]==2) { 		
	?>    
		    		<div class="row" style="padding: 0px; margin: 30px 20px;background-color: #fff; border:solid; border-radius: 5px; border-color: rgba(204,204,204,.7); width: 300px;">
				    	<div class="thumbnail" style="width: 300px;">
			            	<div class="container">
			              		<div>
	               					<div class="miniatura-revista" style="margin: auto;background-image: url(<?php echo ($rowUsuarios['URL_FOTO_PERFIL']); ?>);width: 225px;height: 250px;margin-top: 10px;border-radius: 5px;">
    <?php
			                    	if(is_null($rowUsuarios["URL_FOTO_PERFIL"])){
	?>  
				                        <table style="height: 100%;width: 100%;font-size: 60px;font-weight: bold;">
				                         	<tbody>
				                          		<tr>
				                            		<td class="align-middle text-center">
				                              			<?php echo ($rowUsuarios['INICIAL_USUARIO_PUBLICA']); ?>
				                            		</td>
				                          		</tr>
				                        	</tbody> 
				                      	</table>
	<?php
			                    }
	?> 
               		  				</div>
	               		  		</div>
		                   		<button id="btn-eliminar" type="button" class="close" style="color: black;font-size: 30px;position: absolute;z-index: 30;right: 10px;top: 0px;" onclick="eliminarUsuario(<?php echo ($rowUsuarios['CODIGO_USUARIO']); ?> , <?php echo $codigo_tipo_usuario ?>)" data-toggle="tooltip" data-placement="left" title="Eliminar Usuario">
			          			<span aria-hidden="true">&times;</span>
			          		</button>
							</div>
							<div class="container">
								<p></p>
							</div>
							<div class="caption">
					        	<table style="width: 95%;">
					        		<tbody>
					        			<tr>
					        				<td style="font-size: 15px;padding-right: 10px;">Usuario:</td>
					        				<td style="font-size: 12px;"><?php echo ($rowUsuarios['ALIAS_USUARIO']); ?></td>
					        			</tr>
					        			<tr>
					        				<td style="font-size: 15px;padding-right: 10px;">Correo:</td>
					        				<td style="font-size: 12px;"><?php echo ($rowUsuarios['CORREO']); ?></td>
					        			</tr>
					        			<tr>
					        				<td style="font-size: 15px;padding-right: 10px;">Nombre:</td>
					        				<td style="font-size: 12px;"><?php echo ($rowUsuarios['NOMBRE_USUARIO']); ?></td>
					        			</tr>
					        		</tbody>
					        	</table><br>
				        		<p style="text-align: center;">
					        		<button class="btn btn-primary btn-lg" type="submit" style="font-size: 15px; background-color: #dbdbdb; color: #000;"  data-toggle="tooltip" data-placement="left" title="Ascender a Proveedor" onclick="cambiarTipo_usuario(<?php echo ($rowUsuarios['CODIGO_USUARIO']); ?> ,<?php echo $codigo_tipo_usuario ?>)">Proveedor de Noticias</button>        	
					        	</p>
					      	</div>
					 	</div>
					</div>
	<?php
				}
			}
	?>
			</div>
			<br><hr><br>

	<?php
		}
	?>

			<div >  
		      	<strong style="cursor: pointer; font-size: 20px;">Usuarios eliminados</strong>
		    </div>
			<div class="row  col-lg-11">
			 	
	<?php 
			$resultadoUsuario = $conexion->ejecutarInstruccion($sql);
			while ($rowUsuarios = $conexion->obtenerFila($resultadoUsuario)) {	
				if ($rowUsuarios["CODIGO_ESTADO_USUARIO"]==3) {		
	?>
					<div class="row" style="padding: 0px; margin: 30px 20px;background-color: #fff; border:solid; border-radius: 5px; border-color: rgba(204,204,204,.7); width: 300px;">
				    	<div class="thumbnail" style="width: 300px;">
			            	<div class="container">
			              		<div>
	               					<div class="miniatura-revista" style="margin: auto;background-image: url(<?php echo ($rowUsuarios['URL_FOTO_PERFIL']); ?>);width: 225px;height: 250px;margin-top: 10px;border-radius: 5px;">
    <?php
			                    	if(is_null($rowUsuarios["URL_FOTO_PERFIL"])){
	?>  
				                        <table style="height: 100%;width: 100%;font-size: 60px;font-weight: bold;">
				                         	<tbody>
				                          		<tr>
				                            		<td class="align-middle text-center">
				                              			<?php echo ($rowUsuarios['INICIAL_USUARIO_PUBLICA']); ?>
				                            		</td>
				                          		</tr>
				                        	</tbody> 
				                      	</table>
	<?php
			                    }
	?> 
               		  				</div>
               		  				<button id="btn-eliminar" type="button" class="close" style="color: black;font-size: 20px;position: absolute;z-index: 30;right: 10px;top: 0px;" onclick="agregarUsuario(<?php echo ($rowUsuarios['CODIGO_USUARIO']); ?> ,<?php echo $codigo_tipo_usuario ?>)" data-toggle="tooltip" data-placement="left" title="Agregar Usuario">
					          			<span aria-hidden="true" class="fa fa-plus"></span>
					          		</button>
	               		  		</div>
							</div>
							<div class="container">
								<p></p>
							</div>
							<div class="caption">
					        	<table style="width: 95%;">
					        		<tbody>
					        			<tr>
					        				<td style="font-size: 15px;padding-right: 10px;">Usuario:</td>
					        				<td style="font-size: 12px;"><?php echo ($rowUsuarios['ALIAS_USUARIO']); ?></td>
					        			</tr>
					        			<tr>
					        				<td style="font-size: 15px;padding-right: 10px;">Correo:</td>
					        				<td style="font-size: 12px;"><?php echo ($rowUsuarios['CORREO']); ?></td>
					        			</tr>
					        			<tr>
					        				<td style="font-size: 15px;padding-right: 10px;">Nombre:</td>
					        				<td style="font-size: 12px;"><?php echo ($rowUsuarios['NOMBRE_USUARIO']); ?></td>
					        			</tr>
					        		</tbody>
					        	</table><br>
					      	</div>
					 	</div>
					</div>
	<?php
				}
			}
	?>
			</div>
			<br><hr><br>
		</div><!-- align="center" -->
	<?php 	 	
			
			break;

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   
		#  CAMBIAR TIPO USUARIO
		case '3':
			$codigoUsuario = $_POST['codigoUsuario'];
			$codigo_tipo_usuario = $_POST["codigoTipo_Usuario"];
			if ($codigo_tipo_usuario == 2) {
				$codigoTipo_Usuario = $codigo_tipo_usuario-1;
				$codigoEstado_Usuario = 2;
			}else{
				$codigoTipo_Usuario = $codigo_tipo_usuario+1;
				$codigoEstado_Usuario = 1;
			}

			$sql = "UPDATE tbl_usuarios
		            SET CODIGO_ESTADO_USUARIO= ".$codigoEstado_Usuario.",  
		          		codigo_tipo_usuario=".$codigoTipo_Usuario."
				    WHERE codigo_usuario= ".$codigoUsuario;
			$resultadoUsuario=$conexion->ejecutarInstruccion($sql);
			$conexion->cerrarConexion(); 

			break;
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   
		#	ELIMINAR USUARIO
		case '4':
			$codigoUsuario = $_POST["codigoUsuario"];
			$sql = "UPDATE tbl_usuarios
		          SET CODIGO_ESTADO_USUARIO= 3
				  WHERE codigo_usuario= ".$codigoUsuario;
			$resultadoUsuario=$conexion->ejecutarInstruccion($sql);
			$conexion->cerrarConexion(); 
			break;
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   
		#	QUITAR DE ELIMINADOS
		case '5':
			$codigoUsuario = $_POST['codigoUsuario'];
			$codigoTipo_Usuario = $_POST["codigoTipo_Usuario"];

			if ($codigoTipo_Usuario == 2) {
				$codigoEstado_Usuario = 1;
			}else{
				$codigoEstado_Usuario = 2;
			}

			$sql = "UPDATE tbl_usuarios
		          SET CODIGO_ESTADO_USUARIO= ".$codigoEstado_Usuario.",
		          	  codigo_tipo_usuario= ".$codigoTipo_Usuario."
				  WHERE codigo_usuario= ".$codigoUsuario;
			$resultadoUsuario=$conexion->ejecutarInstruccion($sql);
			$conexion->cerrarConexion(); 
			break;

		default:
			# code...
			break;
	}
	$conexion->cerrarConexion();
?>