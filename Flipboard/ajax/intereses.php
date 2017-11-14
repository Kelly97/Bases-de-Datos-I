<?php
	session_start();
	$codigoUsuario=$_SESSION['usuario']['CODIGO_USUARIO'];//sesion
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
                        <span style="font-size: 20px;cursor:pointer;"><a onclick="agregarInteres('.($row['CODIGO_CATEGORIA']).','.$usuario.');" class="pn-ProductNav_Link">'.($row['CATEGORIA']).'</a></span>
                      </div>
                    </div>';
            }
            $conexion->liberarResultado($resultadoIntereses);
            echo $respuesta; 
            $conexion->cerrarConexion();        
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
			$conexion->commit();


			$sql2 = "SELECT CODIGO_CATEGORIA, 
							UPPER(CATEGORIA) AS CATEGORIA
                    FROM TBL_CATEGORIA A
                    WHERE CODIGO_CATEGORIA = ".$_POST["codigoInteres"];
            $resultadoInte = $conexion->ejecutarInstruccion($sql2);
            $row2 = $conexion->obtenerFila($resultadoInte);
			?>
			<a onclick="cargarNoticias(<?php echo $row2['CODIGO_CATEGORIA']; ?>);return false;" class="pn-ProductNav_Link ">
              <?php echo ($row2['CATEGORIA']) ?>
            </a>
			<?php
			$conexion->cerrarConexion();
			break;
		case '3':
			/*Eliminar interes*/
			$codigoInteres = $_POST["codigoInteres"];
			$conn = oci_connect('DB_FLIPBOARD', 'oracle', 'localhost/XE','AL32UTF8');
			if (!$conn) {
			    $e = oci_error();
			    echo "Ups. Algo anda mal con el servidor.";
			    exit;
			}		
			$sql="
				BEGIN
				    P_ELIMINAR_INTERES(
						:codigoUsuario,
						:codigoInteres,
				        :codigoResultado,
				        :mensajeResultado
				    );
				END;
					";
			$procedure = oci_parse($conn, $sql);
			oci_bind_by_name($procedure, ':codigoUsuario', $codigoUsuario);//las variables de entrada, deben de haber sido declaradas previamente (in)
			oci_bind_by_name($procedure, ':codigoInteres', $codigoInteres);
			oci_bind_by_name($procedure, ':codigoResultado', $codigoRespuesta , 5);//No se deben declarar previamente las variables de salida (out)
			oci_bind_by_name($procedure, ':mensajeResultado', $mensajeRespuesta , 200);
			oci_execute($procedure);			
			$resultado['codigoResp'] = $codigoRespuesta;
			$resultado['mensajeResp'] = $mensajeRespuesta;			
			oci_free_statement($procedure);
			oci_close($conn);
			echo json_encode($resultado);  
			break;
		case '4'://cargar barra intereses
			$codigoInteres = $_POST["codigoInteres"];
			include_once("../class/class-conexion.php");
			$conexion = new Conexion();            
              ?>
	              
	            
	              <?php
	                $sql1 = "SELECT  B.CODIGO_CATEGORIA,
	                                UPPER(B.CATEGORIA) AS CATEGORIA
	                        FROM TBL_INTERESES_X_USUARIO A
	                        LEFT JOIN TBL_CATEGORIA B
	                        ON (A.CODIGO_CATEGORIA_INTERES = B.CODIGO_CATEGORIA)
	                        WHERE A.CODIGO_USUARIO = ".$codigoUsuario;
	                $resultado = $conexion->ejecutarInstruccion($sql1);
	                while($row2 = $conexion->obtenerFila($resultado)){
	                  ?>
	                    <a onclick="cargarNoticias(<?php echo $row2['CODIGO_CATEGORIA']; ?>);return false;" class="pn-ProductNav_Link" id="<?php if($row2['CODIGO_CATEGORIA']==$codigoInteres){ echo 'interesActual'; } ?>">
	                      <?php echo ($row2['CATEGORIA']) ?>
	                    </a>
	                  <?php
	                }
	                $conexion->liberarResultado($resultado);
	              ?>  
              <?php
            $conexion->cerrarConexion();            
			break;
	}
	
			
?>