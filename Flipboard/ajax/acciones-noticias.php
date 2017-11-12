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
				$resultado = $resultado . '<div id="tituloNoticia" style="padding-top:100px; padding-left:100px; padding-right:100px">
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
			//Imprimiendo título de "Noticias de Portada" o sino el titulo de "Categoría"
		case 2:
			session_start();
			$_SESSION["ROWNUM_INCIO"]=1;
			$_SESSION["ROWNUM_FINAL"]=4;//Cantidad de registros que deseo mostrar
			include_once("../class/class-conexion.php");
			$conexion = new Conexion();
			$categoriaEnviada = $_POST["codigoCategoria"];
			if($categoriaEnviada==0){
				?>
				  <div id="labelNoticia" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xl-12" style="text-align: center;padding-bottom: 40px;padding-top: 40px; width: 100%;">
				     <h2>NOTICIAS DE PORTADA</h2>
				     <h5 style="color: #999;">Noticias de gran relevancia en un solo lugar</h5>
				  </div>
		  
				<?php
			}else{
				$sql2 = "SELECT CATEGORIA
						FROM TBL_CATEGORIA
						WHERE CODIGO_CATEGORIA=".$categoriaEnviada;
				$resultadoCategoria = $conexion->ejecutarInstruccion($sql2);
				$categoria = $conexion->obtenerFila($resultadoCategoria);
					//TITULO DE LA CATEGORÍA
				?>
				  <div id="labelCategoria" class="col-lg-12 col-md-12" style="text-align: center;padding-bottom: 40px;padding-top: 40px;">
			        <h2><?php echo ($categoria['CATEGORIA']); ?></h2>
			        <button onclick="eliminarInteres(<?php echo $categoriaEnviada; ?>);" class="btn btn-default btn-seguir" role="button" style="border:none;">
			        	<i class="fa fa-times" aria-hidden="true"></i>
			        </button>
				  </div>

				<?php
			}
			?>
			<div id="grid_Noticias" class="grid">
				<div class="notisizer"></div>
			</div>
			
			<div id="loadingSencilloNoticias" style="text-align:center;">
				<span class="loading-sencillo">Cargando</span>
				<span class="l-1"></span>
				<span class="l-2"></span>
				<span class="l-3"></span>
				<span class="l-4"></span>
				<span class="l-5"></span>
				<span class="l-6"></span>
			</div>
			<script src="js/tarjetasNoticias.js"></script>
			<?php
			$conexion->cerrarConexion();
			
			break;
	}
?>

