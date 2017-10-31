<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <link href="bootstrap3/css/bootstrap.min.css" rel="stylesheet"> 
	   <link href="css/perfil-editor.css" rel="stylesheet">

 
</head>
<body>


<table border="0" style="width: 90%; height: 90%; margin-left: 20px; margin-top: 60px; border-color: black;">
	<tr >
	<!--Menu lateral-->
		<td style="width: 15%;">
				  
			   <!--Imagen, nombre y descricion de revista-->
			  	<div onmousemove="restablecerPortada('1')" onmouseout="restablecerPortada('2')" >
			  		<div>
			  		  <div>
						  <img src="images/background/album.jpg" style="width: 230px; height: 150px;">
						  <p>Nombre del Album</p>
						  <p class="texto-inferior">Descripcion</p>
			  		  </div>
			  		</div>
			  		<br><br><br><br><br><br>

			  		<button class="btn-portada btn btn-default" id="btn-cambiar-portada">Restablecer portada</button>
					
			  	</div>
			  	<!-- Menu lateral inferior-->
			  <br><div id="menu-inferior">
				  <div id="item-menu-1" class=" seleccionado  elemento-menu">
	  				<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
	  				&nbsp;&nbsp;&nbsp;
	  				<label  class="puntero" onclick="seleccionado('item-menu-1'),cargarDetalles(3,1)">STORIES</label>
				  </div> <br>
				   <div id="item-menu-2"  class=" elemento-menu">
	  				<span  class="glyphicon glyphicon-user" aria-hidden="true"></span>
	  				&nbsp;&nbsp;&nbsp;
	  				<label onclick="seleccionado('item-menu-2'), cargarDetalles(3,2)" class="puntero">COLABORADORES</label>
				  </div> <br>
				   <div id="item-menu-3" class="elemento-menu">
	  				<span class="glyphicon glyphicon-stats" aria-hidden="true"></span>
	  				&nbsp;&nbsp;&nbsp;
	  				<label onclick="seleccionado('item-menu-3'), cargarDetalles(3,3)" class="puntero">ESTADÍSTICAS</label>
				  </div> <br>
				   <div id="item-menu-4" class="elemento-menu">
	  				<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
	  				&nbsp;&nbsp;&nbsp;
	  				<label onclick="seleccionado('item-menu-4'),cargarDetalles(3,4)" class="puntero">CONFIGURACIÓN</label>
				  </div> 
			  </div>
		</td>

	    <td  bgcolor="#B3B3B3" style="width:0.5px; ">
			|
		</td>
	<!--Menu Principal-->
		<td  align="center" style="width: 120%;">
<div id="contenido-principal">
				
	
    	

</div>	
		</td>
	</tr>
</table>




<script src="bootstrap3/js/bootstrap.min.js"></script>
<script src="js/perfil-editor.js"></script>
<script type="text/javascript" src="js/jquery-3.2.1"></script>

</body>


</html>