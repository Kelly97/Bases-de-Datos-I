


<?php 
session_start();
if (isset($_SESSION['usuario'])) {
  $codigoUsuario = $_SESSION['usuario']['CODIGO_USUARIO'];
} else{
  header('Location: index.php');
}




switch ($_GET["accion"]) {
	case "1":
	?>
	 <div class="row">
		  <div class="col-lg-12 col-md-12" style="text-align: center;padding-bottom: 40px;">
			 
		  </div>

	<?php
	include_once("../class/class-conexion.php"); 
	$conexion = new Conexion();
		$sql = "   SELECT D.NOMBRE_USUARIO, D.URL_FOTO_PERFIL, A.NOMBRE_REVISTA, C.AUTOR_NOTICIA, C.TITULO_NOTICIA, C.DESCRIPCION_NOTICIA, SUBSTR(TO_CHAR(C.CONTENIDO_NOTICIA),1,200)||'...' AS CONTENIDO_NOTICIA, C.FECHA_PUBLICACION, C.URL_PORTADA_NOTI FROM
			TBL_REVISTAS A
			INNER JOIN TBL_FLIPS B
			ON(A.CODIGO_REVISTA=B.CODIGO_REVISTA)
			INNER JOIN TBL_NOTICIAS C
			ON(B.CODIGO_NOTICIA=C.CODIGO_NOTICIA) 
			INNER JOIN TBL_USUARIOS D
			ON B.CODIGO_USUARIO_FLIP=D.CODIGO_USUARIO 
			WHERE D.CODIGO_USUARIO=".$codigoUsuario;
		$resultadoFlips = $conexion->ejecutarInstruccion($sql);
	while($rowFlips = $conexion->obtenerFila($resultadoFlips)) { 
		
	
		?>

			<div class="card noti-card" style="position: relative;">
				<div class="botones-noticia-general">
			      	<button type="button" class="btn btn-danger btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Flipear" data-trigger="hover">
			      		<i class="fa fa-plus"  data-toggle="tooltip" title="Flipear" aria-hidden="true"></i>
			      	</button><br>
			      	<button type="button" class="btn btn-default btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Me gusta" data-trigger="hover">
			      		<i class="fa fa-heart-o"  data-toggle="tooltip" title="Me Gusta" aria-hidden="true"></i>
			      	</button><br>
			      	<button type="button" class="btn btn-default btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Compartir" data-trigger="hover">
			      		<i class="fa fa-envelope-o"  data-toggle="tooltip" title="Compartir" aria-hidden="true"></i>
			      	</button>
			    </div>
				<div  style="margin-bottom: 10px; height: 50px; ">
					<div class="row" align="left" >

					      <div class="col-lg-1 col-md-2 col-sm-2 col-2 col-xl-1" style="padding:0px;" align="left">
					      	<div class="miniatura-usuario" style="margin: auto;background-image: url('<?php echo ($rowFlips["URL_FOTO_PERFIL"]) ?>');width: 40px;height: 40px;padding: 0px;">
					      	  <?php if ($rowFlips["URL_FOTO_PERFIL"] ==null){ ?>
									<table style="height: 100%;width: 100%;font-size: 15px;font-weight: bold;">
										<tbody>
											<tr>
												<td class="align-middle text-center">
													N
												</td>
											</tr>
										</tbody>
									</table>
									<?php } ?>
							  </div>         
					      </div>
						      
					      <div class="col-lg-11 col-md-10 col-sm-10 col-10 col-xl-11" >
					      	<table style="height: 100%;">
					      		<tbody>
					      			<tr>
								      	<td class="align-middle">
									        <p class="card-text" style="margin-bottom: -8px;">      
									        	<?php echo ($rowFlips["NOMBRE_USUARIO"]) ?>       	
									        </p> 
									        <p style="padding: 0px;margin:0px;"> 
									        	<span style="color: #09c;font-size: 12px;"><?php echo ($rowFlips["NOMBRE_REVISTA"]) ?> </span>   
									        	<span style="color: gray;font-size: 12px;">23h</span> 
									        </p> 
								        </td> 
							    	</tr>
						        </tbody>
					        </table>  
					      </div> 
					</div>
			   </div>  
			  <img class="card-img-top" src="<?php echo ($rowFlips["URL_PORTADA_NOTI"]) ?>" alt="Card image cap">
			  <div class="card-body" style="text-align: justify;">
			    <h4 class="card-title"><?php echo ($rowFlips["TITULO_NOTICIA"]) ?> </h4>
			    <span class="noti-card-autor"><?php echo ($rowFlips["AUTOR_NOTICIA"]) ?> </span>
			    
			    <p class="card-text"><?php echo ($rowFlips["CONTENIDO_NOTICIA"]) ?></p>
			    
			    <p>
		        
		        	<a class="btn btn-default" role="button" style="cursor: pointer;">
			        	<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 13px;padding-right: 8px;">
			        		
			        	</i>
			        	Añadir Comentario
		        	</a>
		        </p>
			  </div>
			</div> &nbsp;&nbsp;&nbsp;
	<?php
}
	break;

	case "3":
	?>
	 
 <div class="row">
 

	<?php 
	include_once("../class/class-conexion.php"); 
	$conexion = new Conexion();
		$sql = "  SELECT B.CODIGO_USUARIO, A.CODIGO_NOTICIA, C.AUTOR_NOTICIA, C.TITULO_NOTICIA, C.DESCRIPCION_NOTICIA, C.FECHA_PUBLICACION, C.URL_PORTADA_NOTI 
			FROM TBL_REACCIONES_X_NOTICIAS A
			INNER JOIN TBL_USUARIOS B
			ON (A.CODIGO_USUARIO=B.CODIGO_USUARIO)
			INNER JOIN TBL_NOTICIAS C
			ON(C.CODIGO_NOTICIA=A.CODIGO_NOTICIA)
			WHERE B.CODIGO_USUARIO=".$codigoUsuario;
		$resultadoLikes = $conexion->ejecutarInstruccion($sql);
	while($rowLikes = $conexion->obtenerFila($resultadoLikes)) { 
		
	
		?>

 <div class="col-md-4">
    <div class="thumbnail">
 
 	<div class="botones-noticia">
		      	<button type="button" class="btn btn-danger btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Flipear" data-trigger="hover">
		      		<i data-toggle="tooltip" title="Flipear" class="fa fa-plus" aria-hidden="true"></i>
		      	</button><br>
		      	<button type="button" class="btn btn-default btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Me gusta" data-trigger="hover">
			      		<i data-toggle="tooltip" title="Me Gusta" class="fa fa-heart" aria-hidden="true" style="color: red;"></i>
			      	</button><br>
		      	<button type="button" class="btn btn-default btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Compartir" data-trigger="hover">
		      		<i class="fa fa-envelope-o" data-toggle="tooltip" title="Compartir" aria-hidden="true" ></i>
		      	</button>
	 </div>

     
        <img src="<?php echo ($rowLikes["URL_PORTADA_NOTI"]) ?>" alt="Lights" style="width:100%">
        <div class="caption" align="left">
		        <h3 style="font-size: 22px; font-weight: bold;"><?php echo ($rowLikes["TITULO_NOTICIA"]) ?></h3>
		        <h5 style="font-size: 15px;"><?php echo ($rowLikes["AUTOR_NOTICIA"]) ?></h5>
		        
		        <p><a class="btn btn-default" role="button">
		        	<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 13px;padding-right: 8px;"></i>
		        	Añadir Comentario
		        </a></p>
		      </div>
     
    </div>
  </div>

	<?php
}
?><div> <?php
	break;


case "2":
	?>
	   <div class="row">
	<?php 

	include_once("../class/class-conexion.php");
		$conexion = new Conexion();
		$sql = "   SELECT B.CODIGO_USUARIO, A.NOMBRE_REVISTA, A.URL_PORTADA FROM
					TBL_REVISTAS A
					INNER JOIN TBL_USUARIOS B
					ON A.CODIGO_USUARIO=B.CODIGO_USUARIO 
					WHERE A.CODIGO_USUARIO=".$codigoUsuario;
		$resultadoRevistas = $conexion->ejecutarInstruccion($sql);
	while($rowRevistas = $conexion->obtenerFila($resultadoRevistas)){ 	
			
		?>
  <div class="col-md-2" style="padding: 20px;">
    <div class="thumbnail">
	            <div class="container">
				  <img  src="<?php echo ($rowRevistas["URL_PORTADA"]) ?>" alt="Avatar" class="image imagen-editar" style="width:170px; height: 250px; ; object-fit: cover; ">
				  <div class="topcenter"><?php echo ($rowRevistas["NOMBRE_REVISTA"]) ?></div>
				  
				  <div class="middle  center" style="width: 170px;">

				   <i data-toggle="tooltip" title="Estadisticas" class="fa fa-line-chart" style="color: white; cursor: pointer;" aria-hidden="true"></i> &nbsp;&nbsp;
				    <input onclick="location.href='editor.php';" class="btn btn-default btn-editar  "  style="cursor: pointer;" type="button" name="Editar" value="Editar"> &nbsp;&nbsp;
				   <i class="fa fa-envelope-o" data-toggle="tooltip" title="Compartir" style="color: white; cursor: pointer; " aria-hidden="true"></i>
				   
				    <span></span>
				  </div>
				</div>
	  
	 </div>
</div>
				
	<?php
}
?><div> <?php
	break;
	









	case "4":
		include_once("../class/class-conexion.php");
		$conexion = new Conexion();
		$sql = "   SELECT C.CODIGO_USUARIO, B.NOMBRE_REVISTA, B.DESCRIPCION, D.NOMBRE_USUARIO,
		                  B.URL_PORTADA
					FROM TBL_REVISTAS_SEGUIDAS A
					INNER JOIN TBL_REVISTAS B
					ON(A.CODIGO_REVISTA=B.CODIGO_REVISTA)
					INNER JOIN TBL_USUARIOS C
					ON (C.CODIGO_USUARIO=A.CODIGO_SEGUIDOR)
					INNER JOIN TBL_USUARIOS D
					ON(D.CODIGO_USUARIO=B.CODIGO_USUARIO)
					WHERE C.CODIGO_USUARIO=".$codigoUsuario;
		$resultadoRevistasSeguidas = $conexion->ejecutarInstruccion($sql);

	?>
	  	   <div class="row">

	<?php 
	while ($rowRevistasSeguidas = $conexion->obtenerFila($resultadoRevistasSeguidas)){ 	
	
		?>
		    
 <div class="col-md-2" style="padding: 20px;">
    <div class="thumbnail">
	         <div class="container">
				  <img  src="<?php echo ($rowRevistasSeguidas["URL_PORTADA"]) ?>" alt="Avatar" class="image imagen-editar" style="width:170px; height: 250px; ; object-fit: cover; ">
				  <div  class="topcenter"><?php echo ($rowRevistasSeguidas["NOMBRE_REVISTA"]) ?></div>
				  <div class="center" style="color: white; top: 90%; font-size: 10px;"><?php echo ($rowRevistasSeguidas["NOMBRE_USUARIO"]) ?></div>
	        </div>
	 </div>
</div>
	    
	<?php
} ?><div> <?php
	break;

case "5":

//LISTA DE INTERESES POR USUARIO
include_once("../class/class-conexion.php");
$conexion = new Conexion();

$sql = "   SELECT  B.CODIGO_CATEGORIA,B.CATEGORIA 
			FROM TBL_INTERESES_X_USUARIO A
			INNER JOIN TBL_CATEGORIA B
			ON(A.CODIGO_CATEGORIA_INTERES=B.CODIGO_CATEGORIA)
			INNER JOIN TBL_USUARIOS C
			ON(C.CODIGO_USUARIO=A.CODIGO_USUARIO)
			WHERE C.CODIGO_USUARIO=".$codigoUsuario;
$resultadoIntereses = $conexion->ejecutarInstruccion($sql);





	?>
		 <div class="row">
	<?php 	
	  while ($rowIntereses = $conexion->obtenerFila($resultadoIntereses)) {
	        
	        $sql2 = "   
	        SELECT distinct B.CODIGO_CATEGORIA, A.URL_PORTADA_NOTI
				FROM TBL_NOTICIAS A
				INNER JOIN TBL_CATEGORIA B
				ON(A.CODIGO_CATEGORIA=B.CODIGO_CATEGORIA)
				WHERE B.CODIGO_CATEGORIA=".$rowIntereses['CODIGO_CATEGORIA'];
            $resultadoImagenInteres = $conexion->ejecutarInstruccion($sql2);
            $rowImagen = $conexion->obtenerFila($resultadoImagenInteres);
            $url=$rowImagen["URL_PORTADA_NOTI"];
		?>
		    
	    <div class="col-md-2" style="padding: 20px;" id="<?php echo ("int-".$rowIntereses['CODIGO_CATEGORIA']) ?>" >
    <div class="thumbnail">
	            <div class="container">
				  <img  src="<?php echo ($url) ?>" alt="Avatar" class="image imagen-editar" style="width:170px; height: 250px; ; object-fit: cover; ">
				  <div class="topcenter" style="float:left;"><?php echo ($rowIntereses['CATEGORIA']) ?></div>
<i onclick="eliminarInteres(<?php echo ($rowIntereses['CODIGO_CATEGORIA'].",".$codigoUsuario)?>)"  data-toggle="tooltip" title="Eliminar" class="fa fa-times topright" style="color: white; cursor: pointer;" aria-hidden="true"></i>
				  
				  <div class="middle  center" style="width: 170px;">

				    <i class="fa fa-envelope-o" style="color: white; cursor: pointer; " aria-hidden="true"></i>
				   
				    <span></span>
				  </div>
				</div>
	  
	 </div>
</div>
	
						

	<?php
}?><div> <?php
	break;



	case "6":


	include_once("../class/class-conexion.php");
	$conexion = new Conexion();
	$sql = " 
		DELETE FROM tbl_intereses_x_usuario WHERE
	        codigo_usuario =".$codigoUsuario."
	    AND
	        codigo_categoria_interes =

	 ".$_GET["CODIGO_CATEGORIA"];
	$resultadoBorrar = $conexion->ejecutarInstruccion($sql);
	           
	break;

	case "7":
	include_once("../class/class-conexion.php");
	$conexion = new Conexion();
	if($_GET["TIPO"]==1){
			$sql = "
			UPDATE tbl_usuarios
		    SET
		        NOMBRE_USUARIO = '".$_GET["NOMBRE"]."'
		    WHERE
		        codigo_usuario =".$codigoUsuario;
		 }
	else{

		$sql = "
			UPDATE tbl_usuarios
		    SET
		        DESCRIPCION = '".$_GET["DESCRIPCION"]."'
		    WHERE
		        codigo_usuario =".$codigoUsuario
		     ;
	}

	$resultadoActualizar = $conexion->ejecutarInstruccion($sql);
	 $conexion->commit();  
	 ?>
			 <div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Sus datos han sidos actualizados</strong>
			</div>
	 <?php
	break;

case "8":


	include_once("../class/class-conexion.php");
	$conexion = new Conexion();
	$sql = "SELECT
    CONTRASENIA
        FROM
    tbl_usuarios
    where CODIGO_USUARIO=".$codigoUsuario;
	$resultadoContrasenia = $conexion->ejecutarInstruccion($sql);
	$rowContrasenia = $conexion->obtenerFila($resultadoContrasenia);
	$contrasenia=$rowContrasenia["CONTRASENIA"];
	     
   if($contrasenia==sha1($_GET["CONTRASENIA"])){

	     $sql = "
			UPDATE tbl_usuarios
		    SET
		        CORREO = '".$_GET["NUEVO_CORREO"]."'
		    WHERE
		        codigo_usuario =".$codigoUsuario;
		     $resultadoNuevoCorreo = $conexion->ejecutarInstruccion($sql);
		     $conexion->commit();
		     $respuesta=1;
			 echo $respuesta;
		
		      

	     } else {
	     	
      	 	 $respuesta=0;
			 echo $respuesta;
			 }
	     	

		
		      
	break;

	case "9":


	include_once("../class/class-conexion.php");
	$conexion = new Conexion();
	$sql = "SELECT
    CONTRASENIA
        FROM
    tbl_usuarios
    where CODIGO_USUARIO=".$codigoUsuario;
	$resultadoContrasenia = $conexion->ejecutarInstruccion($sql);
	$rowContrasenia = $conexion->obtenerFila($resultadoContrasenia);
	$contrasenia=$rowContrasenia["CONTRASENIA"];
   if($contrasenia==sha1($_GET["CONTRASENIA_ACTUAL"])){

	     $sql = "
			UPDATE tbl_usuarios
		    SET
		        CONTRASENIA = '".sha1($_GET["CONTRASENIA"])."'
		    WHERE
		        codigo_usuario =".$codigoUsuario;
		     $resultadoNuevoCorreo = $conexion->ejecutarInstruccion($sql);
		     $conexion->commit();
		     $respuesta=1;
			 echo $respuesta;
		
		      
	     } else {
	     	
      	 	 $respuesta=0;
			 echo $respuesta;
			 }
	     	

		
		      
	break;




}?>   <?php
 
?>