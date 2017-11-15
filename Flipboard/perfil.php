
<?php
session_start();
if (isset($_SESSION['usuario'])) {
  $codigoUsuario = $_SESSION['usuario']['CODIGO_USUARIO'];
} else{
  header('Location: index.php');
}
//Buscar los scripts para la base en la carpeta con el mismo nombre

include_once("class/class-conexion.php");
$conexion = new Conexion();
$sql = "  SELECT  CODIGO_TIPO_USUARIO,
                  CODIGO_ESTADO_USUARIO,
                  substr(NOMBRE_USUARIO,1,1) AS INICIAL,
                  NOMBRE_USUARIO,
                  ALIAS_USUARIO,
                  URL_FOTO_PERFIL,
                  DESCRIPCION, 
                  CORREO
          FROM TBL_USUARIOS
          WHERE CODIGO_USUARIO =".$codigoUsuario;
$resultadoUsuario = $conexion->ejecutarInstruccion($sql);
$rowUsuario = $conexion->obtenerFila($resultadoUsuario);
?>


<?php  

  $sql = "  WITH A AS (
             SELECT D.CODIGO_USUARIO, COUNT(B.CODIGO_USUARIO_FLIP) as CANTIDAD_FLIPS
            FROM TBL_REVISTAS A
            LEFT JOIN TBL_FLIPS B
            ON(A.CODIGO_REVISTA=B.CODIGO_REVISTA)
            LEFT JOIN TBL_NOTICIAS C
            ON(B.CODIGO_NOTICIA=C.CODIGO_NOTICIA) 
            RIGHT JOIN TBL_USUARIOS D
            ON B.CODIGO_USUARIO_FLIP=D.CODIGO_USUARIO 
            group by D.CODIGO_USUARIO
            ),
            B AS(

             SELECT B.CODIGO_USUARIO, count(A.CODIGO_USUARIO)as CANTIDAD_REVISTAS FROM
              TBL_REVISTAS A
              RIGHT JOIN TBL_USUARIOS B
              ON A.CODIGO_USUARIO=B.CODIGO_USUARIO 
              group by B.CODIGO_USUARIO
            ),
            C AS(

             SELECT B.CODIGO_USUARIO, COUNT(A.CODIGO_USUARIO) CANTIDAD_LIKES
            FROM TBL_REACCIONES_X_NOTICIAS A
            RIGHT JOIN TBL_USUARIOS B
            ON (A.CODIGO_USUARIO=B.CODIGO_USUARIO)
            LEFT JOIN TBL_NOTICIAS C
            ON(C.CODIGO_NOTICIA=A.CODIGO_NOTICIA)
            group by B.CODIGO_USUARIO
            ),
            D AS(

            SELECT C.CODIGO_USUARIO, COUNT(A.CODIGO_SEGUIDOR) AS CANTIDAD_SEGUIENDO
            FROM TBL_REVISTAS_SEGUIDAS A
            LEFT JOIN TBL_REVISTAS B
            ON(A.CODIGO_REVISTA=B.CODIGO_REVISTA)
            RIGHT JOIN TBL_USUARIOS C
            ON (C.CODIGO_USUARIO=A.CODIGO_SEGUIDOR)
            LEFT JOIN TBL_USUARIOS D
            ON(D.CODIGO_USUARIO=B.CODIGO_USUARIO)
            group by C.CODIGO_USUARIO
            ),
            E AS(

             SELECT C.CODIGO_USUARIO, COUNT(A.CODIGO_USUARIO)  AS CANTIDAD_INTERESES
            FROM TBL_INTERESES_X_USUARIO A
            LEFT JOIN TBL_CATEGORIA B
            ON(A.CODIGO_CATEGORIA_INTERES=B.CODIGO_CATEGORIA)
           RIGHT JOIN TBL_USUARIOS C
            ON(C.CODIGO_USUARIO=A.CODIGO_USUARIO)
            group by C.CODIGO_USUARIO
            )
            SELECT A.CANTIDAD_FLIPS, B.CANTIDAD_REVISTAS, C.CANTIDAD_LIKES, D.CANTIDAD_SEGUIENDO, E.CANTIDAD_INTERESES
            FROM A,B,C,D,E
            WHERE
            (A.CODIGO_USUARIO=1)
            AND (B.CODIGO_USUARIO=".$codigoUsuario.")
            AND (C.CODIGO_USUARIO=".$codigoUsuario.")
            AND (D.CODIGO_USUARIO=".$codigoUsuario.")
            AND (E.CODIGO_USUARIO=".$codigoUsuario.")";
  $resultadoValoresIniciales = $conexion->ejecutarInstruccion($sql);
  $rowValoresIniciales = $conexion->obtenerFila($resultadoValoresIniciales);



?>





<!-- menu de cierre de sesion y configuracion -->
<div class="dropdown top-right">
    <h1  style="font-size: 14px; cursor: pointer; " class="dropdown-toggle" data-toggle="dropdown">Iniciaste sesión como <?php echo ($rowUsuario['NOMBRE_USUARIO']); ?>
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

    <li><a onclick="session_destroy()" style="font-size: 12px; color: black; font-family: inherit" href="cerrar_sesion.php">Cerrar sesión</a></li>
    </ul>
  </div>

 <div  align="center" style="padding-top: 100px;">
   <div >     
<!-- Logo, nombre y descripcion -->
      <div>     
        <table>
          <tr>

<center><input type="file"  id="files" onchange="upload_image();" style="display: none;"></center>
<div class="upload-msg"></div><!--Para mostrar la respuesta del archivo llamado via ajax -->

     <!-- <input type="file" name="files" id="files" style="display: none;">
       <div id="div-foto"></div>
           -->
           
          <div id="btn-perfil" class="nav-item" data-toggle="popover" data-placement="left" data-content="Foto Perfil" data-trigger="hover">
            <a class="nav-item"  onclick="cambiarFoto()" >
              <div style="padding-top: 5px;">
             
                <div id="imagen_actual" class="miniatura-usuario" style="margin: auto;background-image: url('<?php echo $rowUsuario["URL_FOTO_PERFIL"]; ?>');width: 120px;height: 120px;padding: 0px; display" >


                      <?php
                      if(is_null($rowUsuario["URL_FOTO_PERFIL"])){
                        ?>
                            <br>
                                <div style="font-size: 50px; font-weight: bold;"><?php echo ($rowUsuario['INICIAL']); ?></div>  
                               
                           
                         
                      <?php
                      }
                      ?>
                </div>
              </div>
            </a>
          </div>




          </tr>
           <tr>
              <td >
                <input onclick="editarConfiguracion('nombre-principal')" onmousemove="mostrarIcono(1)" onmouseout="ocultarIcono(1)"  class="texto-no-editable letras-nombre" type="text" id="nombre-principal" size="40" maxlength="20" value=" <?php echo ($rowUsuario['NOMBRE_USUARIO']); ?>" 
                onkeypress="return enter(event,'nombre-principal'),cambiarDatos(event) ">
              </td>
              <td>
                <div id="div-imagen-editar-nombre" onclick="editarConfiguracion('nombre-principal')" onmousemove="mostrarIcono(1)" onmouseout="ocultarIcono(1)"> 
                  <img id="img-icono-nombre" style="visibility: hidden; cursor: pointer;"  src="images/editar.png"></div>

              </td>
           </tr>
            <tr>
              <td>
                 <input onclick="editarConfiguracion('descripcion')" onmousemove="mostrarIcono(2)" onmouseout="ocultarIcono(2)"   class="texto-no-editable letras-descripcion" type="text" id="descripcion" size="100" maxlength="100" value=" <?php 
                 if ($rowUsuario['DESCRIPCION']==null) 
                  echo "Escribe algo sobre ti" ;
                     else  echo ($rowUsuario['DESCRIPCION']); 
                     ?>" onkeypress="return enter(event,'descripcion'),cambiarDatos(event)">
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
		           		<p class="item"><?php if ($rowValoresIniciales["CANTIDAD_FLIPS"]==null) 
                  echo "0"; else echo $rowValoresIniciales["CANTIDAD_FLIPS"];   ?></p>
		           		<p >FLIPS</p>
	           	    </div>
           	    <td>
           	   		<div id="vertical-bar"></div>
           	    </td>
           		</td>
           		<td onclick="cargarDetalles(2)" id="2">
	           		<div style="padding-right: 20px;">
		           		<p class="item"><?php if ($rowValoresIniciales["CANTIDAD_REVISTAS"]==null) 
                  echo "0"; else echo $rowValoresIniciales["CANTIDAD_REVISTAS"];   ?></p>
		           		<p >REVISTAS</p>
	           	    </div>
           		</td>
           		<td>
	           	    <div id="vertical-bar"></div>
	           	</td>
           		<td onclick="cargarDetalles(3)" id="3">
           		<div style="padding-right: 20px;">
	           		<p class="item"><?php if ($rowValoresIniciales["CANTIDAD_LIKES"]==null) 
                  echo "0"; else echo $rowValoresIniciales["CANTIDAD_LIKES"];   ?></p>
	           		<p >'ME GUSTA'</p>
           	    </div>
           		</td>
           		<td>
           	    	<div id="vertical-bar"></div>
           	    </td>
           		<td onclick="cargarDetalles(4)" id="4">
           		<div style="padding-right: 20px;">
	           		<p class="item"><?php if ($rowValoresIniciales["CANTIDAD_SEGUIENDO"]==null) 
                  echo "0"; else echo $rowValoresIniciales["CANTIDAD_SEGUIENDO"];   ?></p>
	           		<p >SIGUIENDO</p>
           	    </div>
           		</td>
           		<td>
           	    <div id="vertical-bar"></div>
           	    </td>
           		<td onclick="cargarDetalles(5)" id="5">
           		<div style="padding-right: 20px;">
	           		<p class="item"><?php if ($rowValoresIniciales["CANTIDAD_INTERESES"]==null) 
                  echo "0"; else echo $rowValoresIniciales["CANTIDAD_INTERESES"];   ?></p>
	           		<p >INICIO</p>
           	    </div>
           		</td>
           		
           	</tr>
           </table>
                  <div class="container-fluid" id="div-contenido-principal">  
                        
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
    <div id="conf-mensajes"></div>
   
<br>
<h1 style="font-size: 14px; font-weight: bold; ">Configuración de cuenta</h1>
<table  class="table" style="border-spacing: 0px; font-size: 14px; border: 0px;">
   <tr>
      <td><input onclick="editarConfiguracion('nombre-usuario-conf')" class="texto-no-editable" type="text" id="nombre-usuario-conf" size="40" maxlength="256" value="<?php echo ($rowUsuario['NOMBRE_USUARIO']); ?>" onkeypress=" return enter(event,'nombre-usuario-conf'),nuevoNombreConf(event)" ></td>
        <td class="edt" onclick="editarConfiguracion('nombre-usuario-conf')">Editar</td>
   </tr>
  <tr>
      <td><input  class="texto-no-editable" type="text" id="correo" size="40" maxlength="256" value="<?php echo ($rowUsuario['CORREO']); ?>" readonly></td>
        <td class="edt" id="edt-correo" onclick="cambiarCorreo()">Editar</td>
   </tr>
   <tr id="menu-cambiar-correo" style="display:none;">
     <td colspan="2">
        <div  >
          <input class="form-control" id="txt-email" type="email" placeholder="Nuevo Correo"><br>
          <input class="form-control" id="txt-password" type="password" placeholder="Contraseña Actual"><br>
          <input class="form-control" onclick="nuevoCorreo()" type="button" value="CAMBIAR CORREO" name="">
        </div>
     </td>
   </tr>
  <tr>
    <td><input  class="texto-no-editable" type="text" id="contrasena" size="40" maxlength="256" value="CONTRASEÑA" ></td>
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
  
     
        <script>
              function archivo(evt) {
                  var files = evt.target.files; // FileList object
             
                  // Obtenemos la imagen del campo "file".
                  for (var i = 0, f; f = files[i]; i++) {
                    //Solo admitimos imágenes.
                    if (!f.type.match('image.*')) {
                        continue;
                    }
             
                    var reader = new FileReader();
             
                    reader.onload = (function(theFile) {
                        return function(e) {
                          // Insertamos la imagen

               document.getElementById("imagen_actual").innerHTML = ['<img class="miniatura-usuario" src="', e.target.result,'" style="margin: auto; width: 120px;height: 120px;padding: 0px; object-fit: cover; display"  title="' , escape(theFile.name), '"/>'].join('');
                        };
                    })(f);
             
                    reader.readAsDataURL(f);
                  }
              }
             
              document.getElementById('files').addEventListener('change', archivo, false);

      </script>

       <script src="js/perfil-operaciones.js"></script>
