<?php
	switch($_POST["codigo"]){
		case '1':
			/*Agregar una revista*/
			include_once("../class/class-conexion.php");
			$conexion = new Conexion();
			$codigo_usuario = $_POST["codigo_usuario"];
			$nombre_revista = $_POST["nombre_revista"];
			$descripcion = $_POST["descripcion"];
			$codigo_tipo_revista = $_POST["codigo_tipo_revista"];
			$fecha_creacion = $_POST["fecha_creacion"];

			$sql = "INSERT INTO TBL_REVISTAS (CODIGO_USUARIO,
											  NOMBRE_REVISTA,
											  DESCRIPCION,
											  CODIGO_TIPO_REVISTA,
											  FECHA_DE_CREACION,
											  URL_PORTADA)
					VALUES (".$codigo_usuario.",
							".$nombre_revista.",
							".$descripcion.",
							".$codigo_tipo_revista.",
							TO_DATE(".$fecha_creacion.", 'YYYY-MM-DD'),
							'http://static.t13.cl/images/sizes/1200x675/1498132806-96591486gettyimages-503387922.jpg'
							)";

			$resultado = $conexion->ejecutarInstruccion($sql);
			$conexion->commit();
			echo $resultado;
			break;

		case '2':

			break;
	}
?>