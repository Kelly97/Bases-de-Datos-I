<?php
	session_start();
	include_once("../class/class-conexion.php"); 
	$conexion = new Conexion();
	$conexion->establecerConexion();
	$resultado = array();

	if($_POST["correo_usuario"]=="" ||
		$_POST["contrasena"]==""){
		$resultado["codigo_resultado"]=0;
		$resultado["mensaje"]="Debe ingresar toda la información";
		echo json_encode($resultado);
		exit;
	}

	$sql = "SELECT CODIGO_USUARIO, NOMBRE_USUARIO, ALIAS_USUARIO, CORREO, CONTRASENIA 
			FROM TBL_USUARIOS";
	$resultadoUsuarios = $conexion->ejecutarInstruccion($sql);
	while($fila = $conexion->obtenerFila($resultadoUsuarios)){
		if($fila["CORREO"] == $_POST["correo_usuario"] || $fila["ALIAS_USUARIO"] == $_POST["correo_usuario"]){
			if ($fila["CONTRASENIA"] == sha1($_POST["contrasena"])) { 
				$resultado["codigo_resultado"]=1;
				$resultado["mensaje"]='Registro encontrado';

				$_SESSION['usuario']=$fila;

				echo json_encode($resultado);
				exit;
			}
		}
	}
	
	$resultado["codigo_resultado"]=0;
	$resultado["mensaje"]='Nombre de usuario o contraseña incorrectos';
	echo json_encode($resultado);
			

	$conexion->cerrarConexion();


?>
