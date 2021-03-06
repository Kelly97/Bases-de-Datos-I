<?php
    session_start();

    if (isset($_SESSION['usuario'])) {
      header('Location:flipboard.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Flipboard</title>
	<link rel="icon" href="images/favicon.jpg">
    <link href="css/bootstrap.min.css" rel="stylesheet">  
    <link href="css/inicio_registro.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body>
	<div class="container-fluid fondo">
		<div class="row col-md-12 col-xs-12 col-sm-12 col-lg-12">
			<div class="container-fluid">
				<div class="navbar-header">
		        	<img id="myimage" src="images/logo.png" class="logo">				
		        </div>
	        	<div class="collapse navbar-collapse right">
	        		<h6>¿Ya usas Flipboard?
	        		<a class="btn btn-default" href="index.php" role="button">Iniciar Sesión</a>
	        		</h6>
	        	</div>
			</div>
			<div class="container">
				<div>
					<h1>FLIPBOARD ES TU REVISTA PERSONAL</h1><br>
					<h4>Con historias de todo el mundo, es un único lugar para seguir los temas y las personas que te interesan.</h4>
					<br>
					<div class="row">
						<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
							<input class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre de usuario" required autofocus><br>
							<input class="form-control" type="text" id="correo" name="correo" placeholder="Correo electrónico" required><br>
      						<input class="form-control" type="password" name="contrasena" id="contrasena" placeholder="Contraseña" required><br>

      						<div id="div-resultado">							
							</div>	

							<br>					
							<button class="btn btn-primary" name="btn-registro" id="btn-registro" data-loading-text="Guardando...">REGISTRARSE</button> 
							<br><br>
							<div class="col-xs-12 text-center">
						      	<p>Al continuar, aceptas los Terminos de Uso y Politicas de Privacidad.</p>
						    </div>
						</div>						
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/registro.js"></script>
    <script>
    	$(window).resize(fondo);
		$(document).ready(fondo);
		function fondo(){
			if($(".fondo").height()<$(window).height()){
				$(".fondo").css("height",$(window).height());
			}		
		}
    </script>
</body>
</html>