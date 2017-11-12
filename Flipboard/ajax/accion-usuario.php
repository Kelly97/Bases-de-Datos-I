<?php 
	switch ($_GET["accion"]) {
		case '1':
			include_once("../class/class-conexion.php");
			$conexion = new Conexion();
			$codigo_usuario = $_POST["codigo_usuario"];

			$sql = "SELECT A.NOMBRE_USUARIO,
				           A.ALIAS_USUARIO,
				           A.URL_FOTO_PERFIL,
				           A.DESCRIPCION,
				           B.TIPO_USUARIO
				      FROM TBL_USUARIOS A
				    LEFT JOIN TBL_TIPOS_USUARIO B
				        ON A.CODIGO_TIPO_USUARIO = B.CODIGO_TIPO_USUARIO
				    WHERE A.CODIGO_USUARIO = $codigo_usuario";

			$resultadoUsuario = $conexion->ejecutarInstruccion($sql);
			$resultado = "";
			while($rowUsuario = $conexion->obtenerFila($resultadoUsuario)){
				$resultado = '<div id="fotoPerfil">
								<img src="'. $rowUsuario["URL_FOTO_PERFIL"] .'" width="700px" height="500px">
							  </div>

							  <div id="nombreUsuario">
							  	<span><h1><strong>'. $rowUsuario["NOMBRE_USUARIO"] .' | '. $rowUsuario["ALIAS_USUARIO"] .' | '. $rowUsuario["TIPO_USUARIO"] .'</strong></h1></span>
							  </div>

							  <div id="descripcion">
							  	<p>'. $rowUsuario["DESCRIPCION"] .'</p>
							  </div>';
			}
			
			echo $resultado;
			break;
		
		default:
			# code...
			break;
	}
?>