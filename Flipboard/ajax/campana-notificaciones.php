<?php
$codigo_usuario=1;//SESION
include_once("../class/class-conexion.php");
$conexion = new Conexion();
$sql =  '
	SELECT COUNT(1) AS CANT_NOTIFICACIONES
	FROM TBL_NOTIFICACIONES
	WHERE CODIGO_USUARIO_RECEPTOR = '.$codigo_usuario;
$resultado = $conexion->ejecutarInstruccion($sql);
$registro = $conexion->obtenerArregloAsociativo($resultado);
echo $registro['CANT_NOTIFICACIONES'];
?>