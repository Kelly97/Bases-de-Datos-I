<?php
$codigoUsuario=1;//sesion
include_once("../class/class-conexion.php");
$conexion = new Conexion();

switch ($_POST["codigo"]) {
		case '1'://evento Like
			$codigoNoticia=$_POST["codigoNoticia"];
			$sql="SELECT CODIGO_NOTICIA
				FROM TBL_REACCIONES_X_NOTICIAS
				WHERE CODIGO_USUARIO=".$codigoUsuario."
				AND CODIGO_NOTICIA=".$codigoNoticia;
			$respuesta=$conexion->ejecutarInstruccion($sql);
			$row = $conexion->obtenerFila($respuesta);
			if($row["CODIGO_NOTICIA"]==""){
				$sql1 = "INSERT INTO TBL_REACCIONES_X_NOTICIAS (
						    CODIGO_NOTICIA,
						    CODIGO_USUARIO,
						    CODIGO_REACCION
						) VALUES (
						    ".$codigoNoticia.",
						    ".$codigoUsuario.",
						    1
						)";
				$conexion->ejecutarInstruccion($sql1);
				$conexion->commit();
				echo "Has indicado que te gusta una noticia";
			}else{
				$sql2="DELETE FROM TBL_REACCIONES_X_NOTICIAS 
						WHERE CODIGO_NOTICIA =".$codigoNoticia."
						AND CODIGO_USUARIO =".$codigoUsuario."
						AND CODIGO_REACCION =1";
				$conexion->ejecutarInstruccion($sql2);
				$conexion->commit();
				echo "Has indicado que ya no te gusta una noticia";
			}
					
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