<?php
	switch ($_POST["codigo"]) {
		case 1:
			//Obtener noticia
			include_once("../class/class-conexion.php");
			$conexion = new Conexion();

			$codigo_noticia = $_POST["codigoNoticia"];

			$sql="SELECT TITULO_NOTICIA,
			           DESCRIPCION_NOTICIA,
			           TO_CHAR(SUBSTR(CONTENIDO_NOTICIA,0,3999)) CONTENIDO,
			           TO_CHAR(FECHA_PUBLICACION, 'DD/MM/YYYY') FECHA,
			           AUTOR_NOTICIA,
			           URL_PORTADA_NOTI
			      FROM TBL_NOTICIAS
			      WHERE CODIGO_NOTICIA = $codigo_noticia";

			$resultadoNoticia = $conexion->ejecutarInstruccion($sql);
			$resultado = "";
			while($row=$conexion->obtenerFila($resultadoNoticia)){
				$resultado = '<div id="tituloNoticia" style="padding-top:100px; padding-left:100px; padding-right:100px">
								<h1><strong>'. $row["TITULO_NOTICIA"] .'</strong></h1>
								<h3>'. $row["AUTOR_NOTICIA"] .' | '. $row["FECHA"] .'</h3>
							  </div>

							  <div id="imgPortada" style="padding-left:100px; padding-right:100px">
							  	<img src="'. $row["URL_PORTADA_NOTI"] .'">
							  </div>

							  <div id="descripcionNoticia" style="padding-left:100px; padding-right:100px">
							  	<p>'. $row["DESCRIPCION_NOTICIA"] .'</p>
							  </div>

							  <div id="contenidoNoticia" style="padding-left:100px; padding-right:100px">
							  	<p>'. $row["CONTENIDO"] .'</p>
							  </div>';
			}
			echo $resultado;
			break;
	}
?>