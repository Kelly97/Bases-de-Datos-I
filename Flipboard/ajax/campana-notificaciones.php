<?php
session_start();
$codigo_usuario = $_SESSION['usuario']['CODIGO_USUARIO'];//SESION
include_once("../class/class-conexion.php");
$conexion = new Conexion();
$sql =  "
	SELECT COUNT(1) AS CANT_NOTIFICACIONES
	FROM TBL_NOTIFICACIONES
	WHERE CODIGO_USUARIO_RECEPTOR = $codigo_usuario
	AND CODGIO_ESTADO_NOTIFICACION=2";
$resultado = $conexion->ejecutarInstruccion($sql);
$registro = $conexion->obtenerArregloAsociativo($resultado);
echo $registro['CANT_NOTIFICACIONES'];
$conexion->cerrarConexion();
?>