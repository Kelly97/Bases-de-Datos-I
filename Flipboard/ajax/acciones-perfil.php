<style type="text/css">
		#imagen {
			width:305px;
			height:50px;
			position:relative;
		}
		#imagen>div
		{
			background-color: #000;
			position: absolute;
			bottom:25px;
			color:#fff;
			padding:2px 10px;
			font-weight:bold;
		}

		#inicio {
			position:relative;
		}
		#inicio>div
		{
			position: absolute;
			bottom:25px;
			color:#fff;
			padding:2px 10px;
			font-weight:bold;
			text-align: center;
		}
	</style>


<?php  
switch ($_GET["accion"]) {
	case "1":
	?>
	 <div class="row">
		  <div class="col-lg-12 col-md-12" style="text-align: center;padding-bottom: 40px;">
			 
		  </div>

	<?php 
	for ($i=0; $i <1 ; $i++) { 
		
	
		?>


		
		  <div class="col-lg-4 col-md-6">
		    <div class="thumbnail" style="position: relative;">		
		      
		      <div align="left" style="padding: 5px">
		      	   <p style="margin: 0px;">NOMBRE USUARIO</p>
			  	   <p style="color: #ACDEEE; margin: 0px;">Favorito</p> <p>4d</p> 
		      </div>
		   
		      <div class="botones-noticia">
		      	<button type="button" class="btn btn-danger btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Flipear" data-trigger="hover">
		      		<i class="fa fa-plus" aria-hidden="true"></i>
		      	</button><br>
		      	<button type="button" class="btn btn-default btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Me gusta" data-trigger="hover">
		      		<i class="fa fa-heart-o" aria-hidden="true"></i>
		      	</button><br>
		      	<button type="button" class="btn btn-default btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Compartir" data-trigger="hover">
		      		<i class="fa fa-envelope-o" aria-hidden="true"></i>
		      	</button>
		      </div>
		      <img src="images/img_prueba.jpg" alt="...">
		      <div class="caption" align="left">
		        <h3>Titulo Noticia</h3>
		        <h5>Autor o propietario de noticia</h5>
		        
		        <p><a class="btn btn-default" role="button">
		        	<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 13px;padding-right: 8px;"></i>
		        	Añadir Comentario
		        </a></p>
		      </div>
		    </div>
		  </div>	

	<?php
}
	break;

	case "3":
	?>
	 
 <div class="row">
 

	<?php 
	for ($i=0; $i <2 ; $i++) { 
		
	
		?>

 <div class="col-md-4">
    <div class="thumbnail">
 
 	<div class="botones-noticia">
		      	<button type="button" class="btn btn-danger btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Flipear" data-trigger="hover">
		      		<i class="fa fa-plus" aria-hidden="true"></i>
		      	</button><br>
		      	<button type="button" class="btn btn-default btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Me gusta" data-trigger="hover">
		      		<span class="glyphicon glyphicon-heart"></span>
		      	</button><br>
		      	<button type="button" class="btn btn-default btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Compartir" data-trigger="hover">
		      		<i class="fa fa-envelope-o" aria-hidden="true"></i>
		      	</button>
	 </div>

     
        <img src="images/noticias/img_prueba.jpg" alt="Lights" style="width:100%">
        <div class="caption" align="left">
		        <h3>Titulo Noticia</h3>
		        <h5>Autor o propietario de noticia</h5>
		        
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
		  <div class="col-lg-12 col-md-12" style="text-align: center;padding-bottom: 40px;">
			 
		  </div>

	<?php 
	for ($i=0; $i <6 ; $i++) { 
		
	
		?>


		
	<div class="col-lg-4 col-md-6" style="width: 170px; height: 225px; cursor: pointer;">
		    <div class="thumbnail" style="position: relative; width: 170px; height: 225px;">		
            <div style="width: 170px; height: 225px; cursor: pointer;" align="center">
		    <div class="thumbnail" style="position: relative; width: 170px; height: 225px;">	   
		    <div class="botones-noticia">
		      	    <i style="color: #fff; font-size: 25px;" class="fa fa-line-chart" aria-hidden="true"></i>&nbsp;&nbsp;
		      	    <button class="transparente">Editar</button>&nbsp;&nbsp;
		      		<i style="color: #fff; font-size: 25px;" class="fa fa-envelope-o" aria-hidden="true"></i>
		    </div>
		    <img style="width: 170px; height: 225px;" src="images/revista.jpg" alt="...">
		    </div>
		
 		</div>
		     
		    </div>
    </div>	

	<?php
}
	break;

	case "4":
	?>
	 <div class="row">
		  <div class="col-lg-12 col-md-12" style="text-align: center;padding-bottom: 40px;">
			 
		  </div>

	<?php 
	for ($i=0; $i <3 ; $i++) { 	
	
		?>
		<div class="col-lg-4 col-md-4" style="width: 170px; height: 225px; cursor: pointer;">
		<div class="thumbnail" style="position: relative; width: 170px; height: 225px;">  <div style="width: 170px; height: 225px; cursor: pointer;" align="center">
		    <div class="thumbnail" style="position: relative; width: 170px; height: 225px;">
			    <div id="imagen">
					<img src="images/perfil.jpg" class="img-rounded" alt="Cinque Terre" width="304" height="236">
					<div>Nombre Seguidor</div>
	           </div>  
		  </div>
 		 </div>     
	    </div>
       </div>	




	<?php
}
	break;

case "5":
	?>
	  <div class="row" style="padding-left: 200px;">
		  <div class="col-lg-12 col-md-12" style="text-align: center;padding-bottom: 40px;" align="center">
			 
		  </div>
	<?php 
	for ($i=0; $i <4 ; $i++) { 	
	
		?>
		  <div style=" width:181; height:237 cursor: pointer; ">
		  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
			    <div id="inicio">
					<img src="images/inicio/fotos.jpg" class="img-rounded" alt="Cinque Terre" width="181" height="237">
					<div>Nombre Categoria</div>

	           </div>  
 		 </div>     
	    
	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php
}
	break;




}
 
?>