


<!-- menu de cierre de sesion y configuracion -->
<div class="dropdown top-right">
    <h1  style="font-size: 14px; cursor: pointer; " class="dropdown-toggle" data-toggle="dropdown">Iniciaste sesión como 
    <span class="caret"></span></h1>
    <ul class="dropdown-menu" >
    <li><a style="font-size: 12px; color: black; font-family: inherit" href="#">Perfil Publico</a></li>
          <li class="divider"></li>

    <li><a style="font-size: 12px; color: black; font-family: inherit" href="#">Estadisticas</a></li>
          <li class="divider"></li>

    <li><a   style="font-size: 12px; color: black; font-family: inherit"  href=" javascript:$('#myModal').modal('show');">Configuración</a></li>
          <li class="divider"></li>

    <li><a style="font-size: 12px; color: black; font-family: inherit" href="#">Ayuda y Sugerencias</a></li>
          <li class="divider"></li>

    <li><a style="font-size: 12px; color: black; font-family: inherit" href="#">Politica de Privacidad</a></li>
          <li class="divider"></li>

    <li><a style="font-size: 12px; color: black; font-family: inherit" href="#">Conviertete en editor</a></li>
          <li class="divider"></li>

    <li><a style="font-size: 12px; color: black; font-family: inherit" href="cerrar_sesion.php">Cerrar sesión</a></li>
    </ul>
  </div>

 <div  align="center" style="padding-top: 100px;">
   <div >     
<!-- Logo, nombre y descripcion -->
      <div>     
        <table>
          <tr>
             <td colspan="2">
               <div class="circle-badge" style="background:#3E3F41">
                      <strong style="cursor: pointer;" >N</strong>
                </div>
             </td> 
          </tr>
           <tr>
              <td >
                <input onmousemove="mostrarIcono(1)" onmouseout="ocultarIcono(1)"  class="texto-no-editable letras-nombre" type="text" id="nombre-principal" size="40" maxlength="20" value="NOMBRE DE USUARIO" onkeypress="return enter(event,'nombre-principal')">
              </td>
              <td>
                <div id="div-imagen-editar-nombre" onclick="editarConfiguracion('nombre-principal')" onmousemove="mostrarIcono(1)" onmouseout="ocultarIcono(1)"> 
                  <img id="img-icono-nombre" style="visibility: hidden; cursor: pointer;"  src="images/editar.png"></div>

              </td>
           </tr>
            <tr>
              <td>
                 <input onmousemove="mostrarIcono(2)" onmouseout="ocultarIcono(2)"   class="texto-no-editable letras-descripcion" type="text" id="descripcion" size="40" maxlength="20" value="Escribe algo sobre ti" onkeypress="return enter(event,'descripcion')">
              </td>
              <td>
                <div id="div-imagen-editar-descripcion" onmousemove="mostrarIcono(2)" onmouseout="ocultarIcono(2)" onclick="editarConfiguracion('descripcion')">
                  <img id="img-icono-descripcion" " style="visibility: hidden; cursor: pointer;"  src="images/editar.png"> </div>

              </td>
           </tr>
        </table>
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
                  <div class="container-fluid">  
                    <div id="div-contenido-principal" style="align-items: center" class="col-lg-12" style="padding: 0px;">
                      </div>    
                  </div>

          </div>
      

      </div>
 
</div>


  <!-- Modal -->
<div  class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="width: 100%; height: 100%;" aria-hidden="true" >
    <div class="modal-dialog" role="document">
    
      <!-- Modal content-->
      <div class="modal-content" >
          <button class="top-right close" type="button"   data-dismiss="modal">&times;</button><br>
          <h1 align="center" style="font-size: 16px; font-weight: bold; ">Configuración</h1>
    <div class="modal-body">
   
<br>
<h1 style="font-size: 14px; font-weight: bold; ">Configuración de cuenta</h1>
<table  class="table" style="border-spacing: 0px; font-size: 14px; border: 0px;">
   <tr>
      <td><input  class="texto-no-editable" type="text" id="nombre-usuario" size="40" maxlength="256" value="Nombre de Usuario" onkeypress="return enter(event,'nombre-usuario')"></td>
        <td class="edt" onclick="editarConfiguracion('nombre-usuario')">Editar</td>
   </tr>
  <tr>
      <td><input  class="texto-no-editable" type="text" id="correo" size="40" maxlength="256" value="Correo" readonly></td>
        <td class="edt" id="edt-correo" onclick="cambiarCorreo()">Editar</td>
   </tr>
   <tr id="menu-cambiar-correo" style="display:none;">
     <td colspan="2">
        <div  >
          <input class="form-control" type="text" placeholder="Nuevo Correo"><br>
          <input class="form-control" type="text" placeholder="Contraseña Actual"><br>
          <input class="form-control" type="button" value="CAMBIAR CORREO" name="">
        </div>
     </td>
   </tr>
  <tr>
    <td><input  class="texto-no-editable" type="text" id="contrasena" size="40" maxlength="256" value="Contraseña" ></td>
    <td class="edt" id="edt-contrasena" onclick="cambiarContrasena()">Editar</td>
  </tr>
  <tr  id="menu-cambiar-contrasena" style="display:none;" >
     <td colspan="2">
        <div>
          <input class="form-control" type="text" placeholder="Contraseña actual"><br>
          <input class="form-control" type="text" placeholder="Nueva Contraseña"><br>
          <input class="form-control" type="text" placeholder="Confirmar Contraseña"><br>
          <input class="form-control" type="button" value="CAMBIAR CONTRASEÑA" name="">
        </div>
     </td>
   </tr>





</table>
<br><br>
<h1 style="font-size: 14px; font-weight: bold;"> Configuración de correos electronicos</h1>
<table  class="table" style="font-size: 14px;">
   <tr>
      <td>Recomendaciones de contenido</td>
       <td> <input type="checkbox" name=""  checked> </td>
   </tr>
  <tr>
      <td>Acerca de tus revistas</td>
       <td><input type="checkbox" name=""  checked> </td>
   </tr>
  <tr>
      <td>Acerca de tus amigos</td>
       <td><input type="checkbox" name=""  checked> </td>
   </tr>
<tr>
      <td>Actualizaciones del producto y educación</td>
       <td><input type="checkbox" name="" checked> </td>
   </tr>
<tr>
      <td>Actualizaciones de la comunidad</td>
       <td><input type="checkbox" name=""  checked> </td>
   </tr>
<tr>
      <td>Resumen diario (Diez para hoy, Selecciones de Flipboard, etc.)</td>
       <td><input type="checkbox" name=""  checked> </td>
   </tr>
</table>

<a style="font-size: 14px;" href="">Resend Confirmation Email</a><br>
<a style="font-size: 14px;" href="">Eliminar Cuenta</a>

        </div>
        <div class="modal-footer">
          
        </div>
      </div>
      
    </div>
  </div>
  
