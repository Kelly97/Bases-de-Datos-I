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
	<div class="row" style="padding: 20px;">
	<?php
		$sqlNoticias = "SELECT A.TITULO_NOTICIA,
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
			<div style="width: 100%;position: relative;">
				<div class="card noti-card" style="margin: auto;">
					<h5><?php echo $rowNoticias["TITULO_NOTICIA"] ?></h5>
					<img class="card-img-top" src="<?php echo $rowNoticia["URL_PORTADA_NOTI"]; ?>" style="cursor: pointer;">
					<h5><?php echo $rowNoticias["AUTOR_NOTICIA"] . " | " . $rowNoticias["CATEGORIA"];?></h5>
				</div>
			</div>
			<script src="../js/index.js"></script>
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
		
		$resultadoRevistas = $conexion->ejecutarInstruccion($sql);
		while($rowRevista = $conexion->obtenerFila($resultadoRevistas)){
		?>
			<div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12" style="margin-bottom: 1.5em">
				<div class="miniatura-revista" style="background-image: url("<?php echo $rowRevista["URL_PORTADA"] ?>");margin: auto;">
					<h5><?php echo $rowRevista["NOMBRE_REVISTA"]; ?></h5><br>
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
		$sqlUsuarios = "SELECT *
				  FROM TBL_USUARIOS
				WHERE UPPER(ALIAS_USUARIO) LIKE UPPER('%". $texto ."%')";

		$resultadoUsuarios = $conexion->ejecutarInstruccion($sqlUsuarios);

		while($rowUsuario = $conexion->obtenerFila($resultadoUsuarios)){
		?>
		<div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12" style="position: relative;margin-bottom: 1.5em;">
			<div class="miniatura-usuario" style="margin: auto;margin-bottom: 10px;">
				<table style="height: 100%;width: 100%;font-size: 2.3em;font-weight: bold;">
					<tbody>
						<tr>
							<td class="align-middle text-center">
								<img src="<?php echo $rowUsuario['URL_FOTO_PERFIL'] ?>" widht="100px" height="200px">
								<h5><?php echo $rowUsuario["NOMBRE_USUARIO"] . " | " . $rowUsuario["ALIAS_USUARIO"]; ?></h5><br>
								<h5><?php echo $rowUsuario["DESCRIPCION"]; ?></h5>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div style="line-height: 1;">
				<p style="font-size: 20px;">Camila Prado</p>
				<p style="color: gray;">@cami1234 • 1 revistas</p>			
			</div>		
		</div>
		<?php 
		}
		?>
	</div>
</div>

