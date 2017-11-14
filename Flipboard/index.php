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
	<!--<a href="flipboard.php" class="btn btn-danger" style="position: absolute;bottom: 20px;right: 20px;max-width: 200px;">
		Explora Flipboard
	</a> -->
	<div class="container-fluid fondo">
		<div class="row col-md-12 col-xs-12 col-sm-12 col-lg-12">
			<div class="container-fluid">
				<div class="navbar-header">
		        	<img id="myimage" src="images/logo.png" class="logo">				
		        </div>
	        	<div class="collapse navbar-collapse right">
	        		<h6>¿Nuevo en Flipboard?
	        			<a class="btn btn-default" href="registro.php" role="button">Registrarse</a>
	        		</h6>
	        	</div>
			</div>
			<br><br>
			<div class="container" style="padding: 0px;">
				<div>
					<h1>INICIAR SESIÓN EN FLIPBOARD</h1>
					<br>
					<div class="row">
						<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
							<input class="form-control" type="text" id="correo_usuario" name="correo_usuario" placeholder="Nombre de usuario o correo electrónico" required autofocus><br>
      						<input class="form-control" type="password" name="contrasena" id="contrasena" placeholder="Contraseña" required><br>

      						<div id="div-resultado">
							
							</div>

							<br><br>
							<button class="btn btn-primary" name="btn-inicio" id="btn-inicio" data-loading-text="Ingresando...">INICIAR SESIÓN</button> 
							<br><br><br>

							<div class="col-xs-12 text-center">
						      	<p><a href="#" style="color: #fff;">¿Olvidaste tu nombre de usuario o contraseña?</a></p>
						    </div><br>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/inicio.js"></script>
</body>

<script>
	$(window).resize(fondo);
	$(document).ready(fondo);
	function fondo(){
		$(".fondo").css("height",$(window).height());
	}	
</script>
</html>