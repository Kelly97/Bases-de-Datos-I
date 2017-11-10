<?php
	switch($_POST["codigo"]){
		case '1':
			/*Agregar una revista*/
			$conn = oci_connect('DB_FLIPBOARD', 'oracle', 'localhost/XE','AL32UTF8');
			if (!$conn) {
			    $e = oci_error();
			    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}

			$codigo_usuario = $_POST["codigo_usuario"];
			$nombre_revista = $_POST["nombre_revista"];
			$descripcion = $_POST["descripcion"];
			$codigo_tipo_revista = $_POST["codigo_tipo_revista"];
			$resultado = 0;

			$sql="
			  	BEGIN
					P_INSERTAR_REVISTA(:p_CODIGO_USUARIO,
						               :p_NOMBRE_REVISTA,
						               :p_DESCRIPCION,
						               :p_CODIGO_TIPO_REVISTA,
						               SYSDATE,
						               :p_RESULTADO);
				END;
			    ";

			$procedure = oci_parse($conn, $sql);
			oci_bind_by_name($procedure, ':p_CODIGO_USUARIO', $codigo_usuario);
			oci_bind_by_name($procedure, ':p_NOMBRE_REVISTA', $nombre_revista,300);	
			oci_bind_by_name($procedure, ':p_DESCRIPCION', $descripcion,300);
			oci_bind_by_name($procedure, ':p_CODIGO_TIPO_REVISTA', $codigo_tipo_revista);
			oci_bind_by_name($procedure, ':p_RESULTADO', $resultado);
			oci_execute($procedure);
			if($resultado == 0){
				echo "Ocurrió un error durante la inserción";
			}else{
				echo "Inserción de la revista completada";
			}
			oci_free_statement($procedure);
			oci_close($conn);
			break;

		case '2':

			break;
	}
?>