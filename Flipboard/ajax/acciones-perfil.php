<?php  
switch ($_GET["accion"]) {
	case "1":
	?>
	 <div class="row">
		  <div class="col-lg-12 col-md-12" style="text-align: center;padding-bottom: 40px;">
			 
		  </div>

	<?php 
	for ($i=0; $i <2 ; $i++) { 
		
	
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
		  <div class="col-lg-12 col-md-12" style="text-align: center;padding-bottom: 40px;">
			 
		  </div>

	<?php 
	for ($i=0; $i <2 ; $i++) { 
		
	
		?>


		
		  <div class="col-lg-4 col-md-6">
		    <div class="thumbnail" style="position: relative;">		
		      
		    
		   
		      <div class="botones-noticia">
		      	<button type="button" class="btn btn-danger btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Flipear" data-trigger="hover">
		      		<i class="fa fa-plus" aria-hidden="true"></i>
		      	</button><br>
		      	<button type="button" class="btn btn-default btn-circle" data-container="body" data-toggle="popover" data-placement="left" data-content="Me gusta" data-trigger="hover">
		      		<i  class="fa fa-heart-o" aria-hidden="true"></i>
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

}

?>