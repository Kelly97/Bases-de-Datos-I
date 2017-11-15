<?php
sleep(1);
include_once("../class/class-conexion.php");
$conexion = new Conexion();
$texto = $_POST["buscar"];
//echo $texto;
?>

<div class="text-center" style="padding: 40px;">
	<br><br>
	<h2>
		Resultados para '<?php echo $texto; ?>'
	</h2>
	<h4>Resultados Noticias</h4><br>
	<div class="row" style="padding-left: 400px;">
	<?php
		$sqlNoticias = "SELECT A.CODIGO_NOTICIA,
							   A.TITULO_NOTICIA,
							   A.URL_PORTADA_NOTI,
							   A.AUTOR_NOTICIA,
							   B.CATEGORIA
						  FROM TBL_NOTICIAS A
						  LEFT JOIN TBL_CATEGORIA B
						  	ON A.CODIGO_CATEGORIA = B.CODIGO_CATEGORIA
						WHERE UPPER(TITULO_NOTICIA) LIKE UPPER('%". $texto ."%')";
		$resultadosNoticias = $conexion->ejecutarInstruccion($sqlNoticias);
		while($rowNoticias = $conexion->obtenerFila($resultadosNoticias)){
		?>
			<div onclick="cargarContenidoNoticia(<?php echo $rowNoticias["CODIGO_NOTICIA"]; ?>)" style="cursor: pointer;position: relative;">
				<div class="card noti-card" style="width: 100%;margin: auto;">
					<h3><?php echo $rowNoticias["TITULO_NOTICIA"]; ?></h3>
					<h5><?php echo $rowNoticias["AUTOR_NOTICIA"] . " | " . $rowNoticias["CATEGORIA"]; ?></h5>
					<div style="background-image:url(<?php echo $rowNoticias['URL_PORTADA_NOTI']; ?>);background-size: cover;background-position: center; height: 500px">
					</div>
				</div>
			</div>
		<?php
		}
	?>
	</div>
	<br><br><br>
	<br><h4>Revistas</h4><br>
	<div class="row" style="padding: 20px;">
	<?php
		$conexion->liberarResultado($resultadosNoticias);
		$sqlRevistas = "SELECT *
						  FROM TBL_REVISTAS
						WHERE UPPER(NOMBRE_REVISTA) LIKE UPPER('%". $texto ."%')";
		
		$resultadoRevistas = $conexion->ejecutarInstruccion($sqlRevistas);
		while($rowRevista = $conexion->obtenerFila($resultadoRevistas)){
		?>
			<div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12" style="margin-bottom: 1.5em">
				<?php echo '<div class="miniatura-revista" style="background-image: url('.$rowRevista["URL_PORTADA"].');margin: auto;">'; ?>
					<h4><?php echo $rowRevista["NOMBRE_REVISTA"]; ?></h4><br>
					<h5><p><?php echo $rowRevista["DESCRIPCION"]; ?></p></h5>
				</div>			
			</div>
		<?php
		}
	?>
	</div>

	<br><h4>Personas</h4><br>
	<div class="row">
		<?php
		$conexion->liberarResultado($resultadoRevistas);
		$sqlUsuarios = "SELECT A.CODIGO_USUARIO,
						       A.NOMBRE_USUARIO,
						       A.ALIAS_USUARIO,
						       A.URL_FOTO_PERFIL,
						       A.DESCRIPCION,
						       COUNT(*) AS CANTIDAD_REVISTAS
					    FROM TBL_USUARIOS A
						LEFT JOIN TBL_REVISTAS B
						    ON A.CODIGO_USUARIO = B.CODIGO_USUARIO
						WHERE UPPER(ALIAS_USUARIO) LIKE UPPER('%".$texto."%')
						GROUP BY A.CODIGO_USUARIO, A.NOMBRE_USUARIO, A.ALIAS_USUARIO, A.URL_FOTO_PERFIL, A.DESCRIPCION";

		$resultadoUsuarios = $conexion->ejecutarInstruccion($sqlUsuarios);

		while($rowUsuario = $conexion->obtenerFila($resultadoUsuarios)){
		?>
		<div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12" style="position: relative;margin-bottom: 1.5em;">
			<div class="miniatura-usuario" onclick="cargarUsuario(<?php echo $rowUsuario["CODIGO_USUARIO"]; ?>)" style="cursor: pointer; background-image: url(<?php echo $rowUsuario["URL_FOTO_PERFIL"]; ?>); margin:auto;margin-bottom: 10px;">
			</div>
			<div style="line-height: 1;">
				
				<p style="color: gray;"><?php echo "@". $rowUsuario["ALIAS_USUARIO"] ." • ". $rowUsuario["CANTIDAD_REVISTAS"] ." revistas"; ?></p>
				<h5><?php echo $rowUsuario["DESCRIPCION"]; ?></h5>
			</div>		
		</div>
		<?php 
		}
		?>
	</div>
</div>

