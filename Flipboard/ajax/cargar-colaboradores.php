<?php
session_start();
$codigo_usuario=$_SESSION['usuario']['CODIGO_USUARIO'];//SESION
$codigoRevista=$_POST["codigoRevista"];
include_once("../class/class-conexion.php");
$conexion = new Conexion();
$sql =  "WITH
		TBL_USUARIO_SEGUIDORES AS
		    (SELECT CODIGO_USUARIO_SEGUIDOR
		    FROM TBL_SEGUIDORES
		    WHERE CODIGO_USUARIO_SEGUIDO=".$codigo_usuario."
		    UNION
		    SELECT CODIGO_USUARIO_SEGUIDO
		    FROM TBL_SEGUIDORES
		    WHERE CODIGO_USUARIO_SEGUIDOR=".$codigo_usuario."
			MINUS
	        SELECT CODIGO_COLABORADOR
	        FROM TBL_COLABORADORES
	        WHERE CODIGO_REVISTA=".$codigoRevista.")
		SELECT
		    A.CODIGO_USUARIO AS CODIGO_COLABORADOR,
		    substr(A.NOMBRE_USUARIO,1,1) AS INICIAL,
		    A.NOMBRE_USUARIO,
		    A.ALIAS_USUARIO,
		    A.URL_FOTO_PERFIL
		FROM TBL_USUARIOS A
		RIGHT JOIN TBL_USUARIO_SEGUIDORES B
		ON (A.CODIGO_USUARIO=B.CODIGO_USUARIO_SEGUIDOR)";
$resultado = $conexion->ejecutarInstruccion($sql);
?>

<div class="resultado row" style="padding: 5px;">
	<?php
		while($colaborador = $conexion->obtenerFila($resultado)){
	?>

		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" style="position: relative;margin-bottom: 1.5em;">
		    <input class="radio-boton" type="radio" name="opt_colaboradores" id="<?php echo $colaborador['CODIGO_COLABORADOR']; ?>" value="<?php echo $colaborador['CODIGO_COLABORADOR'];?>">
		    <label for="<?php echo $colaborador['CODIGO_COLABORADOR']; ?>" style="width: 100%;">

		    	<div onclick="habilitarBotonAniadirColaborador();" class="miniatura-usuario" onclick="cargarUsuario(<?php $colaborador['CODIGO_COLABORADOR']; ?>)"; style="background-image: url('<?php echo $colaborador["URL_FOTO_PERFIL"]; ?>');margin: auto;margin-bottom: 10px;">
        		<?php
		        		if(is_null($colaborador["URL_FOTO_PERFIL"])){
		        			?>
		        				<table style="height: 100%;width: 100%;font-size: 20px;font-weight: bold;">
									<tbody>
										<tr>
											<td class="align-middle text-center">
												<?php echo ($colaborador['INICIAL']); ?>
											</td>
										</tr>
									</tbody>
								</table>
		        			<?php
		        		}
		        		?>								
				  </div>
				  <div style="line-height: 1;text-align: center;">
					<p style="font-size: 18px;">
						<?php echo ($colaborador['NOMBRE_USUARIO']); ?>
					</p>
					<p style="color: gray;"><?php echo "@". $colaborador["ALIAS_USUARIO"]; ?></p>
				</div>		

		    </label>	    
	    </div>
	<?php
	}
	?>
</div>