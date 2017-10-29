<?php

	switch ($_POST["codigo"]) {
		case '1':
			/* OBTENER LAS CATEGORIAS/INTERESES QUE EL USUARIO NO TIENE AGREGADOS */
			include_once("../class/class-conexion.php");
			$usuario = $_POST["usuario"];
			$conexion = new Conexion();
            $sql = "SELECT A.CODIGO_CATEGORIA, A.CATEGORIA
					  FROM TBL_CATEGORIA A
					  LEFT JOIN (
					      SELECT A.CODIGO_USUARIO, A.ALIAS_USUARIO, C.CATEGORIA, C.CODIGO_CATEGORIA
					      FROM TBL_USUARIOS A
					      LEFT JOIN TBL_INTERESES_X_USUARIO B
					      ON (A.CODIGO_USUARIO = B.CODIGO_USUARIO)
					      LEFT JOIN TBL_CATEGORIA C
					      ON (B.CODIGO_CATEGORIA_INTERES = C.CODIGO_CATEGORIA)
					      WHERE A.CODIGO_USUARIO = $usuario
					      ) B
					  ON A.CODIGO_CATEGORIA = B.CODIGO_CATEGORIA
					  WHERE B.CODIGO_CATEGORIA IS NULL";
            $resultadoIntereses = $conexion->ejecutarInstruccion($sql);
            $respuesta = "";
            while($row = $conexion->obtenerFila($resultadoIntereses)){
              $respuesta = $respuesta.'<div class="favorite">
                      <div class="name">
                        <span style="font-size: 30px"><strong><a onclick="agregarInteres('.$row['CODIGO_CATEGORIA'].','.$usuario.');" class="pn-ProductNav_Link">'.$row['CATEGORIA'].'</a></strong></span>
                      </div>
                    </div>';
            }
            $conexion->liberarResultado($resultadoIntereses);
            echo $respuesta;         
			break;
		
		case '2':
			/* AGREGAR UN INTERES A LOS FAVORITOS DEL USUARIO */
			include_once("../class/class-conexion.php");
			$conexion = new Conexion();
			$codigoInteres = $_POST["codigoInteres"];
			$usuario = $_POST["usuario"];
			$sql = "INSERT INTO TBL_INTERESES_X_USUARIO(CODIGO_USUARIO, CODIGO_CATEGORIA_INTERES)
					VALUES ($usuario, $codigoInteres)";
			$conexion->ejecutarInstruccion($sql);
			break;
	}
	
			
?>