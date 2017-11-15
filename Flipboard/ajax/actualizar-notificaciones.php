<?php
session_start();
$codigoUsuario=$_SESSION['usuario']['CODIGO_USUARIO'];//sesion
include_once("../class/class-conexion.php");
$conexion = new Conexion();

switch ($_POST["codigo"]) {
		case '1'://notificacion de seguimiento
			$sqlUsuario = "
				SELECT A.CODIGO_USUARIO_EMISOR
				FROM TBL_NOTIFICACIONES A
				WHERE A.CODIGO_NOTIFICACION = ".$codigoNotificacion;
			$resultado = $conexion->ejecutarInstruccion($sql);
			$codigoUsuarioEmisor['codigoUsuarioEmisor'] = $conexion->obtenerFila($resultado)['CODIGO_USUARIO_EMISOR'];

			$codigoNotificacion=$_POST["codigoNotificacion"];
			$conn = oci_connect('DB_FLIPBOARD', 'oracle', 'localhost/XE','AL32UTF8');
			if (!$conn) {
			    $e = oci_error();
			    exit;
			}		
			$sql="
				BEGIN
				    P_ACTUALIZAR_NOTI(
				    	:codigoNotificacion
				    );
				END;
					";
			$procedure = oci_parse($conn, $sql);
			oci_bind_by_name($procedure, ':codigoNotificacion', $codigoNotificacion);
			oci_execute($procedure);

			oci_free_statement($procedure);
			oci_close($conn);
			echo json_encode($codigoUsuarioEmisor);
			break;
		case '2'://notificacion de comentario, reaccion a noticia y reaccion a comentario
			//todas redirigen a una noticia
			$sqlUsuario = "
				SELECT A.CODIGO_NOTICIA
				FROM TBL_NOTIFICACIONES A
				WHERE A.CODIGO_NOTIFICACION = ".$codigoNotificacion;
			$resultado = $conexion->ejecutarInstruccion($sql);
			$codigoNoticia['codigoNoticia'] = $conexion->obtenerFila($resultado)['CODIGO_NOTICIA'];

			$codigoNotificacion=$_POST["codigoNotificacion"];
			$conn = oci_connect('DB_FLIPBOARD', 'oracle', 'localhost/XE','AL32UTF8');
			if (!$conn) {
			    $e = oci_error();
			    exit;
			}		
			$sql="
				BEGIN
				    P_ACTUALIZAR_NOTI(
				    	:codigoNotificacion
				    );
				END;
					";
			$procedure = oci_parse($conn, $sql);
			oci_bind_by_name($procedure, ':codigoNotificacion', $codigoNotificacion);
			oci_execute($procedure);	

			oci_free_statement($procedure);
			oci_close($conn);
			echo json_encode($codigoNoticia);
		case '3'://notificacion de flip
			$sqlUsuario = "
				SELECT A.CODIGO_REVISTA
				FROM TBL_NOTIFICACIONES A
				WHERE A.CODIGO_NOTIFICACION = ".$codigoNotificacion;
			$resultado = $conexion->ejecutarInstruccion($sql);
			$codigoRevista['codigoRevista'] = $conexion->obtenerFila($resultado)['CODIGO_REVISTA'];

			$codigoNotificacion=$_POST["codigoNotificacion"];
			$conn = oci_connect('DB_FLIPBOARD', 'oracle', 'localhost/XE','AL32UTF8');
			if (!$conn) {
			    $e = oci_error();
			    exit;
			}		
			$sql="
				BEGIN
				    P_ACTUALIZAR_NOTI(
				    	:codigoNotificacion
				    );
				END;
					";
			$procedure = oci_parse($conn, $sql);
			oci_bind_by_name($procedure, ':codigoNotificacion', $codigoNotificacion);
			oci_execute($procedure);	

			oci_free_statement($procedure);
			oci_close($conn);
			echo json_encode($codigoRevista);
			break;
		

}
$conexion->cerrarConexion();
?>