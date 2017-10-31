
<?php

switch ($_GET["accion"]) {
	case "1":

	break;


	case "2":
			echo'
			<div>
			<div style="font-weight: bold;">INVITA A OTROS A COLABORAR</div><br>
			<div style="color: #b3b3b3;text-align: center;">Recopila y comparte artículos con otros.</div>
			<div style="color: #b3b3b3;text-align: center;">Invita gente a esta revista.</div><br>

			
				<table  align="center" style="border: 1px solid #000; border-color:#b3b3b3;  ">
					<tr>
						<td style="border: none; padding: 5px;">
							<input type="text" id="url" style="font-weight: bold; border: 0px; outline:0px;" value="http://flip.it/fyb4NG" >
						</td>
						<td style="border: none; padding: 10px;">
							<div id style="color: #b3b3b3; cursor: pointer; width: 130px; "  align="right" onclick="selecionarTexto()">Haz clic para copiar</div>
						</td>
					</tr>
				</table>
				<br>

				<div style="color: #b3b3b3; display: inline;">O envía una invitación</div>
				<img  src="images/social/fb.png" style="width: 50px; height: 50px; display: inline;">
				<img src="images/social/gm.png" style="width: 50px; height: 50px; display: inline;">
		
		</div>

			';
    break;
	 
	case "4":
	?>
		
				<table border="0"  style="border-spacing: 0px; font-size: 14px; border: 0px;">
    		<tr>
    			<td colspan="2">
				    <div align="left">
					 <div style="font-weight: bold; font-size: 16px;">Información de la revista</div>
				    </div>	
    			</td>
    		</tr>
		   <tr>
		      <td><input style="outline: 0;"  class="texto-no-editable" type="text" id="nombre" size="40" maxlength="256" value="NOMBRE REVISTA" onkeypress="return enter(event,"nombre-usuario")"></td>
		        <td class="edt" onclick="editarConfiguracion('nombre')">Editar</td>
		   </tr>
		 	<tr>
		      <td><input  style="outline: 0;"  class="texto-no-editable" type="text" id="descricion" size="40" maxlength="256" value="DESCRIPCION" onkeypress="return enter(event,"nombre-usuario")"></td>
		        <td class="edt" onclick="editarConfiguracion('descricion')">Editar</td>

		   </tr>
		   <tr>
			   	<td colspan="2">
			   		<div align="left">
			   		<br><br>
					     <div style="font-weight: bold; font-size: 16px;">Privacidad de la revista</div>
				    </div>
			   	</td> 
		   </tr>
		   <tr>
			   	<td >
			   		     <div id="estado-toggle">Solo tú y las personas que tú invites a colaborar podrán ver y seguir esta revista
						</div>
			   	</td>
			   	<td>
			   		<label class="switch" onchange="opcion()">
						  <input type="checkbox" id="chk">
						  <span class="slider round"></span>
					</label>
			   	</td>
		   </tr>
		    <tr>
			   	<td colspan="2">
			   		<div align="left">
			   		<br><br>
					     <div style="font-weight: bold; font-size: 16px;">Opciones para compartir de la revista

</div>
				    </div>
			   	</td> 
		   </tr>

		</table>
		<table  align="center" style="border: 1px solid #000; border-color:#b3b3b3;  ">
					<tr>
						<td style="border: none; padding: 5px;">
							<input type="text" id="url" style="font-weight: bold; border: 0px; outline:0px;" value="http://flip.it/fyb4NG" >
						</td>
						<td style="border: none; padding: 10px;">
							<div id style="color: #b3b3b3; cursor: pointer; width: 130px; "  align="right" onclick="selecionarTexto()">Haz clic para copiar</div>
						</td>
					</tr>
		</table>

		<br><br><br>
		
  <div align="left" style="cursor: pointer; color: #1AA3D1">Eliminar Revista</div>
    
<?php
	
	break;

default:
			
break;
}
?>