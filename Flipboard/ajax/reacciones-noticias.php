<?php
session_start();
$codigoUsuario=$_SESSION['usuario']['CODIGO_USUARIO'];//sesion
include_once("../class/class-conexion.php");
$conexion = new Conexion();

switch ($_POST["codigo"]) {
		case '1'://evento Like
			$codigoNoticia=$_POST["codigoNoticia"];
			$sqlNoticia = " SELECT
							    CODIGO_USUARIO,
							    CODIGO_REVISTA
							FROM TBL_NOTICIAS
							WHERE CODIGO_NOTICIA = ".$codigoNoticia;
			$resultadoNoticia = $conexion->ejecutarInstruccion($sqlNoticia);	
			$filaNoticia = $conexion->obtenerFila($resultadoNoticia);		
			
			$conn = oci_connect('DB_FLIPBOARD', 'oracle', 'localhost/XE','AL32UTF8');
			if (!$conn) {
			    $e = oci_error();
			    echo "Ups. Algo anda mal con el servidor.";
			    exit;
			}		
			$sql="
				BEGIN
				    P_LIKE(
				        :codigoNoticia,
						:codigoUsuario,
				        :codigoResultado,
				        :mensajeResultado
				    );
				END;
					";
			$procedure = oci_parse($conn, $sql);
			oci_bind_by_name($procedure, ':codigoNoticia', $codigoNoticia);//las variables de entrada, deben de haber sido declaradas previamente (in)
			oci_bind_by_name($procedure, ':codigoUsuario', $codigoUsuario);//(in)
			oci_bind_by_name($procedure, ':codigoResultado', $codigoRespuesta , 40);//No es necesario declarar previamente las variables de salida (out)
			oci_bind_by_name($procedure, ':mensajeResultado', $mensajeRespuesta , 200);//(out)
			oci_execute($procedure);			
			$resultado['codigoResp'] = $codigoRespuesta;
			$resultado['mensajeResp'] = $mensajeRespuesta;	
			$resultado['codigoNoticia'] = $codigoNoticia;	
			//Validando la creación de una nueva notificación al dar like en una noticia
			$codigoUsuarioReceptor = $filaNoticia["CODIGO_USUARIO"];
			$codigoRevista = $filaNoticia["CODIGO_REVISTA"];
			$tipoNotificacion=3;//3->Reacción Noticia (like)
			$codigoReaccion=1;//1->Like
			if($codigoRespuesta==1){
				$sqlNotificacion="BEGIN
									  P_CREAR_NOTIFICACION(
									  	:codigo_tipo_notificacion,
								        :codigo_usuario_receptor,
								        :codigo_usuario_emisor,
								        :codigo_revista,
								        :codigo_noticia,
								        :codigo_reaccion,
								        :codigoResultado2,
				        				:mensajeResultado2				
									  );
									END;";
				$procedureNoti = oci_parse($conn, $sqlNotificacion);
				oci_bind_by_name($procedureNoti, ':codigo_tipo_notificacion', $tipoNotificacion);
				oci_bind_by_name($procedureNoti, ':codigo_usuario_receptor', $codigoUsuarioReceptor);
				oci_bind_by_name($procedureNoti, ':codigo_usuario_emisor', $codigoUsuario);
				oci_bind_by_name($procedureNoti, ':codigo_revista', $codigoRevista);
				oci_bind_by_name($procedureNoti, ':codigo_noticia', $codigoNoticia);
				oci_bind_by_name($procedureNoti, ':codigo_reaccion', $codigoReaccion);
				oci_bind_by_name($procedureNoti, ':codigoResultado2', $codigoRespuesta2 , 5);
				oci_bind_by_name($procedureNoti, ':mensajeResultado2', $mensajeRespuesta2 , 200);
				oci_execute($procedureNoti);
				oci_free_statement($procedureNoti);	
			}else{
				$sqlNotificacion="BEGIN
									  P_ELIMINAR_NOTIFICACION(
									  	:codigo_tipo_notificacion,
								        :codigo_usuario_receptor,
								        :codigo_usuario_emisor,
								        :codigo_revista,
								        :codigo_noticia,
								        :codigo_reaccion,
								        :codigoResultado2,
				        				:mensajeResultado2				
									  );
									END;";
				$procedureNoti = oci_parse($conn, $sqlNotificacion);
				oci_bind_by_name($procedureNoti, ':codigo_tipo_notificacion', $tipoNotificacion);
				oci_bind_by_name($procedureNoti, ':codigo_usuario_receptor', $codigoUsuarioReceptor);
				oci_bind_by_name($procedureNoti, ':codigo_usuario_emisor', $codigoUsuario);
				oci_bind_by_name($procedureNoti, ':codigo_revista', $codigoRevista);
				oci_bind_by_name($procedureNoti, ':codigo_noticia', $codigoNoticia);
				oci_bind_by_name($procedureNoti, ':codigo_reaccion', $codigoReaccion);
				oci_bind_by_name($procedureNoti, ':codigoResultado2', $codigoRespuesta2 , 5);
				oci_bind_by_name($procedureNoti, ':mensajeResultado2', $mensajeRespuesta2 , 200);
				oci_execute($procedureNoti);
				oci_free_statement($procedureNoti);	
			}	
			oci_free_statement($procedure);
			oci_close($conn);
			echo json_encode($resultado);
			break;
		
		case '2'://Evento flipear
			$conn = oci_connect('DB_FLIPBOARD', 'oracle', 'localhost/XE','AL32UTF8');
			if (!$conn) {
			    $e = oci_error();
			    echo "Ups. Algo anda mal con el servidor.";
			    exit;
			}
			$codRevista=$_POST["codRevista"];
			$codNoticia=$_POST["codNoticia"];	
			
			$sqlNoticia = " SELECT
							    CODIGO_USUARIO
							FROM TBL_NOTICIAS
							WHERE CODIGO_NOTICIA = ".$codNoticia;
			$resultadoNoticia = $conexion->ejecutarInstruccion($sqlNoticia);	
			$filaNoticia = $conexion->obtenerFila($resultadoNoticia);	

			$sql="
				BEGIN
				  P_FLIPEAR(:codNoticia,
						    :codigoUsuario,
						    :codRevista,
				  			:codigoRespuesta,
				  			:mensajeRespuesta);
				END;
					";
			$procedure = oci_parse($conn, $sql);
			oci_bind_by_name($procedure, ':codNoticia', $codNoticia);//las variables de entrada, deben de haber sido declaradas previamente (in)
			oci_bind_by_name($procedure, ':codigoUsuario', $codigoUsuario);
			oci_bind_by_name($procedure, ':codRevista', $codRevista);
			oci_bind_by_name($procedure, ':codigoRespuesta', $codigoRespuesta,5);//No se deben declarar previamente las variables de salida (out)
			oci_bind_by_name($procedure, ':mensajeRespuesta', $mensajeRespuesta,200);
			oci_execute($procedure);
			$codigoUsuarioReceptor = $filaNoticia["CODIGO_USUARIO"];
			$tipoNotificacion = 5;//3->Flip
			$codigoReaccion = NULL;//
			if($codigoRespuesta == 1){
				$sqlNotificacion = "BEGIN
									  P_CREAR_NOTIFICACION(
									  	:codigo_tipo_notificacion,
								        :codigo_usuario_receptor,
								        :codigo_usuario_emisor,
								        :codigo_revista,
								        :codigo_noticia,
								        :codigo_reaccion,
								        :codigoResultado2,
				        				:mensajeResultado2				
									  );
									END;";
				$procedureNoti = oci_parse($conn, $sqlNotificacion);
				oci_bind_by_name($procedureNoti, ':codigo_tipo_notificacion', $tipoNotificacion);
				oci_bind_by_name($procedureNoti, ':codigo_usuario_receptor', $codigoUsuarioReceptor);
				oci_bind_by_name($procedureNoti, ':codigo_usuario_emisor', $codigoUsuario);
				oci_bind_by_name($procedureNoti, ':codigo_revista', $codRevista);
				oci_bind_by_name($procedureNoti, ':codigo_noticia', $codNoticia);
				oci_bind_by_name($procedureNoti, ':codigo_reaccion', $codigoReaccion);
				oci_bind_by_name($procedureNoti, ':codigoResultado2', $codigoRespuesta2 , 5);
				oci_bind_by_name($procedureNoti, ':mensajeResultado2', $mensajeRespuesta2 , 200);
				oci_execute($procedureNoti);
				oci_free_statement($procedureNoti);	
			}
			echo $mensajeRespuesta;
			oci_free_statement($procedure);
			oci_close($conn);
			break;
}
$conexion->cerrarConexion();
?>