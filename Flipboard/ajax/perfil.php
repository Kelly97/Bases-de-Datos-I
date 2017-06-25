<link rel="stylesheet" type="text/css" href="../css/perfil.css">
<link rel="icon" href="../images/favicon.jpg">
<link href="../css/bootstrap.min.css" rel="stylesheet">  
<link href="../css/font-awesome.css" rel="stylesheet">

<link rel="../stylesheet" href="../css/slick.css">
<link rel="../stylesheet" type="text/css" href="../css/slick-theme.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
 




 <div  align="center" style="padding-top: 100px;">
	<div class="row">
      <div >
        
          
          <div class="circle-badge" style="background:#3E3F41">
           		<strong style="cursor: pointer;" >N</strong>
          </div>

          <div>
           <STRONG id="nombre_usuario" class="letras-nombre" onmousemove="mostrarIcono(1)"  onmouseout="ocultarIcono(1)">NOMBRE DE USUARIO</STRONG>
           
           <input  class="letras-nombre" type="text" hidden="true" value="NOMBRE DE USUARIO" id="txt-nombre-mod" >
    	<div id="div-imagen-editar-nombre" onclick="editarNombre()" onmousemove="mostrarIcono(1)" onmouseout="ocultarIcono(1)"> 
    	<img id="img-icono-nombre" style="visibility: hidden; cursor: pointer;"  src="../images/editar.png">
        </div>
    	

	         <STRONG id="descripcion"  class="letras-descripcion" onmousemove="mostrarIcono(2)"  onmouseout="ocultarIcono(2)" >Escribe algo sobre ti</STRONG>

	         <input hidden="true" class="letras-descripcion" type="text" id="txt-descripcion-mod" value="Escribe algo sobre ti">
	    
      <div id="div-imagen-editar-descripcion" onmousemove="mostrarIcono(2)" onmouseout="ocultarIcono(2)"><img id="img-icono-descripcion" onclick="editarDescripcion()" style="visibility: hidden; cursor: pointer;"  src="../images/editar.png">
        </div>

	        
	       </div><br><br>
          
          <div>
           <!-- Menu inferior -->


           <table class="menu-inferior">
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
           	<div id="div-contenido-principal" align="center" style="padding: 30px;"></div>

          </div>
      

      </div>
    </div>
</div>



 <script src="../js/bootstrap.min.js"></script>
 <script src="../js/perfil.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <script src="../js/slick.min.js"></script>

