<?php
	session_start();
	include_once("../class/class-conexion.php"); 
	$conexion = new Conexion();
	$conexion->establecerConexion();

	if($_POST["nombre"]=="" ||
		$_POST["correo"]=="" ||
		$_POST["contrasena"]==""){
		$resultado["codigo_resultado"]=0;
		$resultado["mensaje"]="Debe ingresar toda la información";
		echo json_encode($resultado);
		exit;
	}

	list($nombre, $apellido) = explode(' ', $_POST["nombre"]);
	$alias=$nombre;
	$nombre_usuario=$_POST["nombre"];
	$codigo_tipo_usuario=1;
	$codigo_lugar_residencia=4;
	$codigo_estado_usuario=2;
	$correo=$_POST["correo"];
	$contrasena=sha1($_POST["contrasena"]);
	$url_foto_perfil=NULL;
	$descripcion=NULL;
	
	$sql="begin 
		INSERTAR_USUARIO(:CODIGO_USUARIO, 
						:CODIGO_TIPO_USUARIO, 
						:CODIGO_LUGAR_RESIDENCIA, 
						:CODIGO_ESTADO_USUARIO, 
						:NOMBRE_USUARIO, 
						:ALIAS_USUARIO, 
						:CORREO, 
						:CONTRASENIA, 
						:URL_FOTO_PERFIL, 
						:DESCRIPCION,
						:FECHA_REGISTRO, 
						:codigo_resultado, 
						:mensaje_resultado); 
		end;";
	$proc_insertar = oci_parse($conexion->getLink(), $sql);
	oci_bind_by_name($proc_insertar, ':CODIGO_USUARIO', $codigo_usuario,-1 , SQLT_INT);
	oci_bind_by_name($proc_insertar, ':CODIGO_TIPO_USUARIO', $codigo_tipo_usuario);
	oci_bind_by_name($proc_insertar, ':CODIGO_LUGAR_RESIDENCIA', $codigo_lugar_residencia);
	oci_bind_by_name($proc_insertar, ':CODIGO_ESTADO_USUARIO', $codigo_estado_usuario);
	oci_bind_by_name($proc_insertar, ':NOMBRE_USUARIO', $nombre_usuario);
	oci_bind_by_name($proc_insertar, ':ALIAS_USUARIO', $alias);
	oci_bind_by_name($proc_insertar, ':CORREO', $correo);
	oci_bind_by_name($proc_insertar, ':CONTRASENIA', $contrasena);
	oci_bind_by_name($proc_insertar, ':URL_FOTO_PERFIL', $url_foto_perfil);
	oci_bind_by_name($proc_insertar, ':DESCRIPCION', $descripcion);
	oci_bind_by_name($proc_insertar, ':FECHA_REGISTRO', $fecha, 100);
	oci_bind_by_name($proc_insertar, ':codigo_resultado', $codigo_resultado, 10);
	oci_bind_by_name($proc_insertar, ':mensaje_resultado', $mensaje_resultado, 500);
	
	oci_execute($proc_insertar);

	$resultado["codigo_resultado"]=$codigo_resultado;
	$resultado["mensaje"]=utf8_encode($mensaje_resultado);
	
	if($resultado["codigo_resultado"]==1){
		$sql = "SELECT CODIGO_USUARIO, CODIGO_TIPO_USUARIO, CODIGO_LUGAR_RESIDENCIA, CODIGO_ESTADO_USUARIO, NOMBRE_USUARIO, ALIAS_USUARIO, CORREO, CONTRASENIA, URL_FOTO_PERFIL, DESCRIPCION, FECHA_REGISTRO
				FROM TBL_USUARIOS
				WHERE CORREO = '".$correo."'";
		$resultadoUsuarios = $conexion->ejecutarInstruccion($sql);
		$fila = $conexion->obtenerFila($resultadoUsuarios);
		$_SESSION['usuario']=$fila;
	}

	echo json_encode($resultado);
	
	oci_free_statement($proc_insertar);
	$conexion->cerrarConexion();
?>
