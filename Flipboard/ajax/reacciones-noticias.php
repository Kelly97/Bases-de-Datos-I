<?php
$codigoNoticia=$_POST["codigoNoticia"];
$codigoUsuario=1;//sesion
include_once("../class/class-conexion.php");
$conexion = new Conexion();

switch ($_POST["codigo"]) {
		case '1'://evento Like
			$sql="SELECT CODIGO_NOTICIA
				FROM TBL_REACCIONES_X_NOTICIAS
				WHERE CODIGO_USUARIO=".$codigoUsuario."
				AND CODIGO_NOTICIA=".$codigoNoticia;
			$respuesta=$conexion->ejecutarInstruccion($sql);
			$row = $conexion->obtenerFila($respuesta);
			if($row["CODIGO_NOTICIA"]==""){
				$sql1 = "INSERT INTO tbl_reacciones_x_noticias (
						    codigo_noticia,
						    codigo_usuario,
						    codigo_reaccion
						) VALUES (
						    ".$codigoNoticia.",
						    ".$codigoUsuario.",
						    1
						)";
				$conexion->ejecutarInstruccion($sql1);
				$conexion->commit();
				echo "Has indicado que te gusta una noticia";
			}else{
				$sql2="DELETE FROM tbl_reacciones_x_noticias 
						WHERE codigo_noticia =".$codigoNoticia."
						AND codigo_usuario =".$codigoUsuario."
						AND codigo_reaccion =1";
				$conexion->ejecutarInstruccion($sql2);
				$conexion->commit();
				echo "Has indicado que ya no te gusta una noticia";
			}
					
			break;
		
		case '2'://Evento flipear

			break;
}
?>