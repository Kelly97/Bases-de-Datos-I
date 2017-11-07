<?php
include_once("../class/class-conexion.php");
include_once("../class/class-tiempo.php");

$codigoRevista = $_POST['codigoRevista'];//Obtenemos el código por medio de la variable enviada en data
$conexion = new Conexion();
$codigoUsuario = 1;//sesion
$sql =  "
	SELECT A.NOMBRE_REVISTA, A.DESCRIPCION, A.FECHA_DE_CREACION, A.URL_PORTADA, B.NOMBRE_USUARIO
	FROM TBL_REVISTAS A
	LEFT JOIN TBL_USUARIOS B
	ON (A.CODIGO_USUARIO = B.CODIGO_USUARIO)
	WHERE (A.CODIGO_REVISTA = $codigoRevista)
	";
$sql2 = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM ($sql)";
$resultado = $conexion->ejecutarInstruccion($sql);
$resultado2 = $conexion->ejecutarInstruccion($sql2);
$cantidadRegistros = $conexion->obtenerArregloAsociativo($resultado2)['NUMBER_OF_ROWS'];
?>
<div class="head-revista" style="margin: auto;background-image: url(../images/alternativo.jpg);width: 100%px;height: 90%;padding: 10px;"> 
	<h2><strong>TITULO DE LA REVISTA</strong></h2>
	<p>Descripcion de la revista</p>
  	<button type="button" class="btn btn-default btn-semcircle" data-content="Seguir" data-trigger="hover">
  		Seguir
  	</button>
  	<button type="button" class="btn btn-default btn-circle">
  		<i class="fa fa-ellipsis-h" aria-hidden="true"></i>
  	</button>
  	<div>
  		<button type="button" class="btn btn-default btn-circle-perfil">
  			<i class="fa fa-user-plus fa-2x" aria-hidden="true"></i>
  		</button>
  	</div>
</div>

		<div class="col" style="text-align: center; padding: 10px">
			SIN CONTENIDO
		</div>

		<div class="row">
		  <div class="col" style="text-align: center; padding: 10px">
		    # Noticias
		  </div>
		  <div class="col" style="text-align: center; padding: 10px">
		    <i class="fa fa-lock" aria-hidden="true"></i><!--Se muestra si la revista es privada-->
		    BAJA PARA VER MAS
		    <i class="fa fa-chevron-down" aria-hidden="true"></i>
		  </div>
		  <div class="col" style="text-align: center; padding: 10px">
		    Botones
		  </div>
		</div>
</div>