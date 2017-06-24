<?php

switch ($_POST["codigo"]) {
	case 0:
		?>
		<div class="row">
		  <div class="col-lg-12 col-md-12" style="text-align: center;padding-bottom: 40px;">
			  <h2>Noticias de Portada</h2>
			  <h5 style="color: #999;">Noticias de gran relevancia en un solo lugar</h5>
		  </div>

		  <div class="col-lg-4 col-md-6">
		    <div class="thumbnail" style="position: relative;">		    
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
		      <div class="caption">
		        <h3>Titulo Noticia</h3>
		        <h5>Autor o propietario de noticia</h5>
		        <p style="text-align: justify;">Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó en. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicostware de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p>
		        <p>
		        	5 
		        	<i class="fa fa-heart" aria-hidden="true" style="font-size: 13px;padding-right: 8px;">
			        </i>
		        	<a class="btn btn-default" role="button">
			        	<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 13px;padding-right: 8px;">
			        		
			        	</i>
			        	Añadir Comentario
		        	</a>
		        </p>
		      </div>
		    </div>
		  </div>	

		  	  
		</div>
		<?php
		break;	
	default:
		echo "Adios";
		# code...
		break;
}
?>