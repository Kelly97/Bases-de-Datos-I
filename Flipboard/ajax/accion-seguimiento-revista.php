<?php
session_start();
include_once("../class/class-conexion.php");
$conexion = new Conexion();

$codigoUsuario=$_SESSION['usuario']['CODIGO_USUARIO'];//sesion
$tipoOperacion = $_POST["tipoOperacion"]
$codigoRevista=$_POST["codigoRevista"];
$resultado = array();

	$conn = oci_connect('DB_FLIPBOARD', 'oracle', 'localhost/XE','AL32UTF8');
	if (!$conn) {
	    $e = oci_error();
	    exit;
	}		
	$sql="
		BEGIN
		    P_SEGUIMIENTO_REVISTA(
		    	:codigoUsuario,
		    	:codigoRevista,
		    	:tipoOperacion,
		    	:codigoResp,
		    );
		END;
			";
	$procedure = oci_parse($conn, $sql);
	oci_bind_by_name($procedure, ':codigoUsuario', $codigoUsuario);
	oci_bind_by_name($procedure, ':codigoRevista', $codigoRevista);
	oci_bind_by_name($procedure, ':tipoOperacion', $tipoOperacion);
	oci_bind_by_name($procedure, ':codigoResp', $resultado['codigoResp']);
	oci_execute($procedure);

	oci_free_statement($procedure);
	oci_close($conn);
$conexion->cerrarConexion();
?>