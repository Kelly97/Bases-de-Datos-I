<?php
$codigo_usuario=1;//SESION
include_once("../class/class-conexion.php");
$conexion = new Conexion();
$sql =  'SELECT A.CODIGO_REVISTA,
		        UPPER(A.NOMBRE_REVISTA) AS NOMBRE_REVISTA,
		        A.URL_PORTADA
		FROM TBL_REVISTAS A
		WHERE CODIGO_USUARIO='.$codigo_usuario;
$resultado = $conexion->ejecutarInstruccion($sql);
?>

<div class="row" style="padding: 5px;">
	<?php
		while($row = $conexion->obtenerFila($resultado)){
	?>
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" style="margin-bottom: 0.3em;padding: 3px;">
		    <input class="radio-boton" type="radio" name="opt_revistas" id="<?php echo $row['CODIGO_REVISTA']; ?>" value="<?php echo $row['CODIGO_REVISTA'];?>">
		    <label for="<?php echo $row['CODIGO_REVISTA']; ?>" style="width: 100%;">			
				<div onclick="habilitarBotonAniadirFlip();" class="miniatura-revista" style="background-image: url('<?php echo $row['URL_PORTADA']; ?>');margin: auto;width: 100%;height: 12em;font-weight: bold;line-height: 0.8em;
						<?php
							if(is_null($row['URL_PORTADA'])){
								?>
								background: -webkit-linear-gradient(orange, red);background: -moz-linear-gradient(orange, red);background: -o-linear-gradient(orange, red);
								<?php
							}
						?>
						">
					<span style="font-size: 0.7em;"><?php echo utf8_encode($row['NOMBRE_REVISTA']); ?></span>
				</div>				
		    </label>	    
	    </div>
	<?php
	}
	?>
	
	<div onclick="agregarNuevaRevista();" class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" style="margin-bottom: 0.3em;padding: 3px;">
		<div class="miniatura-revista" style="margin: auto;width: 100%;height: 12em;">
			<table style="height: 100%;width: 100%;">
                <tbody>
                  <tr>
                    <td class="align-middle text-center">
                      <span style="font-size: 0.8em;">Nueva Revista</span>
                    </td>
                  </tr>
                </tbody>
              </table> 				
		</div>			
	</div>	
</div>