<?php 
	switch ($_GET["accion"]) {
		case '1':
			//Obtener Usuario
			include_once("../class/class-conexion.php");
			$conexion = new Conexion();
			$codigo_usuario = $_POST["codigo_usuario"];

			$sql = "SELECT A.CODIGO_USUARIO,
						   A.NOMBRE_USUARIO,
				           A.ALIAS_USUARIO,
				           A.URL_FOTO_PERFIL,
				           A.DESCRIPCION,
				           A.CODIGO_ESTADO_USUARIO,
				           B.TIPO_USUARIO
				      FROM TBL_USUARIOS A
				    LEFT JOIN TBL_TIPOS_USUARIO B
				        ON A.CODIGO_TIPO_USUARIO = B.CODIGO_TIPO_USUARIO
				    WHERE A.CODIGO_USUARIO = $codigo_usuario";

			$resultadoUsuario = $conexion->ejecutarInstruccion($sql);
			$resultado = "";
			while($rowUsuario = $conexion->obtenerFila($resultadoUsuario)){
				if($rowUsuario["CODIGO_ESTADO_USUARIO"] == 1){
					$resultado = '<div id="div-usuario" style="text-align: center">
									  <div id="fotoPerfil" style="text-align: center">
										<div class="miniatura-usuario" style="background-image: url('.$rowUsuario["URL_FOTO_PERFIL"].'); margin:auto;margin-bottom: 10px;">
								      	</div>
									  </div>

									  <div id="nombreUsuario" style="margin:auto;margin-bottom: 10px;">
									  	<span>
										  	<h1>
										  		<strong>'. $rowUsuario["NOMBRE_USUARIO"] .' | '. $rowUsuario["ALIAS_USUARIO"] .'</strong>
										  		<i class="fa fa-check-circle" aria-hidden="true" style="color: #D11818;" data-toggle="popover"  data-content="Cuenta Verificada" data-trigger="hover"></i>
										  	</h1>
									  	</span>
									  </div>

									  <div id="descripcion" style="margin:auto;margin-bottom: 10px;">
									  	<p>'. $rowUsuario["DESCRIPCION"] .'</p>
									  </div>

									  <input id="btn-seguir-usuario" type="button" class="btn" style="border-color: rgb(0,0,0); background-color: rgba(255,255,255,0.5);" onclick="seguirUsuario('.$rowUsuario["CODIGO_USUARIO"].',\''.$rowUsuario["ALIAS_USUARIO"].'\');" value="SEGUIR")>
								  </div>';
				} else{
					$resultado = '<div id="div-usuario" style="text-align: center">
								  <div id="fotoPerfil">
									<div class="miniatura-usuario" style="background-image: url('.$rowUsuario["URL_FOTO_PERFIL"].'); margin:auto;margin-bottom: 10px;">
							      	</div>
								  </div>

								  <div id="nombreUsuario" style="margin:auto;margin-bottom: 10px;">
								  	<span><h1><strong>'. $rowUsuario["NOMBRE_USUARIO"] .' | '. $rowUsuario["ALIAS_USUARIO"] .' | '.'</strong></h1></span>
								  </div>

								  <div id="descripcion" style="margin:auto;margin-bottom: 10px;">
								  	<p>'. $rowUsuario["DESCRIPCION"] .'</p>
								  </div>

								  <input id="btn-seguir-usuario" type="button" class="btn" style="border-color: rgb(0,0,0); background-color: rgba(255,255,255,0.5);" onclick="seguirUsuario('.$rowUsuario["CODIGO_USUARIO"].',\''.$rowUsuario["ALIAS_USUARIO"].'\');" value="SEGUIR")>
							  </div>';
				}
			}
			
			echo $resultado;
			break;

		case '2':
			//Seguir Usuario
			$conn = oci_connect('DB_FLIPBOARD', 'oracle', 'localhost/XE','AL32UTF8');
			if (!$conn) {
			    $e = oci_error();
			    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}

			$codigo_usuario = $_POST["codigo_usuario"];
			$codigo_seguidor = $_POST["codigo_seguidor"];
			$operacion = 1;
			$resultado = 0;

			$sql = "BEGIN
						P_SEGUIR_USUARIO(:p_USUARIO_SEGUIDOR,
						                 :p_USUARIO_SEGUIDO,
						                 :p_OPERACION,
						             	 :p_RESULTADO);
					END;";

			$procedure = oci_parse($conn, $sql);
			oci_bind_by_name($procedure, ':p_USUARIO_SEGUIDOR', $codigo_seguidor);
			oci_bind_by_name($procedure, ':p_USUARIO_SEGUIDO', $codigo_usuario);
			oci_bind_by_name($procedure, ':p_OPERACION', $operacion);
			oci_bind_by_name($procedure, ':p_RESULTADO', $resultado);
			oci_execute($procedure);
			echo $resultado;
			oci_free_statement($procedure);
			oci_close($conn);
			break;
		
		default:
			# code...
			break;
	}
?>