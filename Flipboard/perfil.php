

<head>
  <script type="text/javascript" src="js/perfil.js"></script>
  <script type="text/javascript" src="ckeditor/ckeditor.js"></script>

  <meta charset="utf-8">
  <title>Flipboard|Perfil</title>

  <link rel="icon" href="images/favicon.jpg">
  <link href="css/bootstrap.min.css" rel="stylesheet">  

  <link href="css/perfil.css" rel="stylesheet">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</head>

<div class="dropdown top-right">
    <h1 style="font-size: 14px; " class="dropdown-toggle" data-toggle="dropdown">Iniciaste sesión como 
    <span class="caret"></span></h1>
    <ul class="dropdown-menu" >
    <li><a style="font-size: 12px; color: black; font-family: inherit" href="#">Perfil Publico</a></li>
          <li class="divider"></li>

    <li><a style="font-size: 12px; color: black; font-family: inherit" href="#">Estadisticas</a></li>
          <li class="divider"></li>

    <li><a style="font-size: 12px; color: black; font-family: inherit" href="#">Configuración</a></li>
          <li class="divider"></li>

    <li><a style="font-size: 12px; color: black; font-family: inherit" href="#">Ayuda y Sugerencias</a></li>
          <li class="divider"></li>

    <li><a style="font-size: 12px; color: black; font-family: inherit" href="#">Politica de Privacidad</a></li>
          <li class="divider"></li>

    <li><a style="font-size: 12px; color: black; font-family: inherit" href="#">Conviertete en editor</a></li>
          <li class="divider"></li>

    <li><a style="font-size: 12px; color: black; font-family: inherit" href="#">Cerrar sesión</a></li>
    </ul>
  </div>








 <div  align="center" style="padding-top: 100px;">

      <div >
        
          
          <div class="circle-badge" style="background:#3E3F41">
           		<strong style="cursor: pointer;" >N</strong>
          </div>

          <div>
           <STRONG id="nombre_usuario" class="letras-nombre" onmousemove="mostrarIcono(1)"  onmouseout="ocultarIcono(1)">NOMBRE DE USUARIO</STRONG>
           
           <input  class="letras-nombre" type="text" hidden="true" value="NOMBRE DE USUARIO" id="txt-nombre-mod" >
    	<div id="div-imagen-editar-nombre" onclick="editarNombre()" onmousemove="mostrarIcono(1)" onmouseout="ocultarIcono(1)"> 
    	<img id="img-icono-nombre" style="visibility: hidden; cursor: pointer;"  src="images/editar.png">
        </div>
    	

	         <STRONG id="descripcion"  class="letras-descripcion" onmousemove="mostrarIcono(2)"  onmouseout="ocultarIcono(2)" >Escribe algo sobre ti</STRONG>

	         <input hidden="true" class="letras-descripcion" type="text" id="txt-descripcion-mod" value="Escribe algo sobre ti">
	    
      <div id="div-imagen-editar-descripcion" onmousemove="mostrarIcono(2)" onmouseout="ocultarIcono(2)"><img id="img-icono-descripcion" onclick="editarDescripcion()" style="visibility: hidden; cursor: pointer;"  src="images/editar.png">
        </div>

	        
	       </div><br><br>
          
          <div>
           <!-- Menu inferior -->


          <table class="menu-inferior" align="center">
           	<tr>
           	    <td onclick="cargarDetalles(1 )" id="1">
	           		<div style="padding-right: 20px;">
		           		<p class="item">1</p>
		           		<p >FLIPS</p>
	           	    </div>
           	    <td>
           	   		<div id="vertical-bar"></div>
           	    </td>
           		</td>
           		<td onclick="cargarDetalles(2)" id="2">
	           		<div style="padding-right: 20px;">
		           		<p class="item">2</p>
		           		<p >REVISTAS</p>
	           	    </div>
           		</td>
           		<td>
	           	    <div id="vertical-bar"></div>
	           	</td>
           		<td onclick="cargarDetalles(3)" id="3">
           		<div style="padding-right: 20px;">
	           		<p class="item">3</p>
	           		<p >'ME GUSTA'</p>
           	    </div>
           		</td>
           		<td>
           	    	<div id="vertical-bar"></div>
           	    </td>
           		<td onclick="cargarDetalles(4)" id="4">
           		<div style="padding-right: 20px;">
	           		<p class="item">1</p>
	           		<p >SIGUIENDO</p>
           	    </div>
           		</td>
           		<td>
           	    <div id="vertical-bar"></div>
           	    </td>
           		<td onclick="cargarDetalles(5)" id="5">
           		<div style="padding-right: 20px;">
	           		<p class="item">1</p>
	           		<p >INICIO</p>
           	    </div>
           		</td>
           		
           	</tr>
           </table>
           	<div id="div-contenido-principal" align="center" style="padding: 20px; align-content: center;"></div>

          </div>
      

      </div>
 
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
