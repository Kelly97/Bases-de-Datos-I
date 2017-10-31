


<?php  
switch ($_GET["accion"]) {
	case "1":
	?>
	 <div class="row">
		  <div class="col-lg-12 col-md-12" style="text-align: center;padding-bottom: 40px;">
			 
		  </div>

	<?php 
	for ($i=0; $i <5 ; $i++) { 
		
	
		?>

			<div class="card noti-card" style="position: relative;">
				<div class="botones-noticia-general">
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
				<div  style="margin-bottom: 10px; height: 50px; ">
					<div class="row" align="left" >

					      <div class="col-lg-1 col-md-2 col-sm-2 col-2 col-xl-1" style="padding:0px;" align="left">
					      	<div class="miniatura-usuario" style="margin: auto;background-image: url('images/noticias/img_prueba_3.jpg');width: 40px;height: 40px;padding: 0px;">
									<table style="height: 100%;width: 100%;font-size: 15px;font-weight: bold;">
										<tbody>
											<tr>
												<td class="align-middle text-center">
													N
												</td>
											</tr>
										</tbody>
									</table>
							  </div>         
					      </div>
						      
					      <div class="col-lg-11 col-md-10 col-sm-10 col-10 col-xl-11" >
					      	<table style="height: 100%;">
					      		<tbody>
					      			<tr>
								      	<td class="align-middle">
									        <p class="card-text" style="margin-bottom: -8px;">      
									        	Nombre Usuarion        	
									        </p> 
									        <p style="padding: 0px;margin:0px;"> 
									        	<span style="color: #09c;font-size: 12px;">Revista</span>   
									        	<span style="color: gray;font-size: 12px;">23h</span> 
									        </p> 
								        </td> 
							    	</tr>
						        </tbody>
					        </table>  
					      </div> 
					</div>
			   </div>  
			  <img class="card-img-top" src="images/noticias/img_prueba_2.jpeg" alt="Card image cap">
			  <div class="card-body" style="text-align: justify;">
			    <h4 class="card-title">Titulo Noticia</h4>
			    <span class="noti-card-autor">Autor o propietario de noticia</span>
			    <p class="card-text">Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se deen ingresó como texto de relleno en documentos electrónicostware de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p>
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
	for ($i=0; $i <6 ; $i++) { 
		
	
		?>

 <div class="col-md-4">
    <div class="thumbnail">
 
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
	<?php 
	for ($i=0; $i <5 ; $i++) { 	
	
		?>
  <div class="col-md-2" style="padding: 20px;">
    <div class="thumbnail">
	            <div class="container">
				  <img  src="images/inicio/foto_2.jpg" alt="Avatar" class="image imagen-editar" style="width:170px; height: 250px; ; object-fit: cover; ">
				  <div class="top-center">Nombre Revista</div>
				  
				  <div class="middle  center" style="width: 170px;">

				   <i class="fa fa-line-chart" style="color: white; cursor: pointer;" aria-hidden="true"></i> &nbsp;&nbsp;
				    <input onclick="location.href='editor.php';" class="btn btn-default btn-editar  "  style="cursor: pointer;" type="button" name="Editar" value="Editar"> &nbsp;&nbsp;
				    <i class="fa fa-envelope-o" style="color: white; cursor: pointer; " aria-hidden="true"></i>
				   
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
	?>
	  	   <div class="row">

	<?php 
	for ($i=0; $i <4 ; $i++) { 	
	
		?>
		    
 <div class="col-md-2" style="padding: 20px;">
    <div class="thumbnail">
	         <div class="container">
				  <img  src="images/inicio/foto_3.jpg" alt="Avatar" class="image imagen-editar" style="width:170px; height: 250px; ; object-fit: cover; ">
				  <div class="top-center">Numero Edicion</div>
				  <div class="center" style="color: white; top: 90%; font-size: 10px;">Creador</div>
	        </div>
	 </div>
</div>
	    
	<?php
} ?><div> <?php
	break;








case "5":
	?>
		 <div class="row">
	<?php 
	for ($i=0; $i <10 ; $i++) { 	
	
		?>
		    
	    <div class="col-md-2" style="padding: 20px;">
    <div class="thumbnail">
	            <div class="container">
				  <img  src="images/inicio/foto_4.jpg" alt="Avatar" class="image imagen-editar" style="width:170px; height: 250px; ; object-fit: cover; ">
				  <div class="topcenter" style="float:left;">Categoria</div>
				  <i class="fa fa-times topright" style="color: white;" aria-hidden="true"></i>
				  
				  <div class="middle  center" style="width: 170px;">

				    <i class="fa fa-envelope-o" style="color: white; cursor: pointer; " aria-hidden="true"></i>
				   
				    <span></span>
				  </div>
				</div>
	  
	 </div>
</div>
	
						

	<?php
}
	break;




}?><div> <?php
 
?>