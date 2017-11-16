<?php
session_start();
$codigoUsuario=$_SESSION['usuario']['CODIGO_USUARIO'];//sesion
include_once("../class/class-conexion.php");
$conexion = new Conexion();


switch ($_POST["codigo"]) {
		case '1'://evento Like
		$codColaborador=$_POST["codColaborador"];
		$codRevista=$_POST["codRevista"];
		$conn = oci_connect('DB_FLIPBOARD', 'oracle', 'localhost/XE','AL32UTF8');
		if (!$conn) {
		    $e = oci_error();
		    echo "Ups. Algo anda mal con el servidor.";
		    exit;
		}	
		$sql="
			BEGIN
			  P_ANIADIR_COLABORADOR
			  			(:codigoUsuario,
					    :codRevista,
			  			:codigoRespuesta,
			  			:mensajeRespuesta);
			END;
				";
		$procedure = oci_parse($conn, $sql);
		oci_bind_by_name($procedure, ':codigoUsuario', $codColaborador);
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