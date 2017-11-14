<?php
session_start();
$codigoUsuario=$_SESSION['usuario']['CODIGO_USUARIO'];//sesion
include_once("../class/class-conexion.php");
$conexion = new Conexion();

switch ($_POST["codigo"]) {
		case '1'://evento Like
			$codigoNoticia=$_POST["codigoNoticia"];
			
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
			echo $mensajeRespuesta;
			oci_free_statement($procedure);
			oci_close($conn);
			break;
}
$conexion->cerrarConexion();
?>